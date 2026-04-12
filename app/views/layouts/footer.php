
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
                <?= t('footer_desc') ?>
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
            <h5 class="text-white font-bold mb-6"><?= t('quick_links') ?></h5>
            <ul id="footerLinks" class="space-y-4 text-sm text-gold-muted">
                <li><a class="hover:text-primary transition-colors" href="<?= BASE_URL ?>/about"><?= t('footer_about_link') ?></a></li>
                <li><a class="hover:text-primary transition-colors" href="<?= BASE_URL ?>/process"><?= t('footer_process_link') ?></a></li>
                <li><a class="hover:text-primary transition-colors" href="<?= BASE_URL ?>/vip"><?= t('footer_vip_link') ?></a></li>
                <li><a class="hover:text-primary transition-colors" href="<?= BASE_URL ?>/faq"><?= t('footer_faq_link') ?></a></li>
                <li><a class="hover:text-primary transition-colors" href="<?= BASE_URL ?>/contact"><?= t('footer_contact_link') ?></a></li>
            </ul>
        </div>

        <!-- Contact Info -->
        <div>
            <h5 class="text-white font-bold mb-6"><?= t('contact_us') ?></h5>
            <ul class="space-y-4 text-sm text-gold-muted">
                <li class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary text-lg">location_on</span>
                    <span id="footerAddress"><?= t('footer_address') ?></span>
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
        <div class="flex items-center justify-center gap-4 mt-5">
            <a href="?lang=he" onclick="switchLang('he')" class="flex items-center gap-2 text-sm font-bold transition-all <?= ($CURRENT_LANG ?? 'he') === 'he' ? 'text-primary' : 'text-slate-500 hover:text-primary' ?>">
                <span style="display:inline-block;width:24px;height:16px;background:linear-gradient(to bottom,#fff 15%,#0038b8 15%,#0038b8 30%,#fff 30%,#fff 70%,#0038b8 70%,#0038b8 85%,#fff 85%);border-radius:2px;border:1px solid rgba(255,255,255,0.15);position:relative;overflow:hidden;"><span style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);font-size:11px;color:#0038b8;">✡</span></span>
                עברית
            </a>
            <span class="text-slate-700">|</span>
            <a href="?lang=ru" onclick="switchLang('ru')" class="flex items-center gap-2 text-sm font-bold transition-all <?= ($CURRENT_LANG ?? 'he') === 'ru' ? 'text-primary' : 'text-slate-500 hover:text-primary' ?>">
                <span style="display:inline-block;width:24px;height:16px;border-radius:2px;border:1px solid rgba(255,255,255,0.15);background:linear-gradient(to bottom,#fff 33%,#0039a6 33%,#0039a6 66%,#d52b1e 66%);"></span>
                Русский
            </a>
            <span class="text-slate-700">|</span>
            <a href="?lang=en" onclick="switchLang('en')" class="flex items-center gap-2 text-sm font-bold transition-all <?= ($CURRENT_LANG ?? 'he') === 'en' ? 'text-primary' : 'text-slate-500 hover:text-primary' ?>">
                <span style="display:inline-block;width:24px;height:16px;border-radius:2px;border:1px solid rgba(255,255,255,0.15);background:#00247d;position:relative;overflow:hidden;"><span style="position:absolute;inset:0;background:linear-gradient(to bottom,transparent 35%,#fff 35%,#fff 42%,#cf142b 42%,#cf142b 58%,#fff 58%,#fff 65%,transparent 65%);"></span><span style="position:absolute;inset:0;background:linear-gradient(to right,transparent 40%,#fff 40%,#fff 47%,#cf142b 47%,#cf142b 53%,#fff 53%,#fff 60%,transparent 60%);"></span></span>
                English
            </a>
        </div>
    </div>
</div>
</footer>

</div>
<!-- End .relative.flex.min-h-screen -->

<!-- Login Modal -->
<div id="loginModal" class="fixed inset-0 z-[100] hidden items-start sm:items-center justify-center bg-black/80 backdrop-blur-sm overflow-y-auto p-3 sm:p-4">
<div class="relative w-full max-w-[420px] bg-[#1a1810] border border-border-gold/40 p-6 sm:p-8 rounded-2xl shadow-2xl my-4 sm:my-auto">
    <button onclick="closeModal('loginModal')" class="absolute top-3 left-3 text-slate-400 hover:text-white transition-colors p-1">
        <span class="material-symbols-outlined text-xl">close</span>
    </button>
    <div class="text-center mb-6">
        <div class="inline-block p-2.5 rounded-full bg-primary/10 mb-3 border border-primary/30">
            <span class="material-symbols-outlined text-primary text-3xl">lock_person</span>
        </div>
        <h1 class="text-xl sm:text-2xl font-black text-white mb-1"><?= t('login_modal_title') ?></h1>
        <p class="text-slate-400 text-xs sm:text-sm"><?= t('login_modal_subtitle') ?></p>
    </div>
    <form id="loginForm" class="space-y-4">
        <div>
            <label class="block text-primary text-xs font-bold mb-1.5 pr-1"><?= t('email') ?></label>
            <div class="relative">
                <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-slate-500 text-base">person</span>
                <input id="loginEmail" class="w-full bg-[#0f0e08] border border-white/10 rounded-lg py-2.5 pr-10 pl-3 text-white text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder:text-slate-600" placeholder="email@example.com" type="email" required/>
            </div>
        </div>
        <div>
            <label class="block text-primary text-xs font-bold mb-1.5 pr-1"><?= t('password') ?></label>
            <div class="relative">
                <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-slate-500 text-base">key</span>
                <input id="loginPassword" class="w-full bg-[#0f0e08] border border-white/10 rounded-lg py-2.5 pr-10 pl-3 text-white text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder:text-slate-600" placeholder="••••••••" type="password" required/>
            </div>
        </div>
        <div id="loginError" class="hidden text-center text-xs font-bold text-red-400 py-1"></div>
        <button class="w-full bg-gradient-to-r from-primary to-[#b89b06] hover:brightness-110 text-background-dark font-black py-3.5 rounded-lg text-base transition-all shadow-lg" type="submit">
            <?= t('login_modal_submit') ?>
        </button>
    </form>
    <div class="mt-4 text-center space-y-2">
        <p><a href="<?= BASE_URL ?>/dashboard?forgot=1" class="text-slate-400 text-xs hover:text-primary transition-colors"><?= t('forgot_password') ?></a></p>
        <p class="text-slate-400 text-xs"><?= t('not_member_yet') ?> <a onclick="closeModal('loginModal'); openModal('registerModal')" class="text-primary font-bold hover:underline cursor-pointer"><?= t('register') ?></a></p>
    </div>
</div>
</div>

<!-- Register Modal -->
<div id="registerModal" class="fixed inset-0 z-[100] hidden items-start sm:items-center justify-center bg-black/80 backdrop-blur-sm overflow-y-auto p-3 sm:p-4">
<div class="relative w-full max-w-[460px] bg-[#1a1810] border border-border-gold/40 p-6 sm:p-8 rounded-2xl shadow-2xl my-4 sm:my-auto">
    <button onclick="closeModal('registerModal')" class="absolute top-3 left-3 text-slate-400 hover:text-white transition-colors p-1">
        <span class="material-symbols-outlined text-xl">close</span>
    </button>
    <div class="text-center mb-6">
        <div class="inline-block p-2.5 rounded-full bg-primary/10 mb-3 border border-primary/30">
            <span class="material-symbols-outlined text-primary text-3xl">person_add</span>
        </div>
        <h1 class="text-xl sm:text-2xl font-black text-white mb-1"><?= t('register_modal_title') ?></h1>
        <p class="text-slate-400 text-xs sm:text-sm"><?= t('register_modal_subtitle') ?></p>
    </div>
    <form id="registerForm" class="space-y-3">
        <div>
            <label class="block text-primary text-xs font-bold mb-1.5 pr-1"><?= t('full_name') ?></label>
            <div class="relative">
                <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-slate-500 text-base">badge</span>
                <input id="regName" class="w-full bg-[#0f0e08] border border-white/10 rounded-lg py-2.5 pr-10 pl-3 text-white text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder:text-slate-600" placeholder="<?= t('register_placeholder_name') ?>" type="text" required/>
            </div>
        </div>
        <div>
            <label class="block text-primary text-xs font-bold mb-1.5 pr-1"><?= t('email') ?></label>
            <div class="relative">
                <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-slate-500 text-base">mail</span>
                <input id="regEmail" class="w-full bg-[#0f0e08] border border-white/10 rounded-lg py-2.5 pr-10 pl-3 text-white text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder:text-slate-600" placeholder="email@example.com" type="email" required/>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block text-primary text-xs font-bold mb-1.5 pr-1"><?= t('password') ?></label>
                <input id="regPassword" class="w-full bg-[#0f0e08] border border-white/10 rounded-lg py-2.5 px-3 text-white text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder:text-slate-600" placeholder="••••••••" type="password" required/>
            </div>
            <div>
                <label class="block text-primary text-xs font-bold mb-1.5 pr-1"><?= t('age') ?></label>
                <input id="regAge" class="w-full bg-[#0f0e08] border border-white/10 rounded-lg py-2.5 px-3 text-white text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder:text-slate-600" placeholder="35" type="number"/>
            </div>
        </div>
        <div>
            <label class="block text-primary text-xs font-bold mb-1.5 pr-1"><?= t('phone') ?></label>
            <div class="relative">
                <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-slate-500 text-base">phone</span>
                <input id="regPhone" class="w-full bg-[#0f0e08] border border-white/10 rounded-lg py-2.5 pr-10 pl-3 text-white text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder:text-slate-600" placeholder="050-1234567" type="tel"/>
            </div>
        </div>
        <div id="registerError" class="hidden text-center text-xs font-bold text-red-400 py-1"></div>
        <button class="w-full bg-gradient-to-r from-primary to-[#b89b06] hover:brightness-110 text-background-dark font-black py-3.5 rounded-lg text-base transition-all shadow-lg mt-2" type="submit">
            <?= t('register_modal_submit') ?>
        </button>
    </form>
    <div class="mt-4 text-center">
        <p class="text-slate-400 text-xs"><?= t('already_member') ?> <a onclick="closeModal('registerModal'); openModal('loginModal')" class="text-primary font-bold hover:underline cursor-pointer"><?= t('login') ?></a></p>
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

// Beautiful verification success modal
function showVerificationSuccess(email) {
    let modal = document.getElementById('verifyEmailModal');
    if (!modal) {
        modal = document.createElement('div');
        modal.id = 'verifyEmailModal';
        modal.className = 'fixed inset-0 z-[200] flex items-center justify-center bg-black/80 backdrop-blur-md p-4';
        modal.innerHTML = `
            <div class="relative w-full max-w-[480px] bg-gradient-to-b from-[#1a1810] to-[#12110a] border border-primary/30 rounded-3xl shadow-2xl p-8 sm:p-10 text-center" style="box-shadow: 0 0 80px rgba(242,208,13,0.15);">
                <button onclick="document.getElementById('verifyEmailModal').remove()" class="absolute top-4 left-4 text-slate-400 hover:text-white transition-colors p-1">
                    <span class="material-symbols-outlined text-xl">close</span>
                </button>

                <!-- Animated checkmark icon -->
                <div class="relative mx-auto mb-6 w-24 h-24">
                    <div class="absolute inset-0 rounded-full bg-primary/20 animate-ping"></div>
                    <div class="relative w-24 h-24 rounded-full bg-gradient-to-br from-primary to-[#b89b06] flex items-center justify-center shadow-[0_0_40px_rgba(242,208,13,0.4)]">
                        <span class="material-symbols-outlined text-background-dark text-5xl font-black" style="font-variation-settings:'FILL' 1">mark_email_read</span>
                    </div>
                </div>

                <h2 class="text-2xl sm:text-3xl font-black text-white mb-3">${T.registration_success || 'ההרשמה הצליחה! 🎉'}</h2>
                <p class="text-slate-300 text-sm sm:text-base mb-6 leading-relaxed">
                    ${T.verification_sent_to || 'שלחנו קישור אימות למייל'}<br>
                    <strong class="text-primary text-lg">${email}</strong>
                </p>

                <div class="bg-primary/5 border border-primary/20 rounded-xl p-4 mb-6 text-right">
                    <p class="text-xs sm:text-sm text-slate-300 mb-2 font-bold flex items-center gap-2 justify-end">
                        <span>${T.next_steps || 'השלבים הבאים:'}</span>
                        <span class="material-symbols-outlined text-primary">checklist</span>
                    </p>
                    <ol class="text-xs sm:text-sm text-slate-400 space-y-1.5 list-decimal pr-5">
                        <li>${T.check_inbox || 'פתח את תיבת הדואר שלך'}</li>
                        <li>${T.check_spam || 'בדוק גם בתיקיית ספאם / קידום מכירות'}</li>
                        <li>${T.click_verify || 'לחץ על כפתור "אמת את המייל שלי"'}</li>
                        <li>${T.return_login || 'חזור לאתר כדי להתחבר'}</li>
                    </ol>
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <button onclick="document.getElementById('verifyEmailModal').remove()" class="flex-1 bg-gradient-to-r from-primary to-[#b89b06] hover:brightness-110 text-background-dark font-black py-3 rounded-xl text-sm transition-all shadow-lg">
                        ${T.got_it || 'הבנתי!'}
                    </button>
                    <button onclick="resendVerification('${email}')" class="flex-1 bg-white/5 hover:bg-white/10 border border-white/10 text-slate-300 font-bold py-3 rounded-xl text-sm transition-all">
                        ${T.resend_email || 'שלח שוב'}
                    </button>
                </div>

                <p class="text-[10px] text-slate-600 mt-4">${T.didnt_receive || 'לא קיבלת? בדוק בתיקיית ספאם או לחץ "שלח שוב"'}</p>
            </div>
        `;
        document.body.appendChild(modal);
    }
    modal.classList.remove('hidden');
}

async function resendVerification(email) {
    try {
        const res = await fetch(BASE + '/api/resend-verification', {
            method: 'POST',
            headers: {'Content-Type':'application/json'},
            body: JSON.stringify({email: email})
        });
        const d = await res.json();
        if (res.ok) {
            const btn = event.target;
            btn.textContent = T.resent || '✓ נשלח';
            btn.disabled = true;
            setTimeout(() => { btn.textContent = T.resend_email || 'שלח שוב'; btn.disabled = false; }, 5000);
        }
    } catch(e) {}
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
        if (res.ok) {
            if (data.needs_verification) {
                closeModal('registerModal');
                showVerificationSuccess(document.getElementById('regEmail').value);
            } else if (data.user) {
                localStorage.setItem('user', JSON.stringify(data.user));
                closeModal('registerModal');
                updateAuthUI();
            } else {
                closeModal('registerModal');
                showVerificationSuccess(document.getElementById('regEmail').value);
            }
        } else {
            errEl.textContent = data.error || T.register_error;
            errEl.classList.remove('hidden');
        }
    } catch {
        errEl.textContent = T.server_error;
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
            errEl.textContent = data.error || T.login_error;
            errEl.classList.remove('hidden');
        }
    } catch {
        errEl.textContent = T.server_error;
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
    <span class="text-sm font-bold"><?= t('admin_panel') ?></span>
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

<!-- Language & Font Scripts -->
<script>
function switchLang(lang) {
    if (event) event.preventDefault();
    document.cookie = 'site_lang=' + lang + '; path=/; max-age=31536000';
    var url = new URL(window.location.href);
    url.searchParams.set('lang', lang);
    window.location.href = url.toString();
}

function setFont(fontName) {
    document.documentElement.style.setProperty('--site-font', "'" + fontName + "', sans-serif");
    document.body.style.fontFamily = "'" + fontName + "', sans-serif";
    localStorage.setItem('site_font', "'" + fontName + "', sans-serif");
    // Save to server settings too
    if (typeof BASE !== 'undefined') {
        fetch(BASE + '/api/admin/settings', {
            method: 'POST',
            headers: {'Content-Type':'application/json'},
            body: JSON.stringify({site_font: fontName})
        }).catch(function(){});
    }
    // Highlight active
    document.querySelectorAll('.font-btn').forEach(function(btn) {
        btn.classList.remove('bg-primary/20', 'text-primary');
    });
    if (event && event.target) {
        event.target.classList.add('bg-primary/20', 'text-primary');
    }
    // Close picker
    var picker = document.getElementById('fontPicker');
    if (picker) picker.classList.add('hidden');
}
</script>
</body>
</html>
