<?php
/* Template Name: Custom Front Page */
get_header();
?>

<main id="site-content" class="homepage">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-background">
            <div class="floating-shapes">
                <div class="shape shape-1"></div>
                <div class="shape shape-2"></div>
                <div class="shape shape-3"></div>
                <div class="shape shape-4"></div>
                <div class="shape shape-5"></div>
            </div>
        </div>
        <div class="hero-content">
            <div class="hero-text">
                <h1 class="hero-title">
                    <span class="title-gradient">Event Portal</span>
                    <span class="title-accent"></span>
                </h1>
                <p class="hero-subtitle">Temukan event terbaik dan bergabunglah dengan komunitas kami untuk pengalaman yang tak terlupakan</p>
                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-number" data-count="<?php echo wp_count_posts('my_event')->publish; ?>">0</span>
                        <span class="stat-label">Event Tersedia</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number" data-count="1500">0</span>
                        <span class="stat-label">Peserta Aktif</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number" data-count="50">0</span>
                        <span class="stat-label">Event Selesai</span>
                    </div>
                </div>
            </div>
            <div class="hero-actions">
                <a href="<?php echo esc_url( get_post_type_archive_link( 'my_event' ) ); ?>" class="hero-btn primary">
                    <span class="btn-icon">📅</span>
                    <span class="btn-text">Jelajahi Event</span>
                </a>
                <a href="<?php echo esc_url( home_url( '/upcoming-events' ) ); ?>" class="hero-btn secondary">
                    <span class="btn-icon">🌟</span>
                    <span class="btn-text">Event Terdekat</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Mengapa Memilih Event Portal?</h2>
                <p class="section-subtitle">Platform terpercaya untuk menemukan dan bergabung dengan event menarik</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🎯</div>
                    <h3 class="feature-title">Event Berkualitas</h3>
                    <p class="feature-description">Kurasi event terbaik dari berbagai kategori dengan standar tinggi</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🎫</div>
                    <h3 class="feature-title">Pendaftaran Mudah</h3>
                    <p class="feature-description">Proses pendaftaran yang cepat dan aman dengan pembayaran online</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">👥</div>
                    <h3 class="feature-title">Komunitas Aktif</h3>
                    <p class="feature-description">Bergabung dengan ribuan peserta dan jaringan profesional</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📱</div>
                    <h3 class="feature-title">Akses Mudah</h3>
                    <p class="feature-description">Informasi event selalu tersedia di genggaman Anda</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Upcoming Events Section -->
    <section class="upcoming-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Event Terdekat</h2>
                <p class="section-subtitle">Jangan lewatkan event menarik yang akan datang</p>
            </div>
            <?php
            // Tampilkan 3 event terdekat langsung di homepage
            echo do_shortcode('[upcoming_events count="3" title="" show_button="true"]');
            ?>
        </div>
    </section>
</main>

<style>
/* Homepage Styles */
.homepage {
    padding-top: 0;
}

/* Hero Section */
.hero-section {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    overflow: hidden;
}

.hero-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 1;
}

.floating-shapes {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    overflow: hidden;
}

.shape {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    animation: float 6s ease-in-out infinite;
}

.shape-1 {
    width: 120px;
    height: 120px;
    top: 10%;
    left: 10%;
    animation-delay: 0s;
}

.shape-2 {
    width: 80px;
    height: 80px;
    top: 70%;
    right: 15%;
    animation-delay: 1s;
}

.shape-3 {
    width: 60px;
    height: 60px;
    top: 30%;
    right: 25%;
    animation-delay: 2s;
}

.shape-4 {
    width: 100px;
    height: 100px;
    bottom: 20%;
    left: 15%;
    animation-delay: 3s;
}

.shape-5 {
    width: 40px;
    height: 40px;
    top: 60%;
    left: 30%;
    animation-delay: 4s;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0px) rotate(0deg);
        opacity: 0.7;
    }
    50% {
        transform: translateY(-30px) rotate(180deg);
        opacity: 0.9;
    }
}

.hero-content {
    position: relative;
    z-index: 2;
    text-align: center;
    max-width: 900px;
    padding: 0 2rem;
}

.hero-title {
    font-size: 4rem;
    font-weight: 900;
    margin: 0 0 1.5rem 0;
    line-height: 1.1;
}

.title-gradient {
    background: linear-gradient(45deg, #ffffff, #ffd700);
    background-clip: text;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: shimmer 3s ease-in-out infinite;
}

.title-accent {
    display: block;
    height: 4px;
    width: 100px;
    background: linear-gradient(90deg, #ffd700, #ffed4e, #ffd700);
    border-radius: 2px;
    margin: 1rem auto;
    animation: slideIn 1s ease-out;
}

@keyframes shimmer {
    0%, 100% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
}

@keyframes slideIn {
    from {
        transform: scaleX(0);
        opacity: 0;
    }
    to {
        transform: scaleX(1);
        opacity: 1;
    }
}

.hero-subtitle {
    font-size: 1.3rem;
    color: rgba(255, 255, 255, 0.9);
    margin: 0 0 3rem 0;
    line-height: 1.6;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.hero-stats {
    display: flex;
    justify-content: center;
    gap: 3rem;
    margin-bottom: 3rem;
    flex-wrap: wrap;
}

.stat-item {
    text-align: center;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    padding: 2rem 2.5rem;
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
    cursor: default;
}

.stat-item:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.15);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
}

.stat-number {
    display: block;
    font-size: 3rem;
    font-weight: 800;
    color: #ffd700;
    margin-bottom: 0.5rem;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.stat-label {
    display: block;
    font-size: 1rem;
    color: rgba(255, 255, 255, 0.8);
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.hero-actions {
    display: flex;
    justify-content: center;
    gap: 1.5rem;
    flex-wrap: wrap;
}

.hero-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem 2rem;
    border-radius: 50px;
    text-decoration: none !important;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    border: 2px solid transparent;
    position: relative;
    overflow: hidden;
}

.hero-btn.primary {
    background: rgba(255, 255, 255, 0.2);
    color: #ffffff !important;
    border-color: rgba(255, 255, 255, 0.3);
    backdrop-filter: blur(10px);
}

.hero-btn.primary:hover {
    background: rgba(255, 255, 255, 0.3);
    color: #ffffff !important;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    text-decoration: none !important;
}

.hero-btn.secondary {
    background: #ffd700;
    color: #2d3748 !important;
}

.hero-btn.secondary:hover {
    background: #ffed4e;
    color: #2d3748 !important;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 215, 0, 0.3);
    text-decoration: none !important;
}

.btn-icon {
    font-size: 1.3rem;
}

/* Features Section */
.features-section {
    padding: 6rem 0;
    background: #f8f9fa;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.section-header {
    text-align: center;
    margin-bottom: 4rem;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: #2d3748;
    margin: 0 0 1rem 0;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    background-clip: text;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.section-subtitle {
    font-size: 1.2rem;
    color: #6c757d;
    margin: 0;
    max-width: 600px;
    margin: 0 auto;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
}

.feature-card {
    background: #ffffff;
    padding: 2.5rem;
    border-radius: 20px;
    text-align: center;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.feature-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 40px rgba(0, 0, 0, 0.12);
    border-color: rgba(102, 126, 234, 0.2);
}

.feature-icon {
    font-size: 3rem;
    margin-bottom: 1.5rem;
    display: block;
}

.feature-title {
    font-size: 1.3rem;
    font-weight: 700;
    color: #2d3748;
    margin: 0 0 1rem 0;
}

.feature-description {
    font-size: 1rem;
    color: #6c757d;
    line-height: 1.6;
    margin: 0;
}

/* Upcoming Section */
.upcoming-section {
    padding: 6rem 0;
    background: #ffffff;
}

.upcoming-section .upcoming-events-shortcode {
    margin: 0 auto;
}

.upcoming-section .upcoming-events-header {
    display: none;
}

/* CTA Section */
.cta-section {
    padding: 6rem 0;
    background: linear-gradient(135deg, #2d3748 0%, #1a202c 100%);
    position: relative;
    overflow: hidden;
}

.cta-background {
    position: relative;
    z-index: 1;
}

.cta-content {
    text-align: center;
    max-width: 700px;
    margin: 0 auto;
    padding: 0 2rem;
}

.cta-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: #ffffff;
    margin: 0 0 1rem 0;
}

.cta-subtitle {
    font-size: 1.2rem;
    color: rgba(255, 255, 255, 0.8);
    margin: 0 0 2rem 0;
    line-height: 1.6;
}

.cta-actions {
    display: flex;
    justify-content: center;
}

.cta-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #ffffff !important;
    padding: 1rem 2.5rem;
    border-radius: 50px;
    text-decoration: none !important;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    border: none;
}

.cta-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    color: #ffffff !important;
    text-decoration: none !important;
}

.cta-arrow {
    font-size: 1.2rem;
    transition: transform 0.3s ease;
}

.cta-btn:hover .cta-arrow {
    transform: translateX(5px);
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }

    .hero-subtitle {
        font-size: 1.1rem;
    }

    .hero-stats {
        gap: 1.5rem;
    }

    .stat-item {
        padding: 1.5rem 1rem;
    }

    .stat-number {
        font-size: 2rem;
    }

    .hero-actions {
        flex-direction: column;
        align-items: center;
    }

    .hero-btn {
        width: 100%;
        max-width: 300px;
        justify-content: center;
    }

    .section-title {
        font-size: 2rem;
    }

    .features-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    .feature-card {
        padding: 2rem;
    }

    .cta-title {
        font-size: 2rem;
    }

    .shape {
        display: none;
    }
}

@media (max-width: 480px) {
    .hero-title {
        font-size: 2rem;
    }

    .hero-subtitle {
        font-size: 1rem;
    }

    .stat-item {
        padding: 1rem 0.75rem;
    }

    .section-title {
        font-size: 1.8rem;
    }

    .feature-card {
        padding: 1.5rem;
    }

    .cta-title {
        font-size: 1.8rem;
    }

    .cta-btn {
        padding: 0.875rem 2rem;
        font-size: 1rem;
    }
}

/* Hide default upcoming events header on homepage */
.homepage .upcoming-events-header {
    display: none !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animate counter numbers
    const animateCounters = () => {
        const counters = document.querySelectorAll('.stat-number');

        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-count'));
            const duration = 2000;
            const increment = target / (duration / 16);
            let current = 0;

            const updateCounter = () => {
                current += increment;
                if (current < target) {
                    counter.textContent = Math.floor(current).toLocaleString('id-ID');
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.textContent = target.toLocaleString('id-ID');
                }
            };

            // Start animation when element is in viewport
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        updateCounter();
                        observer.unobserve(entry.target);
                    }
                });
            });

            observer.observe(counter);
        });
    };

    // Add parallax effect to floating shapes
    const addParallaxEffect = () => {
        const shapes = document.querySelectorAll('.shape');

        document.addEventListener('mousemove', (e) => {
            const mouseX = e.clientX / window.innerWidth;
            const mouseY = e.clientY / window.innerHeight;

            shapes.forEach((shape, index) => {
                const speed = (index + 1) * 30;
                const x = (mouseX - 0.5) * speed;
                const y = (mouseY - 0.5) * speed;

                shape.style.transform = `translate(${x}px, ${y}px)`;
            });
        });
    };

    // Add hover effects to feature cards
    const addFeatureEffects = () => {
        const featureCards = document.querySelectorAll('.feature-card');

        featureCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px) scale(1.02)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });
    };

    // Add smooth scroll for anchor links
    const addSmoothScroll = () => {
        const links = document.querySelectorAll('a[href^="#"]');

        links.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetSection = document.querySelector(targetId);

                if (targetSection) {
                    targetSection.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    };

    // Initialize all animations
    animateCounters();
    addParallaxEffect();
    addFeatureEffects();
    addSmoothScroll();

    // Add scroll reveal animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const scrollObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                scrollObserver.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe elements for scroll animations
    const elementsToObserve = document.querySelectorAll('.feature-card, .section-header');
    elementsToObserve.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        scrollObserver.observe(el);
    });
});
</script>

<?php get_footer(); ?>
