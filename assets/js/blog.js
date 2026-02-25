document.addEventListener('DOMContentLoaded', function () {
    var copyBtn = document.querySelector('.el_shareContainer_linkContainer_copyBtn');
    if (!copyBtn) return;

    copyBtn.addEventListener('click', function () {
        var url = window.location.href;

        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(url).then(function () {
                showCopyFeedback(true);
            }).catch(function () {
                fallbackCopy(url);
            });
        } else {
            fallbackCopy(url);
        }
    });

    function showCopyFeedback(success) {
        var message = success ? 'コピーしました' : 'コピーに失敗しました';
        var popup = document.createElement('div');
        popup.className = 'el_shareContainer_copyPopup';
        popup.setAttribute('role', 'status');
        popup.setAttribute('aria-live', 'polite');
        popup.textContent = message;
        document.body.appendChild(popup);

        requestAnimationFrame(function () {
            popup.classList.add('is_visible');
        });

        setTimeout(function () {
            popup.classList.remove('is_visible');
            setTimeout(function () {
                if (popup.parentNode) popup.parentNode.removeChild(popup);
            }, 300);
        }, 2000);
    }

    function fallbackCopy(url) {
        var textarea = document.createElement('textarea');
        textarea.value = url;
        textarea.style.position = 'fixed';
        textarea.style.left = '-9999px';
        document.body.appendChild(textarea);
        textarea.select();
        try {
            document.execCommand('copy');
            showCopyFeedback(true);
        } catch (err) {
            showCopyFeedback(false);
        }
        document.body.removeChild(textarea);
    }
});