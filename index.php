<?php get_header(); ?>
<!-- Main Container -->

    <div class="<?php echo imaginy_main_content_layout_class(); ?>">
        <div id="imaginy-main-content-container">
        <?php echo imaginy_show_breadcrumbs(); ?>
                    <?php do_action( 'imaginy_before_main_content' ); ?>
            
                    <div id="primary">
                    
                        <div id="content" class="clearfix">
                       
                        <?php if(have_posts()):while(have_posts()):the_post(); ?>
                          
                            <?php get_template_part( 'content', get_post_format() ); ?>
                            
                        <?php endwhile; ?>
                        
                            <?php the_posts_navigation(); ?>
                            
                        <?php else: ?>
                        
                            <?php get_template_part('no-posts-found'); ?>
                            
                        <?php endif; ?>
                        
                        </div>
                        
                    </div><!-- #primary ends here -->
                    
                    <?php do_action('imaginy_after_main_content'); ?>
                
                </div>
    </div>
    
    <?php if(imaginy_show_sidebar()): ?>
    
    <div class="col-md-3">
         <?php if (!dynamic_sidebar('right-sidebar')): ?>
            <div class="pre-widget">
                <h3><?php _e('Left Sidebar', 'imaginy'); ?></h3>
                <p><?php _e('This panel is active and ready for you to add 
                some widgets via the WP Admin', 'imaginy'); ?></p>
            </div>
         <?php endif; ?>
    </div>
    
    <?php endif; ?>
    
<?php get_footer(); ?>