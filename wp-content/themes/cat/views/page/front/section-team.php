<?php $employees = model('employee')->forFrontPage()->posts;
if (!empty($employees)) : ?>
    <section class="crew">
        <div class="container">
            <div class="sectionheaderwrap">
                <div class="titlefigure"></div>
                <h2 class="sectionheader"><?php echo trans('Наша Команда'); ?></h2>
            </div>

            <div class="row justify-content-between">
                <div class="col-lg-9 col-sm-12">
                    <span class="sectionsubheader"><?php echo trans('Врачи и медсперсонал клиники MK Dental Clinic'); ?></span>
                </div>

                <div class="col-lg-3 col-sm-12">
                    <div class="headerlnk-wrap">
                        <a href="<?php echo get_permalink(getCustomOption('relations_employees_page')); ?>" class="headergoalllnk"><span><?php echo trans('Вся команда'); ?> </span><img src="<?php echo appConfig('theme_url'); ?>/img/arrow_right.svg" alt=""></a>
                    </div>
                </div>
            </div>

            <div class="row">

                <?php foreach ($employees as $employee) : ?>
                    <div class="col-lg-3 col-md-6 col-6">
                        <div class="crewitem">
                            <div class="crewitem__imgwrap" style="background: no-repeat center/cover url('<?php echo has_post_thumbnail($employee->ID) ? get_the_post_thumbnail_url($employee->ID, 'full') : ''; ?>')">
                                <div class="crewitem__imgwrap__soccontainer">
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

                            <div class="crewitem__textcontent">
                                <span class="crewitem__textcontent__exp"><?php echo $employee->employee_information_experience; ?></span>
                                <span class="crewitem__textcontent__name"><?php echo $employee->post_title; ?></span>
                                <p class="crewitem__textcontent__subtext"><?php echo $employee->employee_information_subtitle; ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>

        <div class="bgdots bgtopright"></div>
        <div class="bgdots bgbotleft"></div>
    </section>
<?php endif; ?>
