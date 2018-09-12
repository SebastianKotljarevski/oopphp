
<h1><?= $title ?></h1>
<form method="get">
    <input type="number" name="guess">
    <input type="hidden" name="number" value="<?= $game->getNumber() ?>">
    <input type="hidden" name="tries" value="<?= $game->getTries() ?>">
    <input type="submit" value="Submit">
    <input type="submit" name="reset" value="Reset">
    <input type="submit" name="cheat" value="Cheat">
</form>
<p><?= $res ?></p>
<p>Cheat: <?= $cheat ?></p>
