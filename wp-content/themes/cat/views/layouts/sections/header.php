<header>
    <h4>header</h4>
    <!--------------------------------- MENU -------------------------------------------------------------------------->
    <?php if (!empty(getTreeMenu('main_menu'))) : ?>
        <nav>
            <ul class="menu">
                <?php foreach (getTreeMenu('main_menu') as $item) : ?>
                    <li class="menu__item">
                        <a href="<?php echo $item->url; ?>" class="header-left__menu__menu__item__lnk"><?php echo $item->title; ?></a>

                        <?php if (!empty($item->children)) : ?>
                            <ul class="menu__submenu">

                                <?php foreach ($item->children as $children_item) : ?>
                                    <li class="menu__submenuitem">
                                        <div class="menu__sublnkwrap">
                                            <a href="<?php echo $children_item->url; ?>" class="menu__sublnk"><?php echo $children_item->title; ?></a>
                                        </div>

                                        <?php if (!empty($children_item->children)) : ?>
                                            <ul class="menu__sub2menu">
                                                <?php foreach ($children_item->children as $children_children_item) : ?>
                                                    <li class="menu__sub2item"><a href="<?php echo $children_children_item->url; ?>" class="menu__sub2lnk"><?php echo $children_children_item->title; ?></a></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    <?php endif; ?>
    <!--------------------------------- END MENU ---------------------------------------------------------------------->


    <!--------------------------------- LANG SWICHET ------------------------------------------------------------------>
    <?php if (function_exists('pll_the_languages') && function_exists('pll_current_language')) : ?>
        <div class="header-right__langwrap">
            <?php foreach (pll_the_languages(['raw' => 1]) as $locale) : ?>
                <a href="<?php echo $locale['url']; ?>" class="header-right__langwrap__item<?php echo $locale['slug'] == pll_current_language() ? ' active' : ''; ?>">
                    <?php echo strtoupper($locale['slug']); ?>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <!--------------------------------- END LANG SWICHET -------------------------------------------------------------->
</header>

