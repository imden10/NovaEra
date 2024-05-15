<!-- style="background: no-repeat center/cover url(<?php echo appConfig('theme_url'); ?>/img/кабинет4.jpg)" -->

<div class="container">
    <div class="content">
        <?php if (!empty($content['title'])) : ?>
            <h2><?php echo $content['title']; ?></h2>
        <?php endif; ?>
        <?php echo $content['text']; ?>
        <?php require app('path.views') . '/constructor/_buttons.php'; ?>
    </div>


    <!--        <div class="constrlnkwrap">-->
    <!--            <a href="#" class="constrlnk">Переход <img src="img/arrow_right.svg" alt=""></a>-->
    <!--        </div>-->
</div>