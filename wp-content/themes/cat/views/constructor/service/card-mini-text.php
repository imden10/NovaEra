<?php
$data = array_diff_key($content, array_flip(['list']));
$imgPosition = $content['image_position']
?>
<div class="container">
    <div class="wrapper <?= $content['content_position'] ?>">
        <div class="mini-text">
            <?php if (!empty($content['title'])) : ?>
                <h2><?php echo $content['title']; ?></h2>
            <?php endif; ?>
            <?php if (!empty($content['text'])) : ?>
                <div class="redactor">
                    <?= $content['text']; ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="cards-wrapper card-in-row-2 <?= 'card-' . $content['card_background_type'] . ' ' . 'card-' . $content['card_' . $content['card_background_type']]  ?>">
            <?php if (isset($content['list'])) : ?>
                <?php foreach ($content['list'] as $item) : ?>
                    <a href="<?= $item['link_url']?>" class="card">
                        <?php if ($imgPosition == 'top') : ?>
                            <img src="<?= get_image_url_by_id($item['image']); ?>" alt="">
                        <?php endif ?>

                        <div class="card-info">
                            <h2>
                                <?= $item['title']; ?>
                            </h2>

                            <?php if ($item['link_text'] && $item['link_url']) : ?>
                                <a href="<?= $item['link_url']; ?>" class="card-link"><?= $item['link_text']; ?></a>
                            <?php endif; ?>

                            <div class="description">
                                <?= $item['description']; ?>
                            </div>
                            <?php if ($item['btn__enable'] == 1) : ?>
                                <?php
                                if ($item['btn__type_link'] === "form") {
                                    $formData = \App\Models\Form::getData($item['btn__form_id']);
                                }
                                ?>

                                <div class="btn <?= $item['btn__type'] ?>"><?= $item['btn__text'] ?></div>
                            <?php endif; ?>
                        </div>

                        <?php if ($imgPosition == 'bottom') : ?>
                            <img src="<?= get_image_url_by_id($item['image']); ?>" alt="">

                        <?php endif ?>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php require app('path.views') . '/constructor/_buttons.php'; ?>
        </div>
    </div>
</div>