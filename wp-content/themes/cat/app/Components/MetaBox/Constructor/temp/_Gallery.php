<?php

namespace App\Components\MetaBox\Constructor\Components;

class Gallery
{
    public $name = 'Галерея';

    protected static $prefix = 'gallery-item';

    protected static $placeholder = '#imageElementId';


    public function html($key, $name, $value)
    {
        $image_id = [
            'name' => $name . '[' . $key . '][content][images]',
            'value' => isset($value['content']['images']) ? $value['content']['images'] : [],
        ];
        ?>

        <div class="body-block">
            <div class="list-elements-body">
                <div style="display: none">
                    <li data-item-id="<?php echo self::$placeholder; ?>" class="item-list-template gallery-items">
                        <div class="image-wrapper">
                            <a class="attach-image" href="#">
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkAQMAAABKLAcXAAAABlBMVEUAAAC7u7s37rVJAAAAAXRSTlMAQObYZgAAACJJREFUOMtjGAV0BvL/G0YMr/4/CDwY0rzBFJ704o0CWgMAvyaRh+c6m54AAAAASUVORK5CYII=" alt="">
                            </a>

                            <textarea name="<?php echo $image_id['name']; ?>[<?php echo self::$placeholder; ?>][title]" disabled></textarea>

                            <button type="button" class="button button-secondary remove-image"><?php _e('Remove'); ?></button>

                            <input type="hidden" name="<?php echo $image_id['name']; ?>[<?php echo self::$placeholder; ?>][id]" class="image-id" disabled>
                        </div>
                    </li>
                </div>

                <ul class="list-elements-container gallery-container">
                    <?php foreach ((array) $image_id['value'] as $id => $value) : ?>
                        <li data-item-id="<?php echo $id; ?>" class="gallery-items">
                            <div class="image-wrapper">
                                <a class="attach-image" href="#">
                                    <img src="<?php echo $value['id'] != 0 ? wp_get_attachment_image_url($value['id'], 'thumbnail') : 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkAQMAAABKLAcXAAAABlBMVEUAAAC7u7s37rVJAAAAAXRSTlMAQObYZgAAACJJREFUOMtjGAV0BvL/G0YMr/4/CDwY0rzBFJ704o0CWgMAvyaRh+c6m54AAAAASUVORK5CYII='; ?>" alt="">
                                </a>

                                <textarea name="<?php echo $image_id['name']; ?>[<?php echo $id; ?>][title]"><?php echo $value['title']; ?></textarea>

                                <button type="button" class="button button-secondary remove-image"><?php _e('Remove'); ?></button>

                                <input type="hidden" name="<?php echo $image_id['name']; ?>[<?php echo $id; ?>][id]" value="<?php echo $value['id']; ?>" class="image-id">
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <button type="button" class="button button-secondary add-<?php echo self::$prefix; ?>"><?php _e('Add'); ?></button>
            </div>
        </div>

        <?php
    }

    public function handlerStyle()
    {
        add_action('admin_footer', function () { ?>

            <style type="text/css">

                .list-elements-body {
                    width: 100%;
                    margin: 0 auto;
                }

                .list-elements-body input {
                    width: calc(100% - 100px);
                }

                .gallery-container li .remove-image {
                    width: 100%;
                }

                .gallery-container li {
                    width: 150px;
                    margin: 5px 5px 15px 5px;
                }

                .gallery-container {
                    display: -moz-flex;
                    display: -o-flex;
                    display: -webkit-flex;
                    display: flex;
                    -webkit-flex-wrap: wrap;
                    flex-wrap: wrap;
                }

                .image-wrapper img {
                    width: 100%;
                }

                .image-wrapper textarea {
                    height: 50px;
                }

            </style>

        <?php });
    }

    public function handlerScript()
    {
        add_action('admin_footer', function () { ?>

            <script type="text/javascript">
                jQuery(document).ready(function($) {

                    const prefix = '<?php echo self::$prefix; ?>';
                    const placeholder = '<?php echo self::$placeholder; ?>';

                    $(document).on('click', '.add-' + prefix, function () {
                        const container = $(this).parents('.list-elements-body');
                        const itemTemplate = container.find('.item-list-template');
                        const itemsContainer = container.find('.list-elements-container');

                        createItem(container, itemTemplate, itemsContainer, placeholder);

                        itemsContainer.find('input, textarea').each(function () {
                            $(this).prop('disabled', false);
                        });
                    });

                    $(document).on('click', '.remove-image', function () {
                        $(this).parents('.gallery-items').remove();
                    });

                });
            </script>

        <?php });
    }
}