# Royal Date - Premium Matchmaking Website

## Overview
Luxury matchmaking site connecting Israeli men with women from Moldova & Ukraine.
- **Live URL:** https://www.royaldate.co.il
- **Domain:** royaldate.co.il
- **Hosting:** Cloudways (DigitalOcean Amsterdam) - IP: 64.225.73.226
- **Owner:** Saar Yosef (winlink7@gmail.com)

## Tech Stack
- **Backend:** Custom PHP MVC (NOT Laravel/Symfony - no artisan, no composer)
- **Database:** MySQL/MariaDB (utf8mb4) - DB: adhbxejeen, User: adhbxejeen
- **Frontend:** Tailwind CSS v3.4.17 (precompiled, NOT CDN), vanilla JS
- **Fonts:** Google Fonts Heebo (3 weights: 400,700,900)
- **Icons:** Material Symbols Outlined
- **Auth:** WhatsApp OTP via Green-API (BUSINESS_USD_12 plan)
- **Email:** SendGrid API (config in config/mail.local.php, gitignored)
- **WhatsApp:** Green-API (config in config/whatsapp.local.php, gitignored)
- **Translation:** MyMemory API with DB cache (translations_cache table)

## Project Structure
```
index.php                  # Router (all requests via .htaccess rewrite)
config/
  database.php             # DB credentials
  translations.php         # Hebrew/Russian/English UI strings + detectLanguage()
  mail.local.php           # SendGrid key (gitignored)
  whatsapp.local.php       # Green-API credentials (gitignored)
app/
  controllers/
    ApiController.php      # ALL API endpoints (/api/*)
    HomeController.php     # Home page
    PageController.php     # About, search, stories, process, faq, contact, vip
    ProfileController.php  # Profile view
    DashboardController.php
    AuthController.php
    AdminController.php
  models/
    Database.php           # PDO singleton wrapper
  services/
    MailService.php        # SendGrid email
    WhatsAppService.php    # Green-API OTP
    TranslationService.php # MyMemory API + DB cache
  views/
    layouts/
      header.php           # Shared header (SEO, CSS, nav, loader, logo)
      footer.php           # Shared footer (modals, WhatsApp login/register)
      admin-inline.php     # Inline editor for admins (floating bar + popups)
    home/index.php         # Hero, lead form, reviews, recent profiles
    search/index.php       # Profile search with filters
    profile/show.php       # Single profile page (gallery, videos, contact)
    admin/index.php        # Full admin panel (tabbed: profiles, users, reviews, settings, translations, etc.)
    about/, contact/, faq/, process/, stories/, vip/, dashboard/, login/
public/
  css/tailwind.min.css     # Precompiled Tailwind (npm run build:css)
  js/auto-translate.js     # Dictionary + remote API translation
  js/whatsapp-verify.js    # OTP verification modal
  uploads/                 # User uploads (avatars, profile photos)
```

## Key Architecture Decisions
- **No framework** - pure PHP MVC for simplicity on Cloudways
- **Tailwind precompiled** - `npm run build:css` generates static CSS (52KB vs 300KB CDN)
- **Server-side translation** - API endpoints accept `?lang=ru|en`, translate via TranslationService before returning JSON
- **Client-side translation fallback** - auto-translate.js dictionary + remoteTranslateBatch() for anything missed
- **Settings in DB** - `settings` table stores all config (SEO, logo, WhatsApp phone, etc.)
- **Cookie-based auth** - `admin_token` / `user_token` cookies (Varnish strips PHP sessions)
- **RTL default** - Hebrew is default language, dir="rtl"

## Deployment
**SFTP only** - GitHub push does NOT auto-deploy to Cloudways.
```bash
# Deploy script (run after git push):
python _deploy.py
```
This uploads all key files to `public_html/` on 64.225.73.226 via SFTP.

**Tailwind rebuild** (when adding new Tailwind classes):
```bash
npm run build:css
```

**DB migrations** - visit `/?dbrun=Moldova2026` to run dbrun.sql on live server.

## API Endpoints
All under `/api/`:
- `GET /api/profiles?lang=ru&page=1&per_page=12` - List profiles (translated)
- `GET /api/profiles/:id?lang=ru` - Single profile
- `GET /api/reviews?lang=ru` - Reviews (translated)
- `GET /api/stories?lang=ru` - Success stories (translated)
- `GET /api/faqs?lang=ru` - FAQs (translated)
- `GET /api/process-steps?lang=ru` - Process steps (translated)
- `POST /api/translate` - Translate text(s) via MyMemory
- `POST /api/register` - WhatsApp OTP registration
- `POST /api/verify-whatsapp-otp` - Verify OTP code
- `GET/POST /api/admin/settings` - Site settings CRUD
- `GET/PUT/DELETE /api/admin/translations/:id` - Translation cache CRUD
- `GET/POST/PUT/DELETE /api/admin/profiles/:id` - Profile CRUD
- `GET/POST/PUT/DELETE /api/admin/reviews/:id` - Review CRUD

## Admin Access
- **Internal panel:** /admin (tabbed: profiles, users, pages, stories, FAQs, reviews, settings, translations)
- **Inline editor:** appears as floating bar on all pages for admins (edit text, images, buttons inline)
- **SEO settings:** /admin → Site Settings → blue SEO section (title/description per page + OG image)
- **WhatsApp settings:** /admin → Site Settings → green section, or inline bar → green WhatsApp button
- **Translations:** /admin → Translations tab (view/edit/delete cached translations)

## Common Tasks
- **Add profile:** /admin → Profiles → Add
- **Edit review photos:** /admin → Reviews → Edit → upload photo
- **Change hero image:** Edit `app/views/home/index.php` line ~28 (Unsplash URL)
- **Change logo:** /upload-logo or settings: site_logo_image
- **SEO titles:** /admin → Site Settings → SEO section
- **Fix translation:** /admin → Translations → find text → Edit

## Important Notes
- Always deploy via `python _deploy.py` after pushing to GitHub
- Rebuild Tailwind CSS with `npm run build:css` when adding new utility classes
- Language detection: cookie `site_lang` + `?lang=` param, default Hebrew
- Green-API WhatsApp disconnects every ~14 days, user re-scans QR
- Varnish cache on Cloudways: API/admin routes have no-cache headers
- DB credentials in config/database.php (also in index.php dbrun block)
