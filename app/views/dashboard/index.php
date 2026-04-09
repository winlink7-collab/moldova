<?php $pageTitle = 'האזור האישי - Moldova & Ukraine Luxury Brides'; $pageDescription = 'אזור אישי - עריכת פרטים, שינוי סיסמה והודעות'; $currentPage = 'dashboard'; ?>
<?php include BASE_PATH . '/app/views/layouts/header.php'; ?>

<style>
    .tab-active { border-color: #f2d00d; color: #f2d00d; }
    .gold-glow { box-shadow: 0 0 40px rgba(242, 208, 13, 0.08); }
</style>

<!-- ============================================================
     RESET PASSWORD VIEW (shown when ?reset=TOKEN)
     ============================================================ -->
<section id="resetPasswordView" class="hidden px-6 py-20">
    <div class="max-w-md mx-auto">
        <div class="bg-surface border border-border-gold/30 rounded-2xl p-8 md:p-12 gold-glow">
            <div class="text-center mb-10">
                <div class="inline-block p-3 rounded-full bg-primary/10 border border-primary/20 mb-4">
                    <span class="material-symbols-outlined text-primary text-4xl">lock_reset</span>
                </div>
                <h2 class="text-3xl font-black text-white mb-3">איפוס סיסמה</h2>
                <div class="h-0.5 w-16 bg-primary mx-auto mb-4"></div>
                <p class="text-slate-400">הזינו סיסמה חדשה לחשבונכם</p>
            </div>
            <form id="resetPasswordForm" class="space-y-6">
                <div class="space-y-2">
                    <label class="block text-primary text-sm font-semibold pr-1">סיסמה חדשה</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 text-xl">key</span>
                        <input id="resetNewPassword" type="password" required
                               class="w-full bg-background-dark border border-border-gold/40 text-white rounded-lg py-4 pr-12 pl-4 focus:ring-2 focus:ring-primary focus:border-transparent placeholder:text-slate-600 transition-all outline-none"
                               placeholder="••••••••" />
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="block text-primary text-sm font-semibold pr-1">אימות סיסמה</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 text-xl">key</span>
                        <input id="resetConfirmPassword" type="password" required
                               class="w-full bg-background-dark border border-border-gold/40 text-white rounded-lg py-4 pr-12 pl-4 focus:ring-2 focus:ring-primary focus:border-transparent placeholder:text-slate-600 transition-all outline-none"
                               placeholder="••••••••" />
                    </div>
                </div>
                <div id="resetPasswordError" class="hidden text-center text-sm font-bold text-red-400"></div>
                <div id="resetPasswordSuccess" class="hidden text-center text-sm font-bold text-green-400"></div>
                <button type="submit"
                        class="w-full bg-primary hover:bg-primary/80 text-background-dark font-bold py-4 rounded-lg text-lg transition-all transform hover:scale-[1.01] shadow-xl shadow-primary/10 serif-text">
                    שמור סיסמה חדשה
                </button>
            </form>
            <div class="mt-6 text-center">
                <a href="<?= BASE_URL ?>/dashboard" class="text-slate-400 text-sm hover:text-primary transition-colors">חזרה לאזור האישי</a>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     FORGOT PASSWORD VIEW (shown when ?forgot=1)
     ============================================================ -->
<section id="forgotPasswordView" class="hidden px-6 py-20">
    <div class="max-w-md mx-auto">
        <div class="bg-surface border border-border-gold/30 rounded-2xl p-8 md:p-12 gold-glow">
            <div class="text-center mb-10">
                <div class="inline-block p-3 rounded-full bg-primary/10 border border-primary/20 mb-4">
                    <span class="material-symbols-outlined text-primary text-4xl">mail</span>
                </div>
                <h2 class="text-3xl font-black text-white mb-3">שכחתי סיסמה</h2>
                <div class="h-0.5 w-16 bg-primary mx-auto mb-4"></div>
                <p class="text-slate-400">הזינו את כתובת האימייל שלכם ונשלח לכם קישור לאיפוס</p>
            </div>
            <form id="forgotPasswordForm" class="space-y-6">
                <div class="space-y-2">
                    <label class="block text-primary text-sm font-semibold pr-1">אימייל</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 text-xl">person</span>
                        <input id="forgotEmail" type="email" required
                               class="w-full bg-background-dark border border-border-gold/40 text-white rounded-lg py-4 pr-12 pl-4 focus:ring-2 focus:ring-primary focus:border-transparent placeholder:text-slate-600 transition-all outline-none"
                               placeholder="email@example.com" />
                    </div>
                </div>
                <div id="forgotPasswordError" class="hidden text-center text-sm font-bold text-red-400"></div>
                <div id="forgotPasswordSuccess" class="hidden text-center text-sm font-bold text-green-400"></div>
                <button type="submit"
                        class="w-full bg-primary hover:bg-primary/80 text-background-dark font-bold py-4 rounded-lg text-lg transition-all transform hover:scale-[1.01] shadow-xl shadow-primary/10 serif-text">
                    שלח קישור לאיפוס
                </button>
            </form>
            <div class="mt-6 text-center">
                <a href="<?= BASE_URL ?>/dashboard" class="text-slate-400 text-sm hover:text-primary transition-colors">חזרה לאזור האישי</a>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     DASHBOARD MAIN (shown when user is logged in)
     ============================================================ -->
<section id="dashboardMain" class="hidden px-6 md:px-20 py-12">
    <div class="max-w-4xl mx-auto">

        <!-- Welcome Header -->
        <div class="flex flex-col sm:flex-row items-center gap-6 mb-12 p-8 bg-surface border border-border-gold/30 rounded-2xl gold-glow">
            <div class="relative group">
                <img id="dashAvatar" src="" alt="avatar"
                     class="w-24 h-24 rounded-full object-cover border-2 border-primary/40 shadow-lg bg-background-dark" />
                <div class="absolute inset-0 flex items-center justify-center rounded-full bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer"
                     onclick="document.getElementById('avatarInput').click()">
                    <span class="material-symbols-outlined text-white text-2xl">photo_camera</span>
                </div>
                <input id="avatarInput" type="file" accept="image/*" class="hidden" onchange="uploadAvatar(this)" />
            </div>
            <div class="text-center sm:text-right flex-1">
                <h2 class="text-3xl font-black text-white mb-1">שלום, <span id="dashUserName">—</span></h2>
                <p class="text-slate-400 text-sm">ברוכים הבאים לאזור האישי שלכם</p>
            </div>
            <button onclick="logout()" class="flex items-center gap-2 px-5 py-2.5 border border-red-500/30 text-red-400 hover:bg-red-500/10 rounded-lg transition-all text-sm font-bold">
                <span class="material-symbols-outlined text-lg">logout</span>
                התנתקות
            </button>
        </div>

        <!-- Tabs Navigation -->
        <div class="flex gap-2 mb-8 border-b border-border-gold/20 pb-0">
            <button class="dtab-btn tab-active px-6 py-3 text-sm font-bold border-b-2 transition-all hover:text-primary"
                    onclick="switchDashTab('profile')" data-tab="profile">
                <span class="material-symbols-outlined text-base align-middle ml-1">person</span>
                פרטים אישיים
            </button>
            <button class="dtab-btn px-6 py-3 text-sm font-bold border-b-2 border-transparent text-slate-400 transition-all hover:text-primary"
                    onclick="switchDashTab('password')" data-tab="password">
                <span class="material-symbols-outlined text-base align-middle ml-1">lock</span>
                שינוי סיסמה
            </button>
            <button class="dtab-btn px-6 py-3 text-sm font-bold border-b-2 border-transparent text-slate-400 transition-all hover:text-primary"
                    onclick="switchDashTab('messages')" data-tab="messages">
                <span class="material-symbols-outlined text-base align-middle ml-1">chat</span>
                ההודעות שלי
            </button>
        </div>

        <!-- ======================== PROFILE TAB ======================== -->
        <div id="tab-profile" class="dtab-content">
            <div class="bg-surface border border-border-gold/30 rounded-2xl p-8 md:p-10 gold-glow">
                <h3 class="text-xl font-black text-primary mb-6">עריכת פרטים אישיים</h3>
                <form id="profileForm" class="space-y-6">
                    <!-- Avatar upload row -->
                    <div class="flex items-center gap-5 mb-2">
                        <img id="profileAvatar" src="" alt="avatar"
                             class="w-16 h-16 rounded-full object-cover border border-primary/30 bg-background-dark" />
                        <button type="button" onclick="document.getElementById('avatarInput').click()"
                                class="px-4 py-2 border border-primary/30 text-primary text-sm font-bold rounded-lg hover:bg-primary/10 transition-all">
                            <span class="material-symbols-outlined text-sm align-middle ml-1">upload</span>
                            העלאת תמונה
                        </button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div class="space-y-2">
                            <label class="text-slate-300 text-sm font-bold block">שם מלא</label>
                            <input id="profileName" type="text"
                                   class="w-full bg-background-dark border border-border-gold/40 text-white rounded-lg px-5 py-4 focus:ring-2 focus:ring-primary focus:border-transparent placeholder:text-slate-600 transition-all outline-none"
                                   placeholder="ישראל ישראלי" />
                        </div>
                        <!-- Email (disabled) -->
                        <div class="space-y-2">
                            <label class="text-slate-300 text-sm font-bold block">אימייל</label>
                            <input id="profileEmail" type="email" disabled
                                   class="w-full bg-background-dark/50 border border-border-gold/20 text-slate-500 rounded-lg px-5 py-4 cursor-not-allowed outline-none"
                                   placeholder="email@example.com" />
                        </div>
                        <!-- Phone -->
                        <div class="space-y-2">
                            <label class="text-slate-300 text-sm font-bold block">טלפון</label>
                            <input id="profilePhone" type="tel"
                                   class="w-full bg-background-dark border border-border-gold/40 text-white rounded-lg px-5 py-4 focus:ring-2 focus:ring-primary focus:border-transparent placeholder:text-slate-600 transition-all outline-none"
                                   placeholder="050-1234567" />
                        </div>
                        <!-- Age -->
                        <div class="space-y-2">
                            <label class="text-slate-300 text-sm font-bold block">גיל</label>
                            <input id="profileAge" type="number"
                                   class="w-full bg-background-dark border border-border-gold/40 text-white rounded-lg px-5 py-4 focus:ring-2 focus:ring-primary focus:border-transparent placeholder:text-slate-600 transition-all outline-none"
                                   placeholder="35" />
                        </div>
                        <!-- City -->
                        <div class="space-y-2 md:col-span-2">
                            <label class="text-slate-300 text-sm font-bold block">עיר</label>
                            <input id="profileCity" type="text"
                                   class="w-full bg-background-dark border border-border-gold/40 text-white rounded-lg px-5 py-4 focus:ring-2 focus:ring-primary focus:border-transparent placeholder:text-slate-600 transition-all outline-none"
                                   placeholder="תל אביב" />
                        </div>
                    </div>

                    <div id="profileError" class="hidden text-center text-sm font-bold text-red-400"></div>
                    <div id="profileSuccess" class="hidden text-center text-sm font-bold text-green-400"></div>

                    <button type="submit"
                            class="w-full bg-primary hover:bg-primary/80 text-background-dark font-bold py-4 rounded-lg text-lg transition-all transform hover:scale-[1.01] shadow-xl shadow-primary/10 serif-text">
                        שמור שינויים
                    </button>
                </form>
            </div>
        </div>

        <!-- ======================== PASSWORD TAB ======================== -->
        <div id="tab-password" class="dtab-content hidden">
            <div class="bg-surface border border-border-gold/30 rounded-2xl p-8 md:p-10 gold-glow">
                <h3 class="text-xl font-black text-primary mb-6">שינוי סיסמה</h3>
                <form id="changePasswordForm" class="space-y-6 max-w-md">
                    <div class="space-y-2">
                        <label class="text-slate-300 text-sm font-bold block">סיסמה נוכחית</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 text-xl">key</span>
                            <input id="currentPassword" type="password" required
                                   class="w-full bg-background-dark border border-border-gold/40 text-white rounded-lg py-4 pr-12 pl-4 focus:ring-2 focus:ring-primary focus:border-transparent placeholder:text-slate-600 transition-all outline-none"
                                   placeholder="••••••••" />
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-slate-300 text-sm font-bold block">סיסמה חדשה</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 text-xl">lock</span>
                            <input id="newPassword" type="password" required
                                   class="w-full bg-background-dark border border-border-gold/40 text-white rounded-lg py-4 pr-12 pl-4 focus:ring-2 focus:ring-primary focus:border-transparent placeholder:text-slate-600 transition-all outline-none"
                                   placeholder="••••••••" />
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-slate-300 text-sm font-bold block">אימות סיסמה חדשה</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 text-xl">lock</span>
                            <input id="confirmNewPassword" type="password" required
                                   class="w-full bg-background-dark border border-border-gold/40 text-white rounded-lg py-4 pr-12 pl-4 focus:ring-2 focus:ring-primary focus:border-transparent placeholder:text-slate-600 transition-all outline-none"
                                   placeholder="••••••••" />
                        </div>
                    </div>

                    <div id="changePasswordError" class="hidden text-center text-sm font-bold text-red-400"></div>
                    <div id="changePasswordSuccess" class="hidden text-center text-sm font-bold text-green-400"></div>

                    <button type="submit"
                            class="w-full bg-primary hover:bg-primary/80 text-background-dark font-bold py-4 rounded-lg text-lg transition-all transform hover:scale-[1.01] shadow-xl shadow-primary/10 serif-text">
                        עדכן סיסמה
                    </button>
                </form>
            </div>
        </div>

        <!-- ======================== MESSAGES TAB ======================== -->
        <div id="tab-messages" class="dtab-content hidden">
            <div class="bg-surface border border-border-gold/30 rounded-2xl p-8 md:p-10 gold-glow">
                <h3 class="text-xl font-black text-primary mb-6">ההודעות שלי</h3>
                <div id="messagesContainer">
                    <div id="messagesLoading" class="text-center py-12 text-slate-400">
                        <span class="material-symbols-outlined text-4xl mb-2 block animate-spin">progress_activity</span>
                        טוען הודעות...
                    </div>
                    <div id="messagesList" class="hidden space-y-4"></div>
                    <div id="messagesEmpty" class="hidden text-center py-12">
                        <span class="material-symbols-outlined text-slate-600 text-5xl mb-4 block">forum</span>
                        <p class="text-slate-400 text-lg">אין הודעות עדיין</p>
                        <p class="text-slate-500 text-sm mt-1">כשתקבלו הודעות, הן יופיעו כאן</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- ============================================================
     NOT LOGGED IN - redirect prompt
     ============================================================ -->
<section id="notLoggedInView" class="hidden px-6 py-20">
    <div class="max-w-md mx-auto text-center">
        <div class="bg-surface border border-border-gold/30 rounded-2xl p-12 gold-glow">
            <span class="material-symbols-outlined text-primary text-6xl mb-6 block">lock_person</span>
            <h2 class="text-2xl font-black text-white mb-4">נדרשת התחברות</h2>
            <p class="text-slate-400 mb-8">עליכם להתחבר כדי לגשת לאזור האישי</p>
            <button onclick="openModal('loginModal')"
                    class="px-8 py-3 bg-primary hover:bg-primary/80 text-background-dark font-bold rounded-lg text-lg transition-all serif-text">
                התחברות
            </button>
            <p class="mt-4 text-slate-500 text-sm">עדיין לא חברים?
                <a onclick="openModal('registerModal')" class="text-primary font-bold hover:underline cursor-pointer">הרשמה</a>
            </p>
        </div>
    </div>
</section>

<!-- ============================================================
     JAVASCRIPT
     ============================================================ -->
<script>
// BASE_URL already declared in header
const API = BASE_URL;

/* ─── Initialization ─── */
function init() {
    const params = new URLSearchParams(window.location.search);
    const resetToken = params.get('reset');
    const forgotMode = params.get('forgot');

    if (resetToken) {
        // Reset password mode
        document.getElementById('resetPasswordView').classList.remove('hidden');
        return;
    }

    if (forgotMode === '1') {
        // Forgot password mode
        document.getElementById('forgotPasswordView').classList.remove('hidden');
        return;
    }

    // Normal dashboard mode – check auth
    const user = JSON.parse(localStorage.getItem('user') || 'null');
    if (!user) {
        document.getElementById('notLoggedInView').classList.remove('hidden');
        return;
    }

    document.getElementById('dashboardMain').classList.remove('hidden');
    loadUserProfile();
}

/* ─── Tab Switching ─── */
function switchDashTab(tab) {
    // Hide all tab contents
    document.querySelectorAll('.dtab-content').forEach(el => el.classList.add('hidden'));
    // Deactivate all tab buttons
    document.querySelectorAll('.dtab-btn').forEach(btn => {
        btn.classList.remove('tab-active');
        btn.classList.add('border-transparent', 'text-slate-400');
    });
    // Show selected tab
    const tabContent = document.getElementById('tab-' + tab);
    if (tabContent) tabContent.classList.remove('hidden');
    // Activate button
    const activeBtn = document.querySelector(`.dtab-btn[data-tab="${tab}"]`);
    if (activeBtn) {
        activeBtn.classList.add('tab-active');
        activeBtn.classList.remove('border-transparent', 'text-slate-400');
    }
    // Load messages on first switch
    if (tab === 'messages') loadMessages();
}

/* ─── Load User Profile ─── */
async function loadUserProfile() {
    const user = JSON.parse(localStorage.getItem('user') || 'null');
    if (!user) return;

    // Set welcome header
    document.getElementById('dashUserName').textContent = user.name || '—';
    const avatarUrl = user.avatar
        ? (user.avatar.startsWith('http') ? user.avatar : BASE_URL + '/' + user.avatar)
        : BASE_URL + '/public/images/default-avatar.png';
    document.getElementById('dashAvatar').src = avatarUrl;
    document.getElementById('profileAvatar').src = avatarUrl;

    // Fill profile form
    document.getElementById('profileName').value = user.name || '';
    document.getElementById('profileEmail').value = user.email || '';
    document.getElementById('profilePhone').value = user.phone || '';
    document.getElementById('profileAge').value = user.age || '';
    document.getElementById('profileCity').value = user.city || '';
}

/* ─── Upload Avatar ─── */
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
            headers: {
                'X-User-Id': user.id
            },
            body: formData
        });
        const data = await res.json();
        if (res.ok && (data.url || data.filename)) {
            // Update avatar in user data
            user.avatar = data.url;
            localStorage.setItem('user', JSON.stringify(user));
            const newUrl = data.path.startsWith('http') ? data.path : BASE_URL + '/' + data.path;
            document.getElementById('dashAvatar').src = newUrl;
            document.getElementById('profileAvatar').src = newUrl;
        } else {
            alert(data.error || 'שגיאה בהעלאת התמונה');
        }
    } catch {
        alert('שגיאה בהעלאת התמונה');
    }
    // Reset input so same file can be re-selected
    input.value = '';
}

/* ─── Save Profile ─── */
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
            headers: {
                'Content-Type': 'application/json',
                'X-User-Id': user.id
            },
            body: JSON.stringify(payload)
        });
        const data = await res.json();
        if (res.ok) {
            // Update localStorage
            if (data.user) Object.assign(user, data.user);
            else Object.assign(user, payload);
            localStorage.setItem('user', JSON.stringify(user));
            document.getElementById('dashUserName').textContent = user.name;
            updateAuthUI();
            okEl.textContent = 'הפרטים עודכנו בהצלחה!';
            okEl.classList.remove('hidden');
            setTimeout(() => okEl.classList.add('hidden'), 4000);
        } else {
            errEl.textContent = data.error || 'שגיאה בעדכון הפרטים';
            errEl.classList.remove('hidden');
        }
    } catch {
        errEl.textContent = 'שגיאה בחיבור לשרת';
        errEl.classList.remove('hidden');
    }
});

/* ─── Change Password ─── */
document.getElementById('changePasswordForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const errEl = document.getElementById('changePasswordError');
    const okEl = document.getElementById('changePasswordSuccess');
    errEl.classList.add('hidden');
    okEl.classList.add('hidden');

    const newPass = document.getElementById('newPassword').value;
    const confirmPass = document.getElementById('confirmNewPassword').value;

    if (newPass !== confirmPass) {
        errEl.textContent = 'הסיסמאות אינן תואמות';
        errEl.classList.remove('hidden');
        return;
    }

    const user = JSON.parse(localStorage.getItem('user') || 'null');
    if (!user) return;

    try {
        const res = await fetch(API + '/api/user/change-password', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-User-Id': user.id
            },
            body: JSON.stringify({
                current_password: document.getElementById('currentPassword').value,
                new_password: newPass
            })
        });
        const data = await res.json();
        if (res.ok) {
            okEl.textContent = 'הסיסמה שונתה בהצלחה!';
            okEl.classList.remove('hidden');
            document.getElementById('changePasswordForm').reset();
            setTimeout(() => okEl.classList.add('hidden'), 4000);
        } else {
            errEl.textContent = data.error || 'שגיאה בשינוי הסיסמה';
            errEl.classList.remove('hidden');
        }
    } catch {
        errEl.textContent = 'שגיאה בחיבור לשרת';
        errEl.classList.remove('hidden');
    }
});

/* ─── Load Messages ─── */
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
                        <h4 class="font-bold text-white text-sm">${escapeHtml(msg.from_name || msg.sender_name || 'מערכת')}</h4>
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

/* ─── Forgot Password Form ─── */
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
            body: JSON.stringify({
                email: document.getElementById('forgotEmail').value
            })
        });
        const data = await res.json();
        if (res.ok) {
            okEl.textContent = data.message || 'קישור לאיפוס סיסמה נשלח לאימייל שלך';
            okEl.classList.remove('hidden');
            document.getElementById('forgotPasswordForm').reset();
        } else {
            errEl.textContent = data.error || 'שגיאה בשליחת הבקשה';
            errEl.classList.remove('hidden');
        }
    } catch {
        errEl.textContent = 'שגיאה בחיבור לשרת';
        errEl.classList.remove('hidden');
    }
});

/* ─── Reset Password Form ─── */
document.getElementById('resetPasswordForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const errEl = document.getElementById('resetPasswordError');
    const okEl = document.getElementById('resetPasswordSuccess');
    errEl.classList.add('hidden');
    okEl.classList.add('hidden');

    const newPass = document.getElementById('resetNewPassword').value;
    const confirmPass = document.getElementById('resetConfirmPassword').value;

    if (newPass !== confirmPass) {
        errEl.textContent = 'הסיסמאות אינן תואמות';
        errEl.classList.remove('hidden');
        return;
    }

    const token = new URLSearchParams(window.location.search).get('reset');

    try {
        const res = await fetch(API + '/api/reset-password', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                token: token,
                new_password: newPass
            })
        });
        const data = await res.json();
        if (res.ok) {
            okEl.textContent = 'הסיסמה אופסה בהצלחה! מעביר להתחברות...';
            okEl.classList.remove('hidden');
            document.getElementById('resetPasswordForm').reset();
            setTimeout(() => {
                window.location.href = BASE_URL + '/dashboard';
            }, 2000);
        } else {
            errEl.textContent = data.error || 'שגיאה באיפוס הסיסמה';
            errEl.classList.remove('hidden');
        }
    } catch {
        errEl.textContent = 'שגיאה בחיבור לשרת';
        errEl.classList.remove('hidden');
    }
});

/* ─── Utility: HTML Escape ─── */
function escapeHtml(str) {
    if (!str) return '';
    const div = document.createElement('div');
    div.textContent = str;
    return div.innerHTML;
}

/* ─── Run ─── */
init();
</script>

<?php include BASE_PATH . '/app/views/layouts/footer.php'; ?>
