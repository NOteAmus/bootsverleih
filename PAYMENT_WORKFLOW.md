# Zahlungsworkflow - Implementierung

## Implementierte Änderungen

### 1. **Neuer Workflow**

#### Alter Flow:
- Reservierung → Direkt als "paid" gespeichert

#### Neuer Flow:
1. **Reservierung erstellen** → Status: `pending` in DB speichern
2. **Weiterleitung zur Payment-View** → Mit Reservierungs-ID
3. **Zahlung durchführen** → Status auf `paid` aktualisieren
4. **Bestätigung** → Weiterleitung zu "Meine Buchungen"

### 2. **Geänderte Dateien**

#### Booking Controller ([Booking.php](app/Controllers/Booking.php))
- `makeBoatReservation()`: Speichert Reservierung mit `payment_status = 'pending'`, gibt `redirect_url` zurück
- `makeSlotReservation()`: Speichert Reservierung mit `payment_status = 'pending'`, gibt `redirect_url` zurück  
- `index()`: Lädt Boote dynamisch aus der Datenbank

#### Home Controller ([Home.php](app/Controllers/Home.php))
- `payment($reservationId)`: Lädt Reservierung aus DB und zeigt Payment-View
- `processPayment()`: Aktualisiert `payment_status` auf `'paid'` statt neue Reservierung zu erstellen

#### Routes ([Routes.php](app/Config/Routes.php))
- Neue Routes für Booking-API:
  - `POST /booking/makeBoatReservation`
  - `POST /booking/makeSlotReservation`
  - `GET /booking/getAvailableItems`
- Geänderte Payment-Route: `GET /payment/(:num)` (mit Reservierungs-ID)

#### Payment View ([payment-view.php](app/Views/payment-view.php))
- Lädt Reservierungsdaten aus PHP-Variable statt URL-Parametern
- Sendet nur `reservation_id` und `payment_method` beim Payment
- Leitet nach erfolgreicher Zahlung zu "Meine Buchungen" weiter

#### Booking View ([booking-view.php](app/Views/booking-view.php))
- Boot-Formular: Sendet Daten per API an `/booking/makeBoatReservation`
- Liegeplatz-Formular: Sendet Daten per API an `/booking/makeSlotReservation`
- Beide leiten zur Payment-View weiter bei Erfolg
- Boot-Dropdown wird dynamisch aus DB generiert

### 3. **Datenfluss**

```
┌─────────────────┐
│  Booking View   │
│  Formular aus-  │
│  füllen         │
└────────┬────────┘
         │ POST /booking/makeBoatReservation
         │ oder makeSlotReservation
         ▼
┌─────────────────┐
│  API Endpoint   │
│  - Verfügbarkeit│
│    prüfen       │
│  - In DB spei-  │
│    chern (pen-  │
│    ding)        │
│  - Redirect URL │
│    zurückgeben  │
└────────┬────────┘
         │ Redirect
         ▼
┌─────────────────┐
│  Payment View   │
│  - Daten aus DB │
│    laden        │
│  - Payment-Me-  │
│    thode wählen │
└────────┬────────┘
         │ POST /payment/process
         │ {reservation_id, payment_method}
         ▼
┌─────────────────┐
│  Payment API    │
│  - Status auf   │
│    'paid' up-   │
│    daten        │
└────────┬────────┘
         │ Redirect
         ▼
┌─────────────────┐
│  My Bookings    │
│  Bestätigung    │
└─────────────────┘
```

### 4. **Vorteile des neuen Systems**

✅ **Datenkonsistenz**: Alle Daten in der Datenbank, nicht in URL-Parametern  
✅ **Sicherheit**: Keine sensiblen Daten in der URL  
✅ **Verfolgbarkeit**: Reservierungen können auch bei abgebrochenem Zahlungsvorgang nachverfolgt werden  
✅ **Flexibilität**: Reservierungen können später bezahlt werden  
✅ **Wiederverwendbarkeit**: Payment-View funktioniert für Boote und Liegeplätze

### 5. **Datenbank-Status**

| Status | Bedeutung |
|--------|-----------|
| `pending` | Reservierung erstellt, Zahlung steht aus |
| `paid` | Reservierung bezahlt, aktiv |
| `cancelled` | Reservierung storniert |

### 6. **Nächste Schritte (Optional)**

- [ ] E-Mail-Benachrichtigungen bei Reservierung und Zahlung
- [ ] Abbrechen von pending Reservierungen nach X Minuten
- [ ] Admin-Panel zum Verwalten von pending Reservierungen
- [ ] Mehrere Zahlungsmethoden (Stripe, Sofortüberweisung, etc.)
