<?php
/*
 * Template Name: Monitor
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
                    <p class="bl_commonlowerPage_ttl_enTtl">Monitor</p>
                    <h1 class="bl_commonlowerPage_ttl_jaTtl">モニター募集</h1>
                </hgroup>
                <?php get_template_part('inc/breadcrumbs'); ?>
            </div>


            <div class="bl_commonlowerPage_contents">
                <div class="bl_monitorContainer">
                    <div class="bl_monitorContainer_inner">


                        <div class="bl_monitorContainer_aboutWrapper">
                            <img class="el_monitorContainer_aboutWrapper_img el_monitorContainer_aboutWrapper_img01" src="<?php echo get_template_directory_uri(); ?>/assets/img/monitor/monitor-img-01.jpg" alt="">
                            <div class="bl_monitorContainer_aboutWrapper_txtWrapper">
                                <p class="el_monitorContainer_aboutWrapper_txtWrapper_txt">
                                    <span class="el_monitorContainer_aboutWrapper_txtWrapper_txt_line">静岡美容外科 橋本クリニックの<br class="is-sp">モニターとして<br class="is-pc">ご協力頂ける方を<br class="is-sp">募集しております。</span>
                                </p>
                                <p class="el_monitorContainer_aboutWrapper_txtWrapper_noteTxt">ご興味のある方は、男女問わず<br class="is-sp">ご応募お待ちしております。</p>
                            </div>
                            <img class="el_monitorContainer_aboutWrapper_img el_monitorContainer_aboutWrapper_img02" src="<?php echo get_template_directory_uri(); ?>/assets/img/monitor/monitor-img-02.jpg" alt="">
                        </div>


                        <div class="bl_monitorContainer_infoWrapper">
                            <h2 class="bl_monitorContainer_infoWrapper_ttl">美容整形モニターとは？</h2>

                            <div class="bl_monitorContainer_infoWrapper_txtWrapper">
                                <p class="bl_monitorContainer_infoWrapper_txtWrapper_txt">
                                    モニター様には術前、術後、経過の写真を撮影させて頂きます。<br>
                                    こちらのお写真は、ご来院頂いた患者様にお見せする資料として、<br>
                                    また当院ホームページ・雑誌・パンフレット等の広告に使用させていただきます。
                                </p>

                                <p class="el_monitorContainer_infoWrapper_txtWrapper_noteTxt">様々な規約がございますので、<span class="el_monitorContainer_infoWrapper_txtWrapper_noteTxt_line">モニターでのご利用をご希望の場合は、お電話にて</span>是非ご相談下さいませ。</p>

                                <div class="bl_monitorContainer_boxWrapper">
                                    <div class="bl_monitorContainer_boxWrapper_item">
                                        <p class="el_monitorContainer_boxWrapper_item_ttl">撮影部位</p>
                                        <ul class="bl_monitorContainer_boxWrapper_item_list">
                                            <li class="el_monitorContainer_boxWrapper_item_list_item">一部パーツ(モザイクあり)</li>
                                            <li class="el_monitorContainer_boxWrapper_item_list_item">お顔全体(モザイク無し)</li>
                                        </ul>
                                    </div>
                                    <div class="bl_monitorContainer_boxWrapper_item">
                                        <p class="el_monitorContainer_boxWrapper_item_ttl">ご協力いただく内容</p>
                                        <div class="bl_monitorContainer_boxWrapper_item_txtWrapper">
                                            <p class="el_monitorContainer_boxWrapper_item_txtWrapper_txt">写真･体験談</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="bl_monitorContainer_conditionWrapper">
                            <div class="bl_monitorContainer_conditionWrapper_inner">
                                <h2 class="el_monitorContainer_conditionWrapper_ttl">応募条件</h2>

                                <ul class="bl_monitorContainer_conditionWrapper_list">
                                    <li class="bl_monitorContainer_conditionWrapper_list_item">原則として20歳以上の方。未成年様の場合は親権者様のモニター手術同意書が必要となります。</li>
                                    <li class="bl_monitorContainer_conditionWrapper_list_item">術前・術後・当院の指定する検診時の写真撮影にご協力頂く為、複数回通院が可能な方。(交通費は自己負担です)</li>
                                    <li class="bl_monitorContainer_conditionWrapper_list_item">モニター様のアンケートにご協力頂ける方。</li>
                                </ul>
                            </div>
                        </div>


                        <div class="bl_monitorContainer_flowWrapper">
                            <h2 class="el_monitorContainer_flowWrapper_ttl">応募から施術の流れ</h2>

                            <ol class="bl_monitorContainer_flowList">
                                <li class="bl_monitorContainer_flowList_item">
                                    <div class="bl_monitorContainer_flowList_item_imgWrapper">
                                        <img class="el_monitorContainer_flowList_item_img" src="<?php echo get_template_directory_uri(); ?>/assets/img/monitor/flow-icon01.svg" alt="カレンダーのアイコン">
                                    </div>
                                    <div class="bl_monitorContainer_flowList_item_txtWrapper">
                                        <p class="el_monitorContainer_flowList_item_txtWrapper_num">01</p>
                                        
                                        <p class="el_monitorContainer_flowList_item_txtWrapper_txt">お電話またはHP問い合わせメールにてカウンセリングのご予約をお取り下さい。<br>その際にご希望の施術内容、モニター様をご希望の旨をお伝え下さい。</p>
                                        <p class="el_monitorContainer_flowList_item_txtWrapper_noteTxt">※対象の施術に関しましては、お問い合わせください</p>

                                        <div class="bl_monitorContainer_flowList_item_btnWrapper">
                                            <?php if (get_field('tel', 'option')): ?>
                                                <a href="tel:<?php echo get_field('tel', 'option'); ?>" class="el_monitorContainer_flowList_item_btnWrapper_telLink">
                                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/tel-icon.svg" alt="">
                                                    <p class="el_monitorContainer_flowList_item_btnWrapper_txt"><?php echo get_field('tel', 'option'); ?></p>
                                                </a>
                                            <?php endif; ?>

                                            <a href="<?php echo home_url(); ?>/contact/" class="bl_commonCtaBtn">
                                                <div class="bl_commonCtaBtn_inner">
                                                    <p class="el_commonCtaBtn_txt">お問い合わせ</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <li class="bl_monitorContainer_flowList_item">
                                    <div class="bl_monitorContainer_flowList_item_imgWrapper">
                                        <img class="el_monitorContainer_flowList_item_img" src="<?php echo get_template_directory_uri(); ?>/assets/img/monitor/flow-icon02.svg" alt="医師のアイコン">
                                    </div>
                                    <div class="bl_monitorContainer_flowList_item_txtWrapper">
                                        <p class="el_monitorContainer_flowList_item_txtWrapper_num">02</p>
                                        
                                        <p class="el_monitorContainer_flowList_item_txtWrapper_txt">医師によるカウンセリングを受けて頂きます。その際にご希望の手術内容が、モニター様として適応があるかどうか診察させて頂きます。
                                        モニターの採否は、原則としてドクターの診察後に決定させて頂きます。</p>
                                    </div>
                                </li>
                                <li class="bl_monitorContainer_flowList_item">
                                    <div class="bl_monitorContainer_flowList_item_imgWrapper">
                                        <img class="el_monitorContainer_flowList_item_img" src="<?php echo get_template_directory_uri(); ?>/assets/img/monitor/flow-icon03.svg" alt="施術のアイコン">
                                    </div>
                                    <div class="bl_monitorContainer_flowList_item_txtWrapper">
                                        <p class="el_monitorContainer_flowList_item_txtWrapper_num">03</p>
                                        
                                        <p class="el_monitorContainer_flowList_item_txtWrapper_txt">モニター様として適応がある場合は、施術内容、施術日時をご相談の上、施術をお受け頂きます。</p>
                                    </div>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php get_footer(); ?>
</body>

</html>