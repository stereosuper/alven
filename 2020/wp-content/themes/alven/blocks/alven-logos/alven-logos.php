<?php
/**
 * Alven Logos Block Template.
 *
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'alven-logos-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

if( have_rows('logos') ) :
?>
<div id="<?php echo esc_attr($id); ?>" class="js-logos alven-logos">
    <div class="alven-logos-wrapper">
        <ul class="js-logos-list">
        <?php while( have_rows('logos') ) : the_row(); ?>
            <li class="js-logo alven-logo">
                <div class="img"><?php echo wp_get_attachment_image(get_sub_field('logo')); ?></div>
                <p><?php the_sub_field('text'); ?></p>
            </li>
        <?php endwhile; ?>
        </ul>

        <button type="button" class="js-logos-prev logos-prev off" data-slider="<?php echo esc_attr($id); ?>" disabled>
            <svg class="icon"><use xlink:href="#icon-left"></use></svg>
        </button>
        <button type="button" class="js-logos-next logos-next off" data-slider="<?php echo esc_attr($id); ?>">
            <svg class="icon"><use xlink:href="#icon-right"></use></svg>
        </button>
    </div>
</div>
<?php endif; ?>