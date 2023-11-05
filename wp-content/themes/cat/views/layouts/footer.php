<?php require_once app('path.views') . '/layouts/sections/footer.php'; ?>

<?php require_once app('path.views') . '/layouts/sections/modals.php'; ?>

<?php wp_footer(); ?>

<!-- <script src="js/jquery.mCustomScrollbar.min.js"></script> -->

<?php $directions = model('service')->terms();
$services = model('service')->selectList()->posts; ?>

<script type="text/javascript">
    $('.srvselect').selectize({
        options: [
            <?php $i = 1; foreach ($services as $service) :
            $service_directions = wp_get_post_terms($service->ID, 'direction'); ?>
            {class: '<?php echo isset($service_directions[0]) ? 'direction-' . $service_directions[0]->term_id : ''; ?>', value: "<?php echo $service->ID; ?>", name: "<?php echo esc_attr($service->post_title); ?>" }<?php if ($i < count($services)) echo ','; ?>
            <?php $i++; endforeach; ?>
        ],
        optgroups: [
            <?php $i = 1; foreach ($directions as $direction) : ?>
            {value: 'direction-<?php echo $direction->term_id; ?>', label: '<?php echo esc_attr($direction->name); ?>', label_scientific: ''}<?php if ($i < count($directions)) echo ','; ?>
            <?php $i++; endforeach; ?>
        ],
        optgroupField: 'class',
        labelField: 'name',
        searchField: ['name'],
        copyClassesToDropdown: true,
        render: {
            optgroup_header: function(data, escape) {
                return '<div class="optgroup-header">' + escape(data.label) + ' <span class="scientific">' + escape(data.label_scientific) + '</span></div>';
            }
        }
    });
</script>

<?php if (isset($service_id)) : ?>
    <script type="text/javascript">
        const selects = $('*').find('select.srvselect');
        for (let i = 0; i < selects.length; i++) {
            selects[i].selectize.setValue('<?php echo $service_id; ?>');
        }
    </script>
<?php endif; ?>

<script type="text/javascript">
    $(document).on('click', '.appointment-service-button', function(e) {
        e.preventDefault();
        const serviceId = $(this).attr('data-service-id');
        const serviceModal = $('.appointment-service-modal');
        const select = serviceModal.find('select.srvselect');

        if (serviceId) {
            select[0].selectize.setValue(serviceId);
        }
        serviceModal.show();
    });

    $(document).on('click', '.callback-form-button', function(e) {
        e.preventDefault();
        $('.callback-form-modal').show();
    });

    $(document).on('click', '.package-service-button', function(e) {
        e.preventDefault();
        const packageServiceName = $(this).attr('data-package-name');
        const packageServiceModal = $('.package-service-modal');
        if (packageServiceName) {
            packageServiceModal.find('input[name=package_name]').val(packageServiceName);
        }
        packageServiceModal.show();
    });

    $(document).on('click', '.review-full-text-button', function(e) {
        e.preventDefault();
        const reviewId = $(this).attr('data-review-id');
        $('#modalReviewFullText' + reviewId).show();
    });
</script>
</body>
</html>
