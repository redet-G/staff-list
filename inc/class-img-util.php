<?php
if (!defined('ABSPATH')) {
    exit;
}

if ( ! class_exists( 'ABCFSL_Img_Util' ) ) {

class ABCFSL_Img_Util {

	private $uploadDir = '';
	private $uploadUrl = '';
	private $fileQPath = '';
	private $fileUrl = '';
	private $fileName = '';
		
	public function __construct() {
		$this->setUloadDir();
	}

	private function setUloadDir() {

		$dirInfo = wp_get_upload_dir();
		$this->uploadDir = $dirInfo['path'];
		$this->uploadUrl = $dirInfo['url'];

		// [path] => Z:\xampp\htdocs\blog/wp-content/uploads
		// [url] => http://localhost:8080/blog/wp-content/uploads
		// [subdir] => 
		// [basedir] => Z:\xampp\htdocs\blog/wp-content/uploads
		// [baseurl] => http://localhost:8080/blog/wp-content/uploads
		// [error] => 
	}

	private function setFileQPath() {
		$this->fileQPath = trailingslashit( $this->uploadDir ) . $this->fileName;
	}

	private function setFileUrl() {
		$this->fileUrl = trailingslashit( $this->uploadUrl ) . $this->fileName;
	}
	
	//------------------------------------------------------------
	public function getUploadDir() {
		return $this->uploadDir;	
	}

	public function getUploadUrl() {
		return $this->uploadUrl;	
	}

	public function getFileQPath( $fileName ) {
		$this->fileName = $fileName;
		$this->setFileQPath();
		return $this->fileQPath;	
	}

	public function getFileUrl( $fileName ) {
		$this->fileName = $fileName;
		$this->setFileUrl();
		return $this->fileUrl;	
	}
}
}