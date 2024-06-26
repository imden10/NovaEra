<?php
$data = array_diff_key($content, array_flip(['list', 'image']));
$imageUrl = get_image_url_by_id($content['image']['id']);
?>

<div class="column60">
    <div class="container">

        <div class="block-wrapper <?= $content['content_position'] ?>">
            <div class="accordion-wrapper <?= $content['type'] ?>">
                <?php if (!empty($content['title'])) : ?>
                    <h2><?php echo $content['title']; ?></h2>
                <?php endif; ?>

                <?php if (!empty($content['text'])) : ?>
                    <h2><?php echo $content['text']; ?></h2>
                <?php endif; ?>

                <?php if (isset($content['list'])) : ?>
                    <?php foreach ($content['list'] as $item) : ?>
                        <div onclick="slideToggle(this)" class="accordion-title">
                            <?= $item['title']; ?>
                            <i class="ic-plus"></i>
                        </div>
                        <div class="accordion-content redactor" hidden>
                            <?= $item['description']; ?>
                            <img src="<?= get_image_url_by_id($item['image']); ?>" alt="" style="max-width: 200px">

                            <?php if ($item['btn__enable'] == 1) : ?>
                                <!-- <?php
                                        if ($item['btn__type_link'] === "form") {
                                            $formData = \App\Models\Form::getData($item['btn__form_id']);
                                        }

                                        print_r($item);
                                        print_r($formData);
                                        ?> -->
                                <div class="btn-wrp">
                                    <a href="<?= $item['btn__link'] ?>" class="btn <?= $item['btn__color'] . ' ' . $item['btn__type'] . ' ' . $item['btn__size'] ?>"><?= $item['btn__text'] ?></a>
                                </div>
                            <?php endif; ?>
                        </div>

                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php require app('path.views') . '/constructor/_buttons.php'; ?>
</div>