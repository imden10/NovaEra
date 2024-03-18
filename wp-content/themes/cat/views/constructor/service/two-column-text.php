<div class="constr txt2col">
    <div class="container">
        <div class="headerwrap">
            <?php if (!empty($content['title'])) : ?>
                <h2><?php echo $content['title']; ?></h2>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <?php echo $content['text'][1]; ?>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
                <?php echo $content['text'][2]; ?>
            </div>
        </div>

<!--        <div class="constrlnkwrap">-->
<!--            <a href="#" class="constrlnk">Переход <img src="img/arrow_right.svg" alt=""></a>-->
<!--        </div>-->
    </div>
</div>

<?php require app('path.views') . '/constructor/_buttons.php'; ?>