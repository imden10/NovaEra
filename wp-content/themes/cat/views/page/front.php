<section class="page">
    <div class="page__heading">
        <div class="container">
            <!-- Breadcrumbs -->
            <ul class="brdcrmb">
                <?php $home_page = get_post(get_option('page_on_front')); ?>
                <li class="brdcrmb__li"><a href="<?php echo site_url(); ?>" class="brdcrmb__lnk"><?php echo $home_page->post_title; ?></a></li>

                <li class="brdcrmb__li"><?php echo !empty($page->page_information_breadcrumb) ? $page->page_information_breadcrumb : $page->post_title; ?></li>
            </ul>
            <!-- End Breadcrumbs -->

            <h1 class="page__title variablefz"><?php echo $page->post_title; ?></h1>

            <div class="row justify-content-between">
                <div class="col-lg-7 col-sm-12">
                    <?php echo wpautop($page->post_content); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="constructor-container">
        <?php buildContentFromConstructorArray('service', $page->page_information_constructor); ?>
    </div>
    <!-- переключалка для отладки -->
    <div class="setMode">
        <div class="mode" data-mode="light">ligth</div>
        <div class="mode" data-mode="dark">dark</div>
        <div class="startFunc">start demo animation</div>
    </div>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</section>