<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Kreditkartenzahlung</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
	<style>
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		body {
			font-family: "Space Grotesk", "Helvetica Neue", Helvetica, Arial, sans-serif;
			background: radial-gradient(circle at 20% 20%, rgba(56, 189, 248, 0.08), transparent 30%),
						radial-gradient(circle at 80% 0%, rgba(96, 165, 250, 0.12), transparent 26%),
						#0b1221;
			color: #e5e7eb;
			line-height: 1.5;
			min-height: 100vh;
			padding: 2.5rem 1rem 3rem;
		}

		.surface {
			max-width: 1160px;
			margin: 0 auto;
			background: linear-gradient(145deg, rgba(15, 23, 42, 0.92), rgba(15, 23, 42, 0.82));
			border: 1px solid rgba(148, 163, 184, 0.15);
			border-radius: 18px;
			box-shadow: 0 24px 60px rgba(0, 0, 0, 0.35), inset 0 1px 0 rgba(255, 255, 255, 0.04);
			overflow: hidden;
		}

		.top-bar {
			display: flex;
			align-items: center;
			justify-content: space-between;
			padding: 1.25rem 1.75rem;
			border-bottom: 1px solid rgba(148, 163, 184, 0.15);
			background: linear-gradient(90deg, rgba(56, 189, 248, 0.08), rgba(59, 130, 246, 0.08));
		}

		.brand {
			display: flex;
			align-items: center;
			gap: 0.75rem;
		}

		.brand-mark {
			width: 42px;
			height: 42px;
			border-radius: 12px;
			background: linear-gradient(135deg, #22d3ee, #2563eb);
			display: grid;
			place-items: center;
			color: #0b1221;
			font-weight: 700;
			letter-spacing: 0.5px;
			box-shadow: 0 10px 30px rgba(37, 99, 235, 0.4);
		}

		.brand-title {
			display: flex;
			flex-direction: column;
			gap: 0.25rem;
		}

		.brand-title span {
			font-size: 0.85rem;
			color: #94a3b8;
		}

		.trust-badges {
			display: flex;
			align-items: center;
			gap: 0.5rem;
		}

		.badge {
			display: inline-flex;
			align-items: center;
			gap: 0.5rem;
			padding: 0.55rem 0.85rem;
			border-radius: 999px;
			background: rgba(148, 163, 184, 0.12);
			border: 1px solid rgba(148, 163, 184, 0.2);
			color: #e5e7eb;
			font-size: 0.9rem;
			letter-spacing: 0.02em;
		}

		.layout {
			display: grid;
			grid-template-columns: 1.1fr 0.9fr;
			gap: 1px;
			background: rgba(148, 163, 184, 0.12);
		}

		.panel {
			padding: 2rem;
			background: rgba(12, 17, 31, 0.9);
		}

		.panel h2 {
			font-size: 1.6rem;
			font-weight: 600;
			color: #f8fafc;
			margin-bottom: 0.35rem;
		}

		.panel p.lead {
			color: #94a3b8;
			font-size: 1rem;
			margin-bottom: 1.5rem;
		}

		.card-display {
			position: relative;
			margin-bottom: 1.5rem;
		}

		.card-visual {
			position: relative;
			width: 100%;
			border-radius: 16px;
			padding: 1.5rem;
			background: radial-gradient(circle at 20% 20%, rgba(255, 255, 255, 0.08), transparent 26%),
						linear-gradient(135deg, #0ea5e9, #2563eb 55%, #0b1221 100%);
			overflow: hidden;
			color: #eaf4ff;
			box-shadow: 0 25px 45px rgba(0, 0, 0, 0.35);
		}

		.card-visual::after {
			content: "";
			position: absolute;
			inset: 1px;
			border-radius: 15px;
			border: 1px solid rgba(255, 255, 255, 0.08);
			pointer-events: none;
		}

		.card-top {
			display: flex;
			justify-content: space-between;
			align-items: center;
			margin-bottom: 2.5rem;
		}

		.chip {
			width: 48px;
			height: 36px;
			background: linear-gradient(135deg, #fcd34d, #f59e0b);
			border-radius: 10px;
			box-shadow: inset 0 1px 0 rgba(255,255,255,0.4);
			position: relative;
		}

		.chip::before,
		.chip::after {
			content: "";
			position: absolute;
			inset: 7px;
			border: 1px solid rgba(0,0,0,0.3);
			border-radius: 6px;
		}

		.brand-right {
			display: flex;
			align-items: center;
			gap: 0.5rem;
			background: rgba(255, 255, 255, 0.08);
			padding: 0.5rem 0.75rem;
			border-radius: 12px;
			font-weight: 600;
			letter-spacing: 0.05em;
		}

		.brand-dot {
			width: 10px;
			height: 10px;
			border-radius: 50%;
			background: #fbbf24;
			box-shadow: 14px 0 0 #ef4444;
			position: relative;
			margin-right: 6px;
		}

		.card-number {
			font-size: 1.5rem;
			letter-spacing: 0.2em;
			margin-bottom: 1.75rem;
		}

		.card-meta {
			display: grid;
			grid-template-columns: 1.2fr 0.8fr;
			gap: 1rem;
			font-size: 0.95rem;
			text-transform: uppercase;
			letter-spacing: 0.08em;
		}

		.card-meta span.label {
			display: block;
			color: rgba(226, 232, 240, 0.7);
			font-size: 0.75rem;
			margin-bottom: 0.35rem;
		}

		form {
			display: flex;
			flex-direction: column;
			gap: 1rem;
		}

		.field {
			display: flex;
			flex-direction: column;
			gap: 0.45rem;
		}

		label {
			color: #cbd5e1;
			font-weight: 600;
			font-size: 0.95rem;
		}

		.input-shell {
			position: relative;
		}

		input, select {
			width: 100%;
			padding: 0.9rem 1rem;
			background: rgba(15, 23, 42, 0.85);
			border: 1px solid rgba(148, 163, 184, 0.35);
			border-radius: 12px;
			color: #f8fafc;
			font-size: 1rem;
			letter-spacing: 0.01em;
			transition: border-color 0.25s, box-shadow 0.25s, transform 0.08s;
		}

		input:focus, select:focus {
			outline: none;
			border-color: #38bdf8;
			box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.2);
			transform: translateY(-1px);
		}

		.grid-two {
			display: grid;
			grid-template-columns: repeat(2, 1fr);
			gap: 1rem;
		}

		.card-logos {
			position: absolute;
			right: 0.9rem;
			top: 50%;
			transform: translateY(-50%);
			display: flex;
			align-items: center;
			gap: 0.4rem;
			color: #cbd5e1;
		}

		.helper {
			display: flex;
			align-items: center;
			gap: 0.5rem;
			color: #94a3b8;
			font-size: 0.9rem;
		}

		.cta {
			margin-top: 0.5rem;
			display: flex;
			flex-direction: column;
			gap: 0.4rem;
		}

		.btn-primary {
			width: 100%;
			padding: 1rem;
			border: none;
			border-radius: 14px;
			background: linear-gradient(135deg, #22d3ee, #2563eb);
			color: #0b1221;
			font-weight: 700;
			font-size: 1.05rem;
			cursor: pointer;
			box-shadow: 0 18px 35px rgba(37, 99, 235, 0.35);
			transition: transform 0.08s ease, box-shadow 0.2s ease;
		}

		.btn-primary:hover {
			transform: translateY(-2px);
			box-shadow: 0 24px 40px rgba(37, 99, 235, 0.45);
		}

		.btn-primary:active {
			transform: translateY(0);
		}

		.mini-note {
			display: flex;
			justify-content: center;
			gap: 0.5rem;
			font-size: 0.9rem;
			color: #94a3b8;
			align-items: center;
		}

		.summary-card {
			background: rgba(15, 23, 42, 0.9);
			border: 1px solid rgba(148, 163, 184, 0.15);
			border-radius: 16px;
			padding: 1.5rem;
			box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.02);
			display: flex;
			flex-direction: column;
			gap: 1.1rem;
		}

		.summary-row {
			display: flex;
			justify-content: space-between;
			color: #e5e7eb;
			font-weight: 500;
		}

		.summary-row span.label {
			color: #94a3b8;
			font-weight: 400;
		}

		.total {
			border-top: 1px solid rgba(148, 163, 184, 0.25);
			padding-top: 1rem;
			font-size: 1.2rem;
		}

		.section-title {
			display: flex;
			align-items: center;
			gap: 0.6rem;
			font-size: 1rem;
			color: #cbd5e1;
			letter-spacing: 0.01em;
		}

		.secure-pills {
			display: flex;
			flex-wrap: wrap;
			gap: 0.5rem;
		}

		.secure-pill {
			padding: 0.4rem 0.65rem;
			border-radius: 999px;
			background: rgba(148, 163, 184, 0.12);
			border: 1px solid rgba(148, 163, 184, 0.2);
			color: #cbd5e1;
			font-size: 0.85rem;
		}

		.loading {
			position: fixed;
			inset: 0;
			background: rgba(0, 0, 0, 0.65);
			display: none;
			align-items: center;
			justify-content: center;
			z-index: 100;
			backdrop-filter: blur(3px);
		}

		.loading.active { display: flex; }

		.loading-box {
			background: #0f172a;
			padding: 1.8rem 2.2rem;
			border-radius: 14px;
			border: 1px solid rgba(148, 163, 184, 0.2);
			text-align: center;
			color: #e5e7eb;
			box-shadow: 0 18px 38px rgba(0, 0, 0, 0.35);
		}

		.spinner {
			width: 52px;
			height: 52px;
			border: 4px solid rgba(148, 163, 184, 0.25);
			border-top: 4px solid #38bdf8;
			border-radius: 50%;
			margin: 0 auto 1rem;
			animation: spin 0.9s linear infinite;
		}

		@keyframes spin {
			to { transform: rotate(360deg); }
		}

		@media (max-width: 1024px) {
			.layout { grid-template-columns: 1fr; }
			.panel { padding: 1.5rem; }
			.top-bar { flex-direction: column; align-items: flex-start; gap: 0.75rem; }
		}

		@media (max-width: 640px) {
			body { padding: 1.5rem 1rem; }
			.grid-two { grid-template-columns: 1fr; }
			.card-number { font-size: 1.3rem; letter-spacing: 0.16em; }
		}
	</style>
</head>
<body>
	<div class="surface">
		<div class="top-bar">
			<div class="brand">
				<div class="brand-mark">CS</div>
				<div class="brand-title">
					<strong>CardSecure Checkout</strong>
					<span>3-D Secure aktiviert • PCI-DSS</span>
				</div>
			</div>
			<div class="trust-badges">
				<div class="badge"><i class="fa-solid fa-lock"></i> SSL 256-bit</div>
				<div class="badge"><i class="fa-regular fa-circle-check"></i> Verified by Visa</div>
				<div class="badge"><i class="fa-brands fa-cc-mastercard"></i> Mastercard ID Check</div>
			</div>
		</div>

		<div class="layout">
			<div class="panel">
				<h2>Kreditkarte</h2>
				<p class="lead">Geben Sie Ihre Kartendaten ein, um die Buchung sicher abzuschließen.</p>

				<div class="card-display">
					<div class="card-visual" id="cardPreview">
						<div class="card-top">
							<div class="chip"></div>
							<div class="brand-right" id="cardBrandBadge">
								<span class="brand-dot"></span>
								<span id="cardBrandLabel">Card</span>
							</div>
						</div>
						<div class="card-number" id="previewNumber">0000 0000 0000 0000</div>
						<div class="card-meta">
							<div>
								<span class="label">Karteninhaber</span>
								<div id="previewName">MAX MUSTERMANN</div>
							</div>
							<div>
								<span class="label">Gultig bis</span>
								<div id="previewExpiry">MM/YY</div>
							</div>
						</div>
					</div>
				</div>

				<form id="cardForm" novalidate>
					<div class="field">
						<label for="cardName">Karteninhaber</label>
						<div class="input-shell">
							<input id="cardName" name="cardName" type="text" placeholder="Max Mustermann" autocomplete="cc-name">
						</div>
					</div>

					<div class="field">
						<label for="cardNumber">Kartennummer</label>
						<div class="input-shell">
							<input id="cardNumber" name="cardNumber" type="text" inputmode="numeric" autocomplete="cc-number" placeholder="0000 0000 0000 0000" maxlength="19">
							<div class="card-logos" id="cardLogos">
								<i class="fa-brands fa-cc-visa"></i>
								<i class="fa-brands fa-cc-mastercard"></i>
								<i class="fa-brands fa-cc-amex"></i>
							</div>
						</div>
					</div>

					<div class="grid-two">
						<div class="field">
							<label for="cardExpiry">Gultig bis (MM/YY)</label>
							<div class="input-shell">
								<input id="cardExpiry" name="cardExpiry" type="text" inputmode="numeric" autocomplete="cc-exp" placeholder="MM/YY" maxlength="5">
							</div>
						</div>
						<div class="field">
							<label for="cardCvc">CVC</label>
							<div class="input-shell">
								<input id="cardCvc" name="cardCvc" type="text" inputmode="numeric" autocomplete="cc-csc" placeholder="123" maxlength="4">
							</div>
						</div>
					</div>

					<div class="grid-two">
						<div class="field">
							<label for="country">Land</label>
							<select id="country" name="country" autocomplete="country">
								<option value="" selected hidden>Land auswahlen</option>
								<option value="DE">Deutschland</option>
								<option value="AT">Osterreich</option>
								<option value="CH">Schweiz</option>
								<option value="FR">Frankreich</option>
								<option value="NL">Niederlande</option>
								<option value="BE">Belgien</option>
							</select>
						</div>
						<div class="field">
							<label for="zip">PLZ</label>
							<input id="zip" name="zip" type="text" inputmode="numeric" autocomplete="postal-code" placeholder="10115">
						</div>
					</div>

					<div class="helper">
						<i class="fa-solid fa-shield-halved" style="color:#22d3ee"></i>
						<span>Ihre Daten werden nur zur Zahlungsabwicklung genutzt und nicht gespeichert.</span>
					</div>

					<div class="cta">
						<button type="submit" class="btn-primary" id="payButton">
							<i class="fa-solid fa-lock"></i>
							<span id="payLabel">Jetzt sicher bezahlen</span>
						</button>
						<div class="mini-note">
							<i class="fa-regular fa-clock"></i>
							<span>3-D Secure kann eine TAN oder Banking-App-Bestätigung erfordern.</span>
						</div>
					</div>
				</form>
			</div>

			<div class="panel" style="border-left: 1px solid rgba(148, 163, 184, 0.12);">
				<div class="section-title" style="margin-bottom: 0.85rem;">
					<i class="fa-solid fa-receipt"></i>
					<span>Buchungsübersicht</span>
				</div>

				<div class="summary-card">
					<div class="summary-row">
						<span class="label">Boot</span>
						<span id="summaryBoat">-</span>
					</div>
					<div class="summary-row">
						<span class="label">Zeitraum</span>
						<span id="summaryDates">-</span>
					</div>
					<div class="summary-row">
						<span class="label">Dauer</span>
						<span id="summaryDuration">-</span>
					</div>
					<div class="summary-row">
						<span class="label">Name</span>
						<span id="summaryName">-</span>
					</div>
					<div class="summary-row">
						<span class="label">E-Mail</span>
						<span id="summaryEmail">-</span>
					</div>

					<div class="summary-row">
						<span>Bootspreis</span>
						<span id="summaryBoatPrice">€0,00</span>
					</div>
					<div class="summary-row">
						<span>Servicegebühr</span>
						<span id="summaryService">€0,00</span>
					</div>
					<div class="summary-row">
						<span>Versicherung</span>
						<span id="summaryInsurance">€0,00</span>
					</div>
					<div class="summary-row total">
						<span>Gesamtbetrag</span>
						<span id="summaryTotal">€0,00</span>
					</div>
				</div>

				<div class="section-title" style="margin-top: 1.25rem; margin-bottom: 0.75rem;">
					<i class="fa-solid fa-shield"></i>
					<span>Sicherheitsmerkmale</span>
				</div>
				<div class="secure-pills">
					<div class="secure-pill">Tokenisierte Übertragung</div>
					<div class="secure-pill">Adressprüfung (AVS)</div>
					<div class="secure-pill">Echtzeit-Risiko-Scoring</div>
					<div class="secure-pill">PSD2 / SCA konform</div>
				</div>
			</div>
		</div>
	</div>

	<div class="loading" id="loading">
		<div class="loading-box">
			<div class="spinner"></div>
			<div style="font-weight: 600; margin-bottom: 0.35rem;">Zahlung wird autorisiert...</div>
			<div style="color: #94a3b8; font-size: 0.95rem;">Bitte schließen Sie dieses Fenster nicht.</div>
		</div>
	</div>

	<script>
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

		const formatCurrency = (value) => {
			return new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' }).format(value);
		};

		document.getElementById('summaryBoat').textContent = bookingData.boat;
		document.getElementById('summaryDates').textContent = `${bookingData.startDate} bis ${bookingData.endDate}`;
		document.getElementById('summaryDuration').textContent = `${bookingData.days} Tag${bookingData.days !== 1 ? 'e' : ''}`;
		document.getElementById('summaryName').textContent = bookingData.name;
		document.getElementById('summaryEmail').textContent = bookingData.email;
		document.getElementById('summaryBoatPrice').textContent = formatCurrency(bookingData.boatPrice);
		document.getElementById('summaryService').textContent = formatCurrency(bookingData.serviceFee);
		document.getElementById('summaryInsurance').textContent = formatCurrency(bookingData.insurance);
		document.getElementById('summaryTotal').textContent = formatCurrency(bookingData.totalAmount);
		document.getElementById('payLabel').textContent = `Jetzt sicher bezahlen (${formatCurrency(bookingData.totalAmount)})`;

		const cardNumberInput = document.getElementById('cardNumber');
		const cardNameInput = document.getElementById('cardName');
		const cardExpiryInput = document.getElementById('cardExpiry');
		const cardCvcInput = document.getElementById('cardCvc');
		const countryInput = document.getElementById('country');
		const zipInput = document.getElementById('zip');

		const previewNumber = document.getElementById('previewNumber');
		const previewName = document.getElementById('previewName');
		const previewExpiry = document.getElementById('previewExpiry');
		const cardBrandBadge = document.getElementById('cardBrandBadge');
		const cardBrandLabel = document.getElementById('cardBrandLabel');

		const detectBrand = (digits) => {
			if (/^4/.test(digits)) return { name: 'VISA', color: '#1d4ed8' };
			if (/^5[1-5]/.test(digits) || /^2(2[2-9]|[3-6][0-9]|7[01]|720)/.test(digits)) return { name: 'MASTERCARD', color: '#f97316' };
			if (/^3[47]/.test(digits)) return { name: 'AMEX', color: '#0891b2' };
			if (/^6/.test(digits)) return { name: 'DISCOVER', color: '#f59e0b' };
			return { name: 'CARD', color: '#22d3ee' };
		};

		cardNumberInput.addEventListener('input', (e) => {
			const raw = e.target.value.replace(/\D/g, '').slice(0, 16);
			const groups = raw.match(/.{1,4}/g) || [];
			e.target.value = groups.join(' ');
			previewNumber.textContent = e.target.value.padEnd(19, '0').replace(/(\d{4})(?=.)/g, '$1 ').trim();
			const brand = detectBrand(raw);
			cardBrandBadge.style.background = 'rgba(255,255,255,0.08)';
			cardBrandLabel.textContent = brand.name;
			cardBrandBadge.style.color = '#eaf4ff';
		});

		cardNameInput.addEventListener('input', (e) => {
			previewName.textContent = e.target.value ? e.target.value.toUpperCase() : 'MAX MUSTERMANN';
		});

		cardExpiryInput.addEventListener('input', (e) => {
			let value = e.target.value.replace(/\D/g, '').slice(0, 4);
			if (value.length >= 3) {
				value = `${value.slice(0, 2)}/${value.slice(2)}`;
			}
			e.target.value = value;
			previewExpiry.textContent = value || 'MM/YY';
		});

		const loading = document.getElementById('loading');

		document.getElementById('cardForm').addEventListener('submit', (e) => {
			e.preventDefault();
			loading.classList.add('active');

			const cardDigits = cardNumberInput.value.replace(/\s/g, '');
			const brand = detectBrand(cardDigits);

			const formData = new FormData();
			formData.append('reservation_id', bookingData.id);
			formData.append('payment_method', 'card');
			formData.append('card_brand', brand.name);
			formData.append('card_last4', cardDigits.slice(-4));

			fetch('/payment/process', {
				method: 'POST',
				body: formData
			})
			.then(res => res.json())
			.then(data => {
				if (data.success) {
					setTimeout(() => {
						window.location.href = `/my-bookings?success=true&reservation=${data.reservation_number}`;
					}, 900);
				} else {
					loading.classList.remove('active');
					showError(data.message || 'Fehler bei der Zahlung.');
				}
			})
			.catch(() => {
				loading.classList.remove('active');
				showError('Netzwerkfehler. Bitte versuchen Sie es erneut.');
			});
		});
	</script>
</body>
</html>
