<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'Matcha POS') ?></title>
    <style>
        :root { --matcha-900:#244638; --matcha-800:#315b46; --matcha-700:#477d5c; --matcha-600:#699b70; --matcha-300:#b9d5ad; --matcha-100:#e7f0df; --cream:#fbfaf3; --ink:#26352b; --muted:#6e7b70; --line:#dbe6d5; --white:#fffefb; --danger:#a34d45; }
        * { box-sizing:border-box; }
        body { font-family: "Segoe UI", Arial, sans-serif; margin:0; background:linear-gradient(135deg,#f8f8ed 0%,#edf4e7 100%); color:var(--ink); min-height:100vh; }
        nav { background:var(--matcha-900); padding:16px max(18px,calc((100% - 1100px)/2)); display:flex; align-items:center; gap:8px; flex-wrap:wrap; box-shadow:0 3px 14px #24463833; }
        nav::before { content:'🍵'; font-size:20px; margin-right:8px; }
        nav a { color:#f7fbf1; margin-right:14px; text-decoration:none; font-size:14px; font-weight:600; letter-spacing:.1px; padding:7px 9px; border-radius:7px; transition:.2s; }
        nav a:hover { background:#ffffff20; color:#d9edc9; }
        .wrap { max-width:1100px; margin:34px auto; padding:0 18px 50px; }
        h1,h2 { color:var(--matcha-900); letter-spacing:-.4px; }
        h1 { font-size:30px; margin:0 0 20px; }
        h2 { font-size:20px; }
        .card { background:rgba(255,254,251,.94); border:1px solid #ffffff; border-radius:16px; padding:24px; box-shadow:0 10px 30px #315b4614; margin-bottom:20px; }
        .grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(190px,1fr)); gap:18px; }
        .grid .card { border-top:4px solid var(--matcha-600); }
        .stat { color:var(--matcha-800); font-size:32px; font-weight:700; margin-top:8px; }
        table { width:100%; border-collapse:separate; border-spacing:0; overflow:hidden; background:var(--white); border:1px solid var(--line); border-radius:12px; box-shadow:0 8px 24px #315b4610; }
        th,td { padding:13px 14px; border-bottom:1px solid var(--line); text-align:left; }
        th { background:var(--matcha-100); color:var(--matcha-900); font-size:13px; text-transform:uppercase; letter-spacing:.5px; }
        tr:last-child td { border-bottom:0; }
        tr:hover td { background:#f6faef; }
        input,select { padding:11px 12px; width:100%; box-sizing:border-box; margin:6px 0 16px; border:1px solid #c7d8bf; border-radius:8px; background:#fffefb; color:var(--ink); font:inherit; }
        input:focus,select:focus { outline:3px solid #b9d5ad66; border-color:var(--matcha-600); }
        button,.btn { background:var(--matcha-700); color:#fff; border:0; padding:10px 16px; border-radius:8px; text-decoration:none; display:inline-block; font:600 14px "Segoe UI",Arial,sans-serif; cursor:pointer; box-shadow:0 4px 10px #315b4624; transition:.2s; }
        button:hover,.btn:hover { background:var(--matcha-900); transform:translateY(-1px); }
        .danger { background:var(--danger); }
        .success { color:#39704b; background:#e7f0df; border:1px solid #cce1c2; border-radius:8px; padding:11px 14px; }
        .error { color:#963f39; background:#fae9e4; border:1px solid #eccbc2; border-radius:8px; padding:11px 14px; }
        a.error { background:none; border:0; padding:0; color:var(--danger); text-decoration:underline; }
        .top { display:flex; justify-content:space-between; align-items:center; gap:10px; margin-bottom:18px; }
        .top h1 { margin:0; }
        img.thumb { width:52px; height:52px; object-fit:cover; border-radius:10px; border:2px solid var(--matcha-300); }
        label { color:var(--matcha-900); font-weight:600; font-size:14px; }
        @media(max-width:700px) { nav { padding:12px; gap:2px; } nav a { margin-right:2px; font-size:13px; } .wrap { margin:22px auto; } .top { align-items:flex-start; flex-direction:column; } table { display:block; overflow-x:auto; white-space:nowrap; } }
    </style>
</head>
<body>
<?php if (session()->get('user_id')): ?>
<nav>
    <a href="<?= site_url('dashboard') ?>">Dashboard</a>
    <a href="<?= site_url('products') ?>">Products</a>
    <a href="<?= site_url('customers') ?>">Customers</a>
    <a href="<?= site_url('staff') ?>">Staff</a>
    <a href="<?= site_url('sales') ?>">Sales History</a>
    <a href="<?= site_url('sales/new') ?>">Record Sale</a>
    <a href="<?= site_url('logout') ?>">Logout</a>
</nav>
<?php endif ?>
<main class="wrap">
<?php if ($msg = session()->getFlashdata('success')): ?><p class="success"><?= esc($msg) ?></p><?php endif ?>
<?php if ($msg = session()->getFlashdata('error')): ?><p class="error"><?= esc($msg) ?></p><?php endif ?>
