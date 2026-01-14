# Bootsverleih & Liegeplatzverwaltung - Upgrade

## Neue Funktionen

Das System wurde erweitert, um sowohl Boote als auch Liegeplätze zu verwalten.

## Implementierte Änderungen

### 1. Datenbank-Migrationen

#### Migration 1: AddReservationTypeToReservations
Fügt der `reservations` Tabelle zwei neue Felder hinzu:
- `reservation_type`: ENUM ('boot', 'liegeplatz') - Unterscheidet zwischen Boot- und Liegeplatz-Reservierungen
- `item_id`: INT - Referenz zum reservierten Item (Boot oder Liegeplatz)

#### Migration 2: CreateItemsTable
Erstellt eine neue `items` Tabelle für Boote und Liegeplätze:
- Gemeinsame Felder: type, name, description, category, price_per_day, features, image, is_active
- Boot-spezifische Felder: boat_type, length, year, capacity
- Liegeplatz-spezifische Felder: slot_number, row, position, max_boat_length

### 2. Neue Models

#### ItemModel
Verwaltet Boote und Liegeplätze:
- `getBoats()` - Alle aktiven Boote abrufen
- `getBerths()` - Alle aktiven Liegeplätze abrufen
- `checkAvailability()` - Verfügbarkeit für einen Zeitraum prüfen
- `getAvailableItems()` - Verfügbare Items für einen Zeitraum abrufen
- `getBoatsByCategory()` - Boote nach Kategorie filtern
- `getBerthsByRow()` - Liegeplätze nach Reihe filtern

#### ReservationModel (erweitert)
Neue Methoden:
- `generateReservationNumber($type)` - Generiert unterschiedliche Nummern (BOAT- oder BERTH-)
- `getBoatReservations()` - Nur Boot-Reservierungen abrufen
- `getBerthReservations()` - Nur Liegeplatz-Reservierungen abrufen
- `getReservationsByType()` - Reservierungen nach Typ filtern
- `getItemReservations()` - Alle Reservierungen eines Items
- `isItemAvailable()` - Prüft Item-Verfügbarkeit für einen Zeitraum

### 3. Controller-Erweiterungen

#### Booking Controller
Neue/erweiterte Methoden:
- `makeBoatReservation()` - Erstellt echte Boot-Reservierungen mit:
  - Verfügbarkeitsprüfung
  - Preisberechnung (Boot + Service + Versicherung)
  - Datenbank-Speicherung
  
- `makeSlotReservation()` - Erstellt echte Liegeplatz-Reservierungen mit:
  - Verfügbarkeitsprüfung
  - Preisberechnung (Liegeplatz + Service, keine Versicherung)
  - Datenbank-Speicherung

- `getAvailableItems()` - API-Endpunkt für verfügbare Items nach Typ und Datum

### 4. Seeder

#### ItemsSeeder
Füllt die Datenbank mit Beispieldaten:
- 6 Boote (verschiedene Kategorien: Premium, Comfort, Standard, Economy)
- 32 Liegeplätze in 4 Reihen (A-D) mit verschiedenen Kategorien

## Installation & Verwendung

### Migrationen ausführen:
```bash
php spark migrate
```

### Seeder ausführen:
```bash
php spark db:seed ItemsSeeder
```

## API-Endpunkte

### Verfügbare Items abrufen
```
GET /booking/getAvailableItems?type=boot&start_date=2026-01-15&end_date=2026-01-20
GET /booking/getAvailableItems?type=liegeplatz&start_date=2026-01-15&end_date=2026-01-20
```

### Boot reservieren
```
POST /booking/makeBoatReservation
{
  "item_id": 1,
  "customer_name": "Max Mustermann",
  "customer_email": "max@example.com",
  "customer_phone": "+49 123 456789",
  "start_date": "2026-01-15",
  "end_date": "2026-01-20",
  "payment_method": "paypal",
  "additional_equipment": "GPS, Angelausrüstung",
  "experience_level": "Fortgeschritten"
}
```

### Liegeplatz reservieren
```
POST /booking/makeSlotReservation
{
  "item_id": 7,
  "customer_name": "Max Mustermann",
  "customer_email": "max@example.com",
  "customer_phone": "+49 123 456789",
  "start_date": "2026-01-15",
  "end_date": "2026-01-20",
  "payment_method": "paypal"
}
```

## Datenstruktur

### Reservierung (reservation_type)
- **boot**: Boot-Reservierung
  - Enthält Versicherung (35€)
  - Service-Gebühr: 25€
  - Prefix: BOAT-YYYYMMDD-XXXXXX

- **liegeplatz**: Liegeplatz-Reservierung
  - Keine Versicherung
  - Service-Gebühr: 10€
  - Prefix: BERTH-YYYYMMDD-XXXXXX

### Item-Kategorien
- **Premium**: Höchste Ausstattung
- **Comfort**: Gehobene Ausstattung
- **Standard**: Basis-Ausstattung
- **Economy**: Preisgünstig

## Unterschiede zwischen Boot und Liegeplatz

| Merkmal | Boot | Liegeplatz |
|---------|------|------------|
| Versicherung | Ja (35€) | Nein |
| Service-Gebühr | 25€ | 10€ |
| Spezifische Felder | boat_type, capacity, year | slot_number, row, max_boat_length |
| Reservierungsnummer | BOAT-* | BERTH-* |

## Nächste Schritte (Optional)

- Frontend-Views für Liegeplatz-Reservierung erstellen
- Admin-Interface für Items-Verwaltung
- Kalender-Ansicht für Verfügbarkeit
- E-Mail-Benachrichtigungen für Liegeplatz-Reservierungen
- Automatische Preisanpassung nach Saison
