<h2>Registrierung erfolgreich!</h2>

<p>Vorname: <?= esc($firstName) ?></p>
<p>Nachname: <?= esc($lastName) ?></p>
<p>E-Mail: <?= esc($email) ?></p>

<a href="<?= route_to('/') ?>">Zur Startseite</a>
<a href="<?= route_to('/login') ?>">Anmelden</a>
