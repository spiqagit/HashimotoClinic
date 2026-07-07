<!DOCTYPE html>
<html lang="ja">

<head>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-NZ4WGHC9');
    </script>
    <!-- End Google Tag Manager -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover">
    <meta name="format-detection" content="telephone=no">

    <!-- キャッシュ対策 -->
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&family=Noto+Sans+JP:wght@100..900&family=Noto+Serif+JP:wght@200..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/gsap.min.js"></script>



    <!-- css -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/common.css?<?php echo date_i18n("YmdHis"); ?>" type="text/css" />

    <!-- js -->
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/common.js"></script>

    <?php if (is_front_page()): ?>
        <script src="<?php echo get_template_directory_uri(); ?>/assets/js/top.js"></script>
    <?php endif; ?>

    <?php if (is_post_type_archive('menu') || is_singular('menu') || is_single()): ?>
        <script src="<?php echo get_template_directory_uri(); ?>/assets/js/service.js"></script>
    <?php endif; ?>

    <?php if (is_post_type_archive('doctor')): ?>
        <script src="<?php echo get_template_directory_uri(); ?>/assets/js/doctor.js"></script>
    <?php endif; ?>

    <?php if (is_page('information')): ?>
        <script src="<?php echo get_template_directory_uri(); ?>/assets/js/info.js"></script>
    <?php endif; ?>

    <?php if (is_page('access')): ?>
        <script src="<?php echo get_template_directory_uri(); ?>/assets/js/access.js"></script>
    <?php endif; ?>

    <?php if (is_single() && !is_singular('menu')): ?>
        <script src="<?php echo get_template_directory_uri(); ?>/assets/js/blog.js"></script>
    <?php endif; ?>

    <?php if (is_page_template('page-recruit.php')): ?>
        <script src="<?php echo get_template_directory_uri(); ?>/assets/js/recruit.js"></script>
    <?php endif; ?>

    <?php if (is_singular('case')): ?>
        <script src="<?php echo get_template_directory_uri(); ?>/assets/js/case.js"></script>
    <?php endif; ?>