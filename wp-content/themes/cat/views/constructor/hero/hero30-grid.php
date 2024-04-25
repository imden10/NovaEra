<?php
$imageUrl = get_image_url_by_id($content['image']['id']);
?>

<div class="main-screen main-screen-hero-30-grid">
    <div class="container">
        <?php if (!empty($content['title'])) : ?>
            <h2><?php echo $content['title']; ?></h2>
        <?php endif; ?>

        <?php if (!empty($content['text'])) : ?>
            <p><?php echo $content['text']; ?></p>
        <?php endif; ?>

         <img src="<?= $imageUrl ?>" alt="" style="width: 200px">

        <span><?php echo $content['image_type']; ?></span>
    </div>
</div>

<?php require app('path.views') . '/constructor/_buttons.php'; ?>