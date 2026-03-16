<?php
// Bus vol Bikes - Fietsenwijk.nl XML Feed Proxy
// This file fetches the XML feed server-side and returns it as JSON

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Get parameters
$cat = isset($_GET['cat']) ? intval($_GET['cat']) : 0;
$category = isset($_GET['c']) ? $_GET['c'] : '';
$brand = isset($_GET['b']) ? $_GET['b'] : '';

// Build the XML feed URL
$xmlUrl = 'https://F6EA9296200A4E168099E73DF284025B.hst.fietsenwijk.nl/fietsen/xml/';
$params = [];
if ($cat > 0) $params[] = 'cat=' . $cat;
if (!empty($category)) $params[] = 'c=' . urlencode($category);
if (!empty($brand)) $params[] = 'b=' . urlencode($brand);
if (!empty($params)) $xmlUrl .= '?' . implode('&', $params);

// Fetch XML
try {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $xmlUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    
    $xmlString = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpCode !== 200 || empty($xmlString)) {
        throw new Exception('Failed to fetch XML feed');
    }
    
    // Parse XML
    $xml = simplexml_load_string($xmlString);
    if ($xml === false) {
        throw new Exception('Failed to parse XML');
    }
    
    $fietsen = [];
    
    // Parse bicycles from XML
    if (isset($xml->bicycle)) {
        foreach ($xml->bicycle as $bike) {
            $fiets = [
                'id' => (string)($bike->id ?? ''),
                'title' => (string)($bike->title ?? 'Onbekende fiets'),
                'brand' => (string)($bike->brand ?? ''),
                'category' => (string)($bike->category ?? ''),
                'state' => (string)($bike->state ?? 'used'),
                'stateLabel' => ((string)($bike->state ?? 'used')) === 'new' ? 'Nieuw' : 'Gebruikt',
                'price' => (string)($bike->price ?? 'Prijs op aanvraag'),
                'priceNumeric' => (float)($bike->price_numeric ?? 0),
                'image' => (string)($bike->image_url ?? 'images/showroom-fietsen.jpg'),
                'description' => (string)($bike->description ?? ''),
                'url' => (string)($bike->detail_url ?? '#'),
                'specs' => []
            ];
            
            // Extract specs if available
            if (isset($bike->specifications)) {
                foreach ($bike->specifications->spec as $spec) {
                    $fiets['specs'][] = (string)$spec;
                }
            }
            
            // Default specs if none provided
            if (empty($fiets['specs'])) {
                $fiets['specs'] = [
                    (string)($bike->frame_size ?? 'Frame op aanvraag'),
                    (string)($bike->motor_type ?? 'Motor: zie beschrijving'),
                    (string)($bike->range ?? 'Actieradius: zie beschrijving')
                ];
            }
            
            $fietsen[] = $fiets;
        }
    }
    
    // Return JSON response
    echo json_encode([
        'success' => true,
        'count' => count($fietsen),
        'fietsen' => $fietsen,
        'source' => $xmlUrl
    ]);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage(),
        'fietsen' => []
    ]);
}
?>