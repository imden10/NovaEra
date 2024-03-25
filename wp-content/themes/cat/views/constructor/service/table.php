<?php
    $data = array_diff_key($content,array_flip(['list','list_mob']));
?>

<div class="table">
    <div class="container">
        <pre>
            <?php
                print_r($data);
            ?>
        </pre>
        <div class="constrlistwrap">
            <h4>Таблиця</h4>
            <div class="headerwrap">
                <?php if (!empty($content['title'])) : ?>
                    <h2><?php echo $content['title']; ?></h2>
                <?php endif; ?>
            </div>

            <?php if (isset($content['list'])) : ?>
                <?php foreach ($content['list'] as $item) : ?>
                <pre><?php print_r($item) ?></pre>

                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require app('path.views') . '/constructor/_buttons.php'; ?>