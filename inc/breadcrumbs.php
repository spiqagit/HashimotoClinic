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
                <a class="bl_breadcrumbs_list_item_link" href="<?php echo home_url(); ?>/price/">料金表</a>
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
                <a class="bl_breadcrumbs_list_item_link" href="<?php echo home_url(); ?>/menu/">施術メニュー</a>
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

    </ul>
</div>