<?php

return [

    /*
     * $position :
     * 2 Консоль
     * 4 Разделитель
     * 5 Посты
     * 10 Медиа
     * 15 Ссылки
     * 20 Страницы
     * 25 Комментарии
     * 59 Разделитель
     * 60 Внешний вид
     * 65 Плагины
     * 70 Пользователи
     * 75 Инструменты
     * 80 Настройки
     * 99 Разделитель
     */

    'menu_page' => [
        [
            'page_title' => __('Контакти'),
            'menu_label' => __('Контакти'),
            'capability' => 'manage_options',
            'position' => 21,
            'icon_url' => 'dashicons-location',
            'page_slug' => 'page_options',
            'sections' => [

                'contacts_data' =>  [
                    'label' => __('Контактні дані'),
                    'group' => 'contacts_data_group',
                    'description' => '',
                    'fields' => [
                        'phone' => [
                            'label' => __('Телефони'),
                            'component' => 'App\Components\Option\DynamicList',
                            'params' => [],
                        ],
                        'email' => [
                            'label' => __('Email'),
                            'component' => 'App\Components\Option\Email',
                            'params' => [],
                        ],
                        'address' => [
                            'label' => __('Адреса'),
                            'component' => 'App\Components\Option\Textarea',
                            'params' => [],
                        ],
                        'schedule' => [
                            'label' => __('Робочий графік'),
                            'component' => 'App\Components\Option\WorkSchedule',
                            'params' => [],
                        ],
                    ],
                ],

                'map_data' =>  [
                    'label' => __('Відображення на карті'),
                    'group' => 'map_data_group',
                    'description' => '',
                    'fields' => [
                        'title' => [
                            'label' => __('Заголовок мітки'),
                            'component' => 'App\Components\Option\Text',
                            'params' => [],
                        ],
                        'description' => [
                            'label' => __('Опис мітки'),
                            'component' => 'App\Components\Option\Textarea',
                            'params' => [],
                        ],
                        'api_key' => [
                            'label' => __('Google API-key'),
                            'component' => 'App\Components\Option\Text',
                            'params' => [],
                        ],
                        'lat' => [
                            'label' => __('Lat'),
                            'component' => 'App\Components\Option\Text',
                            'params' => [],
                        ],
                        'lng' => [
                            'label' => __('Lng'),
                            'component' => 'App\Components\Option\Text',
                            'params' => [],
                        ],
                    ],
                ],

                'social_links' =>  [
                    'label' => __('Соціальні мережі'),
                    'group' => 'social_links_group',
                    'description' => '',
                    'fields' => [
                        'facebook' => [
                            'label' => __('Facebook'),
                            'component' => 'App\Components\Option\Url',
                            'params' => [],
                        ],
                        'instagram' => [
                            'label' => __('Instagram'),
                            'component' => 'App\Components\Option\Url',
                            'params' => [],
                        ],
                        'telegram' => [
                            'label' => __('Telegram'),
                            'component' => 'App\Components\Option\Text',
                            'params' => [],
                        ],
                    ],
                ],
            ],
        ],

        /*
        [
            //
        ]
        */
    ],


    /*
     * $parent_slug :
     * index.php - Консоль (Dashboard). Или спец. функция: add_dashboard_page();
     * edit.php - Посты (Posts). Или спец. функция: add_posts_page();
     * upload.php - Медиафайлы (Media). Или спец. функция: add_media_page();
     * link-manager.php - Ссылки (Links). Или спец. функция: add_links_page();
     * edit.php?post_type=page - Страницы (Pages). Или спец. функция: add_pages_page();
     * edit-comments.php - Комментарии (Comments). Или спец. функция: add_comments_page();
     * edit.php?post_type=your_post_type - Произвольные типы записей.
     * themes.php - Внешний вид (Appearance). Или спец. функция: add_theme_page();
     * plugins.php - Плагины (Plugins). Или спец. функция: add_plugins_page();
     * users.php - Пользователи (Users). Или спец. функция: add_users_page();
     * tools.php - Инструменты (Tools). Или спец. функция: add_management_page();
     * options-general.php - Настройки (Settings). Или спец. функция: add_options_page()
     * settings.php - Настройки (Settings) сети сайтов в MU режиме.
     */


    'submenu_page' => [
        [
            'parent_slug' => 'plugins.php',
            'page_title' => __('Зв\'язки'),
            'menu_label' => __('Зв\'язки'),
            'capability' => 'manage_options',
            'page_slug' => 'sub_page_options',
            'sections' => [
                'relations' =>  [
                    'label' => __('Зв\'язки'),
                    'group' => 'relation_group',
                    'description' => '',
                    'fields' => [
                        'cases_category' => [
                            'label' => __('Категорія записів для кейсів на головній сторінці'),
                            'component' => 'App\Components\Option\SelectTerm',
                            'params' => [
                                'term' => 'category',
                            ],
                        ],
                        'stock_category' => [
                            'label' => __('Категорія направлення для акцій'),
                            'component' => 'App\Components\Option\SelectTerm',
                            'params' => [
                                'term' => 'direction',
                            ],
                        ],
                        'directions_page' => [
                            'label' => __('Сторінка направлень'),
                            'component' => 'App\Components\Option\SelectPost',
                            'params' => [
                                'list' => get_posts([
                                    'post_type' => 'page',
                                    'posts_per_page' => -1,
                                    'lang' => function_exists('pll_current_language') ? pll_current_language() : get_locale(),
                                ]),
                            ],
                        ],
                        'faqs_page' => [
                            'label' => __('Сторінка частих запитань'),
                            'component' => 'App\Components\Option\SelectPost',
                            'params' => [
                                'list' => get_posts([
                                    'post_type' => 'page',
                                    'posts_per_page' => -1,
                                    'lang' => function_exists('pll_current_language') ? pll_current_language() : get_locale(),
                                ]),
                            ],
                        ],
                        'services_page' => [
                            'label' => __('Сторінка послуг'),
                            'component' => 'App\Components\Option\SelectPost',
                            'params' => [
                                'list' => get_posts([
                                    'post_type' => 'page',
                                    'posts_per_page' => -1,
                                    'lang' => function_exists('pll_current_language') ? pll_current_language() : get_locale(),
                                ]),
                            ],
                        ],
                        'reviews_page' => [
                            'label' => __('Сторінка відгуків'),
                            'component' => 'App\Components\Option\SelectPost',
                            'params' => [
                                'list' => get_posts([
                                    'post_type' => 'page',
                                    'posts_per_page' => -1,
                                    'lang' => function_exists('pll_current_language') ? pll_current_language() : get_locale(),
                                ]),
                            ],
                        ],
                        'employees_page' => [
                            'label' => __('Сторінка співробітників'),
                            'component' => 'App\Components\Option\SelectPost',
                            'params' => [
                                'list' => get_posts([
                                    'post_type' => 'page',
                                    'posts_per_page' => -1,
                                    'lang' => function_exists('pll_current_language') ? pll_current_language() : get_locale(),
                                ]),
                            ],
                        ],
                        'prices_page' => [
                            'label' => __('Сторінка цін'),
                            'component' => 'App\Components\Option\SelectPost',
                            'params' => [
                                'list' => get_posts([
                                    'post_type' => 'page',
                                    'posts_per_page' => -1,
                                    'lang' => function_exists('pll_current_language') ? pll_current_language() : get_locale(),
                                ]),
                            ],
                        ],
                        '404_page' => [
                            'label' => __('Сторінка 404'),
                            'component' => 'App\Components\Option\SelectPost',
                            'params' => [
                                'list' => get_posts([
                                    'post_type' => 'page',
                                    'posts_per_page' => -1,
                                    'lang' => function_exists('pll_current_language') ? pll_current_language() : get_locale(),
                                ]),
                            ],
                        ],
                    ],
                ],
            ],
        ],

    ],


    /*
    'theme_page' => [
        [
            'page_title' => 'Custom options',
            'menu_label' => 'Custom options',
            'capability' => 'manage_options',
            'page_slug' => 'theme_option',

            'sections' => [

                // Sections

            ],
        ],
    ],
    */

];