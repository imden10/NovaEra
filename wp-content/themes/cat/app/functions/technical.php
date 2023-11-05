<?php

/* Disable / enable menu point in admin-panel */
add_action('admin_menu', function() {
    remove_menu_page( 'index.php' );                  //Console
    //remove_menu_page( 'edit.php' );                   //Posts
    //remove_menu_page( 'upload.php' );                 //Media files
    //remove_menu_page( 'edit.php?post_type=page' );    //Pages
    remove_menu_page( 'edit-comments.php' );          //Comments
    //remove_menu_page( 'themes.php' );                 //Appearance
    //remove_menu_page( 'plugins.php' );                //Plugins
    //remove_menu_page( 'users.php' );                  //Users
    remove_menu_page( 'tools.php' );                  //Instruments
    //remove_menu_page( 'options-general.php' );        //Settings
});
/* End Disable / enable menu point in admin-panel */

add_action('admin_enqueue_scripts', function() {
    wp_enqueue_media();
});

/* Change logo and link in login page */
add_action('login_head', function() {
    echo PHP_EOL . '<style type="text/css">
        #login h1 a {
            background-image:url(/wp-content/themes/dental/img/logo.png) !important;
            width: 80px;
            height: 60px;
            -webkit-background-size: 80px 60px;
            background-size: 80px 60px;
        }
        #login #backtoblog { 
            display: none !important; 
        }
        #login #nav { 
            display: none !important;
         }
    </style>' . PHP_EOL;
});

add_filter('login_headertext', function($title) {
    return get_bloginfo('name');
});

add_filter('login_headerurl', function($url) {
    return site_url();
});
/* End Change logo and link in login page */


/* Additional images in posts */
if (class_exists('MultiPostThumbnails')) {

//    new MultiPostThumbnails([
//        'label' => __( 'Банер посту'),
//        'id' => 'post-banner',
//        'post_type' => 'post',
//    ]);

}
/* End Additional images in posts */

add_filter('get_search_form', function($form) {
    $form = '
    
    <form action="' . home_url( '/' ) . '" class="searchfieldwrap__form" role="search" method="get">
        <div class="searchfieldwrap__form__icon"></div>
        <input type="hidden" value="post,service" name="post_type" />
        <input type="text" class="searchfieldwrap__form__input" value="' . get_search_query() . '" name="s" id="s" placeholder="' . trans('Я ищу...') . '">
        <input type="submit" id="searchsubmit" value="' . trans('Найти') . '" class="searchfieldwrap__form__submit">
    </form>';

    return $form;
});


/* Change links and requests */
function changePostLinks($url, $post) {

    if (!is_object($post) || $post instanceof \WP_Post) {
        $post = get_post($post);
    }

    if (in_array($post->ID, [
        getCustomOption('relations_services_page'),
        get_option('ru_relations_services_page'),
        get_option('uk_relations_services_page')
    ])) {
        $replace = $post->post_name;
        $url = str_replace($replace, 'uslugy', $url);
    }

    if (has_term( '', 'direction', $post)) {
        $url = str_replace('/service/', '/uslugy/', $url);
    }

    return $url;
}
add_filter('post_link', 'changePostLinks', 'edit_files', 2);
add_filter('page_link', 'changePostLinks', 'edit_files', 2);
add_filter('post_type_link', 'changePostLinks', 'edit_files', 2);

function changeTermLinks($url, $term, $taxonomy) {
    if ($taxonomy == 'direction') {
        $url = str_replace('/direction/', '/uslugy/direction-', $url);
    }

    return $url;
}
add_filter('term_link', 'changeTermLinks', 10, 3);

function changeRequest($query) {
    $request_url = urldecode($_SERVER['REQUEST_URI']);
    $request_url = str_replace('/' . explode('_', get_locale())[0], '', $request_url);

    if (isset($query['pagename']) && in_array($query['pagename'], ['uslugy', 'napravlenyya-stomatologyy', 'sample-page'])) {
        $p_id = getCustomOption('relations_services_page');
        $p = get_post($p_id);
        $query['pagename'] = $p->post_name;
    }

    if (preg_match('#/uslugy/#', $request_url, $matches) && strpos($request_url, 'direction-') !== false) {
        $query['direction'] = str_replace('direction-', '', $query['attachment']);
        unset($query['attachment']);
        unset($query['post_type']);
    }

    if (preg_match('#/uslugy/#', $request_url, $matches)) {
        if (!empty($matches) && $matches[0] == '/uslugy/' && strlen($request_url) > strlen($matches[0])) {
            $query['post_type'] = 'service';
        }
    }

    return $query;
}

add_filter('request', 'changeRequest', 9999, 1);
/* End Change links and requests */