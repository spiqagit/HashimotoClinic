<?php get_header('meta'); ?>
<?php wp_head(); ?>

<?php

$type = get_query_var('type');
$search_keyword = get_query_var('s');
?>
</head>

<body class="">
    <?php get_header(); ?>

    <main class="bl_commonlowerPage">
        <div class="bl_commonlowerPage_inner">

            <?php
            // ページヘッダー
            ?>
            <div class="bl_commonlowerPage_ttlContainer">
                <?php if ($type == 'post'): ?>
                    <hgroup class="bl_commonlowerPage_ttl">
                        <p class="bl_commonlowerPage_ttl_enTtl">Blog</p>
                        <h1 class="bl_commonlowerPage_ttl_jaTtl">院長ブログ</h1>
                    </hgroup>
                <?php endif; ?>

                <?php if ($type == 'site'): ?>
                    <div class="bl_commonlowerPage_ttl">
                        <h1 class="bl_commonlowerPage_ttl_jaTtl">「<?php echo esc_html($search_keyword); ?>」の検索結果</h1>
                    </div>
                <?php endif; ?>
                <?php get_template_part('inc/breadcrumbs'); ?>
            </div>


            <div class="bl_commonlowerPage_contents">
                <?php if ($type == 'post'): ?>
                    <?php get_template_part('inc/search/search-post'); ?>
                <?php endif; ?>

                <?php if ($type == 'site'): ?>
                    <?php get_template_part('inc/search/search-site'); ?>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <?php get_footer(); ?>
</body>

</html>