<?php
namespace seku\Guess;

include(__DIR__ . "/config.php");
require __DIR__ . "/../../vendor/autoload.php";

$title = "Guess the number(POST)";

// Initial state
// $_post["guess"] == 50
// $_post["number"] == 40
// $_post["tries"] == 3

$number = $_POST["number"] ?? -1;
$tries  = $_POST["tries"]  ?? 6;
$guess  = $_POST["guess"]  ?? null;

// $number === inial state

$game = new Guess($number, $tries);

// Actual state
// $game->postTries()
// $game->postNumber()

$cheat = null;
if (isset($_POST["cheat"])) {
    $cheat = $game->getNumber();
}

if (isset($_POST["reset"])) {
    $game->random();
    $game->resetTries();
}

$res = null;
if (isset($_POST["guess"]) && $_POST["guess"] != null) {
    try {
        $res = $game->makeGuess((int)$guess);
    } catch (IsOutOfRange $e) {
        $res = $e->getMessage();
    }
}
// Modified state
// $_post["number"] == $game->postNumber()
// $_post["tries"] == $game->postTries()

?><!doctype html>
<meta charset="utf-8">
<title><?= $title ?></title>
<h1><?= $title ?></h1>
<form method="post">
    <input type="number" name="guess">
    <input type="hidden" name="number" value="<?= $game->getNumber() ?>">
    <input type="hidden" name="tries" value="<?= $game->getTries() ?>">
    <input type="submit" value="Submit">
    <input type="submit" name="reset" value="Reset">
    <input type="submit" name="cheat" value="Cheat">
</form>
<p><?= $res ?></p>
<p>Cheat: <?= $cheat ?></p>
