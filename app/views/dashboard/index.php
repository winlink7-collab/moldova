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
<section id="dashboardMain" class="hidden px-6 md:px-20 py-12">
    <div class="max-w-4xl mx-auto">

        <div class="flex flex-col sm:flex-row items-center gap-6 mb-12 p-8 bg-surface border border-border-gold/30 rounded-2xl gold-glow">
            <div class="relative group">
                <img id="dashAvatar" src="" alt="avatar" class="w-24 h-24 rounded-full object-cover border-2 border-primary/40 shadow-lg bg-background-dark" />
                <div class="absolute inset-0 flex items-center justify-center rounded-full bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer" onclick="document.getElementById('avatarInput').click()">
                    <span class="material-symbols-outlined text-white text-2xl">photo_camera</span>
                </div>
                <input id="avatarInput" type="file" accept="image/*" class="hidden" onchange="uploadAvatar(this)" />
            </div>
            <div class="text-center sm:text-right flex-1">
                <h2 class="text-3xl font-black text-white mb-1"><?= t('hello') ?> <span id="dashUserName">—</span></h2>
                <p class="text-slate-400 text-sm"><?= t('welcome_to_area') ?></p>
            </div>
            <button onclick="logout()" class="flex items-center gap-2 px-5 py-2.5 border border-red-500/30 text-red-400 hover:bg-red-500/10 rounded-lg transition-all text-sm font-bold">
                <span class="material-symbols-outlined text-lg">logout</span>
                <?= t('disconnect') ?>
            </button>
        </div>

        <div class="flex gap-2 mb-8 border-b border-border-gold/20 pb-0">
            <button class="dtab-btn tab-active px-6 py-3 text-sm font-bold border-b-2 transition-all hover:text-primary" onclick="switchDashTab('profile')" data-tab="profile">
                <span class="material-symbols-outlined text-base align-middle ml-1">person</span>
                <?= t('personal_details') ?>
            </button>
            <button class="dtab-btn px-6 py-3 text-sm font-bold border-b-2 border-transparent text-slate-400 transition-all hover:text-primary" onclick="switchDashTab('password')" data-tab="password">
                <span class="material-symbols-outlined text-base align-middle ml-1">lock</span>
                <?= t('change_password') ?>
            </button>
            <button class="dtab-btn px-6 py-3 text-sm font-bold border-b-2 border-transparent text-slate-400 transition-all hover:text-primary" onclick="switchDashTab('messages')" data-tab="messages">
                <span class="material-symbols-outlined text-base align-middle ml-1">chat</span>
                <?= t('my_messages') ?>
            </button>
        </div>

        <!-- PROFILE TAB -->
        <div id="tab-profile" class="dtab-content">
            <div class="bg-surface border border-border-gold/30 rounded-2xl p-8 md:p-10 gold-glow">
                <h3 class="text-xl font-black text-primary mb-6"><?= t('edit_personal_details') ?></h3>
                <form id="profileForm" class="space-y-6">
                    <div class="flex items-center gap-5 mb-2">
                        <img id="profileAvatar" src="" alt="avatar" class="w-16 h-16 rounded-full object-cover border border-primary/30 bg-background-dark" />
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
    const user = JSON.parse(localStorage.getItem('user') || 'null');
    if (!user) return;

    document.getElementById('dashUserName').textContent = user.name || '—';
    const avatarUrl = user.avatar
        ? (user.avatar.startsWith('http') ? user.avatar : BASE_URL + '/' + user.avatar)
        : BASE_URL + '/public/images/default-avatar.png';
    document.getElementById('dashAvatar').src = avatarUrl;
    document.getElementById('profileAvatar').src = avatarUrl;

    document.getElementById('profileName').value = user.name || '';
    document.getElementById('profileEmail').value = user.email || '';
    document.getElementById('profilePhone').value = user.phone || '';
    document.getElementById('profileAge').value = user.age || '';
    document.getElementById('profileCity').value = user.city || '';
}

async function uploadAvatar(input) {
    const file = input.files[0];
    if (!file) return;

    const user = JSON.parse(localStorage.getItem('user') || 'null');
    if (!user) return;

    const formData = new FormData();
    formData.append('avatar', file);

    try {
        const res = await fetch(API + '/api/upload', {
            method: 'POST',
            headers: { 'X-User-Id': user.id },
            body: formData
        });
        const data = await res.json();
        if (res.ok && (data.url || data.filename)) {
            user.avatar = data.url;
            localStorage.setItem('user', JSON.stringify(user));
            const newUrl = data.path.startsWith('http') ? data.path : BASE_URL + '/' + data.path;
            document.getElementById('dashAvatar').src = newUrl;
            document.getElementById('profileAvatar').src = newUrl;
        } else {
            alert(data.error || T.error_uploading_photo);
        }
    } catch {
        alert(T.error_uploading_photo);
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
