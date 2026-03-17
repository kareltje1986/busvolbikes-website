<?php
/**
 * Template Name: Bus vol Bikes Homepage
 * Description: Custom homepage voor Bus vol Bikes zonder fietsenlijst
 */

get_header();
?>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-bg" style="background-image: linear-gradient(rgba(26, 35, 50, 0.85), rgba(26, 35, 50, 0.9)), url('<?php echo get_template_directory_uri(); ?>/images/hero-bg.jpg');"></div>
    <div class="hero-content">
        <img src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" alt="Bus vol Bikes" class="hero-logo">
        <div class="hero-badge">✨ 2026 Collectie</div>
        <h1 class="hero-title">Jouw perfecte <span class="gradient-text">e-bike</span> wacht op je</h1>
        <p class="hero-subtitle">Betrouwbare tweedehands elektrische fietsen, rijklaar geleverd met 6 maanden garantie. Persoonlijk advies in Raalte en omgeving.</p>
        <div class="hero-buttons">
            <a href="#over-ons" class="btn btn-primary">Meer over ons</a>
            <a href="#contact" class="btn btn-secondary">Maak afspraak</a>
        </div>
        <div class="hero-stats">
            <div class="stat">
                <span class="stat-number">150+</span>
                <span class="stat-label">Tevreden klanten</span>
            </div>
            <div class="stat">
                <span class="stat-number">6</span>
                <span class="stat-label">Maanden garantie</span>
            </div>
            <div class="stat">
                <span class="stat-number">€45</span>
                <span class="stat-label">Bezorging NL</span>
            </div>
        </div>
    </div>
</section>

<!-- Over Ons / Wie ben ik -->
<section id="over-ons" class="section section-about">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">Wie ben ik?</span>
            <h2 class="section-title">Van fietsenzaak <span class="highlight">naar jou</span></h2>
            <p class="section-subtitle">Mijn naam is Erwin Timmer. Met Bus vol Bikes geef ik gebruikte fietsen een tweede kans.</p>
        </div>
        
        <div class="about-erwin">
            <p>Ik koop goede fietsen in bij lokale fietszaken, knap ze grondig op en zorg voor een nieuwe eigenaar. Zo maken we samen fietsen bereikbaar én dragen we bij aan een groenere toekomst.</p>
        </div>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="2" y="7" width="16" height="10" rx="2"></rect>
                        <line x1="22" y1="11" x2="22" y2="13"></line>
                        <line x1="6" y1="11" x2="6" y2="13"></line>
                        <line x1="10" y1="11" x2="10" y2="13"></line>
                        <line x1="14" y1="11" x2="14" y2="13"></line>
                    </svg>
                </div>
                <h3>Rijklaar geleverd</h3>
                <p>Geen gedoe. Je fietst direct de weg op met volle accu en perfecte afstelling.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                </div>
                <h3>6 maanden garantie</h3>
                <p>Op iedere fiets, inclusief motor en elektronica. Geen onverwachte kosten.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                </div>
                <h3>10 dagen omruilgarantie</h3>
                <p>Past de fiets niet? Binnen 10 dagen ruilen voor een andere. Geen vragen.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                    </svg>
                </div>
                <h3>Ook 's avonds open</h3>
                <p>Proefrit maken na je werk? Geen probleem. Flexibele afspraaktijden.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="1" y="3" width="15" height="13"></rect>
                        <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                        <circle cx="5.5" cy="18.5" r="2.5"></circle>
                        <circle cx="18.5" cy="18.5" r="2.5"></circle>
                    </svg>
                </div>
                <h3>Bezorging met track & trace</h3>
                <p>Voor €45,- door heel Nederland. Altijd track & trace, ophalen kan ook.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <h3>Persoonlijke service</h3>
                <p>Geen poespas, gewoon goede fietsen tegen eerlijke prijzen. Dat is waar we voor staan.</p>
            </div>
        </div>
        
        <!-- LEVIT Dealer Banner -->
        <div class="levit-banner">
            <div class="levit-content">
                <span class="levit-badge">Nieuw!</span>
                <h3>Wij zijn officieel LEVIT dealer</h3>
                <p>Modern, innovatief fietsmerk uit Nederland. Plan je proefrit en ervaar het zelf!</p>
            </div>
        </div>
        
        <!-- Locatie -->
        <div class="location-section">
            <div class="location-image">
                <img src="<?php echo get_template_directory_uri(); ?>/images/locatie.jpg" alt="Bus vol Bikes in Raalte">
            </div>
            <div class="location-content">
                <span class="section-tag">Onze locatie</span>
                <h3>Kom langs in Raalte</h3>
                <p>We zijn gevestigd aan de Ampèrestraat 17 in Raalte. Kom gerust langs voor een kop koffie en persoonlijk advies.</p>
                <div class="location-info">
                    <div class="info-item">
                        <span class="info-icon">📍</span>
                        <span>Ampèrestraat 17, 8102 PN Raalte</span>
                    </div>
                    <div class="info-item">
                        <span class="info-icon">🕐</span>
                        <span>Op afspraak, ook 's avonds</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Reparatie Section -->
<section id="reparatie" class="section section-service">
    <div class="container">
        <div class="service-content">
            <div class="service-text">
                <span class="section-tag">Reparatie & Onderhoud</span>
                <h2 class="section-title">Problemen met je <span class="highlight">e-bike?</span></h2>
                <p class="service-intro">Ook als je je fiets niet bij ons hebt gekocht, helpen we je graag. Van kleine reparaties tot complete revisies.</p>
                
                <div class="service-list">
                    <div class="service-item">
                        <span class="service-check">✓</span>
                        <div>
                            <h4>Banden & Wielen</h4>
                            <p>Lekke band plakken, wielen richten, nieuwe banden monteren</p>
                        </div>
                    </div>
                    <div class="service-item">
                        <span class="service-check">✓</span>
                        <div>
                            <h4>Remmen</h4>
                            <p>Afstellen, vervangen, schijfremmen onderhouden</p>
                        </div>
                    </div>
                    <div class="service-item">
                        <span class="service-check">✓</span>
                        <div>
                            <h4>Accu & Elektronica</h4>
                            <p>Diagnose, software-updates, foutcode-uitlezing</p>
                        </div>
                    </div>
                    <div class="service-item">
                        <span class="service-check">✓</span>
                        <div>
                            <h4>Periodiek onderhoud</h4>
                            <p>Jaarlijkse service om je fiets in topconditie te houden</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="service-visual">
                <div class="service-card">
                    <span class="service-icon">🔧</span>
                    <h3>Direct aan de slag</h3>
                    <p>Geen wachttijden van weken. Snelle diagnose, eerlijke prijs.</p>
                    <a href="#contact" class="btn btn-outline">Afspraak maken</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="section section-contact">
    <div class="container">
        <div class="contact-grid">
            <div class="contact-info">
                <span class="section-tag">Contact</span>
                <h2 class="section-title">Laten we <span class="highlight">afspreken</span></h2>
                <p class="contact-intro">Wil je een fiets bekijken, proefrijden, of heb je vragen? Neem gerust contact op.</p>
                
                <div class="contact-methods">
                    <div class="contact-method">
                        <span class="contact-icon">👤</span>
                        <div>
                            <h4>Erwin Timmer</h4>
                            <p>Eigenaar Bus vol Bikes</p>
                        </div>
                    </div>
                    <div class="contact-method">
                        <span class="contact-icon">📍</span>
                        <div>
                            <h4>Adres</h4>
                            <p>Ampèrestraat 17<br>8102 PN Raalte</p>
                        </div>
                    </div>
                    <div class="contact-method">
                        <span class="contact-icon">📱</span>
                        <div>
                            <h4>Telefoon</h4>
                            <p>06-39238249</p>
                        </div>
                    </div>
                    <div class="contact-method">
                        <span class="contact-icon">✉️</span>
                        <div>
                            <h4>Email</h4>
                            <p>info@busvolbikes.nl</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="contact-cta">
                <div class="cta-card">
                    <span class="cta-icon">⚡</span>
                    <h3>Direct beschikbaar</h3>
                    <p>Proefrit mogelijk op afspraak, ook 's avonds of in het weekend.</p>
                    <div class="cta-buttons">
                        <a href="mailto:info@busvolbikes.nl" class="btn btn-primary">Mail ons</a>
                        <a href="tel:0639238249" class="btn btn-secondary">Bel 06-39238249</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
