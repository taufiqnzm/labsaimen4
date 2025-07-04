<?php
$conn = new mysqli("localhost", "root", "", "lab4");
if ($conn->connect_error)
    die("Connection failed: " . $conn->connect_error);

$sql = "SELECT components, expenditure2010, expenditure2011 FROM expenditure";
$result = $conn->query($sql);

$labels = $exp2010 = $exp2011 = [];
while ($row = $result->fetch_assoc()) {
    $labels[] = $row['components'];
    $exp2010[] = $row['expenditure2010'];
    $exp2011[] = $row['expenditure2011'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Expenditure Charts (2010 vs 2011)</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #f8f9fa, #e9ecef);
            padding: 40px 20px;
            color: #333;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.05);
            padding: 40px 30px;
        }

        h1 {
            text-align: center;
            font-size: 32px;
            margin-bottom: 50px;
            color: #0077cc;
        }

        .chart-section {
            margin-bottom: 80px;
        }

        .chart-title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 25px;
            color: #343a40;
        }

        canvas {
            display: block;
            margin: 0 auto;
            max-width: 100%;
            height: 500px !important;
        }

        hr {
            border: none;
            height: 2px;
            background: #dee2e6;
            margin: 60px 0;
            border-radius: 4px;
        }

        footer {
            text-align: center;
            font-size: 14px;
            color: #888;
            margin-top: 60px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Domestic Expenditure Comparison<br>(2010 vs 2011)</h1>

        <div class="chart-section">
            <div class="chart-title">📊 Bar Chart: Expenditure by Component</div>
            <canvas id="barChart"></canvas>
        </div>

        <hr>

        <div class="chart-section">
            <div class="chart-title">📈 Line Chart: Expenditure Trend</div>
            <canvas id="lineChart"></canvas>
        </div>
    </div>

    <footer>Lab Activity – Web Development | BIC 21203</footer>

    <script>
        const labels = <?= json_encode($labels) ?>;
        const data2010 = <?= json_encode($exp2010) ?>;
        const data2011 = <?= json_encode($exp2011) ?>;

        // Bar Chart
        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels,
                datasets: [
                    {
                        label: '2010',
                        data: data2010,
                        backgroundColor: 'rgba(255, 99, 132, 0.7)'
                    },
                    {
                        label: '2011',
                        data: data2011,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)'
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                    title: {
                        display: true,
                        text: 'Comparison of Expenditure by Component'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'RM (Millions)' }
                    }
                }
            }
        });

        // Line Chart
        new Chart(document.getElementById('lineChart'), {
            type: 'line',
            data: {
                labels,
                datasets: [
                    {
                        label: '2010',
                        data: data2010,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        tension: 0.3,
                        fill: true
                    },
                    {
                        label: '2011',
                        data: data2011,
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        tension: 0.3,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                    title: {
                        display: true,
                        text: 'Trend of Visitor Expenditure Over Time'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'RM (Millions)' }
                    }
                }
            }
        });
    </script>

</body>

</html>