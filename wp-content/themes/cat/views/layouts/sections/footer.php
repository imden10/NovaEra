<footer>
    <div class="container">
        <div class="footer__menu">
            <?php foreach (getTreeMenu(225) as $item) : ?>
                <div class="menu__item">
                    <a href="<?php echo $item->url; ?>" class="menu__title"><?php echo $item->title ?></a>
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
                    <!-- <a href="#" class="menu__link"><i class="ic-facebook"></i> Facebook</a>
                    <a href="#" class="menu__link"><i class="ic-telegram"></i> Telegram</a>
                    <a href="#" class="menu__link"><i class="ic-linkedin-simple"></i> LinkedIn</a>
                    <a href="#" class="menu__link"><i class="ic-youtube-simple"></i> Youtube</a> -->
                    <a href="tel:+380672430001" class="menu__link">+380 67 243 00 01</a>
                    <a href="mailto:nfo@nova-era.com.ua" class="menu__link">nfo@nova-era.com.ua</a>
                </div>
            </div>

        </div>
        <div class="footer__bottom">



            <ul>
                <!--------------------------------- LANG SWICHET ------------------------------------------------------------------>
                <!-- <li>
                    <?php if (function_exists('pll_the_languages') && function_exists('pll_current_language')) : ?>
                        <div class="lang-switcher footer">
                            <?php $current_language = pll_current_language(); ?>
                            <div class="selected-lang">
                                <?php foreach (pll_the_languages(['raw' => 1]) as $locale) : ?>
                                    <?php if ($locale['slug'] == $current_language) : ?>
                                        <div class="lang">
                                            <i class="icon ic-lang"></i> <?php echo strtoupper($locale['slug']); ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                            <div class="other-langs">
                                <?php foreach (pll_the_languages(['raw' => 1]) as $locale) : ?>
                                    <?php if ($locale['slug'] != $current_language) : ?>
                                        <a href="<?php echo $locale['url']; ?>" class="lang">
                                            <?php echo strtoupper($locale['slug']); ?>
                                        </a>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </li> -->
                <!--------------------------------- END LANG SWICHET -------------------------------------------------------------->

                <li>Copyright © 2024</li>
                <li><a class="menu__link" href="https://nova-era.sisidev.com.ua/rules-for-using-the-site/">Правила використання</a></li>
                <li><a class="menu__link" href="https://nova-era.sisidev.com.ua/privacy-policy/">Політика конфіденційності</a></li>
                <li><a class="menu__link" href="https://nova-era.sisidev.com.ua/cookies/">Управління Cookies</a></li>
            </ul>
            <p>Зроблено в Україні | SiDev</p>
        </div>
    </div>
</footer>