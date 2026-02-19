<?php if (is_singular('menu')): ?>


    <div class="bl_menuCaseSwiperContainer">
        <button class="bl_menuCaseSwiper_prev" type="button">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow-prev.svg" alt="">
        </button>

        <div class="swiper bl_menuCaseSwiper">
            <div class="swiper-wrapper">
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

                <?php foreach ($relatedCasePosts as $relatedCasePost): ?>
                    <div class="swiper-slide">
                        <div class="bl_commonCaseCard">
                            <a href="<?php the_permalink($relatedCasePost->ID); ?>" class="bl_commonCaseCard_link">
                                <?php if (have_rows('slide', $relatedCasePost->ID)): ?>
                                    <?php while (have_rows('slide', $relatedCasePost->ID)): the_row(); ?>
                                        <img class="el_commonCaseCard_img" src="<?php the_sub_field('img'); ?>" alt="<?php the_title($relatedCasePost->ID); ?>">
                                    <?php endwhile; ?>
                                <?php endif; ?>

                                <?php
                                $menuSelect = get_field('menu_select', $relatedCasePost->ID);
                                ?>
                                <?php if ($menuSelect): ?>
                                    <div class="bl_commonCaseCard_tagList">
                                        <?php foreach ($menuSelect as $menuSelectPost): ?>
                                            <p class="el_commonCaseCard_tagList_item"><?php echo get_the_title($menuSelectPost); ?></p>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <p class="el_commonCaseCard_ttl"><?php echo get_the_title($relatedCasePost->ID); ?></p>
                            </a>
                            <button>
                                <span>詳細を見る</span>
                                <span></span>
                            </button>

                            <div>
                                <div>
                                    <dl>
                                        <dt>施術名</dt>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>
        <button class="bl_menuCaseSwiper_next" type="button">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow-next.svg" alt="">
        </button>
    </div>

    <div class="bl_commonAllBtnContainer">
        <a href="<?php echo home_url('/case/'); ?>" class="bl_commonAllBtn">
            <p class="bl_commonAllBtn_txt">もっと見る</p>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow.svg" alt="">
        </a>
    </div>
<?php endif; ?>