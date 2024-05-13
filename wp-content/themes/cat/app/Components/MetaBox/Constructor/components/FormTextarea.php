<?php

namespace App\Components\MetaBox\Constructor\components;

class FormTextarea
{
    public $name = 'Textarea';

    public function html($key, $name, $value)
    {
        $nameField = [
            'title'    => 'Назва',
            'subtitle' => 'тільки латинські літери',
            'name'     => $name . '[' . $key . '][content][name]',
            'value'    => isset($value['content']['name']) ? $value['content']['name'] : ''
        ];

        $titleField = [
            'title'    => 'Заголовок',
            'subtitle' => 'текст перед полем',
            'name'     => $name . '[' . $key . '][content][title]',
            'value'    => isset($value['content']['title']) ? $value['content']['title'] : ''
        ];

        $placeholderField = [
            'title'    => 'Підказка у полі',
            'name'     => $name . '[' . $key . '][content][placeholder]',
            'value'    => isset($value['content']['placeholder']) ? $value['content']['placeholder'] : ''
        ];

        $showInMessageField = [
            'title'    => 'Відображати у повідомленні',
            'name'     => $name . '[' . $key . '][content][show_in_message]',
            'value'    => isset($value['content']['show_in_message']) ? $value['content']['show_in_message'] : 1
        ];

        $shownNameField = [
            'title'    => 'Заголовок для повідомлення',
            'name'     => $name . '[' . $key . '][content][shown_name]',
            'value'    => isset($value['content']['shown_name']) ? $value['content']['shown_name'] : ''
        ];

        $rulesRequiredField = [
            'title'    => "Обов'язкове поле",
            'name'     => $name . '[' . $key . '][content][rules][required]',
            'value'    => isset($value['content']['rules']['required']) ? $value['content']['rules']['required'] : 0
        ];

        $messagesRequiredField = [
            'title'    => "Обов'язкове поле",
            'name'     => $name . '[' . $key . '][content][messages][required]',
            'value'    => isset($value['content']['messages']['required']) ? $value['content']['messages']['required'] : ''
        ];

        ?>

        <div class="body-block">
            <div style="width: 100%">
                <div style="display: flex;gap:15px;width: 100%;margin-bottom: 15px">
                    <div style="width: 30%;text-align: right">
                        <label><?= $nameField['title'] ?></label>
                        <div style="color: #676565;font-size: 11px;">
                            <span><?= $nameField['subtitle'] ?></span>
                        </div>
                    </div>
                    <div style="width: 70%">
                        <input type="text" name="<?= $nameField['name'] ?>" value="<?= $nameField['value']; ?>" class="form-control">
                    </div>
                </div>

                <div style="display: flex;gap:15px;width: 100%;margin-bottom: 15px">
                    <div style="width: 30%;text-align: right">
                        <label><?= $titleField['title'] ?></label>
                        <div style="color: #676565;font-size: 11px;">
                            <span><?= $titleField['subtitle'] ?></span>
                        </div>
                    </div>
                    <div style="width: 70%">
                        <input type="text" name="<?= $titleField['name'] ?>" value="<?= $titleField['value']; ?>" class="form-control">
                    </div>
                </div>

                <div style="display: flex;gap:15px;width: 100%;margin-bottom: 15px">
                    <div style="width: 30%;text-align: right">
                        <label><?= $placeholderField['title'] ?></label>
                    </div>
                    <div style="width: 70%">
                        <input type="text" name="<?= $placeholderField['name'] ?>" value="<?= $placeholderField['value']; ?>" class="form-control">
                    </div>
                </div>

                <div style="display: flex;gap:15px;width: 100%;margin-bottom: 15px">
                    <div style="width: 30%;text-align: right">
                        <label><?= $showInMessageField['title'] ?></label>
                    </div>
                    <div style="width: 70%">
                        <input type="hidden" name="<?= $showInMessageField['name'] ?>" value="0">
                        <input type="checkbox" style="width: 18px" name="<?= $showInMessageField['name'] ?>" <?php if($showInMessageField['value']) echo "checked";?> value="1" class="form-control">
                    </div>
                </div>

                <div style="display: flex;gap:15px;width: 100%;margin-bottom: 15px">
                    <div style="width: 30%;text-align: right">
                        <label><?= $shownNameField['title'] ?></label>
                    </div>
                    <div style="width: 70%">
                        <input type="text" name="<?= $shownNameField['name'] ?>" value="<?= $shownNameField['value']; ?>" class="form-control">
                    </div>
                </div>

                <div style="display: flex;gap:15px;width: 100%;margin-bottom: 15px">
                    <div style="width: 30%;text-align: right">
                        <label>Правила</label>
                    </div>
                    <div style="width: 70%">
                        <details>
                            <summary>Показати</summary>
                            <br>
                            <h5>Правила</h5>
                            <br>

                            <div style="display: flex;gap:15px;width: 100%;margin-bottom: 15px">
                                <div style="width: 30%;text-align: right">
                                    <label><?= $rulesRequiredField['title'] ?></label>
                                </div>
                                <div style="width: 70%">
                                    <input type="hidden" name="<?= $rulesRequiredField['name'] ?>" value="0">
                                    <input type="checkbox" style="width: 18px" name="<?= $rulesRequiredField['name'] ?>" <?php if($rulesRequiredField['value']) echo "checked";?> value="1" class="form-control">
                                </div>
                            </div>

                            <br>
                            <h5>Повідомлення</h5>
                            <br>

                            <div style="display: flex;gap:15px;width: 100%;margin-bottom: 15px">
                                <div style="width: 30%;text-align: right">
                                    <label><?= $messagesRequiredField['title'] ?></label>
                                </div>
                                <div style="width: 70%">
                                    <input type="text" name="<?= $messagesRequiredField['name'] ?>" value="<?= $messagesRequiredField['value']; ?>" class="form-control">
                                </div>
                            </div>
                        </details>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#componentText<?php echo $key; ?>').summernote(summernote_options);
            });
        </script>
        <?php
    }

    public function handlerStyle()
    {
        add_action('admin_footer', function () { ?>

            <style type="text/css">
                .textarea-part,
                .textarea-part textarea {
                    width: 100%;
                }

                .type-checkbox {
                    margin-bottom: 15px;
                }
            </style>

        <?php });
    }

    public function handlerScript()
    {
        /*
        add_action('admin_footer', function () { ?>

            <script type="text/javascript">
            </script>

        <?php });
        */
    }
}