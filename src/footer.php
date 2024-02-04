        </main>
        <footer class="footer">
            <div class="footer__container container">
            <nav class="footer__nav nav">
                <ul class="menu footer__menu">
                    
                    <?php
                    $menu = get_menu();
                    foreach ($menu as $item) { ?>
                        <li class="menu__item footer__item">
                        <a href="<?php echo $item->url; ?>" class="footer__link menu__link"><?php echo $item->title; ?></a>
                    </li>
                    <?php } ?> 
                </ul>
            </nav>
            <?php get_sociables(); ?>
            <?php get_tels(); ?>
            </div>
        </footer>
        <?php wp_footer(); ?>
    </body>
</html>