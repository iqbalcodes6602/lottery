<?php
include("db.php");

// retrieve all entries
$query = "SELECT * FROM entries where status=1";
$result = $db->query($query);
$entries = $result->fetch_all(MYSQLI_ASSOC);

// loop through entries and assign weight to each
$weighted_entries = [];
foreach ($entries as $entry) {
    if ($entry['num_entries'] == 2) {
        $weighted_entries[] = $entry['id'];
        $weighted_entries[] = $entry['id'];
    } elseif ($entry['num_entries'] == 5) {
        $weighted_entries[] = $entry['id'];
        $weighted_entries[] = $entry['id'];
        $weighted_entries[] = $entry['id'];
    } elseif ($entry['num_entries'] == 1) {
        $weighted_entries[] = $entry['id'];
    }
}

// select a random winner
if (!empty($weighted_entries)) {
    $winner_id = $weighted_entries[array_rand($weighted_entries)];
    $query = "SELECT * FROM entries WHERE id=$winner_id";
    $result = $db->query($query);
    $winner = $result->fetch_assoc();

    // return winner's information as JSON response
    header('Content-Type: application/json');
    echo json_encode($winner);
} else {
    die('No valid entries found.');
}

$db->close();
