<?php
/**
 * Routes for guess game.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Guess my number with GET.
 */
$app->router->get("gissa/get", function () use ($app) {
    $data = [
        "title" => "Gissa mitt nummer(GET)",
    ];
    //include __DIR__ . "/../htdocs/guess/index_get_inside.php";

    //include(__DIR__ . "/config.php");
    //require __DIR__ . "/../../vendor/autoload.php";

    $number = $_GET["number"] ?? -1;
    $tries  = $_GET["tries"]  ?? 6;
    $guess  = $_GET["guess"]  ?? null;

    // $number === inial state

    $game = new \seku\Guess\Guess($number, $tries);

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

    $data["game"] = $game;
    $data["res"] = $res;
    $data["guess"] = $guess;
    $data["cheat"] = $cheat;

    $app->view->add("guess/get", $data);
    return $app->page->render($data);
});

/**
 * Guess my number with POST.
 */
$app->router->any(["GET", "POST"], "gissa/post", function () use ($app) {
    $data = [
        "title" => "Gissa mitt nummer(POST)",
    ];
    //include __DIR__ . "/../htdocs/guess/index_get_inside.php";

    //include(__DIR__ . "/config.php");
    //require __DIR__ . "/../../vendor/autoload.php";

    $number = $_POST["number"] ?? -1;
    $tries  = $_POST["tries"]  ?? 6;
    $guess  = $_POST["guess"]  ?? null;

    // $number === inial state

    $game = new \seku\Guess\Guess($number, $tries);

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

    $data["game"] = $game;
    $data["res"] = $res;
    $data["guess"] = $guess;
    $data["cheat"] = $cheat;

    $app->view->add("guess/post", $data);
    return $app->page->render($data);
});

$app->router->any(["GET", "POST"], "gissa/session", function () use ($app) {
    $data = [
        "title" => "Gissa mitt nummer(session)",
    ];
    //include __DIR__ . "/../htdocs/guess/index_get_inside.php";

    //include(__DIR__ . "/config.php");
    //require __DIR__ . "/../../vendor/autoload.php";

    session_destroy();
    session_name("seku17");
    session_start();

    $_SESSION["number"] = $_POST["number"] ?? -1;
    $_SESSION["guess"] = $_POST["guess"] ?? null;
    $_SESSION["tries"] = $_POST["tries"] ?? 6;

    $game = new \seku\Guess\Guess($_SESSION["number"], $_SESSION["tries"]);

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

    $data["game"] = $game;
    $data["res"] = $res;
    $data["cheat"] = $cheat;

    $app->view->add("guess/post", $data);
    return $app->page->render($data);
});
