<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootverleihe
    </title>
</head>
<body>

    <form method="post" action="">
        <h2>Gib deinen Namen ein:</h2>
        <p for="name">Vorname:</p>
        <input type="text" name="firstName" required>
        <p for="name">Nachname:</p>
        <input type="text" name="lastName" required>
        <p for="name">E-Mail:</p>
        <input type="text" name="email" required>
        <p for="name">Passwort:</p>
        <input type="text" name="passwort" required>
        <br><br>
        <input type="submit" value="Absenden">
        <a href="<?= route_to('home') ?>">Zurück zur Startseite</a>
    </form>
</body>
</html>