<?php
/**
 * Alven Vimeo Block Template.
 *
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'alven-vimeo-small-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'alven-vimeo-small';
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
$logo = get_field('logo');
$text = get_field('text');

if( $url ) :
?>
<!-- use section to make css :even work for bg colors -->
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="video-wrapper">
        <button data-popin-video="<?php echo $url; ?>" class="js-popin video" type="button">
            <div class="cover-small" style="background-image:url(<?php echo $cover; ?>)"></div>
        </button>
    </div>

    <?php if( $text ) : ?>
        <div class="text">
            <?php if( $title ) : ?>
                <div class="vimeo-small-title">
                    <h3 class="h6"><?php echo $title; ?></h3>
                    <?php echo wp_get_attachment_image($logo); ?>
                </div>
            <?php endif; ?>

            <?php echo $text; ?>
        </div>
    <?php endif; ?>
</section>

<?php endif; ?>