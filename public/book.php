<?php
require_once __DIR__ . '/../controllers/bribe-controller.php';

$bribes = getAllBribes();




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
    <div class="index-numerique">
<!--
        <?php
/*        //$alphabet = ['a','b','c','d','e', 'f', 'g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
        $alphabet = range('A', 'Z');
        foreach ($alphabet as $letter) {
            echo $letter;
        }
*/?>
        -->
    </div>

    <section class="desktop">
        <img src="image/whisky.png" alt="a whisky glass" class="whisky"/>
        <img src="image/empty_whisky.png" alt="an empty whisky glass" class="empty-whisky"/>

        <div class="pages">
            <div class="page leftpage">
                Add a bribe

                <?php foreach ($errors as $error) : ?>
                    <p><?= $error ?></p>
                <?php endforeach; ?>

                <!-- TODO : Form -->
                <form action='' method="post">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" >
                    <label for="payment">Payment</label>
                    <input type="number" name="payment" id="payment" >
                    <button>Submit</button>
                </form>
            </div>

            <div class="page rightpage">
                <!-- TODO : Display bribes and total paiement -->

                <table>
                        <tr>
                            <th>Name</th>
                            <th>Payment</th>
                        </tr>
                    <?php $sql = "SELECT name, payment FROM bribe ORDER BY name ASC";

                    // Exécution de la requête et récupération des résultats
                    $stmt = createConnection()->query($sql);
                    $results = $stmt->fetchAll();

                    // Affichage des résultats
                    foreach ($results as $row): ;
                        ?> <tr>
                        <td><?= $row['name']; ?></td>
                        <td><?= $row['payment']; ?> $</td>

                    </tr>
                    <?php endforeach; ?>

                <tfoot>
                <tr>
                    <td class="total">Total</td>
                    <td><?= totalBribes(); ?></td>
                </tr>
                </tfoot>
                </table>
            </div>
        </div>
        <img src="image/inkpen.png" alt="an ink pen" class="inkpen"/>
    </section>
</main>
</body>
</html>
