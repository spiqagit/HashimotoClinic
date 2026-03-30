

document.addEventListener('DOMContentLoaded', function () {





    // メニューアーカイブ内アンカーのスムーススクロール
    document.querySelectorAll('.bl_menuArchiveContainer_downBtnContainer_item').forEach(function (anchorLink) {
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

    // bl_commonDownBtnContainer_item クリックで目的地までスムーススクロール
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


    // 目次生成: bl_commonArticle_content 内の H2 を取得して ID を付与し、目次リストを動的生成（PC・SP両方に吐き出し）
    (function initTableOfContents() {
        const contentEl = document.querySelector('.bl_commonArticle_content');
        const navListEl = document.getElementById('js_commonIndexNav_list');
        const navListElSp = document.getElementById('js_commonIndexNav_list_sp');
        const navEl = document.getElementById('js_commonIndexNav');
        if (!contentEl || !navListEl) return;

        const headings = contentEl.querySelectorAll('h2');
        const accordionContainer = document.getElementById('js_menuArticle_indexAccordion');
        if (headings.length === 0) {
            if (navEl) navEl.style.display = 'none';
            if (accordionContainer) accordionContainer.style.display = 'none';
            return;
        }


        const usedIds = {};
        headings.forEach(function (h2, index) {
            const text = (h2.textContent || '').trim();
            let id = 'index-' + index;
            if (text) {
                const slug = text
                    .replace(/\s+/g, '-')
                    .replace(/[^\w\u3040-\u309f\u30a0-\u30ff\u4e00-\u9faf\-]/g, '')
                    .toLowerCase()
                    .slice(0, 50);
                if (slug) {
                    id = (usedIds[slug] ? slug + '-' + index : slug);
                    usedIds[slug] = (usedIds[slug] || 0) + 1;
                }
            }
            h2.id = id;

            var createNavItem = function () {
                const li = document.createElement('li');
                li.className = 'bl_commonIndexNav_list_item';
                const a = document.createElement('a');
                a.className = 'el_commonIndexNav_list_item_link';
                a.href = '#' + id;
                const span = document.createElement('span');
                span.className = 'el_commonIndexNav_list_item_link_txt';
                span.textContent = text || '見出し' + (index + 1);
                a.appendChild(span);
                a.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.getElementById(id).scrollIntoView({ behavior: 'smooth', block: 'start' });
                });
                li.appendChild(a);
                return li;
            };

            navListEl.appendChild(createNavItem());
            if (navListElSp) navListElSp.appendChild(createNavItem());
        });
    })();

    // メニュー目次アコーディオン（SP）: height 0 で開閉（GSAP）
    const menuIndexAccordion = document.getElementById('js_menuArticle_indexAccordion');
    if (menuIndexAccordion && typeof gsap !== 'undefined') {
        const btn = menuIndexAccordion.querySelector('.bl_menuArticle_navContainer_sp_btn');
        const body = document.getElementById('js_menuArticle_indexAccordion_body');
        if (btn && body) {
            const duration = 0.3;
            const ease = 'power2.out';
            btn.addEventListener('click', function () {
                const willOpen = !menuIndexAccordion.classList.contains('is_open');
                btn.setAttribute('aria-expanded', willOpen);
                if (willOpen) {
                    menuIndexAccordion.classList.add('is_open');
                    body.style.overflow = 'hidden';
                    const endHeight = body.scrollHeight;
                    gsap.fromTo(body, { height: 0 }, {
                        height: endHeight,
                        duration: duration,
                        ease: ease,
                        onComplete: function () {
                            body.style.height = 'auto';
                            body.style.overflow = '';
                            gsap.set(body, { clearProps: 'height' });
                        },
                    });
                } else {
                    const currentHeight = body.offsetHeight;
                    gsap.set(body, { height: currentHeight, overflow: 'hidden' });
                    menuIndexAccordion.classList.remove('is_open');
                    gsap.to(body, {
                        height: 0,
                        duration: duration,
                        ease: ease,
                        onComplete: function () {
                            gsap.set(body, { clearProps: 'height,overflow' });
                        },
                    });
                }
            });
        }
    }

    document.querySelectorAll('.bl_menuCaseSwiper').forEach(function (swiper) {
        new Swiper(swiper, {            
            slidesPerView: 1, // 一度に表示する枚数
            spaceBetween: 20,
            centeredSlides: true,
            initialSlide: 1, 
            breakpoints: {
                1100: {
                    slidesPerView: 2,
                    spaceBetween: 40,
                },
                768: {
                    slidesPerView: 1.5,
                },
            },
            navigation: {
                nextEl: document.querySelector('.bl_menuCaseSwiper_next'),
                prevEl: document.querySelector('.bl_menuCaseSwiper_prev'),
            },
        });
    });


    document.querySelectorAll('.bl_commonBlogSwiperContainer').forEach(function (blogSContainer) {
        const blogSwiper = blogSContainer.querySelector('.bl_commonBlogSwiper');
        const blogSwiperPagination = blogSContainer.querySelector('.bl_commonBlogSwiper_pagination');
        new Swiper(blogSwiper, {
            slidesPerView: 1,
            spaceBetween: 20,
            breakpoints: {
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 40,
                    centeredSlides: false,
                },
                768: {
                    slidesPerView: 3,
                },
            },
            navigation: {
                nextEl: blogSContainer.querySelector('.bl_commonBlogSwiper_next'),
                prevEl: blogSContainer.querySelector('.bl_commonBlogSwiper_prev'),
            },
            pagination: {
                el: blogSwiperPagination,
                clickable: true,
            },
        });
    });

    document.querySelectorAll('.bl_accessRoutelistContainer').forEach(function (routeListContainer) {
        const routeSwiper = routeListContainer.querySelector('.bl_accessRoutelistSwiper');
        const routeSwiperPagination = routeListContainer.querySelector('.bl_accessRoutelistSwiper_pagination');
        if (!routeSwiper) return;

        new Swiper(routeSwiper, {
            slidesPerView: 'auto',
            spaceBetween: 33,
            pagination: {
                el: routeSwiperPagination,
                clickable: true,
            },
        });
    });

});