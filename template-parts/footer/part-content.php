<?php if (get_field('footer_content', 'options')) : ?>
<div class="site-footer__content">
    <?php the_field('footer_content', 'options'); ?>
</div>
<?php endif;
