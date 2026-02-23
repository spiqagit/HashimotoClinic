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
                    <p class="bl_commonlowerPage_ttl_enTtl">Doctor</p>
                    <h1 class="bl_commonlowerPage_ttl_jaTtl">ドクター紹介</h1>
                </hgroup>
                <?php get_template_part('inc/breadcrumbs'); ?>
            </div>


            <div class="bl_commonlowerPage_contents">

                <div class="bl_doctorArchiveContainer">
                    <div class="bl_doctorArchiveContainer_inner">
                        <?php
                        $job_categories = get_terms(array(
                            'taxonomy' => 'job-cat',
                            'hide_empty' => false,
                        ));
                        ?>

                        <?php if (!empty($job_categories)): ?>

                            <?php foreach ($job_categories as $job_category): ?>
                                <?php
                                $relatedDoctorPosts = get_posts(array(
                                    'post_type' => 'doctor',
                                    'posts_per_page' => -1,
                                    'orderby' => 'date',
                                    'order' => 'DESC',
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'job-cat',
                                            'terms' => $job_category->term_id,
                                            'operator' => 'IN',
                                            'field' => 'term_id',
                                        ),
                                    ),
                                ));
                                ?>

                                <?php if (!empty($relatedDoctorPosts)): ?>
                                    <div class="bl_doctorContainer">
                                        <?php foreach ($relatedDoctorPosts as $relatedDoctorPost): ?>

                                            <div class="bl_doctorContainer_upperContainer">
                                                <div class="bl_doctorUpperContainer_imgWrapper">
                                                    <?php if (get_the_post_thumbnail($relatedDoctorPost->ID)): ?>
                                                        <img class="el_doctorUpperContainer_imgWrapper_img" src="<?php echo get_the_post_thumbnail_url($relatedDoctorPost->ID); ?>" alt="<?php echo get_the_title($relatedDoctorPost->ID); ?>">
                                                    <?php else: ?>
                                                        <img class="el_doctorUpperContainer_imgWrapper_img" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/noimage-doc.jpg" alt="Noimage">
                                                    <?php endif; ?>
                                                </div>

                                                <div class="bl_doctorUpperContainer_rightWrapper">
                                                    <div class="bl_doctorUpperContainer_nameContainer">

                                                        <?php if ($job_category->slug == "director"): ?>
                                                            <p class="el_doctorUpperContainer_nameContainer_job el_doctorUpperContainer_nameContainer_job_director"><?php echo get_the_terms($relatedDoctorPost->ID, 'job-cat')[0]->name; ?></p>
                                                        <?php else: ?>
                                                            <p class="el_doctorUpperContainer_nameContainer_job el_doctorUpperContainer_nameContainer_job_box"><?php echo get_the_terms($relatedDoctorPost->ID, 'job-cat')[0]->name; ?></p>
                                                        <?php endif; ?>

                                                        <div class="bl_doctorUpperContainer_nameContainer_nameWrapper">
                                                            <p class="el_doctorUpperContainer_nameContainer_nameWrapper_name"><?php echo get_the_title($relatedDoctorPost->ID); ?></p>

                                                            <?php if (get_field('doctor-name-en', $relatedDoctorPost->ID)): ?>
                                                                <p class="el_doctorUpperContainer_nameContainer_nameWrapper_nameEn"><?php echo get_field('doctor-name-en', $relatedDoctorPost->ID); ?></p>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>

                                                    <div class="bl_doctorUpperContainer_txtWrapper_txtWrapper">
                                                        <p class="el_doctorUpperContainer_txtWrapper_txtWrapper_txt">
                                                            <?php echo get_field('doctor-txt-archive', $relatedDoctorPost->ID); ?>
                                                        </p>
                                                    </div>

                                                    <?php if ($job_category->slug != "director"): ?>
                                                        <?php if (have_rows('career-list', $relatedDoctorPost->ID)): ?>
                                                            <div class="bl_doctorContainer_profileListContainer">
                                                                <h2 class="el_doctorContainer_profileList_ttl">経歴</h2>

                                                                <ul class="bl_doctorContainer_profileList">
                                                                    <?php while (have_rows('career-list', $relatedDoctorPost->ID)): the_row(); ?>
                                                                        <li class="bl_doctorContainer_profileList_item">
                                                                            <p class="el_doctorContainer_profileList_item_year"><?php the_sub_field('career-list-year', $relatedDoctorPost->ID); ?></p>
                                                                            <p class="el_doctorContainer_profileList_item_txt"><?php the_sub_field('career-list-txt', $relatedDoctorPost->ID); ?></p>
                                                                        </li>
                                                                    <?php endwhile; ?>
                                                                </ul>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>


                                            <?php if ($job_category->slug == "director"): ?>

                                                <div class="bl_doctorContainer_lowerContainer">
                                                    <?php if (have_rows('career-list', $relatedDoctorPost->ID)): ?>
                                                        <div class="bl_doctorContainer_profileListContainer">
                                                            <h2 class="el_doctorContainer_profileList_ttl">経歴</h2>

                                                            <ul class="bl_doctorContainer_profileList">
                                                                <?php while (have_rows('career-list', $relatedDoctorPost->ID)): the_row(); ?>
                                                                    <li class="bl_doctorContainer_profileList_item">
                                                                        <p class="el_doctorContainer_profileList_item_year"><?php the_sub_field('career-list-year', $relatedDoctorPost->ID); ?></p>
                                                                        <p class="el_doctorContainer_profileList_item_txt"><?php the_sub_field('career-list-txt', $relatedDoctorPost->ID); ?></p>
                                                                    </li>
                                                                <?php endwhile; ?>
                                                            </ul>
                                                        </div>
                                                    <?php endif; ?>


                                                    <?php if (have_rows('license-list', $relatedDoctorPost->ID)): ?>
                                                        <div class="bl_doctorContainer_profileListContainer">
                                                            <h2 class="el_doctorContainer_profileList_ttl">資格</h2>

                                                            <ul class="bl_doctorContainer_profileList bl_doctorContainer_profileList_license">
                                                                <?php while (have_rows('license-list', $relatedDoctorPost->ID)): the_row(); ?>
                                                                    <li class="bl_doctorContainer_profileList_item">
                                                                        <p class="el_doctorContainer_profileList_item_txt"><?php the_sub_field('license-list-txt', $relatedDoctorPost->ID); ?></p>
                                                                    </li>
                                                                <?php endwhile; ?>
                                                            </ul>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>

                                            <?php endif; ?>

                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <?php get_footer(); ?>
</body>

</html>