<?php
/*
 * Template Name: Recruit
 */
?>
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
                    <p class="bl_commonlowerPage_ttl_enTtl">Recruit</p>
                    <h1 class="bl_commonlowerPage_ttl_jaTtl">採用情報</h1>
                </hgroup>
                <?php get_template_part('inc/breadcrumbs'); ?>
            </div>


            <div class="bl_commonlowerPage_contents">
                <div class="bl_recruitContainer">
                    <div class="bl_recruitContainer_inner">

                        <div class="bl_recruitContainer_copyWrapper">
                            <img class="el_recruitContainer_copyWrapper_iconTop" src="<?php echo get_template_directory_uri(); ?>/assets/img/recruit/recruit-about-icon-top.svg" alt="">
                            <p class="el_recruitContainer_copyWrapper_txt">静岡美容外科橋本クリニックを一緒に盛り上げてくれる<br>新しい仲間を募集いたします。</p>
                            <img class="el_recruitContainer_copyWrapper_iconBottom" src="<?php echo get_template_directory_uri(); ?>/assets/img/recruit/recruit-about-icon-bottom.svg" alt="">
                        </div>

                        <?php if (have_rows('philosophy-list')): ?>
                            <div class="bl_recruitContainer_philosophyContainer">
                                <h2 class="el_recruitContainer_philosophyContainer_ttl">静岡美容外科橋本クリニックの医療理念</h2>

                                <div class="bl_recruitContainer_philosophyContainer_list">
                                    <?php $i = 0;
                                    while (have_rows('philosophy-list')): the_row();
                                        $i++; ?>
                                        <div class="bl_recruitContainer_philosophyContainer_list_item">
                                            <div class="bl_recruitContainer_philosophyContainer_list_item_ttlContainer">
                                                <p class="el_recruitContainer_philosophyContainer_list_item_ttlContainer_num"><?php echo sprintf('%02d', $i); ?></p>
                                                <?php if (get_sub_field('philosophy-list-ttl')): ?>
                                                    <p class="el_recruitContainer_philosophyContainer_list_item_ttlContainer_ttl"><?php the_sub_field('philosophy-list-ttl'); ?></p>
                                                <?php endif; ?>
                                            </div>

                                            <div class="bl_recruitContainer_philosophyContainer_list_item_lower">
                                                <?php if (get_sub_field('philosophy-list-img')): ?>
                                                    <img class="el_recruitContainer_philosophyContainer_list_item_lower_img" src="<?php the_sub_field('philosophy-list-img'); ?>" alt="">
                                                <?php else: ?>
                                                    <img class="el_recruitContainer_philosophyContainer_list_item_lower_img" src="<?php echo get_template_directory_uri(); ?>/assets/img/recruit/noimage-doc.jpg" alt="">
                                                <?php endif; ?>
                                                <?php if (get_sub_field('philosophy-list-txt')): ?>
                                                    <p><?php the_sub_field('philosophy-list-txt'); ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            </div>
                        <?php endif; ?>



                        <div class="bl_recruitContainer_flowContainer">
                            <div class="bl_recruitContainer_flowContainer_inner">
                                <h2 class="el_recruitContainer_flowContainer_ttl">選考の流れ</h2>

                                <ul class="bl_recruitContainer_flowContainer_list">
                                    <li class="bl_recruitContainer_flowContainer_list_item">
                                        <div class="bl_recruitContainer_flowContainer_list_item_ttl">
                                            <p class="el_recruitContainer_flowContainer_list_item_ttl_num">01</p>
                                            <p class="el_recruitContainer_flowContainer_list_item_ttl_txt">応募受付</p>
                                        </div>

                                        <div class="bl_recruitContainer_flowContainer_list_item_contents">
                                            <p class="el_recruitContainer_flowContainer_list_item_contents_txt">下記勤務地住所宛にて履歴書の送付をお願いします。<br>いただいた履歴書で書類選考を行い、通過者のみこちらからご連絡させていただきます。</p>

                                            <div class="bl_recruitContainer_flowContainer_list_item_contents_address">
                                                <p class="el_recruitContainer_flowContainer_list_item_contents_address_ttl">勤務地住所</p>
                                                <p class="el_recruitContainer_flowContainer_list_item_contents_address_txt">静岡美容外科橋本クリニック<br>
                                                    静岡県静岡市葵区紺屋町7-15 Y'sPLATZ 1F・2F</p>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="bl_recruitContainer_flowContainer_list_item">
                                        <div class="bl_recruitContainer_flowContainer_list_item_ttl">
                                            <p class="el_recruitContainer_flowContainer_list_item_ttl_num">02</p>
                                            <p class="el_recruitContainer_flowContainer_list_item_ttl_txt">面接</p>
                                        </div>

                                        <div class="bl_recruitContainer_flowContainer_list_item_contents">
                                            <p class="el_recruitContainer_flowContainer_list_item_contents_txt">面接にお越しの際は、履歴書(写貼)・職務経歴書をご持参ください。看護師の方は資格証明書のコピーもあわせてご持参ください。</p>

                                            <div class="bl_recruitContainer_flowContainer_list_item_contents_note">
                                                <p class="el_recruitContainer_flowContainer_list_item_contents_note_txt">※ 応募書類は返却致しませんので予めご了承ください。</p>
                                                <p class="el_recruitContainer_flowContainer_list_item_contents_note_txt">※ 面接日、勤務開始日はご希望に応じます。お気軽にご相談ください。</p>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="bl_recruitContainer_flowContainer_list_item">
                                        <div class="bl_recruitContainer_flowContainer_list_item_ttl">
                                            <p class="el_recruitContainer_flowContainer_list_item_ttl_num">03</p>
                                            <p class="el_recruitContainer_flowContainer_list_item_ttl_txt">採用</p>
                                        </div>

                                        <div class="bl_recruitContainer_flowContainer_list_item_contents">
                                            <p class="el_recruitContainer_flowContainer_list_item_contents_txt">書類選考が通過次第、面接となります。</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="bl_recruitContainer_flowContainer_contactContainer">
                                <p class="el_recruitContainer_flowContainer_contactContainer_txt">ご質問等は、下記アドレスへお気軽にお問合わせください。</p>

                                <div class="bl_recruitContainer_flowContainer_contactContainer_contactWrapper">
                                    <p class="el_recruitContainer_flowContainer_contactContainer_contactWrapper_ttl">連絡先/採用担当者</p>

                                    <p class="el_recruitContainer_flowContainer_contactContainer_contactWrapper_txt">MAIL：<a class="el_recruitContainer_flowContainer_contactContainer_contactWrapper_txt_mail" href="mailto:shizuoka@hashimotoclinic.co.jp">shizuoka@hashimotoclinic.co.jp</a></p>
                                    <p class="el_recruitContainer_flowContainer_contactContainer_contactWrapper_txt">TEL：<a class="el_recruitContainer_flowContainer_contactContainer_contactWrapper_txt_tel" href="tel:054-266-9722">054-266-9722</a></p>
                                </div>
                            </div>
                        </div>


                        <?php
                        $recruitPostList = get_posts(array(
                            'post_type' => 'recruit',
                            'posts_per_page' => -1,
                            'orderby' => 'menu_order',
                            'order' => 'ASC',
                        ));
                        ?>
                        <?php if (!empty($recruitPostList)): ?>
                            <div class="bl_recruitContainer_recruitPostContainer">
                                <h2 class="el_recruitContainer_recruitPostContainer_ttl">募集一覧</h2>

                                <div class="bl_recruitContainer_recruitPostContainer_list">
                                    <?php foreach ($recruitPostList as $recruitPost): ?>
                                        <div class="bl_recruitContainer_recruitPostContainer_list_item">
                                            <details class="bl_recruitContainer_recruitPostContainer_details">
                                                <summary class="bl_recruitContainer_recruitPostContainer_details_summary">
                                                    <span class="el_recruitContainer_recruitPostContainer_details_summary_txt"><?php echo get_the_title($recruitPost); ?></span>
                                                    <span class="el_recruitContainer_recruitPostContainer_details_summary_icon"></span>
                                                </summary>
                                                <div class="bl_recruitContainer_recruitPostContainer_details_content">
                                                    <div class="bl_recruitContainer_recruitPostContainer_details_content_inner">
                                                        <?php if (have_rows('jobinfo-list', $recruitPost)): ?>
                                                            <ul class="bl_recruitContainer_recruitPostContainer_details_contentList">
                                                                <?php while (have_rows('jobinfo-list', $recruitPost)): the_row(); ?>
                                                                    <li class="bl_recruitContainer_recruitPostContainer_details_contentList_item">
                                                                        <dl class="bl_recruitContainer_recruitPostContainer_details_contentList_dl">
                                                                            <dt class="el_recruitContainer_recruitPostContainer_details_contentList_dl_ttl"><?php the_sub_field('jobinfo-list-ttl'); ?></dt>
                                                                            <dd class="el_recruitContainer_recruitPostContainer_details_contentList_dl_contents"><?php the_sub_field('jobinfo-list-contents'); ?></dd>
                                                                        </dl>
                                                                    </li>
                                                                <?php endwhile; ?>
                                                            </ul>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </details>
                                        </div>
                                    <?php endforeach; ?>
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