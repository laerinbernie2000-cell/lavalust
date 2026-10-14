<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($page_title ?? 'Student Profile') ?></title>
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
    max-width: 560px;
    margin: 0 auto;
    padding: clamp(40px, 9vw, 88px) 24px;
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
    font-size: clamp(1.75rem, 4vw, 2.25rem);
    color: var(--ink);
    margin: 10px 0 28px;
    letter-spacing: -0.02em;
  }
  .id-card {
    position: relative;
    background: var(--ink);
    color: #fff;
    border-radius: 16px;
    padding: 28px 28px 24px;
    overflow: hidden;
    box-shadow: 0 20px 40px -12px rgba(22,35,63,0.35);
  }
  .id-card::before {
    content: "";
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 6px;
    background: var(--accent);
  }
  .id-card::after {
    content: "";
    position: absolute;
    top: 16px; right: 22px;
    width: 14px; height: 14px;
    border-radius: 50%;
    background: var(--paper);
    box-shadow: inset 0 0 0 2px rgba(255,255,255,0.15);
  }
  .id-card-head {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-top: 8px;
  }
  .avatar {
    width: 56px; height: 56px;
    border-radius: 50%;
    background: var(--accent);
    color: var(--ink);
    display: flex; align-items: center; justify-content: center;
    font-family: 'Space Grotesk', sans-serif;
    font-weight: 700;
    font-size: 1.2rem;
    flex-shrink: 0;
  }
  .id-card-name {
    font-family: 'Space Grotesk', sans-serif;
    font-size: 1.3rem;
    font-weight: 700;
    letter-spacing: -0.01em;
  }
  .id-card-course {
    font-size: 0.85rem;
    color: rgba(255,255,255,0.65);
    margin-top: 2px;
  }
  .id-number {
    font-family: 'JetBrains Mono', monospace;
    letter-spacing: 0.08em;
    font-size: 0.85rem;
    color: var(--accent);
    margin-top: 20px;
  }
  .id-barcode {
    margin-top: 16px;
    height: 18px;
    background-image: repeating-linear-gradient(90deg, rgba(255,255,255,0.5) 0 2px, transparent 2px 5px);
    opacity: 0.45;
    border-radius: 2px;
  }
  .detail-list {
    margin-top: 24px;
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 12px;
    overflow: hidden;
  }
  .detail-row {
    display: flex;
    justify-content: space-between;
    gap: 16px;
    padding: 14px 20px;
    border-bottom: 1px solid var(--border);
    font-size: 0.92rem;
  }
  .detail-row:last-child { border-bottom: none; }
  .detail-label {
    font-family: 'JetBrains Mono', monospace;
    font-size: 0.72rem;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--muted);
    padding-top: 2px;
  }
  .detail-value { color: var(--text); font-weight: 500; text-align: right; }
  .back {
    display: inline-block;
    margin-top: 28px;
    color: var(--ink);
    font-size: 0.9rem;
    text-decoration: none;
    border-bottom: 1px solid var(--border);
  }
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
    <a href="<?= site_url('student') ?>">Home</a>
    <a class="active" href="<?= site_url('student/profile') ?>">Student Profile</a>
  </div>
</nav>

<main>
  <div class="eyebrow">Protected by StudentMiddleware</div>
  <h1>Student Information</h1>

  <?php
    $initials = '';
    foreach (explode(' ', trim($student['name'])) as $part) {
        if ($part !== '') {
            $initials .= strtoupper(substr($part, 0, 1));
        }
    }
    $initials = substr($initials, 0, 2);
  ?>

  <div class="id-card">
    <div class="id-card-head">
      <div class="avatar"><?= htmlspecialchars($initials) ?></div>
      <div>
        <div class="id-card-name"><?= htmlspecialchars($student['name']) ?></div>
        <div class="id-card-course"><?= htmlspecialchars($student['course']) ?></div>
      </div>
    </div>
    <div class="id-number">ID No. <?= htmlspecialchars($student['student_id']) ?></div>
    <div class="id-barcode"></div>
  </div>

  <div class="detail-list">
    <div class="detail-row">
      <span class="detail-label">Student ID</span>
      <span class="detail-value"><?= htmlspecialchars($student['student_id']) ?></span>
    </div>
    <div class="detail-row">
      <span class="detail-label">Name</span>
      <span class="detail-value"><?= htmlspecialchars($student['name']) ?></span>
    </div>
    <div class="detail-row">
      <span class="detail-label">Course</span>
      <span class="detail-value"><?= htmlspecialchars($student['course']) ?></span>
    </div>
    <div class="detail-row">
      <span class="detail-label">Year Level</span>
      <span class="detail-value"><?= htmlspecialchars($student['year']) ?></span>
    </div>
    <div class="detail-row">
      <span class="detail-label">Section</span>
      <span class="detail-value"><?= htmlspecialchars($student['section']) ?></span>
    </div>
    <div class="detail-row">
      <span class="detail-label">Email</span>
      <span class="detail-value"><?= htmlspecialchars($student['email']) ?></span>
    </div>
    <?php if (!empty($student['address'])): ?>
    <div class="detail-row">
      <span class="detail-label">Address</span>
      <span class="detail-value"><?= htmlspecialchars($student['address']) ?></span>
    </div>
    <?php endif; ?>
    <?php if (!empty($student['contact'])): ?>
    <div class="detail-row">
      <span class="detail-label">Contact No.</span>
      <span class="detail-value"><?= htmlspecialchars($student['contact']) ?></span>
    </div>
    <?php endif; ?>
    <?php if (!empty($student['hobbies'])): ?>
    <div class="detail-row">
      <span class="detail-label">Hobbies</span>
      <span class="detail-value"><?= htmlspecialchars($student['hobbies']) ?></span>
    </div>
    <?php endif; ?>
  </div>

  <a class="back" href="<?= site_url('student') ?>">&larr; Back to Home</a>
</main>

<footer>Student Information Page &mdash; built with LavaLust</footer>

</body>
</html>
