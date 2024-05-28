<div class="form-field underline <?= $item['content']['rules']['required'] === '1' ? 'required' : '' ?>">
	<span class="field-title"><?= $item['content']['title'] ?></span>
	<input class="phone" type="text" placeholder="<?= $item['content']['placeholder'] ?>" name="<?= $item['content']['name'] ?>">
	<span class="error"></span>
</div>
<script>
	const element = document.querySelectorAll('.phone');
	const maskOptions = {
		mask: '+{38}0-0000-00-000'
	};
	console.log(IMask);
	element.forEach(el => {
		IMask(el, maskOptions);
	})

</script>