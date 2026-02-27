<?php if (is_singular('menu')): ?>

    <?php
    $faq_items = array();
    if (have_rows('faq-blocklist')) {
        while (have_rows('faq-blocklist')) {
            the_row();
            $q = get_sub_field('faq-blocklist-q');
            $a = get_sub_field('faq-blocklist-a');
            if ($q !== '' && $a !== '') {
                $faq_items[] = array(
                    '@type' => 'Question',
                    'name' => wp_strip_all_tags($q),
                    'acceptedAnswer' => array(
                        '@type' => 'Answer',
                        'text' => wp_strip_all_tags($a),
                    ),
                );
            }
        }
    }
    ?>

    <?php if (!empty($faq_items)): ?>
    <script type="application/ld+json">
    <?php echo wp_json_encode(array(
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => $faq_items,
    ), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>
    </script>
    <?php endif; ?>

    <div class="bl_menuFaqContainer">
        <?php if (have_rows('faq-blocklist')): ?>
            <div class="bl_commonFaqList">

                <?php while (have_rows('faq-blocklist')): the_row(); ?>
                    <details class="bl_commonFaqList_details js-details" itemscope itemtype="https://schema.org/Question">
                        <summary class="bl_commonFaqList_details_summary is-summary">
                            <span class="bl_commonFaqList_details_summary_txt">
                                <span class="el_commonFaqList_details_summary_txt_en">Q.</span>
                                <span class="el_commonFaqList_details_summary_txt_ttl" itemprop="name"><?php the_sub_field('faq-blocklist-q'); ?></span>
                            </span>
                            <span class="el_commonFaqList_details_summary_icon"></span>
                        </summary>
                        <div class="bl_commonFaqList_details_content is-details-content" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                            <div class="bl_commonFaqList_details_content_inner">
                                <p class="el_commonFaqList_details_content_inner_txt" itemprop="text"><?php the_sub_field('faq-blocklist-a'); ?></p>
                            </div>
                        </div>
                    </details>
                <?php endwhile; ?>

            </div>
        <?php endif; ?>
    </div>

<?php endif; ?>