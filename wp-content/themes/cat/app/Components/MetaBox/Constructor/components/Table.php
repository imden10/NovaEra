<?php

namespace App\Components\MetaBox\Constructor\components;

class Table
{
    public $name = 'Таблиця';

    protected static $prefix = 'table-item';

    protected static $placeholder = '#tableElementId';

    public function html($key, $name, $value)
    {
        $tableWidthOptions = [];
        for ($i = 2; $i <= 6; $i++) {
            $tableWidthOptions[(string) $i] = (string) $i;
        }

        $tableWidth = [
            'name' => $name . '[' . $key . '][content][table_width]',
            'value' => isset($value['content']['table_width']) ? $value['content']['table_width'] : '2'
        ];

        $colsWidthOptions = [
            'auto' => 'auto',
            '5%'   => '5%',
            '10%'  => '10%',
            '16%'  => '16%',
            '20%'  => '20%',
            '25%'  => '25%',
            '33%'  => '33%',
            '50%'  => '50%',
            '60%'  => '60%',
            '75%'  => '75%',
            '80%'  => '80%',
            '90%'  => '90%',
        ];

        $styleTypeOptions = [
            'default' => '-',
            'numbers' => 'Нумерованый',
            'icons'   => 'З іконками',
        ];

        $styleType = [
            'name' => $name . '[' . $key . '][content][style_type]',
            'value' => isset($value['content']['style_type']) ? $value['content']['style_type'] : 'default'
        ];

        $list = [
            'name' => $name . '[' . $key . '][content][list]',
            'value' => (isset($value['content']['list']) && is_array($value['content']['list'])) ? $value['content']['list'] : []
        ];

        /************************************* MOBILE *********************************************************/
        $tableWidthOptionsMob = [];
        for ($i = 2; $i <= 6; $i++) {
            $tableWidthOptionsMob[(string) $i] = (string) $i;
        }

        $tableWidthMob = [
            'name' => $name . '[' . $key . '][content][table_width_mob]',
            'value' => isset($value['content']['table_width_mob']) ? $value['content']['table_width_mob'] : '2'
        ];

        $colsWidthOptionsMob = [
            'auto' => 'auto',
            '5%'   => '5%',
            '10%'  => '10%',
            '16%'  => '16%',
            '20%'  => '20%',
            '25%'  => '25%',
            '33%'  => '33%',
            '50%'  => '50%',
            '60%'  => '60%',
            '75%'  => '75%',
            '80%'  => '80%',
            '90%'  => '90%',
        ];

        $styleTypeOptionsMob = [
            'default' => '-',
            'numbers' => 'Нумерованый',
            'icons'   => 'З іконками',
        ];

        $styleTypeMob = [
            'name' => $name . '[' . $key . '][content][style_type_mob]',
            'value' => isset($value['content']['style_type_mob']) ? $value['content']['style_type_mob'] : 'default'
        ];

        $listMob = [
            'name' => $name . '[' . $key . '][content][list_mob]',
            'value' => (isset($value['content']['list_mob']) && is_array($value['content']['list_mob'])) ? $value['content']['list_mob'] : []
        ];
        ?>

        <div class="body-block">
            <div class="list-elements-body">
                <div class="mb-3">
                    <label for="table_width" class="form-label"><?php _e('Кількість колонок '); ?></label>
                    <select name="<?php echo $tableWidth['name']; ?>" class="form-control form-control-sm item-row-template-count" id="table_width">
                        <?php foreach ($tableWidthOptions as $key => $name) : ?>
                            <option value="<?php echo $key; ?>"<?php echo ($tableWidth['value'] == $key) ? ' selected' : ''; ?>><?php echo $name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="style_type" class="form-label"><?php _e('Тип відображення колонок '); ?></label>
                    <select name="<?php echo $styleType['name']; ?>" class="form-control form-control-sm row-style-type-component" id="style_type">
                        <?php foreach ($styleTypeOptions as $key => $name) : ?>
                            <option value="<?php echo $key; ?>"<?php echo ($styleType['value'] == $key) ? ' selected' : ''; ?>><?php echo $name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <template>
                    <?php foreach ($tableWidthOptions as $col_count => $width):?>
                        <li data-item-id="<?= self::$placeholder; ?><?= $col_count ?>" class="item-list-template<?= $col_count ?> item-group">
                            <div class="card border-success">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <div class="row-icon-select2-container">
                                            <?= do_shortcode('[icon_select name="' . esc_attr(base64_encode($list['name'] ."[".self::$placeholder.$col_count."][icon]" )) . '"]'); ?>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div>
                                            <div style="display: block; width: 100%">
                                                <?php for($i = 0; $i  < $col_count; $i++):?>
                                                    <div style="display: inline-block; vertical-align: top; width: calc(<?= 100 / $col_count ?>% - 5px)">
                                                        <div class="form-group mb-1">
                                                            <label>Ширина колонки</label>
                                                            <select
                                                                    class="form-control item-row-template-count"
                                                                    name="<?= $list['name']; ?>[<?= self::$placeholder; ?><?= $col_count ?>][<?=$i?>][column_width]">
                                                                <?php foreach ($colsWidthOptions as $w_value => $w_text):?>
                                                                    <option value="<?=$w_value?>"><?=$w_text?></option>
                                                                <?php endforeach;?>
                                                            </select>

                                                        </div>

                                                        <div class="form-group mb-1">
                                                            <label>Текст</label>
                                                            <textarea
                                                                    rows="10"
                                                                    class="form-control ck-editor"
                                                                    name="<?= $list['name']; ?>[<?= self::$placeholder; ?><?= $col_count ?>][<?=$i?>][column_text]"></textarea>
                                                        </div>
                                                    </div>
                                                <?php endfor;?>
                                            </div>
                                        </div>

                                        <div class="mt-1 text-center">
                                            <button type="button" class="btn btn-outline-danger btn-sm remove-row-item">Видалити</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php endforeach;?>
                </template>

                <ul class="list-elements-container">
                    <?php foreach ($list['value'] as $id => $value) : ?>
                        <?php if($value):?>
                            <li data-item-id="<?= $id ?>" class="item-list-template item-group">
                                <div class="card border-success">
                                    <div class="card-body">
                                        <?php if($styleType['value'] == 'icons'):?>
                                            <div class="mb-3">
                                                <div class="row-icon-select2-container">
                                                    <?= do_shortcode('[icon_select ready="true" icon="'.$value['icon'].'" name="' . esc_attr(base64_encode($list['name'] ."[".$id."][icon]" )) . '"]'); ?>
                                                </div>
                                            </div>
                                        <?php endif;?>
                                        <?php unset($value["icon"]);?>
                                        <div class="mb-3">
                                            <div>
                                                <div style="display: block; width: 100%">
                                                    <?php foreach((array) $value as $col => $text):?>
                                                        <div style="display: inline-block; vertical-align: top; width: calc(<?= 100 / count($value) ?>% - 5px)">
                                                            <div class="form-group mb-1">
                                                                <label>Ширина колонки</label>
                                                                <select
                                                                        class="form-control item-row-template-count"
                                                                        name="<?= $list['name']; ?>[<?= $id ?>][<?=$col?>][column_width]">
                                                                    <?php foreach ($colsWidthOptions as $w_value => $w_text):?>
                                                                        <option value="<?=$w_value?>"
                                                                            <?php if($text['column_width'] == $w_value):?> selected <?php endif?>
                                                                        ><?=$w_text?></option>
                                                                    <?php endforeach;?>
                                                                </select>

                                                            </div>

                                                            <div class="form-group mb-1">
                                                                <label>Текст</label>
                                                                <textarea
                                                                        rows="10"
                                                                        class="form-control ck-editor-table-ready"
                                                                        name="<?= $list['name']; ?>[<?= $id ?>][<?=$col?>][column_text]"><?= $text['column_text'] ?? '' ?></textarea>
                                                            </div>
                                                        </div>
                                                    <?php endforeach;?>
                                                </div>
                                            </div>

                                            <div class="mt-1 text-center">
                                                <button type="button" class="btn btn-outline-danger btn-sm remove-row-item">Видалити</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php endif;?>
                    <?php endforeach;?>
                </ul>

                <button type="button" class="btn btn-success btn-sm add-<?php echo self::$prefix; ?>"><?php _e('Додати ряд'); ?></button>
            </div>
        </div>

        <!----------------------------- MOB --------------------------------------->

        <h4 style="margin: 30px 0">Моб.</h4>
        <div class="body-block">
         <div class="list-elements-body">
             <div class="mb-3">
                 <label for="table_width_mob" class="form-label"><?php _e('Кількість колонок (Моб)'); ?></label>
                 <select name="<?php echo $tableWidthMob['name']; ?>" class="form-control form-control-sm item-row-template-count" id="table_width_mob">
                     <?php foreach ($tableWidthOptionsMob as $key => $name) : ?>
                         <option value="<?php echo $key; ?>"<?php echo ($tableWidthMob['value'] == $key) ? ' selected' : ''; ?>><?php echo $name; ?></option>
                     <?php endforeach; ?>
                 </select>
             </div>

             <div class="mb-3">
                 <label for="style_type_mob" class="form-label"><?php _e('Тип відображення колонок (Моб)'); ?></label>
                 <select name="<?php echo $styleTypeMob['name']; ?>" class="form-control form-control-sm row-style-type-component" id="style_type_mob">
                     <?php foreach ($styleTypeOptionsMob as $key => $name) : ?>
                         <option value="<?php echo $key; ?>"<?php echo ($styleTypeMob['value'] == $key) ? ' selected' : ''; ?>><?php echo $name; ?></option>
                     <?php endforeach; ?>
                 </select>
             </div>

             <template>
                 <?php foreach ($tableWidthOptionsMob as $col_count => $width):?>
                     <li data-item-id="<?= self::$placeholder; ?><?= $col_count ?>" class="item-list-template<?= $col_count ?> item-group">
                         <div class="card border-success">
                             <div class="card-body">
                                 <div class="mb-3">
                                     <div class="row-icon-select2-container">
                                         <?= do_shortcode('[icon_select name="' . esc_attr(base64_encode($listMob['name'] ."[".self::$placeholder.$col_count."][icon]" )) . '"]'); ?>
                                     </div>
                                 </div>
                                 <div class="mb-3">
                                     <div>
                                         <div style="display: block; width: 100%">
                                             <?php for($i = 0; $i  < $col_count; $i++):?>
                                                 <div style="display: inline-block; vertical-align: top; width: calc(<?= 100 / $col_count ?>% - 5px)">
                                                     <div class="form-group mb-1">
                                                         <label>Ширина колонки</label>
                                                         <select
                                                                 class="form-control item-row-template-count"
                                                                 name="<?= $listMob['name']; ?>[<?= self::$placeholder; ?><?= $col_count ?>][<?=$i?>][column_width]">
                                                             <?php foreach ($colsWidthOptionsMob as $w_value => $w_text):?>
                                                                 <option value="<?=$w_value?>"><?=$w_text?></option>
                                                             <?php endforeach;?>
                                                         </select>

                                                     </div>

                                                     <div class="form-group mb-1">
                                                         <label>Текст</label>
                                                         <textarea
                                                                 rows="10"
                                                                 class="form-control ck-editor"
                                                                 name="<?= $listMob['name']; ?>[<?= self::$placeholder; ?><?= $col_count ?>][<?=$i?>][column_text]"></textarea>
                                                     </div>
                                                 </div>
                                             <?php endfor;?>
                                         </div>
                                     </div>

                                     <div class="mt-1 text-center">
                                         <button type="button" class="btn btn-outline-danger btn-sm remove-row-item-mob">Видалити</button>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </li>
                 <?php endforeach;?>
             </template>

             <ul class="list-elements-container">
                 <?php foreach ($listMob['value'] as $id => $value) : ?>
                     <?php if($value):?>
                         <li data-item-id="<?= $id ?>" class="item-list-template item-group">
                             <div class="card border-success">
                                 <div class="card-body">
                                     <?php if($styleTypeMob['value'] == 'icons'):?>
                                         <div class="mb-3">
                                             <div class="row-icon-select2-container">
                                                 <?= do_shortcode('[icon_select ready="true" icon="'.$value['icon'].'" name="' . esc_attr(base64_encode($listMon['name'] ."[".$id."][icon]" )) . '"]'); ?>
                                             </div>
                                         </div>
                                     <?php endif;?>
                                     <?php unset($value["icon"]);?>
                                     <div class="mb-3">
                                         <div>
                                             <div style="display: block; width: 100%">
                                                 <?php foreach((array) $value as $col => $text):?>
                                                     <div style="display: inline-block; vertical-align: top; width: calc(<?= 100 / count($value) ?>% - 5px)">
                                                         <div class="form-group mb-1">
                                                             <label>Ширина колонки</label>
                                                             <select
                                                                     class="form-control item-row-template-count"
                                                                     name="<?= $listMob['name']; ?>[<?= $id ?>][<?=$col?>][column_width]">
                                                                 <?php foreach ($colsWidthOptionsMob as $w_value => $w_text):?>
                                                                     <option value="<?=$w_value?>"
                                                                         <?php if($text['column_width'] == $w_value):?> selected <?php endif?>
                                                                     ><?=$w_text?></option>
                                                                 <?php endforeach;?>
                                                             </select>

                                                         </div>

                                                         <div class="form-group mb-1">
                                                             <label>Текст</label>
                                                             <textarea
                                                                     rows="10"
                                                                     class="form-control ck-editor-table-ready"
                                                                     name="<?= $listMob['name']; ?>[<?= $id ?>][<?=$col?>][column_text]"><?= $text['column_text'] ?? '' ?></textarea>
                                                         </div>
                                                     </div>
                                                 <?php endforeach;?>
                                             </div>
                                         </div>

                                         <div class="mt-1 text-center">
                                             <button type="button" class="btn btn-outline-danger btn-sm remove-row-item-mob">Видалити</button>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </li>
                     <?php endif;?>
                 <?php endforeach;?>
             </ul>

             <button type="button" class="btn btn-success btn-sm add-<?php echo self::$prefix; ?>-mob"><?php _e('Додати ряд (Моб)'); ?></button>
         </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {

            });
        </script>

        <?php
    }

    public function handlerStyle()
    {
        add_action('admin_footer', function () { ?>
        <?php });
    }

    public function handlerScript()
    {
        add_action('admin_footer', function () { ?>

            <script type="text/javascript">
                const cb = function (callback) {
                    $('#exampleModalBtn').modal('show');
                    $(".cb-btn-submit").on("click",function () {
                        let data = {
                            text:$(".cb-input-text").val(),
                            type_link:$(".cb-input-type_link").val(),
                            link:$(".cb-input-link").val(),
                            form:$(".cb-input-form").val(),
                            type_button:$(".cb-input-type_button").val(),
                            icon:$(".cb-input-icon-wrapper").find("select").val(),
                        };

                        let a = document.createElement('a');
                        a.className = "cb-component " + data.type_button;

                        if(data.icon){
                            a.className += " icon-" + data.icon;
                        }

                        a.innerText = data.text;

                        if(data.type_link == "link"){
                            a.setAttribute('href',data.link);
                        } else {
                            a.setAttribute('href',"javascript:void(0)");
                            a.className += " render-form-btn";
                            a.setAttribute('data-form_id',data.form);
                        }

                        callback(a);
                        $(".cb-input-link").val('');
                        $(".cb-input-text").val('');
                        $('#exampleModalBtn').modal('hide');
                        $(".cb-btn-submit").off('click');
                    })
                };

                const CustomButton = function (context) {
                    const ui = $.summernote.ui;
                    const button = ui.button({
                        contents: '<i class="fa fa-leaf"></i> Кнопка',
                        tooltip: 'Вставити кнопку',
                        click: function () {
                            $(".cb-btn-submit").off('click');
                            cb(function (btn) {
                                let rng = context.$note.summernote('getLastRange');
                                let node = rng.insertNode(btn);
                                let code = context.$note.summernote('code');

                                context.$note.summernote('code','');
                                context.invoke('pasteHTML', code);
                            });
                        }
                    });

                    return button.render();
                };

                const summernote_options = {
                    lang: 'uk-UA',
                    height: 250,
                    minHeight: null,
                    maxHeight: null,
                    toolbar: [
                        ['undoredo', ['undo', 'redo']],
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear',
                            'tags_replace', 'tags_replace_all'
                        ]],
                        ['fontname', ['fontname']],
                        ['fontsize', ['fontsize']],
                        ['height', ['height']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table', 'specialchars']],
                        ['insert', ['link', 'hr']],
                        ['view', ['fullscreen', 'codeview']],
                        ['typography', ['typography']],
                        ['popovers', ['cb']]
                    ],
                    buttons: {
                        cb: CustomButton
                    },
                };

                jQuery(document).ready(function($) {

                    const prefix = '<?php echo self::$prefix; ?>';

                    $(document).on('click', '.add-' + prefix, function () {
                        let $styleTypeComponent = $(this).closest(".list-elements-body").find(".row-style-type-component");
                        let styleTypeVal = $styleTypeComponent.val();
                        const container = $(this).parents('.list-elements-body');
                        const template = container.find('template')[0];

                        let $styleTypeContainer =$(template.content).find(".row-icon-select2-container");

                        if (styleTypeVal == "icons") {
                            $styleTypeContainer.css("display", "flex");
                        } else {
                            $styleTypeContainer.css("display", "none");
                        }

                        const count = $(this).parent('.list-elements-body').find('.item-row-template-count>option:selected').val();

                        const itemTemplate = $(template.content).find(".item-list-template"+count);
                        const itemsContainer = container.find('.list-elements-container');
                        const placeholder = '<?php echo self::$placeholder; ?>'+count;

                        createItemFromTemplate(container, itemTemplate, itemsContainer, placeholder);

                        itemsContainer.find('textarea.ck-editor').each(function () {
                            $(this).summernote(summernote_options);
                        });

                        if (styleTypeVal == "icons") {
                            container.find('.icon-select-component').each(function() {
                                $(this).select2({
                                    minimumResultsForSearch: -1,
                                    templateResult: formatStateIcon,
                                    templateSelection: formatStateIcon,
                                });
                            });
                        }
                    });

                    $(document).on('click', '.add-' + prefix + '-mob', function () {
                        let $styleTypeComponent = $(this).closest(".list-elements-body").find(".row-style-type-component");
                        let styleTypeVal = $styleTypeComponent.val();
                        const container = $(this).parents('.list-elements-body');
                        const template = container.find('template')[0];

                        let $styleTypeContainer =$(template.content).find(".row-icon-select2-container");

                        if (styleTypeVal == "icons") {
                            $styleTypeContainer.css("display", "flex");
                        } else {
                            $styleTypeContainer.css("display", "none");
                        }

                        const count = $(this).parent('.list-elements-body').find('.item-row-template-count>option:selected').val();

                        const itemTemplate = $(template.content).find(".item-list-template"+count);
                        const itemsContainer = container.find('.list-elements-container');
                        const placeholder = '<?php echo self::$placeholder; ?>'+count;

                        createItemFromTemplate(container, itemTemplate, itemsContainer, placeholder);

                        itemsContainer.find('textarea.ck-editor').each(function () {
                            $(this).summernote(summernote_options);
                        });

                        if (styleTypeVal == "icons") {
                            container.find('.icon-select-component').each(function() {
                                $(this).select2({
                                    minimumResultsForSearch: -1,
                                    templateResult: formatStateIcon,
                                    templateSelection: formatStateIcon,
                                });
                            });
                        }
                    });

                    $(document).on('click', '.remove-row-item', function() {
                        $(this).parents('.item-group').remove();
                    });

                    $(document).on('click', '.remove-row-item-mob', function() {
                        $(this).parents('.item-group').remove();
                    });

                    $(".icon-select-component-ready").each(function () {
                        $(this).select2({
                            templateResult: formatStateIcon,
                            templateSelection: formatStateIcon,
                        });
                    });

                    $('.ck-editor-table-ready').summernote(summernote_options);
                });
            </script>

        <?php });
    }
}
