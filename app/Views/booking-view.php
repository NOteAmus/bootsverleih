<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/header.css">
    <link rel="stylesheet" href="/assets/css/marina-style.css">
    <title><?= esc($title ?? 'Yachthafen Plau am See - Premium Liegeplätze & Bootsverleih') ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', 'Helvetica Neue', Arial, sans-serif;
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
            --grid-color: rgba(255, 255, 255, 0.1);
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

        /* Marina View mit Raster */
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
            height: 700px;
            border-radius: var(--border-radius);
            overflow: hidden;
            position: relative;
            background:
                    linear-gradient(0deg, rgba(26, 82, 118, 0.2), rgba(26, 82, 118, 0.2)),
                    url('https://media.istockphoto.com/id/959508862/de/foto/blaues-meer-f%C3%BCr-hintergrund.jpg?s=612x612&w=0&k=20&c=2nDBrTHMDsfWpsb4x7zCUzOjiDrvPAhk8u-kENTclks=');
            background-size: cover;
            background-position: center;
            border: 3px solid var(--primary);
        }

        /* Raster-Gitter über den See */
        .water-grid {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image:
                    linear-gradient(var(--grid-color) 1px, transparent 1px),
                    linear-gradient(90deg, var(--grid-color) 1px, transparent 1px);
            background-size: 50px 50px;
            z-index: 1;
            pointer-events: none;
        }

        /* Dock- und Steg-Bereiche */
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
            padding: 8px 20px;
            border-radius: 25px;
            border: 2px solid var(--secondary);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        /* Raster-Slots (NEU für das Raster-System) */
        .grid-slot {
            position: absolute;
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.85rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            z-index: 3;
            border: 2px solid rgba(255, 255, 255, 0.6);
            min-width: 80px;
            min-height: 40px;
            backdrop-filter: blur(2px);
            text-align: center;
            padding: 5px;
            user-select: none;
        }

        .grid-slot:hover:not(.occupied):not(.booked) {
            transform: scale(1.08);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.5);
            z-index: 10;
            border-color: var(--white);
        }

        .grid-slot.selected {
            border-color: var(--white);
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.7), 0 8px 25px rgba(0, 0, 0, 0.6);
            animation: pulse 2s infinite;
            transform: scale(1.05);
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.7), 0 8px 25px rgba(0, 0, 0, 0.6); }
            70% { box-shadow: 0 0 0 12px rgba(255, 255, 255, 0), 0 8px 25px rgba(0, 0, 0, 0.6); }
            100% { box-shadow: 0 0 0 0 rgba(255, 255, 255, 0), 0 8px 25px rgba(0, 0, 0, 0.6); }
        }

        /* Slot-Zustände für Raster-System */
        .grid-slot.available {
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.85) 0%, rgba(52, 152, 219, 0.85) 100%);
            border-color: var(--success);
        }

        .grid-slot.booked {
            background: linear-gradient(135deg, rgba(212, 172, 13, 0.9) 0%, rgba(241, 196, 15, 0.9) 100%);
            border-color: var(--secondary);
            animation: booked-pulse 1.5s infinite alternate;
        }

        @keyframes booked-pulse {
            from { transform: scale(1); }
            to { transform: scale(1.03); }
        }

        .grid-slot.occupied {
            background: linear-gradient(135deg, rgba(220, 53, 69, 0.9) 0%, rgba(192, 57, 43, 0.9) 100%);
            border-color: var(--danger);
            cursor: not-allowed;
        }

        .grid-slot.drag-over {
            background: linear-gradient(135deg, rgba(23, 162, 184, 0.7) 0%, rgba(91, 192, 222, 0.7) 100%) !important;
            border: 3px dashed var(--white);
            transform: scale(1.1);
            box-shadow: 0 0 20px rgba(23, 162, 184, 0.5);
            z-index: 20;
        }

        /* Slot-Inhalt */
        .slot-content {
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 3px;
        }

        .slot-number {
            font-size: 1.1rem;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .slot-status {
            font-size: 0.7rem;
            opacity: 0.9;
            padding: 2px 6px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.2);
        }

        /* Boote auf dem See */
        .boat-on-water {
            position: absolute;
            width: 100px;
            height: 40px;
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            border-radius: 8px;
            cursor: move;
            z-index: 4;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.8rem;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
            transition: var(--transition);
            border: 2px solid rgba(255, 255, 255, 0.4);
            user-select: none;
            overflow: hidden;
        }

        .boat-on-water::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            width: 12px;
            height: 12px;
            background: #e74c3c;
            border-radius: 50%;
            box-shadow: 0 0 8px rgba(231, 76, 60, 0.7);
        }

        .boat-on-water::after {
            content: '';
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            width: 8px;
            height: 20px;
            background: #3498db;
            border-radius: 2px;
        }

        .boat-on-water:hover {
            transform: scale(1.1) rotate(1deg);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.6);
            z-index: 100;
            border-color: rgba(255, 255, 255, 0.8);
        }

        .boat-on-water.dragging {
            transform: scale(1.15) rotate(2deg);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.8);
            z-index: 200;
            opacity: 0.9;
            border-color: var(--secondary);
        }

        .boat-name {
            font-size: 0.75rem;
            font-weight: 700;
            margin-bottom: 2px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        .boat-size {
            font-size: 0.65rem;
            opacity: 0.9;
        }

        /* Wellen-Effekt */
        .boat-wave {
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            border-radius: 50%;
            animation: wave 2s infinite linear;
        }

        @keyframes wave {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        /* Kontroll-Buttons */
        .controls {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin: 2rem 0;
            flex-wrap: wrap;
        }

        .control-btn {
            padding: 0.8rem 1.5rem;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
        }

        .control-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .control-btn.reset {
            background: var(--danger);
        }

        .control-btn.reset:hover {
            background: #c82333;
        }

        /* Status Info */
        .booking-status {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: var(--white);
            padding: 1rem 1.5rem;
            border-radius: var(--border-radius);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            border-left: 4px solid var(--secondary);
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
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

        .available-color { background: var(--success); }
        .booked-color { background: var(--secondary); }
        .occupied-color { background: var(--danger); }
        .premium-color { background: var(--secondary); }
        .comfort-color { background: var(--accent); }
        .standard-color { background: var(--primary-light); }
        .economy-color { background: #95a5a6; }

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
            .marina-view { height: 600px; }
            .grid-slot { min-width: 70px; min-height: 35px; font-size: 0.8rem; }
        }

        @media (max-width: 992px) {
            .hero h1 { font-size: 2.8rem; }
            .hero .slogan { font-size: 1.5rem; }
            .form-grid { grid-template-columns: 1fr; }
            .nav-tabs { flex-direction: column; }
            .marina-view { height: 500px; }
        }

        @media (max-width: 768px) {
            .hero { padding: 6rem 0; }
            .hero h1 { font-size: 2.2rem; }
            .hero .slogan { font-size: 1.3rem; }
            .section-title { font-size: 1.8rem; }
            .marina-section, .booking-form { padding: 2rem; }
            .marina-view { height: 400px; }
            .grid-slot { min-width: 60px; min-height: 30px; font-size: 0.7rem; }
            .boat-on-water { width: 80px; height: 35px; font-size: 0.7rem; }
            .controls { flex-direction: column; align-items: center; }
            .control-btn { width: 80%; }
            .boats-grid { grid-template-columns: 1fr; }
            .status-legend { gap: 1rem; }
            .status-item { padding: 0.6rem 1rem; }
        }

        /* Utility Classes */
        .text-center { text-align: center; }
        .mb-2 { margin-bottom: 2rem; }
        .mt-3 { margin-top: 3rem; }
        .hidden { display: none; }
    </style>
</head>
<body>
<?= view('header', ['weather' => $weather ?? null]) ?>

<section class="hero">
    <div class="container">
        <div class="hero-content">
            <h1><?= esc($marina_info['name'] ?? 'Yachthafen Plau am See') ?></h1>
            <div class="slogan"><?= esc($marina_info['slogan'] ?? 'Premium Liegeplatzverwaltung & Bootsverleih') ?></div>
            <p class="subtitle"><?= esc($marina_info['description'] ?? 'Ziehen Sie Boote auf das Raster, um Plätze zu buchen. Einfach und visuell!') ?></p>
        </div>
    </div>
</section>

<div id="app">
    <div class="container">
        <div class="nav-tabs" id="booking">
            <button class="nav-tab" :class="{ active: activeTab === 'slots' }" @click="activeTab = 'slots'">
                <i class="fas fa-anchor"></i> Raster-Buchung
            </button>
            <button class="nav-tab" :class="{ active: activeTab === 'boats' }" @click="activeTab = 'boats'">
                <i class="fas fa-ship"></i> Bootsverleih
            </button>
        </div>
    </div>

    <div class="container" v-if="activeTab === 'slots'">
        <div class="tab-content active">
            <div class="marina-map-container">
                <h2 class="section-title">Interaktives Liegeplatz-Raster</h2>
                <p class="text-center mb-2" style="color: var(--text-light); max-width: 800px; margin: 0 auto 2rem;">
                    Ziehen Sie ein Boot aus dem See auf einen <strong>grünen</strong> Raster-Platz.
                    Gebuchte Plätze werden <strong>golden</strong>, belegte <strong>rot</strong> angezeigt.
                </p>

                <div class="controls">
                    <button class="control-btn" @click="resetAllBookings">
                        <i class="fas fa-redo"></i> Alle Buchungen zurücksetzen
                    </button>
                    <button class="control-btn" @click="simulateRandomBooking">
                        <i class="fas fa-random"></i> Zufällige Buchung simulieren
                    </button>
                    <button class="control-btn reset" @click="resetDrag">
                        <i class="fas fa-times"></i> Zurücksetzen (Boote im See)
                    </button>
                </div>

                <div class="marina-view" id="marinaView">
                    <!-- Raster-Gitter -->
                    <div class="water-grid"></div>

                    <!-- Dock-Bereich -->
                    <div class="dock" style="width: 85%; height: 25px; top: 60px; left: 7.5%;">
                        <div class="dock-label" style="top: -45px; left: 50%; transform: translateX(-50%);">
                            Hauptsteg
                        </div>
                    </div>

                    <!-- Raster-Slots (NEUES System) -->
                    <div v-for="slot in gridSlots"
                         :key="slot.id"
                         class="grid-slot"
                         :class="[slot.status, { 'selected': selectedSlotId === slot.id, 'drag-over': dragOverId === slot.id }]"
                         :style="getGridSlotStyle(slot)"
                         @dragover.prevent="onDragOver(slot.id)"
                         @dragleave="dragOverId = null"
                         @drop="onDrop(slot)"
                         @click="selectSlot(slot)">

                        <div class="slot-content">
                            <div class="slot-number">#{{ slot.slot_number || slot.id }}</div>
                            <div class="slot-status">
                                <template v-if="slot.status === 'available'">Frei</template>
                                <template v-else-if="slot.status === 'booked'">Gebucht</template>
                                <template v-else-if="slot.status === 'occupied'">Belegt</template>
                            </div>
                            <small v-if="slot.boatName">{{ slot.boatName }}</small>
                        </div>
                    </div>

                    <!-- Boote im See -->
                    <div v-for="boat in boatsInWater"
                         :key="'boat-' + boat.id"
                         class="boat-on-water draggable-boat"
                         draggable="true"
                         @dragstart="onDragStart($event, boat)"
                         @dragend="onDragEnd"
                         :style="getBoatStyle(boat)">
                        <div class="boat-name">{{ boat.name }}</div>
                        <div class="boat-size">{{ boat.length }}m</div>
                        <div class="boat-wave"></div>
                    </div>

                    <!-- Info Box für gezogenes Boot -->
                    <div v-if="draggedBoat" class="booking-status">
                        <i class="fas fa-ship" style="color: var(--secondary); margin-right: 8px;"></i>
                        Ziehen Sie <strong>{{ draggedBoat.name }}</strong> auf einen freien Platz
                    </div>
                </div>
            </div>

            <!-- Buchungsformular -->
            <div class="booking-form" id="slotReservationForm">
                <h2 class="section-title">Liegeplatz Reservierung</h2>
                <form @submit.prevent="submitBooking">
                    <div class="form-grid">
                        <div class="form-group">
                            <label><i class="fas fa-anchor"></i> Ausgewählter Platz</label>
                            <input type="text" :value="selectedSlotInfo" readonly placeholder="Kein Platz ausgewählt">
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-ship"></i> Ausgewähltes Boot</label>
                            <input type="text" :value="selectedBoatInfo" readonly placeholder="Kein Boot ausgewählt">
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-user"></i> Name</label>
                            <input type="text" v-model="formData.name" required placeholder="Max Mustermann">
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-envelope"></i> E-Mail</label>
                            <input type="email" v-model="formData.email" required placeholder="max@mustermann.de">
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-calendar-day"></i> Von</label>
                            <input type="date" v-model="formData.start_date" required>
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-calendar-day"></i> Bis</label>
                            <input type="date" v-model="formData.end_date" required>
                        </div>
                        <div class="form-group full-width">
                            <label><i class="fas fa-comment"></i> Bemerkungen</label>
                            <textarea v-model="formData.notes" rows="3" placeholder="Besondere Wünsche oder Anforderungen..."></textarea>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary" :disabled="!canSubmitBooking">
                            <i class="fas fa-check-circle"></i>
                            {{ selectedSlotId ? 'Platz buchen' : 'Zuerst Platz auswählen' }}
                        </button>
                        <button type="button" class="btn" style="margin-left: 1rem;" @click="showAllBookings">
                            <i class="fas fa-list"></i> Alle Buchungen anzeigen
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container" v-if="activeTab === 'boats'">
        <div class="tab-content active">
            <div class="marina-section">
                <h2 class="section-title">Unsere Bootsflotte</h2>
                <div class="boats-grid">
                    <div v-for="boat in boatsList" :key="boat.id" class="boat-card">
                        <div class="boat-image" :style="{ backgroundImage: 'url(' + boat.image_url + ')' }">
                            <div class="boat-category">{{ boat.boat_type || 'Boot' }}</div>
                        </div>
                        <div class="boat-content">
                            <div class="boat-header">
                                <div class="boat-name">{{ boat.name }}</div>
                                <div class="boat-price">€{{ boat.price_per_day }}<span>/Tag</span></div>
                            </div>
                            <div class="boat-details">
                                <div class="detail-item">
                                    <i class="fas fa-ruler"></i>
                                    <span>{{ boat.length || '0' }}m Länge</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-tag"></i>
                                    <span>{{ boat.category || 'Standard' }}</span>
                                </div>
                            </div>
                            <button class="btn btn-primary" style="width: 100%" @click="selectBoatForRental(boat)">
                                Dieses Boot wählen
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer" id="contact">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Kontakt</h3>
                    <p><i class="fas fa-phone"></i> <?= esc($marina_info['contact']['phone'] ?? '+49 38735 12345') ?></p>
                    <p><i class="fas fa-envelope"></i> <?= esc($marina_info['contact']['email'] ?? 'info@yachthafen-plau.de') ?></p>
                </div>
                <div class="footer-section">
                    <h3>Öffnungszeiten</h3>
                    <p>Mo-Fr: 8:00-18:00</p>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2026 Yachthafen Plau am See. Alle Rechte vorbehalten.</p>
            </div>
        </div>
    </footer>
</div>

<script>
    // Daten von PHP an JS übergeben
    const APP_DATA = {
        slots: <?= json_encode($slots ?? []) ?>,
        boats: <?= json_encode($boats ?? []) ?>,
        boats_list: <?= json_encode($boats_list ?? []) ?>,
        marina_info: <?= json_encode($marina_info ?? []) ?>
    };

    // Legacy-Variablen für Kompatibilität
    const INITIAL_SLOTS = <?= json_encode($slots ?? []) ?>;
    const INITIAL_BOATS = <?= json_encode($boats ?? []) ?>;
</script>

<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script>
    const { createApp } = Vue;

    createApp({
        data() {
            return {
                activeTab: 'slots',

                // Neue Datenstruktur für Raster-System
                gridSlots: APP_DATA.slots || [],
                boatsInWater: APP_DATA.boats || [],
                boatsList: APP_DATA.boats_list || [],

                // Zustände
                draggedBoat: null,
                dragOverId: null,
                selectedSlotId: null,
                selectedBoatId: null,

                // Formular
                formData: {
                    name: '',
                    email: '',
                    start_date: '',
                    end_date: '',
                    notes: '',
                    customer_phone: '',
                    payment_method: 'paypal'
                }
            }
        },

        computed: {
            selectedSlotInfo() {
                if (!this.selectedSlotId) return 'Kein Platz ausgewählt';
                const slot = this.gridSlots.find(s => s.id === this.selectedSlotId);
                if (!slot) return 'Platz nicht gefunden';

                const statusMap = {
                    'available': 'Frei',
                    'booked': 'Gebucht',
                    'occupied': 'Belegt'
                };

                return `Platz ${slot.slot_number || slot.id} - ${statusMap[slot.status] || 'Unbekannt'}`;
            },

            selectedBoatInfo() {
                if (!this.selectedBoatId) return 'Kein Boot ausgewählt';
                const boat = this.boatsInWater.find(b => b.id === this.selectedBoatId);
                if (!boat) return 'Boot nicht gefunden';

                return `${boat.name} (${boat.length}m, ${boat.type})`;
            },

            canSubmitBooking() {
                return this.selectedSlotId &&
                    this.selectedBoatId &&
                    this.formData.name &&
                    this.formData.email &&
                    this.formData.start_date &&
                    this.formData.end_date;
            }
        },

        methods: {
            // Positionierung im Raster
            getGridSlotStyle(slot) {
                const rowIndex = slot.row ? slot.row.charCodeAt(0) - 65 : 0;
                const colIndex = slot.col ? slot.col - 1 : slot.position ? slot.position - 1 : 0;

                const cellSize = 70;
                const padding = 10;
                const startX = 50;
                const startY = 120;

                const left = startX + (colIndex * (cellSize + padding));
                const top = startY + (rowIndex * (cellSize + padding));

                return {
                    top: `${top}px`,
                    left: `${left}px`,
                    width: `${cellSize}px`,
                    height: `${cellSize}px`
                };
            },

            getBoatStyle(boat) {
                // Falls Boote keine Positionen haben, zufällige Werte generieren
                return {
                    top: `${boat.top || Math.floor(Math.random() * 400 + 200)}px`,
                    left: `${boat.left || Math.floor(Math.random() * 70 + 5)}%`,
                    background: this.getBoatColor(boat.category),
                    width: '100px',
                    height: '40px'
                };
            },

            getBoatColor(category) {
                const colors = {
                    premium: 'linear-gradient(135deg, #2c3e50 0%, #34495e 100%)',
                    comfort: 'linear-gradient(135deg, #3498db 0%, #2980b9 100%)',
                    standard: 'linear-gradient(135deg, #1abc9c 0%, #16a085 100%)',
                    economy: 'linear-gradient(135deg, #95a5a6 0%, #7f8c8d 100%)'
                };
                return colors[category] || colors.standard;
            },

            // Drag & Drop
            onDragStart(event, boat) {
                this.draggedBoat = boat;
                this.selectedBoatId = boat.id;
                event.dataTransfer.setData('text/plain', boat.id);
                event.dataTransfer.effectAllowed = 'move';
                event.target.classList.add('dragging');
            },

            onDragEnd() {
                this.draggedBoat = null;
                document.querySelectorAll('.dragging').forEach(el => el.classList.remove('dragging'));
            },

            onDragOver(slotId) {
                const slot = this.gridSlots.find(s => s.id === slotId);
                if (slot && slot.status === 'available') {
                    this.dragOverId = slotId;
                    return true;
                }
                return false;
            },

            onDrop(slot) {
                if (!this.draggedBoat || slot.status !== 'available') {
                    this.dragOverId = null;
                    return;
                }

                // Client-seitige Aktualisierung
                slot.status = 'booked';
                slot.boatName = this.draggedBoat.name;

                // Slot auswählen
                this.selectedSlotId = slot.id;

                // Boot aus See entfernen (visuell)
                this.boatsInWater = this.boatsInWater.filter(b => b.id !== this.draggedBoat.id);

                this.draggedBoat = null;
                this.dragOverId = null;

                // Feedback an Benutzer
                alert(`Boot "${slot.boatName}" auf Platz ${slot.slot_number || slot.id} gebucht!`);
            },

            // Slot per Klick auswählen
            selectSlot(slot) {
                if (slot.status === 'available') {
                    this.selectedSlotId = slot.id;

                    // Automatisch ein Boot auswählen, falls keins ausgewählt ist
                    if (!this.selectedBoatId && this.boatsInWater.length > 0) {
                        this.selectedBoatId = this.boatsInWater[0].id;
                    }
                }
            },

            // Boot für Verleih auswählen
            selectBoatForRental(boat) {
                this.selectedBoatId = boat.id;
                this.activeTab = 'slots';
                alert(`Boot "${boat.name}" wurde für die Buchung ausgewählt. Bitte ziehen Sie es auf einen freien Platz.`);
            },

            // Buchung an Server senden
            async submitBooking() {
                if (!this.canSubmitBooking) {
                    alert('Bitte füllen Sie alle erforderlichen Felder aus.');
                    return;
                }

                const slot = this.gridSlots.find(s => s.id === this.selectedSlotId);
                const boat = this.boatsInWater.find(b => b.id === this.selectedBoatId);

                if (!slot || !boat) {
                    alert('Fehler: Slot oder Boot nicht gefunden.');
                    return;
                }

                const bookingData = {
                    slot_id: slot.id,
                    boat_id: boat.id,
                    boat_name: boat.name,
                    ...this.formData
                };

                try {
                    const response = await fetch('/booking/bookSlot', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify(bookingData)
                    });

                    const result = await response.json();

                    if (result.success) {
                        alert('Buchung erfolgreich! ' + result.message);
                        // Formular zurücksetzen
                        this.resetForm();
                    } else {
                        alert('Fehler: ' + (result.message || 'Unbekannter Fehler'));
                    }
                } catch (error) {
                    alert('Netzwerkfehler: ' + error.message);
                }
            },

            // Hilfsfunktionen
            resetForm() {
                this.formData = {
                    name: '',
                    email: '',
                    start_date: '',
                    end_date: '',
                    notes: '',
                    customer_phone: '',
                    payment_method: 'paypal'
                };
                this.selectedSlotId = null;
                this.selectedBoatId = null;
            },

            resetDrag() {
                // Wenn keine Boote da sind, Demo-Boote erstellen
                if (this.boatsInWater.length === 0) {
                    this.createDemoBoats();
                } else {
                    // Boote zurück auf zufällige Positionen setzen
                    this.boatsInWater = this.boatsInWater.map(boat => ({
                        ...boat,
                        top: Math.floor(Math.random() * 400 + 200),
                        left: Math.floor(Math.random() * 70 + 5)
                    }));
                }

                this.draggedBoat = null;
                this.dragOverId = null;
                alert('Boote wurden zurück auf den See gesetzt.');
            },

            createDemoBoats() {
                // Demo-Boote erstellen, falls keine vorhanden sind
                this.boatsInWater = [
                    {
                        id: 1,
                        name: 'Seestern',
                        type: 'Segelyacht',
                        category: 'premium',
                        length: 12,
                        top: Math.floor(Math.random() * 400 + 200),
                        left: Math.floor(Math.random() * 70 + 5)
                    },
                    {
                        id: 2,
                        name: 'Windspiel',
                        type: 'Segelboot',
                        category: 'comfort',
                        length: 8,
                        top: Math.floor(Math.random() * 400 + 200),
                        left: Math.floor(Math.random() * 70 + 5)
                    },
                    {
                        id: 3,
                        name: 'Wassermann',
                        type: 'Motorboot',
                        category: 'standard',
                        length: 10,
                        top: Math.floor(Math.random() * 400 + 200),
                        left: Math.floor(Math.random() * 70 + 5)
                    },
                    {
                        id: 4,
                        name: 'Neptun',
                        type: 'Luxusyacht',
                        category: 'premium',
                        length: 15,
                        top: Math.floor(Math.random() * 400 + 200),
                        left: Math.floor(Math.random() * 70 + 5)
                    }
                ];
            },

            async simulateRandomBooking() {
                try {
                    const response = await fetch('/booking/simulateBooking', {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    });
                    const result = await response.json();
                    alert(result.message || 'Zufällige Buchung durchgeführt');
                    // Seite neu laden für Aktualisierung
                    location.reload();
                } catch (error) {
                    alert('Fehler: ' + error.message);
                }
            },

            async resetAllBookings() {
                if (!confirm('Alle Buchungen zurücksetzen? Dies kann nicht rückgängig gemacht werden.')) {
                    return;
                }

                try {
                    const response = await fetch('/booking/resetBookings', {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    });
                    const result = await response.json();
                    alert(result.message);
                    location.reload();
                } catch (error) {
                    alert('Fehler: ' + error.message);
                }
            },

            async showAllBookings() {
                try {
                    const response = await fetch('/booking/getAllBookings', {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    });
                    const result = await response.json();

                    if (result.success && result.bookings.length > 0) {
                        const bookingList = result.bookings.map(b =>
                            `• ${b.reservation_number}: ${b.customer_name} (${b.start_date} - ${b.end_date})`
                        ).join('\n');

                        alert(`Aktuelle Buchungen:\n\n${bookingList}`);
                    } else {
                        alert('Keine Buchungen vorhanden.');
                    }
                } catch (error) {
                    alert('Fehler beim Laden der Buchungen: ' + error.message);
                }
            }
        },

        mounted() {
            // Heutiges Datum setzen
            const today = new Date().toISOString().split('T')[0];
            const tomorrow = new Date(Date.now() + 86400000).toISOString().split('T')[0];

            this.formData.start_date = today;
            this.formData.end_date = tomorrow;

            // Falls keine Boote im Wasser sind, Demo-Boote erstellen
            if (this.boatsInWater.length === 0) {
                this.createDemoBoats();
            }

            // Demo: Einige Plätze als belegt markieren (nur visuell)
            setTimeout(() => {
                const demoSlots = ['A3', 'B5', 'C2'];
                demoSlots.forEach(slotId => {
                    const slot = this.gridSlots.find(s => s.id === slotId || s.slot_number === slotId);
                    if (slot && slot.status === 'available') {
                        slot.status = 'booked';
                        slot.boatName = 'Demo-Boot';
                    }
                });
            }, 1000);
        }
    }).mount('#app');
</script>
</body>
</html>