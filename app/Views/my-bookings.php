<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Meine Buchungen - Yachthafen Plau am See</title>
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

        /* Header */
        .page-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: var(--white);
            padding: 4rem 0 3rem;
            margin-bottom: 3rem;
        }

        .page-header h1 {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .page-header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--white);
            text-decoration: none;
            margin-bottom: 1.5rem;
            font-size: 1rem;
            transition: var(--transition);
        }

        .back-link:hover {
            opacity: 0.8;
        }

        /* Bookings Grid */
        .bookings-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .booking-card {
            background: var(--white);
            border-radius: var(--border-radius);
            padding: 2rem;
            box-shadow: 0 5px 20px var(--shadow);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .booking-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
        }

        .booking-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px var(--shadow);
        }

        .booking-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--light-gray);
        }

        .booking-number {
            font-size: 0.85rem;
            color: var(--text-light);
            font-weight: 600;
            background: var(--light-bg);
            padding: 0.5rem 1rem;
            border-radius: 20px;
        }

        .booking-status {
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .status-paid {
            background: var(--success);
            color: var(--white);
        }

        .status-pending {
            background: var(--warning);
            color: var(--text-dark);
        }

        .status-cancelled {
            background: var(--danger);
            color: var(--white);
        }

        .boat-info {
            margin-bottom: 1.5rem;
        }

        .boat-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .booking-details {
            display: grid;
            gap: 1rem;
        }

        .detail-row {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.8rem;
            background: var(--light-bg);
            border-radius: 8px;
        }

        .detail-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--primary);
            color: var(--white);
            border-radius: 50%;
            flex-shrink: 0;
        }

        .detail-content {
            flex: 1;
        }

        .detail-label {
            font-size: 0.85rem;
            color: var(--text-light);
            margin-bottom: 0.2rem;
        }

        .detail-value {
            font-weight: 600;
            color: var(--text-dark);
            font-size: 1rem;
        }

        .booking-footer {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 2px solid var(--light-gray);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .total-price {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary);
        }

        .booking-date {
            font-size: 0.85rem;
            color: var(--text-light);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 5rem 2rem;
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: 0 5px 20px var(--shadow);
        }

        .empty-state i {
            font-size: 5rem;
            color: var(--text-light);
            margin-bottom: 2rem;
        }

        .empty-state h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: var(--text-dark);
        }

        .empty-state p {
            font-size: 1.1rem;
            color: var(--text-light);
            margin-bottom: 2rem;
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

        /* Responsive */
        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 2rem;
            }

            .bookings-grid {
                grid-template-columns: 1fr;
            }

            .booking-header {
                flex-direction: column;
                gap: 1rem;
            }

            .total-price {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="page-header">
        <div class="container">
            <a href="/" class="back-link">
                <i class="fas fa-arrow-left"></i> Zurück zur Startseite
            </a>
            <h1>
                <i class="fas fa-clipboard-list"></i>
                Meine Buchungen
            </h1>
            <p>Willkommen zurück, <?= esc($user['firstName']) ?>! Hier ist eine Übersicht Ihrer Bootsreservierungen.</p>
        </div>
    </div>

    <div class="container">
        <?php if (empty($bookings)): ?>
            <div class="empty-state">
                <i class="fas fa-ship"></i>
                <h2>Noch keine Buchungen</h2>
                <p>Sie haben noch keine Boote reserviert. Starten Sie jetzt Ihr nächstes Abenteuer!</p>
                <a href="/booking" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Jetzt Boot reservieren
                </a>
            </div>
        <?php else: ?>
            <div class="bookings-grid">
                <?php foreach ($bookings as $booking): ?>
                    <div class="booking-card">
                        <div class="booking-header">
                            <span class="booking-number">
                                <i class="fas fa-hashtag"></i> <?= esc($booking['reservation_number']) ?>
                            </span>
                            <span class="booking-status status-<?= esc($booking['payment_status']) ?>">
                                <?php
                                    $statusText = [
                                        'paid' => 'Bezahlt',
                                        'pending' => 'Ausstehend',
                                        'cancelled' => 'Storniert'
                                    ];
                                    echo $statusText[$booking['payment_status']] ?? 'Unbekannt';
                                ?>
                            </span>
                        </div>

                        <div class="boat-info">
                            <div class="boat-name">
                                <?php if ($booking['reservation_type'] === 'boot'): ?>
                                    <i class="fas fa-ship"></i>
                                    <?= esc($booking['item_name'] ?? $booking['boat_name']) ?>
                                <?php else: ?>
                                    <i class="fas fa-anchor"></i>
                                    Liegeplatz <?= esc($booking['slot_number'] ?? $booking['item_name']) ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="booking-details">
                            <div class="detail-row">
                                <div class="detail-icon">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div class="detail-content">
                                    <div class="detail-label">Buchungszeitraum</div>
                                    <div class="detail-value">
                                        <?= date('d.m.Y', strtotime($booking['start_date'])) ?> - 
                                        <?= date('d.m.Y', strtotime($booking['end_date'])) ?>
                                        (<?= $booking['days'] ?> Tag<?= $booking['days'] > 1 ? 'e' : '' ?>)
                                    </div>
                                </div>
                            </div>

                            <div class="detail-row">
                                <div class="detail-icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="detail-content">
                                    <div class="detail-label">Gebucht auf</div>
                                    <div class="detail-value"><?= esc($booking['customer_name']) ?></div>
                                </div>
                            </div>

                            <div class="detail-row">
                                <div class="detail-icon">
                                    <i class="fas fa-credit-card"></i>
                                </div>
                                <div class="detail-content">
                                    <div class="detail-label">Zahlungsmethode</div>
                                    <div class="detail-value">
                                        <?= ucfirst(esc($booking['payment_method'])) ?>
                                    </div>
                                </div>
                            </div>

                            <?php if (!empty($booking['experience_level'])): ?>
                            <div class="detail-row">
                                <div class="detail-icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="detail-content">
                                    <div class="detail-label">Erfahrungslevel</div>
                                    <div class="detail-value">
                                        <?php
                                            $levels = [
                                                'beginner' => 'Anfänger',
                                                'intermediate' => 'Erfahren',
                                                'expert' => 'Experte'
                                            ];
                                            echo $levels[$booking['experience_level']] ?? ucfirst($booking['experience_level']);
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="booking-footer">
                            <div>
                                <div class="detail-label">Gesamtpreis</div>
                                <div class="total-price">€<?= number_format($booking['total_amount'], 2, ',', '.') ?></div>
                            </div>
                            <div class="booking-date">
                                <i class="fas fa-clock"></i> Gebucht am <?= date('d.m.Y', strtotime($booking['created_at'])) ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div style="text-align: center; margin-top: 3rem;">
                <a href="/booking" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Weitere Buchung hinzufügen
                </a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
