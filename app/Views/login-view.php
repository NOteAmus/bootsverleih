<form method="post" action="<?= esc(base_url('register/submit')) ?>">
  <?= csrf_field() ?>
  <h2>Gib deinen Daten ein:</h2>

  <label for="email">E-Mail:</label><br>
  <input id="email" type="email" name="email" required><br><br>

  <label for="password">Passwort:</label><br>
  <input id="password" type="password" name="password" required><br><br>

  <input type="submit" value="Absenden">
</form>
<button href="<?= route_to('/login') ?>">Anmelden</button>
<button href="<?= route_to('/') ?>">Zurück zur Startseite</button>
