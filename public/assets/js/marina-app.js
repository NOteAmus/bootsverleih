const { createApp } = Vue;

createApp({
    data() {
        return {
            activeTab: 'slots',

            // Slots initialisieren
            slots: INITIAL_SLOTS.map(s => ({
                ...s,
                isOccupied: [2, 5, 8].includes(parseInt(s.id)), // Nur Demo: Markiert ein paar als belegt
                boatName: [2, 5, 8].includes(parseInt(s.id)) ? 'Belegt' : ''
            })),

            // Boote im Wasser mit zufälligen Positionen für den "See-Look"
            boatsInWater: INITIAL_BOATS.slice(0, 4).map(b => ({
                id: b.id,
                name: b.name,
                style: {
                    top: Math.floor(Math.random() * 150 + 350) + 'px', // Im unteren Bereich des Sees
                    left: Math.floor(Math.random() * 60 + 10) + '%'
                }
            })),

            boats: INITIAL_BOATS, // Für die Liste im Bootsverleih-Tab
            draggedBoat: null,
            dragOverId: null,
            selectedSlotId: null,

            // Formular
            formData: {
                name: '',
                email: '',
                start_date: '',
                end_date: ''
            }
        }
    },
    computed: {
        // Berechnet den Namen des ausgewählten Slots für das Readonly-Feld
        selectedSlotName() {
            const slot = this.slots.find(s => s.id === this.selectedSlotId);
            return slot ? `Steg ${slot.row} - Platz ${slot.slot_number}` : '';
        }
    },
    methods: {
        // Berechnet die exakte Position auf der Karte
        getSlotStyle(slot) {
            const rowPositions = { 'A': '16%', 'B': '31%', 'C': '46%', 'D': '61%', 'E': '76%' };
            const topPos = 95 + (slot.position - 1) * 45;
            return {
                top: topPos + 'px',
                left: rowPositions[slot.row] || '16%'
            };
        },

        // Drag & Drop Logik
        onDragStart(event, boat) {
            this.draggedBoat = boat;
            event.dataTransfer.effectAllowed = "move";
        },

        onDragOver(slotId) {
            const slot = this.slots.find(s => s.id === slotId);
            if (slot && !slot.isOccupied) {
                this.dragOverId = slotId;
            }
        },

        onDrop(slot) {
            this.dragOverId = null;
            if (slot.isOccupied || !this.draggedBoat) return;

            // Boot "einrasten" lassen
            slot.isOccupied = true;
            slot.boatName = this.draggedBoat.name;

            // Aus dem See entfernen
            this.boatsInWater = this.boatsInWater.filter(b => b.id !== this.draggedBoat.id);

            // Automatisch auswählen
            this.selectSlot(slot);

            this.draggedBoat = null;
        },

        // Auswahl per Klick (Alternative zu Drag&Drop)
        selectSlot(slot) {
            if (!slot.isOccupied) {
                this.selectedSlotId = slot.id;
            }
        },

        // Bootsverleih Auswahl
        selectBoatForRental(boat) {
            alert(`Boot "${boat.name}" wurde ausgewählt. Das Formular wird nun vorbereitet.`);
            // Hier könnte man zum Buchungsformular scrollen
        },

        // Formular absenden
        async submitSlotBooking() {
            if (!this.selectedSlotId) {
                alert("Bitte wählen Sie zuerst einen Liegeplatz aus!");
                return;
            }

            const payload = {
                ...this.formData,
                slot_id: this.selectedSlotId
            };

            console.log("Sende Buchung:", payload);
            alert("Vielen Dank! Ihre Anfrage für " + this.selectedSlotName + " wurde gesendet.");
        }
    }
}).mount('#app');