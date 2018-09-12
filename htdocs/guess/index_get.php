<?php

namespace seku\Guess;

include(__DIR__ . "/config.php");
require __DIR__ . "/../../vendor/autoload.php";

$title = "Guess the number(GET)";

// Initial state
// $_GET["guess"] == 50
// $_GET["number"] == 40
// $_GET["tries"] == 3

$number = $_GET["number"] ?? -1;
$tries  = $_GET["tries"]  ?? 6;
$guess  = $_GET["guess"]  ?? null;

// $number === inial state

$game = new Guess($number, $tries);

// Actual state
// $game->getTries()
// $game->getNumber()

$cheat = null;
if (isset($_GET["cheat"])) {
    $cheat = $game->getNumber();
}

if (isset($_GET["reset"])) {
    $game->random();
    $game->resetTries();
}

$res = null;
if (isset($_GET["guess"]) && $_GET["guess"] != null) {
    try {
        $res = $game->makeGuess((int)$guess);
    } catch (IsOutOfRange $e) {
        $res = $e->getMessage();
    }
}
// Modified state
// $_GET["number"] == $game->getNumber()
// $_GET["tries"] == $game->getTries()

?><!doctype html>
<meta charset="utf-8">
<title><?= $title ?></title>
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
