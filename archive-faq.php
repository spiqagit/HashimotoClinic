<?php get_header('meta'); ?>
<?php wp_head(); ?>
<!-- リッチリザルト（構造化データ: FAQPage用） -->
<?php
$faq_terms = get_terms('faq-cat', array(
    'orderby' => 'term_id',
    'order' => 'menu_order',
    'hide_empty' => true,
    'parent' => 0,
));
?>
<?php if (!empty($faq_terms)): ?>
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "FAQPage",
            "mainEntity": [
                <?php
                $faq_json = [];
                foreach ($faq_terms as $faq_term) {
                    // 各カテゴリ内のFAQ投稿を取得
                    $faq_query = new WP_Query(array(
                        'post_type' => 'faq',
                        'posts_per_page' => -1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'faq-cat',
                                'field' => 'term_id',
                                'terms' => $faq_term->term_id,
                            )
                        )
                    ));
                    if ($faq_query->have_posts()) :
                        while ($faq_query->have_posts()) : $faq_query->the_post();
                            $question = get_the_title();
                            $answer = get_the_content();
                            // 改行や余計なHTMLを除去して整形
                            $answer = strip_tags(apply_filters('the_content', $answer));
                            $answer = trim(preg_replace('/\s+/', ' ', $answer));
                            $faq_json[] = '{
                  "@type": "Question",
                  "name": ' . json_encode($question) . ',
                  "acceptedAnswer": {
                    "@type": "Answer",
                    "text": ' . json_encode($answer) . '
                  }
                }';
                        endwhile;
                        wp_reset_postdata();
                    endif;
                }
                // カンマ区切りで出力
                echo implode(",\n", $faq_json);
                ?>
            ]
        }
    </script>
<?php endif; ?>

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
                    <p class="bl_commonlowerPage_ttl_enTtl">FAQ</p>
                    <h1 class="bl_commonlowerPage_ttl_jaTtl">よくある質問</h1>
                </hgroup>
                <?php get_template_part('inc/breadcrumbs'); ?>
            </div>


            <?php
            $faq_terms = get_terms('faq-cat', array(
                'orderby' => 'term_id',
                'order' => 'menu_order',
                'hide_empty' => true,
                'parent' => 0,
            ));
            ?>
            <div class="bl_commonlowerPage_contents">
                <section class="bl_faqArchive">
                    <div class="bl_faqArchive_inner">
                        <div class="bl_faqArchive_navContainer">
                            <nav class="bl_faqArchive_nav is-pc">
                                <p class="bl_faqArchive_nav_ttl">カテゴリー</p>

                                <?php if (!empty($faq_terms)): ?>
                                    <ul class="bl_faqArchive_nav_list">
                                        <?php foreach ($faq_terms as $faq_term): ?>
                                            <li class="bl_faqArchive_nav_list_item">
                                                <a href="#<?php echo $faq_term->slug; ?>" class="el_faqArchive_nav_list_item_link">
                                                    <span class="el_faqArchive_nav_list_item_link_txt"><?php echo $faq_term->name; ?></span>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </nav>

                            <nav class="bl_faqArchive_nav is-sp">
                                <button class="bl_faqArchive_nav_btn" type="button">
                                    <span class="el_faqArchive_nav_btn_txt">カテゴリー</span>
                                    <img class="el_faqArchive_nav_btn_arrow" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/btn-nav-arrow.svg" alt="">
                                </button>

                                <div class="bl_faqArchive_nav_listContainer">
                                    <?php if (!empty($faq_terms)): ?>
                                        <ul class="bl_faqArchive_nav_list">
                                            <?php foreach ($faq_terms as $faq_term): ?>
                                                <li class="bl_faqArchive_nav_list_item">
                                                    <a href="#<?php echo $faq_term->slug; ?>" class="el_faqArchive_nav_list_item_link">
                                                        <span class="el_faqArchive_nav_list_item_link_txt"><?php echo $faq_term->name; ?></span>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </div>
                            </nav>
                        </div>

                        <div class="bl_faqArchive_contents">
                            <?php if (!empty($faq_terms)): ?>
                                <?php foreach ($faq_terms as $faq_term): ?>
                                    <div id="<?php echo esc_attr($faq_term->slug); ?>" class="bl_faqArchive_contents_item">
                                        <h2 class="el_faqArchive_contents_item_ttl"><?php echo $faq_term->name; ?></h2>
                                        <?php $faq_posts = get_posts(array(
                                            'post_type' => 'faq',
                                            'posts_per_page' => -1,
                                            'fields' => 'ids',
                                            'tax_query' => array(
                                                array(
                                                    'taxonomy' => 'faq-cat',
                                                    'field' => 'term_id',
                                                    'terms' => $faq_term->term_id,
                                                ),
                                            ),
                                        )); ?>
                                        <?php if (!empty($faq_posts)): ?>
                                            <?php foreach ($faq_posts as $faq_post): ?>
                                                <div class="bl_commonFaqList">
                                                    <details class="bl_commonFaqList_details js-details">
                                                        <summary class="bl_commonFaqList_details_summary is-summary">
                                                            <span class="bl_commonFaqList_details_summary_txt">
                                                                <span class="el_commonFaqList_details_summary_txt_en">Q.</span>
                                                                <span class="el_commonFaqList_details_summary_txt_ttl"><?php echo get_the_title($faq_post); ?></span>
                                                            </span>
                                                            <span class="el_commonFaqList_details_summary_icon"></span>
                                                        </summary>
                                                        <div class="bl_commonFaqList_details_content is-details-content">
                                                            <div class="bl_commonFaqList_details_content_inner">
                                                                <p class="el_commonFaqList_details_content_inner_txt"><?php echo get_field('faq-txt', $faq_post); ?></p>
                                                            </div>
                                                        </div>
                                                    </details>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>
    <?php get_footer(); ?>
</body>

</html>