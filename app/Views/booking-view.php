<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Yachthafen Plau am See - Liegeplätze & Bootsverleih</title>

    <style>
        *{margin:0;padding:0;box-sizing:border-box}

        :root{
            --primary:#1a5276;
            --primary-dark:#0d3c5a;
            --primary-light:#2e86c1;
            --secondary:#d4ac0d;
            --secondary-light:#f4d03f;
            --accent:#17a2b8;
            --white:#fff;
            --light-bg:#f8f9fa;
            --light-gray:#e9ecef;
            --text-dark:#2c3e50;
            --text-light:#6c757d;
            --danger:#dc3545;
            --shadow:rgba(0,0,0,.1);
            --border-radius:12px;
            --transition:all .3s ease;

            /* Marina */
            --main-dock-height:25px;
            --pier-width:20px;
            --pier-height:260px;

            --slot-gap:10px;     /* Abstand Slot ↔ Steg */
            --slot-width:90px;
            --slot-height:34px;

            --slot-top-start:95px;
            --slot-top-step:40px;
        }

        body{
            font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;
            background:var(--light-bg);
            color:var(--text-dark);
            line-height:1.6;
            min-height:100vh;
        }

        .container{max-width:1400px;margin:0 auto;padding:0 20px}

        .btn{
            padding:1rem 2rem;border:none;border-radius:var(--border-radius);
            font-size:1.1rem;font-weight:600;cursor:pointer;transition:var(--transition);
            text-decoration:none;display:inline-flex;align-items:center;gap:.8rem;
        }
        .btn-primary{background:var(--secondary);color:var(--primary-dark)}
        .btn-primary:hover{background:var(--secondary-light);transform:translateY(-3px);box-shadow:0 10px 20px rgba(212,172,13,.2)}

        /* Tabs */
        .nav-tabs{
            background:var(--white);border-radius:var(--border-radius);
            padding:1rem;margin:-3rem auto 4rem;max-width:900px;
            box-shadow:0 10px 30px var(--shadow);
            display:flex;gap:1rem;position:relative;z-index:10;
        }
        .nav-tab{
            flex:1;padding:1.5rem 2rem;text-align:center;background:var(--light-bg);
            border:none;border-radius:10px;font-size:1.1rem;font-weight:600;
            color:var(--text-dark);cursor:pointer;transition:var(--transition);
            display:flex;align-items:center;justify-content:center;gap:1rem;
        }
        .nav-tab.active{background:var(--primary);color:var(--white);box-shadow:0 5px 15px rgba(26,82,118,.2)}
        .nav-tab:hover:not(.active){background:var(--primary-light);color:var(--white)}

        .tab-content{display:none;animation:fadeIn .5s ease-out}
        .tab-content.active{display:block}
        @keyframes fadeIn{from{opacity:0}to{opacity:1}}

        .marina-section{
            background:var(--white);border-radius:var(--border-radius);
            padding:3rem;margin-bottom:3rem;box-shadow:0 10px 30px var(--shadow);
            border:1px solid var(--light-gray);
        }

        .section-title{
            font-size:2.2rem;color:var(--primary);margin-bottom:2rem;text-align:center;
            font-weight:600;position:relative;padding-bottom:1rem;
        }
        .section-title::after{
            content:'';position:absolute;bottom:0;left:50%;transform:translateX(-50%);
            width:80px;height:4px;background:var(--secondary);border-radius:2px;
        }

        /* Marina Container */
        .marina-map-container{
            background:var(--white);border-radius:var(--border-radius);
            padding:2rem;margin-bottom:3rem;box-shadow:0 10px 30px var(--shadow);
            border:1px solid var(--light-gray);overflow:hidden;
        }

        /* Marina View */
        .marina-view{
            width:100%;height:600px;border-radius:var(--border-radius);
            overflow:hidden;position:relative;
            background:url('https://media.istockphoto.com/id/959508862/de/foto/blaues-meer-f%C3%BCr-hintergrund.jpg?s=612x612&w=0&k=20&c=2nDBrTHMDsfWpsb4x7zCUzOjiDrvPAhk8u-kENTclks=');
            background-size:cover;background-position:center;
            border:3px solid var(--primary);
        }
        .marina-view::before{
            content:'';position:absolute;inset:0;
            background:linear-gradient(rgba(255,255,255,.1),rgba(0,0,0,.1));
            z-index:1;
        }

        .dock{
            position:absolute;
            background:linear-gradient(180deg,#8B4513 0%,#654321 100%);
            border-radius:4px;box-shadow:0 4px 15px rgba(0,0,0,.3);
            z-index:2;
        }

        /* Fingersteg (gleich lang) */
        .dock.pier{
            width:var(--pier-width);
            height:var(--pier-height);
            top:calc(60px + var(--main-dock-height));
        }

        /* Stellplatz */
        .slot{
            position:absolute;
            width:var(--slot-width);
            height:var(--slot-height);
            border-radius:8px;
            display:flex;align-items:center;justify-content:center;
            font-weight:800;font-size:.9rem;
            color:#fff;z-index:3;
            user-select:none;
            cursor:pointer;
            transition:var(--transition);
            background:linear-gradient(135deg, rgba(46,134,193,.92), rgba(52,152,219,.92));
            border:2px solid rgba(255,255,255,.65);
            box-shadow:0 4px 10px rgba(0,0,0,.3);
            backdrop-filter: blur(2px);
        }

        /* rechts/links am Fingersteg (wir setzen left = Pier-Position; Offset via transform) */
        .slot.side-right{transform:translateX(calc(var(--pier-width) + var(--slot-gap)))}
        .slot.side-left{transform:translateX(calc(-1 * (var(--slot-width) + var(--slot-gap))))}

        .slot:hover:not(.occupied){transform:scale(1.05) translateX(var(--slot-hover-x, 0px)); z-index:10}
        /* hover-kompatibel mit side-left/right */
        .slot.side-right:hover:not(.occupied){transform:translateX(calc(var(--pier-width) + var(--slot-gap))) scale(1.05)}
        .slot.side-left:hover:not(.occupied){transform:translateX(calc(-1 * (var(--slot-width) + var(--slot-gap)))) scale(1.05)}

        .slot.selected{
            border-color:var(--white);
            box-shadow:0 0 0 3px rgba(255,255,255,.5), 0 5px 20px rgba(0,0,0,.5);
            animation:pulse 2s infinite;
        }
        @keyframes pulse{
            0%{box-shadow:0 0 0 0 rgba(255,255,255,.7)}
            70%{box-shadow:0 0 0 10px rgba(255,255,255,0)}
            100%{box-shadow:0 0 0 0 rgba(255,255,255,0)}
        }

        .slot.occupied{
            background:linear-gradient(135deg, rgba(220,53,69,.92), rgba(192,57,43,.92));
            cursor:not-allowed;
            border-color:rgba(220,53,69,1);
        }

        /* Boot draufgezogen (noch NICHT gebucht) */
        .slot.pending{
            background: linear-gradient(135deg, rgba(212,172,13,.95), rgba(244,208,63,.95));
            border-color: rgba(255,255,255,.85);
            color: #0d3c5a;
        }

        /* Pending + Boot Icon dunkler lesbar */
        .slot.pending .boat-in-slot i{
            color:#0d3c5a;
            opacity: .95;
        }

        /* Drop-Feedback */
        .slot.drop-hover:not(.occupied){
            outline:3px dashed rgba(255,255,255,.9);
            outline-offset:2px;
            z-index:20;
        }

        /* Boot-Palette */
        .boat-palette{
            display:flex;gap:12px;justify-content:center;align-items:center;
            flex-wrap:wrap;margin:16px 0 0;
        }
        .boat-token{
            display:inline-flex;align-items:center;gap:10px;
            padding:10px 14px;border-radius:999px;
            background:rgba(26,82,118,.92);
            border:2px solid rgba(212,172,13,.9);
            color:#fff;cursor:grab;user-select:none;
            box-shadow:0 8px 20px rgba(0,0,0,.15);
        }
        .boat-token:active{cursor:grabbing}
        .boat-token i{font-size:18px;color:#f4d03f}
        .boat-token .label{font-weight:800;font-size:.95rem}

        /* Boot im Slot */
        .slot .boat-in-slot{display:flex;align-items:center;gap:8px}
        .slot .boat-in-slot i{color:#fff;opacity:.95}

        /* Forms */
        .booking-form{
            background:var(--white);border-radius:var(--border-radius);
            padding:3rem;box-shadow:0 10px 30px var(--shadow);
            margin-top:2rem;border:1px solid var(--light-gray);
        }
        .form-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:1.5rem}
        .form-group{margin-bottom:1.5rem}
        .form-group.full-width{grid-column:1 / -1}
        label{display:block;margin-bottom:.5rem;font-weight:600;color:var(--primary);font-size:.95rem}
        input,select,textarea{
            width:100%;padding:.9rem 1.2rem;border:2px solid var(--light-gray);
            border-radius:8px;font-size:1rem;transition:var(--transition);
            background:var(--white);font-family:inherit;
        }
        input:focus,select:focus,textarea:focus{
            outline:none;border-color:var(--primary);
            box-shadow:0 0 0 3px rgba(26,82,118,.1);
        }
        .form-actions{grid-column:1 / -1;text-align:center;margin-top:1rem}

        /* Boats Grid */
        .boats-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(350px,1fr));gap:2rem;margin-top:2rem}
        .boat-card{
            background:var(--white);border-radius:var(--border-radius);
            overflow:hidden;box-shadow:0 8px 20px var(--shadow);
            transition:var(--transition);border:1px solid var(--light-gray);
        }
        .boat-card:hover{transform:translateY(-5px);box-shadow:0 15px 35px rgba(0,0,0,.1)}
        .boat-image{height:200px;background-size:cover;background-position:center;position:relative}
        .boat-category{
            position:absolute;top:15px;right:15px;background:rgba(0,0,0,.7);color:#fff;
            padding:4px 12px;border-radius:20px;font-weight:600;font-size:.9rem;z-index:2;
        }
        .boat-content{padding:1.5rem}
        .boat-header{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:1rem}
        .boat-name{font-size:1.4rem;font-weight:600;color:var(--primary);margin-bottom:.3rem}
        .boat-type{color:var(--text-light);font-size:.9rem}
        .boat-price{font-size:1.8rem;font-weight:700;color:var(--secondary);text-align:right}
        .boat-price span{font-size:.9rem;color:var(--text-light);font-weight:normal}
        .boat-details{display:grid;grid-template-columns:1fr 1fr;gap:.8rem;margin-bottom:1.2rem}
        .detail-item{display:flex;align-items:center;gap:.5rem;color:var(--text-dark);font-size:.9rem}
        .detail-item i{color:var(--primary);width:16px;text-align:center}
        .boat-features{display:flex;flex-wrap:wrap;gap:.5rem;margin-bottom:1.5rem}
        .feature-tag{
            background:var(--light-bg);color:var(--text-dark);
            padding:.3rem .8rem;border-radius:15px;font-size:.8rem;font-weight:500;
            border:1px solid var(--light-gray);
        }

        /* Footer */
        .footer{background:var(--primary-dark);color:var(--white);padding:3rem 0;margin-top:4rem}
        .footer-content{display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:2rem}
        .footer-section h3{color:var(--secondary);margin-bottom:1.2rem;font-size:1.3rem}
        .footer-section p,.footer-section a{
            color:#bdc3c7;text-decoration:none;margin-bottom:.8rem;
            display:flex;align-items:center;gap:.5rem;transition:var(--transition);
        }
        .footer-section a:hover{color:var(--white)}
        .copyright{
            text-align:center;padding-top:2rem;margin-top:2rem;
            border-top:1px solid rgba(255,255,255,.1);color:#95a5a6;font-size:.9rem;
        }

        /* Responsive */
        @media (max-width:1200px){.marina-view{height:500px}}
        @media (max-width:992px){
            .hero h1{font-size:2.8rem}
            .hero .slogan{font-size:1.5rem}
            .form-grid{grid-template-columns:1fr}
            .nav-tabs{flex-direction:column}
        }
        @media (max-width:768px){
            .hero{padding:3rem 0}
            .hero h1{font-size:2.2rem}
            .hero .slogan{font-size:1.3rem}
            .section-title{font-size:1.8rem}
            .marina-section,.booking-form{padding:2rem}
            .boats-grid{grid-template-columns:1fr}
            .marina-view{height:420px}
            :root{--slot-width:78px;--slot-height:30px;--slot-gap:8px}
        }

        /* Utility */
        .text-center{text-align:center}
        .mb-2{margin-bottom:2rem}
        .mt-3{margin-top:3rem}

        #selectedSlotsChips .chip{
            display:inline-flex;
            align-items:center;
            gap:8px;
            padding:6px 10px;
            border-radius:999px;
            background: rgba(26,82,118,.92);
            color:#fff;
            border:2px solid rgba(212,172,13,.9);
            font-weight:800;
            font-size:.9rem;
        }
        /* Chips */
        #selectedSlotsChips{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:10px;}
        #selectedSlotsChips .chip{
            display:inline-flex;
            align-items:center;
            gap:8px;
            padding:6px 10px;
            border-radius:999px;
            background: rgba(26,82,118,.92);
            color:#fff;
            border:2px solid rgba(212,172,13,.9);
            font-weight:800;
            font-size:.9rem;
        }
        #selectedSlotsChips .chip button{
            border:none;
            background:transparent;
            color:#fff;
            cursor:pointer;
            font-size:1rem;
            line-height:1;
            opacity:.9;
        }
        #selectedSlotsChips .chip button:hover{opacity:1}
        .chip-input{
            min-height:48px;
            padding:8px 10px;
            border:2px solid var(--light-gray);
            border-radius:8px;
            display:flex;
            flex-wrap:wrap;
            gap:8px;
            align-items:center;
            cursor:text;
            transition:all .2s ease;
        }

        .chip-input:focus-within{
            border-color:var(--primary);
            box-shadow:0 0 0 3px rgba(26,82,118,.1);
        }

        .chip-input .placeholder{
            color:var(--text-light);
            font-size:.95rem;
        }

        .chip{
            display:inline-flex;
            align-items:center;
            gap:8px;
            padding:6px 10px;
            border-radius:999px;
            background: rgba(26,82,118,.92);
            color:#fff;
            border:2px solid rgba(212,172,13,.9);
            font-weight:800;
            font-size:.85rem;
        }

        .chip button{
            border:none;
            background:transparent;
            color:#fff;
            cursor:pointer;
            font-size:1rem;
            line-height:1;
        }

    </style>
</head>

<body>
<?= view('header', ['weather' => $weather ?? null]) ?>

<div class="container">
    <!-- Liegeplätze -->
    <div class="tab-content active" id="slots-tab">
        <div class="marina-map-container">
            <h2 class="section-title">Marina Übersicht - Plauer See</h2>

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

            <p class="text-center mb-2" style="color: var(--text-light); max-width: 800px; margin: 0 auto 2rem;">
                Klicken Sie auf einen verfügbaren Liegeplatz, um ihn auszuwählen.
                Oder ziehen Sie ein Boot-Symbol auf einen Stellplatz.
            </p>

            <?php
            // 5 Reihen (A–E) gleichmäßig verteilt
            $rowKeys = ['A','B','C','D','E'];
            $rowCount = count($rowKeys);

            $startLeft = 12; // %
            $endLeft   = 82; // %

            $step = ($rowCount > 1) ? (($endLeft - $startLeft) / ($rowCount - 1)) : 0;

            $rows = [];
            foreach ($rowKeys as $i => $rk) {
                $rows[$rk] = ['left' => ($startLeft + $i * $step) . '%'];
            }

            // Slots gruppieren nach Reihe
            $slotsByRow = [];
            foreach ($slots as $slot) {
                $slotsByRow[$slot['row']][] = $slot;
            }

            // Sortierung nach position
            foreach ($slotsByRow as $r => &$list) {
                usort($list, fn($a,$b) => ($a['position'] ?? 0) <=> ($b['position'] ?? 0));
            }
            unset($list);

            // Layout
            $topStart = 95;
            $topIncrement = 40;

            // Demo: occupied (später aus DB)
            $occupiedSlots = ['A2', 'B3', 'C4', 'D2', 'E1'];
            ?>

            <div class="marina-view" id="marinaView">
                <!-- Hauptsteg -->
                <div class="dock" style="width:85%;height:25px;top:60px;left:7.5%;"></div>

                <!-- Fingerstege -->
                <?php foreach ($rows as $rowKey => $cfg): ?>
                    <div class="dock pier" style="left: <?= $cfg['left'] ?>;"></div>
                <?php endforeach; ?>

                <!-- Stellplätze am Fingersteg (abwechselnd links/rechts) -->
                <?php foreach ($slotsByRow as $row => $rowSlots):
                    if (!isset($rows[$row])) continue;
                    $pierLeft = $rows[$row]['left'];

                    foreach ($rowSlots as $slot):
                        $pos = (int)($slot['position'] ?? 1);
                        $topPos = $topStart + ($pos - 1) * $topIncrement;

                        // 1 rechts, 2 links, 3 rechts ...
                        $sideClass = ($pos % 2 === 1) ? 'side-right' : 'side-left';

                        $isOccupied = in_array($slot['slot_number'], $occupiedSlots, true);
                        $occupiedClass = $isOccupied ? ' occupied' : '';
                        ?>
                        <div class="slot <?= $sideClass ?><?= $occupiedClass ?>"
                             style="top: <?= (int)$topPos ?>px; left: <?= $pierLeft ?>;"
                             data-slot-id="<?= (int)$slot['id'] ?>"
                             data-slot="<?= esc($slot['slot_number']) ?>"
                             data-accepts-boat="1">
                            <?= esc($slot['slot_number']) ?>
                        </div>
                    <?php endforeach; endforeach; ?>
            </div>

            <!-- Boot-Token Palette -->
            <div class="boat-palette" aria-label="Boote ziehen">
                <div class="boat-token" draggable="true" data-boat-token="1" title="Drag & Drop auf einen Stellplatz">
                    <i class="fas fa-ship"></i>
                    <span class="label">Boot</span>
                </div>
            </div>

            <div class="text-center mt-3">
                <p style="color: var(--text-light); font-style: italic;">
                    <i class="fas fa-info-circle"></i>
                    Ziehen Sie das Boot-Symbol auf einen Stellplatz (Desktop) – auf Mobile: Boot antippen, dann Stellplatz antippen.
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
                        <label><i class="fas fa-anchor"></i> Ausgewählte Liegeplätze</label>

                        <!-- Chip-Input Container -->
                        <div id="selectedSlotsContainer" class="chip-input">
        <span class="placeholder">
            Klicken oder ziehen Sie Boote auf Liegeplätze – mehrere möglich
        </span>
                        </div>

                        <!-- Hidden Field für Submit -->
                        <input type="hidden" id="selectedSlotIds" name="slot_ids" value="">
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

    <!-- Bootsverleih -->
    <div class="tab-content" id="boats-tab">
        <div id="successMessage" class="booking-form" style="display:none;background:linear-gradient(135deg,#28a745,#20c997);color:#fff;text-align:center;">
            <i class="fas fa-check-circle" style="font-size:4rem;margin-bottom:1rem;"></i>
            <h2 class="section-title" style="color:#fff;">Buchung erfolgreich!</h2>
            <div style="font-size:1.2rem;margin:1.5rem 0;">
                <p style="margin-bottom:.5rem;"><strong>Reservierungsnummer:</strong> <span id="confirmedReservation"></span></p>
                <p style="margin-bottom:.5rem;"><strong>Boot:</strong> <span id="confirmedBoat"></span></p>
                <p style="margin-bottom:.5rem;"><strong>Name:</strong> <span id="confirmedName"></span></p>
                <p style="margin-bottom:.5rem;"><strong>Zeitraum:</strong> <span id="confirmedDates"></span></p>
                <p style="margin-bottom:.5rem;"><strong>Gesamtpreis:</strong> €<span id="confirmedTotal"></span></p>
            </div>
            <p style="font-size:1.1rem;margin:1.5rem 0;">Eine Bestätigungsmail wurde an Ihre E-Mail-Adresse gesendet.</p>
            <button class="btn btn-primary" onclick="location.reload()" style="background:#fff;color:#28a745;">
                <i class="fas fa-plus"></i> Neue Buchung
            </button>
        </div>

        <div class="booking-form">
            <h2 class="section-title">Boot Reservierung</h2>
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
                                <option value="<?= (int)$boat['id'] ?>" data-price="<?= esc($boat['price_per_day']) ?>">
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

        <div class="marina-section">
            <h2 class="section-title">Unsere Bootsflotte</h2>
            <p class="text-center mb-2" style="color: var(--text-light);">Wählen Sie aus unserer modernen und gut ausgestatteten Flotte</p>
            <div class="boats-grid" id="boatsGrid"></div>
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
    // Tabs
    document.querySelectorAll('.nav-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.nav-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));

            this.classList.add('active');
            const tabId = this.getAttribute('data-tab');
            document.getElementById(tabId + '-tab').classList.add('active');
        });
    });

        // =========================
        // Multi-Select Slots (Chips + Display + Hidden)
        // =========================
        const selectedSlots = new Map(); // key = slotId (string), value = { id, number }

    function refreshSelectedSlotsUI(){
        const container = document.getElementById('selectedSlotsContainer');
        const hiddenIds = document.getElementById('selectedSlotIds');

        const arr = Array.from(selectedSlots.values());

        hiddenIds.value = arr.map(x => x.id).join(',');

        container.innerHTML = '';

        if(arr.length === 0){
            container.innerHTML = `
            <span class="placeholder">
                Klicken oder ziehen Sie Boote auf Liegeplätze – mehrere möglich
            </span>
        `;
            return;
        }

        arr.forEach(slot => {
            const chip = document.createElement('div');
            chip.className = 'chip';
            chip.innerHTML = `
            <span>${slot.number}</span>
            <button type="button">&times;</button>
        `;

            chip.querySelector('button').addEventListener('click', ()=>{
                removeSlotSelectionById(slot.id);
            });

            container.appendChild(chip);
        });
    }

    function addSlotSelection(slotEl) {
        if (!slotEl || slotEl.classList.contains('occupied')) return;

        const slotId = slotEl.getAttribute('data-slot-id');
        const slotNumber = slotEl.getAttribute('data-slot');
        if (!slotId || !slotNumber) return;

        const key = String(slotId);

        if (!selectedSlots.has(key)) {
        selectedSlots.set(key, { id: slotId, number: slotNumber });
        slotEl.classList.add('selected');
        refreshSelectedSlotsUI();
    }
    }

        function removeSlotSelectionById(slotId) {
        const key = String(slotId);
        if (!selectedSlots.has(key)) return;

        selectedSlots.delete(key);

        // Slot visuell abwählen + pending entfernen (optional)
        const el = document.querySelector(`.slot[data-slot-id="${slotId}"]`);
        if (el) {
        el.classList.remove('selected');

        // Optional: wenn du beim Entfernen auch das Boot-Icon wieder weg willst:
        if (el.classList.contains('pending')) {
        el.classList.remove('pending');
        el.removeAttribute('data-boat-token');
        el.innerHTML = el.getAttribute('data-slot') || '';
    }
    }

        refreshSelectedSlotsUI();
    }

        function toggleSlotSelection(slotEl) {
        if (!slotEl || slotEl.classList.contains('occupied')) return;

        const slotId = slotEl.getAttribute('data-slot-id');
        const slotNumber = slotEl.getAttribute('data-slot');
        if (!slotId || !slotNumber) return;

        const key = String(slotId);

        if (selectedSlots.has(key)) {
        removeSlotSelectionById(slotId);
    } else {
        addSlotSelection(slotEl);
        // scroll nur wenn gewählt
        document.getElementById('slotReservationForm')
        .scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
    }

        // =========================
        // Click: Slot auswählen/abwählen
        // =========================
        document.querySelectorAll('.slot[data-slot-id]').forEach(slot => {
        slot.addEventListener('click', () => {
            // Wenn du "tap-to-place-boat" nutzt, kann hier ggf. zuerst Boot-Placement passieren.
            toggleSlotSelection(slot);
        });
    });

        // =========================
        // Drag & Drop: Boot -> Slot (macht Slot "pending" + fügt zur Auswahl hinzu)
        // =========================
        const boatTokens = document.querySelectorAll('.boat-token[draggable="true"]');
        const droppableSlots = document.querySelectorAll('.slot[data-accepts-boat="1"]');

        let draggingBoatTokenId = null;

        boatTokens.forEach(token => {
        token.addEventListener('dragstart', (e) => {
            draggingBoatTokenId = token.getAttribute('data-boat-token');
            e.dataTransfer.setData('text/plain', draggingBoatTokenId);
            e.dataTransfer.effectAllowed = 'copy';
        });
        token.addEventListener('dragend', () => {
        draggingBoatTokenId = null;
    });
    });

        droppableSlots.forEach(slot => {
        slot.addEventListener('dragover', (e) => {
            if (slot.classList.contains('occupied')) return;
            e.preventDefault();
            e.dataTransfer.dropEffect = 'copy';
            slot.classList.add('drop-hover');
        });

        slot.addEventListener('dragleave', () => {
        slot.classList.remove('drop-hover');
    });

        slot.addEventListener('drop', (e) => {
        e.preventDefault();
        slot.classList.remove('drop-hover');

        if (slot.classList.contains('occupied')) return;

        const tokenId = e.dataTransfer.getData('text/plain') || draggingBoatTokenId;
        if (!tokenId) return;

        placeBoatIntoSlot(slot, tokenId);

        // WICHTIG: Slot auch in Auswahl aufnehmen (damit Chips/Display updaten)
        addSlotSelection(slot);

        document.getElementById('slotReservationForm')
    });
    });

    function placeBoatIntoSlot(slot, tokenId) {

        if (slot.classList.contains('occupied')) return;
        if (slot.classList.contains('pending')) return;

        const originalNumber = slot.getAttribute('data-slot');

        slot.classList.add('pending');
        slot.setAttribute('data-boat-token', tokenId);

        // Nur das Schiff-Icon anzeigen
        slot.innerHTML = `
        <div class="boat-in-slot">
            <i class="fas fa-ship"></i>
        </div>
    `;

        // Optional: Tooltip mit Slot-Nummer behalten
        slot.setAttribute('title', originalNumber);
    }


    // Optional: Doppelklick entfernt "pending" + Auswahl
        document.querySelectorAll('.slot[data-slot-id]').forEach(slot => {
        slot.addEventListener('dblclick', () => {
            if (!slot.classList.contains('pending')) return;
            const slotId = slot.getAttribute('data-slot-id');
            removeSlotSelectionById(slotId);
        });
    });

        // =========================
        // Mobile Fallback: Boot antippen -> Slot antippen
        // =========================
        let touchSelectedToken = null;

        boatTokens.forEach(token => {
        token.addEventListener('click', () => {
            touchSelectedToken = token.getAttribute('data-boat-token');
            boatTokens.forEach(t => t.style.outline = '');
            token.style.outline = '3px solid rgba(244,208,63,.9)';
        });
    });

        droppableSlots.forEach(slot => {
        slot.addEventListener('click', () => {
            if (!touchSelectedToken) return;
            if (slot.classList.contains('occupied')) return;

            placeBoatIntoSlot(slot, touchSelectedToken);
            addSlotSelection(slot);

            touchSelectedToken = null;
            boatTokens.forEach(t => t.style.outline = '');

            document.getElementById('slotReservationForm')
                .scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });

    // Click Auswahl
    document.querySelectorAll('.slot:not(.occupied)').forEach(slot => {
        slot.addEventListener('click', function() {
            // Wenn du "tap-to-place-boat" nutzt, ggf. vorher abfangen.
            toggleSlotSelection(this);
        });
    });


    document.querySelectorAll('.slot:not(.occupied)').forEach(slot => {
        slot.addEventListener('click', function() {
            selectSlot(this);
        });
    });


    boatTokens.forEach(token => {
        token.addEventListener('dragstart', (e) => {

            draggingBoatTokenId = token.getAttribute('data-boat-token');
            e.dataTransfer.setData('text/plain', draggingBoatTokenId);
            e.dataTransfer.effectAllowed = 'copy';

            // 👇 Custom Drag Image (nur Schiff-Icon)
            const icon = document.createElement('i');
            icon.className = 'fas fa-ship';
            icon.style.fontSize = '32px';
            icon.style.color = '#f4d03f';
            icon.style.position = 'absolute';
            icon.style.top = '-1000px'; // außerhalb des Screens
            document.body.appendChild(icon);

            e.dataTransfer.setDragImage(icon, 16, 16);

            // Nach kurzer Zeit wieder entfernen
            setTimeout(() => {
                document.body.removeChild(icon);
            }, 0);
        });

        token.addEventListener('dragend', () => {
            draggingBoatTokenId = null;
        });
    });


    droppableSlots.forEach(slot => {
        slot.addEventListener('dragover', (e) => {
            if (slot.classList.contains('occupied')) return;
            e.preventDefault();
            e.dataTransfer.dropEffect = 'copy';
            slot.classList.add('drop-hover');
        });

        slot.addEventListener('dragleave', () => {
            slot.classList.remove('drop-hover');
        });

        slot.addEventListener('drop', (e) => {
            e.preventDefault();
            slot.classList.remove('drop-hover');

            if (slot.classList.contains('occupied')) return;

            const tokenId = e.dataTransfer.getData('text/plain') || draggingBoatTokenId;
            if (!tokenId) return;

            placeBoatIntoSlot(slot, tokenId);
            selectSlot(slot);
        });
    });


    document.querySelectorAll('.slot').forEach(slot=>{
        slot.addEventListener('dblclick', ()=>{
            if(slot.classList.contains('pending')){
                slot.classList.remove('pending');
                slot.removeAttribute('data-boat-token');
                slot.innerHTML = slot.getAttribute('data-slot');
                slot.removeAttribute('title');
            }
        });
    });

    // Mobile Fallback: Boot antippen -> Slot antippen
    // let touchSelectedToken = null;
    boatTokens.forEach(token => {
        token.addEventListener('click', () => {
            touchSelectedToken = token.getAttribute('data-boat-token');
            boatTokens.forEach(t => t.style.outline = '');
            token.style.outline = '3px solid rgba(244,208,63,.9)';
        });
    });

    droppableSlots.forEach(slot => {
        slot.addEventListener('click', () => {
            if (!touchSelectedToken) return;
            if (slot.classList.contains('occupied')) return;

            placeBoatIntoSlot(slot, touchSelectedToken);

            touchSelectedToken = null;
            boatTokens.forEach(t => t.style.outline = '');

            toggleSlotSelection(slot);

        });
    });

    // Liegeplatz Reservierung
    document.getElementById('slotReservationForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const slotInput = document.getElementById('selectedSlot');
        const slotId = slotInput.getAttribute('data-id');

        if (!slotId) {
            alert('Bitte wählen Sie zuerst einen Liegeplatz aus der Marina-Ansicht aus.');
            return;
        }

        const formData = {
            item_id: parseInt(slotId, 10),
            customer_name: document.getElementById('slotCustomerName').value,
            customer_email: document.getElementById('slotCustomerEmail').value,
            customer_phone: document.getElementById('slotCustomerPhone').value,
            start_date: document.getElementById('slotStartDate').value,
            end_date: document.getElementById('slotEndDate').value,
            payment_method: 'paypal'
        };

        const submitBtn = this.querySelector('button[type="submit"]');
        const originalBtnText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Reservierung wird erstellt...';

        fetch('/booking/makeSlotReservation', {
            method: 'POST',
            headers: {'Content-Type':'application/json'},
            body: JSON.stringify(formData)
        })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    window.location.href = data.redirect_url;
                } else {
                    alert('Fehler: ' + (data.message || 'Reservierung konnte nicht erstellt werden'));
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnText;
                }
            })
            .catch(err => {
                console.error(err);
                alert('Fehler bei der Reservierung. Bitte versuchen Sie es erneut.');
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnText;
            });
    });

    // Boot Reservierung
    document.getElementById('boatReservationForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const boatSelect = document.getElementById('selectedBoat');
        if (!boatSelect.value) {
            alert('Bitte wählen Sie zuerst ein Boot aus.');
            return;
        }

        const formData = {
            item_id: parseInt(boatSelect.value, 10),
            customer_name: document.getElementById('boatCustomerName').value,
            customer_email: document.getElementById('boatCustomerEmail').value,
            customer_phone: document.getElementById('boatCustomerPhone').value,
            start_date: document.getElementById('boatStartDate').value,
            end_date: document.getElementById('boatEndDate').value,
            experience_level: document.getElementById('boatExperience').value,
            additional_equipment: document.getElementById('boatRequests').value,
            payment_method: 'paypal'
        };

        const submitBtn = this.querySelector('button[type="submit"]');
        const originalBtnText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Reservierung wird erstellt...';

        fetch('/booking/makeBoatReservation', {
            method: 'POST',
            headers: {'Content-Type':'application/json'},
            body: JSON.stringify(formData)
        })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    window.location.href = data.redirect_url;
                } else {
                    alert('Fehler: ' + (data.message || 'Reservierung konnte nicht erstellt werden'));
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnText;
                }
            })
            .catch(err => {
                console.error(err);
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

    document.querySelectorAll('input[type="date"]').forEach(input => {
        input.value = formatDate(today);
        input.min = formatDate(today);
    });

    const slotEnd = document.getElementById('slotEndDate');
    if (slotEnd) slotEnd.value = formatDate(tomorrow);

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

    // Smooth Scroll Anchor Links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;

            if (targetId === '#boats') {
                document.querySelectorAll('.nav-tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
                document.querySelector('.nav-tab[data-tab="boats"]').classList.add('active');
                document.getElementById('boats-tab').classList.add('active');
                document.getElementById('boats-tab').scrollIntoView({behavior:'smooth',block:'start'});
            } else {
                const target = document.querySelector(targetId);
                if (target) target.scrollIntoView({behavior:'smooth'});
            }
        });
    });

    // Boots-Daten (Demo für Karten)
    const boatsData = [
        {id:1,name:'Bavaria Cruiser 37',type:'Segelyacht',category:'premium',length:11.3,year:2023,capacity:8,price_per_day:350,features:['2 Kabinen','Vollküche','WC mit Dusche','GPS','Autopilot'],image:'https://res.cloudinary.com/dk-wassersport/image/upload/v1740666784/yacht/yacht_20250219_202505_new-img_75_4_img-Z6Q0P0Qy.jpg'},
        {id:2,name:'Hanse 388',type:'Segelyacht',category:'premium',length:11.4,year:2022,capacity:6,price_per_day:320,features:['3 Kabinen','Kombüse','Elektrowinde','Badeplattform','Sonnenliege'],image:'https://res.cloudinary.com/dk-wassersport/image/upload/v1687436145/yacht/hanse-388-segeln-lavagna-2018-mst-7553_ef16a87fb0075501318c20c50a281a6a.jpg'},
        {id:3,name:'Jeanneau Sun Odyssey 349',type:'Segelyacht',category:'comfort',length:10.3,year:2021,capacity:6,price_per_day:280,features:['Großraum','Kühlschrank','Heizung','Badeleiter','Stereoanlage'],image:'https://www.pitter-yachting.com/images/yacht/sun-odyssey-349/23971630-nala/23971630-main.jpg'},
        {id:4,name:'Quicksilver Activ 675',type:'Motorboot',category:'comfort',length:6.75,year:2023,capacity:8,price_per_day:220,features:['115 PS','Sonnendeck','Badeplattform','Kühlbox','USB-Anschluss'],image:'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTlymDneY3tolTqia68b61rdHnxxw9NZzakxQ&s'},
        {id:5,name:'Bayliner VR6',type:'Motorboot',category:'standard',length:6.1,year:2022,capacity:6,price_per_day:180,features:['Mercury 150 PS','Ski-Torpedo','Badeleiter','Sportlenkung','Bluetooth'],image:'https://www.bootscenter-keser.de/wp-content/uploads/2024/03/Bayliner-VR6-Cuddy-7.webp'},
        {id:6,name:'Zodiac Cadet 310',type:'Schlauchboot',category:'economy',length:3.1,year:2023,capacity:4,price_per_day:90,features:['20 PS Motor','Leicht & wendig','Einfache Bedienung','Schnell abpumpbar'],image:'https://www.marinawassersport.de/cdn/shop/files/2015_Zodiac_310Alu_01_6edc392e-22e9-469e-a766-9d8670794f46.jpg?v=1740217353&width=1445'}
    ];

    // Karten generieren
    const boatsGrid = document.getElementById('boatsGrid');
    boatsData.forEach(boat => {
        const boatCard = document.createElement('div');
        boatCard.className = 'boat-card';
        boatCard.setAttribute('data-boat-id', boat.id);
        boatCard.innerHTML = `
            <div class="boat-image" style="background-image:url('${boat.image}');">
                <div class="boat-category">${boat.type}</div>
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
                    <div class="detail-item"><i class="fas fa-ruler"></i><span>${boat.length}m</span></div>
                    <div class="detail-item"><i class="fas fa-users"></i><span>${boat.capacity} Pers.</span></div>
                    <div class="detail-item"><i class="fas fa-calendar"></i><span>${boat.year}</span></div>
                </div>
                <div class="boat-features">
                    ${boat.features.map(f => `<span class="feature-tag">${f}</span>`).join('')}
                </div>
                <button class="btn btn-primary select-boat-btn" data-boat-id="${boat.id}" style="width:100%;margin-top:1rem;">
                    <i class="fas fa-check"></i> Boot auswählen
                </button>
            </div>
        `;
        boatsGrid.appendChild(boatCard);
    });

    // Boot auswählen -> Tab + Select setzen
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.select-boat-btn');
        if (!btn) return;

        const boatId = btn.getAttribute('data-boat-id');
        document.querySelectorAll('.nav-tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
        document.querySelector('.nav-tab[data-tab="boats"]').classList.add('active');
        document.getElementById('boats-tab').classList.add('active');

        document.getElementById('selectedBoat').value = boatId;
        document.getElementById('boatReservationForm').scrollIntoView({behavior:'smooth',block:'start'});
    });

    // Erfolg (von Payment)
    window.addEventListener('load', function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('success') === 'true') {
            document.querySelectorAll('.nav-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
            document.querySelector('.nav-tab[data-tab="boats"]').classList.add('active');
            document.getElementById('boats-tab').classList.add('active');

            document.getElementById('successMessage').style.display = 'block';
            document.getElementById('boatReservationForm').parentElement.style.display = 'none';
            document.querySelector('.boats-grid').parentElement.style.display = 'none';

            document.getElementById('confirmedReservation').textContent = decodeURIComponent(urlParams.get('reservation') || 'N/A');
            document.getElementById('confirmedBoat').textContent = decodeURIComponent(urlParams.get('boat') || '');
            document.getElementById('confirmedName').textContent = decodeURIComponent(urlParams.get('name') || '');
            document.getElementById('confirmedDates').textContent = `${urlParams.get('start')} bis ${urlParams.get('end')}`;
            document.getElementById('confirmedTotal').textContent = urlParams.get('total') || '0';

            document.getElementById('successMessage').scrollIntoView({behavior:'smooth'});
        }
    });
</script>
</body>
</html>
