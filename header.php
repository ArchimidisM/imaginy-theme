<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php imaginy_show_favicon(); ?>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php do_action('imaginy_after_body_tag'); ?>   
<div id="page" class="hfeed site">
    <?php do_action('imaginy_before_header'); ?>   
    <header id="masthead" class="site-header clearfix">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="mobile-header">
                    <a id="responsive-menu-button" href="#sidr-main"><i class='fa fa-reorder fa-3x'></i></a>
                    </div> 
                </div>
                <div class="col-md-12">
                    <div id="imaginy-logo-area-container">
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo imaginy_show_logo(); ?>
                            </div>
                        </div>
                    </div><!-- imaginy-logo-area-container ends here -->       
                </div>
            </div>
        </div><!-- .container ends here -->
        
        <!-- Header Image -->
        <?php 
        $has_header= imaginy_has_header_image(); 
        if($has_header == 1 && is_home()):
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="imaginy-header-image-container">
                        <?php echo imaginy_show_header_image();?>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Header Image ends here -->
        
    </header> 
    <!-- Site header ends here -->
    <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <nav role="navigation" class="clearfix transitions" id="imaginy-main-navigation">
                    <?php $imaginy_menu_args = array(
                    'theme_location'=>'main',
                    'container'=>false,
                    'menu_id'=>'navigation',
                    'echo'=>true);
                    wp_nav_menu($imaginy_menu_args);
                    ?>
                    </nav>
                   
                    <div id="imaginy-top-menu-container">
                     <?php if(imaginy_social_area_disabled()): ?>
                    <div class="clearfix transitions" id="imaginy-top-navigation">
                            <div class="row">
                                <div class="col-md-12">
                                    <ul id="imaginy-social-menu">
                                    
                                    <?php echo imaginy_show_social_networks(); ?>
                                
                                    </ul>    
                                </div>
                            </div>
                    </div>              
                    <?php endif; ?>
                    
                    <?php get_sidebar(); ?> 
                      
                </div>
                   
            </div>
         