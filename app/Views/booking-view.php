<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Yachthafen Plau am See - Premium Liegeplätze & Bootsverleih</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #1a5276;
            --primary-dark: #0d3c5a;
            --primary-light: #2e86c1;
            --secondary: #d4ac0d;
            --secondary-light: #f4d03f;
            --accent: #17a2b8;
            --white: #ffffff;
            --light-bg: #f8f9fa;
            --light-gray: #e9ecef;
            --text-dark: #2c3e50;
            --text-light: #6c757d;
            --success: #28a745;
            --danger: #dc3545;
            --warning: #ffc107;
            --shadow: rgba(0, 0, 0, 0.1);
            --border-radius: 12px;
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--light-bg);
            color: var(--text-dark);
            line-height: 1.6;
            min-height: 100vh;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(rgba(26, 82, 118, 0.9), rgba(13, 60, 90, 0.9)),
                        url('https://images.unsplash.com/photo-1534215754734-18e55d13e346?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            color: var(--white);
            padding: 9rem 0;
            text-align: center;
            position: relative;
        }

        .hero-content {
            max-width: 900px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            letter-spacing: -0.5px;
        }

        .hero .slogan {
            font-size: 1.8rem;
            font-weight: 300;
            margin-bottom: 1.5rem;
            color: var(--secondary-light);
            font-style: italic;
        }

        .hero .subtitle {
            font-size: 1.2rem;
            margin-bottom: 2.5rem;
            opacity: 0.9;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn {
            padding: 1rem 2rem;
            border: none;
            border-radius: var(--border-radius);
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
        }

        .btn-primary {
            background: var(--secondary);
            color: var(--primary-dark);
        }

        .btn-primary:hover {
            background: var(--secondary-light);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(212, 172, 13, 0.2);
        }

        /* Navigation Tabs */
        .nav-tabs {
            background: var(--white);
            border-radius: var(--border-radius);
            padding: 1rem;
            margin: -3rem auto 4rem;
            max-width: 900px;
            box-shadow: 0 10px 30px var(--shadow);
            display: flex;
            gap: 1rem;
            position: relative;
            z-index: 10;
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
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }

        .nav-tab.active {
            background: var(--primary);
            color: var(--white);
            box-shadow: 0 5px 15px rgba(26, 82, 118, 0.2);
        }

        .nav-tab:hover:not(.active) {
            background: var(--primary-light);
            color: var(--white);
        }

        /* Tab Content */
        .tab-content {
            display: none;
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .tab-content.active {
            display: block;
        }

        /* Marina Layout */
        .marina-section {
            background: var(--white);
            border-radius: var(--border-radius);
            padding: 3rem;
            margin-bottom: 3rem;
            box-shadow: 0 10px 30px var(--shadow);
            border: 1px solid var(--light-gray);
        }

        .section-title {
            font-size: 2.2rem;
            color: var(--primary);
            margin-bottom: 2rem;
            text-align: center;
            font-weight: 600;
            position: relative;
            padding-bottom: 1rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--secondary);
            border-radius: 2px;
        }

        /* Marina View mit realistischem See-Bild */
        .marina-map-container {
            background: var(--white);
            border-radius: var(--border-radius);
            padding: 2rem;
            margin-bottom: 3rem;
            box-shadow: 0 10px 30px var(--shadow);
            border: 1px solid var(--light-gray);
            overflow: hidden;
        }

        .marina-view {
            width: 100%;
            height: 600px;
            border-radius: var(--border-radius);
            overflow: hidden;
            position: relative;
            background: url('https://media.istockphoto.com/id/959508862/de/foto/blaues-meer-f%C3%BCr-hintergrund.jpg?s=612x612&w=0&k=20&c=2nDBrTHMDsfWpsb4x7zCUzOjiDrvPAhk8u-kENTclks=');
            background-size: cover;
            background-position: center;
            border: 3px solid var(--primary);
        }

        .marina-view::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(rgba(255, 255, 255, 0.1), rgba(0, 0, 0, 0.1));
            z-index: 1;
        }

        .dock {
            position: absolute;
            background: linear-gradient(180deg, #8B4513 0%, #654321 100%);
            border-radius: 4px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            z-index: 2;
        }

        .dock-label {
            position: absolute;
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.8);
            z-index: 5;
            background: rgba(26, 82, 118, 0.8);
            padding: 5px 15px;
            border-radius: 20px;
            border: 2px solid var(--secondary);
        }

        .slot {
            position: absolute;
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            z-index: 3;
            border: 2px solid rgba(255, 255, 255, 0.5);
            min-width: 90px;
            min-height: 35px;
            backdrop-filter: blur(2px);
        }

        .slot:hover:not(.occupied) {
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
            z-index: 10;
        }

        .slot.selected {
            border-color: var(--white);
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.5), 0 5px 20px rgba(0, 0, 0, 0.5);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(255, 255, 255, 0); }
            100% { box-shadow: 0 0 0 0 rgba(255, 255, 255, 0); }
        }

        .slot.premium { 
            background: linear-gradient(135deg, rgba(212, 172, 13, 0.9) 0%, rgba(241, 196, 15, 0.9) 100%);
            border-color: var(--secondary);
        }
        .slot.comfort { 
            background: linear-gradient(135deg, rgba(23, 162, 184, 0.9) 0%, rgba(91, 192, 222, 0.9) 100%);
            border-color: var(--accent);
        }
        .slot.standard { 
            background: linear-gradient(135deg, rgba(46, 134, 193, 0.9) 0%, rgba(52, 152, 219, 0.9) 100%);
            border-color: var(--primary-light);
        }
        .slot.economy { 
            background: linear-gradient(135deg, rgba(149, 165, 166, 0.9) 0%, rgba(127, 140, 141, 0.9) 100%);
            border-color: #7f8c8d;
        }
        .slot.occupied { 
            background: linear-gradient(135deg, rgba(220, 53, 69, 0.9) 0%, rgba(192, 57, 43, 0.9) 100%);
            cursor: not-allowed;
            border-color: var(--danger);
        }

        /* Boote auf dem See */
        .boat-on-water {
            position: absolute;
            width: 100px;
            height: 35px;
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            border-radius: 6px;
            cursor: move;
            z-index: 4;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.8rem;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
            transition: var(--transition);
            border: 2px solid rgba(255, 255, 255, 0.3);
            user-select: none;
        }

        .boat-on-water::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            width: 15px;
            height: 15px;
            background: #e74c3c;
            border-radius: 50%;
            box-shadow: 0 0 8px rgba(231, 76, 60, 0.7);
        }

        .boat-on-water:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.5);
        }

        .boat-on-water.dragging {
            transform: scale(1.1);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.6);
            z-index: 100;
        }

        /* Wellen-Effekt auf den Booten */
        .boat-wave {
            position: absolute;
            bottom: -3px;
            left: 0;
            right: 0;
            height: 6px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            animation: wave 2s infinite;
        }

        @keyframes wave {
            0% { transform: scale(0.8); opacity: 0.5; }
            50% { transform: scale(1); opacity: 0.3; }
            100% { transform: scale(0.8); opacity: 0.5; }
        }

        /* Boots Grid */
        .boats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .boat-card {
            background: var(--white);
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: 0 8px 20px var(--shadow);
            transition: var(--transition);
            border: 1px solid var(--light-gray);
        }

        .boat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .boat-image {
            height: 200px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .boat-category {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            z-index: 2;
        }

        .boat-content {
            padding: 1.5rem;
        }

        .boat-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .boat-name {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 0.3rem;
        }

        .boat-type {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .boat-price {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--secondary);
            text-align: right;
        }

        .boat-price span {
            font-size: 0.9rem;
            color: var(--text-light);
            font-weight: normal;
        }

        .boat-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.8rem;
            margin-bottom: 1.2rem;
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-dark);
            font-size: 0.9rem;
        }

        .detail-item i {
            color: var(--primary);
            width: 16px;
            text-align: center;
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
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 500;
            border: 1px solid var(--light-gray);
        }

        /* Forms */
        .booking-form {
            background: var(--white);
            border-radius: var(--border-radius);
            padding: 3rem;
            box-shadow: 0 10px 30px var(--shadow);
            margin-top: 2rem;
            border: 1px solid var(--light-gray);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
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
            font-size: 0.95rem;
        }

        input, select, textarea {
            width: 100%;
            padding: 0.9rem 1.2rem;
            border: 2px solid var(--light-gray);
            border-radius: 8px;
            font-size: 1rem;
            transition: var(--transition);
            background: var(--white);
            font-family: inherit;
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: var(--primary);
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
            margin: 3rem 0;
            flex-wrap: wrap;
        }

        .status-item {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            padding: 0.8rem 1.5rem;
            background: var(--white);
            border-radius: 8px;
            box-shadow: 0 5px 15px var(--shadow);
            transition: var(--transition);
            border: 1px solid var(--light-gray);
        }

        .status-item:hover {
            transform: translateY(-2px);
        }

        .status-color {
            width: 20px;
            height: 20px;
            border-radius: 4px;
            border: 2px solid rgba(255, 255, 255, 0.8);
        }

        .premium-color { background: var(--secondary); }
        .comfort-color { background: var(--accent); }
        .standard-color { background: var(--primary-light); }
        .economy-color { background: #95a5a6; }
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
            margin-bottom: 1.2rem;
            font-size: 1.3rem;
        }

        .footer-section p, .footer-section a {
            color: #bdc3c7;
            text-decoration: none;
            margin-bottom: 0.8rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition);
        }

        .footer-section a:hover {
            color: var(--white);
        }

        .copyright {
            text-align: center;
            padding-top: 2rem;
            margin-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: #95a5a6;
            font-size: 0.9rem;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .marina-view { height: 500px; }
        }

        @media (max-width: 992px) {
            .hero h1 { font-size: 2.8rem; }
            .hero .slogan { font-size: 1.5rem; }
            .form-grid { grid-template-columns: 1fr; }
            .nav-tabs { flex-direction: column; }
        }

        @media (max-width: 768px) {
            .hero { padding: 3rem 0; }
            .hero h1 { font-size: 2.2rem; }
            .hero .slogan { font-size: 1.3rem; }
            .section-title { font-size: 1.8rem; }
            .marina-section, .booking-form { padding: 2rem; }
            .boats-grid { grid-template-columns: 1fr; }
            .status-legend { gap: 1rem; }
            .status-item { padding: 0.6rem 1rem; }
            .marina-view { height: 400px; }
            .boat-on-water { width: 80px; height: 30px; font-size: 0.7rem; }
            .slot { min-width: 80px; min-height: 30px; }
        }

        /* Utility Classes */
        .text-center { text-align: center; }
        .mb-2 { margin-bottom: 2rem; }
        .mt-3 { margin-top: 3rem; }
    </style>
</head>
<body>
<?= view('header', ['weather' => $weather ?? null]) ?>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <h1>Yachthafen Plau am See</h1>
            <div class="slogan">Premium Liegeplatzverwaltung & Bootsverleih</div>
            <p class="subtitle">Entdecken Sie die digitale Exzellenz am Plauer See - Buchen Sie direkt online Ihren
                Liegeplatz oder mieten Sie eines unserer Premium-Boote für unvergessliche Stunden auf dem Wasser.</p>
        </div>
    </div>
</section>

<!-- Navigation Tabs -->
<div class="container">
    <div class="nav-tabs" id="booking">
        <button class="nav-tab active" data-tab="slots">
            <i class="fas fa-anchor"></i>Liegeplätze & Marina
        </button>
        <button class="nav-tab" data-tab="boats">
            <i class="fas fa-ship"></i>Bootsverleih
        </button>
    </div>
</div>

<!-- Liegeplätze Tab -->
<div class="container">
    <div class="tab-content active" id="slots-tab">
        <div class="marina-map-container">
            <h2 class="section-title">Marina Übersicht - Plauer See</h2>
            <p class="text-center mb-2" style="color: var(--text-light); max-width: 800px; margin: 0 auto 2rem;">
                Klicken Sie auf einen verfügbaren Liegeplatz, um ihn auszuwählen. Ziehen Sie die Boote, um sie auf dem See zu verschieben.
            </p>
            
            <div class="marina-view" id="marinaView">
                <!-- Natürliches See-Bild als Hintergrund -->
                
                <!-- Hauptsteg -->
                <div class="dock" style="width: 85%; height: 25px; top: 60px; left: 7.5%;"></div>
                
                <!-- Docks -->
                <div class="dock" style="width: 20px; height: 200px; top: 85px; left: 15%;"></div>
                <div class="dock" style="width: 20px; height: 250px; top: 85px; left: 30%;"></div>
                <div class="dock" style="width: 20px; height: 300px; top: 85px; left: 45%;"></div>
                <div class="dock" style="width: 20px; height: 200px; top: 85px; left: 60%;"></div>
                <div class="dock" style="width: 20px; height: 180px; top: 85px; left: 75%;"></div>
                
                <!-- Dock Labels -->
                <div class="dock-label" style="top: 40px; left: 18%;">Premium</div>
                <div class="dock-label" style="top: 40px; left: 33%;">Komfort</div>
                <div class="dock-label" style="top: 40px; left: 48%;">Standard</div>
                <div class="dock-label" style="top: 40px; left: 63%;">Economy</div>
                
                <!-- Slots - Dynamisch aus Datenbank generiert -->
                <?php 
                // Slots gruppieren nach Reihe
                $slotsByRow = [];
                foreach ($slots as $slot) {
                    $slotsByRow[$slot['row']][] = $slot;
                }
                
                // Position-Mapping für visuelle Darstellung
                $rowPositions = ['A' => '16%', 'B' => '31%', 'C' => '46%', 'D' => '61%'];
                $topStart = 95;
                $topIncrement = 45;
                
                // Einige Slots als occupied markieren (simuliert)
                $occupiedSlots = ['A2', 'B3', 'C4', 'D2'];
                
                foreach ($slotsByRow as $row => $rowSlots):
                    $leftPos = $rowPositions[$row] ?? '16%';
                    foreach ($rowSlots as $index => $slot):
                        $topPos = $topStart + ($slot['position'] - 1) * $topIncrement;
                        $isOccupied = in_array($slot['slot_number'], $occupiedSlots);
                        $occupiedClass = $isOccupied ? ' occupied' : '';
                ?>
                <div class="slot <?= strtolower($slot['category']) ?><?= $occupiedClass ?>" 
                     style="top: <?= $topPos ?>px; left: <?= $leftPos ?>;" 
                     data-slot-id="<?= $slot['id'] ?>"
                     data-slot="<?= $slot['slot_number'] ?>">
                    <?= $slot['slot_number'] ?>
                </div>
                <?php 
                    endforeach;
                endforeach;
                ?>
                
                <!-- Boote auf dem Wasser -->
                <div class="boat-on-water" style="top: 135px; left: 20%;" data-slot="A2">
                    A2
                    <div class="boat-wave"></div>
                </div>
                <div class="boat-on-water" style="top: 180px; left: 35%;" data-slot="B3">
                    B3
                    <div class="boat-wave"></div>
                </div>
                <div class="boat-on-water" style="top: 225px; left: 50%;" data-slot="C4">
                    C4
                    <div class="boat-wave"></div>
                </div>
                <div class="boat-on-water" style="top: 135px; left: 65%;" data-slot="D2">
                    D2
                    <div class="boat-wave"></div>
                </div>
                
                <!-- Zusätzliche frei schwimmende Boote -->
                <div class="boat-on-water" style="top: 350px; left: 25%;" data-boat="Segelyacht">
                    Bavaria
                    <div class="boat-wave"></div>
                </div>
                <div class="boat-on-water" style="top: 400px; left: 70%;" data-boat="Motorboot">
                    Quicksilver
                    <div class="boat-wave"></div>
                </div>
                <div class="boat-on-water" style="top: 280px; left: 80%;" data-boat="Schlauchboot">
                    Zodiac
                    <div class="boat-wave"></div>
                </div>
            </div>
            
            <div class="text-center mt-3">
                <p style="color: var(--text-light); font-style: italic;">
                    <i class="fas fa-info-circle"></i> Realistische Ansicht des Plauer Sees mit interaktiven Booten
                </p>
            </div>
        </div>

        <!-- Liegeplatz Buchungsformular -->
        <div class="booking-form">
            <h2 class="section-title">Liegeplatz Reservierung</h2>
            <form id="slotReservationForm">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="slotCustomerName"><i class="fas fa-user"></i> Vor- und Nachname</label>
                        <input type="text" id="slotCustomerName" name="customer_name" required placeholder="Max Mustermann">
                    </div>
                    <div class="form-group">
                        <label for="slotCustomerEmail"><i class="fas fa-envelope"></i> E-Mail Adresse</label>
                        <input type="email" id="slotCustomerEmail" name="customer_email" required placeholder="max@mustermann.de">
                    </div>
                    <div class="form-group">
                        <label for="slotCustomerPhone"><i class="fas fa-phone"></i> Telefonnummer</label>
                        <input type="tel" id="slotCustomerPhone" name="customer_phone" required placeholder="+49 123 456789">
                    </div>
                    <div class="form-group">
                        <label for="boatLength"><i class="fas fa-ruler"></i> Bootslänge (in Metern)</label>
                        <input type="number" id="boatLength" name="boat_length" min="4" max="25" step="0.1" required placeholder="z.B. 8.5">
                    </div>
                    <div class="form-group">
                        <label for="slotStartDate"><i class="fas fa-calendar-day"></i> Ankunftsdatum</label>
                        <input type="date" id="slotStartDate" name="start_date" required>
                    </div>
                    <div class="form-group">
                        <label for="slotEndDate"><i class="fas fa-calendar-day"></i> Abreisedatum</label>
                        <input type="date" id="slotEndDate" name="end_date" required>
                    </div>
                    <div class="form-group full-width">
                        <label for="selectedSlot"><i class="fas fa-anchor"></i> Ausgewählter Liegeplatz</label>
                        <input type="text" id="selectedSlot" name="slot_id" readonly placeholder="Klicken Sie auf einen verfügbaren Liegeplatz in der Marina-Ansicht">
                    </div>
                    <div class="form-group full-width">
                        <label for="specialRequests"><i class="fas fa-comments"></i> Besondere Wünsche</label>
                        <textarea id="specialRequests" name="special_requests" rows="3" placeholder="Stromanschluss benötigt, besondere Manövrierhilfen, etc..."></textarea>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check-circle"></i> Liegeplatz jetzt reservieren
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootsverleih Tab -->
    <div class="tab-content" id="boats-tab">
        <!-- Erfolgsmeldung -->
        <div id="successMessage" class="booking-form" style="display: none; background: linear-gradient(135deg, #28a745, #20c997); color: white; text-align: center;">
            <i class="fas fa-check-circle" style="font-size: 4rem; margin-bottom: 1rem;"></i>
            <h2 class="section-title" style="color: white;">Buchung erfolgreich!</h2>
            <div style="font-size: 1.2rem; margin: 1.5rem 0;">
                <p style="margin-bottom: 0.5rem;"><strong>Reservierungsnummer:</strong> <span id="confirmedReservation"></span></p>
                <p style="margin-bottom: 0.5rem;"><strong>Boot:</strong> <span id="confirmedBoat"></span></p>
                <p style="margin-bottom: 0.5rem;"><strong>Name:</strong> <span id="confirmedName"></span></p>
                <p style="margin-bottom: 0.5rem;"><strong>Zeitraum:</strong> <span id="confirmedDates"></span></p>
                <p style="margin-bottom: 0.5rem;"><strong>Gesamtpreis:</strong> €<span id="confirmedTotal"></span></p>
            </div>
            <p style="font-size: 1.1rem; margin: 1.5rem 0;">Eine Bestätigungsmail wurde an Ihre E-Mail-Adresse gesendet.</p>
            <button class="btn btn-primary" onclick="location.reload()" style="background: white; color: #28a745;">
                <i class="fas fa-plus"></i> Neue Buchung
            </button>
        </div>

        <!-- Boots Buchungsformular -->
        <div class="booking-form">
            <h2 class="section-title">Boot Reservierung</h2>
            <form id="boatReservationForm">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="boatCustomerName"><i class="fas fa-user"></i> Vor- und Nachname</label>
                        <input type="text" id="boatCustomerName" name="customer_name" required placeholder="Max Mustermann">
                    </div>
                    <div class="form-group">
                        <label for="boatCustomerEmail"><i class="fas fa-envelope"></i> E-Mail Adresse</label>
                        <input type="email" id="boatCustomerEmail" name="customer_email" required placeholder="max@mustermann.de">
                    </div>
                    <div class="form-group">
                        <label for="boatCustomerPhone"><i class="fas fa-phone"></i> Telefonnummer</label>
                        <input type="tel" id="boatCustomerPhone" name="customer_phone" required placeholder="+49 123 456789">
                    </div>
                    <div class="form-group">
                        <label for="boatExperience"><i class="fas fa-ship"></i> Segel-/Bootserfahrung</label>
                        <select id="boatExperience" name="experience" required>
                            <option value="">Bitte auswählen</option>
                            <option value="beginner">Anfänger</option>
                            <option value="intermediate">Erfahren</option>
                            <option value="expert">Experte</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="boatStartDate"><i class="fas fa-calendar-day"></i> Abholdatum</label>
                        <input type="date" id="boatStartDate" name="start_date" required>
                    </div>
                    <div class="form-group">
                        <label for="boatEndDate"><i class="fas fa-calendar-day"></i> Rückgabedatum</label>
                        <input type="date" id="boatEndDate" name="end_date" required>
                    </div>
                    <div class="form-group full-width">
                        <label for="selectedBoat"><i class="fas fa-ship"></i> Gewünschtes Boot auswählen</label>
                        <select id="selectedBoat" name="boat_id" required>
                            <option value="">Bitte ein Boot auswählen...</option>
                            <?php foreach ($boats as $boat): ?>
                                <option value="<?= $boat['id'] ?>" data-price="<?= $boat['price_per_day'] ?>">
                                    <?= esc($boat['name']) ?> (<?= esc($boat['boat_type']) ?> - €<?= number_format($boat['price_per_day'], 0) ?>/Tag)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group full-width">
                        <label for="boatRequests"><i class="fas fa-tools"></i> Zusätzliche Ausrüstung</label>
                        <textarea id="boatRequests" name="additional_equipment" rows="3" placeholder="z.B. Sonnendach, Grill, Wasserski, zusätzliche Schwimmwesten..."></textarea>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-ship"></i> Boot jetzt reservieren
                    </button>
                </div>
            </form>
        </div>

        <!-- Boote Übersicht -->
        <div class="marina-section">
            <h2 class="section-title">Unsere Bootsflotte</h2>
            <p class="text-center mb-2" style="color: var(--text-light);">Wählen Sie aus unserer modernen und gut ausgestatteten Flotte</p>
            <div class="boats-grid" id="boatsGrid">
                <!-- Boot Cards werden hier dynamisch generiert -->
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
                <p><i class="fas fa-phone"></i> +49 38735 12345</p>
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
                <p><a href="#"><i class="fas fa-file-contract"></i> AGB</a></p>
                <p><a href="#"><i class="fas fa-shield-alt"></i> Datenschutz</a></p>
                <p><a href="#"><i class="fas fa-building"></i> Impressum</a></p>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; 2023 Yachthafen Plau am See. Alle Rechte vorbehalten.</p>
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

    // Liegeplatz Auswahl in der Marina
    let selectedSlot = null;
    
    document.querySelectorAll('.slot:not(.occupied)').forEach(slot => {
        slot.addEventListener('click', function() {
            const slotId = this.getAttribute('data-slot-id'); // Echte DB-ID
            const slotNumber = this.getAttribute('data-slot'); // Anzeigename (A1, B2, etc.)
            
            // Vorherige Auswahl entfernen
            if (selectedSlot) {
                selectedSlot.classList.remove('selected');
            }
            
            // Neue Auswahl setzen
            this.classList.add('selected');
            selectedSlot = this;
            document.getElementById('selectedSlot').value = slotNumber; // Anzeige für User
            document.getElementById('selectedSlot').setAttribute('data-id', slotId); // Echte ID für API
            
            // Zum Formular scrollen
            document.getElementById('slotReservationForm').scrollIntoView({ 
                behavior: 'smooth', 
                block: 'start' 
            });
        });
    });

    // Boot Drag & Drop Funktionalität
    document.querySelectorAll('.boat-on-water').forEach(boat => {
        let isDragging = false;
        let offsetX, offsetY;
        
        boat.addEventListener('mousedown', startDrag);
        boat.addEventListener('touchstart', startDragTouch);
        
        function startDrag(e) {
            isDragging = true;
            boat.classList.add('dragging');
            const rect = boat.getBoundingClientRect();
            offsetX = e.clientX - rect.left;
            offsetY = e.clientY - rect.top;
            
            document.addEventListener('mousemove', drag);
            document.addEventListener('mouseup', stopDrag);
            e.preventDefault();
        }
        
        function startDragTouch(e) {
            isDragging = true;
            boat.classList.add('dragging');
            const touch = e.touches[0];
            const rect = boat.getBoundingClientRect();
            offsetX = touch.clientX - rect.left;
            offsetY = touch.clientY - rect.top;
            
            document.addEventListener('touchmove', dragTouch);
            document.addEventListener('touchend', stopDrag);
            e.preventDefault();
        }
        
        function drag(e) {
            if (!isDragging) return;
            const marina = document.getElementById('marinaView');
            const marinaRect = marina.getBoundingClientRect();
            
            let x = e.clientX - marinaRect.left - offsetX;
            let y = e.clientY - marinaRect.top - offsetY;
            
            // Begrenzungen (innerhalb des See-Bildes)
            x = Math.max(10, Math.min(x, marinaRect.width - boat.offsetWidth - 10));
            y = Math.max(10, Math.min(y, marinaRect.height - boat.offsetHeight - 10));
            
            boat.style.left = x + 'px';
            boat.style.top = y + 'px';
        }
        
        function dragTouch(e) {
            if (!isDragging) return;
            const touch = e.touches[0];
            const marina = document.getElementById('marinaView');
            const marinaRect = marina.getBoundingClientRect();
            
            let x = touch.clientX - marinaRect.left - offsetX;
            let y = touch.clientY - marinaRect.top - offsetY;
            
            x = Math.max(10, Math.min(x, marinaRect.width - boat.offsetWidth - 10));
            y = Math.max(10, Math.min(y, marinaRect.height - boat.offsetHeight - 10));
            
            boat.style.left = x + 'px';
            boat.style.top = y + 'px';
        }
        
        function stopDrag() {
            isDragging = false;
            boat.classList.remove('dragging');
            document.removeEventListener('mousemove', drag);
            document.removeEventListener('touchmove', dragTouch);
            document.removeEventListener('mouseup', stopDrag);
            document.removeEventListener('touchend', stopDrag);
        }
    });

    // Formular Absenden
    document.getElementById('slotReservationForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const slotInput = document.getElementById('selectedSlot');
        const slotId = slotInput.getAttribute('data-id'); // Echte DB-ID
        
        if (!slotId) {
            alert('Bitte wählen Sie zuerst einen Liegeplatz aus der Marina-Ansicht aus.');
            return;
        }
        
        // Formular-Daten sammeln
        const formData = {
            item_id: parseInt(slotId), // Echte DB-ID als Integer
            customer_name: document.getElementById('slotCustomerName').value,
            customer_email: document.getElementById('slotCustomerEmail').value,
            customer_phone: document.getElementById('slotCustomerPhone').value,
            start_date: document.getElementById('slotStartDate').value,
            end_date: document.getElementById('slotEndDate').value,
            payment_method: 'paypal'
        };

        // Ladeanzeige
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalBtnText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Reservierung wird erstellt...';
        
        // API-Aufruf
        fetch('/booking/makeSlotReservation', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Zur Payment-Seite weiterleiten
                window.location.href = data.redirect_url;
            } else {
                alert('Fehler: ' + (data.message || 'Reservierung konnte nicht erstellt werden'));
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnText;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Fehler bei der Reservierung. Bitte versuchen Sie es erneut.');
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalBtnText;
        });
    });

    document.getElementById('boatReservationForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const boatSelect = document.getElementById('selectedBoat');
        if (!boatSelect.value) {
            alert('Bitte wählen Sie zuerst ein Boot aus.');
            return;
        }
        
        // Formular-Daten sammeln
        const formData = {
            item_id: parseInt(boatSelect.value),
            customer_name: document.getElementById('boatCustomerName').value,
            customer_email: document.getElementById('boatCustomerEmail').value,
            customer_phone: document.getElementById('boatCustomerPhone').value,
            start_date: document.getElementById('boatStartDate').value,
            end_date: document.getElementById('boatEndDate').value,
            experience_level: document.getElementById('boatExperience').value,
            additional_equipment: document.getElementById('boatRequests').value,
            payment_method: 'paypal'
        };

        // Ladeanzeige
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalBtnText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Reservierung wird erstellt...';
        
        // API-Aufruf
        fetch('/booking/makeBoatReservation', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Zur Payment-Seite weiterleiten
                window.location.href = data.redirect_url;
            } else {
                alert('Fehler: ' + (data.message || 'Reservierung konnte nicht erstellt werden'));
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnText;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Fehler bei der Reservierung. Bitte versuchen Sie es erneut.');
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalBtnText;
        });
    });

    // Datumseingaben vorbelegen
    const today = new Date();
    const tomorrow = new Date(today);
    tomorrow.setDate(tomorrow.getDate() + 1);
    
    const formatDate = (date) => date.toISOString().split('T')[0];
    
    // Heutiges Datum setzen
    document.querySelectorAll('input[type="date"]').forEach(input => {
        input.value = formatDate(today);
        input.min = formatDate(today);
    });
    
    // Enddatum für Liegeplätze auf morgen setzen
    document.getElementById('slotEndDate').value = formatDate(tomorrow);
    
    // Datum-Validierung
    document.querySelectorAll('input[type="date"]').forEach(input => {
        input.addEventListener('change', function() {
            const startDate = document.getElementById(this.id.includes('Start') ? this.id : this.id.replace('End', 'Start'));
            const endDate = document.getElementById(this.id.includes('End') ? this.id : this.id.replace('Start', 'End'));
            
            if (startDate && endDate) {
                if (new Date(endDate.value) <= new Date(startDate.value)) {
                    const nextDay = new Date(startDate.value);
                    nextDay.setDate(nextDay.getDate() + 1);
                    endDate.value = formatDate(nextDay);
                }
            }
        });
    });

    // Smooth Scroll für Anchor Links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            if (targetId === '#boats') {
                // Zum Boots-Tab wechseln
                document.querySelectorAll('.nav-tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
                document.querySelector('.nav-tab[data-tab="boats"]').classList.add('active');
                document.getElementById('boats-tab').classList.add('active');
                
                // Zum Tab-Inhalt scrollen
                document.getElementById('boats-tab').scrollIntoView({ 
                    behavior: 'smooth', 
                    block: 'start' 
                });
            } else {
                const target = document.querySelector(targetId);
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
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
            features: ['2 Kabinen', 'Vollküche', 'WC mit Dusche', 'GPS', 'Autopilot'],
            image: 'https://res.cloudinary.com/dk-wassersport/image/upload/v1740666784/yacht/yacht_20250219_202505_new-img_75_4_img-Z6Q0P0Qy.jpg'
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
            features: ['3 Kabinen', 'Kombüse', 'Elektrowinde', 'Badeplattform', 'Sonnenliege'],
            image: 'https://res.cloudinary.com/dk-wassersport/image/upload/v1687436145/yacht/hanse-388-segeln-lavagna-2018-mst-7553_ef16a87fb0075501318c20c50a281a6a.jpg'
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
            features: ['Großraum', 'Kühlschrank', 'Heizung', 'Badeleiter', 'Stereoanlage'],
            image: 'https://www.pitter-yachting.com/images/yacht/sun-odyssey-349/23971630-nala/23971630-main.jpg'
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
            features: ['115 PS', 'Sonnendeck', 'Badeplattform', 'Kühlbox', 'USB-Anschluss'],
            image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTlymDneY3tolTqia68b61rdHnxxw9NZzakxQ&s'
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
            features: ['Mercury 150 PS', 'Ski-Torpedo', 'Badeleiter', 'Sportlenkung', 'Bluetooth'],
            image: 'https://www.bootscenter-keser.de/wp-content/uploads/2024/03/Bayliner-VR6-Cuddy-7.webp'
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
            features: ['20 PS Motor', 'Leicht & wendig', 'Einfache Bedienung', 'Schnell abpumpbar'],
            image: 'https://www.marinawassersport.de/cdn/shop/files/2015_Zodiac_310Alu_01_6edc392e-22e9-469e-a766-9d8670794f46.jpg?v=1740217353&width=1445'
        }
    ];

    // Boots-Karten dynamisch generieren
    const boatsGrid = document.getElementById('boatsGrid');
    boatsData.forEach(boat => {
        const boatCard = document.createElement('div');
        boatCard.className = 'boat-card';
        boatCard.setAttribute('data-boat-id', boat.id);

        boatCard.innerHTML = `
            <div class="boat-image" style="background-image: url('${boat.image}');">
                <div class="boat-category">
                    ${boat.category === 'premium' ? '⭐ Premium' : boat.category === 'comfort' ? '✨ Komfort' : boat.category === 'standard' ? '✓ Standard' : '💫 Economy'}
                </div>
            </div>
            <div class="boat-content">
                <div class="boat-header">
                    <div>
                        <div class="boat-name">${boat.name}</div>
                        <div class="boat-type">${boat.type} • ${boat.year}</div>
                    </div>
                    <div class="boat-price">€${boat.price_per_day}<span>/Tag</span></div>
                </div>
                <div class="boat-details">
                    <div class="detail-item">
                        <i class="fas fa-ruler"></i>
                        <span>${boat.length}m</span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-users"></i>
                        <span>${boat.capacity} Pers.</span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-tag"></i>
                        <span>${boat.category.charAt(0).toUpperCase() + boat.category.slice(1)}</span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-calendar"></i>
                        <span>${boat.year}</span>
                    </div>
                </div>
                <div class="boat-features">
                    ${boat.features.map(feature => `<span class="feature-tag">${feature}</span>`).join('')}
                </div>
                <button class="btn btn-primary select-boat-btn" data-boat-id="${boat.id}" style="width: 100%; margin-top: 1rem;">
                    <i class="fas fa-check"></i> Boot auswählen
                </button>
            </div>
        `;

        boatsGrid.appendChild(boatCard);
    });

    // Event Listener für Bootsauswahl-Buttons
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('select-boat-btn') || e.target.closest('.select-boat-btn')) {
            const btn = e.target.classList.contains('select-boat-btn') ? e.target : e.target.closest('.select-boat-btn');
            const boatId = btn.getAttribute('data-boat-id');
            
            // Zum Boots-Tab wechseln
            document.querySelectorAll('.nav-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
            document.querySelector('.nav-tab[data-tab="boats"]').classList.add('active');
            document.getElementById('boats-tab').classList.add('active');
            
            // Boot im Formular auswählen
            document.getElementById('selectedBoat').value = boatId;
            
            // Zum Formular scrollen
            document.getElementById('boatReservationForm').scrollIntoView({ 
                behavior: 'smooth', 
                block: 'start' 
            });
            
            // Visuelles Feedback für Boot-Auswahl
            const boatCard = btn.closest('.boat-card');
            boatCard.style.transform = 'translateY(-5px)';
            boatCard.style.boxShadow = '0 15px 35px rgba(0, 0, 0, 0.1)';
            
            setTimeout(() => {
                boatCard.style.transform = '';
                boatCard.style.boxShadow = '';
            }, 300);
        }
    });

    // Zufällige Boot-Positionen für natürlicheren Look
    function randomizeBoatPositions() {
        const boats = document.querySelectorAll('.boat-on-water');
        const marina = document.getElementById('marinaView');
        const marinaRect = marina.getBoundingClientRect();
        
        boats.forEach((boat, index) => {
            // Nicht die Boote an Liegeplätzen bewegen
            if (boat.getAttribute('data-slot')) return;
            
            const x = 20 + Math.random() * (marinaRect.width - 140);
            const y = 250 + Math.random() * (marinaRect.height - 300);
            
            boat.style.left = x + 'px';
            boat.style.top = y + 'px';
        });
    }

    // Boot-Positionen beim Laden zufällig setzen
    window.addEventListener('load', randomizeBoatPositions);

    // Prüfen ob Buchung erfolgreich war (von Zahlungsseite zurück)
    window.addEventListener('load', function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('success') === 'true') {
            // Zum Boots-Tab wechseln
            document.querySelectorAll('.nav-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
            document.querySelector('.nav-tab[data-tab="boats"]').classList.add('active');
            document.getElementById('boats-tab').classList.add('active');
            
            // Erfolgsmeldung anzeigen
            document.getElementById('successMessage').style.display = 'block';
            document.getElementById('boatReservationForm').parentElement.style.display = 'none';
            document.querySelector('.boats-grid').parentElement.style.display = 'none';
            
            // Daten in Erfolgsmeldung einfügen
            document.getElementById('confirmedReservation').textContent = decodeURIComponent(urlParams.get('reservation') || 'N/A');
            document.getElementById('confirmedBoat').textContent = decodeURIComponent(urlParams.get('boat') || '');
            document.getElementById('confirmedName').textContent = decodeURIComponent(urlParams.get('name') || '');
            document.getElementById('confirmedDates').textContent = `${urlParams.get('start')} bis ${urlParams.get('end')}`;
            document.getElementById('confirmedTotal').textContent = urlParams.get('total') || '0';
            
            // Zum Erfolgsbereich scrollen
            document.getElementById('successMessage').scrollIntoView({ behavior: 'smooth' });
        }
    });
</script>
</body>
</html>