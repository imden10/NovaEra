<section class="gallerypage">
    <div class="gallerypage__heading">
        <div class="container mobfluid">
            <!-- Breadcrumbs -->
            <ul class="brdcrmb">
                <?php $home_page = get_post(get_option('page_on_front')); ?>
                <li class="brdcrmb__li"><a href="<?php echo site_url(); ?>" class="brdcrmb__lnk"><?php echo $home_page->post_title; ?></a></li>

                <li class="brdcrmb__li"><?php echo !empty($page->page_information_breadcrumb) ? $page->page_information_breadcrumb : $page->post_title; ?></li>
            </ul>
            <!-- End Breadcrumbs -->

            <h1 class="gallerypage__title variablefz"><?php echo $page->post_title; ?></h1>

            <div class="row justify-content-between">
                <div class="col-lg-7 col-sm-12">
                    <?php echo wpautop($page->post_content); ?>
                </div>

<!--                <div class="col-lg-3 col-sm-12">-->
<!--                    <a href="#" class="headergoalllnk"><span>Читать больше</span><img src="img/arrow_right.svg" alt=""></a>-->
<!--                </div>-->
            </div>
        </div>
    </div>

    <?php buildContentFromConstructorArray('service', $page->page_information_constructor); ?>

</section>

<?php require app('path.views') . '/layouts/forms/footer_form.php'; ?>
