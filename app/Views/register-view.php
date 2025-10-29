<form method="post" action="<?= esc(base_url('register/submit')) ?>">
  <?= csrf_field() ?>
  <h2>Gib deinen Namen ein:</h2>

  <label for="firstName">Vorname:</label><br>
  <input id="firstName" type="text" name="firstName" required><br><br>

  <label for="lastName">Nachname:</label><br>
  <input id="lastName" type="text" name="lastName" required><br><br>

  <label for="email">E-Mail:</label><br>
  <input id="email" type="email" name="email" required><br><br>

  <label for="password">Passwort:</label><br>
  <input id="password" type="password" name="password" required><br><br>

  <input type="submit" value="Absenden">
</form>

<a href="<?= route_to('login') ?>">Anmelden</a>
<a href="<?= base_url('/') ?>">Zurück zur Startseite</a>