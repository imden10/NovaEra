<?php

use App\Models\Form;

$formsList = Form::getList();
?>

<div class="modal fade" id="exampleModalBtn" tabindex="-1" role="dialog" aria-labelledby="exampleModalBtnLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalBtnLabel">Вставити кнопку</h5>
                <button type="button" class="close cb-btn-close" data-dismiss="modal" aria-label="Close" onclick="$('#exampleModalBtn').modal('hide');">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group note-form-group">
                    <label class="note-form-label">Текст на кнопці</label>
                    <input class="form-control form-control-sm cb-input-text" type="text">
                </div>

                <div class="form-group note-form-group">
                    <label class="note-form-label">Тип дії</label>
                    <select class="form-control form-control-sm type_link_select cb-input-type_link">
                        <option value="link">Довільне посилання</option>
                        <option value="form">Форма</option>
                    </select>
                </div>

                <div class="form-group note-form-group type_link_link">
                    <div style="display: flex; gap: 10px;align-items: flex-end;">
                        <div>
                            <label class="note-form-label">Посилання</label>
                            <input class="form-control form-control-sm cb-input-link" type="text">
                        </div>
                        <div>
                            <label>
                                <input class="cb-input-link_target" type="checkbox">
                                <span>В новому вікні</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group note-form-group type_link_form" style="display: none">
                    <label class="note-form-label">Форма</label>
                    <select class="form-control form-control-sm cb-input-form">
                        <?php foreach ($formsList as $formListKey => $formList) : ?>
                            <option value="<?= $formListKey ?>"><?= $formList ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group note-form-group">
                    <label class="note-form-label">Колір</label>
                    <select class="form-control form-control-sm cb-input-color_button">
                        <?php foreach (config('buttons')['color'] as $listKey => $listItem) : ?>
                            <option value="<?= $listKey ?>"><?= $listItem ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group note-form-group">
                    <label class="note-form-label">Розмір</label>
                    <select class="form-control form-control-sm cb-input-size_button">
                        <?php foreach (config('buttons')['size'] as $listKey => $listItem) : ?>
                            <option value="<?= $listKey ?>"><?= $listItem ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group note-form-group">
                    <label class="note-form-label">Тип кнопки</label>
                    <select class="form-control form-control-sm cb-input-type_button">
                        <?php foreach (config('buttons')['type'] as $listKey => $listItem) : ?>
                            <option value="<?= $listKey ?>"><?= $listItem ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group note-form-group cb-input-icon-wrapper">
                    <label class="note-form-label">Іконка</label>
                    <?= do_shortcode('[icon_select title="false"]'); ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary cb-btn-submit">Вставити</button>
            </div>
        </div>
    </div>
</div>

<style>
    .select2-container.select2-container--default.select2-container--open {
        z-index: 9999;
    }
</style>

<script>
    $(document).ready(function() {
        $("#exampleModalBtn .icon-select-component").select2({
            width:"200px",
            templateResult: formatStateIcon,
            templateSelection: formatStateIcon,
        });

        $(document).on("change", ".type_link_select", function () {
            let type = $(this).val();

            if (type == 'form') {
                $(this).closest('.modal-body').find('.type_link_link').hide();
                $(this).closest('.modal-body').find('.type_link_form').show();
            } else {
                $(this).closest('.modal-body').find('.type_link_link').show();
                $(this).closest('.modal-body').find('.type_link_form').hide();
            }
        });
    });
</script>