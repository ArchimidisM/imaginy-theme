<section class="imaginy-no-posts-found">
    <div class="imaginy-page-content">
    <?php if(current_user_can('edit_posts')): ?>
    <h3><?php _e( 'Hiya! No posts found! Start writing your first post! Its simple!.', 'imaginy' ); ?></h3>
    <p>
    <a class="transitions" href="<?php echo esc_url(home_url());?>/wp-admin/post-new.php"><?php echo _e('Add a new post here','imaginy');?>
    </a></p>
 
    <?php elseif (is_search()) : ?>
        <h3><?php _e( 'Maybe you should search again. Nothing found.', 'imaginy' ); ?></h3>
        <?php get_search_form(); ?>
        
    <?php elseif(is_404()): ?>
        <h3><?php _e( 'Maybe you should search again. Nothing found.', 'imaginy' ); ?></h3>
        <?php get_search_form(); ?>

    <?php else : ?>
        <h3><?php _e( 'Maybe you should search again. Nothing found.', 'imaginy' ); ?></h3>
        <?php get_search_form(); ?>

    <?php endif; ?>
    </div>
</section>
