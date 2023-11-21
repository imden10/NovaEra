<?php

namespace App\Components\MetaBox\Constructor\components;

class Form
{
    public $name = 'Форма';

    public function html($key, $name, $value)
    {
        $args = array(
            'post_type' => 'forms', // Тип постів "forms"
            'posts_per_page' => -1,  // Всі форми (змініть на потрібну кількість, якщо вам потрібно обмежити)
        );

        // Отримуємо пости
        $forms = get_posts($args);

        // Ініціалізуємо масив для зберігання ID та заголовків
        $forms_array = ['---'];

        // Перевіряємо, чи є пости
        if ($forms) {
            // Цикл виведення форм
            foreach ($forms as $form) {
                $forms_array[$form->ID] = $form->post_title;
            }
        } else {
            // Якщо форми не знайдено
            echo 'Форми не знайдено.';
        }

        $formOptions = $forms_array;

        $form = [
            'name' => $name . '[' . $key . '][content][form_id]',
            'value' => isset($value['content']['form_id']) ? $value['content']['form_id'] : ''
        ];

        ?>

        <div class="body-block">
            <div class="list-elements-body">
                <div class="mb-3">
                    <label for="form_id" class="form-label"><?php _e('Форма '); ?></label>
                    <select name="<?php echo $form['name']; ?>" class="form-control select2-form form-control-sm" id="form_id">
                        <?php foreach ($formOptions as $key => $name) : ?>
                            <option value="<?php echo $key; ?>"<?php echo ($form['value'] == $key) ? ' selected' : ''; ?>><?php echo $name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
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
                jQuery(document).ready(function($) {

                });
            </script>

        <?php });
    }
}
