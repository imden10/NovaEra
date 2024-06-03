<div class="first-screen without-img">
    <div class="container">
        <div class="info">
            <?php if (!empty($content['title'])) : ?>
                <h1><?php echo $content['title']; ?></h1>
            <?php endif; ?>

            <?php if (!empty($content['text'])) : ?>
                <div class="redactor"><?php echo $content['text']; ?></div>
            <?php endif; ?>
        </div>
        <?php require app('path.views') . '/constructor/_buttons.php'; ?>
    </div>
</div>