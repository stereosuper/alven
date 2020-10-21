<div class='post'>
    <div class='img'>
        <?php if( has_post_thumbnail() ){ the_post_thumbnail(); } ?>
    </div>
    <div class='txt'>
        <p class="meta">
            <time datetime='<?php echo get_the_date('Y-m-d'); ?>' class='date'><?php echo get_the_date(); ?></time>
            <?php
                $categories = get_the_category();
                $count = 0;
                if($categories) : 
                    foreach($categories as $category):
                        if($count > 0) echo ', ';
                        echo '<a href="' . get_permalink( get_option( 'page_for_posts' ) ) . '?cat=' . $category->slug . '">' . $category->name . '</a>';
                        $count ++;
                    endforeach;
                endif;
            ?>
            </p>
        <h2 class="h6"><a href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h2>
        <?php the_excerpt(); ?>
        <a href='<?php the_permalink(); ?>' class='btn'>Read</a>
    </div>
</div>