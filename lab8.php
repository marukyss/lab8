<?php
// Make the request
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "http://lab.vntu.org/api-server/lab8.php?user=student&pass=p@ssw0rd");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);

$data = curl_exec($ch);

// Parse json
$decoded = json_decode($data, true);

// Flatten the result into a single array
$flattened = [];
foreach ($decoded as $value)
{
    $flattened = array_merge($flattened, $value);
}
?>

<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Лабораторна робота #8</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
</head>

<script>
    function addTableElement(name, affiliation, rank, location) {
        const template = document.getElementById("table-row")
        const table = document.getElementById("table")

        const row = template.content.cloneNode(true)
        const cells = row.querySelectorAll("td")

        cells[0].innerText = name
        cells[1].innerText = affiliation
        cells[2].innerText = rank
        cells[3].innerText = location

        table.appendChild(row)
    }

    window.onload = () => {
        <?php
            foreach ($flattened as $unit)
            {
                echo sprintf("addTableElement('%s', '%s', '%s', '%s');",
                    $unit["name"], $unit["affiliation"], $unit["rank"], $unit["location"]
                );
            }
        ?>
    }
</script>

<body>
<div class="flex flex-col gap-4">
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
            <tr>
                <th scope="col" class="px-6 py-5">
                    Ім'я
                </th>
                <th scope="col" class="px-6 py-5">
                    Фракція
                </th>
                <th scope="col" class="px-6 py-5">
                    Ранг
                </th>
                <th scope="col" class="px-6 py-5">
                    Місцезнаходження
                </th>
            </tr>
        </thead>

        <template id="table-row">
            <tr class="bg-white border-b">
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    Помилка
                </td>
                <td class="px-6 py-4">
                    Помилка
                </td>
                <td class="px-6 py-4">
                    Помилка
                </td>
                <td class="px-6 py-4">
                    Помилка
                </td>
            </tr>
        </template>

        <tbody id="table">

        </tbody>
    </table>
</div>
</body>
</html>
