// =============================================================
// GLOBAL FUNCTION FOR MAIN HERO SLIDER NAVIGATION
// =============================================================
function currentSlide(index) {
    if (typeof window.__showSlide === 'function') {
        window.__showSlide(index);
    }
}

// =============================================================
// CLEAN URL REWRITER — runs synchronously from <head>
// Attaches a MutationObserver to `document` (not `body`) so it
// catches every <a> the instant the parser inserts it, BEFORE
// Firefox caches the raw href for the hover status bar.
// =============================================================
(function() {
    function cleanHref(href) {
        if (!href) return href;
        if (/^(https?:)?\/\//i.test(href)) return href;
        if (/^(mailto:|tel:|#|javascript:)/i.test(href)) return href;

        var parts = href.match(/^([^?#]*)(\?[^#]*)?(#.*)?$/);
        if (!parts) return href;

        var path = parts[1] || '';
        var qs = parts[2] || '';
        var hash = parts[3] || '';

        if (path === 'index.php' || path === './index.php') {
            return './' + qs + hash;
        }

        var idMatch = path.match(/^(service-detail|post)\.php$/);
        if (idMatch && qs.indexOf('id=') !== -1) {
            var idVal = qs.match(/id=([^&]+)/);
            if (idVal) {
                var rest = qs.replace(/[?&]id=[^&]+/, '').replace(/^&/, '');
                return idMatch[1] + '/' + idVal[1] + (rest ? '?' + rest : '') + hash;
            }
        }

        if (/\.php$/i.test(path)) {
            return path.replace(/\.php$/i, '') + qs + hash;
        }
        return href;
    }

    function cleanAll(root) {
        var links = (root || document).querySelectorAll('a[href]');
        for (var i = 0; i < links.length; i++) {
            var link = links[i];
            var orig = link.getAttribute('href');
            var cleaned = cleanHref(orig);
            if (cleaned !== orig) {
                link.setAttribute('href', cleaned);
            }
        }
    }

    window.__cleanUrls = cleanAll;

    // Observe `document` from the very start — catches every <a>
    // as the HTML parser inserts it, plus dynamically added ones.
    if (typeof MutationObserver !== 'undefined') {
        var mo = new MutationObserver(function(mutations) {
            for (var i = 0; i < mutations.length; i++) {
                var m = mutations[i];
                if (m.type === 'childList') {
                    for (var j = 0; j < m.addedNodes.length; j++) {
                        var node = m.addedNodes[j];
                        if (node.nodeType === 1) {
                            if (node.tagName === 'A' && node.hasAttribute('href')) {
                                var o = node.getAttribute('href');
                                var c = cleanHref(o);
                                if (c !== o) node.setAttribute('href', c);
                            } else if (node.querySelectorAll) {
                                cleanAll(node);
                            }
                        }
                    }
                } else if (m.type === 'attributes' && m.target.tagName === 'A') {
                    var a = m.target;
                    var o2 = a.getAttribute('href');
                    var c2 = cleanHref(o2);
                    if (c2 !== o2) a.setAttribute('href', c2);
                }
            }
        });
        mo.observe(document, {
            childList: true,
            subtree: true,
            attributes: true,
            attributeFilter: ['href']
        });
    }

    // Safety net for the case where the script is loaded after the
    // document has already partially parsed.
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            cleanAll(document);
        });
    } else {
        cleanAll(document);
    }
})();

// =============================================================
// MAIN SCRIPT — everything wrapped inside one DOMContentLoaded
// =============================================================
document.addEventListener('DOMContentLoaded', function() {

    // =========================================================
    // 1. MOBILE MENU TOGGLE
    // =========================================================
    const mobileToggle = document.getElementById('mobileToggle');
    const mainNav = document.getElementById('mainNav');

    if (mobileToggle && mainNav) {
        mobileToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            mainNav.classList.toggle('active');
            const icon = mobileToggle.querySelector('i');
            if (mainNav.classList.contains('active')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });

        document.addEventListener('click', function(event) {
            if (mainNav.classList.contains('active')) {
                if (!mainNav.contains(event.target) && !mobileToggle.contains(event.target)) {
                    mainNav.classList.remove('active');
                    const icon = mobileToggle.querySelector('i');
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                }
            }
        });
    }

    // =========================================================
    // 2. MAIN HERO SLIDER
    // =========================================================
    const heroSlides = document.querySelectorAll('.hero-slider .slide');
    const heroDots = document.querySelectorAll('.hero-slider .dot');
    let heroIndex = 0;
    let heroInterval = null;
    const HERO_DURATION = 3000;

    function showHeroSlide(index) {
        if (heroSlides.length === 0) return;
        if (index >= heroSlides.length) index = 0;
        if (index < 0) index = heroSlides.length - 1;

        heroSlides.forEach(function(s) {
            s.classList.remove('active');
            s.classList.remove('leaving');
        });

        if (heroSlides[heroIndex]) {
            heroSlides[heroIndex].classList.add('leaving');
        }
        heroSlides[index].classList.add('active');

        heroDots.forEach(function(d) { d.classList.remove('active'); });
        if (heroDots[index]) heroDots[index].classList.add('active');

        heroIndex = index;
    }

    window.__showSlide = function(index) {
        clearInterval(heroInterval);
        showHeroSlide(index);
        heroInterval = setInterval(function() {
            showHeroSlide(heroIndex + 1);
        }, HERO_DURATION);
    };

    if (heroSlides.length > 0) {
        heroSlides[0].classList.add('active');
        if (heroDots[0]) heroDots[0].classList.add('active');
        heroInterval = setInterval(function() {
            showHeroSlide(heroIndex + 1);
        }, HERO_DURATION);
    }

    // =========================================================
    // 2B. SERVICES PAGE HERO SLIDER
    // =========================================================
    const servicesSlides = document.querySelectorAll('.services-hero-slider .services-slide');
    let servicesIndex = 0;
    const SERVICES_DURATION = 3000;

    function showServicesSlide(index) {
        if (servicesSlides.length === 0) return;
        if (index >= servicesSlides.length) index = 0;
        if (index < 0) index = servicesSlides.length - 1;

        servicesSlides.forEach(function(s) {
            s.classList.remove('active');
            s.classList.remove('leaving');
        });

        if (servicesSlides[servicesIndex]) {
            servicesSlides[servicesIndex].classList.add('leaving');
        }
        servicesSlides[index].classList.add('active');

        servicesIndex = index;
    }

    if (servicesSlides.length > 0) {
        servicesSlides[0].classList.add('active');
        setInterval(function() {
            showServicesSlide(servicesIndex + 1);
        }, SERVICES_DURATION);
    }

    // =========================================================
    // 3. SYNCHRONIZED MINI SLIDERS (Company Page)
    // =========================================================
    const miniSliders = document.querySelectorAll('.mini-slider');

    if (miniSliders.length > 0) {
        const sliderStates = [];

        miniSliders.forEach(function(slider) {
            const slides = slider.querySelectorAll('.mini-slide');
            if (slides.length > 0) {
                slides[0].classList.add('active');
                sliderStates.push({
                    element: slider,
                    slides: slides,
                    index: 0
                });
            }
        });

        const MINI_DURATION = 3000;

        function advanceAllMiniSliders() {
            sliderStates.forEach(function(state) {
                if (state.slides.length === 0) return;

                const prevIndex = state.index;
                state.slides[prevIndex].classList.remove('active');
                state.slides[prevIndex].classList.add('leaving');

                let nextIndex = (state.index + 1) % state.slides.length;
                state.slides[nextIndex].classList.remove('leaving');
                state.slides[nextIndex].classList.add('active');

                state.index = nextIndex;

                setTimeout(function() {
                    state.slides.forEach(function(s) {
                        s.classList.remove('leaving');
                    });
                }, 950);
            });
        }

        setInterval(advanceAllMiniSliders, MINI_DURATION);
    }

    // =========================================================
    // 4. PORTFOLIO FILTER
    // =========================================================
    const portfolioFilterBtns = document.querySelectorAll('.portfolio-filter-btn');
    const portfolioItems = document.querySelectorAll('.portfolio-item');

    portfolioFilterBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            portfolioFilterBtns.forEach(function(b) { b.classList.remove('active'); });
            btn.classList.add('active');

            const filter = btn.getAttribute('data-filter');

            portfolioItems.forEach(function(item) {
                const category = item.getAttribute('data-category');
                if (filter === 'all' || category === filter) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

    // =========================================================
    // 5. PORTFOLIO LIGHTBOX
    // =========================================================
    const portfolioLinks = document.querySelectorAll('.portfolio-item a');
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    const lightboxClose = document.querySelector('.lightbox-close');

    if (lightbox && lightboxImg && portfolioLinks.length > 0) {
        portfolioLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const imgSrc = link.getAttribute('href');
                if (imgSrc) {
                    lightboxImg.setAttribute('src', imgSrc);
                    lightbox.classList.add('active');
                }
            });
        });

        if (lightboxClose) {
            lightboxClose.addEventListener('click', function() {
                lightbox.classList.remove('active');
            });
        }

        lightbox.addEventListener('click', function(e) {
            if (e.target === lightbox) {
                lightbox.classList.remove('active');
            }
        });
    }

    // =========================================================
    // 6. TESTIMONIALS SLIDER
    // =========================================================
    const testimonialSlides = document.querySelectorAll('.testimonial-slide');
    const testimonialDots = document.querySelectorAll('.testimonial-dot');
    let testimonialIndex = 0;
    const TESTIMONIAL_DURATION = 5000;

    function showTestimonial(index) {
        if (testimonialSlides.length === 0) return;
        if (index >= testimonialSlides.length) index = 0;
        if (index < 0) index = testimonialSlides.length - 1;

        testimonialSlides.forEach(function(s) { s.classList.remove('active'); });
        testimonialDots.forEach(function(d) { d.classList.remove('active'); });

        testimonialSlides[index].classList.add('active');
        if (testimonialDots[index]) testimonialDots[index].classList.add('active');

        testimonialIndex = index;
    }

    if (testimonialSlides.length > 0) {
        testimonialSlides[0].classList.add('active');
        if (testimonialDots[0]) testimonialDots[0].classList.add('active');

        setInterval(function() {
            showTestimonial(testimonialIndex + 1);
        }, TESTIMONIAL_DURATION);
    }

    // =========================================================
    // 7. ACCORDION / FAQ TOGGLE
    // =========================================================
    const accordionHeaders = document.querySelectorAll('.accordion-header');

    accordionHeaders.forEach(function(header) {
        header.addEventListener('click', function() {
            const item = header.parentElement;
            const isActive = item.classList.contains('active');

            document.querySelectorAll('.accordion-item').forEach(function(i) {
                i.classList.remove('active');
            });

            if (!isActive) {
                item.classList.add('active');
            }
        });
    });

    // =========================================================
    // 8. RESOURCES HERO SLIDER
    // =========================================================
    const resourcesSlides = document.querySelectorAll('.resources-hero-slider .resources-slide');
    let resourcesIndex = 0;
    const RESOURCES_DURATION = 3000;

    function showResourcesSlide(index) {
        if (resourcesSlides.length === 0) return;
        if (index >= resourcesSlides.length) index = 0;
        if (index < 0) index = resourcesSlides.length - 1;

        resourcesSlides.forEach(function(s) {
            s.classList.remove('active');
            s.classList.remove('leaving');
        });

        if (resourcesSlides[resourcesIndex]) {
            resourcesSlides[resourcesIndex].classList.add('leaving');
        }
        resourcesSlides[index].classList.add('active');

        resourcesIndex = index;
    }

    if (resourcesSlides.length > 0) {
        resourcesSlides[0].classList.add('active');
        setInterval(function() {
            showResourcesSlide(resourcesIndex + 1);
        }, RESOURCES_DURATION);
    }

    // =========================================================
    // 9. RESOURCES CATEGORY FILTERS
    // =========================================================
    const resourceFilterBtns = document.querySelectorAll('#resourcesGrid').length > 0
        ? document.querySelectorAll('.filter-btn')
        : [];
    const resourceCards = document.querySelectorAll('.resource-card');

    resourceFilterBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            resourceFilterBtns.forEach(function(b) { b.classList.remove('active'); });
            btn.classList.add('active');

            const filter = btn.getAttribute('data-filter');

            resourceCards.forEach(function(card) {
                const category = card.getAttribute('data-category');
                if (filter === 'all' || category === filter) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    // =========================================================
    // 10. HIDE SUPPORT BUTTON WHEN FOOTER IS IN VIEW
    // =========================================================
    const supportBtn = document.querySelector('.support-btn');
    const footer = document.querySelector('footer');

    if (supportBtn && footer && 'IntersectionObserver' in window) {
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    supportBtn.style.opacity = '0';
                    supportBtn.style.pointerEvents = 'none';
                    supportBtn.style.transform = 'translateY(20px)';
                } else {
                    supportBtn.style.opacity = '1';
                    supportBtn.style.pointerEvents = 'auto';
                    supportBtn.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.1 });

        observer.observe(footer);
    }

});