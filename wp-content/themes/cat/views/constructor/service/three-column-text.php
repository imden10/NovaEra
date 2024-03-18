<div class="constr txt3col">
    <div class="container">
        <div class="headerwrap">
            <?php if (!empty($content['title'])) : ?>
                <h2><?php echo $content['title']; ?></h2>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <?php echo $content['text'][1]; ?>
            </div>

            <div class="col-lg-4 col-md-6">
                <?php echo $content['text'][2]; ?>
            </div>

            <div class="col-lg-4 col-md-12">
                <?php echo $content['text'][3]; ?>
            </div>
        </div>

<!--        <div class="constrlnkwrap">-->
<!--            <a href="#" class="constrlnk">Переход <img src="img/arrow_right.svg" alt=""></a>-->
<!--        </div>-->
    </div>
</div>

<?php require app('path.views') . '/constructor/_buttons.php'; ?>