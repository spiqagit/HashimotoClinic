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

                <div class="bl_newsArticle_contents">
                    <div class="bl_commonArticle_content bl_newsArticle_contents_inner">

                        <?php if (get_the_post_thumbnail()): ?>
                            <div class="bl_commonArticle_content_thumbnail">
                                <img class="el_commonArticle_content_thumbnail_img" src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>">
                            </div>
                        <?php endif; ?>

                        <?php the_content(); ?>

                        <?php
                        $relatedBlogPosts = get_posts(array(
                        'post_type' => 'post',
                        'posts_per_page' => 4,
                        'orderby' => 'date',
                        'order' => 'DESC',
                        ));
                        ?>
                        <?php if (!empty($relatedBlogPosts)): ?>
                            <div class="bl_frontBlogSwiperContainer">
                                <div class="bl_frontBlogSwiper swiper">
                                    <div class="bl_blogArchiveList swiper-wrapper">
                                        <?php foreach ($relatedBlogPosts as $relatedBlogPost): ?>
                                            <article class="bl_blogArchiveList_item swiper-slide">
                                                <a href="<?php the_permalink($relatedBlogPost->ID); ?>" class="bl_blogArchiveList_item_link">
                                                    <img class="el_blogArchiveList_item_img" src="<?php echo get_the_post_thumbnail_url($relatedBlogPost->ID); ?>" alt="<?php echo get_the_title($relatedBlogPost->ID); ?>">
                                                </a>

                                                <div class="bl_blogArchiveList_item_txtContainer">

                                                    <div class="bl_blogArchiveList_item_infoWrapper">
                                                        <time class="el_blogArchiveList_item_infoWrapper_time" datetime="<?php echo get_the_date('Y-m-d', $relatedBlogPost->ID); ?>"><?php echo get_the_date('Y.m.d', $relatedBlogPost->ID); ?></time>
                                                        <?php
                                                        $categoryList = get_the_category($relatedBlogPost->ID);
                                                        ?>
                                                        <?php if ($categoryList): ?>
                                                            <div class="bl_blogArchiveList_item_infoWrapper_categoryList">
                                                                <?php foreach ($categoryList as $category): ?>
                                                                    <a href="<?php echo get_term_link($category->term_id); ?>" class="el_blogArchiveList_item_infoWrapper_categoryList_item"><?php echo $category->name; ?></a>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>

                                                    <h3 class="bl_blogArchiveList_item_ttl">
                                                        <a href="<?php the_permalink($relatedBlogPost->ID); ?>" class="bl_blogArchiveList_item_link">
                                                            <?php echo get_the_title($relatedBlogPost->ID); ?>
                                                        </a>
                                                    </h3>
                                                </div>
                                            </article>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="bl_frontBlogSwiper_btnContainer">
                                    <button class="bl_frontBlogSwiper_prev">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow-prev.svg" alt="prev">
                                    </button>
                                    <div class="bl_frontBlogSwiper_pagination"></div>
                                    <button class="bl_frontBlogSwiper_next">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow-next.svg" alt="next">
                                    </button>
                                </div>

                            </div>

                        <?php endif; ?>

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
                                <a href="<?php echo home_url('/news/'); ?>" class="bl_commonArticle_content_allBtn">一覧へ戻る</a>
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
            </article>
        </div>
    </main>

    <?php get_footer(); ?>

</body>

</html>