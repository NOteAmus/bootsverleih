/* app.js
 * Vue 3 App:
 * - Filter/Suche
 * - Drag & Drop + Klick-Auswahl
 * - Validierung (E-Mail, Datum, Status)
 * - Preisvorschau
 * - Toasts statt alert()
 * - Optional API Submit (APP_CONFIG.saveBookingUrl)
 */

const { createApp } = Vue;

function uid() {
    return Math.random().toString(16).slice(2) + Date.now().toString(16);
}

function parseISODate(d) {
    // returns Date at 00:00 local
    if (!d) return null;
    const [y, m, day] = String(d).split("-").map(Number);
    if (!y || !m || !day) return null;
    return new Date(y, m - 1, day, 0, 0, 0, 0);
}

function daysBetweenInclusive(startISO, endISO) {
    const s = parseISODate(startISO);
    const e = parseISODate(endISO);
    if (!s || !e) return 0;
    const ms = e.getTime() - s.getTime();
    const days = Math.round(ms / 86400000);
    return Math.max(0, days);
}

function isEmail(v) {
    // pragmatisch, gut genug für UI-Validierung
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(String(v || "").trim());
}

createApp({
    data() {
        const demo = {
            slots: [
                { id: "S1", slot_number: "1", status: "available", pier: "Steg A", length_m: 10, max_beam_m: 3.2, price_per_day: 18 },
                { id: "S2", slot_number: "2", status: "booked", pier: "Steg A", length_m: 12, max_beam_m: 3.5, price_per_day: 22 },
                { id: "S3", slot_number: "3", status: "occupied", pier: "Steg A", length_m: 8, max_beam_m: 2.8, price_per_day: 15 },
                { id: "S4", slot_number: "4", status: "available", pier: "Steg A", length_m: 9, max_beam_m: 3.0, price_per_day: 16 },

                { id: "S5", slot_number: "5", status: "available", pier: "Steg B", length_m: 11, max_beam_m: 3.3, price_per_day: 20 },
                { id: "S6", slot_number: "6", status: "available", pier: "Steg B", length_m: 13, max_beam_m: 3.8, price_per_day: 24 },
                { id: "S7", slot_number: "7", status: "booked", pier: "Steg B", length_m: 10, max_beam_m: 3.2, price_per_day: 19 },
                { id: "S8", slot_number: "8", status: "available", pier: "Steg B", length_m: 7, max_beam_m: 2.6, price_per_day: 14 },

                { id: "S9", slot_number: "9", status: "available", pier: "Steg C", length_m: 14, max_beam_m: 4.0, price_per_day: 26 },
                { id: "S10", slot_number: "10", status: "occupied", pier: "Steg C", length_m: 12, max_beam_m: 3.5, price_per_day: 22 },
                { id: "S11", slot_number: "11", status: "available", pier: "Steg C", length_m: 9, max_beam_m: 3.0, price_per_day: 16 },
                { id: "S12", slot_number: "12", status: "booked", pier: "Steg C", length_m: 8, max_beam_m: 2.8, price_per_day: 15 },
            ],
            boats: [],
            boats_list: [
                { id: "B1", name: "Segler", category: "Sail", length_m: 10 },
                { id: "B2", name: "Motorboot", category: "Motor", length_m: 8 },
                { id: "B3", name: "Yacht", category: "Yacht", length_m: 12 },
                { id: "B4", name: "Kleinboot", category: "Small", length_m: 6 },
            ],
        };

        const data = window.APP_DATA || demo;

        const todayISO = new Date().toISOString().split("T")[0];
        const tomorrowISO = new Date(Date.now() + 86400000).toISOString().split("T")[0];

        return {
            activeTab: "slots",

            gridSlots: Array.isArray(data.slots) ? data.slots : [],
            boatsInWater: Array.isArray(data.boats) ? data.boats : [],
            boatsList: Array.isArray(data.boats_list) ? data.boats_list : [],

            slotFilter: "all",
            slotSearch: "",
            boatSearch: "",
            showOnlyWithPrice: false,

            draggedBoat: null,
            dragOverId: null,
            selectedSlotId: null,
            selectedBoatId: null,

            formData: {
                name: "",
                email: "",
                customer_phone: "",
                payment_method: "paypal",
                start_date: todayISO,
                end_date: tomorrowISO,
                notes: "",
            },

            toasts: [],
        };
    },

    computed: {
        selectedSlot() {
            if (!this.selectedSlotId) return null;
            return this.gridSlots.find((s) => s.id === this.selectedSlotId) || null;
        },

        selectedBoat() {
            if (!this.selectedBoatId) return null;
            return this.boatsList.find((b) => b.id === this.selectedBoatId) || null;
        },

        filteredSlots() {
            let slots = [...this.gridSlots];

            // Status Filter
            if (this.slotFilter !== "all") {
                slots = slots.filter((s) => s.status === this.slotFilter);
            }

            // "nur mit Preis"
            if (this.showOnlyWithPrice) {
                slots = slots.filter((s) => Number(s.price_per_day) > 0);
            }

            // Suche (slot_number, id, pier)
            const q = this.slotSearch.trim().toLowerCase();
            if (q) {
                slots = slots.filter((s) => {
                    const label = this.slotLabel(s).toLowerCase();
                    const pier = String(s.pier || "").toLowerCase();
                    return label.includes(q) || pier.includes(q);
                });
            }

            // Sort: pier, then numeric slot_number
            slots.sort((a, b) => {
                const pa = String(a.pier || "");
                const pb = String(b.pier || "");
                if (pa !== pb) return pa.localeCompare(pb, "de");
                const na = Number(a.slot_number || a.id.replace(/\D+/g, "")) || 0;
                const nb = Number(b.slot_number || b.id.replace(/\D+/g, "")) || 0;
                return na - nb;
            });

            return slots;
        },

        filteredBoatsList() {
            let list = [...this.boatsList];
            const q = this.boatSearch.trim().toLowerCase();
            if (q) {
                list = list.filter((b) => {
                    const name = String(b.name || "").toLowerCase();
                    const cat = String(b.category || "").toLowerCase();
                    return name.includes(q) || cat.includes(q);
                });
            }
            return list;
        },

        selectedSlotDisplay() {
            if (!this.selectedSlot) return "—";
            return `${this.slotLabel(this.selectedSlot)} · ${this.statusText(this.selectedSlot.status)}`;
        },

        selectedBoatDisplay() {
            if (!this.selectedBoat) return "—";
            return `${this.selectedBoat.name || "Reservierung"}${this.selectedBoat.length_m ? ` · ${this.selectedBoat.length_m}m` : ""}`;
        },

        validationHint() {
            if (!this.selectedSlotId) return "Bitte einen Platz auswählen.";
            if (!this.selectedBoatId) return "Bitte ein Bootssymbol auswählen.";
            if (this.selectedSlot && this.selectedSlot.status !== "available") return "Dieser Platz ist nicht frei.";

            if (!this.formData.name.trim()) return "Bitte Name eintragen.";
            if (!isEmail(this.formData.email)) return "Bitte gültige E-Mail eintragen.";
            if (!this.formData.start_date || !this.formData.end_date) return "Bitte Start- und Enddatum wählen.";

            const s = parseISODate(this.formData.start_date);
            const e = parseISODate(this.formData.end_date);
            if (!s || !e) return "Ungültiges Datum.";
            if (e <= s) return "Enddatum muss nach dem Startdatum liegen.";

            return "";
        },

        canSubmitBooking() {
            return !this.validationHint;
        },

        pricePreview() {
            if (!this.selectedSlot || !this.selectedSlot.price_per_day) return "—";
            const nights = daysBetweenInclusive(this.formData.start_date, this.formData.end_date);
            const price = Number(this.selectedSlot.price_per_day) * nights;
            if (!nights) return `${this.formatPrice(this.selectedSlot.price_per_day)}/Tag`;
            return `${this.formatPrice(price)} gesamt (${nights} Nacht${nights === 1 ? "" : "en"})`;
        },
    },

    methods: {
        // ---------- UI helpers ----------
        toast(message, type = "info", ttl = 3500) {
            const id = uid();
            this.toasts.push({ id, message, type });
            window.setTimeout(() => this.removeToast(id), ttl);
        },

        removeToast(id) {
            this.toasts = this.toasts.filter((t) => t.id !== id);
        },

        statusText(status) {
            const map = { available: "Frei", booked: "Gebucht", occupied: "Belegt" };
            return map[status] || "Unbekannt";
        },

        badgeClass(status) {
            return {
                "badge--free": status === "available",
                "badge--booked": status === "booked",
                "badge--occupied": status === "occupied",
            };
        },

        slotClass(slot) {
            return {
                "is-free": slot.status === "available",
                "is-booked": slot.status === "booked",
                "is-occupied": slot.status === "occupied",
                "is-selected": this.selectedSlotId === slot.id,
                "is-dragover": this.dragOverId === slot.id,
            };
        },

        slotLabel(slot) {
            // schöneres Label
            const nr = slot.slot_number ?? slot.number ?? null;
            const id = slot.id ?? "";
            const base = nr ? `Platz ${nr}` : String(id);
            return slot.pier ? `${base} (${slot.pier})` : base;
        },

        slotAriaLabel(slot) {
            const parts = [
                this.slotLabel(slot),
                this.statusText(slot.status),
            ];
            if (slot.price_per_day) parts.push(`${this.formatPrice(slot.price_per_day)} pro Tag`);
            return parts.join(", ");
        },

        boatAriaLabel(b) {
            const parts = [b.name || "Boot"];
            if (b.category) parts.push(b.category);
            if (b.length_m) parts.push(`${b.length_m} Meter`);
            return parts.join(", ");
        },

        formatPrice(v) {
            const num = Number(v);
            if (!Number.isFinite(num)) return "—";
            return new Intl.NumberFormat("de-DE", { style: "currency", currency: "EUR" }).format(num);
        },

        getBoatColor(category) {
            const c = String(category || "").toLowerCase();
            if (c.includes("sail")) return "#2e86c1";
            if (c.includes("motor")) return "#1abc9c";
            if (c.includes("yacht")) return "#9b59b6";
            if (c.includes("small") || c.includes("klein")) return "#f39c12";
            return "#34495e";
        },

        // ---------- Selection ----------
        selectSlot(slotId) {
            const slot = this.gridSlots.find((s) => s.id === slotId);
            if (!slot) return;

            this.selectedSlotId = slotId;

            if (slot.status !== "available") {
                this.toast(`Hinweis: ${this.slotLabel(slot)} ist ${this.statusText(slot.status)}.`, "warning");
            } else {
                this.toast(`Platz gewählt: ${this.slotLabel(slot)}`, "info");
            }

            // Komfort: wenn Boot schon gewählt, direkt zur Buchung springen
            if (this.selectedBoatId && slot.status === "available") {
                this.activeTab = "booking";
            }
        },

        selectBoat(boatId) {
            const b = this.boatsList.find((x) => x.id === boatId);
            this.selectedBoatId = boatId;

            if (b) this.toast(`Boot gewählt: ${b.name || "Reservierung"}`, "info");

            // Komfort: wenn Slot schon gewählt und frei, direkt zur Buchung
            if (this.selectedSlot && this.selectedSlot.status === "available") {
                this.activeTab = "booking";
            }
        },

        resetSelection() {
            this.draggedBoat = null;
            this.dragOverId = null;
            this.selectedSlotId = null;
            this.selectedBoatId = null;

            // Formular nicht komplett leeren (UX), nur Notizen
            this.formData.notes = "";
            this.toast("Auswahl zurückgesetzt.", "info");
        },

        // ---------- Drag & Drop ----------
        onDragStart(boat) {
            this.draggedBoat = boat;
            this.selectedBoatId = boat?.id || null;
            this.toast("Boot ziehen: Lege es auf einem freien Platz ab.", "info", 2500);
        },

        onDragEnd() {
            this.draggedBoat = null;
            this.dragOverId = null;
        },

        onDragOver(slotId) {
            this.dragOverId = slotId;
        },

        onDragLeave(slotId) {
            if (this.dragOverId === slotId) this.dragOverId = null;
        },

        onDrop(slotId) {
            const slot = this.gridSlots.find((s) => s.id === slotId);
            if (!slot) return;

            this.selectedSlotId = slotId;

            if (!this.selectedBoatId && this.draggedBoat?.id) {
                this.selectedBoatId = this.draggedBoat.id;
            }

            if (slot.status !== "available") {
                this.toast(`Nicht möglich: ${this.slotLabel(slot)} ist ${this.statusText(slot.status)}.`, "warning");
                return;
            }

            if (!this.selectedBoatId) {
                this.toast("Bitte zuerst ein Bootssymbol wählen.", "warning");
                return;
            }

            this.toast(`Abgelegt auf ${this.slotLabel(slot)} – bitte Buchung ausfüllen.`, "success");
            this.activeTab = "booking";
        },

        // ---------- Submit ----------
        async submitBooking() {
            if (!this.canSubmitBooking) {
                this.toast(this.validationHint || "Bitte Eingaben prüfen.", "warning");
                return;
            }

            // Sicherheitscheck: Slot muss frei sein
            const slot = this.selectedSlot;
            if (!slot || slot.status !== "available") {
                this.toast("Dieser Platz ist nicht (mehr) frei.", "warning");
                return;
            }

            const payload = {
                slot_id: this.selectedSlotId,
                boat_id: this.selectedBoatId,
                customer: {
                    name: this.formData.name.trim(),
                    email: this.formData.email.trim(),
                    phone: this.formData.customer_phone.trim(),
                },
                booking: {
                    start_date: this.formData.start_date,
                    end_date: this.formData.end_date,
                    payment_method: this.formData.payment_method,
                    notes: this.formData.notes.trim(),
                },
                meta: {
                    price_preview: this.pricePreview,
                },
            };

            const url = window.APP_CONFIG?.saveBookingUrl || null;

            try {
                // Optional: echte API
                if (url) {
                    const res = await fetch(url, {
                        method: "POST",
                        headers: { "Content-Type": "application/json" },
                        body: JSON.stringify(payload),
                    });

                    if (!res.ok) {
                        const txt = await res.text().catch(() => "");
                        throw new Error(`API Fehler (${res.status}): ${txt || "Unbekannt"}`);
                    }

                    const json = await res.json().catch(() => ({}));
                    if (!json?.success) {
                        throw new Error(json?.message || "Buchung konnte nicht gespeichert werden.");
                    }
                }

                // Demo/Optimistisch: Slot auf booked setzen
                slot.status = "booked";

                this.toast("Buchung gespeichert!", "success");

                // UX: Tab zurück + Auswahl behalten? -> sinnvoll: Boot/Slot zurücksetzen
                this.resetSelection();
                this.activeTab = "slots";
            } catch (err) {
                this.toast(`Fehler: ${err.message}`, "warning", 5000);
            }
        },
    },

    mounted() {
        // Kleine Start-UX:
        if (!this.gridSlots.length) {
            this.toast("Keine Slots vorhanden – APP_DATA prüfen.", "warning", 5000);
        }
    },
}).mount("#app");
