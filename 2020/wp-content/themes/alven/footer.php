        </main>

        <footer role='contentinfo' id='footer'>
            <div class='container'>
                <div>
                    <?php wp_nav_menu(array('theme_location' => 'primary', 'container' => null, 'menu_id' => '', 'menu_class' => '')); ?>
                </div>
                <div class='menu-secondary'>
                    <?php wp_nav_menu(array('theme_location' => 'secondary', 'container' => null, 'menu_id' => '', 'menu_class' => '')); ?>
                </div>
            </div>
        </footer>

        <?php wp_footer(); ?>

        </body>
    </html>
