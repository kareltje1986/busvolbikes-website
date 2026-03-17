# WordPress Template - Bus vol Bikes Homepage

Dit is een **WordPress template** voor de Bus vol Bikes homepage **zonder de fietsenlijst**. Perfect als je alleen een informatieve pagina wilt met je USP's, contactgegevens en diensten.

## Wat zit erin?

- ✅ Hero sectie met call-to-action
- ✅ "Wie ben ik?" sectie (Erwin Timmer)
- ✅ 6 USP's (Rijklaar, garantie, omruil, avondopen, bezorging, service)
- ✅ LEVIT dealer banner
- ✅ Locatie informatie
- ✅ Reparatie & onderhoud sectie
- ✅ Contact sectie met alle gegevens
- ✅ Mobiel responsive
- ✅ ❌ **GEEN fietsenlijst** (zoals gevraagd)

## Installatie in WordPress

### Stap 1: Bestanden uploaden
1. Upload `wordpress-template.php` naar je WordPress theme folder (bijv. `/wp-content/themes/jouw-theme/`)
2. Upload `wordpress-style.css` naar dezelfde folder
3. Maak een `images` folder en upload je logo en afbeeldingen

### Stap 2: Page template activeren
1. Ga in WordPress naar **Pagina's → Nieuwe pagina**
2. Geef de pagina een titel (bijv. "Home")
3. Kies bij **Page Attributes** → **Template** de optie "Bus vol Bikes Homepage"
4. Publiceer de pagina

### Stap 3: Als homepage instellen
1. Ga naar **Instellingen → Lezen**
2. Selecteer bij "Een statische pagina" je net aangemaakte homepage
3. Sla op

### Stap 4: CSS koppelen
Voeg dit toe aan je theme's `header.php` (in de `<head>`):
```html
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/wordpress-style.css">
```

Of gebruik WordPress's `wp_enqueue_style` in je `functions.php`:
```php
function busvolbikes_styles() {
    wp_enqueue_style('busvolbikes-custom', get_template_directory_uri() . '/wordpress-style.css');
}
add_action('wp_enqueue_scripts', 'busvolbikes_styles');
```

## Afbeeldingen die je nodig hebt

Plaats deze in de `images` folder:
- `logo.svg` - Het Bus vol Bikes logo
- `hero-bg.jpg` - Achtergrondfoto voor de hero sectie
- `locatie.jpg` - Foto van je locatie/showroom

## Contactgegevens aanpassen

Open `wordpress-template.php` en zoek naar de Contact sectie (regel ~280). Pas daar aan:
- Telefoonnummer
- Email
- Adres

## Kleuren aanpassen

De huisstijl kleuren staan in `:root` aan het begin van `wordpress-style.css`:
```css
--color-primary: #388e3c;  /* Bus vol Bikes groen */
```

## Links

- GitHub: https://github.com/kareltje1986/busvolbikes-website
- Live site: https://busvolbikes.nl
- Railway test: https://busvolbikes-website-production.up.railway.app/

---

**Vragen?** Check de originele HTML/CSS in de repository of vraag het Kareltje! 🚲
