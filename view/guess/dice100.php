<h1>Dice100. First to 100 wins.</h1>

<form method="post">
    <input type="submit" name="roll" value="Roll Dices">
    <input type="submit" name="stop" value="Skip roll, save your points">
    <input type="submit" name="reset" value="Restart game">
</form>

<div>
    <h2>Player rolls: <?php
    if (isset($_SESSION['playerRollOnetemp']) && !empty($_SESSION['playerRollTwotemp'])) {
        echo $_SESSION["playerRollOnetemp"][0] . " and " . $_SESSION["playerRollTwotemp"][0];
    }
    ?></h2>
    <h2>Computer rolls: <?php
    if (isset($_SESSION['computerRoll']) && !empty($_SESSION['computerRoll'])) {
        echo $_SESSION["computerRoll"][0] . " and " . $_SESSION["computerRoll"][1];
    }
    ?></h2>
    <h3>Player score this round: <?= $_SESSION["temp"] ?></h3>
    <h3>Player score: <?= $_SESSION["playerscore"] ?></h3>
    <h3>Computer score: <?= $_SESSION["computerscore"] ?></h3>
    <h3>Winner: <?= $_SESSION["whowon"] ?></h3>
</div>
