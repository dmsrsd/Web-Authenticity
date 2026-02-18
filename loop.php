<?php
    $start =  $_GET['start'];
    $limit = 50;
    ini_set('max_execution_time', '300');
    ini_set('memory_limit','2048M');
    //save ke db
    $servername = "localhost";
    $username = "root";
    $password = "Nojoron0123)(";
    $dbname = "gridsf";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // $db['default']['username'] = 'root';
    // $db['default']['password'] = 'Nojoron0123)(';

    // $db['default']['database'] = 'gridsf';
    // Cek koneksi
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql_select = "SELECT * FROM member_new LIMIT $limit OFFSET $start";
    $result = $conn->query($sql_select);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            //print_r($row); exit;
            // Tentukan tanggal
            $dated = ($row['created_date'] == "0000-00-00 00:00:00") 
                ? "2023-05-05 17:09:00" 
                : $row['created_date'];

            // Escaping agar aman
            $dated = $conn->real_escape_string($dated);
            $id_member = (int)$row['id_member'];

            // Query update
            $sql_update = "UPDATE member SET created_date = '$dated' WHERE id_member = $id_member";

            if ($conn->query($sql_update) === TRUE) {
                echo "✅ ID $id_member updated successfully (created_date = $dated)<br>";
            } else {
                echo "❌ Error: " . $sql_update . "<br>" . $conn->error . "<br>";
            }
        }
    } else {
        echo "Tidak ada data ditemukan mulai dari offset $start";
        exit;
    }

    $conn->close();
    $start = $start + $limit;
    header("Refresh: 0.5; url=http://localhost:8003/loop.php?start=".$start);
    die();


?>