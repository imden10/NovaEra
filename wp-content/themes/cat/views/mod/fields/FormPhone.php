<div class="form-field outlined <?= $item['content']['rules']['required'] === '1' ? 'required' : '' ?>">
	<span class="field-title"><?= $item['content']['title'] ?></span>
	<input class="phone" type="text" placeholder="<?= $item['content']['placeholder'] ?>" name="<?= $item['content']['name'] ?>">
	<span class="error"></span>
</div>