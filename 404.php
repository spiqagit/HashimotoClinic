<?php
/*
 * Template Name: thanks
 */
?>
<?php get_header('meta'); ?>
<?php wp_head(); ?>
</head>

<body class="">
    <?php get_header(); ?>

    <main class="bl_commonlowerPage">
        <div class="bl_commonlowerPage_inner">

            <div class="bl_404Container">
                <div class="bl_404Container_breadcrumbs">
                    <?php get_template_part('inc/breadcrumbs'); ?>
                </div>
                <div class="bl_404Container_inner">

                    <h1 class="el_thanksContainer_ttl">ページが見つかりませんでした</h1>

                    <p class="el_404Container_txt">お探しのページが見つかりませんでした。<br>一時的にアクセスできない状況にあるか、<br class="is-sp">移動もしくは削除された可能性があります。</p>

                    <a href="<?php echo home_url('/'); ?>" class="el_404Container_btn">トップへ戻る</a>
                </div>
            </div>
        </div>
    </main>
    <?php get_footer(); ?>
</body>

</html>