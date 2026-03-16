<?php
/**
 * Bus vol Bikes Voorraad - Code Snippet voor WordPress
 * 
 * Gebruik: Installeer de "Code Snippets" plugin en plak deze code in een nieuwe snippet.
 * Zet de snippet op "Run snippet everywhere" of alleen op specifieke pagina's.
 * 
 * Toon de voorraad met shortcode: [bvb_voorraad]
 */

// Voorkom directe toegang
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Shortcode: [bvb_voorraad]
 * Optionele parameters: limit="6" filter="all|gebruikt|nieuw"
 */
add_shortcode('bvb_voorraad', function($atts) {
    $atts = shortcode_atts([
        'limit' => 0,
        'filter' => 'all'
    ], $atts, 'bvb_voorraad');
    
    // Genereer unieke ID voor deze instantie
    $id = 'bvb-' . uniqid();
    $limit = intval($atts['limit']);
    $filter = sanitize_text_field($atts['filter']);
    
    ob_start();
    ?>
    <div class="bvb-voorraad" id="<?php echo $id; ?>" data-limit="<?php echo $limit; ?>" data-filter="<?php echo $filter; ?>">
        <div class="bvb-stats">
            <span class="bvb-count">Fietsen laden...</span>
            <span class="bvb-update"></span>
        </div>
        <div class="bvb-filters">
            <button class="bvb-filter active" data-filter="all">Alle fietsen</button>
            <button class="bvb-filter" data-filter="gebruikt">Gebruikt</button>
            <button class="bvb-filter" data-filter="nieuw">Nieuw</button>
        </div>
        <div class="bvb-grid">🚲 Fietsen worden geladen...</div>
    </div>
    <?php
    return ob_get_clean();
});

/**
 * Voeg CSS en JS toe aan de footer
 */
add_action('wp_footer', function() {
    // Check of de shortcode gebruikt is op deze pagina
    global $post;
    if (!is_a($post, 'WP_Post') || !has_shortcode($post->post_content, 'bvb_voorraad')) {
        return;
    }
    ?>
    <style>
        .bvb-voorraad {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px 0;
        }
        .bvb-stats {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding: 12px 16px;
            background: #f8fafc;
            border-radius: 8px;
            font-size: 14px;
            color: #64748b;
            flex-wrap: wrap;
            gap: 8px;
        }
        .bvb-filters {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        .bvb-filter {
            padding: 8px 16px;
            border: 2px solid #e2e8f0;
            background: white;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            font-size: 14px;
            color: #0f172a;
            transition: all 0.2s;
        }
        .bvb-filter:hover {
            border-color: #22c55e;
            color: #22c55e;
        }
        .bvb-filter.active {
            background: #22c55e;
            border-color: #22c55e;
            color: white;
        }
        .bvb-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }
        .bvb-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border: 1px solid #e2e8f0;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .bvb-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        }
        .bvb-img-wrap {
            height: 200px;
            background: #f8fafc;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .bvb-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .bvb-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: #22c55e;
            color: white;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }
        .bvb-badge.nieuw { background: #3b82f6; }
        .bvb-info {
            padding: 16px;
        }
        .bvb-title {
            font-size: 16px;
            font-weight: 700;
            margin: 0 0 6px 0;
            color: #0f172a;
        }
        .bvb-details {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 12px;
        }
        .bvb-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 12px;
            border-top: 1px solid #e2e8f0;
        }
        .bvb-prijs {
            font-size: 20px;
            font-weight: 800;
            color: #22c55e;
        }
        .bvb-link {
            padding: 8px 16px;
            background: #0f172a;
            color: white !important;
            border-radius: 6px;
            text-decoration: none !important;
            font-weight: 600;
            font-size: 13px;
        }
        .bvb-link:hover { background: #1e293b; }
        .bvb-error { color: #ef4444; text-align: center; padding: 40px; }
        @media (max-width: 768px) {
            .bvb-grid { grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); }
            .bvb-img-wrap { height: 160px; }
        }
        @media (max-width: 480px) {
            .bvb-grid { grid-template-columns: 1fr; }
        }
    </style>
    
    <script>
    (function() {
        const API_URL = 'https://busvolbikes-website-production.up.railway.app/fietsen-data.json';
        
        document.querySelectorAll('.bvb-voorraad').forEach(function(container) {
            const grid = container.querySelector('.bvb-grid');
            const countEl = container.querySelector('.bvb-count');
            const updateEl = container.querySelector('.bvb-update');
            const limit = parseInt(container.dataset.limit) || 0;
            let alleFietsen = [];
            
            // Laad data
            fetch(API_URL)
                .then(r => r.json())
                .then(data => {
                    alleFietsen = data.fietsen || [];
                    countEl.textContent = alleFietsen.length + ' fietsen beschikbaar';
                    if (data.laatsteUpdate) {
                        const d = new Date(data.laatsteUpdate);
                        updateEl.textContent = 'Laatste update: ' + d.toLocaleDateString('nl-NL', {day:'numeric', month:'short'});
                    }
                    render('all');
                })
                .catch(() => {
                    grid.innerHTML = '<div class="bvb-error">❌ Fietsen konden niet worden geladen.<br><a href="https://d40972d3c78b4bc6a44e816ede6281cc.hst.fietsenwijk.nl/fietsen/" target="_blank">Bekijk op Fietsenwijk →</a></div>';
                    countEl.textContent = 'Fout bij laden';
                });
            
            // Render functie
            function render(filter) {
                let fietsen = alleFietsen;
                if (filter === 'gebruikt') {
                    fietsen = fietsen.filter(f => f.titel?.toLowerCase().includes('gebruik') || f.soort?.toLowerCase().includes('gebruik'));
                } else if (filter === 'nieuw') {
                    fietsen = fietsen.filter(f => f.titel?.toLowerCase().includes('nieuw') || f.soort?.toLowerCase().includes('nieuw'));
                }
                if (limit > 0) fietsen = fietsen.slice(0, limit);
                
                grid.innerHTML = fietsen.map(f => {
                    const isNieuw = f.titel?.toLowerCase().includes('nieuw') || f.soort?.toLowerCase().includes('nieuw');
                    const badge = isNieuw ? '<span class="bvb-badge nieuw">Nieuw</span>' : '<span class="bvb-badge">Gebruikt</span>';
                    const details = [f.geslacht, f.maat, f.kleur].filter(Boolean).join(' • ');
                    return `
                        <article class="bvb-card">
                            <div class="bvb-img-wrap">${badge}<img src="${f.foto}" alt="${f.titel}" loading="lazy" onerror="this.style.display='none'"></div>
                            <div class="bvb-info">
                                <h3 class="bvb-title">${f.titel}</h3>
                                <p class="bvb-details">${details}</p>
                                <div class="bvb-footer">
                                    <span class="bvb-prijs">${f.prijs}</span>
                                    <a href="${f.detailUrl}" target="_blank" class="bvb-link">Bekijken →</a>
                                </div>
                            </div>
                        </article>
                    `;
                }).join('');
            }
            
            // Filter handlers
            container.querySelectorAll('.bvb-filter').forEach(btn => {
                btn.addEventListener('click', function() {
                    container.querySelectorAll('.bvb-filter').forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    render(this.dataset.filter);
                });
            });
        });
    })();
    </script>
    <?php
});
