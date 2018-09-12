<?php
namespace seku\Guess;

include(__DIR__ . "/config.php");
require __DIR__ . "/../../vendor/autoload.php";

session_name("seku17");
session_start();

$title = "Guess the number(SESSION)";

$_SESSION["number"] = $_POST["number"] ?? -1;
$_SESSION["guess"] = $_POST["guess"] ?? null;
$_SESSION["tries"] = $_POST["tries"] ?? 6;

$game = new Guess($_SESSION["number"], $_SESSION["tries"]);

$res = null;
if (isset($_POST["guess"]) && $_POST["guess"] != null) {
    try {
        $res = $game->makeGuess((int)$_SESSION["guess"]);
        $_SESSION["tries"] --;
    } catch (IsOutOfRange $e) {
        $res = $e->getMessage();
    }
}

$cheat = null;
if (isset($_POST["cheat"])) {
    $cheat = $_SESSION["number"];
}

if (isset($_POST["reset"]) || $_SESSION["number"] == -1) {
    $game->random();
    $_SESSION["number"] = $game->getNumber();
    $game->resetTries();
}

// Modified state
// $_GET["number"] == $game->getNumber()
// $_GET["tries"] == $game->getTries()

?><!doctype html>
<meta charset="utf-8">
<title><?= $title ?></title>
<h1><?= $title ?></h1>
<form method="post">
    <input type="number" name="guess">
    <input type="hidden" name="number" value="<?= $_SESSION["number"] ?>">
    <input type="hidden" name="tries" value="<?= $_SESSION["tries"] ?>">
    <input type="submit" value="Submit">
    <input type="submit" name="reset" value="Reset">
    <input type="submit" name="cheat" value="Cheat">
</form>
<p><?= $res ?></p>
<p>Cheat: <?= $cheat ?></p>
