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
        <?php require app('path.views') . '/constructor/_buttons.php'; ?>
    </div>