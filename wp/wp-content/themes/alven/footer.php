<?php
global $is_ajax;

    if (!$is_ajax) :
?><footer role='contentinfo' id='footer'>
        <div class='container'>
            <div class='container-small'>
                <div class='grid'>
                    <?php dynamic_sidebar( 'menu-responsive' ); ?>
                </div>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>

    </body>
</html><?php

endif; // if (!is_ajax) :
