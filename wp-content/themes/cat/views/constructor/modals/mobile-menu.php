<div class="mobile-menu">
	<?php if (!empty(getTreeMenu(23))) : ?>
		<nav>
			<ul class="menu">
				<?php foreach (getTreeMenu(23) as $item) : ?>
					<li class="menu__item">
						<?php if (!empty($item->children)) : ?>
							<div onclick="slideToggle(this)" class="menu__item__link"><?php echo $item->title ?> <i class="ic-chevron-down"></i></div>
						<?php else : ?>
							<a href="<?php echo $item->url; ?>" class="menu__item__link"><?php echo $item->title ?></a>
						<?php endif; ?>
						<?php if (!empty($item->children)) : ?>
							<?php $has_custom_menu = false; ?>
							<div class="submenu" hidden>
								<ul class="list-wrapper">
									<?php foreach ($item->children as $children_item) : ?>
										<?php if (!$children_item->is_custom_menu) : ?>
											<li class="submenu__item">

												<a href="<?php echo $children_item->url; ?>" class="submenu__item__link"><?php echo $children_item->title; ?></a>

												<?php if (!empty($children_item->children)) : ?>
													<ul class="sub2menu">
														<?php foreach ($children_item->children as $children_children_item) : ?>
															<li class="sub2item"><a href="<?php echo $children_children_item->url; ?>" class="sub2lnk"><?php echo $children_children_item->title; ?></a></li>
														<?php endforeach; ?>
													</ul>
												<?php endif; ?>
											</li>
										<?php else : ?>
											<?php
											$has_custom_menu = true;
											$custom_menu_title = $children_item->title;
											$custom_menu = $children_item->children;
											?>
										<?php endif; ?>
									<?php endforeach; ?>
								</ul>

								<?php if ($has_custom_menu) : ?>
									<div class="list-wrapper custom">
										<h4><?= $custom_menu_title ?></h4>
										<ul>
											<?php foreach ($custom_menu as $children_item_custom) : ?>
												<li class="submenu__item">
													<a href="<?php echo $children_item_custom->url; ?>" class="submenu__item__link"><?php echo $children_item_custom->title; ?></a>
												</li>
											<?php endforeach; ?>
										</ul>
									</div>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</nav>
	<?php endif; ?>
	<div class="mobile-menu-footer">
		<?php if (function_exists('pll_the_languages') && function_exists('pll_current_language')) : ?>
			<!-- <div class="lang-switcher">
            <?php foreach (pll_the_languages(['raw' => 1]) as $locale) : ?>
                <a href="<?php echo $locale['url']; ?>" class="lang<?php echo $locale['slug'] == pll_current_language() ? ' active' : ''; ?>">
                    <?php echo strtoupper($locale['slug']); ?>
                </a>
            <?php endforeach; ?>
        </div> -->
		<?php endif; ?>

		<div class="buttons-wrapper">
			<div class="btn sm primary fill render-form-btn" data-form_id="1629">Демо версія <i class="ic-chevron-right"></i></div>
			<div class="btn sm secondary fill render-form-btn" data-form_id="1629">Реєстрація</div>
		</div>
	</div>
</div>