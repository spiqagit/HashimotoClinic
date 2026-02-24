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
                        <?php the_content(); ?>

                        <?php
                        $previous_post = get_previous_post();
                        $next_post     = get_next_post();
                        ?>

                        <nav class="bl_commonPagination">
                            <?php if ($previous_post): ?>
                                <div class="bl_commonPagination_item">
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
                                <div class="bl_commonPagination_item">
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