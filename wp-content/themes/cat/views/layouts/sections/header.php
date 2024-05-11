<!-- todo @Examp1 - Стилі для прикладу просто -->
<style>
    /* Основний стиль для головного меню */
    .menu {
        list-style: none;
        padding: 0;
        margin: 30px;
        display: flex;
        border: 1px solid #ccc;;
    }

    .menu__item {
        position: relative;
        border-right: 1px solid #ccc;
        padding: 10px 15px;
        cursor: pointer;
    }

    .menu__item:hover .menu__submenu {
        display: flex;
        gap: 30px;
    }

    .menu__item a {
        text-decoration: none;
        color: #333;
        transition: color 0.3s ease;
    }

    .menu__item:hover a {
        color: #007bff;
    }

    /* Стиль для підменю першого рівня */
    .menu__submenu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        border: 1px solid #ccc;
        border-top: none;
        padding: 10px 0;
    }

    .menu__submenu ul {
        display: block;
    }

    .menu__submenu ul li {
        display: block;
    }

    .menu__submenuitem {
        position: relative;
    }

    .menu__submenuitem:hover .menu__sublnkwrap {
        background-color: #f4f4f4;
    }

    .menu__submenuitem a {
        display: block;
        padding: 10px 15px;
        text-decoration: none;
        color: #333;
        transition: background-color 0.3s ease;
    }

    /* Стиль для підменю другого рівня */
    .menu__sub2menu {
        display: none;
        position: absolute;
        top: 0;
        left: 100%;
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        border: 1px solid #ccc;
        border-left: none;
        padding: 10px 0;
    }

    .menu__submenuitem:hover .menu__sub2menu {
        display: block;
    }

    .menu__sub2item:hover {
        background-color: #f4f4f4;
    }

    .menu__sub2item a {
        display: block;
        padding: 10px 15px;
        text-decoration: none;
        color: #333;
        transition: background-color 0.3s ease;
    }

</style>

<header>
    <!--------------------------------- MENU -------------------------------------------------------------------------->
    <?php if (!empty(getTreeMenu('main_menu'))) : ?>
        <nav>
            <ul class="menu">
                <?php foreach (getTreeMenu('main_menu') as $item) : ?>
                    <li class="menu__item">
                        <a href="<?php echo $item->url; ?>" class="header-left__menu__menu__item__lnk"><?php echo $item->title . ' - ' . $item->is_custom_menu; ?></a>

                        <?php if (!empty($item->children)) : ?>
                        <?php $has_custom_menu = false; ?>
                        <div class="menu__submenu">
                            <ul>
                                <?php foreach ($item->children as $children_item) : ?>
                                    <?php if(!$children_item->is_custom_menu):?>
                                    <li class="menu__submenuitem">
                                        <div class="menu__sublnkwrap">
                                            <a href="<?php echo $children_item->url; ?>" class="menu__sublnk"><?php echo $children_item->title; ?></a>

                                            <?php if($children_item->description):?>
                                                <p><?=$children_item->description?></p>
                                            <?php endif;?>
                                        </div>

                                        <?php if (!empty($children_item->children)) : ?>
                                            <ul class="menu__sub2menu">
                                                <?php foreach ($children_item->children as $children_children_item) : ?>
                                                    <li class="menu__sub2item"><a href="<?php echo $children_children_item->url; ?>" class="menu__sub2lnk"><?php echo $children_children_item->title; ?></a></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?>
                                    </li>
                                    <?php else:?>
                                        <?php
                                            $has_custom_menu = true;
                                            $custom_menu_title = $children_item->title;
                                            $custom_menu = $children_item->children;
                                        ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>

                            <?php if($has_custom_menu):?>
                            <div class="custom_menu_container">
                                <h4><?= $custom_menu_title ?></h4>
                                <ul>
                                    <?php foreach ($custom_menu as $children_item_custom) : ?>
                                        <li class="menu__submenuitem">
                                            <div class="menu__sublnkwrap">
                                                <a href="<?php echo $children_item_custom->url; ?>" class="menu__sublnk"><?php echo $children_item_custom->title; ?></a>
                                            </div>
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

