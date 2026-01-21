<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Bestellungsverwaltung - Yachthafen Plau am See</title>
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
            max-width: 1600px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        .page-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: var(--white);
            padding: 3rem 0 2.5rem;
            margin-bottom: 3rem;
            box-shadow: 0 5px 20px var(--shadow);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1.5rem;
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
            margin-bottom: 1rem;
            font-size: 1rem;
            transition: var(--transition);
        }

        .back-link:hover {
            opacity: 0.8;
        }

        .role-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.2);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
        }

        .role-badge.admin {
            background: var(--danger);
        }

        .role-badge.worker {
            background: var(--accent);
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .stat-card {
            background: var(--white);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            box-shadow: 0 5px 20px var(--shadow);
            display: flex;
            align-items: center;
            gap: 1.5rem;
            transition: var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px var(--shadow);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 1.8rem;
        }

        .stat-icon.total {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: var(--white);
        }

        .stat-icon.paid {
            background: linear-gradient(135deg, var(--success), #20c997);
            color: var(--white);
        }

        .stat-icon.pending {
            background: linear-gradient(135deg, var(--warning), #ffc720);
            color: var(--text-dark);
        }

        .stat-icon.cancelled {
            background: linear-gradient(135deg, var(--danger), #ff6b6b);
            color: var(--white);
        }

        .stat-content h3 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .stat-content p {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        /* Table */
        .table-container {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: 0 5px 20px var(--shadow);
            overflow: hidden;
        }

        .table-header {
            padding: 1.5rem 2rem;
            border-bottom: 2px solid var(--light-gray);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .table-header h2 {
            font-size: 1.5rem;
            color: var(--text-dark);
        }

        .search-box {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .search-box input {
            padding: 0.7rem 1rem;
            border: 2px solid var(--light-gray);
            border-radius: 8px;
            font-size: 1rem;
            min-width: 300px;
            transition: var(--transition);
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary);
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: var(--light-bg);
        }

        th {
            padding: 1rem 1.5rem;
            text-align: left;
            font-weight: 600;
            color: var(--text-dark);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        tbody tr {
            border-bottom: 1px solid var(--light-gray);
            transition: var(--transition);
        }

        tbody tr:hover {
            background: var(--light-bg);
        }

        td {
            padding: 1.2rem 1.5rem;
            color: var(--text-dark);
        }

        .booking-number {
            font-weight: 600;
            color: var(--primary);
            font-family: monospace;
        }

        .status-badge {
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
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

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .btn {
            padding: 0.6rem 1.2rem;
            border: none;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-danger {
            background: var(--danger);
            color: var(--white);
        }

        .btn-danger:hover {
            background: #c82333;
            transform: translateY(-2px);
        }

        .btn-info {
            background: var(--accent);
            color: var(--white);
        }

        .btn-info:hover {
            background: #138496;
            transform: translateY(-2px);
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Alert Messages */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: var(--border-radius);
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert i {
            font-size: 1.5rem;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 5rem 2rem;
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

        /* Responsive */
        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 2rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .search-box input {
                min-width: 200px;
            }

            .table-wrapper {
                font-size: 0.9rem;
            }

            th, td {
                padding: 0.8rem 1rem;
            }

            .action-buttons {
                flex-direction: column;
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
            <div class="header-content">
                <div>
                    <h1>
                        <i class="fas fa-clipboard-list"></i>
                        Bestellungsverwaltung
                    </h1>
                    <p>Übersicht aller Bootsreservierungen</p>
                </div>
                <div class="role-badge <?= strtolower(esc($user['role'])) ?>">
                    <i class="fas fa-user-shield"></i>
                    <?= ucfirst(esc($user['role'])) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <?php if (session()->has('success')): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <span><?= session('success') ?></span>
            </div>
        <?php endif; ?>

        <?php if (session()->has('error')): ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i>
                <span><?= session('error') ?></span>
            </div>
        <?php endif; ?>

        <!-- Statistics -->
        <?php
            $total = count($bookings);
            $paid = count(array_filter($bookings, fn($b) => $b['payment_status'] === 'paid'));
            $pending = count(array_filter($bookings, fn($b) => $b['payment_status'] === 'pending'));
            $cancelled = count(array_filter($bookings, fn($b) => $b['payment_status'] === 'cancelled'));
        ?>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon total">
                    <i class="fas fa-list"></i>
                </div>
                <div class="stat-content">
                    <h3><?= $total ?></h3>
                    <p>Gesamt Buchungen</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon paid">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-content">
                    <h3><?= $paid ?></h3>
                    <p>Bezahlt</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon pending">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-content">
                    <h3><?= $pending ?></h3>
                    <p>Ausstehend</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon cancelled">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div class="stat-content">
                    <h3><?= $cancelled ?></h3>
                    <p>Storniert</p>
                </div>
            </div>
        </div>

        <!-- Bookings Table -->
        <div class="table-container">
            <div class="table-header">
                <h2>Alle Buchungen</h2>
                <div class="search-box">
                    <i class="fas fa-search" style="color: var(--text-light);"></i>
                    <input type="text" id="searchInput" placeholder="Suche nach Name, Boot, Reservierungsnummer...">
                </div>
            </div>

            <?php if (empty($bookings)): ?>
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <h2>Keine Buchungen vorhanden</h2>
                    <p>Es wurden noch keine Buchungen vorgenommen.</p>
                </div>
            <?php else: ?>
                <div class="table-wrapper">
                    <table id="bookingsTable">
                        <thead>
                            <tr>
                                <th>Reservierungs-Nr.</th>
                                <th>Kunde</th>
                                <th>Typ</th>
                                <th>Boot / Liegeplatz</th>
                                <th>Zeitraum</th>
                                <th>Tage</th>
                                <th>Betrag</th>
                                <th>Status</th>
                                <th>Gebucht am</th>
                                <th>Aktionen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bookings as $booking): ?>
                                <tr>
                                    <td>
                                        <span class="booking-number"><?= esc($booking['reservation_number']) ?></span>
                                    </td>
                                    <td>
                                        <strong><?= esc($booking['customer_name']) ?></strong><br>
                                        <small style="color: var(--text-light);"><?= esc($booking['customer_email']) ?></small>
                                    </td>
                                    <td>
                                        <?php if ($booking['reservation_type'] === 'boot'): ?>
                                            <i class="fas fa-ship"></i> Boot
                                        <?php else: ?>
                                            <i class="fas fa-anchor"></i> Liegeplatz
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($booking['reservation_type'] === 'boot'): ?>
                                            <?= esc($booking['item_name'] ?? $booking['boat_name']) ?>
                                        <?php else: ?>
                                            Liegeplatz <?= esc($booking['slot_number'] ?? $booking['item_name']) ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?= date('d.m.Y', strtotime($booking['start_date'])) ?><br>
                                        <small style="color: var(--text-light);">bis <?= date('d.m.Y', strtotime($booking['end_date'])) ?></small>
                                    </td>
                                    <td><?= $booking['days'] ?></td>
                                    <td><strong>€<?= number_format($booking['total_amount'], 2, ',', '.') ?></strong></td>
                                    <td>
                                        <span class="status-badge status-<?= esc($booking['payment_status']) ?>">
                                            <?php
                                                $statusText = [
                                                    'paid' => 'Bezahlt',
                                                    'pending' => 'Ausstehend',
                                                    'cancelled' => 'Storniert'
                                                ];
                                                echo $statusText[$booking['payment_status']] ?? 'Unbekannt';
                                            ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?= date('d.m.Y', strtotime($booking['created_at'])) ?><br>
                                        <small style="color: var(--text-light);"><?= date('H:i', strtotime($booking['created_at'])) ?> Uhr</small>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <?php if ($booking['payment_status'] !== 'cancelled'): ?>
                                                <form method="POST" action="/admin/bookings/cancel" style="display: inline;" 
                                                      onsubmit="return confirm('Möchten Sie diese Buchung wirklich stornieren?');">
                                                    <input type="hidden" name="booking_id" value="<?= $booking['id'] ?>">
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fas fa-ban"></i> Stornieren
                                                    </button>
                                                </form>
                                            <?php else: ?>
                                                <button class="btn btn-danger" disabled>
                                                    <i class="fas fa-ban"></i> Storniert
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Live Search Functionality with Persistent No Results Message
        document.getElementById('searchInput')?.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('#bookingsTable tbody tr');
            const tbody = document.querySelector('#bookingsTable tbody');
            let hasResults = false;

            rows.forEach(row => {
                const text = row.innerText.toLowerCase(); // Use innerText for better compatibility
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                    hasResults = true;
                } else {
                    row.style.display = 'none';
                }
            });

            // Ensure 'No results found' message is always displayed when no results are found
            let noResultsRow = document.getElementById('noResultsRow');
            if (!hasResults) {
                if (!noResultsRow) {
                    noResultsRow = document.createElement('tr');
                    noResultsRow.id = 'noResultsRow';
                    noResultsRow.innerHTML = `<td colspan="10" style="text-align: center; color: var(--text-light);">Keine Suchergebnisse gefunden</td>`;
                    tbody.appendChild(noResultsRow);
                } else {
                    noResultsRow.style.display = '';
                }
            } else {
                if (noResultsRow) {
                    noResultsRow.style.display = 'none';
                }
            }
        });
    </script>
</body>
</html>
