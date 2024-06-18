<div class="simple-text">
    <div class="container">
        <?php if ($content['mini_text_show'] === '1') : ?>
            <div class="text-wrapper">
                <div class="mini-text">
                    <?php if (!empty($content['title'])) : ?>
                        <h2><?= $content['title']; ?></h2>
                    <?php endif; ?>
                    <?php if ($content['mini_text']) : ?>
                        <div class="redactor">
                            <?= $content['mini_text']  ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="redactor">
                    <?php echo $content['text']; ?>
                </div>
            </div>
        <?php else : ?>
            <?php if (!empty($content['title'])) : ?>
                <h2><?php echo $content['title']; ?></h2>
            <?php endif; ?>
            <div class="redactor">
                <?php echo $content['text']; ?>
            </div>
        <?php endif ?>

        <?php require app('path.views') . '/constructor/_buttons.php'; ?>
    </div>
</div>