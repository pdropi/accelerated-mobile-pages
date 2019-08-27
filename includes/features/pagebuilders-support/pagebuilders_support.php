<?php
use ReduxCore\ReduxFramework\Redux;
function ampforwp_page_builders_support_options($opt_name){
$wpbakery_for_ampchecker = $divi_pb_for_ampchecker = $elemntr_pb_for_ampchecker = array();

    $wpbakery_for_ampchecker = array( 

                    'id'   => 'wpbakery_pb_for_amp_info_normal',
                    'type' => 'info',
                    'required' => array(
                        array('ampforwp-wpbakery-pb-for-amp', '=' , true),  
                        ),
                     'desc' => sprintf('<div style="background: #FFF9C4;padding: 12px;line-height: 1.6;margin: -45px -14px -18px -17px;"><b>%s</b> %s <a href="https://ampforwp.com/page-builder-compatibility-for-amp/" target="_blank">%s</a> extension.<br /> <div style="margin-top:4px;">(<a href="https://ampforwp.com/page-builder-compatibility-for-amp/" target="_blank">%s</a>)</div></div>',esc_html__( 'ONE LAST STEP REQUIRED:','accelerated-mobile-pages'),esc_html__( 'This feature requires', 'accelerated-mobile-pages' ),esc_html__( 'Page Builder For AMP', 'accelerated-mobile-pages'),esc_html__( 'Click here for more info', 'accelerated-mobile-pages' )),               
               );
    $divi_pb_for_ampchecker = array( 
                    'id'   => 'divi_pb_for_amp_info_normal',
                    'type' => 'info',
                    'required' => array(
                        array('ampforwp-divi-pb-for-amp', '=' , true),  
                        ),
                     'desc' => sprintf('<div style="background: #FFF9C4;padding: 12px;line-height: 1.6;margin: -45px -14px -18px -17px;"><b>%s</b> %s <a href="https://ampforwp.com/page-builder-compatibility-for-amp/" target="_blank">%s</a> extension.<br /> <div style="margin-top:4px;">(<a href="https://ampforwp.com/page-builder-compatibility-for-amp/" target="_blank">%s</a>)</div></div>',esc_html__( 'ONE LAST STEP REQUIRED:','accelerated-mobile-pages'),esc_html__( 'This feature requires', 'accelerated-mobile-pages' ),esc_html__( 'Page Builder For AMP', 'accelerated-mobile-pages'),esc_html__( 'Click here for more info', 'accelerated-mobile-pages' )),               
               );
    $elemntr_pb_for_ampchecker = array( 
                    'id'   => 'elemntr_pb_for_amp_info_normal',
                    'type' => 'info',
                    'required' => array(
                        array('ampforwp-elementor-pb-for-amp', '=' , true),  
                        ),
                     'desc' => sprintf('<div style="background: #FFF9C4;padding: 12px;line-height: 1.6;margin: -45px -14px -18px -17px;"><b>%s</b> %s <a href="https://ampforwp.com/page-builder-compatibility-for-amp/" target="_blank">%s</a> extension.<br /> <div style="margin-top:4px;">(<a href="https://ampforwp.com/page-builder-compatibility-for-amp/" target="_blank">%s</a>)</div></div>',esc_html__( 'ONE LAST STEP REQUIRED:','accelerated-mobile-pages'),esc_html__( 'This feature requires', 'accelerated-mobile-pages' ),esc_html__( 'Page Builder For AMP', 'accelerated-mobile-pages'),esc_html__( 'Click here for more info', 'accelerated-mobile-pages' )),               
               );
//}   
     $pb_for_amp[] =  array(
                'id' => 'ampforwp-pagebuilder-accor',
                'type' => 'section',
                'title' => esc_html__('AMPforWP PageBuilder', 'accelerated-mobile-pages'),
                'indent' => true,
                'layout_type' => 'accordion',
                'accordion-open'=> 1, 
            );
    $pb_for_amp[] = array(
               'id'       => 'ampforwp-pagebuilder',
               'type'     => 'switch',
               'title'    => esc_html__('AMPforWP PageBuilder', 'accelerated-mobile-pages'),
               'tooltip-subtitle' => esc_html__('Enable or Disable the AMP PageBuilder', 'accelerated-mobile-pages'),
               'default'  => true
             );
     $pb_for_amp[] =  array(
                'id' => 'ampforwp-wpbakery-pb-for-amp-accor',
                'type' => 'section',
                'title' => esc_html__('WPBakery Page Builder Compatibility', 'accelerated-mobile-pages'),
                'indent' => true,
                'layout_type' => 'accordion',
                'accordion-open'=> 1, 
            );
     $pb_for_amp[] = array(
               'id'       => 'ampforwp-wpbakery-pb-for-amp',
               'type'     => 'switch',
               'title'    => esc_html__('WPBakery Page Builder Support','accelerated-mobile-pages'),
               'tooltip-subtitle' => esc_html__('Enable or Disable the WPBakery Page Builder support for AMP', 'accelerated-mobile-pages'),
               'default'  => false
            );
    $pb_for_amp[] = $wpbakery_for_ampchecker;
    $pb_for_amp[] =  array(
                'id' => 'ampforwp-divi-pb-for-amp-accor',
                'type' => 'section',
                'title' => esc_html__('Divi Builder Compatibility', 'accelerated-mobile-pages'),
                'indent' => true,
                'layout_type' => 'accordion',
                'accordion-open'=> 1, 
            );
    $pb_for_amp[] = array(
               'id'       => 'ampforwp-divi-pb-for-amp',
               'type'     => 'switch',
               'title'    => esc_html__('Divi Builder Support','accelerated-mobile-pages'),
               'tooltip-subtitle' => esc_html__('Enable or Disable the Divi Builder support for AMP', 'accelerated-mobile-pages'),
               'default'  => false
            );
    $pb_for_amp[] = $divi_pb_for_ampchecker;
    $pb_for_amp[] =  array(
                'id' => 'ampforwp-elementor-pb-for-amp-accor',
                'type' => 'section',
                'title' => esc_html__('Elementor Compatibility', 'accelerated-mobile-pages'),
                'indent' => true,
                'layout_type' => 'accordion',
                'accordion-open'=> 1, 
            );
    $pb_for_amp[] = array(
               'id'       => 'ampforwp-elementor-pb-for-amp',
               'type'     => 'switch',
               'title'    => esc_html__('Elementor Support','accelerated-mobile-pages'),
               'tooltip-subtitle' => esc_html__('Enable or Disable the Elementor support for AMP', 'accelerated-mobile-pages'),
               'default'  => false
            ); 
    $pb_for_amp[] = $elemntr_pb_for_ampchecker;

  $pb_title = 'Page Builder';
    $theme = wp_get_theme(); // gets the current theme
    if( class_exists('Vc_Manager') || ( class_exists('ET_Builder_Plugin') || 'Divi' == $theme->name || 'Divi' == $theme->parent_theme ) || did_action( 'elementor/loaded' ) ){
       if(class_exists('Vc_Manager') ){
           $pb_title =  'WPBakery Page Builder Support';
        }
       if( class_exists('ET_Builder_Plugin') || 'Divi' == $theme->name || 'Divi' == $theme->parent_theme ){
            $pb_title =  'Divi Builder Support';
        }
        if(did_action( 'elementor/loaded' ) ){
            $pb_title =  '!!!Elementor Support NNEEWW';
        }
    }

//echo "string";die;
    // PageBuilders Section
 Redux::setSection( $opt_name, array(
       'title'      => esc_html__(  'Elementor Support', 'accelerated-mobile-pages' ),
       'id'         => 'amp-content-builder',
       'class'      => 'ampforwp_new_features ',
       'subsection' => true,
       'fields' => $pb_for_amp,
       )

   ) ;
}