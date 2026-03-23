<div class="bl_footerReserveContainer">
    <p class="bl_footerReserveContainer_logo">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/footer-logo.svg" alt="HASHIMOTO CLINIC">
    </p>

    <section class="bl_footerReserveContainer_section">
        <div class="bl_footerReserveContainer_section_inner">
            <hgroup class="bl_frontPageTtlContainer">
                <p class="bl_frontPageTtlContainer_enTtl">
                    <span>(</span>
                    <span>Reserve</span>
                    <span>)</span>
                </p>
                <h2 class="bl_frontPageTtlContainer_jaTtl">ご予約</h2>
            </hgroup>

            <div class="bl_footerReserveContainer_section_contents">
                <?php if (get_field('tel', 'option')): ?>
                    <div class="bl_common_telWrapper">
                        <a class="el_common_telLink" href="tel:<?php echo get_field('tel', 'option'); ?>">Tel.<?php echo get_field('tel', 'option'); ?></a>

                        <?php if (get_field('hour', 'option') && get_field('consultation-time', 'option') !== ''): ?>
                            <p class="el_common_telHour">
                                <span>診察時間<?php echo get_field('consultation-time', 'option'); ?></span>
                                <span class="el_common_telHour_separator">/</span>
                                <span>受付<?php echo get_field('hour', 'option'); ?></span>
                            </p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <div class="bl_header_contentsWrapper_ctaWrapper">
                    <a href="<?php echo home_url(); ?>/contact/" class="bl_commonCtaBtn">
                        <div class="bl_commonCtaBtn_inner">
                            <p class="el_commonCtaBtn_txt">お問い合わせ</p>
                        </div>
                    </a>

                    <?php if (have_rows('reserve-url-group', 'option')): ?>
                        <?php while (have_rows('reserve-url-group', 'option')): the_row(); ?>

                            <a href="<?php the_sub_field('mypage-login'); ?>" target="_blank" class="bl_commonCtaBtn bl_commonCtaIconBtn">
                                <div class="bl_commonCtaBtn_inner">
                                    <img class="el_commonCtaIconBtn_icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/mypage-icon-black.svg" alt="">
                                    <p class="el_commonCtaBtn_txt">マイページログイン</p>
                                </div>
                            </a>

                            <a href="<?php the_sub_field('line-resere'); ?>" target="_blank" class="bl_commonCtaBtn bl_commonCtaIconBtn">
                                <div class="bl_commonCtaBtn_inner">
                                    <img class="el_commonCtaIconBtn_icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/icon-line-black.svg" alt="">
                                    <p class="el_commonCtaBtn_txt">LINE予約</p>
                                </div>
                            </a>

                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</div>


<section class="bl_footerScheduleContainer">
    <div class="bl_footerScheduleContainer_inner">
        <div class="bl_frontPageTtlContainer">
            <h2 class="bl_frontPageTtlContainer_jaTtl">スケジュール</h2>
        </div>

        <?php
        $clinicPostList = get_posts(array(
            'post_type' => 'clinic',
            'posts_per_page' => -1,
            'orderby' => 'menu_order',
            'order' => 'ASC',
        ));
        ?>
        <?php if (!empty($clinicPostList)): ?>
            <div class="bl_footerScheduleContainer_list">
                <?php foreach ($clinicPostList as $clinicPost): ?>
                    <div class="bl_footerScheduleContainer_list_item">
                        <div class="bl_footerScheduleContainer_list_item_inner">
                            <h3 class="el_footerScheduleContainer_list_item_ttl"><?php echo get_the_title($clinicPost); ?></h3>

                            <?php if (have_rows('schedule-list', $clinicPost->ID)): ?>

                                <div class="bl_scheduleContainer">
                                    <div class="bl_scheduleContainer_upper">
                                        <button class="bl_scheduleContainer_upper_prev" type="button">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow-prev.svg" alt="">
                                        </button>

                                        <div class="swiper bl_scheduleSwiper">
                                            <div class="swiper-wrapper">
                                                <?php while (have_rows('schedule-list', $clinicPost->ID)): the_row(); ?>
                                                    <div class="swiper-slide" data-date="<?php the_sub_field('schedule-list-m'); ?>">
                                                        <img src="<?php the_sub_field('schedule-list-img'); ?>" alt="<?php the_sub_field('schedule-list-m'); ?>">
                                                    </div>
                                                <?php endwhile; ?>
                                            </div>
                                        </div>

                                        <button class="bl_scheduleContainer_upper_next" type="button">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow-next.svg" alt="">
                                        </button>
                                    </div>
                                    <div class="bl_scheduleContainer_paginationWrapper"></div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>



<?php
$clinicPostList = get_posts(array(
    'post_type' => 'clinic',
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC',
));
?>
<?php if (!empty($clinicPostList)): ?>
    <div class="bl_footerClinicBranchContainer">
        <div class="bl_footerClinicBranchContainer_inner">

            <?php foreach ($clinicPostList as $clinicPost): ?>
                <div class="bl_footerClinicBranchWrapper">

                    <?php if (get_field('googlemap-code', $clinicPost->ID)): ?>
                        <div class="bl_footerClinicBranchWrapper_googlemap">
                            <?php echo get_field('googlemap-code', $clinicPost->ID); ?>
                        </div>
                    <?php endif; ?>

                    <div class="bl_footerClinicBranchWrapper_infoWrapper">
                        <p class="el_footerClinicBranchWrapper_infoWrapper_ttl"><?php echo get_the_title($clinicPost->ID); ?></p>

                        <?php if (get_field('clinic-addres', $clinicPost->ID)): ?>
                            <p class="el_footerClinicBranchWrapper_infoWrapper_address"><?php echo get_field('clinic-addres', $clinicPost->ID); ?></p>
                        <?php endif; ?>

                        <div class="bl_footerClinicBranchWrapper_infoWrapper_cliniInfoList">
                            <?php if (get_field('clinic-tel', $clinicPost->ID)): ?>
                                <dl class="bl_footerClinicBranchWrapper_infoWrapper_cliniInfoList_item">
                                    <dt class="el_footerClinicBranchWrapper_infoWrapper_cliniInfoList_item_ttl">TEL</dt>
                                    <dd class="el_footerClinicBranchWrapper_infoWrapper_cliniInfoList_item_txt">
                                        <a class="el_footerClinicBranchWrapper_infoWrapper_cliniInfoList_item_txt_link" href="tel:<?php echo get_field('clinic-tel', $clinicPost->ID); ?>">
                                            <?php echo get_field('clinic-tel', $clinicPost->ID); ?>
                                        </a>
                                    </dd>
                                </dl>
                            <?php endif; ?>

                            <?php if (get_field('clinic-time', $clinicPost->ID)): ?>
                                <dl class="bl_footerClinicBranchWrapper_infoWrapper_cliniInfoList_item">
                                    <dt class="el_footerClinicBranchWrapper_infoWrapper_cliniInfoList_item_ttl">営業時間</dt>
                                    <dd class="el_footerClinicBranchWrapper_infoWrapper_cliniInfoList_item_txt">
                                        <?php echo get_field('clinic-time', $clinicPost->ID); ?>
                                    </dd>
                                </dl>
                            <?php endif; ?>

                            <?php if (get_field('clinic-holiday', $clinicPost->ID)): ?>
                                <dl class="bl_footerClinicBranchWrapper_infoWrapper_cliniInfoList_item">
                                    <dt class="el_footerClinicBranchWrapper_infoWrapper_cliniInfoList_item_ttl">休診日</dt>
                                    <dd class="el_footerClinicBranchWrapper_infoWrapper_cliniInfoList_item_txt">
                                        <?php echo get_field('clinic-holiday', $clinicPost->ID); ?>
                                    </dd>
                                </dl>
                            <?php endif; ?>
                        </div>



                        <div class="bl_footerClinicBranchWrapper_infoWrapper_btnList">
                            <a href="<?php echo home_url(); ?>/access/#post<?php echo $clinicPost->ID; ?>" class="bl_footerClinicBranchWrapper_infoWrapper_noteLink bl_footerClinicBranchWrapper_infoWrapper_noteLink_noIcon">
                                <p>提携駐車場について</p>
                            </a>
                            <?php if (get_field('googlemap-link', $clinicPost->ID)): ?>

                                <a href="<?php echo get_field('googlemap-link', $clinicPost->ID); ?>" class="bl_footerClinicBranchWrapper_infoWrapper_noteLink" target="_blank">
                                    <p>Google Maps</p>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/tab-icon.svg" alt="">
                                </a>

                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
<?php endif; ?>


<footer class="ly_footer">
    <div class="bl_footer_upper">
        <div class="bl_footer_upper_inner">
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
                    'hide_empty' => true,
                    'object_ids' => $menu_post_ids,
                    'parent' => 0,
                ));
                if (is_wp_error($menu_categories)) {
                    $menu_categories = array();
                }
            }
            ?>
            <?php if (!empty($menu_categories)): ?>
                <div class="bl_footerMenuPostList">

                    <?php foreach ($menu_categories as $menu_category): ?>

                        <div class="bl_footerMenuPostList_item">
                            <h2 class="el_footerMenuPostList_item_ttl">
                                <span class="el_footerMenuPostList_item_ttl_txt"><?php echo $menu_category->name; ?></span>
                            </h2>

                            <?php
                            $childrenMenuCategories = get_terms(array(
                                'taxonomy'   => 'menu-cat',
                                'hide_empty' => true,
                                'object_ids' => $menu_post_ids,
                                'parent' => $menu_category->term_id,
                            ));
                            ?>
                            <?php if (!empty($childrenMenuCategories)): ?>

                                <div class="bl_footerMenuPostList_childList">

                                    <?php foreach ($childrenMenuCategories as $childrenMenuCategory): ?>
                                        <div class="bl_footerMenuPostList_childList_item">
                                            <h3 class="el_footerMenuPostList_item_child_ttl"><?php echo $childrenMenuCategory->name; ?></h3>
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
                                            <?php if (!empty($childrenMenuPosts)): ?>
                                                <div class="bl_footerMenuPostList_postList">
                                                    <?php foreach ($childrenMenuPosts as $childrenMenuPost): ?>
                                                        <a class="el_footerMenuPostList_postList_item" href="<?php echo get_the_permalink($childrenMenuPost); ?>"><?php echo get_the_title($childrenMenuPost); ?></a>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>

                                </div>

                            <?php else: ?>
                                <?php
                                $menuPosts = get_posts(array(
                                    'post_type' => 'menu',
                                    'posts_per_page' => -1,
                                    'fields' => 'ids',
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'menu-cat',
                                            'terms' => $menu_category->term_id,
                                        ),
                                    ),
                                ));
                                ?>
                                <?php if (!empty($menuPosts)): ?>
                                    <div class="bl_footerMenuPostList_postList">
                                        <?php foreach ($menuPosts as $menuPost): ?>
                                            <a class="el_footerMenuPostList_postList_item" href="<?php echo get_the_permalink($menuPost); ?>"><?php echo get_the_title($menuPost); ?></a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>

                        </div>

                    <?php endforeach; ?>

                </div>
            <?php endif; ?>


            <div class="bl_footerNavContainer">
                <div class="bl_footerNavContainer_inner">
                    <div class="bl_footerNavContainer_leftWrapper">
                        <a href="<?php echo home_url(); ?>/" class="bl_footerNavContainer_leftWrapper_logo"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/footer-cliniclogo.svg" alt="HASHIMOTO CLINIC"></a>

                        <div class="bl_footerNavContainer_leftWrapper_infoWrapper">
                            <?php if (get_field('tel', 'option')): ?>
                                <div class="bl_common_telWrapper">
                                    <a class="el_common_telLink" href="tel:<?php echo get_field('tel', 'option'); ?>">Tel.<?php echo get_field('tel', 'option'); ?></a>

                                    <?php if (get_field('hour', 'option') && get_field('consultation-time', 'option') !== ''): ?>
                                        <p class="el_common_telHour">
                                            診察時間<?php echo get_field('consultation-time', 'option'); ?> / 受付<?php echo get_field('hour', 'option'); ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="bl_footerSnsList">
                            <?php if (get_field('instagram', 'option')): ?>
                                <a href="<?php the_sub_field('clinic-snslist-link'); ?>" class="bl_footerSnsList_item" target="_blank">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/icon-instagram-black.svg" alt="">
                                </a>
                            <?php endif; ?>

                            <?php if (get_field('tiktok', 'option')): ?>
                                <a href="<?php echo get_field('tiktok', 'option'); ?>" class="bl_footerSnsList_item" target="_blank">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/icon-tiktok-black.svg" alt="">
                                </a>
                            <?php endif; ?>

                            <?php if (get_field('instagram', 'option')): ?>
                                <a href="<?php echo get_field('youtube', 'option'); ?>" class="bl_footerSnsList_item" target="_blank">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/icon-youtube-black.svg" alt="">
                                </a>
                            <?php endif; ?>
                        </div>

                    </div>

                    <nav class="bl_footerNavContainer_nav">
                        <a href="<?php echo home_url(); ?>/" class="bl_footerNavContainer_nav_item">
                            <p class="el_footerNavContainer_nav_item_txt">トップ</p>
                            <img class="el_footerNavContainer_nav_item_icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/footer-navicon-white.svg" alt="">
                        </a>

                        <a href="<?php echo home_url(); ?>/information/" class="bl_footerNavContainer_nav_item">
                            <p class="el_footerNavContainer_nav_item_txt">クリニックについて</p>
                            <img class="el_footerNavContainer_nav_item_icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/footer-navicon-white.svg" alt="">
                        </a>

                        <a href="<?php echo home_url(); ?>/doctor/" class="bl_footerNavContainer_nav_item">
                            <p class="el_footerNavContainer_nav_item_txt">ドクター紹介</p>
                            <img class="el_footerNavContainer_nav_item_icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/footer-navicon-white.svg" alt="">
                        </a>

                        <a href="<?php echo home_url(); ?>/case/" class="bl_footerNavContainer_nav_item">
                            <p class="el_footerNavContainer_nav_item_txt">症例一覧</p>
                            <img class="el_footerNavContainer_nav_item_icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/footer-navicon-white.svg" alt="">
                        </a>

                        <a href="<?php echo home_url(); ?>/payment/" class="bl_footerNavContainer_nav_item">
                            <p class="el_footerNavContainer_nav_item_txt">料金表</p>
                            <img class="el_footerNavContainer_nav_item_icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/footer-navicon-white.svg" alt="">
                        </a>

                        <a href="<?php echo home_url(); ?>/blog/" class="bl_footerNavContainer_nav_item">
                            <p class="el_footerNavContainer_nav_item_txt">院長ブログ</p>
                            <img class="el_footerNavContainer_nav_item_icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/footer-navicon-white.svg" alt="">
                        </a>

                        <a href="<?php echo home_url(); ?>/faq/" class="bl_footerNavContainer_nav_item">
                            <p class="el_footerNavContainer_nav_item_txt">よくある質問</p>
                            <img class="el_footerNavContainer_nav_item_icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/footer-navicon-white.svg" alt="">
                        </a>

                        <a href="<?php echo home_url(); ?>/news/" class="bl_footerNavContainer_nav_item">
                            <p class="el_footerNavContainer_nav_item_txt">お知らせ</p>
                            <img class="el_footerNavContainer_nav_item_icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/footer-navicon-white.svg" alt="">
                        </a>

                        <a href="<?php echo home_url(); ?>/monitor/" class="bl_footerNavContainer_nav_item">
                            <p class="el_footerNavContainer_nav_item_txt">モニター募集</p>
                            <img class="el_footerNavContainer_nav_item_icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/footer-navicon-white.svg" alt="">
                        </a>

                        <a href="<?php echo home_url(); ?>/access/" class="bl_footerNavContainer_nav_item">
                            <p class="el_footerNavContainer_nav_item_txt">アクセス</p>
                            <img class="el_footerNavContainer_nav_item_icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/footer-navicon-white.svg" alt="">
                        </a>

                        <a href="<?php echo home_url(); ?>/contact/" class="bl_footerNavContainer_nav_item">
                            <p class="el_footerNavContainer_nav_item_txt">お問い合わせ</p>
                            <img class="el_footerNavContainer_nav_item_icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/footer-navicon-white.svg" alt="">
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="bl_footer_lower">
        <div class="bl_footer_lower_inner">
            <div class="bl_footer_lower_inner_linkWrapper">
                <a href="<?php echo home_url(); ?>/recruit/" class="el_footer_lower_link">採用情報</a>
                <a href="<?php echo home_url(); ?>/privacy/" class="el_footer_lower_link">プライバシーポリシー</a>
            </div>
            <small class="el_footer_lower_copyright">&copy; 静岡美容外科橋本クリニック</small>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>