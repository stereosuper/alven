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
                            <ul class='share'>
                                <li>
                                    <a href="<?php echo $twitter; ?>" target="_blank" rel="noopener noreferrer nofollow">
                                        <svg class="icon"><use xlink:href="#icon-twitter"></use></svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $linkedin; ?>" target="_blank" rel="noopener noreferrer nofollow">
                                        <svg class="icon"><use xlink:href="#icon-linkedin"></use></svg>
                                    </a>
                                </li>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
                <?php wp_nav_menu(array('theme_location' => 'secondary', 'container' => null, 'menu_id' => '', 'menu_class' => 'menu-secondary')); ?>
                </div>
            </footer>
        </div>

        <svg aria-hidden="true" style="position: absolute; width: 0; height: 0; overflow: hidden;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <defs>
                <symbol id="icon-glass" viewBox="0 0 31 32">
                    <path d="M31.201 29.732l-7.961-7.957c1.987-2.275 3.203-5.269 3.216-8.546v-0.003c0-0.025 0-0.055 0-0.085 0-7.355-5.962-13.317-13.317-13.317s-13.317 5.962-13.317 13.317c0 7.355 5.962 13.317 13.317 13.317 2.913 0 5.607-0.935 7.799-2.521l-0.039 0.027 8.032 8.034zM3.204 13.229c0-5.535 4.487-10.021 10.021-10.021s10.021 4.487 10.021 10.021c0 5.535-4.487 10.021-10.021 10.021v0c-5.532-0.006-10.015-4.489-10.021-10.021v-0.001z"></path>
                </symbol>
                <symbol id="icon-linkedin" viewBox="0 0 33 32">
                    <path d="M6.928 3.479c-0.016 1.894-1.555 3.423-3.451 3.423-1.906 0-3.451-1.545-3.451-3.451s1.545-3.451 3.451-3.451c0.001 0 0.001 0 0.002 0h-0c1.907 0.009 3.449 1.556 3.449 3.464 0 0.005 0 0.011-0 0.016v-0.001zM6.956 9.739h-6.956v22.259h6.956zM18.061 9.739h-6.911v22.259h6.915v-11.682c0-6.498 8.388-7.029 8.388 0v11.682h6.941v-14.092c0-10.963-12.413-10.564-15.329-5.167v-3.006z"></path>
                </symbol>
                <symbol id="icon-twitter" viewBox="0 0 39 32">
                    <path d="M12.385 32.002c0.047 0 0.102 0.001 0.157 0.001 12.611 0 22.834-10.223 22.834-22.834 0-0.055-0-0.111-0.001-0.166l0 0.008c0-0.349 0-0.702-0.023-1.043 1.587-1.157 2.925-2.543 3.994-4.125l0.037-0.058c-1.352 0.615-2.92 1.063-4.564 1.263l-0.078 0.008c1.67-1.012 2.925-2.565 3.535-4.411l0.016-0.057c-1.477 0.891-3.196 1.572-5.027 1.943l-0.104 0.018c-1.479-1.57-3.571-2.548-5.892-2.548-4.467 0-8.088 3.621-8.088 8.088 0 0.649 0.076 1.28 0.221 1.884l-0.011-0.055c-6.73-0.347-12.651-3.545-16.62-8.4l-0.032-0.041c-0.688 1.164-1.094 2.565-1.094 4.061 0 2.792 1.415 5.253 3.566 6.706l0.029 0.018c-1.353-0.041-2.611-0.411-3.708-1.031l0.040 0.021v0.103c0.001 3.897 2.759 7.15 6.43 7.913l0.052 0.009c-0.636 0.18-1.366 0.284-2.121 0.284-0.54 0-1.068-0.053-1.578-0.154l0.051 0.008c1.063 3.237 4.028 5.546 7.542 5.615l0.008 0c-2.729 2.16-6.221 3.465-10.017 3.465-0.006 0-0.012 0-0.018 0h0.001c-0.679-0.002-1.347-0.044-2.003-0.125l0.080 0.008c3.493 2.273 7.767 3.624 12.356 3.624 0.010 0 0.021 0 0.031-0h-0.002z"></path>
                </symbol>
            </defs>
        </svg>

        <?php wp_footer(); ?>

    </body>
</html>
