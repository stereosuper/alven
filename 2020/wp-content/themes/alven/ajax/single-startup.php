<div class='portfolio-detail-content container'>
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
        <?php the_content(); ?>

        <?php if(get_field('website')){ $site = get_field('websiteDisplay') ? get_field('websiteDisplay') : get_field('website'); ?>
            <a href='<?php the_field('website'); ?>' class='btn-invert' target='_blank'><?php echo $site; ?></a>
        <?php } ?>

        <button role='button' id='close' class="btn-close">
            <span>Close</span>
            <svg class="icon"><use xlink:href="#icon-cross-small"></use></svg>
        </button>
    </div>
</div>
