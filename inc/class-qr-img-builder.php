<?php
if ( ! defined( 'ABSPATH' ) ) {exit;}
class ABCFSL_QR_Img_Builder {

    private $params;
    private $qrParams;
    private $staffID = '';
    private $F = '';
    private $FieldNo = '';
    private $slTplateID = 0;
    private $vcTplateID = '';
    //private $metaKeyNameQRTplateID = '';

    private $vCardTxt = '';
    private $vcardFN = '';

    private $uploadDir = '';
    private $fileQPath = '';
    private $qrFileName = '';
    private $qrLblTxt = '';
    private $uploadUrl = '';
    private $strFileQPath = '';
    private $qrImgUrl = '';
    private $qrImgUri = '';
    //private $saveImg = false;
    
    
    private $errTxt = '';

    public function __construct( $params ) {

        // if( array_key_exists('saveImg', $params) ){ 
        //     $this->saveImg = $params['saveImg']; 
        // }

        if( array_key_exists('staffID', $params) ){ 
            $this->staffID = $params['staffID']; 
        }

        if( array_key_exists('F', $params) ){ 
            $this->F = $params['F']; 
            //vcTplateID_F21
            $this->metaKeyNameQRTplateID = '_vcTplateID_' . $params['F'];
            $this->FieldNo = ltrim( $this->F, 'F');
        }

        if( array_key_exists('slTplateID', $params) ){ 
            $this->slTplateID = $params['slTplateID']; 
        }        
    }

     // Only checkis if all parameters are present for PNG image. 
     public function checkForErrorsPNGImg() {

        $this->checkInputs();
        if( !empty( $this->errTxt ) ){ return; }

        $this->setVcTplateID();
        if( !empty(  $this->errTxt ) ){ return; }

        $this->setFileName();

        $this->setUploadDir();
        if( !empty(  $this->errTxt ) ){ return; }

        $this->qrTemplateExists();
        if( !empty(  $this->errTxt ) ){ return; }

        $this->getVCard();
        if( !empty(  $this->errTxt ) ){ return; }

    }

    // Checkis if all parameters are present and creates Uri. 
    public function maybeCreateQRImgUri() {

        $this->checkInputs();
        if( !empty( $this->errTxt ) ){ return; }

        $this->setVcTplateID();
        if( !empty(  $this->errTxt ) ){ return; }

        $this->qrTemplateExists();
        if( !empty(  $this->errTxt ) ){ return; }

        $this->getVCard();
        if( !empty(  $this->errTxt ) ){ return; }

        $this->createQRImage( false );
        if( !empty(  $this->errTxt ) ){ return; }

    }

    // Called from class ABCFSL_MBox_Item: abcfl_mbsave_create_qr_code_img
    // Checkis if all parameters are present and creates PNG image. 
    public function maybeCrateAndSaveQRImage() {

        $this->checkInputs();
        if( !empty( $this->errTxt ) ){ return; }

        $this->setVcTplateID();
        if( !empty(  $this->errTxt ) ){ return; }

        $this->setFileName();

        $this->setUploadDir();
        if( !empty(  $this->errTxt ) ){ return; }

        $this->qrTemplateExists();
        if( !empty(  $this->errTxt ) ){ return; }

        $this->getVCard();
        if( !empty(  $this->errTxt ) ){ return; }

        $this->createQRImage( true );
        if( !empty(  $this->errTxt ) ){ return; }

    }
    //==============================================================
    private function checkInputs() {

        if ( empty( $this->staffID ) ) { 
            $this->errTxt = 'Empty staffID.';
            return; 
        }
        if ( empty( $this->slTplateID ) ) { 
            $this->errTxt = 'Empty slTplateID.';
            return; 
        }

        // if ( empty( $this->metaKeyNameQRTplateID ) ) { 
        //     $this->errTxt = 'Empty QR Code Template meta key.';
        //     return; 
        // }
    }

    private function setVcTplateID() {

        $vcTplateID  = get_post_meta( $this->slTplateID, '_vcTplateID_' . $this->F, true);
        
        if( !$vcTplateID ) { 
            $this->errTxt = 'QR Code template not selected.';
            return; 
        }
        $this->vcTplateID = $vcTplateID;
    }

    private function setFileName() {
        $this->qrFileName = 'qrcode_' . $this->staffID . '_' . $this->FieldNo .'.png'; 
    }

    private function setUploadDir(){

        $imgDir = new ABCFSL_Img_Util();
        $uploadDir = $imgDir->getUploadDir(); 

        if( !$uploadDir ) { 
            $this->errTxt = 'Upload directory not found.';
            return; 
        }

        if( !is_dir( $uploadDir ) ) {
            $strUploadDir = str_replace('\\','/', $uploadDir);
            $this->errTxt = 'The Directory ' . $strUploadDir . ' does not exist';
            return;
        }

        $this->uploadDir = $uploadDir;
        $this->fileQPath = $imgDir->getFileQPath( $this->qrFileName );
        $this->strFileQPath = str_replace('\\','/', $this->fileQPath);

        $this->uploadUrl = $imgDir->getUploadUrl();    
        $this->qrImgUrl = $imgDir->getFileUrl ( $this->qrFileName );
        
    }

    //Check if QR template exists.
    private function qrTemplateExists(){
        $this->errTxt = abcfsl_util_vcard_no_tplate( $this->vcTplateID, 'QR',  $this->slTplateID );
    }

    public function getVCard(){

        $vcardBuilder = new ABCFVC_vCard_Builder(  $this->staffID, $this->vcTplateID, $this->slTplateID ); 

        $errTxt = $vcardBuilder->vcardBuilderGetErrTxt();
        if( !empty( $errTxt ) ) { 
            $this->errTxt = $errTxt;
            return; 
        }
        //------------------------------------------------------------
        $this->vCardTxt = $vcardBuilder->vcardBuilderGetVCardText();
        $this->vcardFN = $vcardBuilder->vcardBuilderGetFN();

        if(  empty( $this->vCardTxt ) ) { 
            $this->errTxt = 'vCard content is empty.';
            return; 
        }

        //Max output can be 4296 characters.
        $maxLen = strlen( $this->vCardTxt ); 
        if ( $maxLen > 4296 ) {
            $this->errTxt = 'vCard data too big. Max string length 4296. Current string: ' . $maxLen;
            return;
        }
        
        if(  empty( $this->vcardFN ) ) {
            $this->errTxt = 'vCard FN is empty.';
            return;
        }  
    }

    public function createQRImage( $saveImg ){

        $vcTplateOptns = get_post_custom( $this->vcTplateID  );

        //=== RENDER QR FILE ======================================
        $qrParams['qrCorrectionL'] = isset( $vcTplateOptns['_qrCorrectionL'] ) ?  $vcTplateOptns['_qrCorrectionL'][0] : '';
        $qrParams['qrBlockSizeM'] = isset( $vcTplateOptns['_qrBlockSizeM'] ) ?  $vcTplateOptns['_qrBlockSizeM'][0] : '';
        $qrParams['qrSize'] = isset( $vcTplateOptns['_qrSize'] ) ?  $vcTplateOptns['_qrSize'][0] : '';
        $qrParams['qrMargin'] = isset( $vcTplateOptns['_qrMargin'] ) ?  $vcTplateOptns['_qrMargin'][0] : 0;
        $qrParams['qrLblFN'] = isset( $vcTplateOptns['_qrLblFN'] ) ?  $vcTplateOptns['_qrLblFN'][0] : '';
        $qrParams['qrLblStatic'] = isset( $vcTplateOptns['_qrLblStatic'] ) ?  $vcTplateOptns['_qrLblStatic'][0] : '';
        $qrParams['vcardFN'] = $this->vcardFN;
        $qrParams['qrLblFontPx'] = isset( $vcTplateOptns['_qrLblFontPx'] ) ?  $vcTplateOptns['_qrLblFontPx'][0] : '';
        $qrParams['fileQPath'] = $this->fileQPath;
        $qrParams['saveImg'] = $saveImg;
        //----------------------------------------------------
        $qrRender = new ABCFVC_Qr_Render( $qrParams, $this->vCardTxt );
        $qrRender->renderQRCode();

        //if ( $this->saveImg ) {
        if ( $saveImg ) {    
            if ( !file_exists( $this->fileQPath ) ) {
                $this->errTxt = 'QR Code file not exists: ' . $this->strFileQPath;
                $this->qrImgUrl = '';
                return;            
            }
        }
        else{
            $this->qrImgUri = $qrRender->getImgUri();
            if ( empty( $this->qrImgUri ) ) {
                $this->errTxt = 'QR Code Base64 image not created';
                return;            
            }
            
        }     
    }

    //==============================================================
    public function getUploadDir() {
        return $this->uploadDir;
    }

    public function getUploadUrl() {
        return $this->uploadUrl;
    }

    public function getFileQPath() {
        return $this->strFileQPath;
    }
    public function getErrTxt() {
        return $this->errTxt;
    }
    public function getImgUrl() {
        return $this->qrImgUrl;
    }  

    public function getImgUri() {
        return $this->qrImgUri;
    }  
    
    
}