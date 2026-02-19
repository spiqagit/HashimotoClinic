<?php
/* ---------- デフォルト設定 ---------- */
// titleタグの出力
add_theme_support('title-tag');
// 固定ページで抜粋を有効化
add_post_type_support('page', 'excerpt');
// アイキャッチ画像を有効化
add_theme_support('post-thumbnails');

//自動更新を無効化
add_filter('automatic_updater_disabled', '__return_true');

/* ---------- 管理画面 ---------- */
// サイドメニューを非表示


/* ---------- 投稿関連 ---------- */
// 投稿（post）のURLを /blog/スラッグ にする
function renewal2026_post_blog_rewrite_rules() {
	add_rewrite_rule( '^blog/([^/]+)/?$', 'index.php?name=$matches[1]', 'top' );
}
add_action( 'init', 'renewal2026_post_blog_rewrite_rules' );

function renewal2026_post_link_blog_prefix( $permalink, $post ) {
	if ( $post->post_type !== 'post' ) {
		return $permalink;
	}
	return home_url( '/blog/' . $post->post_name . '/' );
}
add_filter( 'post_link', 'renewal2026_post_link_blog_prefix', 10, 2 );

// テーマ有効化時にリライトルールをフラッシュ（/blog/ 対応を反映）
function renewal2026_flush_rewrite_on_activation() {
	renewal2026_post_blog_rewrite_rules();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'renewal2026_flush_rewrite_on_activation' );

// アーカイブの表示条件
function change_posts_per_page($query)
{
    if (is_admin() || !$query->is_main_query())
        return;

    // ページネーションのクエリ変数を適切に処理
    
}
add_action('pre_get_posts', 'change_posts_per_page');

// the_archive_title 余計な文字を削除
add_filter('get_the_archive_title', function ($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_tax()) {
        $title = single_term_title('', false);
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    } elseif (is_date()) {
        $title = get_the_time('Y年n月');
    } elseif (is_search()) {
        $title = '検索結果：' . esc_html(get_search_query(false));
    } elseif (is_404()) {
        $title = '「404」ページが見つかりません';
    } else {
    }
    return $title;
});


// 一覧・single生成制御
function disable_faq_pages()
{
    if (is_singular('faq')  || is_tax('faq-cat')) {
        global $wp_query;
        $wp_query->set_404();
        status_header(404);
        get_template_part(404);
        exit;
    }
}
add_action('template_redirect', 'disable_faq_pages');



/* ---------- 検索機能 ---------- */
function custom_search_case_rewrite_rule()
{
    add_rewrite_rule('^search-case/?$', 'index.php?search_case=1', 'top');
    add_rewrite_rule('^search-price/?$', 'index.php?search_price=1', 'top');
}
add_action('init', 'custom_search_case_rewrite_rule');

function add_query_vars_for_search_case($vars)
{
    $vars[] = 'search_case';
    $vars[] = 'search_price';
    return $vars;
}
add_filter('query_vars', 'add_query_vars_for_search_case');


function load_custom_search_case_template($template)
{
    if (get_query_var('search_case')) {
        $new_template = locate_template('search-case.php');
        if (!empty($new_template)) {
            return $new_template;
        }
    }
    return $template;
}
add_filter('template_include', 'load_custom_search_case_template');



function my_custom_search($search, $wp_query)
{
    global $wpdb;
    if (!$wp_query->is_search)
        return $search;
    if (!isset($wp_query->query_vars))
        return $search;
    $search_words = explode(' ', isset($wp_query->query_vars['s']) ? $wp_query->query_vars['s'] : '');
    if (count($search_words) > 0) {
        $search = '';
        foreach ($search_words as $word) {
            if (!empty($word)) {
                $search_word = '%' . esc_sql($word) . '%';
                $search .= " AND (
                    {$wpdb->posts}.post_title LIKE '{$search_word}'
                    OR {$wpdb->posts}.post_content LIKE '{$search_word}'
                    OR {$wpdb->posts}.ID IN (
                        SELECT distinct tr.object_id
                        FROM {$wpdb->term_relationships} AS tr
                        INNER JOIN {$wpdb->term_taxonomy} AS tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
                        INNER JOIN {$wpdb->terms} AS t ON tt.term_id = t.term_id
                        WHERE t.name LIKE '{$search_word}'
                        OR t.slug LIKE '{$search_word}'
                        OR tt.description LIKE '{$search_word}'
                    )
                    OR {$wpdb->posts}.ID IN (
                        SELECT distinct post_id
                        FROM {$wpdb->postmeta}
                        WHERE meta_value LIKE '{$search_word}'
                    )
                ) ";
            }
        }
    }
    return $search;
}
add_filter('posts_search', 'my_custom_search', 10, 2);
if (isset($_GET['s'])) $_GET['s'] = mb_convert_kana($_GET['s'], 's', 'UTF-8');


/* ---------- ACF ブロック ---------- */
/**
 * カスタムブロックカテゴリーを登録する
 * block.json の "category" で指定した slug と一致させる
 */
function renewal2026_register_block_categories($block_categories, $editor_context)
{
    return array_merge(
        array(
            array(
                'slug'  => 'menu-block',
                'title' => '施術メニュー用',
                'icon'  => null,
            ),
        ),
        $block_categories
    );
}
add_filter('block_categories_all', 'renewal2026_register_block_categories', 10, 2);

/**
 * ACF ブロックを登録する
 * block.json に "acf" キーがあると ACF がブロックとして認識する
 * テーマ側では register_block_type() でブロックディレクトリを登録する
 */
function renewal2026_register_acf_blocks()
{
    if (!function_exists('acf_register_block_type')) {
        return;
    }

    $block_dirs = array(
        'case-block',
        'price-block',
        'faq-block',
        'blog-block',
        // 新しい ACF ブロックを追加する場合はここにディレクトリ名を追加
    );

    foreach ($block_dirs as $dir) {
        $path = get_template_directory() . '/blocks/' . $dir;
        if (file_exists($path . '/block.json')) {
            register_block_type($path);
        }
    }
}
add_action('init', 'renewal2026_register_acf_blocks');

