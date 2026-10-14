<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register &middot; Products</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="auth-box">
        <h1>Create an account</h1>
        <?php if (!empty($error)): ?>
            <p class="alert"><?= html_escape($error) ?></p>
        <?php endif; ?>
        <form method="post" action="<?= site_url('register') ?>">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required autofocus>

                <label for="email">Email Address</label>
        <input
            type="email"
            id="email"
            name="email"
            class="form-control"
            placeholder="Enter your email"
            required
        >
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required minlength="6">

            <div class="form-actions">
                <button type="submit">Create account</button>
            </div>
        </form>
        <p class="muted">Already have an account? <a href="<?= site_url('login') ?>">Log in</a></p>
    </div>
</body>
</html>
