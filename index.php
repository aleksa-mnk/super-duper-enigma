<?php
// подключение к БД
require_once 'db/db.php';

// получение данных с формы
$startDate = $_POST["startDate"];
$finishDate = $_POST["finishDate"];

// колонка Сотрудник и Date
$employee = 'employee';
$employeedate = 'employeedate';

$getnames = "SELECT DISTINCT $employee FROM $table WHERE ($employeedate BETWEEN '" .
    date_format(date_create($startDate), 'Y-m-d') .
    "' AND '" . date_format(date_create($finishDate), 'Y-m-d') . "')";

$sth2 = $pdo->prepare($getnames);
$sth2->execute();
$array2 = $sth2->fetchAll(PDO::FETCH_ASSOC);

$resultText2 = "";

echo "<script>
    var url = 'ajax.js';
    $.getScript(url);
    </script>";

$resultText2 .= "<div id='tabs'><ul class='tabs-nav'>
<li><a href='#tab-0'>Все</a></li>";
$i = 0;
$arrayofstaff = ['Все'];

foreach ($array2 as $item => $value) {

    foreach ($value as $item) {
        $i++;
        $resultText2 .= "<li><a href='#tab-" . $i . "'>" . $item . "</a></li>";
        array_push($arrayofstaff, $item);
    }
}

$resultText2 .= "</ul>";

echo $resultText2;

$num = 0;

echo "<div class='tabs-items'>";

foreach ($arrayofstaff as $item) {
    $queryText = "SELECT * FROM $table WHERE ($employeedate BETWEEN '" .
        date_format(date_create($startDate), 'Y-m-d') .
        "' AND '" . date_format(date_create($finishDate), 'Y-m-d') . "')";

    if ($num != 0) {
        $queryText .= " AND $employee = '" . $item . "'";
    }

    $sth = $pdo->prepare($queryText);
    $sth->execute();
    $array = $sth->fetchAll(PDO::FETCH_ASSOC);

    echo "<div class='tabs-item' id='tab-" . $num . "'>";
    echo '<div style="text-align: center;">
    <div style="margin: 0 auto; width: 70%; white-space: nowrap;">
        <input type="button" value="getCSV" style="display: inline-block;" />
        <input type="text" value="0" style="display: inline-block;" />
    </div><br />

    <table cellpadding="5" cellspacing="0" border="1" style="margin: 0 auto; width: 80%;">
        <thead>
        <tr>
        <th>№</th>
        <th>Date</th>
        <th>Сотрудник</th>
        <th>Task</th>
        <th>Затраченое время</th>
        <th>Часовая ставка</th>
        <th>Сумма</th>
        </tr>
        </thead><tbody>';

    $id = 1;
    // вывод таблицы
    foreach ($array as $item => $value) {
        array_shift($value);
        echo "<tr>";
        echo "<td>" . $id . "</td>";
        foreach ($value as $item) {
            echo "<td>" . $item . "</td>";
        }
        echo "</tr>";
        $id++;
    }

    echo "</tbody></table></div></div>";
    // echo $resultText;

    $num++;
}

echo "</div>";