        <footer role='contentinfo' id='footer'>
            <div class='container'>
                <div class='container-small'>
                    <div class='grid'>
                        <?php dynamic_sidebar( 'menu-responsive' ); ?>
                    </div>
                </div>
                <div class='menu-secondary'>
                    <?php wp_nav_menu(array('theme_location' => 'secondary', 'container' => null, 'menu_id' => '', 'menu_class' => '')); ?>
                </div>
            </div>
        </footer>
    </div>

    <?php wp_footer(); ?>

    </body>
</html>
