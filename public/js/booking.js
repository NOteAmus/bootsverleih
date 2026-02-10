/**
 * Booking View JavaScript
 * Vue.js Application für Buchungsansicht
 *
 * @package    Bootsverleih
 * @subpackage JavaScript
 * @author     Yachthafen Plau am See
 * @version    1.0.0
 */

/**
 * Initialisiert die Booking-App
 *
 * @param {Object} initialData - Server-seitige Daten
 * @param {Array} initialData.boatPositions - Schiffspositionen aus DB
 */
function initBookingApp(initialData = {}) {
    const { createApp, reactive, computed, watch } = Vue;

    createApp({
        setup() {
            // ==========================================
            // STATE MANAGEMENT
            // ==========================================

            const state = reactive({
                activeTab: "slots",

                // Slots selection + states
                selectedSlots: {},         // { [slotId]: { id, number } }
                pendingSlots: {},          // { [slotId]: true }
                dropHoverSlots: {},        // { [slotId]: true }

                // Dragging + mobile token
                draggingBoatTokenId: null,
                touchSelectedToken: null,

                // Submitting flags
                slotSubmitting: false,
                boatSubmitting: false,

                // Ship moving state
                shipsGrid: null,
                shipsGridInitialized: false,
                shipMovements: [],
                shipMoveStatus: {
                    message: "",
                    type: "",
                    icon: ""
                },

                // Schiffspositionen (von Server)
                occupiedShips: initialData.boatPositions || [],

                // Forms
                slotForm: {
                    customer_name: "",
                    customer_email: "",
                    customer_phone: "",
                    boat_length: "",
                    start_date: "",
                    end_date: "",
                    special_requests: "",
                    payment_method: "paypal",
                },
                boatForm: {
                    item_id: "",
                    customer_name: "",
                    customer_email: "",
                    customer_phone: "",
                    start_date: "",
                    end_date: "",
                    experience_level: "",
                    additional_equipment: "",
                    payment_method: "paypal",
                },

                // Boats cards demo data
                boatsData: [
                    {id:1,name:"Bavaria Cruiser 37",type:"Segelyacht",category:"premium",length:11.3,year:2023,capacity:8,price_per_day:350,features:["2 Kabinen","Vollküche","WC mit Dusche","GPS","Autopilot"],image:"https://res.cloudinary.com/dk-wassersport/image/upload/v1740666784/yacht/yacht_20250219_202505_new-img_75_4_img-Z6Q0P0Qy.jpg"},
                    {id:2,name:"Hanse 388",type:"Segelyacht",category:"premium",length:11.4,year:2022,capacity:6,price_per_day:320,features:["3 Kabinen","Kombüse","Elektrowinde","Badeplattform","Sonnenliege"],image:"https://res.cloudinary.com/dk-wassersport/image/upload/v1687436145/yacht/hanse-388-segeln-lavagna-2018-mst-7553_ef16a87fb0075501318c20c50a281a6a.jpg"},
                    {id:3,name:"Jeanneau Sun Odyssey 349",type:"Segelyacht",category:"comfort",length:10.3,year:2021,capacity:6,price_per_day:280,features:["Großraum","Kühlschrank","Heizung","Badeleiter","Stereoanlage"],image:"https://www.pitter-yachting.com/images/yacht/sun-odyssey-349/23971630-nala/23971630-main.jpg"},
                    {id:4,name:"Quicksilver Activ 675",type:"Motorboot",category:"comfort",length:6.75,year:2023,capacity:8,price_per_day:220,features:["115 PS","Sonnendeck","Badeplattform","Kühlbox","USB-Anschluss"],image:"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTlymDneY3tolTqia68b61rdHnxxw9NZzakxQ&s"},
                    {id:5,name:"Bayliner VR6",type:"Motorboot",category:"standard",length:6.1,year:2022,capacity:6,price_per_day:180,features:["Mercury 150 PS","Ski-Torpedo","Badeleiter","Sportlenkung","Bluetooth"],image:"https://www.bootscenter-keser.de/wp-content/uploads/2024/03/Bayliner-VR6-Cuddy-7.webp"},
                    {id:6,name:"Zodiac Cadet 310",type:"Schlauchboot",category:"economy",length:3.1,year:2023,capacity:4,price_per_day:90,features:["20 PS Motor","Leicht & wendig","Einfache Bedienung","Schnell abpumpbar"],image:"https://www.marinawassersport.de/cdn/shop/files/2015_Zodiac_310Alu_01_6edc392e-22e9-469e-a766-9d8670794f46.jpg?v=1740217353&width=1445"}
                ],
            });

            // ==========================================
            // DATE HELPERS
            // ==========================================

            const formatDate = (date) => date.toISOString().split("T")[0];
            const today = new Date();
            const tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);

            const todayStr = computed(() => formatDate(today));

            // Initialize dates
            state.slotForm.start_date = formatDate(today);
            state.slotForm.end_date = formatDate(tomorrow);
            state.boatForm.start_date = formatDate(today);
            state.boatForm.end_date = formatDate(tomorrow);

            /**
             * Stellt sicher, dass Enddatum nach Startdatum liegt
             */
            function ensureEndAfterStart(formObj) {
                if (!formObj.start_date || !formObj.end_date) return;
                const s = new Date(formObj.start_date);
                const e = new Date(formObj.end_date);
                if (e <= s) {
                    const nextDay = new Date(s);
                    nextDay.setDate(nextDay.getDate() + 1);
                    formObj.end_date = formatDate(nextDay);
                }
            }

            // Watch for date changes
            watch(() => state.slotForm.start_date, () => ensureEndAfterStart(state.slotForm));
            watch(() => state.slotForm.end_date,   () => ensureEndAfterStart(state.slotForm));
            watch(() => state.boatForm.start_date, () => ensureEndAfterStart(state.boatForm));
            watch(() => state.boatForm.end_date,   () => ensureEndAfterStart(state.boatForm));

            // ==========================================
            // COMPUTED PROPERTIES
            // ==========================================

            const selectedSlotsList = computed(() => Object.values(state.selectedSlots));
            const selectedSlotIdsCsv = computed(() => selectedSlotsList.value.map(x => x.id).join(","));

            // ==========================================
            // TAB MANAGEMENT
            // ==========================================

            /**
             * Wechselt zwischen Tabs
             */
            function setActiveTab(tabId) {
                state.activeTab = tabId;

                // Initialize GridStack when ships tab is activated
                if (tabId === "ships") {
                    setTimeout(initializeShipsGrid, 100);
                }
            }

            // ==========================================
            // GRIDSTACK (SHIP MOVEMENT)
            // ==========================================

            /**
             * Initialisiert das GridStack für Schiffe-Verschieben
             */
            function initializeShipsGrid() {
                // Check if already initialized
                if (state.shipsGridInitialized) {
                    return;
                }

                const gridElement = document.getElementById('shipsGrid');
                if (!gridElement) return;

                state.shipsGrid = GridStack.init({
                    column: 12,
                    cellHeight: 70,
                    margin: 10,
                    float: true,
                    disableResize: true,
                    draggable: { handle: '.grid-stack-item-content' },
                    animate: true,
                }, gridElement);

                state.shipsGrid.removeAll(false);

                // Extend rows
                state.shipsGrid.engine.maxRow = 30;
                state.shipsGrid.opts.minRow = 30;
                state.shipsGrid._updateStyles?.();
                state.shipsGrid._triggerChangeEvent?.();

                // Add ship widgets
                state.occupiedShips.forEach(ship => {
                    state.shipsGrid.addWidget({
                        id: ship.id,
                        x: ship.x, y: ship.y, w: ship.w, h: ship.h,
                        content: `
                            <div class="grid-stack-item-content with-ship">
                                <div class="ship-icon"><i class="fas fa-ship"></i></div>
                                <div class="ship-name">${ship.name}</div>
                                <div class="ship-slot">Slot: ${ship.slot}</div>
                            </div>
                        `
                    });
                });

                // Event listeners
                state.shipsGrid.on('dragstop', (event, el) => {
                    const n = el?.gridstackNode;
                    if (!n) return;
                });

                state.shipsGrid.on('change', (event, items) => {
                    if (items?.length) updateShipMovements(items);
                });

                state.shipsGridInitialized = true;
            }

            /**
             * Aktualisiert die Schiffsbewegungen im State
             */
            function updateShipMovements(items) {
                items.forEach(item => {
                    const shipId = item.id;
                    const existingIndex = state.shipMovements.findIndex(m => m.id === shipId);

                    const movement = {
                        id: shipId,
                        x: item.x,
                        y: item.y,
                        newSlot: calculateSlotFromPosition(item.x, item.y)
                    };

                    if (existingIndex >= 0) {
                        state.shipMovements[existingIndex] = movement;
                    } else {
                        state.shipMovements.push(movement);
                    }
                });
            }

            /**
             * Berechnet Slot-Nummer aus Grid-Position
             */
            function calculateSlotFromPosition(x, y) {
                const rowLetters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];
                const row = rowLetters[Math.min(y, rowLetters.length - 1)] || 'A';
                const position = Math.min(x + 1, 8);
                return `${row}${position}`;
            }

            /**
             * Bestätigt und speichert Schiffsbewegungen
             */
            async function confirmShipMovements() {
                if (state.shipMovements.length === 0) {
                    showStatus("Es wurden keine Schiffe verschoben.", "warning", "fas fa-exclamation-triangle");
                    return;
                }

                showStatus("Schiffe werden verschoben...", "info", "fas fa-spinner fa-spin");

                try {
                    const response = await fetch("/booking/moveShips", {
                        method: "POST",
                        headers: { "Content-Type": "application/json" },
                        body: JSON.stringify({ movements: state.shipMovements })
                    });

                    const data = await response.json();

                    if (data.success) {
                        showStatus(`${state.shipMovements.length} Schiffe erfolgreich verschoben!`, "success", "fas fa-check-circle");

                        // Update original positions
                        state.shipMovements.forEach(movement => {
                            const shipIndex = state.occupiedShips.findIndex(s => s.id === movement.id);
                            if (shipIndex >= 0) {
                                state.occupiedShips[shipIndex].x = movement.x;
                                state.occupiedShips[shipIndex].y = movement.y;
                                state.occupiedShips[shipIndex].slot = movement.newSlot;
                            }
                        });

                        state.shipMovements = [];

                        setTimeout(() => {
                            state.shipMoveStatus.message = "";
                        }, 3000);
                    } else {
                        showStatus("Fehler: " + (data.message || "Positionen konnten nicht gespeichert werden"), "error", "fas fa-exclamation-circle");
                    }
                } catch (error) {
                    console.error("Fehler beim Speichern:", error);
                    showStatus("Netzwerkfehler beim Speichern der Positionen", "error", "fas fa-exclamation-circle");
                }
            }

            /**
             * Setzt Schiffsbewegungen zurück
             */
            function resetShipMovements() {
                if (state.shipsGrid) {
                    state.shipsGrid.load(state.occupiedShips);
                    state.shipMovements = [];
                    showStatus("Alle Bewegungen wurden zurückgesetzt.", "info", "fas fa-undo");

                    setTimeout(() => {
                        state.shipMoveStatus.message = "";
                    }, 2000);
                }
            }

            /**
             * Zeigt Status-Nachricht an
             */
            function showStatus(message, type, icon) {
                state.shipMoveStatus = {
                    message: message,
                    type: type,
                    icon: icon
                };
            }

            // ==========================================
            // SLOT HELPERS
            // ==========================================

            function getSlotEl(slotId) {
                return document.querySelector(`.slot[data-slot-id="${slotId}"]`);
            }

            function getSlotNumber(slotId) {
                const el = getSlotEl(slotId);
                return el ? (el.getAttribute("data-slot") || "") : "";
            }

            function isSlotOccupied(slotId) {
                const el = getSlotEl(slotId);
                return !!(el && el.classList.contains("occupied"));
            }

            // ==========================================
            // SLOT SELECTION
            // ==========================================

            function addSlotSelectionById(slotId) {
                if (isSlotOccupied(slotId)) return;

                const key = String(slotId);
                if (state.selectedSlots[key]) return;

                const slotNumber = getSlotNumber(slotId);
                if (!slotNumber) return;

                state.selectedSlots[key] = { id: slotId, number: slotNumber };

                const el = getSlotEl(slotId);
                if (el) el.classList.add("selected");
            }

            function removeSlotSelectionById(slotId) {
                const key = String(slotId);
                if (!state.selectedSlots[key]) return;

                delete state.selectedSlots[key];

                const el = getSlotEl(slotId);
                if (el) el.classList.remove("selected");

                if (state.pendingSlots[slotId]) {
                    delete state.pendingSlots[slotId];

                    const el2 = getSlotEl(slotId);
                    if (el2) {
                        el2.classList.remove("pending");
                        el2.removeAttribute("data-boat-token");
                    }
                }
            }

            function toggleSlotSelectionById(slotId) {
                if (isSlotOccupied(slotId)) return;

                const key = String(slotId);
                if (state.selectedSlots[key]) {
                    removeSlotSelectionById(slotId);
                } else {
                    addSlotSelectionById(slotId);
                }
            }

            // ==========================================
            // BOAT PLACEMENT
            // ==========================================

            function placeBoatIntoSlotById(slotId, tokenId) {
                if (isSlotOccupied(slotId)) return;
                if (state.pendingSlots[slotId]) return;

                state.pendingSlots[slotId] = true;

                const el = getSlotEl(slotId);
                if (el) {
                    el.classList.add("pending");
                    el.setAttribute("data-boat-token", tokenId);
                }
            }

            // ==========================================
            // DRAG & DROP
            // ==========================================

            function onBoatDragStart(tokenId, e) {
                state.draggingBoatTokenId = tokenId;
                e.dataTransfer.setData("text/plain", tokenId);
                e.dataTransfer.effectAllowed = "copy";

                // Custom drag image
                const icon = document.createElement("i");
                icon.className = "fas fa-ship";
                icon.style.fontSize = "32px";
                icon.style.color = "#f4d03f";
                icon.style.position = "absolute";
                icon.style.top = "-1000px";
                document.body.appendChild(icon);
                e.dataTransfer.setDragImage(icon, 16, 16);
                setTimeout(() => document.body.removeChild(icon), 0);
            }

            function onBoatDragEnd() {
                state.draggingBoatTokenId = null;
            }

            function onSlotDragOver(slotId) {
                if (isSlotOccupied(slotId)) return;
                state.dropHoverSlots[slotId] = true;
                const el = getSlotEl(slotId);
                if (el) el.classList.add("drop-hover");
            }

            function onSlotDragLeave(slotId) {
                delete state.dropHoverSlots[slotId];
                const el = getSlotEl(slotId);
                if (el) el.classList.remove("drop-hover");
            }

            function onSlotDrop(slotId, e) {
                onSlotDragLeave(slotId);
                if (isSlotOccupied(slotId)) return;

                const tokenId = e.dataTransfer.getData("text/plain") || state.draggingBoatTokenId;
                if (!tokenId) return;

                placeBoatIntoSlotById(slotId, tokenId);
                addSlotSelectionById(slotId);

            }

            // ==========================================
            // MOBILE/TOUCH
            // ==========================================

            function touchSelectTokenFn(tokenId) {
                state.touchSelectedToken = tokenId;
            }

            function onSlotClick(slotId) {
                if (state.touchSelectedToken) {
                    if (isSlotOccupied(slotId)) return;

                    placeBoatIntoSlotById(slotId, state.touchSelectedToken);
                    addSlotSelectionById(slotId);
                    state.touchSelectedToken = null;

                    return;
                }

                toggleSlotSelectionById(slotId);
            }

            // ==========================================
            // DYNAMIC CLASSES
            // ==========================================

            function slotDynamicClasses(slotId) {
                return {
                    pending: !!state.pendingSlots[slotId],
                    "drop-hover": !!state.dropHoverSlots[slotId],
                };
            }

            // ==========================================
            // FORM SUBMISSIONS
            // ==========================================

            /**
             * Sendet Liegeplatz-Reservierung
             */
            async function submitSlotReservation() {

                // Validation
                if (!state.slotForm.customer_name) {
                    alert("Bitte geben Sie Ihren Namen ein.");
                    return;
                }
                if (!state.slotForm.customer_email) {
                    alert("Bitte geben Sie Ihre E-Mail-Adresse ein.");
                    return;
                }
                if (!state.slotForm.customer_phone) {
                    alert("Bitte geben Sie Ihre Telefonnummer ein.");
                    return;
                }
                if (!state.slotForm.boat_length) {
                    alert("Bitte geben Sie die Bootslänge ein.");
                    return;
                }
                if (!state.slotForm.start_date) {
                    alert("Bitte wählen Sie ein Ankunftsdatum.");
                    return;
                }
                if (!state.slotForm.end_date) {
                    alert("Bitte wählen Sie ein Abreisedatum.");
                    return;
                }

                const slotIds = selectedSlotsList.value
                    .map(x => parseInt(x.id, 10))
                    .filter(n => Number.isFinite(n));

                if (slotIds.length === 0) {
                    alert("Bitte wählen Sie zuerst einen oder mehrere Liegeplätze aus der Marina-Ansicht aus.");
                    return;
                }

                const payload = {
                    slot_ids: slotIds,
                    customer_name: state.slotForm.customer_name,
                    customer_email: state.slotForm.customer_email,
                    customer_phone: state.slotForm.customer_phone,
                    boat_length: state.slotForm.boat_length,
                    start_date: state.slotForm.start_date,
                    end_date: state.slotForm.end_date,
                    special_requests: state.slotForm.special_requests,
                    payment_method: state.slotForm.payment_method || "paypal",
                };

                state.slotSubmitting = true;

                try {
                    const r = await fetch("/booking/makeSlotReservation", {
                        method: "POST",
                        headers: { "Content-Type": "application/json" },
                        body: JSON.stringify(payload),
                    });

                    const data = await r.json();

                    if (data.success) {
                        window.location.href = data.redirect_url;
                    } else {
                        alert("Fehler: " + (data.message || "Reservierung konnte nicht erstellt werden"));
                    }
                } catch (err) {
                    console.error('Error:', err);
                    alert("Fehler bei der Reservierung. Bitte versuchen Sie es erneut.");
                } finally {
                    state.slotSubmitting = false;
                }
            }

            /**
             * Sendet Boot-Reservierung
             */
            async function submitBoatReservation() {

                // Validation
                if (!state.boatForm.customer_name) {
                    alert("Bitte geben Sie Ihren Namen ein.");
                    return;
                }
                if (!state.boatForm.customer_email) {
                    alert("Bitte geben Sie Ihre E-Mail-Adresse ein.");
                    return;
                }
                if (!state.boatForm.customer_phone) {
                    alert("Bitte geben Sie Ihre Telefonnummer ein.");
                    return;
                }
                if (!state.boatForm.experience_level) {
                    alert("Bitte wählen Sie Ihre Bootserfahrung aus.");
                    return;
                }
                if (!state.boatForm.start_date) {
                    alert("Bitte wählen Sie ein Abholdatum.");
                    return;
                }
                if (!state.boatForm.end_date) {
                    alert("Bitte wählen Sie ein Rückgabedatum.");
                    return;
                }
                if (!state.boatForm.item_id) {
                    alert("Bitte wählen Sie zuerst ein Boot aus.");
                    return;
                }

                const payload = {
                    item_id: parseInt(state.boatForm.item_id, 10),
                    customer_name: state.boatForm.customer_name,
                    customer_email: state.boatForm.customer_email,
                    customer_phone: state.boatForm.customer_phone,
                    start_date: state.boatForm.start_date,
                    end_date: state.boatForm.end_date,
                    experience_level: state.boatForm.experience_level,
                    additional_equipment: state.boatForm.additional_equipment,
                    payment_method: state.boatForm.payment_method || "paypal",
                };

                state.boatSubmitting = true;

                try {
                    const r = await fetch("/booking/makeBoatReservation", {
                        method: "POST",
                        headers: { "Content-Type": "application/json" },
                        body: JSON.stringify(payload),
                    });

                    const data = await r.json();

                    if (data.success) {
                        window.location.href = data.redirect_url;
                    } else {
                        alert("Fehler: " + (data.message || "Reservierung konnte nicht erstellt werden"));
                    }
                } catch (err) {
                    console.error('Error:', err);
                    alert("Fehler bei der Reservierung. Bitte versuchen Sie es erneut.");
                } finally {
                    state.boatSubmitting = false;
                }
            }

            // ==========================================
            // BOAT CARD SELECTION
            // ==========================================

            function selectBoatFromCard(boatId) {
                // Switch to boats tab
                state.activeTab = "boats";

                setTimeout(() => {
                    state.boatForm.item_id = String(boatId);

                    setTimeout(() => {
                        const selectElement = document.getElementById("selectedBoat");

                        if (selectElement) {
                            const targetValue = String(boatId);
                            selectElement.value = targetValue;

                            selectElement.dispatchEvent(new Event('input', { bubbles: true }));
                            selectElement.dispatchEvent(new Event('change', { bubbles: true }));

                            state.boatForm.item_id = selectElement.value;
                        }

                        const formElement = document.getElementById("boatReservationForm");
                        if (formElement) {
                            formElement.scrollIntoView({ behavior: "smooth", block: "start" });
                        }

                        if (selectElement) {
                            selectElement.focus();
                        }
                    }, 100);
                }, 50);
            }

            // ==========================================
            // RETURN (PUBLIC API)
            // ==========================================

            return {
                // State
                activeTab: computed(() => state.activeTab),
                pendingSlots: state.pendingSlots,
                boatsData: computed(() => state.boatsData),
                slotForm: state.slotForm,
                boatForm: state.boatForm,
                slotSubmitting: computed(() => state.slotSubmitting),
                boatSubmitting: computed(() => state.boatSubmitting),
                shipMoveStatus: computed(() => state.shipMoveStatus),
                todayStr,

                // Selection
                selectedSlotsList,
                selectedSlotIdsCsv,

                // Methods
                setActiveTab,
                onSlotClick,
                removeSlotSelectionById,
                onBoatDragStart,
                onBoatDragEnd,
                onSlotDragOver,
                onSlotDragLeave,
                onSlotDrop,
                touchSelectTokenFn,
                slotDynamicClasses,
                submitSlotReservation,
                submitBoatReservation,
                selectBoatFromCard,
                confirmShipMovements,
                resetShipMovements,
                touchSelectedToken: computed(() => state.touchSelectedToken),
            };
        },

        mounted() {
            // Initialize GridStack if ships tab is active
            if (this.activeTab === "ships") {
                setTimeout(() => this.$options.setup().initializeShipsGrid, 300);
            }
        }
    }).mount("#app");
}
