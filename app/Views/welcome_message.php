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
            padding: 1.2rem 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .logo-icon {
            font-size: 2rem;
            color: var(--accent);
        }
        
        .logo-text h1 {
            font-size: 1.6rem;
            font-weight: 600;
            letter-spacing: -0.5px;
        }
        
        .logo-text p {
            font-size: 0.85rem;
            opacity: 0.8;
            margin-top: 3px;
        }
        
        nav ul {
            display: flex;
            list-style: none;
            gap: 30px;
        }
        
        nav a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            padding: 8px 0;
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
            align-items: center;
            gap: 20px;
            margin-left: 30px;
            padding-left: 30px;
            border-left: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .weather-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
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
        
        .features {
            padding: 80px 0;
            background-color: #f5f7fa;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
        }
        
        .feature-card {
            background-color: white;
            border-radius: 8px;
            padding: 40px 30px;
            text-align: center;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.03);
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }
        
        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 25px;
            height: 80px;
            width: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(10, 46, 92, 0.05);
            border-radius: 50%;
            margin: 0 auto 25px;
        }
        
        .feature-card h3 {
            font-size: 1.4rem;
            margin-bottom: 15px;
            color: var(--dark);
            font-weight: 600;
        }
        
        .feature-card p {
            color: var(--gray);
            line-height: 1.6;
        }
        
        /* Services Section */
        .services {
            padding: 100px 0;
            background-color: white;
        }
        
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
        }
        
        .service-card {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 40px 30px;
            text-align: center;
            transition: all 0.3s ease;
            border-left: 4px solid var(--primary);
        }
        
        .service-card:hover {
            background-color: white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transform: translateY(-5px);
        }
        
        .service-icon {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 20px;
        }
        
        .service-card h3 {
            font-size: 1.4rem;
            margin-bottom: 15px;
            color: var(--dark);
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
        }
        
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 15px;
            }
            
            nav ul {
                flex-wrap: wrap;
                justify-content: center;
                gap: 15px;
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
    <!-- Header mit integriertem Wetter -->
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
                        <i class="fas fa-thermometer-half"></i>
                        <span>22°C</span>
                    </div>
                    <div class="weather-item">
                        <i class="fas fa-wind"></i>
                        <span>12 km/h</span>
                    </div>
                    <div class="weather-item">
                        <i class="fas fa-sun"></i>
                        <span>Sonnig</span>
                    </div>
                </div>
                
                <nav>
                    <ul>
                        <li><a href="#">Startseite</a></li>
                        <li><a href="#booking">Buchen</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#features">Features</a></li>
                        <li><a href="#contact">Kontakt</a></li>
                    </ul>
                </nav>
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
                    <form action="<?=route_to('register') ?>" method="get">
                        <button type="submit" class="btn btn-secondary">
                            <i class="fas fa-user-plus"></i> Konto erstellen
                        </button>
                    </form>
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
                        <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" alt="Tagesliegeplatz">
                        <div class="booking-card-content">
                            <h3>Tagesliegeplatz</h3>
                            <p>Für Boote bis 8m Länge. Inklusive Strom- und Wasseranschluss.</p>
                            <div class="price">€25 <span>/ Tag</span></div>
                            <button class="btn" style="width: 100%;">
                                <i class="fas fa-shopping-cart"></i> Jetzt buchen
                            </button>
                        </div>
                    </div>
                    
                    <div class="booking-card fade-in">
                        <img src="https://images.unsplash.com/photo-1577717903315-1691ae25ab3f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" alt="Wochenliegeplatz">
                        <div class="booking-card-content">
                            <h3>Wochenliegeplatz</h3>
                            <p>Für Boote bis 10m Länge. Inklusive aller Annehmlichkeiten.</p>
                            <div class="price">€150 <span>/ Woche</span></div>
                            <button class="btn" style="width: 100%;">
                                <i class="fas fa-shopping-cart"></i> Jetzt buchen
                            </button>
                        </div>
                    </div>
                    
                    <div class="booking-card fade-in">
                        <img src="https://images.unsplash.com/photo-1506929562872-bb421503ef21?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" alt="Saisonliegeplatz">
                        <div class="booking-card-content">
                            <h3>Saisonliegeplatz</h3>
                            <p>Für die gesamte Saison April-Oktober. Inklusive Winterlager.</p>
                            <div class="price">€1.200 <span>/ Saison</span></div>
                            <button class="btn" style="width: 100%;">
                                <i class="fas fa-shopping-cart"></i> Jetzt buchen
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Boote Tab -->
            <div class="tab-content" id="boats">
                <div class="booking-grid">
                    <div class="booking-card fade-in">
                        <img src="https://images.unsplash.com/photo-1501950183564-3c8ac97d08f0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" alt="Motorboot">
                        <div class="booking-card-content">
                            <h3>Motorboot</h3>
                            <p>Für 6 Personen, 40 PS Motor. Perfekt für Familienausflüge.</p>
                            <div class="price">€90 <span>/ 4 Stunden</span></div>
                            <button class="btn" style="width: 100%;">
                                <i class="fas fa-shopping-cart"></i> Jetzt buchen
                            </button>
                        </div>
                    </div>
                    
                    <div class="booking-card fade-in">
                        <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" alt="Segelboot">
                        <div class="booking-card-content">
                            <h3>Segelboot</h3>
                            <p>Für 4 Personen, 25 Fuß. Erleben Sie pure Segelfreude.</p>
                            <div class="price">€120 <span>/ Tag</span></div>
                            <button class="btn" style="width: 100%;">
                                <i class="fas fa-shopping-cart"></i> Jetzt buchen
                            </button>
                        </div>
                    </div>
                    
                    <div class="booking-card fade-in">
                        <img src="https://images.unsplash.com/photo-1536984700892-1bcf6c7c2e0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" alt="Elektroboot">
                        <div class="booking-card-content">
                            <h3>Elektroboot</h3>
                            <p>Leise und umweltfreundlich. Für 8 Personen, inkl. Picknick-Tisch.</p>
                            <div class="price">€70 <span>/ 3 Stunden</span></div>
                            <button class="btn" style="width: 100%;">
                                <i class="fas fa-shopping-cart"></i> Jetzt buchen
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services" id="services">
        <div class="container">
            <div class="section-title fade-in">
                <h2>Unsere Services</h2>
                <p>Wir bieten umfassende Dienstleistungen für Ihren perfekten Aufenthalt am Wasser</p>
            </div>
            
            <div class="services-grid">
                <div class="service-card fade-in">
                    <div class="service-icon">
                        <i class="fas fa-tools"></i>
                    </div>
                    <h3>Bootsservice & Reparatur</h3>
                    <p>Professionelle Wartung und Reparatur aller Bootstypen durch zertifizierte Techniker.</p>
                </div>
                
                <div class="service-card fade-in">
                    <div class="service-icon">
                        <i class="fas fa-gas-pump"></i>
                    </div>
                    <h3>Tankstelle</h3>
                    <p>Vollservice-Tankstelle mit Diesel, Benzin und Ölen direkt am Hafen.</p>
                </div>
                
                <div class="service-card fade-in">
                    <div class="service-icon">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <h3>Hafenrestaurant</h3>
                    <p>Frisch zubereitete Speisen und Getränke mit Blick auf den See.</p>
                </div>
                
                <div class="service-card fade-in">
                    <div class="service-icon">
                        <i class="fas fa-shower"></i>
                    </div>
                    <h3>Sanitäranlagen</h3>
                    <p>Moderne Sanitär- und Duschräume rund um die Uhr verfügbar.</p>
                </div>
                
                <div class="service-card fade-in">
                    <div class="service-icon">
                        <i class="fas fa-life-ring"></i>
                    </div>
                    <h3>Sicherheitsservice</h3>
                    <p>24/7 Hafensicherheit und Überwachung für Ihre Boote.</p>
                </div>
                
                <div class="service-card fade-in">
                    <div class="service-icon">
                        <i class="fas fa-ship"></i>
                    </div>
                    <h3>Winterlager</h3>
                    <p>Sichere und trockene Überwinterung Ihrer Boote in unserer Halle.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="container">
            <div class="section-title fade-in">
                <h2>Unsere digitalen Features</h2>
                <p>Moderne Technologie für eine nahtlose Erfahrung</p>
            </div>
            
            <div class="features-grid">
                <div class="feature-card fade-in">
                    <div class="feature-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3>Mobile App</h3>
                    <p>Verwalten Sie Ihre Buchungen bequem von unterwegs mit unserer iOS und Android App.</p>
                </div>
                
                <div class="feature-card fade-in">
                    <div class="feature-icon">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <h3>Live-Karte</h3>
                    <p>Echtzeit-Übersicht aller verfügbaren Liegeplätze und Boote auf unserer interaktiven Karte.</p>
                </div>
                
                <div class="feature-card fade-in">
                    <div class="feature-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <h3>Smart Notifications</h3>
                    <p>Automatische Erinnerungen für Ihre Buchungen und wichtige Wetterwarnungen.</p>
                </div>
                
                <div class="feature-card fade-in">
                    <div class="feature-icon">
                        <i class="fas fa-drag"></i>
                    </div>
                    <h3>Drag & Drop</h3>
                    <p>Intuitive Verwaltung Ihrer Liegeplätze durch einfaches Verschieben auf der Karte.</p>
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
                        <i class="fas fa-wind"></i> Detaillierte Wettervorhersage
                    </a>
                </div>
                <div class="weather-info fade-in">
                    <div class="weather-header-large">
                        <div>
                            <h3>Plau am See</h3>
                            <p>Heute, 15. Juni</p>
                        </div>
                        <div class="weather-icon">
                            <i class="fas fa-sun" style="font-size: 2.5rem;"></i>
                        </div>
                    </div>
                    <div class="weather-temp">22°C</div>
                    <p>Sonnig, leichter Wind aus Nordost</p>
                    <div class="weather-details">
                        <div class="weather-detail-item">
                            <i class="fas fa-wind"></i>
                            <div>
                                <p>Wind</p>
                                <p>12 km/h</p>
                            </div>
                        </div>
                        <div class="weather-detail-item">
                            <i class="fas fa-tint"></i>
                            <div>
                                <p>Luftfeuchtigkeit</p>
                                <p>65%</p>
                            </div>
                        </div>
                        <div class="weather-detail-item">
                            <i class="fas fa-water"></i>
                            <div>
                                <p>Wassertemperatur</p>
                                <p>18°C</p>
                            </div>
                        </div>
                        <div class="weather-detail-item">
                            <i class="fas fa-sun"></i>
                            <div>
                                <p>UV-Index</p>
                                <p>5 (Mittel)</p>
                            </div>
                        </div>
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
                        <li><a href="#services">Services</a></li>
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
        // Tab-Funktionalität
        document.addEventListener('DOMContentLoaded', function() {
            const tabBtns = document.querySelectorAll('.tab-btn');
            const tabContents = document.querySelectorAll('.tab-content');
            
            tabBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    // Aktiven Tab entfernen
                    tabBtns.forEach(b => b.classList.remove('active'));
                    tabContents.forEach(c => c.classList.remove('active'));
                    
                    // Neuen aktiven Tab setzen
                    btn.classList.add('active');
                    const tabId = btn.getAttribute('data-tab');
                    document.getElementById(tabId).classList.add('active');
                });
            });
            
            // Einfache Fade-In Animation beim Scrollen
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
            
            // Initial alle Elemente verstecken
            fadeElements.forEach(element => {
                element.style.opacity = "0";
                element.style.transform = "translateY(30px)";
                element.style.transition = "opacity 0.8s ease, transform 0.8s ease";
            });
            
            window.addEventListener('scroll', fadeInOnScroll);
            fadeInOnScroll(); // Einmal beim Laden ausführen
        });
    </script>
</body>
</html>