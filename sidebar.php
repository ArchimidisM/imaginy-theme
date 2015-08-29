<div id="imaginy-sidebar">
    <?php if (!dynamic_sidebar('sidebar')): ?>
        <div class="pre-widget">
            <h3><?php _e('Widgetized Sidebar', 'imaginy'); ?></h3>
            <p><?php _e('This panel is active and ready for you to add 
            some widgets via the WP Admin', 'imaginy'); ?></p>
        </div>
    <?php endif; ?>
</div>