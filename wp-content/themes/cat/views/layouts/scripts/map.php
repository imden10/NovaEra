<script type="text/javascript">
    function initFrontMap() {
        var map;
        var addr = {lat: <?php echo getCustomOption('map_data_lat'); ?>, lng: <?php echo getCustomOption('map_data_lng'); ?>};

        map = new google.maps.Map(document.getElementById('gmap1'), {
            center: addr,
            zoom: 16
        });

        var marker = new google.maps.Marker({
            position: addr,
            map: map,
            icon:'<?php echo appConfig('theme_url'); ?>/img/Pin.svg'
        });
    }
</script>

<script src="//maps.googleapis.com/maps/api/js?key=<?php echo getCustomOption('map_data_api_key'); ?>&amp;callback=initFrontMap" async="" defer=""></script>
