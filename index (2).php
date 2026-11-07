<?php
require_once __DIR__ . '/order_functions.php';   // starts the session on this page too

// Mission 5 (bonus): cookie recognition only; the order itself stays in the session.
if (isset($_COOKIE['lastVisit'])) {
    $last = htmlspecialchars($_COOKIE['lastVisit']);
    $welcomeBack = "Welcome back! Your last visit was {$last}.";
} else {
    $welcomeBack = 'First time at Chez Session? Welcome in!';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Chez Session · Order</title>
  <style>
    body { font-family: Georgia, serif; max-width: 560px; margin: 2rem auto; padding: 0 1rem; }
    label, legend { display: block; margin-top: 1rem; font-weight: bold; }
    .welcome-note { background: #fff6e0; padding: .5rem .8rem; border-radius: 6px; }
    .insight-card { border: 1px solid #ddd; border-radius: 8px; padding: .6rem 1rem; margin-top: 1rem; }
    .insight-card h3 { margin: 0 0 .3rem; font-size: 1rem; }
    .insight-note { color: #555; font-size: .9rem; }
    .pricing-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    .price-figure { font-size: 1.4rem; margin: 0; }
    button, a.btn { margin-top: 1.2rem; }
  </style>
</head>
<body>
  <h1>🍮 Chez Session</h1>

  <p class="welcome-note"><?= $welcomeBack ?></p>

  <form action="process_order.php" method="post">
    <label for="dessert">🍰 Dessert</label>
    <select name="dessert" id="dessert">
      <option value="none">(choose a dessert)</option>
      <option value="Cheesecake"     <?= dessertSelected('Cheesecake'); ?>>Cheesecake</option>
      <option value="Chocolate Cake" <?= dessertSelected('Chocolate Cake'); ?>>Chocolate Cake</option>
      <option value="Carrot Cake"    <?= dessertSelected('Carrot Cake'); ?>>Carrot Cake</option>
      <option value="Tiramisu"       <?= dessertSelected('Tiramisu'); ?>>Tiramisu</option>
    </select>

    <label for="drink">☕ Drink</label>
    <select name="drink" id="drink">
      <option value="none">(choose a drink)</option>
      <option value="Coffee"        <?= drinkSelected('Coffee'); ?>>Coffee</option>
      <option value="Hot Chocolate" <?= drinkSelected('Hot Chocolate'); ?>>Hot Chocolate</option>
      <option value="Root Beer"     <?= drinkSelected('Root Beer'); ?>>Root Beer</option>
      <option value="Tea"           <?= drinkSelected('Tea'); ?>>Tea</option>
      <option value="Milk"          <?= drinkSelected('Milk'); ?>>Milk</option>
    </select>

    <fieldset style="margin-top:1rem">
      <legend>🥤 Drink size</legend>
      <label><input type="radio" name="drinkSize" value="Small"  <?= drinkSizeSelected('Small'); ?>> Small</label>
      <label><input type="radio" name="drinkSize" value="Medium" <?= drinkSizeSelected('Medium'); ?>> Medium</label>
      <label><input type="radio" name="drinkSize" value="Large"  <?= drinkSizeSelected('Large'); ?>> Large</label>
    </fieldset>

    <button type="submit">Send to Kitchen 🧑‍🍳</button>
  </form>

  <div class="insight-card">
    <h3>Live guidance</h3>
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
  </div>

  <p><a class="btn" href="forget_order.php">Forget Order 🗑️</a></p>
</body>
</html>
