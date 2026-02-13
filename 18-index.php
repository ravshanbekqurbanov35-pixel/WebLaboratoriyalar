<?php
// =======================
// 2 O‘LCHOVLI MASSIV
// =======================
$talabalar = [
    [
        "ism" => "Ali",
        "familiya" => "Valiyev",
        "baholar" => [5, 4, 5]
    ],
    [
        "ism" => "Vali",
        "familiya" => "Karimov",
        "baholar" => [3, 4, 3]
    ],
    [
        "ism" => "Aziza",
        "familiya" => "Toshmatova",
        "baholar" => [5, 5, 4]
    ],
    [
        "ism" => "Sardor",
        "familiya" => "Qodirov",
        "baholar" => [2, 3, 4]
    ]
];

// =======================
// O‘RTACHA BAHO FUNKSIYASI
// =======================
function ortachaBaho($baholar) {
    return array_sum($baholar) / count($baholar);
}

// =======================
// ENG YUQORI TALABA
// =======================
function engYuqoriTalaba($talabalar) {
    $max = 0;
    $engYuqori = null;

    foreach ($talabalar as $talaba) {
        $ortacha = ortachaBaho($talaba["baholar"]);
        if ($ortacha > $max) {
            $max = $ortacha;
            $engYuqori = $talaba;
        }
    }
    return $engYuqori;
}

// =======================
// 4 DAN PAST TALABALAR
// =======================
function pastTalabalar($talabalar) {
    $past = [];
    foreach ($talabalar as $talaba) {
        if (ortachaBaho($talaba["baholar"]) < 4) {
            $past[] = $talaba;
        }
    }
    return $past;
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Talabalar ro‘yxati</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; text-align:center; }
        table { margin: auto; border-collapse: collapse; width: 80%; background: white; }
        th, td { border: 1px solid black; padding: 8px; }
        th { background: #007BFF; color: white; }
        h2 { margin-top: 40px; }
    </style>
</head>
<body>

<h2>Barcha talabalar</h2>

<table>
    <tr>
        <th>Ism</th>
        <th>Familiya</th>
        <th>Baholar</th>
        <th>O‘rtacha baho</th>
    </tr>

    <?php foreach ($talabalar as $talaba): ?>
    <tr>
        <td><?= $talaba["ism"] ?></td>
        <td><?= $talaba["familiya"] ?></td>
        <td><?= implode(", ", $talaba["baholar"]) ?></td>
        <td><?= number_format(ortachaBaho($talaba["baholar"]), 2) ?></td>
    </tr>
    <?php endforeach; ?>

</table>

<h2>Eng yuqori o‘rtacha bahoga ega talaba</h2>

<?php 
$engYuqori = engYuqoriTalaba($talabalar);
echo $engYuqori["ism"] . " " . $engYuqori["familiya"] . 
" (O‘rtacha: " . number_format(ortachaBaho($engYuqori["baholar"]),2) . ")";
?>

<h2>O‘rtachasi 4 dan past talabalar</h2>

<?php 
$pastlar = pastTalabalar($talabalar);

if (count($pastlar) > 0) {
    foreach ($pastlar as $talaba) {
        echo $talaba["ism"] . " " . $talaba["familiya"] . 
        " (O‘rtacha: " . number_format(ortachaBaho($talaba["baholar"]),2) . ")<br>";
    }
} else {
    echo "Bunday talabalar yo‘q.";
}
?>

</body>
</html>
