<div class="form-field underline <?= $item['content']['rules']['required'] === '1' ? 'required' : '' ?>">
	<span class="field-title with-padding"><?= $item['content']['title'] ?></span>
	<?php if (isset($item['content']['options'])) : ?>
		<?php
		$options = explode("\n", $item['content']['options']);
		?>
		<!-- Добавляем скрытый input для отслеживания выбранного значения -->
		<input type="hidden" name="<?= htmlspecialchars($item['content']['name']) ?>" id="<?= htmlspecialchars($item['content']['name']) ?>_selected">
		<div class="select">
			<?php foreach ($options as $option) : ?>
				<?php list($value, $text) = explode(':', $option); ?>
				<div class="option" onclick="updateHiddenInput(this, '<?= htmlspecialchars($item['content']['name']) ?>', '<?= htmlspecialchars($value) ?>')" data-value="<?= htmlspecialchars($value) ?>"><?= htmlspecialchars($text) ?></div>

			<?php endforeach; ?>
		</div>
	<?php endif; ?>
	<span class="error"></span>
</div>

<script>
	function updateHiddenInput(target, name, value) {
		const parentEl = target.closest('.select')
		const allOptions = parentEl.querySelectorAll('.option')
		allOptions.forEach(e => {
			e.classList.remove('active')
		})
		target.classList.add('active')
		const hiddenInputId = name + "_selected";
		const hiddenInput = document.getElementById(hiddenInputId);
		hiddenInput.value = value;
	}
</script>