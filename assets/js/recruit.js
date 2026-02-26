/**
 * 採用ページ：募集一覧アコーディオン（1つだけ開く + GSAP）
 */
document.addEventListener('DOMContentLoaded', function() {
    const list = document.querySelector('.bl_recruitContainer_recruitPostContainer_list');
    if (!list || typeof gsap === 'undefined') return;

    const duration = 0.4;
    const ease = 'power2.out';
    const detailsAll = list.querySelectorAll('.bl_recruitContainer_recruitPostContainer_details');

    detailsAll.forEach(function(details) {
        const summary = details.querySelector('.bl_recruitContainer_recruitPostContainer_details_summary');
        const content = details.querySelector('.bl_recruitContainer_recruitPostContainer_details_content');

        if (!summary || !content) return;

        if (details.open) summary.classList.add('is-open');

        summary.addEventListener('click', function(event) {
            event.preventDefault();

            if (details.open) {
                closeItem(details, summary, content, duration, ease);
            } else {
                // 他を閉じる（アコーディオン）
                detailsAll.forEach(function(other) {
                    if (other === details) return;
                    const otherSummary = other.querySelector('.bl_recruitContainer_recruitPostContainer_details_summary');
                    const otherContent = other.querySelector('.bl_recruitContainer_recruitPostContainer_details_content');
                    if (other.open && otherSummary && otherContent) {
                        closeItem(other, otherSummary, otherContent, duration * 0.6, ease);
                    }
                });
                openItem(details, summary, content, duration, ease);
            }
        });
    });

    function closeItem(details, summary, content, dur, easeVal) {
        summary.classList.remove('is-open');
        gsap.to(content, {
            height: 0,
            overflow: 'hidden',
            duration: dur,
            ease: easeVal,
            onComplete: function() {
                details.removeAttribute('open');
                gsap.set(content, { clearProps: 'height,overflow' });
            },
        });
    }

    function openItem(details, summary, content, dur, easeVal) {
        details.setAttribute('open', '');
        summary.classList.add('is-open');

        // 一瞬で開いて見えないように、先に高さ0で固定してから計測
        gsap.set(content, { height: 0, overflow: 'hidden' });
        const endHeight = content.scrollHeight;

        gsap.to(content, {
            height: endHeight,
            overflow: 'hidden',
            duration: dur,
            ease: easeVal,
            onComplete: function() {
                gsap.set(content, { height: 'auto', overflow: '' });
            },
        });
    }
});
