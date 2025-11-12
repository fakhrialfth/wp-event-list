<?php
/**
 * Template Name: Single Event
 * Template Post Type: my_event
 */

get_header(); ?>

<main id="site-content" role="main" class="single-my_event">

    <?php while (have_posts()) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class('event-single'); ?>>
            <div class="event-detail-container">
                <!-- Event Banner & Info Section -->
                <div class="event-detail-header">
                    <?php
                    // Ambil field PODS
                    $event_datetime = get_post_meta(get_the_ID(), 'event_datetime', true);
                    $event_location = get_post_meta(get_the_ID(), 'event_location', true);
                    $event_price = get_post_meta(get_the_ID(), 'event_price', true);
                    $event_banner_id = get_post_meta(get_the_ID(), 'event_banner', true);
                    $event_banner_url = wp_get_attachment_url($event_banner_id);
                    ?>

                    <div class="event-detail-image">
                        <?php if ($event_banner_url): ?>
                            <img src="<?php echo esc_url($event_banner_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                        <?php else: ?>
                            <div class="event-placeholder">
                                <span>📅</span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="event-detail-info">
                        <h1 class="event-detail-title"><?php the_title(); ?></h1>

                        <div class="event-detail-meta">
                            <?php if ($event_datetime): ?>
                                <div class="event-detail-datetime">
                                    <span class="meta-icon">📅</span>
                                    <span class="meta-text"><?php echo date_i18n('d F Y H:i', strtotime($event_datetime)); ?></span>
                                </div>
                            <?php endif; ?>

                            <?php if ($event_location): ?>
                                <div class="event-detail-location">
                                    <span class="meta-icon">📍</span>
                                    <span class="meta-text"><?php echo esc_html($event_location); ?></span>
                                </div>
                            <?php endif; ?>

                            <?php if ($event_price): ?>
                                <div class="event-detail-price">
                                    <span class="meta-icon">💰</span>
                                    <span class="meta-text">Rp. <?php echo number_format((int)$event_price, 0, ',', '.'); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="event-detail-actions">
                            <button class="btn-register" onclick="handleRegistration()">
                                🎫 Beli Tiket
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Countdown Timer Section -->
                <?php if ($event_datetime): ?>
                <div class="countdown-container">
                    <div class="countdown-header">
                        <h3 class="countdown-title">⏰ Event Dimulai Dalam</h3>
                        <p class="countdown-subtitle">Jangan lewatkan event menarik ini!</p>
                    </div>
                    <div class="countdown-timer" id="countdownTimer" data-event-date="<?php echo esc_attr(date('Y-m-d H:i:s', strtotime($event_datetime))); ?>">
                        <div class="countdown-item">
                            <div class="countdown-value" id="days">00</div>
                            <div class="countdown-label">Hari</div>
                        </div>
                        <div class="countdown-item">
                            <div class="countdown-value" id="hours">00</div>
                            <div class="countdown-label">Jam</div>
                        </div>
                        <div class="countdown-item">
                            <div class="countdown-value" id="minutes">00</div>
                            <div class="countdown-label">Menit</div>
                        </div>
                        <div class="countdown-item">
                            <div class="countdown-value" id="seconds">00</div>
                            <div class="countdown-label">Detik</div>
                        </div>
                    </div>
                    <div class="countdown-progress">
                        <div class="progress-bar">
                            <div class="progress-fill" id="progressFill"></div>
                        </div>
                        <div class="progress-text" id="progressText">Memuat...</div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Event Content Section -->
                <div class="event-detail-content">
                    <!-- Tab Navigation -->
                    <div class="tab-navigation">
                        <button class="tab-button active" data-tab="description">
                            <span class="tab-icon">📝</span>
                            Deskripsi
                        </button>
                        <button class="tab-button" data-tab="requirements">
                            <span class="tab-icon">📋</span>
                            Syarat & Ketentuan
                        </button>
                    </div>

                    <!-- Tab Content -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="description">
                            <div class="entry-content">
                                <?php
                                the_content();

                                wp_link_pages(
                                    array(
                                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'twentytwentyone'),
                                        'after'  => '</div>',
                                    )
                                );
                                ?>
                            </div>
                        </div>
                        <div class="tab-pane" id="requirements">
                            <div class="requirements-content">
                                <?php
                                // Get custom field for requirements
                                $event_requirements = get_post_meta(get_the_ID(), 'event_requirements', true);
                                if ($event_requirements):
                                    echo wpautop($event_requirements);
                                else:
                                ?>
                                    <div class="default-requirements">
                                        <h3>📋 Syarat & Ketentuan Event</h3>

                                        <h4>📝 Pendaftaran</h4>
                                        <ul>
                                            <li>Peserta harus mendaftar secara online melalui form yang tersedia</li>
                                            <li>Pembayaran harus dilunasi sebelum batas waktu yang ditentukan</li>
                                            <li>Data peserta harus valid dan dapat diverifikasi</li>
                                        </ul>

                                        <h4>💳 Pembayaran</h4>
                                        <ul>
                                            <li>Pembayaran dapat dilakukan melalui transfer bank</li>
                                            <li>Bukti pembayaran harus dikirimkan maksimal 1x24 jam</li>
                                            <li>Pembayaran tidak dapat dikembalikan (non-refundable)</li>
                                        </ul>

                                        <h4>🎯 Ketentuan Peserta</h4>
                                        <ul>
                                            <li>Peserta harus hadir tepat waktu</li>
                                            <li>Membawa identitas diri yang sah</li>
                                            <li>Mematuhi semua peraturan yang berlaku</li>
                                            <li>Tidak membawa barang-barang yang dilarang</li>
                                        </ul>

                                        <h4>❌ Pembatalan</h4>
                                        <ul>
                                            <li>Pembatalan dapat dilakukan maksimal 7 hari sebelum event</li>
                                            <li>Pembatalan mendadak tidak akan diproses pengembaliannya</li>
                                            <li>Force majeure akan ditangani sesuai kebijakan penyelenggara</li>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>

        <?php
        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || get_comments_number()) {
            comments_template();
        }
        ?>

    <?php endwhile; // End of the loop. ?>

</main>

<style>
.event-detail-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem 1rem;
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.event-detail-header {
    display: flex;
    gap: 2rem;
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    width: 100%;
}

.event-detail-image {
    flex: 0 0 45%;
    position: relative;
}

.event-detail-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    min-height: 400px;
}

.event-placeholder {
    width: 100%;
    height: 400px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 4rem;
    color: white;
}

.event-detail-info {
    flex: 1;
    padding: 3rem;
    display: flex;
    flex-direction: column;
}

.event-detail-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2d3748;
    margin: 0 0 2rem 0;
    line-height: 1.2;
}

.event-detail-meta {
    flex: 1;
    margin-bottom: 2rem;
}

.event-detail-meta > div {
    display: flex;
    align-items: center;
    margin-bottom: 1.5rem;
    font-size: 1.1rem;
    color: #4a5568;
}

.event-detail-meta > div:last-child {
    margin-bottom: 0;
}

.meta-icon {
    font-size: 1.5rem;
    margin-right: 1rem;
    min-width: 40px;
    text-align: center;
}

.meta-text {
    font-weight: 500;
}

.event-detail-actions {
    display: flex;
    gap: 1rem;
    align-items: center;
}

.btn-register {
    background: #0073aa;
    color: white;
    border: none;
    padding: 1rem 2rem;
    border-radius: 8px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
}

.btn-register:hover {
    background: #005a87;
    transform: translateY(-2px);
    box-shadow: 0 4px 16px rgba(0, 115, 170, 0.3);
}

.btn-back {
    background: transparent;
    color: #0073aa;
    padding: 1rem 1.5rem;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 2px solid #0073aa;
}

.btn-back:hover {
    background: #0073aa;
    color: white;
    text-decoration: none;
}

.event-detail-content {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    width: 100%;
}

/* Countdown Timer Styles */
.countdown-container {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 16px;
    padding: 1rem 0.75rem;
    text-align: center;
    position: relative;
    overflow: hidden;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
    width: 100%;
}

.countdown-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>');
    background-size: 20px 20px;
    animation: movePattern 20s linear infinite;
}

@keyframes movePattern {
    0% { transform: translate(0, 0); }
    100% { transform: translate(20px, 20px); }
}

.countdown-header {
    position: relative;
    z-index: 2;
    margin-bottom: 1rem;
}

.countdown-title {
    color: #ffffff;
    font-size: 1.8rem;
    font-weight: 700;
    margin: 0 0 0.5rem 0;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.countdown-subtitle {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1rem;
    margin: 0;
    font-weight: 400;
}

.countdown-timer {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-bottom: 1rem;
    position: relative;
    z-index: 2;
}

.countdown-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    min-width: 80px;
}

.countdown-value {
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 12px;
    padding: 1rem;
    font-size: 2rem;
    font-weight: 800;
    color: #ffd700;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    min-width: 70px;
    min-height: 70px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.countdown-value::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
    transform: rotate(45deg);
    animation: shine 3s ease-in-out infinite;
}

@keyframes shine {
    0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
    50% { transform: translateX(100%) translateY(100%) rotate(45deg); }
    100% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
}

.countdown-value.pulse {
    animation: pulse 1s ease-in-out;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

.countdown-label {
    color: rgba(255, 255, 255, 0.9);
    font-size: 0.9rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-top: 0.5rem;
}

.countdown-progress {
    position: relative;
    z-index: 2;
}

.progress-bar {
    background: rgba(255, 255, 255, 0.2);
    height: 8px;
    border-radius: 4px;
    overflow: hidden;
    margin-bottom: 0.5rem;
}

.progress-fill {
    height: 100%;
    background: linear-gradient(90deg, #ffd700, #ffed4e);
    border-radius: 4px;
    transition: width 1s linear;
    box-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
}

.progress-text {
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.85rem;
    font-weight: 500;
}

/* Event Status */
.countdown-container.event-live {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
}

.countdown-container.event-ended {
    background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
}

/* Tab Navigation */
.tab-navigation {
    display: flex;
    background: #ffffff !important;
    border-bottom: 2px solid #e9ecef;
}

.tab-button {
    flex: 1;
    background: #ffffff !important;
    border: none;
    padding: 0.75rem 1rem;
    font-size: 1.1rem;
    font-weight: 600;
    color: #6c757d !important;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    border-bottom: 3px solid transparent;
}

.tab-button:hover {
    background: #ffffff !important;
    color: #0073aa;
}

.tab-button.active {
    background: #ffffff !important;
    color: #0073aa;
    border-bottom-color: #0073aa;
}

.tab-icon {
    font-size: 1.2rem;
}

/* Tab Content */
.tab-content {
    padding: 1.5rem;
}

.tab-pane {
    display: none;
    animation: fadeIn 0.3s ease-in;
}

.tab-pane.active {
    display: block;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Entry Content Styles */
.event-detail-content .entry-content {
    font-size: 1.1rem;
    line-height: 1.7;
    color: #2d3748;
}

/* Requirements Content Styles */
.requirements-content {
    font-size: 1.1rem;
    line-height: 1.7;
    color: #2d3748;
}

.requirements-content h3 {
    color: #2d3748;
    font-size: 1.8rem;
    margin: 0 0 1rem 0;
    font-weight: 600;
}

.requirements-content h4 {
    color: #0073aa;
    font-size: 1.3rem;
    margin: 1.2rem 0 0.6rem 0;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.requirements-content ul {
    margin-bottom: 0.8rem;
    padding-left: 1.5rem;
}

.requirements-content li {
    margin-bottom: 0.8rem;
    line-height: 1.6;
    position: relative;
}

.requirements-content li::marker {
    color: #0073aa;
    font-weight: bold;
}

.default-requirements {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 12px;
}

.default-requirements h3 {
    margin-top: 0;
    color: #0073aa;
}

.event-detail-content .entry-content h2 {
    color: #2d3748;
    font-size: 1.8rem;
    margin: 1.5rem 0 1rem 0;
    font-weight: 600;
}

.event-detail-content .entry-content h3 {
    color: #2d3748;
    font-size: 1.4rem;
    margin: 1.5rem 0 0.8rem 0;
    font-weight: 600;
}

.event-detail-content .entry-content p {
    margin-bottom: 1.2rem;
}

.event-detail-content .entry-content ul,
.event-detail-content .entry-content ol {
    margin-bottom: 1rem;
    padding-left: 1.5rem;
}

.event-detail-content .entry-content li {
    margin-bottom: 0.5rem;
}

@media (max-width: 968px) {
    .event-detail-header {
        flex-direction: column;
        gap: 0;
    }

    .event-detail-image {
        flex: none;
        width: 100%;
        height: 300px;
    }

    .event-detail-image img {
        min-height: 300px;
    }

    .event-placeholder {
        height: 300px;
        font-size: 3rem;
    }

    .event-detail-info {
        padding: 2.5rem;
    }

    .event-detail-title {
        font-size: 2rem;
        margin-bottom: 1.5rem;
    }

    .event-detail-actions {
        flex-direction: column;
        align-items: stretch;
    }

    .btn-register,
    .btn-back {
        text-align: center;
        padding: 0.8rem 1.5rem;
    }
}

@media (max-width: 968px) {
    .countdown-timer {
        gap: 1rem;
    }

    .countdown-item {
        min-width: 70px;
    }

    .countdown-value {
        font-size: 1.5rem;
        min-width: 60px;
        min-height: 60px;
        padding: 0.75rem;
    }

    .countdown-title {
        font-size: 1.5rem;
    }
}

@media (max-width: 480px) {
    .event-detail-container {
        padding: 1rem 0.5rem;
    }

    .event-detail-info {
        padding: 1.5rem;
    }

    .event-detail-content {
        padding: 2rem 1.5rem;
    }

    .event-detail-title {
        font-size: 1.8rem;
    }

    .event-detail-meta > div {
        font-size: 1rem;
    }

    .meta-icon {
        font-size: 1.2rem;
        margin-right: 0.8rem;
    }

    .countdown-container {
        padding: 0.75rem 0.5rem;
    }

    .countdown-timer {
        gap: 0.75rem;
    }

    .countdown-item {
        min-width: 60px;
    }

    .countdown-value {
        font-size: 1.2rem;
        min-width: 50px;
        min-height: 50px;
        padding: 0.5rem;
    }

    .countdown-label {
        font-size: 0.75rem;
    }

    .countdown-title {
        font-size: 1.3rem;
    }

    .countdown-subtitle {
        font-size: 0.9rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Countdown Timer Functionality
    initCountdownTimer();

    // Tab functionality
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabPanes = document.querySelectorAll('.tab-pane');

    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');

            // Remove active class from all buttons and panes
            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabPanes.forEach(pane => pane.classList.remove('active'));

            // Add active class to clicked button and corresponding pane
            this.classList.add('active');
            document.getElementById(targetTab).classList.add('active');
        });
    });

    // Registration button handler
    window.handleRegistration = function() {
        // You can customize this function to handle registration
        // For example: redirect to registration form, show modal, etc.

        // Simple alert for now - you can replace with actual registration logic
        const eventTitle = document.querySelector('.event-detail-title').textContent;

        // Create a custom modal instead of alert
        const modal = document.createElement('div');
        modal.className = 'modal-overlay';
        modal.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        `;

        modal.innerHTML = `
            <div style="
                background: white;
                padding: 2rem;
                border-radius: 16px;
                max-width: 500px;
                width: 90%;
                text-align: center;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            ">
                <div style="font-size: 3rem; margin-bottom: 1rem;">🎉</div>
                <h3 style="color: #2d3748; margin-bottom: 1rem;">Terima Kasih!</h3>
                <p style="color: #4a5568; margin-bottom: 1.5rem;">
                    Anda telah menunjukkan minat untuk event "<strong>${eventTitle}</strong>".
                </p>
                <p style="color: #4a5568; margin-bottom: 2rem;">
                    Tim kami akan segera menghubungi Anda untuk informasi lebih lanjut.
                </p>
                <button onclick="this.closest('.modal-overlay').remove()" style="
                    background: #0073aa;
                    color: white;
                    border: none;
                    padding: 0.75rem 2rem;
                    border-radius: 8px;
                    font-size: 1rem;
                    font-weight: 600;
                    cursor: pointer;
                ">
                    OK
                </button>
            </div>
        `;

        document.body.appendChild(modal);

        // Close modal when clicking outside
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.remove();
            }
        });
    };
});

// Countdown Timer Function
function initCountdownTimer() {
    const countdownTimer = document.getElementById('countdownTimer');

    if (!countdownTimer) return;

    const eventDate = new Date(countdownTimer.dataset.eventDate).getTime();
    const daysElement = document.getElementById('days');
    const hoursElement = document.getElementById('hours');
    const minutesElement = document.getElementById('minutes');
    const secondsElement = document.getElementById('seconds');
    const progressFill = document.getElementById('progressFill');
    const progressText = document.getElementById('progressText');
    const countdownContainer = document.querySelector('.countdown-container');
    const countdownTitle = document.querySelector('.countdown-title');
    const countdownSubtitle = document.querySelector('.countdown-subtitle');

    let previousValues = {
        days: -1,
        hours: -1,
        minutes: -1,
        seconds: -1
    };

    // Calculate initial total time for progress bar
    const now = new Date().getTime();
    const totalTime = eventDate - now;
    const startTime = now;

    function updateCountdown() {
        const now = new Date().getTime();
        const distance = eventDate - now;

        if (distance < 0) {
            // Event has ended
            daysElement.textContent = '00';
            hoursElement.textContent = '00';
            minutesElement.textContent = '00';
            secondsElement.textContent = '00';
            progressFill.style.width = '100%';
            progressText.textContent = 'Event telah berakhir';
            countdownContainer.className = 'countdown-container event-ended';
            countdownTitle.textContent = '🎉 Event Telah Berakhir';
            countdownSubtitle.textContent = 'Terima kasih telah berpartisipasi!';
            return;
        }

        // Calculate time components
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Update display with animation
        updateTimeValue(daysElement, days, previousValues.days);
        updateTimeValue(hoursElement, hours, previousValues.hours);
        updateTimeValue(minutesElement, minutes, previousValues.minutes);
        updateTimeValue(secondsElement, seconds, previousValues.seconds);

        // Update previous values
        previousValues = { days, hours, minutes, seconds };

        // Update progress bar
        const elapsed = now - startTime;
        const progress = Math.min(100, (elapsed / totalTime) * 100);
        progressFill.style.width = progress + '%';

        // Update progress text
        if (days > 0) {
            progressText.textContent = `${days} hari ${hours} jam lagi`;
        } else if (hours > 0) {
            progressText.textContent = `${hours} jam ${minutes} menit lagi`;
        } else if (minutes > 0) {
            progressText.textContent = `${minutes} menit ${seconds} detik lagi`;
        } else {
            progressText.textContent = `${seconds} detik lagi`;
            countdownContainer.className = 'countdown-container event-live';
            countdownTitle.textContent = '🔴 Event Sedang Berlangsung!';
            countdownSubtitle.textContent = 'Event sedang berlangsung sekarang!';
        }

        // Add urgency effect when less than 1 hour
        if (distance < 3600000) { // Less than 1 hour
            secondsElement.classList.add('pulse');
            setTimeout(() => secondsElement.classList.remove('pulse'), 1000);
        }

        // Add urgency effect when less than 10 minutes
        if (distance < 600000) { // Less than 10 minutes
            minutesElement.classList.add('pulse');
            setTimeout(() => minutesElement.classList.remove('pulse'), 1000);
        }
    }

    function updateTimeValue(element, value, previousValue) {
        const formattedValue = value.toString().padStart(2, '0');
        if (value !== previousValue) {
            element.textContent = formattedValue;
            element.classList.add('pulse');
            setTimeout(() => element.classList.remove('pulse'), 300);
        }
    }

    // Initial update
    updateCountdown();

    // Update every second
    setInterval(updateCountdown, 1000);

    // Add some interactive effects
    const countdownValues = document.querySelectorAll('.countdown-value');
    countdownValues.forEach(value => {
        value.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.1) rotate(5deg)';
        });

        value.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1) rotate(0deg)';
        });
    });
}
</script>

<?php get_footer();