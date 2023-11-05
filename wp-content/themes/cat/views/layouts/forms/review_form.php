<form action="<?php echo appConfig('post_handler', '/'); ?>" class="fbform" method="POST" enctype="multipart/form-data">
    <?php wp_nonce_field('callback_action'); ?>
    <input type="hidden" name="action" value="review_form">

    <input type="hidden" name="g-recaptcha-response-review-form">

    <div class="col4">
        <input name="name" type="text" class="fbform__name" placeholder="<?php echo trans('ИМЯ'); ?>" required>
    </div>

    <div class="col4">
        <input name="phone" type="text" class="fbform__phone phonemask" placeholder="<?php echo trans('ТЕЛЕФОН'); ?>" required>
    </div>

    <div class="fbform__starpick col4">
        <input type="file" hidden="" name="image" id="photoinput" accept="image/x-png,image/gif,image/jpeg">
        <div class="fbform__imgloadwrap">
            <img src="<?php echo appConfig('theme_url'); ?>/img/loadimg.svg" alt="load photo" class="fbform__imgload">
        </div>

        <div>
            <input name="rating" type="number" class="fbform__vote" value="4" min="1" max="5" hidden>
            <i class="fas fa-star vatestar picked" data-val="1"></i>
            <i class="fas fa-star vatestar picked" data-val="2"></i>
            <i class="fas fa-star vatestar picked" data-val="3"></i>
            <i class="fas fa-star vatestar picked" data-val="4"></i>
            <i class="fas fa-star vatestar" data-val="5"></i>
        </div>
    </div>

    <div class="col8">
        <?php $services = model('service')->selectList()->posts;
        if (!empty($services)) : ?>
            <select name="service_id" class="srvselect" required>
                <option value="0"><?php echo trans('Услуга'); ?></option>
                <?php foreach ($services as $service) : ?>
                    <option value="<?php echo $service->ID; ?>"<?php echo isset($service_id) && $service_id == $service->ID ? ' selected' : ''; ?>><?php echo $service->post_title; ?></option>
                <?php endforeach; ?>
            </select>
        <?php endif; ?>
    </div>

    <div class="col4">
        <input required name="date" type="text" class="fbform__date" placeholder="<?php echo trans('Дата посещения'); ?>" onfocus="(this.type='date')"/>
    </div>

    <div class="col12">
        <textarea name="text" id="fbtext" cols="30" rows="10" class="fbform__textarea" required placeholder="<?php echo trans('НАПИШИТЕ ВАШ ОТЗЫВ'); ?>"></textarea>
    </div>

    <div class="col12">
        <input type="submit" class="fbform__submit" id="fbsubmitbtn" value="<?php echo trans('Отправить'); ?>">
    </div>
</form>
