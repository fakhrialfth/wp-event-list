<?php
/**
 * Template Name: Upcoming Events
 * Template Post Type: page
 */

get_header(); ?>

<main id="site-content" role="main" class="upcoming-events-page">

    <?php while (have_posts()) : the_post(); ?>
        <header class="page-header upcoming-events-page-header">
            <div class="header-background">
                <div class="floating-shapes">
                    <div class="shape shape-1"></div>
                    <div class="shape shape-2"></div>
                    <div class="shape shape-3"></div>
                </div>
            </div>
            <div class="header-content">
                <div class="header-text">
                    <h1 class="page-title">
                        <span class="title-text"><?php the_title(); ?></span>
                        <span class="title-accent"></span>
                    </h1>
                    <?php if (get_the_content() && !empty(get_the_content())) : ?>
                        <div class="header-description">
                            <?php the_content(); ?>
                        </div>
                    <?php else : ?>
                        <div class="header-description">
                            Temukan event terdekat yang akan datang dan jadwalk kehadiran Anda untuk tidak ketinggalan momen berharga!
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </header>

        <div class="upcoming-events-content">
            <?php
            // Tampilkan shortcode upcoming_events
            echo do_shortcode('[upcoming_events count="3" title="Event Terdekat" show_button="true"]');
            ?>
        </div>

    <?php endwhile; // End of the loop. ?>

</main>

<style>
/* Upcoming Events Page Styles */
.upcoming-events-page {
    padding-top: 0;
}

.upcoming-events-page-header {
    position: relative;
    padding: 4rem 2rem 3rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    overflow: hidden;
    margin-bottom: 0;
    border-radius: 0 0 30px 30px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
}

.header-background {
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
    width: 80px;
    height: 80px;
    top: 20%;
    left: 10%;
    animation-delay: 0s;
}

.shape-2 {
    width: 60px;
    height: 60px;
    top: 60%;
    right: 15%;
    animation-delay: 2s;
}

.shape-3 {
    width: 40px;
    height: 40px;
    bottom: 20%;
    left: 20%;
    animation-delay: 4s;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0px) rotate(0deg);
        opacity: 0.7;
    }
    50% {
        transform: translateY(-20px) rotate(180deg);
        opacity: 0.9;
    }
}

.header-content {
    position: relative;
    z-index: 2;
    max-width: 1200px;
    margin: 0 auto;
    text-align: center;
}

.header-text {
    color: #ffffff;
}

.page-title {
    position: relative;
    font-size: 3rem;
    font-weight: 800;
    margin: 0 0 1rem 0;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
}

.title-text {
    position: relative;
    z-index: 2;
    background: linear-gradient(45deg, #ffffff, #ffd700);
    background-clip: text;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: shimmer 3s ease-in-out infinite;
}

.title-accent {
    position: absolute;
    bottom: -5px;
    left: 0;
    height: 4px;
    width: 100%;
    background: linear-gradient(90deg, #ffd700, #ffed4e, #ffd700);
    border-radius: 2px;
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

.header-description {
    font-size: 1.2rem;
    color: rgba(255, 255, 255, 0.9);
    margin: 0;
    max-width: 600px;
    line-height: 1.6;
}

.upcoming-events-content {
    background: #f8f9fa;
    padding: 3rem 0;
}

/* Override default upcoming-events styles for page */
.upcoming-events-page .upcoming-events-shortcode {
    margin: 0 auto;
    padding: 0 1rem;
}

.upcoming-events-page .upcoming-events-header {
    display: none; /* Hide header inside shortcode since page has its own */
}

/* Responsive Design */
@media (max-width: 768px) {
    .upcoming-events-page-header {
        padding: 3rem 1rem 2rem;
    }

    .page-title {
        font-size: 2.5rem;
    }

    .header-description {
        font-size: 1.1rem;
        margin: 0 auto;
    }

    .shape {
        display: none;
    }
}

@media (max-width: 480px) {
    .upcoming-events-page-header {
        padding: 2rem 1rem 1.5rem;
    }

    .page-title {
        font-size: 2rem;
    }

    .header-description {
        font-size: 1rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add parallax effect to floating shapes
    const addParallaxEffect = () => {
        const shapes = document.querySelectorAll('.shape');

        document.addEventListener('mousemove', (e) => {
            const mouseX = e.clientX / window.innerWidth;
            const mouseY = e.clientY / window.innerHeight;

            shapes.forEach((shape, index) => {
                const speed = (index + 1) * 20;
                const x = (mouseX - 0.5) * speed;
                const y = (mouseY - 0.5) * speed;

                shape.style.transform = `translate(${x}px, ${y}px)`;
            });
        });
    };

    // Initialize animations
    addParallaxEffect();
});
</script>

<?php get_footer();