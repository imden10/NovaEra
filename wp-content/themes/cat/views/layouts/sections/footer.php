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
                    <div class="social__list">

                        <?php if (getCustomOption('social_links_facebook', [])['link']): ?>
                            <a href="<?= getCustomOption('social_links_facebook', [])['link'] ?>" class="menu__link" style="order: <?= getCustomOption('social_links_facebook', [])['sort'] ?>"><i class="ic-facebook"></i> Facebook</a>
                        <?php endif; ?>

                        <?php if (getCustomOption('social_links_telegram', [])['link']): ?>
                            <a href="<?= getCustomOption('social_links_telegram', [])['link'] ?>" class="menu__link" style="order: <?= getCustomOption('social_links_telegram', [])['sort'] ?>"><i class="ic-telegram"></i> Telegram</a>
                        <?php endif; ?>

                        <?php if (getCustomOption('social_links_linkedin', [])['link']): ?>
                            <a href="<?= getCustomOption('social_links_linkedin', [])['link'] ?>" class="menu__link" style="order: <?= getCustomOption('social_links_linkedin', [])['sort'] ?>"><i class="ic-linkedin-simple"></i> LinkedIn</a>
                        <?php endif; ?>

                        <?php if (getCustomOption('social_links_youtube', [])['link']): ?>
                            <a href="<?= getCustomOption('social_links_youtube', [])['link'] ?>" class="menu__link" style="order: <?= getCustomOption('social_links_youtube', [])['sort'] ?>"><i class="ic-youtube-simple"></i> Youtube</a>
                        <?php endif; ?>
                    </div>

                    <?php $phones = getCustomOption('contacts_data_phone', []) ?>
                    <?php foreach ($phones as $phone) : ?>
                        <a href="tel:<?= $phone ?>" class="menu__link"><?= $phone ?></a>
                    <?php endforeach; ?>
                    <?php $email = getCustomOption('contacts_data_email', []) ?>
                    <a href="mailto:<?= $email ?>" class="menu__link"><?= $email ?></a>
                </div>
            </div>
        </div>
        <div class="footer__bottom">



            <ul>
                <!--------------------------------- LANG SWICHET ------------------------------------------------------------------>
                <li><a class="menu__link" href="https://bookkeeper.kiev.ua/" target="_blank">Copyright BookKeeper SaaS LLC</a> © 2024</li>
                <li><a class="menu__link" href="/rules-for-using-the-site/">Правила використання</a></li>
                <li><a class="menu__link" href="/privacy-policy/">Політика конфіденційності</a></li>
                <li><a class="menu__link" href="/cookies/">Управління Cookies</a></li>
            </ul>
            <a href="https://sidev.digital" target="_blank" class="menu__link" rel="nofollow">Зроблено в Україні | SiDev</a>
        </div>
    </div>
</footer>