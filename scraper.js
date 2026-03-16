const axios = require('axios');
const fs = require('fs');
const path = require('path');

const FEITSENWIJK_URL = 'https://d40972d3c78b4bc6a44e816ede6281cc.hst.fietsenwijk.nl/fietsen/';
const OUTPUT_FILE = path.join(__dirname, 'public', 'fietsen-data.json');

async function scrapeFietsen() {
    try {
        console.log('Fietsen ophalen van Fietsenwijk...');
        
        // Haal HTML op van fietsenwijk
        const response = await axios.get(FEITSENWIJK_URL, {
            timeout: 30000,
            headers: {
                'User-Agent': 'Mozilla/5.0 (compatible; BusVolBikes/1.0)',
                'Accept': 'text/html'
            },
            responseEncoding: 'binary'
        });
        
        // Converteer van latin1 (iso-8859-1) naar utf-8
        const html = Buffer.from(response.data, 'binary').toString('utf8');
        
        // Parse fietsen uit HTML
        const fietsen = parseFietsenFromHTML(html);
        
        if (fietsen.length === 0) {
            console.log('⚠️  Geen fietsen gevonden');
            return;
        }
        
        // Sorteer op titel
        fietsen.sort((a, b) => a.titel.localeCompare(b.titel));
        
        // Maak output object
        const output = {
            laatsteUpdate: new Date().toISOString(),
            aantal: fietsen.length,
            fietsen: fietsen
        };
        
        // Zorg dat public folder bestaat
        const publicDir = path.dirname(OUTPUT_FILE);
        if (!fs.existsSync(publicDir)) {
            fs.mkdirSync(publicDir, { recursive: true });
        }
        
        // Schrijf naar JSON file
        fs.writeFileSync(OUTPUT_FILE, JSON.stringify(output, null, 2));
        
        console.log(`✅ ${fietsen.length} fietsen opgeslagen in fietsen-data.json`);
        console.log(`📸 Foto's zijn nu 800px breed (scherp!)`);
        
    } catch (error) {
        console.error('❌ Fout bij ophalen fietsen:', error.message);
        process.exit(1);
    }
}

function parseFietsenFromHTML(html) {
    const fietsen = [];
    
    // Zoek naar table rows met fiets data
    // Pattern: <tr>...<a href="/fietsen/detail/?b=ID"><img src="/images/bicycles/...060.jpg">...</tr>
    const rowRegex = /<tr>\s*<td[^>]*>\s*<a href="\/fietsen\/detail\/\?b=([^"]+)"[^>]*>\s*<img src="([^"]+)"[^>]*>\s*<\/a>\s*<\/td>\s*<td[^>]*>\s*<a[^>]*>\s*<b>([^<]+)<\/b>\s*<\/a>.*?<br>\s*([^<]+)<br>/gi;
    
    // Zoek naar prijs pattern
    const prijsRegex = /&nbsp;<b>\s*([€\s\d\.,\-]+)\s*<\/b>/i;
    
    let match;
    while ((match = rowRegex.exec(html)) !== null) {
        const id = match[1];
        const fotoSmall = match[2]; // /images/bicycles/...060.jpg
        const titel = match[3].trim();
        const details = match[4].trim();
        
        // Vervang 060.jpg door 800.jpg voor grotere foto
        const fotoLarge = fotoSmall.replace(/060\.jpg$/i, '800.jpg');
        const fotoUrl = 'https://d40972d3c78b4bc6a44e816ede6281cc.hst.fietsenwijk.nl' + fotoLarge;
        
        // Parse details: "Elektrische fiets, heren, 55 cm, blauw"
        const detailParts = details.split(',').map(p => p.trim());
        const soort = detailParts[0] || '';
        const geslacht = detailParts[1] || '';
        const maat = detailParts[2] || '';
        const kleur = detailParts[3] || '';
        
        // Bepaal of nieuw of gebruikt
        const isNieuw = titel.toLowerCase().includes('nieuw') || details.toLowerCase().includes('nieuw');
        
        // Haal prijs op uit de rest van de HTML na deze row
        const prijsMatch = html.substring(match.index, match.index + 500).match(prijsRegex);
        const prijs = prijsMatch ? prijsMatch[1].trim() : '';
        
        fietsen.push({
            id: id,
            titel: titel,
            prijs: prijs,
            prijsNummer: parsePrijs(prijs),
            soort: isNieuw ? 'Nieuw' : 'Gebruikt',
            geslacht: geslacht,
            kleur: kleur,
            maat: maat,
            foto: fotoUrl,
            detailUrl: `https://d40972d3c78b4bc6a44e816ede6281cc.hst.fietsenwijk.nl/fietsen/detail/?b=${id}`
        });
    }
    
    return fietsen;
}

function parsePrijs(prijsString) {
    if (!prijsString) return 0;
    const match = prijsString.replace(/[^0-9]/g, '');
    return parseInt(match) || 0;
}

// Voer uit als dit script direct wordt aangeroepen
if (require.main === module) {
    scrapeFietsen();
}

module.exports = { scrapeFietsen };