<?php
// order_functions.php calls session_start(); setcookie() must also run before any output.
require_once __DIR__ . '/order_functions.php';

// Mission 5 (bonus): stamp the visit for the welcome-back greeting (recognition only).
$visitStamp = date('l, F j, Y g:i a');
setcookie('lastVisit', $visitStamp, time() + 86400, '/');

$orderSummary = order();   // save the three session variables, returns the receipt text
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Chez Session · Receipt</title>
  <style>
    body { font-family: Georgia, serif; max-width: 560px; margin: 2rem auto; padding: 0 1rem; }
    .receipt-card { border: 1px dashed #333; padding: 1rem; line-height: 1.8; }
    .insight-card { border: 1px solid #ddd; border-radius: 8px; padding: .6rem 1rem; margin-top: 1rem; }
    .insight-card h3 { margin: 0 0 .3rem; font-size: 1rem; }
    .insight-note { color: #555; font-size: .9rem; }
    .pricing-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    .full-width-note { grid-column: 1 / -1; margin: 0; }
    .price-figure { font-size: 1.4rem; margin: 0; }
  </style>
</head>
<body>
  <h1>🧾 Chez Session · Receipt</h1>
  <div class="receipt-card"><?= $orderSummary; ?></div>

  <div class="insight-card">
    <h3>Order feedback</h3>
    <p><?= htmlspecialchars(completionMessage()); ?></p>
    <p class="insight-note"><?= htmlspecialchars(pairingSuggestion()); ?></p>
  </div>

  <div class="insight-card pricing-grid">
    <div>
      <h3>Estimated total</h3>
      <p class="price-figure"><?= htmlspecialchars(formattedTotal()); ?></p>
    </div>
    <div>
      <h3>Order profile</h3>
      <p><?= htmlspecialchars(orderProfile()); ?></p>
    </div>
    <p class="insight-note full-width-note"><?= htmlspecialchars(pricingNote()); ?></p>
  </div>

  <p><a href="index.php">Order Again! 🔁</a></p>
</body>
</html>
