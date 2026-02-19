/**
 * アコーディオン（GSAP）
 */
document.addEventListener('DOMContentLoaded', function() {
    const duration = 0.4;
    const ease = 'power2.out';

    document.querySelectorAll('.js-details').forEach(function(details) {
        const summary = details.querySelector('.js-summary');
        const content = details.querySelector('.js-details-content');

        if (!summary || !content) return;

        summary.addEventListener('click', function(event) {
            event.preventDefault();

            if (details.open) {
                // 閉じるとき: アニメーション完了後に open を外す
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
});