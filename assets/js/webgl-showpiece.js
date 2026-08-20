/* ==========================================================================
   Apex Marketings — WebGL hero showpiece (3D network constellation, amber).
   The "elite" upgrade of Codex's 2D growth canvas, shown ONLY on capable
   desktops. Self-gating + graceful: reduced-motion / mobile / coarse-pointer /
   low-power / no-WebGL → never runs (Three.js never downloaded), the 2D canvas
   stays. Three.js is dynamically imported only after the gate passes + idle.
   ========================================================================== */
(function () {
  "use strict";

  // ---- per-site config ----
  var HERO_SEL = ".cs-hero";
  var NODE_COLOR = 0xffc83a;   // amber
  var LINE_COLOR = 0xf6b900;   // gold

  var THREE = null;
  var mq = window.matchMedia;
  function capable() {
    if (!mq) return false;
    if (mq("(prefers-reduced-motion: reduce)").matches) return false;
    if (!mq("(min-width: 1024px)").matches) return false;
    if (!mq("(pointer: fine)").matches) return false;
    if ((navigator.hardwareConcurrency || 4) < 4) return false;
    if (navigator.deviceMemory && navigator.deviceMemory < 4) return false;
    try { var t = document.createElement("canvas"); if (!(t.getContext("webgl") || t.getContext("experimental-webgl"))) return false; } catch (e) { return false; }
    return true;
  }
  if (!capable()) return;

  var DPR = Math.min(window.devicePixelRatio || 1, 2);
  var current = null;

  function Showpiece(canvas) {
    var renderer, scene, camera, group, raf = null, running = false, io = null;
    var parent = canvas.parentElement || document.body;
    var mouse = { x: 0, y: 0 }, target = { x: 0, y: 0 };
    var listeners = [], disposers = [];
    function on(el, ev, fn, opt) { el.addEventListener(ev, fn, opt); listeners.push([el, ev, fn]); }

    function build() {
      renderer = new THREE.WebGLRenderer({ canvas: canvas, alpha: true, antialias: true, powerPreference: "high-performance" });
      renderer.setPixelRatio(DPR);
      scene = new THREE.Scene();
      camera = new THREE.PerspectiveCamera(60, 1, 0.1, 100); camera.position.z = 22;
      group = new THREE.Group(); scene.add(group);
      var N = 150, R = 12, pos = new Float32Array(N * 3), nodes = [];
      for (var i = 0; i < N; i++) {
        var u = Math.random(), v = Math.random(), theta = u * Math.PI * 2, phi = Math.acos(2 * v - 1), r = R * (0.55 + Math.random() * 0.45);
        var x = r * Math.sin(phi) * Math.cos(theta), y = r * Math.sin(phi) * Math.sin(theta), z = r * Math.cos(phi);
        pos[i * 3] = x; pos[i * 3 + 1] = y; pos[i * 3 + 2] = z; nodes.push(new THREE.Vector3(x, y, z));
      }
      var pg = new THREE.BufferGeometry(); pg.setAttribute("position", new THREE.BufferAttribute(pos, 3));
      var pm = new THREE.PointsMaterial({ color: NODE_COLOR, size: 0.30, transparent: true, opacity: 0.92, blending: THREE.AdditiveBlending, depthWrite: false });
      group.add(new THREE.Points(pg, pm)); disposers.push(pg, pm);
      var lp = [], maxD = 4.3;
      for (var a = 0; a < N; a++) for (var b = a + 1; b < N; b++) { if (nodes[a].distanceTo(nodes[b]) < maxD) lp.push(nodes[a].x, nodes[a].y, nodes[a].z, nodes[b].x, nodes[b].y, nodes[b].z); }
      var lg = new THREE.BufferGeometry(); lg.setAttribute("position", new THREE.Float32BufferAttribute(lp, 3));
      var lm = new THREE.LineBasicMaterial({ color: LINE_COLOR, transparent: true, opacity: 0.18, blending: THREE.AdditiveBlending, depthWrite: false });
      group.add(new THREE.LineSegments(lg, lm)); disposers.push(lg, lm);
    }
    function resize() { var r = canvas.getBoundingClientRect(); if (r.width < 1 || r.height < 1) return; renderer.setSize(r.width, r.height, false); camera.aspect = r.width / r.height; camera.updateProjectionMatrix(); }
    function frame() {
      if (!running) return;
      target.x += (mouse.x - target.x) * 0.05; target.y += (mouse.y - target.y) * 0.05;
      group.rotation.y += 0.0015; group.rotation.x = target.y * 0.28; group.rotation.z = target.x * 0.04;
      camera.position.x = target.x * 2.4; camera.position.y = -target.y * 1.8; camera.lookAt(scene.position);
      renderer.render(scene, camera); raf = requestAnimationFrame(frame);
    }
    function start() { if (!running) { running = true; raf = requestAnimationFrame(frame); } }
    function stop() { running = false; if (raf) cancelAnimationFrame(raf); raf = null; }
    function onMove(e) { var r = parent.getBoundingClientRect(); mouse.x = ((e.clientX - r.left) / r.width) * 2 - 1; mouse.y = ((e.clientY - r.top) / r.height) * 2 - 1; }

    this.init = function () {
      build();
      canvas.classList.add("is-on");
      resize();
      on(window, "resize", resize, { passive: true });
      on(parent, "mousemove", onMove, { passive: true });
      on(document, "visibilitychange", function () { document.hidden ? stop() : start(); });
      io = ("IntersectionObserver" in window) ? new IntersectionObserver(function (es) { es.forEach(function (en) { en.isIntersecting ? start() : stop(); }); }, { rootMargin: "120px" }) : null;
      if (io) io.observe(canvas);
      requestAnimationFrame(function () { resize(); canvas.classList.add("is-visible"); });
      start();
    };
    this.destroy = function () {
      stop(); listeners.forEach(function (l) { l[0].removeEventListener(l[1], l[2]); }); listeners = [];
      if (io) io.disconnect(); disposers.forEach(function (d) { try { d.dispose(); } catch (e) {} });
      try { renderer.dispose(); } catch (e) {}
    };
  }

  function boot() {
    var hero = document.querySelector(HERO_SEL);
    if (!hero) return;
    var canvas = hero.querySelector(".apex-webgl-canvas");
    if (!canvas) {
      canvas = document.createElement("canvas");
      canvas.className = "apex-webgl-canvas";
      canvas.setAttribute("aria-hidden", "true");
      hero.insertBefore(canvas, hero.firstChild);
    }
    try {
      var inst = new Showpiece(canvas);
      inst.init();
      current = inst;
      document.documentElement.classList.add("apex-webgl-on"); // CSS hides Codex's 2D .interactive-scene
      window.__apexWebGLActive = true;                          // Codex's draw loop self-stops on this flag
    } catch (e) {
      try { if (current) current.destroy(); } catch (e2) {}
      current = null;
      window.__apexWebGLActive = false;
      document.documentElement.classList.remove("apex-webgl-on");
    }
  }

  function loadAndBoot() {
    if (!document.querySelector(HERO_SEL)) return; // homepage hero only → don't fetch Three.js elsewhere
    import("./vendor/three.module.min.js").then(function (mod) { THREE = mod; boot(); }).catch(function () {});
  }
  function ready() {
    function go() { loadAndBoot(); }
    if (window.requestIdleCallback) requestIdleCallback(go, { timeout: 1500 }); else setTimeout(go, 1200);
  }
  if (document.readyState === "loading") document.addEventListener("DOMContentLoaded", ready); else ready();
})();
