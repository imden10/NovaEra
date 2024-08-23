<div class="btns-container">
    <a href="<?= $item['btn__link'] ?>" target="_blank" class="btn <?= $item['btn__color'] ?> <?= $item['btn__size'] ?> <?= $item['btn__type'] ?> <?php if ($item['btn__type_link'] == 'form') : ?> render-form-btn <?php endif; ?>" <?php if ($item['btn__type_link'] == 'form') : ?> data-form_id="<?= $item['btn__form_id'] ?>" <?php endif; ?>>
        <?= $item['btn__text'] ?><i class="icon <?= $item['btn__icon'] ?>"></i>
    </a>
</div>