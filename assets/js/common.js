/**
 * アコーディオン（GSAP）
 */
document.addEventListener('DOMContentLoaded', function() {
    const duration = 0.4;
    const ease = 'power2.out';

    document.querySelectorAll('.js-details').forEach(function(details) {
        const summary = details.querySelector('.is-summary');
        const content = details.querySelector('.is-details-content');

        if (!summary || !content) return;

        if (details.open) summary.classList.add('is-open');

        summary.addEventListener('click', function(event) {
            event.preventDefault();

            if (details.open) {
                // 閉じるとき: アニメーション完了後に open を外す
                summary.classList.remove('is-open');
                gsap.to(content, {
                    height: 0,
                    overflow: 'hidden',
                    duration: duration,
                    ease: ease,
                    onComplete: function() {
                        details.removeAttribute('open');
                        gsap.set(content, { clearProps: 'height,overflow' });
                    },
                });
            } else {
                // 開くとき: 先に open を付与してからアニメーション
                details.setAttribute('open', '');
                summary.classList.add('is-open');

                const endHeight = content.scrollHeight;
                gsap.fromTo(
                    content,
                    { height: 0, overflow: 'hidden' },
                    {
                        height: endHeight,
                        overflow: 'hidden',
                        duration: duration,
                        ease: ease,
                        onComplete: function() {
                            gsap.set(content, { height: 'auto', overflow: '' });
                        },
                    },
                );
            }
        });
    });


    /* ヘッダーナビゲーション */
    const toggleNavOuter = document.querySelector('.bl_commonToggleNavOuter');
    const toggleNav = document.querySelector('.bl_commonToggleNav');
    const toggleBtn = document.querySelector('.bl_header_toggleBtn');
    const toggleCloseBtn = document.querySelector('.bl_commonToggleNav_closeBtn');

    if (toggleBtn) {
        toggleBtn.addEventListener('click', function() {

            document.body.style.overflow = 'hidden';

            gsap.fromTo(toggleNavOuter, {
                display: 'none',
                opacity: 0,
            }, {
                opacity: .8,
                duration: 0.5,
                ease: 'power2.out',
                display: 'block',
            });
            
            gsap.fromTo(toggleNav, {
                x: '100%',
            }, {
                x: 0,
                duration: 0.5,
                ease: 'power2.out',
            });
            
        });
    }

    if (toggleCloseBtn) {
        toggleCloseBtn.addEventListener('click', function() {

            document.body.style.overflow = '';

            gsap.fromTo(toggleNavOuter, {
                opacity: 1,
            }, {
                opacity: 0,
                duration: 0.5,
                ease: 'power2.out',
                display: 'none',
            });

            gsap.fromTo(toggleNav, {
                x: 0,
            }, {
                x: '100%',
                duration: 0.5,
                ease: 'power2.out',
            });
        });
    }


    /* 気になる部位セクション（タブ切り替え）
    ------------------------------------------------------------------------------------------ */
    const partsCatBtns = document.querySelectorAll('.el_menuPartsCatContainer_btn');
    const partsCatTabItems = document.querySelectorAll('.bl_menuPartsCatContainer_tabContents_item');

    partsCatBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            const targetId = this.getAttribute('id');
            if (!targetId) return;

            // ボタンの is_active を切り替え
            partsCatBtns.forEach(function(b) {
                b.classList.remove('is_active');
            });
            this.classList.add('is_active');

            // タブコンテンツの is_active を切り替え
            partsCatTabItems.forEach(function(item) {
                if (item.getAttribute('data-id') === targetId) {
                    item.classList.add('is_active');

                    gsap.fromTo(item, {
                        opacity: 0,
                    }, {
                        opacity: 1,
                        duration: 0.5,
                        ease: 'power2.out',
                    });

                } else {

                    gsap.fromTo(item, {
                        opacity: 1,
                    }, {
                        opacity: 0,
                        duration: 0.5,
                        ease: 'power2.out',
                    });
                    item.classList.remove('is_active');
                }
            });
        });
    });


    /* スケジュール */
    document.querySelectorAll('.bl_scheduleContainer').forEach(function(scheduleContainer) {
        const scheduleSwiper = scheduleContainer.querySelector('.bl_scheduleSwiper');
        new Swiper(scheduleSwiper, {
            slidesPerView: 'auto',
            navigation: {
                nextEl: scheduleContainer.querySelector('.bl_scheduleContainer_upper_next'),
                prevEl: scheduleContainer.querySelector('.bl_scheduleContainer_upper_prev'),
            },
            pagination: {
                el: scheduleContainer.querySelector('.bl_scheduleContainer_paginationWrapper'),
                clickable: true,
            },
        });
    });
});