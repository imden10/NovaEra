<?php
$formData = \App\Models\Form::getData($id);
$formConstructor = $formData['fields'];
$formFields = [];
$formTextInfo = [];

if (isset($formConstructor)) {
	foreach ($formConstructor as $item) {
		if (isset($item['component']) && ($item['component'] === 'FormTitle' || $item['component'] === 'FormText')) {
			$formTextInfo[] = $item;
		} else {
			$formFields[] = $item;
		}
	}
}
?>

<form class="form" id="tg-form-<?php echo uniqid(); ?>" data-form="<?= $id ?>">
	<?php if (isset($formTextInfo)) : ?>
		<div class="text-wrapper">

			<?php foreach ($formTextInfo as $item) : ?>
				<?php require app('path.views') . '/mod/fields/' . $item['component'] . '.php'; ?>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
	<?php if (isset($formFields)) : ?>
		<?php foreach ($formFields as $item) : ?>
			<?php require app('path.views') . '/mod/fields/' . $item['component'] . '.php'; ?>
		<?php endforeach; ?>
	<?php endif; ?>
	<div class="btns-container">
		<button type="submit" class="btn secondary fill lg"><?= $formData['btn_name'] ?></button>
	</div>
</form>