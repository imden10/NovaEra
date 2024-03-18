<?php
    $data = array_diff_key($content,array_flip(['list','image']));
    $list = isset($content['list']) ? array_values($content['list']) : [];
?>

<div class="constr">
    <div class="container">
        <h3>3 картинки в рядок</h3>
        <pre>
            <?php
                print_r($data);
            ?>
        </pre>
        <?php if(count($list)):?>
        <div style="display: flex;gap: 15px">
            <?foreach ($list as $item):?>
                <img src="<?= get_image_url_by_id($item['image']); ?>" alt="" style="max-width: 300px">
            <?php endforeach;?>
        </div>
        <?php endif;?>
    </div>
</div>

<?php require app('path.views') . '/constructor/_buttons.php'; ?>