<?php
$imageUrl = get_image_url_by_id($content['image']['id']);
?>


<div class="container">
    <?php if (!empty($content['title'])) : ?>
        <h2><?php echo $content['title']; ?></h2>
    <?php endif; ?>

    <img src="<?= $imageUrl ?>" alt="">
    <?php require app('path.views') . '/constructor/_buttons.php'; ?>
</div>