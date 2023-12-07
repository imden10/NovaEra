<?php
    $data = array_diff_key($content,array_flip(['list','image']));
    $imageUrl = get_image_url_by_id($content['image']['id']);
?>

<div class="constr">
    <div class="container mobfluid">
        <pre>
            <?php
                print_r($data);
            ?>
        </pre>
        <img src="<?= $imageUrl ?>" alt="" style="width: 200px">
        <div class="constrlistwrap">
            <h4>Тези</h4>
            <div class="headerwrap">
                <?php if (!empty($content['title'])) : ?>
                    <h2><?php echo $content['title']; ?></h2>
                <?php endif; ?>
            </div>

            <?php if (isset($content['list'])) : ?>
                <ul class="constlist">
                    <?php foreach ($content['list'] as $item) : ?>
                        <li>
                            <h4><?= $item['thesis']; ?></h4>
                            <p><?= $item['icon']; ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require app('path.views') . '/constructor/_buttons.php'; ?>