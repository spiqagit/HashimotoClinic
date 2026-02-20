<?php get_header('meta'); ?>
<?php wp_head(); ?>
</head>

<body class="pg_top">
    <?php get_header(); ?>


    <main class="bl_commonFrontPage">

        <?php if (have_rows('fvslide', 'option')): ?>
            <div class="bl_fvSlideSwiperContainer">
                <div class="swiper bl_fvSlideSwiper">
                    <div class="swiper-wrapper">
                        <?php while (have_rows('fvslide', 'option')): the_row(); ?>

                            <div class="swiper-slide">
                                <?php if (get_sub_field('fvslide-url')): ?>
                                    <a href="<?php the_sub_field('fvslide-url'); ?>" class="bl_fvSlideSwiper_item bl_fvSlideSwiper_link">
                                        <img src="<?php the_sub_field('fvslide-img'); ?>" alt="<?php the_sub_field('tifvslide-alttle'); ?>">
                                    </a>
                                <?php else: ?>
                                    <div class="bl_fvSlideSwiper_item">
                                        <img src="<?php the_sub_field('fvslide-img'); ?>" alt="<?php the_sub_field('tifvslide-alttle'); ?>">
                                    </div>
                                <?php endif; ?>
                            </div>

                        <?php endwhile; ?>
                    </div>
                    <div class="bl_fvSlideSwiper_btnContainer">
                        <button class="bl_fvSlideSwiper_prev" type="button">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow-prev.svg" alt="prev">
                        </button>
                        <button class="bl_fvSlideSwiper_next" type="button">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow-next.svg" alt="next">
                        </button>
                    </div>

                    <div class="bl_fvSlideSwiper_pageNationContainer">
                        <button class="bl_fvSlideSwiper_playBtn" type="button"></button>
                        <div class="bl_fvSlideSwiper_pagination"></div>
                    </div>


                </div>
            </div>
        <?php endif; ?>


        <?php if (have_rows('pickup-list', 'option')): ?>
            <section class="bl_frontPickupSection">
                <div class="bl_frontPickupSection_inner">

                    <hgroup class="bl_frontPageTtlContainer">
                        <p class="bl_frontPageTtlContainer_enTtl">
                            <span>(</span>
                            <span>Pickup</span>
                            <span>)</span>
                        </p>
                        <h2 class="bl_frontPageTtlContainer_jaTtl">おすすめメニュー</h2>
                    </hgroup>

                    <div class="bl_frontPickupSection_contents">
                        <?php while (have_rows('pickup-list', 'option')): the_row(); ?>

                            <?php if (get_sub_field('pickup-menu')): ?>
                                <?php foreach (get_sub_field('pickup-menu') as $menu): ?>
                                    <a href="<?php echo get_the_permalink($menu); ?>" class="bl_frontPickupSection_item">
                                        <img src="<?php the_sub_field('pickup-banner'); ?>" alt="<?php the_sub_field('pickup-banner-alt'); ?>">
                                    </a>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        <?php endwhile; ?>
                    </div>

                </div>
            </section>
        <?php endif; ?>


        <section class="bl_frontMenuSection">
            <div class="bl_frontMenuSection_inner">
                <hgroup class="bl_frontPageTtlContainer">
                    <p class="bl_frontPageTtlContainer_enTtl">
                        <span>(</span>
                        <span>Menu</span>
                        <span>)</span>
                    </p>
                    <h2 class="bl_frontPageTtlContainer_jaTtl">施術メニュー</h2>
                </hgroup>

                <div class="bl_menuPartsCatContainer">
                    <h3 class="el_menuPartsCatContainer_ttl">気になる部位から探す</h3>

                    <?php
                    $partsParentCats = get_terms('parts-cat', array(
                        'orderby' => 'term_id',
                        'order' => 'menu_order',
                        'hide_empty' => true,
                        'parent' => 0,
                    ));
                    ?>
                    <?php if (!empty($partsParentCats)): ?>
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
                    <?php endif; ?>

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
                                                        <?php if (get_field('parts-cat-icon', $partsChildCat)): ?>
                                                            <span class="el_menuPartChildDetails_summary_nameWrapper_iconWrapper">
                                                                <img class="el_menuPartChildDetails_summary_nameWrapper_icon" src="<?php the_field('parts-cat-icon', $partsChildCat); ?>" alt="<?php echo $partsChildCat->name; ?>">
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

                <div class="bl_frontMenuSection_allBtnContainer">
                    <div class="bl_commonAllBtnContainer">
                        <a href="<?php echo home_url(); ?>/service/" class="bl_commonAllBtn">
                            <p class="bl_commonAllBtn_txt">施術一覧はこちら</p>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow.svg" alt="">
                        </a>
                    </div>
                    <div class="bl_commonAllBtnContainer">
                        <a href="<?php echo home_url(); ?>/payment/" class="bl_commonAllBtn">
                            <p class="bl_commonAllBtn_txt">料金表はこちら</p>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow.svg" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </section>


        <section class="bl_frontCaseSection">
            <div class="bl_frontCaseSection_inner">
                <hgroup class="bl_frontPageTtlContainer">
                    <p class="bl_frontPageTtlContainer_enTtl">
                        <span>(</span>
                        <span>Case</span>
                        <span>)</span>
                    </p>
                    <h2 class="bl_frontPageTtlContainer_jaTtl">症例</h2>
                </hgroup>

                <?php
                $relatedCasePosts = get_posts(array(
                    'post_type' => 'case',
                    'posts_per_page' => -1,
                    'orderby' => 'date',
                    'order' => 'DESC',
                ));
                ?>
                <?php if (!empty($relatedCasePosts)): ?>
                    <div class="bl_topCaseSwiperContainer">
                        <div class="swiper bl_topCaseSwiper">
                            <div class="swiper-wrapper">
                                <?php foreach ($relatedCasePosts as $relatedCasePost): ?>
                                    <div class="swiper-slide">

                                        <article class="bl_commonCaseCard">
                                            <a href="<?php the_permalink($relatedCasePost->ID); ?>" class="bl_commonCaseCard_link">
                                                <?php if (have_rows('slide', $relatedCasePost->ID)): ?>
                                                    <?php while (have_rows('slide', $relatedCasePost->ID)): the_row(); ?>
                                                        <img class="el_commonCaseCard_img" src="<?php the_sub_field('img'); ?>" alt="<?php the_title($relatedCasePost->ID); ?>">
                                                    <?php endwhile; ?>
                                                <?php endif; ?>

                                                <?php
                                                $menuSelect = get_field('menu_select', $relatedCasePost->ID);
                                                ?>
                                                <?php if ($menuSelect): ?>
                                                    <div class="bl_commonCaseCard_tagList">
                                                        <?php foreach ($menuSelect as $menuSelectPost): ?>
                                                            <h1 class="el_commonCaseCard_tagList_item"><?php echo get_the_title($menuSelectPost); ?></h1>
                                                        <?php endforeach; ?>
                                                    </div>
                                                <?php endif; ?>

                                                <p class="el_commonCaseCard_ttl"><?php echo get_the_title($relatedCasePost->ID); ?></p>
                                            </a>
                                            <button>
                                                <span>詳細を見る</span>
                                                <span></span>
                                            </button>

                                            <div>
                                                <div>
                                                    <?php if (get_field('case-menu', $relatedCasePost->ID)): ?>
                                                        <dl>
                                                            <dt>施術名</dt>
                                                            <dd><?php echo get_field('case-menu', $relatedCasePost->ID); ?></dd>
                                                        </dl>
                                                    <?php endif; ?>

                                                    <?php if (get_field('case-price', $relatedCasePost->ID)): ?>
                                                        <dl>
                                                            <dt>施術参考料金</dt>
                                                            <dd>
                                                                <?php echo get_field('case-price', $relatedCasePost->ID); ?>
                                                                <?php if (get_field('case-price_sub', $relatedCasePost->ID)): ?>
                                                                    <span><?php echo get_field('case-price_sub', $relatedCasePost->ID); ?></span>
                                                                <?php endif; ?>
                                                            </dd>
                                                        </dl>
                                                    <?php endif; ?>

                                                    <?php if (get_field('case-time', $relatedCasePost->ID)): ?>
                                                        <dl>
                                                            <dt>施術時間</dt>
                                                            <dd><?php echo get_field('case-time', $relatedCasePost->ID); ?></dd>
                                                        </dl>
                                                    <?php endif; ?>

                                                    <?php if (get_field('case-downtime', $relatedCasePost->ID)): ?>
                                                        <dl>
                                                            <dt>ダウンタイム</dt>
                                                            <dd><?php echo get_field('case-downtime', $relatedCasePost->ID); ?></dd>
                                                        </dl>
                                                    <?php endif; ?>

                                                    <?php if (get_field('case-makeup', $relatedCasePost->ID)): ?>
                                                        <dl>
                                                            <dt>メイク</dt>
                                                            <dd><?php echo get_field('case-makeup', $relatedCasePost->ID); ?></dd>
                                                        </dl>
                                                    <?php endif; ?>

                                                    <?php if (get_field('case-risk', $relatedCasePost->ID)): ?>
                                                        <dl>
                                                            <dt>リスク</dt>
                                                            <dd>
                                                                <?php echo get_field('case-risk', $relatedCasePost->ID); ?>
                                                                <?php if (get_field('case-risk_sub', $relatedCasePost->ID)): ?>
                                                                    <span><?php echo get_field('case-risk_sub', $relatedCasePost->ID); ?></span>
                                                                <?php endif; ?>
                                                            </dd>
                                                        </dl>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </article>

                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <div class="swiper-pagination"></div>

                            <div class="bl_topCaseSwiper_btnContainer">
                                <button class="bl_topCaseSwiper_prev">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow-prev.svg" alt="prev">
                                </button>
                                <button class="bl_topCaseSwiper_next">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow-next.svg" alt="next">
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="bl_commonAllBtnContainer">
                    <a href="<?php echo home_url(); ?>/case/" class="bl_commonAllBtn">
                        <p class="bl_commonAllBtn_txt">症例一覧はこちら</p>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow.svg" alt="">
                    </a>
                </div>
            </div>
        </section>
    </main>
    <?php get_footer(); ?>
</body>

</html>