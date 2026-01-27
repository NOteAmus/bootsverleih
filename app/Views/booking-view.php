<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/header.css">
    <link rel="stylesheet" href="/assets/css/marina-style.css">

    <title>Yachthafen Plau am See - Premium Liegeplätze & Bootsverleih</title>
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

<div id="app">
    <div class="container">
        <div class="nav-tabs" id="booking">
            <button class="nav-tab" :class="{ active: activeTab === 'slots' }" @click="activeTab = 'slots'">
                <i class="fas fa-anchor"></i> Liegeplätze & Marina
            </button>
            <button class="nav-tab" :class="{ active: activeTab === 'boats' }" @click="activeTab = 'boats'">
                <i class="fas fa-ship"></i> Bootsverleih
            </button>
        </div>
    </div>

    <div class="container" v-if="activeTab === 'slots'">
        <div class="tab-content active">
            <div class="marina-map-container">
                <h2 class="section-title">Marina Übersicht - Plauer See</h2>
                <p class="text-center mb-2" style="color: var(--text-light); max-width: 800px; margin: 0 auto 2rem;">
                    Ziehen Sie ein Boot aus dem See auf einen freien Liegeplatz, um diesen auszuwählen.
                </p>

                <div class="marina-view" id="marinaView">
                    <div class="dock" style="width: 85%; height: 25px; top: 60px; left: 7.5%;"></div>
                    <div class="dock" style="width: 20px; height: 200px; top: 85px; left: 15%;"></div>
                    <div class="dock" style="width: 20px; height: 250px; top: 85px; left: 30%;"></div>
                    <div class="dock" style="width: 20px; height: 300px; top: 85px; left: 45%;"></div>
                    <div class="dock" style="width: 20px; height: 200px; top: 85px; left: 60%;"></div>

                    <div v-for="slot in slots"
                         :key="slot.id"
                         class="slot"
                         :class="[slot.category.toLowerCase(), { 'occupied': slot.isOccupied, 'drag-over': dragOverId === slot.id, 'selected': selectedSlotId === slot.id }]"
                         :style="getSlotStyle(slot)"
                         @dragover.prevent="onDragOver(slot.id)"
                         @dragleave="dragOverId = null"
                         @drop="onDrop(slot)"
                         @click="selectSlot(slot)">
                        {{ slot.slot_number }}

                        <div v-if="slot.isOccupied" class="boat-in-slot">
                            <i class="fas fa-ship"></i>
                            <small>{{ slot.boatName }}</small>
                        </div>
                    </div>

                    <div v-for="boat in boatsInWater"
                         :key="boat.id"
                         class="boat-on-water draggable-boat"
                         draggable="true"
                         @dragstart="onDragStart($event, boat)"
                         :style="boat.style">
                        {{ boat.name }}
                        <div class="boat-wave"></div>
                    </div>
                </div>
            </div>

            <div class="booking-form" id="slotReservationForm">
                <h2 class="section-title">Liegeplatz Reservierung</h2>
                <form @submit.prevent="submitSlotBooking">
                    <div class="form-grid">
                        <div class="form-group">
                            <label><i class="fas fa-user"></i> Name</label>
                            <input type="text" v-model="formData.name" required placeholder="Max Mustermann">
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-envelope"></i> E-Mail</label>
                            <input type="email" v-model="formData.email" required placeholder="max@mustermann.de">
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-calendar-day"></i> Ankunft</label>
                            <input type="date" v-model="formData.start_date" required>
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-calendar-day"></i> Abreise</label>
                            <input type="date" v-model="formData.end_date" required>
                        </div>
                        <div class="form-group full-width">
                            <label><i class="fas fa-anchor"></i> Ausgewählter Liegeplatz</label>
                            <input type="text" :value="selectedSlotName" readonly placeholder="Ziehen Sie ein Boot auf einen Platz oder klicken Sie einen an">
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary" :disabled="!selectedSlotId">
                            <i class="fas fa-check-circle"></i> Jetzt reservieren
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
                    <div v-for="boat in boats" :key="boat.id" class="boat-card">
                        <div class="boat-image" :style="{ backgroundImage: 'url(' + boat.image_url + ')' }">
                            <div class="boat-category">{{ boat.boat_type }}</div>
                        </div>
                        <div class="boat-content">
                            <div class="boat-header">
                                <div class="boat-name">{{ boat.name }}</div>
                                <div class="boat-price">€{{ boat.price_per_day }}<span>/Tag</span></div>
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
                    <p><i class="fas fa-phone"></i> +49 38735 12345</p>
                    <p><i class="fas fa-envelope"></i> info@yachthafen-plau.de</p>
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
    const INITIAL_SLOTS = <?= json_encode($slots) ?>;
    const INITIAL_BOATS = <?= json_encode($boats) ?>;
</script>

<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script src="/assets/js/marina-app.js"></script>
</body>
</html>