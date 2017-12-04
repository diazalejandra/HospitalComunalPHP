<?php

//database configuration
$dbHost = 'localhost:3308';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'dbhospital';

//connect with the database
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

//get search term
$searchTerm = $_GET['term'];

//get matched data from skills table
$query = $db->query("SELECT * FROM paciente WHERE pac_rut LIKE '%" . $searchTerm . "%' ORDER BY pac_rut ASC");
while ($row = $query->fetch_assoc()) {
    $data[] = $row['pac_rut'];
}

if ($data == null) {
    $queryM = $db->query("SELECT * FROM medico WHERE med_rut LIKE '%" . $searchTerm . "%' ORDER BY med_rut ASC");
    while ($row = $queryM->fetch_assoc()) {
        $data[] = $row['med_rut'];
    }
}

//return json data
echo json_encode($data);
?>