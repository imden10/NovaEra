<header id="header">
    <div class="header-left">
        <?php if (has_custom_logo()) : ?>
            <a class="menuzord-brand pull-left flip xs-pull-center mt-20" href="<?php echo pll_home_url(); ?>">
                <img src="<?php echo wp_get_attachment_image_src(get_theme_mod('custom_logo' ), 'full')[0]; ?>" alt="<?php bloginfo('name'); ?>" class="header-left__logo">
            </a>
        <?php endif; ?>

        <?php if (!empty(getTreeMenu('main_menu'))) : ?>
            <nav>
                <ul class="menu">
                    <?php foreach (getTreeMenu('main_menu') as $item) : ?>
                        <li class="menu__item">
                            <a href="<?php echo $item->url; ?>" class="header-left__menu__menu__item__lnk"><?php echo $item->title; ?></a>

                            <?php if (!empty($item->children)) : ?>
                                <ul class="menu__submenu">

                                    <?php foreach ($item->children as $children_item) : ?>
                                        <li class="menu__submenuitem">
                                            <div class="menu__sublnkwrap">
                                                <a href="<?php echo $children_item->url; ?>" class="menu__sublnk"><?php echo $children_item->title; ?></a>
                                            </div>

                                            <?php if (!empty($children_item->children)) : ?>
                                                <ul class="menu__sub2menu">
                                                    <?php foreach ($children_item->children as $children_children_item) : ?>
                                                        <li class="menu__sub2item"><a href="<?php echo $children_children_item->url; ?>" class="menu__sub2lnk"><?php echo $children_children_item->title; ?></a></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>

    <div class="header-mid">
        <div class="header-mid__col">
            <?php $chunk_phones = array_chunk(getCustomOption('contacts_data_phone', []), 2);
            foreach ($chunk_phones as $chunk_phone) : ?>
                <div class="chunk-phones">
                    <?php echo implode(' ', array_map(function($item, $additional) {
                        return '<span class="header-mid__col__text">' . $additional . $item .';</span>';
                    }, $chunk_phone, ['<i class="fas fa-mobile-alt"></i>'])); ?>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="header-mid__col">
            <?php echo implode('', array_map(function($item) {
                return '<span class="header-mid__col__text">' . $item . '</span>';
            }, explode(PHP_EOL, getCustomOption('contacts_data_address')))); ?>
        </div>

        <div class="header-mid__col">
            <?php echo implode('', array_map(function($item) {
                return '<span class="header-mid__col__text">' . $item['day'] . ' ' . $item['hours'] . '</span>';
            }, getCustomOption('contacts_data_schedule', []))); ?>
        </div>
    </div>

    <?php $phone = array_shift(getCustomOption('contacts_data_phone', []));
    if (!empty($phone)) : ?>
        <div class="header-mid-mob">
            <div class="tll">
                <span class="header-mid__col__text">
                    <i class="fas fa-mobile-alt" aria-hidden="true"></i><?php echo $phone; ?>
                </span>
            </div>
        </div>
    <?php endif; ?>

    <div class="header-right">
        <a href="#" class="header-right__searchbtn"><i class="fas fa-search"></i></a>

        <?php if (function_exists('pll_the_languages') && function_exists('pll_current_language')) : ?>
            <div class="header-right__langwrap">
                <?php foreach (pll_the_languages(['raw' => 1]) as $locale) : ?>
                    <a href="<?php echo $locale['url']; ?>" class="header-right__langwrap__item<?php echo $locale['slug'] == pll_current_language() ? ' active' : ''; ?>">
                        <?php echo strtoupper($locale['slug']); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <a href="#" class="header-right__menutrigger">
            <div class="lines"></div>
        </a>
    </div>
</header>

<!-- Поиск -->
<div class="searchscreen">
    <div class="searchheader">
        <?php if (has_custom_logo()) : ?>
            <div class="header-left">
                <img src="<?php echo wp_get_attachment_image_src(get_theme_mod('custom_logo' ), 'full')[0]; ?>" alt="<?php bloginfo('name'); ?>" class="header-left__logo">
            </div>
        <?php endif; ?>

        <div class="searchcross"></div>
    </div>

    <div class="searchfieldwrap">
        <span class="searchfieldwrap__desc"><?php echo trans('Ищите услуги и другую полезную информацию'); ?></span>

        <?php get_search_form(); ?>
    </div>
</div>
<!-- Меню -->

<!-- Menu start -->
<div class="fullScrMenu">
    <div class="contwrap">
        <div class="container mobexpand">

            <?php if (!empty(getTreeMenu('main_menu'))) : ?>
                <div class="mob">
                    <div>
                        <div class="mobsearchandlang">
                            <a href="#" class="mobsearchandlang__searchbtn"><i class="fas fa-search"></i></a>

                            <?php if (function_exists('pll_the_languages') && function_exists('pll_current_language')) : ?>
                                <div class="mobsearchandlang__langwrap">
                                    <?php foreach (pll_the_languages(['raw' => 1]) as $locale) : ?>
                                        <a href="<?php echo $locale['url']; ?>" class="mobsearchandlang__langwrap__item<?php echo $locale['slug'] == pll_current_language() ? ' active' : ''; ?>">
                                            <?php echo strtoupper($locale['slug']); ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <ul class="menumob">

                            <?php foreach (getTreeMenu('main_menu') as $item) : ?>
                                <li class="menumob__item">
                                    <a href="<?php echo $item->url; ?>" class="menumob__item__lnk"><?php echo $item->title; ?></a>

                                    <?php if (!empty($item->children)) : ?>
                                        <div class="menumob__item__arrowwrap">
                                            <div class="arrow"></div>
                                        </div>
                                        <ul class="menumob__submenu">
                                            <?php foreach ($item->children as $children_item) : ?>
                                                <li class="menumob__submenuitem">
                                                    <div class="menumob__sublnkwrap">
                                                        <a href="<?php echo $children_item->url; ?>" class="menumob__sublnk"><?php echo $children_item->title; ?></a>
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="mob__footer">
                        <a href="#" class="mob__contactbtn appointment-service-button"><?php echo trans('записаться онлайн +'); ?></a>

                        
                    </div>
                </div>
            <?php endif; ?>

            <div class="row justify-content-end">
                <?php if (!empty(getTreeMenu('main_full_menu'))) : ?>
                    <?php foreach (getTreeMenu('main_full_menu') as $item) : ?>
                        <div class="col-lg-3 col-md-6 nomobile">
                            <div class="fullScrMenu__colwrap">
                                <div class="lnkwrap">
                                    <a href="<?php echo $item->url; ?>" class="fullScrMenu__headerlnk"><?php echo $item->title; ?></a>
                                </div>

                                <?php if (!empty($item->children)) : ?>
                                    <ul class="fullScrMenu__ul">
                                        <?php foreach ($item->children as $children_item) : ?>
                                            <li class="fullScrMenu__ul__li"><a href="<?php echo $children_item->url; ?>" class="fullScrMenu__ul__li__lnk"><?php echo $children_item->title; ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <div class="col-lg-3 col-md-12 nomobile">
                    <div class="fullScrMenu__colwrap jcspacebetween">
                        <div class="fullScrMenu__colwrap__subwrap">
                            <span class="fullScrMenu__textSm"><?php echo trans('Мы отвечаем на ваши звонки по телефонам'); ?></span>
                            <?php echo implode('', array_map(function($item) {
                                return '<span class="fullScrMenu__tellnum">' . $item .'</span>';
                            }, getCustomOption('contacts_data_phone', []))); ?>
                        </div>

                        <div class="fullScrMenu__colwrap__subwrap">
                            <span class="fullScrMenu__title"><?php echo trans('Почта'); ?></span>
                            <span class="fullScrMenu__text"><?php echo getCustomOption('contacts_data_email'); ?></span>

                            <span class="fullScrMenu__title"><?php echo trans('Мы открыты:'); ?></span>
                            <?php echo implode('', array_map(function($item) {
                                return '<span class="fullScrMenu__text">' . $item['day'] . ' ' . $item['hours'] . '</span>';
                            }, getCustomOption('contacts_data_schedule', []))); ?>

                            <span class="fullScrMenu__title"><?php echo trans('Мы находимся здесь:'); ?></span>
                            <span class="fullScrMenu__text">
                                <?php echo implode(', ', array_map('trim', explode(PHP_EOL, getCustomOption('contacts_data_address')))); ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="fullScrMenu__stocksandlinks nomobile">
        <?php $stock_term = get_term(getCustomOption('relations_stock_category'));
        if ($stock_term && $stock_term instanceof \WP_Term && $stock_term->count > 0) : ?>
            <a href="<?php echo get_category_link($stock_term->term_id); ?>" class="fullScrMenu__stockslnk"><?php echo trans('Акции'); ?></a>
        <?php endif; ?>

        <div class="fullScrMenu__socwrap">
            <?php if (!empty(getCustomOption('social_links_facebook'))) : ?>
                <a href="<?php echo getCustomOption('social_links_facebook', '#'); ?>" class="fullScrMenu__socwrap__lnk"><i class="fab fa-facebook-f"></i></a>
            <?php endif; ?>

            <?php if (!empty(getCustomOption('social_links_instagram'))) : ?>
                <a href="<?php echo getCustomOption('social_links_instagram', '#'); ?>" class="fullScrMenu__socwrap__lnk"><i class="fab fa-instagram"></i></a>
            <?php endif; ?>

            <?php if (!empty(getCustomOption('social_links_telegram'))) : ?>
                <a href="https://t.me/<?php echo getCustomOption('social_links_telegram'); ?>" class="fullScrMenu__socwrap__lnk"><i class="fab fa-telegram-plane"></i></a>
            <?php endif; ?>
        </div>

        <a href="#" class="callbtn menucall callback-form-button"><i class="fas fa-phone-alt"></i></a>
    </div>

    <div class="fullScrMenu__footer">
        <div class="header-mid__col">
            <?php echo implode('', array_map(function($item, $additional) {
                return '<span class="header-mid__col__text">' . $additional . $item .'</span>';
            }, getCustomOption('contacts_data_phone', []), ['<i class="fas fa-mobile-alt"></i>'])); ?>
        </div>

        <div class="header-mid__col">
            <?php echo implode('', array_map(function($item) {
                return '<span class="header-mid__col__text">' . $item . '</span>';
            }, explode(PHP_EOL, getCustomOption('contacts_data_address')))); ?>
        </div>

        <div class="header-mid__col">
            <?php echo implode('', array_map(function($item) {
                return '<span class="header-mid__col__text">' . $item['day'] . ' ' . $item['hours'] . '</span>';
            }, getCustomOption('contacts_data_schedule', []))); ?>
        </div>
    </div>
</div>


<!-- Menu end -->
