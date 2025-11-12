@echo off
REM WordPress Event Platform Setup Script for Windows
REM This script helps set up the project locally on Windows

echo ========================================
echo WordPress Event Platform Setup
echo ========================================
echo.

REM Check if we're in the right directory
if not exist "wp-config-sample.php" (
    echo Error: wp-config-sample.php not found.
    echo Please run this script from the WordPress root directory.
    pause
    exit /b 1
)

echo Found WordPress installation
echo.

REM Check if wp-config.php already exists
if exist "wp-config.php" (
    echo WARNING: wp-config.php already exists.
    echo Skipping database configuration.
    echo To reconfigure, delete wp-config.php and run this script again.
    echo.
) else (
    echo Setting up database configuration...

    REM Create wp-config.php from sample
    copy "wp-config-sample.php" "wp-config.php" >nul

    REM Update database credentials (you can modify these as needed)
    powershell -Command "(Get-Content wp-config.php) -replace 'database_name_here', 'wordpress_event' | Set-Content wp-config.php"
    powershell -Command "(Get-Content wp-config.php) -replace 'username_here', 'root' | Set-Content wp-config.php"
    powershell -Command "(Get-Content wp-config.php) -replace 'password_here', '' | Set-Content wp-config.php"

    echo Database configuration updated
    echo    Database: wordpress_event
    echo    Username: root
    echo    Password: (empty)
    echo.
)

REM Check if .htaccess exists
if not exist ".htaccess" (
    echo Creating .htaccess file...

    (
        echo # BEGIN WordPress
        echo ^<IfModule mod_rewrite.c^>
        echo RewriteEngine On
        echo RewriteRule .* - [E=HTTP_AUTHORIZATION:%%{HTTP:Authorization}]
        echo RewriteBase /
        echo RewriteRule ^index\.php$ - [L]
        echo RewriteCond %%{REQUEST_FILENAME} !-f
        echo RewriteCond %%{REQUEST_FILENAME} !-d
        echo RewriteRule . /index.php [L]
        echo ^</IfModule^>
        echo # END WordPress
        echo.
        echo # Security Headers
        echo ^<IfModule mod_headers.c^>
        echo     Header always set X-Content-Type-Options nosniff
        echo     Header always set X-Frame-Options DENY
        echo     Header always set X-XSS-Protection "1; mode=block"
        echo     Header always set Referrer-Policy "strict-origin-when-cross-origin"
        echo ^</IfModule^>
        echo.
        echo # Performance
        echo ^<IfModule mod_expires.c^>
        echo     ExpiresActive On
        echo     ExpiresByType image/jpg "access plus 1 year"
        echo     ExpiresByType image/jpeg "access plus 1 year"
        echo     ExpiresByType image/gif "access plus 1 year"
        echo     ExpiresByType image/png "access plus 1 year"
        echo     ExpiresByType text/css "access plus 1 month"
        echo     ExpiresByType application/javascript "access plus 1 month"
        echo ^</IfModule^>
    ) > .htaccess

    echo .htaccess file created
    echo.
) else (
    echo .htaccess file already exists
    echo.
)

echo ========================================
echo NEXT STEPS:
echo ========================================
echo 1. Make sure your local server ^(XAMPP/WAMP/MAMP^) is running
echo 2. Create a database named 'wordpress_event' in phpMyAdmin
echo 3. Visit http://localhost/wordpress-event-test/ in your browser
echo 4. Complete the WordPress installation
echo 5. Login to wp-admin and activate the Twenty Twenty-One theme
echo 6. Configure permalinks to 'Post name' structure
echo.
echo Setup complete! Your WordPress Event Platform is ready to go.
echo.
echo ========================================
echo USEFUL URLS:
echo ========================================
echo - WordPress Admin: http://localhost/wordpress-event-test/wp-admin/
echo - Event Listings: http://localhost/wordpress-event-test/events/
echo - Upcoming Events: http://localhost/wordpress-event-test/upcoming-events/
echo - phpMyAdmin: http://localhost/phpmyadmin/
echo.

pause