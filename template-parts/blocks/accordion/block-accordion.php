<?php
/**
 * Block Name: Accordion
 *
 * This is repeater field that creates a Bootstrap accordion/collapse component.
 */

// Create id attribute for specific styling.
$block_id = 'accordion-' . $block['id'];
$i        = 0;

$classes = array( 'accordion' );

/**
 * Custom classes added in admin.
 */
if (! empty($block['className'])) {
    $classes[] = $block['className'];
}

if (have_rows('accordion')) :
    $trigger = get_field('trigger_element');
    $behavior = get_field('behavior_on_load');
    ?>
<div id="<?php echo esc_html($block_id); ?>" class="<?php echo esc_attr(implode(' ', $classes)); ?>">
    <?php

    switch ($behavior) {
        case 'all_closed':
            $show     = '';
            $expanded = 'false';
            break;
            
        default:
            $show     = ' show';
            $expanded = 'true';
    }

    while (have_rows('accordion')) :
        the_row();

        $accordion_id = esc_html($block_id . '-' . $i);
        ?>
        <div class="accordion-row">
            <div class="row align-items-center">
                <?php $col_content = 'col-md-24'; ?>
                <div class="col col-24 <?php echo $col_content; ?> col-accordion-content nobtm">
                    <<?php esc_attr_e($trigger); ?> class="accordion-heading" id="<?php esc_attr_e($accordion_id); ?>-heading">
                        <button data-bs-toggle="collapse" data-bs-target="#<?php esc_attr_e($accordion_id); ?>-collapse" aria-expanded="<?php esc_attr_e($expanded); ?>" aria-controls="<?php esc_attr_e($accordion_id); ?>-collapse">
                            <span><?php the_sub_field('title'); ?></span>
                            <i class="fa-solid fa-chevron-down"></i>
                        </button>
                    </<?php esc_attr_e($trigger); ?>>
                    <?php // data-bs-parent="#<?php echo esc_html( $block_id ); ?>
                    <div id="<?php esc_attr_e($accordion_id); ?>-collapse" class="collapse accordion-content<?php echo $show; ?>" aria-labelledby="<?php esc_attr_e($accordion_id); ?>-heading">
                        <div class="in">
                            <?php the_sub_field('content'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        switch ($behavior) {
            case 'first_open':
                $show     = '';
                $expanded = 'false';
                break;
        }
        $i++;
    endwhile;
    ?>
</div>
    <?php
elseif (is_admin()) : ?>
<p><em><?php esc_attr_e('Please add accordion rows.', 'wo'); ?></em></p>
<?php endif; ?>
