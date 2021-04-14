<?php
/**
 * Alven Vimeo Block Template.
 *
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'alven-vimeo-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'alven-vimeo';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$url = get_field('url');
$cover = get_field('cover');
$title = get_field('title');
$text = get_field('text');

if( $url ) :
?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="video-wrapper">
        <button data-popin-video="<?php echo $url; ?>" class="js-popin video" type="button">
            <div class="cover" style="background-image:url(<?php echo $cover; ?>)"></div>
        </button>
    </div>

    <?php if( $text ) : ?>
        <div class="text">
            <?php if( $title ) : ?>
                <h3 class="uppercase"><?php echo $title; ?></h3>
            <?php endif; ?>

            <?php echo $text; ?>
        </div>
    <?php endif; ?>
</div>

<?php endif; ?>