<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anmelden - Yachthafen Plau am See</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #0a2e5c;
            --secondary: #1a4b8c;
            --accent: #d4af37;
            --light: #ffffff;
            --error: #e74c3c;
            --success: #28a745;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', 'Helvetica Neue', Arial, sans-serif;
        }

        body {
            background: linear-gradient(rgba(10, 46, 92, 0.85), rgba(26, 75, 140, 0.85)),
            url('https://www.felix-reisen-koeln.de/files/neuland/inhalt/bilder/reisen/deutschland/plau-am-see/online/plau-am-see-idyllische-mecklenburgische-seenplatte-kleiner-hafen-von-plau-am-see-465856009.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 25px;
        }

        .login-container {
            background: var(--light);
            border-radius: 12px;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 15px 50px rgba(0,0,0,0.25);
            overflow: hidden;
        }

        .login-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 32px;
            text-align: center;
        }

        .login-header h2 {
            font-size: 1.9rem;
            font-weight: 600;
        }

        form {
            padding: 32px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: 500;
            margin-bottom: 8px;
            display: block;
            color: #1a1a1a;
        }

        .form-control {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
            transition: 0.3s;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(10,46,92,.2);
            outline: none;
        }

        .error-message {
            background: #ffeaea;
            color: var(--error);
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 20px;
            border-left: 4px solid var(--error);
        }

        .password-toggle {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #555;
            font-size: 1.1rem;
        }

        .btn {
            width: 100%;
            padding: 14px;
            background: var(--accent);
            color: var(--primary);
            font-weight: 600;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: .3s;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            font-size: 1.05rem;
        }

        .btn:hover {
            background: #e6c260;
            transform: translateY(-2px);
            box-shadow: 0 5px 18px rgba(0,0,0,0.25);
        }

        .form-footer {
            text-align: center;
            margin-top: 26px;
            padding-top: 26px;
            border-top: 1px solid #eee;
        }

        .form-footer a {
            color: var(--primary);
            font-weight: 500;
            text-decoration: none;
            transition: 0.3s;
        }

        .form-footer a:hover {
            color: var(--secondary);
        }
    </style>
</head>

<body>
<div class="login-container">
    <div class="login-header">
        <h2>Anmelden</h2>
    </div>

    <form method="post" action="<?= esc(base_url('login/submit')) ?>">
        <?= csrf_field() ?>

        <?php if (isset($errors) && !empty($errors)): ?>
            <div class="error-message">
                <?php foreach ($errors as $e): ?>
                    <div><?= esc($e) ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="form-group">
            <label for="email">E-Mail *</label>
            <input id="email" name="email" type="email" class="form-control" value="<?= old('email') ?>" required>
        </div>

        <div class="form-group password-toggle">
            <label for="password">Passwort *</label>
            <input id="password" name="password" type="password" class="form-control" required>
            <button type="button" class="toggle-password"><i class="fas fa-eye"></i></button>
        </div>

        <button type="submit" class="btn"><i class="fas fa-sign-in-alt"></i> Anmelden</button>

        <div class="form-footer">
            <a href="<?= base_url('/register') ?>">Noch kein Konto? Registrieren</a><br><br>
            <a href="<?= base_url('/') ?>"><i class="fas fa-home"></i> Zur Startseite</a>
        </div>
    </form>
</div>

<script>
document.querySelector('.toggle-password').addEventListener('click', function() {
    const passwordField = document.getElementById('password');
    const isHidden = passwordField.type === 'password';
    passwordField.type = isHidden ? 'text' : 'password';
    this.innerHTML = `<i class="fas fa-${isHidden ? 'eye-slash' : 'eye'}"></i>`;
});
</script>

</body>
</html>
