<?php get_header('meta'); ?>
<?php wp_head(); ?>
</head>

<body>

    <?php get_header(); ?>

    <main class="bl_commonArticlePage">
        <div class="bl_commonArticlePage_inner">
            <article class="bl_blogArticle">

                <div class="bl_commonArticle_header">
                    <div class="bl_commonArticle_header_inner">
                        <div class="bl_commonArticle_header_inner_upper">
                            <time class="el_commonArticle_header_date">
                                <?php the_time('Y.m.d'); ?>
                            </time>
                            <h1 class="el_commonArticle_header_ttl">
                                <?php the_title(); ?>
                            </h1>
                        </div>
                        <?php get_template_part('inc/breadcrumbs'); ?>
                    </div>
                </div>

                <div class="bl_blogArticle_contents">
                    <div class="bl_blogArticle_contents_inner">
                        <div class="bl_blogArchiveListContainer_navContainer">
                            <nav class="bl_blogArchiveListContainer_nav">
                                <div class="bl_blogArchiveListContainer_nav_searchContainer">
                                    <form action="<?php echo home_url(); ?>/" class="bl_blogArchiveListContainer_nav_searchContainer_form" method="get">
                                        <input class="el_blogArchiveListContainer_nav_searchContainer_form_input" type="text" name="s" placeholder="キーワードを入力">
                                        <input type="hidden" name="type" value="post">
                                        <button class="el_blogArchiveListContainer_nav_searchContainer_form_button" type="submit">検索</button>
                                    </form>
                                </div>


                                <div class="bl_blogArchiveListContainer_nav_catContainer">
                                    <?php
                                    wp_dropdown_categories([
                                        'show_option_none' => 'カテゴリー',
                                        'hierarchical'     => true,
                                        'depth'            => 3,
                                        'name'             => 'category',
                                    ]);
                                    ?>
                                    <script>
                                        document.querySelector('select[name="category"]').addEventListener('change', function() {
                                            var url = '<?php echo home_url(); ?>/category/' + this.options[this.selectedIndex].text;
                                            if (this.value > 0) {
                                                location.href = '<?php echo home_url(); ?>/?cat=' + this.value;
                                            }
                                        });
                                    </script>
                                </div>

                                <div class="bl_blogArchiveListContainer_nav_catContainer">
                                    <select onchange="location.href=this.value;">
                                        <option value="">月を選択</option>
                                        <?php wp_get_archives(['type' => 'monthly', 'format' => 'option']); ?>
                                    </select>
                                </div>
                            </nav>
                        </div>
                        <div class="bl_commonArticle_content">

                            <?php if (get_the_post_thumbnail()): ?>
                                <div class="bl_commonArticle_content_thumbnail">
                                    <img class="el_commonArticle_content_thumbnail_img" src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>">
                                </div>
                            <?php endif; ?>

                            <?php the_content(); ?>

                            <?php
                            // 投稿（post）の関連記事を取得：ACF「related-blog-list」→ なければ同じカテゴリの記事
                            $related_blog_ids = get_field('related-blog-list');
                            if (!empty($related_blog_ids) && is_array($related_blog_ids)) {
                                $relatedBlogPosts = get_posts(array(
                                    'post_type'      => 'post',
                                    'posts_per_page' => -1,
                                    'post__in'       => array_map('intval', $related_blog_ids),
                                    'post_status'    => 'publish',
                                    'orderby'        => 'post__in',
                                ));
                            } else {
                                $categories = get_the_category();
                                $cat_ids = !empty($categories) ? wp_list_pluck($categories, 'term_id') : array();
                                $relatedBlogPosts = get_posts(array(
                                    'post_type'      => 'post',
                                    'posts_per_page' => 6,
                                    'post__not_in'   => array(get_the_ID()),
                                    'post_status'    => 'publish',
                                    'category__in'   => $cat_ids,
                                    'orderby'        => 'date',
                                ));
                            }
                            ?>
                            <?php if (!empty($relatedBlogPosts)): ?>
                                <div class="bl_relatedBlogListContainer">
                                    <h2 class="el_commonArticle_content_relatedBlogTtl">関連記事</h2>

                                    <div class="bl_commonBlogSwiperContainer bl_menuBlogSwiperContainer">
                                        <div class="bl_commonBlogSwiperContainer_inner">
                                            <button class="bl_commonBlogSwiper_prev" type="button">
                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow-prev.svg" alt="">
                                            </button>

                                            <div class="swiper bl_commonBlogSwiper">
                                                <div class="swiper-wrapper">
                                                    <?php foreach ($relatedBlogPosts as $relatedBlogPost): ?>

                                                        <div class="swiper-slide">
                                                            <article class="bl_commonBlogSlideBtn">

                                                                <a href="<?php the_permalink($relatedBlogPost->ID); ?>" class="bl_commonBlogSlideBtn_imgContainer">
                                                                    <?php if (has_post_thumbnail($relatedBlogPost->ID)): ?>
                                                                        <img class="el_commonBlogSlideBtn_img" src="<?php echo get_the_post_thumbnail_url($relatedBlogPost->ID); ?>" alt="<?php echo get_the_title($relatedBlogPost->ID); ?>">
                                                                    <?php else: ?>
                                                                        <img class="l_commonBlogSlideBtn_img" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/doctor-no-image.jpg" alt="<?php echo get_the_title($relatedBlogPost->ID); ?>">
                                                                    <?php endif; ?>
                                                                </a>

                                                                <div class="bl_commonBlogSlideBtn_lower">
                                                                    <time class="el_commonBlogSlideBtn_lower_time" datetime="<?php echo get_the_date('Y-m-d', $relatedBlogPost->ID); ?>"><?php echo get_the_date('Y.m.d', $relatedBlogPost->ID); ?></time>

                                                                    <?php
                                                                    $categoryList = get_the_category($relatedBlogPost->ID);
                                                                    ?>
                                                                    <?php if ($categoryList): ?>
                                                                        <div class="bl_commonBlogSlideBtn_lower_categoryList">
                                                                            <?php foreach ($categoryList as $category): ?>
                                                                                <a href="<?php echo get_term_link($category->term_id); ?>" class="el_commonBlogSlideBtn_lower_categoryList_item"><?php echo $category->name; ?></a>
                                                                            <?php endforeach; ?>
                                                                        </div>
                                                                    <?php endif; ?>

                                                                    <h2 class="el_commonBlogSlideBtn_lower_ttl">
                                                                        <a class="el_commonBlogSlideBtn_lower_ttl_link" href="<?php the_permalink($relatedBlogPost->ID); ?>">
                                                                            <?php echo get_the_title($relatedBlogPost->ID); ?>
                                                                        </a>
                                                                    </h2>
                                                                </div>
                                                            </article>
                                                        </div>

                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                            <button class="bl_commonBlogSwiper_next" type="button">
                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow-next.svg" alt="">
                                            </button>
                                        </div>
                                        <div class="bl_commonBlogSwiper_pagination"></div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="bl_shareContainer">
                                <p class="el_shareContainer_ttl">この記事をシェアする</p>

                                <div class="bl_shareContainer_linkContainer">
                                    <button type="button" class="el_shareContainer_linkContainer_copyBtn" aria-label="リンクをコピー">リンクをコピー</button>

                                    <div class="bl_shareContainer_snsContainer">
                                        <a href="https://line.me/R/msg/text/?<?php the_permalink(); ?>" class="el_shareContainer_snsContainer_item" target="_blank">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/icon-line-black.svg" alt="LINE">
                                        </a>
                                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" class="el_shareContainer_snsContainer_item" target="_blank">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/icon-facebook-black.svg" alt="Facebook">
                                        </a>
                                        <a href="https://x.com/share?url=<?php the_permalink(); ?>" class="el_shareContainer_snsContainer_item" target="_blank">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/x-icon.svg" alt="X">
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <?php
                            $previous_post = get_previous_post();
                            $next_post     = get_next_post();
                            ?>
                            <nav class="bl_commonPagination">
                                <?php if ($previous_post): ?>
                                    <div class="bl_commonPagination_item bl_commonPagination_item_prev">
                                        <a href="<?php echo esc_url(get_permalink($previous_post)); ?>" class="bl_commonPagination_item_link bl_commonPagination_item_prev">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/pagination-prev.svg" alt="">
                                            <p class="el_commonPagination_item_link_txt">前の記事へ</p>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <div class="bl_commonArticle_content_allBtnContainer">
                                    <a href="<?php echo home_url('/blog/'); ?>" class="bl_commonArticle_content_allBtn">一覧へ戻る</a>
                                </div>

                                <?php if ($next_post): ?>
                                    <div class="bl_commonPagination_item bl_commonPagination_item_next">
                                        <a href="<?php echo esc_url(get_permalink($next_post)); ?>" class="bl_commonPagination_item_link bl_commonPagination_item_next">
                                            <p class="el_commonPagination_item_link_txt">次の記事へ</p>
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/pagination-next.svg" alt="">
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </nav>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </main>

    <?php get_footer(); ?>

</body>

</html>