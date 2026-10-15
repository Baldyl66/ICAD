<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>403 - Acces refuse | I-CAD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="<?= base_url('favicon.png'); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap">
    <style>
        :root {
            --bg-app: #f4f6f8;
            --bg-card: #ffffff;
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --danger-subtle: #fff1f2;
            --danger: #e11d48;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            background-color: var(--bg-app);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        .error-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.08);
            max-width: 460px;
            width: 100%;
            padding: 44px 36px;
            text-align: center;
        }
        .error-logo-img {
            width: 135px;
            height: auto;
            max-height: 85px;
            object-fit: contain;
            display: block;
            margin: 0 auto 24px auto;
            pointer-events: none;
            user-select: none;
        }
        .badge-code {
            display: inline-block;
            font-size: 0.76rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--danger);
            background: var(--danger-subtle);
            padding: 4px 14px;
            border-radius: 9999px;
            margin-bottom: 14px;
        }
        .error-title {
            font-size: 1.45rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            margin-bottom: 8px;
        }
        .error-desc {
            font-size: 0.9rem;
            color: var(--text-muted);
            line-height: 1.5;
            margin-bottom: 28px;
        }
        .action-btns {
            display: flex;
            justify-content: center;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px 24px;
            font-size: 0.88rem;
            font-weight: 600;
            border-radius: 8px;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.15s ease;
            width: 100%;
        }
        .btn-primary {
            background-color: var(--primary);
            color: #ffffff;
            border: 1px solid transparent;
        }
        .btn-primary:hover {
            background-color: var(--primary-hover);
        }
    </style>
</head>
<body>
    <div class="error-card">
        <img src="<?= base_url('logo.png'); ?>" alt="Logo I-CAD" class="error-logo-img">

        <div>
            <span class="badge-code">Erreur 403 - Acces refuse</span>
            <h1 class="error-title">Zone d'acces securisee</h1>
            <p class="error-desc">
                Vous n'avez pas les permissions requises pour consulter cette ressource.
                Veuillez retourner au registre des identifications.
            </p>
        </div>

        <div class="action-btns">
            <a href="<?= base_url('/'); ?>" class="btn btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Retourner au registre
            </a>
        </div>
    </div>
</body>
</html>
