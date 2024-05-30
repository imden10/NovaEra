<section class="page">
    <div class="page__heading">
        <div class="container">
            <!-- <h1 class="page__title variablefz"><?php echo $page->post_title; ?></h1> -->

            <div class="row justify-content-between">
                <div class="col-lg-7 col-sm-12">
                    <?php echo wpautop($page->post_content); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="main-screen-container">
        <?php buildContentFromConstructorArray('hero', $page->page_information_hero); ?>
    </div>
    <div class="constructor-container">
        <?php buildContentFromConstructorArray('service', $page->page_information_constructor); ?>
    </div>
    <div class="up ic-chevron-up"></div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js"></script>
<!-- NOTE: prior to v2.2.1 tiny-slider.js need to be in <body> -->