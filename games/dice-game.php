<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dice Roll Game</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #1f1f1f;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }
        .container {
            background-color: #2c2c2c;
            padding: 30px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.6);
        }
        .dice {
            width: 100px;
            height: 100px;
            margin: 20px auto;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 5px solid #fff;
            border-radius: 15px;
            background-color: #3b3b3b;
            position: relative;
        }
        .dice svg {
            width: 80px;
            height: 80px;
            transition: transform 0.6s ease;
        }
        .dice.rotate {
            animation: rollDice 0.6s ease;
        }
        @keyframes rollDice {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(720deg); }
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #7289da;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #677bc4;
        }
        .score {
            font-size: 24px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>🎲 Dice Roll Game</h2>

    <?php
    session_start();
    
    if (!isset($_SESSION['score'])) {
        $_SESSION['score'] = 0;
        $_SESSION['game_over'] = false;
    }

    $diceRotationClass = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && !$_SESSION['game_over']) {
        $roll = rand(1, 6);
        $diceRotationClass = 'rotate';

        if ($roll == 6) {
            $_SESSION['game_over'] = true;
        } elseif ($roll % 2 != 0) {
            $_SESSION['score'] += 5;
        }

        if ($_SESSION['score'] >= 25) {
            $_SESSION['game_over'] = true;
            $win = true;
        }
    }

    if (isset($_POST['reset'])) {
        $_SESSION['score'] = 0;
        $_SESSION['game_over'] = false;
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    $roll = isset($roll) ? $roll : 1;
    ?>

    <div class="dice <?php echo $diceRotationClass; ?>">
        <?php
        // SVG for the dice faces
        switch ($roll) {
            case 1:
                echo '<svg viewBox="0 0 100 100"><circle cx="50" cy="50" r="10" fill="#fff"/></svg>';
                break;
            case 2:
                echo '<svg viewBox="0 0 100 100"><circle cx="25" cy="25" r="10" fill="#fff"/><circle cx="75" cy="75" r="10" fill="#fff"/></svg>';
                break;
            case 3:
                echo '<svg viewBox="0 0 100 100"><circle cx="25" cy="25" r="10" fill="#fff"/><circle cx="50" cy="50" r="10" fill="#fff"/><circle cx="75" cy="75" r="10" fill="#fff"/></svg>';
                break;
            case 4:
                echo '<svg viewBox="0 0 100 100"><circle cx="25" cy="25" r="10" fill="#fff"/><circle cx="75" cy="25" r="10" fill="#fff"/><circle cx="25" cy="75" r="10" fill="#fff"/><circle cx="75" cy="75" r="10" fill="#fff"/></svg>';
                break;
            case 5:
                echo '<svg viewBox="0 0 100 100"><circle cx="25" cy="25" r="10" fill="#fff"/><circle cx="75" cy="25" r="10" fill="#fff"/><circle cx="50" cy="50" r="10" fill="#fff"/><circle cx="25" cy="75" r="10" fill="#fff"/><circle cx="75" cy="75" r="10" fill="#fff"/></svg>';
                break;
            case 6:
                echo '<svg viewBox="0 0 100 100"><circle cx="25" cy="25" r="10" fill="#fff"/><circle cx="75" cy="25" r="10" fill="#fff"/><circle cx="25" cy="50" r="10" fill="#fff"/><circle cx="75" cy="50" r="10" fill="#fff"/><circle cx="25" cy="75" r="10" fill="#fff"/><circle cx="75" cy="75" r="10" fill="#fff"/></svg>';
                break;
        }
        ?>
    </div>

    <?php if (!$_SESSION['game_over']) { ?>
        <form method="post">
            <button type="submit">Roll the Dice</button>
        </form>
        <div class="score">Your Score: <?php echo $_SESSION['score']; ?></div>
    <?php } else { ?>
        <div class="score">
            <?php if (isset($win) && $win) { ?>
                🎉 Congratulations! You reached 25 points and won the game!
            <?php } else { ?>
                💥 Game Over! You rolled a 6.
            <?php } ?>
        </div>
        <form method="post">
            <button type="submit" name="reset" value="1">Play Again</button>
            
        </form>
    <?php } ?>
</div>

</body>
</html>
