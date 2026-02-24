

document.addEventListener('DOMContentLoaded', function () {

    // アクセス一覧内アンカーのスムーススクロール
    document.querySelectorAll('.bl_commonDownBtnContainer_item').forEach(function (anchorLink) {
        anchorLink.addEventListener('click', function (event) {
            const href = this.getAttribute('href');
            if (!href || href.charAt(0) !== '#') return;

            const targetEl = document.querySelector(href);
            if (!targetEl) return;

            event.preventDefault();

            const header = document.querySelector('.bl_header');
            const headerHeight = header ? header.offsetHeight : 250;
            const targetPosition = targetEl.getBoundingClientRect().top + window.scrollY - headerHeight - 16;

            window.scrollTo({
                top: Math.max(targetPosition, 0),
                behavior: 'smooth',
            });
        });
    });


    document.querySelectorAll('.bl_accessRoutelistSwiper').forEach(function (routeSwiper) {

        new Swiper(routeSwiper, {
            slidesPerView: 'auto',
            spaceBetween: 33,
        });

    });

});