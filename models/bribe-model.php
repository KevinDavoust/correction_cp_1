<?php
require __DIR__ . '/../connec.php';

function createConnection(): PDO
{
    return new PDO(DSN, USER, PASS);
}

function getAllBribes(): array
{
    $connection = createConnection();

    $statement = $connection->query('SELECT name, payment FROM bribe');
    $bribes = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $bribes;
}


function saveBribe(array $bribe): void
{
    $connection = createConnection();

    $query = 'INSERT INTO bribe(name, payment) VALUES (:name, :payment)';
    $statement = $connection->prepare($query);
    $statement->bindValue(':name', $bribe['name'], PDO::PARAM_STR);
    $statement->bindValue(':payment', $bribe['payment'], PDO::PARAM_STR);
    $statement->execute();
}

function totalBribes(): string
{
    $connection = createConnection();
    $statement = $connection->query('SELECT SUM(payment) FROM bribe');
    $somme = $statement->fetch();
    return $somme[0];
}

