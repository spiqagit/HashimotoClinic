<?php if (is_singular('menu')): ?>


    <div class="bl_menuFaqContainer">
        <?php if (have_rows('faq-blocklist')): ?>
            <div class="bl_commonFaqList">

                <?php while (have_rows('faq-blocklist')): the_row(); ?>
                    <details class="bl_commonFaqList_details js-details">
                        <summary class="bl_commonFaqList_details_summary is-summary">
                            <span class="bl_commonFaqList_details_summary_txt">
                                <span class="el_commonFaqList_details_summary_txt_en">Q.</span>
                                <span class="el_commonFaqList_details_summary_txt_ttl"><?php the_sub_field('faq-blocklist-q'); ?></span>
                            </span>
                            <span class="el_commonFaqList_details_summary_icon"></span>
                        </summary>
                        <div class="bl_commonFaqList_details_content is-details-content">
                            <div class="bl_commonFaqList_details_content_inner">
                                <p class="el_commonFaqList_details_content_inner_txt"><?php the_sub_field('faq-blocklist-a'); ?></p>
                            </div>
                        </div>
                    </details>
                <?php endwhile; ?>

            </div>
        <?php endif; ?>
    </div>

<?php endif; ?>