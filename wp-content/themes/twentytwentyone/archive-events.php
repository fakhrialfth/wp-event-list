<?php
/**
 * Template Name: Archive Events
 * Template Post Type: my_event
 */

get_header(); ?>

<main id="site-content" role="main">
  <header class="page-header modern-page-header">
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
          <span class="title-text">Daftar Event</span>
          <span class="title-accent"></span>
        </h1>
        <p class="header-description">Temukan event terbaik dan bergabunglah dengan komunitas kami</p>
      </div>
      <div class="header-stats">
        <div class="stat-item">
          <span class="stat-number"><?php echo wp_count_posts('my_event')->publish; ?></span>
          <span class="stat-label">Event Tersedia</span>
        </div>
      </div>
    </div>
  </header>

  <?php
  // Query untuk menampilkan semua event (CPT my_event)
  $args = array(
    'post_type' => 'my_event',
    'posts_per_page' => 10,
    'orderby' => 'meta_value',
    'meta_key' => 'event_datetime',
    'order' => 'ASC'
  );
  $events = new WP_Query($args);

  if ($events->have_posts()) :
    echo '<div class="event-slider-container">';
    echo '<button class="slider-arrow slider-arrow-left" id="sliderLeft">‹</button>';
    echo '<div class="event-slider" id="eventSlider">';
    while ($events->have_posts()) : $events->the_post();

      // Ambil field PODS
      $event_datetime = get_post_meta(get_the_ID(), 'event_datetime', true);
      $event_location = get_post_meta(get_the_ID(), 'event_location', true);
      $event_price = get_post_meta(get_the_ID(), 'event_price', true);
      $event_banner_id = get_post_meta(get_the_ID(), 'event_banner', true);
      $event_banner_url = wp_get_attachment_url($event_banner_id);
      ?>

      <article class="event-card" id="post-<?php the_ID(); ?>">
        <?php if ($event_banner_url): ?>
          <div class="event-banner">
            <img src="<?php echo esc_url($event_banner_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" width="300">
          </div>
        <?php endif; ?>

        <div class="event-content">
          <header class="event-header">
            <h2 class="event-title">
              <a href="<?php the_permalink(); ?>" rel="bookmark">
                <?php the_title(); ?>
              </a>
            </h2>
          </header>

          <div class="event-meta">
            <?php if ($event_datetime): ?>
              <div class="event-datetime">
                <?php echo date_i18n('d F Y H:i', strtotime($event_datetime)); ?>
              </div>
            <?php endif; ?>

            <?php if ($event_location): ?>
              <div class="event-location">
                <?php echo esc_html($event_location); ?>
              </div>
            <?php endif; ?>

            <?php if ($event_price): ?>
              <div class="event-price">
                Rp. <?php echo number_format((int)$event_price, 0, ',', '.'); ?>
              </div>
            <?php endif; ?>
          </div>

          <div class="event-footer">
            <a href="<?php the_permalink(); ?>" class="event-link">
              Lihat Detail Event →
            </a>
          </div>
        </div>
      </article>

      <?php
    endwhile;
    echo '</div>';
    echo '<button class="slider-arrow slider-arrow-right" id="sliderRight">›</button>';
    echo '</div>';
    wp_reset_postdata();
  else :
    echo '<p>Belum ada event yang tersedia.</p>';
  endif;
  ?>
</main>

<style>
.event-slider-container {
  position: relative;
  width: 100%;
  max-width: 1200px;
  margin: 2rem auto;
  overflow: hidden;
  padding: 0 60px;
}

.event-slider {
  display: flex;
  overflow-x: hidden;
  scroll-behavior: smooth;
  gap: 1.5rem;
  padding: 1rem 0;
  scrollbar-width: none;
  -ms-overflow-style: none;
}

.event-slider::-webkit-scrollbar {
  display: none;
}

.event-card {
  flex: 0 0 350px;
  background: #fff;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  display: flex;
  flex-direction: column;
}

.event-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
}

.slider-arrow {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: #ffffff !important;
  color: #0073aa !important;
  border: none !important;
  width: 60px;
  height: 60px;
  border-radius: 50%;
  font-size: 26px;
  cursor: pointer;
  z-index: 15;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
  outline: none !important;
  transition: all 0.3s ease;
}

.slider-arrow:hover {
  transform: translateY(-50%) scale(1.1);
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.3);
  background: #f8f9fa !important;
}

.slider-arrow:active {
  transform: translateY(-50%) scale(0.95);
  box-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
}

.slider-arrow:disabled {
  background: #e9ecef !important;
  cursor: not-allowed;
  transform: translateY(-50%);
  color: #6c757d !important;
}

.slider-arrow-left {
  left: 20px;
}

.slider-arrow-right {
  right: 20px;
}

.event-banner img {
  width: 100%;
  height: 180px;
  object-fit: cover;
}

.event-content {
  padding: 1.2rem;
  flex: 1;
  display: flex;
  flex-direction: column;
}

.event-title {
  margin: 0 0 0.8rem 0;
  font-size: 1.1rem;
  line-height: 1.3;
  font-weight: 600;
  color: #333;
}

.event-title a {
  text-decoration: none;
  color: inherit;
}

.event-title a:hover {
  color: #0073aa;
}

.event-meta {
  margin-bottom: 1rem;
  flex: 1;
}

.event-meta > div {
  margin-bottom: 0.5rem;
  font-size: 0.85rem;
  color: #666;
  display: flex;
  align-items: center;
}

.event-meta > div:last-child {
  margin-bottom: 0;
}

.event-datetime::before {
  content: "📅";
  margin-right: 0.5rem;
  font-size: 1rem;
}

.event-location::before {
  content: "📍";
  margin-right: 0.5rem;
  font-size: 1rem;
}

.event-price::before {
  content: "💰";
  margin-right: 0.5rem;
  font-size: 1rem;
}

.event-link {
  display: inline-block;
  background: #0073aa !important;
  color: #fff !important;
  padding: 0.6rem 1.2rem;
  text-decoration: none;
  border-radius: 6px;
  transition: all 0.3s ease;
  font-size: 0.85rem;
  font-weight: 500;
  text-align: center;
  margin-top: auto;
  cursor: pointer;
  border: none;
  outline: none;
  opacity: 1 !important;
  visibility: visible !important;
}

.event-link:hover {
  background: #005a87 !important;
  transform: translateY(-1px);
}

.event-link:active {
  background: #0073aa !important;
  color: #fff !important;
  transform: translateY(0);
}

.event-link:focus {
  outline: 2px solid #0073aa;
  outline-offset: 2px;
}

.event-link:visited {
  background: #0073aa !important;
  color: #fff !important;
}

@media (max-width: 768px) {
  .event-slider-container {
    margin: 1rem;
  }

  .event-card {
    flex: 0 0 300px;
  }

  .slider-arrow {
    width: 40px;
    height: 40px;
    font-size: 18px;
  }

  .slider-arrow-left {
    left: 10px;
  }

  .slider-arrow-right {
    right: 10px;
  }

  .event-meta strong {
    min-width: auto;
    display: block;
    margin-bottom: 0.25rem;
  }
}

/* Modern Page Header Styles */
.modern-page-header {
  position: relative;
  padding: 4rem 2rem 3rem;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  overflow: hidden;
  margin-bottom: 2rem;
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
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 3rem;
}

.header-text {
  flex: 1;
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

.header-stats {
  display: flex;
  gap: 2rem;
  flex-shrink: 0;
}

.stat-item {
  text-align: center;
  background: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(10px);
  padding: 1.5rem 2rem;
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
  font-size: 2.5rem;
  font-weight: 800;
  color: #ffd700;
  margin-bottom: 0.5rem;
  text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
  animation: countUp 2s ease-out;
}

.stat-label {
  display: block;
  font-size: 0.9rem;
  color: rgba(255, 255, 255, 0.8);
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: 1px;
}

@keyframes countUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Responsive Design */
@media (max-width: 768px) {
  .modern-page-header {
    padding: 3rem 1rem 2rem;
  }

  .header-content {
    flex-direction: column;
    text-align: center;
    gap: 2rem;
  }

  .page-title {
    font-size: 2.5rem;
    justify-content: center;
  }

  .header-description {
    font-size: 1.1rem;
    margin: 0 auto;
  }

  .header-stats {
    justify-content: center;
    gap: 1rem;
  }

  .stat-item {
    padding: 1rem 1.5rem;
  }

  .stat-number {
    font-size: 2rem;
  }

  .shape {
    display: none;
  }
}

@media (max-width: 480px) {
  .modern-page-header {
    padding: 2rem 1rem 1.5rem;
  }

  .page-title {
    font-size: 2rem;
  }

  .header-description {
    font-size: 1rem;
  }

  .header-stats {
    flex-direction: column;
    gap: 1rem;
    width: 100%;
  }

  .stat-item {
    width: 100%;
    max-width: 250px;
  }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Animate header stats numbers
  const animateNumbers = () => {
    const statNumbers = document.querySelectorAll('.stat-number');

    statNumbers.forEach(stat => {
      const targetValue = parseInt(stat.textContent);
      const duration = 2000;
      const startValue = 0;
      const increment = targetValue / (duration / 16);
      let currentValue = startValue;

      const updateNumber = () => {
        currentValue += increment;
        if (currentValue < targetValue) {
          stat.textContent = Math.floor(currentValue).toLocaleString('id-ID');
          requestAnimationFrame(updateNumber);
        } else {
          stat.textContent = targetValue.toLocaleString('id-ID');
        }
      };

      // Start animation when element is in viewport
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            updateNumber();
            observer.unobserve(entry.target);
          }
        });
      });

      observer.observe(stat);
    });
  };

  // Add hover effects to header elements
  const addHoverEffects = () => {
    const headerTitle = document.querySelector('.title-text');
    const statItems = document.querySelectorAll('.stat-item');

    // Title glow effect
    headerTitle.addEventListener('mouseenter', function() {
      this.style.textShadow = '0 0 20px rgba(255, 215, 0, 0.5)';
    });

    headerTitle.addEventListener('mouseleave', function() {
      this.style.textShadow = '0 2px 4px rgba(0, 0, 0, 0.3)';
    });

    // Stat items bounce effect
    statItems.forEach(item => {
      item.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-8px) scale(1.05)';
      });

      item.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(-5px) scale(1)';
      });
    });
  };

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

  // Initialize all animations
  animateNumbers();
  addHoverEffects();
  addParallaxEffect();

  // Original slider functionality
  const slider = document.getElementById('eventSlider');
  const leftButton = document.getElementById('sliderLeft');
  const rightButton = document.getElementById('sliderRight');

  if (!slider || !leftButton || !rightButton) return;

  const cardWidth = 350; // Width of event card
  const gap = 24; // Gap between cards (1.5rem)
  const scrollAmount = cardWidth + gap;

  function updateButtons() {
    const maxScroll = slider.scrollWidth - slider.clientWidth;

    // Disable left button if at start
    leftButton.disabled = slider.scrollLeft <= 0;

    // Disable right button if at end
    rightButton.disabled = slider.scrollLeft >= maxScroll - 1;
  }

  function scrollLeft() {
    slider.scrollBy({
      left: -scrollAmount,
      behavior: 'smooth'
    });
  }

  function scrollRight() {
    slider.scrollBy({
      left: scrollAmount,
      behavior: 'smooth'
    });
  }

  // Add click event listeners
  leftButton.addEventListener('click', scrollLeft);
  rightButton.addEventListener('click', scrollRight);

  // Prevent event detail buttons from being hidden
  const eventLinks = document.querySelectorAll('.event-link');
  eventLinks.forEach(link => {
    link.addEventListener('click', function(e) {
      // Force button styles to stay consistent
      this.style.background = '#0073aa !important';
      this.style.color = '#fff !important';
      this.style.opacity = '1 !important';
      this.style.visibility = 'visible !important';
      this.style.display = 'inline-block';
    });

    // Also handle mousedown and mouseup to prevent color changes
    link.addEventListener('mousedown', function(e) {
      this.style.background = '#0073aa !important';
      this.style.color = '#fff !important';
    });

    link.addEventListener('mouseup', function(e) {
      this.style.background = '#0073aa !important';
      this.style.color = '#fff !important';
    });
  });

  // Update button states on scroll
  slider.addEventListener('scroll', updateButtons);

  // Initial button state
  updateButtons();

  // Handle window resize
  window.addEventListener('resize', function() {
    updateButtons();
  });
});
</script>

<?php get_footer();
