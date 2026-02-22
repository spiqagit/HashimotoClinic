<header class="ly_header">
    <div class="ly_header_inner">
        <div class="bl_header_logoWrapper">
            <?php if (is_front_page()): ?>
                <h1>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/logo.svg" alt="HASHIMOTO CLINIC 静岡美容外科橋本クリニック">
                </h1>
            <?php else: ?>
                <a href="<?php echo home_url(); ?>" class="el_header_logo">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/logo.svg" alt="HASHIMOTO CLINIC 静岡美容外科橋本クリニック">
                </a>
            <?php endif; ?>
        </div>

        <div class="ly_header_contentsWrapper">
            <div class="bl_header_contentsWrapper_upper">
                <div class="bl_header_searchWrapper">
                    <input class="el_header_searchWrapper_input" type="text" name="search" placeholder="サイト内検索">
                    <button class="el_header_searchWrapper_button" type="submit">
                        <img class="el_header_searchWrapper_button_icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/search.svg" alt="">
                    </button>
                </div>

                <div class="bl_header_langWrapper">
                    <?php echo do_shortcode('[gtranslate]'); ?>
                </div>

            </div>

            <div class="bl_header_contentsWrapper_lower">
                <?php if (get_field('tel', 'option')): ?>
                    <div class="bl_header_contentsWrapper_telWrapper">
                        <a class="el_header_contentsWrapper_telLink" href="tel:<?php echo get_field('tel', 'option'); ?>">Tel.<?php echo get_field('tel', 'option'); ?></a>
                        <?php if (get_field('hour', 'option')): ?>
                            <p class="el_header_contentsWrapper_telHour">受付<?php echo get_field('hour', 'option'); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <div class="bl_header_contentsWrapper_btnWrapper">
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
                                        <img class="el_commonCtaIconBtn_icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/mypage-icon.svg" alt="">
                                        <p class="el_commonCtaBtn_txt">マイページログイン</p>
                                    </div>
                                </a>

                                <a href="<?php the_sub_field('line-resere'); ?>" target="_blank" class="bl_commonCtaBtn bl_commonCtaIconBtn">
                                    <div class="bl_commonCtaBtn_inner">
                                        <img class="el_commonCtaIconBtn_icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/line-icon.svg" alt="">
                                        <p class="el_commonCtaBtn_txt">LINE予約</p>
                                    </div>
                                </a>

                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                    <button class="bl_header_toggleBtn" type="button">
                        <span class="el_header_toggleBtn_line"></span>
                        <span class="el_header_toggleBtn_line"></span>
                        <span class="el_header_toggleBtn_line"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <nav class="bl_header_nav">
        <div class="bl_header_nav_inner">
            <a href="<?php echo home_url(); ?>/information/"  class="bl_header_nav_item">
                <p class="el_header_nav_item_txt">クリニックについて</p>
                <img class="el_header_nav_item_arrow" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/btn-nav-arrow.svg" alt="">
            </a>
            <a href="<?php echo home_url(); ?>/doctor/"  class="bl_header_nav_item">
                <p class="el_header_nav_item_txt">ドクター紹介</p>
                <img class="el_header_nav_item_arrow" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/btn-nav-arrow.svg" alt="">
            </a>
            <a href="<?php echo home_url(); ?>/access/" class="bl_header_nav_item">
                <p class="el_header_nav_item_txt">アクセス</p>
                <img class="el_header_nav_item_arrow" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/btn-nav-arrow.svg" alt="">
            </a>
        </div>
    </nav>
</header>


<div class="bl_commonToggleNavOuter"></div>
<nav class="bl_commonToggleNav">
    <div class="bl_commonToggleNav_inner">
        <button class="bl_commonToggleNav_closeBtn" type="button">
            <span class="el_commonToggleNav_closeBtn_line"></span>
            <span class="el_commonToggleNav_closeBtn_line"></span>
        </button>

        <div class="bl_commonNavBtnList">
            <a href="<?php echo home_url(); ?>/" class="bl_commonNavBtnList_item">
                <p class="el_commonNavBtnList_item_txt">トップ</p>
                <img class="el_commonNavBtnList_item_arrow" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/btn-nav-arrow.svg" alt="">
            </a>

            <a href="<?php echo home_url(); ?>/information/" class="bl_commonNavBtnList_item">
                <p class="el_commonNavBtnList_item_txt">クリニックについて</p>
                <img class="el_commonNavBtnList_item_arrow" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/btn-nav-arrow.svg" alt="">
            </a>

            <a href="<?php echo home_url(); ?>/service/" class="bl_commonNavBtnList_item">
                <p class="el_commonNavBtnList_item_txt">施術メニュー</p>
                <img class="el_commonNavBtnList_item_arrow" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/btn-nav-arrow.svg" alt="">
            </a>


            <a href="<?php echo home_url(); ?>/doctor/" class="bl_commonNavBtnList_item">
                <p class="el_commonNavBtnList_item_txt">ドクター紹介</p>
                <img class="el_commonNavBtnList_item_arrow" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/btn-nav-arrow.svg" alt="">
            </a>


            <a href="<?php echo home_url(); ?>/case/" class="bl_commonNavBtnList_item">
                <p class="el_commonNavBtnList_item_txt">症例</p>
                <img class="el_commonNavBtnList_item_arrow" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/btn-nav-arrow.svg" alt="">
            </a>

            <a href="<?php echo home_url(); ?>/payment/" class="bl_commonNavBtnList_item">
                <p class="el_commonNavBtnList_item_txt">料金表</p>
                <img class="el_commonNavBtnList_item_arrow" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/btn-nav-arrow.svg" alt="">
            </a>

            <a href="<?php echo home_url(); ?>/blog/" class="bl_commonNavBtnList_item">
                <p class="el_commonNavBtnList_item_txt">院長ブログ</p>
                <img class="el_commonNavBtnList_item_arrow" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/btn-nav-arrow.svg" alt="">
            </a>
            

            <a href="<?php echo home_url(); ?>/faq/" class="bl_commonNavBtnList_item">
                <p class="el_commonNavBtnList_item_txt">よくある質問</p>
                <img class="el_commonNavBtnList_item_arrow" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/btn-nav-arrow.svg" alt="">
            </a>

            <a href="<?php echo home_url(); ?>/news/" class="bl_commonNavBtnList_item">
                <p class="el_commonNavBtnList_item_txt">お知らせ</p>
                <img class="el_commonNavBtnList_item_arrow" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/btn-nav-arrow.svg" alt="">
            </a>

            <a href="<?php echo home_url(); ?>/monitor/" class="bl_commonNavBtnList_item">
                <p class="el_commonNavBtnList_item_txt">モニター募集</p>
                <img class="el_commonNavBtnList_item_arrow" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/btn-nav-arrow.svg" alt="">
            </a>
            <a href="<?php echo home_url(); ?>/access/" class="bl_commonNavBtnList_item">
                <p class="el_commonNavBtnList_item_txt">アクセス</p>
                <img class="el_commonNavBtnList_item_arrow" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/btn-nav-arrow.svg" alt="">
            </a>
        </div>

        <a href="<?php echo home_url(); ?>/recruit/" class="bl_commonToggleNav_recruitLink">採用情報</a>

        <div class="bl_commonToggleNav_lower">
            <img class="bl_commonToggleNav_lower_logo" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/nav-logo.svg" alt="HASHIMOTO CLINIC 静岡美容外科橋本クリニック">

            <div class="bl_commonToggleNav_infoWrapper">
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

                <div class="bl_commonToggleNav_infoWrapper_ctaWrapper">

                    <a href="<?php echo home_url(); ?>/contact/" class="bl_commonCtaBtn">
                        <div class="bl_commonCtaBtn_inner">
                            <p class="el_commonCtaBtn_txt">お問い合わせ</p>
                        </div>
                    </a>

                    <?php if (have_rows('reserve-url-group', 'option')): ?>
                        <?php while (have_rows('reserve-url-group', 'option')): the_row(); ?>

                            <a href="<?php the_sub_field('mypage-login'); ?>" target="_blank" class="bl_commonCtaBtn bl_commonCtaIconBtn">
                                <div class="bl_commonCtaBtn_inner">
                                    <img class="el_commonCtaIconBtn_icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/mypage-icon.svg" alt="">
                                    <p class="el_commonCtaBtn_txt">マイページログイン</p>
                                </div>
                            </a>

                            <a href="<?php the_sub_field('line-resere'); ?>" target="_blank" class="bl_commonCtaBtn bl_commonCtaIconBtn">
                                <div class="bl_commonCtaBtn_inner">
                                    <img class="el_commonCtaIconBtn_icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/line-icon.svg" alt="">
                                    <p class="el_commonCtaBtn_txt">LINE予約</p>
                                </div>
                            </a>

                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>

                <?php if (get_field('instagram', 'option') ||  get_field('tiktok', 'option') || get_field('youtube', 'option')): ?>
                    <div class="bl_commonSnsList">

                        <?php if (get_field('instagram', 'option')): ?>
                            <a href="<?php echo get_field('instagram', 'option'); ?>" class="bl_commonSnsList_item">
                                <img class="el_commonSnsList_item_icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/instagram-black.svg" alt="Instagram">
                            </a>
                        <?php endif; ?>

                        <?php if (get_field('tiktok', 'option')): ?>
                            <a href="<?php echo get_field('tiktok', 'option'); ?>" class="bl_commonSnsList_item">
                                <img class="el_commonSnsList_item_icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/icon-tiktok-black.svg" alt="TikTok">
                            </a>
                        <?php endif; ?>

                        <?php if (get_field('youtube', 'option')): ?>
                            <a href="<?php echo get_field('tiktok', 'option'); ?>" class="bl_commonSnsList_item">
                                <img class="el_commonSnsList_item_icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/icon-youtube-black.svg" alt="YouTube">
                            </a>
                        <?php endif; ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>