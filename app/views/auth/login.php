<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In &middot; Products</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="auth-box">
        <h1>Log in</h1>
        <?php if (!empty($error)): ?>
            <p class="alert"><?= html_escape($error) ?></p>
        <?php endif; ?>
        <form method="post" action="<?= site_url('login') ?>">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required autofocus>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <div class="form-actions">
                <button type="submit">Log in</button>
            </div>
        </form>
        <p class="muted">No account yet? <a href="<?= site_url('register') ?>">Register</a></p>
    </div>
</body>
</html>
