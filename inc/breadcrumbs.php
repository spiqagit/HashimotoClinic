<div class="bl_breadcrumbs">
    <ul class="bl_breadcrumbs_list">
        <li class="bl_breadcrumbs_list_item">
            <a class="bl_breadcrumbs_list_item_link" href="<?php echo home_url(); ?>">トップ</a>
        </li>


        <?php
        /* 料金表 */
        ?>
        <?php if (is_post_type_archive('price')): ?>

            <li class="bl_breadcrumbs_list_item">
                <p class="bl_breadcrumbs_list_item_text">料金表</p>
            </li>
        <?php endif; ?>

        <?php if (is_singular('price') && !is_post_type_archive('price')): ?>
            <li class="bl_breadcrumbs_list_item">
                <a class="bl_breadcrumbs_list_item_link" href="<?php echo home_url(); ?>/payment/">料金表</a>
            </li>
            <li class="bl_breadcrumbs_list_item">
                <p class="bl_breadcrumbs_list_item_text"><?php the_title(); ?></p>
            </li>
        <?php endif; ?>


        <?php
        /* メニュー */
        ?>
        <?php if (is_post_type_archive('menu')): ?>
            <li class="bl_breadcrumbs_list_item">
                <p class="bl_breadcrumbs_list_item_text">施術メニュー</p>
            </li>
        <?php endif; ?>

        <?php if (is_singular('menu') && !is_post_type_archive('menu')): ?>
            <li class="bl_breadcrumbs_list_item">
                <a class="bl_breadcrumbs_list_item_link" href="<?php echo home_url(); ?>/service/">施術メニュー</a>
            </li>
            <li class="bl_breadcrumbs_list_item">
                <p class="bl_breadcrumbs_list_item_text"><?php the_title(); ?></p>
            </li>
        <?php endif; ?>

        <?php
        /* よくある質問 */
        ?>
        <?php if (is_post_type_archive('faq')): ?>
            <li class="bl_breadcrumbs_list_item">
                <p class="bl_breadcrumbs_list_item_text">よくある質問</p>
            </li>
        <?php endif; ?>


        <?php
        /* お知らせ */
        ?>
        <?php if (is_post_type_archive('news')): ?>
            <li class="bl_breadcrumbs_list_item">
                <p class="bl_breadcrumbs_list_item_text">お知らせ</p>
            </li>
        <?php endif; ?>

        <?php if (is_singular('news') && !is_post_type_archive('news')): ?>
            <li class="bl_breadcrumbs_list_item">
                <a class="bl_breadcrumbs_list_item_link" href="<?php echo home_url(); ?>/news/">お知らせ</a>
            </li>
            <li class="bl_breadcrumbs_list_item">
                <p class="bl_breadcrumbs_list_item_text"><?php the_title(); ?></p>
            </li>
        <?php endif; ?>

        <?php if (is_singular('faq') && !is_post_type_archive('faq')): ?>
            <li class="bl_breadcrumbs_list_item">
                <a class="bl_breadcrumbs_list_item_link" href="<?php echo home_url(); ?>/faq/">よくある質問</a>
            </li>
            <li class="bl_breadcrumbs_list_item">
                <p class="bl_breadcrumbs_list_item_text"><?php the_title(); ?></p>
            </li>
        <?php endif; ?>

        <?php
        /* 症例 */
        ?>
        <?php if (is_post_type_archive('case')): ?>
            <li class="bl_breadcrumbs_list_item">
                <p class="bl_breadcrumbs_list_item_text">症例</p>
            </li>
        <?php endif; ?>

        <?php if (get_query_var('search_case')): ?>
            <?php
            $menu_id = isset($_GET['menu']) ? (int) $_GET['menu'] : 0;
            $menu_label = '';
            if ($menu_id > 0) {
                $menu_post = get_post($menu_id);
                if ($menu_post && $menu_post->post_type === 'menu' && $menu_post->post_status === 'publish') {
                    $menu_label = get_the_title($menu_post);
                }
            }
            ?>
            <li class="bl_breadcrumbs_list_item">
                <a class="bl_breadcrumbs_list_item_link" href="<?php echo esc_url(get_post_type_archive_link('case')); ?>">症例</a>
            </li>
            <li class="bl_breadcrumbs_list_item">
                <p class="bl_breadcrumbs_list_item_text"><?php echo $menu_label ? esc_html($menu_label) . 'の症例' : '症例検索'; ?></p>
            </li>
        <?php endif; ?>

        <?php if (is_singular('case') && !is_post_type_archive('case')): ?>
            <li class="bl_breadcrumbs_list_item">
                <a class="bl_breadcrumbs_list_item_link" href="<?php echo home_url(); ?>/case/">症例</a>
            </li>
            <li class="bl_breadcrumbs_list_item">
                <p class="bl_breadcrumbs_list_item_text"><?php the_title(); ?></p>
            </li>
        <?php endif; ?>

        <?php
        /* 院長ブログ */
        ?>
        <?php if (is_home()): ?>
            <li class="bl_breadcrumbs_list_item">
                <p class="bl_breadcrumbs_list_item_text">院長ブログ</p>
            </li>
        <?php endif; ?>

        <?php if (is_search() && get_query_var('type') == 'post'): ?>
            <li class="bl_breadcrumbs_list_item">
                <a class="bl_breadcrumbs_list_item_link" href="<?php echo home_url(); ?>/blog/">院長ブログ</a>
            </li>
            <li class="bl_breadcrumbs_list_item">
                <p class="bl_breadcrumbs_list_item_text">検索結果</p>
            </li>
        <?php endif; ?>

        <?php if (is_category()): ?>
            <li class="bl_breadcrumbs_list_item">
                <a class="bl_breadcrumbs_list_item_link" href="<?php echo home_url(); ?>/blog/">院長ブログ</a>
            </li>
            <li class="bl_breadcrumbs_list_item">
                <p class="bl_breadcrumbs_list_item_text"><?php single_cat_title(); ?></p>
            </li>
        <?php endif; ?>

        <?php if (is_date()): ?>
            <li class="bl_breadcrumbs_list_item">
                <a class="bl_breadcrumbs_list_item_link" href="<?php echo home_url(); ?>/blog/">院長ブログ</a>
            </li>
            <li class="bl_breadcrumbs_list_item">
                <p class="bl_breadcrumbs_list_item_text"><?php echo get_the_date('Y.m.d'); ?></p>
            </li>
        <?php endif; ?>

        <?php if (is_singular('post')): ?>
            <li class="bl_breadcrumbs_list_item">
                <a class="bl_breadcrumbs_list_item_link" href="<?php echo home_url(); ?>/blog/">院長ブログ</a>
            </li>
            <li class="bl_breadcrumbs_list_item">
                <p class="bl_breadcrumbs_list_item_text"><?php the_title(); ?></p>
            </li>
        <?php endif; ?>

        <?php if (is_search() && get_query_var('type') == 'site'): ?>
            <li class="bl_breadcrumbs_list_item">
                <p class="bl_breadcrumbs_list_item_text">「<?php echo esc_html(get_query_var('s')); ?>」の検索結果</p>
            </li>
        <?php endif; ?>

        <?php
        /* ドクター */
        ?>
        <?php if (is_post_type_archive('doctor')): ?>
            <li class="bl_breadcrumbs_list_item">
                <p class="bl_breadcrumbs_list_item_text">ドクター紹介</p>
            </li>
        <?php endif; ?>


        <?php if (is_page('information')): ?>
            <li class="bl_breadcrumbs_list_item">
                <p class="bl_breadcrumbs_list_item_text">クリニックについて</p>
            </li>
        <?php endif; ?>

        <?php if (is_page('access')): ?>
            <li class="bl_breadcrumbs_list_item">
                <p class="bl_breadcrumbs_list_item_text">アクセス</p>
            </li>
        <?php endif; ?>


        <?php if (is_page('monitor')): ?>
            <li class="bl_breadcrumbs_list_item">
                <p class="bl_breadcrumbs_list_item_text">モニター募集</p>
            </li>
        <?php endif; ?>

        <?php if (is_page('recruit')): ?>
            <li class="bl_breadcrumbs_list_item">
                <p class="bl_breadcrumbs_list_item_text">採用情報</p>
            </li>
        <?php endif; ?>

        <?php if (is_page('contact')): ?>
            <li class="bl_breadcrumbs_list_item">
                <p class="bl_breadcrumbs_list_item_text">お問い合わせ</p>
            </li>
        <?php endif; ?>

        <?php if (is_page('privacy-policy')): ?>
            <li class="bl_breadcrumbs_list_item">
                <p class="bl_breadcrumbs_list_item_text">プライバシーポリシー</p>
            </li>
        <?php endif; ?>

        <?php if (is_404()): ?>
            <li class="bl_breadcrumbs_list_item">
                <p class="bl_breadcrumbs_list_item_text">ページが見つかりませんでした</p>
            </li>
        <?php endif; ?>

    </ul>
</div>