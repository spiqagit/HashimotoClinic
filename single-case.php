<?php get_header('meta'); ?>
<?php wp_head(); ?>
</head>

<body>

    <?php get_header(); ?>

    <main class="bl_commonArticlePage">
        <div class="bl_commonArticlePage_inner">
            <article class="bl_newsArticle">
                <div class="bl_commonArticle_header">
                    <div class="bl_commonArticle_header_inner">
                        <div class="bl_commonArticle_header_inner_upper">
                            <?php if (get_field('menu_select')): ?>
                                <div class="bl_commonArticle_header_relatedMenuList">
                                    <?php foreach (get_field('menu_select') as $menu): ?>
                                        <p class="el_commonArticle_header_relatedMenuList_item"><?php echo get_the_title($menu); ?></p>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            <h1 class="el_commonArticle_header_ttl">
                                <?php the_title(); ?>
                            </h1>
                        </div>
                        <?php get_template_part('inc/breadcrumbs'); ?>
                    </div>
                </div>

                <div class="bl_caseArticle_contents">
                    <div class="bl_caseArticle_contents_inner">
                        <div class="bl_caseArticl_imgSlider">
                            <?php if (have_rows('slide')): ?>
                                <?php
                                $slide_count = count(get_field('slide'));
                                ?>
                                <div class="bl_caseArticl_imgSlider_inner">
                                    <div class="bl_caseSingleSwiperContainer">
                                        <button class="bl_caseSingleSwiper_prev">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow-prev.svg" alt="">
                                        </button>
                                        <div class="swiper bl_caseSingleSwiper">
                                            <div class="swiper-wrapper">
                                                <?php while (have_rows('slide')) : the_row(); ?>
                                                    <div class="swiper-slide">
                                                        <div class="bl_caseSingleSwiper_imgWrapper">
                                                            <img class="bl_caseSingleSwiper_img" src="<?php echo get_sub_field('img'); ?>" alt="">
                                                        </div>
                                                        <?php if (get_sub_field('caption')): ?>
                                                            <p class="bl_caseSingleSwiper_caption"><?php echo get_sub_field('caption'); ?></p>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endwhile; ?>
                                            </div>
                                        </div>
                                        <button class="bl_caseSingleSwiper_next">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow-next.svg" alt="">
                                        </button>
                                    </div>
                                    <div class="bl_caseSingleSwiper_pagination"></div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="bl_commonArticle_content">
                            <?php the_content(); ?>

                            <div class="bl_caseArticle_nfoTableContainer">
                                <table class="bl_caseArticle_nfoTableContainer_table">
                                    <?php if (get_field('case-menu')): ?>
                                        <tr class="bl_caseArticle_nfoTableContainer_item">
                                            <th>施術名</th>
                                            <td><?php echo esc_html(get_field('case-menu')); ?></td>
                                        </tr>
                                    <?php endif; ?>

                                    <?php if (get_field('case-price')): ?>
                                        <tr class="bl_caseArticle_nfoTableContainer_item">
                                            <th>施術参考料金</th>
                                            <td>
                                                <?php echo esc_html(get_field('case-price')); ?>
                                                <?php if (get_field('case-price_sub')): ?>
                                                    <span class="el_caseArticle_nfoTableContainer_item_dd_sub"><?php echo esc_html(get_field('case-price_sub')); ?></span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>

                                    <?php if (get_field('case-time')): ?>
                                        <tr class="bl_caseArticle_nfoTableContainer_item">
                                            <th>所要時間</th>
                                            <td><?php echo esc_html(get_field('case-time')); ?></td>
                                        </tr>
                                    <?php endif; ?>

                                    <?php if (get_field('case-period')): ?>
                                        <tr class="bl_caseArticle_nfoTableContainer_item">
                                            <th>治療期間</th>
                                            <td><?php echo esc_html(get_field('case-period')); ?></td>
                                        </tr>
                                    <?php endif; ?>

                                    <?php if (get_field('case-num-times')): ?>
                                        <tr class="bl_caseArticle_nfoTableContainer_item">
                                            <th>治療回数</th>
                                            <td><?php echo esc_html(get_field('case-num-times')); ?></td>
                                        </tr>
                                    <?php endif; ?>

                                    <?php if (get_field('case-downtime')): ?>
                                        <tr class="bl_caseArticle_nfoTableContainer_item">
                                            <th>ダウンタイム</th>
                                            <td><?php echo esc_html(get_field('case-downtime')); ?></td>
                                        </tr>
                                    <?php endif; ?>

                                    <?php if (get_field('case-risk')): ?>
                                        <tr class="bl_caseArticle_nfoTableContainer_item">
                                            <th>副作用・リスク</th>
                                            <td>
                                                <?php echo esc_html(get_field('case-risk')); ?>
                                                <?php if (get_field('case-risk_sub')): ?>
                                                    <span><?php echo esc_html(get_field('case-risk_sub')); ?></span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </article>


            <?php
            $menuSelect = get_field('menu_select');
            $menu_ids = array();
            if (!empty($menuSelect) && is_array($menuSelect)) {
                $menu_ids = array_unique(array_map('intval', $menuSelect));
                $menu_ids = array_filter($menu_ids);
            }

            $meta_query = array('relation' => 'OR');
            foreach ($menu_ids as $mid) {
                $meta_query[] = array(
                    'key'     => 'menu_select',
                    'value'   => '"' . $mid . '"',
                    'compare' => 'LIKE',
                );
            }

            $relatedCasePosts = array();
            if (!empty($meta_query) && count($meta_query) > 1) {
                $relatedCasePosts = get_posts(array(
                    'post_type'      => 'case',
                    'posts_per_page' => 8,
                    'post__not_in'   => array(get_the_ID()),
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                    'post_status'    => 'publish',
                    'meta_query'     => $meta_query,
                ));
            }
            ?>

            <?php if (!empty($relatedCasePosts)): ?>
                <div class="bl_caseArticle_relatedCaseContainer">

                    <div class="bl_caseArticle_relatedCaseContainer_inner">
                        <h2 class="el_caseArticle_relatedCase_ttl">関連症例</h2>

                        <div class="bl_caseArticle_relatedCase_slideContainer">
                            <div class="bl_caseArticle_relatedCase_slideContainer_slide">
                                <button class="bl_caseArticle_relatedCase_slideContainer_prev">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow-prev.svg" alt="">
                                </button>
                                <div class="swiper bl_caseArticle_relatedCase_swiper">
                                    <div class="swiper-wrapper">
                                        <?php
                                        global $post;
                                        foreach ($relatedCasePosts as $relatedCasePost):
                                            $post = $relatedCasePost;
                                            setup_postdata($post);
                                        ?>
                                            <div class="swiper-slide">
                                                <article class="bl_commonCaseCard">
                                                    <a href="<?php the_permalink(); ?>" class="bl_commonCaseCard_link">
                                                        <div class="bl_commonCaseCard_imgWrapper">
                                                            <?php
                                                            $i = 0;
                                                            if (have_rows('slide')): ?>
                                                                <?php while (have_rows('slide')): the_row(); ?>
                                                                    <?php if ($i == 0): ?>
                                                                        <img class="el_commonCaseCard_img" src="<?php the_sub_field('img'); ?>" alt="<?php the_title_attribute(); ?>">
                                                                    <?php endif; ?>
                                                                <?php $i++;
                                                                endwhile; ?>
                                                            <?php endif; ?>
                                                        </div>

                                                        <div class="bl_commonCaseCard_ttlWrapper">
                                                            <?php
                                                            $menuSelect = get_field('menu_select');
                                                            if (!empty($menuSelect) && is_array($menuSelect)):
                                                            ?>
                                                                <div class="bl_commonCaseCard_tagList">
                                                                    <?php foreach ($menuSelect as $menu_id): ?>
                                                                        <h3 class="el_commonCaseCard_tagList_item"><?php echo esc_html(get_the_title($menu_id)); ?></h3>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            <?php endif; ?>
                                                            <p class="el_commonCaseCard_ttl"><?php the_title(); ?></p>
                                                        </div>

                                                        <div class="bl_commonCaseCard_infoWrapper">
                                                            <?php if (get_field('case-menu')): ?>
                                                                <dl class="bl_commonCaseCard_infoWrapper_item">
                                                                    <dt class="el_commonCaseCard_infoWrapper_item_dt">施術名</dt>
                                                                    <dd class="el_commonCaseCard_infoWrapper_item_dd"><?php echo esc_html(get_field('case-menu')); ?></dd>
                                                                </dl>
                                                            <?php endif; ?>

                                                            <?php if (get_field('case-price')): ?>
                                                                <dl class="bl_commonCaseCard_infoWrapper_item">
                                                                    <dt class="el_commonCaseCard_infoWrapper_item_dt">施術参考料金</dt>
                                                                    <dd class="el_commonCaseCard_infoWrapper_item_dd">
                                                                        <?php echo esc_html(get_field('case-price')); ?>
                                                                        <?php if (get_field('case-price_sub')): ?>
                                                                            <span class="el_commonCaseCard_infoWrapper_item_dd_sub"><?php echo esc_html(get_field('case-price_sub')); ?></span>
                                                                        <?php endif; ?>
                                                                    </dd>
                                                                </dl>
                                                            <?php endif; ?>

                                                            <?php if (get_field('case-time')): ?>
                                                                <dl class="bl_commonCaseCard_infoWrapper_item">
                                                                    <dt class="el_commonCaseCard_infoWrapper_item_dt">所要時間</dt>
                                                                    <dd class="el_commonCaseCard_infoWrapper_item_dd"><?php echo esc_html(get_field('case-time')); ?></dd>
                                                                </dl>
                                                            <?php endif; ?>

                                                            <?php if (get_field('case-period')): ?>
                                                                <dl class="bl_commonCaseCard_infoWrapper_item">
                                                                    <dt class="el_commonCaseCard_infoWrapper_item_dt">治療期間</dt>
                                                                    <dd class="el_commonCaseCard_infoWrapper_item_dd"><?php echo esc_html(get_field('case-period')); ?></dd>
                                                                </dl>
                                                            <?php endif; ?>

                                                            <?php if (get_field('case-num-times')): ?>
                                                                <dl class="bl_commonCaseCard_infoWrapper_item">
                                                                    <dt class="el_commonCaseCard_infoWrapper_item_dt">治療回数</dt>
                                                                    <dd class="el_commonCaseCard_infoWrapper_item_dd"><?php echo esc_html(get_field('case-num-times')); ?></dd>
                                                                </dl>
                                                            <?php endif; ?>

                                                            <?php if (get_field('case-downtime')): ?>
                                                                <dl class="bl_commonCaseCard_infoWrapper_item">
                                                                    <dt class="el_commonCaseCard_infoWrapper_item_dt">ダウンタイム</dt>
                                                                    <dd class="el_commonCaseCard_infoWrapper_item_dd"><?php echo esc_html(get_field('case-downtime')); ?></dd>
                                                                </dl>
                                                            <?php endif; ?>

                                                            <?php if (get_field('case-risk')): ?>
                                                                <dl class="bl_commonCaseCard_infoWrapper_item">
                                                                    <dt class="el_commonCaseCard_infoWrapper_item_dt">副作用・リスク</dt>
                                                                    <dd class="el_commonCaseCard_infoWrapper_item_dd">
                                                                        <?php echo esc_html(get_field('case-risk')); ?>
                                                                        <?php if (get_field('case-risk_sub')): ?>
                                                                            <span><?php echo esc_html(get_field('case-risk_sub')); ?></span>
                                                                        <?php endif; ?>
                                                                    </dd>
                                                                </dl>
                                                            <?php endif; ?>
                                                        </div>
                                                    </a>
                                                </article>
                                            </div>
                                        <?php
                                        endforeach;
                                        wp_reset_postdata();
                                        ?>
                                    </div>
                                </div>
                                <button class="bl_caseArticle_relatedCase_slideContainer_next">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow-next.svg" alt="">
                                </button>
                            </div>
                            <div class="bl_caseArticle_relatedCase_slideContainer_scrollbar"></div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <?php get_footer(); ?>

</body>

</html>