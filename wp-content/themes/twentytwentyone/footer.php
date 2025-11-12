<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- #content -->

	<!-- Footer widgets removed for cleaner design -->

	<footer id="colophon" class="site-footer">
		<div class="footer-content">
			<div class="footer-section">
				<div class="footer-branding">
					<?php if ( has_custom_logo() ) : ?>
						<div class="site-logo"><?php the_custom_logo(); ?></div>
					<?php else : ?>
						<?php if ( get_bloginfo( 'name' ) ) : ?>
							<?php if ( is_front_page() && ! is_paged() ) : ?>
								<h3 class="footer-site-title"><?php bloginfo( 'name' ); ?></h3>
							<?php else : ?>
								<h3 class="footer-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h3>
							<?php endif; ?>
						<?php endif; ?>
					<?php endif; ?>
					<?php if ( get_bloginfo( 'description' ) && get_theme_mod( 'display_title_and_tagline', true ) ) : ?>
						<p class="footer-description"><?php bloginfo( 'description' ); ?></p>
					<?php endif; ?>
				</div>
			</div>

			<div class="footer-section">
				<h4 class="footer-title">Quick Links</h4>
				<?php if ( has_nav_menu( 'footer' ) ) : ?>
					<nav aria-label="<?php esc_attr_e( 'Secondary menu', 'twentytwentyone' ); ?>" class="footer-navigation">
						<ul class="footer-navigation-wrapper">
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'footer',
									'items_wrap'     => '%3$s',
									'container'      => false,
									'depth'          => 1,
									'link_before'    => '<span>',
									'link_after'     => '</span>',
									'fallback_cb'    => false,
								)
							);
							?>
						</ul><!-- .footer-navigation-wrapper -->
					</nav><!-- .footer-navigation -->
				<?php else : ?>
					<ul class="footer-links">
						<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
						<li><a href="<?php echo esc_url( get_post_type_archive_link( 'my_event' ) ); ?>">Events</a></li>
						<li><a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>">Blog</a></li>
						<li><a href="<?php echo esc_url( get_privacy_policy_url() ); ?>">Privacy Policy</a></li>
					</ul>
				<?php endif; ?>
			</div>

			<div class="footer-section">
				<h4 class="footer-title">Contact Info</h4>
				<div class="footer-contact">
					<div class="contact-item">
						<span class="contact-icon">📍</span>
						<span>123 Event Street, Jakarta, Indonesia</span>
					</div>
					<div class="contact-item">
						<span class="contact-icon">📧</span>
						<span>info@eventplatform.com</span>
					</div>
					<div class="contact-item">
						<span class="contact-icon">📞</span>
						<span>+62 21 1234 5678</span>
					</div>
				</div>
			</div>

			<div class="footer-section">
				<h4 class="footer-title">Follow Us</h4>
				<div class="social-links">
					<a href="#" class="social-link" aria-label="Facebook">
						<span class="social-icon">📘</span>
					</a>
					<a href="#" class="social-link" aria-label="Twitter">
						<span class="social-icon">🐦</span>
					</a>
					<a href="#" class="social-link" aria-label="Instagram">
						<span class="social-icon">📷</span>
					</a>
					<a href="#" class="social-link" aria-label="LinkedIn">
						<span class="social-icon">💼</span>
					</a>
				</div>
			</div>
		</div>

		<div class="footer-bottom">
			<div class="footer-copyright">
				<p>&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.</p>
				<?php
				if ( function_exists( 'the_privacy_policy_link' ) ) {
					the_privacy_policy_link( '<div class="privacy-policy">', '</div>' );
				}
				?>
			</div>
			<div class="footer-credits">
				<p>Designed with ❤️ by <a href="#">Event Platform Team</a></p>
			</div>
		</div>
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

<style>
/* Modern Footer Styles */
.site-footer {
    background: linear-gradient(135deg, #2d3748 0%, #1a202c 100%);
    color: #ffffff;
    padding: 3rem 0 1rem;
    margin-top: 4rem;
    box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.1);
}

.footer-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 3rem;
    margin-bottom: 2rem;
}

.footer-section {
    text-align: left;
}

.footer-branding {
    text-align: left;
}

.footer-site-title {
    color: #ffffff !important;
    font-size: 1.8rem;
    font-weight: 700;
    margin: 0 0 1rem 0;
    text-decoration: none;
}

.footer-site-title a {
    color: #ffffff !important;
    text-decoration: none;
    transition: color 0.3s ease;
}

.footer-site-title a:hover {
    color: #ffd700 !important;
}

.footer-description {
    color: rgba(255, 255, 255, 0.8);
    font-size: 1rem;
    line-height: 1.6;
    margin: 0;
}

.footer-title {
    color: #ffffff;
    font-size: 1.3rem;
    font-weight: 600;
    margin: 0 0 1.5rem 0;
    position: relative;
    padding-bottom: 0.5rem;
}

.footer-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 50px;
    height: 3px;
    background: linear-gradient(90deg, #667eea, #764ba2);
    border-radius: 2px;
}

.footer-navigation-wrapper,
.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-navigation-wrapper li,
.footer-links li {
    margin-bottom: 0.75rem;
}

.footer-navigation-wrapper a,
.footer-links a {
    color: rgba(255, 255, 255, 0.8) !important;
    text-decoration: none;
    font-size: 1rem;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
}

.footer-navigation-wrapper a:hover,
.footer-links a:hover {
    color: #ffd700 !important;
    transform: translateX(5px);
}

.footer-navigation-wrapper a::before,
.footer-links a::before {
    content: '→';
    margin-right: 0.5rem;
    opacity: 0;
    transition: all 0.3s ease;
}

.footer-navigation-wrapper a:hover::before,
.footer-links a:hover::before {
    opacity: 1;
    transform: translateX(-3px);
}

.footer-contact {
    margin-top: 1.5rem;
}

.contact-item {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.95rem;
}

.contact-icon {
    margin-right: 1rem;
    font-size: 1.2rem;
    min-width: 30px;
    text-align: center;
}

.social-links {
    display: flex;
    gap: 1rem;
    margin-top: 1.5rem;
}

.social-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 45px;
    height: 45px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    color: #ffffff !important;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 2px solid rgba(255, 255, 255, 0.2);
}

.social-link:hover {
    background: rgba(255, 255, 255, 0.2);
    border-color: rgba(255, 255, 255, 0.4);
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    color: #ffd700 !important;
}

.social-icon {
    font-size: 1.3rem;
}

.footer-bottom {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem 2rem 1rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.footer-copyright p,
.footer-credits p {
    margin: 0;
    color: rgba(255, 255, 255, 0.6);
    font-size: 0.9rem;
}

.footer-copyright a,
.footer-credits a {
    color: rgba(255, 255, 255, 0.8) !important;
    text-decoration: none;
    transition: color 0.3s ease;
}

.footer-copyright a:hover,
.footer-credits a:hover {
    color: #ffd700 !important;
}

/* Privacy Policy Link */
.privacy-policy {
    margin-top: 0.5rem;
}

.privacy-policy a {
    color: rgba(255, 255, 255, 0.6) !important;
    text-decoration: none;
    font-size: 0.85rem;
    transition: color 0.3s ease;
}

.privacy-policy a:hover {
    color: #ffd700 !important;
}

/* Responsive Design */
@media (max-width: 768px) {
    .site-footer {
        padding: 2rem 0 1rem;
    }

    .footer-content {
        grid-template-columns: 1fr;
        gap: 2rem;
        padding: 0 1rem;
    }

    .footer-bottom {
        flex-direction: column;
        text-align: center;
        padding: 1.5rem 1rem 1rem;
    }

    .footer-site-title {
        font-size: 1.5rem;
    }

    .social-links {
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .footer-section {
        text-align: center;
    }

    .footer-branding {
        text-align: center;
    }

    .footer-title::after {
        left: 50%;
        transform: translateX(-50%);
    }

    .contact-item {
        justify-content: center;
    }
}
</style>
