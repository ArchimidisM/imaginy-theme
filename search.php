<?php get_header(); ?>
<!-- Main Container -->

    <div class="col-md-10">
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
   
    </div><!-- .row ends here -->
</div><!- container ends here -->
<?php get_footer(); ?>