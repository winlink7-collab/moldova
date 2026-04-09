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
        ? 'text-sm font-semibold text-primary hover:text-primary transition-colors whitespace-nowrap'
        : 'text-sm font-semibold text-slate-100 hover:text-primary transition-colors whitespace-nowrap';
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
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

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
    body {
        font-family: 'Heebo', sans-serif;
    }
    .glass-effect {
        background: rgba(34, 31, 16, 0.8);
        backdrop-filter: blur(12px);
    }
    .serif-text {
        font-family: 'Heebo', sans-serif;
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

    /* ===== Light Theme ===== */
    html.light body {
        background: #f8f7f2 !important;
        color: #1a1a1a !important;
    }
    html.light .glass-effect {
        background: rgba(255,255,255,0.92) !important;
        border-color: rgba(0,0,0,0.08) !important;
    }
    html.light header a, html.light nav a {
        color: #333 !important;
    }
    html.light nav a:hover, html.light .text-primary {
        color: #b89b06 !important;
    }
    html.light h1, html.light h2, html.light h3, html.light h4 {
        color: #1a1a1a !important;
    }
    html.light .text-slate-100, html.light .text-white {
        color: #1a1a1a !important;
    }
    html.light .text-slate-300, html.light .text-slate-400, html.light .text-gold-muted {
        color: #555 !important;
    }
    html.light .bg-background-dark, html.light [class*="bg-background-dark"] {
        background: #f8f7f2 !important;
    }
    html.light .bg-surface, html.light [class*="bg-surface"] {
        background: #fff !important;
    }
    html.light .bg-card, html.light [class*="bg-card"] {
        background: #fff !important;
    }
    html.light .border-white\/10, html.light .border-white\/5, html.light .border-white\/15 {
        border-color: rgba(0,0,0,0.1) !important;
    }
    html.light .border-border-gold {
        border-color: rgba(184,155,6,0.3) !important;
    }
    html.light section, html.light main {
        background: transparent !important;
    }
    /* Hero section in light mode */
    html.light .relative.min-h-\[90vh\] .absolute.inset-0 .bg-gradient-to-l {
        background: linear-gradient(to left, rgba(248,247,242,0.2), rgba(248,247,242,0.85), rgba(248,247,242,1)) !important;
    }
    html.light .luxury-gradient {
        background: linear-gradient(135deg, rgba(248,247,242,0.95) 0%, rgba(255,255,255,0.8) 100%) !important;
    }
    /* Cards & sections with dark bg */
    html.light .gold-border, html.light [class*="gold-border"] {
        border-color: rgba(184,155,6,0.2) !important;
    }
    html.light .bg-accent-dark, html.light [class*="bg-accent-dark"] {
        background: #f0efe8 !important;
    }
    html.light .bg-primary\/10 {
        background: rgba(184,155,6,0.08) !important;
    }
    html.light .border-primary\/30 {
        border-color: rgba(184,155,6,0.25) !important;
    }
    html.light .text-primary {
        color: #9a8200 !important;
    }
    html.light .bg-primary {
        background: #c9a800 !important;
    }
    html.light footer {
        background: #1a1810 !important;
        color: #ccc !important;
    }
    html.light footer h3, html.light footer a, html.light footer span {
        color: #ccc !important;
    }
    html.light .gold-gradient-text {
        background: linear-gradient(135deg, #b89b06 0%, #8a7404 100%) !important;
        -webkit-background-clip: text !important;
        -webkit-text-fill-color: transparent !important;
    }
    html.light .bg-white\/5, html.light .bg-white\/10 {
        background: rgba(0,0,0,0.03) !important;
    }
    html.light .hover\:bg-white\/5:hover {
        background: rgba(0,0,0,0.05) !important;
    }
    html.light input, html.light select, html.light textarea {
        background: #fff !important;
        color: #1a1a1a !important;
        border-color: rgba(0,0,0,0.15) !important;
    }
    html.light #headerLogoTitle {
        color: #1a1a1a !important;
    }
    html.light .rounded-2xl, html.light .rounded-xl {
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
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
<script class="notranslate">
var BASE = '<?= BASE_URL ?>';
var BASE_URL = '<?= BASE_URL ?>';
var CURRENT_PAGE = '<?= $currentPage ?? "home" ?>';
var LANG = '<?= $CURRENT_LANG ?? "he" ?>';
var T = <?= json_encode($T ?? [], JSON_UNESCAPED_UNICODE) ?>;
// Fallback for translation keys
function tr(key) { return T[key] || key; }
</script>
<div class="relative flex min-h-screen w-full flex-col">

<!-- Navigation -->
<header class="sticky top-0 z-50 w-full border-b border-white/10 glass-effect">
<div class="w-full px-6 lg:px-12 xl:px-20">
<div class="flex h-20 items-center justify-between">

    <!-- Logo -->
    <a href="<?= BASE_URL ?>/" class="flex items-center gap-3 shrink-0">
        <div class="relative flex items-center justify-center size-10 bg-primary rounded-full shadow-[0_0_15px_rgba(242,208,13,0.4)]">
            <span class="material-symbols-outlined text-background-dark text-2xl font-bold">workspace_premium</span>
            <div class="absolute -top-1 -right-1">
                <span class="material-symbols-outlined text-primary text-lg">favorite</span>
            </div>
        </div>
        <div class="flex flex-col">
            <h1 id="headerLogoTitle" class="text-xl font-extrabold leading-none tracking-tight text-slate-100 uppercase">Moldova &amp; Ukraine</h1>
            <span id="headerLogoTagline" class="text-[10px] tracking-[0.3em] text-primary font-bold uppercase">Luxury Brides</span>
        </div>
    </a>

    <!-- Desktop Navigation -->
    <nav class="hidden lg:flex items-center gap-6 xl:gap-8 2xl:gap-10">
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
        <div id="userMenu" class="hidden items-center gap-4">
            <a href="<?= BASE_URL ?>/search" class="hidden sm:flex px-5 py-2.5 bg-primary hover:bg-primary/90 text-background-dark text-sm font-bold rounded-lg transition-all">
                <?= t('search_profiles') ?>
            </a>
            <a href="<?= BASE_URL ?>/dashboard" class="hidden sm:flex items-center gap-1 text-sm text-slate-300 hover:text-primary transition-colors font-medium">
                <span class="material-symbols-outlined text-lg">account_circle</span> <?= t('my_area') ?>
            </a>
            <div class="flex items-center gap-3">
                <span id="userName" class="text-sm text-slate-300 font-medium"></span>
                <button onclick="logout()" class="text-slate-400 hover:text-primary transition-colors">
                    <span class="material-symbols-outlined">logout</span>
                </button>
            </div>
        </div>

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
        <div class="flex gap-3 pt-3 border-t border-white/10">
            <button onclick="openModal('loginModal')" class="flex-1 px-4 py-2.5 border border-primary/30 hover:bg-primary/10 text-primary text-sm font-bold rounded-lg transition-all text-center">
                <?= t('login') ?>
            </button>
            <button onclick="openModal('registerModal')" class="flex-1 px-4 py-2.5 bg-primary hover:bg-primary/90 text-background-dark text-sm font-bold rounded-lg transition-all text-center">
                <?= t('register') ?>
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
