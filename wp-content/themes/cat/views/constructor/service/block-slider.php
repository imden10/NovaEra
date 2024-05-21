<?php
$data = array_diff_key($content, array_flip(['list']));
?>


<div class="container">
    <!-- <pre>
            <?php
            print_r($data);
            ?>
        </pre> -->
    <div class="constrlistwrap">
        <div class="headerwrap">
            <?php if (!empty($content['title'])) : ?>
                <h2><?php echo $content['title']; ?></h2>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="swiper1">

    <?php if (isset($content['list'])) : ?>
        <!-- <ul class="constlist"> -->
        <?php foreach ($content['list'] as $item) : ?>
            <div>
                <h4><?= $item['link']; ?></h4>
                <p><?= $item['text']; ?></p>
                <!-- <img src="https://nova-era.sisidev.com.ua/wp-content/uploads/2024/05/img-golovna-test.png" alt=""> -->
                <img src="<?= get_image_url_by_id($item['image']); ?>" alt="" style="max-width: 300px">
            </div>
        <?php endforeach; ?>
        <!-- </ul> -->
    <?php endif; ?>
</div>

<div class="container right">
    <?php require app('path.views') . '/constructor/_buttons.php'; ?>
</div>