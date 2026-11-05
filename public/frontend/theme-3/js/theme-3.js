(function () {
    'use strict';

    function activatePricingTab(tabId) {
        var contents = ['same-day', 'next-day', 'sub-city', 'outside-city'];
        contents.forEach(function (id) {
            var el = document.getElementById(id + '-content');
            if (!el) return;
            if (id === tabId) {
                el.classList.remove('hidden');
                el.classList.add('pricing-tab-fade-in');
            } else {
                el.classList.add('hidden');
                el.classList.remove('pricing-tab-fade-in');
            }
        });
        document.querySelectorAll('.pricing-tab-btn').forEach(function (btn) {
            var id = btn.getAttribute('data-tab');
            if (id === tabId) {
                btn.classList.remove('pricing-tab-inactive');
                btn.classList.add('pricing-tab-active');
            } else {
                btn.classList.remove('pricing-tab-active');
                btn.classList.add('pricing-tab-inactive');
            }
        });
    }

    document.querySelectorAll('.pricing-tab-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var tabId = btn.getAttribute('data-tab');
            if (tabId) activatePricingTab(tabId);
        });
    });
    if (document.querySelector('.pricing-tab-btn')) {
        activatePricingTab('same-day');
    }

    var sections = document.querySelectorAll('section[id]');
    if (sections.length) {
        var anchors = document.querySelectorAll('.js-theme3-section-link[href*="#"]');
        function setActive(id) {
            anchors.forEach(function (a) {
                a.classList.remove('nav-menu-link--active');
                if ((a.getAttribute('href') || '').endsWith('#' + id)) {
                    a.classList.add('nav-menu-link--active');
                }
            });
        }
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) setActive(entry.target.id);
            });
        }, { root: null, threshold: 0.45 });
        sections.forEach(function (s) { io.observe(s); });
    }
})();
