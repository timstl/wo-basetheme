<?php
/**
 * Output copyright with dynamic year.
 */
?>
<?php if (get_field('footer_copyright', 'options')) : ?>
<span class="copyright">
    <?php echo esc_attr(str_ireplace(array('%year%', '%sitename%'), array(date('Y'), get_bloginfo('name')), get_field('footer_copyright', 'options'))); ?>
</span>
<?php endif; ?>
