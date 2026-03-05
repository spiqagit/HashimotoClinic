

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.bl_clinicSwiperWrapper').forEach(function (clinicSwiperContainer) {

        new Swiper(clinicSwiperContainer.querySelector('.bl_clinicSwiper'), {
            slidesPerView: 1,
            spaceBetween: 20,
            loopAdditionalSlides: 1,
            loop: false,
            navigation: {
                nextEl: clinicSwiperContainer.querySelector('.bl_clinicSwiper_next'),
                prevEl: clinicSwiperContainer.querySelector('.bl_clinicSwiper_prev'),
            },
            pagination: {   
                el: clinicSwiperContainer.querySelector('.bl_clinicSwiper_pagination'),
                clickable: true,
            },
        });

    });


    var desktopMq = window.matchMedia('(min-width: 1024px)');
    if (!desktopMq.matches) {
        return;
    }

    var flowItems = document.querySelectorAll('.bl_infoFlowContainer_numList_item');
    var flowImages = document.querySelectorAll('.el_infoFlowContainer_imgList_img');

    if (!flowItems.length || !flowImages.length) {
        return;
    }

    var setActiveImage = function (id) {
        flowImages.forEach(function (img) {
            img.classList.toggle('is-active', img.dataset.id === id);
        });
    };

    var observer = new IntersectionObserver(
        function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    setActiveImage(entry.target.id);
                }
            });
        },
        {
            root: null, // 今回はビューポートをルート要素とする
            rootMargin: "-50% 0px", // ビューポートの中心を判定基準にする
            threshold: 0 // 閾値は0
        }
    );

    flowItems.forEach(function (item) {
        observer.observe(item);
    });



    

});