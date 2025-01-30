<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h2>Voting Results</h2>

    <canvas id="resultsChart"></canvas>

    <?php
    include("../db/db_connect.php");
    $sql = "SELECT * FROM candidates";
    $result = $conn->query($sql);

    $names = [];
    $votes = [];

    while ($row = $result->fetch_assoc()) {
        $names[] = $row['name'];
        $votes[] = $row['votes'];
    }
    ?>

    <script>
        var ctx = document.getElementById('resultsChart').getContext('2d');
        var resultsChart = new Chart(ctx, {
            type: 'bar', 
            data: {
                labels: <?php echo json_encode($names); ?>,
                datasets: [{
                    label: 'Votes',
                    data: <?php echo json_encode($votes); ?>,
                    backgroundColor: 'rgba(245, 0, 0, 0.96)',
                    borderColor: 'rgba(1, 7, 0, 0.78)',
                    borderWidth: 1
                }]
            }
        });
    </script>

</body>
</html>
