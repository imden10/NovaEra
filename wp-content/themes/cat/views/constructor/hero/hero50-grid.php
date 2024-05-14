<?php
$imageUrl = get_image_url_by_id($content['image']['id']);
?>

<!-- <div class="main-screen main-screen-hero-50-grid">
    <div class="container">
        <?php if (!empty($content['title'])) : ?>
            <h2><?php echo $content['title']; ?></h2>
        <?php endif; ?>

        <?php if (!empty($content['text'])) : ?>
            <p><?php echo $content['text']; ?></p>
        <?php endif; ?>

        <img src="<?= $imageUrl ?>" alt="" style="width: 200px">
    </div>
</div> -->

<div class="first-screen column50">
    <div class="container">
        <div class="text-column">
            <?php if (!empty($content['title'])) : ?>
                <h1><?php echo $content['title']; ?></h1>
            <?php endif; ?>
            <?php if (!empty($content['text'])) : ?>
                <div class="redactor"><?php echo $content['text']; ?></div>
            <?php endif; ?>
            <!-- <div class="redactor">
                <p>
                    The eighth requirement. Raise the healthcare system's focus on the epidemic well-being
                </p>
            </div> -->
            <!-- <div class="btns-container">
                <div class="btn fill">з заливкою <i class="mdi mdi-check-bold"></i></div>
                <div class="btn stroke">З БОРДЕРОМ <i class="mdi mdi-check-bold"></i></div>
            </div> -->

            <?php require app('path.views') . '/constructor/_buttons.php'; ?>

        </div>
        <div class="image-column">
            <img src="<?= $imageUrl ?>" alt="<?= $content['image_type']; ?>">
        </div>
    </div>
</div>