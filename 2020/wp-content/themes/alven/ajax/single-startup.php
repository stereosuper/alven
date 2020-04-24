<div class='portfolio-header'>
    <div class='container'>
        <h2>
            <?php the_post_thumbnail('full'); ?>
        </h2>
        <div>
            <div class='header-block-term'>
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
            </div>
            <?php if(get_field('history')){ ?>
                <div class='header-block-history'>
                    <span class='title-small'>History</span>
                    <?php the_field('history'); ?>
                </div>
            <?php } ?>
            <?php if(get_field('keywords')){ ?>
                <div class='header-block-keywords'>
                    <span class='title-small'>Keywords</span>
                    <?php the_field('keywords'); ?>
                </div>
            <?php } ?>
            <?php the_content(); ?>
            <?php if(get_field('website')){ $site = get_field('websiteDisplay') ? get_field('websiteDisplay') : get_field('website'); ?>
                <a href='<?php the_field('website'); ?>' class='btn-invert' target='_blank'><?php echo $site; ?></a>
            <?php } ?>
        </div>
        <div>
            
            <?php if(get_field('appStoreLink') || get_field('googlePlayLink')){ ?>
                <div class='header-block-btn'>
                <span class='title-small'>App</span>
                <?php if(get_field('appStoreLink')){ ?>
                    <a href='<?php the_field('appStoreLink'); ?>' target='_blank' class='btn-store'>AppStore</a>
                <?php } if(get_field('googlePlayLink')){ ?>
                    <a href='<?php the_field('googlePlayLink'); ?>' target='_blank' class='btn-play'>Google play</a>
                <?php } ?>
            </div>
        <?php } ?>
    </div>

    <a href='#' id='close' class='btn-close'><span>Close</span></a>
</div>
