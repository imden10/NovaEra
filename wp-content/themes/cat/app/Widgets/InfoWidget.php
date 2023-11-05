<?php

class InfoWidget extends \WP_Widget
{
    function __construct()
    {
        parent::__construct('info-widget', __('Загальна інформація'), ['description' => 'Віджет з інформацією']);
    }

    function widget($args, $instance)
    {
        echo $args['before_widget']; ?>

        <div class="col-md-12">
            <a href="<?php echo $instance['url']; ?>" class="service-lnk">
                <div class="firstscreen__bnrwarp__servitem">
                    <div class="firstscreen__bnrwarp__servitem__img" style="background: no-repeat center/cover url('<?php echo !empty($instance['image_id']) ? wp_get_attachment_image_url($instance['image_id'], 'full') : ''; ?>');">
                        <div class="firstscreen__bnrwarp__servitem__img__pat"></div>
                    </div>

                    <div class="firstscreen__bnrwarp__servitem__textwrap">
                        <div class="cont">
                            <span class="firstscreen__bnrwarp__servitem__textwrap__title"><?php echo $instance['title']; ?></span>
                            <span class="firstscreen__bnrwarp__servitem__textwrap__subtitle"><?php echo $instance['subtitle']; ?></span>
                        </div>

                        <span class="firstscreen__bnrwarp__servitem__textwrap__godetails"><?php echo trans('Подробнее &#62'); ?></span>
                    </div>

                    <div class="linklines"></div>
                </div>
            </a>
        </div>

        <?php echo $args['after_widget'];
    }

    function update($new_instance, $old_instance)
    {
        $instance = [];
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['subtitle'] = (!empty($new_instance['subtitle'])) ? strip_tags($new_instance['subtitle']) : '';
        $instance['image_id'] = (!empty($new_instance['image_id'])) ? strip_tags($new_instance['image_id']) : '';
        $instance['url'] = (!empty($new_instance['url'])) ? $new_instance['url'] : '';

        return $instance;
    }

    function form($instance)
    {
        $title = isset($instance['title']) ? $instance['title'] : __('Заголовок: ');
        $subtitle = isset($instance['subtitle']) ? $instance['subtitle'] : '';
        $image_id = !empty($instance['image_id']) ? $instance['image_id'] : '';
        $url = isset($instance['url']) ? $instance['url'] : '';
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Заголовок: '); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'subtitle'); ?>"><?php _e('Підзаголовок: '); ?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id('subtitle'); ?>" name="<?php echo $this->get_field_name('subtitle'); ?>"><?php echo esc_attr($subtitle); ?></textarea>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('Посилання: '); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" type="url" value="<?php echo esc_attr($url); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('image_id'); ?>"><?php _e('Зображення: '); ?></label>
            <div class="image-wrapper" style="width: 200px; margin-top: 15px;">
                <a class="attach-image" href="#"><img src="<?php echo !empty($image_id) ? wp_get_attachment_image_url($image_id, 'thumbnail') : 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkAQMAAABKLAcXAAAABlBMVEUAAAC7u7s37rVJAAAAAXRSTlMAQObYZgAAACJJREFUOMtjGAV0BvL/G0YMr/4/CDwY0rzBFJ704o0CWgMAvyaRh+c6m54AAAAASUVORK5CYII='; ?>" alt="" style="width: 100%; height: auto"></a>

                <button type="button" class="button button-secondary remove-image"><?php _e('Remove'); ?></button>

                <input type="hidden" name="<?php echo $this->get_field_name('image_id'); ?>" value="<?php echo $image_id; ?>" class="image-id">
            </div>
        </p>
        <?php

        add_action('admin_print_footer_scripts', function () { ?>

            <script type="text/javascript">
                jQuery(document).ready(function($) {

                    $(document).off().on('click', '.attach-image', function (e) {
                        choiceImage(e, $(this));

                        $(this)
                            .parent()
                            .find('.image-id')
                            .trigger('change');
                    });

                    $(document).on('click', '.remove-image', function () {
                        removeImage($(this));

                        $(this)
                            .parent()
                            .find('.image-id')
                            .trigger('change');
                    });

                });
            </script>

        <?php }, 999);
    }
}
