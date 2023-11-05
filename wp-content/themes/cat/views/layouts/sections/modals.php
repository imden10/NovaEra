<!-- Error modal start -->
<?php if (isset($_GET['status']) && $_GET['status'] == 'error') : ?>
    <div class="modalbg">
        <div class="modalbody modaleror">
            <div class="modalclose">
                <img src="<?php echo appConfig('theme_url'); ?>/img/modalclose.svg" alt="close" class="modalclose__img">
            </div>

            <div class="modalcontentwrap">
                <h2 class="modalcontentwrap__centertitle">
                    <img src="<?php echo appConfig('theme_url'); ?>/img/erroricon.svg" alt=""><?php echo trans('Что-то пошло не так :('); ?>
                </h2>

                <span class="modalcontentwrap__centersubtitle"><?php echo trans('Проверьте правильность введенны данных'); ?></span>

                <a href="<?php echo get_site_url(); ?>" class="modalcontentwrap__gohomelnk"><?php echo trans('На главную'); ?></a>

                <span class="modalcontentwrap__weaccepttxt"><?php echo trans('Мы принимаем ваши заявки'); ?></span>

                <div class="modalcontentwrap__accepttimeswrap">
                    <?php echo implode(', ', array_map(function($item) {
                        return '<span>' . $item['day'] . ' <span class="colored">' . $item['hours'] . '</span> </span>';
                    }, getCustomOption('contacts_data_schedule', []))); ?>
                </div>

                <span class="modalcontentwrap__acceptwaittip"><?php echo trans('Если ваша заявка поступила в нерабочее время, мы свяжемся с вами в начале рабочего дня.'); ?></span>
            </div>
        </div>
    </div>
<?php endif; ?>
<!-- Error modal end -->

<?php if (isset($_GET['status'], $_GET['action']) && $_GET['status'] == 'success' && $_GET['action'] == 'appointment') : ?>
    <div class="modalbg">
        <div class="modalbody modalsuccess">
            <div class="modalclose">
                <img src="<?php echo appConfig('theme_url'); ?>/img/modalclose.svg" alt="close" class="modalclose__img">
            </div>

            <div class="modalcontentwrap">
                <h2 class="modalcontentwrap__centertitle"><?php echo trans('Ваша заявка принята!'); ?></h2>

                <span class="modalcontentwrap__centersubtitle"><?php echo trans('Администратор свяжется с вами в ближайшие 30 минут'); ?></span>

                <a href="<?php echo get_site_url(); ?>" class="modalcontentwrap__gohomelnk"><?php echo trans('На главную'); ?></a>

                <span class="modalcontentwrap__weaccepttxt"><?php echo trans('Мы принимаем ваши заявки'); ?></span>

                <div class="modalcontentwrap__accepttimeswrap">
                    <?php echo implode(', ', array_map(function($item) {
                        return '<span>' . $item['day'] . ' <span class="colored">' . $item['hours'] . '</span> </span>';
                    }, getCustomOption('contacts_data_schedule', []))); ?>
                </div>

                <span class="modalcontentwrap__acceptwaittip"><?php echo trans('Если ваша заявка поступила в нерабочее время, мы свяжемся с вами в начале рабочего дня.'); ?></span>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if (isset($_GET['status'], $_GET['action']) && $_GET['status'] == 'success' && $_GET['action'] == 'callback') : ?>
    <div class="modalbg">
        <div class="modalbody modalsuccess">
            <div class="modalclose">
                <img src="<?php echo appConfig('theme_url'); ?>/img/modalclose.svg" alt="close" class="modalclose__img">
            </div>

            <div class="modalcontentwrap">
                <h2 class="modalcontentwrap__centertitle"><?php echo trans('Благодарим за обратную связь!'); ?></h2>

                <span class="modalcontentwrap__centersubtitle"><?php echo trans('Администратор свяжется с вами в ближайшие 30 минут'); ?></span>

                <a href="<?php echo get_site_url(); ?>" class="modalcontentwrap__gohomelnk"><?php echo trans('На главную'); ?></a>

                <span class="modalcontentwrap__weaccepttxt"><?php echo trans('Мы принимаем ваши заявки'); ?></span>

                <div class="modalcontentwrap__accepttimeswrap">
                    <?php echo implode(', ', array_map(function($item) {
                        return '<span>' . $item['day'] . ' <span class="colored">' . $item['hours'] . '</span> </span>';
                    }, getCustomOption('contacts_data_schedule', []))); ?>
                </div>

                <span class="modalcontentwrap__acceptwaittip"><?php echo trans('Если ваша заявка поступила в нерабочее время, мы свяжемся с вами в начале рабочего дня.'); ?></span>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="modalbg appointment-service-modal" style="display: none;">
    <div class="modalbody appointment">
        <div class="modalclose">
            <img src="<?php echo appConfig('theme_url'); ?>/img/modalclose.svg" alt="close" class="modalclose__img">
        </div>

        <div class="modalcontentwrap">
            <h2 class="modalcontentwrap__title"><?php echo trans('Запишитесь онлайн в клинику MK Dental Clinic'); ?></h2>

            <?php require app('path.views') . '/layouts/forms/appointment_form.php'; ?>

            <span class="modalcontentwrap__contteltext"><?php echo trans('Вы всегда можете записаться по телефону у администратора клиники.'); ?></span>

            <div class="modalcontentwrap__conttelwrap">
                <?php echo implode(' ', array_map(function($item, $additional) {
                    return '<span class="modalcontentwrap__tellitem">' . $additional . $item .'; </span>';
                }, getCustomOption('contacts_data_phone', []), ['<i class="fas fa-mobile-alt"></i>'])); ?>
            </div>
        </div>
    </div>
</div>

<div class="modalbg callback-form-modal" style="display: none;">
    <div class="modalbody callback">
        <div class="modalclose">
            <img src="<?php echo appConfig('theme_url'); ?>/img/modalclose.svg" alt="close" class="modalclose__img">
        </div>

        <div class="modalcontentwrap">
            <h2 class="modalcontentwrap__title"><?php echo trans('Закажите обратный звонок'); ?></h2>

            <?php require app('path.views') . '/layouts/forms/callback_form.php'; ?>

            <span class="modalcontentwrap__contteltext"><?php echo trans('Вы всегда можете записаться по телефону у администратора клиники.'); ?></span>

            <div class="modalcontentwrap__conttelwrap">
                <?php echo implode(' ', array_map(function($item, $additional) {
                    return '<span class="modalcontentwrap__tellitem">' . $additional . $item .'; </span>';
                }, getCustomOption('contacts_data_phone', []), ['<i class="fas fa-mobile-alt"></i>'])); ?>
            </div>
        </div>
    </div>
</div>

<div class="modalbg package-service-modal" style="display: none;">
    <div class="modalbody callback">
        <div class="modalclose">
            <img src="<?php echo appConfig('theme_url'); ?>/img/modalclose.svg" alt="close" class="modalclose__img">
        </div>

        <div class="modalcontentwrap">
            <h2 class="modalcontentwrap__title"><?php echo trans('Запись на пакет услуг клинки MK Dental Clinic'); ?></h2>

            <?php require app('path.views') . '/layouts/forms/package_service_form.php'; ?>

            <span class="modalcontentwrap__contteltext"><?php echo trans('Вы всегда можете записаться по телефону у администратора клиники.'); ?></span>

            <div class="modalcontentwrap__conttelwrap">
                <?php echo implode(' ', array_map(function($item, $additional) {
                    return '<span class="modalcontentwrap__tellitem">' . $additional . $item .'; </span>';
                }, getCustomOption('contacts_data_phone', []), ['<i class="fas fa-mobile-alt"></i>'])); ?>
            </div>
        </div>
    </div>
</div>

<div class="leavefbbg add-review-modal">
    <div class="fbclose"><div></div></div>
    <div class="leavefbcontwrap">
        <h2 class="leavefbcontwrap__title"><?php echo trans('Напишите отзыв о клинике MK Dental Clinic'); ?></h2>

        <span class="leavefbcontwrap__subtitle"><?php echo trans('Если вы посещали нашу клинику и хотите поделиться впечателниями, оставьте, отзыв. Будьте объективны, ваша оценка поможет другим определиться с выбором. Заранее благодарны за ваше участие!'); ?></span>

        <?php require app('path.views') . '/layouts/forms/review_form.php'; ?>
    </div>
</div>
