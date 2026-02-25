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
                    <p class="bl_commonlowerPage_ttl_enTtl">News</p>
                    <h1 class="bl_commonlowerPage_ttl_jaTtl">お知らせ</h1>
                </hgroup>
                <?php get_template_part('inc/breadcrumbs'); ?>
            </div>


            <div class="bl_commonlowerPage_contents">
                <div class="bl_newsArchiveListContainer">
                    <div class="bl_newsArchiveListContainer_inner">
                        <?php if (have_posts()): ?>
                            <div class="bl_newsArchiveList">
                                <?php while (have_posts()): the_post(); ?>

                                    <article class="bl_commonNewsPost">
                                        <a href="<?php the_permalink(); ?>" class="bl_commonNewsCard_link">
                                            <time class="el_commonNewsPost_time" datetime="<?php echo esc_attr(get_the_date('Y-m-d')); ?>"><?php echo esc_html(get_the_date('Y.m.d')); ?></time>
                                            <p class="el_commonNewsPost_ttl"><?php the_title(); ?></p>
                                        </a>
                                    </article>

                                <?php endwhile; ?>
                            </div>

                            <?php
                            $currentPage = max(1, (int) get_query_var('paged'));
                            $totalPages = (int) $wp_query->max_num_pages;

                            $paginationItems = array();
                            $isEllipsisAdded = false;

                            for ($pageNumber = 1; $pageNumber <= $totalPages; $pageNumber++) {
                                $isEdgePage = ($pageNumber === 1 || $pageNumber === $totalPages);
                                $isNearCurrentPage = (abs($pageNumber - $currentPage) <= 1);

                                if ($isEdgePage || $isNearCurrentPage) {
                                    $paginationItems[] = array(
                                        'type' => 'page',
                                        'number' => $pageNumber,
                                    );
                                    $isEllipsisAdded = false;
                                    continue;
                                }

                                if (!$isEllipsisAdded) {
                                    $paginationItems[] = array(
                                        'type' => 'ellipsis',
                                    );
                                    $isEllipsisAdded = true;
                                }
                            }
                            ?>
                            <?php if ($totalPages > 1): ?>
                                <nav class="bl_commonPagination">

                                    <?php if ($currentPage > 1): ?>
                                        <div class="bl_commonPagination_item bl_commonPagination_item_prev">
                                            <a href="<?php echo esc_url(get_pagenum_link($currentPage - 1)); ?>" class="bl_commonPagination_item_link bl_commonPagination_item_prev">
                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/pagination-prev.svg" alt="">
                                                <p class="el_commonPagination_item_link_txt">前のページへ</p>
                                            </a>
                                        </div>
                                    <?php endif; ?>


                                    <ul class="bl_commonNumberList">
                                        <?php foreach ($paginationItems as $paginationItem): ?>
                                            <?php if ($paginationItem['type'] === 'ellipsis'): ?>
                                                <li class="bl_commonNumberList_item">
                                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/dot-icon.svg" alt="">
                                                </li>
                                            <?php else: ?>
                                                <li class="bl_commonNumberList_item">
                                                    <?php if ((int) $paginationItem['number'] === $currentPage): ?>
                                                        <span class="el_commonNumberList_item_number el_commonNumberList_item_number_current"><?php echo esc_html($paginationItem['number']); ?></span>
                                                    <?php else: ?>
                                                        <a href="<?php echo esc_url(get_pagenum_link($paginationItem['number'])); ?>" class="el_commonNumberList_item_number"><?php echo esc_html($paginationItem['number']); ?></a>
                                                    <?php endif; ?>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>

                                    <?php if ($currentPage < $totalPages): ?>
                                        <div class="bl_commonPagination_item bl_commonPagination_item_next">
                                            <a href="<?php echo esc_url(get_pagenum_link($currentPage + 1)); ?>" class="bl_commonPagination_item_link bl_commonPagination_item_next">
                                                <p class="el_commonPagination_item_link_txt">次のページへ</p>
                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/pagination-next.svg" alt="">
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </nav>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php get_footer(); ?>
</body>

</html>