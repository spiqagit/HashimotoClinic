<?php

/**
 * サイト内検索：全投稿タイプのタイトルから検索結果を表示
 */
$currentPage    = max(1, (int) get_query_var('paged'));
$search_keyword = get_search_query(false);
$post_types     = array_values(get_post_types(['public' => true], 'names'));
$post_types     = array_values(array_diff($post_types, ['faq', 'clinic', 'doctor']));

$site_search_query = new WP_Query([
    'post_type'      => $post_types,
    'posts_per_page' => 10,
    'paged'          => $currentPage,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
    's'              => $search_keyword,
    'search_title_only' => true,
]);
?>

<?php
// 検索結果を投稿タイプごとにグループ化
$posts_by_type = [];
if ($site_search_query->have_posts()) {
    while ($site_search_query->have_posts()) {
        $site_search_query->the_post();
        $post_obj = $site_search_query->post;
        if (! isset($posts_by_type[$post_obj->post_type])) {
            $posts_by_type[$post_obj->post_type] = [];
        }
        $posts_by_type[$post_obj->post_type][] = $post_obj;
    }
    wp_reset_postdata();
}
?>

<div class="bl_siteSearch">
    <div class="bl_siteSearch_inner">
        <div class="bl_siteSearch_list">

            <?php if (! empty($posts_by_type)) : ?>
                <div class="bl_siteSearch_sectionContainer">
                    <?php foreach ($posts_by_type as $post_type_slug => $type_posts) : ?>
                        <?php
                        $pt_obj   = get_post_type_object($post_type_slug);
                        $pt_label = $pt_obj ? $pt_obj->labels->singular_name : $post_type_slug;
                        ?>
                        <section class="bl_siteSearch_section" data-post-type="<?php echo esc_attr($post_type_slug); ?>">
                            <h2 class="el_siteSearch_section_ttl"><?php echo esc_html($pt_label); ?><span class="el_siteSearch_section_count">（<?php echo count($type_posts); ?>件）</span></h2>

                            <ul class="bl_siteSearch_list_items">
                                <?php foreach ($type_posts as $post_obj) : ?>
                                    <li class="bl_siteSearch_list_item">
                                        <a href="<?php echo esc_url(get_permalink($post_obj->ID)); ?>" class="bl_siteSearch_list_item_link">
                                            <time class="el_siteSearch_list_item_date" datetime="<?php echo esc_attr(get_the_date('Y-m-d', $post_obj->ID)); ?>"><?php echo esc_html(get_the_date('Y.m.d', $post_obj->ID)); ?></time>
                                            <p class="bl_siteSearch_list_item_ttl"><?php echo esc_html(get_the_title($post_obj->ID)); ?></p>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </section>
                    <?php endforeach; ?>
                </div>

                <?php
                $totalPages      = (int) $site_search_query->max_num_pages;
                $search_base_url = add_query_arg(['s' => $search_keyword, 'type' => 'site'], home_url('/'));
                if ($totalPages > 1) :
                    $paginationItems = [];
                    $isEllipsisAdded = false;
                    for ($pageNumber = 1; $pageNumber <= $totalPages; $pageNumber++) {
                        $isEdgePage = ($pageNumber === 1 || $pageNumber === $totalPages);
                        $isNearCurrentPage = (abs($pageNumber - $currentPage) <= 1);
                        if ($isEdgePage || $isNearCurrentPage) {
                            $paginationItems[] = ['type' => 'page', 'number' => $pageNumber];
                            $isEllipsisAdded = false;
                        } elseif (!$isEllipsisAdded) {
                            $paginationItems[] = ['type' => 'ellipsis'];
                            $isEllipsisAdded = true;
                        }
                    }
                ?>
                    <nav class="bl_commonPagination">
                        <?php if ($currentPage > 1) : ?>
                            <div class="bl_commonPagination_item">
                                <a href="<?php echo esc_url(add_query_arg('paged', $currentPage - 1, $search_base_url)); ?>" class="bl_commonPagination_item_link bl_commonPagination_item_prev">
                                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/common/pagination-prev.svg" alt="">
                                    <p class="el_commonPagination_item_link_txt">前のページへ</p>
                                </a>
                            </div>
                        <?php endif; ?>
                        <ul class="bl_commonNumberList">
                            <?php foreach ($paginationItems as $paginationItem) : ?>
                                <?php if ($paginationItem['type'] === 'ellipsis') : ?>
                                    <li class="bl_commonNumberList_item">
                                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/common/dot-icon.svg" alt="">
                                    </li>
                                <?php else : ?>
                                    <li class="bl_commonNumberList_item">
                                        <?php if ((int) $paginationItem['number'] === $currentPage) : ?>
                                            <span class="el_commonNumberList_item_number el_commonNumberList_item_number_current"><?php echo esc_html($paginationItem['number']); ?></span>
                                        <?php else : ?>
                                            <a href="<?php echo esc_url(add_query_arg('paged', $paginationItem['number'], $search_base_url)); ?>" class="el_commonNumberList_item_number"><?php echo esc_html($paginationItem['number']); ?></a>
                                        <?php endif; ?>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                        <?php if ($currentPage < $totalPages) : ?>
                            <div class="bl_commonPagination_item">
                                <a href="<?php echo esc_url(add_query_arg('paged', $currentPage + 1, $search_base_url)); ?>" class="bl_commonPagination_item_link bl_commonPagination_item_next">
                                    <p class="el_commonPagination_item_link_txt">次のページへ</p>
                                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/common/pagination-next.svg" alt="">
                                </a>
                            </div>
                        <?php endif; ?>
                    </nav>
                <?php endif; ?>

            <?php else : ?>
                <p class="bl_common_noResults">
                    <?php if ($search_keyword !== '') : ?>
                        「<?php echo esc_html($search_keyword); ?>」に一致するページは見つかりませんでした。<br>別のキーワードでお試しください。
                    <?php else : ?>
                        検索キーワードを入力して検索してください。
                    <?php endif; ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
</div>