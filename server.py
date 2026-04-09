from flask import Flask, request, jsonify, send_file, send_from_directory, session, redirect
import pymysql
import pymysql.cursors
from datetime import datetime, timedelta
import hashlib
import json
import os
import uuid
import smtplib
import secrets
from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart
import threading

app = Flask(__name__)
app.secret_key = secrets.token_hex(32)

UPLOAD_FOLDER = os.path.join(os.path.dirname(__file__), 'uploads')
os.makedirs(UPLOAD_FOLDER, exist_ok=True)

DB_CONFIG = {
    'host': 'localhost',
    'user': 'root',
    'password': '',
    'database': 'moldova_brides',
    'charset': 'utf8mb4',
}


def get_db():
    conn = pymysql.connect(**DB_CONFIG, cursorclass=pymysql.cursors.DictCursor)
    with conn.cursor() as cur:
        cur.execute("SET NAMES utf8mb4")
    return conn


# ============ Pages ============

@app.route('/')
def index():
    return send_file('code.html')


@app.route('/search')
def search_page():
    return send_file('event.html')


@app.route('/stories')
def stories_page():
    return send_file('story.html')


@app.route('/about')
def about_page():
    return send_file('about.html')


@app.route('/process')
def process_page():
    return send_file('process.html')


@app.route('/faq')
def faq_page():
    return send_file('answers.html')


@app.route('/contact')
def contact_page():
    return send_file('Contact.html')


@app.route('/vip')
def vip_page():
    return send_file('vip.html')


@app.route('/dashboard')
def dashboard_page():
    return send_file('dashboard.html')


@app.route('/profile/<int:profile_id>')
def profile_page(profile_id):
    return send_file('profil.html')


# ============ Uploads ============

@app.route('/uploads/<path:filename>')
def serve_upload(filename):
    return send_from_directory(UPLOAD_FOLDER, filename)


@app.route('/api/upload', methods=['POST'])
def upload_file():
    if 'file' not in request.files:
        return jsonify({'error': 'לא נבחר קובץ'}), 400
    f = request.files['file']
    if not f.filename:
        return jsonify({'error': 'לא נבחר קובץ'}), 400
    ext = f.filename.rsplit('.', 1)[-1].lower() if '.' in f.filename else 'jpg'
    if ext not in ('jpg', 'jpeg', 'png', 'gif', 'webp', 'jfif', 'bmp', 'tiff', 'svg', 'ico', 'avif'):
        return jsonify({'error': 'סוג קובץ לא נתמך'}), 400
    filename = f"{uuid.uuid4().hex}.{ext}"
    f.save(os.path.join(UPLOAD_FOLDER, filename))
    return jsonify({'success': True, 'url': f'/uploads/{filename}'})


@app.route('/admin')
def admin_page():
    if not session.get('admin_logged_in'):
        return send_file('admin_login.html')
    return send_file('admin.html')


@app.route('/api/admin/login', methods=['POST'])
def admin_login():
    d = request.get_json()
    email = d.get('email', '').strip()
    password = d.get('password', '')
    conn = get_db()
    cursor = conn.cursor()
    cursor.execute('SELECT id, password_hash FROM admin_users WHERE email = %s', (email,))
    admin = cursor.fetchone()
    cursor.close()
    conn.close()
    if not admin or admin['password_hash'] != hash_password(password):
        return jsonify({'error': 'אימייל או סיסמה שגויים'}), 401
    session['admin_logged_in'] = True
    session['admin_id'] = admin['id']
    return jsonify({'success': True})


@app.route('/api/admin/logout', methods=['POST'])
def admin_logout():
    session.clear()
    return jsonify({'success': True})


@app.route('/page/<slug>')
def custom_page(slug):
    conn = get_db()
    cursor = conn.cursor()
    cursor.execute('SELECT * FROM pages WHERE slug = %s AND is_active = TRUE', (slug,))
    page = cursor.fetchone()
    cursor.close()
    conn.close()
    if not page:
        return 'דף לא נמצא', 404
    template = '''<!DOCTYPE html>
<html class="dark" dir="rtl" lang="he"><head>
<meta charset="utf-8"/><meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<title>''' + page['title'] + ''' - Moldova & Ukraine</title>
<script>tailwind.config={darkMode:"class",theme:{extend:{colors:{"primary":"#f2d00d","background-dark":"#12110a","accent-dark":"#221f10","gold-muted":"#bab59c"},fontFamily:{"display":["Manrope","sans-serif"]}}}}</script>
<style>body{font-family:'Manrope',sans-serif}.glass-effect{background:rgba(34,31,16,0.8);backdrop-filter:blur(12px)}</style>
</head><body class="bg-[#12110a] text-slate-100 min-h-screen">
<header class="sticky top-0 z-50 w-full border-b border-white/10 glass-effect">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"><div class="flex h-20 items-center justify-between">
<a href="/" class="flex items-center gap-3"><div class="size-10 bg-[#f2d00d] rounded-full flex items-center justify-center"><span class="material-symbols-outlined text-[#12110a] text-2xl">workspace_premium</span></div>
<div class="flex flex-col"><h1 class="text-xl font-extrabold text-white uppercase">Moldova & Ukraine</h1><span class="text-[10px] tracking-[0.3em] text-[#f2d00d] font-bold uppercase">Luxury Brides</span></div></a>
<nav class="hidden md:flex items-center gap-10">
<a class="text-sm font-semibold text-slate-100 hover:text-[#f2d00d] transition-colors" href="/">דף הבית</a>
<a class="text-sm font-semibold text-slate-100 hover:text-[#f2d00d] transition-colors" href="/search">חיפוש</a>
</nav></div></div></header>
<main class="max-w-5xl mx-auto px-4 py-16">''' + page['content'] + '''</main>
</body></html>'''
    return template


# ============ Auth helpers ============

def hash_password(password):
    return hashlib.sha256(password.encode('utf-8')).hexdigest()


def require_admin():
    """Returns error response if not admin, None if OK"""
    if not session.get('admin_logged_in'):
        return jsonify({'error': 'נדרשת הרשאת מנהל'}), 401
    return None


@app.before_request
def check_admin_routes():
    """Protect all /api/admin/* routes except login and settings GET"""
    if request.path.startswith('/api/admin/') and request.path != '/api/admin/login':
        # Allow GET settings for public pages (footer etc)
        if request.path == '/api/admin/settings' and request.method == 'GET':
            return None
        if not session.get('admin_logged_in'):
            return jsonify({'error': 'נדרשת הרשאת מנהל'}), 401


def get_smtp_settings():
    try:
        conn = get_db()
        cursor = conn.cursor()
        cursor.execute("SELECT setting_key, setting_value FROM site_settings WHERE setting_key LIKE 'smtp_%'")
        rows = cursor.fetchall()
        cursor.close()
        conn.close()
        return {r['setting_key']: r['setting_value'] for r in rows}
    except:
        return {}


def send_email(to_email, subject, html_body):
    """Send email in background thread"""
    def _send():
        try:
            smtp = get_smtp_settings()
            host = smtp.get('smtp_host', '')
            port = int(smtp.get('smtp_port', '587'))
            user = smtp.get('smtp_user', '')
            password = smtp.get('smtp_password', '')
            from_name = smtp.get('smtp_from_name', 'Moldova & Ukraine Brides')

            if not host or not user or not password:
                print(f'[EMAIL] SMTP not configured. Would send to {to_email}: {subject}')
                return

            msg = MIMEMultipart('alternative')
            msg['Subject'] = subject
            msg['From'] = f'{from_name} <{user}>'
            msg['To'] = to_email
            msg.attach(MIMEText(html_body, 'html', 'utf-8'))

            with smtplib.SMTP(host, port) as server:
                server.starttls()
                server.login(user, password)
                server.sendmail(user, to_email, msg.as_string())
            print(f'[EMAIL] Sent to {to_email}: {subject}')
        except Exception as e:
            print(f'[EMAIL ERROR] {e}')

    threading.Thread(target=_send, daemon=True).start()


def send_welcome_email(full_name, email, password):
    html = f'''
    <div dir="rtl" style="font-family:Arial,sans-serif;max-width:600px;margin:0 auto;background:#12110a;color:#f8f8f5;padding:40px;border-radius:12px;">
        <div style="text-align:center;margin-bottom:30px;">
            <h1 style="color:#f2d00d;font-size:28px;margin:0;">Moldova & Ukraine</h1>
            <p style="color:#f2d00d;font-size:12px;letter-spacing:3px;margin:5px 0 0;">LUXURY BRIDES</p>
        </div>
        <h2 style="color:#fff;text-align:center;">ברוך הבא, {full_name}!</h2>
        <p style="color:#bab59c;text-align:center;font-size:16px;">החשבון שלך נוצר בהצלחה. הנה פרטי הגישה שלך:</p>
        <div style="background:#1c1a0e;border:1px solid rgba(242,208,13,0.2);border-radius:8px;padding:20px;margin:20px 0;">
            <table style="width:100%;border-collapse:collapse;">
                <tr><td style="color:#bab59c;padding:8px 0;">שם משתמש (אימייל):</td><td style="color:#fff;font-weight:bold;padding:8px 0;">{email}</td></tr>
                <tr><td style="color:#bab59c;padding:8px 0;">סיסמה:</td><td style="color:#f2d00d;font-weight:bold;padding:8px 0;font-size:18px;">{password}</td></tr>
            </table>
        </div>
        <p style="color:#bab59c;text-align:center;font-size:14px;">מומלץ לשמור את הפרטים במקום בטוח.</p>
        <div style="text-align:center;margin-top:30px;">
            <p style="color:#666;font-size:12px;">© Moldova & Ukraine Brides Luxury Matchmaking</p>
        </div>
    </div>
    '''
    send_email(email, 'ברוך הבא - פרטי הגישה שלך', html)


def send_password_changed_email(full_name, email, new_password):
    html = f'''
    <div dir="rtl" style="font-family:Arial,sans-serif;max-width:600px;margin:0 auto;background:#12110a;color:#f8f8f5;padding:40px;border-radius:12px;">
        <div style="text-align:center;margin-bottom:30px;">
            <h1 style="color:#f2d00d;font-size:28px;margin:0;">Moldova & Ukraine</h1>
            <p style="color:#f2d00d;font-size:12px;letter-spacing:3px;margin:5px 0 0;">LUXURY BRIDES</p>
        </div>
        <h2 style="color:#fff;text-align:center;">שלום {full_name},</h2>
        <p style="color:#bab59c;text-align:center;font-size:16px;">הסיסמה שלך עודכנה על ידי מנהל המערכת.</p>
        <div style="background:#1c1a0e;border:1px solid rgba(242,208,13,0.2);border-radius:8px;padding:20px;margin:20px 0;">
            <table style="width:100%;border-collapse:collapse;">
                <tr><td style="color:#bab59c;padding:8px 0;">שם משתמש (אימייל):</td><td style="color:#fff;font-weight:bold;padding:8px 0;">{email}</td></tr>
                <tr><td style="color:#bab59c;padding:8px 0;">סיסמה חדשה:</td><td style="color:#f2d00d;font-weight:bold;padding:8px 0;font-size:18px;">{new_password}</td></tr>
            </table>
        </div>
        <p style="color:#bab59c;text-align:center;font-size:14px;">מומלץ להחליף את הסיסמה בכניסה הבאה.</p>
        <div style="text-align:center;margin-top:30px;">
            <p style="color:#666;font-size:12px;">© Moldova & Ukraine Brides Luxury Matchmaking</p>
        </div>
    </div>
    '''
    send_email(email, 'הסיסמה שלך עודכנה', html)


def send_reset_email(full_name, email, token):
    reset_link = f'http://localhost:3000/dashboard?reset={token}'
    html = f'''
    <div dir="rtl" style="font-family:Arial,sans-serif;max-width:600px;margin:0 auto;background:#12110a;color:#f8f8f5;padding:40px;border-radius:12px;">
        <div style="text-align:center;margin-bottom:30px;">
            <h1 style="color:#f2d00d;font-size:28px;margin:0;">Moldova & Ukraine</h1>
            <p style="color:#f2d00d;font-size:12px;letter-spacing:3px;margin:5px 0 0;">LUXURY BRIDES</p>
        </div>
        <h2 style="color:#fff;text-align:center;">שלום {full_name},</h2>
        <p style="color:#bab59c;text-align:center;font-size:16px;">קיבלנו בקשה לאיפוס הסיסמה שלך.</p>
        <div style="text-align:center;margin:30px 0;">
            <a href="{reset_link}" style="display:inline-block;background:#f2d00d;color:#12110a;padding:15px 40px;border-radius:8px;font-weight:bold;font-size:18px;text-decoration:none;">איפוס סיסמה</a>
        </div>
        <p style="color:#bab59c;text-align:center;font-size:14px;">הקישור תקף לשעה אחת בלבד.</p>
        <p style="color:#666;text-align:center;font-size:12px;">אם לא ביקשת לאפס את הסיסמה, התעלם ממייל זה.</p>
        <div style="text-align:center;margin-top:30px;">
            <p style="color:#666;font-size:12px;">© Moldova & Ukraine Brides Luxury Matchmaking</p>
        </div>
    </div>
    '''
    send_email(email, 'איפוס סיסמה', html)


# ============ API: Auth ============

@app.route('/api/register', methods=['POST'])
def register():
    data = request.get_json()
    full_name = data.get('full_name', '').strip()
    email = data.get('email', '').strip()
    password = data.get('password', '')
    age = data.get('age')
    phone = data.get('phone', '').strip() if data.get('phone') else None

    if not full_name or not email or not password:
        return jsonify({'error': 'שם, אימייל וסיסמה הם שדות חובה'}), 400

    if len(password) < 6:
        return jsonify({'error': 'הסיסמה חייבת להכיל לפחות 6 תווים'}), 400

    conn = get_db()
    cursor = conn.cursor()

    # Check if email exists
    cursor.execute('SELECT id FROM users WHERE email = %s', (email,))
    if cursor.fetchone():
        cursor.close()
        conn.close()
        return jsonify({'error': 'אימייל זה כבר רשום במערכת'}), 400

    cursor.execute(
        'INSERT INTO users (full_name, email, password_hash, age, phone) VALUES (%s, %s, %s, %s, %s)',
        (full_name, email, hash_password(password), age, phone)
    )
    conn.commit()
    user_id = cursor.lastrowid
    cursor.close()
    conn.close()

    # Send welcome email with credentials
    send_welcome_email(full_name, email, password)

    return jsonify({
        'success': True,
        'user': {'id': user_id, 'full_name': full_name, 'email': email}
    })


@app.route('/api/login', methods=['POST'])
def login():
    data = request.get_json()
    email = data.get('email', '').strip()
    password = data.get('password', '')

    if not email or not password:
        return jsonify({'error': 'אימייל וסיסמה הם שדות חובה'}), 400

    conn = get_db()
    cursor = conn.cursor()
    cursor.execute(
        'SELECT id, full_name, email, password_hash FROM users WHERE email = %s AND is_active = TRUE',
        (email,)
    )
    user = cursor.fetchone()
    cursor.close()
    conn.close()

    if not user or user['password_hash'] != hash_password(password):
        return jsonify({'error': 'אימייל או סיסמה שגויים'}), 401

    return jsonify({
        'success': True,
        'user': {'id': user['id'], 'full_name': user['full_name'], 'email': user['email']}
    })


# ============ API: User Profile (Dashboard) ============

@app.route('/api/user/profile', methods=['GET'])
def get_user_profile():
    user_id = request.args.get('user_id', type=int)
    if not user_id:
        return jsonify({'error': 'חסר מזהה משתמש'}), 400
    conn = get_db()
    cursor = conn.cursor()
    cursor.execute('SELECT id, full_name, email, phone, age, city, country, profile_image, is_vip, created_at FROM users WHERE id = %s', (user_id,))
    user = cursor.fetchone()
    if not user:
        cursor.close(); conn.close()
        return jsonify({'error': 'משתמש לא נמצא'}), 404
    # Get user's messages
    cursor.execute('''SELECT m.*, p.first_name as profile_name, p.main_image as profile_image_url
        FROM messages m LEFT JOIN profiles p ON m.receiver_profile_id = p.id
        WHERE m.sender_user_id = %s ORDER BY m.created_at DESC''', (user_id,))
    messages = cursor.fetchall()
    cursor.close(); conn.close()
    user = fix_dates(user)
    user['messages'] = [fix_dates(m) for m in messages]
    return jsonify(user)


@app.route('/api/user/profile', methods=['PUT'])
def update_user_profile():
    d = request.get_json()
    user_id = d.get('user_id')
    if not user_id:
        return jsonify({'error': 'חסר מזהה משתמש'}), 400
    conn = get_db()
    cursor = conn.cursor()
    cursor.execute('SELECT id FROM users WHERE id = %s', (user_id,))
    if not cursor.fetchone():
        cursor.close(); conn.close()
        return jsonify({'error': 'משתמש לא נמצא'}), 404
    cursor.execute('''UPDATE users SET full_name=%s, phone=%s, age=%s, city=%s, country=%s, profile_image=%s WHERE id=%s''',
        (d.get('full_name', ''), d.get('phone', ''), d.get('age'), d.get('city', ''), d.get('country', 'ישראל'), d.get('profile_image', ''), user_id))
    conn.commit()
    cursor.close(); conn.close()
    return jsonify({'success': True})


@app.route('/api/user/change-password', methods=['POST'])
def change_password():
    d = request.get_json()
    user_id = d.get('user_id')
    current_password = d.get('current_password', '')
    new_password = d.get('new_password', '')
    if not user_id or not current_password or not new_password:
        return jsonify({'error': 'כל השדות הם חובה'}), 400
    if len(new_password) < 6:
        return jsonify({'error': 'הסיסמה חייבת להכיל לפחות 6 תווים'}), 400
    conn = get_db()
    cursor = conn.cursor()
    cursor.execute('SELECT password_hash FROM users WHERE id = %s', (user_id,))
    user = cursor.fetchone()
    if not user:
        cursor.close(); conn.close()
        return jsonify({'error': 'משתמש לא נמצא'}), 404
    if user['password_hash'] != hash_password(current_password):
        cursor.close(); conn.close()
        return jsonify({'error': 'הסיסמה הנוכחית שגויה'}), 400
    cursor.execute('UPDATE users SET password_hash = %s WHERE id = %s', (hash_password(new_password), user_id))
    conn.commit()
    cursor.close(); conn.close()
    return jsonify({'success': True})


@app.route('/api/forgot-password', methods=['POST'])
def forgot_password():
    d = request.get_json()
    email = d.get('email', '').strip()
    if not email:
        return jsonify({'error': 'נא להזין אימייל'}), 400
    conn = get_db()
    cursor = conn.cursor()
    cursor.execute('SELECT id, full_name FROM users WHERE email = %s AND is_active = TRUE', (email,))
    user = cursor.fetchone()
    if not user:
        cursor.close(); conn.close()
        # Don't reveal if email exists
        return jsonify({'success': True, 'message': 'אם האימייל קיים במערכת, נשלח אליך קישור לאיפוס סיסמה'})
    # Generate token
    token = secrets.token_urlsafe(32)
    expires_at = datetime.now() + timedelta(hours=1)
    cursor.execute('''INSERT INTO password_resets (user_id, token, expires_at) VALUES (%s, %s, %s)''',
        (user['id'], token, expires_at))
    conn.commit()
    cursor.close(); conn.close()
    # Send reset email
    send_reset_email(user['full_name'], email, token)
    return jsonify({'success': True, 'message': 'אם האימייל קיים במערכת, נשלח אליך קישור לאיפוס סיסמה'})


@app.route('/api/reset-password', methods=['POST'])
def reset_password():
    d = request.get_json()
    token = d.get('token', '').strip()
    new_password = d.get('new_password', '')
    if not token or not new_password:
        return jsonify({'error': 'חסרים נתונים'}), 400
    if len(new_password) < 6:
        return jsonify({'error': 'הסיסמה חייבת להכיל לפחות 6 תווים'}), 400
    conn = get_db()
    cursor = conn.cursor()
    cursor.execute('SELECT user_id, expires_at FROM password_resets WHERE token = %s AND used = FALSE', (token,))
    reset = cursor.fetchone()
    if not reset:
        cursor.close(); conn.close()
        return jsonify({'error': 'קישור לא תקין או שפג תוקפו'}), 400
    if reset['expires_at'] < datetime.now():
        cursor.close(); conn.close()
        return jsonify({'error': 'פג תוקף הקישור. נא לבקש איפוס חדש'}), 400
    cursor.execute('UPDATE users SET password_hash = %s WHERE id = %s', (hash_password(new_password), reset['user_id']))
    cursor.execute('UPDATE password_resets SET used = TRUE WHERE token = %s', (token,))
    conn.commit()
    cursor.close(); conn.close()
    return jsonify({'success': True})


# ============ API: Leads ============

@app.route('/api/leads', methods=['POST'])
def create_lead():
    data = request.get_json()
    full_name = data.get('full_name', '').strip()
    email = data.get('email', '').strip()
    age = data.get('age')
    interest = data.get('interest', '').strip()

    if not full_name or not email:
        return jsonify({'error': 'שם מלא ואימייל הם שדות חובה'}), 400

    conn = get_db()
    cursor = conn.cursor()
    cursor.execute(
        'INSERT INTO leads (full_name, age, email, interest) VALUES (%s, %s, %s, %s)',
        (full_name, age, email, interest)
    )
    conn.commit()
    lead_id = cursor.lastrowid
    cursor.close()
    conn.close()
    return jsonify({'success': True, 'id': lead_id})


@app.route('/api/contact', methods=['POST'])
def contact_submit():
    data = request.get_json()
    full_name = data.get('full_name', '').strip()
    phone = data.get('phone', '').strip()
    email = data.get('email', '').strip()
    message = data.get('message', '').strip()

    if not full_name or not phone:
        return jsonify({'error': 'שם וטלפון הם שדות חובה'}), 400

    conn = get_db()
    cursor = conn.cursor()
    cursor.execute(
        'INSERT INTO leads (full_name, email, interest) VALUES (%s, %s, %s)',
        (full_name, email or phone, f'טלפון: {phone}\n{message}')
    )
    conn.commit()
    lead_id = cursor.lastrowid
    cursor.close()
    conn.close()
    return jsonify({'success': True, 'id': lead_id})


@app.route('/api/leads', methods=['GET'])
def get_leads():
    conn = get_db()
    cursor = conn.cursor()
    cursor.execute('SELECT * FROM leads ORDER BY created_at DESC')
    leads = cursor.fetchall()
    cursor.close()
    conn.close()
    for lead in leads:
        for key, val in lead.items():
            if isinstance(val, datetime):
                lead[key] = val.isoformat()
    return jsonify(leads)


# ============ API: Profiles ============

@app.route('/api/profiles', methods=['GET'])
def get_profiles():
    country = request.args.get('country')
    age_min = request.args.get('age_min', type=int)
    age_max = request.args.get('age_max', type=int)
    marital = request.args.get('marital_status')
    page = request.args.get('page', 1, type=int)
    per_page = request.args.get('per_page', 9, type=int)
    if per_page > 100:
        per_page = 100

    query = 'SELECT * FROM profiles WHERE is_active = TRUE'
    params = []

    if country:
        query += ' AND country = %s'
        params.append(country)
    if age_min:
        query += ' AND age >= %s'
        params.append(age_min)
    if age_max:
        query += ' AND age <= %s'
        params.append(age_max)
    if marital:
        query += ' AND marital_status = %s'
        params.append(marital)

    # Count total
    conn = get_db()
    cursor = conn.cursor()
    count_query = query.replace('SELECT *', 'SELECT COUNT(*) as total', 1)
    cursor.execute(count_query, params)
    total = cursor.fetchone()['total']

    # Paginate
    query += ' ORDER BY is_vip DESC, is_online DESC, created_at DESC LIMIT %s OFFSET %s'
    params.extend([per_page, (page - 1) * per_page])
    cursor.execute(query, params)
    profiles = cursor.fetchall()

    cursor.close()
    conn.close()

    # Convert datetime objects to strings
    for p in profiles:
        for key, val in p.items():
            if isinstance(val, datetime):
                p[key] = val.isoformat()

    return jsonify({
        'profiles': profiles,
        'total': total,
        'page': page,
        'pages': (total + per_page - 1) // per_page
    })


@app.route('/api/profiles/<int:profile_id>', methods=['GET'])
def get_profile(profile_id):
    conn = get_db()
    cursor = conn.cursor()

    cursor.execute('SELECT * FROM profiles WHERE id = %s AND is_active = TRUE', (profile_id,))
    profile = cursor.fetchone()

    if not profile:
        cursor.close()
        conn.close()
        return jsonify({'error': 'פרופיל לא נמצא'}), 404

    # Get photos
    cursor.execute('SELECT * FROM profile_photos WHERE profile_id = %s ORDER BY sort_order', (profile_id,))
    photos = cursor.fetchall()

    cursor.close()
    conn.close()

    for key, val in profile.items():
        if isinstance(val, datetime):
            profile[key] = val.isoformat()

    profile['photos'] = photos
    return jsonify(profile)


# ============ API: Success Stories ============

@app.route('/api/stories', methods=['GET'])
def get_stories():
    conn = get_db()
    cursor = conn.cursor()
    cursor.execute('SELECT * FROM success_stories WHERE is_published = TRUE ORDER BY created_at DESC')
    stories = cursor.fetchall()
    cursor.close()
    conn.close()

    for s in stories:
        for key, val in s.items():
            if isinstance(val, datetime):
                s[key] = val.isoformat()

    return jsonify(stories)


# ============ API: Messages ============

@app.route('/api/messages', methods=['POST'])
def send_message():
    data = request.get_json()
    user_id = data.get('user_id')
    profile_id = data.get('profile_id')
    content = data.get('content', '').strip()

    if not content or not profile_id:
        return jsonify({'error': 'תוכן והפרופיל הם שדות חובה'}), 400

    conn = get_db()
    cursor = conn.cursor()
    cursor.execute(
        'INSERT INTO messages (sender_user_id, receiver_profile_id, content) VALUES (%s, %s, %s)',
        (user_id, profile_id, content)
    )
    conn.commit()
    msg_id = cursor.lastrowid
    cursor.close()
    conn.close()
    return jsonify({'success': True, 'id': msg_id})


# ============ Helper ============

def fix_dates(row):
    for key, val in row.items():
        if isinstance(val, datetime):
            row[key] = val.isoformat()
    return row


# ============ Admin API: Profiles ============

@app.route('/api/admin/profiles', methods=['POST'])
def admin_create_profile():
    d = request.get_json()
    conn = get_db()
    cursor = conn.cursor()
    cursor.execute('''INSERT INTO profiles
        (first_name, age, city, country, occupation, education, languages, hobbies, bio, quote, main_image, marital_status, is_vip, is_verified)
        VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)''',
        (d['first_name'], d['age'], d['city'], d['country'],
         d.get('occupation',''), d.get('education',''), d.get('languages',''),
         d.get('hobbies',''), d.get('bio',''), d.get('quote',''),
         d.get('main_image',''), d.get('marital_status','single'),
         d.get('is_vip', False), d.get('is_verified', False)))
    conn.commit()
    pid = cursor.lastrowid
    cursor.close()
    conn.close()
    return jsonify({'success': True, 'id': pid})


@app.route('/api/admin/profiles/<int:pid>', methods=['PUT'])
def admin_update_profile(pid):
    d = request.get_json()
    conn = get_db()
    cursor = conn.cursor()
    cursor.execute('''UPDATE profiles SET
        first_name=%s, age=%s, city=%s, country=%s, occupation=%s, education=%s,
        languages=%s, hobbies=%s, bio=%s, quote=%s, main_image=%s,
        marital_status=%s, is_vip=%s, is_verified=%s
        WHERE id=%s''',
        (d['first_name'], d['age'], d['city'], d['country'],
         d.get('occupation',''), d.get('education',''), d.get('languages',''),
         d.get('hobbies',''), d.get('bio',''), d.get('quote',''),
         d.get('main_image',''), d.get('marital_status','single'),
         d.get('is_vip', False), d.get('is_verified', False), pid))
    conn.commit()
    cursor.close()
    conn.close()
    return jsonify({'success': True})


@app.route('/api/admin/profiles/<int:pid>', methods=['DELETE'])
def admin_delete_profile(pid):
    conn = get_db()
    cursor = conn.cursor()
    cursor.execute('DELETE FROM profiles WHERE id = %s', (pid,))
    conn.commit()
    cursor.close()
    conn.close()
    return jsonify({'success': True})


# ============ Admin API: Photos ============

@app.route('/api/admin/photos', methods=['POST'])
def admin_add_photo():
    d = request.get_json()
    conn = get_db()
    cursor = conn.cursor()
    cursor.execute('INSERT INTO profile_photos (profile_id, image_url, is_private) VALUES (%s, %s, %s)',
        (d['profile_id'], d['image_url'], d.get('is_private', False)))
    conn.commit()
    pid = cursor.lastrowid
    cursor.close()
    conn.close()
    return jsonify({'success': True, 'id': pid})


@app.route('/api/admin/photos/<int:photo_id>', methods=['DELETE'])
def admin_delete_photo(photo_id):
    conn = get_db()
    cursor = conn.cursor()
    cursor.execute('DELETE FROM profile_photos WHERE id = %s', (photo_id,))
    conn.commit()
    cursor.close()
    conn.close()
    return jsonify({'success': True})


# ============ Admin API: Users ============

@app.route('/api/admin/users', methods=['GET'])
def admin_get_users():
    conn = get_db()
    cursor = conn.cursor()
    cursor.execute('SELECT id, full_name, email, phone, age, city, country, is_vip, is_active, created_at FROM users ORDER BY created_at DESC')
    users = cursor.fetchall()
    cursor.close()
    conn.close()
    return jsonify([fix_dates(u) for u in users])


@app.route('/api/admin/users/<int:uid>', methods=['GET'])
def admin_get_user(uid):
    conn = get_db()
    cursor = conn.cursor()
    cursor.execute('SELECT id, full_name, email, phone, age, city, country, is_vip, is_active, created_at FROM users WHERE id = %s', (uid,))
    user = cursor.fetchone()
    if not user:
        cursor.close()
        conn.close()
        return jsonify({'error': 'משתמש לא נמצא'}), 404
    # Get messages sent by this user
    cursor.execute('''SELECT m.*, p.first_name as profile_name FROM messages m
        LEFT JOIN profiles p ON m.receiver_profile_id = p.id
        WHERE m.sender_user_id = %s ORDER BY m.created_at DESC''', (uid,))
    messages = cursor.fetchall()
    cursor.close()
    conn.close()
    user = fix_dates(user)
    user['messages'] = [fix_dates(m) for m in messages]
    return jsonify(user)


@app.route('/api/admin/users/<int:uid>', methods=['PUT'])
def admin_update_user(uid):
    d = request.get_json()
    conn = get_db()
    cursor = conn.cursor()

    # Get current user data for email
    cursor.execute('SELECT full_name, email FROM users WHERE id = %s', (uid,))
    user = cursor.fetchone()

    # Build update query
    new_password = d.get('new_password', '').strip()
    if new_password:
        cursor.execute('''UPDATE users SET full_name=%s, email=%s, phone=%s, age=%s,
            is_vip=%s, is_active=%s, password_hash=%s WHERE id=%s''',
            (d.get('full_name', user['full_name']), d.get('email', user['email']),
             d.get('phone'), d.get('age'), d.get('is_vip', False), d.get('is_active', True),
             hash_password(new_password), uid))
        # Send email with new password
        send_password_changed_email(
            d.get('full_name', user['full_name']),
            d.get('email', user['email']),
            new_password
        )
    else:
        cursor.execute('''UPDATE users SET full_name=%s, email=%s, phone=%s, age=%s,
            is_vip=%s, is_active=%s WHERE id=%s''',
            (d.get('full_name', user['full_name']), d.get('email', user['email']),
             d.get('phone'), d.get('age'), d.get('is_vip', False), d.get('is_active', True), uid))

    conn.commit()
    cursor.close()
    conn.close()
    return jsonify({'success': True})


@app.route('/api/admin/users/<int:uid>', methods=['DELETE'])
def admin_delete_user(uid):
    conn = get_db()
    cursor = conn.cursor()
    cursor.execute('DELETE FROM users WHERE id = %s', (uid,))
    conn.commit()
    cursor.close()
    conn.close()
    return jsonify({'success': True})


# ============ Admin API: Messages ============

@app.route('/api/admin/messages', methods=['GET'])
def admin_get_messages():
    conn = get_db()
    cursor = conn.cursor()
    cursor.execute('''SELECT m.*, u.full_name as sender_name, u.email as sender_email,
        p.first_name as receiver_name
        FROM messages m
        LEFT JOIN users u ON m.sender_user_id = u.id
        LEFT JOIN profiles p ON m.receiver_profile_id = p.id
        ORDER BY m.created_at DESC LIMIT 200''')
    messages = cursor.fetchall()
    cursor.close()
    conn.close()
    return jsonify([fix_dates(m) for m in messages])


@app.route('/api/admin/messages/<int:mid>', methods=['DELETE'])
def admin_delete_message(mid):
    conn = get_db()
    cursor = conn.cursor()
    cursor.execute('DELETE FROM messages WHERE id = %s', (mid,))
    conn.commit()
    cursor.close()
    conn.close()
    return jsonify({'success': True})


# ============ Admin API: Leads ============

@app.route('/api/admin/leads/<int:lid>', methods=['DELETE'])
def admin_delete_lead(lid):
    conn = get_db()
    cursor = conn.cursor()
    cursor.execute('DELETE FROM leads WHERE id = %s', (lid,))
    conn.commit()
    cursor.close()
    conn.close()
    return jsonify({'success': True})


# ============ Admin API: Pages ============

@app.route('/api/admin/pages', methods=['GET'])
def admin_get_pages():
    conn = get_db()
    cursor = conn.cursor()
    cursor.execute('SELECT * FROM pages ORDER BY created_at DESC')
    pages = cursor.fetchall()
    cursor.close()
    conn.close()
    return jsonify([fix_dates(p) for p in pages])


@app.route('/api/admin/pages/<int:pid>', methods=['GET'])
def admin_get_page(pid):
    conn = get_db()
    cursor = conn.cursor()
    cursor.execute('SELECT * FROM pages WHERE id = %s', (pid,))
    page = cursor.fetchone()
    cursor.close()
    conn.close()
    if not page:
        return jsonify({'error': 'דף לא נמצא'}), 404
    return jsonify(fix_dates(page))


@app.route('/api/admin/pages', methods=['POST'])
def admin_create_page():
    d = request.get_json()
    conn = get_db()
    cursor = conn.cursor()
    cursor.execute('INSERT INTO pages (title, slug, content, show_in_menu, is_active) VALUES (%s,%s,%s,%s,%s)',
        (d['title'], d['slug'], d.get('content',''), d.get('show_in_menu', False), d.get('is_active', True)))
    conn.commit()
    pid = cursor.lastrowid
    cursor.close()
    conn.close()
    return jsonify({'success': True, 'id': pid})


@app.route('/api/admin/pages/<int:pid>', methods=['PUT'])
def admin_update_page(pid):
    d = request.get_json()
    conn = get_db()
    cursor = conn.cursor()
    cursor.execute('UPDATE pages SET title=%s, slug=%s, content=%s, show_in_menu=%s, is_active=%s WHERE id=%s',
        (d['title'], d['slug'], d.get('content',''), d.get('show_in_menu', False), d.get('is_active', True), pid))
    conn.commit()
    cursor.close()
    conn.close()
    return jsonify({'success': True})


@app.route('/api/admin/pages/<int:pid>', methods=['DELETE'])
def admin_delete_page(pid):
    conn = get_db()
    cursor = conn.cursor()
    cursor.execute('DELETE FROM pages WHERE id = %s', (pid,))
    conn.commit()
    cursor.close()
    conn.close()
    return jsonify({'success': True})


# ============ Admin API: Stories ============

@app.route('/api/admin/stories', methods=['GET'])
def admin_get_stories():
    conn = get_db()
    cursor = conn.cursor()
    cursor.execute('SELECT * FROM success_stories ORDER BY created_at DESC')
    stories = cursor.fetchall()
    cursor.close()
    conn.close()
    return jsonify([fix_dates(s) for s in stories])


@app.route('/api/admin/stories', methods=['POST'])
def admin_create_story():
    d = request.get_json()
    conn = get_db()
    cursor = conn.cursor()
    cursor.execute(
        'INSERT INTO success_stories (couple_name, story_text, image_url, badge, is_published) VALUES (%s,%s,%s,%s,%s)',
        (d['couple_name'], d.get('story_text', ''), d.get('image_url', ''), d.get('badge', ''), d.get('is_published', True))
    )
    conn.commit()
    sid = cursor.lastrowid
    cursor.close()
    conn.close()
    return jsonify({'success': True, 'id': sid})


@app.route('/api/admin/stories/<int:sid>', methods=['PUT'])
def admin_update_story(sid):
    d = request.get_json()
    conn = get_db()
    cursor = conn.cursor()
    cursor.execute(
        'UPDATE success_stories SET couple_name=%s, story_text=%s, image_url=%s, badge=%s, is_published=%s WHERE id=%s',
        (d['couple_name'], d.get('story_text', ''), d.get('image_url', ''), d.get('badge', ''), d.get('is_published', True), sid)
    )
    conn.commit()
    cursor.close()
    conn.close()
    return jsonify({'success': True})


@app.route('/api/admin/stories/<int:sid>', methods=['DELETE'])
def admin_delete_story(sid):
    conn = get_db()
    cursor = conn.cursor()
    cursor.execute('DELETE FROM success_stories WHERE id = %s', (sid,))
    conn.commit()
    cursor.close()
    conn.close()
    return jsonify({'success': True})


# ============ API: Process Steps ============

@app.route('/api/process-steps', methods=['GET'])
def get_process_steps():
    conn = get_db()
    cursor = conn.cursor()
    cursor.execute('SELECT * FROM process_steps WHERE is_active = TRUE ORDER BY step_number ASC')
    steps = cursor.fetchall()
    cursor.close()
    conn.close()
    return jsonify([fix_dates(s) for s in steps])


# ============ Admin API: Process Steps ============

@app.route('/api/admin/process-steps', methods=['GET'])
def admin_get_process_steps():
    conn = get_db()
    cursor = conn.cursor()
    cursor.execute('SELECT * FROM process_steps ORDER BY step_number ASC')
    steps = cursor.fetchall()
    cursor.close()
    conn.close()
    return jsonify([fix_dates(s) for s in steps])


@app.route('/api/admin/process-steps', methods=['POST'])
def admin_create_process_step():
    d = request.get_json()
    conn = get_db()
    cursor = conn.cursor()
    cursor.execute(
        'INSERT INTO process_steps (step_number, title, description, icon, image_url, is_active) VALUES (%s,%s,%s,%s,%s,%s)',
        (d.get('step_number', 1), d['title'], d.get('description', ''), d.get('icon', 'star'), d.get('image_url', ''), d.get('is_active', True))
    )
    conn.commit()
    sid = cursor.lastrowid
    cursor.close()
    conn.close()
    return jsonify({'success': True, 'id': sid})


@app.route('/api/admin/process-steps/<int:sid>', methods=['PUT'])
def admin_update_process_step(sid):
    d = request.get_json()
    conn = get_db()
    cursor = conn.cursor()
    cursor.execute(
        'UPDATE process_steps SET step_number=%s, title=%s, description=%s, icon=%s, image_url=%s, is_active=%s WHERE id=%s',
        (d.get('step_number', 1), d['title'], d.get('description', ''), d.get('icon', 'star'), d.get('image_url', ''), d.get('is_active', True), sid)
    )
    conn.commit()
    cursor.close()
    conn.close()
    return jsonify({'success': True})


@app.route('/api/admin/process-steps/<int:sid>', methods=['DELETE'])
def admin_delete_process_step(sid):
    conn = get_db()
    cursor = conn.cursor()
    cursor.execute('DELETE FROM process_steps WHERE id = %s', (sid,))
    conn.commit()
    cursor.close()
    conn.close()
    return jsonify({'success': True})


# ============ API: FAQs ============

@app.route('/api/faqs', methods=['GET'])
def get_faqs():
    conn = get_db()
    cursor = conn.cursor()
    cursor.execute('SELECT * FROM faqs WHERE is_active = TRUE ORDER BY sort_order ASC, id ASC')
    faqs = cursor.fetchall()
    cursor.close()
    conn.close()
    return jsonify([fix_dates(f) for f in faqs])


# ============ Admin API: FAQs ============

@app.route('/api/admin/faqs', methods=['GET'])
def admin_get_faqs():
    conn = get_db()
    cursor = conn.cursor()
    cursor.execute('SELECT * FROM faqs ORDER BY sort_order ASC, id ASC')
    faqs = cursor.fetchall()
    cursor.close()
    conn.close()
    return jsonify([fix_dates(f) for f in faqs])


@app.route('/api/admin/faqs', methods=['POST'])
def admin_create_faq():
    d = request.get_json()
    conn = get_db()
    cursor = conn.cursor()
    cursor.execute(
        'INSERT INTO faqs (question, answer, sort_order, is_active) VALUES (%s,%s,%s,%s)',
        (d['question'], d.get('answer', ''), d.get('sort_order', 0), d.get('is_active', True))
    )
    conn.commit()
    fid = cursor.lastrowid
    cursor.close()
    conn.close()
    return jsonify({'success': True, 'id': fid})


@app.route('/api/admin/faqs/<int:fid>', methods=['PUT'])
def admin_update_faq(fid):
    d = request.get_json()
    conn = get_db()
    cursor = conn.cursor()
    cursor.execute(
        'UPDATE faqs SET question=%s, answer=%s, sort_order=%s, is_active=%s WHERE id=%s',
        (d['question'], d.get('answer', ''), d.get('sort_order', 0), d.get('is_active', True), fid)
    )
    conn.commit()
    cursor.close()
    conn.close()
    return jsonify({'success': True})


@app.route('/api/admin/faqs/<int:fid>', methods=['DELETE'])
def admin_delete_faq(fid):
    conn = get_db()
    cursor = conn.cursor()
    cursor.execute('DELETE FROM faqs WHERE id = %s', (fid,))
    conn.commit()
    cursor.close()
    conn.close()
    return jsonify({'success': True})


# ============ Admin API: Site Settings ============

@app.route('/api/admin/settings', methods=['GET'])
def admin_get_settings():
    conn = get_db()
    cursor = conn.cursor()
    cursor.execute('SELECT setting_key, setting_value FROM site_settings')
    rows = cursor.fetchall()
    cursor.close()
    conn.close()
    return jsonify({r['setting_key']: r['setting_value'] for r in rows})


@app.route('/api/admin/settings', methods=['POST'])
def admin_save_settings():
    data = request.get_json()
    conn = get_db()
    cursor = conn.cursor()
    for key, value in data.items():
        cursor.execute('''INSERT INTO site_settings (setting_key, setting_value)
            VALUES (%s, %s) ON DUPLICATE KEY UPDATE setting_value = %s''',
            (key, value, value))
    conn.commit()
    cursor.close()
    conn.close()
    return jsonify({'success': True})


if __name__ == '__main__':
    print('Server running at http://localhost:3000')
    print('Admin panel: http://localhost:3000/admin')
    app.run(port=3000, debug=True)
