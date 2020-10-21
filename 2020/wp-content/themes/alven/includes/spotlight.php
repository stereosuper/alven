<?php
    $stickies = array_reverse( get_option( 'sticky_posts' ) );
                
    if( $stickies ){
        $post = $stickies[0];
    }else{
        $stickies = wp_get_recent_posts( array('numberposts' => 1, 'post_status' =>'publish') );
        $post = $stickies[0]['ID'];
    }
                
    $sticky = $post;
    setup_postdata($post);
?>
                
    <div class='spotlight-post'>
        <div class='img'>
            <div>
                <?php the_post_thumbnail('full', array('class' => 'no-scroll')); ?>
            </div>
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
            <h3 class="h2"><a href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h3>
            <?php the_excerpt(); ?>
            <a href='<?php the_permalink(); ?>' class='btn'>Read</a>
        </div>
    </div>

<?php wp_reset_postdata(); ?>