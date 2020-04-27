<?php
/*
Template Name: Portfolio
*/

require_once('includes/form-contact.php');

get_header(); ?>

    <?php if ( have_posts() ) : the_post(); ?>

        <div class='title-wrapper'>
            <div class='container'>
                <h1><?php the_title(); ?></h1>
            </div>
        </div>

        <section class='portfolio-detail' id='startup'></section>

        <section class="container">
            <div class='portfolio-wrapper'>
                <aside class='portfolio-filters' id='portfolio-filters'>
                    <div>
                        <ul>
                            <li>
                                <button data-filter='investment' data-investment='present'><?php the_field('present', 'options'); ?></button>
                            </li>
                            <li>
                                <button data-filter='investment' data-investment='past'><?php the_field('past', 'options'); ?></button>
                            </li>
                        </ul>
                        <ul>
                            <?php
                                $locs = get_terms(array('taxonomy' => 'location'));
                                foreach($locs as $loc){
                                    echo '<li><button data-filter="location" data-location="'.$loc->slug.'">'.$loc->name.'</button></li>';
                                }
                            ?>
                        </ul>
                    </div>
                    <div>
                        <ul class='portfolio-fields'>
                            <?php
                                $fields = get_terms(array('taxonomy' => 'field'));
                                foreach($fields as $field){
                                    echo '<li><button data-filter="field" data-field="'.$field->slug.'">'.$field->name.'</button></li>';
                                }
                            ?>
                        </ul>
                    </div>
                </aside>

                <div class='portfolio-content'>
                    <?php
                        $portfolioUrl = get_the_permalink();
                        $startups = new WP_Query(array('post_type' => 'startup', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC'));
                        if($startups->have_posts()):
                    ?>
                        <ul class='portfolio' id='portfolio'>
                            <?php while($startups->have_posts()): $startups->the_post(); ?>
                                <?php
                                    $fields = get_the_terms($post, 'field');
                                    $fieldList = '';
                                    if( $fields ){
                                        foreach( $fields as $field ){
                                            $fieldList .= $field->slug.',';
                                        }
                                    }

                                    $locs = get_the_terms($post, 'location');
                                    $locList = '';
                                    if( $locs ){
                                        foreach( $locs as $loc ){
                                            $locList .= $loc->slug.',';
                                        }
                                    }

                                    $color = get_field('color') ?: '#003240';
                                ?>
                                <?php if( get_field('investment') !== 'past' ){ ?>
                                    <li data-investment='<?php the_field('investment') ?>' data-field='<?php echo $fieldList; ?>' data-location='<?php echo $locList; ?>'>
                                        <a href='<?php echo '#' . basename(get_permalink()); ?>' class='ajax-load off' data-name='<?php echo basename(get_permalink()); ?>' style='background-color: <?php echo $color; ?>; border-color: <?php echo $color; ?>'>
                                            <?php if( has_post_thumbnail() ){
                                                echo alven_get_svg(get_post_thumbnail_id());
                                            }else{ ?>
                                                <span class='txt'><?php the_title(); ?></span>
                                            <?php } ?>
                                        </a>
                                    </li>
                                <?php } else{ ?>
                                    <li class='transfered' data-investment='<?php the_field('investment') ?>' data-field='<?php echo $fieldList; ?>' data-location='<?php echo $locList; ?>'>
                                        <a href='<?php echo '#' . basename(get_permalink()); ?>' class='ajax-load off' data-name='<?php echo basename(get_permalink()); ?>'>
                                            <span class='content-transfered <?php if(!get_field('acquiredBy')){ echo 'no-by'; } ?>'>
                                                <span <?php if(!has_post_thumbnail()){ echo "class='txt-container'"; } ?>>
                                                    <?php if(has_post_thumbnail()){
                                                        echo alven_get_svg(get_post_thumbnail_id());
                                                    }else{ ?>
                                                        <span class='txt'><?php the_title(); ?></span>
                                                    <?php } ?>
                                                </span>
                                                <?php if( get_field('acquiredBy') ){ ?>
                                                    <span>Sold to</span>
                                                    <span <?php if(!get_field('acquiredByLogo')){ echo "class='txt-container'"; } ?>>
                                                        <?php if(get_field('acquiredByLogo')){
                                                            echo alven_get_svg(get_field('acquiredByLogo'));
                                                        }else{ ?>
                                                            <span class='txt'><?php echo get_field('acquiredBy'); ?></span>
                                                        <?php } ?>
                                                    </span>
                                                <?php }else{ ?>
                                                    <span>Sold</span>
                                                <?php } ?>
                                            </span>
                                        </a>
                                    </li>
                                <?php } ?>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; wp_reset_query(); ?>
                </div>
            </div>
        </div>

        <section class='contact-wrapper'>
            <h2 class='title-home'><?php echo get_the_title(CONTACT_ID); ?></h2>
            <p class='subtitle'><?php the_field('contactSubtitle', CONTACT_ID); ?></p>
            <?php require_once('includes/contact.php'); ?>
        </section>

    <?php endif; ?>

<?php get_footer(); ?>
