<div class="container">
    <div class="inner-wrapper">
        <div class="aside-menu">
            <?php if (isset($content['list'])) : ?>
                <?php foreach ($content['list'] as $item) : ?>
                    <a href="<?= $item['link_url'] ?>"><?= $item['link_name'] ?></a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="content">
            <?php if (!empty($content['title'])) : ?>
                <h1><?php echo $content['title']; ?></h1>
            <?php endif; ?>

            <?php if (!empty($content['text'])) : ?>
                <div class="redactor">
                    <?php echo $content['text']; ?>
                </div>
            <?php endif; ?>
        </div>

    </div>
    <?php require app('path.views') . '/constructor/_buttons.php'; ?>
</div>