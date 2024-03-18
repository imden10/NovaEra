<div class="constr">
    <div class="container">
        <div class="constrlistwrap">
            <div class="headerwrap">
                <?php if (!empty($content['title'])) : ?>
                    <h2><?php echo $content['title']; ?></h2>
                <?php endif; ?>
            </div>

            <?php if (isset($content['list'])) : ?>
                <ul class="constlist">
                    <?php foreach ($content['list'] as $item) : ?>
                        <li class="<?php echo $content['type'] == 'numeric' ? 'constlinum' : 'constli'; ?>"><?php echo $item; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

<!--            <div class="constrlnkwrap">-->
<!--                <a href="#" class="constrlnk">Переход <img src="img/arrow_right.svg" alt=""></a>-->
<!--            </div>-->
        </div>
    </div>
</div>

<?php require app('path.views') . '/constructor/_buttons.php'; ?>