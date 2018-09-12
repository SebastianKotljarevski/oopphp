<?php

namespace seku\Guess;

include(__DIR__ . "/config.php");
require __DIR__ . "/../../vendor/autoload.php";

$title = "Guess the number(GET)";

$number = $_GET["number"] ?? -1;
$tries  = $_GET["tries"]  ?? 6;
$guess  = $_GET["guess"]  ?? null;

// $number === inial state

$game = new Guess($number, $tries);

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
