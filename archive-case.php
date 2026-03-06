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
                    <p class="bl_commonlowerPage_ttl_enTtl">Case</p>
                    <h1 class="bl_commonlowerPage_ttl_jaTtl">症例</h1>
                </hgroup>
                <?php get_template_part('inc/breadcrumbs'); ?>
            </div>


            <?php
            // case 投稿に紐づく menu-cat タームのみ取得
            $case_post_ids = get_posts(array(
                'post_type'      => 'case',
                'posts_per_page' => -1,
                'fields'         => 'ids',
            ));

            $menu_post_ids = array();

            if (!empty($case_post_ids)) {
                foreach ($case_post_ids as $case_post_id) {
                    $menus = get_field('menu_select', $case_post_id);
                    if (!empty($menus)) {
                        $menu_post_ids = array_merge($menu_post_ids, (array) $menus);
                    }
                }
                $menu_post_ids = array_unique(array_filter($menu_post_ids));
            }

            $menu_categories = array();
            if (!empty($menu_post_ids)) {
                $menu_categories = get_terms(array(
                    'taxonomy'   => 'menu-cat',
                    'hide_empty' => false,
                    'object_ids' => $menu_post_ids,
                ));
                if (is_wp_error($menu_categories)) {
                    $menu_categories = array();
                }
            }
            $price_categories = $menu_categories;
            ?>

            <div class="bl_commonlowerPage_contents ly_twoColumnContainer">
                <div class="ly_twoColumnContainer_inner">

                    <?php // 左カラム：ナビゲーション 
                    ?>
                    <div class="l_twoColumnContainer_left">
                        <?php if (!empty($price_categories)): ?>
                            <nav class="bl_commonNavWrapper">
                                <?php foreach ($price_categories as $price_category): ?>
                                    <?php if ((int) $price_category->parent !== 0) continue; ?>

                                    <?php
                                    $nav_posts = get_posts(array(
                                        'post_type'      => 'menu',
                                        'posts_per_page' => -1,
                                        'fields'         => 'ids',
                                        'post__in'       => $menu_post_ids,
                                        'tax_query'      => array(
                                            array(
                                                'taxonomy'         => 'menu-cat',
                                                'terms'            => $price_category->term_id,
                                                'field'            => 'term_id',
                                                'operator'         => 'IN',
                                                'include_children' => true,
                                            ),
                                        ),
                                    ));
                                    ?>
                                    <div class="bl_commonNavWrapper_item">
                                        <p class="el_commonNavWrapper_item_ttl"><?php echo esc_html($price_category->name); ?></p>
                                        <?php if (!empty($nav_posts)): ?>
                                            <div class="bl_commonNavWrapper_selectWrapper">
                                                <select class="el_commonNavWrapper_selectWrapper_select js_priceNavSelect" name="<?php echo esc_attr($price_category->slug); ?>" id="nav-<?php echo esc_attr($price_category->slug); ?>">
                                                    <option value="">施術を選ぶ</option>
                                                    <?php foreach ($nav_posts as $post_id): ?>
                                                        <?php $post = get_post($post_id); ?>
                                                        <option value="<?php echo esc_url(home_url('/search-case/?menu=' . $post->ID)); ?>"><?php echo esc_html(get_the_title($post->ID)); ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </nav>
                        <?php endif; ?>
                    </div>
                    <div class="l_twoColumnContainer_right bl_caseArchiveListContainer">
                        <?php
                        $currentPage = max(1, (int) get_query_var('paged'));
                        $args = array(
                            'post_type'      => 'case',
                            'posts_per_page' => 10,
                            'paged'          => $currentPage,
                        );
                        $query = new WP_Query($args);
                        ?>
                        <?php if ($query->have_posts()): ?>
                            <div class="bl_caseArchiveList">
                                <?php while ($query->have_posts()): $query->the_post(); ?>
                                    <article class="bl_commonCaseCard">
                                        <a href="<?php echo esc_url( user_trailingslashit( get_permalink() ) ); ?>" class="bl_commonCaseCard_link">
                                            <div class="bl_commonCaseCard_imgWrapper">
                                                <?php 
                                                $i = 0;
                                                if (have_rows('slide')): ?>
                                                    <?php while (have_rows('slide')): the_row(); ?>
                                                        <?php if ($i == 0): ?>
                                                            <img class="el_commonCaseCard_img" src="<?php the_sub_field('img'); ?>" width="360" height="485" alt="<?php the_title_attribute(); ?>">
                                                        <?php endif; ?>
                                                        <?php $i++; ?>
                                                    <?php endwhile; ?>
                                                <?php endif; ?>
                                            </div>

                                            <div class="bl_commonCaseCard_ttlWrapper">
                                                <?php $menuSelect = get_field('menu_select'); ?>
                                                <?php if ($menuSelect): ?>
                                                    <div class="bl_commonCaseCard_tagList">
                                                        <?php foreach ($menuSelect as $menuSelectPost): ?>
                                                            <h2 class="el_commonCaseCard_tagList_item"><?php echo esc_html(get_the_title($menuSelectPost)); ?></h2>
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
                                                                <span class="el_commonCaseCard_infoWrapper_item_dd_sub"><?php echo esc_html(get_field('case-risk_sub')); ?></span>
                                                            <?php endif; ?>
                                                        </dd>
                                                    </dl>
                                                <?php endif; ?>
                                            </div>
                                        </a>
                                    </article>
                                <?php endwhile; ?>
                                <?php wp_reset_postdata(); ?>
                            </div>
                        <?php endif; ?>


                        <?php
                        $totalPages = (int) $query->max_num_pages;

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
    </main>
    <?php get_footer(); ?>
    <script>
        (function() {
            document.querySelectorAll('.js_priceNavSelect').forEach(function(select) {
                select.addEventListener('change', function() {
                    var url = this.value;
                    if (url) {
                        window.location.href = url;
                    }
                });
            });
        })();
    </script>
</body>

</html>