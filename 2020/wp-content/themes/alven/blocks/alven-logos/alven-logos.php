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
<div id="<?php echo esc_attr($id); ?>" class="alven-logos">
    <ul>
    <?php while( have_rows('logos') ) : the_row(); ?>
        <li class="alven-logo">
            <?php echo wp_get_attachment_image(get_sub_field('logo')); ?>
            <p><?php the_sub_field('text'); ?></p>
        </li>
    <?php endwhile; ?>
    </ul>
</div>
<?php endif; ?>