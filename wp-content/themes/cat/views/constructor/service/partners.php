<?php
$data = array_diff_key($content, array_flip(['list']));
?>

<div class="container">
    <div class="constrlistwrap">
        <div class="headerwrap">
            <?php if (!empty($content['title'])) : ?>
                <h2><?php echo $content['title']; ?></h2>
            <?php endif; ?>
        </div>

        <?php if (isset($content['list'])) : ?>
            <ul class="partner-list">
                <?php foreach ($content['list'] as $item) : ?>
                    <li class="partner">
                        <a href="<?= $item['link'] ?>">
                            <img src="<?= get_image_url_by_id($item['image']); ?>" alt="" style="max-width: 300px">
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <?php require app('path.views') . '/constructor/_buttons.php'; ?>
</div>
