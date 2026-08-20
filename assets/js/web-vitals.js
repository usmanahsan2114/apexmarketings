/* Apex Web Vitals tracking — sends LCP, INP, CLS to GA4 dataLayer
 * Loads web-vitals library and reports Core Web Vitals as GA4 events.
 * Requires GA4 to be already loaded via gtag.js
 */
(function() {
  if (typeof gtag !== 'function') return; // GA4 not loaded
  // Use Google's web-vitals CDN
  var s = document.createElement('script');
  s.type = 'module';
  s.textContent = "import {onCLS, onINP, onLCP, onFCP, onTTFB} from 'https://unpkg.com/web-vitals@4?module';" +
                  "function sendToGA4(metric){" +
                  "  gtag('event', metric.name, {" +
                  "    event_category: 'Web Vitals'," +
                  "    value: Math.round(metric.name==='CLS' ? metric.value*1000 : metric.value)," +
                  "    metric_id: metric.id," +
                  "    metric_value: metric.value," +
                  "    metric_delta: metric.delta," +
                  "    metric_rating: metric.rating" +
                  "  });" +
                  "}" +
                  "onLCP(sendToGA4);onINP(sendToGA4);onCLS(sendToGA4);onFCP(sendToGA4);onTTFB(sendToGA4);";
  document.head.appendChild(s);
})();
