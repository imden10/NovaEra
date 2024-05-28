<div class="form-field underline <?= $item['content']['rules']['required'] === '1' ? 'required' : '' ?>">
	<span class="field-title"><?= $item['content']['title'] ?></span>
	<textarea maxlength="1000" type="text" placeholder="<?= $item['content']['placeholder'] ?>" name="<?= $item['content']['name'] ?>"></textarea>
	<span class="error"></span>
</div>