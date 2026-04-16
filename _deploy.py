"""Upload changed files to Cloudways via SFTP"""
import paramiko, os, sys

HOST = '64.225.73.226'
USER = 'moldova'
PASS = 'Saar0504040042'
LOCAL_ROOT = r'c:\xampp\htdocs\moldova'
REMOTE_ROOT = '/public_html/'

FILES = [
    'index.php',
    'app/services/TranslationService.php',
    'app/controllers/ApiController.php',
    'app/views/home/index.php',
    'app/views/search/index.php',
    'app/views/profile/show.php',
    'app/views/stories/index.php',
    'app/views/process/index.php',
    'app/views/faq/index.php',
    'app/views/layouts/header.php',
    'app/views/layouts/admin-inline.php',
    'app/views/admin/index.php',
    'public/js/auto-translate.js',
    'public/css/tailwind.min.css',
    'favicon.svg',
    'tailwind.config.js',
    'package.json',
    'src/tailwind.css',
    '.htaccess',
    '.gitignore',
]

transport = paramiko.Transport((HOST, 22))
transport.connect(username=USER, password=PASS)
sftp = paramiko.SFTPClient.from_transport(transport)

for f in FILES:
    local = os.path.join(LOCAL_ROOT, f.replace('/', os.sep))
    remote = REMOTE_ROOT + f
    if not os.path.isfile(local):
        print(f'SKIP (missing): {f}')
        continue
    # Ensure remote dir exists
    parts = remote.rsplit('/', 1)
    if len(parts) > 1 and parts[0]:
        dirs = parts[0].split('/')
        cur = ''
        for d in dirs:
            cur += '/' + d if cur else d
            if not cur: continue
            try: sftp.stat(cur)
            except:
                try: sftp.mkdir(cur)
                except: pass
    try:
        sftp.put(local, remote)
        print(f'OK: {f}')
    except Exception as e:
        print(f'ERR: {f} -> {e}')

sftp.close()
transport.close()
print('\nDone!')
