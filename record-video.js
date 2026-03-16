const { chromium } = require('playwright');
const path = require('path');

(async () => {
    const videoPath = path.join(__dirname, 'busvolbikes-reclame.mp4');
    
    const browser = await chromium.launch();
    
    const context = await browser.newContext({
        viewport: { width: 1080, height: 1920 },
        recordVideo: {
            dir: __dirname,
            size: { width: 1080, height: 1920 }
        }
    });
    
    const page = await context.newPage();
    
    // Open het HTML bestand
    await page.goto('file://' + path.join(__dirname, 'reclame-bord-9x16.html'));
    
    // Wacht even tot alles geladen is
    await page.waitForTimeout(500);
    
    // Verberg de tip
    await page.evaluate(() => {
        const tip = document.getElementById('tip');
        if (tip) tip.style.display = 'none';
    });
    
    // Neem 10 seconden op
    await page.waitForTimeout(10000);
    
    await context.close();
    await browser.close();
    
    console.log('✅ Video opgeslagen als: busvolbikes-reclame.mp4');
})();
