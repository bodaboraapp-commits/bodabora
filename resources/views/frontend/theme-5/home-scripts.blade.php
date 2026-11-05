@push('scripts')
<!-- script section -->
  <script>
    (function () {
      var toggle = document.getElementById("nav-toggle");
      var panel = document.getElementById("mobile-nav");

      if (!toggle || !panel) return;

      // toggle open/close
      toggle.addEventListener("click", function () {
        var open = panel.classList.toggle("hidden") === false;
        toggle.setAttribute("aria-expanded", open ? "true" : "false");
      });

      //  auto close on menu click
      panel.querySelectorAll("a, button").forEach(function (item) {
        item.addEventListener("click", function () {
          if (!panel.classList.contains("hidden")) {
            panel.classList.add("hidden");
            toggle.setAttribute("aria-expanded", "false");
          }
        });
      });

    })();
  </script>

  <script>
    const track = document.getElementById("testimonialTrack");
    const slides = document.querySelectorAll("#testimonialTrack > div");

    const nextBtn = document.getElementById("nextBtn");
    const prevBtn = document.getElementById("prevBtn");

    let index = 0;

    function updateSlider() {
      track.style.transform = `translateX(-${index * 100}%)`;
    }

    nextBtn.addEventListener("click", () => {
      index++;

      if (index >= slides.length) {
        index = 0;
      }

      updateSlider();
    });

    prevBtn.addEventListener("click", () => {
      index--;

      if (index < 0) {
        index = slides.length - 1;
      }

      updateSlider();
    });

    // Auto Slide
    setInterval(() => {
      index++;

      if (index >= slides.length) {
        index = 0;
      }

      updateSlider();
    }, 4000);
  </script>

  <script>
    // Scrollspy: highlight nav links (desktop + mobile) when sections enter viewport
    (function () {
      const sections = document.querySelectorAll('section[id]');
      if (!sections.length) return;

      const desktopNavLinks = document.querySelectorAll('nav a[href^="#"]');
      const mobileNavLinks = document.querySelectorAll('#mobile-nav a[href^="#"]');

      const removeActive = (links) => {
        links.forEach(a => {
          a.classList.remove('bg-nav-bg', 'text-nav-active-text', 'border-active-border', 'border-b-2');
        });
      };

      const setActiveForId = (id) => {
        const selector = `nav a[href="#${id}"], #mobile-nav a[href="#${id}"]`;
        const matches = document.querySelectorAll(selector);
        removeActive(desktopNavLinks);
        removeActive(mobileNavLinks);
        matches.forEach(a => a.classList.add('bg-nav-bg', 'text-nav-active-text', 'border-active-border', 'border-b-2'));
      };

      // IntersectionObserver to watch sections
      const io = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            setActiveForId(entry.target.id);
          }
        });
      }, { root: null, threshold: 0.55 });

      sections.forEach(s => io.observe(s));

      // Also update active immediately on nav link click (for smooth scroll targets)
      const allLinks = Array.from(desktopNavLinks).concat(Array.from(mobileNavLinks));
      allLinks.forEach(link => {
        link.addEventListener('click', (e) => {
          const href = link.getAttribute('href') || '';
          if (href.startsWith('#')) {
            const id = href.slice(1);
            setTimeout(() => setActiveForId(id), 50);
          }
        });
      });
    })();
  </script>

  <script>
    // Tab switching logic with emerald unified design
    const tabBtns = document.querySelectorAll('.tab-btn-emerald');
    const contentsMap = {
      'same-day': document.getElementById('same-day-content'),
      'next-day': document.getElementById('next-day-content'),
      'sub-city': document.getElementById('sub-city-content'),
      'outside-city': document.getElementById('outside-city-content')
    };

    function activateTab(tabId) {
      // hide all tab contents
      Object.values(contentsMap).forEach(content => {
        if (content) content.classList.add('hidden');
      });
      if (contentsMap[tabId]) {
        contentsMap[tabId].classList.remove('hidden');
        contentsMap[tabId].classList.add('animate-fade-up');
      }
      // update button styles
      tabBtns.forEach(btn => {
        const btnTab = btn.getAttribute('data-tab');
        if (btnTab === tabId) {
          btn.classList.remove('tab-inactive-emerald');
          btn.classList.add('tab-active-emerald');
        } else {
          btn.classList.remove('tab-active-emerald');
          btn.classList.add('tab-inactive-emerald');
        }
      });
    }

    tabBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        const tabId = btn.getAttribute('data-tab');
        if (tabId) activateTab(tabId);
      });
    });

    // set default "same-day"
    activateTab('same-day');
  </script>
@endpush
