<div class="container">
	<ul class="breadcrumbs">
		<?php $home_page = get_post(get_option('page_on_front')); ?>
		<li class="breadcrumbs-item"><a href="<?php echo site_url(); ?>" class="brdcrmb__lnk"><?php echo $home_page->post_title; ?></a></li>

		<li class="breadcrumbs-item"><?php echo !empty($page->page_information_breadcrumb) ? $page->page_information_breadcrumb : $page->post_title; ?></li>
	</ul>
</div>

<?php buildContentFromConstructorArray('hero', $page->page_information_hero); ?>

<?php buildContentFromConstructorArray('service', $page->page_information_constructor); ?>