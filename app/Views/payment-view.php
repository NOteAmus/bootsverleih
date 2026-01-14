<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zahlung abschließen - PayPal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            background: #f5f7fa;
            color: #2c2e2f;
            line-height: 1.5;
        }

        .paypal-header {
            background: #ffffff;
            border-bottom: 1px solid #cbd2d9;
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .paypal-logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .paypal-logo svg {
            width: 120px;
            height: auto;
        }

        .container {
            max-width: 1000px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .payment-layout {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 2rem;
            align-items: start;
        }

        .payment-main {
            background: #ffffff;
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .payment-summary {
            background: #ffffff;
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            position: sticky;
            top: 2rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
            color: #2c2e2f;
        }

        .payment-methods {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .payment-method {
            border: 2px solid #cbd2d9;
            border-radius: 8px;
            padding: 1.2rem;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .payment-method:hover {
            border-color: #0070ba;
            background: #f7f9fa;
        }

        .payment-method.active {
            border-color: #0070ba;
            background: #f7f9fa;
        }

        .payment-method input[type="radio"] {
            width: 20px;
            height: 20px;
            accent-color: #0070ba;
        }

        .payment-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #2c2e2f;
            font-size: 0.95rem;
        }

        input, select {
            width: 100%;
            padding: 0.9rem;
            border: 1px solid #cbd2d9;
            border-radius: 4px;
            font-size: 1rem;
            transition: all 0.3s;
            font-family: inherit;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #0070ba;
            box-shadow: 0 0 0 3px rgba(0,112,186,0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1rem;
        }

        .card-icons {
            display: flex;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .card-icons i {
            font-size: 1.8rem;
        }

        .btn-paypal {
            width: 100%;
            padding: 1rem 2rem;
            background: #0070ba;
            color: white;
            border: none;
            border-radius: 24px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 1rem;
        }

        .btn-paypal:hover {
            background: #005ea6;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,112,186,0.3);
        }

        .btn-paypal:active {
            transform: translateY(0);
        }

        .order-summary {
            border-top: 1px solid #cbd2d9;
            padding-top: 1.5rem;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
            padding: 0.5rem 0;
        }

        .summary-item.total {
            border-top: 2px solid #cbd2d9;
            margin-top: 1rem;
            padding-top: 1rem;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .booking-details {
            background: #f7f9fa;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .booking-details h3 {
            font-size: 1.1rem;
            margin-bottom: 1rem;
            color: #2c2e2f;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.8rem;
            font-size: 0.95rem;
        }

        .detail-label {
            color: #6c7378;
        }

        .detail-value {
            font-weight: 500;
            color: #2c2e2f;
        }

        .security-notice {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            background: #f0f8ff;
            padding: 1rem;
            border-radius: 6px;
            margin-top: 1.5rem;
            font-size: 0.9rem;
            color: #0070ba;
        }

        .security-notice i {
            font-size: 1.5rem;
        }

        @media (max-width: 992px) {
            .payment-layout {
                grid-template-columns: 1fr;
            }

            .payment-summary {
                position: static;
            }
        }

        .loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.8);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .loading-overlay.active {
            display: flex;
        }

        .loading-content {
            background: white;
            padding: 3rem;
            border-radius: 12px;
            text-align: center;
        }

        .spinner {
            width: 60px;
            height: 60px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #0070ba;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 1.5rem;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <header class="paypal-header">
        <div class="paypal-logo">
            <svg viewBox="0 0 100 32" xmlns="http://www.w3.org/2000/svg">
                <path fill="#003087" d="M12 4.917h-2.833c-.417 0-.75.333-.75.75v12.666c0 .417.333.75.75.75h.75c.417 0 .75-.333.75-.75v-4.666h1.333c2.75 0 5-2.25 5-5s-2.25-5-5-5zm0 8.333h-1.333v-6.667h1.333c1.833 0 3.333 1.5 3.333 3.333s-1.5 3.334-3.333 3.334z"/>
                <path fill="#009cde" d="M29 4.917h-2.833c-.417 0-.75.333-.75.75v.5c-.667-.75-1.667-1.25-2.833-1.25-2.583 0-4.667 2.083-4.667 4.666s2.084 4.667 4.667 4.667c1.166 0 2.166-.5 2.833-1.25v.5c0 .417.333.75.75.75h.75c.417 0 .75-.333.75-.75v-7.833c0-.417-.333-.75-.75-.75h-.917zm-5.667 7.5c-1.5 0-2.666-1.167-2.666-2.667s1.166-2.667 2.666-2.667 2.667 1.167 2.667 2.667-1.167 2.667-2.667 2.667z"/>
                <path fill="#003087" d="M45 4.917h-2.833c-.417 0-.75.333-.75.75v.5c-.667-.75-1.667-1.25-2.833-1.25-2.583 0-4.667 2.083-4.667 4.666s2.084 4.667 4.667 4.667c1.166 0 2.166-.5 2.833-1.25v.5c0 .417.333.75.75.75h.75c.417 0 .75-.333.75-.75v-7.833c0-.417-.333-.75-.75-.75h-.917zm-5.667 7.5c-1.5 0-2.666-1.167-2.666-2.667s1.166-2.667 2.666-2.667 2.667 1.167 2.667 2.667-1.167 2.667-2.667 2.667z"/>
            </svg>
        </div>
    </header>

    <div class="container">
        <div class="payment-layout">
            <div class="payment-main">
                <h2 class="section-title">Zahlungsmethode wählen</h2>

                <div class="payment-methods">
                    <label class="payment-method active">
                        <input type="radio" name="payment_method" value="paypal" checked>
                        <div class="payment-icon">
                            <i class="fab fa-paypal" style="color: #0070ba;"></i>
                        </div>
                        <div>
                            <strong>PayPal</strong>
                            <div style="font-size: 0.9rem; color: #6c7378;">Bezahlen Sie sicher mit Ihrem PayPal-Konto</div>
                        </div>
                    </label>

                    <label class="payment-method">
                        <input type="radio" name="payment_method" value="card">
                        <div class="payment-icon">
                            <i class="fas fa-credit-card" style="color: #333;"></i>
                        </div>
                        <div>
                            <strong>Kredit- oder Debitkarte</strong>
                            <div style="font-size: 0.9rem; color: #6c7378;">Visa, Mastercard, American Express</div>
                        </div>
                    </label>
                </div>

                <form id="paymentForm">
                    <div id="cardFields" style="display: none;">
                        <div class="form-group">
                            <label>Karteninhaber</label>
                            <input type="text" id="cardHolder" placeholder="Max Mustermann">
                        </div>

                        <div class="form-group">
                            <label>Kartennummer</label>
                            <input type="text" id="cardNumber" placeholder="1234 5678 9012 3456" maxlength="19">
                            <div class="card-icons">
                                <i class="fab fa-cc-visa" style="color: #1A1F71;"></i>
                                <i class="fab fa-cc-mastercard" style="color: #EB001B;"></i>
                                <i class="fab fa-cc-amex" style="color: #006FCF;"></i>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Gültig bis</label>
                                <input type="text" id="cardExpiry" placeholder="MM/JJ" maxlength="5">
                            </div>
                            <div class="form-group">
                                <label>CVV</label>
                                <input type="text" id="cardCvv" placeholder="123" maxlength="3">
                            </div>
                        </div>
                    </div>

                    <div id="paypalFields">
                        <div class="form-group">
                            <label>PayPal E-Mail</label>
                            <input type="email" id="paypalEmail" placeholder="ihre-email@beispiel.de" required>
                        </div>

                        <div class="form-group">
                            <label>PayPal Passwort</label>
                            <input type="password" id="paypalPassword" placeholder="••••••••" required>
                        </div>
                    </div>

                    <div class="security-notice">
                        <i class="fas fa-lock"></i>
                        <div>Ihre Zahlungsinformationen sind sicher verschlüsselt</div>
                    </div>

                    <button type="submit" class="btn-paypal">
                        <i class="fas fa-lock"></i> Jetzt sicher bezahlen
                    </button>
                </form>
            </div>

            <div class="payment-summary">
                <h3 class="section-title">Bestellübersicht</h3>

                <div class="booking-details">
                    <h3><i class="fas fa-ship"></i> Bootsbuchung</h3>
                    <div class="detail-row">
                        <span class="detail-label">Boot:</span>
                        <span class="detail-value" id="summaryBoat">-</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Name:</span>
                        <span class="detail-value" id="summaryName">-</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">E-Mail:</span>
                        <span class="detail-value" id="summaryEmail">-</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Zeitraum:</span>
                        <span class="detail-value" id="summaryDates">-</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Dauer:</span>
                        <span class="detail-value" id="summaryDuration">-</span>
                    </div>
                </div>

                <div class="order-summary">
                    <div class="summary-item">
                        <span>Bootspreis</span>
                        <span id="boatPrice">€0</span>
                    </div>
                    <div class="summary-item">
                        <span>Servicegebühr</span>
                        <span id="serviceFee">€25</span>
                    </div>
                    <div class="summary-item">
                        <span>Versicherung</span>
                        <span id="insurance">€35</span>
                    </div>
                    <div class="summary-item total">
                        <span>Gesamtbetrag</span>
                        <span id="totalAmount">€0</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-content">
            <div class="spinner"></div>
            <h3>Zahlung wird verarbeitet...</h3>
            <p>Bitte warten Sie einen Moment</p>
        </div>
    </div>

    <script>
        // Buchungsdaten aus PHP-Variable (von der Datenbank)
        const reservation = <?= json_encode($reservation) ?>;
        
        const bookingData = {
            id: reservation.id,
            reservationNumber: reservation.reservation_number,
            reservationType: reservation.reservation_type,
            name: reservation.customer_name,
            email: reservation.customer_email,
            boat: reservation.boat_name,
            startDate: reservation.start_date,
            endDate: reservation.end_date,
            days: reservation.days,
            boatPrice: parseFloat(reservation.boat_price),
            serviceFee: parseFloat(reservation.service_fee),
            insurance: parseFloat(reservation.insurance),
            totalAmount: parseFloat(reservation.total_amount)
        };

        // Zusammenfassung anzeigen
        document.getElementById('summaryBoat').textContent = bookingData.boat;
        document.getElementById('summaryName').textContent = bookingData.name;
        document.getElementById('summaryEmail').textContent = bookingData.email;
        document.getElementById('summaryDates').textContent = `${bookingData.startDate} bis ${bookingData.endDate}`;
        document.getElementById('summaryDuration').textContent = `${bookingData.days} Tag${bookingData.days !== 1 ? 'e' : ''}`;
        document.getElementById('boatPrice').textContent = `€${bookingData.boatPrice.toFixed(2)}`;
        document.getElementById('serviceFee').textContent = `€${bookingData.serviceFee.toFixed(2)}`;
        document.getElementById('insurance').textContent = `€${bookingData.insurance.toFixed(2)}`;
        document.getElementById('totalAmount').textContent = `€${bookingData.totalAmount.toFixed(2)}`;

        // Zahlungsmethoden-Wechsel
        document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.querySelectorAll('.payment-method').forEach(method => {
                    method.classList.remove('active');
                });
                this.closest('.payment-method').classList.add('active');

                if (this.value === 'card') {
                    document.getElementById('cardFields').style.display = 'block';
                    document.getElementById('paypalFields').style.display = 'none';
                } else {
                    document.getElementById('cardFields').style.display = 'none';
                    document.getElementById('paypalFields').style.display = 'block';
                }
            });
        });

        // Kartennummer formatieren
        document.getElementById('cardNumber')?.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s/g, '');
            let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
            e.target.value = formattedValue;
        });

        // Ablaufdatum formatieren
        document.getElementById('cardExpiry')?.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 2) {
                value = value.slice(0, 2) + '/' + value.slice(2, 4);
            }
            e.target.value = value;
        });

        // Formular absenden
        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Loading anzeigen
            document.getElementById('loadingOverlay').classList.add('active');

            // Daten sammeln
            const formData = new FormData();
            formData.append('reservation_id', bookingData.id);
            
            const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
            formData.append('payment_method', paymentMethod);

            // An Server senden
            fetch('/payment/process', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Erfolgreiche Zahlung - zu My Bookings weiterleiten
                    setTimeout(() => {
                        window.location.href = '/my-bookings?success=true&reservation=' + data.reservation_number;
                    }, 1500);
                } else {
                    alert('Fehler bei der Zahlung: ' + (data.message || 'Unbekannter Fehler'));
                    document.getElementById('loadingOverlay').classList.remove('active');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Fehler bei der Zahlung. Bitte versuchen Sie es erneut.');
                document.getElementById('loadingOverlay').classList.remove('active');
            });
        });
    </script>
</body>
</html>
