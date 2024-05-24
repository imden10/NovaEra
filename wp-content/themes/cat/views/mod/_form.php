<?php
$formData = \App\Models\Form::getData($id);
$formConstructor = $formData['fields'];
$success = [
    'title' => $formData['success_text'],
]
?>


<!-- This is form <?= $id ?> -->
<!-- <pre>
<?php print_r($item) ?>
</pre> -->
<form class="form">
    <?php if (isset($formConstructor)) : ?>
        <?php foreach ($formConstructor as $item) : ?>
            <?php require app('path.views') . '/mod/fields/' . $item['component'] . '.php'; ?>
        <?php endforeach; ?>
    <?php endif; ?>
    <div class="btns-container">
        <button type="submit" class="btn secondary fill lg">Задати питання</button>
    </div>
</form>
