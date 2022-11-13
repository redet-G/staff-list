<?php
//Free version
function abcfsl_mbox_tplate_staff_pg_layout( $tplateOptns ){

        echo  abcfl_html_tag('div','CN1','inside');
        $lstLayout = isset( $tplateOptns['_lstLayout'] ) ? esc_attr( $tplateOptns['_lstLayout'][0] ) : '0';
        $lstLayoutH = isset( $tplateOptns['_lstLayoutH'] ) ? esc_attr( $tplateOptns['_lstLayoutH'][0] ) : $lstLayout;
    
        $lstCntrW = isset( $tplateOptns['_lstCntrW'] ) ? esc_attr( $tplateOptns['_lstCntrW'][0] ) : '';
        $lstACenter = isset( $tplateOptns['_lstACenter'] ) ? esc_attr( $tplateOptns['_lstACenter'][0] ) : 'Y';
        $lstCntrTM = isset( $tplateOptns['_lstCntrTM'] ) ? esc_attr( $tplateOptns['_lstCntrTM'][0] ) : '';
        $lstCntrCls = isset( $tplateOptns['_lstCntrCls'] ) ? esc_attr( $tplateOptns['_lstCntrCls'][0] ) : '';
        $lstCntrStyle = isset( $tplateOptns['_lstCntrStyle'] ) ? esc_attr( $tplateOptns['_lstCntrStyle'][0] ) : '';
    
        //-- ADD NEW Record Screen. Display only Add New Field cbo --------------------
        if($lstLayoutH == '0'){
            abcfsl_mbox_tplate_staff_pg_layout_add_template_f( $lstLayout );
            echo abcfl_html_tag_end('div');
            return;
        }

        $layoutOptns['lstCntrW'] = $lstCntrW;
        $layoutOptns['lstCntrCls'] = $lstCntrCls;
        $layoutOptns['lstCntrStyle'] = $lstCntrStyle;    
        $layoutOptns['lstACenter'] = $lstACenter;
        $layoutOptns['lstCntrTM'] = $lstCntrTM;
        //$layoutOptns[''] = $;
        
        //---------------------------
        echo abcfl_input_hidden( '', 'lstLayoutH', $lstLayoutH );

        switch ( $lstLayoutH ) {
            case 1:
                abcfsl_mbox_tplate_staff_pg_layout_list( $tplateOptns, $layoutOptns, 'layout-list.png' );
                break;
            case 203:
                abcfsl_mbox_tplate_staff_pg_layout_list_i( $tplateOptns, $layoutOptns, 'layout-list.png' );
                break;             
            default:
                break;
        }
        echo abcfl_html_tag_end('div');
    }