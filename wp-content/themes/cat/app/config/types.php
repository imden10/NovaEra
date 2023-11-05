<?php

/*
menu_position (число)
Позиция где должно расположится меню нового типа записи:

1       — в самом верху меню
2-3     — под «Консоль»
4-9     — под «Записи»
10-14   — под «Медиафайлы»
15-19   — под «Ссылки»
20-24   — под «Страницы»
25-59   — под «Комментарии» (по умолчанию, null)
60-64   — под «Внешний вид»
65-69   — под «Плагины»
70-74   — под «Пользователи»
75-79   — под «Инструменты»
80-99   — под «Параметры»
100+    — под разделителем после «Параметры»


supports(массив)
Вспомогательные поля на странице создания/редактирования этого типа записи. Метки для вызова функции add_post_type_support().

title           - блок заголовка;
editor          - блок для ввода контента;
author          - блог выбора автора;
thumbnail       - блок выбора миниатюры записи. Нужно также включить поддержку в установке темы post-thumbnails;
excerpt         - блок ввода цитаты;
trackbacks      - включает поддержку трекбеков и пингов (за блоки не отвечает);
custom-fields   - блок установки произвольных полей;
comments        - блок комментариев (обсуждение);
revisions       - блок ревизий (не отображается пока нет ревизий);
page-attributes - блок атрибутов постоянных страниц (шаблон и древовидная связь записей, древовидность должна быть включена).
post-formats    – блок форматов записи, если они включены в теме.
*/

return [

    'page' => [
        'metas' => [
            'post' => [
                'page_template' => [
                    'label' => __('Шаблон сторінки'),
                    'position' => 'side',
                    'priority' => 'default',
                    'fields' => [
                        'name' => [
                            'label' => __('Шаблон'),
                            'component' => 'App\Components\MetaBox\Select',
                            'single' => true,
                            'params' => [
                                'list' => [
                                    '' => 'Default',
                                    'directions' => 'Directions',
                                    'employees' => 'Employees',
                                    'reviews' => 'Reviews',
                                    'contacts' => 'Contacts',
                                    'gallery' => 'Gallery',
                                    'questions' => 'Questions',
                                    'beforeafter' => 'Before and After',
                                    'prices' => 'Prices',
                                ]
                            ]
                        ],
                    ],
                ],

                'page_information' => [
                    'label' => __('Додаткова інформація'),
                    'position' => 'normal',
                    'priority' => 'default',
                    'fields' => [
                        'breadcrumb' => [
                            'label' => __('Breadcrumb'),
                            'component' => 'App\Components\MetaBox\Text',
                            'single' => true,
                            'params' => []
                        ],
                        'subtitle' => [
                            'label' => __('Підзаголовок'),
                            'component' => 'App\Components\MetaBox\Text',
                            'single' => true,
                            'params' => []
                        ],
                        'seo_breadcrumbs' => [
                            'label' => __('SEO breadcrumbs'),
                            'component' => 'App\Components\MetaBox\Text',
                            'single' => true,
                            'params' => []
                        ],
                        'seo_title' => [
                            'label' => __('SEO заголовок'),
                            'component' => 'App\Components\MetaBox\Text',
                            'single' => true,
                            'params' => []
                        ],
                        'seo_text' => [
                            'label' => __('SEO текст'),
                            'component' => 'App\Components\MetaBox\Textarea',
                            'single' => true,
                            'params' => []
                        ],
                        'page_test_field' => [
                            'label' => __('Test field'),
                            'component' => 'App\Components\MetaBox\Text',
                            'single' => true,
                            'params' => []
                        ],
                        'constructor' => [
                            'label' => __(''),
                            'component' => 'App\Components\MetaBox\Constructor\Constructor',
                            'single' => true,
                            'params' => [
                                'only' => [
                                    'DynamicList.php',
                                    'Gallery.php',
                                    'ImageAndText.php',
                                    'Quote.php',
                                    'Text.php',
                                    'TextWithBackground.php',
                                    'ThreeColumnText.php',
                                    'TwoColumnText.php',
                                    'VideoAndText.php',
                                    'SimpleTitle.php',
                                    'Accordion.php',
                                    'Images3.php',
                                    'Stages.php',
                                    'Numbers.php',
                                    'QuoteSlider.php',
                                    'FullImage.php',
                                    'Blocks.php',
                                    'LinkList.php',
                                    'TextDivider.php',
                                    'BlockSlider.php',
                                    'Theses.php',
                                    'Table.php',
                                    'AccordionTable.php',
                                ],
                            ]
                        ],
                    ],
                ],
            ],
        ],
    ],

    'post' => [
        'metas' => [
            'post' => [
                'post_information' => [
                    'label' => __('Додаткова інформація'),
                    'position' => 'normal',
                    'priority' => 'default',
                    'fields' => [
                        'subtitle' => [
                            'label' => __('Підзаголовок'),
                            'component' => 'App\Components\MetaBox\Text',
                            'single' => true,
                            'params' => []
                        ],
                        'main' => [
                            'label' => __('Головна стаття'),
                            'component' => 'App\Components\MetaBox\Checkbox',
                            'single' => true,
                            'params' => []
                        ],
                        'body' => [
                            'label' => __(''),
                            'component' => 'App\Components\MetaBox\Constructor\Constructor',
                            'single' => true,
                            'params' => [
                                'only' => [
                                    'DynamicList.php',
                                    'Gallery.php',
                                    'ImageAndText.php',
                                    'Quote.php',
                                    'Text.php',
                                    'TextWithBackground.php',
                                    'ThreeColumnText.php',
                                    'TwoColumnText.php',
                                    'VideoAndText.php',
                                    'BeforeAfter.php',
                                ],
                            ]
                        ],
                    ],
                ],
            ],
        ],
    ],

    'service' => [
        'type' => [
            'labels' => [
                'name' => __('Послуги'),
                'singular_name' => __('Послуга'),
                'add_new' => __('Додати послугу'),
                'add_new_item' => __('Додати нову послугу'),
                'edit_item' => __('Редагувати послугу'),
                'new_item' => __('Нова послуга'),
                'view_item' => __('Подивитись послугу'),
                'search_items' => __('Знайти послугу'),
                'not_found' => __('Послуги не знайдено'),
                'not_found_in_trash' => __('В кошику послуги не знайдено'),
                'parent_item_colon' => '',
                'menu_name' => __('Послуги'),
            ],
            'public'  => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 12,
            'menu_icon' => 'dashicons-image-filter',
            'supports' => [
                'title',
                //'editor',
                //'author',
                'thumbnail',
                'page-attributes',
                'excerpt',
                //'comments'
            ],
            'taxonomies' => ['direction'],
        ],

        'taxonomies' => [
            'direction' => [
                'label' => __('Направлення'),
                'labels' => [
                    'name' => __('Направлення'),
                    'singular_name' => __('Направлення'),
                    'search_items' => __('Шукати направлення'),
                    'all_items' => __('Усі направлення'),
                    'parent_item' => __('Батьківське направлення'),
                    'parent_item_colon' => __('Батьківське направлення'),
                    'edit_item' => __('Редагувати направлення'),
                    'update_item' => __('Оновити направлення'),
                    'add_new_item' => __('Додати направлення'),
                    'new_item_name' => __('Нове направлення'),
                    'menu_name' => __('Направлення'),
                ],
                'description' => __('Направлення'),
                'public' => true,
                'show_in_nav_menus' => true,
                'show_ui' => true,
                'show_tagcloud' => false,
                'hierarchical' => true,
                /*
                'rewrite' => [
                    'slug' => 'service',
                    'hierarchical' => false,
                    'with_front' => false,
                    'feed' => false
                ],
                */
                'show_admin_column' => true,
            ],
        ],

        'metas' => [
            'post' => [
                'service_information' => [
                    'label' => __('Додаткова інформація'),
                    'position' => 'normal',
                    'priority' => 'default',
                    'fields' => [
                        'preview_title' => [
                            'label' => __('Preview-заголовок'),
                            'component' => 'App\Components\MetaBox\Text',
                            'single' => true,
                            'params' => []
                        ],
                        'price_actual' => [
                            'label' => __('Актуальна ціна, (грн.)'),
                            'component' => 'App\Components\MetaBox\Text',
                            'single' => true,
                            'params' => []
                        ],
                        'price' => [
                            'label' => __('Ціна, (грн.)'),
                            'component' => 'App\Components\MetaBox\Text',
                            'single' => true,
                            'params' => []
                        ],
                    ],
                ],
                'service_content' => [
                    'label' => __('Контент послуги'),
                    'position' => 'normal',
                    'priority' => 'default',
                    'fields' => [
                        'body' => [
                            'label' => __(''),
                            'component' => 'App\Components\MetaBox\Constructor\Constructor',
                            'single' => true,
                            'params' => []
                        ],
                    ],
                ],
            ],

            'term' => [
                'direction_information' => [
                    'taxonomy' => ['direction'],
                    'fields' => [
                        'preview_title' => [
                            'label' => __('Preview заголовок'),
                            'component'  => 'App\Components\MetaBox\Text',
                            'single' => true,
                            'params' => [],
                        ],
                        'icon' => [
                            'label' => __('Іконка'),
                            'component'  => 'App\Components\MetaBox\Image',
                            'single' => true,
                            'params' => [],
                        ],
                        'image' => [
                            'label' => __('Банер'),
                            'component'  => 'App\Components\MetaBox\Image',
                            'single' => true,
                            'params' => [],
                        ],
                        'seo_title' => [
                            'label' => __('SEO заголовок'),
                            'component'  => 'App\Components\MetaBox\Text',
                            'single' => true,
                            'params' => [],
                        ],
                        'seo_text' => [
                            'label' => __('SEO текст'),
                            'component'  => 'App\Components\MetaBox\Textarea',
                            'single' => true,
                            'params' => [],
                        ],
                        /*
                        'order' => [
                            'label' => __('Порядок сортування'),
                            'component'  => 'App\Components\MetaBox\Number',
                            'single' => true,
                            'params' => [],
                        ],
                        */
                    ],
                ],
            ],
        ],
    ],

    'service_package' => [
        'type' => [
            'labels' => [
                'name' => __('Пакети послуг'),
                'singular_name' => __('Пакети послуги'),
                'add_new' => __('Додати пакет'),
                'add_new_item' => __('Додати новий пакет'),
                'edit_item' => __('Редагувати пакет'),
                'new_item' => __('Новий пакет'),
                'view_item' => __('Подивитись пакет'),
                'search_items' => __('Знайти пакет'),
                'not_found' => __('Пакет не знайдено'),
                'not_found_in_trash' => __('В кошику пакет не знайдено'),
                'parent_item_colon' => '',
                'menu_name' => __('Пакети послуг'),
            ],
            'public'  => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 12,
            'menu_icon' => 'dashicons-products',
            'supports' => [
                'title',
                //'editor',
                //'author',
                'thumbnail',
                'page-attributes',
                //'excerpt',
                //'comments'
            ],
        ],

        'metas' => [
            'post' => [
                'service_package_information' => [
                    'label' => __('Додаткова інформація'),
                    'position' => 'normal',
                    'priority' => 'default',
                    'fields' => [
                        'on_front_page' => [
                            'label' => __('Відображати на головній'),
                            'component' => 'App\Components\MetaBox\Checkbox',
                            'single' => true,
                            'params' => [],
                        ],
                        'price' => [
                            'label' => __('Ціна, (грн.)'),
                            'component' => 'App\Components\MetaBox\Number',
                            'single' => true,
                            'params' => []
                        ],
                        'note' => [
                            'label' => __('Примітка'),
                            'component' => 'App\Components\MetaBox\Text',
                            'single' => true,
                            'params' => []
                        ],
                        'services' => [
                            'label' => __('Назви послуг'),
                            'component' => 'App\Components\MetaBox\DynamicList',
                            'single' => true,
                            'params' => []
                        ],
                    ],
                ],
            ],
        ],
    ],

    'employee' => [
        'type' => [
            'labels' => [
                'name' => __('Співробітники'),
                'singular_name' => __('Співробітник'),
                'add_new' => __('Додати співробітника'),
                'add_new_item' => __('Додати нового співробітника'),
                'edit_item' => __('Редагувати співробітника'),
                'new_item' => __('Новий співробітник'),
                'view_item' => __('Подивитись співробітника'),
                'search_items' => __('Знайти співробітника'),
                'not_found' => __('Співробітника не знайдено'),
                'not_found_in_trash' => __('В кошику співробітника не знайдено'),
                'parent_item_colon' => '',
                'menu_name' => __('Співробітники'),
            ],
            'public'  => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 12,
            'menu_icon' => 'dashicons-businessman',
            'supports' => [
                'title',
                //'editor',
                //'author',
                'thumbnail',
                'page-attributes',
                //'excerpt',
                //'comments'
            ]
        ],

        'metas' => [
            'post' => [
                'employee_information' => [
                    'label' => __('Додаткова інформація'),
                    'position' => 'normal',
                    'priority' => 'default',
                    'fields' => [
                        'subtitle' => [
                            'label' => __('Підзаголовок'),
                            'component' => 'App\Components\MetaBox\Text',
                            'single' => true,
                            'params' => [],
                        ],
                        'on_front_page' => [
                            'label' => __('Відображати на головній'),
                            'component' => 'App\Components\MetaBox\Checkbox',
                            'single' => true,
                            'params' => [],
                        ],
                        'experience' => [
                            'label' => __('Досвід роботи, роки'),
                            'component' => 'App\Components\MetaBox\Text',
                            'single' => true,
                            'params' => [],
                        ],
                        'service' => [
                            'label' => __('Послуги'),
                            'component' => 'App\Components\MetaBox\MultiSelectPost',
                            'single' => true,
                            'params' => [
                                'list' => get_posts([
                                    'post_type' => 'service',
                                    'posts_per_page' => -1,
                                    'order'=> 'ASC',
                                    'orderby' => 'title',
                                    'lang' => function_exists('pll_current_language') ? pll_current_language() : get_locale(),
                                ]),
                            ],
                        ],
                        'facebook' => [
                            'label' => __('Facebook'),
                            'component' => 'App\Components\MetaBox\Url',
                            'single' => true,
                            'params' => []
                        ],
                        'twitter' => [
                            'label' => __('Twitter'),
                            'component' => 'App\Components\MetaBox\Url',
                            'single' => true,
                            'params' => []
                        ],
                        'linked_in' => [
                            'label' => __('LinkedIn'),
                            'component' => 'App\Components\MetaBox\Url',
                            'single' => true,
                            'params' => []
                        ],
                        /*
                        'instagram' => [
                            'label' => __('Instagram'),
                            'component' => 'App\Components\MetaBox\Url',
                            'single' => true,
                            'params' => []
                        ],
                        'email' => [
                            'label' => __('Email'),
                            'component' => 'App\Components\MetaBox\Email',
                            'single' => true,
                            'params' => []
                        ],
                        'phone' => [
                            'label' => __('Телефон'),
                            'component' => 'App\Components\MetaBox\Text',
                            'single' => true,
                            'params' => []
                        ],
                        */
                    ],
                ],
            ],
        ],
    ],

    'before_after' => [
        'type' => [
            'labels' => [
                'name' => __('До/Після'),
                'singular_name' => __('До/Після'),
                /*
                'add_new' => __('Додати відгук'),
                'add_new_item' => __('Додати новий відгук'),
                'edit_item' => __('Редагувати відгук'),
                'new_item' => __('Новий відгук'),
                'view_item' => __('Подивитись відгук'),
                'search_items' => __('Знайти відгук'),
                'not_found' => __('Відгук не знайдено'),
                'not_found_in_trash' => __('В кошику відгук не знайдено'),
                'parent_item_colon' => '',
                */
                'menu_name' => __('До/Після'),
            ],
            'public'  => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 12,
            'menu_icon' => 'dashicons-tickets-alt',
            'supports' => [
                'title',
                'editor',
                //'author',
                //'thumbnail',
                'page-attributes',
                //'excerpt',
                //'comments'
            ]
        ],

        'metas' => [
            'post' => [
                'before_after_information' => [
                    'label' => __('Додаткова інформація'),
                    'position' => 'normal',
                    'priority' => 'default',
                    'fields' => [
                        'before' => [
                            'label' => __('До'),
                            'component' => 'App\Components\MetaBox\Image',
                            'single' => true,
                            'params' => [],
                        ],
                        'after' => [
                            'label' => __('Після'),
                            'component' => 'App\Components\MetaBox\Image',
                            'single' => true,
                            'params' => [],
                        ],
                        'employee' => [
                            'label' => __('Виконавець'),
                            'component' => 'App\Components\MetaBox\SelectPost',
                            'single' => true,
                            'params' => [
                                'list' => get_posts([
                                    'post_type' => 'employee',
                                    'posts_per_page' => -1,
                                    'order'=> 'ASC',
                                    'orderby' => 'title',
                                    'lang' => function_exists('pll_current_language') ? pll_current_language() : get_locale(),
                                ]),
                            ],
                        ],
                        'service' => [
                            'label' => __('Послуга'),
                            'component' => 'App\Components\MetaBox\SelectPost',
                            'single' => true,
                            'params' => [
                                'list' => get_posts([
                                    'post_type' => 'service',
                                    'posts_per_page' => -1,
                                    'order'=> 'ASC',
                                    'orderby' => 'title',
                                    'lang' => function_exists('pll_current_language') ? pll_current_language() : get_locale(),
                                ]),
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],

    'review' => [
        'type' => [
            'labels' => [
                'name' => __('Відгуки'),
                'singular_name' => __('Відгук'),
                'add_new' => __('Додати відгук'),
                'add_new_item' => __('Додати новий відгук'),
                'edit_item' => __('Редагувати відгук'),
                'new_item' => __('Новий відгук'),
                'view_item' => __('Подивитись відгук'),
                'search_items' => __('Знайти відгук'),
                'not_found' => __('Відгук не знайдено'),
                'not_found_in_trash' => __('В кошику відгук не знайдено'),
                'parent_item_colon' => '',
                'menu_name' => __('Відгуки'),
            ],
            'public'  => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 12,
            'menu_icon' => 'dashicons-format-status',
            'supports' => [
                'title',
                'editor',
                //'author',
                'thumbnail',
                //'page-attributes',
                //'excerpt',
                //'comments'
            ]
        ],

        'metas' => [
            'post' => [
                'review_information' => [
                    'label' => __('Додаткова інформація'),
                    'position' => 'normal',
                    'priority' => 'default',
                    'fields' => [
                        'on_front_page' => [
                            'label' => __('Відображати на головній'),
                            'component' => 'App\Components\MetaBox\Checkbox',
                            'single' => true,
                            'params' => [],
                        ],
                        'rating' => [
                            'label' => __('Рейтинг'),
                            'component' => 'App\Components\MetaBox\Select',
                            'single' => true,
                            'params' => [
                                'list' => [
                                    '1' => 1,
                                    '2' => 2,
                                    '3' => 3,
                                    '4' => 4,
                                    '5' => 5,
                                ],
                            ],
                        ],
                        'service' => [
                            'label' => __('Послуга'),
                            'component' => 'App\Components\MetaBox\SelectPost',
                            'single' => true,
                            'params' => [
                                'list' => get_posts([
                                    'post_type' => 'service',
                                    'posts_per_page' => -1,
                                    'order'=> 'ASC',
                                    'orderby' => 'title',
                                    'lang' => function_exists('pll_current_language') ? pll_current_language() : get_locale(),
                                ]),
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],

    'faq' => [
        'type' => [
            'labels' => [
                'name' => __('FAQs'),
                'singular_name' => __('FAQs'),
                'add_new' => __('Додати питання-відповідь'),
                'add_new_item' => __('Додати нове питання-відповідь'),
                'edit_item' => __('Редагувати питання-відповідь'),
                'new_item' => __('Нове питання-відповідь'),
                'view_item' => __('Подивитись питання-відповідь'),
                'search_items' => __('Знайти питання-відповідь'),
                'not_found' => __('Питання-відповідь не знайдено'),
                'not_found_in_trash' => __('В кошику питання-відповідь не знайдено'),
                'parent_item_colon' => '',
                'menu_name' => __('FAQs'),
            ],
            'public'  => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 13,
            'menu_icon' => 'dashicons-thumbs-up',
            'supports' => [
                'title',
                'editor',
                //'author',
                //'thumbnail',
                'page-attributes',
                //'excerpt',
                //'comments'
            ]
        ],

        'metas' => [
            'post' => [
                'faq_information' => [
                    'label' => __('Додаткова інформація'),
                    'position' => 'normal',
                    'priority' => 'default',
                    'fields' => [
                        'service' => [
                            'label' => __('Послуга'),
                            'component' => 'App\Components\MetaBox\SelectPost',
                            'single' => true,
                            'params' => [
                                'list' => get_posts([
                                    'post_type' => 'service',
                                    'posts_per_page' => -1,
                                    'order'=> 'ASC',
                                    'orderby' => 'title',
                                    'lang' => function_exists('pll_current_language') ? pll_current_language() : get_locale(),
                                ]),
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],

    'partner' => [
        'type' => [
            'labels' => [
                'name' => __('Партнери'),
                'singular_name' => __('Партнер'),
                'add_new' => __('Додати партнера'),
                'add_new_item' => __('Додати нового партнера'),
                'edit_item' => __('Редагувати партнера'),
                'new_item' => __('Новий партнер'),
                'view_item' => __('Подивитись партнера'),
                'search_items' => __('Знайти партнера'),
                'not_found' => __('Партнер не знайдено'),
                'not_found_in_trash' => __('В кошику партнера не знайдено'),
                'parent_item_colon' => '',
                'menu_name' => __('Партнери'),
            ],
            'public'  => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 13,
            'menu_icon' => 'dashicons-groups',
            'supports' => [
                'title',
                //'editor',
                //'author',
                'thumbnail',
                'page-attributes',
                //'excerpt',
                //'comments'
            ]
        ],

        'metas' => [
            'post' => [

            ],
        ],
    ],

    'benefit' => [
        'type' => [
            'labels' => [
                'name' => __('Переваги'),
                'singular_name' => __('Перевага'),
                'add_new' => __('Додати перевагу'),
                'add_new_item' => __('Додати нову перевагу'),
                'edit_item' => __('Редагувати перевагу'),
                'new_item' => __('Нова перевага'),
                'view_item' => __('Подивитись перевагу'),
                'search_items' => __('Знайти перевагу'),
                'not_found' => __('Перевагу не знайдено'),
                'not_found_in_trash' => __('В кошику перевагу не знайдено'),
                'parent_item_colon' => '',
                'menu_name' => __('Переваги'),
            ],
            'public'  => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 13,
            'menu_icon' => 'dashicons-star-filled',
            'supports' => [
                'title',
                'editor',
                //'author',
                'thumbnail',
                'page-attributes',
                //'excerpt',
                //'comments'
            ]
        ],

        'metas' => [
            'post' => [

            ],
        ],
    ],

    /*
    'type_name_2' => [

        'type' => [

        ],

        'taxonomy' => [

        ],

        'meta' => [

            'post' => [

            ],

            'term' => [

            ],

        ],

    ]
    */

    'banner' => [
        'type' => [
            'labels' => [
                'name' => __('Головний банер'),
                'singular_name' => __('Банер'),
                'add_new' => __('Додати банер'),
                'add_new_item' => __('Додати новий банер'),
                'edit_item' => __('Редагувати банер'),
                'new_item' => __('Новий банер'),
                'view_item' => __('Подивитись банер'),
                'search_items' => __('Знайти банер'),
                'not_found' => __('Банер не знайдено'),
                'not_found_in_trash' => __('В кошику банер не знайдено'),
                'parent_item_colon' => '',
                'menu_name' => __('Головний банер'),
            ],
            'public'  => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 0,
            'menu_icon' => 'dashicons-format-image',
            'supports' => [
                'title',
                //'editor',
                //'author',
                //'thumbnail',
                'page-attributes',
                //'excerpt',
                //'comments'
            ]
        ],

        'metas' => [
            'post' => [
                'banner_information' => [
                    'label' => __('Додаткова інформація'),
                    'position' => 'normal',
                    'priority' => 'default',
                    'fields' => [
                        'link' => [
                            'label' => __('Посилання'),
                            'component' => 'App\Components\MetaBox\Url',
                            'single' => true,
                            'params' => [],
                        ],
                        'desktop_image' => [
                            'label' => __('Зображення (desktop)'),
                            'component' => 'App\Components\MetaBox\Image',
                            'single' => true,
                            'params' => [],
                        ],
                        'mobile_image' => [
                            'label' => __('Зображення (mobile)'),
                            'component' => 'App\Components\MetaBox\Image',
                            'single' => true,
                            'params' => [],
                        ],
                    ],
                ],
            ],
        ],
    ],

    'forms' => [
        'type' => [
            'labels' => [
                'name' => __('Форми'),
                'singular_name' => __('Форма'),
                'add_new' => __('Додати форму'),
                'add_new_item' => __('Додати нову форму'),
                'edit_item' => __('Редагувати форму'),
                'new_item' => __('Нова фарма'),
                'view_item' => __('Подивитись форму'),
                'search_items' => __('Знайти форму'),
                'not_found' => __('Форму не знайдено'),
                'not_found_in_trash' => __('В кошику форму не знайдено'),
                'parent_item_colon' => '',
                'menu_name' => __('Форми'),
            ],
            'public'  => false,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 14,
            'menu_icon' => 'dashicons-feedback',
            'supports' => [
                'title',
//                'editor',
                //'author',
//                'thumbnail',
//                'page-attributes',
                //'excerpt',
                //'comments'
            ]
        ],

        'metas' => [
            'post' => [

            ],
        ],
    ],
];