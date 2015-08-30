<?php
/**================================================**/
/**  Imaginy functions file.
**   Adding core functionality.
**   Be careful when editing :) 
/**================================================**/

/**================================================**/
/** Define directory constants.
/**================================================**/

DEFINE('IMAGINY_STYLE_PATH',get_stylesheet_uri());
DEFINE('IMAGINY_CSS_PATH',get_template_directory_uri().'/css/');
DEFINE('IMAGINY_FONTS_PATH',get_template_directory_uri().'/fonts/');
DEFINE('IMAGINY_IMG_PATH',get_template_directory_uri().'/images/');
DEFINE('IMAGINY_INCLUDES_PATH',get_template_directory_uri().'/includes/');
DEFINE('IMAGINY_JS_PATH',get_template_directory_uri().'/js/');
DEFINE('IMAGINY_LANGUAGES_PATH',get_template_directory_uri().'/languages/');
DEFINE('IMAGINY_TEMPLATES_PATH',get_template_directory_uri().'/page-templates/');

/**================================================**/
/** Theme Setup
/**================================================**/
add_action('after_setup_theme','imaginy_theme_setup');
if(!function_exists('imaginy_theme_setup')):
function imaginy_theme_setup(){     
     /**== Set main content width ==**/
     if(!isset( $content_width ))
     $content_width = 750;
    
    /**== Add editor style ==**/
    add_editor_style('style.css');
    /**== Post Formats Support ==**/
    add_theme_support('post-formats', array('video','audio'));
    
    /**== Add RSS links to the theme ==**/
    add_theme_support( 'automatic-feed-links' );
    
    /**== This theme is ready for translation ==**/
    load_theme_textdomain( 'imaginy', get_template_directory(). '/languages' );
    
    /**== Add HTML5 to some elements -galleries and captions ==**/
    add_theme_support('html5', array( 'gallery', 'caption' ));
    
    /**== Add newest title-tag support for wordpress version 4.1 and above ==**/
   
    add_theme_support( 'title-tag' );
    
    /**== Register the navigation menus and positions ==**/
    register_nav_menus( array(
        'main' =>       __( 'Main Navigation', 'imaginy' ),
    ));
    
    /**== Custom Background ==**/
    $imaginy_background_defaults = array(
        'default-color' => 'ffffff',
        'default-image' => '',
        'wp-head-callback' => 'imaginy_background_callback',
        );
    add_theme_support( 'custom-background', $imaginy_background_defaults );
    
    /**== Custom Header Image ==**/
    $imaginy_header_defaults = array(
        'default-image'          => '',
        'random-default'         => false,
        'width'                  => '1170',
        'height'                 => '450',
        'flex-height'            => false,
        'flex-width'             => false,
        'default-text-color'     => '',
        'header-text'            => false,
        'uploads'                => true,
        'wp-head-callback'       => '',
        'admin-head-callback'    => '',
        'admin-preview-callback' => '',
        );
    add_theme_support( 'custom-header', $imaginy_header_defaults );
    
    /**== This add an excerpt field for  pages ==**/
    add_post_type_support( 'page', 'excerpt' );
    
    /**== This theme uses featured images ==**/
    add_theme_support('post-thumbnails' );
    add_image_size('imaginy-slider-boxed-image',1170,420,true);
    add_image_size('imaginy-blog-image-col-md-10',1170,600,true);
    add_image_size('imaginy-blog-image-col-md-7',768,420,true);
    add_image_size('imaginy-blog-image-col-md-4',768,450,true);
    add_image_size('imaginy-blog-image-col-md-3',768,580,true);
    add_image_size('imaginy-blog-image-full',1170,800,true);
}    
endif; //function imaginy_theme_setup ends here

/**================================================**/
/** Fallback functions
**  - Background Callback
**  - Navigation Menu callback (when is not a menu set up)
/**================================================**/
if(!function_exists('imaginy_background_callback')):
function imaginy_background_callback() {
  $background = set_url_scheme( get_background_image() );
  $color = get_theme_mod( 'background_color', get_theme_support( 'custom-background', 'default-color' ) );

  if ( ! $background && ! $color )
    return;

  $style = $color ? "background-color: #$color;" : '';

  if ( $background ) {
    $image = " background-image: url('$background');";

    $repeat = get_theme_mod( 'background_repeat', get_theme_support( 'custom-background', 'default-repeat' ) );
    if ( ! in_array( $repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ) ) )
      $repeat = 'repeat';
    $repeat = " background-repeat: $repeat;";

    $position = get_theme_mod( 'background_position_x', get_theme_support( 'custom-background', 'default-position-x' ) );
    if ( ! in_array( $position, array( 'center', 'right', 'left' ) ) )
      $position = 'left';
    $position = " background-position: top $position;";

    $attachment = get_theme_mod( 'background_attachment', get_theme_support( 'custom-background', 'default-attachment' ) );
    if ( ! in_array( $attachment, array( 'fixed', 'scroll' ) ) )
      $attachment = 'scroll';
    $attachment = " background-attachment: $attachment;";

    $style .= $image . $repeat . $position . $attachment;
  }
?>
<style type="text/css" id="custom-background-css">
body.custom-background { <?php echo trim( $style ); ?> }
</style>
<?php
}
endif; //function imaginy_background_callback ends here



/**================================================**/
/** Enqueue CSS & JS for the theme
/**================================================**/
add_action('wp_enqueue_scripts','imaginy_add_stylesheets');
function imaginy_add_stylesheets(){
    
    /**== Twitter Bootstrap ==**/
    wp_enqueue_style( 'imaginy-bootstrap', IMAGINY_CSS_PATH. 'bootstrap.min.css','','','all' );
    wp_enqueue_style( 'imaginy-bootstrap-theme', IMAGINY_CSS_PATH.'bootstrap-theme.min.css','','','all' );
    
    /**== Fonts & Icon fonts ==**/
    wp_enqueue_style('imaginy-roboto-slab',IMAGINY_FONTS_PATH.'roboto-slab-font/stylesheet.css','','','all');
    wp_enqueue_style('imaginy-antonio',IMAGINY_FONTS_PATH.'Antonio/stylesheet.css','','','all');
    
    wp_enqueue_style('imaginy-font-awesome-4.3.0',IMAGINY_FONTS_PATH.'font-awesome-4.3.0/css/font-awesome.min.css','','','all');
    
    /**== Other CSS ==**/
    wp_enqueue_style('imaginy-sidr-css',IMAGINY_CSS_PATH.'jquery.sidr.dark.css','','','all');
    
    /**== Main Style ==**/
    wp_enqueue_style('imaginy-imaginy-style',IMAGINY_STYLE_PATH,'','','all');
    
}// function imaginy_add_styles ends here

add_action('wp_enqueue_scripts','imaginy_add_scripts');
function imaginy_add_scripts(){
      
    if ( is_singular() && get_option( 'thread_comments' ) )
      wp_enqueue_script( 'comment-reply' );
      
    /**== Twitter Bootstrap js ==**/
    
    wp_enqueue_script('imaginy-bootstrap', IMAGINY_JS_PATH.'bootstrap.min.js',array('jquery'),'',true);

    /**== Other JS ==**/
    wp_enqueue_script('imaginy-sidr-js', IMAGINY_JS_PATH.'jquery.sidr.js',array('jquery'),'',true);
    wp_enqueue_script('imaginy-matchHeight-js', IMAGINY_JS_PATH.'jquery.matchHeight-min.js',array('jquery'),'',true);
    
    wp_enqueue_script('imaginy-theme-js', IMAGINY_JS_PATH.'theme.js',array('jquery'),'',true);

}// function imaginy_add_scripts ends here

add_action('wp_head', 'imaginy_add_html5shiv');
function imaginy_add_html5shiv () {
    echo '<!--[if lt IE 9]>';
    echo '<script src="'.IMAGINY_JS_PATH.'html5shiv.js"></script>';
    echo '<![endif]-->';
}//function imaginy_add_html5shiv ends here

/**================================================**/
/** Theme Functions
/**================================================**/

/**== Function for title in head ==**/
if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
    function imaginy_wp_title( $title, $sep ) {
        if ( is_feed() ) {
            return $title;
        }
        global $page, $paged;
       
        $title .= get_bloginfo( 'name', 'display' );
        
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) ) {
            $title .= " $sep $site_description";
        }
        if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
            $title .= " $sep " . sprintf( __( 'Page %s', 'imaginy' ), max( $paged, $page ) );
        }
        return $title;
    }
    add_filter( 'wp_title', 'imaginy_wp_title', 10, 2 );
endif;

/**== Add some sidebars ==**/
add_action('widgets_init','imaginy_register_sidebars');
function imaginy_register_sidebars(){
    
    /**== Right sidebar ==**/
    register_sidebar( array(
        'name'              => __( 'Sidebar', 'imaginy' ),
        'id'                => 'sidebar',
        'description'       => __( 'This is the main sidebar.It is shown below the main menu', 'imaginy' ),
        'before_widget'     => '<div id="%1$s" class="widget %2$s">',
        'after_widget'      => '</div>',
        'before_title'      => '<h3 class="widget-title"><span>',
        'after_title'       => '</span></h3>'
    ));  
    /**== Left sidebar ==**/
    register_sidebar( array(
        'name'              => __( 'Right Sidebar', 'imaginy' ),
        'id'                => 'right-sidebar',
        'description'       => __( 'This is the right sidebar.It is shown on the right when activated', 'imaginy' ),
        'before_widget'     => '<div id="%1$s" class="widget %2$s">',
        'after_widget'      => '</div>',
        'before_title'      => '<h3 class="widget-title"><span>',
        'after_title'       => '</span></h3>'
    )); 

    
    /**== Footer Sidebar 1 ==**/
    register_sidebar( array(
        'name'              => __( 'Footer Sidebar 1', 'imaginy' ),
        'id'                => 'imaginy_footer_1_sidebar',
        'description'       => __( 'This is the sidebar in the footer, on the left', 'imaginy' ),
        'before_widget'     => '<aside id="%1$s" class="footerwidget %2$s">',
        'after_widget'      => '</aside>',
        'before_title'      => '<h3 class="widget-title"><span>',
        'after_title'       => '</span></h3>'
    ));
    /**== Footer Sidebar 1 ==**/
    register_sidebar( array(
        'name'              => __( 'Footer Sidebar 2', 'imaginy' ),
        'id'                => 'imaginy_footer_2_sidebar',
        'description'       => __( 'This is the sidebar in the footer, the second on the left', 'imaginy' ),
        'before_widget'     => '<aside id="%1$s" class="footerwidget %2$s">',
        'after_widget'      => '</aside>',
        'before_title'      => '<h3 class="widget-title"><span>',
        'after_title'       => '</span></h3>'
    ));
    /**== Footer Sidebar 1 ==**/
    register_sidebar( array(
        'name'              => __( 'Footer Sidebar 3', 'imaginy' ),
        'id'                => 'imaginy_footer_3_sidebar',
        'description'       => __( 'This is the sidebar in the footer, the second on the right', 'imaginy' ),
        'before_widget'     => '<aside id="%1$s" class="footerwidget %2$s">',
        'after_widget'      => '</aside>',
        'before_title'      => '<h3 class="widget-title"><span>',
        'after_title'       => '</span></h3>'
    ));
    /**== Footer Sidebar 1 ==**/
    register_sidebar( array(
        'name'              => __( 'Footer Sidebar 4', 'imaginy' ),
        'id'                => 'imaginy_footer_4_sidebar',
        'description'       => __( 'This is the sidebar in the footer, on the right', 'imaginy' ),
        'before_widget'     => '<aside id="%1$s" class="footerwidget %2$s">',
        'after_widget'      => '</aside>',
        'before_title'      => '<h3 class="widget-title"><span>',
        'after_title'       => '</span></h3>'
    ));
}

/**== Get favicon or not ==**/
if(!function_exists('imaginy_show_favicon')):
    function imaginy_show_favicon(){
        $html = '';
        $imaginy_has_favicon = esc_url(get_theme_mod('imaginy_favicon_upload',''));
        if(empty($imaginy_has_favicon)):
           return;
        else:
            $html .=
            '<link rel="icon" href="'.$imaginy_has_favicon.'" type="image/x-icon"> ';
        endif;
    echo $html;
    }
endif;

/**== Get site title or logo ==**/
if(!function_exists('imaginy_show_logo')):
    function imaginy_show_logo(){
        $html = '';
        $imaginy_has_logo = esc_url(get_theme_mod('imaginy_logo_upload',''));
        if(empty($imaginy_has_logo)):
            $html .= 
            '<h1 id="imaginy-site-name">
                <a class="transitions" href="'.esc_url(home_url('/')).'">'.get_bloginfo('name').'</a>
            </h1>';
            $html .=
            '<h4 id="imaginy-site-subtitle">'.get_bloginfo('description').'</h4>';
        else:
            $html .=
            '<a href="'.esc_url(home_url('/')).'"><img src="'.$imaginy_has_logo.'" class="img-responsive" alt="'.get_bloginfo('name').'"></a>';
        endif;
    return $html;
    }
endif;

/**== Check if has header image ==**/
if( !function_exists('imaginy_has_header_image')):
function imaginy_has_header_image(){
    $has_header = get_header_image();
    
    if($has_header == ''):
        $has_header = 0;
    else:
        $has_header = 1;
    endif;
    return $has_header;
}
endif;

/** == Show header image == **/
if( !function_exists('imaginy_show_header_image')):
    function imaginy_show_header_image(){
    $html = '';
        if(get_header_image() != ''):
            $html .= '<img class="img-responsive" src="'.get_header_image().'" height="'.get_custom_header()->height.'" width="'.get_custom_header()->width.'" alt=""/>';
        else:
            return false;
        endif; 
    return $html;
}
endif;

/**== If there is a social area ==**/
if(!function_exists('imaginy_social_area_disabled')):
    function imaginy_social_area_disabled(){
        $is_disabled = esc_html(get_theme_mod('imaginy_enable_social_area',0));
        
        if($is_disabled == 1):
        
            return true;
        
        else:
        
            return false;
            
        endif;
    }//function imaginy_social_area_disabled ends here
endif;

/**== Social Icons ==**/
if(!function_exists('imaginy_show_social_networks')):
    function imaginy_show_social_networks(){
       $html = ''; 
       $soc_array = array('facebook',
       'twitter',
       'google-plus',
       'instagram',
       'pinterest',
       'linkedin',
       'flickr',
       'lastfm',
       'youtube',
       'vimeo-square',
       'dribbble',
       'tumblr',
       'skype',
       'share',
       'stumbleupon');
       
       $html .= '';
       foreach($soc_array as $soc):
       
         if(get_theme_mod('imaginy_'.$soc.'_url','') != ''):
            $html .= '
            <li>
            
            <a href="'.esc_url(get_theme_mod('imaginy_'.$soc.'_url','')).'">
            
                <i class="fa fa-'.$soc.'"></i>
                
            </a>
            
            </li>';
         endif;
       
       endforeach;
       
       return $html;
    }
endif;

/**== Get Post Title or Date if title is not present == **/
if(!function_exists('imaginy_show_post_title')):
    function imaginy_show_post_title($post_id){
        $title = get_the_title($post_id);
        
        if($title == ''):
            $title =  strip_tags(get_the_date(get_option('date_format'),$post_id));
        endif;
    return $title;
    }

endif;

/**== If is right sidebar enabled ==**/
if(!function_exists('imaginy_show_sidebar')):
    function imaginy_show_sidebar(){
        
        $has_sidebar = strip_tags(get_theme_mod('imaginy_enable_right_sidebar',0));
        if($has_sidebar == 0):
            
            return false;
        
        elseif($has_sidebar == 1):
        
            return true;
        
        endif;
    }
endif;

if(!function_exists('imaginy_main_content_layout_class')):
    function imaginy_main_content_layout_class(){
        if(imaginy_show_sidebar()):
           
            return 'col-md-7';
        
        else:
            
            return 'col-md-10';
       
        endif;
    }
endif;

/**==== Post Formats =====**/
if(!function_exists('imaginy_get_post_format')):
    function imaginy_get_post_format(){
        $post_format = strip_tags(get_post_format(get_the_ID()));
        
        return $post_format;
    }
endif;
/**== Get first lines of content to use with featured image ==**/
function imaginy_get_embed(){
    
    global $imaginy_videos;
    $post_id = get_the_ID();

    if( empty( $imaginy_videos ) ) $imaginy_videos = array();
    if( isset( $imaginy_videos[$post_id]) ) return $imaginy_videos[$post_id];

    $content = get_the_content();
    $content = apply_filters( 'the_content', $content );
    $content = str_replace( ']]>', ']]&gt;', $content );
    $content = trim($content);
    
    $imaginy_format = imaginy_get_post_format();     
    
    if($imaginy_format=='image'):
        list($line, $content) = explode("\n", $content."\n", 2);
    else:
        list($line, $content) = explode("\n", $content, 2);
    endif;
    
    if ( preg_match('/\<\s*(iframe|object|embed|img)/i', $line) ) {
        $imaginy_videos[$post_id] = strip_tags($line, '<iframe><object><embed><img>');
    }
    else {
        $imaginy_videos[$post_id] = false;
    }

    return $imaginy_videos[$post_id];   
}

/**== Create Breadcrumbs ==**/
if(!function_exists('imaginy_show_breadcrumbs')):
function imaginy_show_breadcrumbs() {
if(is_home() || is_front_page()): return false; endif;    
echo '<ul id="imaginy-breadcrumb-container">';

   
    if(is_category()):
        echo '<li><a href="'.get_home_url().'">'.__('Home','imaginy').'</a> <i class="fa fa-angle-double-right"> </i> '.'<em>'.__('You are currently viewing the category: ','imaginy').'</em> ';
        single_cat_title().'</li>';
    elseif(is_tag()):
        echo '<li><a href="'.get_home_url().'">'.__('Home','imaginy').'</a> <i class="fa fa-angle-double-right"> </i>  '.'<em>'.__('You are currently viewing the tag archive for: ','imaginy').'</em> ';
        single_tag_title().'</li>';    
    elseif(is_day()):
        echo '<li><a href="'.get_home_url().'">'.__('Home','imaginy').'</a> <i class="fa fa-angle-double-right"> </i>  ';
        echo __('Archive for ','imaginy'). get_the_time('F jS, Y').'</li>';  
    elseif(is_month()):
        echo '<li><a href="'.get_home_url().'">'.__('Home','imaginy').'</a> <i class="fa fa-angle-double-right"> </i>  ';
        echo __('Archive for ','imaginy'). get_the_time('F, Y').'</li>';  
    elseif(is_year()):
        echo '<li><a href="'.get_home_url().'">'.__('Home','imaginy').'</a> <i class="fa fa-angle-double-right"> </i>  ';
        echo __('Archive for ','imaginy'). get_the_time('Y').'</li>';  
    elseif(is_search()):
        echo '<li><a href="'.get_home_url().'">'.__('Home','imaginy').'</a> <i class="fa fa-angle-double-right"> </i>  ';
        echo __('Search Results for the term: ','imaginy').'<span class="info">'.$_GET['s'].'</span>'.'</li>';
    elseif(is_single() || is_page() || is_singular()):
       echo '<li><a href="'.get_home_url().'">'.__('Home','imaginy').'</a> <i class="fa fa-angle-double-right"> </i>  ';
       echo get_the_title().'</li>';
      
    endif;
    echo '</ul>';
}
endif;

/*== Add 'nextpage' quicktag in WordPress Editor ==**/
if( !function_exists('imaginy_editor')):
function imaginy_editor($mce_buttons) {
    $pos = array_search('wp_more',$mce_buttons,true);
    if ($pos !== false) {
        $tmp_buttons = array_slice($mce_buttons, 0, $pos+1);
        $tmp_buttons[] = 'wp_page';
        $mce_buttons = array_merge($tmp_buttons, array_slice($mce_buttons, $pos+1));
    }
    return $mce_buttons;
}
endif;
add_filter('mce_buttons','imaginy_editor');

/**== Post Comment Callback ==**/
if(!function_exists('imaginy_comment')):
function imaginy_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ( 'div' == $args['style'] ) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }
?>
    <<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
    <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
    <div class="comment-author vcard">
        <?php 
        if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
        <?php printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>','imaginy'
        ),
            get_comment_author_link() ); ?>
        
        <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
        <?php
            printf( __('%1$s at %2$s','imaginy'), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)','imaginy' ), '  ', '' );
        ?>
        </div>
    </div>
    
    <?php if ( $comment->comment_approved == '0' ) : ?>
        <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.','imaginy' ); ?></em>
        <br />
    <?php endif; ?>
    <div class="imaginy_comment_body">
    <?php comment_text(); ?>
    </div>
    <div class="reply">
    <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
    </div>
    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif; ?>
<?php
}
endif;

/**== Footer Active Sidebars ==**/
if(!function_exists('imaginy_active_footer_sidebars')):
    function imaginy_active_footer_sidebars(){
        
        $active_sidebars = 0;
        
        for($i=1; $i<5;$i++ ){
            
            if(is_active_sidebar('imaginy_footer_'.$i.'_sidebar')):
            
                $active_sidebars++;
            
            endif;
            
        }
        return strip_tags($active_sidebars);
    }
endif;

/**== Footer Columns ==**/
if(!function_exists('imaginy_footer_columns')):
    function imaginy_footer_columns(){
        
        $footer_columns = absint(get_theme_mod('imaginy_footer_columns_number',''));
        
        $footer_class = '';
        
        if($footer_columns == 1):
            
            $footer_class = 'col-md-12';
            
        elseif($footer_columns == 2):
            
            $footer_class = 'col-md-6';
            
        elseif($footer_columns == 3):
        
            $footer_class = 'col-md-4';
        
        elseif($footer_columns == 4):
        
            $footer_class = 'col-md-3';
        
        else:
            
            $footer_class == 'col-md-12';
            
        endif;
        
        return $footer_class;
    }
endif;

/**================================================**/
/** Customizer Support
 *================================================== */
add_action('customize_register', 'imaginy_customizer_registration');
function imaginy_customizer_registration($wp_customize){

    /** Customizer Sections
    *  1. General Section
     * 2. Social Section
     * 3. Footer Section
    ***/

     /*==== GENERAL SECTION ====*/

    $wp_customize->add_section(
        'imaginy_customizer_general_section',
        array(
            'title' => __('General Settings', 'imaginy'),
            'description' => __('Some General settings for the theme.', 'imaginy'),
            'priority' => 9,
        )
    );


    $wp_customize->add_setting(
        'imaginy_favicon_upload',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        )
    );

    $wp_customize->add_setting(
        'imaginy_logo_upload',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        )
    );

    $wp_customize->add_setting(
        'imaginy_enable_right_sidebar',
        array(
            'default' => 0,
            'sanitize_callback' => 'absint'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'imaginy_favicon_upload',
            array(
                'label' => __('Upload a favicon', 'imaginy'),
                'section' => 'imaginy_customizer_general_section',
                'settings' => 'imaginy_favicon_upload',
            )
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'imaginy_logo_upload',
            array(
                'label' => __('Upload a logo', 'imaginy'),
                'section' => 'imaginy_customizer_general_section',
                'settings' => 'imaginy_logo_upload',
            )
        )
    );

    $wp_customize->add_control(
        'imaginy_enable_right_sidebar',
        array(
            'type' => 'select',
            'label' => __('Select if the right sidebar is enabled.', 'imaginy'),
            'section' => 'imaginy_customizer_general_section',
            'settings' => 'imaginy_enable_right_sidebar',
            'choices' => array(
                0 => __('No', 'imaginy'),
                1 => __('Yes', 'imaginy'),

            )
        ));


    /*===== SOCIAL SECTION =====*/

    $wp_customize->add_section(
        'imaginy_customizer_social_section',
        array(
            'title' => __('Social Settings', 'imaginy'),
            'description' => __('Add your social networks.', 'imaginy'),
            'priority' => 10,
        )
    );

    $wp_customize->add_setting(
        'imaginy_enable_social_area',
        array(
            'default' => 0,
            'sanitize_callback' => 'absint'
        )
    );

    $wp_customize->add_setting(
        'imaginy_facebook_url',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        )
    );

    $wp_customize->add_setting(
        'imaginy_twitter_url',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        )
    );

    $wp_customize->add_setting(
        'imaginy_google-plus_url',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        )
    );

    $wp_customize->add_setting(
        'imaginy_instagram_url',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        )
    );

    $wp_customize->add_setting(
        'imaginy_pinterest_url',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        )
    );

    $wp_customize->add_setting(
        'imaginy_linkedin_url',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        )
    );

    $wp_customize->add_setting(
        'imaginy_flickr_url',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        )
    );

    $wp_customize->add_setting(
        'imaginy_lastfm_url',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        )
    );

    $wp_customize->add_setting(
        'imaginy_youtube_url',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        )
    );

    $wp_customize->add_setting(
        'imaginy_vimeo-square_url',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        )
    );

    $wp_customize->add_setting(
        'imaginy_dribbble_url',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        )
    );

    $wp_customize->add_setting(
        'imaginy_tumblr_url',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        )
    );

    $wp_customize->add_setting(
        'imaginy_skype_url',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        )
    );

    $wp_customize->add_setting(
        'imaginy_share_url',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        )
    );

    $wp_customize->add_setting(
        'imaginy_stumbleupon_url',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        )
    );


    $wp_customize->add_control(
        'imaginy_enable_social_area',
        array(
            'type' => 'select',
            'label' => __('Select if the you want to enable the social area below the menu to
             the right.
            .', 'imaginy'),
            'section' => 'imaginy_customizer_social_section',
            'settings' => 'imaginy_enable_social_area',
            'choices' => array(
                0 => __('No', 'imaginy'),
                1 => __('Yes', 'imaginy'),
            )
        ));

    $wp_customize->add_control(
        'imaginy_facebook_url',
        array(
            'label' => __('Facebook URL', 'imaginy'),
            'section' => 'imaginy_customizer_social_section',
            'settings' => 'imaginy_facebook_url',
            'type' => 'text'
        )
    );

    $wp_customize->add_control(
        'imaginy_twitter_url',
        array(
            'label' => __('Twitter URL', 'imaginy'),
            'section' => 'imaginy_customizer_social_section',
            'settings' => 'imaginy_twitter_url',
            'type' => 'text'
        )
    );

    $wp_customize->add_control(
        'imaginy_google-plus_url',
        array(
            'label' => __('Google Plus URL', 'imaginy'),
            'section' => 'imaginy_customizer_social_section',
            'settings' => 'imaginy_google-plus_url',
            'type' => 'text'
        )
    );

    $wp_customize->add_control(
        'imaginy_instagram_url',
        array(
            'label' => __('Instagram URL', 'imaginy'),
            'section' => 'imaginy_customizer_social_section',
            'settings' => 'imaginy_instagram_url',
            'type' => 'text'
        )
    );

    $wp_customize->add_control(
        'imaginy_pinterest_url',
        array(
            'label' => __('Pinterest URL', 'imaginy'),
            'section' => 'imaginy_customizer_social_section',
            'settings' => 'imaginy_pinterest_url',
            'type' => 'text'
        )
    );

    $wp_customize->add_control(
        'imaginy_linkedin_url',
        array(
            'label' => __('Lnkedin URL', 'imaginy'),
            'section' => 'imaginy_customizer_social_section',
            'settings' => 'imaginy_linkedin_url',
            'type' => 'text'
        )
    );

    $wp_customize->add_control(
        'imaginy_flickr_url',
        array(
            'label' => __('Flickr URL', 'imaginy'),
            'section' => 'imaginy_customizer_social_section',
            'settings' => 'imaginy_flickr_url',
            'type' => 'text'
        )
    );

    $wp_customize->add_control(
        'imaginy_lastfm_url',
        array(
            'label' => __('LastFM URL', 'imaginy'),
            'section' => 'imaginy_customizer_social_section',
            'settings' => 'imaginy_lastfm_url',
            'type' => 'text'
        )
    );

    $wp_customize->add_control(
        'imaginy_youtube_url',
        array(
            'label' => __('Youtube URL', 'imaginy'),
            'section' => 'imaginy_customizer_social_section',
            'settings' => 'imaginy_youtube_url',
            'type' => 'text'
        )
    );

    $wp_customize->add_control(
        'imaginy_vimeo-square_url',
        array(
            'label' => __('Vimeo URL', 'imaginy'),
            'section' => 'imaginy_customizer_social_section',
            'settings' => 'imaginy_vimeo-square_url',
            'type' => 'text'
        )
    );

    $wp_customize->add_control(
        'imaginy_dribbble_url',
        array(
            'label' => __('Dribbble URL', 'imaginy'),
            'section' => 'imaginy_customizer_social_section',
            'settings' => 'imaginy_dribbble_url',
            'type' => 'text'
        )
    );

    $wp_customize->add_control(
        'imaginy_tumblr_url',
        array(
            'label' => __('Tumblr URL', 'imaginy'),
            'section' => 'imaginy_customizer_social_section',
            'settings' => 'imaginy_tumblr_url',
            'type' => 'text'
        )
    );

    $wp_customize->add_control(
        'imaginy_skype_url',
        array(
            'label' => __('Skype URL', 'imaginy'),
            'section' => 'imaginy_customizer_social_section',
            'settings' => 'imaginy_skype_url',
            'type' => 'text'
        )
    );

    $wp_customize->add_control(
        'imaginy_share_url',
        array(
            'label' => __('Share URL', 'imaginy'),
            'section' => 'imaginy_customizer_social_section',
            'settings' => 'imaginy_share_url',
            'type' => 'text'
        )
    );

    $wp_customize->add_control(
        'imaginy_stumbleupon_url',
        array(
            'label' => __('StumbleUpon URL', 'imaginy'),
            'section' => 'imaginy_customizer_social_section',
            'settings' => 'imaginy_stumbleupon_url',
            'type' => 'text'
        )
    );

    /*===== FOOTER SECTION =====*/


    $wp_customize->add_section(
        'imaginy_customizer_footer_section',
        array(
            'title' => __('Footer Columns', 'imaginy'),
            'description' => __('How many columns do you want the footer to be?.', 'imaginy'),
            'priority' => 11,
        )
    );

    $wp_customize->add_setting(
        'imaginy_footer_columns_number',
        array(
            'default' => '',
            'sanitize_callback' => 'absint'
        )
    );

    $wp_customize->add_control(
        'imaginy_footer_columns_number',
        array(
            'type' => 'select',
            'label' => __('Select columns number.Bear in mind that even if you select columns
             if there are not any widgets , the columns won\'t appear',
                'imaginy'),
            'section' => 'imaginy_customizer_footer_section',
            'settings' => 'imaginy_footer_columns_number',
            'choices' => array(
                1 => __('1 Column', 'imaginy'),
                2 => __('2 Columns', 'imaginy'),
                3 => __('3 Columns', 'imaginy'),
                4 => __('4 Columns', 'imaginy'),

            )
        ));
}