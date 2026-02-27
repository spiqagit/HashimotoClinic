<?php
/*
 * Template Name: Contact
 */
?>
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
                    <p class="bl_commonlowerPage_ttl_enTtl">Contact</p>
                    <h1 class="bl_commonlowerPage_ttl_jaTtl">お問い合わせ</h1>
                </hgroup>
                <?php get_template_part('inc/breadcrumbs'); ?>
            </div>


            <div class="bl_commonlowerPage_contents">
                <div class="bl_contactContainer">
                    <div class="bl_contactContainer_inner">

                        <div class="bl_contactContainer_freeContainer">
                            <h2 class="el_contactContainer_ttl">
                                <span class="el_contactContainer_ttl_txt">ご予約・無料相談</span>
                            </h2>
                            <p class="el_contactContainer_freeContainer_txt">おひとりで抱え込まず、まずはお気軽にご相談ください。 <br>お悩みに合わせて、専門スタッフがご質問や費用について丁寧にご案内いたします。</p>
                        </div>

                        <div class="bl_contactContainer_formContainer">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            const privacy = document.getElementById("privacy");
            const privacyInput = privacy?.querySelector("input[name='privacy[]']");
            const submit = document.querySelector(".bl_submit");

            if (privacyInput) {
                privacyInput.addEventListener("change", function() {
                    if (this.checked) {
                        submit.classList.add("is-active");
                    } else {
                        submit.classList.remove("is-active");

                    }
                });
            }

            const privacyLink = document.querySelector(".el_privacyContainer_txt_link");

            if (privacyLink) {
                privacyLink.setAttribute("href", "<?php echo home_url(); ?>/privacy-policy/");
            }
        });
    </script>
    <?php get_footer(); ?>
</body>

</html>