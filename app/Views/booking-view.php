<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #1a5276;
            --primary-dark: #154360;
            --primary-light: #2e86c1;
            --secondary: #d4ac0d;
            --secondary-dark: #b7950b;
            --accent: #17a2b8;
            --white: #ffffff;
            --light-bg: #f8f9fa;
            --text-dark: #2c3e50;
            --text-light: #6c757d;
            --success: #28a745;
            --danger: #dc3545;
            --warning: #ffc107;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--light-bg) 0%, #e3f2fd 100%);
            color: var(--text-dark);
            line-height: 1.6;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: var(--white);
            padding: 4rem 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none"><path d="M1200 120L0 16.48 0 0 1200 0 1200 120z" fill="%23ffffff"/></svg>');
            background-size: cover;
            background-position: bottom;
            opacity: 0.1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            margin: 0 auto;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .hero .slogan {
            font-size: 1.8rem;
            font-weight: 300;
            margin-bottom: 1.5rem;
            color: var(--secondary);
        }

        .hero .subtitle {
            font-size: 1.2rem;
            margin-bottom: 2.5rem;
            opacity: 0.9;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 1rem 2rem;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: var(--secondary);
            color: var(--primary-dark);
        }

        .btn-primary:hover {
            background: var(--secondary-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(212, 172, 13, 0.3);
        }

        .btn-outline {
            background: transparent;
            color: var(--white);
            border: 2px solid var(--white);
        }

        .btn-outline:hover {
            background: var(--white);
            color: var(--primary);
        }

        /* Navigation Tabs */
        .nav-tabs {
            background: var(--white);
            border-radius: 15px;
            padding: 1rem;
            margin: -2rem auto 3rem;
            max-width: 1200px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            display: flex;
            gap: 0.5rem;
        }

        .nav-tab {
            flex: 1;
            padding: 1.5rem 2rem;
            text-align: center;
            background: var(--light-bg);
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-dark);
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }

        .nav-tab.active {
            background: var(--primary);
            color: var(--white);
            box-shadow: 0 5px 15px rgba(26, 82, 118, 0.3);
        }

        .nav-tab:hover:not(.active) {
            background: var(--primary-light);
            color: var(--white);
        }

        /* Tab Content */
        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /* Marina Layout */
        .marina-section {
            background: var(--white);
            border-radius: 20px;
            padding: 3rem;
            margin-bottom: 3rem;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }

        .section-title {
            font-size: 2.2rem;
            color: var(--primary);
            margin-bottom: 2rem;
            text-align: center;
            font-weight: 700;
        }

        /* SVG Marina Map */
        .marina-map-container {
            background: var(--white);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .marina-svg {
            width: 100%;
            height: auto;
            max-height: 600px;
        }

        .water-area {
            fill: url(#waterGradient);
            stroke: var(--primary-light);
            stroke-width: 1;
        }

        .dock {
            fill: #8B4513;
            stroke: #654321;
            stroke-width: 2;
        }

        .slot-rect {
            fill: #4caf50;
            stroke: #388e3c;
            stroke-width: 2;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .slot-rect:hover:not(.occupied) {
            filter: brightness(1.2);
            stroke-width: 3;
            stroke: var(--white);
        }

        .slot-rect.premium { fill: var(--secondary); stroke: var(--secondary-dark); }
        .slot-rect.comfort { fill: var(--accent); stroke: #138496; }
        .slot-rect.standard { fill: var(--primary-light); stroke: var(--primary); }
        .slot-rect.economy { fill: #6c757d; stroke: #495057; }
        .slot-rect.occupied { fill: var(--danger); stroke: #c82333; cursor: not-allowed; }

        .slot-text {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 12px;
            font-weight: bold;
            fill: var(--white);
            text-anchor: middle;
            pointer-events: none;
            user-select: none;
        }

        .boat-symbol {
            fill: var(--primary-dark);
            stroke: var(--white);
            stroke-width: 1;
        }

        /* Boats Grid */
        .boats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .boat-card {
            background: var(--white);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border: 1px solid #e9ecef;
        }

        .boat-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.15);
        }

        .boat-image {
            height: 200px;
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 3rem;
        }

        .boat-content {
            padding: 1.5rem;
        }

        .boat-header {
            display: flex;
            justify-content: between;
            align-items: start;
            margin-bottom: 1rem;
        }

        .boat-name {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .boat-type {
            color: var(--text-light);
            font-style: italic;
        }

        .boat-price {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--secondary);
            text-align: right;
        }

        .boat-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .detail-item i {
            color: var(--primary);
            width: 16px;
        }

        .boat-features {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .feature-tag {
            background: var(--light-bg);
            color: var(--text-dark);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        /* Forms */
        .booking-form {
            background: var(--white);
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            margin-top: 2rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--primary);
        }

        input, select, textarea {
            width: 100%;
            padding: 1rem 1.25rem;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: var(--light-bg);
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: var(--primary);
            background: var(--white);
            box-shadow: 0 0 0 3px rgba(26, 82, 118, 0.1);
        }

        .form-actions {
            grid-column: 1 / -1;
            text-align: center;
            margin-top: 1rem;
        }

        /* Status Legend */
        .status-legend {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin: 2rem 0;
            flex-wrap: wrap;
        }

        .status-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1.5rem;
            background: var(--white);
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .status-color {
            width: 20px;
            height: 20px;
            border-radius: 5px;
            border: 2px solid rgba(0,0,0,0.1);
        }

        .premium-color { background: var(--secondary); }
        .comfort-color { background: var(--accent); }
        .standard-color { background: var(--primary-light); }
        .economy-color { background: #6c757d; }
        .occupied-color { background: var(--danger); }

        /* Footer */
        .footer {
            background: var(--primary-dark);
            color: var(--white);
            padding: 3rem 0;
            margin-top: 4rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .footer-section h3 {
            color: var(--secondary);
            margin-bottom: 1rem;
        }

        .footer-section p, .footer-section a {
            color: #bdc3c7;
            text-decoration: none;
        }

        .footer-section a:hover {
            color: var(--white);
        }

        @media (max-width: 768px) {
            .hero h1 { font-size: 2.5rem; }
            .hero .slogan { font-size: 1.4rem; }
            .nav-tabs { flex-direction: column; }
            .form-grid { grid-template-columns: 1fr; }
            .boats-grid { grid-template-columns: 1fr; }
            .status-legend { gap: 1rem; }
        }
    </style>
    <title>Yachthafen Plau am See - Premium Liegeplätze & Bootsverleih</title>
</head>
<body>
<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <h1>Yachthafen Plau am See</h1>
            <div class="slogan">Premium Liegeplatzverwaltung & Bootsverleih</div>
            <p class="subtitle">Digitale Exzellenz am Plauer See - Buchen Sie direkt online Ihren Liegeplatz oder mieten Sie ein Boot für Ihren perfekten Tag auf dem Wasser. Einfach, schnell und transparent.</p>
            <div class="hero-buttons">
                <a href="#booking" class="btn btn-primary">
                    <i class="fas fa-calendar-check"></i>Jetzt buchen
                </a>
                <a href="#contact" class="btn btn-outline">
                    <i class="fas fa-info-circle"></i>Kein Stress
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Navigation Tabs -->
<div class="container">
    <div class="nav-tabs" id="booking">
        <button class="nav-tab active" data-tab="slots">
            <i class="fas fa-anchor"></i>Liegeplätze
        </button>
        <button class="nav-tab" data-tab="boats">
            <i class="fas fa-ship"></i>Bootsverleih
        </button>
    </div>
</div>

<!-- Status Legend -->
<div class="container">
    <div class="status-legend">
        <div class="status-item">
            <div class="status-color premium-color"></div>
            <span>Premium</span>
        </div>
        <div class="status-item">
            <div class="status-color comfort-color"></div>
            <span>Komfort</span>
        </div>
        <div class="status-item">
            <div class="status-color standard-color"></div>
            <span>Standard</span>
        </div>
        <div class="status-item">
            <div class="status-color economy-color"></div>
            <span>Economy</span>
        </div>
        <div class="status-item">
            <div class="status-color occupied-color"></div>
            <span>Belegt</span>
        </div>
    </div>
</div>

<!-- Liegeplätze Tab -->
<div class="container">
    <div class="tab-content active" id="slots-tab">
        <div class="marina-map-container">
            <h2 class="section-title">Marina Übersicht - Liegeplätze</h2>

            <svg class="marina-svg" viewBox="0 0 1200 800" xmlns="http://www.w3.org/2000/svg">
                <!-- Wasser-Hintergrund mit Gradient -->
                <defs>
                    <linearGradient id="waterGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                        <stop offset="0%" stop-color="#1e90ff" />
                        <stop offset="100%" stop-color="#0077cc" />
                    </linearGradient>
                    <pattern id="waterPattern" patternUnits="userSpaceOnUse" width="100" height="100">
                        <path d="M0,50 C25,40 50,60 75,50 C100,40 125,60 150,50 L150,100 L0,100 Z" fill="rgba(255,255,255,0.1)" />
                    </pattern>
                </defs>

                <!-- Wasserfläche -->
                <rect class="water-area" x="0" y="0" width="1200" height="800" fill="url(#waterPattern)" />

                <!-- Steganlagen -->
                <!-- Hauptsteg oben -->
                <rect class="dock" x="100" y="100" width="1000" height="20" rx="5" />

                <!-- Steg A - Premium -->
                <rect class="dock" x="150" y="120" width="15" height="180" />
                <!-- Liegeplätze Reihe A -->
                <g class="slot-group" data-row="A">
                    <rect class="slot-rect premium" x="165" y="120" width="80" height="30" rx="5" data-slot="A1" />
                    <text class="slot-text" x="205" y="140">A1</text>

                    <rect class="slot-rect premium occupied" x="165" y="160" width="80" height="30" rx="5" data-slot="A2" />
                    <text class="slot-text" x="205" y="180">A2</text>

                    <rect class="slot-rect premium" x="165" y="200" width="80" height="30" rx="5" data-slot="A3" />
                    <text class="slot-text" x="205" y="220">A3</text>

                    <rect class="slot-rect premium" x="165" y="240" width="80" height="30" rx="5" data-slot="A4" />
                    <text class="slot-text" x="205" y="260">A4</text>
                </g>

                <!-- Steg B - Komfort -->
                <rect class="dock" x="300" y="120" width="15" height="220" />
                <!-- Liegeplätze Reihe B -->
                <g class="slot-group" data-row="B">
                    <rect class="slot-rect comfort" x="315" y="120" width="80" height="30" rx="5" data-slot="B1" />
                    <text class="slot-text" x="355" y="140">B1</text>

                    <rect class="slot-rect comfort" x="315" y="160" width="80" height="30" rx="5" data-slot="B2" />
                    <text class="slot-text" x="355" y="180">B2</text>

                    <rect class="slot-rect comfort occupied" x="315" y="200" width="80" height="30" rx="5" data-slot="B3" />
                    <text class="slot-text" x="355" y="220">B3</text>

                    <rect class="slot-rect comfort" x="315" y="240" width="80" height="30" rx="5" data-slot="B4" />
                    <text class="slot-text" x="355" y="260">B4</text>

                    <rect class="slot-rect comfort" x="315" y="280" width="80" height="30" rx="5" data-slot="B5" />
                    <text class="slot-text" x="355" y="300">B5</text>
                </g>

                <!-- Steg C - Standard -->
                <rect class="dock" x="500" y="120" width="15" height="260" />
                <!-- Liegeplätze Reihe C -->
                <g class="slot-group" data-row="C">
                    <rect class="slot-rect standard" x="515" y="120" width="80" height="30" rx="5" data-slot="C1" />
                    <text class="slot-text" x="555" y="140">C1</text>

                    <rect class="slot-rect standard" x="515" y="160" width="80" height="30" rx="5" data-slot="C2" />
                    <text class="slot-text" x="555" y="180">C2</text>

                    <rect class="slot-rect standard" x="515" y="200" width="80" height="30" rx="5" data-slot="C3" />
                    <text class="slot-text" x="555" y="220">C3</text>

                    <rect class="slot-rect standard occupied" x="515" y="240" width="80" height="30" rx="5" data-slot="C4" />
                    <text class="slot-text" x="555" y="260">C4</text>

                    <rect class="slot-rect standard" x="515" y="280" width="80" height="30" rx="5" data-slot="C5" />
                    <text class="slot-text" x="555" y="300">C5</text>

                    <rect class="slot-rect standard" x="515" y="320" width="80" height="30" rx="5" data-slot="C6" />
                    <text class="slot-text" x="555" y="340">C6</text>
                </g>

                <!-- Steg D - Economy -->
                <rect class="dock" x="700" y="120" width="15" height="220" />
                <!-- Liegeplätze Reihe D -->
                <g class="slot-group" data-row="D">
                    <rect class="slot-rect economy" x="715" y="120" width="80" height="30" rx="5" data-slot="D1" />
                    <text class="slot-text" x="755" y="140">D1</text>

                    <rect class="slot-rect economy occupied" x="715" y="160" width="80" height="30" rx="5" data-slot="D2" />
                    <text class="slot-text" x="755" y="180">D2</text>

                    <rect class="slot-rect economy" x="715" y="200" width="80" height="30" rx="5" data-slot="D3" />
                    <text class="slot-text" x="755" y="220">D3</text>

                    <rect class="slot-rect economy" x="715" y="240" width="80" height="30" rx="5" data-slot="D4" />
                    <text class="slot-text" x="755" y="260">D4</text>

                    <rect class="slot-rect economy" x="715" y="280" width="80" height="30" rx="5" data-slot="D5" />
                    <text class="slot-text" x="755" y="300">D5</text>
                </g>

                <!-- Boot-Symbole auf belegten Plätzen -->
                <g class="boat-symbols">
                    <!-- Boot auf A2 -->
                    <path class="boat-symbol" d="M185,145 L185,135 L225,135 L225,145 Z" />
                    <!-- Boot auf B3 -->
                    <path class="boat-symbol" d="M335,225 L335,215 L375,215 L375,225 Z" />
                    <!-- Boot auf C4 -->
                    <path class="boat-symbol" d="M535,265 L535,255 L575,255 L575,265 Z" />
                    <!-- Boot auf D2 -->
                    <path class="boat-symbol" d="M735,185 L735,175 L775,175 L775,185 Z" />
                </g>

                <!-- Beschriftungen -->
                <text x="200" y="90" font-family="Arial" font-size="16" font-weight="bold" fill="var(--primary)">Reihe A - Premium</text>
                <text x="350" y="90" font-family="Arial" font-size="16" font-weight="bold" fill="var(--primary)">Reihe B - Komfort</text>
                <text x="550" y="90" font-family="Arial" font-size="16" font-weight="bold" fill="var(--primary)">Reihe C - Standard</text>
                <text x="750" y="90" font-family="Arial" font-size="16" font-weight="bold" fill="var(--primary)">Reihe D - Economy</text>

                <!-- Wasser-Einlauf -->
                <path d="M50,400 C150,350 250,450 350,400 C450,350 550,450 650,400 C750,350 850,450 950,400 C1050,350 1150,450 1200,400 L1200,800 L0,800 L0,400 Z"
                      fill="url(#waterGradient)" opacity="0.8" />
            </svg>
        </div>

        <!-- Liegeplatz Buchungsformular -->
        <div class="booking-form">
            <h2 class="section-title">Liegeplatz Reservierung</h2>
            <form id="slotReservationForm">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="slotCustomerName"><i class="fas fa-user"></i> Name</label>
                        <input type="text" id="slotCustomerName" name="customer_name" required>
                    </div>
                    <div class="form-group">
                        <label for="slotCustomerEmail"><i class="fas fa-envelope"></i> E-Mail</label>
                        <input type="email" id="slotCustomerEmail" name="customer_email" required>
                    </div>
                    <div class="form-group">
                        <label for="slotCustomerPhone"><i class="fas fa-phone"></i> Telefon</label>
                        <input type="tel" id="slotCustomerPhone" name="customer_phone" required>
                    </div>
                    <div class="form-group">
                        <label for="boatLength"><i class="fas fa-ruler"></i> Bootslänge (m)</label>
                        <input type="number" id="boatLength" name="boat_length" min="4" max="20" step="0.1" required>
                    </div>
                    <div class="form-group">
                        <label for="slotStartDate"><i class="fas fa-calendar-day"></i> Startdatum</label>
                        <input type="date" id="slotStartDate" name="start_date" required>
                    </div>
                    <div class="form-group">
                        <label for="slotEndDate"><i class="fas fa-calendar-day"></i> Enddatum</label>
                        <input type="date" id="slotEndDate" name="end_date" required>
                    </div>
                    <div class="form-group full-width">
                        <label for="selectedSlot"><i class="fas fa-anchor"></i> Ausgewählter Liegeplatz</label>
                        <input type="text" id="selectedSlot" name="slot_id" readonly
                               placeholder="Klicken Sie auf einen verfügbaren Liegeplatz in der Karte">
                    </div>
                    <div class="form-group full-width">
                        <label for="specialRequests"><i class="fas fa-comment"></i> Besondere Wünsche</label>
                        <textarea id="specialRequests" name="special_requests" rows="3" placeholder="Zusätzliche Ausstattung oder Anmerkungen..."></textarea>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check-circle"></i>Liegeplatz reservieren
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootsverleih Tab -->
    <div class="tab-content" id="boats-tab">
        <!-- Boots Buchungsformular -->
        <div class="booking-form">
            <h2 class="section-title">Boot Reservierung</h2>
            <form id="boatReservationForm">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="boatCustomerName"><i class="fas fa-user"></i> Name</label>
                        <input type="text" id="boatCustomerName" name="customer_name" required>
                    </div>
                    <div class="form-group">
                        <label for="boatCustomerEmail"><i class="fas fa-envelope"></i> E-Mail</label>
                        <input type="email" id="boatCustomerEmail" name="customer_email" required>
                    </div>
                    <div class="form-group">
                        <label for="boatCustomerPhone"><i class="fas fa-phone"></i> Telefon</label>
                        <input type="tel" id="boatCustomerPhone" name="customer_phone" required>
                    </div>
                    <div class="form-group">
                        <label for="boatExperience"><i class="fas fa-ship"></i> Erfahrung</label>
                        <select id="boatExperience" name="experience" required>
                            <option value="">Bitte wählen</option>
                            <option value="beginner">Anfänger</option>
                            <option value="intermediate">Erfahren</option>
                            <option value="expert">Experte</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="boatStartDate"><i class="fas fa-calendar-day"></i> Startdatum</label>
                        <input type="date" id="boatStartDate" name="start_date" required>
                    </div>
                    <div class="form-group">
                        <label for="boatEndDate"><i class="fas fa-calendar-day"></i> Enddatum</label>
                        <input type="date" id="boatEndDate" name="end_date" required>
                    </div>
                    <div class="form-group full-width">
                        <label for="selectedBoat"><i class="fas fa-ship"></i> Boot auswählen</label>
                        <select id="selectedBoat" name="boat_id" required>
                            <option value="">Boot wählen...</option>
                            <option value="1" data-price="350">Bavaria Cruiser 37 (Segelyacht - €350.00/Tag)</option>
                            <option value="2" data-price="320">Hanse 388 (Segelyacht - €320.00/Tag)</option>
                            <option value="3" data-price="280">Jeanneau Sun Odyssey 349 (Segelyacht - €280.00/Tag)</option>
                            <option value="4" data-price="220">Quicksilver Activ 675 (Motorboot - €220.00/Tag)</option>
                            <option value="5" data-price="180">Bayliner VR6 (Motorboot - €180.00/Tag)</option>
                            <option value="6" data-price="90">Zodiac Cadet 310 (Schlauchboot - €90.00/Tag)</option>
                        </select>
                    </div>
                    <div class="form-group full-width">
                        <label for="boatRequests"><i class="fas fa-comment"></i> Zusätzliche Ausrüstung</label>
                        <textarea id="boatRequests" name="additional_equipment" rows="3" placeholder="Zusätzliche Ausrüstung oder besondere Wünsche..."></textarea>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-ship"></i>Boot reservieren
                    </button>
                </div>
            </form>
        </div>

        <!-- Boote Übersicht -->
        <div class="marina-section">
            <h2 class="section-title">Unsere Bootsflotte</h2>
            <div class="boats-grid">
                <!-- Boot Cards werden hier dynamisch eingefügt -->
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="footer" id="contact">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Kontakt</h3>
                <p><i class="fas fa-phone"></i> +49 123 456789</p>
                <p><i class="fas fa-envelope"></i> info@yachthafen-plau.de</p>
                <p><i class="fas fa-map-marker-alt"></i> Hafenstraße 1, 19395 Plau am See</p>
            </div>
            <div class="footer-section">
                <h3>Öffnungszeiten</h3>
                <p>Mo-Fr: 8:00-18:00</p>
                <p>Sa: 9:00-16:00</p>
                <p>So: 10:00-14:00</p>
            </div>
            <div class="footer-section">
                <h3>Service</h3>
                <p><a href="#">AGB</a></p>
                <p><a href="#">Datenschutz</a></p>
                <p><a href="#">Impressum</a></p>
            </div>
        </div>
    </div>
</footer>

<script>
    // Tab Funktionalität
    document.querySelectorAll('.nav-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.nav-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));

            this.classList.add('active');
            const tabId = this.getAttribute('data-tab');
            document.getElementById(tabId + '-tab').classList.add('active');
        });
    });

    // Liegeplatz Auswahl in der SVG-Karte
    document.querySelectorAll('.slot-rect:not(.occupied)').forEach(slot => {
        slot.addEventListener('click', function() {
            const slotId = this.getAttribute('data-slot');
            document.getElementById('selectedSlot').value = slotId;

            // Visuelles Feedback
            document.querySelectorAll('.slot-rect').forEach(s => {
                s.style.stroke = '';
                s.style.strokeWidth = '2';
            });
            this.style.stroke = 'var(--white)';
            this.style.strokeWidth = '3';
            this.style.filter = 'brightness(1.3)';
        });
    });

    // Boot Auswahl
    document.querySelectorAll('.select-boat').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const boatId = this.getAttribute('data-boat-id');
            document.getElementById('selectedBoat').value = boatId;

            // Zum Boots-Tab wechseln
            document.querySelectorAll('.nav-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
            document.querySelector('.nav-tab[data-tab="boats"]').classList.add('active');
            document.getElementById('boats-tab').classList.add('active');

            // Zum Formular scrollen
            document.getElementById('boats-tab').scrollIntoView({ behavior: 'smooth' });
        });
    });

    // Formular Absenden
    document.getElementById('slotReservationForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        // Simulierte Reservierung
        const reservationNumber = 'SLOT-' + Math.random().toString(36).substr(2, 9).toUpperCase();
        alert('✅ Liegeplatz erfolgreich reserviert!\nReservierungsnummer: ' + reservationNumber);
        this.reset();
        document.getElementById('selectedSlot').value = '';
    });

    document.getElementById('boatReservationForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        // Simulierte Reservierung
        const reservationNumber = 'BOAT-' + Math.random().toString(36).substr(2, 9).toUpperCase();
        alert('✅ Boot erfolgreich reserviert!\nReservierungsnummer: ' + reservationNumber);
        this.reset();
    });

    // Heutiges Datum setzen
    const today = new Date().toISOString().split('T')[0];
    document.querySelectorAll('input[type="date"]').forEach(input => {
        input.value = today;
        input.min = today;
    });

    // Smooth Scroll für Anchor Links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // Boots-Daten für die Anzeige
    const boatsData = [
        {
            id: 1,
            name: 'Bavaria Cruiser 37',
            type: 'Segelyacht',
            category: 'premium',
            length: 11.3,
            year: 2023,
            capacity: 8,
            price_per_day: 350,
            features: ['Kajüt', 'Küche', 'WC', 'GPS', 'Autopilot']
        },
        {
            id: 2,
            name: 'Hanse 388',
            type: 'Segelyacht',
            category: 'premium',
            length: 11.4,
            year: 2022,
            capacity: 6,
            price_per_day: 320,
            features: ['2 Kabinen', 'Kombüse', 'Dusche', 'Elektrowinde']
        },
        {
            id: 3,
            name: 'Jeanneau Sun Odyssey 349',
            type: 'Segelyacht',
            category: 'comfort',
            length: 10.3,
            year: 2021,
            capacity: 6,
            price_per_day: 280,
            features: ['Großraum', 'Kühlschrank', 'Heizung', 'Badeleiter']
        },
        {
            id: 4,
            name: 'Quicksilver Activ 675',
            type: 'Motorboot',
            category: 'comfort',
            length: 6.75,
            year: 2023,
            capacity: 8,
            price_per_day: 220,
            features: ['Sonnenliege', 'Badeplattform', 'Kühlbox', 'USB-Anschluss']
        },
        {
            id: 5,
            name: 'Bayliner VR6',
            type: 'Motorboot',
            category: 'standard',
            length: 6.1,
            year: 2022,
            capacity: 6,
            price_per_day: 180,
            features: ['Ski-Torpedo', 'Badeleiter', 'Sportlenkung', 'Stereoanlage']
        },
        {
            id: 6,
            name: 'Zodiac Cadet 310',
            type: 'Schlauchboot',
            category: 'economy',
            length: 3.1,
            year: 2023,
            capacity: 4,
            price_per_day: 90,
            features: ['Leicht', 'Wendig', 'Einfache Bedienung', 'Transportabel']
        }
    ];

    // Boots-Karten dynamisch generieren
    const boatsGrid = document.querySelector('.boats-grid');
    boatsData.forEach(boat => {
        const boatCard = document.createElement('div');
        boatCard.className = 'boat-card';
        boatCard.setAttribute('data-boat-id', boat.id);

        boatCard.innerHTML = `
                <div class="boat-image">
                    <i class="fas fa-ship"></i>
                </div>
                <div class="boat-content">
                    <div class="boat-header">
                        <div>
                            <div class="boat-name">${boat.name}</div>
                            <div class="boat-type">${boat.type} • ${boat.year}</div>
                        </div>
                        <div class="boat-price">€${boat.price_per_day.toFixed(2)}</div>
                    </div>
                    <div class="boat-details">
                        <div class="detail-item">
                            <i class="fas fa-ruler"></i>
                            <span>${boat.length}m Länge</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-users"></i>
                            <span>${boat.capacity} Personen</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-tag"></i>
                            <span>${boat.category.charAt(0).toUpperCase() + boat.category.slice(1)}</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-calendar"></i>
                            <span>Baujahr ${boat.year}</span>
                        </div>
                    </div>
                    <div class="boat-features">
                        ${boat.features.map(feature => `<span class="feature-tag">${feature}</span>`).join('')}
                    </div>
                    <button class="btn btn-primary select-boat" data-boat-id="${boat.id}" style="width: 100%;">
                        <i class="fas fa-check"></i>Dieses Boot auswählen
                    </button>
                </div>
            `;

        boatsGrid.appendChild(boatCard);
    });

    // Event Listener für dynamisch erstellte Boots-Buttons
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('select-boat')) {
            const boatId = e.target.getAttribute('data-boat-id');
            document.getElementById('selectedBoat').value = boatId;

            document.querySelectorAll('.nav-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
            document.querySelector('.nav-tab[data-tab="boats"]').classList.add('active');
            document.getElementById('boats-tab').classList.add('active');

            document.getElementById('boats-tab').scrollIntoView({ behavior: 'smooth' });
        }
    });
</script>
</body>
</html>