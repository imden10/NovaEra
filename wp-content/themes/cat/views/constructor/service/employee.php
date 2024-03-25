<?php

$employees = !empty($content['ids']) ? get_posts([
    'post_type' => 'employee',
    'posts_per_page' => -1,
    'post__in' => (array) $content['ids'],
    'orderby' => 'menu_order',
    'order' => 'ASC',
]) : [];

if (!empty($employees)) : ?>

    <div class="employee">

        <div class="container">
            <div class="headerwrap">
                <div class="titlefigure"></div>
                <?php if (!empty($content['title'])) : ?>
                    <h2><?php echo $content['title']; ?></h2>
                <?php endif; ?>
            </div>
        </div>

        <div class="container">
            <div class="workdoctorsslider_wrap sliderwraptrgt">
                <div class="workdoctorsslider owl-carousel">

                    <?php foreach ($employees as $employee) : ?>
                        <div class="workdoctorssl_item">
                            <div class="workdoctorssl_item__imgwrap" style="background: no-repeat center/cover url('<?php echo has_post_thumbnail($employee->ID) ? get_the_post_thumbnail_url($employee->ID, 'full') : ''; ?>')">
                                <div class="workdoctorssl_item__soccontainer">
                                    <?php if ($employee->employee_information_facebook) : ?>
                                        <a href="<?php echo $employee->employee_information_facebook; ?>" class="crewitem__imgwrap__soccontainer__lnk"><i class="fab fa-facebook-f"></i></a>
                                    <?php endif; ?>

                                    <?php if ($employee->employee_information_twitter) : ?>
                                        <a href="<?php echo $employee->employee_information_twitter; ?>" class="crewitem__imgwrap__soccontainer__lnk"><i class="fab fa-twitter"></i></a>
                                    <?php endif; ?>

                                    <?php if ($employee->employee_information_linked_in) : ?>
                                        <a href="<?php echo $employee->employee_information_linked_in; ?>" class="crewitem__imgwrap__soccontainer__lnk"><i class="fab fa-linkedin-in"></i></a>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="workdoctorssl_item__textcontent">
                                <span class="workdoctorssl_item__exp"><?php echo $employee->employee_information_experience; ?></span>
                                <span class="workdoctorssl_item__name"><?php echo $employee->post_title; ?></span>
                                <span class="workdoctorssl_item__subtext"><?php echo $employee->employee_information_subtitle; ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>

                <div class="workdoctorsslider_controlswrap">
                    <div class="galleryslider_controls slider_controls">
                        <span class="slider_controls__prev">
                            <svg width="26" height="13" viewBox="0 0 26 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M26 6.5H1.5M5 1L1 6.5L5 12" stroke="black" stroke-opacity="0.7"/>
                            </svg>
                        </span>

                        <span class="slider_controls__next">
                            <svg width="28" height="13" viewBox="0 0 28 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.5 6.5H26M22.5 1L26.5 6.5L22.5 12" stroke="white"/>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="bgdots bgtopright"></div>
        <div class="bgdots bgbotleft"></div>
    </div>

<?php endif; ?>

<?php require app('path.views') . '/constructor/_buttons.php'; ?>