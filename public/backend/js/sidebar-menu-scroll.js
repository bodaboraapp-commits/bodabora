/**
 * Keep expanded sidebar submenus in view (desktop + mobile offcanvas).
 */
(function () {
    'use strict';

    var PADDING = 20;

    function getMenuScrollContainers() {
        var containers = [];
        var navList = document.querySelector('.nav-left-sidebar > .navbar-nav');
        var sidebar = document.querySelector('.nav-left-sidebar');
        var offcanvasBody = document.querySelector('#offcanvasDarkNavbar .offcanvas-body');
        var isDesktop = window.matchMedia('(min-width: 992px)').matches;

        if (isDesktop) {
            if (navList) {
                containers.push(navList);
            }
            if (sidebar) {
                containers.push(sidebar);
            }
        } else {
            if (offcanvasBody) {
                containers.push(offcanvasBody);
            }
            if (navList) {
                containers.push(navList);
            }
        }

        return containers.filter(function (container, index, list) {
            return list.indexOf(container) === index;
        });
    }

    function scrollElementInContainer(element, container) {
        var elRect = element.getBoundingClientRect();
        var containerRect = container.getBoundingClientRect();

        if (elRect.bottom > containerRect.bottom - PADDING) {
            container.scrollTop += elRect.bottom - containerRect.bottom + PADDING;
        }

        elRect = element.getBoundingClientRect();
        containerRect = container.getBoundingClientRect();

        if (elRect.top < containerRect.top + PADDING) {
            container.scrollTop -= containerRect.top - elRect.top + PADDING;
        }
    }

    function revealSidebarMenuItem(element, options) {
        if (!element) {
            return;
        }

        options = options || {};
        var containers = getMenuScrollContainers();
        var passes = 3;

        for (var pass = 0; pass < passes; pass++) {
            containers.forEach(function (container) {
                scrollElementInContainer(element, container);
            });
        }

        if (options.skipScrollIntoView) {
            return;
        }

        if (typeof element.scrollIntoView === 'function') {
            try {
                element.scrollIntoView({ block: 'nearest', inline: 'nearest', behavior: 'smooth' });
            } catch (error) {
                element.scrollIntoView(false);
            }
        }
    }

    function getActiveSidebarLink() {
        var sidebar = document.querySelector('.nav-left-sidebar');

        if (!sidebar) {
            return null;
        }

        return sidebar.querySelector('.submenu .nav-link.active')
            || sidebar.querySelector('.navbar-nav .nav-link.active');
    }

    function scrollToActiveMenuItem() {
        var active = getActiveSidebarLink();

        if (!active) {
            return;
        }

        var navItem = active.closest('.nav-item');
        var parentNavItem = active.closest('.submenu') ? active.closest('.submenu').closest('.nav-item') : null;
        var revealOptions = { skipScrollIntoView: true };

        var reveal = function () {
            if (parentNavItem) {
                revealSidebarMenuItem(parentNavItem, revealOptions);
            }

            if (navItem) {
                revealSidebarMenuItem(navItem, revealOptions);
            }

            revealSidebarMenuItem(active, revealOptions);
        };

        reveal();
        window.setTimeout(reveal, 80);
        window.setTimeout(reveal, 350);
    }

    function onSubmenuExpanded(submenu) {
        if (!submenu) {
            return;
        }

        if (submenu.classList.contains('collapse') && !submenu.classList.contains('show')) {
            return;
        }

        var navItem = submenu.closest('.nav-item');
        var lastChild = submenu.querySelector('.nav .nav-item:last-child');

        window.requestAnimationFrame(function () {
            window.requestAnimationFrame(function () {
                if (navItem) {
                    revealSidebarMenuItem(navItem);
                }

                revealSidebarMenuItem(submenu);

                if (lastChild) {
                    revealSidebarMenuItem(lastChild);
                }
            });
        });
    }

    function scheduleSubmenuReveal(submenu) {
        onSubmenuExpanded(submenu);
        window.setTimeout(function () {
            onSubmenuExpanded(submenu);
        }, 80);
        window.setTimeout(function () {
            onSubmenuExpanded(submenu);
        }, 380);
        window.setTimeout(function () {
            onSubmenuExpanded(submenu);
        }, 700);
    }

    function watchSubmenu(submenu) {
        if (!submenu || submenu.__sidebarScrollObserver) {
            return;
        }

        var observer = new MutationObserver(function (mutations) {
            mutations.forEach(function (mutation) {
                if (mutation.attributeName === 'class' && submenu.classList.contains('show')) {
                    scheduleSubmenuReveal(submenu);
                }
            });
        });

        observer.observe(submenu, { attributes: true, attributeFilter: ['class'] });
        submenu.__sidebarScrollObserver = observer;
    }

    function initSubmenuObservers() {
        document.querySelectorAll('.nav-left-sidebar .submenu').forEach(watchSubmenu);
    }

    document.addEventListener('shown.bs.collapse', function (event) {
        if (!event.target || !event.target.classList || !event.target.classList.contains('submenu')) {
            return;
        }

        scheduleSubmenuReveal(event.target);
    });

    document.addEventListener('click', function (event) {
        var trigger = event.target.closest('.nav-left-sidebar [data-toggle="collapse"]');

        if (!trigger) {
            return;
        }

        if (trigger.tagName === 'A') {
            event.preventDefault();
        }

        if (trigger.getAttribute('aria-expanded') === 'true') {
            return;
        }

        var selector = trigger.getAttribute('data-target');

        if (!selector) {
            return;
        }

        var target = document.querySelector(selector);

        if (!target) {
            return;
        }

        scheduleSubmenuReveal(target);
    }, true);

    function initSidebarMenuScroll() {
        initSubmenuObservers();
        scrollToActiveMenuItem();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initSidebarMenuScroll);
    } else {
        initSidebarMenuScroll();
    }

    window.addEventListener('resize', initSubmenuObservers);
})();
