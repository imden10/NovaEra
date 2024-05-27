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

$custom_form_settings = get_option('custom_form_settings');
$formBotList = ['' => '---'];

foreach ($custom_form_settings as $key => $value) {
    $formBotList[$key] = $value['form_name'];
}

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
                                    'banner' => 'With banner',
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
                        'hero' => [
                            'label' => __('Головний екран'),
                            'component' => 'App\Components\MetaBox\Constructor\Constructor',
                            'single' => true,
                            'params' => [
                                'only' => [
                                    'Hero30Grid.php',
                                    'Hero50Grid.php',
                                    'Hero50Screen.php',
                                    'Hero.php',
                                    'HeroCards.php',
                                ],
                            ]
                        ],
                        'constructor' => [
                            'label' => __('Конструктор'),
                            'component' => 'App\Components\MetaBox\Constructor\Constructor',
                            'single' => true,
                            'params' => [
                                'only' => [
                                    'Text.php',
                                    'TextAndMenu.php',
                                    'SeoText.php',
                                    'DynamicList.php',
                                    'Table.php',
                                    'FullImage.php',
                                    'VideoAndText.php',
                                    'Gallery.php',
                                    'ImageAndText.php',
                                    'Quote.php',
                                    'TextWithBackground.php',
                                    'ThreeColumnText.php',
                                    'TwoColumnText.php',
                                    'SimpleTitle.php',
                                    'Accordion.php',
                                    'Images3.php',
                                    'Stages.php',
                                    'Numbers.php',
                                    'QuoteSlider.php',
                                    'Blocks.php',
                                    'BlockSlider.php',
                                    'CardMiniText.php',
                                    'CardWithImage.php',
                                    'LinkList.php',
                                    'TextDivider.php',
                                    'Theses.php',
                                    'AccordionTable.php',
                                    'Partners.php',
                                    'Prices.php',
                                    'Contacts.php',
                                    'Form.php',
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
                        'body' => [
                            'label' => __(''),
                            'component' => 'App\Components\MetaBox\Constructor\Constructor',
                            'single' => true,
                            'params' => [
                                'only' => [
                                    'Text.php',
                                    'DynamicList.php',
                                    'ImageBlock.php',
                                ],
                            ]
                        ],
                    ],
                ],
            ],
        ],
    ],

//    'banner' => [
//        'type' => [
//            'labels' => [
//                'name' => __('Банери'),
//                'singular_name' => __('Банер'),
//                'add_new' => __('Додати банер'),
//                'add_new_item' => __('Додати новий банер'),
//                'edit_item' => __('Редагувати банер'),
//                'new_item' => __('Новий банер'),
//                'view_item' => __('Подивитись банер'),
//                'search_items' => __('Знайти банер'),
//                'not_found' => __('Банер не знайдено'),
//                'not_found_in_trash' => __('В кошику банер не знайдено'),
//                'parent_item_colon' => '',
//                'menu_name' => __('Банери'),
//            ],
//            'public'  => false,
//            'publicly_queryable' => true,
//            'show_ui' => true,
//            'show_in_menu' => true,
//            'query_var' => true,
//            'capability_type' => 'post',
//            'has_archive' => true,
//            'hierarchical' => false,
//            'menu_position' => 0,
//            'menu_icon' => 'dashicons-format-image',
//            'supports' => [
//                'title',
//            ]
//        ],
//
//        'metas' => [
//            'post' => [
//                'banner_information' => [
//                    'label' => __('Налаштування'),
//                    'position' => 'normal',
//                    'priority' => 'default',
//                    'fields' => [
//                        'title' => [
//                            'label' => __('Заголовок'),
//                            'component' => 'App\Components\MetaBox\Text',
//                            'single' => true,
//                            'params' => [],
//                        ],
//                        'text' => [
//                            'label' => __('Текст'),
//                            'component' => 'App\Components\MetaBox\Editor',
//                            'single' => true,
//                            'params' => [],
//                        ],
//                        'link' => [
//                            'label' => __('Посилання'),
//                            'component' => 'App\Components\MetaBox\Url',
//                            'single' => true,
//                            'params' => [],
//                        ],
//                        'list' => [
//                            'label' => 'Кнопки',
//                            'component' => 'App\Components\MetaBox\Banner\BtnList',
//                            'single' => true,
//                            'params' => [],
//                        ],
//                        'images' => [
//                            'label' => 'Зображення',
//                            'component' => 'App\Components\MetaBox\Banner\Images',
//                            'single' => true,
//                            'params' => [],
//                        ],
//                        'size' => [
//                            'label' => 'Розмір',
//                            'component' => 'App\Components\MetaBox\Select',
//                            'single' => true,
//                            'params' => [
//                                'list' => [
//                                    's' => 'Маленький',
//                                    'm' => 'Середній',
//                                    'l' => 'Великий',
//                                ]
//                            ],
//                        ],
//                        'btn' => [
//                            'label' => __('1'),
//                            'component' => 'App\Components\MetaBox\Banner\GenerateBtn',
//                            'single' => true,
//                            'params' => [],
//                        ],
//                    ],
//                ],
//            ],
//        ],
//    ],

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
                'form_information' => [
                    'label' => __('Налаштування'),
                    'position' => 'normal',
                    'priority' => 'default',
                    'fields' => [
                        'title' => [
                            'label' => __('Заголовок для повідомлення'),
                            'component' => 'App\Components\MetaBox\Text',
                            'single' => true,
                            'params' => []
                        ],
                        'btn_name' => [
                            'label' => __('Напис на кнопці'),
                            'component' => 'App\Components\MetaBox\Text',
                            'single' => true,
                            'params' => []
                        ],
                        'image' => [
                            'label' => __('Зображення'),
                            'component' => 'App\Components\MetaBox\Image',
                            'single' => true,
                            'params' => []
                        ],
                        'group_id' => [
                            'label' => __('Надсилати в групу'),
                            'component' => 'App\Components\MetaBox\Select',
                            'single' => true,
                            'params' => [
                                'list' => $formBotList
                            ]
                        ],
                        [
                            'label' => __('Вікно результату'),
                            'component' => 'App\Components\MetaBox\Separator',
                            'single' => true,
                            'params' => []
                        ],
                        'success_title' => [
                            'label' => __('Заголовок'),
                            'component' => 'App\Components\MetaBox\Text',
                            'single' => true,
                            'params' => []
                        ],
                        'success_text' => [
                            'label' => __('Текст'),
                            'component' => 'App\Components\MetaBox\Textarea',
                            'single' => true,
                            'params' => []
                        ],
                        'fields' => [
                            'label' => __('Поля форми'),
                            'component' => 'App\Components\MetaBox\Constructor\Constructor',
                            'single' => true,
                            'params' => [
                                'without_separator_block' => true,
                                'without_title' => true,
                                'only' => [
                                    'FormTitle.php',
                                    'FormText.php',
                                    'FormInput.php',
                                    'FormTextarea.php',
                                    'FormSelect.php',
                                    'FormCheckbox.php',
                                ],
                            ]
                        ],
                    ],
                ],
            ],
        ],
    ],
];