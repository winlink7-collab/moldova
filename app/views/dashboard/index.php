<?php $pageTitle = t('dashboard_title') . ' - Moldova & Ukraine Luxury Brides'; $pageDescription = t('welcome_to_area'); $currentPage = 'dashboard'; ?>
<?php include BASE_PATH . '/app/views/layouts/header.php'; ?>

<style>
    .tab-active { border-color: #f2d00d; color: #f2d00d; }
    .gold-glow { box-shadow: 0 0 40px rgba(242, 208, 13, 0.08); }
</style>

<!-- RESET PASSWORD VIEW -->
<section id="resetPasswordView" class="hidden px-6 py-20">
    <div class="max-w-md mx-auto">
        <div class="bg-surface border border-border-gold/30 rounded-2xl p-8 md:p-12 gold-glow">
            <div class="text-center mb-10">
                <div class="inline-block p-3 rounded-full bg-primary/10 border border-primary/20 mb-4">
                    <span class="material-symbols-outlined text-primary text-4xl">lock_reset</span>
                </div>
                <h2 class="text-3xl font-black text-white mb-3"><?= t('reset_password') ?></h2>
                <div class="h-0.5 w-16 bg-primary mx-auto mb-4"></div>
                <p class="text-slate-400"><?= t('reset_password_subtitle') ?></p>
            </div>
            <form id="resetPasswordForm" class="space-y-6">
                <div class="space-y-2">
                    <label class="block text-primary text-sm font-semibold pr-1"><?= t('new_password') ?></label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 text-xl">key</span>
                        <input id="resetNewPassword" type="password" required class="w-full bg-background-dark border border-border-gold/40 text-white rounded-lg py-4 pr-12 pl-4 focus:ring-2 focus:ring-primary focus:border-transparent placeholder:text-slate-600 transition-all outline-none" placeholder="••••••••" />
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="block text-primary text-sm font-semibold pr-1"><?= t('confirm_password') ?></label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 text-xl">key</span>
                        <input id="resetConfirmPassword" type="password" required class="w-full bg-background-dark border border-border-gold/40 text-white rounded-lg py-4 pr-12 pl-4 focus:ring-2 focus:ring-primary focus:border-transparent placeholder:text-slate-600 transition-all outline-none" placeholder="••••••••" />
                    </div>
                </div>
                <div id="resetPasswordError" class="hidden text-center text-sm font-bold text-red-400"></div>
                <div id="resetPasswordSuccess" class="hidden text-center text-sm font-bold text-green-400"></div>
                <button type="submit" class="w-full bg-primary hover:bg-primary/80 text-background-dark font-bold py-4 rounded-lg text-lg transition-all transform hover:scale-[1.01] shadow-xl shadow-primary/10 serif-text">
                    <?= t('save_new_password') ?>
                </button>
            </form>
            <div class="mt-6 text-center">
                <a href="<?= BASE_URL ?>/dashboard" class="text-slate-400 text-sm hover:text-primary transition-colors"><?= t('back_to_dashboard') ?></a>
            </div>
        </div>
    </div>
</section>

<!-- FORGOT PASSWORD VIEW -->
<section id="forgotPasswordView" class="hidden px-6 py-20">
    <div class="max-w-md mx-auto">
        <div class="bg-surface border border-border-gold/30 rounded-2xl p-8 md:p-12 gold-glow">
            <div class="text-center mb-10">
                <div class="inline-block p-3 rounded-full bg-primary/10 border border-primary/20 mb-4">
                    <span class="material-symbols-outlined text-primary text-4xl">mail</span>
                </div>
                <h2 class="text-3xl font-black text-white mb-3"><?= t('forgot_password_title') ?></h2>
                <div class="h-0.5 w-16 bg-primary mx-auto mb-4"></div>
                <p class="text-slate-400"><?= t('forgot_password_subtitle') ?></p>
            </div>
            <form id="forgotPasswordForm" class="space-y-6">
                <div class="space-y-2">
                    <label class="block text-primary text-sm font-semibold pr-1"><?= t('email') ?></label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 text-xl">person</span>
                        <input id="forgotEmail" type="email" required class="w-full bg-background-dark border border-border-gold/40 text-white rounded-lg py-4 pr-12 pl-4 focus:ring-2 focus:ring-primary focus:border-transparent placeholder:text-slate-600 transition-all outline-none" placeholder="email@example.com" />
                    </div>
                </div>
                <div id="forgotPasswordError" class="hidden text-center text-sm font-bold text-red-400"></div>
                <div id="forgotPasswordSuccess" class="hidden text-center text-sm font-bold text-green-400"></div>
                <button type="submit" class="w-full bg-primary hover:bg-primary/80 text-background-dark font-bold py-4 rounded-lg text-lg transition-all transform hover:scale-[1.01] shadow-xl shadow-primary/10 serif-text">
                    <?= t('send_reset_link') ?>
                </button>
            </form>
            <div class="mt-6 text-center">
                <a href="<?= BASE_URL ?>/dashboard" class="text-slate-400 text-sm hover:text-primary transition-colors"><?= t('back_to_dashboard') ?></a>
            </div>
        </div>
    </div>
</section>

<!-- DASHBOARD MAIN -->
<section id="dashboardMain" class="hidden px-4 sm:px-6 md:px-20 py-6 md:py-12">
    <div class="max-w-4xl mx-auto">

        <!-- Page Title -->
        <div class="text-center mb-6 sm:mb-8">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-primary/10 border border-primary/30 rounded-full mb-3">
                <span class="material-symbols-outlined text-primary text-base">account_circle</span>
                <span class="text-primary text-xs font-bold tracking-widest uppercase"><?= t('my_area') ?></span>
            </div>
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-white mb-2"><?= t('my_personal_area') ?? 'האזור האישי שלי' ?></h1>
            <p class="text-slate-400 text-sm"><?= t('manage_your_profile') ?? 'נהל את הפרטים והפעילות שלך' ?></p>
        </div>

        <!-- Welcome Card - Centered mobile / Row desktop -->
        <div class="bg-gradient-to-l from-primary/5 via-surface to-surface border border-border-gold/30 rounded-2xl gold-glow p-6 sm:p-8 mb-6 sm:mb-8">
            <!-- Mobile: vertical centered / Desktop: horizontal row -->
            <div class="flex flex-col items-center text-center sm:flex-row sm:text-right sm:gap-6">
                <!-- Avatar with change button below -->
                <div class="flex flex-col items-center gap-3 sm:gap-2 shrink-0 mb-4 sm:mb-0">
                    <div class="relative">
                        <img id="dashAvatar" src="" alt="avatar" class="w-28 h-28 sm:w-24 sm:h-24 rounded-full object-cover border-2 border-primary/40 shadow-lg bg-background-dark" />
                    </div>
                    <button type="button" onclick="document.getElementById('avatarInput').click()" class="flex items-center gap-1.5 px-3 py-1.5 bg-primary/10 hover:bg-primary/20 text-primary text-xs font-bold rounded-lg transition-all border border-primary/30">
                        <span class="material-symbols-outlined text-sm">photo_camera</span>
                        <?= t('change_photo') ?? 'החלף תמונה' ?>
                    </button>
                    <input id="avatarInput" type="file" accept="image/*" class="hidden" onchange="uploadAvatar(this)" />
                </div>

                <!-- Name + greeting -->
                <div class="flex-1 w-full">
                    <h2 class="text-2xl sm:text-3xl font-black text-white mb-2"><?= t('hello') ?> <span id="dashUserName">—</span></h2>
                    <p class="text-slate-400 text-sm mb-4 sm:mb-0"><?= t('welcome_to_area') ?></p>
                </div>

                <!-- Logout button -->
                <button onclick="logout()" class="flex items-center justify-center gap-2 px-5 py-3 sm:py-2.5 border border-red-500/30 text-red-400 hover:bg-red-500/10 rounded-xl transition-all text-sm font-bold w-full sm:w-auto">
                    <span class="material-symbols-outlined text-lg">logout</span>
                    <?= t('disconnect') ?>
                </button>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-10">
            <a href="<?= BASE_URL ?>/search" class="flex items-center gap-4 p-5 bg-surface border border-border-gold/20 rounded-2xl hover:border-primary/40 transition-all group">
                <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center group-hover:bg-primary/20 transition-all">
                    <span class="material-symbols-outlined text-primary text-2xl">search</span>
                </div>
                <div>
                    <p class="text-white font-bold text-sm"><?= t('search_profiles') ?></p>
                    <p class="text-slate-500 text-xs"><?= t('browse_matches') ?? 'מצא התאמות חדשות' ?></p>
                </div>
            </a>
            <a id="dashWhatsappLink" href="https://wa.me/972500000000?text=שלום, אני מעוניין להכיר בחורה" target="_blank" class="flex items-center gap-4 p-5 bg-surface border border-green-500/20 rounded-2xl hover:border-green-500/40 transition-all group">
                <div class="w-12 h-12 rounded-xl bg-green-500/10 flex items-center justify-center group-hover:bg-green-500/20 transition-all">
                    <svg class="w-6 h-6 text-green-500" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                </div>
                <div>
                    <p class="text-white font-bold text-sm"><?= t('want_to_meet') ?? 'רוצה להכיר בחורה?' ?></p>
                    <p class="text-green-500/70 text-xs"><?= t('chat_whatsapp') ?? 'דבר איתנו בוואטסאפ' ?></p>
                </div>
            </a>
            <a href="<?= BASE_URL ?>/vip" class="flex items-center gap-4 p-5 bg-surface border border-primary/20 rounded-2xl hover:border-primary/40 transition-all group">
                <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center group-hover:bg-primary/20 transition-all">
                    <span class="material-symbols-outlined text-primary text-2xl">star</span>
                </div>
                <div>
                    <p class="text-white font-bold text-sm"><?= t('vip_title') ?></p>
                    <p class="text-slate-500 text-xs"><?= t('upgrade_vip') ?? 'שדרג את החשבון שלך' ?></p>
                </div>
            </a>
        </div>

        <div class="flex gap-1 sm:gap-2 mb-6 sm:mb-8 border-b border-border-gold/20 pb-0 overflow-x-auto justify-center sm:justify-start">
            <button class="dtab-btn tab-active px-3 sm:px-6 py-3 text-xs sm:text-sm font-bold border-b-2 transition-all hover:text-primary whitespace-nowrap" onclick="switchDashTab('profile')" data-tab="profile">
                <span class="material-symbols-outlined text-base align-middle ml-1">person</span>
                <?= t('personal_details') ?>
            </button>
            <button class="dtab-btn px-3 sm:px-6 py-3 text-xs sm:text-sm font-bold border-b-2 border-transparent text-slate-400 transition-all hover:text-primary whitespace-nowrap" onclick="switchDashTab('password')" data-tab="password">
                <span class="material-symbols-outlined text-base align-middle ml-1">lock</span>
                <?= t('change_password') ?>
            </button>
            <button class="dtab-btn px-3 sm:px-6 py-3 text-xs sm:text-sm font-bold border-b-2 border-transparent text-slate-400 transition-all hover:text-primary whitespace-nowrap" onclick="switchDashTab('messages')" data-tab="messages">
                <span class="material-symbols-outlined text-base align-middle ml-1">chat</span>
                <?= t('my_messages') ?>
            </button>
        </div>

        <!-- PROFILE TAB -->
        <div id="tab-profile" class="dtab-content">
            <div class="bg-surface border border-border-gold/30 rounded-2xl p-5 sm:p-8 md:p-10 gold-glow">
                <h3 class="text-xl font-black text-primary mb-6 text-center sm:text-right"><?= t('edit_personal_details') ?></h3>
                <form id="profileForm" class="space-y-5 sm:space-y-6">
                    <div class="flex flex-col sm:flex-row items-center gap-4 sm:gap-5 mb-2">
                        <img id="profileAvatar" src="" alt="avatar" class="w-20 h-20 sm:w-16 sm:h-16 rounded-full object-cover border border-primary/30 bg-background-dark" />
                        <button type="button" onclick="document.getElementById('avatarInput').click()" class="px-4 py-2 border border-primary/30 text-primary text-sm font-bold rounded-lg hover:bg-primary/10 transition-all">
                            <span class="material-symbols-outlined text-sm align-middle ml-1">upload</span>
                            <?= t('upload_photo') ?>
                        </button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-slate-300 text-sm font-bold block"><?= t('full_name') ?></label>
                            <input id="profileName" type="text" class="w-full bg-background-dark border border-border-gold/40 text-white rounded-lg px-5 py-4 focus:ring-2 focus:ring-primary focus:border-transparent placeholder:text-slate-600 transition-all outline-none" placeholder="" />
                        </div>
                        <div class="space-y-2">
                            <label class="text-slate-300 text-sm font-bold block"><?= t('email') ?></label>
                            <input id="profileEmail" type="email" disabled class="w-full bg-background-dark/50 border border-border-gold/20 text-slate-500 rounded-lg px-5 py-4 cursor-not-allowed outline-none" placeholder="email@example.com" />
                        </div>
                        <div class="space-y-2">
                            <label class="text-slate-300 text-sm font-bold block"><?= t('phone') ?></label>
                            <input id="profilePhone" type="tel" class="w-full bg-background-dark border border-border-gold/40 text-white rounded-lg px-5 py-4 focus:ring-2 focus:ring-primary focus:border-transparent placeholder:text-slate-600 transition-all outline-none" placeholder="050-1234567" />
                        </div>
                        <div class="space-y-2">
                            <label class="text-slate-300 text-sm font-bold block"><?= t('age') ?></label>
                            <input id="profileAge" type="number" class="w-full bg-background-dark border border-border-gold/40 text-white rounded-lg px-5 py-4 focus:ring-2 focus:ring-primary focus:border-transparent placeholder:text-slate-600 transition-all outline-none" placeholder="35" />
                        </div>
                        <div class="space-y-2 md:col-span-2">
                            <label class="text-slate-300 text-sm font-bold block"><?= t('city') ?></label>
                            <input id="profileCity" type="text" class="w-full bg-background-dark border border-border-gold/40 text-white rounded-lg px-5 py-4 focus:ring-2 focus:ring-primary focus:border-transparent placeholder:text-slate-600 transition-all outline-none" placeholder="" />
                        </div>
                    </div>

                    <div id="profileError" class="hidden text-center text-sm font-bold text-red-400"></div>
                    <div id="profileSuccess" class="hidden text-center text-sm font-bold text-green-400"></div>

                    <button type="submit" class="w-full bg-primary hover:bg-primary/80 text-background-dark font-bold py-4 rounded-lg text-lg transition-all transform hover:scale-[1.01] shadow-xl shadow-primary/10 serif-text">
                        <?= t('save_changes') ?>
                    </button>
                </form>
            </div>
        </div>

        <!-- PASSWORD TAB -->
        <div id="tab-password" class="dtab-content hidden">
            <div class="bg-surface border border-border-gold/30 rounded-2xl p-8 md:p-10 gold-glow">
                <h3 class="text-xl font-black text-primary mb-6"><?= t('change_password') ?></h3>
                <form id="changePasswordForm" class="space-y-6 max-w-md">
                    <div class="space-y-2">
                        <label class="text-slate-300 text-sm font-bold block"><?= t('current_password') ?></label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 text-xl">key</span>
                            <input id="currentPassword" type="password" required class="w-full bg-background-dark border border-border-gold/40 text-white rounded-lg py-4 pr-12 pl-4 focus:ring-2 focus:ring-primary focus:border-transparent placeholder:text-slate-600 transition-all outline-none" placeholder="••••••••" />
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-slate-300 text-sm font-bold block"><?= t('new_password') ?></label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 text-xl">lock</span>
                            <input id="newPassword" type="password" required class="w-full bg-background-dark border border-border-gold/40 text-white rounded-lg py-4 pr-12 pl-4 focus:ring-2 focus:ring-primary focus:border-transparent placeholder:text-slate-600 transition-all outline-none" placeholder="••••••••" />
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-slate-300 text-sm font-bold block"><?= t('confirm_new_password') ?></label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 text-xl">lock</span>
                            <input id="confirmNewPassword" type="password" required class="w-full bg-background-dark border border-border-gold/40 text-white rounded-lg py-4 pr-12 pl-4 focus:ring-2 focus:ring-primary focus:border-transparent placeholder:text-slate-600 transition-all outline-none" placeholder="••••••••" />
                        </div>
                    </div>

                    <div id="changePasswordError" class="hidden text-center text-sm font-bold text-red-400"></div>
                    <div id="changePasswordSuccess" class="hidden text-center text-sm font-bold text-green-400"></div>

                    <button type="submit" class="w-full bg-primary hover:bg-primary/80 text-background-dark font-bold py-4 rounded-lg text-lg transition-all transform hover:scale-[1.01] shadow-xl shadow-primary/10 serif-text">
                        <?= t('update_password') ?>
                    </button>
                </form>
            </div>
        </div>

        <!-- MESSAGES TAB -->
        <div id="tab-messages" class="dtab-content hidden">
            <div class="bg-surface border border-border-gold/30 rounded-2xl p-8 md:p-10 gold-glow">
                <h3 class="text-xl font-black text-primary mb-6"><?= t('my_messages') ?></h3>
                <div id="messagesContainer">
                    <div id="messagesLoading" class="text-center py-12 text-slate-400">
                        <span class="material-symbols-outlined text-4xl mb-2 block animate-spin">progress_activity</span>
                        <?= t('loading_messages') ?>
                    </div>
                    <div id="messagesList" class="hidden space-y-4"></div>
                    <div id="messagesEmpty" class="hidden text-center py-12">
                        <span class="material-symbols-outlined text-slate-600 text-5xl mb-4 block">forum</span>
                        <p class="text-slate-400 text-lg"><?= t('no_messages_yet') ?></p>
                        <p class="text-slate-500 text-sm mt-1"><?= t('messages_appear_here') ?></p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- NOT LOGGED IN -->
<section id="notLoggedInView" class="hidden px-6 py-20">
    <div class="max-w-md mx-auto text-center">
        <div class="bg-surface border border-border-gold/30 rounded-2xl p-12 gold-glow">
            <span class="material-symbols-outlined text-primary text-6xl mb-6 block">lock_person</span>
            <h2 class="text-2xl font-black text-white mb-4"><?= t('login_required') ?></h2>
            <p class="text-slate-400 mb-8"><?= t('login_required_text') ?></p>
            <button onclick="openModal('loginModal')" class="px-8 py-3 bg-primary hover:bg-primary/80 text-background-dark font-bold rounded-lg text-lg transition-all serif-text">
                <?= t('login') ?>
            </button>
            <p class="mt-4 text-slate-500 text-sm"><?= t('not_members_yet') ?>
                <a onclick="openModal('registerModal')" class="text-primary font-bold hover:underline cursor-pointer"><?= t('register') ?></a>
            </p>
        </div>
    </div>
</section>

<script>
const API = BASE_URL;

function init() {
    const params = new URLSearchParams(window.location.search);
    const resetToken = params.get('reset');
    const forgotMode = params.get('forgot');

    if (resetToken) {
        document.getElementById('resetPasswordView').classList.remove('hidden');
        return;
    }

    if (forgotMode === '1') {
        document.getElementById('forgotPasswordView').classList.remove('hidden');
        return;
    }

    const user = JSON.parse(localStorage.getItem('user') || 'null');
    if (!user) {
        document.getElementById('notLoggedInView').classList.remove('hidden');
        return;
    }

    document.getElementById('dashboardMain').classList.remove('hidden');
    loadUserProfile();
}

function switchDashTab(tab) {
    document.querySelectorAll('.dtab-content').forEach(el => el.classList.add('hidden'));
    document.querySelectorAll('.dtab-btn').forEach(btn => {
        btn.classList.remove('tab-active');
        btn.classList.add('border-transparent', 'text-slate-400');
    });
    const tabContent = document.getElementById('tab-' + tab);
    if (tabContent) tabContent.classList.remove('hidden');
    const activeBtn = document.querySelector(`.dtab-btn[data-tab="${tab}"]`);
    if (activeBtn) {
        activeBtn.classList.add('tab-active');
        activeBtn.classList.remove('border-transparent', 'text-slate-400');
    }
    if (tab === 'messages') loadMessages();
}

async function loadUserProfile() {
    let user = JSON.parse(localStorage.getItem('user') || 'null');
    if (!user) return;

    // Refresh user data from server (includes latest avatar, etc)
    try {
        const freshRes = await fetch(BASE + '/api/user/profile?user_id=' + user.id);
        if (freshRes.ok) {
            const freshUser = await freshRes.json();
            if (freshUser && freshUser.id) {
                user = Object.assign({}, user, freshUser);
                localStorage.setItem('user', JSON.stringify(user));
            }
        }
    } catch(e) {}

    document.getElementById('dashUserName').textContent = user.name || '—';
    const avatarUrl = user.avatar
        ? (user.avatar.startsWith('http') || user.avatar.startsWith('/') ? (user.avatar.startsWith('http') ? user.avatar : BASE_URL + user.avatar) : BASE_URL + '/' + user.avatar)
        : BASE_URL + '/public/images/default-avatar.svg';
    document.getElementById('dashAvatar').src = avatarUrl;
    document.getElementById('profileAvatar').src = avatarUrl;

    document.getElementById('profileName').value = user.name || '';
    document.getElementById('profileEmail').value = user.email || '';
    document.getElementById('profilePhone').value = user.phone || '';
    document.getElementById('profileAge').value = user.age || '';
    document.getElementById('profileCity').value = user.city || '';

    // Load WhatsApp link from settings
    try {
        const sRes = await fetch(BASE + '/api/panel/settings');
        const s = await sRes.json();
        if (s.whatsapp) {
            var waNum = s.whatsapp.replace(/[^0-9]/g, '');
            document.getElementById('dashWhatsappLink').href = 'https://wa.me/' + waNum + '?text=' + encodeURIComponent(T.whatsapp_message || 'שלום, אני מעוניין להכיר בחורה');
        }
    } catch(e) {}
}

async function uploadAvatar(input) {
    const file = input.files[0];
    if (!file) return;

    const user = JSON.parse(localStorage.getItem('user') || 'null');
    if (!user) return;

    const formData = new FormData();
    formData.append('file', file);

    try {
        const res = await fetch(BASE + '/api/upload', {
            method: 'POST',
            body: formData
        });
        const data = await res.json();
        if (res.ok && data.url) {
            const newUrl = data.url.startsWith('http') ? data.url : BASE_URL + data.url;

            // Save to user profile in DB
            await fetch(BASE + '/api/user/profile', {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json', 'X-User-Id': user.id },
                body: JSON.stringify({ avatar: data.url })
            }).catch(()=>{});

            user.avatar = data.url;
            localStorage.setItem('user', JSON.stringify(user));
            document.getElementById('dashAvatar').src = newUrl;
            const profileAvatarEl = document.getElementById('profileAvatar');
            if (profileAvatarEl) profileAvatarEl.src = newUrl;
        } else {
            alert(data.error || T.error_uploading_photo || 'שגיאה בהעלאת תמונה');
        }
    } catch(e) {
        alert(T.error_uploading_photo || 'שגיאה בהעלאת תמונה');
    }
    input.value = '';
}

document.getElementById('profileForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const errEl = document.getElementById('profileError');
    const okEl = document.getElementById('profileSuccess');
    errEl.classList.add('hidden');
    okEl.classList.add('hidden');

    const user = JSON.parse(localStorage.getItem('user') || 'null');
    if (!user) return;

    const payload = {
        name: document.getElementById('profileName').value,
        phone: document.getElementById('profilePhone').value,
        email: document.getElementById('profileEmail') ? document.getElementById('profileEmail').value : undefined
    };

    try {
        const res = await fetch(API + '/api/user/profile', {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json', 'X-User-Id': user.id },
            body: JSON.stringify(payload)
        });
        const data = await res.json();
        if (res.ok) {
            if (data.user) Object.assign(user, data.user);
            else Object.assign(user, payload);
            localStorage.setItem('user', JSON.stringify(user));
            document.getElementById('dashUserName').textContent = user.name;
            updateAuthUI();
            okEl.textContent = T.details_updated;
            okEl.classList.remove('hidden');
            setTimeout(() => okEl.classList.add('hidden'), 4000);
        } else {
            errEl.textContent = data.error || T.error_updating;
            errEl.classList.remove('hidden');
        }
    } catch {
        errEl.textContent = T.server_error;
        errEl.classList.remove('hidden');
    }
});

document.getElementById('changePasswordForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const errEl = document.getElementById('changePasswordError');
    const okEl = document.getElementById('changePasswordSuccess');
    errEl.classList.add('hidden');
    okEl.classList.add('hidden');

    const newPass = document.getElementById('newPassword').value;
    const confirmPass = document.getElementById('confirmNewPassword').value;

    if (newPass !== confirmPass) {
        errEl.textContent = T.passwords_not_match;
        errEl.classList.remove('hidden');
        return;
    }

    const user = JSON.parse(localStorage.getItem('user') || 'null');
    if (!user) return;

    try {
        const res = await fetch(API + '/api/user/change-password', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-User-Id': user.id },
            body: JSON.stringify({
                current_password: document.getElementById('currentPassword').value,
                new_password: newPass
            })
        });
        const data = await res.json();
        if (res.ok) {
            okEl.textContent = T.password_changed;
            okEl.classList.remove('hidden');
            document.getElementById('changePasswordForm').reset();
            setTimeout(() => okEl.classList.add('hidden'), 4000);
        } else {
            errEl.textContent = data.error || T.error_changing_password;
            errEl.classList.remove('hidden');
        }
    } catch {
        errEl.textContent = T.server_error;
        errEl.classList.remove('hidden');
    }
});

async function loadMessages() {
    const user = JSON.parse(localStorage.getItem('user') || 'null');
    if (!user) return;

    const loadingEl = document.getElementById('messagesLoading');
    const listEl = document.getElementById('messagesList');
    const emptyEl = document.getElementById('messagesEmpty');

    loadingEl.classList.remove('hidden');
    listEl.classList.add('hidden');
    emptyEl.classList.add('hidden');

    try {
        const res = await fetch(API + '/api/user/messages', {
            headers: { 'X-User-Id': user.id }
        });
        const data = await res.json();
        loadingEl.classList.add('hidden');

        const messages = data.messages || data.data || [];
        if (!messages.length) {
            emptyEl.classList.remove('hidden');
            return;
        }

        listEl.innerHTML = messages.map(msg => `
            <div class="p-5 bg-background-dark rounded-xl border border-border-gold/20 hover:border-primary/30 transition-all">
                <div class="flex items-start justify-between gap-4 mb-2">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary text-xl">${msg.is_read ? 'mark_email_read' : 'mark_email_unread'}</span>
                        <h4 class="font-bold text-white text-sm">${escapeHtml(msg.from_name || msg.sender_name || T.system)}</h4>
                    </div>
                    <span class="text-slate-500 text-xs whitespace-nowrap">${msg.created_at || msg.date || ''}</span>
                </div>
                <p class="text-slate-300 text-sm leading-relaxed pr-9">${escapeHtml(msg.body || msg.message || msg.content || '')}</p>
            </div>
        `).join('');
        listEl.classList.remove('hidden');
    } catch {
        loadingEl.classList.add('hidden');
        emptyEl.classList.remove('hidden');
    }
}

document.getElementById('forgotPasswordForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const errEl = document.getElementById('forgotPasswordError');
    const okEl = document.getElementById('forgotPasswordSuccess');
    errEl.classList.add('hidden');
    okEl.classList.add('hidden');

    try {
        const res = await fetch(API + '/api/forgot-password', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email: document.getElementById('forgotEmail').value })
        });
        const data = await res.json();
        if (res.ok) {
            okEl.textContent = data.message || T.reset_link_sent;
            okEl.classList.remove('hidden');
            document.getElementById('forgotPasswordForm').reset();
        } else {
            errEl.textContent = data.error || T.error_sending_request;
            errEl.classList.remove('hidden');
        }
    } catch {
        errEl.textContent = T.server_error;
        errEl.classList.remove('hidden');
    }
});

document.getElementById('resetPasswordForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const errEl = document.getElementById('resetPasswordError');
    const okEl = document.getElementById('resetPasswordSuccess');
    errEl.classList.add('hidden');
    okEl.classList.add('hidden');

    const newPass = document.getElementById('resetNewPassword').value;
    const confirmPass = document.getElementById('resetConfirmPassword').value;

    if (newPass !== confirmPass) {
        errEl.textContent = T.passwords_not_match;
        errEl.classList.remove('hidden');
        return;
    }

    const token = new URLSearchParams(window.location.search).get('reset');

    try {
        const res = await fetch(API + '/api/reset-password', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ token: token, new_password: newPass })
        });
        const data = await res.json();
        if (res.ok) {
            okEl.textContent = T.password_reset_success;
            okEl.classList.remove('hidden');
            document.getElementById('resetPasswordForm').reset();
            setTimeout(() => { window.location.href = BASE_URL + '/dashboard'; }, 2000);
        } else {
            errEl.textContent = data.error || T.error_resetting_password;
            errEl.classList.remove('hidden');
        }
    } catch {
        errEl.textContent = T.server_error;
        errEl.classList.remove('hidden');
    }
});

function escapeHtml(str) {
    if (!str) return '';
    const div = document.createElement('div');
    div.textContent = str;
    return div.innerHTML;
}

init();
</script>

<?php include BASE_PATH . '/app/views/layouts/footer.php'; ?>
