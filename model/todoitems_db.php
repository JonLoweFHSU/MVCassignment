<?php

function get_todo_items()
{
    global $db;
    $query = 'SELECT ItemNum, Title, Description FROM todoitems ORDER BY ItemNum';
    $statement = $db->prepare($query);
    $statement->execute();
    $todoItems = $statement->fetchAll();
    $statement->closeCursor();
    return $todoItems;
}

function delete_todo_item($itemNum)
{
    global $db;
    $query = 'DELETE FROM todoitems WHERE ItemNum = :itemNum';
    $statement = $db->prepare($query);
    $statement->bindValue(':itemNum', $itemNum);
    $statement->execute();
    $statement->closeCursor();
}

function add_todo_item($title, $description)
{
    global $db;
    $query = 'INSERT INTO todoitems (Title, Description) VALUES (:title, :description)';
    $statement = $db->prepare($query);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':description', $description);
    $statement->execute();
    $statement->closeCursor();
}

?>
