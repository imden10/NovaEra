<div class="first-screen without-img">
    <div class="container">
        <div class="info">
            <?php if (!empty($content['title'])) : ?>
                <h1><?php echo $content['title']; ?></h1>
            <?php endif; ?>

            <?php if (!empty($content['text'])) : ?>
                <p><?php echo $content['text']; ?></p>
            <?php endif; ?>
        </div>
        <?php require app('path.views') . '/constructor/_buttons.php'; ?>
    </div>
</div>