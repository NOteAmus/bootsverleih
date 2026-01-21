<!-- Header mit dynamischem Profil-Icon -->
<header>
    <div class="container">
        <div class="header-content">
            <div class="logo">
                <div class="logo-icon">
                    <i class="fas fa-anchor"></i>
                </div>
                <div class="logo-text">
                    <h1>Yachthafen Plau am See</h1>
                    <p>Premium Liegeplatzverwaltung & Bootsverleih</p>
                </div>
            </div>

            <!-- Temperaturanzeige direkt neben Logo -->
            <div class="temp-display">
                <?php
                $tc = isset($weather['temperature_c']) ? $weather['temperature_c'] : null;
                ?>
                <i class="fas fa-thermometer-half"></i>
                <span><?= $tc !== null ? round($tc) . '°C' : 'n.v.' ?></span>
            </div>

            <!-- Hamburger Menu Button -->
            <div class="hamburger" id="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <div class="weather-header">
                <div class="weather-item">
                    <?php
                    $tc = isset($weather['temperature_c']) ? $weather['temperature_c'] : null;
                    $tf = isset($weather['temperature_f']) ? $weather['temperature_f'] : null;
                    $prec = isset($weather['precipitation_probability']) ? $weather['precipitation_probability'] : null;
                    $hum = isset($weather['humidity']) ? $weather['humidity'] : null;
                    $wind = isset($weather['windspeed']) ? $weather['windspeed'] : null;
                    ?>
                    <i class="fas fa-thermometer-half"></i>
                    <span style="font-weight:700"><?= $tc !== null ? round($tc) . '°C' : 'n.v.' ?></span>
                </div>
                <div class="weather-item" style="margin-left:12px;">
                    <i class="fas fa-cloud-showers-heavy"></i>
                    <span><?= $prec !== null ? 'Niederschlag: ' . $prec . '%' : 'Niederschlag: n.v.' ?></span>
                </div>
                <div class="weather-item" style="margin-left:12px;">
                    <i class="fas fa-tint"></i>
                    <span><?= $hum !== null ? 'Luftfeuchte: ' . $hum . '%' : 'Luftfeuchte: n.v.' ?></span>
                </div>
                <div class="weather-item" style="margin-left:12px;">
                    <i class="fas fa-wind"></i>
                    <span><?= $wind !== null ? 'Wind: ' . $wind . ' km/h' : 'Wind: n.v.' ?></span>
                </div>
            </div>

            <nav>
                <ul>
                    <li><a href="#">Startseite</a></li>
                    <li><a href="#booking">Buchen</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#features">Features</a></li>
                </ul>
            </nav>

            <!-- Dynamisches Profil-Icon (außerhalb nav für mobile Sichtbarkeit) -->
            <div class="profile-section" id="profileSection">
                <?php
                $session = service('session');
                $user = $session ? $session->get('user') : null;

                if ($user) {
                    $initials = '';
                    if (!empty($user['initials'])) {
                        $initials = $user['initials'];
                    } else {
                        $fn = isset($user['firstName']) ? $user['firstName'] : '';
                        $ln = isset($user['lastName']) ? $user['lastName'] : '';
                        $initials = strtoupper(substr($fn, 0, 1) . substr($ln, 0, 1));
                    }

                    echo '<div class="profile-dropdown">\n'
                        . '<div class="profile-icon" id="profileInitials">' . esc($initials) . '</div>\n'
                        . '<div class="dropdown-menu">\n'
                        . '<div class="user-info">\n'
                        . '<div class="user-name">' . esc($user['firstName'] ?? '') . ' ' . esc($user['lastName'] ?? '') . '</div>\n'
                        . '<div class="user-email">' . esc($user['email'] ?? '') . '</div>\n'
                        . '</div>\n'
                        . '<a href="' . site_url('profile') . '">\n'
                        . '<i class="fas fa-user"></i> Mein Profil\n'
                        . '</a>\n'
                        . '<a href="' . site_url('bookings') . '">\n'
                        . '<i class="fas fa-calendar-alt"></i> Meine Buchungen\n'
                        . '</a>\n'
                        . '<a href="' . site_url('settings') . '">\n'
                        . '<i class="fas fa-cog"></i> Einstellungen\n'
                        . '</a>\n'
                        . '<a href="' . site_url('logout') . '">\n'
                        . '<i class="fas fa-sign-out-alt"></i> Abmelden\n'
                        . '</a>\n'
                        . '</div>\n'
                        . '</div>';
                } else {
                    echo '<a href="' . site_url('login') . '" class="login-btn">\n'
                        . '<i class="fas fa-sign-in-alt"></i> Anmelden\n'
                        . '</a>';
                }
                ?>
            </div>
        </div>
    </div>
</header>
