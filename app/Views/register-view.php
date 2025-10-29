<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrierung - Yachthafen Plau am See</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #0a2e5c;
            --secondary: #1a4b8c;
            --accent: #d4af37;
            --light: #f8f9fa;
            --dark: #1e2a3a;
            --text: #333333;
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
            background: linear-gradient(rgba(10, 46, 92, 0.9), rgba(26, 75, 140, 0.9)), url('https://www.felix-reisen-koeln.de/files/neuland/inhalt/bilder/reisen/deutschland/plau-am-see/online/plau-am-see-idyllische-mecklenburgische-seenplatte-kleiner-hafen-von-plau-am-see-465856009.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .registration-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            overflow: hidden;
        }
        
        .registration-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .registration-header h2 {
            font-size: 1.8rem;
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .registration-header p {
            opacity: 0.9;
            font-size: 1rem;
        }
        
        .registration-form {
            padding: 30px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(10, 46, 92, 0.1);
        }
        
        .error-message {
            background: #ffeaea;
            color: var(--error);
            padding: 12px 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            border-left: 4px solid var(--error);
            font-size: 0.9rem;
        }
        
        .error-message div {
            margin-bottom: 5px;
        }
        
        .error-message div:last-child {
            margin-bottom: 0;
        }
        
        .field-error {
            color: var(--error);
            font-size: 0.875rem;
            margin-top: 5px;
            display: block;
        }
        
        .btn {
            width: 100%;
            padding: 14px;
            background: var(--accent);
            color: var(--primary);
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .btn:hover {
            background: #e6c260;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .form-footer {
            text-align: center;
            margin-top: 25px;
            padding-top: 25px;
            border-top: 1px solid #eee;
        }
        
        .form-footer a {
            color: var(--primary);
            text-decoration: none;
            margin: 0 15px;
            transition: color 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-weight: 500;
        }
        
        .form-footer a:hover {
            color: var(--secondary);
        }
        
        .password-toggle {
            position: relative;
        }
        
        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--dark);
            cursor: pointer;
            font-size: 1rem;
        }
        
        .info-text {
            color: #666;
            font-size: 0.875rem;
            margin-top: 5px;
            display: block;
        }
        
        /* Responsive Design */
        @media (max-width: 480px) {
            .registration-container {
                margin: 10px;
            }
            
            .registration-header {
                padding: 25px 20px;
            }
            
            .registration-form {
                padding: 25px 20px;
            }
            
            .form-footer a {
                display: block;
                margin: 10px 0;
            }
        }
    </style>
</head>
<body>
    <div class="registration-container">
        <div class="registration-header">
            <h2>Konto erstellen</h2>
            <p>Registrieren Sie sich für unseren Premium-Service</p>
        </div>
        
        <form method="post" action="<?= esc(base_url('register/submit')) ?>" class="registration-form">
            <?= csrf_field() ?>
            
            <!-- Fehleranzeige -->
            <?php if (isset($errors) && !empty($errors)): ?>
                <div class="error-message">
                    <?php foreach ($errors as $error): ?>
                        <div><?= esc($error) ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <!-- Vorname -->
            <div class="form-group">
                <label for="firstName">Vorname *</label>
                <input type="text" id="firstName" name="firstName" class="form-control" 
                       value="<?= old('firstName') ?>" 
                       placeholder="Ihr Vorname"
                       required>
            </div>
            
            <!-- Nachname -->
            <div class="form-group">
                <label for="lastName">Nachname *</label>
                <input type="text" id="lastName" name="lastName" class="form-control" 
                       value="<?= old('lastName') ?>" 
                       placeholder="Ihr Nachname"
                       required>
            </div>
            
            <!-- E-Mail -->
            <div class="form-group">
                <label for="email">E-Mail-Adresse *</label>
                <input type="email" id="email" name="email" class="form-control" 
                       value="<?= old('email') ?>" 
                       placeholder="ihre.email@beispiel.de"
                       required>
            </div>
            
            <!-- Passwort -->
            <div class="form-group password-toggle">
                <label for="password">Passwort *</label>
                <input type="password" id="password" name="password" class="form-control" 
                       placeholder="Mindestens 8 Zeichen"
                       minlength="8" 
                       required>
                <button type="button" class="toggle-password" id="togglePassword">
                    <i class="fas fa-eye"></i>
                </button>
                <span class="info-text">Mindestens 8 Zeichen</span>
            </div>
            
            <!-- Submit Button -->
            <button type="submit" class="btn">
                <i class="fas fa-user-plus"></i> Konto erstellen
            </button>
            
            <!-- Footer Links -->
            <div class="form-footer">
                <a href="<?= route_to('login') ?>">
                    <i class="fas fa-sign-in-alt"></i> Bereits registriert?
                </a>
                <a href="<?= base_url('/') ?>">
                    <i class="fas fa-home"></i> Zur Startseite
                </a>
            </div>
        </form>
    </div>

    <script>
        // Passwort Sichtbarkeit umschalten
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.getElementById('togglePassword');
            const password = document.getElementById('password');
            
            if (togglePassword && password) {
                togglePassword.addEventListener('click', function() {
                    // Typ umschalten
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
                    
                    // Icon umschalten
                    const icon = this.querySelector('i');
                    if (type === 'password') {
                        icon.className = 'fas fa-eye';
                    } else {
                        icon.className = 'fas fa-eye-slash';
                    }
                });
            }
            
            // Form Validation Feedback
            const form = document.querySelector('form');
            const inputs = form.querySelectorAll('input[required]');
            
            inputs.forEach(input => {
                input.addEventListener('invalid', function(e) {
                    e.preventDefault();
                    this.style.borderColor = 'var(--error)';
                });
                
                input.addEventListener('input', function() {
                    if (this.checkValidity()) {
                        this.style.borderColor = '#ddd';
                    }
                });
            });
            
            // Passwort-Stärke anzeigen (optional)
            const passwordInput = document.getElementById('password');
            if (passwordInput) {
                passwordInput.addEventListener('input', function() {
                    const password = this.value;
                    const infoText = this.parentNode.querySelector('.info-text');
                    
                    if (password.length > 0) {
                        if (password.length < 8) {
                            infoText.style.color = 'var(--error)';
                            infoText.textContent = 'Zu kurz - mindestens 8 Zeichen';
                        } else if (password.length < 12) {
                            infoText.style.color = '#f39c12';
                            infoText.textContent = 'Gut - aber könnte stärker sein';
                        } else {
                            infoText.style.color = 'var(--success)';
                            infoText.textContent = 'Starkes Passwort';
                        }
                    } else {
                        infoText.style.color = '#666';
                        infoText.textContent = 'Mindestens 8 Zeichen';
                    }
                });
            }
        });
    </script>
</body>
</html>