<?php

namespace App\Components\MetaBox\Constructor\components;

use App\Models\Form;

class Contacts
{
    public $name = 'Контакти';

    public function html($key, $name, $value)
    {
        $text = [
            'name' => $name . '[' . $key . '][content][text]',
            'value' => isset($value['content']['text']) ? $value['content']['text'] : ''
        ];

        $formTitle = [
            'title' => 'Заголовок',
            'name' => $name . '[' . $key . '][content][form_title]',
            'value' => isset($value['content']['form_title']) ? $value['content']['form_title'] : ''
        ];

        $formSubtitle = [
            'title' => 'Підзаголовок',
            'name' => $name . '[' . $key . '][content][form_subtitle]',
            'value' => isset($value['content']['form_subtitle']) ? $value['content']['form_subtitle'] : ''
        ];

        $form = [
            'title' => 'Форма',
            'name' => $name . '[' . $key . '][content][form_id]',
            'value' => isset($value['content']['form_id']) ? $value['content']['form_id'] : ''
        ];

        $formsList = Form::getList();
        ?>

        <div class="body-block">
            <div class="list-elements-body">
                <div class="row">
                    <div class="col-6">
                        <h4>Контакти</h4>
                        <div class="mb-3">
                            <textarea id="componentContacts<?php echo $key; ?>" class="ck-editor" name="<?php echo $text['name']; ?>"><?php echo $text['value']; ?></textarea>
                        </div>
                    </div>
                    <div class="col-6">
                        <h4>Форма</h4>
                        <div class="mb-3">
                            <input type="text" placeholder="<?= $formTitle['title'] ?>" name="<?php echo $formTitle['name']; ?>" value="<?php echo $formTitle['value']; ?>">
                        </div>
                        <div class="mb-3">
                            <input type="text" placeholder="<?= $formSubtitle['title'] ?>"  name="<?php echo $formSubtitle['name']; ?>" value="<?php echo $formSubtitle['value']; ?>">
                        </div>
                        <div class="mb-3">
                            <select name="<?php echo $form['name']; ?>" class="form-control form-control-sm">
                                <?php if(count($formsList)):?>
                                    <?php foreach ($formsList as $formKey => $formItem):?>
                                        <option value="<?= $formKey ?>" <?php if($form['value'] == $formKey):?> selected <?php endif;?> ><?= $formItem ?></option>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#componentContacts<?php echo $key; ?>').summernote(summernote_options);
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