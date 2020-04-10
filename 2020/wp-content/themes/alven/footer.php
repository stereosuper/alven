        </main>

        <footer role='contentinfo' id='footer'>
            <div class='container'>
                <div>
                    <?php wp_nav_menu(array('theme_location' => 'primary', 'container' => null, 'menu_id' => '', 'menu_class' => '')); ?>
                    <div>
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
                <div class='menu-secondary'>
                    <?php wp_nav_menu(array('theme_location' => 'secondary', 'container' => null, 'menu_id' => '', 'menu_class' => '')); ?>
                </div>
            </div>
        </footer>

        <?php wp_footer(); ?>

        </body>
    </html>
