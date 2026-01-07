/**
 * Sacks Optical - Frontend Animations
 * Powered by GSAP
 */

document.addEventListener('DOMContentLoaded', () => {

    // 1. Register GSAP Plugins First
    gsap.registerPlugin(ScrollTrigger);

    // 2. Page Loader Removal
    const loader = document.querySelector('.page-loader');
    if (loader) {
        gsap.to(loader, {
            opacity: 0,
            duration: 1,
            delay: 1,
            onComplete: () => loader.remove()
        });
    }

    // 3. Custom Cursor
    const cursorDot = document.querySelector('.cursor-dot');
    const cursorCircle = document.querySelector('.cursor-circle');

    if (cursorDot && cursorCircle) {
        // Move cursor
        document.addEventListener('mousemove', (e) => {
            gsap.to(cursorDot, { x: e.clientX, y: e.clientY, duration: 0.1 });
            gsap.to(cursorCircle, { x: e.clientX, y: e.clientY, duration: 0.3 });
        });

        // Hover Effect on Magnetic Items
        const magneticItems = document.querySelectorAll('.magnetic-item, a, button');
        magneticItems.forEach(item => {
            item.addEventListener('mouseenter', () => {
                document.body.classList.add('hovering');
                // Magnetic Pull
                gsap.to(item, { scale: 1.1, duration: 0.3 });
            });
            item.addEventListener('mouseleave', () => {
                document.body.classList.remove('hovering');
                gsap.to(item, { x: 0, y: 0, scale: 1, duration: 0.3 });
            });
        });
    }

    // 4. Navbar Scroll Effect
    const navbar = document.querySelector('.navbar');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // 5. Global Scroll Animations
    // A. General Parallax Elements
    // Add data-speed="0.5" (slow) or data-speed="1.2" (fast) to elements
    document.querySelectorAll('[data-speed]').forEach(el => {
        const speed = parseFloat(el.getAttribute('data-speed'));
        gsap.to(el, {
            y: (i, target) => -ScrollTrigger.maxScroll(window) * target.dataset.speed,
            ease: "none",
            scrollTrigger: {
                trigger: document.body,
                start: "top top",
                end: "bottom bottom",
                scrub: 0.5
            }
        });
    });

    // B. Parallax Image Containers (Mask Effect)
    document.querySelectorAll('.parallax-image-container').forEach(container => {
        const img = container.querySelector('img');
        if (img) {
            gsap.fromTo(img,
                { scale: 1.2, yPercent: -10 },
                {
                    scale: 1.2,
                    yPercent: 10,
                    ease: "none",
                    scrollTrigger: {
                        trigger: container,
                        start: "top bottom",
                        end: "bottom top",
                        scrub: true
                    }
                }
            );
        }
    });

    // D. Fade Up & Reveal Elements
    const fadeUpElements = document.querySelectorAll('.fade-up');
    fadeUpElements.forEach(el => {
        gsap.fromTo(el,
            { y: 60, opacity: 0 },
            {
                y: 0,
                opacity: 1,
                duration: 0.8,
                ease: "power2.out",
                scrollTrigger: {
                    trigger: el,
                    start: "top 90%",
                    end: "top 60%",
                    toggleActions: "play none none reverse"
                }
            }
        );
    });

    // E. Text Reveal (Split Line simulation)
    // Needs a wrapper with overflow:hidden and inner span
    const textReveals = document.querySelectorAll('.text-reveal');
    textReveals.forEach(el => {
        gsap.fromTo(el,
            { yPercent: 100, opacity: 0 },
            {
                yPercent: 0,
                opacity: 1,
                duration: 1.2,
                ease: "power3.out",
                scrollTrigger: {
                    trigger: el.parentElement,
                    start: "top 85%",
                    end: "top 50%",
                    toggleActions: "play none none reverse"
                }
            }
        );
    });

    // Hero Text Stagger (if exists)
    const heroTitle = document.querySelector('.hero-title');
    if (heroTitle) {
        const spans = heroTitle.querySelectorAll('span');
        gsap.fromTo(spans,
            { y: 100, opacity: 0 },
            {
                y: 0,
                opacity: 1,
                duration: 1.2,
                stagger: 0.2,
                ease: "power3.out",
                delay: 1.2
            }
        );
    }

    // Refresh ScrollTrigger after all animations are set up
    ScrollTrigger.refresh();

});
