<?php if (is_singular('menu')): ?>
    <div class="bl_commonBlogSwiperContainer bl_menuBlogSwiperContainer">
        <div class="bl_commonBlogSwiperContainer_inner">
            <button class="bl_commonBlogSwiper_prev" type="button">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow-prev.svg" alt="">
            </button>

            <div class="swiper bl_commonBlogSwiper">
                <div class="swiper-wrapper">
                    <?php
                    $relatedBlogList = get_field('related-blog-list');

                    $relatedBlogPosts = get_posts(array(
                        'post_type' => 'post',
                        'posts_per_page' => -1,
                        'post__in' => $relatedBlogList,
                    ));
                    ?>

                    <?php foreach ($relatedBlogPosts as $relatedBlogPost): ?>

                        <div class="swiper-slide">
                            <article class="bl_commonBlogSlideBtn">

                                <a href="<?php the_permalink($relatedBlogPost->ID); ?>" class="bl_commonBlogSlideBtn_imgContainer">
                                    <?php if (has_post_thumbnail($relatedBlogPost->ID)): ?>
                                        <img class="el_commonBlogSlideBtn_img" src="<?php echo get_the_post_thumbnail_url($relatedBlogPost->ID); ?>" alt="<?php echo get_the_title($relatedBlogPost->ID); ?>">
                                    <?php else: ?>
                                        <img class="l_commonBlogSlideBtn_img" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/doctor-no-image.jpg" alt="<?php echo get_the_title($relatedBlogPost->ID); ?>">
                                    <?php endif; ?>
                                </a>

                                <div class="bl_commonBlogSlideBtn_lower">
                                    <time class="el_commonBlogSlideBtn_lower_time" datetime="<?php echo get_the_date('Y-m-d', $relatedBlogPost->ID); ?>"><?php echo get_the_date('Y.m.d', $relatedBlogPost->ID); ?></time>

                                    <?php
                                    $categoryList = get_the_category($relatedBlogPost->ID);
                                    ?>
                                    <?php if ($categoryList): ?>
                                        <div class="bl_commonBlogSlideBtn_lower_categoryList">
                                            <?php foreach ($categoryList as $category): ?>
                                                <a href="<?php echo get_term_link($category->term_id); ?>" class="el_commonBlogSlideBtn_lower_categoryList_item"><?php echo $category->name; ?></a>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>

                                    <h1 class="el_commonBlogSlideBtn_lower_ttl">
                                        <a class="el_commonBlogSlideBtn_lower_ttl_link" href="<?php the_permalink($relatedBlogPost->ID); ?>">
                                            <?php echo get_the_title($relatedBlogPost->ID); ?>
                                        </a>
                                    </h1>
                                </div>
                            </article>
                        </div>

                    <?php endforeach; ?>
                </div>
            </div>
            <button class="bl_commonBlogSwiper_next" type="button">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/arrow-next.svg" alt="">
            </button>
        </div>
        <div class="bl_commonBlogSwiper_pagination"></div>
    </div>
<?php endif; ?>