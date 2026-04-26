<?php
/**
 * Shared admin inline editing component.
 * Included automatically from footer.php when admin is logged in.
 * Requires: $isAdmin variable set by the controller.
 *
 * Features:
 * 1. Admin bar with edit mode toggle
 * 2. Inline text/image editing via click (saves to site_settings)
 * 3. Block builder: add/delete/reorder sections via drag & drop
 * 4. Section visibility toggle (hide/show static sections)
 * 5. Navigator sidebar with page overview + drag reorder
 */
if (empty($isAdmin)) return;
if (!empty($skipGlobalInlineEdit)) return;
?>

<!-- SortableJS CDN -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.6/Sortable.min.js"></script>

<!-- Admin Inline Editing + Block Builder + Navigator Styles -->
<style>
/* ========== Admin Bar ========== */
.aie-bar {
    position: fixed; top: 0; left: 0; right: 0; z-index: 9999;
    background: rgba(18,17,10,0.97); border-bottom: 2px solid #f2d00d;
    display: flex; align-items: center; justify-content: space-between;
    padding: 0 20px; height: 48px; backdrop-filter: blur(12px);
    font-family: 'Heebo', sans-serif; direction: rtl;
}
.aie-bar .aie-label { color: #f2d00d; font-weight: 800; font-size: 14px; display: flex; align-items: center; gap: 8px; }
.aie-bar .aie-actions { display: flex; align-items: center; gap: 10px; }
.aie-bar .aie-btn {
    padding: 6px 16px; border-radius: 8px; font-size: 13px; font-weight: 700;
    cursor: pointer; transition: all 0.2s; border: none; display: flex; align-items: center; gap: 6px;
    text-decoration: none;
}
.aie-btn-edit { background: #f2d00d; color: #12110a; }
.aie-btn-edit:hover { background: #e0c00c; }
.aie-btn-edit.active { background: #ef4444; color: white; }
.aie-btn-link { background: rgba(255,255,255,0.08); color: #bab59c; }
.aie-btn-link:hover { background: rgba(255,255,255,0.15); color: white; }

body.aie-active { padding-top: 48px !important; }
body.aie-active header.sticky { top: 48px !important; }

/* ========== Edit Mode Highlights ========== */
body.aie-editing [data-aie] {
    outline: 2px dashed rgba(242,208,13,0.4) !important;
    outline-offset: 4px; cursor: pointer !important;
    transition: outline-color 0.2s, background 0.2s;
}
body.aie-editing [data-aie]:hover {
    outline-color: #f2d00d !important;
    background: rgba(242,208,13,0.06) !important;
}
body.aie-editing [data-aie-img] {
    outline: 2px dashed rgba(59,130,246,0.5) !important;
    outline-offset: 4px; cursor: pointer !important; transition: outline-color 0.2s;
}
body.aie-editing [data-aie-img]:hover { outline-color: #3b82f6 !important; }

body.aie-editing [data-aie]:hover::after,
body.aie-editing [data-aie-img]:hover::after {
    content: attr(data-aie-label);
    position: absolute; top: -22px; right: 4px; z-index: 100;
    font-size: 10px; font-weight: 700; padding: 2px 8px; border-radius: 4px;
    font-family: 'Heebo', sans-serif; white-space: nowrap; pointer-events: none;
}
body.aie-editing [data-aie]:hover::after { background: #f2d00d; color: #12110a; }
body.aie-editing [data-aie-img]:hover::after { content: 'החלף תמונה'; background: #3b82f6; color: white; }

/* ========== Popup ========== */
.aie-popup {
    position: fixed; z-index: 10001;
    background: #1c1a0e; border: 1px solid rgba(242,208,13,0.3);
    border-radius: 12px; padding: 16px; min-width: 320px; max-width: 500px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.5);
    font-family: 'Heebo', sans-serif; direction: rtl;
}
.aie-popup-title { color: #f2d00d; font-weight: 700; font-size: 13px; margin-bottom: 8px; display: flex; align-items: center; gap: 6px; }
.aie-popup input[type="text"], .aie-popup textarea, .aie-popup select, .aie-popup input[type="number"], .aie-popup input[type="url"] {
    width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.15);
    border-radius: 8px; color: white; padding: 10px 12px; font-size: 14px;
    font-family: 'Heebo', sans-serif; outline: none; resize: vertical; box-sizing: border-box;
}
.aie-popup input:focus, .aie-popup textarea:focus, .aie-popup select:focus { border-color: #f2d00d; }
.aie-popup-actions { display: flex; gap: 8px; margin-top: 10px; justify-content: flex-start; }
.aie-popup-actions button {
    padding: 6px 18px; border-radius: 8px; font-size: 13px; font-weight: 700;
    cursor: pointer; border: none; transition: all 0.2s;
}
.aie-popup-actions .aie-save { background: #f2d00d; color: #12110a; }
.aie-popup-actions .aie-save:hover { background: #e0c00c; }
.aie-popup-actions .aie-cancel { background: rgba(255,255,255,0.1); color: #bab59c; }
.aie-popup-actions .aie-cancel:hover { background: rgba(255,255,255,0.2); }

/* ========== Color & Link Fields ========== */
.aie-popup .aie-field-row { display: flex; align-items: center; gap: 8px; margin-top: 8px; }
.aie-popup .aie-field-row label { color: #bab59c; font-size: 12px; font-weight: 700; white-space: nowrap; min-width: 60px; }
.aie-popup input[type="color"] { width: 40px; height: 36px; border: 1px solid rgba(255,255,255,0.15); border-radius: 8px; background: transparent; cursor: pointer; padding: 2px; }
.aie-popup input[type="color"]::-webkit-color-swatch-wrapper { padding: 2px; }
.aie-popup input[type="color"]::-webkit-color-swatch { border: none; border-radius: 4px; }
.aie-popup .aie-color-hex { width: 90px !important; font-size: 12px !important; text-align: center; }
.aie-popup .aie-section-label { color: #f2d00d; font-size: 11px; font-weight: 700; margin-top: 10px; margin-bottom: 2px; opacity: 0.7; text-transform: uppercase; letter-spacing: 0.05em; }

/* ========== Toast ========== */
.aie-toast {
    position: fixed; bottom: 24px; right: 24px; z-index: 10002;
    padding: 12px 24px; border-radius: 10px; font-size: 14px; font-weight: 700;
    font-family: 'Heebo', sans-serif; direction: rtl; color: white;
    box-shadow: 0 8px 30px rgba(0,0,0,0.4); transition: all 0.3s;
    opacity: 0; transform: translateY(20px);
}
.aie-toast.show { opacity: 1; transform: translateY(0); }
.aie-toast.success { background: #16a34a; }
.aie-toast.error { background: #dc2626; }

/* ========== Section Toolbar (on-page) ========== */
.aie-section-toolbar {
    position: absolute; top: 8px; left: 8px; z-index: 200;
    display: none; gap: 4px; background: rgba(18,17,10,0.95);
    border: 1px solid rgba(242,208,13,0.3); border-radius: 10px;
    padding: 4px; backdrop-filter: blur(8px);
    font-family: 'Heebo', sans-serif;
}
body.aie-editing .aie-section-toolbar { display: flex; }
.aie-section-toolbar button {
    width: 32px; height: 32px; border: none; border-radius: 6px;
    cursor: pointer; display: flex; align-items: center; justify-content: center;
    transition: all 0.2s; background: transparent; color: #bab59c;
}
.aie-section-toolbar button:hover { background: rgba(255,255,255,0.1); color: white; }
.aie-section-toolbar button.aie-tb-danger:hover { background: rgba(239,68,68,0.2); color: #ef4444; }
.aie-section-toolbar button.aie-tb-active { background: rgba(242,208,13,0.2); color: #f2d00d; }

/* Section highlights */
body.aie-editing main > section,
body.aie-editing main > .aie-dynamic-block { position: relative; transition: outline 0.2s; }
body.aie-editing main > section:hover,
body.aie-editing main > .aie-dynamic-block:hover {
    outline: 2px solid rgba(242,208,13,0.15); outline-offset: -2px;
}
body.aie-editing [data-aie-hidden="true"] {
    display: block !important; opacity: 0.3;
    outline: 2px dashed rgba(239,68,68,0.4) !important; outline-offset: -2px; min-height: 60px;
}

/* Highlight active section when selected in navigator */
body.aie-editing .aie-section-active {
    outline: 2px solid #f2d00d !important; outline-offset: -2px;
}

/* ========== Drop zones ========== */
.aie-dropzone { display: none; height: 4px; margin: 0; position: relative; transition: all 0.3s; }
body.aie-editing .aie-dropzone { display: block; height: 40px; }
.aie-dropzone:hover, .aie-dropzone.aie-dz-active { height: 60px; }
.aie-dropzone-inner {
    position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
    display: flex; align-items: center; gap: 12px; opacity: 0; transition: opacity 0.2s;
}
.aie-dropzone:hover .aie-dropzone-inner, .aie-dropzone.aie-dz-active .aie-dropzone-inner { opacity: 1; }
.aie-dropzone-line { flex: 1; height: 2px; background: rgba(242,208,13,0.3); min-width: 60px; }
.aie-dropzone-btn {
    width: 36px; height: 36px; border-radius: 50%;
    background: rgba(242,208,13,0.15); border: 2px dashed #f2d00d;
    color: #f2d00d; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    transition: all 0.2s; font-size: 20px; line-height: 1;
}
.aie-dropzone-btn:hover { background: #f2d00d; color: #12110a; border-style: solid; transform: scale(1.15); }

/* SortableJS */
.sortable-ghost { opacity: 0.4; outline: 2px dashed #f2d00d !important; }
.sortable-chosen { outline: 2px solid #f2d00d !important; }

/* ========== NAVIGATOR SIDEBAR ========== */
.aie-navigator {
    position: fixed; top: 48px; right: 0; bottom: 0; width: 300px; z-index: 9998;
    background: rgba(18,17,10,0.98); border-left: 1px solid rgba(242,208,13,0.2);
    backdrop-filter: blur(16px); font-family: 'Heebo', sans-serif; direction: rtl;
    display: flex; flex-direction: column;
    transform: translateX(100%); transition: transform 0.3s ease;
}
.aie-navigator.open { transform: translateX(0); }

/* Push page content when navigator is open */
body.aie-nav-open { margin-right: 300px; transition: margin-right 0.3s ease; }
body.aie-nav-open header.sticky { right: 300px; width: calc(100% - 300px); }

.aie-nav-header {
    padding: 12px 16px; border-bottom: 1px solid rgba(242,208,13,0.15);
    display: flex; align-items: center; justify-content: space-between; flex-shrink: 0;
}
.aie-nav-header h3 { color: #f2d00d; font-weight: 800; font-size: 14px; margin: 0; display: flex; align-items: center; gap: 6px; }
.aie-nav-header-actions { display: flex; gap: 4px; }
.aie-nav-header button {
    width: 28px; height: 28px; border: none; border-radius: 6px;
    background: rgba(255,255,255,0.05); color: #bab59c;
    cursor: pointer; display: flex; align-items: center; justify-content: center;
    transition: all 0.2s;
}
.aie-nav-header button:hover { background: rgba(255,255,255,0.15); color: white; }

/* Navigator list */
.aie-nav-list {
    flex: 1; overflow-y: auto; padding: 8px 0;
    scrollbar-width: thin; scrollbar-color: rgba(242,208,13,0.2) transparent;
}
.aie-nav-list::-webkit-scrollbar { width: 4px; }
.aie-nav-list::-webkit-scrollbar-track { background: transparent; }
.aie-nav-list::-webkit-scrollbar-thumb { background: rgba(242,208,13,0.2); border-radius: 2px; }

/* Navigator item */
.aie-nav-item {
    display: flex; align-items: center; gap: 8px;
    padding: 8px 14px; margin: 2px 8px; border-radius: 8px;
    cursor: pointer; transition: all 0.15s; border: 1px solid transparent;
    user-select: none;
}
.aie-nav-item:hover { background: rgba(255,255,255,0.04); border-color: rgba(255,255,255,0.08); }
.aie-nav-item.active { background: rgba(242,208,13,0.08); border-color: rgba(242,208,13,0.2); }
.aie-nav-item.hidden-section { opacity: 0.4; }

.aie-nav-item .aie-nav-drag {
    cursor: grab; color: rgba(186,181,156,0.4); flex-shrink: 0; transition: color 0.2s;
    display: flex; align-items: center;
}
.aie-nav-item:hover .aie-nav-drag { color: #bab59c; }
.aie-nav-item .aie-nav-drag:active { cursor: grabbing; }

.aie-nav-icon {
    width: 28px; height: 28px; border-radius: 6px; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    font-size: 16px;
}
.aie-nav-icon.static { background: rgba(242,208,13,0.1); color: #f2d00d; }
.aie-nav-icon.dynamic { background: rgba(59,130,246,0.1); color: #3b82f6; }

.aie-nav-info { flex: 1; min-width: 0; }
.aie-nav-label {
    color: #e0ddd0; font-size: 12px; font-weight: 600;
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.aie-nav-type { color: #6b6650; font-size: 10px; font-weight: 500; }

.aie-nav-actions {
    display: flex; gap: 2px; flex-shrink: 0;
    opacity: 0; transition: opacity 0.15s;
}
.aie-nav-item:hover .aie-nav-actions { opacity: 1; }
.aie-nav-actions button {
    width: 24px; height: 24px; border: none; border-radius: 4px;
    background: transparent; color: #6b6650; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    transition: all 0.15s;
}
.aie-nav-actions button:hover { background: rgba(255,255,255,0.08); color: #bab59c; }
.aie-nav-actions button.danger:hover { color: #ef4444; }

/* Navigator add block row */
.aie-nav-add-row {
    display: flex; align-items: center; gap: 6px;
    padding: 4px 14px; margin: 0 8px; border-radius: 6px;
    opacity: 0; height: 0; overflow: hidden;
    transition: all 0.2s; cursor: pointer;
}
.aie-nav-item:hover + .aie-nav-add-row,
.aie-nav-add-row:hover {
    opacity: 1; height: 28px; padding: 4px 14px; margin: 2px 8px;
}
.aie-nav-add-row:hover { background: rgba(242,208,13,0.05); }
.aie-nav-add-row span { color: #f2d00d; font-size: 14px; }
.aie-nav-add-row .aie-nav-add-label { color: #6b6650; font-size: 11px; font-weight: 600; }

/* Navigator minimap preview */
.aie-nav-minimap {
    flex-shrink: 0; border-top: 1px solid rgba(242,208,13,0.1);
    padding: 12px 16px; max-height: 200px;
}
.aie-nav-minimap-viewport {
    width: 100%; background: rgba(255,255,255,0.03); border-radius: 8px;
    overflow: hidden; position: relative;
}
.aie-nav-minimap-bar {
    height: 100%; display: flex; flex-direction: column; gap: 2px; padding: 4px;
}
.aie-nav-mm-block {
    border-radius: 3px; min-height: 4px; transition: all 0.15s;
    cursor: pointer;
}
.aie-nav-mm-block.static { background: rgba(242,208,13,0.15); }
.aie-nav-mm-block.dynamic { background: rgba(59,130,246,0.2); }
.aie-nav-mm-block.hidden-mm { background: rgba(239,68,68,0.15); }
.aie-nav-mm-block:hover { opacity: 0.8; }
.aie-nav-mm-indicator {
    position: absolute; left: 0; right: 0; border: 1px solid rgba(242,208,13,0.4);
    border-radius: 3px; pointer-events: none; transition: top 0.1s, height 0.1s;
    background: rgba(242,208,13,0.03);
}

/* Navigator footer */
.aie-nav-footer {
    flex-shrink: 0; padding: 10px 16px; border-top: 1px solid rgba(242,208,13,0.1);
}
.aie-nav-footer button {
    width: 100%; padding: 8px; border-radius: 8px; border: 2px dashed rgba(242,208,13,0.3);
    background: transparent; color: #f2d00d; font-size: 13px; font-weight: 700;
    cursor: pointer; transition: all 0.2s; font-family: 'Heebo', sans-serif;
    display: flex; align-items: center; justify-content: center; gap: 6px;
}
.aie-nav-footer button:hover { background: rgba(242,208,13,0.08); border-color: #f2d00d; }

/* SortableJS in navigator */
.aie-nav-list .sortable-ghost { opacity: 0.3; background: rgba(242,208,13,0.1); border-radius: 8px; }

/* ========== Add Block Panel ========== */
.aie-block-panel {
    position: fixed; top: 48px; left: 0; bottom: 0; width: 340px; z-index: 10000;
    background: rgba(18,17,10,0.98); border-right: 2px solid rgba(242,208,13,0.3);
    backdrop-filter: blur(16px); overflow-y: auto;
    font-family: 'Heebo', sans-serif; direction: rtl;
    transform: translateX(-100%); transition: transform 0.3s ease; padding: 0;
}
.aie-block-panel.open { transform: translateX(0); }
.aie-block-panel-header {
    position: sticky; top: 0; z-index: 1;
    padding: 16px 20px; background: rgba(18,17,10,0.98);
    border-bottom: 1px solid rgba(242,208,13,0.15);
    display: flex; align-items: center; justify-content: space-between;
}
.aie-block-panel-header h3 { color: #f2d00d; font-weight: 800; font-size: 16px; margin: 0; }
.aie-block-panel-close {
    width: 32px; height: 32px; border: none; border-radius: 8px;
    background: rgba(255,255,255,0.05); color: #bab59c;
    cursor: pointer; display: flex; align-items: center; justify-content: center;
}
.aie-block-panel-close:hover { background: rgba(255,255,255,0.15); color: white; }
.aie-block-types { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; padding: 20px; }
.aie-block-type-card {
    padding: 16px 12px; border: 1px solid rgba(255,255,255,0.1);
    border-radius: 12px; cursor: pointer; text-align: center;
    transition: all 0.2s; background: rgba(255,255,255,0.02);
}
.aie-block-type-card:hover { border-color: rgba(242,208,13,0.4); background: rgba(242,208,13,0.05); transform: translateY(-2px); }
.aie-block-type-card .material-symbols-outlined { font-size: 28px; color: #f2d00d; display: block; margin-bottom: 6px; }
.aie-block-type-card span:last-child { color: #bab59c; font-size: 12px; font-weight: 700; }

/* ========== Block Edit Modal ========== */
.aie-block-modal {
    position: fixed; inset: 0; z-index: 10001;
    display: none; align-items: center; justify-content: center;
    background: rgba(0,0,0,0.7); backdrop-filter: blur(4px);
}
.aie-block-modal.open { display: flex; }
.aie-block-modal-content {
    width: 90%; max-width: 520px; max-height: 85vh; overflow-y: auto;
    background: #1c1a0e; border: 1px solid rgba(242,208,13,0.3);
    border-radius: 16px; padding: 24px;
    font-family: 'Heebo', sans-serif; direction: rtl;
}
.aie-block-modal-content h3 { color: #f2d00d; font-weight: 800; font-size: 18px; margin: 0 0 16px; }
.aie-block-modal-content label { color: #bab59c; font-size: 13px; font-weight: 700; display: block; margin-bottom: 4px; }
.aie-block-modal-content .aie-field { margin-bottom: 14px; }
.aie-block-modal-content .aie-field input,
.aie-block-modal-content .aie-field textarea,
.aie-block-modal-content .aie-field select {
    width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.15);
    border-radius: 8px; color: white; padding: 10px 12px; font-size: 14px;
    font-family: 'Heebo', sans-serif; outline: none; box-sizing: border-box;
}
.aie-block-modal-content .aie-field input:focus,
.aie-block-modal-content .aie-field textarea:focus,
.aie-block-modal-content .aie-field select:focus { border-color: #f2d00d; }
.aie-block-modal-actions { display: flex; gap: 10px; margin-top: 20px; }
.aie-block-modal-actions button {
    flex: 1; padding: 10px; border-radius: 10px; font-size: 15px; font-weight: 700;
    cursor: pointer; border: none; transition: all 0.2s;
}
.aie-block-modal-actions .aie-bm-save { background: #f2d00d; color: #12110a; }
.aie-block-modal-actions .aie-bm-save:hover { background: #e0c00c; }
.aie-block-modal-actions .aie-bm-cancel { background: rgba(255,255,255,0.1); color: #bab59c; }

.aie-upload-row { display: flex; gap: 8px; }
.aie-upload-row input { flex: 1; }
.aie-upload-btn {
    padding: 10px 14px; border-radius: 8px; border: none;
    background: rgba(242,208,13,0.15); color: #f2d00d;
    font-weight: 700; font-size: 13px; cursor: pointer;
    white-space: nowrap; transition: all 0.2s;
}
.aie-upload-btn:hover { background: rgba(242,208,13,0.3); }

.aie-gallery-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px; margin-top: 8px; }
.aie-gallery-item { position: relative; aspect-ratio: 1; border-radius: 8px; overflow: hidden; border: 1px solid rgba(255,255,255,0.1); }
.aie-gallery-item img { width: 100%; height: 100%; object-fit: cover; }
.aie-gallery-item button {
    position: absolute; top: 4px; right: 4px; width: 22px; height: 22px;
    border-radius: 50%; border: none; background: rgba(239,68,68,0.9); color: white;
    cursor: pointer; font-size: 14px; display: flex; align-items: center; justify-content: center;
}
</style>

<!-- Admin Bar -->
<div class="aie-bar" id="aieBar" style="<?= isset($_COOKIE['aie_bar_hidden']) && $_COOKIE['aie_bar_hidden'] === '1' ? 'display:none;' : '' ?>">
    <div class="aie-label">
        <span class="material-symbols-outlined" style="font-size:20px">admin_panel_settings</span>
        <span>מצב ניהול</span>
    </div>
    <div class="aie-actions">
        <button class="aie-btn aie-btn-edit" id="aieToggle" onclick="aieToggleEdit()">
            <span class="material-symbols-outlined" style="font-size:18px">edit</span>
            <span id="aieToggleText">הפעל עריכה</span>
        </button>
        <button class="aie-btn" id="aieWaBtn" onclick="aieOpenWhatsAppSettings()" style="background:#25D366;color:#fff;" title="הגדרות WhatsApp">
            <span class="material-symbols-outlined" style="font-size:18px">chat</span>
            <span>וואטסאפ</span>
        </button>
        <a href="<?= BASE_URL ?>/admin" class="aie-btn aie-btn-link">
            <span class="material-symbols-outlined" style="font-size:16px">dashboard</span>
            פאנל ניהול
        </a>
        <button onclick="document.cookie='aie_bar_hidden=1; path=/; max-age=86400'; document.getElementById('aieBar').style.display='none';" class="aie-btn" style="background:rgba(255,255,255,0.1);color:#fff;" title="הסתר סרגל (יחזור מחר)">
            <span class="material-symbols-outlined" style="font-size:18px">close</span>
        </button>
    </div>
</div>
<!-- Small restore button when bar is hidden -->
<?php if (isset($_COOKIE['aie_bar_hidden']) && $_COOKIE['aie_bar_hidden'] === '1'): ?>
<button onclick="document.cookie='aie_bar_hidden=0; path=/; max-age=0'; location.reload();" style="position:fixed;top:8px;left:8px;z-index:9998;background:#f2d00d;color:#12110a;border:none;width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 12px rgba(0,0,0,0.3);cursor:pointer;" title="הצג סרגל אדמין">
    <span class="material-symbols-outlined" style="font-size:18px">admin_panel_settings</span>
</button>
<?php endif; ?>

<!-- Navigator Sidebar -->
<div class="aie-navigator" id="aieNavigator">
    <div class="aie-nav-header">
        <h3><span class="material-symbols-outlined" style="font-size:18px">layers</span> ניווט עמוד</h3>
        <div class="aie-nav-header-actions">
            <button onclick="aieRefreshNavigator()" title="רענן"><span class="material-symbols-outlined" style="font-size:16px">refresh</span></button>
            <button onclick="aieToggleNavigator()" title="סגור"><span class="material-symbols-outlined" style="font-size:16px">close</span></button>
        </div>
    </div>
    <div class="aie-nav-list" id="aieNavList">
        <!-- Populated dynamically -->
    </div>
    <div class="aie-nav-minimap" id="aieNavMinimap">
        <div class="aie-nav-minimap-viewport" id="aieMinimapViewport">
            <div class="aie-nav-minimap-bar" id="aieMinimapBar"></div>
            <div class="aie-nav-mm-indicator" id="aieMinimapIndicator"></div>
        </div>
    </div>
    <div class="aie-nav-footer">
        <button onclick="aieAddBlockFromNav(-1)"><span class="material-symbols-outlined" style="font-size:18px">add_circle</span> הוסף בלוק חדש</button>
    </div>
</div>

<!-- Add Block Side Panel -->
<div class="aie-block-panel" id="aieBlockPanel">
    <div class="aie-block-panel-header">
        <h3>הוסף בלוק חדש</h3>
        <button class="aie-block-panel-close" onclick="aieCloseBlockPanel()">
            <span class="material-symbols-outlined">close</span>
        </button>
    </div>
    <div class="aie-block-types" id="aieBlockTypes">
        <div class="aie-block-type-card" data-type="heading"><span class="material-symbols-outlined">title</span><span>כותרת</span></div>
        <div class="aie-block-type-card" data-type="text"><span class="material-symbols-outlined">notes</span><span>טקסט</span></div>
        <div class="aie-block-type-card" data-type="image"><span class="material-symbols-outlined">image</span><span>תמונה</span></div>
        <div class="aie-block-type-card" data-type="video"><span class="material-symbols-outlined">play_circle</span><span>וידאו</span></div>
        <div class="aie-block-type-card" data-type="image_text"><span class="material-symbols-outlined">view_sidebar</span><span>תמונה + טקסט</span></div>
        <div class="aie-block-type-card" data-type="cta"><span class="material-symbols-outlined">ads_click</span><span>קריאה לפעולה</span></div>
        <div class="aie-block-type-card" data-type="spacer"><span class="material-symbols-outlined">unfold_more</span><span>רווח</span></div>
        <div class="aie-block-type-card" data-type="divider"><span class="material-symbols-outlined">horizontal_rule</span><span>קו מפריד</span></div>
        <div class="aie-block-type-card" data-type="gallery"><span class="material-symbols-outlined">photo_library</span><span>גלריה</span></div>
    </div>
</div>

<!-- Block Edit Modal -->
<div class="aie-block-modal" id="aieBlockModal">
    <div class="aie-block-modal-content" id="aieBlockModalContent"></div>
</div>

<!-- Inline Editing + Block Builder + Navigator JS -->
<script>
(function() {
    // ========== INLINE EDITING ==========
    document.body.classList.add('aie-active');
    const floatBtn = document.querySelector('a[href$="/admin"].fixed.bottom-6');
    if (floatBtn) floatBtn.style.display = 'none';

    let editMode = false;
    let currentPopup = null;

    window.aieToggleEdit = function() {
        editMode = !editMode;
        const btn = document.getElementById('aieToggle');
        const txt = document.getElementById('aieToggleText');
        if (editMode) {
            document.body.classList.add('aie-editing');
            btn.classList.add('active');
            txt.textContent = 'כבה עריכה';
            aieGlobalScan();
            aieBlockBuilderActivate();
            aieOpenNavigator();
        } else {
            document.body.classList.remove('aie-editing');
            btn.classList.remove('active');
            txt.textContent = 'הפעל עריכה';
            aieClosePopup();
            aieBlockBuilderDeactivate();
            aieCloseNavigator();
        }
    };

    function idToKey(id) { return id.replace(/([A-Z])/g, '_$1').toLowerCase(); }

    const SKIP_IDS = new Set([
        'aieBar','aieToggle','aieToggleText','aieBlockPanel','aieBlockModal','aieBlockModalContent','aieBlockTypes',
        'aieNavigator','aieNavList','aieNavMinimap','aieMinimapViewport','aieMinimapBar','aieMinimapIndicator',
        'tailwind-config',
        'leadForm','loginForm','registerForm','contactForm','storyEditForm','faqEditForm',
        'formMessage','loginError','registerError','contactSuccess',
        'submitBtn','contactSubmitBtn',
        'fullName','age','email','interest',
        'loginEmail','loginPassword','regName','regEmail','regPassword','regAge','regPhone',
        'cfName','cfPhone','cfEmail','cfMessage',
        'loginModal','registerModal','storyEditModal','faqEditModal',
        'authButtons','userMenu','userName',
        'mobileMenu','mobileMenuBtn',
        'profileGrid','pagination','totalCount',
        'ageMin','ageMax','countryFilter','maritalFilter',
        'storiesGrid','faqList','stepsContainer',
        'storyEditId','storyEditNames','storyEditTitle','storyEditText','storyEditImage','storyEditDate','storyImageFile','storyModalTitle',
        'faqEditId','faqEditQuestion','faqEditAnswer','faqEditOrder','faqModalTitle',
        'siteFooter','adminFloatBtn',
        'footerSocial','footerLinks',
        'socialLink1','socialLink2','socialLink3',
        'visionCards','aboutWhyList','statsContainer',
        'vipPkg1Features','vipPkg2Features','vipPkg3Features',
    ]);
    const SKIP_TAGS = new Set(['INPUT','SELECT','TEXTAREA','FORM','SCRIPT','STYLE','LINK','META','NAV','HEADER','FOOTER','MAIN','ASIDE','DETAILS','SUMMARY','UL','OL','TABLE','THEAD','TBODY','TR','SECTION','ARTICLE']);
    const FORCE_EDITABLE_PREFIXES = ['nav','header','footer','social'];

    window.aieToast = function(msg, type = 'success') {
        const old = document.querySelector('.aie-toast'); if (old) old.remove();
        const t = document.createElement('div'); t.className = 'aie-toast ' + type; t.textContent = msg;
        document.body.appendChild(t);
        requestAnimationFrame(() => t.classList.add('show'));
        setTimeout(() => { t.classList.remove('show'); setTimeout(() => t.remove(), 300); }, 3000);
    };

    function aieClosePopup() { if (currentPopup) { currentPopup.remove(); currentPopup = null; } }
    window.aieClosePopup = aieClosePopup;

    async function aieSaveSetting(key, value) {
        try {
            const res = await fetch(BASE + '/api/panel/settings', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ [key]: value }),
                credentials: 'include'
            });
            const txt = await res.text();
            if (!res.ok) {
                alert('❌ שגיאה בשמירה!\n\nקוד: ' + res.status + '\nתשובה: ' + txt + '\nמפתח: ' + key + '\n\nנסה להתנתק ולהתחבר מחדש ל-/admin');
                return false;
            }
            // Verify the save actually persisted
            const verifyRes = await fetch(BASE + '/api/panel/settings?verify=' + Date.now(), { credentials: 'include' });
            const verifyData = await verifyRes.json();
            const savedVal = verifyData[key];
            if (savedVal !== value) {
                alert('⚠️ שמירה נכשלה!\n\nנשלח: "' + (value||'').substring(0,50) + '"\nנשמר: "' + (savedVal||'').substring(0,50) + '"\nמפתח: ' + key);
                return false;
            }
            return true;
        } catch (e) {
            alert('❌ שגיאת רשת: ' + e.message);
            return false;
        }
    }

    async function aieUploadImage(file) {
        const fd = new FormData(); fd.append('file', file);
        try {
            const res = await fetch(BASE + '/api/upload', { method: 'POST', body: fd });
            const data = await res.json(); if (!res.ok) throw new Error(data.error || 'Upload failed'); return data.url;
        } catch (e) { aieToast('שגיאה בהעלאה: ' + e.message, 'error'); return null; }
    }

    function friendlyLabel(key) { return key.replace(/_/g, ' '); }

    function rgbToHex(rgb) {
        if (!rgb || rgb === 'transparent' || rgb === 'rgba(0, 0, 0, 0)') return '';
        if (rgb.startsWith('#')) return rgb;
        const m = rgb.match(/\d+/g);
        if (!m || m.length < 3) return '';
        return '#' + m.slice(0, 3).map(x => parseInt(x).toString(16).padStart(2, '0')).join('');
    }

    function getElColors(el) {
        const cs = getComputedStyle(el);
        return {
            text: rgbToHex(cs.color),
            bg: rgbToHex(cs.backgroundColor),
        };
    }

    function showTextPopup(el, key, isMultiline) {
        aieClosePopup();
        const rect = el.getBoundingClientRect();
        const popup = document.createElement('div'); popup.className = 'aie-popup';
        const currentVal = el.innerText.trim();
        const inputEl = isMultiline ? `<textarea rows="4">${currentVal}</textarea>` : `<input type="text" value="${currentVal.replace(/"/g, '&quot;')}"/>`;

        // Detect if element is a link or button (also check parent)
        const linkEl = el.tagName === 'A' ? el : (el.closest('a') || null);
        const isLink = !!linkEl;
        const isButton = el.tagName === 'BUTTON' || !!el.closest('button');
        const linkHref = isLink ? (linkEl.getAttribute('href') || '') : '';

        // Build link field HTML
        let linkHTML = '';
        if (isLink) {
            // Detect if current href is a WhatsApp link and extract phone/message
            let currentPhone = '', currentMsg = '';
            const waMatch = linkHref.match(/^https?:\/\/wa\.me\/(\d+)(?:\?text=(.*))?$/);
            if (waMatch) {
                currentPhone = waMatch[1];
                currentMsg = waMatch[2] ? decodeURIComponent(waMatch[2].replace(/\+/g, ' ')) : '';
            }
            linkHTML = `<div class="aie-section-label">קישור / וואטסאפ</div>
                <div class="aie-field-row">
                    <label>URL</label>
                    <input type="url" class="aie-link-input" value="${linkHref.replace(/"/g, '&quot;')}" placeholder="https://... או /page" dir="ltr" style="flex:1;color:#fff !important;background:#0f0e08 !important;"/>
                </div>
                <div style="padding:10px;background:rgba(37,211,102,0.08);border:1px solid rgba(37,211,102,0.3);border-radius:8px;margin:8px 0;">
                    <p style="font-size:12px;color:#25D366;font-weight:bold;margin-bottom:8px;">🟢 בנה קישור וואטסאפ:</p>
                    <div class="aie-field-row" style="margin-bottom:6px;">
                        <label style="font-size:12px;color:#fff;min-width:60px;">טלפון</label>
                        <input type="tel" class="aie-wa-phone" value="${currentPhone}" placeholder="972501234567" dir="ltr" style="flex:1;font-size:13px;color:#fff !important;background:#0f0e08 !important;padding:8px;border:1px solid rgba(255,255,255,0.2);border-radius:4px;"/>
                    </div>
                    <div class="aie-field-row" style="margin-bottom:6px;">
                        <label style="font-size:12px;color:#fff;min-width:60px;">הודעה</label>
                        <input type="text" class="aie-wa-msg" value="${currentMsg.replace(/"/g, '&quot;')}" placeholder="שלום, אני מעוניין..." style="flex:1;font-size:13px;color:#fff !important;background:#0f0e08 !important;padding:8px;border:1px solid rgba(255,255,255,0.2);border-radius:4px;"/>
                    </div>
                    <button type="button" class="aie-wa-build" style="margin-top:8px;background:#25D366;color:#fff;border:none;border-radius:6px;padding:8px 12px;font-size:13px;cursor:pointer;font-weight:bold;width:100%;">בנה קישור וואטסאפ</button>
                </div>`;
        }

        // Build color fields HTML
        const colors = getElColors(el);
        let colorHTML = `<div class="aie-section-label">צבעים</div>
            <div class="aie-field-row">
                <label>טקסט</label>
                <input type="color" class="aie-color-text" value="${colors.text || '#ffffff'}"/>
                <input type="text" class="aie-color-hex aie-color-text-hex" value="${colors.text || '#ffffff'}" dir="ltr" maxlength="7"/>
            </div>
            <div class="aie-field-row">
                <label>רקע</label>
                <input type="color" class="aie-color-bg" value="${colors.bg || '#12110a'}"/>
                <input type="text" class="aie-color-hex aie-color-bg-hex" value="${colors.bg || '#12110a'}" dir="ltr" maxlength="7"/>
            </div>`;

        popup.innerHTML = `<div class="aie-popup-title"><span class="material-symbols-outlined" style="font-size:16px">edit</span> ${friendlyLabel(key)}</div>
            <div class="aie-section-label">טקסט</div>
            ${inputEl}
            ${linkHTML}
            ${colorHTML}
            <div class="aie-popup-actions"><button class="aie-save">שמור</button><button class="aie-cancel">ביטול</button></div>`;

        const scrollY = window.scrollY; let top = rect.bottom + scrollY + 8, left = rect.left;
        if (left + 340 > window.innerWidth) left = window.innerWidth - 360; if (left < 10) left = 10;
        if (top + 300 > window.innerHeight + scrollY) { top = rect.top + scrollY - 380; if (top < scrollY + 60) top = scrollY + 60; }
        popup.style.position = 'absolute'; popup.style.top = top + 'px'; popup.style.left = left + 'px';
        document.body.appendChild(popup); currentPopup = popup;

        const input = popup.querySelector('input[type="text"]:not(.aie-color-hex):not(.aie-link-input), textarea');
        input.focus(); if (input.select) input.select();

        // Sync color picker <-> hex input
        const colorText = popup.querySelector('.aie-color-text');
        const colorTextHex = popup.querySelector('.aie-color-text-hex');
        const colorBg = popup.querySelector('.aie-color-bg');
        const colorBgHex = popup.querySelector('.aie-color-bg-hex');

        if (colorText && colorTextHex) {
            colorText.oninput = () => { colorTextHex.value = colorText.value; el.style.color = colorText.value; };
            colorTextHex.oninput = () => { if (/^#[0-9a-fA-F]{6}$/.test(colorTextHex.value)) { colorText.value = colorTextHex.value; el.style.color = colorTextHex.value; } };
        }
        if (colorBg && colorBgHex) {
            colorBg.oninput = () => { colorBgHex.value = colorBg.value; el.style.backgroundColor = colorBg.value; };
            colorBgHex.oninput = () => { if (/^#[0-9a-fA-F]{6}$/.test(colorBgHex.value)) { colorBg.value = colorBgHex.value; el.style.backgroundColor = colorBgHex.value; } };
        }

        const doSave = async () => {
            const newVal = input.value;
            let ok = await aieSaveSetting(key, newVal);
            if (!ok) return;
            el.textContent = newVal;

            // Save link
            if (isLink && linkEl) {
                const newHref = popup.querySelector('.aie-link-input').value;
                if (newHref !== linkHref) {
                    await aieSaveSetting(key + '_link', newHref);
                    linkEl.setAttribute('href', newHref);
                }
            }

            // Save colors
            const newTextColor = colorTextHex.value;
            const newBgColor = colorBgHex.value;
            if (newTextColor && newTextColor !== colors.text) {
                await aieSaveSetting(key + '_color', newTextColor);
                el.style.color = newTextColor;
            }
            if (newBgColor && newBgColor !== colors.bg) {
                await aieSaveSetting(key + '_bg_color', newBgColor);
                el.style.backgroundColor = newBgColor;
            }

            aieToast('נשמר בהצלחה!');
            aieClosePopup();
        };
        const origColor = el.style.color;
        const origBg = el.style.backgroundColor;
        const doCancel = () => {
            // Revert live preview to original
            el.style.color = origColor;
            el.style.backgroundColor = origBg;
            aieClosePopup();
        };
        // WhatsApp link builder
        const waPhone = popup.querySelector('.aie-wa-phone');
        const waMsg = popup.querySelector('.aie-wa-msg');
        const waBuild = popup.querySelector('.aie-wa-build');
        if (waBuild) {
            waBuild.onclick = () => {
                let phone = (waPhone.value || '').replace(/[^0-9]/g, '');
                if (!phone) return;
                // Convert Israeli 05 to 9725
                if (phone.startsWith('0')) phone = '972' + phone.substring(1);
                const msg = (waMsg.value || '').trim();
                const url = 'https://wa.me/' + phone + (msg ? '?text=' + encodeURIComponent(msg) : '');
                popup.querySelector('.aie-link-input').value = url;
                waBuild.textContent = '✓ נבנה!';
                setTimeout(() => { waBuild.textContent = 'בנה קישור וואטסאפ'; }, 1500);
            };
        }

        popup.querySelector('.aie-save').onclick = doSave;
        popup.querySelector('.aie-cancel').onclick = doCancel;
        input.addEventListener('keydown', e => { if (e.key === 'Escape') { e.preventDefault(); doCancel(); } if (e.key === 'Enter' && !isMultiline) { e.preventDefault(); doSave(); } if (e.key === 'Enter' && e.ctrlKey && isMultiline) { e.preventDefault(); doSave(); } });
    }

    function handleImageClick(el, key) {
        const input = document.createElement('input'); input.type = 'file'; input.accept = 'image/*';
        input.onchange = async function() { if (!input.files[0]) return; aieToast('מעלה תמונה...', 'success'); const url = await aieUploadImage(input.files[0]); if (url) { const ok = await aieSaveSetting(key, url); if (ok) { if (el.tagName === 'IMG') el.src = url; else el.style.backgroundImage = `url('${url}')`; aieToast('תמונה עודכנה בהצלחה!'); } } };
        input.click();
    }

    // ---- WhatsApp Contact Settings (global phone + message template) ----
    window.aieOpenWhatsAppSettings = async function() {
        aieClosePopup();
        let cur = { phone: '', tmpl: '' };
        try {
            const r = await fetch(BASE + '/api/panel/settings');
            const s = await r.json();
            cur.phone = s.contact_whatsapp_phone || '';
            cur.tmpl = s.contact_whatsapp_template || 'שלום, אני מעוניין בפרופיל של {name}, גיל {age}, מ-{city}. אשמח לפרטים נוספים.';
        } catch {}
        const backdrop = document.createElement('div');
        backdrop.style.cssText = 'position:fixed;inset:0;z-index:10000;background:rgba(0,0,0,0.6);backdrop-filter:blur(4px);';
        const popup = document.createElement('div');
        popup.className = 'aie-popup';
        popup.style.cssText = 'position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);min-width:420px;max-width:520px;';
        popup.innerHTML = `
            <div class="aie-popup-title" style="font-size:16px;margin-bottom:14px;">
                <span class="material-symbols-outlined" style="font-size:20px;color:#25D366;">chat</span>
                הגדרות WhatsApp לכפתורי "צור קשר"
            </div>
            <div style="background:rgba(37,211,102,0.08);border:1px solid rgba(37,211,102,0.3);border-radius:8px;padding:10px;margin-bottom:12px;font-size:12px;color:#cbd5e1;line-height:1.6;">
                כאשר מבקר לוחץ על כפתור "שלח הודעה" בעמוד פרופיל, הוא יופנה לוואטסאפ עם המספר שלך וההודעה תכלול אוטומטית את פרטי הפרופיל.
            </div>
            <div class="aie-section-label">מספר טלפון WhatsApp שלך</div>
            <input type="tel" id="aieWaPhone" value="${cur.phone.replace(/"/g,'&quot;')}" placeholder="972501234567" dir="ltr" style="font-size:16px;letter-spacing:1px;background:#ffffff !important;color:#000000 !important;font-weight:700;"/>
            <div style="font-size:11px;color:#777;margin-top:4px;">פורמט: 972501234567 (ללא + או 0 בהתחלה). או הכנס 0501234567 והמערכת תמיר.</div>

            <div class="aie-section-label" style="margin-top:14px;">תבנית הודעה</div>
            <textarea id="aieWaTmpl" rows="4" style="font-family:Heebo,sans-serif;background:#ffffff !important;color:#000000 !important;font-weight:500;">${cur.tmpl.replace(/</g,'&lt;')}</textarea>
            <div style="font-size:11px;color:#777;margin-top:4px;line-height:1.6;">
                משתנים זמינים: <code style="color:#f2d00d;background:#0f0e08;padding:1px 5px;border-radius:3px;">{name}</code>
                <code style="color:#f2d00d;background:#0f0e08;padding:1px 5px;border-radius:3px;">{age}</code>
                <code style="color:#f2d00d;background:#0f0e08;padding:1px 5px;border-radius:3px;">{city}</code>
                <code style="color:#f2d00d;background:#0f0e08;padding:1px 5px;border-radius:3px;">{country}</code>
                <code style="color:#f2d00d;background:#0f0e08;padding:1px 5px;border-radius:3px;">{url}</code>
            </div>

            <div id="aieWaPreview" style="margin-top:12px;padding:10px;background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.08);border-radius:8px;font-size:12px;color:#aaa;line-height:1.5;">
                <div style="font-weight:700;color:#bab59c;margin-bottom:4px;">תצוגה מקדימה (לדוגמה: אלנה, 28, קישינב):</div>
                <div id="aieWaPreviewText" style="color:#cbd5e1;"></div>
            </div>

            <div class="aie-popup-actions" style="margin-top:14px;">
                <button class="aie-save" id="aieWaSaveBtn">שמור</button>
                <button class="aie-cancel" id="aieWaCancelBtn">ביטול</button>
            </div>
        `;
        document.body.appendChild(backdrop);
        document.body.appendChild(popup);
        currentPopup = popup;

        const phoneEl = popup.querySelector('#aieWaPhone');
        const tmplEl = popup.querySelector('#aieWaTmpl');
        const previewEl = popup.querySelector('#aieWaPreviewText');
        function renderPreview() {
            const sample = { name: 'אלנה', age: '28', city: 'קישינב', country: 'מולדובה', url: location.origin + '/profile/1' };
            const msg = (tmplEl.value || '').replace(/\{(\w+)\}/g, (_, k) => sample[k] || '');
            previewEl.textContent = msg;
        }
        renderPreview();
        tmplEl.oninput = renderPreview;

        const close = () => { backdrop.remove(); popup.remove(); currentPopup = null; };
        backdrop.onclick = close;
        popup.querySelector('#aieWaCancelBtn').onclick = close;
        popup.querySelector('#aieWaSaveBtn').onclick = async () => {
            let phone = (phoneEl.value || '').replace(/[^0-9]/g, '');
            if (phone.startsWith('0')) phone = '972' + phone.substring(1);
            await aieSaveSetting('contact_whatsapp_phone', phone);
            await aieSaveSetting('contact_whatsapp_template', tmplEl.value || '');
            aieToast('הגדרות WhatsApp נשמרו!');
            close();
        };
    };

    // ---- GLOBAL SCAN ----
    function aieGlobalScan() {
        document.querySelectorAll('[id]').forEach(el => {
            const id = el.id;
            if (SKIP_IDS.has(id) || id.startsWith('aie')) return;
            if (el.hasAttribute('data-aie') || el.hasAttribute('data-aie-img')) return;
            if (el.closest('.aie-bar') || el.closest('.aie-popup') || el.closest('.aie-block-panel') || el.closest('.aie-block-modal') || el.closest('.aie-navigator') || el.closest('[id$="Modal"]') || el.closest('[id$="modal"]')) return;
            const isForced = FORCE_EDITABLE_PREFIXES.some(p => id.toLowerCase().startsWith(p));
            if (!isForced && SKIP_TAGS.has(el.tagName)) return;
            if (['INPUT','SELECT','TEXTAREA','FORM','SCRIPT','STYLE'].includes(el.tagName)) return;
            if (el.tagName === 'BUTTON' && (el.type === 'submit' || el.closest('form'))) return;
            const hasText = el.textContent.trim().length > 0;
            const isImg = el.tagName === 'IMG';
            const hasBgImg = el.style.backgroundImage && el.style.backgroundImage !== 'none' && el.style.backgroundImage !== '';
            if (!hasText && !isImg && !hasBgImg) return;
            const dce = el.querySelectorAll(':scope > *').length;
            if (!isForced && dce > 5 && !isImg && !hasBgImg) return;
            const key = idToKey(id);
            if (isImg || hasBgImg) { el.setAttribute('data-aie-img', key); el.setAttribute('data-aie-label', 'החלף תמונה'); }
            else { const isMulti = el.tagName === 'P' || (el.tagName === 'DIV' && dce <= 1) || el.textContent.trim().length > 80; el.setAttribute('data-aie', key); el.setAttribute('data-aie-type', isMulti ? 'multiline' : 'text'); el.setAttribute('data-aie-label', friendlyLabel(key)); }
            el.style.position = el.style.position || 'relative';
        });
    }
    window.aieGlobalScan = aieGlobalScan;
    window.aieAutoScan = function() { aieGlobalScan(); };
    window.aieInit = function(map) { Object.entries(map).forEach(([id, c]) => { const el = document.getElementById(id); if (!el) return; if (c.type === 'image') { el.setAttribute('data-aie-img', c.key); el.setAttribute('data-aie-label', 'החלף תמונה'); } else { el.setAttribute('data-aie', c.key); el.setAttribute('data-aie-type', c.type || 'text'); el.setAttribute('data-aie-label', friendlyLabel(c.key)); } el.style.position = el.style.position || 'relative'; }); };

    document.addEventListener('click', function(e) {
        if (!editMode) return;
        if (e.target.closest('.aie-section-toolbar') || e.target.closest('.aie-dropzone') || e.target.closest('.aie-block-panel') || e.target.closest('.aie-block-modal') || e.target.closest('.aie-navigator')) return;
        const textEl = e.target.closest('[data-aie]'); const imgEl = e.target.closest('[data-aie-img]');
        if (textEl) { e.preventDefault(); e.stopPropagation(); showTextPopup(textEl, textEl.getAttribute('data-aie'), (textEl.getAttribute('data-aie-type') || 'text') === 'multiline'); }
        else if (imgEl) { e.preventDefault(); e.stopPropagation(); handleImageClick(imgEl, imgEl.getAttribute('data-aie-img')); }
    }, true);
    document.addEventListener('mousedown', function(e) { if (currentPopup && !currentPopup.contains(e.target) && !e.target.closest('[data-aie]') && !e.target.closest('[data-aie-img]')) aieClosePopup(); });
    document.addEventListener('keydown', function(e) { if (e.key === 'Escape' && currentPopup) aieClosePopup(); });

    setTimeout(aieGlobalScan, 500);
    setTimeout(aieGlobalScan, 2000);

    // ========== BLOCK BUILDER ==========
    let blockPanelInsertAfter = null;
    let currentBlockEdit = null;
    let sortableInstance = null;
    let navSortableInstance = null;

    const BLOCK_TYPE_ICONS = { heading: 'title', text: 'notes', image: 'image', video: 'play_circle', image_text: 'view_sidebar', cta: 'ads_click', spacer: 'unfold_more', divider: 'horizontal_rule', gallery: 'photo_library' };
    const BLOCK_TYPE_LABELS = { heading: 'כותרת', text: 'טקסט', image: 'תמונה', video: 'וידאו', image_text: 'תמונה + טקסט', cta: 'קריאה לפעולה', spacer: 'רווח', divider: 'קו מפריד', gallery: 'גלריה' };

    function getSectionLabel(sec) {
        const h = sec.querySelector('h1, h2, h3, h4');
        if (h) return h.textContent.trim().substring(0, 40);
        const p = sec.querySelector('p');
        if (p) return p.textContent.trim().substring(0, 40);
        return 'סקשן';
    }

    function aieBlockBuilderActivate() {
        const main = document.querySelector('main'); if (!main) return;
        main.querySelectorAll('.aie-section-toolbar, .aie-dropzone').forEach(el => el.remove());
        const children = Array.from(main.children).filter(el => el.tagName === 'SECTION' || el.classList.contains('aie-dynamic-block'));
        let staticIdx = 0;

        children.forEach((sec) => {
            sec.style.position = sec.style.position || 'relative';
            const isDynamic = sec.classList.contains('aie-dynamic-block');
            const blockId = sec.getAttribute('data-block-id');
            const isHidden = sec.getAttribute('data-aie-hidden') === 'true';
            const tb = document.createElement('div'); tb.className = 'aie-section-toolbar';
            if (isDynamic) {
                tb.innerHTML = `<button onclick="aieEditBlock(${blockId})" title="ערוך"><span class="material-symbols-outlined" style="font-size:18px">edit</span></button><button class="aie-tb-danger" onclick="aieDeleteBlock(${blockId})" title="מחק"><span class="material-symbols-outlined" style="font-size:18px">delete</span></button>`;
            } else {
                const idx = staticIdx;
                tb.innerHTML = `<button class="${isHidden ? '' : 'aie-tb-active'}" onclick="aieToggleSection(this, ${idx})" title="${isHidden ? 'הצג' : 'הסתר'}"><span class="material-symbols-outlined" style="font-size:18px">${isHidden ? 'visibility_off' : 'visibility'}</span></button>`;
                sec.setAttribute('data-aie-section-idx', idx);
                staticIdx++;
            }
            sec.insertBefore(tb, sec.firstChild);
        });
        addDropZones();
        initSortable();
    }

    function addDropZones() {
        const main = document.querySelector('main'); if (!main) return;
        main.querySelectorAll('.aie-dropzone').forEach(el => el.remove());
        const children = Array.from(main.children).filter(el => el.tagName === 'SECTION' || el.classList.contains('aie-dynamic-block'));
        const dzTop = createDropZone(-1);
        if (children.length > 0) main.insertBefore(dzTop, children[0]); else main.appendChild(dzTop);
        let sIdx = -1;
        children.forEach(sec => { if (!sec.classList.contains('aie-dynamic-block')) sIdx++; sec.after(createDropZone(sIdx)); });
    }

    function createDropZone(insertAfterIdx) {
        const dz = document.createElement('div'); dz.className = 'aie-dropzone'; dz.setAttribute('data-insert-after', insertAfterIdx);
        dz.innerHTML = `<div class="aie-dropzone-inner"><div class="aie-dropzone-line"></div><button class="aie-dropzone-btn" title="הוסף בלוק כאן">+</button><div class="aie-dropzone-line"></div></div>`;
        dz.querySelector('.aie-dropzone-btn').addEventListener('click', (e) => { e.stopPropagation(); blockPanelInsertAfter = parseInt(dz.getAttribute('data-insert-after')); openBlockPanel(); });
        return dz;
    }

    function aieBlockBuilderDeactivate() {
        const main = document.querySelector('main'); if (!main) return;
        main.querySelectorAll('.aie-section-toolbar, .aie-dropzone').forEach(el => el.remove());
        if (sortableInstance) { sortableInstance.destroy(); sortableInstance = null; }
        aieCloseBlockPanel(); aieCloseBlockModal();
    }

    function initSortable() {
        const main = document.querySelector('main'); if (!main || sortableInstance) return;
        sortableInstance = new Sortable(main, {
            animation: 200, handle: '.aie-section-toolbar', draggable: 'section, .aie-dynamic-block',
            ghostClass: 'sortable-ghost', chosenClass: 'sortable-chosen', filter: '.aie-dropzone',
            onEnd: async function() { await saveDynamicBlockOrder(); addDropZones(); aieRefreshNavigator(); }
        });
    }

    async function saveDynamicBlockOrder() {
        const main = document.querySelector('main'); if (!main) return;
        const children = Array.from(main.children).filter(el => el.tagName === 'SECTION' || el.classList.contains('aie-dynamic-block'));
        const orders = []; let sIdx = -1;
        children.forEach(el => { if (el.classList.contains('aie-dynamic-block')) { const bid = el.getAttribute('data-block-id'); if (bid) orders.push({ id: parseInt(bid), sort_order: orders.length, insert_after: sIdx }); } else sIdx++; });
        if (orders.length > 0) {
            try { await fetch(BASE + '/api/panel/blocks-reorder', { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ orders }) }); } catch (e) { aieToast('שגיאה בעדכון סדר', 'error'); }
        }
    }

    // ---- Block Panel ----
    function openBlockPanel() { document.getElementById('aieBlockPanel').classList.add('open'); }
    window.aieCloseBlockPanel = function() { document.getElementById('aieBlockPanel').classList.remove('open'); };
    document.querySelectorAll('.aie-block-type-card').forEach(card => { card.addEventListener('click', () => { aieCloseBlockPanel(); currentBlockEdit = null; showBlockForm(card.getAttribute('data-type'), null); }); });

    function aieCloseBlockModal() { document.getElementById('aieBlockModal').classList.remove('open'); }
    window.aieCloseBlockModal = aieCloseBlockModal;
    document.getElementById('aieBlockModal').addEventListener('click', e => { if (e.target === e.currentTarget) aieCloseBlockModal(); });

    function showBlockForm(type, existingData) {
        const modal = document.getElementById('aieBlockModal');
        const content = document.getElementById('aieBlockModalContent');
        const isEdit = !!existingData; const d = existingData || {};
        let title = BLOCK_TYPE_LABELS[type] || type, fields = '';

        switch (type) {
            case 'heading': fields = `<div class="aie-field"><label>טקסט</label><input type="text" id="aieBlkText" value="${escA(d.text)}"/></div><div class="aie-field"><label>גודל</label><select id="aieBlkLevel"><option value="h2" ${d.level==='h2'?'selected':''}>H2 - גדול</option><option value="h3" ${d.level==='h3'?'selected':''}>H3 - בינוני</option><option value="h4" ${d.level==='h4'?'selected':''}>H4 - קטן</option><option value="h1" ${d.level==='h1'?'selected':''}>H1 - ענק</option></select></div><div class="aie-field"><label>יישור</label><select id="aieBlkAlign"><option value="center" ${d.align==='center'?'selected':''}>מרכז</option><option value="right" ${d.align==='right'?'selected':''}>ימין</option><option value="left" ${d.align==='left'?'selected':''}>שמאל</option></select></div>`; break;
            case 'text': fields = `<div class="aie-field"><label>תוכן</label><textarea id="aieBlkContent" rows="5">${d.content||''}</textarea></div><div class="aie-field"><label>יישור</label><select id="aieBlkAlign"><option value="right" ${d.align==='right'||!d.align?'selected':''}>ימין</option><option value="center" ${d.align==='center'?'selected':''}>מרכז</option><option value="left" ${d.align==='left'?'selected':''}>שמאל</option></select></div>`; break;
            case 'image': fields = `<div class="aie-field"><label>תמונה</label><div class="aie-upload-row"><input type="text" id="aieBlkUrl" placeholder="URL" value="${escA(d.url)}"/><button type="button" class="aie-upload-btn" onclick="aieBlockUploadImg('aieBlkUrl')">העלה</button></div></div><div class="aie-field"><label>Alt</label><input type="text" id="aieBlkAlt" value="${escA(d.alt)}"/></div><div class="aie-field"><label>רוחב</label><select id="aieBlkWidth"><option value="large" ${d.width==='large'||!d.width?'selected':''}>גדול</option><option value="full" ${d.width==='full'?'selected':''}>מלא</option><option value="small" ${d.width==='small'?'selected':''}>קטן</option></select></div>`; break;
            case 'video': fields = `<div class="aie-field"><label>קישור (YouTube / Vimeo)</label><input type="url" id="aieBlkUrl" value="${escA(d.url)}"/></div>`; break;
            case 'image_text': fields = `<div class="aie-field"><label>כותרת</label><input type="text" id="aieBlkTitle" value="${escA(d.title)}"/></div><div class="aie-field"><label>טקסט</label><textarea id="aieBlkText" rows="4">${d.text||''}</textarea></div><div class="aie-field"><label>תמונה</label><div class="aie-upload-row"><input type="text" id="aieBlkImgUrl" value="${escA(d.image_url)}"/><button type="button" class="aie-upload-btn" onclick="aieBlockUploadImg('aieBlkImgUrl')">העלה</button></div></div><div class="aie-field"><label>מיקום תמונה</label><select id="aieBlkImgPos"><option value="right" ${d.image_position==='right'||!d.image_position?'selected':''}>ימין</option><option value="left" ${d.image_position==='left'?'selected':''}>שמאל</option></select></div>`; break;
            case 'cta': fields = `<div class="aie-field"><label>כותרת</label><input type="text" id="aieBlkTitle" value="${escA(d.title)}"/></div><div class="aie-field"><label>תת כותרת</label><input type="text" id="aieBlkSubtitle" value="${escA(d.subtitle)}"/></div><div class="aie-field"><label>טקסט כפתור</label><input type="text" id="aieBlkBtnText" value="${escA(d.button_text)}"/></div><div class="aie-field"><label>קישור כפתור</label><input type="text" id="aieBlkBtnUrl" value="${escA(d.button_url)}"/></div><div class="aie-field"><label>צבע רקע</label><select id="aieBlkBgColor"><option value="primary" ${d.bg_color==='primary'||!d.bg_color?'selected':''}>זהב</option><option value="dark" ${d.bg_color==='dark'?'selected':''}>כהה</option></select></div>`; break;
            case 'spacer': fields = `<div class="aie-field"><label>גובה (px)</label><input type="number" id="aieBlkHeight" value="${d.height||60}" min="10" max="300"/></div>`; break;
            case 'divider': fields = `<div class="aie-field"><label>סגנון</label><select id="aieBlkStyle"><option value="line" ${d.style==='line'||!d.style?'selected':''}>קו</option><option value="dots" ${d.style==='dots'?'selected':''}>נקודות</option></select></div>`; break;
            case 'gallery': const imgs = d.images||[]; fields = `<div class="aie-field"><label>עמודות</label><select id="aieBlkCols"><option value="2" ${d.columns==2?'selected':''}>2</option><option value="3" ${d.columns==3||!d.columns?'selected':''}>3</option><option value="4" ${d.columns==4?'selected':''}>4</option></select></div><div class="aie-field"><label>תמונות</label><div id="aieGalleryGrid" class="aie-gallery-grid">${imgs.map((img,i)=>`<div class="aie-gallery-item" data-idx="${i}"><img src="${typeof img==='string'?img:img.url}"/><button onclick="aieRemoveGalleryImg(this)">×</button></div>`).join('')}</div><button type="button" class="aie-upload-btn" style="margin-top:8px;width:100%" onclick="aieAddGalleryImg()">+ הוסף תמונה</button></div>`; break;
        }

        content.innerHTML = `<h3>${isEdit?'עריכת':'הוספת'} ${title}</h3>${fields}<div class="aie-block-modal-actions"><button class="aie-bm-save" id="aieBlockSaveBtn">${isEdit?'עדכן':'הוסף'}</button><button class="aie-bm-cancel" onclick="aieCloseBlockModal()">ביטול</button></div>`;
        content.setAttribute('data-block-type', type);
        modal.classList.add('open');
        document.getElementById('aieBlockSaveBtn').addEventListener('click', () => saveBlock(type));
    }

    function escA(s) { return (s||'').replace(/"/g, '&quot;').replace(/'/g, '&#39;'); }

    function collectBlockData(type) {
        const g = id => { const el = document.getElementById(id); return el ? el.value : ''; };
        switch (type) {
            case 'heading': return { text: g('aieBlkText'), level: g('aieBlkLevel'), align: g('aieBlkAlign') };
            case 'text': return { content: g('aieBlkContent'), align: g('aieBlkAlign') };
            case 'image': return { url: g('aieBlkUrl'), alt: g('aieBlkAlt'), width: g('aieBlkWidth') };
            case 'video': return { url: g('aieBlkUrl') };
            case 'image_text': return { title: g('aieBlkTitle'), text: g('aieBlkText'), image_url: g('aieBlkImgUrl'), image_position: g('aieBlkImgPos') };
            case 'cta': return { title: g('aieBlkTitle'), subtitle: g('aieBlkSubtitle'), button_text: g('aieBlkBtnText'), button_url: g('aieBlkBtnUrl'), bg_color: g('aieBlkBgColor') };
            case 'spacer': return { height: parseInt(g('aieBlkHeight')) || 60 };
            case 'divider': return { style: g('aieBlkStyle') };
            case 'gallery': const imgs = []; document.querySelectorAll('#aieGalleryGrid .aie-gallery-item img').forEach(img => imgs.push(img.src)); return { images: imgs, columns: parseInt(g('aieBlkCols')) || 3 };
            default: return {};
        }
    }

    async function saveBlock(type) {
        const blockData = collectBlockData(type);
        const btn = document.getElementById('aieBlockSaveBtn'); btn.disabled = true; btn.textContent = 'שומר...';
        try {
            if (currentBlockEdit) {
                const res = await fetch(BASE + '/api/panel/blocks/' + currentBlockEdit.id, { method: 'PUT', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ block_data: blockData, block_type: type }) });
                if (res.ok) { aieToast('בלוק עודכן!'); aieCloseBlockModal(); await reloadPageBlocks(); } else { const d = await res.json(); aieToast(d.error || 'שגיאה', 'error'); }
            } else {
                const res = await fetch(BASE + '/api/panel/blocks', { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ page_slug: CURRENT_PAGE, block_type: type, block_data: blockData, insert_after: blockPanelInsertAfter }) });
                if (res.ok) { aieToast('בלוק נוסף!'); aieCloseBlockModal(); await reloadPageBlocks(); } else { const d = await res.json(); aieToast(d.error || 'שגיאה', 'error'); }
            }
        } catch (e) { aieToast('שגיאה: ' + e.message, 'error'); }
        btn.disabled = false;
    }

    window.aieEditBlock = async function(blockId) {
        try { const res = await fetch(BASE + '/api/panel/blocks/' + blockId); const block = await res.json(); currentBlockEdit = block; showBlockForm(block.block_type, block.block_data); } catch (e) { aieToast('שגיאה', 'error'); }
    };
    window.aieDeleteBlock = async function(blockId) {
        if (!confirm('למחוק בלוק זה?')) return;
        try { const res = await fetch(BASE + '/api/panel/blocks/' + blockId, { method: 'DELETE' }); if (res.ok) { aieToast('בלוק נמחק'); await reloadPageBlocks(); } else aieToast('שגיאה', 'error'); } catch (e) { aieToast('שגיאה', 'error'); }
    };
    window.aieToggleSection = async function(btn, sectionIdx) {
        const key = CURRENT_PAGE + '_section_' + sectionIdx + '_hidden';
        const main = document.querySelector('main');
        const sec = main.querySelector(`[data-aie-section-idx="${sectionIdx}"]`);
        const isHidden = sec && sec.getAttribute('data-aie-hidden') === 'true';
        const newVal = isHidden ? '0' : '1';
        const ok = await aieSaveSetting(key, newVal);
        if (ok) {
            if (newVal === '1') { sec.setAttribute('data-aie-hidden', 'true'); btn.classList.remove('aie-tb-active'); btn.querySelector('span').textContent = 'visibility_off'; }
            else { sec.removeAttribute('data-aie-hidden'); sec.style.display = ''; btn.classList.add('aie-tb-active'); btn.querySelector('span').textContent = 'visibility'; }
            aieToast(newVal === '1' ? 'סקשן הוסתר' : 'סקשן מוצג');
            aieRefreshNavigator();
        }
    };

    window.aieBlockUploadImg = function(inputId) { const f = document.createElement('input'); f.type = 'file'; f.accept = 'image/*'; f.onchange = async function() { if (!f.files[0]) return; aieToast('מעלה...', 'success'); const url = await aieUploadImage(f.files[0]); if (url) document.getElementById(inputId).value = url; }; f.click(); };
    window.aieAddGalleryImg = function() { const f = document.createElement('input'); f.type = 'file'; f.accept = 'image/*'; f.multiple = true; f.onchange = async function() { for (const file of f.files) { const url = await aieUploadImage(file); if (url) { const grid = document.getElementById('aieGalleryGrid'); const item = document.createElement('div'); item.className = 'aie-gallery-item'; item.innerHTML = `<img src="${url}"/><button onclick="aieRemoveGalleryImg(this)">×</button>`; grid.appendChild(item); } } }; f.click(); };
    window.aieRemoveGalleryImg = function(btn) { if (typeof btn === 'number') { const items = document.querySelectorAll('#aieGalleryGrid .aie-gallery-item'); if (items[btn]) items[btn].remove(); } else btn.closest('.aie-gallery-item').remove(); };

    window.aieAddBlockFromNav = function(insertAfter) {
        blockPanelInsertAfter = insertAfter;
        openBlockPanel();
    };

    async function reloadPageBlocks() {
        const main = document.querySelector('main'); if (!main) return;
        main.querySelectorAll('.aie-dynamic-block').forEach(el => el.remove());
        main.querySelectorAll('.aie-section-toolbar, .aie-dropzone').forEach(el => el.remove());
        if (sortableInstance) { sortableInstance.destroy(); sortableInstance = null; }
        try {
            const res = await fetch(BASE + '/api/blocks?page=' + encodeURIComponent(CURRENT_PAGE));
            const blocks = await res.json();
            if (blocks.length) {
                const sections = Array.from(main.querySelectorAll(':scope > section'));
                const groups = {};
                blocks.forEach(b => { const k = b.insert_after !== null ? b.insert_after : -1; if (!groups[k]) groups[k] = []; groups[k].push(b); });
                if (groups[-1]) { const frag = document.createRange().createContextualFragment(groups[-1].map(b => window.aieRenderBlockHTML(b)).join('')); if (sections.length > 0) main.insertBefore(frag, sections[0]); else main.appendChild(frag); }
                let ss = Array.from(main.querySelectorAll(':scope > section:not(.aie-dynamic-block)'));
                ss.forEach((sec, i) => { if (groups[i]) { const frag = document.createRange().createContextualFragment(groups[i].map(b => window.aieRenderBlockHTML(b)).join('')); sec.after(frag); } });
            }
        } catch (e) { console.error('Error reloading blocks:', e); }
        if (editMode) { aieBlockBuilderActivate(); aieGlobalScan(); aieRefreshNavigator(); }
    }

    // ========== NAVIGATOR ==========
    function aieOpenNavigator() {
        document.getElementById('aieNavigator').classList.add('open');
        document.body.classList.add('aie-nav-open');
        aieRefreshNavigator();
        startMinimapTracker();
    }
    function aieCloseNavigator() {
        document.getElementById('aieNavigator').classList.remove('open');
        document.body.classList.remove('aie-nav-open');
        if (navSortableInstance) { navSortableInstance.destroy(); navSortableInstance = null; }
    }
    window.aieToggleNavigator = function() {
        const nav = document.getElementById('aieNavigator');
        if (nav.classList.contains('open')) aieCloseNavigator(); else aieOpenNavigator();
    };

    window.aieRefreshNavigator = function() {
        const list = document.getElementById('aieNavList');
        const minimapBar = document.getElementById('aieMinimapBar');
        const main = document.querySelector('main'); if (!main || !list) return;

        const children = Array.from(main.children).filter(el =>
            (el.tagName === 'SECTION' || el.classList.contains('aie-dynamic-block')) && !el.classList.contains('aie-dropzone')
        );

        let html = '';
        let mmHtml = '';
        let staticIdx = 0;

        children.forEach((sec, i) => {
            const isDynamic = sec.classList.contains('aie-dynamic-block');
            const blockId = sec.getAttribute('data-block-id');
            const isHidden = sec.getAttribute('data-aie-hidden') === 'true';
            const blockType = sec.getAttribute('data-block-id') ? (sec.querySelector('[class*="aspect-video"]') ? 'video' : 'heading') : null;

            let icon, label, typeName, cssClass;
            if (isDynamic) {
                // Try to detect block type from class or content
                const typeFromDB = sec.className.includes('aspect-video') ? 'video' : null;
                icon = 'widgets';
                label = sec.querySelector('h1,h2,h3,h4')?.textContent?.trim()?.substring(0,35) ||
                        sec.querySelector('p')?.textContent?.trim()?.substring(0,35) ||
                        sec.querySelector('img')?.alt || 'בלוק דינמי';
                typeName = 'בלוק דינמי';
                cssClass = 'dynamic';
            } else {
                icon = 'dashboard';
                label = getSectionLabel(sec);
                typeName = 'סקשן #' + (staticIdx + 1);
                cssClass = 'static';
                staticIdx++;
            }

            html += `<div class="aie-nav-item ${isHidden ? 'hidden-section' : ''}" data-nav-idx="${i}" data-block-id="${blockId || ''}" data-is-dynamic="${isDynamic}" onclick="aieNavScrollTo(${i})">
                <span class="aie-nav-drag"><span class="material-symbols-outlined" style="font-size:16px">drag_indicator</span></span>
                <div class="aie-nav-icon ${cssClass}"><span class="material-symbols-outlined" style="font-size:16px">${icon}</span></div>
                <div class="aie-nav-info"><div class="aie-nav-label">${label}</div><div class="aie-nav-type">${typeName}</div></div>
                <div class="aie-nav-actions">
                    ${isDynamic ? `<button onclick="event.stopPropagation();aieEditBlock(${blockId})" title="ערוך"><span class="material-symbols-outlined" style="font-size:14px">edit</span></button><button class="danger" onclick="event.stopPropagation();aieDeleteBlock(${blockId})" title="מחק"><span class="material-symbols-outlined" style="font-size:14px">delete</span></button>` : `<button onclick="event.stopPropagation();aieNavToggleVis(${i})" title="${isHidden?'הצג':'הסתר'}"><span class="material-symbols-outlined" style="font-size:14px">${isHidden?'visibility_off':'visibility'}</span></button>`}
                </div>
            </div>`;

            // Minimap
            const h = Math.max(4, Math.min(20, Math.round((sec.offsetHeight || 100) / 40)));
            mmHtml += `<div class="aie-nav-mm-block ${cssClass} ${isHidden?'hidden-mm':''}" style="height:${h}px" data-nav-idx="${i}" onclick="aieNavScrollTo(${i})"></div>`;
        });

        list.innerHTML = html;
        minimapBar.innerHTML = mmHtml;

        // Init SortableJS on navigator list
        if (navSortableInstance) navSortableInstance.destroy();
        navSortableInstance = new Sortable(list, {
            animation: 200, handle: '.aie-nav-drag', ghostClass: 'sortable-ghost',
            onEnd: async function(evt) {
                // Reorder actual DOM elements in main to match navigator order
                const items = Array.from(list.querySelectorAll('.aie-nav-item'));
                const main = document.querySelector('main');
                // Remove dropzones temporarily
                main.querySelectorAll('.aie-dropzone').forEach(el => el.remove());
                const allSections = Array.from(main.children).filter(el => el.tagName === 'SECTION' || el.classList.contains('aie-dynamic-block'));
                // Build new order map
                const newOrder = items.map(item => parseInt(item.getAttribute('data-nav-idx')));
                // Reorder DOM
                const frag = document.createDocumentFragment();
                newOrder.forEach(idx => {
                    if (allSections[idx]) frag.appendChild(allSections[idx]);
                });
                // Append remaining children that aren't sections (like scripts)
                const nonSections = Array.from(main.children).filter(el => el.tagName !== 'SECTION' && !el.classList.contains('aie-dynamic-block'));
                main.innerHTML = '';
                main.appendChild(frag);
                nonSections.forEach(el => main.appendChild(el));

                await saveDynamicBlockOrder();
                addDropZones();
                // Update nav-idx attributes
                const newItems = list.querySelectorAll('.aie-nav-item');
                newItems.forEach((item, i) => item.setAttribute('data-nav-idx', i));
                // Refresh minimap
                aieRefreshNavigator();
            }
        });

        updateMinimapIndicator();
    };

    window.aieNavScrollTo = function(idx) {
        const main = document.querySelector('main'); if (!main) return;
        const children = Array.from(main.children).filter(el => (el.tagName === 'SECTION' || el.classList.contains('aie-dynamic-block')) && !el.classList.contains('aie-dropzone'));
        if (children[idx]) {
            // Highlight
            document.querySelectorAll('.aie-section-active').forEach(el => el.classList.remove('aie-section-active'));
            children[idx].classList.add('aie-section-active');
            children[idx].scrollIntoView({ behavior: 'smooth', block: 'center' });
            // Highlight nav item
            document.querySelectorAll('.aie-nav-item.active').forEach(el => el.classList.remove('active'));
            const navItem = document.querySelector(`.aie-nav-item[data-nav-idx="${idx}"]`);
            if (navItem) navItem.classList.add('active');
            setTimeout(() => children[idx].classList.remove('aie-section-active'), 2000);
        }
    };

    window.aieNavToggleVis = function(idx) {
        const main = document.querySelector('main'); if (!main) return;
        const children = Array.from(main.children).filter(el => (el.tagName === 'SECTION' || el.classList.contains('aie-dynamic-block')) && !el.classList.contains('aie-dropzone'));
        const sec = children[idx]; if (!sec || sec.classList.contains('aie-dynamic-block')) return;
        const sIdx = sec.getAttribute('data-aie-section-idx');
        if (sIdx !== null) {
            const tb = sec.querySelector('.aie-section-toolbar button');
            if (tb) aieToggleSection(tb, parseInt(sIdx));
        }
    };

    // Minimap viewport indicator
    let mmTrackerRaf = null;
    function startMinimapTracker() {
        function update() {
            updateMinimapIndicator();
            if (document.getElementById('aieNavigator').classList.contains('open')) mmTrackerRaf = requestAnimationFrame(update);
        }
        if (mmTrackerRaf) cancelAnimationFrame(mmTrackerRaf);
        mmTrackerRaf = requestAnimationFrame(update);
    }

    function updateMinimapIndicator() {
        const viewport = document.getElementById('aieMinimapViewport');
        const indicator = document.getElementById('aieMinimapIndicator');
        const bar = document.getElementById('aieMinimapBar');
        if (!viewport || !bar || !bar.children.length) return;

        const pageH = document.documentElement.scrollHeight;
        const viewH = window.innerHeight;
        const scrollY = window.scrollY;
        const barH = bar.offsetHeight || 100;

        const ratio = barH / pageH;
        const top = scrollY * ratio;
        const height = viewH * ratio;

        indicator.style.top = Math.round(top) + 'px';
        indicator.style.height = Math.max(8, Math.round(height)) + 'px';
    }

    // Scroll sync: highlight active section in navigator
    let scrollTimer = null;
    window.addEventListener('scroll', () => {
        if (!editMode) return;
        clearTimeout(scrollTimer);
        scrollTimer = setTimeout(() => {
            const main = document.querySelector('main'); if (!main) return;
            const children = Array.from(main.children).filter(el => (el.tagName === 'SECTION' || el.classList.contains('aie-dynamic-block')) && !el.classList.contains('aie-dropzone'));
            const viewMid = window.scrollY + window.innerHeight / 2;
            let activeIdx = 0;
            children.forEach((sec, i) => {
                const rect = sec.getBoundingClientRect();
                const top = rect.top + window.scrollY;
                if (top < viewMid) activeIdx = i;
            });
            document.querySelectorAll('.aie-nav-item.active').forEach(el => el.classList.remove('active'));
            const navItem = document.querySelector(`.aie-nav-item[data-nav-idx="${activeIdx}"]`);
            if (navItem) { navItem.classList.add('active'); navItem.scrollIntoView({ block: 'nearest', behavior: 'smooth' }); }
        }, 100);
    });

})();
</script>
