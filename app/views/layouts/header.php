<?php
/**
 * Shared layout header for Moldova & Ukraine Luxury Brides
 *
 * Available variables:
 *   $pageTitle       - Page title
 *   $pageDescription - Meta description
 *   $currentPage     - Current page identifier (home, about, search, stories, process, faq, contact, vip, dashboard, login, admin)
 */

$pageTitle       = $pageTitle ?? ('Moldova & Ukraine Luxury Brides - ' . t('hero_badge'));
$pageDescription = $pageDescription ?? t('hero_subtitle');
$currentPage     = $currentPage ?? 'home';

$canonicalUrl = 'https://' . ($_SERVER['HTTP_HOST'] ?? 'moldova-ukraine-brides.com') . ($_SERVER['REQUEST_URI'] ?? '/');

/** Helper: returns active nav class */
function navClass(string $page, string $current): string {
    return $page === $current
        ? 'text-xs xl:text-sm font-semibold text-primary hover:text-primary transition-colors whitespace-nowrap'
        : 'text-xs xl:text-sm font-semibold text-slate-100 hover:text-primary transition-colors whitespace-nowrap';
}
?>
<!DOCTYPE html>
<html class="dark" dir="<?= $LANG_DIR ?? 'rtl' ?>" lang="<?= $CURRENT_LANG ?? 'he' ?>">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>

<!-- SEO Meta -->
<title><?= htmlspecialchars($pageTitle) ?></title>
<meta name="description" content="<?= htmlspecialchars($pageDescription) ?>"/>
<link rel="canonical" href="<?= htmlspecialchars($canonicalUrl) ?>"/>
<meta name="robots" content="index, follow"/>

<!-- Open Graph -->
<meta property="og:title" content="<?= htmlspecialchars($pageTitle) ?>"/>
<meta property="og:description" content="<?= htmlspecialchars($pageDescription) ?>"/>
<meta property="og:type" content="website"/>
<meta property="og:url" content="<?= htmlspecialchars($canonicalUrl) ?>"/>
<meta property="og:locale" content="he_IL"/>
<meta property="og:site_name" content="Moldova & Ukraine Luxury Brides"/>

<!-- Hreflang -->
<link rel="alternate" hreflang="he" href="<?= htmlspecialchars($canonicalUrl) ?>"/>

<!-- JSON-LD Structured Data -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "Moldova & Ukraine Luxury Brides",
    "description": "<?= htmlspecialchars($pageDescription) ?>",
    "url": "https://<?= $_SERVER['HTTP_HOST'] ?? 'moldova-ukraine-brides.com' ?><?= BASE_URL ?>/",
    "logo": "https://<?= $_SERVER['HTTP_HOST'] ?? 'moldova-ukraine-brides.com' ?><?= BASE_URL ?>/public/images/logo.png",
    "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "+972-3-123-4567",
        "contactType": "customer service",
        "availableLanguage": ["Hebrew", "English", "Russian"]
    },
    "sameAs": [],
    "areaServed": ["IL", "MD", "UA"],
    "serviceType": "Luxury Matchmaking"
}
</script>

<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@300;400;500;600;700;800;900&family=Assistant:wght@300;400;500;600;700;800&family=Rubik:wght@300;400;500;600;700;800;900&family=Noto+Sans+Hebrew:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<script>
// Load saved font preference
(function() {
    var savedFont = localStorage.getItem('site_font');
    if (savedFont) {
        document.documentElement.style.setProperty('--site-font', savedFont);
    }
})();
</script>

<!-- Tailwind Config -->
<script id="tailwind-config">
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    "primary": "#f2d00d",
                    "background-light": "#f8f8f5",
                    "background-dark": "#12110a",
                    "accent-dark": "#221f10",
                    "gold-muted": "#bab59c",
                    "surface": "#1c1a0e",
                    "card": "#1a1810",
                    "border-gold": "#393728"
                },
                fontFamily: {
                    "display": ["Heebo", "sans-serif"]
                },
                borderRadius: {
                    "DEFAULT": "0.25rem",
                    "lg": "0.5rem",
                    "xl": "0.75rem",
                    "full": "9999px"
                }
            }
        }
    }
</script>

<!-- Common Styles -->
<style>
    :root {
        --site-font: 'Heebo', sans-serif;
    }
    body {
        font-family: var(--site-font) !important;
    }
    .glass-effect {
        background: rgba(34, 31, 16, 0.8);
        backdrop-filter: blur(12px);
    }
    .serif-text {
        font-family: var(--site-font) !important;
        font-weight: 800;
    }
    .luxury-gradient {
        background: linear-gradient(135deg, rgba(18,17,10,0.95) 0%, rgba(28,26,15,0.8) 100%);
    }
    .gold-border {
        border: 1px solid rgba(242, 208, 13, 0.3);
    }
    .gold-gradient-text {
        background: linear-gradient(135deg, #f2d00d 0%, #bab59c 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .gold-gradient {
        background: linear-gradient(135deg, #f2d00d 0%, #b89b06 100%);
        color: #12110a;
    }

    /* ===== Mobile UX Improvements ===== */
    /* Prevent horizontal scroll everywhere */
    html, body {
        overflow-x: hidden !important;
        max-width: 100vw;
    }

    /* Prevent layout shift on images - CRITICAL */
    img {
        max-width: 100%;
        height: auto;
    }
    img[src=""] {
        visibility: hidden;
    }

    /* Prevent FOUC (Flash of Unstyled Content) */
    body {
        opacity: 1;
        transition: opacity 0.15s;
    }

    /* Disable hover effects on touch devices to prevent jumps */
    @media (hover: none) {
        .hover\:scale-105:hover,
        .hover\:scale-110:hover,
        .hover\:-translate-y-2:hover,
        .hover\:-translate-y-1:hover,
        .group:hover,
        .hover\:translate-y-\[-2px\]:hover {
            transform: none !important;
        }
    }

    /* Mobile base fixes */
    @media (max-width: 640px) {
        * { word-wrap: break-word; }
        h1, h2, h3, h4 { line-height: 1.2; }

        /* Remove any horizontal scrolling in containers */
        section, main, header, footer { overflow-x: hidden; }

        /* Smoother modal animations */
        .fixed.inset-0 {
            -webkit-overflow-scrolling: touch;
        }

        /* Prevent button scaling jumps on tap */
        button, a {
            -webkit-tap-highlight-color: transparent;
        }

        /* Force images to fit */
        img {
            max-width: 100% !important;
            object-fit: cover;
        }
    }

    /* Smooth transitions globally */
    * {
        -webkit-font-smoothing: antialiased;
    }

    /* ===== Light Theme - Clean Gold & White ===== */
    html.light body {
        background: #faf9f5 !important;
        color: #2a2a2a !important;
    }

    /* --- Header --- */
    html.light .glass-effect {
        background: rgba(255,255,255,0.97) !important;
        border-color: rgba(0,0,0,0.06) !important;
        box-shadow: 0 1px 12px rgba(0,0,0,0.05);
    }
    html.light header a, html.light header nav a {
        color: #444 !important;
    }
    html.light header nav a:hover {
        color: #b89b06 !important;
    }
    html.light header .text-slate-100, html.light #headerLogoTitle {
        color: #1a1a1a !important;
    }

    /* --- Main Content --- */
    html.light main { background: transparent !important; }
    html.light main h1, html.light main h2, html.light main h3,
    html.light main h4, html.light main h5, html.light main h6 {
        color: #1a1a1a !important;
    }
    html.light main .text-white, html.light main .text-slate-100 {
        color: #2a2a2a !important;
    }
    /* Profile cards - name white, details dark */
    html.light main .profile-card h3,
    html.light main .profile-card h4,
    html.light main .aspect-\[3\/4\] h3,
    html.light main .aspect-\[3\/4\] h4 {
        color: #fff !important;
        text-shadow: 0 2px 8px rgba(0,0,0,0.6);
    }
    html.light main .profile-card .text-white\/70,
    html.light main .aspect-\[3\/4\] .text-white\/70,
    html.light main .profile-card p.text-sm,
    html.light main .aspect-\[3\/4\] p.text-sm {
        color: #1a1a1a !important;
        text-shadow: none;
    }
    html.light main .profile-card .text-white\/50,
    html.light main .aspect-\[3\/4\] .text-white\/50,
    html.light main .profile-card p.text-xs,
    html.light main .aspect-\[3\/4\] p.text-xs {
        color: #444 !important;
        text-shadow: none;
    }
    /* Card bottom section - light bg for readability */
    html.light main .profile-card .absolute.bottom-0,
    html.light main .aspect-\[3\/4\] .absolute.bottom-0,
    html.light main .group .absolute.bottom-0 {
        background: linear-gradient(to top, rgba(255,255,255,0.95) 0%, rgba(255,255,255,0.8) 60%, transparent 100%) !important;
    }
    html.light main .profile-card,
    html.light main .group.relative.rounded-2xl {
        border-color: rgba(0,0,0,0.1) !important;
        box-shadow: 0 2px 16px rgba(0,0,0,0.08);
        overflow: hidden;
    }
    /* Hero and profile page name stays white on dark image */
    html.light main .drop-shadow-2xl,
    html.light main #heroName, html.light main #heroAge {
        color: #fff !important;
        text-shadow: 0 2px 12px rgba(0,0,0,0.5);
    }
    /* Gallery items */
    html.light main .gallery-item .text-white {
        color: #fff !important;
    }

    /* Lead form always dark with white text */
    html.light main #leadForm,
    html.light main #leadForm * {
        color: #fff !important;
    }
    html.light main #homeFormTitle {
        color: #fff !important;
    }
    html.light main #leadForm label {
        color: #fff !important;
    }
    html.light main #leadForm input,
    html.light main #leadForm select {
        background: rgba(255,255,255,0.1) !important;
        color: #fff !important;
        border-color: rgba(255,255,255,0.25) !important;
    }
    html.light main #leadForm input::placeholder {
        color: #94a3b8 !important;
    }
    html.light main .text-slate-300, html.light main .text-slate-400,
    html.light main .text-slate-500, html.light main .text-gold-muted {
        color: #666 !important;
    }
    html.light main .text-primary {
        color: #b89b06 !important;
    }
    html.light main .bg-primary {
        background: linear-gradient(135deg, #dbb80e 0%, #b89b06 100%) !important;
        color: #fff !important;
    }
    html.light main .bg-primary\/10 {
        background: rgba(184,155,6,0.06) !important;
    }

    /* --- Backgrounds --- */
    html.light main .bg-background-dark,
    html.light main [class*="bg-background-dark"] {
        background: #faf9f5 !important;
    }
    html.light main .bg-card, html.light main [class*="bg-card"],
    html.light main .bg-surface {
        background: #ffffff !important;
        box-shadow: 0 1px 8px rgba(0,0,0,0.04);
    }
    html.light main .bg-accent-dark, html.light main [class*="bg-accent-dark"] {
        background: #f5f4ee !important;
    }
    html.light main .bg-white\/5, html.light main .bg-white\/10 {
        background: rgba(0,0,0,0.02) !important;
    }

    /* --- Borders --- */
    html.light main .border-white\/5, html.light main .border-white\/10,
    html.light main .border-white\/15 {
        border-color: rgba(0,0,0,0.08) !important;
    }
    html.light main .border-border-gold, html.light main .gold-border {
        border-color: rgba(184,155,6,0.2) !important;
    }
    html.light main .border-primary\/30, html.light main .border-primary\/40 {
        border-color: rgba(184,155,6,0.3) !important;
    }

    /* --- VIP Cards --- */
    html.light main .bg-card\/50 {
        background: #fff !important;
        border: 1px solid rgba(0,0,0,0.08) !important;
        box-shadow: 0 2px 16px rgba(0,0,0,0.05);
    }
    html.light main .bg-\[\#1c1a0e\], html.light main .bg-\[\#1a1810\],
    html.light main [style*="background-dark"], html.light main .luxury-gradient {
        background: #fff !important;
        border: 1px solid rgba(184,155,6,0.15) !important;
        box-shadow: 0 4px 24px rgba(184,155,6,0.08);
    }

    /* --- FAQ Accordion --- */
    html.light main details {
        background: #fff !important;
        border: 1px solid rgba(0,0,0,0.08) !important;
        box-shadow: 0 1px 6px rgba(0,0,0,0.03);
    }
    html.light main details summary span:first-child {
        color: #2a2a2a !important;
    }
    html.light main details .text-gold-muted {
        color: #555 !important;
    }

    /* --- Gradient Text --- */
    html.light main .gold-gradient-text {
        background: linear-gradient(135deg, #b89b06 0%, #8a7404 100%) !important;
        -webkit-background-clip: text !important;
        -webkit-text-fill-color: transparent !important;
    }

    /* --- Hero overlay --- */
    html.light main .bg-gradient-to-l {
        background: linear-gradient(to left, rgba(250,249,245,0.1), rgba(250,249,245,0.8), rgba(250,249,245,1)) !important;
    }
    html.light main .bg-gradient-to-t {
        background: linear-gradient(to top, rgba(250,249,245,0.9), transparent, transparent) !important;
    }

    /* --- Forms in main --- */
    html.light main input, html.light main select, html.light main textarea,
    html.light header input {
        background: #fff !important;
        color: #2a2a2a !important;
        border-color: rgba(0,0,0,0.12) !important;
    }
    html.light main input:focus, html.light main select:focus, html.light main textarea:focus {
        border-color: #b89b06 !important;
        box-shadow: 0 0 0 2px rgba(184,155,6,0.1);
    }

    /* --- Buttons --- */
    html.light main .gold-gradient {
        background: linear-gradient(135deg, #dbb80e 0%, #b89b06 100%) !important;
        color: #fff !important;
    }

    /* --- Footer ALWAYS dark --- */
    html.light footer, html.light footer#siteFooter {
        background: #12110a !important;
        color: #aaa !important;
    }
    html.light footer * { color: inherit !important; }
    html.light footer .text-primary { color: #f2d00d !important; }
    html.light footer .text-white, html.light footer .text-slate-100 { color: #ddd !important; }
    html.light footer .text-slate-400, html.light footer .text-slate-500,
    html.light footer .text-gold-muted { color: #777 !important; }
    html.light footer .border-white\/10 { border-color: rgba(255,255,255,0.08) !important; }
    html.light footer input, html.light footer textarea {
        background: rgba(255,255,255,0.05) !important;
        color: #fff !important;
        border-color: rgba(255,255,255,0.1) !important;
    }

    /* --- VIP Package Cards --- */
    html.light main .bg-zinc-900\/80,
    html.light main .bg-zinc-900\/40,
    html.light main [class*="bg-zinc-900"] {
        background: linear-gradient(135deg, #ffffff 0%, #f8f7f0 100%) !important;
        border: 2px solid rgba(184,155,6,0.15) !important;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08), 0 4px 12px rgba(184,155,6,0.05) !important;
    }
    html.light main .bg-zinc-900\/90 {
        background: linear-gradient(135deg, #fff8db 0%, #fffceb 50%, #ffffff 100%) !important;
        border: 3px solid #f2d00d !important;
        box-shadow: 0 20px 60px rgba(242,208,13,0.25), 0 8px 24px rgba(242,208,13,0.15) !important;
    }
    html.light main .bg-zinc-900\/80 h3,
    html.light main .bg-zinc-900\/80 span[id*="Price"],
    html.light main [class*="bg-zinc-900"] h3 {
        color: #1a1a1a !important;
    }
    html.light main .bg-zinc-900\/80 span,
    html.light main .bg-zinc-900\/80 li,
    html.light main .bg-zinc-900\/80 p,
    html.light main .bg-zinc-900\/80 div,
    html.light main .bg-zinc-900\/80 .text-slate-300,
    html.light main .bg-zinc-900\/80 .text-slate-400,
    html.light main [class*="bg-zinc-900"] span,
    html.light main [class*="bg-zinc-900"] li,
    html.light main [class*="bg-zinc-900"] p,
    html.light main [class*="bg-zinc-900"] .text-slate-300,
    html.light main [class*="bg-zinc-900"] .text-slate-400 {
        color: #333 !important;
    }
    html.light main .bg-zinc-900\/80 .text-\[\#E5E4E2\],
    html.light main [class*="bg-zinc-900"] .text-\[\#E5E4E2\] {
        color: #333 !important;
    }
    /* Gold card text */
    html.light main .bg-gradient-to-b span,
    html.light main .bg-gradient-to-b li,
    html.light main .bg-gradient-to-b p,
    html.light main .bg-gradient-to-b div,
    html.light main .bg-gradient-to-b .text-slate-300 {
        color: #333 !important;
    }
    html.light main .border-\[\#E5E4E2\]\/20,
    html.light main .border-\[\#E5E4E2\]\/50 {
        border-color: rgba(0,0,0,0.12) !important;
    }
    /* Gold VIP center card */
    html.light main .bg-gradient-to-b {
        background: linear-gradient(to bottom, #fff8e1, #ffffff) !important;
        border-color: rgba(184,155,6,0.3) !important;
        box-shadow: 0 8px 40px rgba(184,155,6,0.12);
    }
    /* Silver gradient */
    html.light main .silver-gradient {
        background: linear-gradient(135deg, #ccc 0%, #999 100%) !important;
    }
    /* "Why choose us" section */
    html.light main .backdrop-blur-sm {
        background: #f5f4ee !important;
        border-color: rgba(184,155,6,0.1) !important;
    }
    html.light main .backdrop-blur-sm h3,
    html.light main .backdrop-blur-sm h4 {
        color: #1a1a1a !important;
    }

    /* --- Reviews cards in light theme --- */
    html.light main #reviewsGrid > div {
        background: linear-gradient(135deg, #ffffff 0%, #fafaf5 100%) !important;
        border: 1px solid rgba(184,155,6,0.2) !important;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08), 0 2px 8px rgba(184,155,6,0.05) !important;
    }
    html.light main #reviewsGrid > div:hover {
        border-color: rgba(184,155,6,0.5) !important;
        box-shadow: 0 12px 40px rgba(184,155,6,0.15), 0 4px 16px rgba(0,0,0,0.1) !important;
    }
    html.light main #reviewsGrid p.text-slate-200 {
        color: #2a2a2a !important;
    }
    html.light main #reviewsGrid .text-white {
        color: #1a1a1a !important;
    }
    html.light main #reviewsGrid .text-primary\/80 {
        color: #9a8200 !important;
    }
    html.light main #reviewsGrid .text-white\/10 {
        color: rgba(0,0,0,0.1) !important;
    }
    html.light main #reviewsGrid .text-primary\/10 {
        color: rgba(184,155,6,0.15) !important;
    }
    html.light main #reviewsGrid .border-primary\/10 {
        border-color: rgba(184,155,6,0.15) !important;
    }
    html.light main #reviewsGrid img {
        border-color: #b89b06 !important;
    }

    /* --- Modals ALWAYS dark --- */
    html.light .fixed[id*="Modal"], html.light #loginModal, html.light #registerModal,
    html.light #msgModal {
        color: #fff !important;
    }
    html.light .fixed[id*="Modal"] input, html.light #loginModal input,
    html.light #registerModal input, html.light #msgModal input,
    html.light #msgModal textarea {
        background: rgba(28,26,15,0.5) !important;
        color: #fff !important;
        border-color: rgba(255,255,255,0.1) !important;
    }
</style>
<script>
// Theme toggle - load saved preference
(function() {
    var saved = localStorage.getItem('site_theme');
    if (saved === 'light') {
        document.documentElement.classList.remove('dark');
        document.documentElement.classList.add('light');
    }
})();
</script>
</head>

<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 antialiased overflow-x-hidden">
<?php global $T, $CURRENT_LANG, $LANG_DIR, $TRANSLATIONS; if (empty($T) && !empty($TRANSLATIONS)) { $T = $TRANSLATIONS[$CURRENT_LANG ?? 'he'] ?? $TRANSLATIONS['he']; } ?>
<script id="__translations" type="application/json"><?= json_encode($T ?? [], JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP) ?></script>
<script>
var BASE = '<?= BASE_URL ?>';
var BASE_URL = '<?= BASE_URL ?>';
var CURRENT_PAGE = '<?= $currentPage ?? "home" ?>';
var LANG = '<?= $CURRENT_LANG ?? "he" ?>';
var T = JSON.parse(document.getElementById('__translations').textContent);
function tr(key) { return (T && T[key]) ? T[key] : key; }
</script>
<script src="<?= BASE_URL ?>/public/js/auto-translate.js?v=<?= time() ?>"></script>
<script src="<?= BASE_URL ?>/public/js/whatsapp-verify.js?v=<?= time() ?>"></script>
<div class="relative flex min-h-screen w-full flex-col">

<!-- Navigation -->
<header class="sticky top-0 z-50 w-full border-b border-white/10 glass-effect">
<div class="w-full px-6 lg:px-12 xl:px-20">
<div class="flex h-20 items-center justify-between">

    <!-- Logo -->
    <a href="<?= BASE_URL ?>/" class="flex items-center gap-3 shrink-0">
        <div class="relative flex items-center justify-center size-12 shadow-[0_0_15px_rgba(242,208,13,0.4)]">
            <svg viewBox="0 0 100 100" class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <linearGradient id="crownGold" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#ffd700"/>
                        <stop offset="50%" style="stop-color:#f2d00d"/>
                        <stop offset="100%" style="stop-color:#b89b06"/>
                    </linearGradient>
                </defs>
                <!-- Crown base -->
                <path d="M 15 55 L 20 80 L 80 80 L 85 55 L 70 65 L 60 45 L 50 60 L 40 45 L 30 65 Z" fill="url(#crownGold)" stroke="#8a7404" stroke-width="1"/>
                <!-- Crown peaks -->
                <circle cx="20" cy="55" r="3" fill="#ff3366"/>
                <circle cx="50" cy="45" r="4" fill="#b9f2ff"/>
                <circle cx="80" cy="55" r="3" fill="#ff3366"/>
                <!-- Heart/diamond center -->
                <path d="M 50 52 L 45 57 L 50 65 L 55 57 Z" fill="#b9f2ff" stroke="#fff" stroke-width="0.5"/>
            </svg>
        </div>
        <div class="flex flex-col">
            <h1 id="headerLogoTitle" class="text-xl md:text-2xl font-black leading-none tracking-tight uppercase" style="background:linear-gradient(135deg,#ffd700 0%,#f2d00d 50%,#b89b06 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">Royal Date</h1>
            <span id="headerLogoTagline" class="text-[10px] tracking-[0.25em] text-primary font-bold uppercase">Premium Dating Solutions</span>
        </div>
    </a>

    <!-- Desktop Navigation -->
    <nav class="hidden lg:flex items-center gap-3 xl:gap-5 2xl:gap-8 flex-shrink min-w-0">
        <a id="navHome" class="<?= navClass('home', $currentPage) ?>" href="<?= BASE_URL ?>/"><?= t('nav_home') ?></a>
        <a id="navAbout" class="<?= navClass('about', $currentPage) ?>" href="<?= BASE_URL ?>/about"><?= t('nav_about') ?></a>
        <a id="navSearch" class="<?= navClass('search', $currentPage) ?>" href="<?= BASE_URL ?>/search"><?= t('nav_search') ?></a>
        <a id="navProcess" class="<?= navClass('process', $currentPage) ?>" href="<?= BASE_URL ?>/process"><?= t('nav_process') ?></a>
        <a id="navVip" class="<?= navClass('vip', $currentPage) ?>" href="<?= BASE_URL ?>/vip"><?= t('nav_vip') ?></a>
        <a id="navStories" class="<?= navClass('stories', $currentPage) ?>" href="<?= BASE_URL ?>/stories"><?= t('nav_stories') ?></a>
        <a id="navFaq" class="<?= navClass('faq', $currentPage) ?>" href="<?= BASE_URL ?>/faq"><?= t('nav_faq') ?></a>
        <a id="navContact" class="<?= navClass('contact', $currentPage) ?>" href="<?= BASE_URL ?>/contact"><?= t('nav_contact') ?></a>
    </nav>

    <!-- Language Switcher -->
    <div class="hidden lg:flex items-center gap-1.5">
        <a href="?lang=he" onclick="switchLang('he')" class="flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg text-xs font-bold transition-all <?= ($CURRENT_LANG ?? 'he') === 'he' ? 'bg-primary text-background-dark' : 'text-slate-400 hover:text-primary hover:bg-white/5 border border-white/10' ?>">
            <span style="display:inline-block;width:20px;height:14px;background:linear-gradient(to bottom,#fff 15%,#0038b8 15%,#0038b8 30%,#fff 30%,#fff 70%,#0038b8 70%,#0038b8 85%,#fff 85%);border-radius:2px;position:relative;overflow:hidden;border:1px solid rgba(255,255,255,0.2);"><span style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);font-size:10px;color:#0038b8;">✡</span></span>
            עב
        </a>
        <a href="?lang=ru" onclick="switchLang('ru')" class="flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg text-xs font-bold transition-all <?= ($CURRENT_LANG ?? 'he') === 'ru' ? 'bg-primary text-background-dark' : 'text-slate-400 hover:text-primary hover:bg-white/5 border border-white/10' ?>">
            <span style="display:inline-block;width:20px;height:14px;border-radius:2px;overflow:hidden;border:1px solid rgba(255,255,255,0.2);background:linear-gradient(to bottom,#fff 33%,#0039a6 33%,#0039a6 66%,#d52b1e 66%);"></span>
            RU
        </a>
        <a href="?lang=en" onclick="switchLang('en')" class="flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg text-xs font-bold transition-all <?= ($CURRENT_LANG ?? 'he') === 'en' ? 'bg-primary text-background-dark' : 'text-slate-400 hover:text-primary hover:bg-white/5 border border-white/10' ?>">
            <span style="display:inline-block;width:20px;height:14px;border-radius:2px;overflow:hidden;border:1px solid rgba(255,255,255,0.2);background:#00247d;position:relative;"><span style="position:absolute;inset:0;background:linear-gradient(to bottom,transparent 35%,#fff 35%,#fff 42%,#cf142b 42%,#cf142b 58%,#fff 58%,#fff 65%,transparent 65%);"></span><span style="position:absolute;inset:0;background:linear-gradient(to right,transparent 40%,#fff 40%,#fff 47%,#cf142b 47%,#cf142b 53%,#fff 53%,#fff 60%,transparent 60%);"></span></span>
            EN
        </a>
    </div>

    <!-- Font Picker (Admin only) -->
    <?php if (!empty($isAdmin)): ?>
    <div class="hidden lg:flex items-center relative">
        <button onclick="document.getElementById('fontPicker').classList.toggle('hidden')" class="flex items-center gap-1 text-slate-400 hover:text-primary transition-colors px-2 py-1.5 rounded-lg hover:bg-white/5 border border-white/10" title="<?= t('change_font') ?? 'Change Font' ?>">
            <span class="material-symbols-outlined text-lg">text_fields</span>
        </button>
        <div id="fontPicker" class="hidden absolute top-full left-0 mt-2 w-56 bg-background-dark border border-white/15 rounded-xl shadow-2xl overflow-hidden z-[100] p-3" style="direction:rtl;">
            <p class="text-xs text-slate-500 font-bold mb-2 uppercase"><?= t('change_font') ?? 'Font' ?></p>
            <div class="space-y-1 max-h-64 overflow-y-auto">
                <button onclick="setFont('Heebo')" class="font-btn w-full text-right px-3 py-2 rounded-lg text-sm text-slate-300 hover:bg-white/10 hover:text-primary transition-all" style="font-family:Heebo">Heebo (ברירת מחדל)</button>
                <button onclick="setFont('Assistant')" class="font-btn w-full text-right px-3 py-2 rounded-lg text-sm text-slate-300 hover:bg-white/10 hover:text-primary transition-all" style="font-family:Assistant">Assistant</button>
                <button onclick="setFont('Rubik')" class="font-btn w-full text-right px-3 py-2 rounded-lg text-sm text-slate-300 hover:bg-white/10 hover:text-primary transition-all" style="font-family:Rubik">Rubik</button>
                <button onclick="setFont('Noto Sans Hebrew')" class="font-btn w-full text-right px-3 py-2 rounded-lg text-sm text-slate-300 hover:bg-white/10 hover:text-primary transition-all" style="font-family:'Noto Sans Hebrew'">Noto Sans Hebrew</button>
                <button onclick="setFont('Playfair Display')" class="font-btn w-full text-right px-3 py-2 rounded-lg text-sm text-slate-300 hover:bg-white/10 hover:text-primary transition-all" style="font-family:'Playfair Display'">Playfair Display</button>
                <button onclick="setFont('Inter')" class="font-btn w-full text-right px-3 py-2 rounded-lg text-sm text-slate-300 hover:bg-white/10 hover:text-primary transition-all" style="font-family:Inter">Inter</button>
                <button onclick="setFont('Poppins')" class="font-btn w-full text-right px-3 py-2 rounded-lg text-sm text-slate-300 hover:bg-white/10 hover:text-primary transition-all" style="font-family:Poppins">Poppins</button>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Theme Toggle -->
    <button id="themeToggleBtn" onclick="toggleTheme()" class="hidden lg:flex items-center gap-2 text-slate-400 hover:text-primary transition-colors px-3 py-1.5 rounded-lg hover:bg-white/5 border border-white/10 hover:border-primary/30" title="<?= t('change_theme') ?>">
        <span id="themeIcon" class="material-symbols-outlined text-lg">light_mode</span>
        <span id="themeLabel" class="text-xs font-bold"><?= t('change_theme') ?></span>
    </button>

    <!-- Quick Search -->
    <div class="hidden lg:flex items-center relative">
        <button onclick="toggleHeaderSearch()" class="flex items-center gap-1 text-slate-400 hover:text-primary transition-colors px-2 py-1.5 rounded-lg hover:bg-white/5" title="<?= t('search_now') ?>">
            <span class="material-symbols-outlined text-xl">search</span>
        </button>
        <div id="headerSearchBox" class="hidden absolute top-full left-0 mt-2 w-80 bg-background-dark border border-white/15 rounded-xl shadow-2xl overflow-hidden z-[100]" style="direction:rtl;">
            <div class="flex items-center gap-2 px-4 py-3 border-b border-white/10">
                <span class="material-symbols-outlined text-primary text-xl">search</span>
                <input id="headerSearchInput" type="text" placeholder="<?= t('search_placeholder') ?>" class="flex-1 bg-transparent text-white text-sm outline-none placeholder:text-slate-500" autocomplete="off"/>
                <button onclick="closeHeaderSearch()" class="text-slate-500 hover:text-white"><span class="material-symbols-outlined text-lg">close</span></button>
            </div>
            <div id="headerSearchResults" class="max-h-80 overflow-y-auto"></div>
        </div>
    </div>

    <!-- Auth Buttons & Mobile Menu -->
    <div class="flex items-center gap-4">
        <!-- Logged out state -->
        <div id="authButtons" class="flex items-center gap-3">
            <button onclick="openModal('loginModal')" class="hidden sm:flex px-5 py-2.5 border border-primary/30 hover:bg-primary/10 text-primary text-sm font-bold rounded-lg transition-all">
                <?= t('login') ?>
            </button>
            <button onclick="openModal('registerModal')" class="hidden sm:flex px-5 py-2.5 bg-primary hover:bg-primary/90 text-background-dark text-sm font-bold rounded-lg transition-all transform hover:scale-105">
                <?= t('register') ?>
            </button>
        </div>

        <!-- Logged in state (hidden by default) -->
        <div id="userMenu" class="hidden items-center gap-3">
            <a href="<?= BASE_URL ?>/dashboard" class="hidden sm:flex items-center gap-2 px-4 py-2 bg-primary hover:bg-primary/90 text-background-dark text-sm font-black rounded-lg transition-all shadow-lg">
                <span class="material-symbols-outlined text-lg">account_circle</span>
                <span><?= t('my_area') ?></span>
            </a>
            <a href="<?= BASE_URL ?>/search" class="hidden md:flex items-center gap-1 px-3 py-2 border border-primary/30 text-primary hover:bg-primary/10 text-sm font-bold rounded-lg transition-all">
                <span class="material-symbols-outlined text-base">search</span>
            </a>
            <div class="flex items-center gap-2">
                <span id="userName" class="hidden lg:block text-sm text-slate-300 font-medium"></span>
                <button onclick="logout()" class="flex items-center gap-1 px-2 py-2 text-red-400 hover:bg-red-500/10 rounded-lg transition-all" title="<?= t('logout') ?>">
                    <span class="material-symbols-outlined text-lg">logout</span>
                </button>
            </div>
        </div>

        <!-- Mobile: Dashboard quick access (when logged in) -->
        <a id="mobileDashboardBtn" href="<?= BASE_URL ?>/dashboard" class="hidden lg:!hidden flex items-center justify-center w-10 h-10 bg-primary text-background-dark rounded-full shadow-lg" title="<?= t('my_area') ?>">
            <span class="material-symbols-outlined text-xl">account_circle</span>
        </a>

        <!-- Mobile theme toggle -->
        <button onclick="toggleTheme()" class="lg:hidden text-slate-400 hover:text-primary transition-colors">
            <span id="themeIconMobile" class="material-symbols-outlined text-2xl">light_mode</span>
        </button>
        <!-- Mobile menu button -->
        <button id="mobileMenuBtn" class="lg:hidden text-slate-100" onclick="toggleMobileMenu()">
            <span class="material-symbols-outlined text-3xl">menu</span>
        </button>
    </div>

</div>
</div>

<!-- Mobile Navigation Menu -->
<div id="mobileMenu" class="hidden lg:hidden border-t border-white/10 bg-background-dark/95 backdrop-blur-xl">
    <nav class="flex flex-col px-6 py-4 space-y-3">
        <a class="<?= navClass('home', $currentPage) ?> block py-2" href="<?= BASE_URL ?>/"><?= t('nav_home') ?></a>
        <a class="<?= navClass('about', $currentPage) ?> block py-2" href="<?= BASE_URL ?>/about"><?= t('nav_about') ?></a>
        <a class="<?= navClass('search', $currentPage) ?> block py-2" href="<?= BASE_URL ?>/search"><?= t('nav_search') ?></a>
        <a class="<?= navClass('process', $currentPage) ?> block py-2" href="<?= BASE_URL ?>/process"><?= t('nav_process') ?></a>
        <a class="<?= navClass('vip', $currentPage) ?> block py-2" href="<?= BASE_URL ?>/vip"><?= t('nav_vip') ?></a>
        <a class="<?= navClass('stories', $currentPage) ?> block py-2" href="<?= BASE_URL ?>/stories"><?= t('nav_stories') ?></a>
        <a class="<?= navClass('faq', $currentPage) ?> block py-2" href="<?= BASE_URL ?>/faq"><?= t('nav_faq') ?></a>
        <a class="<?= navClass('contact', $currentPage) ?> block py-2" href="<?= BASE_URL ?>/contact"><?= t('nav_contact') ?></a>
        <!-- Mobile Language Switcher -->
        <div class="flex gap-2 pt-3 border-t border-white/10">
            <a href="?lang=he" onclick="switchLang('he')" class="flex-1 flex items-center justify-center gap-2 px-3 py-2.5 rounded-lg text-sm font-bold transition-all <?= ($CURRENT_LANG ?? 'he') === 'he' ? 'bg-primary text-background-dark' : 'border border-white/10 text-slate-300 hover:border-primary/30' ?>">
                <span style="display:inline-block;width:22px;height:15px;background:linear-gradient(to bottom,#fff 15%,#0038b8 15%,#0038b8 30%,#fff 30%,#fff 70%,#0038b8 70%,#0038b8 85%,#fff 85%);border-radius:2px;border:1px solid rgba(255,255,255,0.2);position:relative;overflow:hidden;"><span style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);font-size:10px;color:#0038b8;">✡</span></span>
                עברית
            </a>
            <a href="?lang=ru" onclick="switchLang('ru')" class="flex-1 flex items-center justify-center gap-2 px-3 py-2.5 rounded-lg text-sm font-bold transition-all <?= ($CURRENT_LANG ?? 'he') === 'ru' ? 'bg-primary text-background-dark' : 'border border-white/10 text-slate-300 hover:border-primary/30' ?>">
                <span style="display:inline-block;width:22px;height:15px;border-radius:2px;border:1px solid rgba(255,255,255,0.2);background:linear-gradient(to bottom,#fff 33%,#0039a6 33%,#0039a6 66%,#d52b1e 66%);"></span>
                Русский
            </a>
            <a href="?lang=en" onclick="switchLang('en')" class="flex-1 flex items-center justify-center gap-2 px-3 py-2.5 rounded-lg text-sm font-bold transition-all <?= ($CURRENT_LANG ?? 'he') === 'en' ? 'bg-primary text-background-dark' : 'border border-white/10 text-slate-300 hover:border-primary/30' ?>">
                <span style="display:inline-block;width:22px;height:15px;border-radius:2px;border:1px solid rgba(255,255,255,0.2);background:#00247d;position:relative;overflow:hidden;"><span style="position:absolute;inset:0;background:linear-gradient(to bottom,transparent 35%,#fff 35%,#fff 42%,#cf142b 42%,#cf142b 58%,#fff 58%,#fff 65%,transparent 65%);"></span><span style="position:absolute;inset:0;background:linear-gradient(to right,transparent 40%,#fff 40%,#fff 47%,#cf142b 47%,#cf142b 53%,#fff 53%,#fff 60%,transparent 60%);"></span></span>
                English
            </a>
        </div>
        <!-- Mobile auth buttons - Logged out -->
        <div id="mobileAuthButtons" class="flex gap-3 pt-3 border-t border-white/10">
            <button onclick="openModal('loginModal')" class="flex-1 px-4 py-2.5 border border-primary/30 hover:bg-primary/10 text-primary text-sm font-bold rounded-lg transition-all text-center">
                <?= t('login') ?>
            </button>
            <button onclick="openModal('registerModal')" class="flex-1 px-4 py-2.5 bg-primary hover:bg-primary/90 text-background-dark text-sm font-bold rounded-lg transition-all text-center">
                <?= t('register') ?>
            </button>
        </div>
        <!-- Mobile user menu - Logged in -->
        <div id="mobileUserMenu" class="hidden flex-col gap-2 pt-3 border-t border-white/10">
            <a href="<?= BASE_URL ?>/dashboard" class="flex items-center justify-center gap-2 px-4 py-3 bg-primary/10 border border-primary/30 text-primary text-sm font-bold rounded-lg">
                <span class="material-symbols-outlined text-lg">account_circle</span>
                <span id="mobileUserName"><?= t('my_area') ?></span>
            </a>
            <a href="<?= BASE_URL ?>/search" class="flex items-center justify-center gap-2 px-4 py-3 bg-white/5 text-slate-200 text-sm font-bold rounded-lg">
                <span class="material-symbols-outlined text-lg">search</span>
                <?= t('search_profiles') ?>
            </a>
            <button onclick="logout()" class="flex items-center justify-center gap-2 px-4 py-3 border border-red-500/30 text-red-400 hover:bg-red-500/10 text-sm font-bold rounded-lg transition-all">
                <span class="material-symbols-outlined text-lg">logout</span>
                <?= t('logout') ?>
            </button>
        </div>
    </nav>
</div>
</header>

<!-- Header Search Script -->
<script>
let headerSearchTimeout = null;
function toggleHeaderSearch() {
    const box = document.getElementById('headerSearchBox');
    box.classList.toggle('hidden');
    if (!box.classList.contains('hidden')) {
        document.getElementById('headerSearchInput').focus();
    }
}
function closeHeaderSearch() {
    document.getElementById('headerSearchBox').classList.add('hidden');
    document.getElementById('headerSearchInput').value = '';
    document.getElementById('headerSearchResults').innerHTML = '';
}
document.addEventListener('click', function(e) {
    const box = document.getElementById('headerSearchBox');
    if (box && !box.classList.contains('hidden') && !e.target.closest('#headerSearchBox') && !e.target.closest('[onclick*="toggleHeaderSearch"]')) {
        closeHeaderSearch();
    }
});
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('headerSearchInput');
    if (!input) return;
    input.addEventListener('input', function() {
        clearTimeout(headerSearchTimeout);
        const q = this.value.trim();
        const results = document.getElementById('headerSearchResults');
        if (q.length < 2) { results.innerHTML = '<div class="px-4 py-3 text-sm text-slate-500 text-center">' + (T.search_min_chars || 'Type at least 2 characters...') + '</div>'; return; }
        results.innerHTML = '<div class="px-4 py-3 text-sm text-slate-500 text-center">' + (T.searching || 'Searching...') + '</div>';
        headerSearchTimeout = setTimeout(async () => {
            try {
                const res = await fetch(BASE + '/api/profiles?q=' + encodeURIComponent(q) + '&per_page=5');
                const data = await res.json();
                const profiles = data.profiles || [];
                if (!profiles.length) {
                    results.innerHTML = '<div class="px-4 py-6 text-sm text-slate-500 text-center">' + (T.no_results || 'No results found') + '</div>';
                    return;
                }
                results.innerHTML = profiles.map(p => {
                    const country = p.country === 'moldova' ? (T.moldova_country || 'Moldova') : (T.ukraine || 'Ukraine');
                    return `<a href="${BASE}/profile/${p.id}" class="flex items-center gap-3 px-4 py-3 hover:bg-white/5 transition-colors border-b border-white/5">
                        <img src="${p.primary_photo || ''}" class="w-10 h-10 rounded-full object-cover bg-white/10 flex-shrink-0" onerror="this.style.display='none'"/>
                        <div class="flex-1 min-w-0">
                            <div class="text-sm font-bold text-white">${p.name}, ${p.age}</div>
                            <div class="text-xs text-slate-500">${p.city || ''}, ${country}</div>
                        </div>
                        <span class="material-symbols-outlined text-slate-600 text-lg">arrow_back</span>
                    </a>`;
                }).join('') + `<a href="${BASE}/search" class="block px-4 py-3 text-center text-sm text-primary font-bold hover:bg-white/5 transition-colors">${T.filters || 'Advanced Search'}</a>`;
            } catch { results.innerHTML = '<div class="px-4 py-3 text-sm text-red-400 text-center">' + (T.error_loading || 'Error') + '</div>'; }
        }, 300);
    });
    input.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeHeaderSearch();
        if (e.key === 'Enter') {
            const q = this.value.trim();
            if (q) window.location.href = BASE + '/search?q=' + encodeURIComponent(q);
        }
    });
});
</script>

<!-- Main Content -->
<main class="flex-1">
