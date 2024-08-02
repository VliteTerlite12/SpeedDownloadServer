<?php

// buat database
$db = new SQLite3('chat.db');

// buat tabel untuk menyimpan data chat
$db->exec('CREATE TABLE IF NOT EXISTS chat (
    id INTEGER PRIMARY KEY,
    username TEXT,
    message TEXT,
    created_at TEXT
)');

function saveChat($username, $message) {
    global $db;
    $db->exec("INSERT INTO chat (username, message, created_at) VALUES ('$username', '$message', datetime('now'))");
}

function displayChat() {
    global $db;
    $result = $db->query("SELECT * FROM chat ORDER BY created_at ASC");
    while ($row = $result->fetchArray()) {
        echo $row['username'] . ': ' . $row['message'] . "\n";
    }
}

function changeUsername($newUsername) {
    global $username;
    $username = $newUsername;
    echo "Username berhasil diubah menjadi $newUsername\n";
}

$username = 'Guest'; // default username

while (true) {
    echo "Chat Interface\n";
    echo "1. Kirim Pesan\n";
    echo "2. Ubah Username\n";
    echo "3. Keluar\n";
    echo "Pilih opsi: ";
    $option = trim(fgets(STDIN));

    switch ($option) {
        case '1':
            echo "Masukkan pesan: ";
            $message = trim(fgets(STDIN));
            saveChat($username, $message);
            displayChat();
            break;
        case '2':
            echo "Masukkan username baru: ";
            $newUsername = trim(fgets(STDIN));
            changeUsername($newUsername);
            break;
        case '3':
            echo "Selamat tinggal!\n";
            exit;
        default:
            echo "Opsi tidak valid\n";
    }
}

?
