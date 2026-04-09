
</main>
<!-- End Main Content -->

<!-- Footer -->
<footer id="siteFooter" class="bg-background-dark border-t border-white/10 pt-20 pb-10">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid md:grid-cols-4 gap-12 mb-16">

        <!-- Brand & Description -->
        <div class="col-span-1 md:col-span-2 space-y-6">
            <a href="<?= BASE_URL ?>/" class="flex items-center gap-3">
                <span class="material-symbols-outlined text-primary text-3xl">workspace_premium</span>
                <div class="flex flex-col">
                    <h1 id="footerLogoTitle" class="text-xl font-extrabold leading-none tracking-tight text-slate-100 uppercase">Moldova &amp; Ukraine</h1>
                    <span id="footerLogoTagline" class="text-[10px] tracking-[0.3em] text-primary font-bold uppercase">Luxury Brides</span>
                </div>
            </a>
            <p id="footerDesc" class="text-gold-muted text-sm leading-relaxed max-w-sm">
                הסוכנות המובילה בעולם לשידוכי יוקרה הממוקדת במולדובה ואוקראינה. אנו מביאים את השילוב המנצח של יופי מזרח אירופאי וערכים מסורתיים ללקוחותינו ברחבי העולם.
            </p>
            <div id="footerSocial" class="flex gap-4">
                <a class="size-10 rounded-full bg-white/5 flex items-center justify-center text-white hover:bg-primary hover:text-background-dark transition-all" href="#" id="socialLink1">
                    <span class="material-symbols-outlined" id="socialIcon1">public</span>
                </a>
                <a class="size-10 rounded-full bg-white/5 flex items-center justify-center text-white hover:bg-primary hover:text-background-dark transition-all" href="#" id="socialLink2">
                    <span class="material-symbols-outlined" id="socialIcon2">alternate_email</span>
                </a>
                <a class="size-10 rounded-full bg-white/5 flex items-center justify-center text-white hover:bg-primary hover:text-background-dark transition-all" href="#" id="socialLink3">
                    <span class="material-symbols-outlined" id="socialIcon3">phone_iphone</span>
                </a>
            </div>
        </div>

        <!-- Quick Links -->
        <div>
            <h5 class="text-white font-bold mb-6">קישורים מהירים</h5>
            <ul id="footerLinks" class="space-y-4 text-sm text-gold-muted">
                <li><a class="hover:text-primary transition-colors" href="<?= BASE_URL ?>/about">אודותינו</a></li>
                <li><a class="hover:text-primary transition-colors" href="<?= BASE_URL ?>/process">תהליך השידוך</a></li>
                <li><a class="hover:text-primary transition-colors" href="<?= BASE_URL ?>/vip">חבילות VIP</a></li>
                <li><a class="hover:text-primary transition-colors" href="<?= BASE_URL ?>/faq">שאלות נפוצות</a></li>
                <li><a class="hover:text-primary transition-colors" href="<?= BASE_URL ?>/contact">צרו קשר</a></li>
            </ul>
        </div>

        <!-- Contact Info -->
        <div>
            <h5 class="text-white font-bold mb-6">צרו קשר</h5>
            <ul class="space-y-4 text-sm text-gold-muted">
                <li class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary text-lg">location_on</span>
                    <span id="footerAddress">משרד ראשי: תל אביב, ישראל</span>
                </li>
                <li class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary text-lg">call</span>
                    <span id="footerPhone" dir="ltr">+972 3-123-4567</span>
                </li>
                <li class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary text-lg">mail</span>
                    <span id="footerEmail">office@moldova-ukraine-brides.com</span>
                </li>
            </ul>
        </div>

    </div>

    <!-- Copyright -->
    <div class="border-t border-white/5 pt-8 text-center text-xs text-gold-muted/50">
        <p id="footerCopy">&copy; <?= date('Y') ?> Moldova &amp; Ukraine Brides Luxury Matchmaking. <?= t('all_rights') ?></p>
        <!-- Footer Language Switcher -->
        <div class="flex items-center justify-center gap-3 mt-4">
            <?php foreach (['he' => 'עברית', 'ru' => 'Русский', 'en' => 'English'] as $code => $label): ?>
            <a href="?lang=<?= $code ?>" class="text-sm font-bold transition-all <?= ($CURRENT_LANG ?? 'he') === $code ? 'text-primary' : 'text-slate-500 hover:text-primary' ?>">
                <?= $label ?>
            </a>
            <?php if ($code !== 'en'): ?><span class="text-slate-700">|</span><?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</footer>

</div>
<!-- End .relative.flex.min-h-screen -->

<!-- Login Modal -->
<div id="loginModal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/70 backdrop-blur-sm">
<div class="relative w-full max-w-[500px] mx-4 luxury-gradient p-8 md:p-12 rounded-xl gold-border shadow-2xl backdrop-blur-sm">
    <button onclick="closeModal('loginModal')" class="absolute top-4 left-4 text-slate-400 hover:text-white transition-colors">
        <span class="material-symbols-outlined text-2xl">close</span>
    </button>
    <div class="text-center mb-10">
        <div class="inline-block p-3 rounded-full bg-primary/5 mb-4 gold-border">
            <span class="material-symbols-outlined text-primary text-4xl">lock_person</span>
        </div>
        <h1 class="serif-text text-3xl md:text-4xl font-bold text-white mb-3">כניסת חברי VIP</h1>
        <div class="h-0.5 w-16 bg-primary mx-auto mb-4"></div>
        <p class="text-slate-400 text-base">הזינו את פרטי הגישה שלכם</p>
    </div>
    <form id="loginForm" class="space-y-6">
        <div class="space-y-2">
            <label class="block text-primary text-sm font-semibold pr-1">אימייל</label>
            <div class="relative">
                <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 text-xl">person</span>
                <input id="loginEmail" class="w-full bg-[#1c1a0f]/50 border border-white/10 rounded-lg py-4 pr-12 pl-4 text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder:text-slate-600" placeholder="email@example.com" type="email" required/>
            </div>
        </div>
        <div class="space-y-2">
            <label class="block text-primary text-sm font-semibold pr-1">סיסמה</label>
            <div class="relative">
                <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 text-xl">key</span>
                <input id="loginPassword" class="w-full bg-[#1c1a0f]/50 border border-white/10 rounded-lg py-4 pr-12 pl-4 text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder:text-slate-600" placeholder="••••••••" type="password" required/>
            </div>
        </div>
        <div id="loginError" class="hidden text-center text-sm font-bold text-red-400"></div>
        <div class="pt-2">
            <button class="w-full bg-primary hover:bg-primary/80 text-background-dark font-bold py-4 rounded-lg text-lg transition-all transform hover:scale-[1.01] shadow-xl shadow-primary/10 serif-text" type="submit">
                כניסה למערכת
            </button>
        </div>
    </form>
    <div class="mt-6 text-center space-y-3">
        <p><a href="<?= BASE_URL ?>/dashboard?forgot=1" class="text-slate-400 text-sm hover:text-primary transition-colors">שכחת סיסמה?</a></p>
        <p class="text-slate-400 text-sm">עדיין לא חברים? <a onclick="closeModal('loginModal'); openModal('registerModal')" class="text-primary font-bold hover:underline cursor-pointer">הרשמה</a></p>
    </div>
</div>
</div>

<!-- Register Modal -->
<div id="registerModal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/70 backdrop-blur-sm">
<div class="relative w-full max-w-[500px] mx-4 luxury-gradient p-8 md:p-12 rounded-xl gold-border shadow-2xl backdrop-blur-sm max-h-[90vh] overflow-y-auto">
    <button onclick="closeModal('registerModal')" class="absolute top-4 left-4 text-slate-400 hover:text-white transition-colors">
        <span class="material-symbols-outlined text-2xl">close</span>
    </button>
    <div class="text-center mb-10">
        <div class="inline-block p-3 rounded-full bg-primary/5 mb-4 gold-border">
            <span class="material-symbols-outlined text-primary text-4xl">person_add</span>
        </div>
        <h1 class="serif-text text-3xl md:text-4xl font-bold text-white mb-3">הצטרפות למועדון</h1>
        <div class="h-0.5 w-16 bg-primary mx-auto mb-4"></div>
        <p class="text-slate-400 text-base">צור חשבון וגלה את ההתאמה המושלמת</p>
    </div>
    <form id="registerForm" class="space-y-5">
        <div class="space-y-2">
            <label class="block text-primary text-sm font-semibold pr-1">שם מלא</label>
            <div class="relative">
                <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 text-xl">badge</span>
                <input id="regName" class="w-full bg-[#1c1a0f]/50 border border-white/10 rounded-lg py-4 pr-12 pl-4 text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder:text-slate-600" placeholder="ישראל ישראלי" type="text" required/>
            </div>
        </div>
        <div class="space-y-2">
            <label class="block text-primary text-sm font-semibold pr-1">אימייל</label>
            <div class="relative">
                <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 text-xl">mail</span>
                <input id="regEmail" class="w-full bg-[#1c1a0f]/50 border border-white/10 rounded-lg py-4 pr-12 pl-4 text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder:text-slate-600" placeholder="email@example.com" type="email" required/>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div class="space-y-2">
                <label class="block text-primary text-sm font-semibold pr-1">סיסמה</label>
                <input id="regPassword" class="w-full bg-[#1c1a0f]/50 border border-white/10 rounded-lg py-4 px-4 text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder:text-slate-600" placeholder="••••••••" type="password" required/>
            </div>
            <div class="space-y-2">
                <label class="block text-primary text-sm font-semibold pr-1">גיל</label>
                <input id="regAge" class="w-full bg-[#1c1a0f]/50 border border-white/10 rounded-lg py-4 px-4 text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder:text-slate-600" placeholder="35" type="number"/>
            </div>
        </div>
        <div class="space-y-2">
            <label class="block text-primary text-sm font-semibold pr-1">טלפון</label>
            <div class="relative">
                <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 text-xl">phone</span>
                <input id="regPhone" class="w-full bg-[#1c1a0f]/50 border border-white/10 rounded-lg py-4 pr-12 pl-4 text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder:text-slate-600" placeholder="050-1234567" type="tel"/>
            </div>
        </div>
        <div id="registerError" class="hidden text-center text-sm font-bold text-red-400"></div>
        <div class="pt-2">
            <button class="w-full bg-primary hover:bg-primary/80 text-background-dark font-bold py-4 rounded-lg text-lg transition-all transform hover:scale-[1.01] shadow-xl shadow-primary/10 serif-text" type="submit">
                יצירת חשבון VIP
            </button>
        </div>
    </form>
    <div class="mt-8 text-center">
        <p class="text-slate-400 text-sm">כבר חברים? <a onclick="closeModal('registerModal'); openModal('loginModal')" class="text-primary font-bold hover:underline cursor-pointer">התחברות</a></p>
    </div>
</div>
</div>

<!-- Shared JavaScript -->
<script>

// Mobile menu toggle
function toggleMobileMenu() {
    const menu = document.getElementById('mobileMenu');
    const btn = document.getElementById('mobileMenuBtn');
    if (menu.classList.contains('hidden')) {
        menu.classList.remove('hidden');
        btn.querySelector('span').textContent = 'close';
    } else {
        menu.classList.add('hidden');
        btn.querySelector('span').textContent = 'menu';
    }
}

// Modal functions
function openModal(id) {
    const m = document.getElementById(id);
    m.classList.remove('hidden');
    m.classList.add('flex');
}
function closeModal(id) {
    const m = document.getElementById(id);
    m.classList.add('hidden');
    m.classList.remove('flex');
}
// Close on background click
document.querySelectorAll('[id$="Modal"]').forEach(m => {
    m.addEventListener('click', e => { if (e.target === m) closeModal(m.id); });
});
// Close on Escape key
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') {
        document.querySelectorAll('[id$="Modal"]').forEach(m => {
            if (!m.classList.contains('hidden')) closeModal(m.id);
        });
    }
});

// Auth state management
function updateAuthUI() {
    const user = JSON.parse(localStorage.getItem('user') || 'null');
    const authButtons = document.getElementById('authButtons');
    const userMenu = document.getElementById('userMenu');
    if (user) {
        authButtons.classList.add('hidden');
        authButtons.classList.remove('flex');
        userMenu.classList.remove('hidden');
        userMenu.classList.add('flex');
        document.getElementById('userName').textContent = user.name;
    } else {
        authButtons.classList.remove('hidden');
        authButtons.classList.add('flex');
        userMenu.classList.add('hidden');
        userMenu.classList.remove('flex');
    }
}

// Register
document.getElementById('registerForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const errEl = document.getElementById('registerError');
    errEl.classList.add('hidden');
    try {
        const res = await fetch(BASE + '/api/register', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                name: document.getElementById('regName').value,
                email: document.getElementById('regEmail').value,
                password: document.getElementById('regPassword').value,
                phone: document.getElementById('regPhone').value || null
            })
        });
        const data = await res.json();
        if (res.ok && data.user) {
            localStorage.setItem('user', JSON.stringify(data.user));
            closeModal('registerModal');
            updateAuthUI();
        } else {
            errEl.textContent = data.error || 'שגיאה בהרשמה';
            errEl.classList.remove('hidden');
        }
    } catch {
        errEl.textContent = 'שגיאה בחיבור לשרת';
        errEl.classList.remove('hidden');
    }
});

// Login
document.getElementById('loginForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const errEl = document.getElementById('loginError');
    errEl.classList.add('hidden');
    try {
        const res = await fetch(BASE + '/api/login', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                email: document.getElementById('loginEmail').value,
                password: document.getElementById('loginPassword').value
            })
        });
        const data = await res.json();
        if (res.ok && data.user) {
            localStorage.setItem('user', JSON.stringify(data.user));
            closeModal('loginModal');
            updateAuthUI();
        } else {
            errEl.textContent = data.error || 'אימייל או סיסמה שגויים';
            errEl.classList.remove('hidden');
        }
    } catch {
        errEl.textContent = 'שגיאה בחיבור לשרת';
        errEl.classList.remove('hidden');
    }
});

// Logout
function logout() {
    localStorage.removeItem('user');
    updateAuthUI();
    window.location.href = BASE + '/';
}

// Initialize auth UI
updateAuthUI();

// Load header + footer settings from API
(async function loadLayoutSettings() {
    try {
        const res = await fetch(BASE + '/api/admin/settings');
        const s = await res.json();

        // Header
        if (s.header_logo_title) document.getElementById('headerLogoTitle').textContent = s.header_logo_title;
        if (s.header_logo_tagline) document.getElementById('headerLogoTagline').textContent = s.header_logo_tagline;
        // Nav link labels
        if (s.nav_home) { document.getElementById('navHome').textContent = s.nav_home; const m = document.querySelector('[data-nav-mobile="home"]'); if (m) m.textContent = s.nav_home; }
        if (s.nav_about) { document.getElementById('navAbout').textContent = s.nav_about; const m = document.querySelector('[data-nav-mobile="about"]'); if (m) m.textContent = s.nav_about; }
        if (s.nav_search) { document.getElementById('navSearch').textContent = s.nav_search; const m = document.querySelector('[data-nav-mobile="search"]'); if (m) m.textContent = s.nav_search; }
        if (s.nav_process) { document.getElementById('navProcess').textContent = s.nav_process; const m = document.querySelector('[data-nav-mobile="process"]'); if (m) m.textContent = s.nav_process; }
        if (s.nav_vip) { document.getElementById('navVip').textContent = s.nav_vip; const m = document.querySelector('[data-nav-mobile="vip"]'); if (m) m.textContent = s.nav_vip; }
        if (s.nav_stories) { document.getElementById('navStories').textContent = s.nav_stories; const m = document.querySelector('[data-nav-mobile="stories"]'); if (m) m.textContent = s.nav_stories; }
        if (s.nav_faq) { document.getElementById('navFaq').textContent = s.nav_faq; const m = document.querySelector('[data-nav-mobile="faq"]'); if (m) m.textContent = s.nav_faq; }
        if (s.nav_contact) { document.getElementById('navContact').textContent = s.nav_contact; const m = document.querySelector('[data-nav-mobile="contact"]'); if (m) m.textContent = s.nav_contact; }

        // Footer
        if (s.footer_logo_title) document.getElementById('footerLogoTitle').textContent = s.footer_logo_title;
        if (s.footer_logo_tagline) document.getElementById('footerLogoTagline').textContent = s.footer_logo_tagline;
        if (s.footer_desc) document.getElementById('footerDesc').textContent = s.footer_desc;
        if (s.footer_phone) document.getElementById('footerPhone').textContent = s.footer_phone;
        if (s.footer_email) document.getElementById('footerEmail').textContent = s.footer_email;
        if (s.footer_address) document.getElementById('footerAddress').textContent = s.footer_address;
        if (s.footer_copy) document.getElementById('footerCopy').textContent = s.footer_copy;
        if (s.footer_links) {
            const ul = document.getElementById('footerLinks');
            const links = s.footer_links.split('\n').filter(l => l.trim());
            ul.innerHTML = links.map(l => {
                const [name, url] = l.split('|').map(x => x.trim());
                return `<li><a class="hover:text-primary transition-colors" href="${url || '#'}">${name}</a></li>`;
            }).join('');
        }
        // Social links
        if (s.social_icon1) document.getElementById('socialIcon1').textContent = s.social_icon1;
        if (s.social_url1) document.getElementById('socialLink1').href = s.social_url1;
        if (s.social_icon2) document.getElementById('socialIcon2').textContent = s.social_icon2;
        if (s.social_url2) document.getElementById('socialLink2').href = s.social_url2;
        if (s.social_icon3) document.getElementById('socialIcon3').textContent = s.social_icon3;
        if (s.social_url3) document.getElementById('socialLink3').href = s.social_url3;
    } catch(e) {
        // Settings API unavailable - use defaults
    }
})();

// Auto-open login modal if redirected from a protected page
if (new URLSearchParams(window.location.search).get('login') === '1') {
    if (!localStorage.getItem('user')) openModal('loginModal');
    history.replaceState(null, '', window.location.pathname);
}
</script>

<!-- Admin Float Button (hidden when admin inline bar is active) -->
<a id="adminFloatBtn" href="<?= BASE_URL ?>/admin" class="fixed bottom-6 left-6 z-50 flex items-center gap-2 bg-card/90 border border-white/10 hover:border-primary/50 text-slate-400 hover:text-primary px-4 py-3 rounded-xl shadow-2xl backdrop-blur-sm transition-all hover:scale-105 group">
    <span class="material-symbols-outlined text-xl">admin_panel_settings</span>
    <span class="text-sm font-bold">פאנל ניהול</span>
    <span class="material-symbols-outlined text-sm text-slate-600">lock</span>
</a>

<!-- Dynamic Page Blocks Renderer -->
<script>
(function() {
    function renderBlockHTML(block) {
        const d = block.block_data || {};
        const type = block.block_type;
        switch (type) {
            case 'heading':
                const lvl = d.level || 'h2';
                const align = d.align || 'center';
                const sizes = { h1: 'text-5xl md:text-6xl', h2: 'text-4xl md:text-5xl', h3: 'text-3xl md:text-4xl', h4: 'text-2xl md:text-3xl' };
                return `<section class="py-12 px-6 aie-dynamic-block" data-block-id="${block.id}"><div class="max-w-7xl mx-auto text-${align}"><${lvl} class="${sizes[lvl] || sizes.h2} font-black text-white">${escapeHtml(d.text || '')}</${lvl}></div></section>`;

            case 'text':
                return `<section class="py-10 px-6 aie-dynamic-block" data-block-id="${block.id}"><div class="max-w-4xl mx-auto text-slate-300 text-lg leading-relaxed" style="text-align:${d.align || 'right'}">${escapeHtml(d.content || '').replace(/\n/g, '<br>')}</div></section>`;

            case 'image':
                const imgW = d.width === 'full' ? 'w-full' : (d.width === 'small' ? 'max-w-lg' : 'max-w-4xl');
                return `<section class="py-12 px-6 aie-dynamic-block" data-block-id="${block.id}"><div class="max-w-7xl mx-auto text-center"><img src="${escapeAttr(d.url || '')}" alt="${escapeAttr(d.alt || '')}" class="rounded-2xl shadow-2xl mx-auto ${imgW} border border-white/10"/></div></section>`;

            case 'video':
                const videoUrl = convertVideoUrl(d.url || '');
                return `<section class="py-12 px-6 aie-dynamic-block" data-block-id="${block.id}"><div class="max-w-4xl mx-auto aspect-video rounded-2xl overflow-hidden border border-white/10 shadow-2xl"><iframe src="${escapeAttr(videoUrl)}" class="w-full h-full" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div></section>`;

            case 'spacer':
                return `<div class="aie-dynamic-block" data-block-id="${block.id}" style="height:${parseInt(d.height) || 60}px"></div>`;

            case 'image_text':
                const imgPos = d.image_position === 'left' ? 'order-2' : 'order-1';
                const txtPos = d.image_position === 'left' ? 'order-1' : 'order-2';
                return `<section class="py-16 px-6 aie-dynamic-block" data-block-id="${block.id}"><div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-12 items-center"><div class="${imgPos}"><img src="${escapeAttr(d.image_url || '')}" alt="" class="rounded-2xl shadow-2xl w-full border border-white/10"/></div><div class="${txtPos} text-right"><h3 class="text-3xl font-bold text-white mb-4">${escapeHtml(d.title || '')}</h3><p class="text-slate-300 text-lg leading-relaxed">${escapeHtml(d.text || '').replace(/\n/g, '<br>')}</p></div></div></section>`;

            case 'cta':
                const bgColor = d.bg_color || 'primary';
                const bgClass = bgColor === 'primary' ? 'bg-primary text-[#12110a]' : (bgColor === 'dark' ? 'bg-surface text-white' : 'bg-primary text-[#12110a]');
                return `<section class="py-20 px-6 ${bgClass} aie-dynamic-block" data-block-id="${block.id}"><div class="max-w-4xl mx-auto text-center"><h3 class="text-3xl md:text-5xl font-black mb-6">${escapeHtml(d.title || '')}</h3><p class="text-lg md:text-xl mb-10 opacity-80">${escapeHtml(d.subtitle || '')}</p>${d.button_text ? `<a href="${escapeAttr(d.button_url || '#')}" class="inline-block ${bgColor === 'primary' ? 'bg-[#12110a] text-primary' : 'bg-primary text-[#12110a]'} px-12 py-5 rounded-2xl font-bold text-xl hover:scale-105 transition-transform">${escapeHtml(d.button_text)}</a>` : ''}</div></section>`;

            case 'gallery':
                const images = d.images || [];
                const cols = d.columns || 3;
                return `<section class="py-12 px-6 aie-dynamic-block" data-block-id="${block.id}"><div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-${cols} gap-4">${images.map(img => `<div class="rounded-xl overflow-hidden border border-white/10 aspect-square"><img src="${escapeAttr(img.url || img)}" alt="${escapeAttr(img.alt || '')}" class="w-full h-full object-cover hover:scale-110 transition-transform duration-500"/></div>`).join('')}</div></section>`;

            case 'divider':
                const divStyle = d.style || 'line';
                if (divStyle === 'dots') return `<section class="py-8 aie-dynamic-block" data-block-id="${block.id}"><div class="flex justify-center gap-3"><span class="size-2 rounded-full bg-primary/40"></span><span class="size-2 rounded-full bg-primary"></span><span class="size-2 rounded-full bg-primary/40"></span></div></section>`;
                return `<section class="py-8 px-6 aie-dynamic-block" data-block-id="${block.id}"><div class="max-w-4xl mx-auto"><div class="h-px bg-gradient-to-r from-transparent via-primary/40 to-transparent"></div></div></section>`;

            default:
                return `<section class="py-8 px-6 aie-dynamic-block" data-block-id="${block.id}"><div class="max-w-4xl mx-auto text-slate-500 text-center">[${type}]</div></section>`;
        }
    }

    function escapeHtml(s) {
        const d = document.createElement('div');
        d.textContent = s;
        return d.innerHTML;
    }
    function escapeAttr(s) { return (s || '').replace(/"/g, '&quot;').replace(/'/g, '&#39;').replace(/</g, '&lt;'); }
    function convertVideoUrl(url) {
        const yt = url.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/)([\w-]+)/);
        if (yt) return 'https://www.youtube.com/embed/' + yt[1];
        const vm = url.match(/vimeo\.com\/(\d+)/);
        if (vm) return 'https://player.vimeo.com/video/' + vm[1];
        return url;
    }

    // Expose globally for admin-inline reuse
    window.aieRenderBlockHTML = renderBlockHTML;

    // Load and render blocks for current page
    async function loadPageBlocks() {
        if (!window.CURRENT_PAGE) return;
        try {
            const res = await fetch(BASE + '/api/blocks?page=' + encodeURIComponent(CURRENT_PAGE));
            const blocks = await res.json();
            if (!blocks.length) return;

            const main = document.querySelector('main');
            if (!main) return;
            const sections = Array.from(main.querySelectorAll(':scope > section, :scope > div:not(.aie-dynamic-block)'));

            // Group blocks by insert_after
            const groups = {};
            blocks.forEach(b => {
                const key = b.insert_after !== null ? b.insert_after : -1;
                if (!groups[key]) groups[key] = [];
                groups[key].push(b);
            });

            // Insert blocks at top (insert_after = -1 or null)
            if (groups[-1]) {
                const frag = document.createRange().createContextualFragment(
                    groups[-1].map(b => renderBlockHTML(b)).join('')
                );
                if (sections.length > 0) {
                    main.insertBefore(frag, sections[0]);
                } else {
                    main.appendChild(frag);
                }
            }

            // Insert blocks after each section index
            sections.forEach((sec, i) => {
                if (groups[i]) {
                    const frag = document.createRange().createContextualFragment(
                        groups[i].map(b => renderBlockHTML(b)).join('')
                    );
                    sec.after(frag);
                }
            });

            // Also check for hidden sections from settings
            try {
                const sRes = await fetch(BASE + '/api/admin/settings');
                const settings = await sRes.json();
                sections.forEach((sec, i) => {
                    const hideKey = CURRENT_PAGE + '_section_' + i + '_hidden';
                    if (settings[hideKey] === '1' || settings[hideKey] === 'true') {
                        sec.style.display = 'none';
                        sec.setAttribute('data-aie-hidden', 'true');
                    }
                });
            } catch {}

        } catch (e) {
            console.error('Error loading page blocks:', e);
        }
    }

    // Run after DOM and other scripts have loaded
    setTimeout(loadPageBlocks, 300);
})();
</script>

<!-- Auto-apply saved colors & links for all visitors -->
<script>
setTimeout(async function aieApplyStyleSettings() {
    try {
        const res = await fetch((typeof BASE !== 'undefined' ? BASE : '/moldova') + '/api/admin/settings');
        const s = await res.json();
        Object.keys(s).forEach(k => {
            let baseKey, elId, el;
            if (k.endsWith('_bg_color')) {
                baseKey = k.replace(/_bg_color$/, '');
                elId = baseKey.replace(/_([a-z0-9])/g, (_, c) => c.toUpperCase());
                el = document.getElementById(elId);
                if (el && s[k]) el.style.backgroundColor = s[k];
            } else if (k.endsWith('_color')) {
                baseKey = k.replace(/_color$/, '');
                elId = baseKey.replace(/_([a-z0-9])/g, (_, c) => c.toUpperCase());
                el = document.getElementById(elId);
                if (el && s[k]) el.style.color = s[k];
            } else if (k.endsWith('_link')) {
                baseKey = k.replace(/_link$/, '');
                elId = baseKey.replace(/_([a-z0-9])/g, (_, c) => c.toUpperCase());
                el = document.getElementById(elId);
                if (el && el.tagName === 'A' && s[k]) el.setAttribute('href', s[k]);
            }
        });
    } catch(e) {}
}, 800);
</script>

<?php
// Include admin inline editing on ALL pages (only renders if $isAdmin is true)
require BASE_PATH . '/app/views/layouts/admin-inline.php';
?>

<script>
function toggleTheme() {
    var html = document.documentElement;
    var isLight = html.classList.contains('light');
    if (isLight) {
        html.classList.remove('light');
        html.classList.add('dark');
        localStorage.setItem('site_theme', 'dark');
    } else {
        html.classList.remove('dark');
        html.classList.add('light');
        localStorage.setItem('site_theme', 'light');
    }
    updateThemeIcons();
}
function updateThemeIcons() {
    var isLight = document.documentElement.classList.contains('light');
    var newIcon = isLight ? 'dark_mode' : 'light_mode';
    ['themeIcon', 'themeIconMobile'].forEach(function(id) {
        var el = document.getElementById(id);
        if (el) el.textContent = newIcon;
    });
}
document.addEventListener('DOMContentLoaded', updateThemeIcons);
</script>
</body>
</html>
