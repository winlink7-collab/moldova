<!DOCTYPE html>
<html class="dark" dir="rtl" lang="he">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>כניסת מנהל - Moldova & Ukraine</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#f2d00d",
                        "bg": "#0f0e08",
                        "card": "#1a1810",
                    },
                    fontFamily: { "display": ["Heebo", "sans-serif"] },
                },
            },
        }
    </script>
    <style>body { font-family: 'Heebo', sans-serif; }</style>
</head>
<body class="bg-bg text-white min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="flex flex-col items-center mb-8">
            <div class="w-20 h-20 bg-primary/20 rounded-full flex items-center justify-center mb-4">
                <span class="material-symbols-outlined text-primary text-5xl">admin_panel_settings</span>
            </div>
            <h1 class="text-3xl font-bold text-primary">פאנל ניהול</h1>
            <p class="text-gray-400 mt-1">Moldova & Ukraine Brides</p>
        </div>

        <!-- Login Card -->
        <div class="bg-card border border-primary/20 rounded-2xl p-8">
            <form id="loginForm" class="space-y-6">
                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2" for="email">אימייל</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-gray-500">email</span>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            required
                            placeholder="admin@example.com"
                            class="w-full bg-bg border border-primary/20 rounded-xl pr-11 pl-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-primary/50 focus:ring-1 focus:ring-primary/50 transition-colors"
                        />
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2" for="password">סיסמה</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-gray-500">lock</span>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            required
                            placeholder="••••••••"
                            class="w-full bg-bg border border-primary/20 rounded-xl pr-11 pl-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-primary/50 focus:ring-1 focus:ring-primary/50 transition-colors"
                        />
                    </div>
                </div>

                <!-- Error Message -->
                <div id="errorMessage" class="hidden bg-red-500/10 border border-red-500/30 text-red-400 rounded-xl px-4 py-3 text-sm text-center"></div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    id="submitBtn"
                    class="w-full bg-primary text-bg font-bold py-3 rounded-xl hover:bg-primary/90 transition-colors text-lg"
                >
                    כניסה
                </button>
            </form>
        </div>

        <!-- Back to site -->
        <div class="text-center mt-6">
            <a id="backLink" href="/moldova" class="text-gray-400 hover:text-primary transition-colors text-sm inline-flex items-center gap-1">
                <span class="material-symbols-outlined text-base">arrow_forward</span>
                חזרה לאתר
            </a>
        </div>
    </div>

    <script>
        const BASE_URL = '<?= BASE_URL ?>';

        document.getElementById('backLink').href = BASE_URL;

        document.getElementById('loginForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const errorDiv = document.getElementById('errorMessage');
            const submitBtn = document.getElementById('submitBtn');
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            errorDiv.classList.add('hidden');
            errorDiv.textContent = '';
            submitBtn.disabled = true;
            submitBtn.textContent = '...מתחבר';

            try {
                const response = await fetch(`${BASE_URL}/api/admin/login`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ email, password })
                });

                const data = await response.json();

                if (response.ok) {
                    window.location.href = `${BASE_URL}/admin`;
                } else {
                    errorDiv.textContent = data.error || 'שגיאה בהתחברות. נסה שנית.';
                    errorDiv.classList.remove('hidden');
                }
            } catch (err) {
                errorDiv.textContent = 'שגיאת תקשורת. נסה שנית.';
                errorDiv.classList.remove('hidden');
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = 'כניסה';
            }
        });
    </script>

</body>
</html>
