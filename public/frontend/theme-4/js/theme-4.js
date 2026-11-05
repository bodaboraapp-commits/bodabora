(function () {
    'use strict';

    document.querySelectorAll('a[href*="#"]').forEach(function (link) {
        link.addEventListener('click', function (e) {
            var href = link.getAttribute('href') || '';
            if (!href.includes('#')) return;
            var hash = href.split('#')[1];
            if (!hash) return;
            var target = document.getElementById(hash);
            if (!target) return;
            if (!window.location.pathname.match(/^\/?$/)) return;
            e.preventDefault();
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            history.replaceState(null, '', '#' + hash);
        });
    });
})();
