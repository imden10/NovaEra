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
        <!-- <div class="image-column">
            <img src="<?= $imageUrl ?>" alt="<?= $content['image_type']; ?>" style="max-width: 300px">
        </div> -->
        <div class="cards">
            <?php if (isset($content['list'])) : ?>
                <?php foreach ($content['list'] as $item) : ?>
                    <?php if ($item['icon_type'] === 'custom') : ?>
                        <div class="hero-card hero-item hero-card-img" style="--bg: url('<?= get_image_url_by_id($item['icon_custom']) ?>')">
                            <p class="description">
                                <?= $item['title'] ?>
                            </p>
                            <?php
                            $path_parts = pathinfo(get_image_url_by_id($item['icon_custom']));
                            if ($path_parts['extension'] === 'mp4') :
                            ?>
                                <video autoplay muted playsinline loop>
                                    <source src="<?= get_image_url_by_id($item['icon_custom']); ?>" type="video/mp4">
                                    Ваш браузер не поддерживает тег видео.
                                </video>
                            <?php endif; ?>

                            <!-- <img src="<?= get_image_url_by_id($item['icon_custom']) ?>"> -->
                        </div>
                    <?php else : ?>
                        <div class="hero-item hero-card">
<!-- href="<?= $item['link'] ?>" -->
                            <div class="hero-card-link"><?= $item['title'] ?>
                                <?php if ($item['icon']) : ?>
                                    <i class="icon <?= $item['icon'] ?>"></i>
                                <?php endif; ?>
                            </div>

                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>