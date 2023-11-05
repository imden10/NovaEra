<form action="<?php echo appConfig('post_handler', '/'); ?>" class="modalcontentwrap__form" method="post">
    <?php wp_nonce_field('callback_action'); ?>
    <input type="hidden" name="action" value="make_package_appointment_form">

    <input type="hidden" name="g-recaptcha-response-package-appointment-form">

    <input type="text" placeholder="<?php echo trans('ИМЯ'); ?>" name="name" class="modalcontentwrap__form__name" required>

    <input type="text" placeholder="<?php echo trans('ТЕЛЕФОН'); ?>" name="phone" class="modalcontentwrap__form__phone phonemask" required>

    <input type="hidden" name="package_name">

    <input type="submit" class="modalcontentwrap__form__submit" value="<?php echo trans('ПЕРЕЗВОНИТЕ МНЕ +'); ?>">
</form>
