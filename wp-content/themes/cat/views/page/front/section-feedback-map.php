<section class="howtoheal">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="howtoheal__enrlFormColWrap">
                    <div class="howtoheal__enrlFormColWrap__enrlFormWrap mobfluid">
                        <div class="sectionheaderwrap">
                            <div class="titlefigure"></div>
                            <h2 class="sectionheader"><?php echo trans('Как начать лечение?'); ?></h2>
                        </div>

                        <span class="cformbanner__subtitle"><?php echo trans('Запишитесь онлайн в клинику MK Dental Clinic'); ?></span>

                        <?php require_once app('path.views') . '/layouts/forms/appointment_form.php'; ?>

                        <span class="howtoheal__enrlFormColWrap__enrlFormWrap__desc"><?php echo trans('Вы всегда можете записаться по телефону у администратора клиники.'); ?></span>

                        <span class="howtoheal__enrlFormColWrap__enrlFormWrap__contantphones">
                            <i class="fas fa-mobile-alt"></i>
                            <?php echo implode(' ', array_map(function($item) {
                                return '<span>' . $item .'; </span>';
                            }, getCustomOption('contacts_data_phone', []))); ?>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 nopadding">
                <div class="mapwrap">
                    <!-- <div class="mapplaceholder"></div> -->
                    <div id="gmap1"></div>
                    <div class="mapwrap__addreses">
                        <div class="mapwrap__addreses__col">
                            <span class="mapwrap__addreses__col__title"><?php echo trans('Мы находимся здесь:'); ?></span>
                            <?php echo implode('', array_map(function($item) {
                                return '<span class="mapwrap__addreses__col__text">' . $item . '</span>';
                            }, explode(PHP_EOL, getCustomOption('contacts_data_address')))); ?>
                        </div>

                        <div class="mapwrap__addreses__col">
                            <span class="mapwrap__addreses__col__title"><?php echo trans('Открыты'); ?></span>
                            <?php echo implode('', array_map(function($item) {
                                return '<span class="mapwrap__addreses__col__text">' . $item['day'] . ' ' . $item['hours'] . '</span>';
                            }, getCustomOption('contacts_data_schedule', []))); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once app('path.views') . '/layouts/scripts/map.php'; ?>
