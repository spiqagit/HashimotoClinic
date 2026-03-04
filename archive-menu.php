
<?php get_header('meta'); ?>
<?php wp_head(); ?>
</head>

<body class="">
    <?php get_header(); ?>

    <main class="bl_commonlowerPage">
        <div class="bl_commonlowerPage_inner">

            <?php
            // ページヘッダー
            ?>
            <div class="bl_commonlowerPage_ttlContainer">
                <hgroup class="bl_commonlowerPage_ttl">
                    <p class="bl_commonlowerPage_ttl_enTtl">Menu</p>
                    <h1 class="bl_commonlowerPage_ttl_jaTtl">施術メニュー</h1>
                </hgroup>
                <?php get_template_part('inc/breadcrumbs'); ?>
            </div>


            <div class="bl_commonlowerPage_contents">
                <?php
                $partsParentCats = get_terms('parts-cat', array(
                    'orderby' => 'term_id',
                    'order' => 'menu_order',
                    'hide_empty' => true,
                    'parent' => 0,
                ));
                ?>

                <?php
                $menu_post_ids = get_posts(array(
                    'post_type'      => 'menu',
                    'posts_per_page' => -1,
                    'fields'         => 'ids',
                ));
                $menu_categories = array();
                if (!empty($menu_post_ids)) {
                    $menu_categories = get_terms(array(
                        'taxonomy'   => 'menu-cat',
                        'hide_empty' => false,
                        'object_ids' => $menu_post_ids,
                    ));
                    if (is_wp_error($menu_categories)) {
                        $menu_categories = array();
                    }
                }

                $menuParentCatList = get_terms('menu-cat', array(
                    'orderby' => 'term_id',
                    'order' => 'menu_order',
                    'hide_empty' => true,
                    'parent' => 0,
                    'object_ids' => $menu_post_ids,
                ));
                ?>

                <div class="bl_menuArchiveContainer">
                    <div class="bl_menuArchiveContainer_inner">

                        <div class="bl_commonDownBtnContainer">
                            <?php if (!empty($partsParentCats)): ?>
                                <a href="#parts-cat" class="bl_commonDownBtnContainer_item">
                                    <span>気になる部位から探す</span>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/down-arrow.svg" alt="">
                                </a>
                            <?php endif; ?>
                            <?php if (!empty($menuParentCatList)): ?>
                                <a href="#menu-cat" class="bl_commonDownBtnContainer_item">
                                    <span>カテゴリから探す</span>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/down-arrow.svg" alt="">
                                </a>
                            <?php endif; ?>
                        </div>


                        <?php if (!empty($partsParentCats)): ?>
                            <div class="bl_menuPartsCatContainer" id="parts-cat">
                                <h2 class="el_menuPartsCatContainer_ttl">気になる部位から探す</h2>


                                <div class="bl_menuPartsCatContainer_btnContainer">
                                    <?php
                                    $i = 0;
                                    foreach ($partsParentCats as $partsParentCat): ?>
                                        <?php if ($i == 0): ?>
                                            <button type="button" class="el_menuPartsCatContainer_btn is_active" id="cat-<?php echo $partsParentCat->term_id; ?>"><?php echo $partsParentCat->name; ?></button>
                                        <?php else: ?>
                                            <button type="button" class="el_menuPartsCatContainer_btn " id="cat-<?php echo $partsParentCat->term_id; ?>"><?php echo $partsParentCat->name; ?></button>
                                        <?php endif; ?>
                                    <?php $i++;
                                    endforeach; ?>
                                </div>

                                <div class="bl_menuPartsCatContainer_tabContents">

                                    <?php
                                    $j = 0;
                                    foreach ($partsParentCats as $partsParentCat): ?>
                                        <?php if ($j == 0) {
                                            $isActive = 'is_active';
                                        } else {
                                            $isActive = '';
                                        } ?>

                                        <div class="bl_menuPartsCatContainer_tabContents_item <?php echo $isActive; ?>" data-id="cat-<?php echo $partsParentCat->term_id; ?>">
                                            <div class="bl_menuPartsCatContainer_tabContents_item_inner">
                                                <?
                                                $partsChildCats = get_terms('parts-cat', array(
                                                    'orderby' => 'term_id',
                                                    'order' => 'menu_order',
                                                    'hide_empty' => true,
                                                    'parent' => $partsParentCat->term_id,
                                                ));
                                                ?>
                                                <?php if (!empty($partsChildCats)): ?>
                                                    <?php foreach ($partsChildCats as $partsChildCat): ?>
                                                        <details class="bl_menuPartChildDetails js-details">
                                                            <summary class="bl_menuPartChildDetails_summary is-summary">
                                                                <span class="bl_menuPartChildDetails_summary_nameWrapper">
                                                                    <?php if (get_field('parts-cat-icon', "term_" . $partsChildCat->term_id)): ?>
                                                                        <span class="el_menuPartChildDetails_summary_nameWrapper_iconWrapper">
                                                                            <img class="el_menuPartChildDetails_summary_nameWrapper_icon" src="<?php echo get_field('parts-cat-icon', "term_" . $partsChildCat->term_id); ?>" alt="<?php echo $partsChildCat->name; ?>">
                                                                        </span>
                                                                    <?php endif; ?>
                                                                    <span class="el_menuPartChildDetails_summary_nameWrapper_name"><?php echo $partsChildCat->name; ?></span>
                                                                </span>

                                                                <img class="el_menuPartChildDetails_summary_icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/lang-arrow.svg" alt="">
                                                            </summary>

                                                            <div class="bl_menuPartChildDetails_contents is-details-content">
                                                                <div class="bl_menuPartChildDetails_contents_inner">
                                                                    <?php

                                                                    $partsCatPosts = get_posts(array(
                                                                        'post_type' => 'menu',
                                                                        'posts_per_page' => -1,
                                                                        'fields' => 'ids',
                                                                        'tax_query' => array(
                                                                            array(
                                                                                'taxonomy' => 'parts-cat',
                                                                                'terms' => $partsChildCat->term_id,
                                                                            ),
                                                                        ),
                                                                    ));
                                                                    ?>
                                                                    <?php if (!empty($partsCatPosts)): ?>
                                                                        <?php foreach ($partsCatPosts as $partsCatPost): ?>
                                                                            <a href="<?php echo get_the_permalink($partsCatPost); ?>" class="bl_menuPartChildDetails_contents_link">
                                                                                <p><?php echo get_the_title($partsCatPost); ?></p>
                                                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/close-arrow.svg" alt="">
                                                                            </a>
                                                                        <?php endforeach; ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </details>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php $j++;
                                    endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>


                        <?php if (!empty($menuParentCatList)): ?>
                            <div class="bl_menuCatContainer" id="menu-cat">
                                <h2 class="el_menuCatContainer_ttl">カテゴリから探す</h2>

                                <div class="bl_menuCatContainer_contentsWrapper">
                                    <?php foreach ($menuParentCatList as $menuParentCat): ?>
                                        <?php
                                        $childrenMenuCategories = get_terms(array(
                                            'taxonomy'   => 'menu-cat',
                                            'hide_empty' => true,
                                            'object_ids' => $menu_post_ids,
                                            'parent' => $menuParentCat->term_id,
                                        ));
                                        ?>
                                        <?php if ($childrenMenuCategories): ?>
                                            <div class="bl_menuCatContainer_parentItem">
                                                <h3 class="el_menuCatContainer_catTtl"><?php echo $menuParentCat->name; ?></h3>

                                                <div class="bl_menuCatContainer_parentItem_childList">
                                                    <?php foreach ($childrenMenuCategories as $childrenMenuCategory): ?>

                                                        <details class="bl_menuPartChildDetails js-details">
                                                            <summary class="bl_menuPartChildDetails_summary is-summary">
                                                                <span class="bl_menuPartChildDetails_summary_nameWrapper">
                                                                    <?php if (get_field('parts-cat-icon', "term_" . $childrenMenuCategory->term_id)): ?>
                                                                        <span class="el_menuPartChildDetails_summary_nameWrapper_iconWrapper">
                                                                            <img class="el_menuPartChildDetails_summary_nameWrapper_icon" src="<?php the_field('parts-cat-icon', "term_" . $childrenMenuCategory->term_id); ?>" alt="<?php echo $childrenMenuCategory->name; ?>">
                                                                        </span>
                                                                    <?php endif; ?>
                                                                    <span class="el_menuPartChildDetails_summary_nameWrapper_name"><?php echo $childrenMenuCategory->name; ?></span>
                                                                </span>

                                                                <img class="el_menuPartChildDetails_summary_icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/lang-arrow.svg" alt="">
                                                            </summary>

                                                            <div class="bl_menuPartChildDetails_contents is-details-content">
                                                                <div class="bl_menuPartChildDetails_contents_inner">
                                                                    <?php

                                                                    $childrenMenuPosts = get_posts(array(
                                                                        'post_type' => 'menu',
                                                                        'posts_per_page' => -1,
                                                                        'fields' => 'ids',
                                                                        'tax_query' => array(
                                                                            array(
                                                                                'taxonomy' => 'menu-cat',
                                                                                'terms' => $childrenMenuCategory->term_id,
                                                                            ),
                                                                        ),
                                                                    ));
                                                                    ?>
                                                                    <?php if (!empty($partsCatPosts)): ?>
                                                                        <?php foreach ($partsCatPosts as $partsCatPost): ?>
                                                                            <a href="<?php echo get_the_permalink($partsCatPost); ?>" class="bl_menuPartChildDetails_contents_link">
                                                                                <p><?php echo get_the_title($partsCatPost); ?></p>
                                                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/close-arrow.svg" alt="">
                                                                            </a>
                                                                        <?php endforeach; ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </details>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>


                                    <div class="bl_menuCatContainer_lowerContainer">
                                        <?php foreach ($menuParentCatList as $menuParentCat): ?>
                                            <?php
                                            $childrenMenuCategories = get_terms(array(
                                                'taxonomy'   => 'menu-cat',
                                                'hide_empty' => true,
                                                'object_ids' => $menu_post_ids,
                                                'parent' => $menuParentCat->term_id,
                                            ));
                                            ?>
                                            <?php if (empty($childrenMenuCategories)): ?>
                                                <div class="bl_menuCatContainer_lowerItem">
                                                    <h3 class="el_menuCatContainer_catTtl"><?php echo $menuParentCat->name; ?></h3>

                                                    <div class="bl_menuCatContainer_lowerItem_postList">
                                                        <?php
                                                        $menuPosts = get_posts(array(
                                                            'post_type' => 'menu',
                                                            'posts_per_page' => -1,
                                                            'fields' => 'ids',
                                                            'tax_query' => array(
                                                                array(
                                                                    'taxonomy' => 'menu-cat',
                                                                    'terms' => $menuParentCat->term_id,
                                                                ),
                                                            ),
                                                        ));
                                                        ?>
                                                        <?php if (!empty($menuPosts)): ?>
                                                            <?php foreach ($menuPosts as $menuPost): ?>
                                                                <a href="<?php echo get_the_permalink($menuPost); ?>" class="bl_menuCatContainer_lowerItem_postList_item">
                                                                    <p><?php echo get_the_title($menuPost); ?></p>
                                                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/close-arrow.svg" alt="">
                                                                </a>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>

                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php get_footer(); ?>
</body>

</html>