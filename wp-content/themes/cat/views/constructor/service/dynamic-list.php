<div class="container">
    <?php if (!empty($content['title'])) : ?>
        <h2><?php echo $content['title']; ?></h2>
    <?php endif; ?>

    <?php if (isset($content['list'])) : ?>
        <<?= $content['type'] == 'numeric' ? 'ol' : 'ul'; ?> class="list">
            <?php foreach ($content['list'] as $item) : ?>
                <li><?php echo $item['title']; ?></li>
            <?php endforeach; ?>
        </<?= $content['type'] == 'numeric' ? 'ol' : 'ul'; ?>>
    <?php endif; ?>
    <?php require app('path.views') . '/constructor/_buttons.php'; ?>
</div>