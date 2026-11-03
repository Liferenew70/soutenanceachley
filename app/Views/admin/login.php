<!DOCTYPE html>
<html lang="fr" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle ?? 'Espace Sécurisé • Wiky Holding') ?></title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background: #0B1120;
            background-image: 
                radial-gradient(at 0% 0%, rgba(37, 99, 235, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(249, 115, 22, 0.1) 0px, transparent 50%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            color: #F8FAFC;
            padding: 1rem;
        }

        .auth-container {
            width: 100%;
            max-width: 380px;
        }

        .auth-card {
            background: rgba(15, 23, 42, 0.85);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1rem;
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.6), 0 0 20px rgba(37, 99, 235, 0.15);
            backdrop-filter: blur(20px);
            padding: 2rem 1.75rem;
            position: relative;
        }

        .auth-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 20%;
            right: 20%;
            height: 2px;
            background: linear-gradient(90deg, transparent, #2563EB, #F97316, transparent);
        }

        .auth-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .auth-logo {
            width: 48px;
            height: 48px;
            border-radius: 0.75rem;
            object-fit: cover;
            border: 1px solid rgba(255, 255, 255, 0.15);
            margin-bottom: 0.75rem;
        }

        .auth-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.25rem;
            font-weight: 800;
            color: #FFFFFF;
            letter-spacing: -0.01em;
        }

        .auth-subtitle {
            color: #64748B;
            font-size: 0.8rem;
            margin-top: 0.25rem;
        }

        .alert {
            padding: 0.65rem 0.85rem;
            border-radius: 0.5rem;
            font-size: 0.825rem;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.12);
            border: 1px solid rgba(239, 68, 68, 0.35);
            color: #FCA5A5;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.12);
            border: 1px solid rgba(16, 185, 129, 0.35);
            color: #6EE7B7;
        }

        .form-group {
            margin-bottom: 1.1rem;
        }

        .form-label {
            display: block;
            font-size: 0.75rem;
            font-weight: 600;
            color: #94A3B8;
            margin-bottom: 0.35rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .input-group {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 0.85rem;
            color: #64748B;
            pointer-events: none;
            display: flex;
        }

        .form-input {
            width: 100%;
            background: rgba(30, 41, 59, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.5rem;
            padding: 0.65rem 2.5rem 0.65rem 2.4rem;
            font-size: 0.9rem;
            color: #FFFFFF;
            font-family: inherit;
            transition: all 0.2s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #3B82F6;
            background: rgba(30, 41, 59, 0.9);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }

        .toggle-password {
            position: absolute;
            right: 0.75rem;
            background: none;
            border: none;
            color: #64748B;
            cursor: pointer;
            padding: 0.25rem;
            display: flex;
        }

        .toggle-password:hover {
            color: #94A3B8;
        }

        .btn-submit {
            width: 100%;
            background: #2563EB;
            color: #FFFFFF;
            border: none;
            padding: 0.75rem;
            font-size: 0.9rem;
            font-weight: 700;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-submit:hover {
            background: #1D4ED8;
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.5);
            transform: translateY(-1px);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .auth-footer {
            text-align: center;
            margin-top: 1.25rem;
        }

        .back-link {
            color: #64748B;
            font-size: 0.8rem;
            text-decoration: none;
            transition: color 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }

        .back-link:hover {
            color: #94A3B8;
        }
    </style>
</head>
<body>

    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <img src="<?= e(BASE_URL) ?>/logo.jpg" alt="Logo" class="auth-logo" onerror="this.style.display='none'">
                <h1 class="auth-title">Espace d'Administration</h1>
                <p class="auth-subtitle">Accès restreint aux gestionnaires</p>
            </div>

            <?php if (!empty($error)): ?>
                <div class="alert alert-error">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                    <span><?= e($error) ?></span>
                </div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div class="alert alert-success">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    <span><?= e($success) ?></span>
                </div>
            <?php endif; ?>

            <form action="<?= e(url('admin-login-submit')) ?>" method="POST" autocomplete="off">
                <div class="form-group">
                    <label for="username" class="form-label">Identifiant</label>
                    <div class="input-group">
                        <span class="input-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        </span>
                        <input type="text" name="username" id="username" class="form-input" required autofocus autocomplete="off">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Mot de passe</label>
                    <div class="input-group">
                        <span class="input-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        </span>
                        <input type="password" name="password" id="password" class="form-input" required autocomplete="off">
                        <button type="button" class="toggle-password" onclick="togglePasswordVisibility()" aria-label="Afficher le mot de passe">
                            <svg id="eyeIcon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    <span>Connexion</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path><polyline points="10 17 15 12 10 7"></polyline><line x1="15" y1="12" x2="3" y2="12"></line></svg>
                </button>
            </form>

            <div class="auth-footer">
                <a href="<?= e(url()) ?>" class="back-link">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                    <span>Retourner au site public</span>
                </a>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            if (passInput.type === 'password') {
                passInput.type = 'text';
                eyeIcon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>';
            } else {
                passInput.type = 'password';
                eyeIcon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>';
            }
        }
    </script>
</body>
</html>
