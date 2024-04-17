<?php
$data = array_diff_key($content, array_flip(['list']));
?>

<div class="card-mini-text">
    <?php
    print_r($data);
    ?>

    <div class="block-wrapper <?= $content['content_position'] ?>">
        <div class="accordion-wrapper">
            <?php if (!empty($content['title'])) : ?>
                <h2><?php echo $content['title']; ?></h2>
            <?php endif; ?>

            <?php if (!empty($content['text'])) : ?>
                <h2><?php echo $content['text']; ?></h2>
            <?php endif; ?>

            <?php if (isset($content['list'])) : ?>
                <?php foreach ($content['list'] as $item) : ?>
                    <?= $item['title']; ?><br>

                    <?php if($item['link_text'] && $item['link_url']):?>
                        <a href="<?= $item['link_url']; ?>"><?= $item['link_text']; ?></a>
                    <?php endif; ?>

                    <!-- new fields -->
                    <img src="<?= get_image_url_by_id($item['image']); ?>" alt="" style="max-width: 200px">

                    <?php if($item['btn__enable'] == 1): ?>
                        <?php
                            if($item['btn__type_link'] === "form"){
                                $formData = \App\Models\Form::getData($item['btn__form_id']);
                            }

                            print_r($item);
                            print_r($formData);
                        ?>

                        <button><?= $item['btn__text'] ?></button>
                    <?php endif; ?>

                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require app('path.views') . '/constructor/_buttons.php'; ?>