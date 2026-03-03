

document.addEventListener('DOMContentLoaded', function () {

    // 症例詳細スライダー（single-case.php）
    const caseSingleEl = document.querySelector('.bl_caseArticl_imgSlider');
    if (caseSingleEl) {
        const caseSingleSwiper = caseSingleEl.querySelector('.bl_caseSingleSwiper');
        new Swiper(caseSingleSwiper, {
            slidesPerView: 1,
            spaceBetween: 0,
            pagination: {
                el: '.bl_caseSingleSwiper_pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.bl_caseSingleSwiper_next',
                prevEl: '.bl_caseSingleSwiper_prev',
            },
        });
    }


    const caseArticleRelatedContainer = document.querySelector('.bl_caseArticle_relatedCase_slideContainer');

    if (caseArticleRelatedContainer) {
        const caseArticleRelatedSwiper = caseArticleRelatedContainer.querySelector('.bl_caseArticle_relatedCase_swiper');
        new Swiper(caseArticleRelatedSwiper, {
            slidesPerView: 1,
            spaceBetween: 25,
            breakpoints: {
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 25,
                },
            },
            navigation: {
                nextEl: caseArticleRelatedContainer.querySelector('.bl_caseArticle_relatedCase_slideContainer_next'),
                prevEl: caseArticleRelatedContainer.querySelector('.bl_caseArticle_relatedCase_slideContainer_prev'),
            },
            scrollbar: {
                el: caseArticleRelatedContainer.querySelector('.bl_caseArticle_relatedCase_slideContainer_scrollbar'),
                draggable: true,
            },
        });
    }
});