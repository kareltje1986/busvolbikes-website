const { chromium } = require('playwright');
const path = require('path');

(async () => {
  const browser = await chromium.launch();
  const page = await browser.newPage();
  
  // Open de HTML file
  await page.goto('file://' + path.join(__dirname, 'ansichtkaart-advertentie.html'));
  
  // Wacht tot alles geladen is
  await page.waitForTimeout(1000);
  
  // Maak screenshot van de kaart
  const card = await page.$('.card');
  await card.screenshot({
    path: path.join(__dirname, 'ansichtkaart-advertentie.png'),
    type: 'png'
  });
  
  await browser.close();
  console.log('✅ Ansichtkaart opgeslagen als: ansichtkaart-advertentie.png');
})();
