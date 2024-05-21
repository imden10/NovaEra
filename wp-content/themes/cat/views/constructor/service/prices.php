<div class="prices">
    <div class="container">
        <?php if (!empty($content['title'])) : ?>
            <h2><?php echo $content['title']; ?></h2>
        <?php endif; ?>

        <?php if (isset($content['list'])) : ?>
            <div style="display: flex; gap: 30px">
                <?php foreach ($content['list'] as $item) : ?>
                    <pre>
                        <?php print_r($item);?>
                    </pre>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require app('path.views') . '/constructor/_buttons.php'; ?>