<!-- style="background: no-repeat center/cover url(<?php echo appConfig('theme_url'); ?>/img/кабинет4.jpg)" -->

<div class="container">
    <div class="content">
        <?php if (!empty($content['title'])) : ?>
            <h2><?php echo $content['title']; ?></h2>
        <?php endif; ?>
        <?php if (!empty($content['text'])) : ?>
        <div class="redactor">
            <?php echo $content['text']; ?>
        </div>
        <?php endif; ?>
        <?php require app('path.views') . '/constructor/_buttons.php'; ?>
    </div>
</div>