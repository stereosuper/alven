<div class='post'>
    <div class='img'>
        <?php if( has_post_thumbnail() ){ the_post_thumbnail(); } ?>
    </div>
    <div class='txt'>
        <time datetime='<?php echo get_the_date('Y-m-d'); ?>' class='date'><?php echo get_the_date(); ?></time>
        <h2 class="h6"><a href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h2>
        <?php the_excerpt(); ?>
        <a href='<?php the_permalink(); ?>' class='btn'>Read</a>
    </div>
</div>