<?php $benefits = model('benefit')->forFrontPage()->posts;
if (!empty($benefits)) : ?>
    <section class="advantages">
        <div class="container">
            <div class="__titlewrap sectionheaderwrap">
                <div class="titlefigure"></div>
                <h2 class="sectionheader"><?php echo trans('Почему выбирают нас?'); ?></h2>
            </div>

            <div class="row">
                <div class="col-12">
                    <span class="sectionsubheader"><?php echo trans('Преимущества MK Dental Clinic'); ?></span>
                </div>
            </div>

            <div class="row">

                <?php foreach ($benefits as $benefit) : ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="advantageitem">
                            <?php if (has_post_thumbnail($benefit->ID)) : ?>
                                <img src="<?php echo get_the_post_thumbnail_url($benefit->ID, 'full') ?>" alt="<?php echo $benefit->post_title; ?>" class="advantageitem__icon">
                            <?php endif; ?>

                            <span class="advantageitem__title"><?php echo $benefit->post_title; ?></span>
                            <p class="advantageitem__text"><?php echo $benefit->post_content; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>

        <div class="bgdots bgtopright"></div>
        <div class="bgdots bgcenterleft"></div>
        <div class="bgdots bgbotright"></div>
    </section>
<?php endif; ?>
