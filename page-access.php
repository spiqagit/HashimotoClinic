<?php
/*
 * Template Name: Access
 */
?>
<?php wp_head(); ?>
<?php get_header('meta'); ?>
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
                    <p class="bl_commonlowerPage_ttl_enTtl">Access</p>
                    <h1 class="bl_commonlowerPage_ttl_jaTtl">アクセス</h1>
                </hgroup>
                <?php get_template_part('inc/breadcrumbs'); ?>
            </div>


            <div class="bl_commonlowerPage_contents">
                <?php
                $clinicPostList = get_posts(array(
                    'post_type' => 'clinic',
                    'posts_per_page' => -1,
                    'orderby' => 'menu_order',
                    'order' => 'ASC',
                ));
                ?>
                <?php if (!empty($clinicPostList)): ?>
                    <div class="bl_accessContainer">
                        <div class="bl_accessContainer_inner">

                            <div class="bl_commonDownBtnContainer">
                                <?php foreach ($clinicPostList as $clinicPost): ?>
                                    <a href="#clinic-<?php echo $clinicPost->ID; ?>" class="bl_commonDownBtnContainer_item">
                                        <span>
                                            <?php
                                            $clinicTitle = str_replace('静岡美容外科橋本クリニック', '', get_the_title($clinicPost));
                                            echo trim($clinicTitle, " \t\n\r\0\x0B　");
                                            ?>
                                        </span>
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/down-arrow.svg" alt="">
                                    </a>
                                <?php endforeach; ?>
                            </div>


                            <section class="bl_accessArchiveContainer">
                                <?php foreach ($clinicPostList as $clinicPost): ?>

                                    <div class="bl_accessArchiveContainer_item" id="clinic-<?php echo $clinicPost->ID; ?>">
                                        <h2 class="el_accessArchiveContainer_item_ttl"><?php echo get_the_title($clinicPost); ?></h2>


                                        <div class="bl_accessArchiveContainer_infoWrapper">
                                            <?php if (get_field('googlemap-code', $clinicPost->ID)): ?>
                                                <div class="bl_accessArchiveContainer_googlemapContainer">
                                                    <?php echo get_field('googlemap-code', $clinicPost->ID); ?>
                                                </div>
                                            <?php endif; ?>

                                            <div class="bl_accessArchiveContainer_infoListContainer">

                                                <?php if (get_field('clinic-addres', $clinicPost->ID)): ?>
                                                    <dl class="bl_accessArchiveContainer_infoList">
                                                        <dt class="el_accessArchiveContainer_infoList_ttl">所在地</dt>
                                                        <dd class="bl_accessArchiveContainer_infoList_contents">
                                                            <p class="el_accessArchiveContainer_infoList_contents_txt"><?php echo get_field('clinic-addres', $clinicPost->ID); ?></p>

                                                            <?php if (get_field('googlemap-link', $clinicPost->ID)): ?>
                                                                <a href="<?php echo get_field('googlemap-link', $clinicPost->ID); ?>" class="bl_accessArchiveContainer_infoList_contents_link" target="_blank">
                                                                    <p class="el_accessArchiveContainer_infoList_contents_link_txt">Google Maps</p>
                                                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/tab-icon.svg" alt="">
                                                                </a>
                                                            <?php endif; ?>
                                                        </dd>
                                                    </dl>
                                                <?php endif; ?>

                                                <?php if (get_field('clinic-access', $clinicPost->ID)): ?>
                                                    <dl class="bl_accessArchiveContainer_infoList">
                                                        <dt class="el_accessArchiveContainer_infoList_ttl">アクセス</dt>
                                                        <dd class="bl_accessArchiveContainer_infoList_contents">
                                                            <p class="el_accessArchiveContainer_infoList_contents_txt"><?php echo get_field('clinic-access', $clinicPost->ID); ?></p>
                                                        </dd>
                                                    </dl>
                                                <?php endif; ?>

                                                <?php if (get_field('clinic-tel', $clinicPost->ID)): ?>
                                                    <dl class="bl_accessArchiveContainer_infoList">
                                                        <dt class="el_accessArchiveContainer_infoList_ttl">TEL</dt>
                                                        <dd class="bl_accessArchiveContainer_infoList_contents">
                                                            <a class="el_accessArchiveContainer_infoList_contents_telLink" href="tel:<?php echo get_field('clinic-tel', $clinicPost->ID); ?>"><?php echo get_field('clinic-tel', $clinicPost->ID); ?></a>
                                                        </dd>
                                                    </dl>
                                                <?php endif; ?>

                                                <?php if (get_field('clinic-time', $clinicPost->ID)): ?>
                                                    <dl class="bl_accessArchiveContainer_infoList">
                                                        <dt class="el_accessArchiveContainer_infoList_ttl">営業時間</dt>
                                                        <dd class="bl_accessArchiveContainer_infoList_contents">
                                                            <p class="el_accessArchiveContainer_infoList_contents_txt"><?php echo get_field('clinic-time', $clinicPost->ID); ?></p>
                                                        </dd>
                                                    </dl>
                                                <?php endif; ?>

                                                <?php if (get_field('clinic-holiday', $clinicPost->ID)): ?>
                                                    <dl class="bl_accessArchiveContainer_infoList">
                                                        <dt class="el_accessArchiveContainer_infoList_ttl">休診日</dt>
                                                        <dd class="bl_accessArchiveContainer_infoList_contents">
                                                            <p class="el_accessArchiveContainer_infoList_contents_txt"><?php echo get_field('clinic-holiday', $clinicPost->ID); ?></p>
                                                        </dd>
                                                    </dl>
                                                <?php endif; ?>
                                            </div>

                                        </div>

                                        <?php if (have_rows('route-container-list', $clinicPost->ID)): ?>
                                            <div class="bl_accessRouteContainer">

                                                <?php while (have_rows('route-container-list', $clinicPost->ID)): the_row(); ?>
                                                    <div class="bl_accessRouteContainer_item">
                                                        <?php if (get_sub_field('route-container-list-ttl')): ?>
                                                            <h3 class="el_accessRouteContainer_item_ttl"><?php the_sub_field('route-container-list-ttl'); ?></h3>
                                                        <?php endif; ?>

                                                        <?php if (have_rows('route-list', $clinicPost->ID)): ?>
                                                            <div class="bl_accessRoutelistContainer">

                                                                <div class="bl_accessRoutelistSwiper swiper">
                                                                    <ol class="bl_accessRoutelist swiper-wrapper">
                                                                        <?php
                                                                        $i = 1;
                                                                        while (have_rows('route-list', $clinicPost->ID)): the_row(); ?>
                                                                            <li class="bl_accessRoutelist_item swiper-slide">
                                                                                <img class="el_accessRoutelist_item_img" src="<?php the_sub_field('route-list-img'); ?>" alt="<?php the_sub_field('route-list-txt'); ?>">

                                                                                <div class="bl_accessRoutelist_item_txt">
                                                                                    <?php if (get_sub_field('route-list-ttl')): ?>
                                                                                        <p class="el_accessRoutelist_item_txt_ttl">
                                                                                            <span class="el_accessRoutelist_item_txt_ttl_num"><?php echo $i; ?>.</span>
                                                                                            <span class="el_accessRoutelist_item_txt_ttl_txt"><?php the_sub_field('route-list-ttl'); ?></span>
                                                                                        </p>
                                                                                    <?php endif; ?>

                                                                                    <?php if (get_sub_field('route-list-txt')): ?>
                                                                                        <p class="el_accessRoutelist_item_txt_txt"><?php the_sub_field('route-list-txt'); ?></p>
                                                                                    <?php endif; ?>
                                                                                </div>
                                                                            </li>
                                                                        <?php $i++;
                                                                        endwhile; ?>
                                                                    </ol>
                                                                </div>


                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endwhile; ?>
                                            </div>
                                        <?php endif; ?>

                                        <div class="bl_accessParkingContainer">

                                            <?php
                                            $clinicTitle = str_replace('静岡美容外科橋本クリニック', '', get_the_title($clinicPost));
                                            $clinicTitle = trim($clinicTitle, " \t\n\r\0\x0B　");
                                            if ($clinicTitle == '静岡院'): ?>
                                                <div class="bl_accessParkingInfoWrapper">
                                                    <h3 class="el_accessParkingInfoWrapper_ttl">定型駐車場のご案内</h3>
                                                    <div class="bl_accessParkingInfoWrapper_contents">
                                                        <p class="el_accessParkingInfoWrapper_contents_txt">当院ではクリニック近隣に提携駐車場をご用意しております。<br>お車でご来院の方は提携駐車場をご利用ください。</p>

                                                        <div class="bl_accessParkingInfoWrapper_parkinglinkList">
                                                            <a href="https://www.inamori-parking.com/" target="_blank" rel="noopener noreferrer" class="bl_accessParkingInfoWrapper_parkinglinkList_item">
                                                                <p class="el_accessParkingInfoWrapper_parkinglinkList_item_txt">稲森パーキングについて</p>
                                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/tab-icon-black.svg" alt="">
                                                            </a>
                                                            <a href="https://www.city.shizuoka.lg.jp/s3792/s001405.html" target="_blank" rel="noopener noreferrer" class="bl_accessParkingInfoWrapper_parkinglinkList_item">
                                                                <p class="el_accessParkingInfoWrapper_parkinglinkList_item_txt">エキパについて</p>
                                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/tab-icon-black.svg" alt="">
                                                            </a>
                                                        </div>

                                                        <ul class="bl_accessParkingInfoWrapper_parkinglinkList_noteList">
                                                            <li class="bl_accessParkingInfoWrapper_parkinglinkList_noteList_item">恐れ入りますが、「稲森パーキング2号」は当院との提携駐車場ではございません。<br>ご利用の際はご注意くださいますようお願い申し上げます。</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            <?php endif; ?>

                                            <?php
                                            if ($clinicTitle == '三島院'): ?>
                                                <div class="bl_accessParkingInfoWrapper">
                                                    <h3 class="el_accessParkingInfoWrapper_ttl">定型駐車場のご案内</h3>
                                                    <div class="bl_accessParkingInfoWrapper_contents">
                                                        <p class="el_accessParkingInfoWrapper_contents_txt">当院ではクリニック近隣に提携駐車場をご用意しております。<br>お車でご来院の方は提携駐車場をご利用ください。</p>

                                                        <div class="bl_accessParkingInfoWrapper_detailsWrapper">
                                                            <div class="bl_accessParkingInfoWrapper_detailsWrapper_item">
                                                                <div class="bl_accessParkingInfoWrapper_detailsWrapper_ttl">
                                                                    <h5 class="el_accessParkingInfoWrapper_detailsWrapper_ttl_ttl">名鉄協商パーキング</h5>
                                                                    
                                                                    <div class="bl_accessParkingInfoWrapper_detailsWrapper_ttl_parkingLinkList">
                                                                        <p class="el_accessParkingInfoWrapper_detailsWrapper_ttl_parkingLinkList_txt">クリニック近隣2か所にございます。</p>
                                                                        <ol class="bl_accessParkingInfoWrapper_detailsWrapper_ttl_parkingLinkList_list">
                                                                            <li class="el_accessParkingInfoWrapper_detailsWrapper_ttl_parkingLinkList_list_item">&#9312;名鉄協商パーキング三島駅前第二</li>
                                                                            <li class="el_accessParkingInfoWrapper_detailsWrapper_ttl_parkingLinkList_list_item">&#9313;名鉄協商パーキング三島駅前</li>
                                                                        </ol>
                                                                    </div>
                                                                </div>

                                                                <div class="bl_accessParkingInfoWrapper_detailsWrapper_details">
                                                                    <a href="https://mkp.jp/search/?pref=&k=%E4%B8%89%E5%B3%B6%E9%A7%85" target="_blank" rel="noopener noreferrer" class="bl_accessParkingInfoWrapper_detailsWrapper_details_link">
                                                                        <p>名鉄協商パーキングについて</p>
                                                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/tab-icon.svg" alt="">
                                                                    </a>

                                                                    <ul class="bl_accessParkingInfoWrapper_detailsWrapper_details_noteList">
                                                                        <li class="bl_accessParkingInfoWrapper_detailsWrapper_details_noteList_item">精算機にて利用証明書の発券が必要となります。<br>
                                                                            発券方法につきましては、現地清算機上部に案内が掲示されておりますので、ご確認ください。</li>
                                                                    </ul>
                                                                </div>
                                                            </div>


                                                            <div class="bl_accessParkingInfoWrapper_detailsWrapper_item">
                                                                <div class="bl_accessParkingInfoWrapper_detailsWrapper_ttl">
                                                                    <h5 class="el_accessParkingInfoWrapper_detailsWrapper_ttl_ttl">タイムズ三島一番町</h5>
                                                                    
                                                                    <div class="bl_accessParkingInfoWrapper_detailsWrapper_ttl_parkingLinkList">
                                                                        <p class="el_accessParkingInfoWrapper_detailsWrapper_ttl_parkingLinkList_txt">クリニック近隣2か所にございます。</p>
                                                                        <ol class="bl_accessParkingInfoWrapper_detailsWrapper_ttl_parkingLinkList_list">
                                                                            <li class="el_accessParkingInfoWrapper_detailsWrapper_ttl_parkingLinkList_list_item">&#9312;タイムズ三島南口寿町</li>
                                                                            <li class="el_accessParkingInfoWrapper_detailsWrapper_ttl_parkingLinkList_list_item">&#9313;タイムズ三島一番町第2</li>
                                                                            <li class="el_accessParkingInfoWrapper_detailsWrapper_ttl_parkingLinkList_list_item">&#9313;タイムズ三島一番町第3</li>
                                                                            <li class="el_accessParkingInfoWrapper_detailsWrapper_ttl_parkingLinkList_list_item">&#9313;タイムズ三島一番町第4</li>
                                                                        </ol>
                                                                    </div>
                                                                </div>

                                                                <div class="bl_accessParkingInfoWrapper_detailsWrapper_details">
                                                                    <a href="https://times-shizuoka.com/parking/detail/" target="_blank" rel="noopener noreferrer" class="bl_accessParkingInfoWrapper_detailsWrapper_details_link">
                                                                        <p>タイムズ三島一番町について</p>
                                                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/tab-icon.svg" alt="">
                                                                    </a>

                                                                    <ul class="bl_accessParkingInfoWrapper_detailsWrapper_details_noteList">
                                                                        <li class="bl_accessParkingInfoWrapper_detailsWrapper_details_noteList_item">｢タイムズ三島南口寿町｣｢タイムズ三島一番町第2｣をご利用の場合は、精算機にて利用証明書の発券が必要となります。発券方法につきましては、現地精算機上部に案内が掲示されておりますので、ご確認ください。<br>
                                                                        なお、｢タイムズ三島一番町第3｣｢第4｣につきましては利用証明書の発券ができませんので、受付にてお申し出ください。</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>

                                            <div class="bl_accessParkingCarContainer">
                                                <h4 class="el_accessParkingCarContainer_ttl">
                                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/car-icon.svg" alt="">
                                                    <span>お車でお越しの方へ</span>
                                                </h4>

                                                <div class="bl_accessParkingCarContainer_contents">
                                                    <p class="el_accessParkingCarContainer_contents_txt">上記駐車場をご利用の方は、サービス券を発行いたしますので、<br>
                                                        駐車券を受付にてご提示ください。</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php endforeach; ?>
                            </section>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <?php get_footer(); ?>
</body>

</html>