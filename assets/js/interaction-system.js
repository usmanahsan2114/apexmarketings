(function () {
  "use strict";

  var reduce = window.matchMedia && window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  function ready(fn) {
    if (document.readyState !== "loading") fn();
    else document.addEventListener("DOMContentLoaded", fn);
  }

  function track(label, detail) {
    if (typeof window.gtag === "function") window.gtag("event", label, detail || {});
  }

  function injectHero() {
    var hero = document.querySelector(".cs-hero");
    if (!hero) return;
    if (!hero.querySelector(".interactive-scene")) {
      var canvas = document.createElement("canvas");
      canvas.className = "interactive-scene";
      canvas.setAttribute("aria-hidden", "true");
      canvas.setAttribute("data-scene", "growth-orbit");
      hero.insertBefore(canvas, hero.firstChild);
      drawGrowth(canvas);
    }
    var text = hero.querySelector(".cs-hero_text");
    if (text && !text.querySelector(".am-proof-strip")) {
      var strip = document.createElement("div");
      strip.className = "am-proof-strip";
      strip.innerHTML = [
        ["SEO", "Search demand into qualified traffic"],
        ["PPC", "Google and Meta campaigns with intent"],
        ["CRO", "Funnels tuned for leads and revenue"]
      ].map(function (item) {
        return '<div class="am-proof-card" data-tilt><b>' + item[0] + '</b><span>' + item[1] + '</span></div>';
      }).join("");
      text.appendChild(strip);
    }
  }

  function drawGrowth(canvas) {
    if (reduce) return;
    var ctx = canvas.getContext("2d");
    if (!ctx) return;
    var dpr = Math.min(window.devicePixelRatio || 1, 1.75);
    var bars = [];
    var running = true;
    function resize() {
      var rect = canvas.getBoundingClientRect();
      canvas.width = Math.max(1, Math.floor(rect.width * dpr));
      canvas.height = Math.max(1, Math.floor(rect.height * dpr));
      ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
      bars = [];
      var count = rect.width < 700 ? 18 : 34;
      for (var i = 0; i < count; i++) {
        bars.push({ x: Math.random() * rect.width, y: Math.random() * rect.height, h: 20 + Math.random() * 90, s: 0.4 + Math.random() * 0.8 });
      }
    }
    function draw(t) {
      if (!running || window.__apexWebGLActive) return; // WebGL showpiece took over the hero
      var w = canvas.clientWidth;
      var h = canvas.clientHeight;
      ctx.clearRect(0, 0, w, h);
      ctx.strokeStyle = "rgba(246,185,0,.22)";
      ctx.lineWidth = 1;
      for (var i = 0; i < bars.length; i++) {
        var b = bars[i];
        var pulse = Math.sin((t / 900) * b.s + i) * 0.5 + 0.5;
        var height = b.h * (0.45 + pulse * 0.55);
        ctx.beginPath();
        ctx.moveTo(b.x, b.y);
        ctx.lineTo(b.x, b.y - height);
        ctx.stroke();
        ctx.fillStyle = "rgba(246,185,0," + (0.18 + pulse * 0.38).toFixed(2) + ")";
        ctx.beginPath();
        ctx.arc(b.x, b.y - height, 2.3, 0, Math.PI * 2);
        ctx.fill();
      }
      ctx.strokeStyle = "rgba(255,255,255,.16)";
      ctx.beginPath();
      for (var x = -40; x < w + 80; x += 80) {
        var y = h * 0.62 + Math.sin((x + t / 18) / 70) * 22;
        if (x === -40) ctx.moveTo(x, y);
        else ctx.lineTo(x, y);
      }
      ctx.stroke();
      requestAnimationFrame(draw);
    }
    window.addEventListener("resize", resize, { passive: true });
    document.addEventListener("visibilitychange", function () {
      running = !document.hidden;
      if (running) requestAnimationFrame(draw);
    });
    resize();
    requestAnimationFrame(draw);
  }

  function enhanceCards() {
    document.querySelectorAll(".cs-iconbox, .cs-portfolio, .cs-post, .cs-testimonial, .cs-pricing_table, .am-proof-card").forEach(function (el) {
      el.setAttribute("data-tilt", "");
    });
  }

  function initTilt() {
    if (reduce || !window.matchMedia("(pointer:fine)").matches) return;
    document.querySelectorAll("[data-tilt]").forEach(function (el) {
      el.addEventListener("mousemove", function (event) {
        var r = el.getBoundingClientRect();
        var x = (event.clientX - r.left) / r.width - 0.5;
        var y = (event.clientY - r.top) / r.height - 0.5;
        el.style.transform = "perspective(900px) rotateX(" + (-y * 4).toFixed(2) + "deg) rotateY(" + (x * 6).toFixed(2) + "deg) translateY(-3px)";
      });
      el.addEventListener("mouseleave", function () { el.style.transform = ""; });
    });
  }

  function initReveal() {
    var items = document.querySelectorAll("section .container > .row, .cs-iconbox, .cs-portfolio, .cs-post");
    items.forEach(function (el) { el.setAttribute("data-motion", "reveal"); });
    if (!("IntersectionObserver" in window) || reduce) {
      items.forEach(function (el) { el.classList.add("is-visible"); });
      return;
    }
    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add("is-visible");
          observer.unobserve(entry.target);
        }
      });
      /* threshold MUST stay 0. A `.row` wrapping a whole article can be many
         times the viewport height, and its intersectionRatio then tops out at
         viewportH/elementH — for a 6600px body in a 900px window that is 0.13,
         so any threshold above it never fires and the article stays at
         opacity:0 until the reader scrolls most of the way through it. With
         threshold 0 the negative bottom margin alone decides the trigger
         point: the element reveals as its top crosses 94% of the viewport. */
    }, { threshold: 0, rootMargin: "0px 0px -6% 0px" });
    items.forEach(function (el) { observer.observe(el); });

    /* Anything already inside the first viewport reveals immediately, so
       above-the-fold content is never blank on arrival. */
    items.forEach(function (el) {
      var r = el.getBoundingClientRect();
      if (r.top < window.innerHeight && r.bottom > 0) el.classList.add("is-visible");
    });
  }

  function analytics() {
    document.addEventListener("click", function (event) {
      var a = event.target.closest && event.target.closest("a[href]");
      if (!a) return;
      var href = a.getAttribute("href") || "";
      if (/wa\.me|whatsapp/i.test(href)) track("whatsapp_click", { link_url: href });
      else if (href.indexOf("tel:") === 0) track("phone_click", { link_url: href });
      else if (href.indexOf("mailto:") === 0) track("email_click", { link_url: href });
      else if (/contact|quote|portfolio|case-studies|services/.test(href)) track("marketing_cta_click", { link_url: href });
    }, true);
  }

  ready(function () {
    injectHero();
    enhanceCards();
    initTilt();
    initReveal();
    analytics();
  });
})();
