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

if( have_rows('blocks') ) : ?>
<div id="<?php echo esc_attr($id); ?>" class="alven-text-icons"> 
<?php while( have_rows('blocks') ) : the_row(); ?>
    <div class="block">
        <?php echo wp_get_attachment_image(get_sub_field('image')); ?>
        <h3 class="uppercase block-title"><?php the_sub_field('title'); ?></h3>
        <?php the_sub_field('text'); ?>
    </div>
<?php endwhile; ?>
</div>
<?php endif; ?>