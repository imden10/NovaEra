<?php

namespace App\Components\MetaBox\Constructor\components;

class VideoBlog
{
    public $name = 'Відео';


    public function html($key, $name, $value)
    {
        $type_options = [
            'link' => __('Посилання'),
            'file' => __('Файл'),
        ];

        $type = [
            'name' => $name . '[' . $key . '][content][type]',
            'value' => isset($value['content']['type']) ? $value['content']['type'] : 'link'
        ];

        $link = [
            'name' => $name . '[' . $key . '][content][link]',
            'value' => isset($value['content']['link']) ? $value['content']['link'] : ''
        ];

        $file_id = [
            'name' => $name . '[' . $key . '][content][file][id]',
            'value' => isset($value['content']['file']['id']) ? $value['content']['file']['id'] : '0'
        ];
        ?>

        <div class="body-block">
            <div class="list-elements-body">
                <div class="mb-3">
                    <label><?php _e('Тип '); ?></label>
                    <select name="<?php echo $type['name']; ?>" class=" form-control form-control-sm select-video-type">
                        <?php foreach ($type_options as $k => $name) : ?>
                            <option value="<?php echo $k; ?>"<?php echo ($type['value'] == $k) ? ' selected' : ''; ?>><?php echo $name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3 video-type-link" <?php if($type['value'] != 'link'):?> style="display: none" <?php endif;?> >
                    <label><?php _e('Посилання '); ?></label>
                    <input type="text" class="form-control form-control-sm" name="<?php echo $link['name']; ?>" value="<?php echo $link['value'] ?? '' ?>">
                </div>

                <div class="mb-3 video-type-file" <?php if($type['value'] != 'file'):?> style="display: none" <?php endif;?> >
                    <?= media_preview_box($file_id['name'],$file_id['value'], "Файл"); ?>
                </div>
            </div>
        </div>

        <?php
    }

    public function handlerStyle()
    {
        add_action('admin_footer', function () { ?>

            <style type="text/css">
                .text-block {
                    -webkit-align-self: stretch;
                    align-self: stretch;
                    width: 100%;
                }

                .text-block textarea {
                    width: 100%;
                    height: calc(100% - 30px)!important;
                }

                .text-block input {
                    margin-top: 0;
                }

                .delete-image {
                    width: 200px;
                    margin: 0 auto;
                }

                .position-image-select {
                    width: 100%;
                }

            </style>

        <?php });
    }

    public function handlerScript()
    {
        add_action('admin_footer', function () { ?>

            <script type="text/javascript">

                $(function () {
                    $(document).on("change",".select-video-type",function(){
                        let type = $(this).val();
                        let $box = $(this).closest('.list-elements-body');

                        if(type == 'link'){
                            $box.find('.video-type-link').show();
                            $box.find('.video-type-file').hide();
                        } else {
                            $box.find('.video-type-link').hide();
                            $box.find('.video-type-file').show();
                        }
                    })
                });

            </script>

        <?php }, 99);
    }
}