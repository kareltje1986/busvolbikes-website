const express = require('express');
const axios = require('axios');
const xml2js = require('xml2js');
const path = require('path');

const app = express();
const PORT = process.env.PORT || 3000;

// Serve static files
app.use(express.static(path.join(__dirname)));

// XML Feed Proxy Endpoint
app.get('/api/fietsen', async (req, res) => {
    const { cat = '0', c, b } = req.query;
    
    try {
        // Build XML feed URL
        let xmlUrl = 'https://F6EA9296200A4E168099E73DF284025B.hst.fietsenwijk.nl/fietsen/xml/';
        const params = [];
        if (cat !== '0') params.push(`cat=${cat}`);
        if (c) params.push(`c=${encodeURIComponent(c)}`);
        if (b) params.push(`b=${encodeURIComponent(b)}`);
        if (params.length) xmlUrl += '?' + params.join('&');
        
        // Fetch XML
        const response = await axios.get(xmlUrl, { timeout: 30000 });
        const xmlData = response.data;
        
        // Parse XML to JSON
        const parser = new xml2js.Parser({ explicitArray: false });
        const result = await parser.parseStringPromise(xmlData);
        
        // Transform data
        const fietsen = [];
        
        if (result && result.bicycles && result.bicycles.bicycle) {
            const bikes = Array.isArray(result.bicycles.bicycle) 
                ? result.bicycles.bicycle 
                : [result.bicycles.bicycle];
            
            for (const bike of bikes) {
                const state = bike.state || 'used';
                fietsen.push({
                    id: bike.id || '',
                    title: bike.title || 'Onbekende fiets',
                    brand: bike.brand || '',
                    category: bike.category || '',
                    state: state,
                    stateLabel: state === 'new' ? 'Nieuw' : 'Gebruikt',
                    price: bike.price || 'Prijs op aanvraag',
                    priceNumeric: parseFloat(bike.price_numeric) || 0,
                    image: bike.image_url || 'images/showroom-fietsen.jpg',
                    description: bike.description || '',
                    url: bike.detail_url || '#',
                    specs: [
                        bike.frame_size || 'Frame op aanvraag',
                        bike.motor_type || 'Motor: zie beschrijving',
                        bike.range || 'Actieradius: zie beschrijving'
                    ].filter(s => s !== 'Frame op aanvraag' || !bike.frame_size)
                });
            }
        }
        
        res.json({
            success: true,
            count: fietsen.length,
            fietsen: fietsen,
            source: xmlUrl
        });
        
    } catch (error) {
        console.error('Error fetching XML:', error.message);
        res.status(500).json({
            success: false,
            error: error.message,
            fietsen: []
        });
    }
});

// Serve index.html for all other routes (SPA support)
app.get('*', (req, res) => {
    res.sendFile(path.join(__dirname, 'index.html'));
});

app.listen(PORT, () => {
    console.log(`Bus vol Bikes server running on port ${PORT}`);
});
