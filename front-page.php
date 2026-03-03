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
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow-prev.svg" alt="">
                        </button>
                        <button class="bl_fvSlideSwiper_next" type="button">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow-next.svg" alt="">
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

                    <?php
                    $selectMenuPost = get_field('select-menupost', 'option');
                    ?>
                    <?php if ($selectMenuPost): ?>
                        <div class="bl_frontMenuSection_selectMenuPostContainer">
                            <?php foreach ($selectMenuPost as $selectMenuPostItem): ?>
                                <a href="<?php echo get_the_permalink($selectMenuPostItem); ?>" class="bl_frontMenuSection_selectMenuPostItem">
                                    <p class="el_frontMenuSection_selectMenuPostItem_ttl"><?php echo get_the_title($selectMenuPostItem); ?></p>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/pagination-next.svg" alt="">
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
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
                    'posts_per_page' => 20,
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
                                                <div class="bl_commonCaseCard_imgWrapper">
                                                    <?php 
                                                    $i = 0;
                                                    if (have_rows('slide', $relatedCasePost->ID)): ?>
                                                        <?php while (have_rows('slide', $relatedCasePost->ID)): the_row(); ?>
                                                            <?php if ($i == 0): ?>
                                                                <img class="el_commonCaseCard_img" src="<?php the_sub_field('img'); ?>" alt="<?php the_title($relatedCasePost->ID); ?>">
                                                            <?php endif; ?>
                                                            <?php $i++; ?>
                                                        <?php endwhile; ?>
                                                    <?php endif; ?>
                                                </div>

                                                <div class="bl_commonCaseCard_ttlWrapper">
                                                    <?php
                                                    $menuSelect = get_field('menu_select', $relatedCasePost->ID);
                                                    ?>
                                                    <?php if ($menuSelect): ?>
                                                        <div class="bl_commonCaseCard_tagList">
                                                            <?php foreach ($menuSelect as $menuSelectPost): ?>
                                                                <h3 class="el_commonCaseCard_tagList_item"><?php echo get_the_title($menuSelectPost); ?></h3>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    <p class="el_commonCaseCard_ttl"><?php echo get_the_title($relatedCasePost->ID); ?></p>
                                                </div>


                                                <div class="bl_commonCaseCard_infoWrapper">
                                                    <?php if (get_field('case-menu', $relatedCasePost->ID)): ?>
                                                        <dl class="bl_commonCaseCard_infoWrapper_item">
                                                            <dt class="el_commonCaseCard_infoWrapper_item_dt">施術名</dt>
                                                            <dd class="el_commonCaseCard_infoWrapper_item_dd"><?php echo get_field('case-menu', $relatedCasePost->ID); ?></dd>
                                                        </dl>
                                                    <?php endif; ?>

                                                    <?php if (get_field('case-price', $relatedCasePost->ID)): ?>
                                                        <dl class="bl_commonCaseCard_infoWrapper_item">
                                                            <dt class="el_commonCaseCard_infoWrapper_item_dt">施術参考料金</dt>
                                                            <dd class="el_commonCaseCard_infoWrapper_item_dd">
                                                                <?php echo get_field('case-price', $relatedCasePost->ID); ?>
                                                                <?php if (get_field('case-price_sub', $relatedCasePost->ID)): ?>
                                                                    <span class="el_commonCaseCard_infoWrapper_item_dd_sub"><?php echo get_field('case-price_sub', $relatedCasePost->ID); ?></span>
                                                                <?php endif; ?>
                                                            </dd>
                                                        </dl>
                                                    <?php endif; ?>

                                                    <?php if (get_field('case-time', $relatedCasePost->ID)): ?>
                                                        <dl class="bl_commonCaseCard_infoWrapper_item">
                                                            <dt class="el_commonCaseCard_infoWrapper_item_dt">所要時間</dt>
                                                            <dd class="el_commonCaseCard_infoWrapper_item_dd"><?php echo get_field('case-time', $relatedCasePost->ID); ?></dd>
                                                        </dl>
                                                    <?php endif; ?>

                                                    <?php if (get_field('case-period', $relatedCasePost->ID)): ?>
                                                        <dl class="bl_commonCaseCard_infoWrapper_item">
                                                            <dt class="el_commonCaseCard_infoWrapper_item_dt">治療期間</dt>
                                                            <dd class="el_commonCaseCard_infoWrapper_item_dd"><?php echo get_field('case-period', $relatedCasePost->ID); ?></dd>
                                                        </dl>
                                                    <?php endif; ?>

                                                    <?php if (get_field('case-num-times', $relatedCasePost->ID)): ?>
                                                        <dl class="bl_commonCaseCard_infoWrapper_item">
                                                            <dt class="el_commonCaseCard_infoWrapper_item_dt">治療回数</dt>
                                                            <dd class="el_commonCaseCard_infoWrapper_item_dd"><?php echo get_field('case-num-times', $relatedCasePost->ID); ?></dd>
                                                        </dl>
                                                    <?php endif; ?>

                                                    <?php if (get_field('case-downtime', $relatedCasePost->ID)): ?>
                                                        <dl class="bl_commonCaseCard_infoWrapper_item">
                                                            <dt class="el_commonCaseCard_infoWrapper_item_dt">ダウンタイム</dt>
                                                            <dd class="el_commonCaseCard_infoWrapper_item_dd"><?php echo get_field('case-downtime', $relatedCasePost->ID); ?></dd>
                                                        </dl>
                                                    <?php endif; ?>

                                                    <?php if (get_field('case-risk', $relatedCasePost->ID)): ?>
                                                        <dl class="bl_commonCaseCard_infoWrapper_item">
                                                            <dt class="el_commonCaseCard_infoWrapper_item_dt">副作用・リスク</dt>
                                                            <dd class="el_commonCaseCard_infoWrapper_item_dd">
                                                                <?php echo get_field('case-risk', $relatedCasePost->ID); ?>
                                                                <?php if (get_field('case-risk_sub', $relatedCasePost->ID)): ?>
                                                                    <span><?php echo get_field('case-risk_sub', $relatedCasePost->ID); ?></span>
                                                                <?php endif; ?>
                                                            </dd>
                                                        </dl>
                                                    <?php endif; ?>
                                                </div>
                                            </a>

                                        </article>

                                    </div>
                                <?php endforeach; ?>
                            </div>

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

        <section class="bl_frontDoctorSection">
            <div class="bl_frontDoctorSection_inner">
                <hgroup class="bl_frontPageTtlContainer">
                    <p class="bl_frontPageTtlContainer_enTtl">
                        <span>(</span>
                        <span>Doctor</span>
                        <span>)</span>
                    </p>
                    <h2 class="bl_frontPageTtlContainer_jaTtl">ドクター紹介</h2>
                </hgroup>

                <?php
                $relatedDoctorPosts = get_posts(array(
                    'post_type' => 'doctor',
                    'posts_per_page' => 1,
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'job-cat',
                            'terms' => 1,
                            'operator' => 'IN',
                            'field' => 'slug',
                            'terms' => 'director',
                        ),
                    ),
                ));
                ?>

                <?php if (!empty($relatedDoctorPosts)): ?>
                    <div class="bl_doctorContainer">
                        <?php foreach ($relatedDoctorPosts as $relatedDoctorPost): ?>

                            <div class="bl_doctorContainer_upperContainer">

                                <div class="bl_doctorUpperContainer_imgWrapper">
                                    <?php if (get_the_post_thumbnail($relatedDoctorPost->ID)): ?>
                                        <img class="el_doctorUpperContainer_imgWrapper_img" src="<?php echo get_the_post_thumbnail_url($relatedDoctorPost->ID); ?>" alt="<?php echo get_the_title($relatedDoctorPost->ID); ?>">
                                    <?php else: ?>
                                        <img class="el_doctorUpperContainer_imgWrapper_img" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/noimage-doc.jpg" alt="Noimage">
                                    <?php endif; ?>
                                </div>

                                <div class="bl_doctorUpperContainer_rightWrapper">
                                    <div class="bl_doctorUpperContainer_nameContainer">
                                        <p class="el_doctorUpperContainer_nameContainer_job"><?php echo get_the_terms($relatedDoctorPost->ID, 'job-cat')[0]->name; ?></p>
                                        <div class="bl_doctorUpperContainer_nameContainer_nameWrapper">
                                            <p class="el_doctorUpperContainer_nameContainer_nameWrapper_name"><?php echo get_the_title($relatedDoctorPost->ID); ?></p>

                                            <?php if (get_field('doctor-name-en', $relatedDoctorPost->ID)): ?>
                                                <p class="el_doctorUpperContainer_nameContainer_nameWrapper_nameEn"><?php echo get_field('doctor-name-en', $relatedDoctorPost->ID); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="bl_doctorUpperContainer_txtWrapper_txtWrapper">
                                        <p class="el_doctorUpperContainer_txtWrapper_txtWrapper_txt">
                                            <?php echo get_field('doctor-txt-top', $relatedDoctorPost->ID); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="bl_commonAllBtnContainer">
                    <a href="<?php echo home_url(); ?>/doctor/" class="bl_commonAllBtn">
                        <p class="bl_commonAllBtn_txt">ドクター紹介はこちら</p>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow.svg" alt="">
                    </a>
                </div>
            </div>
        </section>



        <section class="bl_frontNewsSection">
            <div class="bl_frontNewsSection_inner">
                <hgroup class="bl_frontPageTtlContainer">
                    <p class="bl_frontPageTtlContainer_enTtl">
                        <span>(</span>
                        <span>News</span>
                        <span>)</span>
                    </p>
                    <h2 class="bl_frontPageTtlContainer_jaTtl">お知らせ</h2>
                </hgroup>

                <?php
                $relatedNewsPosts = get_posts(array(
                    'post_type' => 'news',
                    'posts_per_page' => 4,
                    'orderby' => 'date',
                    'order' => 'DESC',
                ));
                ?>
                <?php if (!empty($relatedNewsPosts)): ?>
                    <div class="bl_newsArchiveList">
                        <?php foreach ($relatedNewsPosts as $relatedNewsPost): ?>

                            <article class="bl_commonNewsPost">
                                <a href="<?php the_permalink($relatedNewsPost->ID); ?>" class="bl_commonNewsCard_link">
                                    <time class="el_commonNewsPost_time" datetime="<?php echo get_the_date('Y-m-d', $relatedNewsPost->ID); ?>"><?php echo get_the_date('Y.m.d', $relatedNewsPost->ID); ?></time>
                                    <p class="el_commonNewsPost_ttl"><?php echo get_the_title($relatedNewsPost->ID); ?></p>
                                </a>
                            </article>

                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="bl_commonAllBtnContainer">
                    <a href="<?php echo home_url(); ?>/doctor/" class="bl_commonAllBtn">
                        <p class="bl_commonAllBtn_txt">お知らせ一覧はこちら</p>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow.svg" alt="">
                    </a>
                </div>
            </div>
        </section>


        <section class="bl_fronSnsSection">
            <div class="bl_fronSnsSection_inner">


                <div class="bl_frontSnsContainer">
                    <h2 class="el_frontSnsContainer_ttl">静岡美容外科橋本クリニック<br class="sp_only"> Instagram</h2>

                    <div class="bl_frontSnsContainer_lower">
                        <?php echo do_shortcode('[instagram-feed feed=3]'); ?>
                    </div>
                </div>

                <div class="bl_frontSnsContainer">
                    <h2 class="el_frontSnsContainer_ttl">静岡美容外科橋本クリニック<br class="sp_only">チャンネル</h2>

                    <div class="bl_frontSnsContainer_lower">
                        <div class="bl_frontSnsContainer_lower_txtWrapper">
                            <p class="el_frontSnsContainer_lower_txtWrapper_txt">初めて美容医療に触れる方から、専門的な知識を求める方まで、<br>どなたにも安心してお役立ていただける動画を配信しております。</p>
                        </div>

                        <?php if (get_field('youtube', 'option')): ?>
                            <div class="bl_commonAllBtnContainer">
                                <a href="<?php echo get_field('youtube', 'option'); ?>" target="_blank" class="bl_commonAllBtn bl_commonSnsBtn">
                                    <img class="el_commonSnsBtn_icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/icon-youtube-white.svg" alt="YouTube">
                                    <p class="bl_commonAllBtn_txt">Youtubeでチャンネル登録</p>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if (get_field('tiktok', 'option')): ?>
                    <div class="bl_frontTiktokContainer">
                        <div class="bl_frontTiktokContainer_ttl">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/tiktok-ttl-icon.svg" alt="">
                            <h2 class="el_frontTiktokContainer_ttl_ttl">Clinic Tiktok</h2>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/tiktok-ttl-icon.svg" alt="">
                        </div>
                        <?php if (get_field('tiktok', 'option')): ?>
                            <div class="bl_commonAllBtnContainer">
                                <a href="<?php echo get_field('youtube', 'option'); ?>" target="_blank" class="bl_commonAllBtn bl_commonSnsBtn">
                                    <img class="el_commonSnsBtn_icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/icon-tiktok-white.svg" alt="YouTube">
                                    <p class="bl_commonAllBtn_txt">Tiktokでフォロー</p>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>


        <section class="bl_frontBlogSection">
            <div class="bl_frontBlogSection_inner">
                <hgroup class="bl_frontPageTtlContainer">
                    <p class="bl_frontPageTtlContainer_enTtl">
                        <span>(</span>
                        <span>Blog</span>
                        <span>)</span>
                    </p>
                    <h2 class="bl_frontPageTtlContainer_jaTtl">院長ブログ</h2>
                </hgroup>

                <?php
                $relatedBlogPosts = get_posts(array(
                    'post_type' => 'post',
                    'posts_per_page' => 4,
                    'orderby' => 'date',
                    'order' => 'DESC',
                ));
                ?>
                <?php if (!empty($relatedBlogPosts)): ?>
                    <div class="bl_frontBlogSwiperContainer">
                        <div class="bl_frontBlogSwiper swiper">
                            <div class="bl_blogArchiveList swiper-wrapper">
                                <?php foreach ($relatedBlogPosts as $relatedBlogPost): ?>
                                    <article class="bl_blogArchiveList_item swiper-slide">
                                        <a href="<?php the_permalink($relatedBlogPost->ID); ?>" class="bl_blogArchiveList_item_link">
                                            <?php if (get_the_post_thumbnail($relatedBlogPost->ID)): ?>
                                                <img class="el_blogArchiveList_item_img" src="<?php echo get_the_post_thumbnail_url($relatedBlogPost->ID); ?>" alt="<?php echo get_the_title($relatedBlogPost->ID); ?>">
                                            <?php else: ?>
                                                <img class="el_blogArchiveList_item_img" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/noimage-doc.jpg" alt="<?php echo get_the_title($relatedBlogPost->ID); ?>">
                                            <?php endif; ?>
                                        </a>

                                        <div class="bl_blogArchiveList_item_txtContainer">

                                            <div class="bl_blogArchiveList_item_infoWrapper">
                                                <time class="el_blogArchiveList_item_infoWrapper_time" datetime="<?php echo get_the_date('Y-m-d', $relatedBlogPost->ID); ?>"><?php echo get_the_date('Y.m.d', $relatedBlogPost->ID); ?></time>
                                                <?php
                                                $categoryList = get_the_category($relatedBlogPost->ID);
                                                ?>
                                                <?php if ($categoryList): ?>
                                                    <div class="bl_blogArchiveList_item_infoWrapper_categoryList">
                                                        <?php foreach ($categoryList as $category): ?>
                                                            <a href="<?php echo get_term_link($category->term_id); ?>" class="el_blogArchiveList_item_infoWrapper_categoryList_item"><?php echo $category->name; ?></a>
                                                        <?php endforeach; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <h3 class="bl_blogArchiveList_item_ttl">
                                                <a href="<?php the_permalink($relatedBlogPost->ID); ?>" class="bl_blogArchiveList_item_link">
                                                    <?php echo get_the_title($relatedBlogPost->ID); ?>
                                                </a>
                                            </h3>
                                        </div>
                                    </article>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="bl_frontBlogSwiper_btnContainer">
                            <button class="bl_frontBlogSwiper_prev">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow-prev.svg" alt="prev">
                            </button>
                            <div class="bl_frontBlogSwiper_pagination"></div>
                            <button class="bl_frontBlogSwiper_next">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow-next.svg" alt="next">
                            </button>
                        </div>

                    </div>

                <?php endif; ?>

                <div class="bl_commonAllBtnContainer">
                    <a href="<?php echo home_url(); ?>/blog/" class="bl_commonAllBtn">
                        <p class="bl_commonAllBtn_txt">ブログ一覧はこちら</p>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow.svg" alt="">
                    </a>
                </div>
            </div>
        </section>
    </main>
    <?php get_footer(); ?>
</body>

</html>