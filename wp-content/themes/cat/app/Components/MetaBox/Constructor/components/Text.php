<?php

namespace App\Components\MetaBox\Constructor\components;

class Text
{
    public $name = 'Текст';

    public function html($key, $name, $value)
    {
        $text = [
            'name' => $name . '[' . $key . '][content][text]',
            'value' => isset($value['content']['text']) ? $value['content']['text'] : ''
        ];

        $miniText = [
            'name' => $name . '[' . $key . '][content][mini_text]',
            'value' => isset($value['content']['mini_text']) ? $value['content']['mini_text'] : ''
        ];

        $miniTextShow = [
            'name' => $name . '[' . $key . '][content][mini_text_show]',
            'value' => isset($value['content']['mini_text_show']) ? $value['content']['mini_text_show'] : 0
        ];
        ?>

        <div class="body-block">
            <div class="textarea-part">
                <label>Текст</label>
                <textarea id="componentText<?php echo $key; ?>" class="ck-editor" name="<?php echo $text['name']; ?>"><?php echo $text['value']; ?></textarea>

                <br>

                <label>Міні текст</label>

                <label>
                    <input type="hidden" value="0" name="<?php echo $miniTextShow['name']; ?>">
                    <input type="checkbox" class="mini-text-show-checkbox" style="width: 15px; margin: 10px 0;" value="1" name="<?php echo $miniTextShow['name']; ?>" <?php if($miniTextShow['value'] == 1):?> checked <?php endif;?> >
                    <span>Показувати</span>
                </label>

                <div <?php if(!$miniTextShow['value']):?> style="display: none" <?php endif;?> class="mini-text-show-container">
                    <textarea id="componentMiniText<?php echo $key; ?>" class="ck-editor" name="<?php echo $miniText['name']; ?>"><?php echo $miniText['value']; ?></textarea>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#componentText<?php echo $key; ?>').summernote(summernote_options);
                $('#componentMiniText<?php echo $key; ?>').summernote(summernote_options);
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

        add_action('admin_footer', function () { ?>

            <script type="text/javascript">
                $(document).ready(function(){
                    $(document).on("change",".mini-text-show-checkbox", function (){
                        let val = $(this).prop('checked');
                        if(val){
                            $(this).closest('.textarea-part').find('.mini-text-show-container').show();
                        } else {
                            $(this).closest('.textarea-part').find('.mini-text-show-container').hide();
                        }
                    })
                });
            </script>

        <?php });

    }
}