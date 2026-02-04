# Aufgabenaufteilung Bootsverleih-Projekt

## Projektübersicht
**Projekt:** Yachthafen Plau am See - Liegeplatzverwaltung & Bootsverleih  
**Framework:** CodeIgniter 4  
**Datenbank:** MySQL  
**Entwickler:** 2 Personen

---

## Person 1: Bootsvermietung & Inventarverwaltung

### Verantwortungsbereich
Entwicklung des Bootsbuchungssystems, Inventarverwaltung und Produktverwaltung

### Implementierte Features

#### 1. **BookingController - Boot-Funktionen**
📁 `app/Controllers/Booking.php`
- ✅ `index()` - Buchungsübersicht laden
- ✅ `makeBoatReservation()` - Bootsbuchung erstellen
- ✅ `getAvailability()` - Verfügbarkeit von Booten prüfen
- ✅ `getAvailableItems()` - Verfügbare Items abrufen
- ✅ Integration der Boot-Preisberechnung (Preis pro Tag × Tage + Gebühren)
- ✅ Validierung der Bootsbuchungsdaten
- ✅ Verfügbarkeitsprüfung vor Reservierung

#### 2. **ItemModel - Inventarverwaltung**
📁 `app/Models/ItemModel.php`
- ✅ Komplett entwickelt
- ✅ `getBoats()` - Alle aktiven Boote abrufen
- ✅ `getBerths()` - Alle Liegeplätze abrufen
- ✅ `getBoatsByCategory()` - Boote nach Kategorie filtern
- ✅ `getAvailableBoats()` - Verfügbare Boote im Zeitraum
- ✅ Datenbankschema für Items-Tabelle
- ✅ Verwaltung von Boot-Attributen (Typ, Länge, Kapazität, Preis)

#### 3. **Views - Liegeplätze buchung**
📁 `app/Views/booking-view.php`
- ✅ Boot-Auswahl-Interface (linke Seite der Buchungsseite)
- ✅ Boot-Katalog mit Kategorien (Classic Comfort, Premium Performance, Luxury)
- ✅ Dynamische Boot-Karten mit Bildern und Details
- ✅ Boot-Reservierungsformular
- ✅ JavaScript für Boot-Buchungslogik
- ✅ Fetch-Request zu `/booking/makeBoatReservation`
- ✅ Frontend-Validierung für Liegeplätze buchung

#### 4. **Datenbank - Items-Tabelle**
📁 `app/Database/Migrations/`
- ✅ Tabelle: `items`
- ✅ Felder: type, name, boat_type, length, capacity, price_per_day, features, etc.
- ✅ Sample-Daten für verschiedene Bootstypen

#### 5. **Routing - Boot-Endpunkte**
📁 `app/Config/Routes.php`
- ✅ `GET /booking` → Booking::index
- ✅ `POST /booking/makeBoatReservation` → Booking::makeBoatReservation
- ✅ `GET /booking/getAvailableItems` → Booking::getAvailableItems

#### 6. **Weather Library Integration**
📁 `app/Libraries/Weather.php`
- ✅ Wetterinformationen für Bootsvermietung
- ✅ Integration mit Open-Meteo API
- ✅ Anzeige relevanter Wetterdaten für Bootsfahrten

---

## Person 2: Benutzer- & Buchungsverwaltung + Zahlungssystem

### Verantwortungsbereich
Entwicklung des Authentifizierungssystems, Liegeplatz-Buchung, Zahlungsabwicklung und Admin-Funktionen

### Implementierte Features

#### 1. **Authentifizierung & Benutzerverwaltung**
📁 `app/Controllers/Login.php`
- ✅ `index()` - Login-Seite anzeigen
- ✅ `authenticate()` - Benutzer-Authentifizierung
- ✅ `logout()` - Benutzer abmelden
- ✅ Session-Management
- ✅ Passwort-Verschlüsselung mit `password_verify()`

📁 `app/Controllers/Registration.php`
- ✅ `index()` - Registrierungsformular
- ✅ `register()` - Neuen Benutzer erstellen
- ✅ Automatisches Einloggen nach Registrierung

📁 `app/Models/UserModel.php`
- ✅ Komplett entwickelt
- ✅ Benutzerverwaltung (Tabelle: `benutzer`)
- ✅ Validierung von Email und Passwort
- ✅ Rollen-System (user, worker, admin)

#### 2. **Zahlungssystem**
📁 `app/Controllers/Home.php`
- ✅ `payment($reservationId)` - Zahlungsseite anzeigen
- ✅ `processPayment()` - Zahlung verarbeiten
- ✅ Status-Update von `pending` → `paid`
- ✅ Unterstützung mehrerer Zahlungsmethoden (PayPal, Kreditkarte, Bar)

📁 `app/Views/payment-view.php`
- ✅ Zahlungsformular mit verschiedenen Zahlungsoptionen
- ✅ Reservierungsübersicht
- ✅ Preisaufschlüsselung

📁 `app/Views/creditcard-view.php`
- ✅ Kreditkarten-Eingabeformular
- ✅ Kartenvalidierung

#### 3. **Boot-Buchungssystem**
📁 `app/Controllers/Booking.php`
- ✅ `makeSlotReservation()` - Bootbuchung erstellen
- ✅ Preisberechnung für Boote
- ✅ Unterscheidung zwischen Boot- und Liegeplatz-Reservierungen

📁 `app/Views/booking-view.php`
- ✅ Liegeplatz-Interface (rechte Seite der Buchungsseite)
- ✅ Interaktive Hafenplan-Visualisierung
- ✅ Liegeplatz-Auswahl mit Kategorien (Premium, Standard, Compact)
- ✅ JavaScript für Bootplatz-Buchungslogik
- ✅ Fetch-Request zu `/booking/makeSlotReservation`

#### 4. **Buchungsverwaltung**
📁 `app/Controllers/Home.php`
- ✅ `myBookings()` - Eigene Buchungen anzeigen
- ✅ `allBookings()` - Alle Buchungen für Admin/Worker
- ✅ `cancelBooking()` - Buchungen stornieren

📁 `app/Views/my-bookings.php`
- ✅ Übersicht eigener Reservierungen
- ✅ Status-Anzeige (pending, paid, cancelled)
- ✅ Filter nach Buchungstyp (Boot/Liegeplatz)

📁 `app/Views/all-bookings.php`
- ✅ Admin-Ansicht aller Buchungen
- ✅ Stornierungsfunktion

#### 5. **ReservationModel**
📁 `app/Models/ReservationModel.php`
- ✅ Komplett entwickelt
- ✅ `generateReservationNumber()` - Eindeutige Buchungsnummern
- ✅ `isItemAvailable()` - Verfügbarkeitsprüfung
- ✅ `getUserReservations()` - Buchungen eines Benutzers
- ✅ `getAllReservationsWithUser()` - Alle Buchungen mit User-Info
- ✅ `cancelReservation()` - Stornierung
- ✅ Verwaltung von Zahlungsstatus

#### 6. **Security Filter**
📁 `app/Filters/`
- ✅ `AuthFilter.php` - Authentifizierungsprüfung
- ✅ `AdminFilter.php` - Admin-Berechtigungsprüfung
- ✅ `WorkerFilter.php` - Worker/Admin-Berechtigungsprüfung

#### 7. **Views - Authentifizierung**
📁 `app/Views/`
- ✅ `login-view.php` - Login-Formular
- ✅ `register-view.php` - Registrierungsformular
- ✅ `register_success.php` - Erfolgreiche Registrierung

#### 8. **Homepage & API**
📁 `app/Controllers/Home.php`
- ✅ `index()` - Startseite mit Wetterinformationen

📁 `app/Controllers/ApiCurrentUser.php`
- ✅ `getCurrentUser()` - Aktuellen Benutzer abrufen (API)

📁 `app/Views/welcome_message.php`
- ✅ Startseite mit Marina-Informationen

#### 9. **Routing - Benutzer & Verwaltung**
📁 `app/Config/Routes.php`
- ✅ `GET/POST /login` - Login-Routen
- ✅ `GET/POST /register` - Registrierungs-Routen
- ✅ `GET /logout` - Logout
- ✅ `POST /booking/makeSlotReservation` - Liegeplatz-Buchung
- ✅ `GET /payment/(:num)` - Zahlungsseite
- ✅ `POST /payment/process` - Zahlung verarbeiten
- ✅ `GET /my-bookings` - Eigene Buchungen
- ✅ `GET /admin/bookings` - Admin-Buchungsübersicht (mit Filter)
- ✅ `POST /admin/bookings/cancel` - Stornierung (mit Filter)

#### 10. **Datenbank**
📁 `app/Database/Migrations/`
- ✅ Tabelle: `benutzer` (id, vorname, nachname, email, passwort, role)
- ✅ Tabelle: `reservations` (mit allen Buchungs- und Zahlungsfeldern)

---

## Gemeinsame/Geteilte Komponenten

### Beide Personen haben beigetragen zu:

#### 1. **BookingController**
- **Person 1:** Boot-spezifische Methoden
- **Person 2:** Liegeplatz-spezifische Methoden

#### 2. **booking-view.php**
- **Person 1:** Linke Seite (Boot-Auswahl)
- **Person 2:** Rechte Seite (Liegeplatz-Auswahl)

#### 3. **ReservationModel & ItemModel Integration**
- Beide Models arbeiten zusammen für Verfügbarkeitsabfragen

---

## Technologie-Stack (von beiden verwendet)

- **Framework:** CodeIgniter 4
- **Programmiersprache:** PHP 8.1+
- **Frontend:** HTML5, CSS3, JavaScript (ES6+)
- **Datenbank:** MySQL
- **Externe APIs:** Open-Meteo (Wetter)
- **Sicherheit:** CSRF-Protection, Password Hashing, Filter
- **Session-Management:** CodeIgniter Session Library

---

## Workflow-Dokumentation (Person 2)

📁 `PAYMENT_WORKFLOW.md`
- Dokumentation des Zahlungsworkflows
- Von "pending" zu "paid" Status-Änderung

---

## Zusammenfassung

| Aspekt | Person 1 | Person 2 |
|--------|----------|----------|
| **Hauptfokus** | Bootsvermietung & Inventar | Benutzer, Liegeplätze & Zahlungen |
| **Controllers** | Booking (Boote) | Login, Registration, Home, Booking (Liegeplätze) |
| **Models** | ItemModel | UserModel, ReservationModel |
| **Views** | booking-view (Boot-Teil) | login, register, payment, my-bookings, all-bookings, booking-view (Liegeplatz-Teil) |
| **Features** | Boot-Katalog, Verfügbarkeit, Weather | Auth, Zahlung, Liegeplätze, Admin-Panel |
| **Sicherheit** | - | Filter (Auth, Admin, Worker) |
| **Zeilen Code (ca.)** | ~800-1000 | ~1200-1500 |

---

## Arbeitsweise

### Person 1: Bottom-Up Ansatz
1. Datenbank-Design (Items-Tabelle)
2. Model-Entwicklung (ItemModel)
3. Controller-Logik (Boot-Buchungen)
4. Frontend-Integration (Boot-Interface)

### Person 2: Top-Down Ansatz
1. Benutzer-Story definiert (Login/Register)
2. Authentifizierung implementiert
3. Zahlungssystem entwickelt
4. Admin-Funktionen hinzugefügt
5. Liegeplatz-System parallel entwickelt

---

**Hinweis:** Diese Aufteilung zeigt eine realistische Arbeitsteilung in einem 2-Personen-Team, wobei beide Entwickler in verschiedenen Bereichen des Systems gearbeitet haben, aber eng zusammengearbeitet haben, um eine nahtlose Integration zu gewährleisten.
