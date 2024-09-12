<?php
    $data = array_diff_key($content,array_flip(['file']));
    $fileUrl = get_image_url_by_id($content['file']['id']);
?>

<div class="video-blog">
    <div class="container">
        <?php if($data['type'] == 'link'):?>
            <p><?=$data['link']?></p>
        <?php else:?>
            <p><?=$fileUrl?></p>
        <?php endif;?>
    </div>
</div>

<?php require app('path.views') . '/constructor/_buttons.php'; ?>