<?php
    $data = array_diff_key($content,array_flip(['list']));
?>

<div class="constr">
    <div class="container">
        <h3>Цифри</h3>
        <pre>
            <?php
                print_r($data);
            ?>
        </pre>
        <div class="constrlistwrap">
            <div class="headerwrap">
                <?php if (!empty($content['title'])) : ?>
                    <h2><?php echo $content['title']; ?></h2>
                <?php endif; ?>
            </div>

            <?php if (isset($content['list'])) : ?>
                <ul class="constlist">
                    <?php foreach ($content['list'] as $item) : ?>
                        <li>
                            <h4><?= $item['number']; ?></h4>
                            <h4><?= $item['title']; ?></h4>
                            <h4>font: <?= $item['title_font_size']; ?></h4>
                            <p><?= $item['text']; ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require app('path.views') . '/constructor/_buttons.php'; ?>