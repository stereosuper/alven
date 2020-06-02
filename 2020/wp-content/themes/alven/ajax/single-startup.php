<div class='portfolio-detail-content container'>
    <button role='button' id='close' class="btn-close">
        <span>Close</span>
        <svg class="icon"><use xlink:href="#icon-cross-small"></use></svg>
    </button>

    <aside class='portfolio-header'>
        <h2 class='portfolio-logo'>
            <?php the_post_thumbnail('full'); ?>
        </h2>

        <p class='portfolio-term'>
            <?php
                $terms = get_the_terms( $post->ID , 'field' );
                $totalTerms = $terms ? count($terms) : 0;
                $countTerm = 0;
                if ($terms) {
                    foreach($terms as $term){
                        $countTerm ++;
                        echo $term->name;
                        if($countTerm < $totalTerms){
                            echo ' / ';
                        }
                    }
                }
            ?>
        </p>

        <?php if(get_field('history')){ ?>
            <div class='portfolio-history'>
                <p class='title'>History</p>
                <?php the_field('history'); ?>
            </div>
        <?php } ?>

        <?php if(get_field('appStoreLink') || get_field('googlePlayLink')){ ?>
            <div class='portfolio-btn'>
                <p class='title'>App</p>
                <?php if(get_field('appStoreLink')){ ?>
                    <a href='<?php the_field('appStoreLink'); ?>' target='_blank' class='btn-store'>AppStore</a>
                <?php } if(get_field('googlePlayLink')){ ?>
                    <a href='<?php the_field('googlePlayLink'); ?>' target='_blank' class='btn-play'>Google play</a>
                <?php } ?>
            </div>
        <?php } ?>

        <?php if(get_field('keywords')){ ?>
            <div class='portfolio-keywords'>
                <p class='title'>Keywords</p>
                <?php the_field('keywords'); ?>
            </div>
        <?php } ?>
    </aside>

    <div class='portfolio-text'>
        <div><?php the_content(); ?></div>

        <?php if(get_field('website')){ $site = get_field('websiteDisplay') ? get_field('websiteDisplay') : get_field('website'); ?>
            <a href='<?php the_field('website'); ?>' class='btn-invert' target='_blank'><?php echo $site; ?></a>
        <?php } ?>
    </div>
</div>

<?php
    $related = get_posts(array(
        'post_type' => 'post',
        'meta_query' => array(
            array(
                'key' => 'startup', // name of custom field
                'value' => '"' . get_the_ID() . '"',
                'compare' => 'LIKE'
            )
        )
    ));
        
    if( $related ) : ?>
        <div class='portfolio-related'>
            <div class='container'>
                <span class='title-small'>Related articles</span>
                <div class='portfolio-posts posts'>
                    <?php foreach($related as $post){ setup_postdata($post); ?>
                        <div>
                            <time datetime='<?php echo get_the_date('Y-m-d'); ?>' class='date'><?php echo get_the_date(); ?></time>
                            <h4 class="h6"><a href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h4>
                            <?php the_excerpt(); ?>
                            <a href='<?php the_permalink(); ?>' class='btn'>Read</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
<?php
    wp_reset_postdata();
    endif;
?>
