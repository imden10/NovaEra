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
        update_option('theme_settings__color', sanitize_text_field($_POST['theme_settings__color']));
        update_option('theme_settings__gradient_color_1', sanitize_text_field($_POST['theme_settings__gradient_color_1']));
        update_option('theme_settings__gradient_color_2', sanitize_text_field($_POST['theme_settings__gradient_color_2']));
        update_option('theme_settings__gradient_type', sanitize_text_field($_POST['theme_settings__gradient_type']));
        update_option('theme_settings__gradient_deg', sanitize_text_field($_POST['theme_settings__gradient_deg']));
        update_option('theme_settings__noise', sanitize_text_field($_POST['theme_settings__noise']));
        update_option('theme_settings__font_style', sanitize_text_field($_POST['theme_settings__font_style']));
    }

    // Отримання значення збереженого налаштування
    $bg_type = get_option('theme_settings__bg_type', 'color');
    $color = get_option('theme_settings__color', '#ffffff');
    $gradient_color_1 = get_option('theme_settings__gradient_color_1', '#ffffff');
    $gradient_color_2 = get_option('theme_settings__gradient_color_2', '#ffffff');
    $gradient_type = get_option('theme_settings__gradient_type', 'linear');
    $gradient_deg = get_option('theme_settings__gradient_deg', '0');
    $noise = get_option('theme_settings__noise', '0');
    $font_style = get_option('theme_settings__font_style');
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
                            </select>
                        </td>
                    </tr>
                    <tr class="theme_color_block" <?php if($bg_type == "gradient"):?> style="display: none" <?php endif;?> >
                        <th scope="row" style="text-align: right">
                            <label>Колір теми</label>
                        </th>
                        <td>
                            <input type="color" name="theme_settings__color" value="<?= esc_attr($color); ?>">
                        </td>
                    </tr>
                    <tr class="theme_gradient_block" <?php if($bg_type == "color"):?> style="display: none" <?php endif;?>>
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
                    <tr class="theme_gradient_block" <?php if($bg_type == "color"):?> style="display: none" <?php endif;?>>
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
                    <tr class="theme_gradient_block" <?php if($bg_type == "color"):?> style="display: none" <?php endif;?>>
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
                    <tr>
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
    </style>

    <script>
        $(document).ready(function () {
            $(".select-color-type").on('change', function(){
                let type = $(this).val();

                if(type == "color"){
                    $(".theme_color_block").show();
                    $(".theme_gradient_block").hide();
                } else {
                    $(".theme_color_block").hide();
                    $(".theme_gradient_block").show();
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
        });
    </script>
    <?php
}