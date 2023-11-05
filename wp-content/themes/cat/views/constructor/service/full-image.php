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
    </div>
</div>
