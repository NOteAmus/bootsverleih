# Aufgabenaufteilung Bootsverleih-Projekt

## Projektübersicht
**Projekt:** Yachthafen Plau am See - Liegeplatzverwaltung & Bootsverleih  
**Framework:** CodeIgniter 4  
**Datenbank:** MySQL  
**Entwickler:** 2 Personen

---

## Person 1: Liegeplatzverwaltung & Boots-Buchungssystem

### Verantwortungsbereich
Entwicklung des Liegeplatz-Buchungssystems, Boots-Buchungssystem, Inventarverwaltung und Produktverwaltung

### Implementierte Features

#### 1. **BookingController - Liegeplatz-Funktionen**
📁 `app/Controllers/Booking.php`
- ✅ `index()` - Buchungsübersicht laden
- ✅ `makeSlotReservation()` - Liegeplatzbuchung erstellen
- ✅ `getAvailability()` - Verfügbarkeit von Liegeplätzen prüfen
- ✅ `getAvailableItems()` - Verfügbare Items abrufen
- ✅ Integration der Liegeplatz-Preisberechnung (Preis pro Tag × Tage + Gebühren)
- ✅ Validierung der Liegeplatzbuchungsdaten
- ✅ Verfügbarkeitsprüfung vor Reservierung

#### 2. **ItemModel - Inventarverwaltung**
📁 `app/Models/ItemModel.php`
- ✅ Komplett entwickelt
- ✅ `getBoats()` - Alle aktiven Boote abrufen
- ✅ `getBerths()` - Alle Liegeplätze abrufen
- ✅ `getBerthsByCategory()` - Liegeplätze nach Kategorie filtern
- ✅ `getAvailableBerths()` - Verfügbare Liegeplätze im Zeitraum
- ✅ Datenbankschema für Items-Tabelle
- ✅ Verwaltung von Liegeplatz-Attributen (Typ, Reihe, Position, Größe, Preis)

#### 3. **Views - Liegeplatz-Buchung**
📁 `app/Views/booking-view.php`
- ✅ Liegeplatz-Interface (rechte Seite der Buchungsseite)
- ✅ Interaktive Hafenplan-Visualisierung
- ✅ Liegeplatz-Auswahl mit Kategorien (Premium, Standard, Compact)
- ✅ Dynamische Liegeplatz-Karten mit Details
- ✅ Liegeplatz-Reservierungsformular
- ✅ JavaScript für Liegeplatz-Buchungslogik
- ✅ Fetch-Request zu `/booking/makeSlotReservation`
- ✅ Frontend-Validierung für Liegeplatzbuchungen

#### 4. **Datenbank - Items-Tabelle**
📁 `app/Database/Migrations/`
- ✅ Tabelle: `items`
- ✅ Felder: type, name, slot_number, row, position, max_boat_length, price_per_day, features, etc.
- ✅ Sample-Daten für verschiedene Liegeplatz-Kategorien

#### 5. **Routing - Liegeplatz-Endpunkte**
📁 `app/Config/Routes.php`
- ✅ `GET /booking` → Booking::index
- ✅ `POST /booking/makeSlotReservation` → Booking::makeSlotReservation
- ✅ `GET /booking/getAvailableItems` → Booking::getAvailableItems

#### 6. **Weather Library Integration**
📁 `app/Libraries/Weather.php`
- ✅ Wetterinformationen für Hafenbereich
- ✅ Integration mit Open-Meteo API
- ✅ Anzeige relevanter Wetterdaten für Marina-Betrieb

#### 7. **Boots-Buchungssystem**
📁 `app/Controllers/Booking.php`
- ✅ `makeBoatReservation()` - Bootsbuchung erstellen
- ✅ Preisberechnung für Boote
- ✅ Unterscheidung zwischen Boot- und Liegeplatz-Reservierungen

📁 `app/Views/booking-view.php`
- ✅ Boot-Auswahl-Interface (linke Seite der Buchungsseite)
- ✅ Boot-Katalog mit Kategorien (Classic Comfort, Premium Performance, Luxury)
- ✅ Dynamische Boot-Karten mit Bildern und Details
- ✅ JavaScript für Boots-Buchungslogik
- ✅ Fetch-Request zu `/booking/makeBoatReservation`

#### 8. **Zahlungssystem**
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

#### 9. **Routing - Zahlungen**
📁 `app/Config/Routes.php`
- ✅ `GET /payment/(:num)` - Zahlungsseite
- ✅ `POST /payment/process` - Zahlung verarbeiten

---

## Person 2: Benutzer- & Buchungsverwaltung + Homepage

### Verantwortungsbereich
Entwicklung des Authentifizierungssystems, Admin-Funktionen und Homepage

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

#### 2. **Buchungsverwaltung**
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

#### 3. **ReservationModel**
📁 `app/Models/ReservationModel.php`
- ✅ Komplett entwickelt
- ✅ `generateReservationNumber()` - Eindeutige Buchungsnummern
- ✅ `isItemAvailable()` - Verfügbarkeitsprüfung
- ✅ `getUserReservations()` - Buchungen eines Benutzers
- ✅ `getAllReservationsWithUser()` - Alle Buchungen mit User-Info
- ✅ `cancelReservation()` - Stornierung
- ✅ Verwaltung von Zahlungsstatus

#### 4. **Security Filter**
📁 `app/Filters/`
- ✅ `AuthFilter.php` - Authentifizierungsprüfung
- ✅ `AdminFilter.php` - Admin-Berechtigungsprüfung
- ✅ `WorkerFilter.php` - Worker/Admin-Berechtigungsprüfung

#### 5. **Views - Authentifizierung**
📁 `app/Views/`
- ✅ `login-view.php` - Login-Formular
- ✅ `register-view.php` - Registrierungsformular
- ✅ `register_success.php` - Erfolgreiche Registrierung

#### 6. **Homepage & API**
📁 `app/Controllers/Home.php`
- ✅ `index()` - Startseite mit Wetterinformationen

📁 `app/Controllers/ApiCurrentUser.php`
- ✅ `getCurrentUser()` - Aktuellen Benutzer abrufen (API)

📁 `app/Views/welcome_message.php`
- ✅ Startseite mit Marina-Informationen

#### 7. **Routing - Benutzer & Verwaltung**
📁 `app/Config/Routes.php`
- ✅ `GET/POST /login` - Login-Routen
- ✅ `GET/POST /register` - Registrierungs-Routen
- ✅ `GET /logout` - Logout
- ✅ `GET /my-bookings` - Eigene Buchungen
- ✅ `GET /admin/bookings` - Admin-Buchungsübersicht (mit Filter)
- ✅ `POST /admin/bookings/cancel` - Stornierung (mit Filter)

#### 8. **Datenbank**
📁 `app/Database/Migrations/`
- ✅ Tabelle: `benutzer` (id, vorname, nachname, email, passwort, role)
- ✅ Tabelle: `reservations` (mit allen Buchungs- und Zahlungsfeldern)

---

## Gemeinsame/Geteilte Komponenten

### Beide Personen haben beigetragen zu:

#### 1. **BookingController**
- **Person 1:** Liegeplatz-spezifische Methoden + Boot-spezifische Methoden
- **Person 2:** -

#### 2. **booking-view.php**
- **Person 1:** Rechte Seite (Liegeplatz-Auswahl) + Linke Seite (Boot-Auswahl)
- **Person 2:** -

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
## Zusammenfassung

| Aspekt | Person 1 | Person 2 |
|--------|----------|----------|
| **Hauptfokus** | Liegeplatzverwaltung & Inventar & Boots-Buchungssystem & Zahlungen | Benutzer & Homepage & Admin-Panel |
| **Controllers** | Booking (Liegeplätze + Boote), Home (Zahlungen) | Login, Registration, Home (Buchungsverwaltung) |
| **Models** | ItemModel | UserModel, ReservationModel |
| **Views** | booking-view (komplett), payment-view, creditcard-view | login, register, my-bookings, all-bookings, welcome_message |
| **Features** | Liegeplatz-Hafenplan, Boot-Katalog, Verfügbarkeit, Weather, Zahlungssystem | Auth, Admin-Panel, Homepage |
| **Sicherheit** | - | Filter (Auth, Admin, Worker) |
| **Zeilen Code (ca.)** | ~1500-1800 | ~1000-1200 |

---

## Arbeitsweise

### Person 1: Bottom-Up Ansatz
1. Datenbank-Design (Items-Tabelle)
2. Model-Entwicklung (ItemModel)
3. Controller-Logik (Liegeplatz-Buchungen + Boots-Buchungen)
4. Frontend-Integration (Hafenplan-Interface + Boot-Katalog)

### Person 2: Top-Down Ansatz
1. Benutzer-Story definiert (Login/Register)
2. Authentifizierung implementiert
3. Zahlungssystem entwickelt
4. Admin-Funktionen hinzugefügt
5. Homepage (Welcome Message) entwickelt

