<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php do_action( 'imaginy_before_post_content' ); ?>
    
    <header class="entry-header">
        
    <?php if(imaginy_get_embed() != ''):
    
        
        echo imaginy_get_embed();
    
    elseif(has_post_thumbnail()): ?>
    
            <figure>
                <?php 
                    the_post_thumbnail('imaginy-blog-image-'.imaginy_main_content_layout_class(),array('class'=>'img-responsive','alt'=>get_the_title()));
                ?>       
            </figure>        
    <?php endif; ?>
        <h1 class="entry-title h2">
            <span class="fa fa-video-camera post-format-icon"></span>
            <span><a class="transitions" href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>">
            <?php echo imaginy_show_post_title(get_the_ID()); ?></a></span>
        </h1><!-- .entry-title -->
        <?php if(!is_single() && !is_page()): ?>
            <div class="entry-meta clearfix">
            <p>
               <?php echo get_the_date(get_option('date_format')); ?> / <?php echo comments_number( __('No comments','imaginy'),__('1 Comment','imaginy'), __('% Comments','imaginy' )); ?> /
               <?php echo get_the_category_list(',',''); ?>
            </p>
            </div>
        <?php endif; ?>
    </header>
    
    <?php if(!is_single() && !is_page()): ?>
    <div class="entry-content clearfix">
        <?php
            the_excerpt();
        ?>
        <a href="<?php the_permalink(); ?>" class="imaginy-read-more transitions radius"><?php echo __('Read More','imaginy'); ?> <i class="fa fa-arrow-right"></i></a>
    </div>
    <?php else: ?>
    <div class="entry-content clearfix">
        <?php
            the_content();
        ?>
    </div>
    <?php endif; ?>
    
    <?php if(is_page()): ?>
    
        <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'imaginy' ) . '</span>', 'after' => '</div>' ) ); ?>
        
        <div class="clearfix"></div>
    
    <?php endif; ?>

    <?php if ( 'post' == get_post_type() ) : ?>
                            
        <?php if(is_single() && !is_page()): ?>
        <footer class="entry-meta-footer clearfix">   
        <div class="entry-meta clearfix">
            <p>
               <?php echo get_the_date(get_option('date_format')); ?> / <?php echo comments_number( __('No comments','imaginy'),__('1 Comment','imaginy'), __('% Comments','imaginy' )); ?> /
               <?php echo get_the_category_list(',',''); ?>
               <?php if(has_tag()): echo get_the_tag_list('/',','); endif; ?>
               /  <?php echo '<i>'.__('Written by','imaginy').'</i>'.' '.get_the_author(); ?>
            </p>
            </div>
        
        <?php endif;?>
        
        <!-- Comments -->
        <?php if(is_single() || is_page()): ?>
        <div class="imaginy-comments-area">
            <?php comments_template( '', true ); ?>
        </div>
        <?php endif; ?>
          
        </footer>
    <?php endif; ?>
    <?php
    do_action( 'imaginy_after_post_content' );
   ?>
</article>
<hr/>

