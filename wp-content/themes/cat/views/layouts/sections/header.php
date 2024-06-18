<header>
    <div class="container">

        <div class="left-column">
            <a href="<?php echo $locale['url']; ?>/">
                <img class="logo" src="<?= get_image_url_by_id(get_option('theme_settings__logotype')) ?>" alt="logo"></img>
            </a>
            <!--------------------------------- MENU -------------------------------------------------------------------------->
            <?php if (!empty(getTreeMenu(23))) : ?>
                <nav>
                    <ul class="menu">
                        <?php foreach (getTreeMenu(23) as $item) : ?>
                            <li class="menu__item">
                                <?php if (!empty($item->children)) : ?>
                                    <a href="<?php echo $item->url; ?>" class="menu__item__link"><?php echo $item->title ?> <i class="ic-chevron-down"></i></a>
                                <?php else : ?>
                                    <a href="<?php echo $item->url; ?>" <?php if ($item->target_blank) : ?> target="_blank" <?php endif; ?> class="menu__item__link"><?php echo $item->title ?></a>
                                <?php endif; ?>

                                <?php if (!empty($item->children)) : ?>
                                    <?php $has_custom_menu = $children_item->is_custom_menu; ?>
                                    <div class="submenu <? echo $has_custom_menu ? 'double-column' : '' ?>">
                                        <ul class="list-wrapper">
                                            <?php foreach ($item->children as $children_item) : ?>
                                                <?php if (!$children_item->is_custom_menu) : ?>
                                                    <li class="submenu__item">

                                                        <a href="<?php echo $children_item->url; ?>" <?php if ($children_item->target_blank) : ?> target="_blank" <?php endif; ?> class="sublnk"><?php echo $children_item->title; ?> <i class="ic-chevron-right">
                                                            </i>
                                                            <?php if ($children_item->description) : ?>
                                                                <p><?= $children_item->description ?></p>
                                                            <?php endif; ?>
                                                        </a>

                                                        <?php if (!empty($children_item->children)) : ?>
                                                            <ul class="sub2menu">
                                                                <?php foreach ($children_item->children as $children_children_item) : ?>
                                                                    <li class="sub2item"><a href="<?php echo $children_children_item->url; ?>" <?php if ($children_children_item->target_blank) : ?> target="_blank" <?php endif; ?> class="sub2lnk"><?php echo $children_children_item->title; ?></a></li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        <?php endif; ?>
                                                    </li>
                                                <?php else : ?>
                                                    <?php
                                                    // $has_custom_menu = true;
                                                    $custom_menu_title = $children_item->title;
                                                    $custom_menu = $children_item->children;
                                                    ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ul>

                                        <?php if ($has_custom_menu) : ?>
                                            <div class="list-wrapper custom">
                                                <div class="submenu__item">
                                                    <h4><?= $custom_menu_title ?></h4>
                                                    <?php if ($children_item->description) : ?>
                                                        <p class="item_desc"><?= $children_item->description ?></p>
                                                    <?php endif; ?>
                                                </div>
                                                <ul>
                                                    <?php foreach ($custom_menu as $children_item_custom) : ?>
                                                        <li class="submenu__item">
                                                            <a href="<?php echo $children_item_custom->url; ?>" <?php if ($children_item_custom->target_blank) : ?> target="_blank" <?php endif; ?> class="sublnk"><?php echo $children_item_custom->title; ?></a>
                                                            <?php if ($children_item->description) : ?>
                                                                <p><?= $children_item->description ?></p>
                                                            <?php endif; ?>
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
        </div>
        <!--------------------------------- END MENU ---------------------------------------------------------------------->


        <div class="actions">
            <!--------------------------------- LANG SWICHET ------------------------------------------------------------------>
            <!-- <?php if (function_exists('pll_the_languages') && function_exists('pll_current_language')) : ?>
                <div class="lang-switcher">
                    <?php $current_language = pll_current_language(); ?>
                    <div class="selected-lang">
                        <?php foreach (pll_the_languages(['raw' => 1]) as $locale) : ?>
                            <?php if ($locale['slug'] == $current_language) : ?>
                                <div class="lang">
                                    <i class="icon ic-lang"></i> <?php echo strtoupper($locale['slug']); ?>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    <div class="other-langs">
                        <?php foreach (pll_the_languages(['raw' => 1]) as $locale) : ?>
                            <?php if ($locale['slug'] != $current_language) : ?>
                                <a href="<?php echo $locale['url']; ?>" class="lang">
                                    <?php echo strtoupper($locale['slug']); ?>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?> -->

            <!--------------------------------- END LANG SWICHET -------------------------------------------------------------->
            <div class="buttons-wrapper">
                <div class="btn sm primary fill render-form-btn" data-form_id="1629">Демо версія <i class="ic-chevron-right"></i></div>
                <div class="btn sm secondary fill render-form-btn" data-form_id="1629">Реєстрація</div>
                <div class="burger-menu-trigger ic-menu"></div>
            </div>
        </div>
    </div>
</header>
<?php require_once app('path.views') . '/constructor/modals/mobile-menu.php'; ?>