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
    <!-- <div class="on-dark bg-darker mb-L mt-L">
        <div class="container">

            <h2>Вспылтие можно настроить чтобы с любой стороны выезжали</h2>
            <div class="headline">
                <h2 class="masked">анимация вспылтие + маска</h2>
            </div>
       
            <h2 class="fadeDown-t">анимация вспылтие без маски</h2>
            

            <h2>Анимации банеров/картинок</h2>
            <div class="masked-wrp">
                <img class="masked-image" src="https://images.ctfassets.net/oydui2rqm15t/51btQIIZDerr255ipgviRV/561b08cff61a06d9bbce093e356b0765/ABOUT_US_3_1840x2254.jpg?fm=webp&q=80" alt="">
            </div>
            <h3>тут поставил смещение на 150 для теста
                можем смещать в любую сторону </h3>
            <div class="masked-wrp" style="width: 400px;">
                <img class="paralax-image" src="https://images.ctfassets.net/oydui2rqm15t/51btQIIZDerr255ipgviRV/561b08cff61a06d9bbce093e356b0765/ABOUT_US_3_1840x2254.jpg?fm=webp&q=80" alt="">
            </div>
        </div>
        <h3>от скрола увеличивается/уменьшается банер/картинка</h3>
        <img id="banner-action-on-scroll" src="https://d2interier.com/media/images/orig/uploads/Banneri/banner1.jpg" alt="">
        <img id="banner-action-on-scroll-reverse" src="https://d2interier.com/media/images/orig/uploads/Banneri/banner1.jpg" alt="">
    </div> -->

    <!-- <?php require app('path.views') . '/constructor/service/first-screen.php'; ?> -->
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