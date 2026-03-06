<?php
/*
 * Template Name: About
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
                    <p class="bl_commonlowerPage_ttl_enTtl">About</p>
                    <h1 class="bl_commonlowerPage_ttl_jaTtl">クリニックについて</h1>
                </hgroup>
                <?php get_template_part('inc/breadcrumbs'); ?>
            </div>


            <div class="bl_commonlowerPage_contents">

                <div class="bl_infoAboutContainer">
                    <div class="bl_infoAboutContainer_inner">
                        <h2 class="el_infoAboutContainer_ttl">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/ttl-icon-left.svg" alt="">
                            <span class="el_infoAboutContainer_ttl_txt">About</span>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/ttl-icon-right.svg" alt="">
                        </h2>

                        <div class="bl_infoAboutContainer_copyWrapper">
                            <p class="el_infoAboutContainer_copyWrapper_txt">自然な美しさ、確かな安心。<br>12万症例の経験を、<br class="is-sp">あなたの自信に。</p>
                        </div>

                        <div class="bl_infoAboutContainer_txtWrapper">
                            <p class="el_infoAboutContainer_txtWrapper_txt">15年にわたり全国で12万症例以上を手がけてきた実績をもとに、<br>
                                当院では｢安心・安全な美容医療｣を信念とし、一人ひとりに寄り添った施術を提供しています。</p>
                            <p class="el_infoAboutContainer_txtWrapper_txt">美容皮膚科から美容外科まで幅広い領域を、美容医療15年目の医師2名と、その指導を受けた医師たちが担当し、<br>
                                静岡の皆さまに確かな技術と信頼できる医療をお届けします。</p>
                            <p class="el_infoAboutContainer_txtWrapper_txt">施術前の不安から施術後のケアまで、いつでも安心して通えるクリニックを目指しています。</p>
                        </div>
                    </div>
                </div>


                <div class="bl_infoFeatureContainer">
                    <div class="bl_infoFeatureContainer_inner">

                        <div class="bl_infoContainer_borderTtlWrapper">
                            <h3 class="el_infoContainer_borderTtlWrapper_txt">クリニックの特徴</h3>
                        </div>

                        <ol class="bl_infoContainer_featureList">
                            <li class="bl_infoContainer_featureList_item">
                                <p class="el_infoContainer_featureList_item_num">01</p>
                                <div class="bl_infoContainer_featureList_item_txtWrapper">
                                    <h4 class="el_infoContainer_featureList_item_txtWrapper_copy">医師による<br>誠実なカウンセリング</h4>
                                    <p class="el_infoContainer_featureList_item_txtWrapper_txt">カウンセラー任せにせず、医師が直接、手術内容からリスクまで十分に説明します。ご納得いただかないまま施術を勧めることはありません。</p>
                                </div>
                            </li>

                            <li class="bl_infoContainer_featureList_item">
                                <p class="el_infoContainer_featureList_item_num">02</p>
                                <div class="bl_infoContainer_featureList_item_txtWrapper">
                                    <h4 class="el_infoContainer_featureList_item_txtWrapper_copy">追加費用のない<br>「完全明朗会計」</h4>
                                    <p class="el_infoContainer_featureList_item_txtWrapper_txt">HP表示価格には、麻酔・薬代・カウンセリング料がすべて含まれています。剃り残し対応などの不透明な追加費用は一切ございません。</p>
                                </div>
                            </li>

                            <li class="bl_infoContainer_featureList_item">
                                <p class="el_infoContainer_featureList_item_num">03</p>
                                <div class="bl_infoContainer_featureList_item_txtWrapper">
                                    <h4 class="el_infoContainer_featureList_item_txtWrapper_copy">「痛み・腫れ」を<br>最小限に抑える技術</h4>
                                    <p class="el_infoContainer_featureList_item_txtWrapper_txt">極細針の使用や熟練のスピード施術により、身体への負担を軽減。患者様が一番不安に思う「痛み」に対し、最大限の配慮を尽くします。</p>
                                </div>
                            </li>

                            <li class="bl_infoContainer_featureList_item">
                                <p class="el_infoContainer_featureList_item_num">04</p>
                                <div class="bl_infoContainer_featureList_item_txtWrapper">
                                    <h4 class="el_infoContainer_featureList_item_txtWrapper_copy">1年間の充実したアフターケア</h4>
                                    <p class="el_infoContainer_featureList_item_txtWrapper_txt">すべての施術に1年間のアフターケア料金が含まれています。術後の些細な不安も、遠慮なくご相談いただける体制を整えています。</p>
                                </div>
                            </li>

                            <li class="bl_infoContainer_featureList_item">
                                <p class="el_infoContainer_featureList_item_num">05</p>
                                <div class="bl_infoContainer_featureList_item_txtWrapper">
                                    <h4 class="el_infoContainer_featureList_item_txtWrapper_copy">モニター価格に<br>頼らない適正価格</h4>
                                    <p class="el_infoContainer_featureList_item_txtWrapper_txt">当院の基本料金は、モニター前提の価格ではありません。どなたでも安心して受けていただける適正価格を提示し、モニターご協力時にはさらに割引を適用いたします。</p>
                                </div>
                            </li>

                            <li class="bl_infoContainer_featureList_item">
                                <p class="el_infoContainer_featureList_item_num">06</p>
                                <div class="bl_infoContainer_featureList_item_txtWrapper">
                                    <h4 class="el_infoContainer_featureList_item_txtWrapper_copy">わたくし、橋本健太郎は<br>美容外科医でありながら<br>整形顔が嫌いです</h4>
                                    <p class="el_infoContainer_featureList_item_txtWrapper_txt"> どの施術においても｢いかにも整形しています｣の仕上りではなく、｢自然に生まれながら｣のように｢昔のあなた｣のように仕上げることをポリシーとして施術させて頂いております。</p>
                                </div>
                            </li>
                        </ol>
                    </div>
                </div>


                <div class="bl_infoFlowContainer">
                    <div class="bl_infoFlowContainer_inner">
                        <div class="bl_infoContainer_borderTtlWrapper">
                            <h3 class="el_infoContainer_borderTtlWrapper_txt">診療の流れ</h3>
                        </div>

                        <div class="bl_infoFlowContainer_listWrapper">
                            <div class="bl_infoFlowContainer_imgWrapper">
                                <div class="bl_infoFlowContainer_imgList">
                                    <img class="el_infoFlowContainer_imgList_img is-active" data-id="flow-01" src="<?php echo get_template_directory_uri(); ?>/assets/img/about/flow-01.jpg" alt="ご予約・無料相談">
                                    <img class="el_infoFlowContainer_imgList_img" data-id="flow-02" src="<?php echo get_template_directory_uri(); ?>/assets/img/about/flow-02.jpg" alt="ご来院・無料カウンセリング">
                                    <img class="el_infoFlowContainer_imgList_img" data-id="flow-03" src="<?php echo get_template_directory_uri(); ?>/assets/img/about/flow-03.jpg" alt="治療・施術">
                                    <img class="el_infoFlowContainer_imgList_img" data-id="flow-04" src="<?php echo get_template_directory_uri(); ?>/assets/img/about/flow-04.jpg" alt="アフターケア">
                                </div>
                            </div>
                            <div class="bl_infoFlowContainer_numListWrapper">
                                <ol class="bl_infoFlowContainer_numList">
                                    <li class="bl_infoFlowContainer_numList_item" id="flow-01">
                                        <img class="el_infoFlowContainer_numList_item_img" src="<?php echo get_template_directory_uri(); ?>/assets/img/about/flow-01.jpg" alt="ご予約・無料相談">
                                        <div class="bl_infoFlowContainer_numList_item_ttlWrapper">
                                            <p class="el_infoFlowContainer_numList_item_ttlWrapper_num">01</p>
                                            <h4 class="el_infoFlowContainer_numList_item_ttlWrapper_txt">ご予約・無料相談</h4>
                                        </div>

                                        <div class="bl_infoFlowContainer_infoWrapper">
                                            <div class="bl_infoFlowContainer_infoWrapper_item">
                                                <h4 class="el_infoFlowContainer_infoWrapper_item_txt">メールでのご相談</h4>
                                                <div class="bl_header_contentsWrapper_ctaWrapper">
                                                    <a href="<?php echo home_url(); ?>/contact/" class="bl_commonCtaBtn">
                                                        <div class="bl_commonCtaBtn_inner">
                                                            <p class="el_commonCtaBtn_txt">お問い合わせ</p>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="bl_infoFlowContainer_infoWrapper_item">
                                                <h4 class="el_infoFlowContainer_infoWrapper_item_txt">お電話でのご相談</h4>
                                                <a class="el_infoFlowContainer_infoWrapper_item_telLink" href="tel:<?php echo get_field('tel', 'option'); ?>">
                                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/tel-icon.svg" alt="">
                                                    <p class="el_infoFlowContainer_infoWrapper_item_telLink_txt"><?php echo get_field('tel', 'option'); ?></p>
                                                </a>
                                                <p class="el_infoFlowContainer_infoWrapper_item_telTime">(受付時間 11:00〜20:00)</p>
                                            </div>
                                        </div>
                                    </li>


                                    <li class="bl_infoFlowContainer_numList_item" id="flow-02">
                                        <img class="el_infoFlowContainer_numList_item_img" src="<?php echo get_template_directory_uri(); ?>/assets/img/about/flow-02.jpg" alt="ご来院・無料カウンセリング">

                                        <div class="bl_infoFlowContainer_numList_item_ttlWrapper">
                                            <p class="el_infoFlowContainer_numList_item_ttlWrapper_num">02</p>
                                            <h4 class="el_infoFlowContainer_numList_item_ttlWrapper_txt">ご来院・無料カウンセリング</h4>
                                        </div>

                                        <div class="bl_infoFlowContainer_numList_item_txtWrapper">
                                            <p class="el_infoFlowContainer_numList_item_txt">ご来院後、医師がカウンセリングを行い、お悩み・ご希望・不安点を丁寧におうかがいします。最適な施術をご提案し、ご納得いただけるまで分かりやすく説明いたします。どんな些細なことでも遠慮なくご相談ください。</p>
                                        </div>
                                    </li>

                                    <li class="bl_infoFlowContainer_numList_item" id="flow-03">
                                        <img class="el_infoFlowContainer_numList_item_img" src="<?php echo get_template_directory_uri(); ?>/assets/img/about/flow-03.jpg" alt="治療・施術">

                                        <div class="bl_infoFlowContainer_numList_item_ttlWrapper">
                                            <p class="el_infoFlowContainer_numList_item_ttlWrapper_num">03</p>
                                            <h4 class="el_infoFlowContainer_numList_item_ttlWrapper_txt">治療・施術</h4>
                                        </div>

                                        <div class="bl_infoFlowContainer_numList_item_txtWrapper">
                                            <p class="el_infoFlowContainer_numList_item_txt">医師とのカウンセリングで決定した治療や施術を行います。術前に写真撮影、洗顔をしていただきます。洗顔料等はこちらで用意いたしております。</p>
                                        </div>
                                    </li>

                                    <li class="bl_infoFlowContainer_numList_item" id="flow-04">
                                        <img class="el_infoFlowContainer_numList_item_img" src="<?php echo get_template_directory_uri(); ?>/assets/img/about/flow-04.jpg" alt="アフターケア">

                                        <div class="bl_infoFlowContainer_numList_item_ttlWrapper">
                                            <p class="el_infoFlowContainer_numList_item_ttlWrapper_num">04</p>
                                            <h4 class="el_infoFlowContainer_numList_item_ttlWrapper_txt">アフターケア</h4>
                                        </div>

                                        <div class="bl_infoFlowContainer_numList_item_txtWrapper">
                                            <p class="el_infoFlowContainer_numList_item_txt">当院では治療施術後1年間のアフターケア料金が施術料金に含まれます。治療や施術にご不安なことがございましたら、どのような些細なご相談もご遠慮なくお申しつけ下さい。</p>
                                        </div>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="bl_infoBranchClinicContainer">
                    <div class="bl_infoBranchClinicContainer_inner">
                        <div class="bl_infoContainer_borderTtlWrapper">
                            <h3 class="el_infoContainer_borderTtlWrapper_txt">院内紹介</h3>
                        </div>

                        <p class="el_infoContainer_introTxt">ご来院されるすべての方が、心地よく安心して過ごせる環境づくりを大切にしています。</p>

                        <div class="bl_infoBranchClinicSlideContainer">
                            <?php
                            $clinicPostList = get_posts(array(
                                'post_type' => 'clinic',
                                'posts_per_page' => -1,
                                'orderby' => 'menu_order',
                                'order' => 'ASC',
                            ));
                            ?>
                            <?php if (!empty($clinicPostList)): ?>
                                <?php foreach ($clinicPostList as $clinicPost): ?>

                                    <?php if (have_rows('clinic-imglist', $clinicPost->ID)): ?>
                                        <div class="bl_infoBranchClinicSlideContainer_item">
                                            <h4 class="el_infoBranchClinicSlideContainer_item_ttl">
                                                <?php
                                                $clinicTitle = str_replace('静岡美容外科橋本クリニック', '', get_the_title($clinicPost));
                                                echo trim($clinicTitle, " \t\n\r\0\x0B　");
                                                ?>
                                            </h4>


                                            <div class="bl_clinicSwiperWrapper">
                                                <div class="swiper bl_clinicSwiper">
                                                    <div class="swiper-wrapper">
                                                        <?php while (have_rows('clinic-imglist', $clinicPost->ID)): the_row(); ?>
                                                            <div class="swiper-slide">
                                                                <img class="el_clinicSwiper_img" src="<?php the_sub_field('clinic-imglist-img'); ?>" alt="<?php the_sub_field('clinic-imglist-alt'); ?>">
                                                            </div>
                                                        <?php endwhile; ?>
                                                    </div>
                                                </div>
                                                <div class="bl_clinicSwiper_btnWrapper">
                                                    <button class="bl_clinicSwiper_prev" type="button">
                                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow-prev.svg" alt="">
                                                    </button>
                                                    <button class="bl_clinicSwiper_next" type="button">
                                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow-next.svg" alt="">
                                                    </button>
                                                </div>
                                                <div class="bl_clinicSwiper_pagination"></div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>


                <div class="bl_infoUnderContainerOuter">
                    <div class="bl_infoUnderContainer">
                        <div class="bl_infoUnderContainer_inner">
                            <h3 class="el_infoUnderContainer_ttl">未成年で<br class="is-sp">施術を希望される方へ</h3>

                            <div class="bl_infoUnderContainer_txtWrapper">
                                <p class="el_infoUnderContainer_txtWrapper_txt">静岡美容外科クリニックでは、未成年の方が施術を受けられる場合、保護者の方の同伴または同意書のご提出が必要となります。中学生以下の方は、同意書のご持参に加えて、保護者の方の同伴をお願いしております。あらかじめご了承ください。<br>
                                    同意書は下記リンクよりダウンロードいただけます。<br>
                                    プリントアウトのうえ、必要事項をご記入いただき、ご来院時にご提出ください。</p>

                                <ul class="bl_infoUnderContainer_txtWrapper_list">
                                    <li class="bl_infoUnderContainer_txtWrapper_list_item">プリンターをお持ちでない場合、保護者の方の手書きでも構いません。同意書に記載された各項目にもれがないようご記入ください。</li>
                                    <li class="bl_infoUnderContainer_txtWrapper_list_item">同意書はクリニックにもご用意しています。必要な際には受付にお申しつけください。</li>
                                </ul>
                            </div>

                            <?php if (get_field('download-file', 'option')): ?>
                                <a href="<?php echo get_field('download-file', 'option') ?>" download class="bl_commonDownloadBtn">
                                    <p class="el_commonCtaBtn_txt">同意書を<br class="is-sp">ダウンロード</p>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/download-icon.svg" alt="">
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <?php get_footer(); ?>
</body>

</html>