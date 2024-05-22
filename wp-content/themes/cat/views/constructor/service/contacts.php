<div class="contacts">
    <div class="container">
        <?php if (!empty($content['title'])) : ?>
            <h2><?php echo $content['title']; ?></h2>
        <?php endif; ?>

        <div style="display: flex; gap: 30px; align-items: start">
            <div style="width: 50%">
                <?= $content['text']; ?>
            </div>
            <div style="width: 50%">
                <h3><?= $content['form_title']; ?></h3>
                <span><?= $content['form_subtitle']; ?></span>
                <div>
                    <?php $id = $content['form_id']; require app('path.views') . '/mod/_form.php'; ?>
                </div>
            </div>
        </div>
        <?php require app('path.views') . '/constructor/_buttons.php'; ?>
    </div>
</div>