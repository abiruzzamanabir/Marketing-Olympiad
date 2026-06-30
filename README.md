# Marketing Olympiad Laravel Application

This is the full application code with existing features preserved and production security/performance improvements applied.

## What was improved

- Removed the live `.env` file from the ZIP and added a sanitized `.env.example`.
- Preserved maintenance, queue, and image-compression routes, but protected them with existing admin authentication and rate limiting.
- Added login rate limiting for the admin panel.
- Added secure session handling: session regeneration after login and invalidation after logout.
- Added security headers middleware.
- Added Apache `.htaccess` protection for shared-hosting/root deployments.
- Added static asset browser caching and compression rules for Apache.
- Removed server log/error/cache artifacts from the package.
- Added missing Laravel runtime folder placeholders.
- Verified PHP syntax after changes.

## Production setup

1. Copy `.env.example` to `.env` on the server.
2. Add the real database, SMTP, SMS, app URL, and app key values in `.env`.
3. Keep these values on the live server:

```env
APP_ENV=production
APP_DEBUG=false
SESSION_SECURE_COOKIE=true
```

4. Run:

```bash
composer install --no-dev --optimize-autoloader
php artisan key:generate
php artisan storage:link
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

5. If Vite assets are required:

```bash
npm install
npm run build
```

## Important deployment notes

- Point the domain to Laravel's `public` directory if your hosting supports it.
- If your hosting forces the project to run from web root, keep the included `.htaccess`.
- Do not upload a real `.env` file to public repositories or shared ZIPs.
- For queues, use Supervisor/cron where possible. The `/queue-job` feature is still present but now processes one job per secured request to avoid a browser request hanging indefinitely.
