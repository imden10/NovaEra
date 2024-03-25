<div class="form-component">
    <div class="container">
        <?php echo $content['title']; ?>

        <pre>
<?php
$formData = \App\Models\Form::getData($content['form_id']);

// print_r($formData);
?>
</pre>
        <form>
            <div class="form-field">
                <span>Label</span>
                <input type="text" placeholder="default">
                <span class="error">default</span>
            </div>
            <div class="form-field error">
                <span>Label</span>
                <input type="text" placeholder="error">
                <span class="error">error</span>
            </div>
            <div class="form-field disabled">
                <span>Label</span>
                <input type="text" placeholder="disabled">
                <span class="error">disabled</span>
            </div>
            <div class="form-field underline">
                <span>Label</span>
                <input type="text" placeholder="default">
                <span class="error">default</span>
            </div>
            <div class="form-field underline error">
                <span>Label</span>
                <input type="text" placeholder="error">
                <span class="error">error</span>
            </div>
            <div class="form-field underline disabled">
                <span>Label</span>
                <input type="text" placeholder="disabled">
                <span class="error">disabled</span>
            </div>
        </form>
    </div>
</div>

<?php require app('path.views') . '/constructor/_buttons.php'; ?>