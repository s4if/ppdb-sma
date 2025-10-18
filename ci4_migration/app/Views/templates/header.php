<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="<?= esc($description ?? 'Sistem Penerimaan Peserta Didik Baru SMAIT Ihsanul Fikri') ?>">
    <meta name="keywords" content="<?= esc($keywords ?? 'PPDB, SMAIT, Ihsanul Fikri, Pendaftaran, Sekolah') ?>">
    <meta name="author" content="<?= esc($author ?? 'SMAIT Ihsanul Fikri') ?>">
    
    <!-- Cache Control -->
    <meta http-equiv="Cache-Control" content="public, max-age=31536000">
    <meta http-equiv="Expires" content="<?= date('D, d M Y H:i:s \G\M\T', time() + 31536000) ?>">
    
    <title><?= esc($title) ?> - <?= esc($nama_sekolah ?? 'PPDB SMAIT Ihsanul Fikri') ?></title>
    
    <!-- Preconnect for external resources -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Bootstrap 5 CSS with version cache busting -->
    <link href="<?= base_url('assets/css/bootstrap.min.css?v=5.3.2') ?>" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <!-- DataTables Bootstrap 5 with version cache busting -->
    <link href="<?= base_url('assets/css/dataTables.bootstrap5.min.css?v=2.0.3') ?>" rel="stylesheet">
    
    <!-- Font Awesome with version cache busting -->
    <link href="<?= base_url('assets/css/all.min.css?v=6.5.1') ?>" rel="stylesheet" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous">
    
    <!-- Custom CSS with version cache busting -->
    <link href="<?= base_url('assets/css/style.css?v=1.0.0') ?>" rel="stylesheet">
    
    <!-- HTMX with version cache busting -->
    <script src="<?= base_url('assets/js/htmx.min.js?v=1.9.10') ?>" defer></script>
    
    <!-- DNS prefetch for potential external resources -->
    <link rel="dns-prefetch" href="//cdn.datatables.net">
    <link rel="dns-prefetch" href="//code.jquery.com">
</head>
<body>