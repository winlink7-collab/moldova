<?php require BASE_PATH . '/app/views/layouts/header.php'; ?>

<style>
.profile-card:hover .profile-img { transform: scale(1.08); }
.profile-card:hover .profile-overlay { opacity: 1; }
.profile-card:hover { border-color: rgba(242,208,13,0.4); box-shadow: 0 0 30px rgba(242,208,13,0.08); }
</style>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
<div class="flex flex-col lg:flex-row gap-10">

<!-- Sidebar Filters -->
<aside class="w-full lg:w-80 flex-shrink-0">
<div class="sticky top-28 bg-card rounded-2xl border border-white/10 p-6 space-y-6">
    <div>
        <h2 class="text-xl font-bold text-primary mb-1">מסננים מתקדמים</h2>
        <p class="text-sm text-slate-500">צמצם את תוצאות החיפוש שלך</p>
    </div>

    <!-- Age -->
    <div class="space-y-2">
        <div class="flex items-center gap-2 text-sm font-bold text-slate-300">
            <span class="material-symbols-outlined text-primary text-lg">person_search</span> טווח גילאים
        </div>
        <div class="flex items-center gap-3">
            <input id="ageMin" class="w-full bg-background-dark border border-white/10 rounded-lg py-2.5 px-3 text-white text-center focus:border-primary outline-none" type="number" value="18" min="18" max="60"/>
            <span class="text-slate-500 font-bold">-</span>
            <input id="ageMax" class="w-full bg-background-dark border border-white/10 rounded-lg py-2.5 px-3 text-white text-center focus:border-primary outline-none" type="number" value="45" min="18" max="60"/>
        </div>
    </div>

    <!-- Country -->
    <div class="space-y-2">
        <div class="flex items-center gap-2 text-sm font-bold text-slate-300">
            <span class="material-symbols-outlined text-primary text-lg">location_on</span> מדינה
        </div>
        <select id="countryFilter" class="w-full bg-background-dark border border-white/10 rounded-lg py-2.5 px-3 text-white focus:border-primary outline-none">
            <option value="">כל המדינות</option>
            <option value="moldova">מולדובה 🇲🇩</option>
            <option value="ukraine">אוקראינה 🇺🇦</option>
        </select>
    </div>

    <!-- Marital Status -->
    <div class="space-y-2">
        <div class="flex items-center gap-2 text-sm font-bold text-slate-300">
            <span class="material-symbols-outlined text-primary text-lg">favorite</span> מצב משפחתי
        </div>
        <select id="maritalFilter" class="w-full bg-background-dark border border-white/10 rounded-lg py-2.5 px-3 text-white focus:border-primary outline-none">
            <option value="">הכל</option>
            <option value="single">רווקה</option>
            <option value="divorced">גרושה</option>
            <option value="widowed">אלמנה</option>
        </select>
    </div>

    <button onclick="applyFilters()" class="w-full py-3.5 bg-primary text-background-dark text-base font-bold rounded-xl hover:bg-primary/90 transition-all flex items-center justify-center gap-2 shadow-lg shadow-primary/10">
        <span class="material-symbols-outlined">search</span> חפש עכשיו
    </button>
    <button onclick="resetFilters()" class="w-full py-2.5 text-sm text-slate-400 hover:text-primary transition-colors">
        <span class="material-symbols-outlined text-sm align-middle">restart_alt</span> נקה מסננים
    </button>
</div>
</aside>

<!-- Main Content -->
<section class="flex-1">
    <!-- Top bar -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-8 gap-4">
        <div class="flex items-center gap-4">
            <h2 class="text-2xl md:text-3xl font-bold">
                מצאנו <span id="totalCount" class="text-primary font-black">0</span> התאמות עבורך
            </h2>
            <?php if (!empty($isAdmin)): ?>
            <button onclick="openAddProfile()" class="bg-primary text-background-dark px-4 py-2 rounded-xl font-bold text-sm hover:opacity-90 transition flex items-center gap-2 shadow-lg">
                <span class="material-symbols-outlined text-lg">person_add</span>
                הוסף פרופיל
            </button>
            <?php endif; ?>
        </div>
        <div class="flex gap-2">
            <button onclick="filterCountry('')" class="country-btn px-4 py-2 rounded-lg text-sm font-bold border border-white/10 hover:border-primary/40 transition-all bg-card text-slate-300 hover:text-primary">הכל</button>
            <button onclick="filterCountry('moldova')" class="country-btn px-4 py-2 rounded-lg text-sm font-bold border border-white/10 hover:border-primary/40 transition-all bg-card text-slate-300 hover:text-primary">🇲🇩 מולדובה</button>
            <button onclick="filterCountry('ukraine')" class="country-btn px-4 py-2 rounded-lg text-sm font-bold border border-white/10 hover:border-primary/40 transition-all bg-card text-slate-300 hover:text-primary">🇺🇦 אוקראינה</button>
        </div>
    </div>

    <!-- Profile Grid -->
    <div id="profileGrid" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        <p class="text-slate-500 text-center py-20 col-span-full">טוען פרופילים...</p>
    </div>

    <!-- Pagination -->
    <div id="pagination" class="mt-12 flex items-center justify-center gap-2"></div>
</section>

</div>
</div>

<script>
let currentPage = 1;
let currentCountry = '';
let currentMarital = '';

function applyFilters() {
    currentCountry = document.getElementById('countryFilter').value;
    currentMarital = document.getElementById('maritalFilter').value;
    loadProfiles(1);
}

function resetFilters() {
    document.getElementById('ageMin').value = '18';
    document.getElementById('ageMax').value = '45';
    document.getElementById('countryFilter').value = '';
    document.getElementById('maritalFilter').value = '';
    currentCountry = '';
    currentMarital = '';
    loadProfiles(1);
}

function filterCountry(c) {
    currentCountry = c;
    document.getElementById('countryFilter').value = c;
    // Highlight active button
    document.querySelectorAll('.country-btn').forEach(b => {
        b.classList.remove('bg-primary', 'text-background-dark', 'border-primary');
        b.classList.add('bg-card', 'text-slate-300');
    });
    event.target.classList.remove('bg-card', 'text-slate-300');
    event.target.classList.add('bg-primary', 'text-background-dark', 'border-primary');
    loadProfiles(1);
}

async function loadProfiles(page = 1) {
    currentPage = page;
    const ageMin = document.getElementById('ageMin').value;
    const ageMax = document.getElementById('ageMax').value;

    let url = BASE + `/api/profiles?page=${page}&per_page=9`;
    if (currentCountry) url += `&country=${currentCountry}`;
    if (ageMin) url += `&age_min=${ageMin}`;
    if (ageMax) url += `&age_max=${ageMax}`;
    if (currentMarital) url += `&marital_status=${currentMarital}`;

    try {
        const res = await fetch(url);
        const data = await res.json();
        document.getElementById('totalCount').textContent = data.total;
        renderProfiles(data.profiles);
        renderPagination(data.page, data.total_pages);
    } catch {
        document.getElementById('profileGrid').innerHTML = '<p class="text-red-400 text-center py-20 col-span-full">שגיאה בטעינה</p>';
    }
}

function renderProfiles(profiles) {
    const grid = document.getElementById('profileGrid');
    if (!profiles.length) {
        grid.innerHTML = '<div class="col-span-full text-center py-20"><span class="material-symbols-outlined text-slate-600 text-6xl block mb-4">search_off</span><p class="text-slate-500 text-lg">לא נמצאו פרופילים התואמים לחיפוש</p><button onclick="resetFilters()" class="text-primary text-sm mt-3 hover:underline">נקה מסננים ונסה שוב</button></div>';
        return;
    }
    grid.innerHTML = profiles.map(p => {
        const flag = p.country === 'moldova' ? '🇲🇩' : '🇺🇦';
        const countryName = p.country === 'moldova' ? 'מולדובה' : 'אוקראינה';
        return `
        <a href="${BASE}/profile/${p.id}" class="profile-card group relative rounded-2xl overflow-hidden border border-white/5 cursor-pointer transition-all duration-500 block">
            <div class="aspect-[3/4] relative overflow-hidden">
                <img class="profile-img w-full h-full object-cover transition-transform duration-700" src="${p.primary_photo || ''}" alt="${p.name}" onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 300 400%22><rect fill=%22%231a1810%22 width=%22300%22 height=%22400%22/><text x=%22150%22 y=%22210%22 text-anchor=%22middle%22 fill=%22%23f2d00d%22 font-size=%2260%22>${p.name[0]}</text></svg>'"/>

                <!-- Gradient overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent"></div>

                <!-- VIP Badge -->
                ${p.is_vip ? `<div class="absolute top-4 right-4 z-10 bg-primary/90 backdrop-blur-sm text-background-dark text-[11px] font-extrabold px-3 py-1.5 rounded-full flex items-center gap-1 shadow-lg">
                    <span class="material-symbols-outlined text-sm" style="font-variation-settings:'FILL' 1">star</span> VIP
                </div>` : ''}

                <!-- Verified Badge -->
                ${p.is_verified ? `<div class="absolute top-4 left-4 z-10 bg-emerald-500/80 backdrop-blur-sm text-white text-[11px] font-bold px-2.5 py-1.5 rounded-full flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm" style="font-variation-settings:'FILL' 1">verified</span>
                </div>` : ''}

                <!-- Online indicator -->
                ${p.is_online ? `<div class="absolute top-4 left-4 ${p.is_verified ? 'top-14' : ''} z-10 flex items-center gap-1.5 bg-black/40 backdrop-blur-sm px-2.5 py-1 rounded-full">
                    <div class="size-2 rounded-full bg-emerald-400 animate-pulse"></div>
                    <span class="text-[10px] text-emerald-300 font-bold">מחוברת</span>
                </div>` : ''}

                <!-- Info overlay on image -->
                <div class="absolute bottom-0 right-0 left-0 p-5 z-10">
                    <h3 class="text-2xl font-extrabold text-white mb-1 drop-shadow-lg">${p.name}, ${p.age}</h3>
                    <p class="text-sm text-white/70 flex items-center gap-1.5 font-medium">
                        <span class="material-symbols-outlined text-primary text-base">location_on</span>
                        ${p.city}, ${countryName} ${flag}
                    </p>
                    ${p.occupation ? `<p class="text-xs text-white/50 mt-1 flex items-center gap-1"><span class="material-symbols-outlined text-xs">work</span> ${p.occupation}</p>` : ''}
                </div>

                <!-- Hover overlay -->
                <div class="profile-overlay absolute inset-0 bg-primary/10 opacity-0 transition-opacity duration-500 z-[5]"></div>
            </div>
        </a>`;
    }).join('');
}

function renderPagination(page, pages) {
    const el = document.getElementById('pagination');
    if (pages <= 1) { el.innerHTML = ''; return; }
    let html = '';
    if (page > 1) html += `<button onclick="loadProfiles(${page-1})" class="size-10 flex items-center justify-center rounded-lg bg-card border border-white/10 text-slate-400 hover:text-primary hover:border-primary/30 transition-all"><span class="material-symbols-outlined">chevron_right</span></button>`;
    for (let i = 1; i <= pages; i++) {
        if (pages > 7 && i > 3 && i < pages - 2 && Math.abs(i - page) > 1) {
            if (i === 4 || i === pages - 3) html += '<span class="text-slate-600 px-1">...</span>';
            continue;
        }
        const active = i === page;
        html += `<button onclick="loadProfiles(${i})" class="size-10 flex items-center justify-center rounded-lg text-sm font-bold transition-all ${active ? 'bg-primary text-background-dark' : 'bg-card border border-white/10 text-slate-400 hover:text-primary hover:border-primary/30'}">${i}</button>`;
    }
    if (page < pages) html += `<button onclick="loadProfiles(${page+1})" class="size-10 flex items-center justify-center rounded-lg bg-card border border-white/10 text-slate-400 hover:text-primary hover:border-primary/30 transition-all"><span class="material-symbols-outlined">chevron_left</span></button>`;
    el.innerHTML = html;
}

// Init
loadProfiles();
</script>

<?php if (!empty($isAdmin)): ?>
<!-- Add Profile Modal -->
<div id="addProfileModal" class="fixed inset-0 z-[10001] hidden items-center justify-center bg-black/70 backdrop-blur-sm">
<div class="relative w-full max-w-3xl mx-4 bg-[#1c1a0e] border border-primary/30 rounded-2xl shadow-2xl max-h-[90vh] overflow-y-auto" dir="rtl">
    <div class="sticky top-0 bg-[#1c1a0e] border-b border-white/10 px-6 py-4 flex items-center justify-between z-10">
        <h3 class="text-lg font-bold text-primary">הוסף פרופיל חדש</h3>
        <button onclick="closeAddProfile()" class="text-slate-400 hover:text-white"><span class="material-symbols-outlined">close</span></button>
    </div>
    <form id="addProfileForm" onsubmit="submitNewProfile(event)" class="p-6 space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm text-white/60 mb-1">שם</label>
                <input id="ap_name" type="text" required class="w-full bg-white/5 border border-white/15 rounded-lg px-4 py-3 text-white"/>
            </div>
            <div>
                <label class="block text-sm text-white/60 mb-1">גיל</label>
                <input id="ap_age" type="number" required min="18" max="60" class="w-full bg-white/5 border border-white/15 rounded-lg px-4 py-3 text-white"/>
            </div>
            <div>
                <label class="block text-sm text-white/60 mb-1">עיר</label>
                <input id="ap_city" type="text" required class="w-full bg-white/5 border border-white/15 rounded-lg px-4 py-3 text-white"/>
            </div>
            <div>
                <label class="block text-sm text-white/60 mb-1">מדינה</label>
                <select id="ap_country" required class="w-full bg-white/5 border border-white/15 rounded-lg px-4 py-3 text-white">
                    <option value="moldova">מולדובה</option>
                    <option value="ukraine">אוקראינה</option>
                </select>
            </div>
            <div>
                <label class="block text-sm text-white/60 mb-1">עיסוק</label>
                <input id="ap_occupation" type="text" class="w-full bg-white/5 border border-white/15 rounded-lg px-4 py-3 text-white"/>
            </div>
            <div>
                <label class="block text-sm text-white/60 mb-1">השכלה</label>
                <input id="ap_education" type="text" class="w-full bg-white/5 border border-white/15 rounded-lg px-4 py-3 text-white"/>
            </div>
            <div>
                <label class="block text-sm text-white/60 mb-1">שפות</label>
                <input id="ap_languages" type="text" class="w-full bg-white/5 border border-white/15 rounded-lg px-4 py-3 text-white"/>
            </div>
            <div>
                <label class="block text-sm text-white/60 mb-1">תחביבים</label>
                <input id="ap_hobbies" type="text" class="w-full bg-white/5 border border-white/15 rounded-lg px-4 py-3 text-white"/>
            </div>
            <div>
                <label class="block text-sm text-white/60 mb-1">מצב משפחתי</label>
                <select id="ap_marital" class="w-full bg-white/5 border border-white/15 rounded-lg px-4 py-3 text-white">
                    <option value="single">רווקה</option>
                    <option value="divorced">גרושה</option>
                    <option value="widowed">אלמנה</option>
                </select>
            </div>
            <div>
                <label class="block text-sm text-white/60 mb-1">גובה</label>
                <input id="ap_height" type="text" class="w-full bg-white/5 border border-white/15 rounded-lg px-4 py-3 text-white" placeholder="165cm"/>
            </div>
            <div>
                <label class="block text-sm text-white/60 mb-1">משקל</label>
                <input id="ap_weight" type="text" class="w-full bg-white/5 border border-white/15 rounded-lg px-4 py-3 text-white" placeholder="55kg"/>
            </div>
            <div>
                <label class="block text-sm text-white/60 mb-1">ילדים</label>
                <input id="ap_children" type="text" class="w-full bg-white/5 border border-white/15 rounded-lg px-4 py-3 text-white" placeholder="אין / 1 / 2"/>
            </div>
            <div>
                <label class="block text-sm text-white/60 mb-1">מזל</label>
                <input id="ap_zodiac" type="text" class="w-full bg-white/5 border border-white/15 rounded-lg px-4 py-3 text-white" placeholder="מזל טלה, שור..."/>
            </div>
        </div>
        <div>
            <label class="block text-sm text-white/60 mb-1">ביוגרפיה</label>
            <textarea id="ap_bio" rows="3" class="w-full bg-white/5 border border-white/15 rounded-lg px-4 py-3 text-white resize-none"></textarea>
        </div>
        <div>
            <label class="block text-sm text-white/60 mb-1">מחפשת / ציטוט</label>
            <input id="ap_quote" type="text" class="w-full bg-white/5 border border-white/15 rounded-lg px-4 py-3 text-white"/>
        </div>

        <!-- Main Photo -->
        <div>
            <label class="block text-sm text-white/60 mb-1">תמונה ראשית</label>
            <div class="flex items-center gap-4">
                <input id="ap_main_file" type="file" accept="image/*" onchange="apUploadMain(this)" class="hidden"/>
                <button type="button" onclick="document.getElementById('ap_main_file').click()" class="bg-primary/20 text-primary px-5 py-3 rounded-lg font-bold text-sm hover:bg-primary/30 flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg">add_photo_alternate</span> בחר תמונה
                </button>
                <img id="ap_main_preview" src="" class="h-16 rounded hidden"/>
                <input id="ap_main_url" type="hidden"/>
            </div>
        </div>

        <!-- Gallery Photos -->
        <div>
            <label class="block text-sm text-white/60 mb-1">תמונות גלריה</label>
            <div class="flex items-center gap-4">
                <input id="ap_gallery_files" type="file" accept="image/*" multiple onchange="apUploadGallery(this)" class="hidden"/>
                <button type="button" onclick="document.getElementById('ap_gallery_files').click()" class="bg-primary/20 text-primary px-5 py-3 rounded-lg font-bold text-sm hover:bg-primary/30 flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg">photo_library</span> בחר תמונות
                </button>
                <span id="ap_gallery_progress" class="text-sm text-primary hidden">מעלה...</span>
            </div>
            <div id="ap_gallery_preview" class="flex flex-wrap gap-2 mt-3"></div>
        </div>

        <!-- Videos -->
        <div>
            <label class="block text-sm text-white/60 mb-1">סרטונים</label>
            <div class="flex items-center gap-4">
                <input id="ap_video_files" type="file" accept="video/mp4,video/webm,.mp4,.webm,.mov" multiple onchange="apUploadVideos(this)" class="hidden"/>
                <button type="button" onclick="document.getElementById('ap_video_files').click()" class="bg-primary/20 text-primary px-5 py-3 rounded-lg font-bold text-sm hover:bg-primary/30 flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg">video_call</span> בחר סרטונים
                </button>
                <span id="ap_video_progress" class="text-sm text-primary hidden">מעלה...</span>
            </div>
            <div id="ap_video_preview" class="flex flex-wrap gap-2 mt-3"></div>
        </div>

        <div id="ap_error" class="text-sm text-red-400 hidden"></div>

        <div class="flex justify-end gap-3 pt-4 border-t border-white/10">
            <button type="button" onclick="closeAddProfile()" class="px-6 bg-white/10 text-slate-300 py-3 rounded-xl font-bold">ביטול</button>
            <button type="submit" id="ap_submit" class="bg-primary text-background-dark px-8 py-3 rounded-xl font-bold text-lg hover:opacity-90 transition">שמור פרופיל</button>
        </div>
    </form>
</div>
</div>

<script>
let apGallery = [];
let apVideos = [];

function openAddProfile() {
    const m = document.getElementById('addProfileModal');
    m.classList.remove('hidden'); m.classList.add('flex');
    document.getElementById('addProfileForm').reset();
    document.getElementById('ap_main_url').value = '';
    document.getElementById('ap_main_preview').classList.add('hidden');
    apGallery = [];
    apVideos = [];
    renderApGallery();
    renderApVideos();
}

function closeAddProfile() {
    const m = document.getElementById('addProfileModal');
    m.classList.add('hidden'); m.classList.remove('flex');
}

document.getElementById('addProfileModal').addEventListener('click', e => { if (e.target === e.currentTarget) closeAddProfile(); });

async function apUploadMain(input) {
    if (!input.files[0]) return;
    const fd = new FormData(); fd.append('file', input.files[0]);
    try {
        const res = await fetch(BASE + '/api/upload', { method: 'POST', body: fd });
        const data = await res.json();
        const url = data.url || data.path;
        if (url) {
            document.getElementById('ap_main_url').value = url;
            document.getElementById('ap_main_preview').src = url;
            document.getElementById('ap_main_preview').classList.remove('hidden');
        }
    } catch(e) { console.error(e); }
}

async function apUploadGallery(input) {
    const prog = document.getElementById('ap_gallery_progress');
    prog.classList.remove('hidden');
    for (let i = 0; i < input.files.length; i++) {
        prog.textContent = `מעלה ${i+1} מתוך ${input.files.length}...`;
        const fd = new FormData(); fd.append('file', input.files[i]);
        try {
            const res = await fetch(BASE + '/api/upload', { method: 'POST', body: fd });
            const data = await res.json();
            if (data.url || data.path) apGallery.push(data.url || data.path);
        } catch(e) { console.error(e); }
    }
    renderApGallery();
    prog.textContent = 'הועלו!';
    setTimeout(() => prog.classList.add('hidden'), 2000);
    input.value = '';
}

function renderApGallery() {
    document.getElementById('ap_gallery_preview').innerHTML = apGallery.map((url, i) => `
        <div class="relative">
            <img src="${url}" class="w-16 h-16 object-cover rounded border border-white/10"/>
            <button type="button" onclick="apGallery.splice(${i},1);renderApGallery()" class="absolute -top-1 -right-1 bg-red-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">&times;</button>
        </div>
    `).join('');
}

async function apUploadVideos(input) {
    const prog = document.getElementById('ap_video_progress');
    prog.classList.remove('hidden');
    for (let i = 0; i < input.files.length; i++) {
        prog.textContent = `מעלה סרטון ${i+1} מתוך ${input.files.length}...`;
        const fd = new FormData(); fd.append('file', input.files[i]);
        try {
            const res = await fetch(BASE + '/api/upload', { method: 'POST', body: fd });
            const data = await res.json();
            if (data.url || data.path) apVideos.push({ url: data.url || data.path, title: input.files[i].name.replace(/\.[^.]+$/, '') });
        } catch(e) { console.error(e); }
    }
    renderApVideos();
    prog.textContent = 'הועלו!';
    setTimeout(() => prog.classList.add('hidden'), 2000);
    input.value = '';
}

function renderApVideos() {
    document.getElementById('ap_video_preview').innerHTML = apVideos.map((v, i) => `
        <div class="relative bg-black rounded overflow-hidden" style="width:120px;height:80px;">
            <video src="${v.url}" class="w-full h-full object-cover" preload="metadata"></video>
            <button type="button" onclick="apVideos.splice(${i},1);renderApVideos()" class="absolute -top-1 -right-1 bg-red-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">&times;</button>
            <div class="absolute bottom-0 left-0 right-0 bg-black/70 text-white text-[9px] text-center truncate px-1">${v.title}</div>
        </div>
    `).join('');
}

async function submitNewProfile(e) {
    e.preventDefault();
    const errEl = document.getElementById('ap_error');
    const btn = document.getElementById('ap_submit');
    errEl.classList.add('hidden');
    btn.textContent = 'שומר...';
    btn.disabled = true;

    const body = {
        name: document.getElementById('ap_name').value,
        age: parseInt(document.getElementById('ap_age').value),
        city: document.getElementById('ap_city').value,
        country: document.getElementById('ap_country').value,
        occupation: document.getElementById('ap_occupation').value,
        education: document.getElementById('ap_education').value,
        languages: document.getElementById('ap_languages').value,
        hobbies: document.getElementById('ap_hobbies').value,
        marital_status: document.getElementById('ap_marital').value,
        height: document.getElementById('ap_height').value,
        weight: document.getElementById('ap_weight').value,
        children: document.getElementById('ap_children').value,
        zodiac: document.getElementById('ap_zodiac').value,
        about: document.getElementById('ap_bio').value,
        looking_for: document.getElementById('ap_quote').value,
        is_active: true
    };

    try {
        // Create profile
        const res = await fetch(BASE + '/api/admin/profiles', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(body)
        });
        const result = await res.json();
        if (!res.ok) throw new Error(result.error || 'שגיאה');

        const profileId = result.profile.id;

        // Upload main photo
        const mainUrl = document.getElementById('ap_main_url').value;
        if (mainUrl) {
            await fetch(BASE + '/api/admin/photos', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ profile_id: profileId, photo_url: mainUrl, is_primary: true })
            });
        }

        // Upload gallery photos
        for (const url of apGallery) {
            if (url !== mainUrl) {
                await fetch(BASE + '/api/admin/photos', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ profile_id: profileId, photo_url: url, is_primary: false })
                });
            }
        }

        // Upload videos
        for (const v of apVideos) {
            await fetch(BASE + '/api/admin/videos', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ profile_id: profileId, video_url: v.url, title: v.title })
            });
        }

        if (typeof aieToast === 'function') aieToast('פרופיל נוצר בהצלחה!');
        closeAddProfile();
        loadProfiles(currentPage);
    } catch(err) {
        errEl.textContent = err.message;
        errEl.classList.remove('hidden');
    }

    btn.textContent = 'שמור פרופיל';
    btn.disabled = false;
}
</script>
<?php endif; ?>

<?php require BASE_PATH . '/app/views/layouts/footer.php'; ?>
