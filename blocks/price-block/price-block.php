<?php if (is_singular('menu')): ?>

    <div class="bl_relatedPriceBlock">
        <div class="bl_priceCatChildList">
            <?php
            $price_posts = get_posts(array(
                'post_type'      => 'price',
                'posts_per_page' => -1,
                'meta_query' => array(
                    array(
                        'key' => 'menu_select',
                        'value' => '"' . get_the_ID() . '"',
                        'compare' => 'LIKE',
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
    </div>



<?php endif; ?>