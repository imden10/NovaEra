<div class="constr txt1col">
    <div class="container mobfluid">
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
