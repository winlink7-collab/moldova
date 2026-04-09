<?php require BASE_PATH . '/app/views/layouts/header.php'; ?>

<style>
.gold-gradient { background: linear-gradient(135deg, #f2d00d 0%, #b89b06 100%); color: #12110a; }
.luxury-shadow { box-shadow: 0 0 50px -12px rgba(242, 208, 13, 0.15); }
.lightbox { position: fixed; inset: 0; z-index: 300; background: rgba(0,0,0,0.92); backdrop-filter: blur(8px); display: flex; align-items: center; justify-content: center; opacity: 0; pointer-events: none; transition: opacity 0.3s ease; }
.lightbox.active { opacity: 1; pointer-events: auto; }
.lightbox img { max-width: 90vw; max-height: 85vh; object-fit: contain; border-radius: 12px; box-shadow: 0 0 80px rgba(242,208,13,0.15); transform: scale(0.9); transition: transform 0.3s ease; }
.lightbox.active img { transform: scale(1); }
.lightbox-nav { position: absolute; top: 50%; transform: translateY(-50%); width: 56px; height: 56px; border-radius: 50%; background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.15); display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s; color: white; }
.lightbox-nav:hover { background: rgba(242,208,13,0.2); border-color: rgba(242,208,13,0.4); color: #f2d00d; }
.gallery-item { cursor: pointer; position: relative; overflow: hidden; }
.gallery-item::after { content: ''; position: absolute; inset: 0; background: rgba(0,0,0,0); transition: background 0.3s; }
.gallery-item:hover::after { background: rgba(0,0,0,0.25); }
.gallery-item .zoom-icon { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%) scale(0); opacity: 0; transition: all 0.3s; z-index: 5; background: rgba(0,0,0,0.6); border-radius: 50%; width: 48px; height: 48px; display: flex; align-items: center; justify-content: center; }
.gallery-item:hover .zoom-icon { transform: translate(-50%, -50%) scale(1); opacity: 1; }

<?php if (!empty($isAdmin)): ?>
/* ===== Inline Edit Admin Styles ===== */
.admin-bar { position: fixed; top: 0; left: 0; right: 0; z-index: 400; background: linear-gradient(135deg, #1a1810 0%, #0f0e08 100%); border-bottom: 2px solid #f2d00d; padding: 10px 24px; display: flex; align-items: center; justify-content: space-between; gap: 16px; }
body header.sticky { top: 56px !important; }
.edit-overlay { display: none; }
.edit-mode .edit-overlay { display: flex; position: absolute; inset: 0; z-index: 30; background: rgba(242,208,13,0.04); border: 2px dashed rgba(242,208,13,0.3); border-radius: inherit; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s; }
.edit-mode .edit-overlay:hover { background: rgba(242,208,13,0.1); border-color: rgba(242,208,13,0.6); }
.edit-mode .editable-section { position: relative; }
.edit-mode [id^="profile"][id$="Btn"] { outline: 2px dashed rgba(242,208,13,0.4); outline-offset: 2px; cursor: pointer !important; }
.edit-mode [id^="profile"][id$="Btn"]:hover { outline-color: #f2d00d; background: rgba(242,208,13,0.1); }
.edit-btn-float { background: rgba(242,208,13,0.9); color: #0f0e08; border: none; border-radius: 12px; padding: 8px 16px; font-size: 13px; font-weight: 800; cursor: pointer; display: flex; align-items: center; gap: 6px; transition: all 0.2s; box-shadow: 0 4px 20px rgba(242,208,13,0.3); }
.edit-btn-float:hover { transform: scale(1.05); box-shadow: 0 6px 30px rgba(242,208,13,0.5); }
.edit-btn-float .material-symbols-outlined { font-size: 18px; }
.inline-editor { position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 500; background: #1a1810; border: 1px solid rgba(255,255,255,0.1); border-radius: 16px; padding: 0; width: 95%; max-width: 700px; max-height: 85vh; overflow-y: auto; box-shadow: 0 0 100px rgba(0,0,0,0.8); }
.inline-editor-backdrop { position: fixed; inset: 0; z-index: 499; background: rgba(0,0,0,0.7); backdrop-filter: blur(4px); }
.inline-editor-header { position: sticky; top: 0; background: #1a1810; border-bottom: 1px solid rgba(255,255,255,0.1); padding: 16px 24px; display: flex; align-items: center; justify-content: space-between; z-index: 1; }
.inline-editor-body { padding: 24px; }
.ie-field { margin-bottom: 16px; }
.ie-field label { display: block; font-size: 12px; color: rgba(255,255,255,0.5); margin-bottom: 6px; font-weight: 600; }
.ie-field input, .ie-field select, .ie-field textarea { width: 100%; background: #0f0e08; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; padding: 10px 14px; color: white; font-size: 14px; outline: none; transition: border 0.2s; }
.ie-field input:focus, .ie-field select:focus, .ie-field textarea:focus { border-color: #f2d00d; }
.ie-save-btn { background: #f2d00d; color: #0f0e08; border: none; border-radius: 10px; padding: 12px 32px; font-size: 15px; font-weight: 800; cursor: pointer; transition: all 0.2s; }
.ie-save-btn:hover { opacity: 0.9; transform: scale(1.02); }
.ie-cancel-btn { background: transparent; color: rgba(255,255,255,0.6); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; padding: 12px 24px; font-size: 14px; cursor: pointer; transition: all 0.2s; }
.ie-cancel-btn:hover { color: white; border-color: rgba(255,255,255,0.3); }
.ie-photo-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)); gap: 8px; }
.ie-photo-item { position: relative; aspect-ratio: 1; border-radius: 8px; overflow: hidden; border: 1px solid rgba(255,255,255,0.1); }
.ie-photo-item img { width: 100%; height: 100%; object-fit: cover; }
.ie-photo-item .ie-photo-del { position: absolute; top: 4px; right: 4px; width: 22px; height: 22px; border-radius: 50%; background: rgba(220,38,38,0.9); color: white; border: none; font-size: 14px; cursor: pointer; display: flex; align-items: center; justify-content: center; line-height: 1; }
.ie-photo-item.primary { border-color: #f2d00d; }
.ie-photo-item.primary::after { content: '<?= t('primary_photo') ?>'; position: absolute; bottom: 0; left: 0; right: 0; background: rgba(242,208,13,0.9); color: #0f0e08; font-size: 10px; font-weight: 800; text-align: center; padding: 2px; }
.toast { position: fixed; bottom: 24px; left: 50%; transform: translateX(-50%); z-index: 600; padding: 14px 28px; border-radius: 12px; font-weight: 700; font-size: 14px; box-shadow: 0 10px 40px rgba(0,0,0,0.4); transition: all 0.3s; opacity: 0; pointer-events: none; }
.toast.show { opacity: 1; }
.toast.success { background: #16a34a; color: white; }
.toast.error { background: #dc2626; color: white; }
<?php endif; ?>
</style>


<!-- Loading -->
<div id="loading" class="fixed inset-0 z-[200] bg-background-dark flex items-center justify-center">
    <span class="material-symbols-outlined text-primary text-5xl animate-spin">progress_activity</span>
</div>

<?php if (!empty($isAdmin)): ?>
<!-- Admin Floating Bar -->
<div class="admin-bar" id="adminBar">
    <div class="flex items-center gap-3">
        <span class="material-symbols-outlined text-primary text-2xl">admin_panel_settings</span>
        <span class="text-primary font-bold text-sm"><?= t('edit_mode') ?></span>
    </div>
    <div class="flex items-center gap-3">
        <button id="toggleEditBtn" onclick="toggleEditMode()" class="flex items-center gap-2 px-5 py-2 rounded-lg text-sm font-bold transition-all bg-primary/10 text-primary border border-primary/30 hover:bg-primary/20">
            <span class="material-symbols-outlined text-lg">edit</span>
            <span id="toggleEditLabel"><?= t('enable_editing') ?></span>
        </button>
        <a href="<?= BASE_URL ?>/admin" class="flex items-center gap-1 px-4 py-2 rounded-lg text-sm text-white/60 hover:text-white border border-white/10 hover:border-white/30 transition-all">
            <span class="material-symbols-outlined text-lg">dashboard</span>
            <?= t('admin_panel') ?>
        </a>
    </div>
</div>
<div style="height: 56px;"></div>

<!-- Toast Notification -->
<div id="toast" class="toast"></div>
<?php endif; ?>

<!-- Lightbox -->
<div id="lightbox" class="lightbox" onclick="closeLightbox(event)">
    <button onclick="closeLightbox()" class="absolute top-6 left-6 z-10 w-12 h-12 rounded-full bg-white/10 border border-white/20 flex items-center justify-center text-white hover:text-primary hover:border-primary/50 transition-all">
        <span class="material-symbols-outlined text-2xl">close</span>
    </button>
    <button onclick="prevImage(event)" class="lightbox-nav right-6">
        <span class="material-symbols-outlined text-2xl">chevron_right</span>
    </button>
    <button onclick="nextImage(event)" class="lightbox-nav left-6">
        <span class="material-symbols-outlined text-2xl">chevron_left</span>
    </button>
    <img id="lightboxImg" src="" alt=""/>
    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 text-sm text-slate-400 font-medium">
        <span id="lightboxCounter"></span>
    </div>
</div>

<div class="max-w-[1400px] mx-auto px-6 lg:px-20 py-12">

<!-- Hero: Image + Info -->
<section class="grid grid-cols-1 lg:grid-cols-12 gap-12 mb-20">

    <!-- Main Image -->
    <div class="lg:col-span-7 relative group overflow-hidden rounded-3xl luxury-shadow gallery-item editable-section" style="height: 750px;" onclick="openLightbox(0)">
        <div class="absolute inset-0 bg-gradient-to-t from-background-dark via-transparent to-transparent opacity-80 z-10 pointer-events-none"></div>
        <img id="mainImage" alt="" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105" src=""/>
        <div class="zoom-icon"><span class="material-symbols-outlined text-white text-2xl">zoom_in</span></div>
        <div class="absolute bottom-10 right-10 z-20 pointer-events-none">
            <div id="badge" class="hidden items-center gap-2 bg-primary/95 text-background-dark px-5 py-2 rounded-full text-xs font-black uppercase tracking-widest mb-6 w-fit shadow-2xl">
                <span class="material-symbols-outlined text-base">verified</span> <span id="badgeText"></span>
            </div>
            <h2 class="text-7xl lg:text-8xl font-black text-white drop-shadow-2xl leading-[0.85]">
                <span id="heroName">...</span>, <span id="heroAge" class="font-light"></span>
            </h2>
        </div>
        <?php if (!empty($isAdmin)): ?>
        <div class="edit-overlay" onclick="event.stopPropagation(); openEditor('photos')">
            <button class="edit-btn-float"><span class="material-symbols-outlined">photo_library</span> <?= t('edit_photos') ?></button>
        </div>
        <?php endif; ?>
    </div>

    <!-- Profile Details -->
    <div class="lg:col-span-5 flex flex-col justify-between">
        <div>
            <!-- Location -->
            <div class="flex items-center gap-4 mb-10 pb-10 border-b border-white/5 editable-section relative">
                <span class="material-symbols-outlined text-primary text-4xl">location_on</span>
                <div>
                    <p class="text-primary font-black uppercase tracking-[0.3em] text-[10px] mb-1"><?= t('location') ?></p>
                    <span id="location" class="text-2xl font-light text-white"></span>
                </div>
                <?php if (!empty($isAdmin)): ?>
                <div class="edit-overlay" onclick="openEditor('basic')">
                    <button class="edit-btn-float"><span class="material-symbols-outlined">edit</span> <?= t('basic_details') ?></button>
                </div>
                <?php endif; ?>
            </div>

            <!-- Details Grid -->
            <div class="space-y-6 mb-10 editable-section relative">
                <div class="flex items-center gap-4 p-4 bg-card/50 rounded-xl border border-white/5">
                    <span class="material-symbols-outlined text-primary text-2xl">cake</span>
                    <div><p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest"><?= t('age') ?></p>
                    <p id="detAge" class="text-lg text-white font-medium"></p></div>
                </div>
                <div class="flex items-center gap-4 p-4 bg-card/50 rounded-xl border border-white/5">
                    <span class="material-symbols-outlined text-primary text-2xl">work</span>
                    <div><p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest"><?= t('occupation') ?></p>
                    <p id="detOccupation" class="text-lg text-white font-medium"></p></div>
                </div>
                <div class="flex items-center gap-4 p-4 bg-card/50 rounded-xl border border-white/5">
                    <span class="material-symbols-outlined text-primary text-2xl">school</span>
                    <div><p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest"><?= t('education') ?></p>
                    <p id="detEducation" class="text-lg text-white font-medium"></p></div>
                </div>
                <div class="flex items-center gap-4 p-4 bg-card/50 rounded-xl border border-white/5">
                    <span class="material-symbols-outlined text-primary text-2xl">translate</span>
                    <div><p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest"><?= t('languages') ?></p>
                    <p id="detLanguages" class="text-lg text-white font-medium"></p></div>
                </div>
                <div class="flex items-center gap-4 p-4 bg-card/50 rounded-xl border border-white/5">
                    <span class="material-symbols-outlined text-primary text-2xl">interests</span>
                    <div><p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest"><?= t('hobbies') ?></p>
                    <p id="detHobbies" class="text-lg text-white font-medium"></p></div>
                </div>
                <?php if (!empty($isAdmin)): ?>
                <div class="edit-overlay" onclick="openEditor('details')">
                    <button class="edit-btn-float"><span class="material-symbols-outlined">edit</span> <?= t('more_details') ?></button>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="space-y-4">
            <a id="profileMsgLink" href="#" onclick="handleMsgClick(event)" class="w-full py-5 rounded-2xl font-black text-lg uppercase tracking-widest hover:brightness-110 transition-all shadow-2xl flex items-center justify-center gap-3" style="background:linear-gradient(135deg,#f2d00d 0%,#b89b06 100%);color:#12110a;text-decoration:none;">
                <span class="material-symbols-outlined text-2xl">mail</span>
                <span id="profileMsgBtn" <?php if (!empty($isAdmin)): ?>onclick="profileInlineEdit(this,'profile_msg_btn');event.preventDefault();event.stopPropagation();"<?php endif; ?>><?= t('send_message') ?></span>
            </a>
            <div class="grid grid-cols-2 gap-4">
                <a id="profileVideoLink" href="#" onclick="handleVideoClick(event)" class="border-2 border-primary/40 text-primary py-4 rounded-2xl font-black text-sm uppercase tracking-wider hover:bg-primary/10 transition-all flex items-center justify-center gap-2 text-decoration-none">
                    <span class="material-symbols-outlined">videocam</span>
                    <span id="profileVideoBtn" <?php if (!empty($isAdmin)): ?>onclick="profileInlineEdit(this,'profile_video_btn');event.preventDefault();event.stopPropagation();"<?php endif; ?>><?= t('video_call') ?></span>
                </a>
                <a id="profileGiftLink" href="#" onclick="handleGiftClick(event)" class="bg-card text-white py-4 rounded-2xl font-black text-sm uppercase tracking-wider hover:bg-card/80 transition-all flex items-center justify-center gap-2 border border-white/10 text-decoration-none">
                    <span class="material-symbols-outlined">card_giftcard</span>
                    <span id="profileGiftBtn" <?php if (!empty($isAdmin)): ?>onclick="profileInlineEdit(this,'profile_gift_btn');event.preventDefault();event.stopPropagation();"<?php endif; ?>><?= t('send_gift') ?></span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Gallery -->
<section class="mb-20 editable-section relative">
    <div class="flex items-end justify-between mb-8 border-b border-white/10 pb-4">
        <h3 class="text-4xl font-bold text-white"><?= t('gallery') ?></h3>
        <span id="photoCount" class="text-slate-500 uppercase tracking-widest text-xs font-black"></span>
    </div>
    <div id="gallery" class="grid grid-cols-2 md:grid-cols-4 gap-6"></div>
    <?php if (!empty($isAdmin)): ?>
    <div class="edit-overlay" onclick="openEditor('photos')">
        <button class="edit-btn-float"><span class="material-symbols-outlined">photo_library</span> <?= t('edit_photos') ?></button>
    </div>
    <?php endif; ?>
</section>

<!-- Videos -->
<section id="videosSection" class="mb-20 editable-section relative" style="display:none;">
    <div class="flex items-end justify-between mb-8 border-b border-white/10 pb-4">
        <h3 class="text-4xl font-bold text-white"><?= t('videos') ?></h3>
        <span id="videoCount" class="text-slate-500 uppercase tracking-widest text-xs font-black"></span>
    </div>
    <div id="videoGallery" class="grid grid-cols-1 md:grid-cols-2 gap-8"></div>
    <?php if (!empty($isAdmin)): ?>
    <div class="edit-overlay" onclick="openEditor('videos')">
        <button class="edit-btn-float"><span class="material-symbols-outlined">videocam</span> <?= t('edit_videos') ?></button>
    </div>
    <?php endif; ?>
</section>

<!-- Bio + Preferences -->
<section class="grid grid-cols-1 lg:grid-cols-3 gap-16 py-20 border-t border-white/10">
    <div class="lg:col-span-2 editable-section relative">
        <h4 class="text-4xl font-bold mb-8 text-white"><?= t('in_her_words') ?></h4>
        <div class="space-y-8">
            <p id="bioQuote" class="text-2xl font-light text-primary/90 leading-snug border-r-2 border-primary/30 pr-8 py-2"></p>
            <p id="bioText" class="text-lg font-light leading-loose text-slate-400"></p>
        </div>
        <?php if (!empty($isAdmin)): ?>
        <div class="edit-overlay" onclick="openEditor('bio')">
            <button class="edit-btn-float"><span class="material-symbols-outlined">edit</span> <?= t('edit_bio') ?></button>
        </div>
        <?php endif; ?>
    </div>
    <div class="bg-card/50 p-10 rounded-3xl border border-primary/10 shadow-2xl h-fit editable-section relative">
        <h5 class="text-primary font-black uppercase tracking-[0.3em] text-[11px] mb-10 flex items-center gap-3">
            <span class="material-symbols-outlined text-xl">tune</span> <?= t('match_preferences') ?>
        </h5>
        <ul class="space-y-8">
            <li class="flex items-start gap-4">
                <span class="material-symbols-outlined text-primary text-2xl mt-0.5">check_circle</span>
                <div><p class="font-black text-white uppercase text-[10px] tracking-widest mb-1"><?= t('relationship_goal') ?></p>
                <p id="prefGoal" class="text-slate-300 text-lg font-light"></p></div>
            </li>
            <li class="flex items-start gap-4">
                <span class="material-symbols-outlined text-primary text-2xl mt-0.5">check_circle</span>
                <div><p class="font-black text-white uppercase text-[10px] tracking-widest mb-1"><?= t('marital_status') ?></p>
                <p id="prefMarital" class="text-slate-300 text-lg font-light"></p></div>
            </li>
            <li class="flex items-start gap-4">
                <span class="material-symbols-outlined text-primary text-2xl mt-0.5">check_circle</span>
                <div><p class="font-black text-white uppercase text-[10px] tracking-widest mb-1"><?= t('zodiac') ?></p>
                <p id="prefZodiac" class="text-slate-300 text-lg font-light"></p></div>
            </li>
        </ul>
        <?php if (!empty($isAdmin)): ?>
        <div class="edit-overlay" onclick="openEditor('preferences')">
            <button class="edit-btn-float"><span class="material-symbols-outlined">edit</span> <?= t('edit_preferences') ?></button>
        </div>
        <?php endif; ?>
    </div>
</section>

</div>

<!-- Message Modal -->
<div id="messageModal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/70 backdrop-blur-sm">
<div class="relative w-full max-w-[500px] mx-4 bg-card p-8 rounded-xl border border-white/10 shadow-2xl">
    <button onclick="closeMessageModal()" class="absolute top-4 left-4 text-slate-400 hover:text-white"><span class="material-symbols-outlined">close</span></button>
    <div class="text-center mb-6">
        <span class="material-symbols-outlined text-primary text-4xl mb-2">mail</span>
        <h3 class="text-xl font-bold text-white"><?= t('send_message_to') ?><span id="msgProfileName" class="text-primary"></span></h3>
    </div>
    <div id="msgLoginPrompt" class="hidden text-center py-6">
        <p class="text-slate-400 mb-4"><?= t('login_to_message') ?></p>
        <a id="msgLoginLink" href="#" class="px-8 py-3 rounded-lg font-bold hover:opacity-90 transition-all inline-block" style="background:#f2d00d;color:#12110a;"><?= t('login_now') ?></a>
    </div>
    <form id="msgForm" class="space-y-4">
        <textarea id="msgContent" rows="5" class="w-full bg-background-dark border border-white/10 rounded-lg py-3 px-4 text-white focus:border-primary outline-none resize-none" placeholder="<?= t('write_message_here') ?>" required></textarea>
        <div id="msgError" class="hidden text-center text-sm font-bold text-red-400"></div>
        <div id="msgSuccess" class="hidden text-center text-sm font-bold text-green-400"><?= t('message_sent') ?></div>
        <button type="submit" id="msgSubmitBtn" class="w-full py-3 rounded-lg font-bold hover:brightness-110 transition-all" style="background:linear-gradient(135deg,#f2d00d 0%,#b89b06 100%);color:#12110a;"><?= t('send_message') ?></button>
    </form>
</div>
</div>

<?php if (!empty($isAdmin)): ?>
<!-- Inline Editor Container -->
<div id="editorBackdrop" class="inline-editor-backdrop" style="display:none;" onclick="closeEditor()"></div>
<div id="editorPanel" class="inline-editor" style="display:none;">
    <div class="inline-editor-header">
        <h3 id="editorTitle" class="text-lg font-bold text-primary"></h3>
        <button onclick="closeEditor()" class="text-white/60 hover:text-white"><span class="material-symbols-outlined">close</span></button>
    </div>
    <div id="editorBody" class="inline-editor-body"></div>
</div>
<?php endif; ?>

<script>
const profileId = <?= (int)$profileId ?>;
const isAdmin = <?= !empty($isAdmin) ? 'true' : 'false' ?>;
const maritalMap = { single: T.single, divorced: T.divorced, widowed: T.widowed };

// Current profile data (kept in memory for editing)
let currentProfile = null;

// Lightbox
let lightboxImages = [];
let lightboxIndex = 0;

function openLightbox(index) {
    if (document.body.classList.contains('edit-mode')) return;
    lightboxIndex = index;
    const lb = document.getElementById('lightbox');
    document.getElementById('lightboxImg').src = lightboxImages[index];
    document.getElementById('lightboxCounter').textContent = `${index + 1} / ${lightboxImages.length}`;
    lb.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeLightbox(e) {
    if (e && e.target !== e.currentTarget && !e.target.closest('button')) return;
    document.getElementById('lightbox').classList.remove('active');
    document.body.style.overflow = '';
}

function nextImage(e) {
    if (e) e.stopPropagation();
    lightboxIndex = (lightboxIndex + 1) % lightboxImages.length;
    document.getElementById('lightboxImg').src = lightboxImages[lightboxIndex];
    document.getElementById('lightboxCounter').textContent = `${lightboxIndex + 1} / ${lightboxImages.length}`;
}

function prevImage(e) {
    if (e) e.stopPropagation();
    lightboxIndex = (lightboxIndex - 1 + lightboxImages.length) % lightboxImages.length;
    document.getElementById('lightboxImg').src = lightboxImages[lightboxIndex];
    document.getElementById('lightboxCounter').textContent = `${lightboxIndex + 1} / ${lightboxImages.length}`;
}

document.addEventListener('keydown', (e) => {
    const lb = document.getElementById('lightbox');
    if (!lb.classList.contains('active')) return;
    if (e.key === 'Escape') closeLightbox();
    if (e.key === 'ArrowLeft') nextImage();
    if (e.key === 'ArrowRight') prevImage();
});

async function loadProfile() {
    try {
        const res = await fetch(BASE + '/api/profiles/' + profileId);
        if (!res.ok) {
            document.getElementById('loading').innerHTML = `<p class="text-red-400 text-xl">${T.profile_not_found}</p>`;
            return;
        }
        const p = await res.json();
        currentProfile = p;
        const mainPhoto = (p.photos || []).find(ph => ph.is_primary == 1 || ph.is_primary === true) || (p.photos || [])[0] || {};
        p.primary_photo = mainPhoto.photo_url || '';
        const countryName = p.country === 'moldova' ? T.moldova_country : T.ukraine;

        // Hero
        document.getElementById('mainImage').src = p.primary_photo || '';
        document.getElementById('mainImage').alt = p.name;
        document.getElementById('heroName').textContent = p.name;
        document.getElementById('heroAge').textContent = p.age;
        document.title = `${p.name}, ${p.age} - Moldova & Ukraine`;

        // Location
        document.getElementById('location').innerHTML = `${p.city}, <span class="font-semibold">${countryName}</span>`;

        // Details
        document.getElementById('detAge').textContent = T.age_prefix ? `${T.age_prefix} ${p.age}` : p.age;
        document.getElementById('detOccupation').textContent = p.occupation || '—';
        document.getElementById('detEducation').textContent = p.education || '—';
        document.getElementById('detLanguages').textContent = p.languages || '—';
        document.getElementById('detHobbies').textContent = p.hobbies || '—';

        // Bio
        if (p.looking_for) document.getElementById('bioQuote').textContent = `"${p.looking_for}"`;
        if (p.about) document.getElementById('bioText').textContent = p.about;

        // Preferences
        document.getElementById('prefGoal').textContent = T.serious_marriage;
        document.getElementById('prefMarital').textContent = maritalMap[p.marital_status] || T.single;
        document.getElementById('prefZodiac').textContent = p.zodiac || '';

        // Gallery — show ALL photos (primary already shown as hero, but include in gallery too)
        const gallery = document.getElementById('gallery');
        const photos = p.photos || [];
        const allPhotoUrls = photos.map(ph => ph.photo_url).filter(Boolean);
        // Add primary_photo if not already in photos list
        if (p.primary_photo && !allPhotoUrls.includes(p.primary_photo)) {
            allPhotoUrls.unshift(p.primary_photo);
        }
        lightboxImages = [...allPhotoUrls];

        document.getElementById('photoCount').textContent = `${allPhotoUrls.length} ${T.photos}`;

        gallery.innerHTML = allPhotoUrls.map((url, i) => `
            <div class="aspect-[3/4] rounded-2xl overflow-hidden border border-white/5 luxury-shadow gallery-item" onclick="openLightbox(${i})">
                <img src="${url}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" loading="lazy"/>
                <div class="zoom-icon"><span class="material-symbols-outlined text-white text-2xl">zoom_in</span></div>
            </div>
        `).join('');

        if (allPhotoUrls.length === 0) {
            gallery.innerHTML = `<p class="text-slate-500 col-span-full text-center py-12">${T.no_photos}</p>`;
        }

        // Videos
        const videos = p.videos || [];
        const videosSection = document.getElementById('videosSection');
        const videoGallery = document.getElementById('videoGallery');
        if (videos.length > 0 || isAdmin) {
            videosSection.style.display = '';
            document.getElementById('videoCount').textContent = `${videos.length} ${T.videos}`;
            if (videos.length > 0) {
                videoGallery.innerHTML = videos.map(v => `
                    <div class="relative rounded-2xl overflow-hidden border border-white/5 luxury-shadow bg-black" style="min-height:500px;">
                        <video class="w-full h-full" style="min-height:500px;max-height:700px;object-fit:contain;background:#000;" controls preload="metadata" poster="${v.thumbnail_url || ''}">
                            <source src="${v.video_url}" type="video/mp4">
                        </video>
                        ${v.title ? `<div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-4 pointer-events-none"><p class="text-white text-sm font-bold">${v.title}</p></div>` : ''}
                    </div>
                `).join('');
            } else {
                videoGallery.innerHTML = `<p class="text-slate-500 col-span-full text-center py-12">${T.no_videos}</p>`;
            }
        }

        document.getElementById('loading').style.display = 'none';
    } catch (err) {
        document.getElementById('loading').innerHTML = `<p class="text-red-400 text-xl">${T.error_loading_profile}</p>`;
    }
}

loadProfile();

// Message modal
function openMessageModal() {
    if (document.body.classList.contains('edit-mode')) return;
    const user = JSON.parse(localStorage.getItem('user') || 'null');
    const m = document.getElementById('messageModal');
    m.classList.remove('hidden'); m.classList.add('flex');
    document.getElementById('msgProfileName').textContent = document.getElementById('heroName').textContent;
    document.getElementById('msgError').classList.add('hidden');
    document.getElementById('msgSuccess').classList.add('hidden');
    document.getElementById('msgContent').value = '';
    document.getElementById('msgSubmitBtn').textContent = T.send_message;
    if (!user) {
        document.getElementById('msgLoginPrompt').classList.remove('hidden');
        document.getElementById('msgForm').classList.add('hidden');
        document.getElementById('msgLoginLink').href = BASE + '/?login=1';
    } else {
        document.getElementById('msgLoginPrompt').classList.add('hidden');
        document.getElementById('msgForm').classList.remove('hidden');
    }
}

function closeMessageModal() {
    const m = document.getElementById('messageModal');
    m.classList.add('hidden'); m.classList.remove('flex');
}

document.getElementById('messageModal').addEventListener('click', e => { if (e.target.id === 'messageModal') closeMessageModal(); });

document.getElementById('msgForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const user = JSON.parse(localStorage.getItem('user') || 'null');
    if (!user) return;
    const content = document.getElementById('msgContent').value.trim();
    if (!content) return;
    const errEl = document.getElementById('msgError');
    const successEl = document.getElementById('msgSuccess');
    errEl.classList.add('hidden');
    successEl.classList.add('hidden');
    try {
        const res = await fetch(BASE + '/api/messages', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ sender_name: user.name, sender_email: user.email, user_id: user.id, profile_id: profileId, message: content })
        });
        const data = await res.json();
        if (res.ok) {
            successEl.classList.remove('hidden');
            document.getElementById('msgContent').value = '';
            document.getElementById('msgSubmitBtn').textContent = T.sent;
            setTimeout(() => closeMessageModal(), 2000);
        } else {
            errEl.textContent = data.error || T.error;
            errEl.classList.remove('hidden');
        }
    } catch {
        errEl.textContent = T.server_error;
        errEl.classList.remove('hidden');
    }
});

// Load editable button texts + links from settings (for all visitors)
let profileBtnLinks = { msg: '', video: '', gift: '' };
(async function loadProfileBtnSettings() {
    try {
        const res = await fetch(BASE + '/api/admin/settings');
        const s = await res.json();
        if (s.profile_msg_btn) document.getElementById('profileMsgBtn').textContent = s.profile_msg_btn;
        if (s.profile_video_btn) document.getElementById('profileVideoBtn').textContent = s.profile_video_btn;
        if (s.profile_gift_btn) document.getElementById('profileGiftBtn').textContent = s.profile_gift_btn;
        if (s.profile_msg_link) { profileBtnLinks.msg = s.profile_msg_link; setExternalLink('profileMsgLink', s.profile_msg_link); }
        if (s.profile_video_link) { profileBtnLinks.video = s.profile_video_link; setExternalLink('profileVideoLink', s.profile_video_link); }
        if (s.profile_gift_link) { profileBtnLinks.gift = s.profile_gift_link; setExternalLink('profileGiftLink', s.profile_gift_link); }
    } catch {}
})();

function setExternalLink(elId, url) {
    const el = document.getElementById(elId);
    if (!el) return;
    el.href = url;
    if (url && url !== '#' && (url.startsWith('http') || url.startsWith('tel:') || url.startsWith('mailto:'))) {
        el.target = '_blank';
        el.rel = 'noopener noreferrer';
    }
}

function isValidLink(el) {
    const href = el.getAttribute('href');
    return href && href !== '#' && href !== '' && !href.endsWith('/profile/' + profileId + '#');
}

function handleMsgClick(e) {
    if (document.body.classList.contains('edit-mode')) { e.preventDefault(); return; }
    const el = document.getElementById('profileMsgLink');
    if (isValidLink(el)) {
        e.preventDefault();
        window.open(el.getAttribute('href'), '_blank');
    } else {
        e.preventDefault();
        openMessageModal();
    }
}
function handleVideoClick(e) {
    if (document.body.classList.contains('edit-mode')) { e.preventDefault(); return; }
    const el = document.getElementById('profileVideoLink');
    if (isValidLink(el)) {
        e.preventDefault();
        window.open(el.getAttribute('href'), '_blank');
    } else {
        e.preventDefault();
    }
}
function handleGiftClick(e) {
    if (document.body.classList.contains('edit-mode')) { e.preventDefault(); return; }
    const el = document.getElementById('profileGiftLink');
    if (isValidLink(el)) {
        e.preventDefault();
        window.open(el.getAttribute('href'), '_blank');
    } else {
        e.preventDefault();
    }
}

<?php if (!empty($isAdmin)): ?>
// ============================
// INLINE EDITING SYSTEM
// ============================

function toggleEditMode() {
    document.body.classList.toggle('edit-mode');
    const active = document.body.classList.contains('edit-mode');
    document.getElementById('toggleEditLabel').textContent = active ? T.disable_editing : T.enable_editing;
    const btn = document.getElementById('toggleEditBtn');
    if (active) {
        btn.classList.add('bg-primary', 'text-bg');
        btn.classList.remove('bg-primary/10', 'text-primary');
    } else {
        btn.classList.remove('bg-primary', 'text-bg');
        btn.classList.add('bg-primary/10', 'text-primary');
    }
}

function showToast(msg, type = 'success') {
    const t = document.getElementById('toast');
    t.textContent = msg;
    t.className = 'toast ' + type + ' show';
    setTimeout(() => t.classList.remove('show'), 3000);
}

// Inline editing for profile page buttons
async function profileSaveSetting(key, value) {
    try {
        const res = await fetch(BASE + '/api/admin/settings', { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ [key]: value }) });
        return res.ok;
    } catch { return false; }
}

function profileInlineEdit(el, key) {
    if (!document.body.classList.contains('edit-mode')) return;
    const current = el.textContent.trim();
    // Find the parent link element to get current URL
    const linkEl = el.closest('a[id$="Link"]');
    const linkKey = key.replace('_btn', '_link');
    const currentLink = linkEl ? (linkEl.getAttribute('href') || '') : '';
    const linkDisplay = (currentLink === '#' || !currentLink) ? '' : currentLink;

    const popup = document.createElement('div');
    popup.style.cssText = 'position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);z-index:600;background:#1c1a0e;border:1px solid rgba(242,208,13,0.3);border-radius:12px;padding:20px;min-width:380px;font-family:Heebo,sans-serif;direction:rtl;box-shadow:0 20px 60px rgba(0,0,0,0.5);';
    popup.innerHTML = `
        <div style="font-size:15px;font-weight:700;color:#f2d00d;margin-bottom:14px;display:flex;align-items:center;gap:6px;">
            <span class="material-symbols-outlined" style="font-size:18px;">edit</span> ${T.edit_button || 'Edit Button'}
        </div>
        <div style="margin-bottom:12px;">
            <label style="font-size:12px;color:rgba(255,255,255,0.5);margin-bottom:4px;display:block;">${T.button_text || 'Button Text'}</label>
            <input id="pie_text" type="text" value="${current.replace(/"/g, '&quot;')}" style="width:100%;background:#0f0e08;border:1px solid rgba(255,255,255,0.15);border-radius:8px;padding:10px 14px;color:white;font-size:14px;outline:none;"/>
        </div>
        <div style="margin-bottom:14px;">
            <label style="font-size:12px;color:rgba(255,255,255,0.5);margin-bottom:4px;display:block;">${T.button_link || 'Link (WhatsApp / External URL / Empty = In-app message)'}</label>
            <input id="pie_link" type="text" value="${linkDisplay.replace(/"/g, '&quot;')}" placeholder="https://wa.me/972501234567" dir="ltr" style="width:100%;background:#0f0e08;border:1px solid rgba(255,255,255,0.15);border-radius:8px;padding:10px 14px;color:white;font-size:14px;outline:none;"/>
            <div style="margin-top:6px;display:flex;gap:6px;flex-wrap:wrap;">
                <button type="button" class="wa-preset" style="background:rgba(37,211,102,0.15);color:#25d366;border:1px solid rgba(37,211,102,0.3);border-radius:6px;padding:4px 10px;font-size:11px;font-weight:700;cursor:pointer;">WhatsApp</button>
                <button type="button" class="tg-preset" style="background:rgba(0,136,204,0.15);color:#0088cc;border:1px solid rgba(0,136,204,0.3);border-radius:6px;padding:4px 10px;font-size:11px;font-weight:700;cursor:pointer;">Telegram</button>
                <button type="button" class="tel-preset" style="background:rgba(242,208,13,0.1);color:#f2d00d;border:1px solid rgba(242,208,13,0.2);border-radius:6px;padding:4px 10px;font-size:11px;font-weight:700;cursor:pointer;">${T.phone || 'Phone'}</button>
                <button type="button" class="clear-preset" style="background:rgba(255,255,255,0.05);color:rgba(255,255,255,0.4);border:1px solid rgba(255,255,255,0.1);border-radius:6px;padding:4px 10px;font-size:11px;cursor:pointer;">${T.clear_in_app || 'Clear (in-app message)'}</button>
            </div>
        </div>
        <div style="display:flex;gap:8px;justify-content:flex-start;">
            <button class="save-btn" style="background:#f2d00d;color:#0f0e08;border:none;border-radius:8px;padding:10px 24px;font-size:14px;font-weight:700;cursor:pointer;">${T.save}</button>
            <button class="cancel-btn" style="background:transparent;color:rgba(255,255,255,0.6);border:1px solid rgba(255,255,255,0.15);border-radius:8px;padding:10px 20px;font-size:13px;cursor:pointer;">${T.cancel}</button>
        </div>`;
    const backdrop = document.createElement('div');
    backdrop.style.cssText = 'position:fixed;inset:0;z-index:599;background:rgba(0,0,0,0.5);';
    document.body.appendChild(backdrop);
    document.body.appendChild(popup);

    const textInput = popup.querySelector('#pie_text');
    const linkInput = popup.querySelector('#pie_link');
    textInput.focus(); textInput.select();

    // Presets
    popup.querySelector('.wa-preset').onclick = () => { linkInput.value = 'https://wa.me/972'; linkInput.focus(); };
    popup.querySelector('.tg-preset').onclick = () => { linkInput.value = 'https://t.me/'; linkInput.focus(); };
    popup.querySelector('.tel-preset').onclick = () => { linkInput.value = 'tel:+972'; linkInput.focus(); };
    popup.querySelector('.clear-preset').onclick = () => { linkInput.value = ''; };

    const close = () => { popup.remove(); backdrop.remove(); };
    backdrop.onclick = close;
    popup.querySelector('.cancel-btn').onclick = close;
    popup.querySelector('.save-btn').onclick = async () => {
        const newText = textInput.value;
        const newLink = linkInput.value.trim();
        const ok1 = await profileSaveSetting(key, newText);
        const ok2 = await profileSaveSetting(linkKey, newLink);
        if (ok1) el.textContent = newText;
        if (ok2 && linkEl) linkEl.href = newLink || '#';
        showToast(T.saved || 'Saved!');
        close();
    };
    textInput.addEventListener('keydown', e => { if (e.key === 'Escape') close(); });
    linkInput.addEventListener('keydown', e => { if (e.key === 'Enter') popup.querySelector('.save-btn').click(); if (e.key === 'Escape') close(); });
}

function closeEditor() {
    document.getElementById('editorBackdrop').style.display = 'none';
    document.getElementById('editorPanel').style.display = 'none';
}

function openEditor(section) {
    if (!currentProfile) return;
    const p = currentProfile;
    document.getElementById('editorBackdrop').style.display = 'block';
    document.getElementById('editorPanel').style.display = 'block';
    const title = document.getElementById('editorTitle');
    const body = document.getElementById('editorBody');

    switch(section) {
        case 'basic':
            title.textContent = T.basic_details;
            body.innerHTML = `
                <div class="grid grid-cols-2 gap-4">
                    <div class="ie-field"><label>${T.name}</label><input id="ie_name" value="${esc(p.name)}"/></div>
                    <div class="ie-field"><label>${T.age}</label><input id="ie_age" type="number" value="${p.age || ''}"/></div>
                    <div class="ie-field"><label>${T.city}</label><input id="ie_city" value="${esc(p.city)}"/></div>
                    <div class="ie-field"><label>${T.country}</label>
                        <select id="ie_country">
                            <option value="moldova" ${p.country==='moldova'?'selected':''}>${T.moldova_country}</option>
                            <option value="ukraine" ${p.country==='ukraine'?'selected':''}>${T.ukraine}</option>
                        </select>
                    </div>
                    <div class="ie-field"><label>${T.marital_status}</label>
                        <select id="ie_marital">
                            <option value="single" ${p.marital_status==='single'?'selected':''}>${T.single}</option>
                            <option value="divorced" ${p.marital_status==='divorced'?'selected':''}>${T.divorced}</option>
                            <option value="widowed" ${p.marital_status==='widowed'?'selected':''}>${T.widowed}</option>
                        </select>
                    </div>
                    <div class="ie-field"><label>${T.children}</label><input id="ie_children" value="${esc(p.children)}"/></div>
                </div>
                <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-white/10">
                    <button class="ie-cancel-btn" onclick="closeEditor()">${T.cancel}</button>
                    <button class="ie-save-btn" onclick="saveBasic()">${T.save_changes}</button>
                </div>`;
            break;

        case 'details':
            title.textContent = T.more_details;
            body.innerHTML = `
                <div class="grid grid-cols-2 gap-4">
                    <div class="ie-field"><label>${T.occupation}</label><input id="ie_occupation" value="${esc(p.occupation)}"/></div>
                    <div class="ie-field"><label>${T.education}</label><input id="ie_education" value="${esc(p.education)}"/></div>
                    <div class="ie-field"><label>${T.languages}</label><input id="ie_languages" value="${esc(p.languages)}"/></div>
                    <div class="ie-field"><label>${T.hobbies}</label><input id="ie_hobbies" value="${esc(p.hobbies)}"/></div>
                    <div class="ie-field"><label>${T.height}</label><input id="ie_height" value="${esc(p.height)}"/></div>
                    <div class="ie-field"><label>${T.weight}</label><input id="ie_weight" value="${esc(p.weight)}"/></div>
                </div>
                <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-white/10">
                    <button class="ie-cancel-btn" onclick="closeEditor()">${T.cancel}</button>
                    <button class="ie-save-btn" onclick="saveDetails()">${T.save_changes}</button>
                </div>`;
            break;

        case 'bio':
            title.textContent = T.edit_bio;
            body.innerHTML = `
                <div class="ie-field"><label>${T.looking_for}</label><input id="ie_looking_for" value="${esc(p.looking_for)}"/></div>
                <div class="ie-field"><label>${T.biography}</label><textarea id="ie_about" rows="6">${esc(p.about)}</textarea></div>
                <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-white/10">
                    <button class="ie-cancel-btn" onclick="closeEditor()">${T.cancel}</button>
                    <button class="ie-save-btn" onclick="saveBio()">${T.save_changes}</button>
                </div>`;
            break;

        case 'preferences':
            title.textContent = T.edit_preferences;
            body.innerHTML = `
                <div class="ie-field"><label>${T.looking_for}</label><input id="ie_pref_looking" value="${esc(p.looking_for)}"/></div>
                <div class="ie-field"><label>${T.marital_status}</label>
                    <select id="ie_pref_marital">
                        <option value="single" ${p.marital_status==='single'?'selected':''}>${T.single}</option>
                        <option value="divorced" ${p.marital_status==='divorced'?'selected':''}>${T.divorced}</option>
                        <option value="widowed" ${p.marital_status==='widowed'?'selected':''}>${T.widowed}</option>
                    </select>
                </div>
                <div class="ie-field"><label>${T.zodiac}</label><input id="ie_pref_zodiac" value="${esc(p.zodiac)}" placeholder="${T.zodiac_placeholder}"/></div>
                <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-white/10">
                    <button class="ie-cancel-btn" onclick="closeEditor()">${T.cancel}</button>
                    <button class="ie-save-btn" onclick="savePreferences()">${T.save_changes}</button>
                </div>`;
            break;

        case 'photos':
            title.textContent = T.edit_photos;
            const photos = p.photos || [];
            body.innerHTML = `
                <div class="ie-field"><label>${T.photos} (${photos.length})</label></div>
                <div class="ie-photo-grid" id="ie_photos_grid">
                    ${photos.map(ph => `
                        <div class="ie-photo-item ${ph.is_primary == 1 ? 'primary' : ''}" data-id="${ph.id}">
                            <img src="${ph.photo_url}"/>
                            <div style="position:absolute;bottom:0;left:0;right:0;display:flex;gap:2px;">
                                ${ph.is_primary != 1 ? `<button onclick="ieSetPrimary(${ph.id})" style="flex:1;background:rgba(242,208,13,0.8);color:#0f0e08;border:none;font-size:9px;padding:3px;cursor:pointer;font-weight:700;" title="${T.primary_photo}">★</button>` : ''}
                            </div>
                            <button class="ie-photo-del" onclick="ieDeletePhoto(${ph.id})">&times;</button>
                        </div>
                    `).join('')}
                </div>
                <div class="ie-field mt-4">
                    <label>${T.choose_photos}</label>
                    <div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
                        <input id="ie_photo_upload" type="file" accept="image/*,.jfif,.jpg,.jpeg,.png,.webp,.gif" multiple onchange="ieUploadPhotos(this)" style="display:none;"/>
                        <button onclick="document.getElementById('ie_photo_upload').click()" style="background:rgba(242,208,13,0.9);color:#0f0e08;border:none;border-radius:10px;padding:10px 24px;font-size:14px;font-weight:800;cursor:pointer;display:flex;align-items:center;gap:6px;transition:all 0.2s;">
                            <span class="material-symbols-outlined" style="font-size:20px;">add_photo_alternate</span>
                            ${T.choose_photos}
                        </button>
                        <span id="ie_upload_progress" class="text-sm text-primary hidden">${T.uploading}</span>
                    </div>
                </div>
                <div id="ie_upload_error" class="text-sm text-red-400 mt-2 hidden"></div>
                <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-white/10">
                    <button class="ie-cancel-btn" onclick="closeEditor()">${T.cancel}</button>
                </div>`;
            break;

        case 'videos':
            title.textContent = T.edit_videos;
            const videos = p.videos || [];
            body.innerHTML = `
                <div class="ie-field"><label>${T.videos} (${videos.length})</label></div>
                <div id="ie_videos_grid" style="display:grid;gap:12px;">
                    ${videos.map(v => `
                        <div class="ie-video-item" data-id="${v.id}" style="position:relative;background:#0f0e08;border:1px solid rgba(255,255,255,0.1);border-radius:12px;overflow:hidden;padding:12px;display:flex;gap:12px;align-items:center;">
                            <video style="width:120px;height:80px;object-fit:cover;border-radius:8px;background:#000;" preload="metadata">
                                <source src="${v.video_url}" type="video/mp4">
                            </video>
                            <div style="flex:1;min-width:0;">
                                <p style="color:white;font-size:13px;font-weight:700;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">${v.title || (T.no_title || 'Untitled')}</p>
                                <p style="color:rgba(255,255,255,0.4);font-size:11px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">${v.video_url.split('/').pop()}</p>
                            </div>
                            <button onclick="ieDeleteVideo(${v.id})" style="background:rgba(220,38,38,0.8);color:white;border:none;border-radius:8px;width:32px;height:32px;display:flex;align-items:center;justify-content:center;cursor:pointer;flex-shrink:0;" title="${T.delete_error ? T.delete_error.split(' ')[0] : 'Delete'}">
                                <span class="material-symbols-outlined" style="font-size:18px;">delete</span>
                            </button>
                        </div>
                    `).join('')}
                </div>
                <div class="ie-field mt-4">
                    <label>${T.choose_videos}</label>
                    <div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
                        <input id="ie_video_upload" type="file" accept="video/mp4,video/webm,video/ogg,video/quicktime,.mp4,.webm,.mov,.avi" onchange="ieUploadVideo(this)" style="display:none;"/>
                        <button onclick="document.getElementById('ie_video_upload').click()" style="background:rgba(242,208,13,0.9);color:#0f0e08;border:none;border-radius:10px;padding:10px 24px;font-size:14px;font-weight:800;cursor:pointer;display:flex;align-items:center;gap:6px;transition:all 0.2s;">
                            <span class="material-symbols-outlined" style="font-size:20px;">video_call</span>
                            ${T.choose_videos}
                        </button>
                        <span id="ie_video_progress" class="text-sm text-primary hidden">${T.uploading}</span>
                    </div>
                </div>
                <div class="ie-field mt-2">
                    <label>${T.add_video_url || 'Or add video link (YouTube / URL)'}</label>
                    <div style="display:flex;gap:8px;">
                        <input id="ie_video_url" type="text" placeholder="https://..." style="flex:1;background:#0f0e08;border:1px solid rgba(255,255,255,0.1);border-radius:8px;padding:10px 14px;color:white;font-size:14px;outline:none;" dir="ltr"/>
                        <button onclick="ieAddVideoUrl()" style="background:rgba(242,208,13,0.9);color:#0f0e08;border:none;border-radius:10px;padding:10px 16px;font-size:13px;font-weight:800;cursor:pointer;">${T.upload || 'Add'}</button>
                    </div>
                </div>
                <div id="ie_video_error" class="text-sm text-red-400 mt-2 hidden"></div>
                <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-white/10">
                    <button class="ie-cancel-btn" onclick="closeEditor()">${T.cancel}</button>
                </div>`;
            break;
    }
}

function esc(v) { return (v || '').replace(/"/g, '&quot;').replace(/</g, '&lt;'); }

async function saveToApi(data) {
    const res = await fetch(BASE + '/api/admin/profiles/' + profileId, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    });
    if (!res.ok) throw new Error('Save failed');
    return res.json();
}

async function saveBasic() {
    try {
        await saveToApi({
            name: document.getElementById('ie_name').value,
            age: parseInt(document.getElementById('ie_age').value),
            city: document.getElementById('ie_city').value,
            country: document.getElementById('ie_country').value,
            marital_status: document.getElementById('ie_marital').value,
            children: document.getElementById('ie_children').value,
        });
        showToast(T.details_saved);
        closeEditor();
        loadProfile();
    } catch { showToast(T.save_error, 'error'); }
}

async function saveDetails() {
    try {
        await saveToApi({
            occupation: document.getElementById('ie_occupation').value,
            education: document.getElementById('ie_education').value,
            languages: document.getElementById('ie_languages').value,
            hobbies: document.getElementById('ie_hobbies').value,
            height: document.getElementById('ie_height').value,
            weight: document.getElementById('ie_weight').value,
        });
        showToast(T.details_saved);
        closeEditor();
        loadProfile();
    } catch { showToast(T.save_error, 'error'); }
}

async function saveBio() {
    try {
        await saveToApi({
            looking_for: document.getElementById('ie_looking_for').value,
            about: document.getElementById('ie_about').value,
        });
        showToast(T.bio_saved);
        closeEditor();
        loadProfile();
    } catch { showToast(T.save_error, 'error'); }
}

async function savePreferences() {
    try {
        await saveToApi({
            looking_for: document.getElementById('ie_pref_looking').value,
            marital_status: document.getElementById('ie_pref_marital').value,
            zodiac: document.getElementById('ie_pref_zodiac').value,
        });
        showToast(T.preferences_saved);
        closeEditor();
        loadProfile();
    } catch { showToast(T.save_error, 'error'); }
}

async function ieDeletePhoto(photoId) {
    if (!confirm(T.delete_photo_confirm)) return;
    try {
        await fetch(BASE + '/api/admin/photos/' + photoId, { method: 'DELETE' });
        document.querySelector(`.ie-photo-item[data-id="${photoId}"]`)?.remove();
        showToast(T.photo_deleted);
        // Refresh profile data
        const res = await fetch(BASE + '/api/profiles/' + profileId);
        currentProfile = await res.json();
        loadProfile();
    } catch { showToast(T.delete_error_general, 'error'); }
}

async function ieUploadPhotos(input) {
    const prog = document.getElementById('ie_upload_progress');
    const errEl = document.getElementById('ie_upload_error');
    prog.classList.remove('hidden');
    errEl.classList.add('hidden');
    const files = input.files;
    if (!files || files.length === 0) {
        prog.classList.add('hidden');
        return;
    }
    const grid = document.getElementById('ie_photos_grid');
    let successCount = 0;
    let errorMessages = [];

    for (let i = 0; i < files.length; i++) {
        prog.textContent = (T.uploading_x_of_y || 'Uploading %d of %d...').replace('%d', i + 1).replace('%d', files.length);
        const formData = new FormData();
        formData.append('file', files[i]);
        try {
            const upRes = await fetch(BASE + '/api/upload', { method: 'POST', body: formData });
            const upData = await upRes.json();
            console.log('Upload response:', upRes.status, upData);
            if (!upRes.ok) {
                const errMsg = `${files[i].name}: ${upData.error || T.upload_error_status} (status: ${upRes.status})`;
                alert(T.upload_error_status + ': ' + JSON.stringify(upData));
                errorMessages.push(errMsg);
                continue;
            }
            const url = upData.url || upData.path;
            if (url) {
                const photoRes = await fetch(BASE + '/api/admin/photos', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ profile_id: parseInt(profileId), photo_url: url, is_primary: false })
                });
                const photoData = await photoRes.json();
                console.log('Photo save response:', photoRes.status, photoData);
                if (!photoRes.ok) {
                    alert(T.save_error + ': ' + JSON.stringify(photoData));
                    errorMessages.push(`${files[i].name}: ${photoData.error || T.save_error}`);
                    continue;
                }
                const ph = photoData.photo;
                if (ph) {
                    grid.innerHTML += `
                        <div class="ie-photo-item" data-id="${ph.id}">
                            <img src="${ph.photo_url}"/>
                            <div style="position:absolute;bottom:0;left:0;right:0;display:flex;gap:2px;">
                                <button onclick="ieSetPrimary(${ph.id})" style="flex:1;background:rgba(242,208,13,0.8);color:#0f0e08;border:none;font-size:9px;padding:3px;cursor:pointer;font-weight:700;" title="${T.primary_photo}">★</button>
                            </div>
                            <button class="ie-photo-del" onclick="ieDeletePhoto(${ph.id})">&times;</button>
                        </div>`;
                    successCount++;
                }
            }
        } catch(e) {
            console.error('Upload error:', e);
            errorMessages.push(`${files[i].name}: ${T.network_error}`);
        }
    }

    if (successCount > 0) {
        prog.textContent = `${successCount} ${T.photos_uploaded}!`;
        showToast(`${successCount} ${T.photos_uploaded}`);
    } else {
        prog.textContent = T.no_photos_uploaded;
    }
    if (errorMessages.length > 0) {
        errEl.textContent = errorMessages.join(' | ');
        errEl.classList.remove('hidden');
    }
    setTimeout(() => prog.classList.add('hidden'), 3000);
    input.value = '';

    // Refresh profile data and re-render editor
    const res = await fetch(BASE + '/api/profiles/' + profileId);
    currentProfile = await res.json();
    loadProfile();
    // Re-open photos editor to show updated photos
    openEditor('photos');
}

async function ieSetPrimary(photoId) {
    try {
        await fetch(BASE + '/api/admin/photos/' + photoId, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ is_primary: true })
        });
        showToast(T.primary_updated);
        const res = await fetch(BASE + '/api/profiles/' + profileId);
        currentProfile = await res.json();
        openEditor('photos');
        loadProfile();
    } catch { showToast(T.update_error, 'error'); }
}

// ============================
// VIDEO MANAGEMENT
// ============================

async function ieUploadVideo(input) {
    const prog = document.getElementById('ie_video_progress');
    const errEl = document.getElementById('ie_video_error');
    prog.classList.remove('hidden');
    errEl.classList.add('hidden');
    const file = input.files[0];
    if (!file) { prog.classList.add('hidden'); return; }

    if (file.size > 100 * 1024 * 1024) {
        errEl.textContent = T.video_size_error;
        errEl.classList.remove('hidden');
        prog.classList.add('hidden');
        return;
    }

    prog.textContent = T.uploading_video;
    try {
        const fd = new FormData();
        fd.append('file', file);
        const upRes = await fetch(BASE + '/api/upload', { method: 'POST', body: fd });
        const upData = await upRes.json();
        if (!upRes.ok) {
            errEl.textContent = upData.error || T.upload_error_status;
            errEl.classList.remove('hidden');
            prog.classList.add('hidden');
            return;
        }
        const url = upData.url || upData.path;
        if (url) {
            const videoRes = await fetch(BASE + '/api/admin/videos', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ profile_id: profileId, video_url: url, title: file.name.replace(/\.[^.]+$/, '') })
            });
            if (!videoRes.ok) {
                const d = await videoRes.json();
                errEl.textContent = d.error || T.save_error;
                errEl.classList.remove('hidden');
                prog.classList.add('hidden');
                return;
            }
            showToast(T.video_uploaded);
            prog.textContent = T.video_upload_done;
            const res = await fetch(BASE + '/api/profiles/' + profileId);
            currentProfile = await res.json();
            loadProfile();
            openEditor('videos');
        }
    } catch(e) {
        errEl.textContent = T.network_error + ': ' + e.message;
        errEl.classList.remove('hidden');
    }
    setTimeout(() => prog.classList.add('hidden'), 3000);
    input.value = '';
}

async function ieAddVideoUrl() {
    const urlInput = document.getElementById('ie_video_url');
    const errEl = document.getElementById('ie_video_error');
    const url = urlInput.value.trim();
    if (!url) return;
    errEl.classList.add('hidden');

    try {
        const videoRes = await fetch(BASE + '/api/admin/videos', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ profile_id: profileId, video_url: url, title: '' })
        });
        if (!videoRes.ok) {
            const d = await videoRes.json();
            errEl.textContent = d.error || T.error;
            errEl.classList.remove('hidden');
            return;
        }
        showToast(T.video_added);
        urlInput.value = '';
        const res = await fetch(BASE + '/api/profiles/' + profileId);
        currentProfile = await res.json();
        loadProfile();
        openEditor('videos');
    } catch(e) {
        errEl.textContent = T.error + ': ' + e.message;
        errEl.classList.remove('hidden');
    }
}

async function ieDeleteVideo(videoId) {
    if (!confirm(T.delete_video_confirm)) return;
    try {
        await fetch(BASE + '/api/admin/videos/' + videoId, { method: 'DELETE' });
        showToast(T.video_deleted);
        const res = await fetch(BASE + '/api/profiles/' + profileId);
        currentProfile = await res.json();
        loadProfile();
        openEditor('videos');
    } catch { showToast(T.delete_error_general, 'error'); }
}
<?php endif; ?>
</script>

<?php
// Profile page has its own inline editing — skip the global one
$skipGlobalInlineEdit = true;
require BASE_PATH . '/app/views/layouts/footer.php';
?>
