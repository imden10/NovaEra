<?php
$imageUrl = get_image_url_by_id($content['image']['id']);
?>

<div class="first-screen hero-cards">
    <div class="container">
        <div class="text-column">
            <?php if (!empty($content['title'])) : ?>
                <h1><?php echo $content['title']; ?></h1>
            <?php endif; ?>
            <?php if (!empty($content['text'])) : ?>
                <div class="redactor"><?php echo $content['text']; ?></div>
            <?php endif; ?>

            <?php require app('path.views') . '/constructor/_buttons.php'; ?>

        </div>
        <div class="image-column">
            <img src="<?= $imageUrl ?>" alt="<?= $content['image_type']; ?>" style="max-width: 300px">
        </div>
        <div class="cards">
            <?php if (isset($content['list'])) : ?>
            <?php foreach ($content['list'] as $item) : ?>
                <a href="<?= $item['link'] ?>" class="hero-card">
                    <?= $item['title'] ?>

                    <?php if($item['icon_type'] === 'custom'):?>
                        <img src="<?= get_image_url_by_id($item['icon_custom']) ?>" style="width: 50px">
                    <?php else:?>
                        <i class="<?= $item['icon'] ?>"><?= $item['icon'] ?></i>
                    <?php endif; ?>
                </a>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>