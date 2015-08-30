</div><!--#page ends here -->
 </div>
<?php if(imaginy_active_footer_sidebars() != 0): ?>

    <footer id="imaginy-footer-area">

        <?php do_action('imaginy_before_footer'); ?>
        
        <div class="container">
            
            <div class="row">
            <?php 
            $imaginy_sidebar_number = imaginy_active_footer_sidebars(); 
            $imaginy_sidebar_class = imaginy_footer_columns();
            ?>   
            
            <?php for($i=1; $i<$imaginy_sidebar_number+1; $i++) { ?>  
            
                <div class="<?php echo strip_tags($imaginy_sidebar_class); ?> footer-sidebar
                matchHeight">
                    <?php if (!dynamic_sidebar( 'imaginy_footer_'.$i.'_sidebar')): ?>
                        <div class="pre-widget">
                            <h3><?php _e('Widgetized Sidebar', 'imaginy'); ?></h3>
                            <p><?php _e('This panel is active and ready for you to add 
                            some widgets via the WP Admin', 'imaginy'); ?></p>
                        </div>
                    <?php endif; ?>
                </div> 
                
            <?php } //end for?>  
            
            </div>
            
        </div>
        
        <?php do_action('imaginy_after_footer'); ?>
        
    </footer>

<?php endif; ?>
<div id="imaginy-footer-container">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <p>
                    <a rel="nofollow" href="<?php echo esc_url( __( 'http://www.webapptester.com/imaginy-theme/', 'imaginy')); ?>">
                   
                    <small><?php printf( __( 'Imaginy', 'imaginy' )); ?></a></small>,
                    
                    <small><?php echo __('&copy;','imaginy').date('Y'); ?></small>
                    
                    <small><?php bloginfo('name'); ?></small>
                    
                </p>    
            </div>
        </div>
    </div>
</div>
<?php wp_footer(); ?>
</body>
</html>