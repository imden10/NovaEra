<form action="<?php echo appConfig('post_handler', '/'); ?>" class="modalcontentwrap__form" method="post">
    <?php wp_nonce_field('callback_action'); ?>
    <input type="hidden" name="action" value="callback_form">

    <input type="hidden" name="g-recaptcha-response-callback-form">

    <input type="text" name="name" placeholder="<?php echo trans('ИМЯ'); ?>" class="modalcontentwrap__form__name" required>

    <input type="text" name="phone" placeholder="<?php echo trans('ТЕЛЕФОН'); ?>" class="modalcontentwrap__form__phone phonemask" required>

    <input type="submit" class="modalcontentwrap__form__submit" value="<?php echo trans('ПЕРЕЗВОНИТЕ МНЕ +'); ?>">
</form>
