<div class="form-component">
    <?php echo $content['title']; ?>

    <pre>
    <?php
    $formData = \App\Models\Form::getData($content['form_id']);

    print_r($formData);
    ?>
    </pre>
</div>

<?php require app('path.views') . '/constructor/_buttons.php'; ?>