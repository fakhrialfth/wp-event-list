<?php
/**
 * Fungsi untuk mendukung CPT Events dan template
 */

// Pastikan WordPress memuat template yang benar untuk CPT my_event
add_filter('template_include', 'events_template_include', 99);

function events_template_include($template) {
    // Cek apakah ini adalah archive untuk CPT my_event
    if (is_post_type_archive('my_event')) {
        // Cari template archive-events.php di theme
        $theme_template = locate_template('archive-events.php');
        if ($theme_template) {
            return $theme_template;
        }
    }

    // Cek apakah ini adalah single CPT my_event
    if (is_singular('my_event')) {
        // Cari template single-my_event.php di theme
        $theme_template = locate_template('single-my_event.php');
        if ($theme_template) {
            return $theme_template;
        }
    }

    // Cek apakah ini adalah halaman dengan slug 'upcoming-events'
    if (is_page() && get_post_field('post_name', get_the_ID()) === 'upcoming-events') {
        // Cari template page-upcoming-events.php di theme
        $theme_template = locate_template('page-upcoming-events.php');
        if ($theme_template) {
            return $theme_template;
        }
    }

    return $template;
}

// Tambahkan support untuk theme features
add_action('after_setup_theme', 'events_theme_setup');

function events_theme_setup() {
    // Tambahkan post thumbnail support
    add_theme_support('post-thumbnails');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title.
    add_theme_support('title-tag');
}

// Flush rewrite rules saat theme diaktivasi
add_action('after_switch_theme', 'flush_rewrite_rules');

// Buat halaman upcoming-events otomatis saat theme diaktivasi
add_action('after_switch_theme', 'create_upcoming_events_page');

function create_upcoming_events_page() {
    // Cek apika halaman sudah ada
    if (get_page_by_path('upcoming-events')) {
        return;
    }

    // Buat halaman baru
    $page_data = array(
        'post_title'    => 'Upcoming Events',
        'post_content'  => 'Halaman ini akan menampilkan event-event yang akan datang.',
        'post_status'   => 'publish',
        'post_type'     => 'page',
        'post_name'     => 'upcoming-events'
    );

    wp_insert_post($page_data);
}

// Custom function untuk mendapatkan field Pods dengan aman
function get_event_field($field_name) {
    if (function_exists('pods')) {
        $pod = pods('my_event', get_the_ID());
        return $pod->field($field_name);
    }
    return get_post_meta(get_the_ID(), $field_name, true);
}

// Enqueue styles dan scripts khusus event
add_action('wp_enqueue_scripts', 'events_enqueue_scripts');

function events_enqueue_scripts() {
    // Hanya enqueue di halaman event
    if (is_post_type_archive('my_event') || is_singular('my_event')) {
        wp_enqueue_style(
            'events-styles',
            get_stylesheet_directory_uri() . '/assets/events-style.css',
            array(),
            '1.0.0'
        );
    }
}

// Shortcode untuk menampilkan 3 event terdekat
add_shortcode('upcoming_events', 'upcoming_events_shortcode');

function upcoming_events_shortcode($atts) {
    // Default attributes
    $atts = shortcode_atts(array(
        'count' => 3,
        'title' => 'Event Terdekat',
        'show_button' => 'true'
    ), $atts, 'upcoming_events');

    // Query untuk mendapatkan event yang akan datang
    $args = array(
        'post_type' => 'my_event',
        'posts_per_page' => intval($atts['count']),
        'meta_key' => 'event_datetime',
        'meta_value' => current_time('Y-m-d H:i:s'),
        'meta_compare' => '>=',
        'orderby' => 'meta_value',
        'order' => 'ASC',
        'post_status' => 'publish'
    );

    $events_query = new WP_Query($args);

    ob_start();

    // Mulai output HTML
    ?>
    <div class="upcoming-events-shortcode">
        <div class="upcoming-events-header">
            <h2 class="upcoming-events-title"><?php echo esc_html($atts['title']); ?></h2>
            <div class="upcoming-events-subtitle">Jangan lewatkan event menarik ini!</div>
        </div>

        <?php if ($events_query->have_posts()) : ?>
            <div class="upcoming-events-grid">
                <?php while ($events_query->have_posts()) : $events_query->the_post(); ?>
                    <?php
                    // Ambil field PODS
                    $event_datetime = get_post_meta(get_the_ID(), 'event_datetime', true);
                    $event_location = get_post_meta(get_the_ID(), 'event_location', true);
                    $event_price = get_post_meta(get_the_ID(), 'event_price', true);
                    $event_banner_id = get_post_meta(get_the_ID(), 'event_banner', true);
                    $event_banner_url = wp_get_attachment_url($event_banner_id);
                    ?>

                    <div class="upcoming-event-card">
                        <?php if ($event_banner_url): ?>
                            <div class="upcoming-event-image">
                                <img src="<?php echo esc_url($event_banner_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                                <div class="upcoming-event-date">
                                    <?php
                                    if ($event_datetime) {
                                        echo date_i18n('d M', strtotime($event_datetime));
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="upcoming-event-placeholder">
                                <span>📅</span>
                                <div class="upcoming-event-date">
                                    <?php
                                    if ($event_datetime) {
                                        echo date_i18n('d M', strtotime($event_datetime));
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="upcoming-event-content">
                            <h3 class="upcoming-event-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>

                            <div class="upcoming-event-meta">
                                <?php if ($event_datetime): ?>
                                    <div class="upcoming-event-datetime">
                                        <span class="upcoming-meta-icon">📅</span>
                                        <span><?php echo date_i18n('d F Y H:i', strtotime($event_datetime)); ?></span>
                                    </div>
                                <?php endif; ?>

                                <?php if ($event_location): ?>
                                    <div class="upcoming-event-location">
                                        <span class="upcoming-meta-icon">📍</span>
                                        <span><?php echo esc_html($event_location); ?></span>
                                    </div>
                                <?php endif; ?>

                                <?php if ($event_price): ?>
                                    <div class="upcoming-event-price">
                                        <span class="upcoming-meta-icon">💰</span>
                                        <span>Rp. <?php echo number_format((int)$event_price, 0, ',', '.'); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <?php if ($atts['show_button'] === 'true'): ?>
                                <div class="upcoming-event-action">
                                    <a href="<?php the_permalink(); ?>" class="upcoming-event-button">
                                        Lihat Detail →
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                <?php endwhile; ?>
            </div>

            <div class="upcoming-events-footer">
                <a href="<?php echo esc_url(get_post_type_archive_link('my_event')); ?>" class="upcoming-events-view-all">
                    Lihat Semua Event →
                </a>
            </div>

        <?php else : ?>
            <div class="upcoming-events-empty">
                <div class="upcoming-events-empty-icon">📅</div>
                <h3>Belum Ada Event Terdekat</h3>
                <p>Event akan segera hadir. Pantau terus halaman ini untuk informasi terbaru!</p>
                <a href="<?php echo esc_url(get_post_type_archive_link('my_event')); ?>" class="upcoming-events-view-all">
                    Lihat Semua Event
                </a>
            </div>
        <?php endif; ?>

        <?php
        // Reset post data
        wp_reset_postdata();
        ?>

    </div>

    <style>
    /* Upcoming Events Shortcode Styles */
    .upcoming-events-shortcode {
        max-width: 1200px;
        margin: 3rem auto;
        padding: 0 1rem;
    }

    .upcoming-events-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .upcoming-events-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2d3748;
        margin: 0 0 1rem 0;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .upcoming-events-subtitle {
        font-size: 1.1rem;
        color: #6c757d;
        margin: 0;
    }

    .upcoming-events-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .upcoming-event-card {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .upcoming-event-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    }

    .upcoming-event-image {
        position: relative;
        height: 200px;
        overflow: hidden;
    }

    .upcoming-event-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .upcoming-event-card:hover .upcoming-event-image img {
        transform: scale(1.05);
    }

    .upcoming-event-placeholder {
        width: 100%;
        height: 200px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: white;
        position: relative;
    }

    .upcoming-event-date {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        color: #667eea;
        font-size: 0.9rem;
    }

    .upcoming-event-content {
        padding: 1.5rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .upcoming-event-title {
        margin: 0 0 1rem 0;
        font-size: 1.3rem;
        font-weight: 600;
        line-height: 1.3;
    }

    .upcoming-event-title a {
        color: #2d3748;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .upcoming-event-title a:hover {
        color: #0073aa;
    }

    .upcoming-event-meta {
        margin-bottom: 1.5rem;
        flex: 1;
    }

    .upcoming-event-meta > div {
        display: flex;
        align-items: center;
        margin-bottom: 0.75rem;
        font-size: 0.9rem;
        color: #6c757d;
    }

    .upcoming-event-meta > div:last-child {
        margin-bottom: 0;
    }

    .upcoming-meta-icon {
        margin-right: 0.5rem;
        font-size: 1rem;
    }

    .upcoming-event-action {
        margin-top: auto;
    }

    .upcoming-event-button {
        display: inline-block;
        background: #0073aa !important;
        color: white !important;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        text-decoration: none !important;
        font-weight: 600;
        text-align: center;
        transition: all 0.3s ease;
        border: none;
        outline: none;
        cursor: pointer;
    }

    .upcoming-event-button:hover {
        background: #005a87 !important;
        transform: translateY(-1px);
        color: white !important;
        text-decoration: none !important;
    }

    .upcoming-event-button:active {
        background: #0073aa !important;
        color: white !important;
    }

    .upcoming-event-button:visited {
        background: #0073aa !important;
        color: white !important;
    }

    .upcoming-event-button:focus {
        background: #0073aa !important;
        color: white !important;
    }

    .upcoming-events-footer {
        text-align: center;
        padding: 2rem 0;
        border-top: 1px solid #e9ecef;
    }

    .upcoming-events-view-all {
        display: inline-block;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        color: white !important;
        padding: 1rem 2rem;
        border-radius: 50px;
        text-decoration: none !important;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .upcoming-events-view-all:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(102, 126, 234, 0.4);
        color: white !important;
        text-decoration: none !important;
    }

    .upcoming-events-view-all:active {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        color: white !important;
        text-decoration: none !important;
    }

    .upcoming-events-view-all:visited {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        color: white !important;
        text-decoration: none !important;
    }

    .upcoming-events-view-all:focus {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        color: white !important;
        text-decoration: none !important;
    }

    .upcoming-events-empty {
        text-align: center;
        padding: 3rem 2rem;
    }

    .upcoming-events-empty-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .upcoming-events-empty h3 {
        font-size: 1.5rem;
        color: #2d3748;
        margin: 0 0 1rem 0;
    }

    .upcoming-events-empty p {
        color: #6c757d;
        margin: 0 0 2rem 0;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .upcoming-events-shortcode {
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .upcoming-events-title {
            font-size: 2rem;
        }

        .upcoming-events-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .upcoming-event-title {
            font-size: 1.2rem;
        }
    }

    @media (max-width: 480px) {
        .upcoming-events-title {
            font-size: 1.8rem;
        }

        .upcoming-event-card {
            border-radius: 12px;
        }

        .upcoming-event-content {
            padding: 1rem;
        }

        .upcoming-event-button {
            padding: 0.6rem 1.2rem;
            font-size: 0.9rem;
        }
    }
    </style>

    <?php
    $output = ob_get_clean();
    return $output;
}