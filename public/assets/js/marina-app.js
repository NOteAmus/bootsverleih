const { createApp } = Vue;

createApp({
    data() {
        return {
            activeTab: 'slots',

            // Neue Datenstruktur für Raster-System
            gridSlots: APP_DATA.slots || [],
            boatsInWater: APP_DATA.boats || [],
            boatsList: APP_DATA.boats_list || [],

            // Zustände
            draggedBoat: null,
            dragOverId: null,
            selectedSlotId: null,
            selectedBoatId: null,

            // Formular
            formData: {
                name: '',
                email: '',
                start_date: '',
                end_date: '',
                notes: '',
                customer_phone: '',
                payment_method: 'paypal'
            }
        };
    },

    computed: {
        selectedSlotInfo() {
            if (!this.selectedSlotId) return 'Kein Platz ausgewählt';
            const slot = this.gridSlots.find(s => s.id === this.selectedSlotId);
            if (!slot) return 'Platz nicht gefunden';

            const statusMap = {
                'available': 'Frei',
                'booked': 'Gebucht',
                'occupied': 'Belegt'
            };

            return `Platz ${slot.slot_number || slot.id} - ${statusMap[slot.status] || 'Unbekannt'}`;
        },

        selectedBoatInfo() {
            if (!this.selectedBoatId) return 'Kein Boot ausgewählt';
            const boat = this.boatsInWater.find(b => b.id === this.selectedBoatId);
            if (!boat) return 'Boot nicht gefunden';

            return `${boat.name} (${boat.length}m, ${boat.type})`;
        },

        canSubmitBooking() {
            return this.selectedSlotId &&
                this.selectedBoatId &&
                this.formData.name &&
                this.formData.email &&
                this.formData.start_date &&
                this.formData.end_date;
        }
    },

    methods: {
        // Positionierung im Raster
        getGridSlotStyle(slot) {
            const rowIndex = slot.row ? slot.row.charCodeAt(0) - 65 : 0;
            const colIndex = slot.col ? slot.col - 1 : slot.position ? slot.position - 1 : 0;

            const cellSize = 70;
            const padding = 10;
            const startX = 50;
            const startY = 120;

            const left = startX + (colIndex * (cellSize + padding));
            const top = startY + (rowIndex * (cellSize + padding));

            return {
                top: `${top}px`,
                left: `${left}px`,
                width: `${cellSize}px`,
                height: `${cellSize}px`
            };
        },

        getBoatStyle(boat) {
            return {
                top: `${boat.top || 300}px`,
                left: `${boat.left || 30}%`,
                background: this.getBoatColor(boat.category)
            };
        },

        getBoatColor(category) {
            const colors = {
                premium: 'linear-gradient(135deg, #2c3e50 0%, #34495e 100%)',
                comfort: 'linear-gradient(135deg, #3498db 0%, #2980b9 100%)',
                standard: 'linear-gradient(135deg, #1abc9c 0%, #16a085 100%)',
                economy: 'linear-gradient(135deg, #95a5a6 0%, #7f8c8d 100%)'
            };
            return colors[category] || colors.standard;
        },

        // Drag & Drop
        onDragStart(event, boat) {
            this.draggedBoat = boat;
            this.selectedBoatId = boat.id;
            event.dataTransfer.setData('text/plain', boat.id);
            event.dataTransfer.effectAllowed = 'move';
            event.target.classList.add('dragging');
        },

        onDragEnd() {
            this.draggedBoat = null;
            document.querySelectorAll('.dragging').forEach(el => el.classList.remove('dragging'));
        },

        onDragOver(slotId) {
            const slot = this.gridSlots.find(s => s.id === slotId);
            if (slot && slot.status === 'available') {
                this.dragOverId = slotId;
                return true;
            }
            return false;
        },

        onDrop(slot) {
            if (!this.draggedBoat || slot.status !== 'available') {
                this.dragOverId = null;
                return;
            }

            // Client-seitige Aktualisierung
            slot.status = 'booked';
            slot.boatName = this.draggedBoat.name;

            // Auswahl setzen
            this.selectedSlotId = slot.id;

            // Boot aus See entfernen
            this.boatsInWater = this.boatsInWater.filter(b => b.id !== this.draggedBoat.id);

            this.draggedBoat = null;
            this.dragOverId = null;

            alert(`Boot "${slot.boatName}" auf Platz ${slot.slot_number || slot.id} gebucht!`);
        },

        // Slot per Klick auswählen
        selectSlot(slot) {
            if (slot.status === 'available') {
                this.selectedSlotId = slot.id;

                // Automatisch ein Boot auswählen, falls keins ausgewählt ist
                if (!this.selectedBoatId && this.boatsInWater.length > 0) {
                    this.selectedBoatId = this.boatsInWater[0].id;
                }
            }
        },

        // Boot für Verleih auswählen
        selectBoatForRental(boat) {
            this.selectedBoatId = boat.id;
            this.activeTab = 'slots';
            alert(`Boot "${boat.name}" wurde für die Buchung ausgewählt.`);
        },

        // Buchung an Server senden
        async submitBooking() {
            if (!this.canSubmitBooking) {
                alert('Bitte füllen Sie alle erforderlichen Felder aus.');
                return;
            }

            const slot = this.gridSlots.find(s => s.id === this.selectedSlotId);
            const boat = this.boatsInWater.find(b => b.id === this.selectedBoatId);

            if (!slot || !boat) {
                alert('Fehler: Slot oder Boot nicht gefunden.');
                return;
            }

            const bookingData = {
                slot_id: slot.id,
                boat_id: boat.id,
                boat_name: boat.name,
                ...this.formData
            };

            try {
                const response = await fetch('/booking/bookSlot', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify(bookingData)
                });

                const result = await response.json();

                if (result.success) {
                    alert('Buchung erfolgreich! ' + result.message);
                    // Formular zurücksetzen
                    this.resetForm();
                } else {
                    alert('Fehler: ' + (result.message || 'Unbekannter Fehler'));
                }
            } catch (error) {
                alert('Netzwerkfehler: ' + error.message);
            }
        },

        // Hilfsfunktionen
        resetForm() {
            this.formData = {
                name: '',
                email: '',
                start_date: '',
                end_date: '',
                notes: '',
                customer_phone: '',
                payment_method: 'paypal'
            };
            this.selectedSlotId = null;
            this.selectedBoatId = null;
        },

        async simulateRandomBooking() {
            try {
                const response = await fetch('/booking/simulateBooking', {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                const result = await response.json();
                alert(result.message || 'Zufällige Buchung durchgeführt');
                // Seite neu laden für Aktualisierung
                location.reload();
            } catch (error) {
                alert('Fehler: ' + error.message);
            }
        },

        async resetAllBookings() {
            if (!confirm('Alle Buchungen zurücksetzen? Dies kann nicht rückgängig gemacht werden.')) {
                return;
            }

            try {
                const response = await fetch('/booking/resetBookings', {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                const result = await response.json();
                alert(result.message);
                location.reload();
            } catch (error) {
                alert('Fehler: ' + error.message);
            }
        },

        async showAllBookings() {
            try {
                const response = await fetch('/booking/getAllBookings', {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                const result = await response.json();

                if (result.success && result.bookings.length > 0) {
                    const bookingList = result.bookings.map(b =>
                        `• ${b.reservation_number}: ${b.customer_name} (${b.start_date} - ${b.end_date})`
                    ).join('\n');

                    alert(`Aktuelle Buchungen:\n\n${bookingList}`);
                } else {
                    alert('Keine Buchungen vorhanden.');
                }
            } catch (error) {
                alert('Fehler beim Laden der Buchungen: ' + error.message);
            }
        }
    },

    mounted() {
        // Heutiges Datum setzen
        const today = new Date().toISOString().split('T')[0];
        const tomorrow = new Date(Date.now() + 86400000).toISOString().split('T')[0];

        this.formData.start_date = today;
        this.formData.end_date = tomorrow;
    }
}).mount('#app');