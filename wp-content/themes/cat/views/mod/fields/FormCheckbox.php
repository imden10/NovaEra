<div class="form-field underline <?= $item['content']['rules']['required'] === '1' ? 'required' : '' ?>">
	<label class="checkbox">
		<input type="checkbox" name="<?= $item['content']['name'] ?>">
		<p><?= $item['content']['title'] ?></p>
	</label>
	<span class="error"></span>
</div>