<?php
/**
 * Routes for guess game.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Guess my number with GET.
 */
$app->router->any(["GET", "POST"], "dice100", function () use ($app) {
    include "../src/Guess/dice100.php";

    $data = [
        "testing" => "testar lite PHP kod"
    ];

    $_SESSION["playerRollOnetemp"] = [];
    $_SESSION["playerRollTwotemp"] = [];
    $_SESSION["playerRollOne"] = [];
    $_SESSION["playerRollTwo"] = [];
    $_SESSION["computerRoll"] = [];
    $_SESSION["temp"] = $_SESSION["temp"] ?? 0;
    $_SESSION["playerscore"] = $_SESSION["playerscore"] ?? 0;
    $_SESSION["computerscore"] = $_SESSION["computerscore"] ?? 0;
    $_SESSION["count"] = $_SESSION["count"] ?? 0;
    $_SESSION["whowon"] = $_SESSION["whowon"] ?? "";

    $dice = new \seku\Guess\Dice();

    $dice->setCount($_SESSION["count"]);

    if (isset($_POST["roll"])) {
        array_push($_SESSION["playerRollOne"], rand(1, 6));
        array_push($_SESSION["playerRollTwo"], rand(1, 6));

        if ($dice->getCount() == 0) {
            if (in_array(1, $_SESSION["playerRollOne"])) {
                $_SESSION["playerRollOnetemp"] = $_SESSION["playerRollOne"];
                $_SESSION["playerRollTwotemp"] = $_SESSION["playerRollTwo"];
                array_pop($_SESSION["playerRollOne"]);
                $dice->setTempScore(array_sum($_SESSION["playerRollOne"]) + array_sum($_SESSION["playerRollTwo"]));
                $_SESSION["temp"] += $dice->getTempScore();
                $_SESSION["count"] = 1;
                $dice->setCount(1);
            } elseif (in_array(1, $_SESSION["playerRollTwo"])) {
                $_SESSION["playerRollTwotemp"] = $_SESSION["playerRollTwotemp"];
                $_SESSION["playerRollOnetemp"] = $_SESSION["playerRollOne"];
                array_pop($_SESSION["playerRollTwo"]);
                $dice->setTempScore(array_sum($_SESSION["playerRollOne"]) + array_sum($_SESSION["playerRollTwo"]));
                $_SESSION["temp"] += $dice->getTempScore();
                $_SESSION["count"] = 1;
                $dice->setCount(1);
            } else {
                $_SESSION["playerRollOnetemp"] = $_SESSION["playerRollOne"];
                $_SESSION["playerRollTwotemp"] = $_SESSION["playerRollTwo"];
                $dice->setTempScore(array_sum($_SESSION["playerRollOne"]) + array_sum($_SESSION["playerRollTwo"]));
                $_SESSION["temp"] += $dice->getTempScore();
                $_SESSION["count"] = 1;
                $dice->setCount(1);
            }
        } elseif ($dice->getCount() == 1) {
            if (in_array(1, $_SESSION["playerRollOne"]) || in_array(1, $_SESSION["playerRollTwo"])) {
                $_SESSION["playerRollOnetemp"] = $_SESSION["playerRollOne"];
                $_SESSION["playerRollTwotemp"] = $_SESSION["playerRollTwo"];
                $dice->setTempScoreToZero();
                $_SESSION["temp"] = $dice->getTempScore();

                for ($i=0; $i < 2; $i++) {
                    array_push($_SESSION["computerRoll"], rand(1, 6));
                }


                if (in_array(1, $_SESSION["computerRoll"])) {
                    $_SESSION["count"] = 0;
                    $dice->setCount(0);
                } else {
                    $dice->setTempScore(array_sum($_SESSION["computerRoll"]));
                    $_SESSION["tempcomp"] = $dice->getTempScore();
                    $_SESSION["computerscore"] += $_SESSION["tempcomp"];
                    $_SESSION["count"] = 0;
                    $dice->setCount(0);
                }
            } else {
                $_SESSION["playerRollOnetemp"] = $_SESSION["playerRollOne"];
                $_SESSION["playerRollTwotemp"] = $_SESSION["playerRollTwo"];
                $dice->setTempScore(array_sum($_SESSION["playerRollOne"]) + array_sum($_SESSION["playerRollTwo"]));
                $_SESSION["temp"] += $dice->getTempScore();
                $_SESSION["count"] = 1;
                $dice->setCount(1);
            }
        }
    }

    if (isset($_POST["stop"])) {
        $_SESSION["playerscore"] += $_SESSION["temp"];

        for ($i=0; $i < 2; $i++) {
            array_push($_SESSION["computerRoll"], rand(1, 6));
        }

        if (in_array(1, $_SESSION["computerRoll"])) {
            $_SESSION["count"] = 0;
            $dice->setCount(0);
        } else {
            $dice->setTempScore(array_sum($_SESSION["computerRoll"]));
            $_SESSION["tempcomp"] = $dice->getTempScore();
            $_SESSION["computerscore"] += $_SESSION["tempcomp"];
            $_SESSION["temp"] = 0;
            $_SESSION["count"] = 0;
            $dice->setCount(0);
        }
    }

    if (isset($_POST["reset"])) {
        $_SESSION["playerscore"] = 0;
        $_SESSION["computerscore"] = 0;
        $_SESSION["count"] = 1;
        $dice->setCount(0);
        $_SESSION["temp"] = 0;
        $_SESSION["whowon"] = "";
    }

    if ($_SESSION["playerscore"] >= 100) {
        $_SESSION["whowon"] = '<div style="color: green;">You won vs computer!</div>';
    } elseif ($_SESSION["computerscore"] >= 100) {
        $_SESSION["whowon"] = '<div style="color: red;">Computer won vs you!</div>';
    }

    $_SESSSION["count"] = $dice->getCount();

    $app->view->add("guess/dice100", $data);
    return $app->page->render($data);
});
