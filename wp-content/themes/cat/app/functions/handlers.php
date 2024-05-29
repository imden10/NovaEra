<?php

//<form action="<php echo appConfig('post_handler', '/'); >">
//    <?php wp_nonce_field('callback_action'); >
//    <input type="hidden" name="action" value="callback_form">
//
/*    <input type="text" placeholder="<php echo trans('Ваше имя'); ?>" name="name" class="inpt name">*/
/*    <input type="text" placeholder="<php echo trans('Ваш телефон'); ?>" name="phone" class="inpt phone">*/
//    <button type="submit" class="inpt sub fill-right"><php echo trans('Отправить заявку'); ></button>
//</form>

function clearPostData(array $data) {
    return array_map(function($item) {
        return strip_tags($item);
    }, $data);
}

/* Form Handlers */
//
add_action('admin_post_nopriv_callback_form', 'callbackHandler');
add_action('admin_post_callback_form', 'callbackHandler');

function callbackHandler() {
    $http_refer = isset($_POST['_wp_http_referer']) ? $_POST['_wp_http_referer'] : site_url();

    try {
        if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'callback_action')) {
            throw new \Exception('Field nonce invalid');
        }

        require_once get_template_directory() . '/vendor/autoload.php';

        $recaptcha = new \ReCaptcha\ReCaptcha(RE_CAPTCHA_SECRET_KEY);

        $resp = $recaptcha->setExpectedHostname($_SERVER['SERVER_NAME'])
            ->setExpectedAction('callback')
            ->setScoreThreshold(0.5)
            ->verify($_POST['g-recaptcha-response-callback-form'], $_SERVER['REMOTE_ADDR']);

        if (!$resp->isSuccess()) {
            wp_safe_redirect(esc_url(add_query_arg(['status' => 'error'], $http_refer)));
            exit;
        }

        $data = clearPostData($_POST);

        $validator = new Valitron\Validator($data);

        $validator->rules([
            'required' => [
                ['name'],
                ['phone'],
            ],
            'lengthMin' => [
                ['name', 2],
                ['phone', 2],
            ],
            'lengthMax' => [
                ['name', 64],
                ['phone', 32],
            ],
        ]);

        if (!$validator->validate())
            throw new \Exception(wp_json_encode($validator->errors()));

        /* Mail send to administrator email */
        $to = get_bloginfo('admin_email');
        $subject = 'Форма зворотнього дзвінка з сайту ' . get_bloginfo('name');
        $headers = [
            'content-type: text/html',
        ];

        ob_start();
        require_once app('path.views') . '/emails/callback-form.php';
        $message = ob_get_contents();
        ob_end_clean();

        if (!wp_mail($to, $subject, $message, $headers))
            throw new \Exception('Error mail send');
        /* End Mail send to administrator email */

        wp_safe_redirect(add_query_arg(['status' => 'success', 'action' => 'callback'], $http_refer));
    } catch (\Exception $e) {
        wp_safe_redirect(add_query_arg(['status' => 'error', 'response' => base64_encode($e->getMessage())], $http_refer));
    }
}

//
add_action('admin_post_nopriv_make_appointment_form', 'makeAppointmentHandler');
add_action('admin_post_make_appointment_form', 'makeAppointmentHandler');

function makeAppointmentHandler() {
    $http_refer = isset($_POST['_wp_http_referer']) ? $_POST['_wp_http_referer'] : site_url();

    try {
        if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'callback_action')) {
            throw new \Exception('Field nonce invalid');
        }

        $data = clearPostData($_POST);

        $recaptcha = new \ReCaptcha\ReCaptcha(RE_CAPTCHA_SECRET_KEY);

        $resp = $recaptcha->setExpectedHostname($_SERVER['SERVER_NAME'])
            ->setExpectedAction('appointment')
            ->setScoreThreshold(0.5)
            ->verify($_POST['g-recaptcha-response-appointment-form'], $_SERVER['REMOTE_ADDR']);

        if (!$resp->isSuccess()) {
            wp_safe_redirect(esc_url(add_query_arg(['status' => 'error'], $http_refer)));
            exit;
        }

        $validator = new Valitron\Validator($data);

        $validator->rules([
            'required' => [
                ['name'],
                ['phone'],
            ],
            'lengthMin' => [
                ['name', 2],
                ['phone', 2],
            ],
            'lengthMax' => [
                ['name', 64],
                ['phone', 32],
            ],
            'numeric' => ['service_id'],
        ]);

        if (!$validator->validate())
            throw new \Exception(wp_json_encode($validator->errors()));

        /* Mail send to administrator email */
        $to = get_bloginfo('admin_email');
        $subject = 'Форма запису онлайн з сайту ' . get_bloginfo('name');
        $headers = [
            'content-type: text/html',
        ];

        $service = '---';
        if (isset($data['service_id'])) {
            $service_object = get_post((int) $data['service_id']);
            $service = '<a href="' . get_permalink($service_object->ID) . '">' . $service_object->post_title . '</a>';
        }

        ob_start();
        require_once app('path.views') . '/emails/make-appointment-form.php';
        $message = ob_get_contents();
        ob_end_clean();

        if (!wp_mail($to, $subject, $message, $headers))
            throw new \Exception('Error mail send');
        /* End Mail send to administrator email */

        wp_safe_redirect(add_query_arg(['status' => 'success', 'action' => 'appointment'], $http_refer));
    } catch (\Exception $e) {
        wp_safe_redirect(add_query_arg(['status' => 'error', 'response' => base64_encode($e->getMessage())], $http_refer));
    }
}

//
add_action('admin_post_nopriv_review_form', 'reviewHandler');
add_action('admin_post_review_form', 'reviewHandler');

function reviewHandler() {
    $http_refer = isset($_POST['_wp_http_referer']) ? $_POST['_wp_http_referer'] : site_url();

    try {
        if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'callback_action')) {
            throw new \Exception('Field nonce invalid');
        }

        $data = clearPostData($_POST);

        $recaptcha = new \ReCaptcha\ReCaptcha(RE_CAPTCHA_SECRET_KEY);

        $resp = $recaptcha->setExpectedHostname($_SERVER['SERVER_NAME'])
            ->setExpectedAction('review')
            ->setScoreThreshold(0.5)
            ->verify($_POST['g-recaptcha-response-review-form'], $_SERVER['REMOTE_ADDR']);

        if (!$resp->isSuccess()) {
            wp_safe_redirect(esc_url(add_query_arg(['status' => 'error'], $http_refer)));
            exit;
        }

        $validator = new Valitron\Validator($data);

        $validator->rules([
            'required' => [
                ['name'],
                ['text'],
            ],
            'lengthMin' => [
                ['name', 2],
                ['text', 2],
            ],
            'lengthMax' => [
                ['name', 64],
                ['text', 3000],
            ],
            'numeric' => [
                ['rating'],
                ['service_id'],
            ],
        ]);

        if (!$validator->validate())
            throw new \Exception(wp_json_encode($validator->errors()));

        /* Insert data in DB */
        $post_id = wp_insert_post([
            'post_title' => wp_strip_all_tags($data['name']),
            'post_type' => 'review',
            'post_content' => $data['text'],
            'post_status' => 'pending',
            'meta_input' => [
                'review_information_rating' => $data['rating'],
                'review_information_service' => $data['service_id'],
            ],
        ]);

        if (is_wp_error($post_id))
            throw new \Exception('Save review error');
        /* End Insert data in DB */

        /* Upload files */
        require_once ABSPATH . 'wp-admin/includes/image.php';
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/media.php';

        if (isset($_FILES['image'], $_FILES['image']['error']) && $_FILES['image']['error'] == 0) {
            $image_id = media_handle_upload('image', $post_id);

            if (is_wp_error($image_id))
                throw new \Exception('Upload image error');

            set_post_thumbnail($post_id, $image_id);
        }
        /* End Upload files */

        /* Mail send to administrator email */
        $to = get_bloginfo('admin_email');
        $subject = 'Новий відгук з сайту ' . get_bloginfo('name');
        $headers = [
            'content-type: text/html',
        ];

        ob_start();
        require_once app('path.views') . '/emails/review-form.php';
        $message = ob_get_contents();
        ob_end_clean();

        if (!wp_mail($to, $subject, $message, $headers))
            throw new \Exception('Error mail send');
        /* End Mail send to administrator email */

        wp_safe_redirect(add_query_arg(['status' => 'success', 'action' => 'callback'], $http_refer));
    } catch (\Exception $e) {
        wp_safe_redirect(add_query_arg(['status' => 'error', 'response' => base64_encode($e->getMessage())], $http_refer));
    }
}

//
add_action('admin_post_nopriv_question_form', 'questionHandler');
add_action('admin_post_question_form', 'questionHandler');

function questionHandler() {
    $http_refer = isset($_POST['_wp_http_referer']) ? $_POST['_wp_http_referer'] : site_url();

    try {
        if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'callback_action')) {
            throw new \Exception('Field nonce invalid');
        }

        $data = clearPostData($_POST);

        $validator = new Valitron\Validator($data);

        $validator->rules([
            'required' => [
                ['name'],
                ['phone'],
                ['question'],
            ],
            'lengthMin' => [
                ['name', 2],
                ['phone', 2],
                ['question', 2],
            ],
            'lengthMax' => [
                ['name', 64],
                ['phone', 32],
                ['question', 255],
            ],
        ]);

        if (!$validator->validate())
            throw new \Exception(wp_json_encode($validator->errors()));

        /* Mail send to administrator email */
        $to = get_bloginfo('admin_email');
        $subject = 'Форма запитання з сайту ' . get_bloginfo('name');
        $headers = [
            'content-type: text/html',
        ];

        ob_start();
        require_once app('path.views') . '/emails/question-form.php';
        $message = ob_get_contents();
        ob_end_clean();

        if (!wp_mail($to, $subject, $message, $headers))
            throw new \Exception('Error mail send');
        /* End Mail send to administrator email */

        wp_safe_redirect(add_query_arg(['status' => 'success', 'action' => 'callback'], $http_refer));
    } catch (\Exception $e) {
        wp_safe_redirect(add_query_arg(['status' => 'error', 'response' => base64_encode($e->getMessage())], $http_refer));
    }
}

//
add_action('admin_post_nopriv_make_package_appointment_form', 'makePackageAppointmentHandler');
add_action('admin_post_make_package_appointment_form', 'makePackageAppointmentHandler');

function makePackageAppointmentHandler() {
    $http_refer = isset($_POST['_wp_http_referer']) ? $_POST['_wp_http_referer'] : site_url();

    try {
        if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'callback_action')) {
            throw new \Exception('Field nonce invalid');
        }

        $data = clearPostData($_POST);

        $recaptcha = new \ReCaptcha\ReCaptcha(RE_CAPTCHA_SECRET_KEY);

        $resp = $recaptcha->setExpectedHostname($_SERVER['SERVER_NAME'])
            ->setExpectedAction('package_appointment')
            ->setScoreThreshold(0.5)
            ->verify($_POST['g-recaptcha-response-package-appointment-form'], $_SERVER['REMOTE_ADDR']);

        if (!$resp->isSuccess()) {
            wp_safe_redirect(esc_url(add_query_arg(['status' => 'error'], $http_refer)));
            exit;
        }

        $validator = new Valitron\Validator($data);

        $validator->rules([
            'required' => [
                ['name'],
                ['phone'],
                ['package_name'],
            ],
            'lengthMin' => [
                ['name', 2],
                ['phone', 2],
                ['package_name', 2],
            ],
            'lengthMax' => [
                ['name', 64],
                ['phone', 32],
                ['package_name', 124],
            ],
        ]);

        if (!$validator->validate())
            throw new \Exception(wp_json_encode($validator->errors()));

        /* Mail send to administrator email */
        $to = get_bloginfo('admin_email');
        $subject = 'Форма запису на пакет послуг з сайту ' . get_bloginfo('name');
        $headers = [
            'content-type: text/html',
        ];

        ob_start();
        require_once app('path.views') . '/emails/make-package-appointment-form.php';
        $message = ob_get_contents();
        ob_end_clean();

        if (!wp_mail($to, $subject, $message, $headers))
            throw new \Exception('Error mail send');
        /* End Mail send to administrator email */

        wp_safe_redirect(add_query_arg(['status' => 'success', 'action' => 'appointment'], $http_refer));
    } catch (\Exception $e) {
        wp_safe_redirect(add_query_arg(['status' => 'error', 'response' => base64_encode($e->getMessage())], $http_refer));
    }
}
/* End Form Handlers */


add_action('wp_ajax_load_more_articles', 'loadMoreArticlesHandler');
add_action('wp_ajax_nopriv_load_more_articles', 'loadMoreArticlesHandler');

function loadMoreArticlesHandler() {
    $args = unserialize(stripslashes($_POST['query']));
    $args['paged'] = $_POST['page'] + 1;
    $args['post_status'] = 'publish';

    $articles = get_posts($args);

    foreach ($articles as $article) :

        require app('path.views') . '/page/articles/article-block.php';

    endforeach;

    die();
}

//
add_action('wp_ajax_load_more_services', 'loadMoreServicesHandler');
add_action('wp_ajax_nopriv_load_more_services', 'loadMoreServicesHandler');

function loadMoreServicesHandler() {
    $args = unserialize(stripslashes($_POST['query']));
    $args['paged'] = $_POST['page'] + 1;
    $args['post_status'] = 'publish';

    $services = get_posts($args);

    foreach ($services as $service) :

        require app('path.views') . '/service/elements/service-block.php';

    endforeach;

    die();
}

// Додаємо розділ в налаштуваннях "Форми"
include_once('custom-form-settings.php');

// Додаємо код в кінець тіла сторінки адмін-панелі
function my_admin_footer() {
    include_once(get_template_directory() . '/app/views/modal-add-btn.php');
}
add_action('admin_footer', 'my_admin_footer');


wp_add_inline_script( 'jquery', '$ = jQuery;' );

/***************** Додавання поля "Опис" в меню ***********************************************************************/
function menu_item_desc( $item_id, $item ) {
    $menu_item_desc = get_post_meta( $item_id, '_menu_item_desc', true );
    ?>
    <p class="description description-wide">
        <label>Короткий опис</label><br />
        <input type="hidden" class="nav-menu-id" value="<?php echo $item_id ;?>" />
    <div class="logged-input-holder">
        <input type="text" class="widefat edit-menu-item-title" name="menu_item_desc[<?php echo $item_id ;?>]" id="menu-item-desc-<?php echo $item_id ;?>" value="<?php echo esc_attr( $menu_item_desc ); ?>" />
    </div>
    </p>
    <?php
}
add_action( 'wp_nav_menu_item_custom_fields', 'menu_item_desc', 10, 2 );

function save_menu_item_desc( $menu_id, $menu_item_db_id ) {
    if ( isset( $_POST['menu_item_desc'][$menu_item_db_id]  ) ) {
        $sanitized_data = sanitize_text_field( $_POST['menu_item_desc'][$menu_item_db_id] );
        update_post_meta( $menu_item_db_id, '_menu_item_desc', $sanitized_data );
    } else {
        delete_post_meta( $menu_item_db_id, '_menu_item_desc' );
    }
}
add_action( 'wp_update_nav_menu_item', 'save_menu_item_desc', 10, 2 );
/******************************************************************************************************************** */
/***************** Додавання поля "Чекбокс 'кастомне меню'" в меню ****************************************************/
function menu_item_menu_custom( $item_id, $item ) {
    $menu_item_checkbox = get_post_meta( $item_id, '_menu_item_menu_custom', true );
    ?>
    <p class="description description-wide">
        <input type="hidden" class="nav-menu-id" value="<?php echo $item_id ;?>" /></p>
    <div class="logged-input-holder">
        <input type="checkbox" name="menu_item_menu_custom[<?php echo $item_id ;?>]" id="menu-item-menu_custom-<?php echo $item_id ;?>" <?php if($menu_item_checkbox == 1):?> checked <?php endif;?>  value="1" />
        <label for="menu-item-menu_custom-<?php echo $item_id ;?>">Кастомне меню</label>
    </div>
    <?php
}
add_action( 'wp_nav_menu_item_custom_fields', 'menu_item_menu_custom', 10, 3 );

function save_menu_item_menu_custom( $menu_id, $menu_item_db_id ) {
    if ( isset( $_POST['menu_item_menu_custom'][$menu_item_db_id]  ) ) {
        $sanitized_data = sanitize_text_field( $_POST['menu_item_menu_custom'][$menu_item_db_id] );
        update_post_meta( $menu_item_db_id, '_menu_item_menu_custom', $sanitized_data );
    } else {
        delete_post_meta( $menu_item_db_id, '_menu_item_menu_custom' );
    }
}
add_action( 'wp_update_nav_menu_item', 'save_menu_item_menu_custom', 10, 3 );
/******************************************************************************************************************** */
/***************** Додавання поля "Чекбокс 'Target blank'" в меню ****************************************************/
function menu_item_target_blank( $item_id, $item ) {
    $menu_item_checkbox_target_blank = get_post_meta( $item_id, '_menu_item_target_blank', true );
    ?>
    <p class="description description-wide">
        <input type="hidden" class="nav-menu-id" value="<?php echo $item_id ;?>" />
    </p>
    <div class="logged-input-holder">
        <input type="checkbox" name="menu_item_target_blank[<?php echo $item_id ;?>]" id="menu-item-target_blank-<?php echo $item_id ;?>" <?php if($menu_item_checkbox_target_blank == 1):?> checked <?php endif;?>  value="1" />
        <label for="menu-item-target_blank-<?php echo $item_id ;?>">Target blank</label>
    </div>
    <?php
}
add_action( 'wp_nav_menu_item_custom_fields', 'menu_item_target_blank', 10, 3 );

function save_menu_item_target_blank( $menu_id, $menu_item_db_id ) {
    if ( isset( $_POST['menu_item_target_blank'][$menu_item_db_id]  ) ) {
        $sanitized_data = sanitize_text_field( $_POST['menu_item_target_blank'][$menu_item_db_id] );
        update_post_meta( $menu_item_db_id, '_menu_item_target_blank', $sanitized_data );
    } else {
        delete_post_meta( $menu_item_db_id, '_menu_item_target_blank' );
    }
}
add_action( 'wp_update_nav_menu_item', 'save_menu_item_target_blank', 10, 3 );
/******************************************************************************************************************** */

function remove_widgets_submenu() {
    global $submenu;
    unset($submenu['themes.php'][6]); // Видалити пункт "Паттерни"
    unset($submenu['themes.php'][8]); // Видалити пункт "Віджети"
    unset($submenu['themes.php'][5]); // Видалити пункт "Теми"
    unset($submenu['themes.php'][7]); // Видалити пункт "Налаштування"
}
add_action('admin_menu', 'remove_widgets_submenu');

/***************** Видалення підрозділів з меню "Записи" **************************************************************/
function custom_remove_menus() {
    remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=category' ); // Видалення підрозділу "Категорії"
    remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=post_tag' ); // Видалення підрозділу "Мітки"
    remove_submenu_page( 'edit.php', 'to-interface-post' ); // Видалення підрозділу "taxonomy"
}
add_action( 'admin_menu', 'custom_remove_menus', 999 );

/***************** Додавання mime type svg, mp4, webm, gif ************************************************************/
function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    $mimes['mp4'] = 'video/mp4';
    $mimes['webm'] = 'video/webm';
    $mimes['gif'] = 'image/gif';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function allow_svg_uploads($data, $file, $filename, $mimes) {
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if ($ext === 'svg') {
        $data['ext'] = 'svg';
        $data['type'] = 'image/svg+xml';
    }
    return $data;
}
add_filter('wp_check_filetype_and_ext', 'allow_svg_uploads', 10, 4);
/******************************************************************************************************************** */

/*************************** Перейменувати "Записи" на "Блог" *********************************************************/
function rename_posts_menu() {
    global $menu;
    global $submenu;

    // Змінити основний пункт меню
    $menu[5][0] = 'Блог';

    // Змінити підпункт меню
    $submenu['edit.php'][5][0] = 'Всі записи блогу';
    $submenu['edit.php'][10][0] = 'Додати новий запис';
    $submenu['edit.php'][16][0] = 'Теги блогу'; // Підрозділ "Мітки"

    // Якщо є додаткові підрозділи, змініть їхні назви тут
}
add_action( 'admin_menu', 'rename_posts_menu' );
/******************************************************************************************************************** */