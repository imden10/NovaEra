<?php
    $data = array_diff_key($content,array_flip(['list','image']));
    $imageUrl = get_image_url_by_id($content['image']['id']);
?>

<div class="full-image">
    <div class="container">
        <pre>
            <?php
                print_r($data);
            ?>
        </pre>
        <img src="<?= $imageUrl ?>" alt="" style="width: 200px">
    </div>
</div>

<?php require app('path.views') . '/constructor/_buttons.php'; ?>