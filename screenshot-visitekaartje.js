const { chromium } = require('playwright');
const path = require('path');

(async () => {
  const browser = await chromium.launch();
  const page = await browser.newPage();
  
  // Open de HTML file
  await page.goto('file://' + path.join(__dirname, 'visitekaartje.html'));
  
  // Wacht tot alles geladen is
  await page.waitForTimeout(1000);
  
  // Screenshot van beide kaarten samen
  await page.screenshot({
    path: path.join(__dirname, 'visitekaartje-preview.png'),
    type: 'png',
    fullPage: true
  });
  
  // Screenshot alleen voorkant
  const front = await page.$('.front');
  await front.screenshot({
    path: path.join(__dirname, 'visitekaartje-voorkant.png'),
    type: 'png'
  });
  
  // Screenshot alleen achterkant
  const back = await page.$('.back');
    await back.screenshot({
    path: path.join(__dirname, 'visitekaartje-achterkant.png'),
    type: 'png'
  });
  
  await browser.close();
  console.log('✅ Visitekaartjes opgeslagen:');
  console.log('  - visitekaartje-preview.png (beide kanten)');
  console.log('  - visitekaartje-voorkant.png');
  console.log('  - visitekaartje-achterkant.png');
})();
