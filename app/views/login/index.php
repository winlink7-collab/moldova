<?php $pageTitle = t('login_title') . ' - Moldova & Ukraine Luxury Brides'; $pageDescription = t('login_subtitle'); $currentPage = 'login'; ?>
<?php include BASE_PATH . '/app/views/layouts/header.php'; ?>

<!-- Login Page -->
<section class="relative min-h-[calc(100vh-5rem)] flex items-center justify-center py-12 px-4">

    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-background-dark"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,rgba(242,208,13,0.08)_0%,transparent_70%)]"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-background-dark/50 via-transparent to-background-dark"></div>
    </div>

    <div class="relative z-10 w-full max-w-[500px] luxury-gradient p-8 md:p-12 rounded-xl gold-border shadow-2xl backdrop-blur-sm">

        <div class="text-center mb-10">
            <div class="inline-block p-3 rounded-full bg-primary/5 mb-4 gold-border">
                <span class="material-symbols-outlined text-primary text-4xl">lock_person</span>
            </div>
            <h1 class="serif-text text-3xl md:text-4xl font-bold text-white mb-3"><?= t('login_title') ?></h1>
            <div class="h-0.5 w-16 bg-primary mx-auto mb-4"></div>
            <p class="text-slate-400 text-base"><?= t('login_subtitle') ?></p>
        </div>

        <form id="loginPageForm" class="space-y-6">
            <div class="space-y-2">
                <label class="block text-primary text-sm font-semibold pr-1"><?= t('email') ?></label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 text-xl">person</span>
                    <input id="loginPageEmail" class="w-full bg-[#1c1a0f]/50 border border-white/10 rounded-lg py-4 pr-12 pl-4 text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder:text-slate-600" placeholder="email@example.com" type="email" required/>
                </div>
            </div>
            <div class="space-y-2">
                <label class="block text-primary text-sm font-semibold pr-1"><?= t('password') ?></label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 text-xl">key</span>
                    <input id="loginPagePassword" class="w-full bg-[#1c1a0f]/50 border border-white/10 rounded-lg py-4 pr-12 pl-4 text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder:text-slate-600" placeholder="••••••••" type="password" required/>
                </div>
            </div>

            <div id="loginPageError" class="hidden text-center text-sm font-bold text-red-400"></div>

            <div class="pt-2">
                <button class="w-full bg-primary hover:bg-primary/80 text-background-dark font-bold py-4 rounded-lg text-lg transition-all transform hover:scale-[1.01] shadow-xl shadow-primary/10 serif-text" type="submit">
                    <?= t('login_submit') ?>
                </button>
            </div>
        </form>

        <div class="flex items-center my-8">
            <div class="flex-1 h-px bg-white/10"></div>
            <span class="px-4 text-slate-500 text-sm"><?= t('or_via') ?></span>
            <div class="flex-1 h-px bg-white/10"></div>
        </div>

        <div class="flex gap-4">
            <button type="button" class="flex-1 flex items-center justify-center gap-3 py-3.5 border border-white/10 rounded-lg hover:bg-white/5 transition-all group">
                <svg class="w-5 h-5" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                </svg>
                <span class="text-slate-300 text-sm font-semibold group-hover:text-white transition-colors">Google</span>
            </button>
            <button type="button" class="flex-1 flex items-center justify-center gap-3 py-3.5 border border-white/10 rounded-lg hover:bg-white/5 transition-all group">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                    <path class="text-slate-300" d="M17.05 20.28c-.98.95-2.05.88-3.08.4-1.09-.5-2.08-.48-3.24 0-1.44.62-2.2.44-3.06-.4C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.5-1.31 2.99-2.54 4.09zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.32 2.32-1.55 4.3-3.74 4.25z"/>
                </svg>
                <span class="text-slate-300 text-sm font-semibold group-hover:text-white transition-colors">Apple ID</span>
            </button>
        </div>

        <div class="mt-8 text-center space-y-3">
            <p><a href="<?= BASE_URL ?>/dashboard?forgot=1" class="text-slate-400 text-sm hover:text-primary transition-colors"><?= t('forgot_password') ?></a></p>
            <p class="text-slate-400 text-sm"><?= t('not_member_yet') ?> <a href="<?= BASE_URL ?>/register" class="text-primary font-bold hover:underline"><?= t('register') ?></a></p>
        </div>

    </div>
</section>

<script>
document.getElementById('loginPageForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const email    = document.getElementById('loginPageEmail').value;
    const password = document.getElementById('loginPagePassword').value;
    const errEl    = document.getElementById('loginPageError');

    errEl.classList.add('hidden');

    try {
        const res = await fetch(`${BASE_URL}/api/login`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email, password })
        });

        const data = await res.json();

        if (res.ok && data.user) {
            localStorage.setItem('user', JSON.stringify(data.user));
            window.location.href = `${BASE_URL}/dashboard`;
        } else {
            errEl.textContent = data.error || T.login_error;
            errEl.classList.remove('hidden');
        }
    } catch (err) {
        errEl.textContent = T.login_server_error;
        errEl.classList.remove('hidden');
    }
});

(function() {
    const user = JSON.parse(localStorage.getItem('user') || 'null');
    if (user) {
        window.location.href = `${BASE_URL}/dashboard`;
    }
})();
</script>

<?php include BASE_PATH . '/app/views/layouts/footer.php'; ?>
