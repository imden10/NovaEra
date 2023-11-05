<section class="contactpage">
    <div class="contactpage__contenttext">
        <div class="container mobfluid">
            <div class="row">
                <div class="col-lg-7">
                    <div class="catmainsec__desc">
                        <h1><?= $page->page_information_page_test_field ?></h1>
                        <!-- Breadcrumbs -->
                        <ul class="brdcrmb">
                            <?php $home_page = get_post(get_option('page_on_front')); ?>
                            <li class="brdcrmb__li"><a href="<?php echo site_url(); ?>" class="brdcrmb__lnk"><?php echo $home_page->post_title; ?></a></li>

                            <li class="brdcrmb__li"><?php echo !empty($page->page_information_breadcrumb) ? $page->page_information_breadcrumb : $page->post_title; ?></li>
                        </ul>
                        <!-- End Breadcrumbs -->

                        <h1 class="catmainsec__desc__title variablefz"><?php echo $page->post_title; ?></h1>

                        <?php echo wpautop($page->post_content); ?>

                        <div class="contactpage__continfowrap">
                            <div class="contactpage__continfoitem">
                                <span class="contactpage__continfoitem__title"><?php echo trans('Мы открыты:'); ?></span>
                                <div class="contactpage__continfoitem__sub">
                                    <?php echo implode('', array_map(function($item) {
                                        return '<div class="contactpage__continfoitem__sub__txt">' . $item['day'] . ' ' . $item['hours'] . '</div>';
                                    }, getCustomOption('contacts_data_schedule', []))); ?>
                                </div>
                            </div>

                            <div class="contactpage__continfoitem">
                                <span class="contactpage__continfoitem__title"><?php echo trans('Телефоны'); ?></span>
                                <div class="contactpage__continfoitem__sub">
                                    <?php echo implode('', array_map(function($item) {
                                        return '<div class="contactpage__continfoitem__sub__txt">' . $item .'; </div>';
                                    }, getCustomOption('contacts_data_phone', []))); ?>
                                </div>
                            </div>

                            <div class="contactpage__continfoitem">
                                <span class="contactpage__continfoitem__title"><?php echo trans('Почта'); ?></span>
                                <div class="contactpage__continfoitem__sub">
                                    <div class="contactpage__continfoitem__sub__txt"><?php echo getCustomOption('contacts_data_email'); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="formwrap">
                        <span class="formwrap__subtitle"><?php echo trans('Есть вопросы? Напишите нам'); ?></span>
                        <span class="formwrap__subsecondtitle"><?php echo trans('Будем рады ответить на ваши приедложения и отзывы!'); ?></span>

                        <?php require app('path.views') . '/layouts/forms/appointment_form.php'; ?>

                        <span class="formwrap__desc"><?php echo trans('Вы всегда можете записаться по телефону у администратора клиники.'); ?></span>

                        <div class="formwrap__contantphones">
                            <?php echo implode('', array_map(function($item) {
                                return '<span><i class="fas fa-mobile-alt"></i> ' . $item .'; </span>';
                            }, getCustomOption('contacts_data_phone', []))); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="contactpage__mapwrap">
        <div id="gmap1"></div>
        <div class="contactpage__mapwrap__addreses">
            <div class="contactpage__mapwrap__addreses__col">
                <span class="contactpage__mapwrap__addreses__col__title"><?php echo trans('Мы находимся здесь:'); ?></span>
                <?php echo implode('', array_map(function($item) {
                    return '<span class="contactpage__mapwrap__addreses__col__text">' . $item .'</span>';
                },  explode(PHP_EOL, getCustomOption('contacts_data_address')))); ?>
            </div>

            <div class="contactpage__mapwrap__addreses__col">
                <span class="contactpage__mapwrap__addreses__col__title"><?php echo trans('Открыты'); ?></span>
                <?php echo implode('', array_map(function($item) {
                    return '<span class="contactpage__mapwrap__addreses__col__text">' . $item['day'] . ' ' . $item['hours'] . '</span>';
                }, getCustomOption('contacts_data_schedule', []))); ?>
            </div>
        </div>
    </div>
</section>

<?php require_once app('path.views') . '/layouts/scripts/map.php'; ?>
