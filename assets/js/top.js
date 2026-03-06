

document.addEventListener('DOMContentLoaded', function () {


    const fvSwiper = new Swiper('.bl_fvSlideSwiper', {
        slidesPerView: 1,
        loop: true,
        spaceBetween: 40,
        loopAdditionalSlides: 1,
        centeredSlides: true,
        speed: 1000,
        breakpoints: {
            1024: {
                spaceBetween: 40,
                slidesPerView: 3,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 40,
                loopAdditionalSlides: 2,
                centeredSlides: true,
            },
        },
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        pagination: {
            el: document.querySelector('.bl_fvSlideSwiper_pagination'),
            clickable: true,
        },
        navigation: {
            nextEl: document.querySelector('.bl_fvSlideSwiper_next'),
            prevEl: document.querySelector('.bl_fvSlideSwiper_prev'),
        },
    });

    //一時停止
    document.querySelector('.bl_fvSlideSwiper_playBtn').addEventListener('click', function () {

        if (document.querySelector('.bl_fvSlideSwiper_playBtn').classList.contains('is-stop')) {

            document.querySelector('.bl_fvSlideSwiper_playBtn').classList.remove('is-stop');
            fvSwiper.autoplay.start(); //再生

        } else {

            document.querySelector('.bl_fvSlideSwiper_playBtn').classList.add('is-stop');
            fvSwiper.autoplay.stop(); //一時停止
        }

    });


    //症例
    const topCaseContainer = document.querySelector('.bl_topCaseSwiper');
    const topCaseSwiper = new Swiper(topCaseContainer, {
        slidesPerView: 'auto',
        spaceBetween: 35,
        centeredSlides: true,
        watchSlidesProgress: true,
        breakpoints: {
            1024: {
                slidesPerView: 3,
                spaceBetween: 40,
                centeredSlides: false,

            },
        },
        navigation: {
            nextEl: document.querySelector('.bl_topCaseSwiper_next'),
            prevEl: document.querySelector('.bl_topCaseSwiper_prev'),
        },
    });


    //ブログ
    const blogSwiperItem = document.querySelector('.bl_frontBlogSwiper');
    
    const blogSwiper = new Swiper(blogSwiperItem, {
        init: false,
        slidesPerView: 1,
        spaceBetween: 20,
        navigation: {
            nextEl: document.querySelector('.bl_frontBlogSwiper_next'),
            prevEl: document.querySelector('.bl_frontBlogSwiper_prev'),
        },
        pagination: {
            el: document.querySelector('.bl_frontBlogSwiper_pagination'),
            clickable: true,
        },
    });


    if (window.innerWidth <= 1024) {
        blogSwiper.init();
    } else {
        blogSwiper.destroy();
    }

});