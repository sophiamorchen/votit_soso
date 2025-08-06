<?php
function getPolls(PDO $pdo, int $limit = null): array
{
    $sql = "SELECT poll.*, category.name AS category_name
    FROM poll
    JOIN category
    ON category.id = poll.category_id
    ORDER BY poll.id DESC";

    if ($limit) {
        $sql .= " LIMIT :limit";
    }
    $query = $pdo->prepare($sql);
    if ($limit) {

        $query->bindValue(':limit', $limit, PDO::PARAM_INT);
    }

    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}
function getPollById(PDO $pdo, int $id): array|bool
{
    $query = $pdo->prepare('SELECT * FROM poll WHERE id = :id');
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}
function getPollResultsByPollId(PDO $pdo, int $id): array
{
    $query = $pdo->prepare('SELECT pi.id, pi.name, COUNT(upi.poll_item_id) AS votes
                                    FROM poll_item AS pi
                                    LEFT JOIN user_poll_item upi
                                    ON upi.poll_item_id = pi.id
                                    WHERE poll_id = :id
                                    GROUP BY pi.id
                                    ORDER BY votes DESC');
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}
function getPollTotalUsersByPollId(PDO $pdo, int $id): int
{
    // Prépare une requête SQL pour compter le nombre total de votes distincts (par utilisateur)
    // pour tous les éléments d'un sondage donné (via l'ID du sondage)
    $query = $pdo->prepare('SELECT COUNT(distinct upi.user_id) as total_users 
                                    FROM poll_item pi 
                                    LEFT JOIN user_poll_item upi 
                                    ON upi.poll_item_id = pi.id 
                                    WHERE pi.poll_id = :id');
    // Lie l'ID du sondage au paramètre :id dans la requête SQL
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    // Exécute la requête
    $query->execute();
    // Récupère le résultat sous forme de tableau associatif et le retourne
    $res = $query->fetch(PDO::FETCH_ASSOC);

    if ($res) {
        return (int) $res['total_users'];
    } else {
        return 0;
    }
    // Ici, cela gère l'erreur possible, plus besoin de mettre un bool à coté du INT| "BOOL", cela m'évite de faire un traitement derriere, soit elle ressort un int soit zero! 
}

function getPollItems(PDO $pdo, int $id): array
{
    $query = $pdo->prepare('SELECT * 
                                FROM poll_item
                                WHERE poll_id = :id
                                ORDER BY name ASC');
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}