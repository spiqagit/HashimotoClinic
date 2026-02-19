<?php get_header('meta'); ?>
<?php wp_head(); ?>
</head>

<body class="pg_price">
    <div class="bl_commonBgContainer">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/bg.png" alt="">
    </div>
    <?php get_header(); ?>

    <?php
    if (get_the_terms(get_the_ID(), 'page-cat')) {
        $page_cat = get_the_terms(get_the_ID(), 'page-cat');
    } else {
        $page_cat = false;
    }
    ?>
    <main class="ly_commonPage ly_overBg">


        <div class="bl_commonSingleTtlContainer">
            <div class="bl_commonSingleTtlContainer_inner">
                <div class="bl_commonSingleTtlContainer_breadcrumbs">
                    <?php get_template_part('inc/breadcrumbs'); ?>
                </div>
                <div class="bl_commonSingleTtlContainer_ttlContainer">
                    <h1 class="bl_commonSingleTtlContainer_ttl">
                        <?php the_title(); ?>
                    </h1>
                </div>
            </div>
        </div>

        <div class="ly_caseArticleSec">
            <div class="ly_caseArticleSec_inner">
                <div class="bl_caseSlideContainer">
                    <?php if (have_rows('slide')): ?>
                        <?php
                        $slide_count = count(get_field('slide'));
                        ?>
                        <div class="splide case-slider" data-slide-count="<?php echo $slide_count; ?>">
                            <div class="splide__track">
                                <ul class="splide__list">
                                    <?php while (have_rows('slide')) : the_row(); ?>
                                        <li class="splide__slide">
                                            <img class="case-slider_img" src="<?php echo get_sub_field('img'); ?>" alt="">
                                            <?php if (get_sub_field('caption')): ?>
                                                <p class="case-slider_caption"><?php echo get_sub_field('caption'); ?></p>
                                            <?php endif; ?>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
                            </div>
                            <?php if ($slide_count >= 1): ?>
                                <div class="splide__arrows">
                                    <button class="splide__arrow splide__arrow--prev">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="12" viewBox="0 0 18 12" fill="none">
                                            <path d="M6.30371 0.706975C6.01082 0.414081 5.53508 0.414081 5.24219 0.706975L0.469727 5.48041C0.176833 5.77331 0.176833 6.24807 0.469727 6.54096L5.24219 11.3144C5.53508 11.6073 6.01082 11.6073 6.30371 11.3144C6.5966 11.0215 6.5966 10.5458 6.30371 10.2529L2.81055 6.76069H17C17.4142 6.76069 17.75 6.4249 17.75 6.01069C17.75 5.59647 17.4142 5.26069 17 5.26069H2.81055L6.30371 1.7685C6.5966 1.4756 6.5966 0.999868 6.30371 0.706975Z" fill="white"></path>
                                        </svg>
                                    </button>
                                    <ul class="splide__pagination">
                                    </ul>
                                    <button class="splide__arrow splide__arrow--next">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="12" viewBox="0 0 18 12" fill="none">
                                            <path d="M11.6963 0.706975C11.9892 0.414081 12.4649 0.414081 12.7578 0.706975L17.5303 5.48041C17.8232 5.77331 17.8232 6.24807 17.5303 6.54096L12.7578 11.3144C12.4649 11.6073 11.9892 11.6073 11.6963 11.3144C11.4034 11.0215 11.4034 10.5458 11.6963 10.2529L15.1895 6.76069H1C0.585786 6.76069 0.25 6.4249 0.25 6.01069C0.25 5.59647 0.585786 5.26069 1 5.26069H15.1895L11.6963 1.7685C11.4034 1.4756 11.4034 0.999868 11.6963 0.706975Z" fill="white"></path>
                                        </svg>
                                    </button>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <article class="bl_menuArticleSec_inner_article ">
                    <div class="bl_articlePage_article">
                        <?php the_content(); ?>


                        <?php
                        $caseInfoSlugList = ["case-price", "case-time", "case-downtime", "case-makeup", "case-risk"];
                        ?>


                        <?php if (get_field('case-price') || get_field('case-time') || get_field('case-downtime') || get_field('case-makeup') || get_field('case-risk')): ?>
                            <figure class="wp-block-flexible-table-block-table is-test">
                                <table class="has-fixed-layout">
                                    <?php foreach ($caseInfoSlugList as $caseInfoSlug): ?>
                                        <?php if (get_field($caseInfoSlug)): ?>
                                            <tr>
                                                <th>
                                                    <?php
                                                    $field_object = get_field_object($caseInfoSlug);
                                                    echo $field_object['label'];
                                                    ?>
                                                </th>
                                                <td><?php the_field($caseInfoSlug); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </table>
                            </figure>
                            <p>※自由診療になります。</p>
                        <?php endif; ?>
                        
                    </div>
                </article>
            </div>
        </div>

        <div class="ly_caseRecommendBgContainer">

            <picture class="el_caseRecommendBgContainer_img">
                <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/case/sp-top-wave.png" media="(max-width: 768px)">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/case/pc-top-wave.png" alt="">
            </picture>

            <section class="bl_caseRecommendSec">
                <div class="bl_caseRecommendSec_inner">

                    <div class="bl_menuArticleSec_inner_article_ttlContainer bl_caseRecommendSec_ttlContainer">
                        <hgroup class="bl_commonSectionTtl bl_topFeatureSec_ttl">
                            <p class="el_commonSectionTtl_ttl">Related Cases</p>
                            <h2 class="el_commonSectionTtl_ttl_ttl">関連する症例</h2>
                        </hgroup>
                    </div>

                    <?php
                    $menu_selectList = get_field('menu_select');
                    $menu_select = !empty($menu_selectList) ? $menu_selectList : array();

                    $meta_query = array('relation' => 'OR');
                    if (!empty($menu_select)) {
                        foreach ($menu_select as $select) {
                            $meta_query[] = array(
                                'key' => 'menu_select',
                                'value' => '"' . $select . '"',
                                'compare' => 'LIKE'
                            );
                        }
                    }

                    $args = array(
                        'post_type' => 'case',
                        'posts_per_page' => 3,
                        'orderby' => 'rand',
                        'meta_query' => $meta_query
                    );
                    $query = new WP_Query($args);
                    ?>
                    <?php if ($query->have_posts()) : ?>
                        <div class="bl_caseList_item_list">
                            <?php while ($query->have_posts()) : $query->the_post(); ?>
                                <a href="<?php the_permalink(); ?>" class="bl_caseList_item_btn">
                                    <div class="bl_caseList_item_imgContainer">
                                        <?php if (have_rows('slide')): ?>
                                            <?php
                                            $i = 0;
                                            while (have_rows('slide')): the_row();
                                                if ($i === 0): ?>
                                                    <img class="bl_caseList_item_imgContainer_img" src="<?php the_sub_field('img'); ?>" alt="<?php the_title(); ?>">
                                            <?php
                                                endif;
                                                $i++;
                                            endwhile;
                                            ?>
                                        <?php else: ?>
                                            <img class="bl_caseList_item_imgContainer_img" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/no-post.jpg" alt="<?php the_title(); ?>">
                                        <?php endif; ?>
                                    </div>

                                    <div class="bl_caseList_item_txtContainer">
                                        <div class="bl_bl_caseList_item_txtContainer_tagList">
                                            <?php
                                            $menu_select = get_field('menu_select');
                                            ?>

                                            <?php if (!empty($menu_select)) : ?>
                                                <?php foreach ($menu_select as $menu_selectPost) : ?>
                                                    <p class="el_caseList_item_txtContainer_tagList_item">#<?php echo esc_html(get_the_title($menu_selectPost)); ?></p>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div>
                                        <p class="bl_caseList_item_txtContainer_ttl"><?php the_title(); ?></p>
                                    </div>

                                    <dl class="bl_caseList_item_caseInfo">
                                        <?php
                                        $caseInfoSlugList = ["case-price", "case-time", "case-downtime", "case-makeup", "case-risk"];
                                        foreach ($caseInfoSlugList as $caseInfoSlug):
                                            $field_object = get_field_object($caseInfoSlug, get_the_ID());
                                            $price = get_field($caseInfoSlug, get_the_ID());

                                            if ($price):
                                        ?>
                                                <div class="bl_caseList_item_caseInfo_item">
                                                    <dt class="bl_caseList_item_caseInfo_item_dt">
                                                        <?php echo esc_html($field_object['label']); ?>
                                                    </dt>
                                                    <dd class="bl_caseList_item_caseInfo_item_dd">
                                                        <?php echo esc_html($price); ?>
                                                    </dd>
                                                </div>
                                        <?php
                                            endif;
                                        endforeach;
                                        ?>
                                    </dl>
                                </a>
                            <?php endwhile; ?>
                        <?php endif; ?>
                        </div>
                        <?php wp_reset_postdata(); ?>
                </div>
            </section>
        </div>



    </main>

    <?php get_footer(); ?>

</body>

</html>