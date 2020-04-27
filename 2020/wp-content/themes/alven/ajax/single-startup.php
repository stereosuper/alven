<div class='portfolio-detail-content container'>
    <div class='portfolio-header'>
        <h2 class='portfolio-logo'>
            <?php the_post_thumbnail('full'); ?>
        </h2>

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
                    <p class='title'>History</p>
                    <?php the_field('history'); ?>
                </div>
            <?php } ?>

            <?php if(get_field('keywords')){ ?>
                <div class='header-block-keywords'>
                    <p class='title'>Keywords</p>
                    <?php the_field('keywords'); ?>
                </div>
            <?php } ?>
    </div>

        <div class='portfolio-text'>
            <?php the_content(); ?>

            <?php if(get_field('website')){ $site = get_field('websiteDisplay') ? get_field('websiteDisplay') : get_field('website'); ?>
                <a href='<?php the_field('website'); ?>' class='btn-invert' target='_blank'><?php echo $site; ?></a>
            <?php } ?>

            <?php if(get_field('appStoreLink') || get_field('googlePlayLink')){ ?>
            <div class='header-block-btn'>
                <p class='title'>App</p>
                <?php if(get_field('appStoreLink')){ ?>
                    <a href='<?php the_field('appStoreLink'); ?>' target='_blank' class='btn-invert'>AppStore</a>
                <?php } if(get_field('googlePlayLink')){ ?>
                    <a href='<?php the_field('googlePlayLink'); ?>' target='_blank' class='btn-invert'>Google play</a>
                <?php } ?>
            </div>
        <?php } ?>
        </div>
        
    <div  class='portfolio-close'>
        <button role='button' id='close'>Close</button>
    </div>
</div>
