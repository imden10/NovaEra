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
