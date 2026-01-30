<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Yachthafen Plau am See - Liegeplätze</title>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', 'Helvetica Neue', Arial, sans-serif; }

        :root {
            --primary: #1a5276;
            --primary-dark: #0d3c5a;
            --primary-light: #2e86c1;
            --secondary: #d4ac0d;
            --secondary-light: #f4d03f;
            --accent: #17a2b8;
            --white: #ffffff;
            --light-bg: #f8f9fa;
            --light-gray: #e9ecef;
            --text-dark: #2c3e50;
            --text-light: #6c757d;
            --success: #28a745;
            --danger: #dc3545;
            --warning: #ffc107;
            --shadow: rgba(0, 0, 0, 0.1);
            --border-radius: 12px;
            --transition: all 0.25s ease;
            --grid-color: rgba(255, 255, 255, 0.10);
        }

        body { background: var(--light-bg); color: var(--text-dark); min-height: 100vh; }

        .container { max-width: 1400px; margin: 0 auto; padding: 0 20px; }

        .hero {
            background: linear-gradient(rgba(26, 82, 118, 0.9), rgba(13, 60, 90, 0.9)),
            url('https://images.unsplash.com/photo-1534215754734-18e55d13e346?auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            color: var(--white);
            padding: 6rem 0 5rem;
            text-align: center;
        }

        .hero h1 { font-size: 3rem; font-weight: 800; margin-bottom: 0.8rem; letter-spacing: -0.5px; }
        .hero .slogan { font-size: 1.4rem; font-weight: 300; color: var(--secondary-light); font-style: italic; margin-bottom: 0.8rem; }
        .hero .subtitle { max-width: 880px; margin: 0 auto; opacity: 0.92; }

        .nav-tabs {
            background: var(--white);
            border-radius: var(--border-radius);
            padding: 1rem;
            margin: -2.5rem auto 2.5rem;
            max-width: 900px;
            box-shadow: 0 10px 30px var(--shadow);
            display: flex;
            gap: 1rem;
            position: relative;
            z-index: 10;
        }

        .nav-tab {
            flex: 1;
            padding: 1rem 1.25rem;
            text-align: center;
            background: var(--light-bg);
            border: none;
            border-radius: 10px;
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--text-dark);
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
        }
        .nav-tab.active { background: var(--primary); color: var(--white); }
        .nav-tab:hover:not(.active) { background: var(--primary-light); color: var(--white); }

        .marina-map-container {
            background: var(--white);
            border-radius: var(--border-radius);
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px var(--shadow);
            border: 1px solid var(--light-gray);
            overflow: hidden;
        }

        .section-title {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 1.2rem;
            text-align: center;
            font-weight: 800;
            position: relative;
            padding-bottom: 0.75rem;
        }
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 90px;
            height: 4px;
            background: var(--secondary);
            border-radius: 2px;
        }

        .text-center { text-align: center; }
        .mb-2 { margin-bottom: 1.5rem; }

        .controls {
            display: flex;
            justify-content: center;
            gap: 0.8rem;
            margin: 1.25rem 0 1.5rem;
            flex-wrap: wrap;
        }
        .anchor-token {
            width: 180px;
            height: 50px;
            border-radius: 14px;
            cursor: grab;
            user-select: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-weight: 900;
            color: #fff;
            background: linear-gradient(135deg, #1a5276 0%, #2e86c1 100%);
            box-shadow: 0 8px 20px rgba(0,0,0,0.25);
            border: 2px solid rgba(255,255,255,0.4);
            transition: all 0.2s ease;
        }
        .anchor-token:hover { transform: translateY(-2px) scale(1.03); }
        .anchor-token:active { cursor: grabbing; }
        .anchor-token.dragging { opacity: 0.85; transform: scale(1.05); }

        .marina-view {
            width: 100%;
            height: 700px;
            border-radius: var(--border-radius);
            overflow: hidden;
            position: relative;
            background:
                    linear-gradient(0deg, rgba(26, 82, 118, 0.15), rgba(26, 82, 118, 0.15)),
                    url('/kleine-wellen-auf-ruhiger-see-irgendwo-in-griechenland_8353-8983.jpg');
            background-size: cover;
            background-position: center;
            border: 3px solid var(--primary);
        }

        /* Raster-Gitter über den See */
        .water-grid {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-image:
                    linear-gradient(var(--grid-color) 1px, transparent 1px),
                    linear-gradient(90deg, var(--grid-color) 1px, transparent 1px);
            background-size: 50px 50px;
            z-index: 1;
            pointer-events: none;
        }

        /* Docks (Hauptsteg + Fingerstege) */
        .dock {
            pointer-events: none;
            position: absolute;
            background: linear-gradient(180deg, #8B4513 0%, #654321 100%);
            border-radius: 6px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.35);
            z-index: 2;
        }

        .dock-label {
            position: absolute;
            color: white;
            font-weight: 800;
            font-size: 1rem;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.8);
            z-index: 5;
            background: rgba(26, 82, 118, 0.85);
            padding: 8px 16px;
            border-radius: 999px;
            border: 2px solid var(--secondary);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            pointer-events: none;
            user-select: none;
            white-space: nowrap;
        }

        /* Liegeplätze (keine Clusterung, feste Slots entlang der Fingerstege) */
        .grid-slot {
            position: absolute;
            border-radius: 10px;
            cursor: pointer;
            transition: var(--transition);
            z-index: 3;
            border: 2px solid rgba(255, 255, 255, 0.65);
            backdrop-filter: blur(2px);
            user-select: none;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .grid-slot.available {
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.78) 0%, rgba(52, 152, 219, 0.78) 100%);
            border-color: rgba(40, 167, 69, 0.9);
        }

        .grid-slot.booked {
            background: linear-gradient(135deg, rgba(212, 172, 13, 0.85) 0%, rgba(241, 196, 15, 0.85) 100%);
            border-color: rgba(212, 172, 13, 0.95);
        }

        .grid-slot.occupied {
            background: linear-gradient(135deg, rgba(220, 53, 69, 0.88) 0%, rgba(192, 57, 43, 0.88) 100%);
            border-color: rgba(220, 53, 69, 0.95);
            cursor: not-allowed;
        }

        .grid-slot:hover:not(.occupied):not(.booked) {
            transform: scale(1.06);
            box-shadow: 0 10px 28px rgba(0,0,0,0.45);
            border-color: rgba(255,255,255,0.95);
            z-index: 10;
        }

        .grid-slot.selected {
            box-shadow: 0 0 0 3px rgba(255,255,255,0.65), 0 10px 28px rgba(0,0,0,0.50);
            transform: scale(1.03);
        }

        /* Drag Over (aus deinen Snippets inspiriert) */
        .grid-slot.drag-over {
            background-color: rgba(46, 204, 113, 0.25) !important;
            border: 3px dashed #ffffff !important;
            box-shadow: 0 0 20px rgba(46, 204, 113, 0.5);
            transform: scale(1.07);
            z-index: 20;
            transition: all 0.18s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        /* Slot Inhalt */
        .slot-content {
            width: 100%;
            height: 100%;
            padding: 8px 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 4px;
            color: #fff;
            text-align: center;
            position: relative;
            z-index: 2;
        }
        .slot-number { font-weight: 900; font-size: 1rem; letter-spacing: 0.3px; }
        .slot-status {
            font-size: 0.72rem;
            opacity: 0.95;
            padding: 2px 8px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.18);
            font-weight: 800;
        }
        .slot-boatname { font-size: 0.72rem; font-weight: 800; opacity: 0.95; }

        /* Boot im Slot (optische Darstellung) */
        .boat-in-slot {
            position: absolute;
            width: 72%;
            height: 92%;
            background: linear-gradient(180deg, #f8f9fa 0%, #d1d8e0 100%);
            color: #2c3e50;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            clip-path: polygon(50% 0%, 100% 20%, 100% 100%, 0% 100%, 0% 20%);
            border-radius: 0 0 6px 6px;
            box-shadow: 0 6px 14px rgba(0,0,0,0.3);
            font-size: 0.62rem;
            font-weight: 900;
            text-align: center;
            padding: 10px 4px;
            animation: boatDrop 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            z-index: 1;
        }
        .boat-in-slot::after {
            content: '';
            position: absolute;
            top: 25%;
            width: 60%;
            height: 28%;
            background: rgba(52, 152, 219, 0.3);
            border-radius: 3px;
        }
        @keyframes boatDrop {
            0% { opacity: 0; transform: translateY(-16px) scale(1.1); }
            100% { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* Schiff-Palette (Drag Quelle): bleibt IMMER da */
        .fleet-panel {
            position: absolute;
            left: 16px;
            bottom: 16px;
            z-index: 50;
            background: rgba(255,255,255,0.92);
            border: 1px solid rgba(0,0,0,0.08);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.25);
            padding: 12px 12px 10px;
            min-width: 240px;
            max-width: 420px;
            backdrop-filter: blur(4px);
        }

        .fleet-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 10px;
            color: var(--primary-dark);
            font-weight: 900;
            font-size: 0.95rem;
        }
        .fleet-title small { font-weight: 800; color: var(--text-light); }

        .fleet-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .boat-token {
            width: 128px;
            height: 44px;
            border-radius: 12px;
            cursor: grab;
            user-select: none;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 10px;
            color: #fff;
            font-weight: 900;
            box-shadow: 0 8px 18px rgba(0,0,0,0.25);
            border: 2px solid rgba(255,255,255,0.35);
            transition: var(--transition);
            overflow: hidden;
            position: relative;
        }
        .boat-token:active { cursor: grabbing; }
        .boat-token:hover { transform: translateY(-2px) scale(1.02); border-color: rgba(255,255,255,0.7); }
        .boat-token.dragging { opacity: 0.85; transform: scale(1.05); border-color: var(--secondary); }

        .boat-token .left {
            display: flex;
            align-items: center;
            gap: 8px;
            min-width: 0;
        }
        .boat-token .icon {
            width: 28px;
            height: 28px;
            border-radius: 9px;
            background: rgba(255,255,255,0.18);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 auto;
        }
        .boat-token .name {
            font-size: 0.82rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 70px;
        }
        .boat-token .meta {
            font-size: 0.75rem;
            opacity: 0.92;
            font-weight: 900;
            flex: 0 0 auto;
        }

        .booking-status {
            position: absolute;
            right: 16px;
            bottom: 16px;
            background: rgba(255,255,255,0.92);
            padding: 0.9rem 1.1rem;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.25);
            z-index: 60;
            border-left: 4px solid var(--secondary);
            backdrop-filter: blur(4px);
            max-width: 360px;
        }

        /* Buchungsformular */
        .booking-form {
            background: var(--white);
            border-radius: var(--border-radius);
            padding: 2rem;
            box-shadow: 0 10px 30px var(--shadow);
            border: 1px solid var(--light-gray);
            margin-bottom: 3rem;
        }
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.1rem;
        }
        .form-group { margin-bottom: 0.25rem; }
        .form-group.full-width { grid-column: 1 / -1; }

        label { display: block; margin-bottom: 0.4rem; font-weight: 900; color: var(--primary); font-size: 0.95rem; }
        input, textarea, select {
            width: 100%;
            padding: 0.85rem 1rem;
            border: 2px solid var(--light-gray);
            border-radius: 10px;
            font-size: 1rem;
            transition: var(--transition);
            background: var(--white);
        }
        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(26, 82, 118, 0.10);
        }

        .btn {
            padding: 0.9rem 1.4rem;
            border: none;
            border-radius: 12px;
            font-size: 1.05rem;
            font-weight: 900;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.7rem;
            background: var(--light-gray);
            color: var(--text-dark);
        }
        .btn-primary { background: var(--secondary); color: var(--primary-dark); }
        .btn-primary:hover { background: var(--secondary-light); transform: translateY(-2px); }
        .btn:disabled { opacity: 0.55; cursor: not-allowed; transform: none !important; }

        .form-actions { grid-column: 1 / -1; text-align: center; margin-top: 0.7rem; }

        @media (max-width: 992px) {
            .marina-view { height: 560px; }
            .form-grid { grid-template-columns: 1fr; }
            .nav-tabs { flex-direction: column; }
        }

        @media (max-width: 768px) {
            .hero h1 { font-size: 2.25rem; }
            .marina-map-container { padding: 1.25rem; }
            .marina-view { height: 470px; }
            .fleet-panel { min-width: 220px; max-width: 92%; }
            .boat-token { width: 122px; }
        }
    </style>
</head>

<body>
<section class="hero">
    <div class="container">
        <h1>Yachthafen Plau am See</h1>
        <p class="subtitle">Ziehe ein Schiff-Symbol auf einen freien Platz. Nach dem Buchen springt das Symbol zurück – du kannst mehrere Plätze nacheinander buchen.</p>
    </div>
</section>

<div id="app">
    <div class="container">
        <div class="nav-tabs" id="booking">
            <button class="nav-tab" :class="{ active: activeTab === 'slots' }" @click="activeTab = 'slots'">
                <i class="fas fa-anchor"></i> Liegeplätze
            </button>
            <button class="nav-tab" :class="{ active: activeTab === 'boats' }" @click="activeTab = 'boats'">
                <i class="fas fa-ship"></i> Bootsverleih
            </button>
        </div>
    </div>

    <!-- TAB: Slots -->
    <div class="container" v-if="activeTab === 'slots'">
        <div class="marina-map-container">
            <h2 class="section-title">Interaktiver Steg-Plan</h2>
            <p class="text-center mb-2" style="color: var(--text-light); max-width: 900px; margin: 0 auto;">
                <strong>Grün</strong> = frei, <strong>Gold</strong> = gebucht, <strong>Rot</strong> = belegt.
                Ziehe ein Boot-Symbol aus der Palette unten links auf einen freien Platz.
            </p>

            <div class="controls">
            </div>

            <div class="marina-view" id="marinaView">
                <div class="water-grid"></div>

                <!-- Hauptsteg (vertikal, wie im Bild) -->
                <div class="dock" :style="dockMainStyle">
                </div>

                <!-- Fingerstege (Branches links/rechts) -->
                <div v-for="(p, idx) in pierBranches" :key="'pier-'+idx" class="dock" :style="p.style">
                    <div class="dock-label" v-if="p.label" :style="p.labelStyle">{{ p.label }}</div>
                </div>

                <!-- Liegeplätze -->
                <div v-for="slot in gridSlots"
                     :key="slot.id"
                     class="grid-slot"
                     :class="[slot.status, { selected: selectedSlotId === slot.id, 'drag-over': dragOverId === slot.id }]"
                     :style="getSlotStyle(slot)"
                     @click="selectSlot(slot)"
                     @dragenter.prevent="onDragOver(slot.id)"
                     @dragover.prevent="onDragOver(slot.id)"
                     @dragleave="dragOverId = null"
                     @drop.prevent="onDrop(slot)">


                <!-- Boot-Icon im Slot wenn gebucht -->
                    <div v-if="slot.status === 'booked' && slot.boatName" class="boat-in-slot">
                        {{ slot.boatName }}
                    </div>

                    <div class="slot-content">
                        <div class="slot-number">#{{ slot.slot_number || slot.id }}</div>
                        <div class="slot-status">
                            <template v-if="slot.status === 'available'">Frei</template>
                            <template v-else-if="slot.status === 'booked'">Gebucht</template>
                            <template v-else>Belegt</template>
                        </div>
                        <div class="slot-boatname" v-if="slot.boatName && slot.status !== 'available'">{{ slot.boatName }}</div>
                    </div>
                </div>

                <!-- Fleet Palette (Drag Quelle, bleibt immer vorhanden) -->
                <div class="fleet-panel">
                    <div class="fleet-title">
                        <div><i ></i>Platz reservieren</div>
                        <small>Drag & Drop</small>
                    </div>

                    <div class="fleet-list">
                        <div class="anchor-token"
                             draggable="true"
                             @dragstart="onDragStart"
                             @dragend="onDragEnd"
                             title="Liegeplatz reservieren">
                            <i class="fas fa-ship"></i>
                        </div>
                    </div>

                    <!-- Hinweis beim Ziehen -->
                <div v-if="draggedBoat" class="booking-status">
                    <i class="fas fa-ship" style="color: var(--secondary); margin-right: 8px;"></i>
                    Ziehe <strong>{{ draggedBoat.name }}</strong> auf einen <strong>freien</strong> Platz.
                    <div style="margin-top:6px; color: var(--text-light); font-weight: 800; font-size: 0.9rem;">
                        Nach dem Drop springt das Symbol zurück.
                    </div>
                </div>
            </div>
        </div>

        <!-- Buchungsformular (wie gehabt – nun passt es zur neuen Drag-Logik) -->
        <div class="booking-form" id="slotReservationForm">
            <h2 class="section-title">Liegeplatz Reservierung</h2>

            <form @submit.prevent="submitBooking">
                <div class="form-grid">
                    <div class="form-group">
                        <label><i class="fas fa-anchor"></i> Ausgewählter Platz</label>
                        <input type="text" :value="selectedSlotInfo" readonly placeholder="Kein Platz ausgewählt">
                    </div>

                    <div class="form-group full-width">
                        <label><i class="fas fa-list-check"></i> Ausgewählte Plätze</label>

                        <div v-if="selectedSlots.length === 0" style="color: var(--text-light); font-weight: 800;">
                            Noch keine Plätze ausgewählt – ziehe das Symbol auf freie Plätze.
                        </div>

                        <div v-else style="display:flex; flex-wrap:wrap; gap:10px;">
                            <button type="button"
                                    v-for="s in selectedSlots"
                                    :key="'chip-'+s.id"
                                    @click="removeSelectedSlot(s.id)"
                                    style="border:none; cursor:pointer; padding:10px 12px; border-radius:999px; font-weight:900;
                   background: rgba(212,172,13,0.18); color: var(--primary-dark);
                   display:flex; align-items:center; gap:8px;">
                                <i class="fas fa-anchor"></i>
                                Platz #{{ s.slot_number || s.id }}
                                <span style="opacity:.7;">(entfernen)</span>
                            </button>
                        </div>
                    </div>

<!--                    <div class="form-group">-->
<!--                        <label><i class="fas fa-ship"></i> Ausgewähltes Boot</label>-->
<!--                        <input type="text" :value="selectedBoatInfo" readonly placeholder="Kein Boot ausgewählt">-->
<!--                    </div>-->

                    <div class="form-group">
                        <label><i class="fas fa-user"></i> Name</label>
                        <input type="text" v-model="formData.name" required placeholder="Max Mustermann">
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-envelope"></i> E-Mail</label>
                        <input type="email" v-model="formData.email" required placeholder="max@mustermann.de">
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-calendar-day"></i> Von</label>
                        <input type="date" v-model="formData.start_date" required>
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-calendar-day"></i> Bis</label>
                        <input type="date" v-model="formData.end_date" required>
                    </div>

                    <div class="form-group full-width">
                        <label><i class="fas fa-comment"></i> Bemerkungen</label>
                        <textarea v-model="formData.notes" rows="3" placeholder="Besondere Wünsche..."></textarea>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary" :disabled="!canSubmitBooking">
                            <i class="fas fa-check-circle"></i>
                            {{ canSubmitBooking ? 'Platz reservieren' : 'Zuerst Boot & Platz wählen' }}
                        </button>

                        <button type="button" class="btn" style="margin-left: 0.75rem;" @click="showLocalBookings">
                            <i class="fas fa-list"></i> Lokale Buchungen
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- TAB: Bootsverleih -->
    <div class="container" v-if="activeTab === 'boats'">
        <div class="marina-map-container">
            <h2 class="section-title">Bootsverleih</h2>
            <p class="text-center" style="color: var(--text-light); max-width: 900px; margin: 0 auto 1rem;">
                Wähle ein Boot aus – es erscheint/bleibt dann als Symbol in der Palette und kann auf Plätze gezogen werden.
            </p>

            <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 16px;">
                <div v-for="boat in boatsList" :key="'list-'+boat.id"
                     style="background:#fff; border:1px solid var(--light-gray); border-radius:16px; overflow:hidden; box-shadow: 0 10px 20px rgba(0,0,0,0.08);">
                    <div :style="{ height:'170px', backgroundSize:'cover', backgroundPosition:'center', backgroundImage:'url(' + (boat.image_url || 'https://images.unsplash.com/photo-1500375592092-40eb2168fd21?auto=format&fit=crop&w=1200&q=80') + ')' }"></div>
                    <div style="padding:14px 14px 16px;">
                        <div style="display:flex; align-items:flex-start; justify-content:space-between; gap:12px;">
                            <div>
                                <div style="font-weight:900; color: var(--primary); font-size:1.15rem;">{{ boat.name }}</div>
                                <div style="color: var(--text-light); font-weight:800; margin-top:2px;">{{ boat.boat_type || 'Boot' }} · {{ boat.length || 0 }}m</div>
                            </div>
                            <div style="font-weight:900; color: var(--secondary); font-size:1.25rem;">
                                €{{ boat.price_per_day || 0 }}<span style="font-size:.85rem; color: var(--text-light);">/Tag</span>
                            </div>
                        </div>

                        <button class="btn btn-primary" style="width:100%; margin-top:12px;" @click="addBoatToPalette(boat)">
                            <i class="fas fa-plus"></i> Als Symbol hinzufügen
                        </button>
                    </div>
                </div>
            </div>

            <div class="text-center" style="margin-top: 1.25rem;">
                <button class="btn" @click="activeTab='slots'"><i class="fas fa-arrow-left"></i> Zurück zum Steg-Plan</button>
            </div>
        </div>
    </div>
</div>

<script>
    /**
     * In deinem echten Projekt ersetzt du APP_DATA wieder durch deine PHP JSONs:
     * APP_DATA = { slots: ..., boats: ..., boats_list: ... }
     */
    const APP_DATA = window.APP_DATA || {
        slots: [
            // Demo: wenn Backend nichts liefert.
            { id: 'S1', slot_number: '1', status: 'available' },
            { id: 'S2', slot_number: '2', status: 'available' },
            { id: 'S3', slot_number: '3', status: 'available' },
            { id: 'S4', slot_number: '4', status: 'available' },
            { id: 'S5', slot_number: '5', status: 'available' },
            { id: 'S6', slot_number: '6', status: 'available' },
            { id: 'S7', slot_number: '7', status: 'available' },
            { id: 'S8', slot_number: '8', status: 'available' },
        ],
        boats: [
            { id: 1, name: 'Schiff', type: 'Symbol', category: 'standard', length: 10 },
            { id: 2, name: 'Seestern', type: 'Segelyacht', category: 'premium', length: 12 },
            { id: 3, name: 'Windspiel', type: 'Segelboot', category: 'comfort', length: 8 },
        ],
        boats_list: [
            { id: 101, name: 'Neptun', boat_type: 'Luxusyacht', length: 15, price_per_day: 250, category: 'premium' },
            { id: 102, name: 'Wassermann', boat_type: 'Motorboot', length: 10, price_per_day: 140, category: 'standard' },
            { id: 103, name: 'Plauer Perle', boat_type: 'Segelboot', length: 8, price_per_day: 120, category: 'comfort' },
        ],
    };
</script>

<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script>
    const { createApp } = Vue;

    createApp({
        data() {
            return {
                activeTab: 'slots',

                gridSlots: (APP_DATA.slots || []).map(s => ({
                    ...s,
                    status: s.status || 'available',
                    boatName: s.boatName || s.boat_name || null,
                })),

                boatsInWater: (APP_DATA.boats || []).length
                    ? APP_DATA.boats
                    : [{ id: 1, name: 'Schiff', type: 'Symbol', category: 'standard', length: 10 }],

                boatsList: APP_DATA.boats_list || [],

                draggedBoat: null,
                dragOverId: null,
                selectedSlotId: null,
                selectedSlotIds: [],
                // rein lokal (für UI-Liste)
                localBookings: [],

                formData: {
                    name: '',
                    email: '',
                    start_date: '',
                    end_date: '',
                    notes: '',
                    customer_phone: '',
                    payment_method: 'paypal'
                },

                // Dock / Layout Parameter (wie Bild: Hauptsteg vertikal + Branches)
                layout: {
                    mainPier: { xPct: 60, yPct: 6, wPct: 3.2, hPct: 90 },

                    // NEU: alle Fingerstege gleich lang
                    uniformBranchLengthPct: 20, // <-- anpassen (Prozent der Marina-View-Breite)

                    branches: [
                        { yPct: 10, side: 'left',  thicknessPx: 18 },
                        { yPct: 10, side: 'right', thicknessPx: 18 },

                        { yPct: 33, side: 'left',  thicknessPx: 18 },
                        { yPct: 33, side: 'right', thicknessPx: 18 },

                        { yPct: 56, side: 'left',  thicknessPx: 18 },
                        { yPct: 56, side: 'right', thicknessPx: 18 },

                    ],

                    slotPlan: [
                        { branchIndex: 0, count: 2 },
                        { branchIndex: 1, count: 2 },
                        { branchIndex: 2, count: 2 },
                        { branchIndex: 3, count: 2 },
                        { branchIndex: 4, count: 2 },
                        { branchIndex: 5, count: 2 },
                        { branchIndex: 6, count: 2 }, // auch der letzte
                    ],

                    slot: { w: 190, h: 52, gap: 18, offsetFromPier: 26 },
                }
            };
        },

        computed: {
            dockMainStyle() {
                return {
                    left: `${this.layout.mainPier.xPct}%`,
                    top: `${this.layout.mainPier.yPct}%`,
                    width: `${this.layout.mainPier.wPct}%`,
                    height: `${this.layout.mainPier.hPct}%`,
                };
            },

            pierBranches() {
                const mainX = this.layout.mainPier.xPct;
                const mainW = this.layout.mainPier.wPct;

                // Einheitliche Länge für ALLE Fingerstege
                const L = this.layout.uniformBranchLengthPct;

                return this.layout.branches.map((b, i) => {
                    const isLeft = b.side === 'left';
                    const y = `${b.yPct}%`;
                    const h = `${b.thicknessPx}px`;

                    let left, width;
                    width = `${L}%`;

                    if (isLeft) {
                        // Links: Branch endet am Hauptsteg
                        left = `${mainX - L}%`;
                    } else {
                        // Rechts: Branch startet am Hauptsteg
                        left = `${mainX + mainW}%`;
                    }

                    return {
                        id: i,
                        style: { top: y, left, width, height: h },
                        label: null,
                        labelStyle: null
                    };
                });
            },

            selectedSlots() {
                return this.gridSlots.filter(s => this.selectedSlotIds.includes(s.id));
            },

            selectedSlotInfo() {
                if (!this.selectedSlotIds.length) return 'Kein Platz ausgewählt';

                // hübsch: Liste der Slot-Nummern
                const labels = this.selectedSlots.map(s => (s.slot_number || s.id));
                return `Ausgewählt: ${labels.join(', ')}`;
            },


            selectedBoatInfo() {
                if (!this.selectedBoatId) return 'Kein Boot ausgewählt';
                const boat = this.boatsInWater.find(b => b.id === this.selectedBoatId);
                if (!boat) return 'Boot nicht gefunden';
                return `${boat.name} (${boat.length}m, ${boat.type || 'Boot'})`;
            },

            canSubmitBooking() {
                return this.selectedSlotIds.length > 0 &&
                    this.formData.name &&
                    this.formData.email &&
                    this.formData.start_date &&
                    this.formData.end_date;
            }
        },

        methods: {
            getBoatGradient(category) {
                const colors = {
                    premium: 'linear-gradient(135deg, #2c3e50 0%, #34495e 100%)',
                    comfort: 'linear-gradient(135deg, #3498db 0%, #2980b9 100%)',
                    standard: 'linear-gradient(135deg, #1abc9c 0%, #16a085 100%)',
                    economy: 'linear-gradient(135deg, #95a5a6 0%, #7f8c8d 100%)'
                };
                return colors[category] || colors.standard;
            },

            /**
             * Slot-Style:
             * - Wenn Backend Koordinaten liefert (x,y,w,h): nutze die.
             * - Sonst: lege Slots in einem festen Plan entlang der Branches an (Layout wie Bild).
             */
            getSlotStyle(slot) {
                // 1) Backend-Koordinaten
                if (typeof slot.x === 'number' && typeof slot.y === 'number') {
                    return {
                        left: `${slot.x}px`,
                        top: `${slot.y}px`,
                        width: `${slot.w || 190}px`,
                        height: `${slot.h || 52}px`,
                    };
                }
                // 2) Aus generiertem Layout
                if (slot._layout && typeof slot._layout.left === 'number') {
                    return {
                        left: `${slot._layout.left}px`,
                        top: `${slot._layout.top}px`,
                        width: `${slot._layout.width}px`,
                        height: `${slot._layout.height}px`,
                    };
                }
                // Fallback (sollte nicht passieren)
                return { left: `20px`, top: `20px`, width: `190px`, height: `52px` };
            },

            ensureSlotsHaveLayout() {
                const view = document.getElementById('marinaView');
                if (!view) return;

                const rect = view.getBoundingClientRect();

                // Wenn bereits alle Slots x/y haben -> nichts tun
                const hasAllXY = this.gridSlots.every(s => typeof s.x === 'number' && typeof s.y === 'number');
                if (hasAllXY) return;

                // Slotplan -> BranchIndex Reihenfolge -> Slots in Reihenfolge belegen
                const plan = this.layout.slotPlan;
                const branches = this.layout.branches;

                const slotW = this.layout.slot.w;
                const slotH = this.layout.slot.h;
                const gap = this.layout.slot.gap;
                const offset = this.layout.slot.offsetFromPier;

                // Reihenfolge: so wie im Plan
                const orderedSlots = [...this.gridSlots];

                let cursor = 0;

                plan.forEach(p => {
                    const b = branches[p.branchIndex];
                    if (!b) return;

                    for (let i = 0; i < p.count; i++) {
                        const slot = orderedSlots[cursor];
                        if (!slot) return;

                        const mainXpx = rect.width * (this.layout.mainPier.xPct / 100);
                        const mainWpx = rect.width * (this.layout.mainPier.wPct / 100);
                        const yPx = rect.height * (b.yPct / 100);

                        // slot-top: etwas unterhalb des Fingerstegs
                        const top = Math.max(10, yPx + (b.thicknessPx / 2) + 20 + (i * (slotH + gap)));

                        let left;
                        if (b.side === 'left') {
                            // Links: Slots links vom Hauptsteg
                            left = Math.max(10, (mainXpx - offset - slotW));
                        } else {
                            // Rechts: Slots rechts vom Hauptsteg
                            left = Math.min(rect.width - slotW - 10, (mainXpx + mainWpx + offset));
                        }

                        // Für mehrere Slots an gleicher Branch "untereinander" wie im Sketch unten rechts 2
                        slot._layout = { left, top, width: slotW, height: slotH };
                        cursor++;
                    }
                });

                // Wenn mehr Slots als Plan: unterhalb weiter auffädeln (rechts)
                while (cursor < orderedSlots.length) {
                    const slot = orderedSlots[cursor];
                    const fallbackTop = 120 + (cursor * (slotH + 12)) % Math.max(200, rect.height - 120);
                    const left = rect.width * 0.68;
                    slot._layout = { left: Math.min(rect.width - slotW - 10, left), top: fallbackTop, width: slotW, height: slotH };
                    cursor++;
                }
            },

            // Drag & Drop
            onDragStart(event) {
                this.draggedBoat = { id: 'anchor', name: 'Reservierung' };
                event.dataTransfer.setData('text/plain', 'anchor');
                event.dataTransfer.effectAllowed = 'move';

                // falls du den dragging-style nutzen willst:
                if (event?.target?.classList) event.target.classList.add('dragging');
            },

            onDragEnd(event) {
                this.draggedBoat = null;
                this.dragOverId = null;

                if (event?.target?.classList) event.target.classList.remove('dragging');
            },


            onDragOver(slotId) {
                const slot = this.gridSlots.find(s => s.id === slotId);
                if (!slot) return false;

                if (slot.status === 'available') {
                    this.dragOverId = slotId;
                    return true;
                }
                this.dragOverId = null;
                return false;
            },

            onDrop(slot) {
                if (!this.draggedBoat || slot.status !== 'available') {
                    this.dragOverId = null;
                    return;
                }

                slot.status = 'booked';
                slot.boatName = 'Reserviert';

                if (!this.selectedSlotIds.includes(slot.id)) {
                    this.selectedSlotIds.push(slot.id);
                }

                this.selectedSlotId = slot.id;
                this.dragOverId = null;
            },
            addBoatToPalette(boat) {
                // Wenn Boot schon da ist, nur auswählen
                const exists = this.boatsInWater.some(b => b.id === boat.id);
                if (!exists) {
                    this.boatsInWater.push({
                        id: boat.id,
                        name: boat.name,
                        type: boat.boat_type || 'Boot',
                        category: boat.category || 'standard',
                        length: boat.length || 0
                    });
                }
                this.selectedBoatId = boat.id;
                this.activeTab = 'slots';
                alert(`"${boat.name}" ist als Symbol verfügbar. Ziehe es unten links auf einen freien Platz.`);
            },

            resetSelection() {
                this.selectedSlotId = null;
                this.selectedBoatId = null;
                this.dragOverId = null;
                this.draggedBoat = null;
            },

            resetAllLocalBookings() {
                if (!confirm('Alle lokalen Buchungen zurücksetzen?')) return;

                this.gridSlots.forEach(s => {
                    if (s.status === 'booked') {
                        s.status = 'available';
                        s.boatName = null;
                    }
                });
                this.localBookings = [];
                this.resetSelection();
                alert('Lokale Buchungen wurden zurückgesetzt.');
            },

            simulateLocalBooking() {
                const free = this.gridSlots.filter(s => s.status === 'available');
                if (!free.length) return alert('Keine freien Plätze mehr (lokal).');

                const slot = free[Math.floor(Math.random() * free.length)];
                const boat = this.boatsInWater[Math.floor(Math.random() * this.boatsInWater.length)];

                slot.status = 'booked';
                slot.boatName = boat.name;

                this.localBookings.push({
                    slot_id: slot.id,
                    slot_number: slot.slot_number || slot.id,
                    boat_id: boat.id,
                    boat_name: boat.name,
                    ts: new Date().toISOString()
                });

                alert(`Simuliert: "${boat.name}" auf Platz ${slot.slot_number || slot.id}`);
            },

            showLocalBookings() {
                if (!this.localBookings.length) return alert('Keine lokalen Buchungen vorhanden.');
                const lines = this.localBookings.map((b, i) => `${i+1}. Platz ${b.slot_number} – ${b.boat_name} (${b.ts})`);
                alert(`Lokale Buchungen:\n\n${lines.join('\n')}`);
            },

            async submitBooking() {
                if (!this.canSubmitBooking) {
                    alert('Bitte Boot & Platz auswählen und alle Felder ausfüllen.');
                    return;
                }

                const slot = this.gridSlots.find(s => s.id === this.selectedSlotId);
                const boat = this.boatsInWater.find(b => b.id === this.selectedBoatId);

                if (!slot || !boat) {
                    alert('Fehler: Slot oder Boot nicht gefunden.');
                    return;
                }

                // Hier kannst du wie in deinem Original Code ans Backend schicken:
                const bookingData = {
                    slot_id: slot.id,
                    slot_number: slot.slot_number || slot.id,
                    boat_id: boat.id,
                    boat_name: boat.name,
                    ...this.formData
                };

                try {
                    // Beispiel (anpassen an deine Route):
                    // const response = await fetch('/booking/bookSlot', { ... });
                    // const result = await response.json();

                    // Demo: Erfolg simulieren
                    const result = { success: true, message: 'Reservierung gespeichert (Demo).' };

                    if (result.success) {
                        alert('Buchung erfolgreich! ' + result.message);

                        // WICHTIG: Boot-Symbol soll zurückspringen -> es bleibt sowieso in Palette.
                        // Optional: Auswahl zurücksetzen, aber Slot bleibt gebucht.
                        this.resetSelection();

                        // Formular reset (optional)
                        this.formData.notes = '';
                    } else {
                        alert('Fehler: ' + (result.message || 'Unbekannter Fehler'));
                    }
                } catch (err) {
                    alert('Netzwerkfehler: ' + err.message);
                }
            },
        },

        mounted() {
            // Datum initialisieren
            const today = new Date().toISOString().split('T')[0];
            const tomorrow = new Date(Date.now() + 86400000).toISOString().split('T')[0];
            this.formData.start_date = today;
            this.formData.end_date = tomorrow;

            // Layout erzeugen (Slots entlang der Stege, nicht clustern!)
            this.ensureSlotsHaveLayout();

            // Bei Resize Layout neu berechnen
            window.addEventListener('resize', () => this.ensureSlotsHaveLayout());
        }
    }).mount('#app');
</script>
</body>
</html>
