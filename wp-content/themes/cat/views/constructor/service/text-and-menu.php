<div class="text-and-menu">
    <div class="container">
        <?php if (!empty($content['title'])) : ?>
            <h1><?php echo $content['title']; ?></h1>
        <?php endif; ?>

        <?php if (!empty($content['text'])) : ?>
            <?php echo $content['text']; ?>
        <?php endif; ?>

        <?php if (isset($content['list'])) : ?>
            <?php foreach ($content['list'] as $item) : ?>
                <a href="<?= $item['link_url'] ?>"><?= $item['link_name'] ?></a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php require app('path.views') . '/constructor/_buttons.php'; ?>