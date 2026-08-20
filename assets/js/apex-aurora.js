/* ==========================================================================
   APEX AURORA — interaction engine (Apex Marketings)
   --------------------------------------------------------------------------
   Zero dependencies. Everything is capability-gated and re-runs cleanly after
   late DOM injection. Nothing here is required for the page to be usable:
   if this file fails to parse, the site is exactly as it was.

   Public config (optional, set before this script):
     window.APEX_AURORA = { accent:'#e6ad02', glow:'#ffd34d', bubbles:true }
   ========================================================================== */
(function () {
  'use strict';

  var CFG = window.APEX_AURORA || {};
  var doc = document;
  var root = doc.documentElement;

  /* ---------------------------------------------------------------- utils */
  var reduced = false;
  try {
    var mq = window.matchMedia('(prefers-reduced-motion: reduce)');
    reduced = mq.matches;
    if (mq.addEventListener) mq.addEventListener('change', function (e) { reduced = e.matches; });
  } catch (e) { /* ancient browser: treat as motion-allowed */ }

  var finePointer = true;
  try { finePointer = window.matchMedia('(hover: hover) and (pointer: fine)').matches; } catch (e) { }

  var isDesktop = function () { return window.innerWidth >= 992; };
  var lowPower = (navigator.hardwareConcurrency || 8) <= 3 || (navigator.deviceMemory || 8) <= 2;
  var saveData = !!(navigator.connection && navigator.connection.saveData);

  var canAnimate = function () { return !reduced && !saveData; };
  var canDecorate = function () { return canAnimate() && !lowPower; };

  function $(sel, ctx) { return (ctx || doc).querySelector(sel); }
  function $$(sel, ctx) { return Array.prototype.slice.call((ctx || doc).querySelectorAll(sel)); }
  function on(el, ev, fn, opt) { el.addEventListener(ev, fn, opt || false); }

  /* Cleanup registry so re-initialisation never leaks observers / rAF loops. */
  var teardown = [];
  function onTeardown(fn) { teardown.push(fn); }
  function runTeardown() {
    while (teardown.length) { try { teardown.pop()(); } catch (e) { } }
  }

  /* rAF throttle */
  function raf(fn) {
    var queued = false, lastArgs;
    return function () {
      lastArgs = arguments;
      if (queued) return;
      queued = true;
      requestAnimationFrame(function () { queued = false; fn.apply(null, lastArgs); });
    };
  }

  /* =====================================================================
     1. SCROLL REVEALS
     Auto-tags sensible blocks so 300+ pages get the treatment with no
     per-page markup edits, then reveals them on intersection.
     ===================================================================== */
  var AUTO_REVEAL = [
    '.cs-iconbox', '.cs-card', '.cs-post', '.cs-team', '.cs-funfact',
    '.cs-pricing_table', '.cs-service_card', '.cs-resource_card',
    '.cs-sidebar_item', '.aur-stat',
    '.aur-answer', '.aur-table-wrap', '.aur-faq details'
  ].join(',');

  function tagReveals(scope) {
    var els = $$(AUTO_REVEAL, scope);
    els.forEach(function (el, i) {
      if (el.hasAttribute('data-aur')) return;
      /* Never fight a reveal system that already owns this element (wow.js and
         the shared [data-motion] layer) — double-animating causes flicker. */
      if (el.closest('.wow, [data-motion], [data-reveal], [data-animate], .cs-hobble')) return;
      /* Carousel slides can sit outside the visible track forever, so an
         intersection-gated reveal would strand them at opacity:0. Skip them. */
      if (el.closest('.swiper, .swiper-slide, .slick-slider, .slick-slide, .cs-slider, [class*="slider"]')) return;
      el.setAttribute('data-aur', 'up');
      /* Stagger only within a row of siblings, capped so nothing lags. */
      var idx = 0, p = el.previousElementSibling;
      while (p && idx < 5) { idx++; p = p.previousElementSibling; }
      if (idx) el.style.setProperty('--aur-delay', (idx * 70) + 'ms');
    });
  }

  function initReveals(scope) {
    if (!('IntersectionObserver' in window)) {
      $$('[data-aur]', scope).forEach(function (el) { el.classList.add('is-in'); });
      return;
    }
    tagReveals(scope);
    var targets = $$('[data-aur]:not(.is-in)', scope);
    if (!targets.length) return;

    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) {
        if (!en.isIntersecting) return;
        en.target.classList.add('is-in');
        io.unobserve(en.target);
      });
      /* threshold 0: a ratio-based threshold can never be met by an element
         taller than the viewport (see the same note in interaction-system.js). */
    }, { rootMargin: '0px 0px -6% 0px', threshold: 0 });

    targets.forEach(function (t) { io.observe(t); });
    onTeardown(function () { io.disconnect(); });

    /* Failsafe: whatever the observer misses within 2.2s becomes visible anyway,
       so content can never be stranded at opacity:0 (the old white-page class
       of bug). */
    var fs = setTimeout(function () {
      $$('[data-aur]', scope).forEach(function (el) {
        var r = el.getBoundingClientRect();
        if (r.top < window.innerHeight * 1.2) el.classList.add('is-in');
      });
    }, 2200);
    onTeardown(function () { clearTimeout(fs); });
  }

  /* =====================================================================
     2. AMBIENT BACKGROUNDS
     Injected into dark hero/section shells. Purely decorative children,
     appended first so existing content keeps its own stacking.
     ===================================================================== */
  /* Heroes and page-heading banners only: those are the two shells whose
     stacking (scrim at z-index 1, content at 3) is known and stable. */
  var AMBIENT_TARGETS = CFG.ambientTargets || '.cs-hero, .cs-page_heading';

  function makeAmbient(opts) {
    var wrap = doc.createElement('div');
    wrap.className = 'aur-ambient' + (opts.light ? ' aur-ambient--light' : '');
    wrap.setAttribute('aria-hidden', 'true');
    var html = '<span class="aur-ambient__blob aur-ambient__blob--a"></span>' +
      '<span class="aur-ambient__blob aur-ambient__blob--b"></span>';
    if (opts.rich) {
      html += '<span class="aur-ambient__blob aur-ambient__blob--c"></span>' +
        '<span class="aur-ambient__grid"></span>' +
        '<span class="aur-ambient__grain"></span>';
    }
    /* Scrim last: it must paint over every decorative layer in this wrapper.
       Light banners get no scrim — they need no help holding dark text. */
    if (!opts.light) html += '<span class="aur-ambient__scrim"></span>';
    wrap.innerHTML = html;
    return wrap;
  }

  function makeBubbleField(count) {
    var f = doc.createElement('div');
    f.className = 'aur-bubble-field';
    f.setAttribute('aria-hidden', 'true');
    var html = '';
    for (var i = 0; i < count; i++) {
      var size = 8 + Math.random() * 46;
      var left = Math.random() * 100;
      var dur = 16 + Math.random() * 22;
      var delay = -Math.random() * dur;
      var drift = (Math.random() * 160 - 80).toFixed(0);
      html += '<i style="width:' + size.toFixed(0) + 'px;height:' + size.toFixed(0) + 'px;left:' +
        left.toFixed(2) + '%;animation-duration:' + dur.toFixed(1) + 's;animation-delay:' +
        delay.toFixed(1) + 's;--aur-drift:' + drift + 'px"></i>';
    }
    f.innerHTML = html;
    return f;
  }

  /* Effective background luminance of an element: walk up until a non-transparent
     background colour is found, then use the sRGB luma formula. Used to pick the
     dark or light ambient treatment — painting the dark one onto a white banner
     turns it to grey mud and wrecks the headline contrast. */
  function bgLuminance(el) {
    var node = el;
    while (node && node !== doc.documentElement) {
      var c = window.getComputedStyle(node).backgroundColor;
      var m = /rgba?\(\s*(\d+)[,\s]+(\d+)[,\s]+(\d+)(?:[,\s/]+([\d.]+))?/.exec(c || '');
      if (m && (m[4] === undefined || parseFloat(m[4]) > 0.5)) {
        return (0.2126 * m[1] + 0.7152 * m[2] + 0.0722 * m[3]) / 255;
      }
      node = node.parentElement;
    }
    return 1; /* nothing opaque found → assume the page is light */
  }

  function initAmbient(scope) {
    if (!canDecorate()) return;
    var sections = $$(AMBIENT_TARGETS, scope);
    sections.forEach(function (sec, i) {
      if (sec.querySelector(':scope > .aur-ambient')) return;
      /* Only decorate genuinely large panels — small utility blocks look noisy. */
      if (sec.offsetHeight < 260) return;
      var light = bgLuminance(sec) > 0.5;
      var isMainHero = sec.classList.contains('cs-hero');
      sec.classList.add('aur-has-ambient');

      /* Lift the section's real content above the ambient layer — but ONLY the
         children that are currently `static`. Those are the ones a positioned
         ambient would otherwise paint over; static -> relative moves nothing.
         Already-positioned children are left completely alone: the theme has
         arranged them deliberately, and re-stacking them buries background
         layers (the hero image slider) or breaks overlay positioning. */
      Array.prototype.forEach.call(sec.children, function (kid) {
        if (kid.classList.contains('aur-ambient') || kid.classList.contains('aur-bubble-field')) return;
        if (window.getComputedStyle(kid).position !== 'static') return;
        kid.style.position = 'relative';
        kid.style.zIndex = '3';
      });

      sec.insertBefore(makeAmbient({ rich: isMainHero && !light, light: light }), sec.firstChild);
      if (isMainHero && !light && CFG.bubbles !== false && isDesktop()) {
        sec.insertBefore(makeBubbleField(14), sec.firstChild);
      }
    });
  }

  /* =====================================================================
     3. GLASS + SPOTLIGHT + TILT
     ===================================================================== */
  var CARD_TARGETS = CFG.cardTargets ||
    '.cs-iconbox, .cs-card, .cs-post, .cs-team, .cs-funfact, .cs-pricing_table,' +
    '.cs-service_card, .cs-resource_card, .cs-portfolio, .aur-stat';

  function initCards(scope) {
    if (!finePointer) return;
    var cards = $$(CARD_TARGETS, scope);
    if (!cards.length) return;

    cards.forEach(function (card) {
      if (card.__aurBound) return;
      card.__aurBound = true;
      card.classList.add('aur-spot');

      var tiltable = canDecorate() && card.offsetWidth > 180 && card.offsetHeight > 120;
      if (tiltable) card.classList.add('aur-tilt');

      var rect = null;
      var move = raf(function (x, y) {
        if (!rect) return;
        var px = (x - rect.left) / rect.width;
        var py = (y - rect.top) / rect.height;
        card.style.setProperty('--aur-mx', (px * 100).toFixed(1) + '%');
        card.style.setProperty('--aur-my', (py * 100).toFixed(1) + '%');
        if (tiltable) {
          var rx = (0.5 - py) * 7;
          var ry = (px - 0.5) * 9;
          card.style.transform = 'perspective(1000px) rotateX(' + rx.toFixed(2) +
            'deg) rotateY(' + ry.toFixed(2) + 'deg) translate3d(0,-6px,0)';
        }
      });

      function enter() { rect = card.getBoundingClientRect(); if (tiltable) card.classList.add('is-tilting'); }
      function pm(e) { move(e.clientX, e.clientY); }
      function leave() {
        rect = null;
        if (tiltable) { card.classList.remove('is-tilting'); card.style.transform = ''; }
      }

      on(card, 'pointerenter', enter);
      on(card, 'pointermove', pm);
      on(card, 'pointerleave', leave);
      onTeardown(function () {
        card.removeEventListener('pointerenter', enter);
        card.removeEventListener('pointermove', pm);
        card.removeEventListener('pointerleave', leave);
        card.__aurBound = false;
      });
    });
  }

  /* =====================================================================
     4. BUTTONS — magnetic pull, shine, ripple
     ===================================================================== */
  var BTN_TARGETS = CFG.buttonTargets ||
    '.cs-btn, .cs-newsletter_btn, .aur-cta, button.cs-btn';

  function initButtons(scope) {
    var btns = $$(BTN_TARGETS, scope);
    btns.forEach(function (b) {
      if (b.__aurBtn) return;
      b.__aurBtn = true;
      b.classList.add('aur-shine');

      /* Ripple works on every pointer type. */
      function ripple(e) {
        if (!canAnimate()) return;
        var r = b.getBoundingClientRect();
        var d = Math.max(r.width, r.height);
        var s = doc.createElement('span');
        s.className = 'aur-ripple';
        s.style.width = s.style.height = d + 'px';
        s.style.left = ((e.clientX || r.left + r.width / 2) - r.left - d / 2) + 'px';
        s.style.top = ((e.clientY || r.top + r.height / 2) - r.top - d / 2) + 'px';
        b.appendChild(s);
        setTimeout(function () { if (s.parentNode) s.parentNode.removeChild(s); }, 700);
      }
      on(b, 'pointerdown', ripple);

      /* Magnetic pull is desktop-only and subtle (max 6px). */
      if (finePointer && canDecorate()) {
        b.classList.add('aur-magnetic');
        var rect = null;
        var mv = raf(function (x, y) {
          if (!rect) return;
          var dx = (x - (rect.left + rect.width / 2)) / rect.width;
          var dy = (y - (rect.top + rect.height / 2)) / rect.height;
          b.style.transform = 'translate3d(' + (dx * 10).toFixed(1) + 'px,' + (dy * 8).toFixed(1) + 'px,0)';
        });
        on(b, 'pointerenter', function () { rect = b.getBoundingClientRect(); });
        on(b, 'pointermove', function (e) { mv(e.clientX, e.clientY); });
        on(b, 'pointerleave', function () { rect = null; b.style.transform = ''; });
      }
    });
  }

  /* =====================================================================
     5. READING PROGRESS
     ===================================================================== */
  function initProgress() {
    if (reduced) return;
    var bar = $('.aur-progress');
    if (!bar) {
      bar = doc.createElement('div');
      bar.className = 'aur-progress';
      bar.setAttribute('aria-hidden', 'true');
      bar.innerHTML = '<div class="aur-progress__bar"></div>';
      doc.body.appendChild(bar);
    }
    var inner = bar.firstElementChild;
    var update = raf(function () {
      var h = doc.documentElement.scrollHeight - window.innerHeight;
      var p = h > 40 ? Math.min(1, Math.max(0, window.pageYOffset / h)) : 0;
      inner.style.transform = 'scaleX(' + p.toFixed(4) + ')';
      bar.classList.toggle('is-on', window.pageYOffset > 120);
    });
    on(window, 'scroll', update, { passive: true });
    on(window, 'resize', update, { passive: true });
    update();
    onTeardown(function () {
      window.removeEventListener('scroll', update);
      window.removeEventListener('resize', update);
    });
  }

  /* =====================================================================
     6. COUNT-UP NUMBERS  —  <span data-count="120" data-suffix="+">0</span>
     ===================================================================== */
  function initCounters(scope) {
    var els = $$('[data-count]', scope).filter(function (e) { return !e.__aurCounted; });
    if (!els.length || !('IntersectionObserver' in window)) {
      els.forEach(function (e) { e.textContent = (e.dataset.prefix || '') + e.dataset.count + (e.dataset.suffix || ''); });
      return;
    }
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) {
        if (!en.isIntersecting) return;
        var el = en.target;
        io.unobserve(el);
        el.__aurCounted = true;
        var target = parseFloat(el.dataset.count) || 0;
        var dec = (el.dataset.count.split('.')[1] || '').length;
        var pre = el.dataset.prefix || '', suf = el.dataset.suffix || '';
        if (reduced) { el.textContent = pre + target.toFixed(dec) + suf; return; }
        var t0 = performance.now(), dur = 1500;
        (function step(now) {
          var p = Math.min(1, (now - t0) / dur);
          var eased = 1 - Math.pow(1 - p, 3);
          el.textContent = pre + (target * eased).toFixed(dec) + suf;
          if (p < 1) requestAnimationFrame(step);
        })(t0);
      });
    }, { threshold: 0.4 });
    els.forEach(function (e) { io.observe(e); });
    onTeardown(function () { io.disconnect(); });
  }

  /* =====================================================================
     7. PARALLAX  —  [data-aur-parallax="0.15"]
     ===================================================================== */
  function initParallax(scope) {
    if (!canDecorate() || !isDesktop()) return;
    var els = $$('[data-aur-parallax]', scope);
    if (!els.length) return;
    var update = raf(function () {
      var vh = window.innerHeight;
      els.forEach(function (el) {
        var r = el.getBoundingClientRect();
        if (r.bottom < -200 || r.top > vh + 200) return;
        var speed = parseFloat(el.dataset.aurParallax) || 0.12;
        var mid = r.top + r.height / 2 - vh / 2;
        el.style.transform = 'translate3d(0,' + (-mid * speed).toFixed(1) + 'px,0)';
      });
    });
    on(window, 'scroll', update, { passive: true });
    on(window, 'resize', update, { passive: true });
    update();
    onTeardown(function () {
      window.removeEventListener('scroll', update);
      window.removeEventListener('resize', update);
      els.forEach(function (el) { el.style.transform = ''; });
    });
  }

  /* =====================================================================
     8. HEADLINE WORD STAGGER  —  add class "aur-words" to any heading
     ===================================================================== */
  function initWords(scope) {
    $$('.aur-words', scope).forEach(function (h) {
      if (h.__aurWords) return;
      h.__aurWords = true;
      if (reduced) { h.classList.add('is-in'); return; }
      /* Only split plain-text headings — never touch nested markup. */
      if (h.children.length === 0) {
        var words = h.textContent.trim().split(/\s+/);
        h.textContent = '';
        words.forEach(function (w, i) {
          var s = doc.createElement('span');
          s.textContent = w + (i < words.length - 1 ? ' ' : '');
          s.style.transitionDelay = (i * 55) + 'ms';
          h.appendChild(s);
        });
      }
      if ('IntersectionObserver' in window) {
        var io = new IntersectionObserver(function (en) {
          if (en[0].isIntersecting) { h.classList.add('is-in'); io.disconnect(); }
        }, { threshold: 0.2 });
        io.observe(h);
        onTeardown(function () { io.disconnect(); });
      } else { h.classList.add('is-in'); }
    });
  }

  /* =====================================================================
     9. MARQUEE — duplicates the track so the loop is seamless
     ===================================================================== */
  function initMarquee(scope) {
    $$('.aur-marquee__track', scope).forEach(function (t) {
      if (t.__aurDup) return;
      t.__aurDup = true;
      t.setAttribute('aria-hidden', 'false');
      var clone = t.cloneNode(true);
      clone.setAttribute('aria-hidden', 'true');
      Array.prototype.forEach.call(clone.children, function (c) { c.setAttribute('aria-hidden', 'true'); });
      while (clone.firstChild) t.appendChild(clone.firstChild);
    });
  }

  /* =====================================================================
     10. CURSOR GLOW
     ===================================================================== */
  function initCursorGlow() {
    if (!finePointer || !canDecorate() || !isDesktop()) return;
    if ($('.aur-cursor-glow')) return;
    var g = doc.createElement('div');
    g.className = 'aur-cursor-glow';
    g.setAttribute('aria-hidden', 'true');
    doc.body.appendChild(g);
    var move = raf(function (x, y) {
      g.style.transform = 'translate3d(' + x + 'px,' + y + 'px,0)';
      g.classList.add('is-on');
    });
    function pm(e) { move(e.clientX, e.clientY); }
    on(doc, 'pointermove', pm, { passive: true });
    onTeardown(function () {
      doc.removeEventListener('pointermove', pm);
      if (g.parentNode) g.parentNode.removeChild(g);
    });
  }

  /* =====================================================================
     11. SMOOTH ANCHOR SCROLL (honours reduced-motion + fixed headers)
     ===================================================================== */
  function initAnchors() {
    function click(e) {
      var a = e.target.closest && e.target.closest('a[href^="#"]');
      if (!a) return;
      var id = a.getAttribute('href');
      if (!id || id === '#' || id.length < 2) return;
      var t;
      try { t = doc.querySelector(id); } catch (err) { return; }
      if (!t) return;
      e.preventDefault();
      var top = t.getBoundingClientRect().top + window.pageYOffset - 90;
      window.scrollTo({ top: top, behavior: reduced ? 'auto' : 'smooth' });
      /* Keep keyboard focus with the visual jump. */
      t.setAttribute('tabindex', '-1');
      t.focus({ preventScroll: true });
    }
    on(doc, 'click', click);
    onTeardown(function () { doc.removeEventListener('click', click); });
  }

  /* =====================================================================
     12. LAZY-LOADING / DECODING SAFETY NET
     Any image that is below the fold and has no loading attribute gets one.
     Cheap insurance for pages the build sweep didn't touch.
     ===================================================================== */
  function initImages(scope) {
    var imgs = $$('img', scope);
    imgs.forEach(function (img, i) {
      if (!img.hasAttribute('decoding')) img.setAttribute('decoding', 'async');
      if (img.hasAttribute('loading')) return;
      var r = img.getBoundingClientRect();
      if (r.top > window.innerHeight * 1.2) img.setAttribute('loading', 'lazy');
      else if (i === 0) img.setAttribute('fetchpriority', 'high');
    });
  }

  /* =====================================================================
     BOOT
     ===================================================================== */
  function boot(scope) {
    scope = scope || doc;
    try { initAmbient(scope); } catch (e) { }
    try { initReveals(scope); } catch (e) { }
    try { initCards(scope); } catch (e) { }
    try { initButtons(scope); } catch (e) { }
    try { initCounters(scope); } catch (e) { }
    try { initParallax(scope); } catch (e) { }
    try { initWords(scope); } catch (e) { }
    try { initMarquee(scope); } catch (e) { }
    try { initImages(scope); } catch (e) { }
  }

  function bootGlobal() {
    try { initProgress(); } catch (e) { }
    try { initCursorGlow(); } catch (e) { }
    try { initAnchors(); } catch (e) { }
  }

  root.classList.add('aur-js');

  function start() {
    bootGlobal();
    boot(doc);
  }

  if (doc.readyState === 'loading') on(doc, 'DOMContentLoaded', start);
  else start();

  /* AM is a classic multi-page site (no soft navigation), but late-injected
     content — slider clones, AJAX panels — can still call the refresh hook. */

  /* Expose a manual hook for pages that inject content later. */
  window.apexAurora = { refresh: boot, teardown: runTeardown };
})();
