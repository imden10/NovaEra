<form action="<?php echo appConfig('post_handler', '/'); ?>" method="POST" class="cformbanner__form">
    <?php wp_nonce_field('callback_action'); ?>
    <input type="hidden" name="action" value="make_appointment_form">

    <input type="hidden" name="g-recaptcha-response-appointment-form">

    <input type="text" name="name" class="cformbanner__form__name inpname" placeholder="<?php echo trans('ИМЯ'); ?>" data-role="name">

    <input type="text" name="phone" class="cformbanner__form__phone phonemask" placeholder="<?php echo trans('ТЕЛЕФОН'); ?>" data-role="phone">

    <select name="service_id" class="howtoheal_form__service srvselect" placeholder="<?php echo trans('УСЛУГА'); ?>"></select>

    <input type="submit" class="formwrap__form__submit" value="<?php echo trans('записаться онлайн +'); ?>">
</form>

