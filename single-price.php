<?php get_header('meta'); ?>
<?php wp_head(); ?>
</head>

<body class="">
    <?php get_header(); ?>

    <main class="bl_commonlowerPage">

        <div class="bl_commonlowerPage_inner">
            <div class="bl_commonlowerPage_ttlContainer">
                <hgroup class="bl_commonlowerPage_ttl">
                    <p class="bl_commonlowerPage_ttl_enTtl">Price</p>
                    <h1 class="bl_commonlowerPage_ttl_jaTtl">料金表</h1>
                </hgroup>

                <?php get_template_part('inc/breadcrumbs'); ?>
            </div>

            <?php

            // price 投稿に紐づく menu-cat タームのみ取得（他投稿タイプで使われているタームは含めない）
            $price_post_ids = get_posts(array(
                'post_type' => 'price',
                'posts_per_page' => -1,
                'fields' => 'ids',
            ));

            $price_categories = !empty($price_post_ids)
                ? get_terms(array(
                    'taxonomy' => 'menu-cat',
                    'hide_empty' => false,
                    'object_ids' => $price_post_ids,
                ))
                : array();

            if (is_wp_error($price_categories)) {
                $price_categories = array();
            }
            ?>

            <div class="bl_commonlowerPage_contents ly_twoColumnContainer">

                <div class="ly_twoColumnContainer_inner">
                    <div class="l_twoColumnContainer_left">
                        <?php if (!empty($price_categories)): ?>

                            <nav class="bl_commonNavWrapper">
                                <?php foreach ($price_categories as $price_category): ?>
                                    <?php if ($price_category->parent == 0): ?>
                                        <div class="bl_commonNavWrapper_item">
                                            <p class="el_commonNavWrapper_item_ttl"><?php echo $price_category->name; ?></p>
                                            <?php

                                            $price_posts = get_posts(array(
                                                'post_type' => 'price',
                                                'posts_per_page' => -1,
                                                'fields' => 'ids',
                                                'tax_query' => array(
                                                    array(
                                                        'taxonomy' => 'menu-cat',
                                                        'terms' => $price_category->term_id,
                                                        'field' => 'term_id',
                                                        'operator' => 'IN',
                                                        'include_children' => true,
                                                    ),
                                                ),
                                            ));
                                            ?>
                                            <?php if (!empty($price_posts)): ?>
                                                <div class="bl_commonNavWrapper_selectWrapper">
                                                    <select class="el_commonNavWrapper_selectWrapper_select js_priceNavSelect" name="<?php echo $price_category->slug; ?>" id="nav-<?php echo $price_category->slug; ?>">
                                                        <option value="">施術を選ぶ</option>
                                                        <?php foreach ($price_posts as $post_id): ?>
                                                            <option value="<?php echo esc_url(get_permalink($post_id)); ?>"<?php selected(get_the_ID(), $post_id); ?>><?php echo esc_html(get_the_title($post_id)); ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </nav>
                        <?php endif; ?>
                    </div>

                    <div class="l_twoColumnContainer_right bl_priceOuterList">

                        <div class="bl_priceCatChildList">
                            <div class="bl_priceCatChildList_item">
                                <h2 class="el_priceCatChildList_item_ttl"><?php the_title(); ?></h2>

                                <?php if (have_rows('price_wrap')): ?>
                                    <?php while (have_rows('price_wrap')): the_row(); ?>
                                        <div class="bl_priceWrapper">
                                            <div class="bl_priceWrapper_item">
                                                <?php if (get_sub_field('left')): ?>
                                                    <p class="el_priceWrapper_item_ttl"><?php echo get_sub_field('left'); ?></p>
                                                <?php endif; ?>

                                                <?php if (have_rows('price_table')): ?>
                                                    <div class="bl_priceTableWrapper">
                                                        <div class="bl_priceTable">
                                                            <?php while (have_rows('price_table')): the_row(); ?>
                                                                <div class="bl_priceTable_item">
                                                                    <div class="bl_priceTable_item_upper">
                                                                        <p class="el_priceTable_item_upper_ttl"><?php echo get_sub_field('price_table-ttl'); ?></p>

                                                                        <?php if (have_rows('amount-table')): ?>
                                                                            <div class="bl_amountTable">
                                                                                <?php while (have_rows('amount-table')): the_row(); ?>

                                                                                    <?php if (get_sub_field('amount-table_txt')): ?>
                                                                                        <p class="el_amountTable_pricetxt el_amountTable_txt"><?php echo get_sub_field('amount-table_txt'); ?></p>
                                                                                    <?php endif; ?>

                                                                                    <?php if (get_sub_field('amount-table_view')): ?>
                                                                                        <p class="el_amountTable_view el_amountTable_txt"><?php echo get_sub_field('amount-table_view'); ?></p>
                                                                                    <?php endif; ?>

                                                                                    <?php if (get_sub_field('amount-table_num')): ?>
                                                                                        <p class="el_amountTable_num el_amountTable_txt"><?php echo get_sub_field('amount-table_num'); ?></p>
                                                                                    <?php endif; ?>

                                                                                <?php endwhile; ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <?php if (get_sub_field('price_table-txt')): ?>
                                                                        <p class="el_priceTable_item_lower_txt"><?php echo get_sub_field('price_table-txt'); ?></p>
                                                                    <?php endif; ?>
                                                                </div>
                                                            <?php endwhile; ?>
                                                        </div>
                                                        <p class="el_priceTableWrapper_lower_txt"><?php echo get_sub_field('price-caption'); ?></p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </div>
                        </div>
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