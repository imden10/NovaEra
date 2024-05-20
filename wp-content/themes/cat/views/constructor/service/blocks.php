<?php
$data = array_diff_key($content, array_flip(['list']));
?>
<div class="container">
    <?php if (!empty($content['title'])) : ?>
        <h2 class="tac"><?php echo $content['title']; ?></h2>
    <?php endif; ?>
    <div class="cards-wrapper <?= 'card-in-row-' . $content['items_in_row'] . ' ' .  'card-' . $content['card_background_type'] . ' ' . 'card-' . $content['card_' . $content['card_background_type']]  ?>">
        <?php if (isset($content['list'])) : ?>
            <?php foreach ($content['list'] as $item) : ?>
                <div class="card">
                    <!-- <?php print_r($item); ?> -->
                    <?php if ($content['image_position'] == 'top' && $content['type'] === 'image') : ?>
                        <img src="<?= get_image_url_by_id($item['image']); ?>" alt="">

                    <?php endif ?>

                    <div class="card-info">
                        <div class="title-wrp">
                            <?php if ($content['type'] === 'icon' && $item['icon']) : ?>
                                <i class="<?= $item['icon'] ?>"></i>
                            <?php endif ?>
                            <?php if ($item['title']) : ?>
                                <h2>
                                    <?= $item['title']; ?>
                                </h2>
                            <?php endif; ?>
                        </div>

                        <?php if ($item['link_text'] && $item['link_url']) : ?>
                            <a href="<?= $item['link_url']; ?>" class="card-link"><?= $item['link_text']; ?></a>
                        <?php endif; ?>

                        <?php if ($item['description']) : ?>
                            <div class="description">
                                <?= $item['description']; ?>
                            </div>
                        <?php endif; ?>
                        <!-- new fields -->

                        <?php if ($item['btn__enable'] == 1) : ?>
                            <?php
                            if ($item['btn__type_link'] === "form") {
                                $formData = \App\Models\Form::getData($item['btn__form_id']);
                            }

                            // print_r($item);
                            // print_r($formData);
                            ?>

                            <div class="btn <?= $item['btn__type'] ?>"><?= $item['btn__text'] ?></div>
                        <?php endif; ?>
                    </div>

                    <?php if ($content['image_position'] == 'bottom' && $content['type'] === 'image') : ?>
                        <img src="<?= get_image_url_by_id($item['image']); ?>" alt="">

                    <?php endif ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <div class="center">
        <?php require app('path.views') . '/constructor/_buttons.php'; ?>
    </div>
</div>