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
            <div class="bl_thanksContainer">
                <div class="bl_thanksContainer_inner">
                    <h1 class="el_thanksContainer_ttl">お問い合わせいただき、<br class="is-sp">ありがとうございます。</h1>

                    <div class="bl_thanksContainer_txtContainer">
                        <p class="el_thanksContainer_txtContainer_txt">ご入力いただいた内容は正常に送信されました。<br>担当スタッフが内容を確認の上、3〜5日以内にご連絡させていただきます。</p>
                        <p class="el_thanksContainer_txtContainer_txt">お急ぎの場合や、ご予約をご希望の際は、お電話でも承っておりますのでお気軽にご連絡ください。<br>
                            いただいた情報は、当院にて厳重に管理し、外部に漏れることはございませんのでご安心ください。</p>
                        <p class="el_thanksContainer_txtContainer_txt">また、ご希望の日時によってはご予約をお取りできない場合もございます。
                            その際は、担当者より別日程をご提案させていただきます。
                            引き続き、静岡美容外科クリニックをどうぞよろしくお願いいたします。</p>
                    </div>

                    <a href="<?php echo home_url('/'); ?>" class="bl_thanksContainer_btn">トップへ戻る</a>
                </div>
            </div>
        </div>
    </main>
    <?php get_footer(); ?>
</body>

</html>