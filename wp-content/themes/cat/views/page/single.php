Single page (PageController)

<?php buildContentFromConstructorArray('service', $page->page_information_constructor); ?>

<pre>
    <?php
    $post_id = 1629; // Замініть це на бажаний ID посту "forms"

    $form = get_post($post_id);

    if ($form && $form->post_type == 'forms') {
        // Отримати дані з посту, наприклад, заголовок і контент
        $form_title = $form->post_title;

        print_r([
            $form->form_information_title,
            $form->form_information_btn_name,
            $form->form_information_image,
            $form->form_information_group_id,
            $form->form_information_success_title,
            $form->form_information_success_text,
            $form->form_information_fields,
        ]);

        // Далі ви можете використовувати отримані дані
    } else {
        // Пост не було знайдено або це не пост типу "form"
    }
    ?>
</pre>
