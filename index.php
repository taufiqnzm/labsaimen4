<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Expenditure Comparison</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #eef3f7;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        h1 {
            color: #1d3557;
            text-align: center;
            margin-bottom: 40px;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
        }

        .chart-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 90%;
            max-width: 650px;
            text-align: center;
            transition: transform 0.2s ease;
        }

        .chart-card:hover {
            transform: translateY(-4px);
        }

        .chart-card h3 {
            margin-bottom: 15px;
            color: #457b9d;
        }

        img {
            width: 100%;
            max-height: 360px;
            object-fit: contain;
            border-radius: 5px;
            background-color: #f8f9fa;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 22px;
            }

            .chart-card h3 {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>
    <h1>Expenditure Comparison: 2010 vs 2011</h1>
    <div class="container">
        <div class="chart-card">
            <h3>Bar Chart: Side-by-side Comparison</h3>
            <img src="bar.php" alt="Bar Chart">
        </div>
        <div class="chart-card">
            <h3>Line Chart: Yearly Trends</h3>
            <img src="line.php" alt="Line Chart">
        </div>
    </div>
</body>

</html>