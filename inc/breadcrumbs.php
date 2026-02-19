<div class="bl_breadcrumbs">
    <ul class="bl_breadcrumbs_list">
        <li class="bl_breadcrumbs_list_item">
            <a class="bl_breadcrumbs_list_item_link" href="<?php echo home_url(); ?>">トップ</a>
        </li>

        <?php if (is_post_type_archive('price')): ?>
            <li class="bl_breadcrumbs_list_item">
                <p class="bl_breadcrumbs_list_item_text">料金表</p>
            </li>
        <?php endif; ?>

        <?php if (is_singular('price') && !is_post_type_archive('price')): ?>
            <li class="bl_breadcrumbs_list_item">
                <a class="bl_breadcrumbs_list_item_link" href="<?php echo home_url(); ?>/price/">料金表</a>
            </li>
            <li class="bl_breadcrumbs_list_item">
                <p class="bl_breadcrumbs_list_item_text"><?php the_title(); ?></p>
            </li>
        <?php endif; ?>
    </ul>
</div>