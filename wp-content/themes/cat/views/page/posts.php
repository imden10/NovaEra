<div class="blog container">
    <div class="top-side">
        <ul class="breadcrumbs">
            <?php $home_page = get_post(get_option('page_on_front')); ?>
            <li class="breadcrumbs-item"><a href="<?php echo site_url(); ?>" class="brdcrmb__lnk"><?php echo $home_page->post_title; ?></a></li>

            <li class="breadcrumbs-item"><?php echo !empty($page->page_information_breadcrumb) ? $page->page_information_breadcrumb : $page->post_title; ?></li>
        </ul>
        <h1><?php echo $page->post_title; ?></h1>
        <!-- <div class="cformbanner__wrap">
            <div class="cformbanner__textcol">
                <ul class="brdcrmb">
                    
                    <li class="brdcrmb__li"><a href="<?php echo site_url(); ?>" class="brdcrmb__lnk"><?php echo $home_page->post_title; ?></a></li>

                    <li class="brdcrmb__li"><?php echo $page->post_title; ?></li>
                </ul>

                <div class="cformbanner__textcol__formwrap">
                    <h1 class="blogtitle"><?php echo $page->post_title; ?></h1>
                </div>
            </div>
        </div>

        <div class="bgdots bgtopcenter"></div>
        <div class="bgtext bgtopleft"></div> -->
    </div>
    <div class="blog-wrapper">


        <aside class="blog-aside">
            <div class="redactor">
                <?= $page->page_information_description ?? '' ?>
            </div>
        </aside>

        <section>
            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $article_objects = model('post')->all([], null, $paged);
            $articles = $article_objects->posts;
            if (!empty($articles)) : ?>

                <div class="article-list">
                    <?php foreach ($articles as $article) :
                        require app('path.views') . '/page/articles/article-block.php';
                    endforeach; ?>
                </div>

                <!-- Пагінація -->
                <div class="pagination">
                    <?php
                    $pagination_args = array(
                        'total'        => $article_objects->max_num_pages,
                        'current'      => $paged,
                        'show_all'     => false,
                        'end_size'     => 1,
                        'mid_size'     => 2,
                        'prev_next'    => true,
                        'prev_text'    => __('« Попередня'),
                        'next_text'    => __('Наступна »'),
                        'type'         => 'plain',
                    );
                    echo paginate_links($pagination_args);
                    ?>
                </div>

            <?php endif; ?>
        </section>
    </div>
</div>