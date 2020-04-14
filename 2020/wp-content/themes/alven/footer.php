        </main>

        <footer role='contentinfo' class='footer'>
            <div class='container footer-top'>
                <?php wp_nav_menu(array('theme_location' => 'primary', 'container' => null, 'menu_id' => '', 'menu_class' => 'menu-footer')); ?>
                <div class='address'>
                    <?php the_field('address', 'options'); ?>
                    <?php
                        $twitter = get_field('twitter', 'options');
                        $linkedin = get_field('linkedin', 'options');
                        if( $twitter || $linkedin ) :
                    ?>
                        <ul>
                            <li><a href="<?php echo $twitter; ?>" target="_blank" rel="noopener noreferrer nofollow">Twitter</a></li>
                            <li><a href="<?php echo $linkedin; ?>" target="_blank" rel="noopener noreferrer nofollow">LinkedIn</a></li>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
            <?php wp_nav_menu(array('theme_location' => 'secondary', 'container' => null, 'menu_id' => '', 'menu_class' => 'menu-secondary')); ?>
            </div>
        </footer>

        <?php wp_footer(); ?>

        </body>
    </html>
