<?php if (is_singular('menu')): ?>


    <?php
    $relatedCasePosts = get_posts(array(
        'post_type' => 'case',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => 'menu_select',
                'value' => '"' . get_the_ID() . '"',
                'compare' => 'LIKE',
            ),
        ),
    ));
    ?>
    <?php if (!empty($relatedCasePosts)): ?>
        <div class="bl_menuCaseSwiperContainer">
            <button class="bl_menuCaseSwiper_prev" type="button">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow-prev.svg" alt="">
            </button>

            <div class="swiper bl_menuCaseSwiper">
                <div class="swiper-wrapper">

                    <?php foreach ($relatedCasePosts as $relatedCasePost): ?>
                        <div class="swiper-slide">
                            <article class="bl_commonCaseCard">
                                <a href="<?php echo esc_url(get_permalink($relatedCasePost->ID)); ?>" class="bl_commonCaseCard_link">
                                    <div class="bl_commonCaseCard_imgWrapper">
                                        <?php
                                        $i = 0;
                                        if (have_rows('slide', $relatedCasePost->ID)): ?>
                                            <?php while (have_rows('slide', $relatedCasePost->ID)): the_row(); ?>
                                                <?php if ($i == 0): ?>
                                                    <img class="el_commonCaseCard_img" src="<?php the_sub_field('img'); ?>" alt="<?php echo esc_attr(get_the_title($relatedCasePost->ID)); ?>">
                                                <?php endif; ?>
                                                <?php $i++; ?>
                                            <?php endwhile; ?>
                                        <?php endif; ?>
                                    </div>

                                    <div class="bl_commonCaseCard_ttlWrapper">
                                        <?php $menuSelect = get_field('menu_select', $relatedCasePost->ID); ?>
                                        <?php if ($menuSelect): ?>
                                            <div class="bl_commonCaseCard_tagList">
                                                <?php foreach ($menuSelect as $menuSelectPost): ?>
                                                    <h3 class="el_commonCaseCard_tagList_item"><?php echo esc_html(get_the_title($menuSelectPost)); ?></h3>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>
                                        <p class="el_commonCaseCard_ttl"><?php echo esc_html(get_the_title($relatedCasePost->ID)); ?></p>
                                    </div>

                                    <div class="bl_commonCaseCard_infoWrapper">
                                        <?php if (get_field('case-menu', $relatedCasePost->ID)): ?>
                                            <dl class="bl_commonCaseCard_infoWrapper_item">
                                                <dt class="el_commonCaseCard_infoWrapper_item_dt">施術名</dt>
                                                <dd class="el_commonCaseCard_infoWrapper_item_dd"><?php echo esc_html(get_field('case-menu', $relatedCasePost->ID)); ?></dd>
                                            </dl>
                                        <?php endif; ?>

                                        <?php if (get_field('case-price', $relatedCasePost->ID)): ?>
                                            <dl class="bl_commonCaseCard_infoWrapper_item">
                                                <dt class="el_commonCaseCard_infoWrapper_item_dt">施術参考料金</dt>
                                                <dd class="el_commonCaseCard_infoWrapper_item_dd">
                                                    <?php echo esc_html(get_field('case-price', $relatedCasePost->ID)); ?>
                                                    <?php if (get_field('case-price_sub', $relatedCasePost->ID)): ?>
                                                        <span class="el_commonCaseCard_infoWrapper_item_dd_sub"><?php echo esc_html(get_field('case-price_sub', $relatedCasePost->ID)); ?></span>
                                                    <?php endif; ?>
                                                </dd>
                                            </dl>
                                        <?php endif; ?>

                                        <?php if (get_field('case-time', $relatedCasePost->ID)): ?>
                                            <dl class="bl_commonCaseCard_infoWrapper_item">
                                                <dt class="el_commonCaseCard_infoWrapper_item_dt">所要時間</dt>
                                                <dd class="el_commonCaseCard_infoWrapper_item_dd"><?php echo esc_html(get_field('case-time', $relatedCasePost->ID)); ?></dd>
                                            </dl>
                                        <?php endif; ?>

                                        <?php if (get_field('case-period', $relatedCasePost->ID)): ?>
                                            <dl class="bl_commonCaseCard_infoWrapper_item">
                                                <dt class="el_commonCaseCard_infoWrapper_item_dt">治療期間</dt>
                                                <dd class="el_commonCaseCard_infoWrapper_item_dd"><?php echo esc_html(get_field('case-period', $relatedCasePost->ID)); ?></dd>
                                            </dl>
                                        <?php endif; ?>

                                        <?php if (get_field('case-num-times', $relatedCasePost->ID)): ?>
                                            <dl class="bl_commonCaseCard_infoWrapper_item">
                                                <dt class="el_commonCaseCard_infoWrapper_item_dt">治療回数</dt>
                                                <dd class="el_commonCaseCard_infoWrapper_item_dd"><?php echo esc_html(get_field('case-num-times', $relatedCasePost->ID)); ?></dd>
                                            </dl>
                                        <?php endif; ?>

                                        <?php if (get_field('case-downtime', $relatedCasePost->ID)): ?>
                                            <dl class="bl_commonCaseCard_infoWrapper_item">
                                                <dt class="el_commonCaseCard_infoWrapper_item_dt">ダウンタイム</dt>
                                                <dd class="el_commonCaseCard_infoWrapper_item_dd"><?php echo esc_html(get_field('case-downtime', $relatedCasePost->ID)); ?></dd>
                                            </dl>
                                        <?php endif; ?>

                                        <?php if (get_field('case-risk', $relatedCasePost->ID)): ?>
                                            <dl class="bl_commonCaseCard_infoWrapper_item">
                                                <dt class="el_commonCaseCard_infoWrapper_item_dt">副作用・リスク</dt>
                                                <dd class="el_commonCaseCard_infoWrapper_item_dd">
                                                    <?php echo esc_html(get_field('case-risk', $relatedCasePost->ID)); ?>
                                                    <?php if (get_field('case-risk_sub', $relatedCasePost->ID)): ?>
                                                        <span class="el_commonCaseCard_infoWrapper_item_dd_sub"><?php echo esc_html(get_field('case-risk_sub', $relatedCasePost->ID)); ?></span>
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
            </div>

            <button class="bl_menuCaseSwiper_next" type="button">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow-next.svg" alt="">
            </button>

            <div class="bl_menuCaseSwiper_pagination"></div>
        </div>

        <div class="bl_commonAllBtnContainer">
            <a href="<?php echo home_url('/case/'); ?>" class="bl_commonAllBtn">
                <p class="bl_commonAllBtn_txt">もっと見る</p>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow.svg" alt="">
            </a>
        </div>
    <?php endif; ?>
<?php endif; ?>