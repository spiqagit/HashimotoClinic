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

function remove_admin_selection_color() {
    echo '<style>
        ::selection {
            background: auto !important;
            color: auto !important;
        }
    </style>';
}
add_action("admin_head", "remove_admin_selection_color");

/* ---------- 固定ページテンプレート（管理画面の「テンプレート」欄に表示） ---------- */
// function renewal2026_ensure_page_templates($templates)
// {
//     $custom = [
//         'page-about.php'  => 'About',
//         'page-access.php' => 'Access',
//         'page-blog.php'   => 'Blog',
//         'page-monitor.php' => 'Monitor',
//         'front-page.php'  => 'front-page',
//     ];
//     return array_merge($custom, (array) $templates);
// }
// add_filter('theme_page_templates', 'renewal2026_ensure_page_templates');

/* ---------- 管理画面 ---------- */
// サイドメニューを非表示

// 投稿タイプ menu でアイキャッチを有効化（記事編集ページに「アイキャッチ画像」欄を表示）
function renewal2026_menu_add_thumbnail_support()
{
    add_post_type_support('menu', 'thumbnail');
}
add_action('init', 'renewal2026_menu_add_thumbnail_support', 20);

// 投稿タイプ menu の一覧ではサムネイル列を非表示（編集画面で登録できればよい）
function renewal2026_menu_remove_thumbnail_column($columns)
{
    unset($columns['thumbnail']);
    return $columns;
}
add_filter('manage_menu_posts_columns', 'renewal2026_menu_remove_thumbnail_column', 21);


/* ---------- 投稿関連 ---------- */
// 投稿（post）のURLを /blog/スラッグ にする
function renewal2026_post_blog_rewrite_rules()
{
    add_rewrite_rule('^blog/page/([0-9]+)/?$', 'index.php?pagename=blog&paged=$matches[1]', 'top');
    add_rewrite_rule('^blog/([^/]+)/?$', 'index.php?name=$matches[1]', 'top');
}
add_action('init', 'renewal2026_post_blog_rewrite_rules');

function renewal2026_post_link_blog_prefix($permalink, $post)
{
    if ($post->post_type !== 'post') {
        return $permalink;
    }
    return home_url('/blog/' . $post->post_name . '/');
}
add_filter('post_link', 'renewal2026_post_link_blog_prefix', 10, 2);

function get_blog_pagenum_link($page)
{
    if ($page <= 1) {
        return home_url('/blog/');
    }
    return home_url('/blog/page/' . $page . '/');
}

// テーマ有効化時・リライト変更後にフラッシュ（管理画面「設定」→「パーマリンク」で「変更を保存」でも可）
function renewal2026_flush_rewrite_on_activation()
{
    renewal2026_post_blog_rewrite_rules();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'renewal2026_flush_rewrite_on_activation');

// アーカイブの表示条件
function change_posts_per_page($query)
{
    if (is_admin() || !$query->is_main_query())
        return;

    if ($query->is_post_type_archive('news')) {
        $query->set('posts_per_page', 10);
        $query->set('orderby', 'date');
        $query->set('order', 'DESC');
    }
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

    if (is_singular('clinic')) {
        global $wp_query;
        $wp_query->set_404();
        status_header(404);
        get_template_part(404);
        exit;
    }

    if (is_tax('parts-cat')) {
        global $wp_query;
        $wp_query->set_404();
        status_header(404);
        get_template_part(404);
        exit;
    }

    if (is_tax('menu-cat')) {
        global $wp_query;
        $wp_query->set_404();
        status_header(404);
        get_template_part(404);
        exit;
    }

    if (is_singular('doctor')) {
        global $wp_query;
        $wp_query->set_404();
        status_header(404);
        get_template_part(404);
        exit;
    }

    if (is_singular('doctor') || is_tax('faq-cat')) {
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
    // ページネーション用（先にマッチさせる）
    add_rewrite_rule('^search-case/page/([0-9]+)/?$', 'index.php?search_case=1&paged=$matches[1]', 'top');
    add_rewrite_rule('^search-price/page/([0-9]+)/?$', 'index.php?search_price=1&paged=$matches[1]', 'top');
    // 1ページ目
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

/**
 * 検索ページ（search-case / search-price）を 404 扱いにしない
 */
function prevent_404_for_search_case_price($pre_handle_404, $wp_query)
{
    if ($wp_query->get('search_case') || $wp_query->get('search_price')) {
        return true;
    }
    return $pre_handle_404;
}
add_filter('pre_handle_404', 'prevent_404_for_search_case_price', 10, 2);

/**
 * search-case: 無効な menu パラメータの場合は症例一覧へリダイレクト（出力前に実行）
 */
function redirect_search_case_invalid_menu()
{
    if (!get_query_var('search_case')) {
        return;
    }
    if (!isset($_GET['menu'])) {
        return;
    }
    $selected_menu_id = (int) $_GET['menu'];
    $menu_post = $selected_menu_id > 0 ? get_post($selected_menu_id) : null;
    $is_invalid = $selected_menu_id <= 0
        || !$menu_post
        || $menu_post->post_type !== 'menu'
        || $menu_post->post_status !== 'publish';
    if ($is_invalid) {
        wp_safe_redirect(get_post_type_archive_link('case'), 302);
        exit;
    }
}
add_action('template_redirect', 'redirect_search_case_invalid_menu');


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



/* ---------- doctor 投稿タイプ ---------- */
// doctor 投稿タイプでは本文エディターを表示しない（クラシック用）
function renewal2026_disable_doctor_editor_support()
{
    remove_post_type_support('doctor', 'editor');
    remove_post_type_support('clinic', 'editor');
    remove_post_type_support('faq', 'editor');
}
add_action('init', 'renewal2026_disable_doctor_editor_support', 20);

// doctor 投稿タイプではブロックエディター自体を無効化
function renewal2026_disable_doctor_block_editor($use_block_editor, $post_type)
{
    if ($post_type === 'doctor') {
        return false;
    }

    if ($post_type === 'clinic') {
        return false;
    }

    if ($post_type === 'faq') {
        return false;
    }

    return $use_block_editor;
}
add_filter('use_block_editor_for_post_type', 'renewal2026_disable_doctor_block_editor', 10, 2);


// タイトルのみ検索
add_filter('posts_where', function ($where, $query) {
    global $wpdb;

    // 管理画面では適用しない
    if (is_admin()) return $where;

    // タイトル検索のみのフラグがあるときに適用
    if ($query->get('search_title_only')) {
        $search = esc_sql($query->get('s'));
        if ($search !== '') {
            $where .= " AND {$wpdb->posts}.post_title LIKE '%{$search}%'";
        }
    }

    return $where;
}, 10, 2);


// functions.phpに追加
add_filter('query_vars', function ($vars) {
    $vars[] = 'type';
    return $vars;
});
