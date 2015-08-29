<?php get_header(); ?>
<!-- Main Container -->
    <div class="col-md-10">
    <div id="imaginy-main-content-container">
    <?php echo imaginy_show_breadcrumbs(); ?>
                <?php do_action( 'imaginy_before_404_content' ); ?>
        
                <div id="primary">
                
                    <div id="content" class="clearfix">
                        <?php get_template_part('no-posts-found'); ?>
                    </div>
                    
                </div><!-- #primary ends here -->
                
                <?php do_action('imaginy_after_404_content'); ?>
            
            </div>
        </div>
   
    </div><!-- .row ends here -->
</div><!- container ends here -->
<?php get_footer(); ?>