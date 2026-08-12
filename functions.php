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

function remove_admin_selection_color()
{
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

/* ---------- 症例（case）：タイトル先頭の #数字 で並び替え ---------- */
/**
 * タイトルから症例番号を数値抽出し並べる。
 * 1. #数字あり → 小さい順（#100 → #101 → … → 最新）
 * 2. #数字なし → 末尾
 * orderby=case_number または _renewal2026_case_number_order=1 のとき適用。
 */
function renewal2026_wants_case_number_order($query)
{
    if ((int) $query->get('_renewal2026_case_number_order') === 1) {
        return true;
    }

    $orderby = $query->get('orderby');
    if ($orderby === 'case_number') {
        return true;
    }
    if (isset($query->query['orderby']) && $query->query['orderby'] === 'case_number') {
        return true;
    }

    return false;
}

/**
 * # / 全角＃ を除いた先頭を数値化（"229 (60代…" → 229）。
 * 番号ありは小さい順、番号なし（抽出結果 0）は末尾。
 */
function renewal2026_case_number_orderby_sql()
{
    global $wpdb;
    $title = "{$wpdb->posts}.post_title";
    $num = "CAST(TRIM(LEADING '#' FROM TRIM(LEADING '＃' FROM TRIM({$title}))) AS UNSIGNED)";

    // 番号ありを小さい順、番号なし(0)は末尾
    return "({$num} = 0) ASC, {$num} ASC, {$wpdb->posts}.ID ASC";
}

function renewal2026_case_number_posts_orderby($orderby, $query)
{
    if (!renewal2026_wants_case_number_order($query)) {
        return $orderby;
    }

    return renewal2026_case_number_orderby_sql();
}
add_filter('posts_orderby', 'renewal2026_case_number_posts_orderby', 9999, 2);
add_filter('posts_orderby_request', 'renewal2026_case_number_posts_orderby', 9999, 2);

function renewal2026_case_number_posts_clauses($clauses, $query)
{
    if (!renewal2026_wants_case_number_order($query)) {
        return $clauses;
    }

    $clauses['orderby'] = renewal2026_case_number_orderby_sql();
    return $clauses;
}
add_filter('posts_clauses', 'renewal2026_case_number_posts_clauses', 9999, 2);
add_filter('posts_clauses_request', 'renewal2026_case_number_posts_clauses', 9999, 2);

// orderby=case_number をフラグに変換（WP が未知の orderby を無視しても効くように）
function renewal2026_case_number_flag_query($query)
{
    if (!renewal2026_wants_case_number_order($query)) {
        return;
    }
    $query->set('_renewal2026_case_number_order', 1);
}
add_action('pre_get_posts', 'renewal2026_case_number_flag_query', 9998);

// 管理画面の症例一覧：デフォルトを #数字の小さい順（列クリック時の並び替えは尊重）
function renewal2026_case_admin_default_order($query)
{
    if (!is_admin() || !$query->is_main_query()) {
        return;
    }
    if ($query->get('post_type') !== 'case') {
        return;
    }
    if (isset($_GET['orderby'])) {
        return;
    }

    $query->set('orderby', 'case_number');
    $query->set('order', 'ASC');
    $query->set('_renewal2026_case_number_order', 1);
}
add_action('pre_get_posts', 'renewal2026_case_admin_default_order', 999);

/* ---------- 管理画面 ---------- */
// サイドメニューを非表示

// Contact Form 7（お問い合わせ）のメニューをカスタム投稿タイプより下へ（番号が大きいほどサイドバーで下）
function renewal2026_move_cf7_admin_menu_down()
{
    global $menu;
    if (!is_array($menu)) {
        return;
    }
    $slug = 'wpcf7';
    $item = null;
    $key_found = null;
    foreach ($menu as $key => $m) {
        if (isset($m[2]) && $m[2] === $slug) {
            $item = $m;
            $key_found = $key;
            break;
        }
    }
    if ($item === null) {
        return;
    }
    unset($menu[$key_found]);
    // 外観(60)より手前で、使える一番大きい番号＝サイドバーで一番下に近い位置
    for ($pos = 58; $pos >= 25; $pos--) {
        if (!isset($menu[$pos])) {
            $menu[$pos] = $item;
            return;
        }
    }
    $menu[58] = $item;
}
add_action('admin_menu', 'renewal2026_move_cf7_admin_menu_down', 9999);

// recruit 固定ページのエディターを非表示（テンプレート page-recruit.php またはスラッグ recruit のとき）
function renewal2026_is_recruit_page($post)
{
    if (!$post || $post->post_type !== 'page') {
        return false;
    }
    $template = get_page_template_slug($post);
    return $template === 'page-recruit.php' || $post->post_name === 'recruit';
}

add_filter('use_block_editor_for_post', function ($use_block_editor, $post) {
    if (renewal2026_is_recruit_page($post)) {
        return false;
    }
    return $use_block_editor;
}, 10, 2);

add_action('add_meta_boxes', function () {
    $post = get_post();
    if (!renewal2026_is_recruit_page($post)) {
        return;
    }
    remove_meta_box('postdivrich', 'page', 'normal');
    remove_meta_box('postimagediv', 'page', 'side');
}, 99);

add_action('admin_head', function () {
    $screen = get_current_screen();
    if (!$screen || $screen->id !== 'page' || $screen->base !== 'post') {
        return;
    }
    $post_id = isset($_GET['post']) ? (int) $_GET['post'] : 0;
    if (!$post_id) {
        return;
    }
    $post = get_post($post_id);
    if (!renewal2026_is_recruit_page($post)) {
        return;
    }
    echo '<style>
        #postdivrich,
        #postdiv,
        #post-body-content .wp-editor-wrap,
        #postimagediv {
            display: none !important;
        }
    </style>';
});

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
// 投稿（post）の編集画面でスラッグを変更できるメタボックス（ブロックエディターでURLの編集が表示されない場合用）
function renewal2026_post_slug_metabox()
{
    add_meta_box(
        'renewal2026_post_slug',
        __('スラッグ'),
        'renewal2026_post_slug_metabox_callback',
        'post',
        'side'
    );
}

function renewal2026_post_slug_metabox_callback($post)
{
    $slug = $post->post_name;
    wp_nonce_field('renewal2026_post_slug', 'renewal2026_post_slug_nonce');
?>
    <p>
        <label for="renewal2026_post_slug">スラッグ</label><br>
        <input type="hidden" name="renewal2026_post_slug_original" value="<?php echo esc_attr($slug); ?>" />
        <input type="text" id="renewal2026_post_slug" name="renewal2026_post_slug" value="<?php echo esc_attr($slug); ?>" class="widefat" />
    </p>
    <p class="description"><?php echo esc_html(home_url('/blog/' . $slug . '/')); ?></p>
<?php
}

function renewal2026_post_slug_save($post_id)
{
    if (!isset($_POST['renewal2026_post_slug_nonce']) || !wp_verify_nonce($_POST['renewal2026_post_slug_nonce'], 'renewal2026_post_slug')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (!isset($_POST['renewal2026_post_slug']) || get_post_type($post_id) !== 'post') {
        return;
    }

    $new_slug = sanitize_title(wp_unslash($_POST['renewal2026_post_slug']));
    if ($new_slug === '') {
        return;
    }

    // メタボックス未変更なら何もしない（ブロックエディター側のスラッグ保存を上書きしない）
    $original_slug = isset($_POST['renewal2026_post_slug_original'])
        ? sanitize_title(wp_unslash($_POST['renewal2026_post_slug_original']))
        : '';
    if ($new_slug === $original_slug) {
        return;
    }

    $current = get_post($post_id);
    if (!$current || $current->post_name === $new_slug) {
        return;
    }

    remove_action('save_post', 'renewal2026_post_slug_save');
    wp_update_post(array(
        'ID'        => $post_id,
        'post_name' => $new_slug,
    ));
    add_action('save_post', 'renewal2026_post_slug_save', 10, 1);
}
add_action('add_meta_boxes_post', 'renewal2026_post_slug_metabox');
add_action('save_post', 'renewal2026_post_slug_save');

// 投稿（post）のURLを /blog/スラッグ/ にする
function renewal2026_get_post_blog_base()
{
    $posts_page_id = (int) get_option('page_for_posts');
    if ($posts_page_id) {
        $posts_page = get_post($posts_page_id);
        if ($posts_page && $posts_page->post_name !== '') {
            return $posts_page->post_name;
        }
    }

    return 'blog';
}

function renewal2026_get_post_blog_url($post)
{
    if (is_numeric($post)) {
        $post = get_post($post);
    }
    if (!$post || $post->post_type !== 'post') {
        return '';
    }

    $slug = $post->post_name;
    if ($slug === '' && $post->post_status === 'auto-draft') {
        $slug = sanitize_title($post->post_title);
    }
    if ($slug === '') {
        $slug = (string) $post->ID;
    }

    return home_url(user_trailingslashit(renewal2026_get_post_blog_base() . '/' . $slug));
}

/**
 * 下書き等はコア同様 ?p=ID のままにする（/blog/スラッグ/ だと name 解決できずプレビューが 404 になる）
 */
function renewal2026_post_needs_plain_permalink($post)
{
    return in_array($post->post_status, array('draft', 'pending', 'auto-draft', 'future'), true);
}

// Custom Post Type Permalinks より後に適用し、投稿URLを /blog/スラッグ/ に固定する
function renewal2026_post_link_blog_prefix($permalink, $post, $leavename = false)
{
    if (!is_object($post) || $post->post_type !== 'post') {
        return $permalink;
    }

    // 下書き・予約などのプレビューはコアの ?p=ID 形式を維持する
    if (!$leavename && renewal2026_post_needs_plain_permalink($post)) {
        return $permalink;
    }

    $base = renewal2026_get_post_blog_base();
    if ($leavename) {
        return home_url(user_trailingslashit($base . '/%postname%'));
    }

    return renewal2026_get_post_blog_url($post);
}
add_filter('post_link', 'renewal2026_post_link_blog_prefix', 999, 3);
add_filter('post_type_link', 'renewal2026_post_link_blog_prefix', 999, 3);

// ブロックエディターのURLプレビュー・「投稿を表示」用
function renewal2026_get_sample_permalink($sample, $post_id, $title, $name, $post)
{
    if (!$post || $post->post_type !== 'post') {
        return $sample;
    }

    // 手動指定のスラッグを最優先（任意変更を許可）
    if ($name !== null && $name !== '') {
        $slug = sanitize_title($name);
    } elseif ($post->post_name !== '' && $post->post_status !== 'auto-draft') {
        // 既存スラッグを維持（タイトル変更で勝手に変わらないように）
        $slug = $post->post_name;
    } else {
        $slug = sanitize_title($title ? $title : $post->post_title);
    }

    if ($slug === '') {
        $slug = (string) $post->ID;
    }

    return array(
        home_url(user_trailingslashit(renewal2026_get_post_blog_base() . '/%postname%')),
        $slug,
    );
}
add_filter('get_sample_permalink', 'renewal2026_get_sample_permalink', 999, 5);

// ブログ一覧（固定ページ blog）のページネーション用
function renewal2026_post_blog_rewrite_rules()
{
    add_rewrite_rule('^blog/page/([0-9]+)/?$', 'index.php?pagename=blog&paged=$matches[1]', 'top');
    add_rewrite_rule('^blog/([^/]+)/?$', 'index.php?post_type=post&name=$matches[1]', 'top');
}
add_action('init', 'renewal2026_post_blog_rewrite_rules', 99);

/**
 * /blog/スラッグ/ が固定ページ blog の子ページとして解釈され 404 になるのを防ぐ。
 * 該当する子ページが存在しない場合は投稿（post）として解決する。
 */
function renewal2026_post_blog_request($query_vars)
{
    if (empty($query_vars['pagename']) || !preg_match('#^blog/([^/]+)$#', $query_vars['pagename'], $matches)) {
        return $query_vars;
    }

    $slug = $matches[1];
    if ($slug === 'page') {
        return $query_vars;
    }

    if (get_page_by_path($query_vars['pagename'], OBJECT, 'page')) {
        return $query_vars;
    }

    unset($query_vars['pagename']);
    $query_vars['name'] = $slug;
    $query_vars['post_type'] = 'post';

    return $query_vars;
}
add_filter('request', 'renewal2026_post_blog_request');

// ブロックエディターの「投稿を表示」リンクを正しいパーマリンクに揃える
// ※ slug / generated_slug は上書きしない（任意のスラッグ変更を妨げない）
function renewal2026_post_rest_link($response, $post, $request)
{
    if ($post->post_type !== 'post') {
        return $response;
    }

    $fresh_post = get_post($post->ID);
    if (!$fresh_post) {
        return $response;
    }

    $base = renewal2026_get_post_blog_base();

    // permalink_template は下書きでも公開後の形を見せる（スラッグ編集UI用）
    if (array_key_exists('permalink_template', $response->data)) {
        $response->data['permalink_template'] = home_url(user_trailingslashit($base . '/%postname%'));
    }

    // link（プレビュー／表示）は未公開時は ?p=ID を維持する
    if (renewal2026_post_needs_plain_permalink($fresh_post) || $fresh_post->post_name === '') {
        return $response;
    }

    $response->data['link'] = renewal2026_get_post_blog_url($fresh_post);

    return $response;
}
add_filter('rest_prepare_post', 'renewal2026_post_rest_link', 99999, 3);

function get_blog_pagenum_link($page)
{
    if ($page <= 1) {
        return home_url('/blog/');
    }
    return home_url('/blog/page/' . $page . '/');
}

function renewal2026_flush_rewrite_rules()
{
    renewal2026_post_blog_rewrite_rules();
    flush_rewrite_rules();
}

// テーマ有効化時・リライト変更後にフラッシュ（管理画面「設定」→「パーマリンク」で「変更を保存」でも可）
function renewal2026_flush_rewrite_on_activation()
{
    renewal2026_flush_rewrite_rules();
}
add_action('after_switch_theme', 'renewal2026_flush_rewrite_on_activation');

// リライトルール更新時に1回だけ自動フラッシュ
function renewal2026_maybe_flush_rewrite_rules()
{
    if (get_option('renewal2026_rewrite_version') === '3') {
        return;
    }
    renewal2026_flush_rewrite_rules();
    update_option('renewal2026_rewrite_version', '3');
}
add_action('init', 'renewal2026_maybe_flush_rewrite_rules', 999);

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

    if (is_singular('recruit')) {
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



/**
 * サイト内検索（type=site）はタイトル・本文・抜粋・タクソノミー・カスタムフィールドを対象。
 * ブログ検索（type=post / search_title_only）はタイトルのみ。
 */
function renewal2026_is_title_only_search($wp_query)
{
    $type = isset($_GET['type']) ? (string) $_GET['type'] : (string) $wp_query->get('type');
    // サイト内検索は search_title_only が残っていても本文を対象にする
    if ($type === 'site') {
        return false;
    }
    if ($type === 'post' || $wp_query->get('search_title_only')) {
        return true;
    }
    return false;
}

function my_custom_search($search, $wp_query)
{
    global $wpdb;
    if (!isset($wp_query->query_vars)) {
        return $search;
    }
    $keyword = isset($wp_query->query_vars['s']) ? $wp_query->query_vars['s'] : '';
    if ($keyword === '' || $keyword === null) {
        return $search;
    }

    $search_words = explode(' ', $keyword);
    $search = '';
    $title_only = renewal2026_is_title_only_search($wp_query);

    foreach ($search_words as $word) {
        if ($word === '' || $word === null) {
            continue;
        }
        $search_word = '%' . esc_sql($word) . '%';
        if ($title_only) {
            $search .= " AND {$wpdb->posts}.post_title LIKE '{$search_word}' ";
            continue;
        }
        $search .= " AND (
            {$wpdb->posts}.post_title LIKE '{$search_word}'
            OR {$wpdb->posts}.post_excerpt LIKE '{$search_word}'
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
                AND meta_key NOT LIKE '\\_%'
            )
        ) ";
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
    remove_post_type_support('recruit', 'editor');
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

    if ($post_type === 'recruit') {
        return false;
    }

    if ($post_type === 'faq') {
        return false;
    }

    return $use_block_editor;
}
add_filter('use_block_editor_for_post_type', 'renewal2026_disable_doctor_block_editor', 10, 2);


// タイトルのみ検索は my_custom_search / renewal2026_is_title_only_search に集約


// functions.phpに追加
add_filter('query_vars', function ($vars) {
    $vars[] = 'type';
    return $vars;
});


/* ---------- Contact Form 7：メールアドレス一致チェック（email と email-2） ---------- */
function renewal2026_cf7_validate_email_match($result, $tag)
{
    if ($tag->name !== 'email-2') {
        return $result;
    }
    $submission = WPCF7_Submission::get_instance();
    if (!$submission) {
        return $result;
    }
    $posted = $submission->get_posted_data();
    $email = isset($posted['email']) ? trim((string) $posted['email']) : '';
    $email2 = isset($posted['email-2']) ? trim((string) $posted['email-2']) : '';
    if ($email2 !== '' && $email !== $email2) {
        $result->invalidate($tag, 'メールアドレスが一致しません。同じメールアドレスを入力してください。');
    }
    return $result;
}
add_filter('wpcf7_validate_email', 'renewal2026_cf7_validate_email_match', 20, 2);
add_filter('wpcf7_validate_email*', 'renewal2026_cf7_validate_email_match', 20, 2);


/* ---------- Contact Form 7：ルビ（フリガナ）はカタカナのみ許可 ---------- */
function renewal2026_cf7_validate_rubi_katakana($result, $tag)
{
    if ($tag->name !== 'rubi') {
        return $result;
    }
    $submission = WPCF7_Submission::get_instance();
    if (!$submission) {
        return $result;
    }
    $posted = $submission->get_posted_data();
    $value = isset($posted['rubi']) ? trim((string) $posted['rubi']) : '';
    if ($value === '') {
        return $result;
    }
    // カタカナ・長音（ー）・中黒（・）・スペースのみ許可
    if (!preg_match('/^[\p{Katakana}ー・\s]+$/u', $value)) {
        $result->invalidate($tag, 'カタカナで入力してください。');
    }
    return $result;
}
add_filter('wpcf7_validate_text', 'renewal2026_cf7_validate_rubi_katakana', 20, 2);
add_filter('wpcf7_validate_text*', 'renewal2026_cf7_validate_rubi_katakana', 20, 2);


/**
 * 症例絞り込み（search-case + ?menu=）かどうか。
 * AIOSEO 4.x はこのURLを「通常のWP条件分岐」に当てはめず getTitle/getDescription が空になるため、
 * aioseo_title / aioseo_description フィルタは通らない。pre_get_document_title と head 直出力で補う。
 */
function is_search_case_page()
{
    return (int) get_query_var('search_case') === 1 && isset($_GET['menu']);
}

function renewal2026_search_case_document_title()
{
    $post_id = (int) $_GET['menu'];
    $post_title = $post_id ? get_the_title($post_id) : '';

    return $post_title
        ? $post_title . 'の絞り込み結果 | 静岡美容外科橋本クリニック'
        : '絞り込み結果 | 静岡美容外科橋本クリニック';
}

function renewal2026_search_case_meta_description()
{
    $post_id = (int) $_GET['menu'];
    $post_title = $post_id ? get_the_title($post_id) : '';

    return $post_title ? $post_title . 'に関する症例の絞り込み結果ページです。' : '';
}

add_filter('pre_get_document_title', function ($title) {
    if (!is_search_case_page()) {
        return $title;
    }
    return renewal2026_search_case_document_title();
}, 100000);

add_action('wp_head', function () {
    if (!is_search_case_page()) {
        return;
    }
    $description = renewal2026_search_case_meta_description();
    if ($description !== '') {
        echo '<meta name="description" content="' . esc_attr($description) . '" />' . "\n";
    }
    echo "<meta name=\"robots\" content=\"noindex, follow\" />\n";
}, 2);


$categories = get_the_category();

// デフォルトのカテゴリー列を削除して再登録
add_filter('manage_posts_columns', function ($columns) {
    unset($columns['categories']);
    $columns['categories'] = 'カテゴリー';
    return $columns;
});

// カスタム列の中身を出力
add_action('manage_posts_custom_column', function ($column, $post_id) {
    if ($column === 'categories') {
        $categories = get_the_category($post_id);
        usort($categories, function ($a, $b) {
            return $a->parent - $b->parent;
        });
        $links = array_map(function ($cat) use ($post_id) {
            return '<a href="' . esc_url(add_query_arg(['category_name' => $cat->slug], admin_url('edit.php'))) . '">' . esc_html($cat->name) . '</a>';
        }, $categories);
        echo implode('、', $links);
    }
}, 10, 2);


/**
 * タクソノミー・日付アーカイブページ用 OGP 画像を直接出力
 */
add_action('wp_head', 'custom_taxonomy_ogp_image', 5);
function custom_taxonomy_ogp_image()
{

    if (! is_tax() && ! is_category() && ! is_tag() && ! is_date()) {
        return;
    }

    // ★ デフォルト OGP 画像の URL を変更してください
    $default_ogp_image   = get_template_directory_uri() . '/assets/img/common/ogp.jpg';
    $default_ogp_image_w = 1200;
    $default_ogp_image_h = 630;

    $ogp_image   = $default_ogp_image;
    $ogp_image_w = $default_ogp_image_w;
    $ogp_image_h = $default_ogp_image_h;

    $ogp_title       = wp_get_document_title();
    $ogp_description = '';
    $ogp_url         = home_url(add_query_arg(null, null));

    if (is_tax() || is_category() || is_tag()) {
        $term = get_queried_object();
        if ($term && ! is_wp_error($term)) {
            $ogp_description = wp_strip_all_tags(term_description($term->term_id, $term->taxonomy));

            $term_thumbnail_id = get_term_meta($term->term_id, 'thumbnail_id', true);
            if ($term_thumbnail_id) {
                $img = wp_get_attachment_image_src($term_thumbnail_id, 'full');
                if ($img) {
                    $ogp_image   = $img[0];
                    $ogp_image_w = $img[1];
                    $ogp_image_h = $img[2];
                }
            }
        }
    }

    if (is_date()) {
        $ogp_description = get_bloginfo('description');
    }

?>
    <!-- Custom OGP for Taxonomy / Date Archive -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo esc_url($ogp_url); ?>" />
    <meta property="og:title" content="<?php echo esc_attr($ogp_title); ?>" />
    <meta property="og:description" content="<?php echo esc_attr($ogp_description); ?>" />
    <meta property="og:image" content="<?php echo esc_url($ogp_image); ?>" />
    <meta property="og:image:width" content="<?php echo esc_attr($ogp_image_w); ?>" />
    <meta property="og:image:height" content="<?php echo esc_attr($ogp_image_h); ?>" />
    <meta property="og:site_name" content="<?php echo esc_attr(get_bloginfo('name')); ?>" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="<?php echo esc_attr($ogp_title); ?>" />
    <meta name="twitter:description" content="<?php echo esc_attr($ogp_description); ?>" />
    <meta name="twitter:image" content="<?php echo esc_url($ogp_image); ?>" />
<?php
}
