<?php
require_once "../connec.php";
$pdo = new PDO(DSN, USER, PASS);

$errors = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_POST['name'])) {
        $errors[] = 'Name is empty';
    }

    if (!isset($_POST['payment']) || $_POST['payment'] <= 0) {
        $errors[] = 'Payment must be higher than 0';
    }

    if (count($errors) > 0) {
        var_dump($errors);
        die();
    }

    $name = trim($_POST['name']);
    $payment = trim($_POST['payment']);

    $query = "INSERT INTO bribe(name, payment) VALUES (:name, :payment)";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':name', $name, PDO::PARAM_STR);
    $statement->bindValue(':payment', $payment, PDO::PARAM_INT);
    $statement->execute();
}

$query = 'SELECT * FROM bribe ORDER BY name';
$statement = $pdo->query($query);
$bribes = $statement->fetchAll();

$query = 'SELECT SUM(payment) FROM bribe';
$total = $pdo->query($query)->fetch();



?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/book.css">
    <title>Checkpoint PHP 1</title>
</head>
<body>

<?php include 'header.php'; ?>

<main class="container">

    <section class="desktop">
        <img src="image/whisky.png" alt="a whisky glass" class="whisky"/>
        <img src="image/empty_whisky.png" alt="an empty whisky glass" class="empty-whisky"/>

        <div class="pages">
            <div class="page leftpage">
                Add a bribe
                <!-- TODO : Form -->

                <form method="post">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name">
                    <label for="">Payment</label>
                    <input type="text" id="payment" name="payment">
                    <button type="submit">Submit</button>
                </form>
            </div>

            <div class="page rightpage">
                <!-- TODO : Display bribes and total paiement -->
                <table>

                    <?php
                    foreach ($bribes as $bribe) {
                        ?>
                        <tr>
                            <td><?= $bribe['name'] ?></td>
                            <td><?=  $bribe['payment'] ?></td>
                        </tr>

                        <?php } ?>

                    <tr>
                        <td>Total :</td>
                        <td> <?= $total[0] ?> </td>
                    </tr>
                </table>
            </div>
        </div>
        <img src="image/inkpen.png" alt="an ink pen" class="inkpen"/>
    </section>
</main>
</body>
</html>
