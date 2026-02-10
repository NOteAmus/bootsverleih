<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yachthafen Plau am See - Premium Liegeplatzverwaltung & Bootsverleih</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Grundlegende Styles */
        :root {
            --primary: #0a2e5c;
            --secondary: #1a4b8c;
            --accent: #d4af37;
            --light: #f8f9fa;
            --dark: #1e2a3a;
            --text: #333333;
            --gray: #6c757d;
            --success: #28a745;
            --error: #e74c3c;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', 'Helvetica Neue', Arial, sans-serif;
        }

        body {
            background-color: var(--light);
            color: var(--text);
            line-height: 1.7;
            overflow-x: hidden;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header Styles */
        header {
            background-color: rgba(10, 46, 92, 0.98);
            color: white;
            /* reduced vertical padding to decrease toolbar height */
            padding: 0.5rem 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }

        .header-content {
            display: flex;
            justify-content: center; /* center the whole header content */
            align-items: center;
            gap: 30px; /* spacing between main blocks */
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 15px;
            /* allow logo to size naturally so header stays centered */
            flex: 0 1 auto;
        }

        .logo-icon {
            font-size: 1.6rem;
            color: var(--accent);
        }

        .logo-text h1 {
            font-size: 1.15rem;
            font-weight: 600;
            letter-spacing: -0.5px;
            width: 220px;
        }

        .logo-text p {
            font-size: 0.75rem;
            opacity: 0.8;
            margin-top: 2px;
        }

        /* Temperaturanzeige neben Logo */
        .temp-display {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-left: 25px;
            font-size: 1.1rem;
            color: white;
        }

        .temp-display i {
            display: none;
        }

        .temp-display span {
            font-weight: 700;
            font-size: 1.2rem;
        }

        /* Hamburger Menu */
        .hamburger {
            display: none;
            flex-direction: column;
            cursor: pointer;
            padding: 10px;
            z-index: 1002;
        }

        .hamburger span {
            width: 25px;
            height: 3px;
            background-color: white;
            margin: 3px 0;
            transition: 0.3s;
            border-radius: 3px;
        }

        .hamburger.active span:nth-child(1) {
            transform: rotate(-45deg) translate(-5px, 6px);
        }

        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }

        .hamburger.active span:nth-child(3) {
            transform: rotate(45deg) translate(-5px, -6px);
        }

        .mobile-nav {
            display: none;
        }

        nav ul {
            display: flex;
            list-style: none;
            gap: 30px;
            align-items: center;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            /* reduce vertical padding to avoid increasing header height */
            padding: 4px 0;
            position: relative;
            transition: color 0.3s;
        }

        nav a:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: var(--accent);
            transition: width 0.3s;
        }

        nav a:hover {
            color: var(--accent);
        }

        nav a:hover:after {
            width: 100%;
        }

        .weather-header {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 30px; /* more space between items */
            margin-left: 0; /* no extra left spacing so it centers well */
            padding-left: 12px;
            border-left: 1px solid rgba(255, 255, 255, 0.2);
            flex-wrap: nowrap; /* keep items on one line */
            font-size: 1rem; /* slightly larger for readability */
        }

        .weather-item {
            display: flex;
            align-items: center;
            gap: 10px; /* slightly wider gap inside item */
            font-size: 1rem;
            white-space: nowrap; /* prevent line breaks inside each item */
            padding: 0 6px; /* breathing room around each item */
        }
        
        /* Profil Icon */
        .profile-section {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-left: 30px;
        }
        
        .profile-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), #e67e22);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.8rem;
            color: var(--primary);
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }
        
        .profile-icon:hover {
            transform: scale(1.1);
            box-shadow: 0 0 15px rgba(212, 175, 55, 0.5);
        }
        
        .profile-dropdown {
            position: relative;
        }
        
        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            padding: 10px 0;
            min-width: 200px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1001;
        }
        
        .profile-dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .dropdown-menu a {
            display: block;
            padding: 12px 20px;
            color: var(--dark);
            text-decoration: none;
            transition: background-color 0.3s;
            font-size: 0.9rem;
        }
        
        .dropdown-menu a:hover {
            background-color: #f8f9fa;
            color: var(--primary);
        }
        
        .dropdown-menu a i {
            width: 20px;
            margin-right: 10px;
            color: var(--gray);
        }
        
        .user-info {
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            margin-bottom: 5px;
        }
        
        .user-name {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 5px;
        }
        
        .user-email {
            font-size: 0.8rem;
            color: var(--gray);
        }

        /* Login Button falls kein Benutzer */
        .login-btn {
            background: var(--accent);
            color: var(--primary);
            padding: 8px 20px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .login-btn:hover {
            background: #e6c260;
            transform: translateY(-2px);
        }
        
        /* Hero Section */
        .hero {
            background: linear-gradient(rgba(10, 46, 92, 0.7), rgba(26, 75, 140, 0.7)), url('https://www.felix-reisen-koeln.de/files/neuland/inhalt/bilder/reisen/deutschland/plau-am-see/online/plau-am-see-idyllische-mecklenburgische-seenplatte-kleiner-hafen-von-plau-am-see-465856009.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: white;
            padding: 180px 0 120px;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .hero-content {
            max-width: 700px;
        }

        .hero h2 {
            font-size: 3.2rem;
            font-weight: 700;
            margin-bottom: 25px;
            line-height: 1.2;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 35px;
            opacity: 0.9;
        }

        .cta-buttons {
            display: flex;
            gap: 20px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 32px;
            background-color: var(--accent);
            color: var(--primary);
            text-decoration: none;
            border-radius: 4px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            background-color: #e6c260;
        }

        .btn-secondary {
            background-color: transparent;
            border: 2px solid white;
            color: white;
        }

        .btn-secondary:hover {
            background-color: white;
            color: var(--primary);
        }

        /* Booking Section */
        .booking {
            padding: 100px 0;
            background-color: white;
        }

        .section-title {
            text-align: center;
            margin-bottom: 70px;
        }

        .section-title h2 {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 15px;
            font-weight: 700;
        }

        .section-title p {
            color: var(--gray);
            max-width: 700px;
            margin: 0 auto;
            font-size: 1.1rem;
        }

        .booking-tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 40px;
            border-bottom: 1px solid #e0e0e0;
        }

        .tab-btn {
            padding: 15px 30px;
            background: none;
            border: none;
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--gray);
            cursor: pointer;
            transition: all 0.3s;
            border-bottom: 3px solid transparent;
        }

        .tab-btn.active {
            color: var(--primary);
            border-bottom: 3px solid var(--accent);
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .booking-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .booking-card {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.03);
        }

        .booking-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }

        .booking-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .booking-card-content {
            padding: 25px;
        }

        .booking-card h3 {
            font-size: 1.4rem;
            margin-bottom: 10px;
            color: var(--dark);
        }

        .booking-card p {
            color: var(--gray);
            margin-bottom: 15px;
            font-size: 0.95rem;
        }

        .price {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 20px;
        }

        .price span {
            font-size: 1rem;
            color: var(--gray);
            font-weight: normal;
        }

        /* Verbesserte Services Section */
        .services {
            padding: 100px 0;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
        }

        .service-card {
            background-color: white;
            border-radius: 12px;
            padding: 40px 30px;
            text-align: center;
            transition: all 0.4s ease;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            border-top: 4px solid var(--accent);
            position: relative;
            overflow: hidden;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: 1;
        }

        .service-card:hover::before {
            opacity: 0.03;
        }

        .service-icon {
            font-size: 3rem;
            color: var(--primary);
            margin-bottom: 25px;
            height: 90px;
            width: 90px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, rgba(10, 46, 92, 0.1) 0%, transparent 100%);
            border-radius: 50%;
            margin: 0 auto 25px;
            transition: all 0.4s ease;
            position: relative;
            z-index: 2;
        }

        .service-card:hover .service-icon {
            transform: scale(1.1);
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
        }

        .service-card h3 {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: var(--dark);
            font-weight: 600;
            position: relative;
            z-index: 2;
        }

        .service-card p {
            color: var(--gray);
            line-height: 1.7;
            position: relative;
            z-index: 2;
        }

        /* Verbesserte Features Section */
        .features {
            padding: 100px 0;
            background-color: white;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
        }

        .feature-card {
            background-color: white;
            border-radius: 12px;
            padding: 40px 30px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.4s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            border-color: rgba(10, 46, 92, 0.1);
        }

        .feature-card::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--accent), var(--primary));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }

        .feature-card:hover::after {
            transform: scaleX(1);
        }

        .feature-icon {
            font-size: 3rem;
            color: var(--primary);
            margin-bottom: 25px;
            height: 90px;
            width: 90px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, rgba(10, 46, 92, 0.1) 0%, transparent 100%);
            border-radius: 50%;
            margin: 0 auto 25px;
            transition: all 0.4s ease;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
        }

        .feature-card h3 {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: var(--dark);
            font-weight: 600;
        }

        .feature-card p {
            color: var(--gray);
            line-height: 1.7;
        }

        /* Weather Footer Section */
        .weather-footer {
            padding: 60px 0;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
        }

        .weather-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            align-items: center;
        }

        .weather-info {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 40px;
            backdrop-filter: blur(10px);
        }

        .weather-header-large {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .weather-temp {
            font-size: 3.5rem;
            font-weight: 700;
        }

        .weather-details {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-top: 25px;
        }

        .weather-detail-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .weather-text h2 {
            font-size: 2.2rem;
            color: white;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .weather-text p {
            opacity: 0.9;
            margin-bottom: 15px;
        }

        /* Footer */
        footer {
            background-color: var(--dark);
            color: white;
            padding: 80px 0 30px;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 50px;
            margin-bottom: 50px;
        }

        .footer-column h3 {
            font-size: 1.3rem;
            margin-bottom: 25px;
            color: var(--accent);
            font-weight: 600;
        }

        .footer-column ul {
            list-style: none;
        }

        .footer-column ul li {
            margin-bottom: 12px;
        }

        .footer-column a {
            color: #bdc3c7;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-column a:hover {
            color: white;
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transition: background-color 0.3s;
        }

        .social-links a:hover {
            background-color: var(--accent);
        }

        .copyright {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: #bdc3c7;
            font-size: 0.9rem;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .booking-tabs {
                flex-direction: column;
                align-items: center;
            }

            .tab-btn {
                width: 100%;
                text-align: center;
            }

            .weather-container {
                grid-template-columns: 1fr;
            }

            .weather-header {
                display: none;
            }
            
            .profile-section {
                margin-left: 15px;
            }
        }

        @media (max-width: 768px) {
            /* Mobile Header Layout */
            header {
                padding: 0.5rem 0;
            }

            .header-content {
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
                gap: 10px;
            }

            /* Hide logo text on mobile, keep only icon */
            .logo-text {
                display: none;
            }

            .logo {
                flex: 0 0 auto;
                gap: 0;
            }

            .logo-icon {
                font-size: 1.8rem;
            }

            /* Temperaturanzeige im mobilen Header ausblenden */
            .temp-display {
                display: none;
            }

            /* Show hamburger menu and profile on mobile */
            .hamburger {
                display: flex;
                order: 2;
                margin-left: auto;
            }

            /* Profile section visible on mobile, positioned right */
            .profile-section {
                order: 3;
                margin-left: 15px !important;
                margin-top: 0 !important;
                position: relative;
            }

            .profile-dropdown .dropdown-menu {
                position: absolute;
                top: 100%;
                right: 0;
                margin-top: 10px;
            }

            .login-btn {
                padding: 8px 16px;
                font-size: 0.9rem;
            }

            /* Hide desktop navigation on mobile */
            nav {
                display: none;
                position: fixed;
                top: 60px;
                left: 0;
                width: 100%;
                background-color: rgba(10, 46, 92, 0.98);
                padding: 20px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                z-index: 1001;
            }

            nav.mobile-nav-open {
                display: block;
            }

            nav ul {
                flex-direction: column;
                gap: 0;
                align-items: stretch;
            }

            nav ul li {
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }

            nav ul li:last-child {
                border-bottom: none;
            }

            /* Hide profile from nav list on mobile since it's in header */
            nav ul li.profile-section {
                display: none;
            }

            nav a {
                display: block;
                padding: 15px 10px;
                font-size: 1rem;
            }

            .hero h2 {
                font-size: 2.5rem;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: flex-start;
            }

            .section-title h2 {
                font-size: 2rem;
            }
            
            .services-grid,
            .features-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Animationen */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeInUp 0.8s ease forwards;
        }
    </style>
</head>
<body>
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
                                    . '<a href="' . site_url('my-bookings') . '">\n'
                                        . '<i class="fas fa-calendar-alt"></i> Meine Buchungen\n'
                                    . '</a>\n'
                                    . (in_array($user['role'] ?? 'user', ['admin', 'worker']) 
                                        ? '<a href="' . site_url('admin/bookings') . '">\n'
                                            . '<i class="fas fa-tasks"></i> Verwaltung\n'
                                        . '</a>\n'
                                        : '')
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

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content fade-in">
                <h2>Digitale Exzellenz am Plauer See</h2>
                <p>Buchen Sie direkt online Ihren Liegeplatz oder mieten Sie ein Boot für Ihren perfekten Tag auf dem Wasser. Einfach, schnell und transparent.</p>
                <div class="cta-buttons">
                    <a href="#booking" class="btn">
                        <i class="fas fa-calendar-check"></i> Jetzt buchen
                    </a>
                    <a href="/register" class="btn btn-secondary">
                        <i class="fas fa-user-plus"></i> Konto erstellen
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Booking Section -->
    <section class="booking" id="booking">
        <div class="container">
            <div class="section-title fade-in">
                <h2>Direkt buchen</h2>
                <p>Wählen Sie zwischen Liegeplatz mieten oder Boot leihen - einfach und transparent</p>
            </div>

            <div class="booking-tabs">
                <button class="tab-btn active" data-tab="berths">Liegeplätze mieten</button>
                <button class="tab-btn" data-tab="boats">Boote mieten</button>
            </div>

            <!-- Liegeplätze Tab -->
            <div class="tab-content active" id="berths">
                <div class="booking-grid">
                    <div class="booking-card fade-in">
                        <img src="https://media.delius-klasing.de/dk-wassersport/images/dpr_auto,fl_progressive,f_auto,c_fill,g_face:auto,h_600,w_1068/q_auto:eco/yacht/M3421059_d3206a659a2c702bc9f1d70d2e05e207/marinas-liegeplatz-reservierung-per-app-grosse-marktuebersicht" alt="Tagesliegeplatz">
                        <div class="booking-card-content">
                            <h3>Tagesliegeplatz</h3>
                            <p>Für Boote bis 8m Länge. Inklusive Strom- und Wasseranschluss.</p>
                            <div class="price">€25 <span>/ Tag</span></div>
                            <a href="/booking" class="btn" style="width: 100%;">
                                <i class="fas fa-shopping-cart"></i> Jetzt buchen
                            </a>
                        </div>
                    </div>

                    <div class="booking-card fade-in">
                        <img src="https://media.delius-klasing.de/dk-wassersport/images/dpr_auto,fl_progressive,f_auto,c_fill,g_face:auto,h_712,w_1068/q_auto:eco/yacht/modern-classics-2016-hafen-2016-kan-ka201609091338_5df6296934a17a66b38dc9173980ece6/im-paeckchen-liegen-ist-in-der-hochsaison-vielerorts-ueblich-daneben-gibt-es-noch-andere-arten-einen-platz-im-vollen-hafen-zu-ergattern" alt="Wochenliegeplatz">
                        <div class="booking-card-content">
                            <h3>Wochenliegeplatz</h3>
                            <p>Für Boote bis 10m Länge. Inklusive aller Annehmlichkeiten.</p>
                            <div class="price">€150 <span>/ Woche</span></div>
                            <a href="/booking" class="btn" style="width: 100%;">
                                <i class="fas fa-shopping-cart"></i> Jetzt buchen
                            </a>
                        </div>
                    </div>

                    <div class="booking-card fade-in">
                        <img src="https://images.unsplash.com/photo-1506929562872-bb421503ef21?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" alt="Saisonliegeplatz">
                        <div class="booking-card-content">
                            <h3>Saisonliegeplatz</h3>
                            <p>Für die gesamte Saison April-Oktober. Inklusive Winterlager.</p>
                            <div class="price">€1.200 <span>/ Saison</span></div>
                            <a href="/booking" class="btn" style="width: 100%;">
                                <i class="fas fa-shopping-cart"></i> Jetzt buchen
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Boote Tab -->
            <div class="tab-content" id="boats">
                <div class="booking-grid">
                    <div class="booking-card fade-in">
                        <img src="https://www.boat24.com/img/blog/uploads/motor--oder-segelboot-439-1673450068-xlarge.jpg" alt="Motorboot">
                        <div class="booking-card-content">
                            <h3>Motorboot</h3>
                            <p>Für 6 Personen, 40 PS Motor. Perfekt für Familienausflüge.</p>
                            <div class="price">€90 <span>/ 4 Stunden</span></div>
                            <a href="/booking" class="btn" style="width: 100%;">
                                <i class="fas fa-shopping-cart"></i> Jetzt buchen
                            </a>
                        </div>
                    </div>

                    <div class="booking-card fade-in">
                        <img src="https://www.bootsurlaub.de/wp-content/uploads/2020/11/Typ-Segelboot.webp" alt="Segelboot">
                        <div class="booking-card-content">
                            <h3>Segelboot</h3>
                            <p>Für 4 Personen, 25 Fuß. Erleben Sie pure Segelfreude.</p>
                            <div class="price">€120 <span>/ Tag</span></div>
                            <a href="/booking" class="btn" style="width: 100%;">
                                <i class="fas fa-shopping-cart"></i> Jetzt buchen
                            </a>
                        </div>
                    </div>

                    <div class="booking-card fade-in">
                        <img src="https://marianboats.at/wp-content/uploads/2018/08/Unbenan33nt-1.jpg" alt="Elektroboot">
                        <div class="booking-card-content">
                            <h3>Elektroboot</h3>
                            <p>Leise und umweltfreundlich. Für 8 Personen, inkl. Picknick-Tisch.</p>
                            <div class="price">€70 <span>/ 3 Stunden</span></div>
                            <a href="/booking" class="btn" style="width: 100%;">
                                <i class="fas fa-shopping-cart"></i> Jetzt buchen
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Verbesserte Services Section -->
    <section class="services" id="services">
        <div class="container">
            <div class="section-title fade-in">
                <h2>Unsere Services</h2>
                <p>Profitieren Sie von unseren umfangreichen Dienstleistungen rund um den Yachthafen und Bootsverleih.</p>
            </div>
            <div class="services-grid">
                <div class="service-card fade-in">
                    <div class="service-icon"><i class="fas fa-anchor"></i></div>
                    <h3>Liegeplatzverwaltung</h3>
                    <p>Digitale Verwaltung und Buchung von Liegeplätzen – einfach, schnell und transparent. Verwalten Sie Ihre Liegeplätze bequem online und sparen Sie Zeit und Aufwand.</p>
                </div>
                <div class="service-card fade-in">
                    <div class="service-icon"><i class="fas fa-ship"></i></div>
                    <h3>Bootsverleih</h3>
                    <p>Wählen Sie aus einer Vielzahl moderner Boote für Ihren perfekten Tag auf dem Wasser. Von Segelbooten bis zu Motorbooten - für jeden Anlass das passende Boot.</p>
                </div>
                <div class="service-card fade-in">
                    <div class="service-icon"><i class="fas fa-life-ring"></i></div>
                    <h3>Rundum-Service</h3>
                    <p>Von der Einweisung bis zum technischen Support – wir sind für Sie da. Unser Team steht Ihnen mit Rat und Tat zur Seite für ein sorgenfreies Bootserlebnis.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Verbesserte Features Section -->
    <section class="features" id="features">
        <div class="container">
            <div class="section-title fade-in">
                <h2>Unsere Features</h2>
                <p>Entdecken Sie die Vorteile unseres modernen Yachthafens und digitalen Services.</p>
            </div>
            <div class="features-grid">
                <div class="feature-card fade-in">
                    <div class="feature-icon"><i class="fas fa-mobile-alt"></i></div>
                    <h3>Online-Buchung</h3>
                    <p>Buchen Sie Liegeplätze und Boote bequem online – jederzeit und überall. Unser benutzerfreundliches System macht die Buchung zum Kinderspiel.</p>
                </div>
                <div class="feature-card fade-in">
                    <div class="feature-icon"><i class="fas fa-wifi"></i></div>
                    <h3>WLAN am Steg</h3>
                    <p>Bleiben Sie auch auf dem Wasser immer verbunden mit kostenlosem WLAN. Schnelle Internetverbindung an jedem Liegeplatz.</p>
                </div>
                <div class="feature-card fade-in">
                    <div class="feature-icon"><i class="fas fa-shield-alt"></i></div>
                    <h3>Sichere Anlage</h3>
                    <p>Modernste Sicherheitsstandards für Ihr Boot und Ihre Daten. Videoüberwachung und Sicherheitspersonal rund um die Uhr.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Weather Footer Section -->
    <section class="weather-footer">
        <div class="container">
            <div class="weather-container">
                <div class="weather-text fade-in">
                    <h2>Aktuelles Wetter am Plauer See</h2>
                    <p>Planen Sie Ihren Bootsausflug mit unseren detaillierten Wetterinformationen. Wir bieten Echtzeit-Daten und Vorhersagen für die nächsten Tage.</p>
                    <p>Die Wassertemperatur, Windgeschwindigkeit und UV-Index helfen Ihnen, den perfekten Tag für Ihre Bootstour zu finden.</p>
                    <a href="#" class="btn">
                        <i class="fas fa-wind" href="https://www.wetter.com/wetter_aktuell/wettervorhersage/3_tagesvorhersage/deutschland/plau-am-see/DE0008294.html"></i>
                    </a>
                </div>
                <div class="weather-info fade-in">
                    <?php
                        // determine a simple icon class based on weathercode
                        $iconClass = 'fa-sun';
                        if (isset($weather['weathercode'])) {
                            $wc = (int) $weather['weathercode'];
                            if (in_array($wc, [1,2,3,45,48])) $iconClass = 'fa-cloud-sun';
                            if (in_array($wc, [51,53,55,61,63,65,80,81,82])) $iconClass = 'fa-cloud-rain';
                            if (in_array($wc, [71,73,75,85,86])) $iconClass = 'fa-snowflake';
                            if (in_array($wc, [95,96,99])) $iconClass = 'fa-bolt';
                        }
                    ?>
                    <div class="weather-header-large">
                        <div>
                            <h3>Plau am See</h3>
                            <p>Heute, <?= date('j. F') ?></p>
                        </div>
                        <div class="weather-icon">
                            <i class="fas <?= $iconClass ?>" style="font-size: 2.5rem;"></i>
                        </div>
                    </div>
                    <div class="weather-temp"><?= $tc !== null ? round($tc) . '°C' : 'n.v.' ?></div>
                    <div style="margin-top:12px; font-size:0.95rem;">
                        <div style="margin-bottom:6px;">Niederschlag: <?= $prec !== null ? $prec . '%' : 'n.v.' ?></div>
                        <div style="margin-bottom:6px;">Luftfeuchte: <?= $hum !== null ? $hum . '%' : 'n.v.' ?></div>
                        <div>Wind: <?= $wind !== null ? $wind . ' km/h' : 'n.v.' ?></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact">
        <div class="container">
            <div class="footer-content">
                <div class="footer-column fade-in">
                    <h3>Yachthafen Plau am See</h3>
                    <p>Ihr Partner für moderne, digitale Liegeplatzverwaltung und Bootsverleih am Plauer See.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>

                <div class="footer-column fade-in">
                    <h3>Kontakt</h3>
                    <ul>
                        <li><i class="fas fa-map-marker-alt"></i> Hafenstraße 1, 19395 Plau am See</li>
                        <li><i class="fas fa-phone"></i> 038735 12345</li>
                        <li><i class="fas fa-envelope"></i> info@yachthafen-plau.de</li>
                        <li><i class="fas fa-clock"></i> Mo-Fr: 8:00 - 18:00, Sa-So: 9:00 - 16:00</li>
                    </ul>
                </div>

                <div class="footer-column fade-in">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="#">Startseite</a></li>
                        <li><a href="#booking">Buchen</a></li>
                        <li><a href="#features">Features</a></li>
                        <li><a href="#">AGB</a></li>
                        <li><a href="#">Datenschutz</a></li>
                    </ul>
                </div>

                <div class="footer-column fade-in">
                    <h3>Newsletter</h3>
                    <p>Bleiben Sie auf dem Laufenden mit unseren Angeboten und Neuigkeiten.</p>
                    <form style="margin-top: 15px;">
                        <input type="email" placeholder="Ihre E-Mail" style="padding: 10px; width: 100%; margin-bottom: 10px; border-radius: 4px; border: 1px solid #ccc;">
                        <button type="submit" class="btn" style="width: 100%;">
                            <i class="fas fa-paper-plane"></i> Abonnieren
                        </button>
                    </form>
                </div>
            </div>

            <div class="copyright">
                <p>&copy; 2023 Yachthafen Plau am See. Alle Rechte vorbehalten. | Entwickelt mit modernster Web-Technologie</p>
            </div>
        </div>
    </footer>

    <script>
        // Benutzerdaten aus der Datenbank laden
        document.addEventListener('DOMContentLoaded', function() {
            loadUserData();
            initializePage();
        });

        async function loadUserData() {
            try {
                const response = await fetch('/api/current-user');
                const data = await response.json();
                
                const profileSection = document.getElementById('profileSection');
                const createAccountBtn = document.querySelector('.cta-buttons .btn-secondary');
                
                if (data.success && data.user) {
                    // Benutzer ist eingeloggt - Profil-Icon anzeigen
                    const user = data.user;
                    
                    profileSection.innerHTML = `
                        <div class="profile-dropdown">
                            <div class="profile-icon" id="profileInitials">${user.initials}</div>
                            <div class="dropdown-menu">
                                <div class="user-info">
                                    <div class="user-name">${user.firstName} ${user.lastName}</div>
                                    <div class="user-email">${user.email}</div>
                                </div>
                                <a href="/profile">
                                    <i class="fas fa-user"></i> Mein Profil
                                </a>
                                <a href="/my-bookings">
                                    <i class="fas fa-calendar-alt"></i> Meine Buchungen
                                </a>
                                ${['admin', 'worker'].includes(user.role) ? `
                                <a href="/admin/bookings">
                                    <i class="fas fa-tasks"></i> Verwaltung
                                </a>
                                ` : ''}
                                <a href="/settings">
                                    <i class="fas fa-cog"></i> Einstellungen
                                </a>
                                <a href="/logout">
                                    <i class="fas fa-sign-out-alt"></i> Abmelden
                                </a>
                            </div>
                        </div>
                    `;
                    // Verstecke den "Konto erstellen" Button, falls vorhanden
                    if (createAccountBtn) createAccountBtn.style.display = 'none';
                } else {
                    // Kein Benutzer eingeloggt - Login Button anzeigen
                    profileSection.innerHTML = `
                        <a href="/login" class="login-btn">
                            <i class="fas fa-sign-in-alt"></i> Anmelden
                        </a>
                    `;
                    if (createAccountBtn) createAccountBtn.style.display = '';
                }
            } catch (error) {
                console.error('Fehler beim Laden der Benutzerdaten:', error);
                
                // Fallback: Login Button anzeigen
                const profileSection = document.getElementById('profileSection');
                profileSection.innerHTML = `
                    <a href="/login" class="login-btn">
                        <i class="fas fa-sign-in-alt"></i> Anmelden
                    </a>
                `;
                const createAccountBtn = document.querySelector('.cta-buttons .btn-secondary');
                if (createAccountBtn) createAccountBtn.style.display = '';
            }
        }

        function initializePage() {
            // Hamburger Menu Funktionalität
            const hamburger = document.getElementById('hamburger');
            const nav = document.querySelector('nav');
            
            if (hamburger && nav) {
                hamburger.addEventListener('click', () => {
                    hamburger.classList.toggle('active');
                    nav.classList.toggle('mobile-nav-open');
                });

                // Schließe das Menu wenn auf einen Link geklickt wird
                const navLinks = nav.querySelectorAll('a');
                navLinks.forEach(link => {
                    link.addEventListener('click', () => {
                        hamburger.classList.remove('active');
                        nav.classList.remove('mobile-nav-open');
                    });
                });

                // Schließe das Menu wenn außerhalb geklickt wird
                document.addEventListener('click', (e) => {
                    if (!hamburger.contains(e.target) && !nav.contains(e.target)) {
                        hamburger.classList.remove('active');
                        nav.classList.remove('mobile-nav-open');
                    }
                });
            }

            // Tab-Funktionalität
            const tabBtns = document.querySelectorAll('.tab-btn');
            const tabContents = document.querySelectorAll('.tab-content');
            
            if (tabBtns.length > 0) {
                tabBtns.forEach(btn => {
                    btn.addEventListener('click', () => {
                        tabBtns.forEach(b => b.classList.remove('active'));
                        tabContents.forEach(c => c.classList.remove('active'));
                        
                        btn.classList.add('active');
                        const tabId = btn.getAttribute('data-tab');
                        const tabElement = document.getElementById(tabId);
                        if (tabElement) {
                            tabElement.classList.add('active');
                        }
                    });
                });
            }
            
            // Fade-In Animation
            const fadeElements = document.querySelectorAll('.fade-in');
            const fadeInOnScroll = function() {
                fadeElements.forEach(element => {
                    const elementTop = element.getBoundingClientRect().top;
                    const elementVisible = 150;

                    if (elementTop < window.innerHeight - elementVisible) {
                        element.style.opacity = "1";
                        element.style.transform = "translateY(0)";
                    }
                });
            };
            
            fadeElements.forEach(element => {
                element.style.opacity = "0";
                element.style.transform = "translateY(30px)";
                element.style.transition = "opacity 0.8s ease, transform 0.8s ease";
            });

            window.addEventListener('scroll', fadeInOnScroll);
            fadeInOnScroll();

            // Smooth Scroll für Anchor Links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        }
    </script>
</body>
</html>