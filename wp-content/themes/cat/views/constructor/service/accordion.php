<?php
$data = array_diff_key($content, array_flip(['list', 'image']));
$imageUrl = get_image_url_by_id($content['image']['id']);
?>

<div class="accordion">
    <div class="container">
        <?php
        print_r($data);
        ?>
        <!-- <img src="<?= $imageUrl ?>" alt="" style="width: 200px"> -->

        <?php if (!empty($content['title'])) : ?>
            <h2><?php echo $content['title']; ?></h2>
        <?php endif; ?>

        <div class="accordion-wrapper">
            <?php if (isset($content['list'])) : ?>
                <?php foreach ($content['list'] as $item) : ?>
                    <div class="accordion-title">
                        <?= $item['title']; ?>
                        <span class="icon"></span>
                    </div>
                    <div class="accordion-content redactor" hidden>
                            <?= $item['description']; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>

<?php require app('path.views') . '/constructor/_buttons.php'; ?>