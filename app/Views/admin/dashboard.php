<!DOCTYPE html>
<html lang="fr" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle ?? 'Tableau de Bord Administrateur • Wiky Holding') ?></title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-body: #0B1120;
            --bg-surface: #0F172A;
            --bg-card: rgba(30, 41, 59, 0.7);
            --bg-card-hover: rgba(30, 41, 59, 0.95);
            --border-color: rgba(255, 255, 255, 0.08);
            --border-highlight: rgba(255, 255, 255, 0.16);
            --text-primary: #F8FAFC;
            --text-secondary: #94A3B8;
            --text-muted: #64748B;
            --color-blue: #2563EB;
            --color-blue-glow: rgba(37, 99, 235, 0.25);
            --color-orange: #F97316;
            --color-green: #10B981;
            --color-red: #EF4444;
            --color-purple: #8B5CF6;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-primary);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            min-height: 100vh;
            padding-bottom: 3rem;
        }

        /* Custom Scrollbars */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: rgba(11, 17, 32, 0.6);
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.16);
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        /* Top Navbar */
        .admin-nav {
            background: rgba(15, 23, 42, 0.92);
            border-bottom: 1px solid var(--border-color);
            backdrop-filter: blur(16px);
            position: sticky;
            top: 0;
            z-index: 50;
            padding: 0.75rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
        }

        .nav-logo {
            width: 40px;
            height: 40px;
            border-radius: 0.625rem;
            object-fit: cover;
            border: 1px solid var(--border-highlight);
        }

        .nav-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 800;
            font-size: 1.15rem;
            color: #FFFFFF;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-badge {
            background: rgba(37, 99, 235, 0.2);
            color: #60A5FA;
            border: 1px solid rgba(37, 99, 235, 0.4);
            font-size: 0.7rem;
            font-weight: 700;
            padding: 0.2rem 0.5rem;
            border-radius: 9999px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 0.9rem;
            border-radius: 0.5rem;
            font-size: 0.825rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            border: 1px solid transparent;
        }

        .btn-outline {
            background: rgba(255, 255, 255, 0.04);
            border-color: var(--border-color);
            color: var(--text-secondary);
        }

        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.08);
            color: var(--text-primary);
            border-color: var(--border-highlight);
        }

        .btn-primary {
            background: var(--color-blue);
            color: #FFFFFF;
        }

        .btn-primary:hover {
            background: #1D4ED8;
            box-shadow: 0 4px 12px var(--color-blue-glow);
        }

        .btn-danger {
            background: rgba(239, 68, 68, 0.15);
            border-color: rgba(239, 68, 68, 0.3);
            color: #F87171;
        }

        .btn-danger:hover {
            background: #EF4444;
            color: #FFFFFF;
        }

        .btn-success {
            background: rgba(16, 185, 129, 0.15);
            border-color: rgba(16, 185, 129, 0.3);
            color: #34D399;
        }

        .btn-success:hover {
            background: #10B981;
            color: #FFFFFF;
        }

        .btn-warning {
            background: rgba(249, 115, 22, 0.15);
            border-color: rgba(249, 115, 22, 0.3);
            color: #FB923C;
        }

        .btn-warning:hover {
            background: #F97316;
            color: #FFFFFF;
        }

        /* Container */
        .container {
            max-width: 1440px;
            margin: 1.5rem auto;
            padding: 0 1.5rem;
        }

        /* Toast Alert */
        .toast {
            padding: 0.85rem 1.25rem;
            border-radius: 0.75rem;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.9rem;
            font-weight: 500;
            animation: slideDown 0.3s ease;
        }

        .toast-success {
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.35);
            color: #6EE7B7;
        }

        .toast-error {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.35);
            color: #FCA5A5;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* KPI Stats Grid */
        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .kpi-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 0.875rem;
            padding: 1.25rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: all 0.2s ease;
        }

        .kpi-card:hover {
            border-color: var(--border-highlight);
            transform: translateY(-2px);
        }

        .kpi-icon {
            width: 48px;
            height: 48px;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
        }

        .kpi-icon.blue { background: rgba(37, 99, 235, 0.2); color: #60A5FA; }
        .kpi-icon.green { background: rgba(16, 185, 129, 0.2); color: #34D399; }
        .kpi-icon.orange { background: rgba(249, 115, 22, 0.2); color: #FB923C; }
        .kpi-icon.purple { background: rgba(139, 92, 246, 0.2); color: #A78BFA; }

        .kpi-data h3 {
            font-size: 1.5rem;
            font-weight: 800;
            color: #FFFFFF;
            font-family: 'Plus Jakarta Sans', sans-serif;
            line-height: 1.2;
        }

        .kpi-data p {
            color: var(--text-secondary);
            font-size: 0.8rem;
            font-weight: 500;
            margin-top: 0.2rem;
        }

        /* Quick Action Toolbar */
        .toolbar {
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            border-radius: 0.875rem;
            padding: 0.85rem 1.25rem;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .tabs-nav {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            background: rgba(11, 17, 32, 0.8);
            padding: 0.3rem;
            border-radius: 0.5rem;
            border: 1px solid var(--border-color);
        }

        .tab-btn {
            padding: 0.45rem 1rem;
            border-radius: 0.4rem;
            font-size: 0.825rem;
            font-weight: 700;
            color: var(--text-secondary);
            text-decoration: none;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .tab-btn.active {
            background: var(--color-blue);
            color: #FFFFFF;
            box-shadow: 0 2px 8px var(--color-blue-glow);
        }

        .tab-count {
            background: rgba(255, 255, 255, 0.2);
            padding: 0.1rem 0.45rem;
            border-radius: 9999px;
            font-size: 0.7rem;
        }

        .toolbar-actions {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            flex-wrap: wrap;
        }

        /* Table Card avec Scroll Interne */
        .table-card {
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            border-radius: 0.875rem;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
        }

        .table-header-controls {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0.75rem;
            background: rgba(15, 23, 42, 0.6);
        }

        .search-form {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            flex: 1;
            max-width: 480px;
        }

        .search-input {
            width: 100%;
            background: rgba(30, 41, 59, 0.8);
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            padding: 0.5rem 0.85rem;
            color: #FFFFFF;
            font-size: 0.825rem;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--color-blue);
        }

        .filter-select {
            background: rgba(30, 41, 59, 0.8);
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            padding: 0.5rem 0.75rem;
            color: #FFFFFF;
            font-size: 0.825rem;
        }

        .batch-actions {
            display: flex;
            align-items: center;
            gap: 0.65rem;
        }

        /* Responsive Data Table avec Scroll Interne Bidirectionnel (Scrollable horizontalement & verticalement) */
        .table-responsive {
            width: 100%;
            max-height: 540px;
            overflow-x: auto;
            overflow-y: auto;
            position: relative;
            border-radius: 0 0 0.85rem 0.85rem;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: thin;
            scrollbar-color: rgba(59, 130, 246, 0.45) rgba(15, 23, 42, 0.6);
        }

        /* Barre de défilement moderne et visible pour scroll horizontal & vertical */
        .table-responsive::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        .table-responsive::-webkit-scrollbar-track {
            background: rgba(15, 23, 42, 0.75);
            border-radius: 4px;
        }
        .table-responsive::-webkit-scrollbar-thumb {
            background: rgba(59, 130, 246, 0.45);
            border-radius: 4px;
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        .table-responsive::-webkit-scrollbar-thumb:hover {
            background: rgba(59, 130, 246, 0.75);
        }

        table {
            width: max-content;
            min-width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            text-align: left;
            font-size: 0.85rem;
        }

        /* Largeurs minimales pour garantir un étirement libre sans coupure */
        .table-devis {
            min-width: 1440px;
        }

        .table-messages {
            min-width: 1220px;
        }

        thead th {
            position: sticky;
            top: 0;
            z-index: 10;
            background: #0B1120;
            padding: 0.85rem 1.15rem;
            color: var(--text-secondary);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.725rem;
            letter-spacing: 0.05em;
            border-bottom: 1px solid var(--border-highlight);
            white-space: nowrap;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.45);
        }

        td {
            padding: 0.85rem 1.15rem;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
            color: var(--text-primary);
            background: var(--bg-surface);
            white-space: nowrap;
        }

        tr:hover td {
            background: rgba(255, 255, 255, 0.035);
        }

        /* Colonnes et textes étirés librement sans coupure */
        .cell-nowrap {
            white-space: nowrap !important;
        }

        .cell-company {
            font-weight: 700;
            color: #FFFFFF;
            font-size: 0.875rem;
            white-space: nowrap !important;
            letter-spacing: -0.01em;
        }

        .cell-contact {
            color: var(--text-secondary);
            font-size: 0.775rem;
            margin-top: 3px;
            white-space: nowrap !important;
        }

        /* Badges */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.25rem 0.7rem;
            border-radius: 9999px;
            font-size: 0.725rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            white-space: nowrap !important;
        }

        .badge-nouveau, .badge-en_attente {
            background: rgba(249, 115, 22, 0.15);
            color: #FB923C;
            border: 1px solid rgba(249, 115, 22, 0.3);
        }

        .badge-lu, .badge-en_cours {
            background: rgba(37, 99, 235, 0.15);
            color: #60A5FA;
            border: 1px solid rgba(37, 99, 235, 0.3);
        }

        .badge-traite, .badge-valide {
            background: rgba(16, 185, 129, 0.15);
            color: #34D399;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .badge-archive, .badge-rejete {
            background: rgba(148, 163, 184, 0.15);
            color: #94A3B8;
            border: 1px solid rgba(148, 163, 184, 0.3);
        }

        .badge-budget {
            background: rgba(16, 185, 129, 0.15);
            color: #34D399;
            border: 1px solid rgba(16, 185, 129, 0.35);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            white-space: nowrap !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.35rem 0.85rem;
            border-radius: 9999px;
            font-size: 0.775rem;
            letter-spacing: 0.02em;
        }

        .contact-links {
            display: flex;
            flex-direction: column;
            gap: 0.2rem;
            font-size: 0.775rem;
        }

        .contact-link {
            color: #60A5FA;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }

        .contact-link:hover {
            text-decoration: underline;
        }

        /* Action Buttons Cell */
        .actions-cell {
            display: flex;
            align-items: center;
            gap: 0.35rem;
        }

        .btn-icon {
            padding: 0.35rem 0.45rem;
            border-radius: 0.4rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-color);
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
        }

        .btn-icon:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #FFFFFF;
            transform: scale(1.05);
        }

        .btn-icon.delete:hover {
            background: rgba(239, 68, 68, 0.2);
            color: #F87171;
            border-color: rgba(239, 68, 68, 0.4);
        }

        .btn-icon.edit:hover {
            background: rgba(37, 99, 235, 0.2);
            color: #60A5FA;
            border-color: rgba(37, 99, 235, 0.4);
        }

        .btn-icon.view:hover {
            background: rgba(16, 185, 129, 0.2);
            color: #34D399;
            border-color: rgba(16, 185, 129, 0.4);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3.5rem 2rem;
            color: var(--text-muted);
        }

        .empty-icon {
            font-size: 2.5rem;
            margin-bottom: 0.75rem;
            opacity: 0.6;
        }

        /* Modals avec Scroll Interne */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(8px);
            z-index: 100;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: #0F172A;
            border: 1px solid var(--border-highlight);
            border-radius: 1rem;
            width: 100%;
            max-width: 600px;
            max-height: 85vh;
            overflow-y: auto;
            padding: 1.75rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7);
            position: relative;
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.25rem;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 0.85rem;
        }

        .modal-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.15rem;
            font-weight: 800;
            color: #FFFFFF;
        }

        .modal-close {
            background: transparent;
            border: none;
            color: var(--text-muted);
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.2rem;
            line-height: 1;
        }

        .modal-close:hover {
            color: #FFFFFF;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.85rem;
            margin-bottom: 0.85rem;
        }

        .form-full {
            grid-column: span 2;
        }

        .modal-label {
            display: block;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 0.3rem;
            text-transform: uppercase;
        }

        .modal-input, .modal-textarea, .modal-select {
            width: 100%;
            background: rgba(30, 41, 59, 0.8);
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            padding: 0.6rem 0.8rem;
            color: #FFFFFF;
            font-size: 0.825rem;
        }

        .modal-textarea {
            resize: vertical;
            min-height: 90px;
        }

        .modal-input:focus, .modal-textarea:focus, .modal-select:focus {
            outline: none;
            border-color: var(--color-blue);
        }

        .modal-footer {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 0.65rem;
            margin-top: 1.25rem;
            border-top: 1px solid var(--border-color);
            padding-top: 1rem;
        }

        .detail-row {
            margin-bottom: 0.85rem;
        }

        .detail-label {
            font-size: 0.725rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .detail-value {
            font-size: 0.875rem;
            color: var(--text-primary);
            margin-top: 0.2rem;
            background: rgba(30, 41, 59, 0.5);
            padding: 0.6rem 0.8rem;
            border-radius: 0.5rem;
            border: 1px solid rgba(255, 255, 255, 0.04);
            white-space: pre-wrap;
        }
    </style>
</head>
<body>

    <!-- Top Admin Header -->
    <header class="admin-nav">
        <a href="<?= e(url('admin')) ?>" class="nav-brand">
            <img src="<?= e(BASE_URL) ?>/logo.jpg" alt="Logo" class="nav-logo" onerror="this.style.display='none'">
            <div>
                <div class="nav-title">
                    Digital Agency Wiky
                    <span class="nav-badge">Back-Office Admin</span>
                </div>
                <div style="font-size: 0.725rem; color: var(--text-muted);">
                    Connecté : <strong><?= e($_SESSION['admin_user'] ?? 'admin') ?></strong> • <?= e($_SESSION['admin_login_at'] ?? '') ?>
                </div>
            </div>
        </a>

        <div class="nav-actions">
            <!-- Bouton Modifier mes identifiants -->
            <button type="button" class="btn btn-outline" onclick="openCredentialsModal()" title="Changer identifiant ou mot de passe">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 2l-2 2m-1.5 1.5L10 13l-4 1 1-4 7.5-7.5M16 5l3 3"></path><circle cx="6" cy="18" r="3"></circle></svg>
                <span>Mes identifiants</span>
            </button>

            <!-- Bouton Voir le site -->
            <a href="<?= e(url()) ?>" target="_blank" class="btn btn-outline">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                <span>Site public</span>
            </a>

            <!-- Bouton Déconnexion -->
            <a href="<?= e(url('admin-logout')) ?>" class="btn btn-danger">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                <span>Quitter</span>
            </a>
        </div>
    </header>

    <div class="container">

        <!-- Flash Messages -->
        <?php if (!empty($flashSuccess)): ?>
            <div class="toast toast-success">
                <span>✓ <?= e($flashSuccess) ?></span>
                <button type="button" class="modal-close" onclick="this.parentElement.style.display='none'">&times;</button>
            </div>
        <?php endif; ?>

        <?php if (!empty($flashError)): ?>
            <div class="toast toast-error">
                <span>⚠️ <?= e($flashError) ?></span>
                <button type="button" class="modal-close" onclick="this.parentElement.style.display='none'">&times;</button>
            </div>
        <?php endif; ?>

        <!-- KPI Stats Cards -->
        <div class="kpi-grid">
            <div class="kpi-card">
                <div class="kpi-icon blue">✉️</div>
                <div class="kpi-data">
                    <h3><?= (int) $totalMessages ?></h3>
                    <p>Messages de Contact (<?= (int) $newMessages ?> nouveaux)</p>
                </div>
            </div>

            <div class="kpi-card">
                <div class="kpi-icon green">💼</div>
                <div class="kpi-data">
                    <h3><?= (int) $totalDevis ?></h3>
                    <p>Demandes de Devis (<?= (int) $pendingDevis ?> en attente)</p>
                </div>
            </div>

            <div class="kpi-card">
                <div class="kpi-icon orange">⚡</div>
                <div class="kpi-data">
                    <h3>100%</h3>
                    <p>Base MySQL InnoDB & WampServer Active</p>
                </div>
            </div>

            <div class="kpi-card">
                <div class="kpi-icon purple">📊</div>
                <div class="kpi-data">
                    <h3><?= (int) ($totalMessages + $totalDevis) ?></h3>
                    <p>Total Enregistrements en Base</p>
                </div>
            </div>
        </div>

        <!-- Quick Actions Toolbar -->
        <div class="toolbar">
            <div class="tabs-nav">
                <a href="<?= e(url('admin', ['tab' => 'messages'])) ?>" class="tab-btn <?= $tab === 'messages' ? 'active' : '' ?>">
                    <span>📩 Messages de contact</span>
                    <span class="tab-count"><?= (int) $totalMessages ?></span>
                </a>
                <a href="<?= e(url('admin', ['tab' => 'devis'])) ?>" class="tab-btn <?= $tab === 'devis' ? 'active' : '' ?>">
                    <span>📋 Demandes de devis</span>
                    <span class="tab-count"><?= (int) $totalDevis ?></span>
                </a>
            </div>

            <div class="toolbar-actions">
                <!-- Bouton Générer données de test -->
                <form action="<?= e(url('admin-seed-data')) ?>" method="POST" style="display:inline;">
                    <button type="submit" class="btn btn-success" title="Insérer 5 messages et 5 devis d'exemple pour vos tests et captures">
                        <span>⚡ Générer données de test (10)</span>
                    </button>
                </form>

                <!-- Bouton Purge totale -->
                <button type="button" class="btn btn-warning" onclick="openPurgeAllModal()" title="Vider complètement les messages et les devis">
                    <span>🗑️ Purger TOUT d'un coup</span>
                </button>
            </div>
        </div>

        <!-- ============================================================= -->
        <!-- ONGLET 1 : MESSAGES DE CONTACT -->
        <!-- ============================================================= -->
        <?php if ($tab === 'messages'): ?>
            <div class="table-card">
                <div class="table-header-controls">
                    <!-- Formulaire de recherche et filtre -->
                    <form action="<?= e(url('admin')) ?>" method="GET" class="search-form">
                        <input type="hidden" name="page" value="admin">
                        <input type="hidden" name="tab" value="messages">
                        <input type="text" name="search_msg" class="search-input" placeholder="Rechercher nom, email, sujet..." value="<?= e($searchMsg) ?>">
                        <select name="status_msg" class="filter-select" onchange="this.form.submit()">
                            <option value="all" <?= $statusMsg === 'all' ? 'selected' : '' ?>>Tous les statuts</option>
                            <option value="nouveau" <?= $statusMsg === 'nouveau' ? 'selected' : '' ?>>Nouveau</option>
                            <option value="lu" <?= $statusMsg === 'lu' ? 'selected' : '' ?>>Lu</option>
                            <option value="traite" <?= $statusMsg === 'traite' ? 'selected' : '' ?>>Traité</option>
                            <option value="archive" <?= $statusMsg === 'archive' ? 'selected' : '' ?>>Archivé</option>
                        </select>
                        <button type="submit" class="btn btn-outline">Filtrer</button>
                    </form>

                    <!-- Actions groupées -->
                    <div class="batch-actions">
                        <form id="batchDeleteMessagesForm" action="<?= e(url('admin-messages-batch-delete')) ?>" method="POST" onsubmit="return confirmBatchDeleteMessages()">
                            <button type="submit" id="btnBatchDeleteMessages" class="btn btn-danger" disabled>
                                <span>Supprimer la sélection (<span id="msgSelectedCount">0</span>)</span>
                            </button>
                        </form>
                        
                        <form action="<?= e(url('admin-messages-truncate')) ?>" method="POST" onsubmit="return confirm('Attention : voulez-vous vraiment supprimer TOUS les messages ?');">
                            <button type="submit" class="btn btn-outline" style="color: #F87171;">
                                <span>Vider tous les messages</span>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Conteneur avec scroll interne -->
                <div class="table-responsive">
                    <?php if (empty($messages)): ?>
                        <div class="empty-state">
                            <div class="empty-icon">📭</div>
                            <h3>Aucun message trouvé</h3>
                            <p>Cliquez sur le bouton vert <strong>« Générer données de test »</strong> pour insérer des exemples en 1 clic.</p>
                        </div>
                    <?php else: ?>
                        <table class="admin-table table-messages">
                            <thead>
                                <tr>
                                    <th width="40"><input type="checkbox" id="checkAllMessages" onchange="toggleAllMessages(this)"></th>
                                    <th width="65">#ID</th>
                                    <th width="130">Date</th>
                                    <th>Expéditeur</th>
                                    <th>Contact</th>
                                    <th>Service</th>
                                    <th>Objet</th>
                                    <th width="105" style="text-align:center;">Statut</th>
                                    <th width="110" style="text-align:right;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($messages as $msg): ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="ids[]" value="<?= (int) $msg['id'] ?>" class="msg-checkbox" form="batchDeleteMessagesForm" onchange="updateMessageBatchCount()">
                                        </td>
                                        <td><strong>#<?= (int) $msg['id'] ?></strong></td>
                                        <td style="color: var(--text-secondary); font-size: 0.775rem;" class="cell-nowrap">
                                            <?= e(date('d/m/Y H:i', strtotime($msg['created_at']))) ?>
                                        </td>
                                        <td class="cell-nowrap">
                                            <div class="cell-company"><?= e($msg['name']) ?></div>
                                        </td>
                                        <td class="cell-nowrap">
                                            <div class="contact-links">
                                                <a href="mailto:<?= e($msg['email']) ?>" class="contact-link">✉ <?= e($msg['email']) ?></a>
                                                <?php if (!empty($msg['phone'])): ?>
                                                    <a href="https://wa.me/<?= e(preg_replace('/[^0-9]/', '', $msg['phone'])) ?>" target="_blank" class="contact-link" style="color:#34D399;">✆ <?= e($msg['phone']) ?></a>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td class="cell-nowrap"><strong><?= e($msg['service']) ?></strong></td>
                                        <td style="min-width: 260px; max-width: 380px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="<?= e($msg['subject']) ?>">
                                            <?= e($msg['subject']) ?>
                                        </td>
                                        <td style="text-align:center;" class="cell-nowrap">
                                            <span class="badge badge-<?= e($msg['status'] ?? 'nouveau') ?>">
                                                <?= e(ucfirst($msg['status'] ?? 'nouveau')) ?>
                                            </span>
                                        </td>
                                        <td style="text-align:right;" class="cell-nowrap">
                                            <div class="actions-cell" style="justify-content: flex-end;">
                                                <button type="button" class="btn-icon view" title="Voir les détails" onclick='viewMessage(<?= json_encode($msg, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>)'>👁️</button>
                                                <button type="button" class="btn-icon edit" title="Modifier" onclick='editMessage(<?= json_encode($msg, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>)'>✏️</button>
                                                <form action="<?= e(url('admin-message-delete')) ?>" method="POST" style="display:inline;" onsubmit="return confirm('Supprimer définitivement le message #<?= (int) $msg['id'] ?> ?');">
                                                    <input type="hidden" name="id" value="<?= (int) $msg['id'] ?>">
                                                    <button type="submit" class="btn-icon delete" title="Supprimer">🗑️</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- ============================================================= -->
        <!-- ONGLET 2 : DEMANDES DE DEVIS -->
        <!-- ============================================================= -->
        <?php if ($tab === 'devis'): ?>
            <div class="table-card">
                <div class="table-header-controls">
                    <!-- Formulaire de recherche et filtre -->
                    <form action="<?= e(url('admin')) ?>" method="GET" class="search-form">
                        <input type="hidden" name="page" value="admin">
                        <input type="hidden" name="tab" value="devis">
                        <input type="text" name="search_devis" class="search-input" placeholder="Rechercher entreprise, contact, service..." value="<?= e($searchDevis) ?>">
                        <select name="status_devis" class="filter-select" onchange="this.form.submit()">
                            <option value="all" <?= $statusDevis === 'all' ? 'selected' : '' ?>>Tous les statuts</option>
                            <option value="en_attente" <?= $statusDevis === 'en_attente' ? 'selected' : '' ?>>En attente</option>
                            <option value="en_cours" <?= $statusDevis === 'en_cours' ? 'selected' : '' ?>>En cours</option>
                            <option value="valide" <?= $statusDevis === 'valide' ? 'selected' : '' ?>>Validé</option>
                            <option value="rejete" <?= $statusDevis === 'rejete' ? 'selected' : '' ?>>Rejeté</option>
                        </select>
                        <button type="submit" class="btn btn-outline">Filtrer</button>
                    </form>

                    <!-- Actions groupées -->
                    <div class="batch-actions">
                        <form id="batchDeleteDevisForm" action="<?= e(url('admin-devis-batch-delete')) ?>" method="POST" onsubmit="return confirmBatchDeleteDevis()">
                            <button type="submit" id="btnBatchDeleteDevis" class="btn btn-danger" disabled>
                                <span>Supprimer la sélection (<span id="devisSelectedCount">0</span>)</span>
                            </button>
                        </form>

                        <form action="<?= e(url('admin-devis-truncate')) ?>" method="POST" onsubmit="return confirm('Attention : voulez-vous vraiment supprimer TOUTES les demandes de devis ?');">
                            <button type="submit" class="btn btn-outline" style="color: #F87171;">
                                <span>Vider tous les devis</span>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Conteneur avec scroll interne -->
                <div class="table-responsive">
                    <?php if (empty($devisList)): ?>
                        <div class="empty-state">
                            <div class="empty-icon">📋</div>
                            <h3>Aucune demande de devis</h3>
                            <p>Cliquez sur le bouton vert <strong>« Générer données de test »</strong> pour insérer des exemples en 1 clic.</p>
                        </div>
                    <?php else: ?>
                        <table class="admin-table table-devis">
                            <thead>
                                <tr>
                                    <th width="40"><input type="checkbox" id="checkAllDevis" onchange="toggleAllDevis(this)"></th>
                                    <th width="65">#ID</th>
                                    <th width="130">Date</th>
                                    <th>Entreprise / Contact</th>
                                    <th>Coordonnées</th>
                                    <th>Service demandé</th>
                                    <th style="text-align:center;">Budget estimé</th>
                                    <th>Urgence</th>
                                    <th width="105" style="text-align:center;">Statut</th>
                                    <th width="110" style="text-align:right;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($devisList as $d): ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="ids[]" value="<?= (int) $d['id'] ?>" class="devis-checkbox" form="batchDeleteDevisForm" onchange="updateDevisBatchCount()">
                                        </td>
                                        <td><strong>#<?= (int) $d['id'] ?></strong></td>
                                        <td style="color: var(--text-secondary); font-size: 0.775rem;" class="cell-nowrap">
                                            <?= e(date('d/m/Y H:i', strtotime($d['created_at']))) ?>
                                        </td>
                                        <td class="cell-nowrap">
                                            <div class="cell-company"><?= e($d['company_name']) ?></div>
                                            <div class="cell-contact"><?= e($d['contact_name']) ?></div>
                                        </td>
                                        <td class="cell-nowrap">
                                            <div class="contact-links">
                                                <a href="mailto:<?= e($d['email']) ?>" class="contact-link">✉ <?= e($d['email']) ?></a>
                                                <a href="https://wa.me/<?= e(preg_replace('/[^0-9]/', '', $d['phone'])) ?>" target="_blank" class="contact-link" style="color:#34D399;">✆ <?= e($d['phone']) ?></a>
                                            </div>
                                        </td>
                                        <td class="cell-nowrap"><strong style="color: #FFFFFF;"><?= e($d['service_type']) ?></strong></td>
                                        <td class="cell-nowrap" style="text-align:center;">
                                            <span class="badge badge-budget"><?= e($d['budget_range']) ?></span>
                                        </td>
                                        <td class="cell-nowrap">
                                            <span style="font-size:0.775rem; color:var(--text-secondary);"><?= e($d['urgency']) ?></span>
                                        </td>
                                        <td class="cell-nowrap" style="text-align:center;">
                                            <span class="badge badge-<?= e($d['status'] ?? 'en_attente') ?>">
                                                <?= e(ucfirst(str_replace('_', ' ', $d['status'] ?? 'en_attente'))) ?>
                                            </span>
                                        </td>
                                        <td style="text-align:right;" class="cell-nowrap">
                                            <div class="actions-cell" style="justify-content: flex-end;">
                                                <button type="button" class="btn-icon view" title="Voir les détails" onclick='viewDevis(<?= json_encode($d, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>)'>👁️</button>
                                                <button type="button" class="btn-icon edit" title="Modifier" onclick='editDevis(<?= json_encode($d, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>)'>✏️</button>
                                                <form action="<?= e(url('admin-devis-delete')) ?>" method="POST" style="display:inline;" onsubmit="return confirm('Supprimer définitivement le devis #<?= (int) $d['id'] ?> ?');">
                                                    <input type="hidden" name="id" value="<?= (int) $d['id'] ?>">
                                                    <button type="submit" class="btn-icon delete" title="Supprimer">🗑️</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

    </div>

    <!-- ================================================================= -->
    <!-- MODAL : CHANGER MES IDENTIFIANTS -->
    <!-- ================================================================= -->
    <div id="modalChangeCredentials" class="modal">
        <div class="modal-content" style="max-width: 440px;">
            <div class="modal-header">
                <h3 class="modal-title">Modifier mes identifiants</h3>
                <button type="button" class="modal-close" onclick="closeModal('modalChangeCredentials')">&times;</button>
            </div>
            <form action="<?= e(url('admin-profile-update')) ?>" method="POST" autocomplete="off">
                <p style="font-size: 0.8rem; color: var(--text-secondary); margin-bottom: 1.25rem; line-height: 1.4;">
                    Sécurisez votre espace en modifiant votre nom d'utilisateur et votre mot de passe d'administration.
                </p>

                <div style="margin-bottom: 0.9rem;">
                    <label class="modal-label">Mot de passe actuel <span style="color:#F87171;">*</span></label>
                    <input type="password" name="current_password" class="modal-input" required placeholder="Mot de passe en cours">
                </div>

                <div style="margin-bottom: 0.9rem;">
                    <label class="modal-label">Nouvel identifiant (username) <span style="color:#F87171;">*</span></label>
                    <input type="text" name="new_username" class="modal-input" required value="<?= e($_SESSION['admin_user'] ?? 'admin') ?>">
                </div>

                <div style="margin-bottom: 0.9rem;">
                    <label class="modal-label">Nouveau mot de passe <small style="color:var(--text-muted);">(Min. 6 caractères)</small></label>
                    <input type="password" name="new_password" class="modal-input" placeholder="Laisser vide pour ne pas changer">
                </div>

                <div style="margin-bottom: 0.9rem;">
                    <label class="modal-label">Confirmer le nouveau mot de passe</label>
                    <input type="password" name="confirm_password" class="modal-input" placeholder="Répéter le nouveau mot de passe">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" onclick="closeModal('modalChangeCredentials')">Annuler</button>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ================================================================= -->
    <!-- MODAL : VOIR MESSAGE -->
    <!-- ================================================================= -->
    <div id="modalViewMessage" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="vmTitle">Détail du Message</h3>
                <button type="button" class="modal-close" onclick="closeModal('modalViewMessage')">&times;</button>
            </div>
            <div class="detail-row">
                <div class="detail-label">Expéditeur & Date</div>
                <div class="detail-value" id="vmSender"></div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Service & Objet</div>
                <div class="detail-value" id="vmSubject"></div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Message intégral</div>
                <div class="detail-value" id="vmBody" style="min-height: 100px;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" onclick="closeModal('modalViewMessage')">Fermer</button>
            </div>
        </div>
    </div>

    <!-- ================================================================= -->
    <!-- MODAL : MODIFIER MESSAGE -->
    <!-- ================================================================= -->
    <div id="modalEditMessage" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Modifier le Message</h3>
                <button type="button" class="modal-close" onclick="closeModal('modalEditMessage')">&times;</button>
            </div>
            <form action="<?= e(url('admin-message-update')) ?>" method="POST">
                <input type="hidden" name="id" id="emId">
                <div class="form-grid">
                    <div>
                        <label class="modal-label">Nom complet</label>
                        <input type="text" name="name" id="emName" class="modal-input" required>
                    </div>
                    <div>
                        <label class="modal-label">Email</label>
                        <input type="email" name="email" id="emEmail" class="modal-input" required>
                    </div>
                    <div>
                        <label class="modal-label">Téléphone</label>
                        <input type="text" name="phone" id="emPhone" class="modal-input">
                    </div>
                    <div>
                        <label class="modal-label">Service</label>
                        <input type="text" name="service" id="emService" class="modal-input">
                    </div>
                    <div class="form-full">
                        <label class="modal-label">Objet</label>
                        <input type="text" name="subject" id="emSubject" class="modal-input" required>
                    </div>
                    <div class="form-full">
                        <label class="modal-label">Statut</label>
                        <select name="status" id="emStatus" class="modal-select">
                            <option value="nouveau">Nouveau</option>
                            <option value="lu">Lu</option>
                            <option value="traite">Traité</option>
                            <option value="archive">Archivé</option>
                        </select>
                    </div>
                    <div class="form-full">
                        <label class="modal-label">Contenu du message</label>
                        <textarea name="message" id="emMessage" class="modal-textarea" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" onclick="closeModal('modalEditMessage')">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ================================================================= -->
    <!-- MODAL : VOIR DEVIS -->
    <!-- ================================================================= -->
    <div id="modalViewDevis" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="vdTitle">Détail de la Demande de Devis</h3>
                <button type="button" class="modal-close" onclick="closeModal('modalViewDevis')">&times;</button>
            </div>
            <div class="detail-row">
                <div class="detail-label">Entreprise & Contact</div>
                <div class="detail-value" id="vdCompany"></div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Service & Budget Estimé</div>
                <div class="detail-value" id="vdService"></div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Cahier des charges / Description du projet</div>
                <div class="detail-value" id="vdDetails" style="min-height: 100px;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" onclick="closeModal('modalViewDevis')">Fermer</button>
            </div>
        </div>
    </div>

    <!-- ================================================================= -->
    <!-- MODAL : MODIFIER DEVIS -->
    <!-- ================================================================= -->
    <div id="modalEditDevis" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Modifier la Demande de Devis</h3>
                <button type="button" class="modal-close" onclick="closeModal('modalEditDevis')">&times;</button>
            </div>
            <form action="<?= e(url('admin-devis-update')) ?>" method="POST">
                <input type="hidden" name="id" id="edId">
                <div class="form-grid">
                    <div>
                        <label class="modal-label">Entreprise</label>
                        <input type="text" name="company_name" id="edCompany" class="modal-input" required>
                    </div>
                    <div>
                        <label class="modal-label">Nom du contact</label>
                        <input type="text" name="contact_name" id="edContact" class="modal-input" required>
                    </div>
                    <div>
                        <label class="modal-label">Email</label>
                        <input type="email" name="email" id="edEmail" class="modal-input" required>
                    </div>
                    <div>
                        <label class="modal-label">Téléphone</label>
                        <input type="text" name="phone" id="edPhone" class="modal-input" required>
                    </div>
                    <div>
                        <label class="modal-label">Service type</label>
                        <input type="text" name="service_type" id="edService" class="modal-input" required>
                    </div>
                    <div>
                        <label class="modal-label">Budget range</label>
                        <input type="text" name="budget_range" id="edBudget" class="modal-input">
                    </div>
                    <div>
                        <label class="modal-label">Urgence / Délai</label>
                        <input type="text" name="urgency" id="edUrgency" class="modal-input">
                    </div>
                    <div>
                        <label class="modal-label">Statut</label>
                        <select name="status" id="edStatus" class="modal-select">
                            <option value="en_attente">En attente</option>
                            <option value="en_cours">En cours</option>
                            <option value="valide">Validé</option>
                            <option value="rejete">Rejeté</option>
                        </select>
                    </div>
                    <div class="form-full">
                        <label class="modal-label">Détails du projet</label>
                        <textarea name="project_details" id="edDetails" class="modal-textarea" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" onclick="closeModal('modalEditDevis')">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ================================================================= -->
    <!-- MODAL : CONFIRMATION PURGE TOTALE -->
    <!-- ================================================================= -->
    <div id="modalPurgeAll" class="modal">
        <div class="modal-content" style="max-width: 440px; text-align: center;">
            <div style="font-size: 2.5rem; margin-bottom: 0.75rem;">⚠️</div>
            <h3 class="modal-title" style="margin-bottom: 0.5rem;">Purger toutes les données de test ?</h3>
            <p style="color: var(--text-secondary); font-size: 0.85rem; line-height: 1.5; margin-bottom: 1.25rem;">
                Cette action va vider <strong>l'intégralité des tables messages et devis_requests</strong> et réinitialiser les compteurs à 1.<br><br>
                Idéal une fois que vos tests sont terminés !
            </p>
            <form action="<?= e(url('admin-purge-all')) ?>" method="POST">
                <div class="modal-footer" style="justify-content: center;">
                    <button type="button" class="btn btn-outline" onclick="closeModal('modalPurgeAll')">Annuler</button>
                    <button type="submit" class="btn btn-danger">Oui, tout purger maintenant !</button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript Interactions -->
    <script>
        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
        }

        function openPurgeAllModal() {
            document.getElementById('modalPurgeAll').classList.add('active');
        }

        function openCredentialsModal() {
            document.getElementById('modalChangeCredentials').classList.add('active');
        }

        // Selection groupée Messages
        function toggleAllMessages(source) {
            const checkboxes = document.querySelectorAll('.msg-checkbox');
            checkboxes.forEach(cb => cb.checked = source.checked);
            updateMessageBatchCount();
        }

        function updateMessageBatchCount() {
            const checked = document.querySelectorAll('.msg-checkbox:checked').length;
            document.getElementById('msgSelectedCount').textContent = checked;
            document.getElementById('btnBatchDeleteMessages').disabled = checked === 0;
        }

        function confirmBatchDeleteMessages() {
            const count = document.querySelectorAll('.msg-checkbox:checked').length;
            return confirm(`Supprimer définitivement les ${count} message(s) sélectionné(s) ?`);
        }

        // Selection groupée Devis
        function toggleAllDevis(source) {
            const checkboxes = document.querySelectorAll('.devis-checkbox');
            checkboxes.forEach(cb => cb.checked = source.checked);
            updateDevisBatchCount();
        }

        function updateDevisBatchCount() {
            const checked = document.querySelectorAll('.devis-checkbox:checked').length;
            document.getElementById('devisSelectedCount').textContent = checked;
            document.getElementById('btnBatchDeleteDevis').disabled = checked === 0;
        }

        function confirmBatchDeleteDevis() {
            const count = document.querySelectorAll('.devis-checkbox:checked').length;
            return confirm(`Supprimer définitivement les ${count} devis sélectionné(s) ?`);
        }

        // Modals Messages
        function viewMessage(data) {
            document.getElementById('vmTitle').textContent = `Message #${data.id} • ${data.subject}`;
            document.getElementById('vmSender').textContent = `${data.name} (${data.email} | ${data.phone || 'Non renseigné'}) - Reçu le ${data.created_at}`;
            document.getElementById('vmSubject').textContent = `Pôle : ${data.service} • Statut : ${data.status}`;
            document.getElementById('vmBody').textContent = data.message;
            document.getElementById('modalViewMessage').classList.add('active');
        }

        function editMessage(data) {
            document.getElementById('emId').value = data.id;
            document.getElementById('emName').value = data.name;
            document.getElementById('emEmail').value = data.email;
            document.getElementById('emPhone').value = data.phone || '';
            document.getElementById('emService').value = data.service;
            document.getElementById('emSubject').value = data.subject;
            document.getElementById('emStatus').value = data.status || 'nouveau';
            document.getElementById('emMessage').value = data.message;
            document.getElementById('modalEditMessage').classList.add('active');
        }

        // Modals Devis
        function viewDevis(data) {
            document.getElementById('vdTitle').textContent = `Devis #${data.id} • ${data.company_name}`;
            document.getElementById('vdCompany').textContent = `${data.company_name} - Contact : ${data.contact_name} (${data.email} | ${data.phone}) - Reçu le ${data.created_at}`;
            document.getElementById('vdService').textContent = `Service : ${data.service_type} • Budget : ${data.budget_range} • Urgence : ${data.urgency} • Statut : ${data.status}`;
            document.getElementById('vdDetails').textContent = data.project_details;
            document.getElementById('modalViewDevis').classList.add('active');
        }

        function editDevis(data) {
            document.getElementById('edId').value = data.id;
            document.getElementById('edCompany').value = data.company_name;
            document.getElementById('edContact').value = data.contact_name;
            document.getElementById('edEmail').value = data.email;
            document.getElementById('edPhone').value = data.phone;
            document.getElementById('edService').value = data.service_type;
            document.getElementById('edBudget').value = data.budget_range || '';
            document.getElementById('edUrgency').value = data.urgency || '';
            document.getElementById('edStatus').value = data.status || 'en_attente';
            document.getElementById('edDetails').value = data.project_details;
            document.getElementById('modalEditDevis').classList.add('active');
        }

        // Fermer les modals en cliquant à l'extérieur
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove('active');
            }
        };
    </script>
</body>
</html>
