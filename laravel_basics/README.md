## Week 4 – Day 3: Deployment

### Objective
Deploy a Laravel application to a production environment and configure it for live usage.

### Production Configuration
- APP_ENV=production
- APP_DEBUG=false
- APP_URL configured correctly

### Optimization Commands

```bash
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Deployment Steps
1. Configure the `.env` file for production.
2. Upload project files to the hosting server using FTP or SSH.
3. Set directory permissions to **755** and file permissions to **644**.
4. Run database migrations if required.
5. Cache configuration, routes, and views.
6. Test all application routes and verify the live deployment.

### Tools Used
- Laravel
- PHP
- Composer
- Git
- GitHub
- Visual Studio Code

### Outcome
Successfully learned the Laravel deployment workflow, production configuration, optimization commands, file permissions, and deployment checklist for shared hosting.