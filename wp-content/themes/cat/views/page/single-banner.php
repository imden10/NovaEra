single with banner
<?php $banners = model('banner')->all()->posts;
if (!empty($banners)) :
    $banner = array_shift($banners); ?>
    <section class="firstbanner">
        <?php if (!empty($banner->banner_information_link)) : ?>
        <a href="<?php echo esc_url($banner->banner_information_link); ?>">
            <?php endif; ?>

            <?php if (!empty($banner->banner_information_desktop_image)) : ?>
                <img class="descbanner" src="<?php echo wp_get_attachment_image_url($banner->banner_information_desktop_image, 'full') ?>" alt="">
            <?php endif; ?>

            <?php if (!empty($banner->banner_information_mobile_image)) : ?>
                <img class="mobbanner" src="<?php echo wp_get_attachment_image_url($banner->banner_information_mobile_image, 'full') ?>" alt="">
            <?php endif; ?>

            <?php if (!empty($banner->banner_information_link)) : ?>
        </a>
    <?php endif; ?>
    </section>
<?php endif; ?>
