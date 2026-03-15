<?php
/**
 * Front Page Template - ClearGreen
 * Dark modern design inspired by Gatekeeper Titan
 */
get_header();

// ─── CMS helper: uses bcms_get() / bcms_arr() from inc/meta-boxes.php ───
$fp_id = (int) get_option('page_on_front');
?>

<style>
/* ===== ClearGreen Front Page — Titan-inspired Dark ===== */
.fp {
  --green: #bcd642;
  --green-dark: #9ab835;
  --blue: #2f86b2;
  --dark-1: #0a0e1a;
  --dark-2: #0e1525;
  --dark-3: #131b2e;
  --dark-card: rgba(255,255,255,.04);
  --dark-border: rgba(255,255,255,.08);
  --text: rgba(255,255,255,.8);
  --text-muted: rgba(255,255,255,.6);
  --accent-glow: rgba(188,214,66,.12);
  --blue-glow: rgba(47,134,178,.1);
  --radius: 18px;
  --radius-lg: 28px;
  font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
  color: #fff;
  overflow: hidden;
  position: relative;
}

/* Global BG gradient */
.fp::before {
  content:''; position:fixed; inset:0; z-index:-1;
  background:
    radial-gradient(ellipse at 20% 0%, rgba(188,214,66,.08) 0%, transparent 50%),
    radial-gradient(ellipse at 80% 20%, rgba(47,134,178,.07) 0%, transparent 45%),
    radial-gradient(ellipse at 40% 80%, rgba(188,214,66,.05) 0%, transparent 50%),
    linear-gradient(180deg, var(--dark-1) 0%, var(--dark-2) 40%, var(--dark-3) 100%);
}

*, *::before, *::after { box-sizing:border-box }

/* Scroll animations */
.fp-a { opacity:0; transform:translateY(44px); transition:opacity .85s cubic-bezier(.22,1,.36,1), transform .85s cubic-bezier(.22,1,.36,1) }
.fp-a.d1 { transition-delay:.1s } .fp-a.d2 { transition-delay:.2s }
.fp-a.d3 { transition-delay:.3s } .fp-a.d4 { transition-delay:.4s }
.fp-a.d5 { transition-delay:.5s }
.fp-a.vis { opacity:1; transform:translateY(0) }

@keyframes heroFade { from { opacity:0; transform:translateY(30px) } to { opacity:1; transform:translateY(0) } }
@keyframes pulse { 0%,100% { opacity:.4 } 50% { opacity:1 } }
@keyframes float { 0%,100% { transform:translateY(0) } 50% { transform:translateY(-10px) } }

/* Layout */
.fp-sec { padding:120px 0 }
.fp-w { width:90%; max-width:var(--max); margin:0 auto; padding:0 }

/* Accent text */
.text-acc { color:var(--green) }
.grad-text {
  background:linear-gradient(135deg, var(--green), var(--blue));
  -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;
}

/* Tag/badge */
.fp-tag {
  display:inline-flex; align-items:center; gap:8px;
  padding:8px 20px; border-radius:100px;
  background:rgba(188,214,66,.08); border:1px solid rgba(188,214,66,.15);
  color:var(--green); font-size:.72rem; font-weight:700;
  text-transform:uppercase; letter-spacing:2.5px;
}
.fp-tag::before {
  content:''; width:6px; height:6px; border-radius:50%;
  background:var(--green); animation:pulse 2s ease infinite;
}

/* Headings */
.fp-h2 {
  font-size:clamp(2.2rem,4.5vw,3.6rem); font-weight:700;
  color:#fff; line-height:1.2; margin:18px 0 22px;
  letter-spacing: -0.01em;
  word-spacing: 0.2em;
}
.fp-h3 {
  font-size:clamp(1.6rem,3vw,2.4rem); font-weight:700;
  color:#fff; line-height:1.2; margin:16px 0 18px;
  letter-spacing: -0.01em;
  word-spacing: 0.2em;
}
.fp-p { font-size:1.08rem; color:var(--text); line-height:1.8; margin:0 }
.fp-p strong { font-weight:700; color:var(--green) }

/* Button */
.fp-btn {
  display:inline-flex; align-items:center; gap:10px;
  padding:16px 38px; border-radius:100px; border:none;
  font-weight:700; font-size:.9rem; cursor:pointer;
  text-decoration:none; background:var(--green); color:var(--dark-1);
  transition:all .35s cubic-bezier(.22,1,.36,1);
  box-shadow:0 6px 24px rgba(188,214,66,.2);
}
.fp-btn:hover {
  transform:translateY(-3px);
  box-shadow:0 16px 44px rgba(188,214,66,.3);
  color:var(--dark-1);
}
.fp-btn i { transition:transform .3s }
.fp-btn:hover i { transform:translateX(4px) }
.fp-btn--ghost {
  background:transparent; color:#fff;
  border:1.5px solid var(--dark-border); box-shadow:none;
}
.fp-btn--ghost:hover {
  border-color:rgba(255,255,255,.25); color:#fff;
  box-shadow:0 8px 24px rgba(0,0,0,.2); background:rgba(255,255,255,.04);
}

/* ==================== HERO ==================== */
.fp-hero {
  position:relative; min-height:100vh; min-height:100svh;
  display:flex; align-items:center; justify-content:center;
  text-align:center; padding:140px 0 100px;
  overflow:hidden;
}
.fp-hero::before {
  content:''; position:absolute; inset:0; z-index:0;
  background:
    radial-gradient(ellipse at 30% 20%, rgba(188,214,66,.12) 0%, transparent 50%),
    radial-gradient(ellipse at 70% 30%, rgba(47,134,178,.1) 0%, transparent 45%),
    radial-gradient(ellipse at 50% 80%, rgba(188,214,66,.06) 0%, transparent 50%);
  pointer-events:none;
}
.fp-hero-content {
  width:90%; margin-left:auto; margin-right:auto;
  position:relative; z-index:2;
  animation:heroFade 1s cubic-bezier(.22,1,.36,1) .2s both;
}
.fp-hero h1 {
  font-size:clamp(2.5rem,10vw,4.8rem); font-weight:700;
  line-height:1.15; margin:24px 0 36px; color:#fff;
  letter-spacing: -0.02em;
}
.fp-hero-desc {
  font-size:clamp(0.95rem,1.8vw,1.15rem); color:var(--text); line-height:1.7;
  margin-bottom:48px; max-width:680px; margin-left:auto; margin-right:auto;
}
.fp-hero-sep {
  width:60px; height:2px; margin:0 auto 36px;
  background:linear-gradient(90deg, var(--green), var(--blue));
  border-radius:2px;
}
.fp-hero-btns { display:flex; gap:14px; justify-content:center; flex-wrap:wrap }

/* Hero stats */
.fp-hero-stats {
  display:flex; gap:0; justify-content:center; margin-top:60px;
  border:1px solid var(--dark-border); border-radius:16px;
  overflow:hidden; background:var(--dark-card);
  backdrop-filter:blur(16px); -webkit-backdrop-filter:blur(16px);
}
.fp-hero-stat {
  flex:1; padding:24px 28px; text-align:center;
  border-right:1px solid var(--dark-border);
}
.fp-hero-stat:last-child { border-right:none }
.fp-hero-stat strong {
  display:block; font-size:1.6rem; font-weight:700; color:var(--green);
}
.fp-hero-stat span { font-size:.72rem; color:var(--text-muted); text-transform:uppercase; letter-spacing:1.5px; font-weight:600 }

/* ==================== ABOUT ==================== */
.fp-about-grid {
  display:grid; grid-template-columns:1fr 1fr; gap:80px; align-items:center;
}
.fp-about-visual { position:relative }
.fp-about-img {
  width:100%; border-radius:var(--radius-lg); display:block;
  border:1px solid var(--dark-border);
  box-shadow:0 32px 80px rgba(0,0,0,.3);
}
.fp-about-badge {
  position:absolute; bottom:-20px; right:-20px; z-index:3;
  width:120px; height:120px; border-radius:22px;
  background:linear-gradient(135deg, var(--green), var(--blue));
  display:flex; flex-direction:column; align-items:center; justify-content:center;
  box-shadow:0 16px 48px rgba(188,214,66,.25);
  animation:float 4s ease infinite;
}
.fp-about-badge strong { font-size:1.8rem; font-weight:800; color:#fff }
.fp-about-badge span { font-size:.65rem; font-weight:600; color:rgba(255,255,255,.85); text-align:center; line-height:1.3 }
.fp-about-text .fp-p + .fp-p { margin-top:16px }

/* ==================== WHY US (legacy — kept for reference) ==================== */

/* ==================== SERVICES ==================== */
.fp-services-head { text-align:center; margin-bottom:72px }
.fp-services-head .fp-p { max-width:600px; margin:0 auto }
.fp-services-grid {
  display:grid; grid-template-columns:repeat(3,1fr); gap:18px;
}
.fp-svc {
  background:var(--dark-card); border:1px solid var(--dark-border);
  border-radius:var(--radius); overflow:hidden;
  transition:all .4s cubic-bezier(.22,1,.36,1);
}
.fp-svc:hover {
  transform:translateY(-8px);
  border-color:rgba(188,214,66,.2);
  box-shadow:0 24px 64px rgba(0,0,0,.15), 0 0 0 1px rgba(188,214,66,.1);
}
.fp-svc-img-wrap { overflow:hidden; position:relative }
.fp-svc-img-wrap::after {
  content:''; position:absolute; bottom:0; left:0; right:0; height:40%;
  background:linear-gradient(to top, var(--dark-1), transparent);
  pointer-events:none;
}
.fp-svc-img {
  width:100%; aspect-ratio:16/10; object-fit:cover; display:block;
  transition:transform .5s cubic-bezier(.22,1,.36,1);
}
.fp-svc:hover .fp-svc-img { transform:scale(1.06) }
.fp-svc-body { padding:26px 26px 30px }
.fp-svc h3 {
  font-size:1.15rem; font-weight:700; color:#fff;
  margin:0 0 12px; letter-spacing:-.01em;
}
.fp-svc p { font-size:.95rem; color:var(--text); line-height:1.75; margin:0 }

/* ==================== CTA BANNER ==================== */
.fp-cta {
  position:relative; border-radius:var(--radius-lg); overflow:hidden;
  padding:72px 64px;
  background:linear-gradient(135deg, rgba(188,214,66,.1) 0%, rgba(47,134,178,.08) 100%);
  border:1px solid rgba(188,214,66,.15);
  display:flex; align-items:center; justify-content:space-between; gap:40px;
}
.fp-cta::before {
  content:''; position:absolute; top:-40%; right:-5%;
  width:500px; height:500px; border-radius:50%;
  background:radial-gradient(circle, rgba(188,214,66,.1) 0%, transparent 60%);
}
.fp-cta h3 {
  font-size:clamp(1.5rem,3vw,2.1rem); font-weight:800;
  color:#fff; margin:0; line-height:1.3; max-width:560px;
  position:relative; z-index:1;
}
.fp-cta h3 em { font-style:normal; color:var(--green) }
.fp-cta .fp-btn { position:relative; z-index:1; flex-shrink:0 }

/* ==================== PROCESS ==================== */
.fp-process-head {
  display:flex; align-items:flex-end; justify-content:space-between;
  margin-bottom:72px; gap:32px;
}
.fp-steps {
  display:grid; grid-template-columns:repeat(3,1fr); gap:24px; position:relative;
}
.fp-steps::before {
  content:''; position:absolute; top:40px; left:12%; right:12%;
  height:1px; background:linear-gradient(90deg, var(--green), var(--blue));
  opacity:.15; z-index:0;
}
.fp-step {
  text-align:center; padding:0 16px; position:relative; z-index:1;
}
.fp-step-num {
  width:80px; height:80px; border-radius:50%;
  background:var(--dark-card); border:2px solid var(--dark-border);
  display:inline-flex; align-items:center; justify-content:center;
  font-weight:800; font-size:1.3rem; color:rgba(255,255,255,.3);
  margin:0 auto 28px;
  transition:all .7s cubic-bezier(.22,1,.36,1);
}
/* Lit-up state when scrolled into view */
.fp-step.vis .fp-step-num {
  background:var(--green); border-color:var(--green); color:var(--dark-1);
  box-shadow:0 0 0 8px rgba(188,214,66,.15), 0 12px 36px rgba(188,214,66,.25);
  animation:numGlow 1.8s ease .2s;
}
@keyframes numGlow {
  0% { box-shadow:0 0 0 0 rgba(188,214,66,.5), 0 12px 36px rgba(188,214,66,.25) }
  50% { box-shadow:0 0 0 20px rgba(188,214,66,0), 0 12px 36px rgba(188,214,66,.25) }
  100% { box-shadow:0 0 0 8px rgba(188,214,66,.15), 0 12px 36px rgba(188,214,66,.25) }
}
.fp-step:hover .fp-step-num {
  transform:scale(1.08);
  box-shadow:0 0 0 12px rgba(188,214,66,.12), 0 16px 44px rgba(188,214,66,.3);
}
.fp-step h3 {
  font-size:1.15rem; font-weight:700; color:#fff;
  margin:0 0 14px;
}
.fp-step p { font-size:.95rem; color:var(--text); line-height:1.75; margin:0 }

/* ==================== TESTIMONIALS ==================== */
.fp-test-head { text-align:center; margin-bottom:64px }
.fp-test-grid {
  display:grid; grid-template-columns:repeat(3,1fr); gap:18px;
}
.fp-tcard {
  background:var(--dark-card); border:1px solid var(--dark-border);
  border-radius:var(--radius); padding:36px;
  position:relative; transition:all .35s cubic-bezier(.22,1,.36,1);
  display:flex; flex-direction:column;
}
.fp-tcard:hover {
  transform:translateY(-6px);
  border-color:rgba(188,214,66,.2);
  box-shadow:0 20px 56px rgba(0,0,0,.12);
}
.fp-tcard-stars { margin-bottom:18px; color:var(--green); font-size:.85rem; letter-spacing:3px }
.fp-tcard-q {
  font-size:.92rem; color:var(--text); line-height:1.8;
  margin-bottom:26px; flex:1;
}
.fp-tcard-author {
  display:flex; align-items:center; gap:14px;
  padding-top:22px; border-top:1px solid var(--dark-border);
}
.fp-tcard-av {
  width:44px; height:44px; border-radius:12px;
  background:var(--green); display:flex; align-items:center; justify-content:center;
  font-weight:800; font-size:.78rem; color:var(--dark-1); flex-shrink:0;
}
.fp-tcard-logo {
  width:84px; height:64px; border-radius:14px; object-fit:cover;
  background:rgb(255,252,252); padding:6px; flex-shrink:0;
}
.fp-tcard-name { font-weight:700; color:#fff; font-size:.88rem }

/* ==================== CONTACT ==================== */
.fp-contact-grid {
  display:grid; grid-template-columns:1fr 1.2fr; gap:72px; align-items:start;
}
.fp-contact-info .fp-p { margin-bottom:40px }
.fp-ci {
  display:flex; align-items:center; gap:18px; margin-bottom:14px;
  padding:18px 22px; border-radius:16px;
  background:var(--dark-card); border:1px solid var(--dark-border);
  transition:all .35s cubic-bezier(.22,1,.36,1);
}
.fp-ci:hover {
  border-color:rgba(188,214,66,.25);
  box-shadow:0 8px 28px rgba(188,214,66,.08);
  transform:translateX(6px);
}
.fp-ci-icon {
  width:48px; height:48px; border-radius:14px;
  background:var(--green); display:flex; align-items:center; justify-content:center;
  font-size:1rem; color:var(--dark-1); flex-shrink:0;
}
.fp-ci a {
  color:var(--text); font-size:.95rem; text-decoration:none;
  font-weight:600; transition:color .2s;
}
.fp-ci a:hover { color:var(--green) }

.fp-form {
  background:var(--dark-card); border:1px solid var(--dark-border);
  border-radius:var(--radius-lg); padding:48px;
}
.fp-form-title { font-size:1.2rem; font-weight:700; color:#fff; margin:0 0 8px }
.fp-form-sub { font-size:.88rem; color:var(--text-muted); margin:0 0 28px }
.fp-frow { display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-bottom:14px }
.fp-frow--full { grid-template-columns:1fr }
.fp-form input,
.fp-form textarea {
  width:100%; padding:16px 22px; border:1.5px solid var(--dark-border);
  border-radius:14px; font-size:.92rem; font-family:inherit;
  background:rgba(255,255,255,.03); color:#fff;
  transition:all .3s; box-sizing:border-box;
}
.fp-form input:focus,
.fp-form textarea:focus {
  outline:none; border-color:var(--green);
  box-shadow:0 0 0 4px rgba(188,214,66,.08);
  background:rgba(255,255,255,.05);
}
.fp-form input::placeholder,
.fp-form textarea::placeholder { color:var(--text-muted) }
.fp-form textarea { resize:vertical; min-height:140px }
.fp-form .fp-btn { width:100%; justify-content:center; margin-top:8px }

/* ==================== WHY US CARDS ==================== */
.fp-why-dark { background:rgba(0,0,0,.15) }
.fp-why-cards {
  display:grid; grid-template-columns:repeat(3,1fr); gap:18px;
}
.fp-why-card {
  background:var(--dark-card); border:1px solid var(--dark-border);
  border-radius:var(--radius); padding:32px 28px;
  transition:all .4s cubic-bezier(.22,1,.36,1);
}
.fp-why-card:hover {
  transform:translateY(-6px);
  border-color:rgba(188,214,66,.25);
  box-shadow:0 20px 56px rgba(0,0,0,.12);
}
.fp-why-card-icon {
  width:52px; height:52px; border-radius:14px;
  background:linear-gradient(135deg, var(--green), var(--blue));
  display:inline-flex; align-items:center; justify-content:center;
  font-size:1.2rem; color:var(--dark-1); margin-bottom:18px;
  box-shadow:0 8px 24px rgba(188,214,66,.2);
}
.fp-why-card-title { font-size:1.1rem; font-weight:700; color:#fff; margin:0 0 10px }
.fp-why-card-desc { font-size:.9rem; color:var(--text); line-height:1.7; margin:0 0 16px }
.fp-why-card-tags { display:flex; flex-wrap:wrap; gap:8px }
.fp-pill {
  display:inline-block; padding:4px 14px; border-radius:100px;
  border:1px solid rgba(188,214,66,.3); color:var(--green);
  font-size:.72rem; font-weight:600; letter-spacing:.5px;
}

/* ==================== SERVICE CARDS — NO IMAGE VARIANT ==================== */
.fp-svc-for {
  display:block; margin-top:12px;
  font-size:.78rem; color:var(--text-muted); font-weight:600;
  letter-spacing:.3px;
}
.fp-svc-link {
  display:inline-flex; align-items:center; gap:6px; margin-top:14px;
  color:var(--green); font-weight:700; font-size:.85rem;
  text-decoration:none; transition:gap .3s;
}
.fp-svc-link:hover { gap:10px }
.fp-svc--featured { border-color:rgba(188,214,66,.2); background:rgba(188,214,66,.04) }

/* ==================== RESPONSIVE ==================== */
@media (max-width:1024px) {
  .fp-about-grid, .fp-contact-grid { grid-template-columns:1fr; gap:48px }
  .fp-why-cards { grid-template-columns:repeat(2,1fr) }
  .fp-services-grid { grid-template-columns:repeat(2,1fr) }
  .fp-test-grid { grid-template-columns:repeat(2,1fr) }
  .fp-steps::before { display:none }
  .fp-steps { grid-template-columns:repeat(2,1fr); gap:32px }
  .fp-cta { flex-direction:column; text-align:center; padding:52px 36px }
  .fp-process-head { flex-direction:column; align-items:flex-start }
  .fp-about-badge { bottom:-14px; right:-14px; width:100px; height:100px }
}
@media (max-width:640px) {
  .fp-sec { padding:80px 0 }
  .fp-hero { min-height:auto; padding:120px 24px 80px }
  .fp-hero-stats { flex-direction:column; border-radius:14px }
  .fp-hero-stat { border-right:none; border-bottom:1px solid var(--dark-border) }
  .fp-hero-stat:last-child { border-bottom:none }
  .fp-services-grid, .fp-steps, .fp-test-grid, .fp-why-cards { grid-template-columns:1fr }
  .fp-frow { grid-template-columns:1fr }
  .fp-cta { margin:0 8px; border-radius:20px; padding:40px 24px }
  .fp-about-badge { display:none }
  .fp-form { padding:32px 24px }
  .fp-why-list li { padding:14px 16px }
}
@media (max-width:400px) {
  .fp-w { padding:0 20px }
}

/* ==================== FOOTER DARK OVERRIDE ==================== */
.footer-main {
  background:#0a0e1a !important;
  border-top:1px solid rgba(255,255,255,.06) !important;
  padding:48px 0 0 !important;
}
.footer-brandname { color:#bcd642 !important }
.footer-desc { color:rgba(255,255,255,.5) !important }
.footer-newsletter-title { color:#bcd642 !important }
.footer-newsletter-input {
  background:rgba(255,255,255,.04) !important;
  border-color:rgba(255,255,255,.1) !important;
  color:#fff !important;
}
.footer-newsletter-input:focus { border-color:#bcd642 !important }
.footer-newsletter-input::placeholder { color:rgba(255,255,255,.35) !important }
.footer-sep { border-top-color:rgba(255,255,255,.06) !important }
.footer-copyright { color:rgba(255,255,255,.45) !important }
.footer-copyright a { color:#bcd642 !important }
.footer-social-icon {
  background:rgba(255,255,255,.06) !important;
  color:rgba(255,255,255,.6) !important;
}
.footer-social-icon:hover {
  background:#bcd642 !important;
  color:#0a0e1a !important;
}
.footer-main .custom-logo-link img,
.footer-logo .custom-logo-link img,
.custom-logo-link-footer img {
  filter:none !important;
  background:transparent !important;
  border-radius:0 !important;
  border:none !important;
  box-shadow:none !important;
  padding:0 !important;
  content:url('/wp-content/uploads/2026/03/Nenaslovljeni-dizajn1.png') !important;
  width:150px !important; height:auto !important; max-height:none !important;
  object-fit:contain !important;
}
.footer-logo .custom-logo-link img,
.custom-logo-link-footer img {
  height:auto !important; max-height:none !important;
}

/* ==================== HEADER — TRANSPARENT, FLOATS OVER HERO ==================== */
.site-header {
  background:transparent !important;
  box-shadow:none !important;
  border-bottom:none !important;
  position:absolute !important;
  top:0 !important; left:0 !important; right:0 !important;
  z-index:100 !important;
}
.header-inner {
  width:90% !important;
}
.menu-list li a {
  color:rgba(255,255,255,.7) !important;
  font-weight:500 !important;
}
.menu-list li a:hover,
.menu-list li.current-menu-item > a { color:#bcd642 !important }
.site-title { color:#bcd642 !important }
/* Dropdown */
.menu-list li ul {
  background:rgba(14,21,37,.95) !important;
  backdrop-filter:blur(16px) !important; -webkit-backdrop-filter:blur(16px) !important;
  border:1px solid rgba(255,255,255,.08) !important;
  box-shadow:0 16px 48px rgba(0,0,0,.5) !important;
}
.menu-list li ul li a { color:rgba(255,255,255,.65) !important }
.menu-list li ul li a:hover {
  background:rgba(188,214,66,.08) !important;
  color:#bcd642 !important;
}
/* CTA button */
.btn.btn-primary {
  background:#bcd642 !important;
  color:#0a0e1a !important;
  box-shadow:0 4px 16px rgba(188,214,66,.2) !important;
}
.btn.btn-primary:hover {
  background:#a9c64e !important;
  color:#0a0e1a !important;
  box-shadow:0 8px 28px rgba(188,214,66,.3) !important;
}
/* Logo */
.custom-logo-link img,
.site-branding img,
.footer-logo img,
.footer-main img {
  filter:none !important;
  background:transparent !important;
  border-radius:0 !important;
  border:none !important;
  box-shadow:none !important;
  padding:0 !important;
}
.site-branding .custom-logo-link img {
  content:url('/wp-content/uploads/2026/03/Nenaslovljeni-dizajn1.png') !important;
  width:150px !important; height:auto !important; max-height:none !important;
  object-fit:contain !important;
}

/* ==================== HAMBURGER ==================== */
.hamburger {
  display:none !important;
  flex-direction:column !important;
  justify-content:center !important;
  align-items:center !important;
  gap:5px !important;
  width:48px !important; height:48px !important;
  background:rgba(255,255,255,.06) !important;
  border:1px solid rgba(255,255,255,.1) !important;
  border-radius:14px !important;
  cursor:pointer !important;
  z-index:12001 !important;
  box-shadow:none !important;
  transition:all .25s !important;
}
.hamburger:hover {
  background:rgba(255,255,255,.1) !important;
  border-color:rgba(255,255,255,.18) !important;
}
.hamburger span {
  display:block !important;
  width:28px !important; height:2px !important;
  border-radius:2px !important;
  background:#fff !important;
  filter:none !important;
  border:none !important;
  padding:0 !important;
  content:normal !important;
  transition:all .25s !important;
}
.hamburger.is-active span:nth-child(1) { transform:translateY(7px) rotate(45deg) !important }
.hamburger.is-active span:nth-child(2) { opacity:0 !important }
.hamburger.is-active span:nth-child(3) { transform:translateY(-7px) rotate(-45deg) !important }
@media (max-width:900px) {
  .hamburger { display:flex !important; margin:0 !important; padding:0 !important; box-sizing:border-box !important; }
  .site-header { padding: 16px 0 !important; }
  .header-inner { box-sizing: border-box !important; align-items: center !important; }
  .site-branding .custom-logo-link img { width: 130px !important; height: auto !important; }
}

/* ==================== MOBILE OVERLAY ==================== */
.mobile-overlay-menu {
  background:rgba(10,14,26,.97) !important;
  backdrop-filter:blur(24px) !important;
  -webkit-backdrop-filter:blur(24px) !important;
}
.mobile-overlay-menu.active {
  opacity:1 !important;
  pointer-events:all !important;
}
/* Mobile header bar */
.mobile-overlay-header {
  position:absolute !important;
  top:0 !important; left:0 !important; right:0 !important;
  width:100% !important; max-width:none !important;
  padding:24px 28px !important;
  display:flex !important; align-items:center !important;
  justify-content:space-between !important;
  z-index:12001 !important;
  border-bottom:1px solid rgba(255,255,255,.06) !important;
}
.mobile-overlay-header .custom-logo-link img,
.mobile-overlay-logo .custom-logo-link img,
.mobile-overlay-header .custom-logo img {
  content:url('/wp-content/uploads/2026/03/Nenaslovljeni-dizajn1.png') !important;
  width:120px !important; height:auto !important; max-height:none !important;
}
/* Close button */
.mobile-overlay-close {
  background:rgba(255,255,255,.06) !important;
  border:1px solid rgba(255,255,255,.1) !important;
  width:48px !important; height:48px !important;
  border-radius:14px !important;
  font-size:24px !important;
  color:rgba(255,255,255,.7) !important;
  -webkit-text-fill-color:rgba(255,255,255,.7) !important;
  display:flex !important; align-items:center !important; justify-content:center !important;
  padding:0 !important;
  position:static !important;
  z-index:12002 !important;
  cursor:pointer !important;
  transition:all .25s !important;
  line-height:1 !important;
  box-shadow:none !important;
  appearance:none !important;
}
.mobile-overlay-close:hover {
  background:#bcd642 !important;
  color:#0a0e1a !important;
  -webkit-text-fill-color:#0a0e1a !important;
  border-color:transparent !important;
}
/* Mobile nav links */
.mobile-menu-list {
  gap:28px !important;
}
.mobile-menu-list li a {
  color:rgba(255,255,255,.75) !important;
  -webkit-text-fill-color:rgba(255,255,255,.75) !important;
  font-size:1.5rem !important;
  font-weight:600 !important;
  letter-spacing:.5px !important;
  transition:color .2s !important;
}
.mobile-menu-list li a:hover {
  color:#bcd642 !important;
  -webkit-text-fill-color:#bcd642 !important;
}
/* Mobile dropdown */
.mobile-menu-list li ul li a {
  font-size:1.1rem !important;
  font-weight:500 !important;
  color:rgba(255,255,255,.5) !important;
  -webkit-text-fill-color:rgba(255,255,255,.5) !important;
}
.mobile-menu-list .menu-item-has-children > a::after {
  color:#bcd642 !important;
  -webkit-text-fill-color:#bcd642 !important;
}
</style>

<div class="fp">

<!-- ==================== HERO ==================== -->
<section class="fp-hero">
  <div class="fp-hero-content">
    <div class="fp-tag"><?php echo esc_html(bcms_get('bcms_fp_hero_tag', 'ClearGreen Solutions', $fp_id)); ?></div>
    <h1><?php echo wp_kses_post(bcms_get('bcms_fp_hero_title', 'Povjerenje počinje<br><span class="text-acc">provjerenim</span> identitetom.', $fp_id)); ?></h1>
    <div class="fp-hero-sep"></div>
    <p class="fp-hero-desc"><?php echo wp_kses_post(bcms_get('bcms_fp_hero_desc', 'Digitalna identifikacija, kontrola pristupa i automatizacija poslovanja &mdash;<br>za sektore gdje greška košta reputacije.', $fp_id)); ?></p>
    <div class="fp-hero-btns">
      <a href="<?php echo esc_url(bcms_get('bcms_fp_hero_btn1_url', '#kontakt', $fp_id)); ?>" class="fp-btn"><?php echo esc_html(bcms_get('bcms_fp_hero_btn1_text', 'Kontaktirajte nas', $fp_id)); ?> <i class="fas fa-arrow-right"></i></a>
    </div>
    <?php
    $hero_stats = bcms_arr('bcms_fp_hero_stats', $fp_id);
    if (empty($hero_stats)) {
        $hero_stats = [
            ['number' => '50+', 'label' => 'Klijenata'],
            ['number' => '99.9%', 'label' => 'Uptime'],
            ['number' => '24h', 'label' => 'Pilot setup'],
            ['number' => '5+', 'label' => 'Godina'],
        ];
    }
    ?>
    <div class="fp-hero-stats">
      <?php foreach ($hero_stats as $stat): ?>
        <div class="fp-hero-stat"><strong><?php echo esc_html($stat['number']); ?></strong><span><?php echo esc_html($stat['label']); ?></span></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ==================== ABOUT ==================== -->
<?php
$about_img_id = bcms_get('bcms_fp_about_image', '', $fp_id);
$about_img_url = $about_img_id ? wp_get_attachment_image_url($about_img_id, 'large') : 'https://cleargreen.me/wp-content/uploads/2025/09/ClearGreen-2.png';
$about_badge_text = bcms_get('bcms_fp_about_badge_txt', 'Godina<br>iskustva', $fp_id);
?>
<section id="o-nama" class="fp-sec">
  <div class="fp-w">
    <div class="fp-about-grid">
      <div class="fp-about-visual fp-a">
        <img class="fp-about-img" src="<?php echo esc_url($about_img_url); ?>" alt="ClearGreen" loading="lazy">
        <div class="fp-about-badge">
          <strong><?php echo esc_html(bcms_get('bcms_fp_about_badge_num', '5+', $fp_id)); ?></strong>
          <span><?php echo wp_kses_post($about_badge_text); ?></span>
        </div>
      </div>
      <div class="fp-about-text fp-a d1">
        <div class="fp-tag"><?php echo esc_html(bcms_get('bcms_fp_about_tag', 'O nama', $fp_id)); ?></div>
        <h2 class="fp-h2"><?php echo wp_kses_post(bcms_get('bcms_fp_about_title', 'Clear<span class="text-acc">Green</span>', $fp_id)); ?></h2>
        <p class="fp-p"><?php echo wp_kses_post(bcms_get('bcms_fp_about_p1', 'Razvili smo platformu koja povezuje provjeru identiteta, kontrolu pristupa i digitalizaciju procesa. Radimo za banke, telekome i javne institucije &mdash; sektore gdje greška košta reputacije.', $fp_id)); ?></p>
        <p class="fp-p"><?php echo wp_kses_post(bcms_get('bcms_fp_about_p2', 'Naša rješenja su SaaS i mogu biti on-prem ili cloud hostovana, u skladu s vašim sigurnosnim politikama.', $fp_id)); ?></p>
        <p class="fp-p"><?php echo wp_kses_post(bcms_get('bcms_fp_about_p3', 'Vizija nam je da budemo partner svakoj organizaciji koja želi raditi pametnije, isporučiti više i učiniti svoje procese otpornima na greške.', $fp_id)); ?></p>
        <a href="<?php echo esc_url(bcms_get('bcms_fp_about_btn_url', '#kontakt', $fp_id)); ?>" class="fp-btn" style="margin-top:36px"><?php echo esc_html(bcms_get('bcms_fp_about_btn_text', 'Kontaktirajte nas', $fp_id)); ?> <i class="fas fa-arrow-right"></i></a>
      </div>
    </div>
  </div>
</section>

<!-- ==================== WHY US ==================== -->
<?php
$why_cards = bcms_arr('bcms_fp_why_cards', $fp_id);
if (empty($why_cards)) {
    $why_cards = [
        ['icon' => 'bank.png', 'title' => 'Banke i finansije', 'desc' => 'Identifikacija klijenata na šalteru &mdash; pouzdana, brza i usklađena sa regulatornim zahtjevima.', 'tags' => 'BASIC, Alter One'],
        ['icon' => 'fas fa-landmark', 'title' => 'Javne institucije', 'desc' => 'Kontrola pristupa i digitalna evidencija posjetilaca sa punim audit tragom.', 'tags' => 'GateKeeper, DMS'],
        ['icon' => 'fas fa-satellite-dish', 'title' => 'Telekomunikacije', 'desc' => 'SIM i eSIM aktivacija jedino sa verifikovanim identitetom u core sistemu operatera.', 'tags' => 'SIMPLEX'],
        ['icon' => 'fas fa-truck', 'title' => 'Logistika i javna preduzeća', 'desc' => 'Svako vozilo, svaka ruta i svaki litar goriva &mdash; vidljivi i mjerljivi u realnom vremenu.', 'tags' => 'GreenFleet'],
        ['icon' => 'fas fa-parking', 'title' => 'Gradovi i parking servisi', 'desc' => 'Mobilno plaćanje, digitalne dozvole i automatski izvještaji bez papirne administracije.', 'tags' => 'Smart Parking'],
        ['icon' => 'fas fa-heartbeat', 'title' => 'Zdravstvo', 'desc' => 'Digitalni karton, e-posjete i podaci zaštićeni blockchain tehnologijom &mdash; dostupni uvijek.', 'tags' => 'e-Zdravstvo'],
    ];
}
$delay_classes = ['', ' d1', ' d2', ' d3', ' d4', ' d5'];
?>
<section id="zasto-mi" class="fp-sec fp-why-dark">
  <div class="fp-w">
    <div class="fp-why-head fp-a" style="text-align:center; margin-bottom:64px;">
      <div class="fp-tag"><?php echo esc_html(bcms_get('bcms_fp_why_tag', 'Zašto sarađivati sa nama?', $fp_id)); ?></div>
      <h2 class="fp-h2"><?php echo wp_kses_post(bcms_get('bcms_fp_why_title', 'Radimo u sektorima gdje greška košta <span class="text-acc">reputacije.</span>', $fp_id)); ?></h2>
      <p class="fp-p" style="max-width:700px; margin:0 auto;"><?php echo wp_kses_post(bcms_get('bcms_fp_why_desc', 'ClearGreen rješenja su aktivna u bankama, institucijama, zdravstvu i logistici &mdash; svuda gdje tačnost, sigurnost i usklađenost nisu opcija nego obaveza.', $fp_id)); ?></p>
    </div>
    <div class="fp-why-cards">
      <?php foreach ($why_cards as $i => $card): $dc = $delay_classes[$i] ?? ''; ?>
        <div class="fp-why-card fp-a<?php echo $dc; ?>">
          <div class="fp-why-card-icon">
            <?php if (strpos($card['icon'], '.png') !== false || strpos($card['icon'], '.svg') !== false): ?>
              <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/icons/' . $card['icon']); ?>" alt="<?php echo esc_attr($card['title']); ?>" style="width:28px; height:28px;">
            <?php else: ?>
              <i class="<?php echo esc_attr($card['icon']); ?>"></i>
            <?php endif; ?>
          </div>
          <h3 class="fp-why-card-title"><?php echo esc_html($card['title']); ?></h3>
          <p class="fp-why-card-desc"><?php echo wp_kses_post($card['desc']); ?></p>
          <?php if (!empty($card['tags'])): ?>
            <div class="fp-why-card-tags">
              <?php foreach (explode(',', $card['tags']) as $tag): ?>
                <span class="fp-pill"><?php echo esc_html(trim($tag)); ?></span>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
    <div style="text-align:center; margin-top:48px;" class="fp-a">
      <p style="color:var(--text-muted); font-size:.95rem; margin-bottom:14px;"><?php echo esc_html(bcms_get('bcms_fp_why_bottom', 'Nije vaš sektor na listi? Vjerovatno smo ga već riješili.', $fp_id)); ?></p>
      <a href="<?php echo esc_url(bcms_get('bcms_fp_why_btn_url', '#kontakt', $fp_id)); ?>" class="fp-btn"><?php echo esc_html(bcms_get('bcms_fp_why_btn_text', 'Kontaktirajte nas', $fp_id)); ?> <i class="fas fa-arrow-right"></i></a>
    </div>
  </div>
</section>

<!-- ==================== SERVICES ==================== -->
<?php
$svc_items = bcms_arr('bcms_fp_svc_items', $fp_id);
if (empty($svc_items)) {
    $svc_items = [
        ['name' => 'GateKeeper', 'desc' => 'Digitalna portirnica. Kontrola pristupa i evidencija posjetilaca zasnovana na Regula Forensics tehnologiji &mdash; GDPR i ISO 27001 usklađena.', 'for_whom' => 'Banke · Institucije · Telekomi · Korporacije', 'link' => 'https://cleargreen.me/gate-keeper/', 'featured' => '1'],
        ['name' => 'BASIC', 'desc' => 'Verifikacija identiteta klijenata na šalteru &mdash; MRZ, NFC i OCR čitanje dokumenta za 10 sekundi.', 'for_whom' => 'Banke · Mikrokrediti · Javne institucije', 'link' => '', 'featured' => ''],
        ['name' => 'SIMPLEX', 'desc' => 'SIM i eSIM aktivacija isključivo sa potvrđenim identitetom u core sistemu operatera.', 'for_whom' => 'Telekomunikacijski operateri', 'link' => '', 'featured' => ''],
        ['name' => 'DMS &mdash; Document Management', 'desc' => 'Skenirajte, arhivirajte i pretražujte dokumentaciju na jednom mjestu. Revizijski čist, sigurno dijeljenje.', 'for_whom' => 'Svi sektori', 'link' => '', 'featured' => ''],
        ['name' => 'Alter One &mdash; Fintech', 'desc' => 'Automatizacija kreditnih procesa, portoflio upravljanje i regulatorni izvještaji za mikrofinansijske institucije.', 'for_whom' => 'Mikrokrediti · Finansije', 'link' => '', 'featured' => ''],
        ['name' => 'GreenFleet &mdash; GPS &amp; Flota', 'desc' => 'Praćenje vozila u realnom vremenu, CAN analiza, potrošnja goriva i optimizacija ruta.', 'for_whom' => 'Logistika · Distribucija · Javna preduzeća', 'link' => '', 'featured' => ''],
        ['name' => 'Smart Parking', 'desc' => 'Mobilno plaćanje parkinga, digitalne dozvole i analitika za operatere i gradove.', 'for_whom' => 'Gradovi · Parking servisi · Turizam', 'link' => '', 'featured' => ''],
        ['name' => 'e-Zdravstvo', 'desc' => 'Digitalni karton pacijenta, e-posjete i blockchain zaštita medicinskih podataka.', 'for_whom' => 'Zdravstvene ustanove', 'link' => '', 'featured' => ''],
        ['name' => 'CRM &amp; poslovni softver', 'desc' => 'CRM po mjeri &mdash; praćenje prodaje, klijenata i poslovnih procesa u jednom sistemu.', 'for_whom' => 'Preduzeća svih sektora', 'link' => '', 'featured' => ''],
    ];
}
$svc_delays = ['', ' d1', ' d2', ' d3', ' d4', ' d5', '', ' d1', ' d2'];
?>
<section id="usluge" class="fp-sec">
  <div class="fp-w">
    <div class="fp-services-head fp-a">
      <div class="fp-tag"><?php echo esc_html(bcms_get('bcms_fp_svc_tag', 'Naše usluge', $fp_id)); ?></div>
      <h2 class="fp-h2"><?php echo wp_kses_post(bcms_get('bcms_fp_svc_title', 'Nudimo rješenja koja omogućavaju vašem poslovanju da <span class="text-acc">radi pametnije.</span>', $fp_id)); ?></h2>
    </div>
    <div class="fp-services-grid">
      <?php foreach ($svc_items as $si => $svc):
        $is_feat = !empty($svc['featured']);
        $sd = $svc_delays[$si] ?? '';
      ?>
        <div class="fp-svc<?php echo $is_feat ? ' fp-svc--featured' : ''; ?> fp-a<?php echo $sd; ?>">
          <div class="fp-svc-body">
            <h3><?php echo wp_kses_post($svc['name']); ?><?php if ($is_feat): ?> <span style="color:var(--green);">★</span><?php endif; ?></h3>
            <p><?php echo wp_kses_post($svc['desc']); ?></p>
            <?php if (!empty($svc['for_whom'])): ?>
              <span class="fp-svc-for">Za koga: <?php echo esc_html($svc['for_whom']); ?></span>
            <?php endif; ?>
            <?php if (!empty($svc['link'])): ?>
              <a href="<?php echo esc_url($svc['link']); ?>" class="fp-svc-link">Saznajte više <i class="fas fa-arrow-right"></i></a>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <div style="text-align:center; margin-top:48px;" class="fp-a">
      <a href="<?php echo esc_url(bcms_get('bcms_fp_svc_btn_url', '#kontakt', $fp_id)); ?>" class="fp-btn"><?php echo esc_html(bcms_get('bcms_fp_svc_btn_text', 'Stupite u kontakt', $fp_id)); ?> <i class="fas fa-arrow-right"></i></a>
    </div>
  </div>
</section>

<!-- ==================== CTA BANNER ==================== -->
<section class="fp-sec" style="padding:32px 0">
  <div class="fp-w">
    <div class="fp-cta fp-a">
      <h3><?php echo wp_kses_post(bcms_get('bcms_fp_cta_title', 'Spremni da svoj projekat pretvorite u <em>stvarnost?</em>', $fp_id)); ?></h3>
      <a href="<?php echo esc_url(bcms_get('bcms_fp_cta_btn_url', '#kontakt', $fp_id)); ?>" class="fp-btn"><?php echo esc_html(bcms_get('bcms_fp_cta_btn_text', 'Kontaktirajte nas', $fp_id)); ?> <i class="fas fa-arrow-right"></i></a>
    </div>
  </div>
</section>

<!-- ==================== PROCESS ==================== -->
<?php
$proc_steps = bcms_arr('bcms_fp_proc_steps', $fp_id);
if (empty($proc_steps)) {
    $proc_steps = [
        ['number' => '1', 'title' => 'Razumijemo procese, dizajniramo rješenje', 'desc' => 'Brzo mapiramo gdje nastaju rizici: identitet, pristup, dokumenti i operacije. Na toj osnovi sklapamo ciljnu arhitekturu prilagođenu vašim potrebama.'],
        ['number' => '2', 'title' => 'Pilot u realnim uslovima', 'desc' => 'U roku od 24 sata postavljamo prilagođeni pilot u vašem okruženju i povezujemo ga sa core sistemima. Testiranje na stvarnim procesima &mdash; odmah.'],
        ['number' => '3', 'title' => 'Implementacija i podrška', 'desc' => 'Glatka tranzicija, obuka zaposlenih i tehnička dokumentacija. Nakon pokretanja, ostajemo vaš partner za sve nadogradnje i podršku.'],
    ];
}
?>
<section id="proces" class="fp-sec">
  <div class="fp-w">
    <div class="fp-process-head fp-a">
      <div>
        <div class="fp-tag"><?php echo esc_html(bcms_get('bcms_fp_proc_tag', 'Naš proces – jednostavan i pouzdan', $fp_id)); ?></div>
        <h2 class="fp-h2"><?php echo wp_kses_post(bcms_get('bcms_fp_proc_title', 'Postavljamo prilagođeni pilot u roku od <span class="text-acc">24h.</span>', $fp_id)); ?></h2>
      </div>
      <a href="<?php echo esc_url(bcms_get('bcms_fp_proc_btn_url', '#kontakt', $fp_id)); ?>" class="fp-btn" style="flex-shrink:0"><?php echo esc_html(bcms_get('bcms_fp_proc_btn_text', 'Kontaktirajte nas', $fp_id)); ?> <i class="fas fa-arrow-right"></i></a>
    </div>
    <div class="fp-steps">
      <?php foreach ($proc_steps as $pi => $step): $pd = $delay_classes[$pi] ?? ''; ?>
        <div class="fp-step fp-a<?php echo $pd; ?>">
          <div class="fp-step-num"><?php echo esc_html($step['number']); ?></div>
          <h3><?php echo esc_html($step['title']); ?></h3>
          <p><?php echo wp_kses_post($step['desc']); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ==================== TESTIMONIALS ==================== -->
<?php
$test_partners = bcms_arr('bcms_fp_test_partners', $fp_id);
if (empty($test_partners)) {
    $test_partners = [
        ['name' => 'Adriatic Bank'], ['name' => 'Alter Modus'], ['name' => 'CKB Banka'],
        ['name' => 'Telemach'], ['name' => 'B-ONE'], ['name' => 'CINMED'],
        ['name' => 'SAT-TRAKT'], ['name' => 'Permar Plus'], ['name' => '2AI4ME'],
    ];
}
$test_cards = bcms_arr('bcms_fp_test_cards', $fp_id);
if (empty($test_cards)) {
    $test_cards = [
        ['quote' => 'Saradnja sa Cleargreen timom značajno je unaprijedila digitalne procese u mikrofinansijama.', 'company' => 'Alter Modus', 'logo' => ''],
        ['quote' => 'Cleargreen je implementirao softver za identifikaciju u naših devet poslovnica — proces je sigurniji i efikasniji.', 'company' => 'Adriatic Bank', 'logo' => ''],
        ['quote' => 'Instalacijom Cleargreen GateKeeper sistema značajno smo unaprijedili kontrolu pristupa i sigurnost u poslovnoj zgradi.', 'company' => 'CKB Banka', 'logo' => ''],
        ['quote' => 'U okruženju sa velikim protokom posjetilaca, GateKeeper je značajno smanjio operativni rizik na ulazu i ubrzao rad recepcije.', 'company' => 'Telemach', 'logo' => ''],
        ['quote' => 'Zajedno sa Cleargreen-om razvijamo napredne informaciono-komunikacione sisteme za klijente širom regiona.', 'company' => 'B-ONE', 'logo' => ''],
        ['quote' => 'Naše AI inovacije, uz Cleargreen-ovu ekspertizu, donose praktične alate za poslovnu transformaciju.', 'company' => 'CINMED', 'logo' => ''],
    ];
}
// Map of company names to hardcoded logo paths (used as fallback when no logo uploaded)
$logo_fallbacks = [
    'Alter Modus'  => '/wp-content/uploads/2026/01/alter-modus-logo-ravni.png',
    'Adriatic Bank' => '/wp-content/uploads/2026/01/adriatic-bank.png',
    'CKB Banka'     => '/wp-content/uploads/2026/01/CKB-transparent.png',
    'Telemach'       => '/wp-content/uploads/2026/01/Telemach-logo-.png',
    'B-ONE'          => '/wp-content/uploads/2026/01/b-one-logo.png',
    'CINMED'         => '/wp-content/uploads/2026/01/Cinmed-logo.png',
];
?>
<section id="reference" class="fp-sec">
  <div class="fp-w">
    <div class="fp-test-head fp-a">
      <div class="fp-tag"><?php echo esc_html(bcms_get('bcms_fp_test_tag', 'Partneri', $fp_id)); ?></div>
      <h2 class="fp-h2"><?php echo wp_kses_post(bcms_get('bcms_fp_test_title', 'Šta kažu <span class="text-acc">o nama</span>', $fp_id)); ?></h2>
    </div>
    <!-- Logo traka -->
    <div class="fp-partner-logos fp-a" style="display:flex; flex-wrap:wrap; justify-content:center; gap:32px; margin-bottom:56px; opacity:.5;">
      <?php foreach ($test_partners as $p): ?>
        <span style="font-size:.85rem; font-weight:600; color:var(--text-muted); letter-spacing:1px;"><?php echo esc_html($p['name']); ?></span>
      <?php endforeach; ?>
    </div>
    <div class="fp-test-grid">
      <?php foreach ($test_cards as $ti => $tc):
        $td = $delay_classes[$ti] ?? '';
        $logo_url = '';
        if (!empty($tc['logo'])) {
            $logo_url = wp_get_attachment_image_url($tc['logo'], 'medium');
        }
        if (!$logo_url && isset($logo_fallbacks[$tc['company']])) {
            $logo_url = $logo_fallbacks[$tc['company']];
        }
      ?>
        <div class="fp-tcard fp-a<?php echo $td; ?>">
          <div class="fp-tcard-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
          <div class="fp-tcard-q">"<?php echo esc_html($tc['quote']); ?>"</div>
          <div class="fp-tcard-author">
            <?php if ($logo_url): ?>
              <img class="fp-tcard-logo" src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr($tc['company']); ?>" loading="lazy">
            <?php endif; ?>
            <div class="fp-tcard-name"><?php echo esc_html($tc['company']); ?></div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ==================== CONTACT ==================== -->
<?php
$c_email = bcms_get('bcms_fp_contact_email', 'stefan.planic@cleargreen.me', $fp_id);
$c_phone = bcms_get('bcms_fp_contact_phone', '+382 (0) 68 090 161', $fp_id);
$c_phone_raw = bcms_get('bcms_fp_contact_phone_raw', '+38268090161', $fp_id);
?>
<section id="kontakt" class="fp-sec">
  <div class="fp-w">
    <div class="fp-contact-grid">
      <div class="fp-contact-info fp-a">
        <div class="fp-tag"><?php echo esc_html(bcms_get('bcms_fp_contact_tag', 'Kontakt', $fp_id)); ?></div>
        <h2 class="fp-h2"><?php echo wp_kses_post(bcms_get('bcms_fp_contact_title', 'Spremni da svoj projekat pretvorite u <span class="text-acc">stvarnost?</span>', $fp_id)); ?></h2>
        <p class="fp-p"><?php echo wp_kses_post(bcms_get('bcms_fp_contact_desc', 'Hajde da razgovaramo o tome kako vam možemo pomoći. Odgovaramo u roku od 24 sata.', $fp_id)); ?></p>
        <div class="fp-ci">
          <div class="fp-ci-icon"><i class="fas fa-envelope"></i></div>
          <a href="mailto:<?php echo esc_attr($c_email); ?>"><?php echo esc_html($c_email); ?></a>
        </div>
        <div class="fp-ci">
          <div class="fp-ci-icon"><i class="fas fa-phone"></i></div>
          <a href="tel:<?php echo esc_attr($c_phone_raw); ?>"><?php echo esc_html($c_phone); ?></a>
        </div>
      </div>
      <div class="fp-form fp-a d1">
        <h3 class="fp-form-title"><?php echo esc_html(bcms_get('bcms_fp_contact_form_title', 'Pošaljite nam poruku', $fp_id)); ?></h3>
        <p class="fp-form-sub"><?php echo esc_html(bcms_get('bcms_fp_contact_form_sub', 'Odgovaramo u roku od 24 sata.', $fp_id)); ?></p>
        <form action="#" method="post">
          <div class="fp-frow fp-frow--full">
            <input type="text" name="ime" placeholder="Ime i prezime" required>
          </div>
          <div class="fp-frow fp-frow--full">
            <input type="email" name="email" placeholder="Email adresa" required>
          </div>
          <div class="fp-frow fp-frow--full">
            <textarea name="poruka" placeholder="Opiši ukratko zahtjev..." required></textarea>
          </div>
          <button type="submit" class="fp-btn">Pošalji poruku <i class="fas fa-arrow-right"></i></button>
        </form>
      </div>
    </div>
  </div>
</section>

</div><!-- .fp -->

<script>
(function(){
  var els = document.querySelectorAll('.fp-a');
  if(!('IntersectionObserver' in window)){
    els.forEach(function(el){ el.classList.add('vis') });
    return;
  }
  var o = new IntersectionObserver(function(entries){
    entries.forEach(function(e){
      if(e.isIntersecting){
        e.target.classList.add('vis');
        o.unobserve(e.target);
      }
    });
  },{ threshold:0.06, rootMargin:'0px 0px -30px 0px' });
  els.forEach(function(el){ o.observe(el) });
})();
</script>

<?php get_footer(); ?>
