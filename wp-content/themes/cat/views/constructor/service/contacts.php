<div class="container">
    <?php if (!empty($content['title'])) : ?>
        <h2><?php echo $content['title']; ?></h2>
    <?php endif; ?>
<pre> <?php print_r($formData['fields']) ?></pre>
    <div class="contacts-wrapper">
        <div class="redactor">
            <?= $content['text']; ?>
        </div>
        <div class="form-wrapper">
            <div class="form-wrapper-head">
                <h2><?= $content['form_title']; ?></h2>
                <p class="text"><?= $content['form_subtitle']; ?></p>
            </div>
            <div>
                <?php $id = $content['form_id'];
                require app('path.views') . '/mod/_form.php'; ?>
            </div>
        </div>
    </div>
    <?php require app('path.views') . '/constructor/_buttons.php'; ?>
</div>
