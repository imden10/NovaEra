<div class="container">
    <?php if (!empty($content['title'])) : ?>
        <h2 class="title"><?php echo $content['title']; ?></h2>
    <?php endif; ?>

    <div class="prices-list">
        <?php if (isset($content['list'])) : ?>
            <?php foreach ($content['list'] as $item) : ?>
                <div class="prices-item">
                    <div class="main-info">
                        <?php if ($item['title']) : ?>
                            <h2>
                                <?= $item['title']  ?>
                            </h2>
                        <?php endif ?>
                        <?php if ($item['price_title']) : ?>
                            <p class="price-title <?= $item['price_color'] ?>">
                                <?= $item['price_title']  ?>
                            </p>
                        <?php endif ?>
                        <?php if ($item['btn__link'] && $item['btn__enable'] !== 1) : ?>
                            <a href="<?= $item['btn__link'] ?>" class="btn <?= $item['btn__color'] . ' ' . $item['btn__size'] . ' ' . $item['btn__type']  ?>">
                                <?= $item['btn__text'] ?>
                                <?php if ($item['btn__icon']) : ?>
                                    <i class="<?= $item['btn__icon'] ?>"></i>
                                <?php endif ?>
                            </a>
                        <?php endif ?>
                        <?php if ($item['btn__enable'] == 1) : ?>
                            <?php
                            if ($item['btn__type_link'] === "form") {
                                $formData = \App\Models\Form::getData($item['btn__form_id']);
                            }
                            ?>

                            <div class="btn <?= $item['btn__type'] ?>"><?= $item['btn__text'] ?></div>
                        <?php endif; ?>
                    </div>
                    <?php if ($item['description']) : ?>
                        <div class="redactor">
                            <?= $item['description'] ?>
                        </div>
                    <?php endif ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <?php require app('path.views') . '/constructor/_buttons.php'; ?>
</div>