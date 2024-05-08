<?php
require_once('model/database.php');
require_once('model/todoitems_db.php');
require_once('model/category_db.php');

// Filter input to prevent XSS and SQL Injection
$itemNum = filter_input(INPUT_POST, 'itemNum', FILTER_VALIDATE_INT);
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);

// Determine the action to take, defaulting to 'list_todo_items' if none specified
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?: filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ?: 'list_todo_items';

switch ($action) {
    case "list_categories":
        $categories = get_categories();
        include('view/category_list.php');
        break;
    case "add_category":
        if (!empty($_POST['category_name'])) {
            $category_name = filter_input(INPUT_POST, 'category_name', FILTER_SANITIZE_SPECIAL_CHARS);
            add_category($category_name);
            header("Location: .?action=list_categories");
            exit();
        } else {
            $error = "Invalid category name. Please check the field and try again.";
            include("view/error.php");
            exit();
        }
        break;
    case "add_todo_item":
        if (!empty($title) && !empty($description)) {
            add_todo_item($title, $description, $category_id);
            header("Location: .");
            exit();
        } else {
            $error = "Invalid ToDo List item data. Check all fields and try again.";
            include("view/error.php");
            exit();
        }
        break;
    case "remove_todo_item":
        if ($itemNum) {
            delete_todo_item($itemNum);
            header("Location: .");
            exit();
        } else {
            $error = "Missing or incorrect ToDo List item ID.";
            include('view/error.php');
            exit();
        }
        break;
    case "delete_category":
        if ($category_id) {
            try {
                delete_category($category_id);
                header("Location: .?action=list_categories");
                exit();
            } catch (PDOException $e) {
                $error = "You cannot delete a category if items exist in the category.";
                include('view/error.php');
                exit();
            }
        }
        break;
    default:
        $categories = get_categories();
        $todoItems = get_todo_items();
        include('view/todoitems_list.php');
        // No break needed after default as it's the last case
}
