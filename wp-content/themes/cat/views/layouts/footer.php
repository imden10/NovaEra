<?php require_once app('path.views') . '/layouts/sections/footer.php'; ?>

<?php require_once app('path.views') . '/layouts/sections/modals.php'; ?>

<?php wp_footer(); ?>

<!-- HelpCrunch start -->
<script type="text/javascript">
  window.helpcrunchSettings = {
    organization: 'bookkeeper',
    appId: 'a7b70983-63d4-4987-8a3b-ce79c1b4fe24',
  };
</script>

<script type="text/javascript">
  (function(w,d){var hS=w.helpcrunchSettings;if(!hS||!hS.organization){return;}var widgetSrc='https://embed.helpcrunch.com/sdk.js';w.HelpCrunch=function(){w.HelpCrunch.q.push(arguments)};w.HelpCrunch.q=[];function r(){if (d.querySelector('script[src="' + widgetSrc + '"')) { return; }var s=d.createElement('script');s.async=1;s.type='text/javascript';s.src=widgetSrc;(d.body||d.head).appendChild(s);}if(d.readyState === 'complete'||hS.loadImmediately){r();} else if(w.attachEvent){w.attachEvent('onload',r)}else{w.addEventListener('load',r,false)}})(window, document)
</script>
<!-- HelpCrunch end -->
</body>
</html>
