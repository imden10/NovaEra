<section class="simple-text">
    <div class="container">
        <div class="headerwrap">
            <div class="titlefigure"></div>
            <?php if (!empty($content['title'])) : ?>
                <h2><?php echo $content['title']; ?></h2>
            <?php endif; ?>
        </div>

        <div class="redactor">
            <?php echo $content['text']; ?>
        </div>
        <a href="#">test ссылка</a>

        <!--        <div class="constrlnkwrap">-->
        <!--            <a href="#" class="constrlnk">Переход <img src="img/arrow_right.svg" alt=""></a>-->
        <!--        </div>-->
    </div>
    <?php require app('path.views') . '/constructor/_buttons.php'; ?>
</section>

