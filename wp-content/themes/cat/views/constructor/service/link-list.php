<?php
$data = array_diff_key($content, array_flip(['list']));
?>

<div class="container">
    <?php if (!empty($content['title'])) : ?>
        <h2><?php echo $content['title']; ?></h2>
    <?php endif; ?>


    <?php if (isset($content['list'])) : ?>
        <ul class="links__list">
            <?php foreach ($content['list'] as $item) : ?>
                <li>
                    <a class="links__item" href="<?= $item['link']; ?>"><?= $item['name']; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <?php require app('path.views') . '/constructor/_buttons.php'; ?>
</div>