
        <div class='portfolio-header'>
            <div class='container'>
                <div class='grid'>
                    <h1 class='col-3'>
                        <?php the_post_thumbnail('full'); ?>
                    </h1><div class='col-3'>
                        <div class='header-block-term'>
                            <?php
                                $terms = get_the_terms( $post->ID , 'field' );
                                $totalTerms = count($terms);
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
                        <?php if(get_field('website')){ $site = get_field('websiteDisplay') ? get_field('websiteDisplay') : get_field('website'); ?>
                            <div class='header-block-btn'>
                                <span class='title-small'>Website</span>
                                <a href='<?php the_field('website'); ?>' class='btn-invert' target='_blank'><?php echo $site; ?></a>
                            </div>
                        <?php } ?>
                    </div><div class='col-3'>
                        <?php if(get_field('keywords')){ ?>
                            <div class='header-block-keywords'>
                                <span class='title-small'>Keywords</span>
                                <?php the_field('keywords'); ?>
                            </div>
                        <?php } ?>
                        <?php if(get_field('appStoreLink') || get_field('googlePlayLink')){ ?>
                            <div class='header-block-btn'>
                                <span class='title-small'>App</span>
                                <?php if(get_field('appStoreLink')){ ?>
                                    <a href='<?php the_field('appStoreLink'); ?>' target='_blank' class='btn-store'>AppStore</a>
                                <?php }
                                if(get_field('googlePlayLink')){ ?>
                                    <a href='<?php the_field('googlePlayLink'); ?>' target='_blank' class='btn-play'>Google play</a>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <a href='#' id='closePortfolio' class='btn-close'><span>Close</span></a>
            </div>
        </div>

        <!--<main role='main' id='main'>-->
            <article class='content-main'>
                <div class='container'>

                    <h2><?php the_excerpt(); ?></h2>

                    <div class='container-small'>
                        <div class='grid'>
                            <div class='col-8 content-default'>
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </article>

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
                if($related){ ?>
                    <div class='related-portfolio'>
                        <div class='container'>
                            <div class='container-small'>
                                <div class='grid'>
                                    <div class='related-portfolio-list'>
                                        <span class='title-small'>Related articles</span>
                                        <?php foreach($related as $post){ setup_postdata($post); ?><div class='post-small'>
                                            <?php if(has_post_thumbnail()){ ?>
                                                <div class='img'>
                                                        <a href='<?php the_permalink(); ?>'>
                                                        <?php the_post_thumbnail('medium', array('class' => 'no-scroll')); ?>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                            <h4><a href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h4>
                                            <div class='post-meta'>
                                                <?php the_category( ', ' ); ?> -
                                                <time datetime='<?php echo get_the_date('Y-m-d'); ?>'><?php echo get_the_date(); ?></time>
                                            </div>
                                            <a href='<?php the_permalink(); ?>' class='btn-arrow'>Read</a>
                                        </div><?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php wp_reset_postdata(); }
            ?>
        <!--</main>-->
