<div class="constr txt1col">
    <div class="container mobfluid">
        <div class="headerwrap">
            <div class="titlefigure"></div>
            <h4>Роздільник тексту</h4>
            <?php if (!empty($content['title'])) : ?>
                <h2><?php echo $content['title']; ?></h2>
            <?php endif; ?>
        </div>

        <?= $content['text']; ?>
        <?= $content['font_size']; ?>

<!--        <div class="constrlnkwrap">-->
<!--            <a href="#" class="constrlnk">Переход <img src="img/arrow_right.svg" alt=""></a>-->
<!--        </div>-->
    </div>
</div>

<?php require app('path.views') . '/constructor/_buttons.php'; ?>