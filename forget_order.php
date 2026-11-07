<?php
// Mission 4: The Forgetting Ritual (order-only reset; the lastVisit recognition cookie is kept).
require_once __DIR__ . '/order_functions.php';

// 1. Clear the three session variables.
unset($_SESSION['dessert'], $_SESSION['drink'], $_SESSION['drinkSize']);
$_SESSION = [];

// 2. Expire the session ID cookie in the browser.
if (ini_get('session.use_cookies')) {
    $p = session_get_cookie_params();
    setcookie(session_name(), '', time() - 3600, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
}

// 3. Destroy the server-side session data.
session_destroy();

// 4. Back to a fresh form (no-store so the browser does not show a cached copy).
header('Cache-Control: no-store');
header('Location: index.php');
exit;
