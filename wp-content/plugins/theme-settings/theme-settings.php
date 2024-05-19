<?php
/*
Plugin Name: Theme Settings
Description: Налаштування теми
*/

// Додаємо пункт меню
function theme_settings_menu() {
    add_options_page(
        'Налаштування теми',    // Назва сторінки
        'Налаштування теми',    // Назва пункту меню
        'manage_options',     // Рівень доступу користувача
        'theme-settings',    // Ідентифікатор сторінки
        'theme_settings_page' // Функція, що відображає сторінку
    );
}
add_action('admin_menu', 'theme_settings_menu');

// Відображаємо сторінку налаштувань
function theme_settings_page() {
    // Збереження налаштувань при натисканні кнопки "Зберегти"
    if (isset($_POST['custom_settings_submit'])) {
        update_option('theme_settings__bg_type', sanitize_text_field($_POST['theme_settings__bg_type']));
        update_option('theme_settings__preset', sanitize_text_field($_POST['theme_settings__preset']));
        update_option('theme_settings__mode', sanitize_text_field($_POST['theme_settings__mode']));
        update_option('theme_settings__color', sanitize_text_field($_POST['theme_settings__color']));
        update_option('theme_settings__gradient_color_1', sanitize_text_field($_POST['theme_settings__gradient_color_1']));
        update_option('theme_settings__gradient_color_2', sanitize_text_field($_POST['theme_settings__gradient_color_2']));
        update_option('theme_settings__gradient_type', sanitize_text_field($_POST['theme_settings__gradient_type']));
        update_option('theme_settings__gradient_deg', sanitize_text_field($_POST['theme_settings__gradient_deg']));
        update_option('theme_settings__noise', sanitize_text_field($_POST['theme_settings__noise']));
        update_option('theme_settings__font_style', sanitize_text_field($_POST['theme_settings__font_style']));
        update_option('theme_settings__favicon', sanitize_text_field($_POST['theme_settings__favicon']));
        update_option('theme_settings__logotype', sanitize_text_field($_POST['theme_settings__logotype']));
    }

    // Отримання значення збереженого налаштування
    $bg_type = get_option('theme_settings__bg_type', 'color');
    $preset = get_option('theme_settings__preset', '');
    $mode = get_option('theme_settings__mode', 'light');
    $color = get_option('theme_settings__color', '#ffffff');
    $gradient_color_1 = get_option('theme_settings__gradient_color_1', '#ffffff');
    $gradient_color_2 = get_option('theme_settings__gradient_color_2', '#ffffff');
    $gradient_type = get_option('theme_settings__gradient_type', 'linear');
    $gradient_deg = get_option('theme_settings__gradient_deg', '0');
    $noise = get_option('theme_settings__noise', '0');
    $font_style = get_option('theme_settings__font_style');
    $favicon = get_option('theme_settings__favicon');
    $logotype = get_option('theme_settings__logotype');
    ?>
    <div class="custom-options-container">
        <form method="post" action="" class="custom-options-form">
            <h2>Налаштування теми</h2>

            <span id="options_section_contacts_data" class="option-section-description"></span>

            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row" style="text-align: right">
                            <label for="theme_settings__bg_type">Кольорова схема</label>
                        </th>
                        <td>
                            <select name="theme_settings__bg_type" class="select-color-type" id="theme_settings__bg_type">
                                <option value="color" <?php if($bg_type == 'color'):?> selected <?php endif;?> >Колір</option>
                                <option value="gradient" <?php if($bg_type == 'gradient'):?> selected <?php endif;?> >Градієнт</option>
                                <option value="presets" <?php if($bg_type == 'presets'):?> selected <?php endif;?> >Пресети</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="theme_color_block" <?php if($bg_type == "color"):?> <?php else: ?> style="display: none" <?php endif;?> >
                        <th scope="row" style="text-align: right">
                            <label>Колір теми</label>
                        </th>
                        <td>
                            <input type="color" name="theme_settings__color" value="<?= esc_attr($color); ?>">
                        </td>
                    </tr>
                    <tr class="theme_gradient_block" <?php if($bg_type == "gradient"):?> <?php else: ?> style="display: none" <?php endif;?> >
                        <th scope="row" style="text-align: right">
                            <label>Кольори градієнту</label>
                        </th>
                        <td>
                            <div style="display: flex; gap: 15px">
                                <input type="color" class="form-control" name="theme_settings__gradient_color_1" value="<?= esc_attr($gradient_color_1); ?>">
                                <input type="color" class="form-control" name="theme_settings__gradient_color_2" value="<?= esc_attr($gradient_color_2); ?>">
                            </div>
                        </td>
                    </tr>
                    <tr class="theme_gradient_block" <?php if($bg_type == "gradient"):?> <?php else: ?> style="display: none" <?php endif;?> >
                        <th scope="row" style="text-align: right">
                            <label for="theme_settings__gradient_type">Тип градієнту</label>
                        </th>
                        <td>
                            <select name="theme_settings__gradient_type" id="theme_settings__gradient_type">
                                <option value="linear" <?php if($gradient_type == 'linear'):?> selected <?php endif;?> >Linear</option>
                                <option value="radial" <?php if($gradient_type == 'radial'):?> selected <?php endif;?> >Radial</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="theme_gradient_block" <?php if($bg_type == "gradient"):?> <?php else: ?> style="display: none" <?php endif;?> >
                        <th scope="row" style="text-align: right">
                            <label for="theme_settings__gradient_deg">Градус градієнту</label>
                        </th>
                        <td>
                            <div style="display: flex;gap: 15px">
                                <input type="range"
                                       min="0"
                                       max="360"
                                       name="theme_settings__gradient_deg"
                                       value="<?= esc_attr($gradient_deg); ?>"
                                       id="theme_settings__gradient_deg"
                                       class="range-input"
                                       style="width: 200px"
                                >
                                <span id="range_value"><?= esc_attr($gradient_deg); ?></span>
                            </div>
                        </td>
                    </tr>
                    <tr class="theme_presets_block" <?php if($bg_type == "presets"):?> <?php else: ?> style="display: none" <?php endif;?> >
                        <th scope="row" style="text-align: right">
                            <label for="theme_settings__preset">Пресети</label>
                        </th>
                        <td>
                            <select name="theme_settings__preset"  id="theme_settings__preset" style="width: 250px">
                                <option value="on-light bg-lighter" data-color="#ffffff" <?php if($preset == 'on-light-lighter'):?> selected <?php endif;?> >on-light bg-lighter</option>
                                <option value="on-light bg-darker" data-color="#D9DAD3" <?php if($preset == 'on-light-darker'):?> selected <?php endif;?> >on-light bg-darker</option>
                                <option value="on-dark bg-lighter" data-color="#9C9F8B" <?php if($preset == 'on-dark-lighter'):?> selected <?php endif;?> >on-dark bg-lighter</option>
                                <option value="on-dark bg-darker" data-color="#635E78" <?php if($preset == 'on-dark-darker'):?> selected <?php endif;?> >on-dark bg-darker</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="theme_presets_block" <?php if($bg_type == "presets"):?> <?php else: ?> style="display: none" <?php endif;?> >
                        <th scope="row" style="text-align: right">
                            <label for="theme_settings__mode">Режим теми</label>
                        </th>
                        <td>
                            <select name="theme_settings__mode"  id="theme_settings__mode">
                                <option value="light" <?php if($mode == 'light'):?> selected <?php endif;?> >Світла</option>
                                <option value="dark" <?php if($mode == 'dark'):?> selected <?php endif;?> >Темна</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="theme-settings-noise" <?php if($bg_type == "presets"):?> style="display: none" <?php endif;?> >
                        <th scope="row" style="text-align: right">
                            <label for="theme_settings__noise">Шум</label>
                        </th>
                        <td>
                            <select name="theme_settings__noise" id="theme_settings__noise">
                                <option value="0" <?php if($noise == '0'):?> selected <?php endif;?> >Ні</option>
                                <option value="1" <?php if($noise == '1'):?> selected <?php endif;?> >Так</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" style="text-align: right">
                            <label for="theme_settings__noise">Шрифт</label>
                        </th>
                        <td>
                            <div style="display: flex;gap: 15px">
                                <div>
                                    <select name="theme_settings__font_style" class="select-font-component" id="theme_settings__font_style">
                                        <option value="">---</option>
                                        <?php foreach (config('theme')['fonts'] as $key => $font):?>
                                            <option value="<?= $key ?>" <?php if($font_style == $key):?> selected <?php endif;?> ><?= $font['name'] ?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div>
                                    <?php foreach (config('theme')['fonts'] as $key => $font):?>
                                        <span class="template-font-style" data-font_key="<?= $key ?>"
                                              style="font-family: <?= $font['name'] ?>; font-size: 18px; <?php if($font_style != $key):?> display: none; <?php else:?> display: block; <?php endif;?>"
                                        >Приклад, як буде виглядати шрифт</span>
                                    <?php endforeach;?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" style="text-align: right">
                            <label for="theme_settings__favicon">Favicon</label>
                        </th>
                        <td>
                            <?= media_preview_box('theme_settings__favicon',$favicon, ""); ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" style="text-align: right">
                            <label for="theme_settings__logotype">Логотип</label>
                        </th>
                        <td>
                            <?= media_preview_box('theme_settings__logotype',$logotype, ""); ?>
                        </td>
                    </tr>
                </tbody>
            </table>

            <p class="submit">
                <input type="submit" name="custom_settings_submit" class="button button-primary" value="Зберегти">
            </p>
        </form>
    </div>

    <?php foreach (config('theme')['fonts'] as $font):?>
        <?= $font['link'] ?>
    <?php endforeach;?>

    <style>
        @font-face {
            font-family: "e-Ukraine";
            src: url("/wp-content/themes/dental/fonts/e-Ukraine/e-Ukraine.otf");
        }
        /* Стилі для кольорів */
        .color-option {
            display: inline-block;
            width: 20px;
            height: 20px;
            margin-right: 10px;
            margin-top: 2px;
            border: 1px #bfb0b0 solid;
        }
    </style>

    <script>
        $(document).ready(function () {
            $(".select-color-type").on('change', function(){
                let type = $(this).val();

                if(type == "color"){
                    $(".theme_color_block").show();
                    $(".theme-settings-noise").show();
                    $(".theme_gradient_block").hide();
                    $(".theme_presets_block").hide();
                } else if(type == "gradient") {
                    $(".theme_gradient_block").show();
                    $(".theme-settings-noise").show();
                    $(".theme_color_block").hide();
                    $(".theme_presets_block").hide();
                } else {
                    $(".theme_presets_block").show();
                    $(".theme_color_block").hide();
                    $(".theme_gradient_block").hide();
                    $(".theme-settings-noise").hide();
                }
            });

            $(".range-input").on("change, input", function(){
                $("#range_value").text($(this).val());
            });

            $(".select-font-component").on('change', function (){
                let font = $(this).val();
                $(".template-font-style").hide();
                $(".template-font-style[data-font_key='"+font+"']").show();
            });
            $("#theme_settings__preset").select2({
                minimumResultsForSearch: Infinity,
                templateResult: function(data) {
                    // Перевірка, чи має елемент атрибут 'data-color'
                    if (!data.element) {
                        return data.text;
                    }

                    // Створення HTML-коду для відображення кольору перед назвою
                    var $color = $('<span class="color-option" style="background-color:' + $(data.element).data('color') + '"></span>');
                    var $text = $('<span style="vertical-align: top;">' + data.text + '</span>');

                    return $color.add($text);
                },
                templateSelection: function(data) {
                    // Відображення обраного елементу з кольором
                    if (!data.element) {
                        return data.text;
                    }

                    var $color = $('<span class="color-option" style="background-color:' + $(data.element).data('color') + '"></span>');
                    var $text = $('<span style="vertical-align: top;">' + data.text + '</span>');

                    return $color.add($text);
                }
            });

        });
    </script>
    <?php
}