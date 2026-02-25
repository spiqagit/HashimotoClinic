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
                    <p class="bl_commonlowerPage_ttl_enTtl">Blog</p>
                    <h1 class="bl_commonlowerPage_ttl_jaTtl">院長ブログ</h1>
                </hgroup>
                <?php get_template_part('inc/breadcrumbs'); ?>
            </div>


            <div class="bl_commonlowerPage_contents">
                <div class="bl_blogArchiveListContainer">
                    <div class="bl_blogArchiveListContainer_inner">

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

                        <div>
                            <div class="bl_blogArchiveList">
                                <?php
                                $currentPage    = max(1, (int) get_query_var('paged'));
                                $currentCatId   = get_queried_object_id(); // 表示中のカテゴリーID
                                $blog_query     = new WP_Query([
                                    'post_type'      => 'post',
                                    'posts_per_page' => 10,
                                    'paged'          => $currentPage,
                                    'post_status'    => 'publish',
                                    'orderby'        => 'date',
                                    'order'          => 'DESC',
                                    'cat'            => $currentCatId, // カテゴリーで絞り込み
                                ]);
                                if ($blog_query->have_posts()) :
                                    while ($blog_query->have_posts()) :
                                        $blog_query->the_post();
                                        $blog_post = $blog_query->post;
                                ?>
                                        <article class="bl_blogArchiveList_item swiper-slide">
                                            <a href="<?php echo esc_url(get_permalink($blog_post->ID)); ?>" class="bl_blogArchiveList_item_link">
                                                <?php if (has_post_thumbnail($blog_post->ID)): ?>
                                                    <img class="el_blogArchiveList_item_img" src="<?php echo esc_url(get_the_post_thumbnail_url($blog_post->ID)); ?>" alt="<?php echo esc_attr(get_the_title($blog_post->ID)); ?>">
                                                <?php else: ?>
                                                    <img class="el_blogArchiveList_item_img" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/noimage-doc.jpg" alt="<?php echo esc_attr(get_the_title($blog_post->ID)); ?>">
                                                <?php endif; ?>
                                            </a>

                                            <div class="bl_blogArchiveList_item_txtContainer">

                                                <div class="bl_blogArchiveList_item_infoWrapper">
                                                    <time class="el_blogArchiveList_item_infoWrapper_time" datetime="<?php echo esc_attr(get_the_date('Y-m-d', $blog_post->ID)); ?>"><?php echo esc_html(get_the_date('Y.m.d', $blog_post->ID)); ?></time>
                                                    <?php
                                                    $categoryList = get_the_category($blog_post->ID);
                                                    ?>
                                                    <?php if ($categoryList) : ?>
                                                        <div class="bl_blogArchiveList_item_infoWrapper_categoryList">
                                                            <?php foreach ($categoryList as $category) : ?>
                                                                <a href="<?php echo esc_url(get_term_link($category->term_id)); ?>" class="el_blogArchiveList_item_infoWrapper_categoryList_item"><?php echo esc_html($category->name); ?></a>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>

                                                <h3 class="bl_blogArchiveList_item_ttl">
                                                    <a href="<?php echo esc_url(get_permalink($blog_post->ID)); ?>" class="bl_blogArchiveList_item_link">
                                                        <?php echo esc_html(get_the_title($blog_post->ID)); ?>
                                                    </a>
                                                </h3>
                                            </div>
                                        </article>
                                <?php
                                    endwhile;
                                    wp_reset_postdata();
                                endif;
                                ?>
                            </div>

                            <div>
                                <?php
                                $totalPages = (int) $blog_query->max_num_pages;

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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php get_footer(); ?>
</body>

</html>