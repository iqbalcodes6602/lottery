<?php
include("db.php");

// check if user already has entries
$email = $_POST['email'];
$query = "SELECT * FROM entries WHERE email='$email'";
$result = $db->query($query);

$status = 1;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // update number of entries based on rules
    if ($row['num_entries'] == 1) {
        $status = 1;
        $num_entries = 2;
    } else if ($row['num_entries'] == 4) {
        $status = 1;
        $num_entries = 5;
    } else {
        $status = 0;
        if ($row['num_entries'] < 6) {
            $num_entries = $row['num_entries'] + 1;
        }else{
            $num_entries = $row['num_entries'];
        }
    }

    $query = "UPDATE entries SET num_entries=$num_entries, status=$status WHERE id={$row['id']}";
} else {
    // insert new entry
    $name = $_POST['name'];
    $num_entries = 1;

    $query = "INSERT INTO entries (name, email, num_entries, timestamp) VALUES ('$name', '$email', $num_entries, now())";
}

$result = $db->query($query);

if ($result) {
    if ($status == 0) {
        echo 'You are disqualified.';
    } else {
        echo 'Entry submitted successfully.';
    }
} else {
    echo 'Error submitting entry.';
}

$db->close();
