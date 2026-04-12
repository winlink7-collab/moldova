/**
 * WhatsApp OTP Verification Widget
 */

function openWhatsappVerify(phone, onSuccess) {
    let modal = document.getElementById('waVerifyModal');
    if (modal) modal.remove();

    modal = document.createElement('div');
    modal.id = 'waVerifyModal';
    modal.className = 'fixed inset-0 z-[300] flex items-center justify-center bg-black/80 backdrop-blur-md p-4';
    modal.innerHTML = `
        <div class="relative w-full max-w-[440px] bg-gradient-to-b from-[#1a1810] to-[#12110a] border border-[#25D366]/30 rounded-3xl shadow-2xl p-6 sm:p-8" style="box-shadow: 0 0 60px rgba(37,211,102,0.2);">
            <button onclick="document.getElementById('waVerifyModal').remove()" class="absolute top-3 left-3 text-slate-400 hover:text-white p-1">
                <span class="material-symbols-outlined text-xl">close</span>
            </button>

            <!-- Step 1: Send OTP -->
            <div id="waStep1" class="text-center">
                <div class="relative mx-auto mb-6 w-20 h-20">
                    <div class="absolute inset-0 rounded-full bg-[#25D366]/20 animate-ping"></div>
                    <div class="relative w-20 h-20 rounded-full bg-gradient-to-br from-[#25D366] to-[#128C7E] flex items-center justify-center">
                        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    </div>
                </div>
                <h2 class="text-2xl font-black text-white mb-2">אימות בוואטסאפ</h2>
                <p class="text-slate-400 text-sm mb-5">נשלח לך קוד אימות בוואטסאפ למספר:</p>
                <p class="text-[#25D366] text-xl font-bold mb-6" dir="ltr">${phone}</p>
                <div id="waError1" class="hidden text-red-400 text-sm mb-4"></div>
                <button id="waSendBtn" onclick="waSendOtp('${phone}')" class="w-full bg-gradient-to-r from-[#25D366] to-[#128C7E] hover:brightness-110 text-white font-black py-3.5 rounded-xl text-base transition-all shadow-lg">
                    שלח לי קוד בוואטסאפ
                </button>
                <button onclick="document.getElementById('waVerifyModal').remove()" class="mt-3 text-slate-400 text-sm hover:text-white">ביטול</button>
            </div>

            <!-- Step 2: Enter OTP -->
            <div id="waStep2" class="text-center hidden">
                <div class="mx-auto mb-6 w-20 h-20 rounded-full bg-gradient-to-br from-primary to-[#b89b06] flex items-center justify-center">
                    <span class="material-symbols-outlined text-background-dark text-4xl" style="font-variation-settings:'FILL' 1">pin</span>
                </div>
                <h2 class="text-2xl font-black text-white mb-2">הזן את הקוד</h2>
                <p class="text-slate-400 text-sm mb-5">הקוד נשלח לוואטסאפ שלך</p>
                <div class="flex gap-2 justify-center mb-4" dir="ltr">
                    <input type="text" maxlength="1" class="wa-otp-input w-12 h-14 bg-[#0f0e08] border-2 border-white/10 rounded-lg text-white text-center text-2xl font-black focus:border-[#25D366] outline-none" data-index="0"/>
                    <input type="text" maxlength="1" class="wa-otp-input w-12 h-14 bg-[#0f0e08] border-2 border-white/10 rounded-lg text-white text-center text-2xl font-black focus:border-[#25D366] outline-none" data-index="1"/>
                    <input type="text" maxlength="1" class="wa-otp-input w-12 h-14 bg-[#0f0e08] border-2 border-white/10 rounded-lg text-white text-center text-2xl font-black focus:border-[#25D366] outline-none" data-index="2"/>
                    <input type="text" maxlength="1" class="wa-otp-input w-12 h-14 bg-[#0f0e08] border-2 border-white/10 rounded-lg text-white text-center text-2xl font-black focus:border-[#25D366] outline-none" data-index="3"/>
                    <input type="text" maxlength="1" class="wa-otp-input w-12 h-14 bg-[#0f0e08] border-2 border-white/10 rounded-lg text-white text-center text-2xl font-black focus:border-[#25D366] outline-none" data-index="4"/>
                    <input type="text" maxlength="1" class="wa-otp-input w-12 h-14 bg-[#0f0e08] border-2 border-white/10 rounded-lg text-white text-center text-2xl font-black focus:border-[#25D366] outline-none" data-index="5"/>
                </div>
                <div id="waError2" class="hidden text-red-400 text-sm mb-4"></div>
                <button onclick="waVerifyCode('${phone}')" class="w-full bg-gradient-to-r from-primary to-[#b89b06] hover:brightness-110 text-background-dark font-black py-3.5 rounded-xl text-base transition-all shadow-lg">
                    אמת קוד
                </button>
                <button onclick="waBackToStep1()" class="mt-3 text-slate-400 text-sm hover:text-[#25D366]">לא קיבלת? שלח שוב</button>
            </div>
        </div>
    `;
    document.body.appendChild(modal);

    // Save callback
    window._waOnSuccess = onSuccess || function(){};

    // OTP input behavior
    setTimeout(() => {
        document.querySelectorAll('.wa-otp-input').forEach((input, i, arr) => {
            input.addEventListener('input', (e) => {
                if (e.target.value && i < arr.length - 1) arr[i+1].focus();
            });
            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !e.target.value && i > 0) arr[i-1].focus();
            });
            input.addEventListener('paste', (e) => {
                e.preventDefault();
                const pasted = (e.clipboardData || window.clipboardData).getData('text').replace(/\D/g, '').slice(0, 6);
                pasted.split('').forEach((ch, idx) => { if (arr[idx]) arr[idx].value = ch; });
                if (arr[Math.min(pasted.length, 5)]) arr[Math.min(pasted.length, 5)].focus();
            });
        });
    }, 100);
}

async function waSendOtp(phone) {
    const btn = document.getElementById('waSendBtn');
    const err = document.getElementById('waError1');
    btn.disabled = true;
    btn.textContent = 'שולח...';
    err.classList.add('hidden');

    try {
        const res = await fetch(BASE + '/api/send-whatsapp-otp', {
            method: 'POST',
            headers: {'Content-Type':'application/json'},
            body: JSON.stringify({phone: phone})
        });
        const data = await res.json();

        if (res.ok) {
            document.getElementById('waStep1').classList.add('hidden');
            document.getElementById('waStep2').classList.remove('hidden');
            document.querySelector('.wa-otp-input[data-index="0"]').focus();
        } else {
            err.textContent = data.error || 'שגיאה בשליחה';
            err.classList.remove('hidden');
            btn.disabled = false;
            btn.textContent = 'שלח לי קוד בוואטסאפ';
        }
    } catch(e) {
        err.textContent = 'שגיאת רשת';
        err.classList.remove('hidden');
        btn.disabled = false;
        btn.textContent = 'שלח לי קוד בוואטסאפ';
    }
}

async function waVerifyCode(phone) {
    const inputs = document.querySelectorAll('.wa-otp-input');
    const code = Array.from(inputs).map(i => i.value).join('');
    const err = document.getElementById('waError2');

    if (code.length !== 6) {
        err.textContent = 'אנא הזן 6 ספרות';
        err.classList.remove('hidden');
        return;
    }

    try {
        const res = await fetch(BASE + '/api/verify-whatsapp-otp', {
            method: 'POST',
            headers: {'Content-Type':'application/json'},
            body: JSON.stringify({phone: phone, code: code})
        });
        const data = await res.json();

        if (res.ok) {
            if (data.user) localStorage.setItem('user', JSON.stringify(data.user));
            document.getElementById('waVerifyModal').remove();
            if (window._waOnSuccess) window._waOnSuccess(data);
        } else {
            err.textContent = data.error || 'קוד שגוי';
            err.classList.remove('hidden');
            inputs.forEach(i => i.value = '');
            inputs[0].focus();
        }
    } catch(e) {
        err.textContent = 'שגיאת רשת';
        err.classList.remove('hidden');
    }
}

function waBackToStep1() {
    document.getElementById('waStep1').classList.remove('hidden');
    document.getElementById('waStep2').classList.add('hidden');
    const btn = document.getElementById('waSendBtn');
    btn.disabled = false;
    btn.textContent = 'שלח לי קוד בוואטסאפ';
}
