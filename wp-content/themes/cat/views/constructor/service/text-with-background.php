<div class="constr txtonbg" style="background: no-repeat center/cover url(<?php echo appConfig('theme_url'); ?>/img/кабинет4.jpg)">
    <div class="bgpattern"></div>
    <div class="container">
        <div class="headerwrap">
            <div class="titlefigure"></div>
            <?php if (!empty($content['title'])) : ?>
                <h2><?php echo $content['title']; ?></h2>
            <?php endif; ?>
        </div>

        <?php echo $content['text']; ?>

<!--        <div class="constrlnkwrap">-->
<!--            <a href="#" class="constrlnk">Переход <img src="img/arrow_right.svg" alt=""></a>-->
<!--        </div>-->
    </div>
</div>

<?php require app('path.views') . '/constructor/_buttons.php'; ?>