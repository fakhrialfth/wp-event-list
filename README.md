# WordPress Event Platform

A modern and feature-rich event management platform built with WordPress, featuring custom post types, advanced event listings, countdown timers, and a responsive design.

## 📸 Screenshots

![Homepage Preview](https://raw.githubusercontent.com/fakhrialfth/wp-event-list/main/docs/screenshots/homepage.png)
*Modern homepage with hero section and event highlights*

![Event Listing](https://raw.githubusercontent.com/fakhrialfth/wp-event-list/main/docs/screenshots/event-listing.png)
*Event archive with slider navigation*

![Event Details](https://raw.githubusercontent.com/fakhrialfth/wp-event-list/main/docs/screenshots/event-details.png)
*Single event page with countdown timer and registration*

### Server Requirements
- PHP 8.0 or higher
- MySQL 5.7 or MariaDB 10.2 or higher
- WordPress 6.0 or higher
- Web server (Apache/Nginx)
- SSL certificate (recommended for production)

### Local Development
- XAMPP, WAMP, MAMP, or similar local server environment
- Git installed
- Modern web browser
- Code editor (VS Code recommended)

## 🚀 Quick Start

### 1. Clone the Repository

```bash
git clone https://github.com/fakhrialfth/wp-event-list.git
cd wp-event-list
```

### Local Development Setup

#### Using XAMPP (Recommended)

1. **Install XAMPP**
   - Download and install [XAMPP](https://www.apachefriends.org/)
   - Start Apache and MySQL services from XAMPP Control Panel

2. **Clone Project**
   ```bash
   # Buka terminal/command prompt Anda
   cd C:\xampp\htdocs
   git clone https://github.com/fakhrialfth/wp-event-list.git
   cd wp-event-list
   ```

3. **Setup Database**
   - Buka browser, akses http://localhost/phpmyadmin
   - Klik "New" di sidebar kiri
   - Masukkan nama database: `wordpress_event`
   - Pilih collation: `utf8mb4_general_ci`
   - Klik "Create"

4. **Configure WordPress**
   - Edit file `wp-config.php` atau copy dari `wp-config-sample.php`
   - Update database credentials:
   ```php
   define('DB_NAME', 'wordpress_event');
   define('DB_USER', 'root');
   define('DB_PASSWORD', '');
   define('DB_HOST', 'localhost');
   ```

5. **Install WordPress**
   - Buka browser: http://localhost/wp-event-list/
   - Ikuti wizard instalasi WordPress:
     - Site Title: WordPress Event Platform (atau sesuai keinginan)
     - Username: admin
     - Password: buat password yang kuat
     - Your Email: email Anda
     - Search Engine Visibility: unchecked

6. **Install Required Plugins**
   - Login ke WordPress Admin: http://localhost/wp-event-list/wp-admin
   - Pergi ke Plugins → Add New
   - Search dan install:
     - "Pods – Custom Content Types and Fields"
     - Activate plugin tersebut

7. **Setup Pods Configuration**
   - Pergi ke Pods Admin → Add New
   - Buat Pod baru dengan konfigurasi:
     - Pod Type: Custom Post Type (CPT)
     - Name: my_event
     - Label: Events
     - Plural: Events
     - Enable Archive Page: Yes
     - Rewrite Slug: events
   - Add Fields:
     - `event_banner` (File/Image)
     - `event_location` (Plain Text)
     - `event_price` (Plain Text)
     - `event_datetime` (Date/Time)

8. **Configure Permalinks**
   - Pergi ke Settings → Permalinks
   - Pilih "Post name"
   - Klik "Save Changes"

9. **Create Test Events**
   - Pergi ke Events → Add New
   - Buat beberapa event dengan data lengkap
   - Publish event tersebut

10. **Access Your Site**
    - Frontend: http://localhost/wp-event-list/
    - Events Archive: http://localhost/wp-event-list/events/
    - WordPress Admin: http://localhost/wp-event-list/wp-admin

## 📁 Project Structure

```
wp-event-list/
├── wp-content/
│   └── themes/
│       └── twentytwentyone/
│           ├── functions-events.php          # Event-specific functions
│           ├── front-page.php                # Custom homepage template
│           ├── page-upcoming-events.php      # Upcoming events page
│           ├── single-my_event.php           # Single event template
│           ├── archive-events.php            # Event archive template
│           ├── footer.php                    # Custom footer
│           └── template-parts/
│               └── header/
│                   ├── site-header.php        # Main navigation
│                   └── entry-header.php      # Entry header (modified)
├── wp-config.php                             # WordPress configuration
├── .htaccess                                 # Apache configuration
└── README.md                                # This file
```

**Built with ❤️ by Fakhri Al Fatah**

Made with WordPress, PHP, and modern web technologies.