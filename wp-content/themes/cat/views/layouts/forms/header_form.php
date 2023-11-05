<span class="cformbanner__subtitle"><?php echo trans('Запишитесь онлайн в клинику MK Dental Clinic'); ?></span>

<?php require app('path.views') . '/layouts/forms/appointment_form.php'; ?>

<span class="howtoheal__enrlFormColWrap__enrlFormWrap__desc"><?php echo trans('Вы всегда можете записаться по телефону у администратора клиники.'); ?></span>

<div class="formwrap__contantphones">
    <?php echo implode(' ', array_map(function($item) {
        return '<span><i class="fas fa-mobile-alt"></i> ' . $item .';</span>';
    }, getCustomOption('contacts_data_phone', []))); ?>
</div>
