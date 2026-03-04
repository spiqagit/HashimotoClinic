<?php get_header('meta'); ?>
<?php wp_head(); ?>
</head>

<body class="">
    <?php get_header(); ?>

    <main class="bl_commonlowerPage">
        <div class="bl_commonlowerPage_inner">

            <?php
            // ページヘッダー
            ?>
            <div class="bl_commonlowerPage_ttlContainer">
                <hgroup class="bl_commonlowerPage_ttl">
                    <p class="bl_commonlowerPage_ttl_enTtl">Price</p>
                    <h1 class="bl_commonlowerPage_ttl_jaTtl">料金表</h1>
                </hgroup>
                <?php get_template_part('inc/breadcrumbs'); ?>
            </div>

            <?php
            // price 投稿に紐づく menu-cat タームのみ取得
            $price_post_ids = get_posts(array(
                'post_type'      => 'price',
                'posts_per_page' => -1,
                'fields'         => 'ids',
            ));
            $price_categories = array();
            if (!empty($price_post_ids)) {
                $price_categories = get_terms(array(
                    'taxonomy'   => 'menu-cat',
                    'hide_empty' => false,
                    'object_ids' => $price_post_ids,
                ));
                if (is_wp_error($price_categories)) {
                    $price_categories = array();
                }
            }
            ?>

            <div class="bl_commonlowerPage_contents ly_twoColumnContainer">
                <div class="ly_twoColumnContainer_inner">

                    <?php // 左カラム：ナビゲーション 
                    ?>
                    <div class="l_twoColumnContainer_left">
                        <?php if (!empty($price_categories)): ?>
                            <nav class="bl_commonNavWrapper">
                                <?php foreach ($price_categories as $price_category): ?>
                                    <?php if ((int) $price_category->parent !== 0) continue; ?>

                                    <?php
                                    $nav_posts = get_posts(array(
                                        'post_type'      => 'price',
                                        'posts_per_page' => -1,
                                        'fields'         => 'ids',
                                        'tax_query'      => array(
                                            array(
                                                'taxonomy'         => 'menu-cat',
                                                'terms'            => $price_category->term_id,
                                                'field'            => 'term_id',
                                                'operator'         => 'IN',
                                                'include_children' => true,
                                            ),
                                        ),
                                    ));
                                    ?>
                                    <div class="bl_commonNavWrapper_item">
                                        <p class="el_commonNavWrapper_item_ttl"><?php echo esc_html($price_category->name); ?></p>
                                        <?php if (!empty($nav_posts)): ?>
                                            <div class="bl_commonNavWrapper_selectWrapper">
                                                <select class="el_commonNavWrapper_selectWrapper_select js_priceNavSelect" name="<?php echo esc_attr($price_category->slug); ?>" id="nav-<?php echo esc_attr($price_category->slug); ?>">
                                                    <option value="">施術を選ぶ</option>
                                                    <?php foreach ($nav_posts as $post_id): ?>
                                                        <?php $post = get_post($post_id); ?>
                                                        <option value="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_html(get_the_title($post->ID)); ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </nav>
                        <?php endif; ?>
                    </div>

                    <?php // 右カラム：料金一覧 
                    ?>
                    <div class="l_twoColumnContainer_right bl_priceOuterList">
                        <?php foreach ($price_categories as $price_category): ?>
                            <?php if ((int) $price_category->parent !== 0) continue; ?>

                            <div class="bl_priceOuterList_item">
                                <h2 class="el_priceOuterList_ttl"><?php echo esc_html($price_category->name); ?></h2>

                                <?php
                                $children = get_terms(array(
                                    'taxonomy'   => 'menu-cat',
                                    'parent'     => $price_category->term_id,
                                    'hide_empty' => true,
                                ));
                                ?>

                                <?php if (!empty($children) && !is_wp_error($children)): ?>
                                    <?php // 子タームあり：子タームごとにセクション 
                                    ?>
                                    <?php foreach ($children as $child_term): ?>
                                        <div class="bl_priceCatChildList">
                                            <h3 class="el_priceCatChildList_ttl"><?php echo esc_html($child_term->name); ?></h3>
                                            <?php
                                            $price_posts = get_posts(array(
                                                'post_type'      => 'price',
                                                'posts_per_page' => -1,
                                                'fields'         => 'ids',
                                                'tax_query'      => array(
                                                    array(
                                                        'taxonomy'         => 'menu-cat',
                                                        'terms'            => $child_term->term_id,
                                                        'field'            => 'term_id',
                                                        'operator'         => 'IN',
                                                        'include_children' => true,
                                                    ),
                                                ),
                                            ));
                                            ?>
                                            <?php if (!empty($price_posts)): ?>
                                                <?php foreach ($price_posts as $price_post): ?>
                                                    <div class="bl_priceCatChildList_item">
                                                        <h4 class="el_priceCatChildList_item_ttl"><?php echo esc_html(get_the_title($price_post)); ?></h4>

                                                        <?php if (have_rows('price_wrap', $price_post)): ?>
                                                            <?php while (have_rows('price_wrap', $price_post)): the_row(); ?>
                                                                <div class="bl_priceWrapper">
                                                                    <div class="bl_priceWrapper_item">
                                                                        <?php if (get_sub_field('left')): ?>
                                                                            <p class="el_priceWrapper_item_ttl"><?php echo esc_html(get_sub_field('left')); ?></p>
                                                                        <?php endif; ?>

                                                                        <?php if (have_rows('price_table')): ?>
                                                                            <div class="bl_priceTableWrapper">
                                                                                <div class="bl_priceTable">
                                                                                    <?php while (have_rows('price_table')): the_row(); ?>
                                                                                        <div class="bl_priceTable_item">
                                                                                            <div class="bl_priceTable_item_upper">
                                                                                                <p class="el_priceTable_item_upper_ttl"><?php echo esc_html(get_sub_field('price_table-ttl')); ?></p>

                                                                                                <?php if (have_rows('amount-table')): ?>
                                                                                                    <div class="bl_amountTable">
                                                                                                        <?php while (have_rows('amount-table')): the_row(); ?>
                                                                                                            <?php if (get_sub_field('amount-table_txt')): ?>
                                                                                                                <p class="el_amountTable_pricetxt el_amountTable_txt"><?php echo esc_html(get_sub_field('amount-table_txt')); ?></p>
                                                                                                            <?php endif; ?>
                                                                                                            <?php if (get_sub_field('amount-table_view')): ?>
                                                                                                                <p class="el_amountTable_view el_amountTable_txt"><?php echo esc_html(get_sub_field('amount-table_view')); ?></p>
                                                                                                            <?php endif; ?>
                                                                                                            <?php if (get_sub_field('amount-table_num')): ?>
                                                                                                                <p class="el_amountTable_num el_amountTable_txt"><?php echo esc_html(get_sub_field('amount-table_num')); ?></p>
                                                                                                            <?php endif; ?>
                                                                                                        <?php endwhile; ?>
                                                                                                    </div>
                                                                                                <?php endif; ?>
                                                                                            </div>

                                                                                            <?php if (get_sub_field('price_table-txt')): ?>
                                                                                                <p class="el_priceTable_item_lower_txt"><?php echo esc_html(get_sub_field('price_table-txt')); ?></p>
                                                                                            <?php endif; ?>
                                                                                        </div>
                                                                                    <?php endwhile; ?>
                                                                                </div>
                                                                                <p class="el_priceTableWrapper_lower_txt"><?php echo esc_html(get_sub_field('price-caption')); ?></p>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            <?php endwhile; ?>
                                                        <?php endif; ?>

                                                        <p>料金は全て税込価格です。</p>

                                                    </div>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>

                                <?php else: ?>

                                    <?php // 子タームなし：親タームに紐づく投稿を直接表示 
                                    ?>
                                    <div class="bl_priceCatChildList">
                                        <?php
                                        $price_posts = get_posts(array(
                                            'post_type'      => 'price',
                                            'posts_per_page' => -1,
                                            'fields'         => 'ids',
                                            'tax_query'      => array(
                                                array(
                                                    'taxonomy'         => 'menu-cat',
                                                    'terms'            => $price_category->term_id,
                                                    'field'            => 'term_id',
                                                    'operator'         => 'IN',
                                                    'include_children' => true,
                                                ),
                                            ),
                                        ));
                                        ?>
                                        <?php if (!empty($price_posts)): ?>
                                            <?php foreach ($price_posts as $price_post): ?>
                                                <div class="bl_priceCatChildList_item">
                                                    <h4 class="el_priceCatChildList_item_ttl"><?php echo esc_html(get_the_title($price_post)); ?></h4>

                                                    <?php if (have_rows('price_wrap', $price_post)): ?>
                                                        <?php while (have_rows('price_wrap', $price_post)): the_row(); ?>
                                                            <div class="bl_priceWrapper">
                                                                <div class="bl_priceWrapper_item">
                                                                    <?php if (get_sub_field('left')): ?>
                                                                        <p class="el_priceWrapper_item_ttl"><?php echo esc_html(get_sub_field('left')); ?></p>
                                                                    <?php endif; ?>

                                                                    <?php if (have_rows('price_table')): ?>
                                                                        <div class="bl_priceTableWrapper">
                                                                            <div class="bl_priceTable">
                                                                                <?php while (have_rows('price_table')): the_row(); ?>
                                                                                    <div class="bl_priceTable_item">
                                                                                        <div class="bl_priceTable_item_upper">
                                                                                            <p class="el_priceTable_item_upper_ttl"><?php echo esc_html(get_sub_field('price_table-ttl')); ?></p>

                                                                                            <?php if (have_rows('amount-table')): ?>
                                                                                                <div class="bl_amountTable">
                                                                                                    <?php while (have_rows('amount-table')): the_row(); ?>
                                                                                                        <?php if (get_sub_field('amount-table_txt')): ?>
                                                                                                            <p class="el_amountTable_pricetxt el_amountTable_txt"><?php echo esc_html(get_sub_field('amount-table_txt')); ?></p>
                                                                                                        <?php endif; ?>
                                                                                                        <?php if (get_sub_field('amount-table_view')): ?>
                                                                                                            <p class="el_amountTable_view el_amountTable_txt"><?php echo esc_html(get_sub_field('amount-table_view')); ?></p>
                                                                                                        <?php endif; ?>
                                                                                                        <?php if (get_sub_field('amount-table_num')): ?>
                                                                                                            <p class="el_amountTable_num el_amountTable_txt"><?php echo esc_html(get_sub_field('amount-table_num')); ?></p>
                                                                                                        <?php endif; ?>
                                                                                                    <?php endwhile; ?>
                                                                                                </div>
                                                                                            <?php endif; ?>
                                                                                        </div>

                                                                                        <?php if (get_sub_field('price_table-txt')): ?>
                                                                                            <p class="el_priceTable_item_lower_txt"><?php echo esc_html(get_sub_field('price_table-txt')); ?></p>
                                                                                        <?php endif; ?>
                                                                                    </div>
                                                                                <?php endwhile; ?>
                                                                            </div>
                                                                            <p class="el_priceTableWrapper_lower_txt"><?php echo esc_html(get_sub_field('price-caption')); ?></p>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endwhile; ?>
                                                    <?php endif; ?>

                                                    <p class="el_priceCatChildList_item_lower_txt">料金は全て税込価格です。</p>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>



                            </div>
                        <?php endforeach; ?>
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