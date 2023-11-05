<?php

return [

    'name' => 'Cat Project',

    'text_domain' => 'cat-project',

    'languages_path' => 'languages',
    
    'theme_dir' => get_template_directory(),

    'theme_url' => get_template_directory_uri(),

    'post_handler' => admin_url('admin-post.php'),

    'ajax_handler' => admin_url('admin-ajax.php')

];