<?php get_header('meta'); ?>
<?php wp_head(); ?>
</head>

<body>

    <?php get_header(); ?>

    <main class="bl_commonArticlePage">
        <div class="bl_commonArticlePage_inner">
            <article class="bl_menuArticle">
                <div class="bl_menuArticle_header">
                    <div class="bl_menuArticle_header_inner">
                        <div class="bl_menuArticle_header_ttlContainer">
                            <div class="bl_menuArticle_header_ttlContainer_upper">
                                <h1 class="el_menuArticle_header_ttlContainer_ttl">
                                    <?php the_title(); ?>
                                </h1>

                                <?php if (get_field('menu-subtxt')): ?>
                                    <p class="el_menuArticle_header_ttlContainer_subTxt">
                                        <?php the_field('menu-subtxt'); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                            <?php get_template_part('inc/breadcrumbs'); ?>
                        </div>
                        <div class="bl_menuArticle_header_imgContainer">
                            <?php if (get_the_post_thumbnail()): ?>
                                <img class="el_menuArticle_header_imgContainer_img" src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>">
                            <?php else: ?>
                                <img class="el_menuArticle_header_imgContainer_img" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/menu-no-image.jpg" alt="<?php the_title(); ?>">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="bl_menuArticle_contents">
                    <div class="bl_menuArticle_contents_inner">
                        <div class="bl_menuArticle_navContainer bl_menuArticle_navContainer_pc">
                            <nav class="bl_commonIndexNav" id="js_commonIndexNav">
                                <h2 class="el_commonIndexNav_ttl">Index</h2>
                                <ul class="bl_commonIndexNav_list" id="js_commonIndexNav_list"></ul>
                            </nav>
                        </div>

                        <div class="bl_menuArticle_navContainer_sp" id="js_menuArticle_indexAccordion">
                            <button class="bl_menuArticle_navContainer_sp_btn" type="button" aria-expanded="false" aria-controls="js_menuArticle_indexAccordion_body">
                                <span class="bl_menuArticle_navContainer_sp_btn_txt">Index</span>
                                <span class="bl_menuArticle_navContainer_sp_btn_arrow">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/index-arrow.svg" alt="">
                                </span>
                            </button>
                            <div class="bl_menuArticle_navContainer_sp_body" id="js_menuArticle_indexAccordion_body" role="region" aria-label="目次">
                                <ul class="bl_commonIndexNav_list_sp" id="js_commonIndexNav_list_sp"></ul>
                            </div>
                        </div>

                        <div class="bl_commonArticle_content">
                            <?php the_content(); ?>

                            <div class="bl_commonArticle_content_allBtnContainer">
                                <a href="<?php echo home_url('/service/'); ?>" class="bl_commonArticle_content_allBtn">一覧へ戻る</a>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </main>

    <?php get_footer(); ?>

</body>

</html>