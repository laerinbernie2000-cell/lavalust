<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($page_title ?? 'Student Portal') ?></title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
  :root {
    --ink: #16233F;
    --paper: #F3F5F8;
    --card: #FFFFFF;
    --accent: #C89B3C;
    --text: #2B303B;
    --muted: #6B7280;
    --border: #E3E7ED;
  }
  * { box-sizing: border-box; }
  body {
    margin: 0;
    background: var(--paper);
    color: var(--text);
    font-family: 'Inter', system-ui, sans-serif;
    -webkit-font-smoothing: antialiased;
  }
  .nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px clamp(20px, 5vw, 64px);
    border-bottom: 1px solid var(--border);
    background: var(--card);
  }
  .nav .brand {
    font-family: 'Space Grotesk', sans-serif;
    font-weight: 700;
    color: var(--ink);
    text-decoration: none;
  }
  .nav-links a {
    color: var(--ink);
    text-decoration: none;
    font-size: 0.95rem;
    margin-left: 24px;
    padding-bottom: 3px;
    border-bottom: 2px solid transparent;
  }
  .nav-links a.active { border-color: var(--accent); }
  main {
    max-width: 720px;
    margin: 0 auto;
    padding: clamp(40px, 9vw, 88px) 24px;
  }
  .notice {
    background: #FDEEEA;
    border: 1px solid #F0B8A8;
    color: #8A3B24;
    padding: 12px 16px;
    border-radius: 6px;
    font-size: 0.9rem;
    margin-bottom: 28px;
  }
  .eyebrow {
    font-family: 'JetBrains Mono', monospace;
    font-size: 0.75rem;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--accent);
  }
  h1 {
    font-family: 'Space Grotesk', sans-serif;
    font-size: clamp(2rem, 5vw, 2.75rem);
    color: var(--ink);
    margin: 10px 0 16px;
    letter-spacing: -0.02em;
  }
  p.lede {
    color: var(--muted);
    font-size: 1.05rem;
    line-height: 1.65;
    max-width: 52ch;
  }
  code {
    background: var(--border);
    border-radius: 4px;
    padding: 1px 6px;
    font-family: 'JetBrains Mono', monospace;
    font-size: 0.85em;
  }
  .btn {
    display: inline-block;
    margin-top: 28px;
    padding: 12px 28px;
    background: var(--ink);
    color: #fff;
    text-decoration: none;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.95rem;
  }
  .btn:hover { background: var(--accent); }
  footer {
    text-align: center;
    color: var(--muted);
    font-size: 0.8rem;
    padding: 32px 24px 48px;
  }
</style>
</head>
<body>

<nav class="nav">
  <a class="brand" href="<?= site_url('student') ?>">Student Portal</a>
  <div class="nav-links">
    <a class="active" href="<?= site_url('student') ?>">Home</a>
    <a href="<?= site_url('student/profile') ?>">Student Profile</a>
  </div>
</nav>

<main>
  <?php if (!empty($_SESSION['student_notice'])): ?>
    <div class="notice"><?= htmlspecialchars($_SESSION['student_notice']) ?></div>
    <?php unset($_SESSION['student_notice']); ?>
  <?php endif; ?>

  <div class="eyebrow">LavaLust &middot; Routing / Controller / View / Middleware</div>
  <h1>Welcome to the Student Portal</h1>
  <a class="btn" href="<?= site_url('student/profile') ?>">View My Student Profile &rarr;</a>
</main>

<footer>Student Information Page &mdash; built with LavaLust</footer>

</body>
</html>
