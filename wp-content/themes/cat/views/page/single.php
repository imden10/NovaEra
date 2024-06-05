<div class="container">
	<ul class="breadcrumbs">
        <?php $home_page = get_post(get_option('page_on_front')); ?>
        <li class="breadcrumbs-item"><a href="<?= $page->page_information_breadcrumb_url ?? site_url() ?>" class="brdcrmb__lnk"><?= $page->page_information_breadcrumb_text ?? $home_page->post_title ?></a></li>
        <li class="breadcrumbs-item"><?= $page->post_title; ?></li>
	</ul>
</div>

<?php buildContentFromConstructorArray('hero', $page->page_information_hero); ?>

<?php buildContentFromConstructorArray('service', $page->page_information_constructor); ?>
<div class="up ic-chevron-up"></div>
<!-- <div class="cookie-popup">
	<i class="close ic-close"></i>
	<h3>Файли Cookie</h3>
	<p>Файли cookie потрібні для того, щоб персоналізувати ваше користування Порталом та зробити його приємнішим і зручнішим.</p>
	<div class="btn primary lg fill">Дозволити всі Cookie <i class="ic-check-line"></i></div>
</div> -->