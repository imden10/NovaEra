<div class="constr txt1col">
    <div class="container mobfluid">
        <div class="headerwrap">
            <div class="titlefigure"></div>
            <?php if (!empty($content['title'])) : ?>
                <h2><?php echo $content['title']; ?></h2>
            <?php endif; ?>
        </div>

        <div class="redactor">
            <?php echo $content['text']; ?>
        </div>

        <!--        <div class="constrlnkwrap">-->
        <!--            <a href="#" class="constrlnk">Переход <img src="img/arrow_right.svg" alt=""></a>-->
        <!--        </div>-->
    </div>
    <div class="btn">test</div>
</div>

<?php require app('path.views') . '/constructor/_buttons.php'; ?>
