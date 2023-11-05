<footer>
    <div class="footerlinks">
        <div class="container">
            <?php if (!empty(menuItems('footer_mobile_menu'))) : ?>
                <div class="mobilelinks">
                    <?php foreach (menuItems('footer_mobile_menu') as $item) : ?>
                        <a href="<?php echo $item->url; ?>" class="mobilelinks__lnk"><?php echo $item->title; ?></a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="row">
                <?php if (!empty(getTreeMenu('footer_menu'))) : ?>
                    <?php foreach (getTreeMenu('footer_menu') as $item) : ?>
                        <div class="col-lg-3 col-md-4 nomobile">
                            <div class="footer_colitem">
                                <span class="footer_colitem__title"><?php echo $item->title; ?></span>

                                <?php if (!empty($item->children)) : ?>
                                    <ul class="footer_colitem__lnklist">
                                        <?php foreach ($item->children as $children_item) : ?>
                                            <li class="footer_colitem__lnklist__item"><a href="<?php echo $children_item->url; ?>"><?php echo $children_item->title; ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <div class="col-lg-4 notablet">
                    <div class="footer_colitem flexcont">
                        <div class="footer_colitem__subdiv">
                            <span class="footer_colitem__subdiv__text"><?php echo trans('Мы отвечаем на ваши звонки по телефонам'); ?></span>
                            <?php echo implode('', array_map(function($item) {
                                return '<span class="footer_colitem__subdiv__phonenum">' . $item .'; </span>';
                            }, getCustomOption('contacts_data_phone', []))); ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-4 mobtxtac">
                    <div class="footer_colitem flexcont">
                        <div class="footer_colitem__subdiv">
                            <span class="footer_colitem__subdiv__title"><?php echo trans('Мы открыты:'); ?></span>
                            <span class="footer_colitem__subdiv__text">
                                <?php echo implode('<br>', array_map(function($item) {
                                    return $item['day'] . ' ' . $item['hours'];
                                }, getCustomOption('contacts_data_schedule', []))); ?>
                            </span>

                            <span class="footer_colitem__subdiv__title"><?php echo trans('Мы находимся здесь:'); ?></span>
                            <span class="footer_colitem__subdiv__text">
                                <?php echo implode(', ', array_map('trim', explode(PHP_EOL, getCustomOption('contacts_data_address')))); ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footerbot">
        <div class="container">
            <div class="footerbot__linkswrap">
                <a href="https://owlweb.com.ua/" target="_blank" rel="nofollow" class="owlweblogo">
                    <span>Created by</span>
                    <img src="<?php echo appConfig('theme_url'); ?>/img/owlweb.svg" alt="owlweb">
                </a>

                <div class="footerbot__linkswrap__socwrap">
                    <?php if (!empty(getCustomOption('social_links_facebook'))) : ?>
                        <a href="<?php echo getCustomOption('social_links_facebook', '#'); ?>" class="footerbot__linkswrap__socwrap__lnk"><i class="fab fa-facebook-f"></i></a>
                    <?php endif; ?>

                    <?php if (!empty(getCustomOption('social_links_instagram'))) : ?>
                        <a href="<?php echo getCustomOption('social_links_instagram', '#'); ?>" class="footerbot__linkswrap__socwrap__lnk"><i class="fab fa-instagram"></i></a>
                    <?php endif; ?>

                    <?php if (!empty(getCustomOption('social_links_telegram'))) : ?>
                        <a href="https://t.me/<?php echo getCustomOption('social_links_telegram'); ?>" class="footerbot__linkswrap__socwrap__lnk"><i class="fab fa-telegram-plane"></i></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</footer>

<a href="#" class="callbtn menucall callback-form-button"><i class="fas fa-phone-alt"></i></a>

<a href="#firstscreen" class="upanchor ">
    <svg width="13" height="28" viewBox="0 0 13 28" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M6.5 27.5L6.5 2M1 5.5L6.5 1.5L12 5.5" stroke="#9E54FC"/>
    </svg>
</a>

<?php $stock_term = get_term(getCustomOption('relations_stock_category'));
if ($stock_term && $stock_term instanceof \WP_Term && $stock_term->count > 0) : ?>
    <div class="stockwrap">
        <div class="stockwrap__lnkwrap">
            <a href="<?php echo get_category_link($stock_term->term_id); ?>" class="stockwrap__lnkwrap__lnk"><?php echo trans('Акции'); ?></a>
        </div>
    </div>
<?php endif; ?>
