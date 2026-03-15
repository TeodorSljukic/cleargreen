(function() {
  const $ = (sel, root = document) => root.querySelector(sel);
  const $$ = (sel, root = document) => Array.from(root.querySelectorAll(sel));

  const isEmail = (v) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(String(v || "").trim());

  // Wait for DOM to be ready
  function init() {
    // ----- Form UX (validation + loader) -----
    const form = $(".titan-gatekeeper .getTitan");
    if (form) {
      const emailInput = $("input[name='email']", form);
      const errorEl = $(".error", form);

      form.addEventListener("submit", (e) => {
        e.preventDefault();
        const email = (emailInput?.value || "").trim();
        const msg = form.getAttribute("data-error") || "Invalid email.";

        if (!isEmail(email)) {
          form.classList.remove("is-loading");
          if (errorEl) errorEl.textContent = msg;
          emailInput?.focus();
          return;
        }

        if (errorEl) errorEl.textContent = "";
        form.classList.add("is-loading");

        // No backend endpoint provided; keep this as UI-only.
        setTimeout(() => {
          form.classList.remove("is-loading");
        }, 1200);
      });
    }

    // ----- FAQ accordion -----
    const faqButtons = $$(".titan-gatekeeper .faq-acordion-btn");
    if (faqButtons.length > 0) {
      faqButtons.forEach((btn) => {
        btn.addEventListener("click", function(e) {
          e.preventDefault();
          e.stopPropagation();
          const targetSel = this.getAttribute("data-target");
          if (!targetSel) return;
          const panel = $(targetSel);
          if (!panel) return;

          const isOpen = this.getAttribute("aria-expanded") === "true";

          // close others with animation
          faqButtons.forEach((b) => {
            if (b === this) return;
            const sel = b.getAttribute("data-target");
            const p = sel ? $(sel) : null;
            if (p && !p.hidden) {
              b.setAttribute("aria-expanded", "false");
              b.classList.remove("active");
              // Animate closing
              p.style.maxHeight = p.scrollHeight + "px";
              setTimeout(() => {
                p.style.maxHeight = "0px";
                p.style.opacity = "0";
              }, 10);
              setTimeout(() => {
                p.hidden = true;
              }, 400);
            }
          });

          // toggle current with smooth animation
          if (isOpen) {
            this.setAttribute("aria-expanded", "false");
            this.classList.remove("active");
            // Start closing animation
            panel.style.maxHeight = panel.scrollHeight + "px";
            setTimeout(() => {
              panel.style.maxHeight = "0px";
              panel.style.opacity = "0";
            }, 10);
            setTimeout(() => {
              panel.hidden = true;
            }, 400);
          } else {
            this.setAttribute("aria-expanded", "true");
            this.classList.add("active");
            panel.hidden = false;
            // Start opening animation
            panel.style.maxHeight = "0px";
            panel.style.opacity = "0";
            setTimeout(() => {
              panel.style.maxHeight = panel.scrollHeight + "px";
              panel.style.opacity = "1";
            }, 10);
          }
        });
      });
    }

    // ----- Video modal -----
    const modal = $("#popupModal.titan-modal");
    const frame = $("#titanVideoFrame");
    const openers = $$(".titan-gatekeeper .video-container, .titan-gatekeeper .icon.icon-play");

    const openModal = (url) => {
      if (!modal) return;
      modal.setAttribute("aria-hidden", "false");
      document.documentElement.style.overflow = "hidden";
      if (frame) frame.src = url;
    };

    const closeModal = () => {
      if (!modal) return;
      modal.setAttribute("aria-hidden", "true");
      document.documentElement.style.overflow = "";
      if (frame) frame.src = "";
    };

    openers.forEach((el) => {
      el.addEventListener("click", () => {
        const container = el.closest(".video-container") || el;
        const url = container?.getAttribute("data-url");
        if (url) openModal(url);
      });
      el.addEventListener("keydown", (e) => {
        if (e.key === "Enter" || e.key === " ") {
          e.preventDefault();
          const container = el.closest(".video-container") || el;
          const url = container?.getAttribute("data-url");
          if (url) openModal(url);
        }
      });
    });

    if (modal) {
      modal.addEventListener("click", (e) => {
        const t = e.target;
        if (t && t instanceof HTMLElement && t.getAttribute("data-close") === "1") {
          closeModal();
        }
      });
      document.addEventListener("keydown", (e) => {
        if (e.key === "Escape" && modal.getAttribute("aria-hidden") === "false") {
          closeModal();
        }
      });
    }

    // ----- Image Lightbox (Magnific Popup) -----
    // Wait for jQuery and Magnific Popup to be available
    if (typeof jQuery !== 'undefined') {
      jQuery(document).ready(function($) {
        if (typeof $.fn.magnificPopup !== 'undefined') {
          $('.titan-gatekeeper .image-popup').magnificPopup({
            type: 'image',
            gallery: {
              enabled: true,
              navigateByImgClick: true,
              preload: [0, 1]
            },
            image: {
              titleSrc: function(item) {
                return item.el.find('img').attr('alt') || '';
              }
            },
            mainClass: 'mfp-fade',
            removalDelay: 300,
            transition: 'mfp-fade'
          });
        }
      });
    }

    // ----- Testimonials Swiper Slider -----
    if (typeof Swiper !== 'undefined') {
      const testimonialSwiper = new Swiper('.testimonial-swiper', {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        autoplay: {
          delay: 5000,
          disableOnInteraction: false,
        },
        pagination: {
          el: '.testimonial-pagination',
          clickable: true,
          dynamicBullets: true,
        },
        navigation: {
          nextEl: '.testimonial-next',
          prevEl: '.testimonial-prev',
        },
        breakpoints: {
          640: {
            slidesPerView: 2,
            spaceBetween: 20,
          },
          992: {
            slidesPerView: 3,
            spaceBetween: 24,
          },
        },
      });
    }

    // ----- Brand Swiper (References) -----
    if (typeof Swiper !== 'undefined') {
      new Swiper('.brand-swiper', {
        slidesPerView: 2,
        spaceBetween: 20,
        loop: true,
        autoplay: {
          delay: 2500,
          disableOnInteraction: false,
        },
        breakpoints: {
          640: {
            slidesPerView: 3,
            spaceBetween: 24,
          },
          992: {
            slidesPerView: 5,
            spaceBetween: 28,
          },
          1200: {
            slidesPerView: 7,
            spaceBetween: 28,
          },
        },
      });
    }

    // ----- Mobile menu (Gatekeeper header) -----
    const toggleMobileMenu = $(".toggle-mobileMenu");
    const mobileMenu = $(".mobile-menu");
    const closeButton = $(".close-button");
    const sideOverlay = $(".side-overlay");

    const openMobileMenu = () => {
      if (!mobileMenu) return;
      mobileMenu.classList.add("active");
      sideOverlay?.classList.add("show");
      document.body.style.overflow = "hidden";
      document.body.classList.add("mobile-menu-open");
    };

    const closeMobileMenu = () => {
      if (!mobileMenu) return;
      mobileMenu.classList.remove("active");
      sideOverlay?.classList.remove("show");
      document.body.style.overflow = "";
      document.body.classList.remove("mobile-menu-open");
    };

    if (toggleMobileMenu && mobileMenu) {
      toggleMobileMenu.addEventListener("click", () => {
        mobileMenu.classList.contains("active") ? closeMobileMenu() : openMobileMenu();
      });
    }

    closeButton?.addEventListener("click", closeMobileMenu);
    sideOverlay?.addEventListener("click", closeMobileMenu);
    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape" && mobileMenu?.classList.contains("active")) {
        closeMobileMenu();
      }
    });
  }

  // Initialize when DOM is ready
  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }
})();
