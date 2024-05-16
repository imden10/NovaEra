<footer>
    <div class="container">
        <div class="footer__menu">
            <?php foreach (getTreeMenu(225) as $item) : ?>
                <div class="menu__item">
                    <a href="<?php echo $item->url; ?>" class="menu__title"><?php echo $item->title . ' - ' . $item->is_custom_menu; ?></a>
                    <?php if (!empty($item->children)) : ?>
                        <ul class="menu__list">
                            <?php foreach ($item->children as $children_item) : ?>
                                <?php if (!$children_item->is_custom_menu) : ?>
                                    <a href="<?php echo $children_item->url; ?>" class="menu__link">
                                        <?php echo $children_item->title; ?>
                                    </a>
                                <?php else : ?>
                                    <?php
                                    $has_custom_menu = true;
                                    $custom_menu_title = $children_item->title;
                                    $custom_menu = $children_item->children;
                                    ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif ?>
                </div>
            <?php endforeach ?>
            <div class="menu__item">
                <a href="#" class="menu__title">
                Звʼязок та соціальні мережі
                </a>
                <div class="menu__list">
                    <a href="#" class="menu__link"><i class="ic-facebook"></i> Facebook</a>
                    <a href="#" class="menu__link"><i class="ic-telegram"></i> Telegram</a>
                    <a href="#" class="menu__link"><i class="ic-linkedin-simple"></i> LinkedIn</a>
                    <a href="#" class="menu__link"><i class="ic-youtube-simple"></i> Youtube</a>
                    <a href="tel:+380672430001" class="menu__link">+380 67 243 00 01</a>
                    <a href="mailto:nfo@nova-era.com.ua" class="menu__link">nfo@nova-era.com.ua</a>
                </div>
            </div>

        </div>
        <div class="footer__bottom">
            <ul>
                <li>Copyright © 2024</li>
                <li><a class="menu__link" href="#">Правила використання</a></li>
                <li><a class="menu__link" href="#">Політика конфіденційності</a></li>
                <li><a class="menu__link" href="#">Управління Cookies</a></li>
            </ul>
            <p>Зроблено в Україні | SiDev</p>
        </div>
    </div>
</footer>