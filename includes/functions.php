
<?php
function getTopScores($conn) {
    $stmt = $conn->prepare("SELECT player_name,game_name, score FROM scores ORDER BY score DESC LIMIT 10");
    $stmt->execute();
    return $stmt->fetchAll();
}

function saveScore($conn, $game_name, $player_name, $score) {
    $stmt = $conn->prepare("INSERT INTO scores (game_name, player_name, score) VALUES (?, ?, ?)");
    $stmt->execute([$game_name, $player_name, $score]);
}

?>
