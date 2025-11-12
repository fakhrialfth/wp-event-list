#!/bin/bash

# WordPress Event Platform Setup Script
# This script helps set up the project locally

echo "🚀 WordPress Event Platform Setup"
echo "================================"

# Check if we're in the right directory
if [ ! -f "wp-config-sample.php" ]; then
    echo "❌ Error: wp-config-sample.php not found. Please run this script from the WordPress root directory."
    exit 1
fi

echo "✅ Found WordPress installation"

# Check if wp-config.php already exists
if [ -f "wp-config.php" ]; then
    echo "⚠️  wp-config.php already exists. Skipping database configuration."
    echo "   To reconfigure, delete wp-config.php and run this script again."
else
    echo "📝 Setting up database configuration..."

    # Create wp-config.php from sample
    cp wp-config-sample.php wp-config.php

    # Update database credentials (you can modify these as needed)
    sed -i "s/database_name_here/wordpress_event/" wp-config.php
    sed -i "s/username_here/root/" wp-config.php
    sed -i "s/password_here//" wp-config.php

    echo "✅ Database configuration updated"
    echo "   Database: wordpress_event"
    echo "   Username: root"
    echo "   Password: (empty)"
fi

# Check if .htaccess exists
if [ ! -f ".htaccess" ]; then
    echo "📝 Creating .htaccess file..."
    cat > .htaccess << 'EOF'
# BEGIN WordPress
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]
RewriteBase /
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /index.php [L]
</IfModule>
# END WordPress

# Security Headers
<IfModule mod_headers.c>
    Header always set X-Content-Type-Options nosniff
    Header always set X-Frame-Options DENY
    Header always set X-XSS-Protection "1; mode=block"
    Header always set Referrer-Policy "strict-origin-when-cross-origin"
</IfModule>

# Performance
<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType image/jpg "access plus 1 year"
    ExpiresByType image/jpeg "access plus 1 year"
    ExpiresByType image/gif "access plus 1 year"
    ExpiresByType image/png "access plus 1 year"
    ExpiresByType text/css "access plus 1 month"
    ExpiresByType application/javascript "access plus 1 month"
</IfModule>
EOF
    echo "✅ .htaccess file created"
else
    echo "✅ .htaccess file already exists"
fi

echo ""
echo "📋 Next Steps:"
echo "1. Make sure your local server (XAMPP/WAMP/MAMP) is running"
echo "2. Create a database named 'wordpress_event' in phpMyAdmin"
echo "3. Visit http://localhost/wordpress-event-test/ in your browser"
echo "4. Complete the WordPress installation"
echo "5. Login to wp-admin and activate the Twenty Twenty-One theme"
echo "6. Configure permalinks to 'Post name' structure"
echo ""
echo "🎉 Setup complete! Your WordPress Event Platform is ready to go."

# Provide useful URLs
echo ""
echo "🔗 Useful URLs:"
echo "- WordPress Admin: http://localhost/wordpress-event-test/wp-admin/"
echo "- Event Listings: http://localhost/wordpress-event-test/events/"
echo "- Upcoming Events: http://localhost/wordpress-event-test/upcoming-events"
echo "- phpMyAdmin: http://localhost/phpmyadmin/"