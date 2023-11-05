<?php if ($page) : ?>
    <section class="cformbanner notfoundpage">
        <div class="cformbanner__wrap">
            <div class="cformbanner__textcol">
                <div class="notfoundpage__messagewrap">
                    <h1 class="notfoundpage__title"><?php echo $page->post_title; ?></h1>

                    <?php echo $page->post_content; ?>

                    <a href="<?php echo get_site_url(); ?>" class="notfoundpage__lnk"><?php echo trans('На главную'); ?></a>
                </div>
            </div>
            <div class="cformbanner__banner" style="background: no-repeat center/cover url('<?php echo has_post_thumbnail($page->ID) ? get_the_post_thumbnail_url($page->ID, 'full') : ''; ?>');"></div>
        </div>

        <div class="bgdots bgtopcenter"></div>
        <div class="bgtext bgbotleft"></div>
    </section>
<?php endif; ?>
