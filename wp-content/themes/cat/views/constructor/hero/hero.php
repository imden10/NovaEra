<div class="main-screen main-screen-hero">
    <div class="container">
        <?php if (!empty($content['title'])) : ?>
            <h2><?php echo $content['title']; ?></h2>
        <?php endif; ?>

        <?php if (!empty($content['text'])) : ?>
            <p><?php echo $content['text']; ?></p>
        <?php endif; ?>
    </div>
</div>

<?php require app('path.views') . '/constructor/_buttons.php'; ?>