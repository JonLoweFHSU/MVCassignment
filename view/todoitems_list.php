<?php 
include('view/header.php'); // Include the header part of the HTML page
?>

<!-- Section to Display ToDo List Items -->
<section>
    <h1>ToDo List</h1>

    <!-- Check if there are ToDo List items to display -->
    <?php if (!empty($todoItems)) : ?>
        <!-- Loop through each ToDo List item and display it -->
        <ul>
            <?php foreach ($todoItems as $item) : ?>
                <li>
                    <strong><?= htmlspecialchars($item['Title']) ?></strong> - <?= htmlspecialchars($item['Description']) ?>
                    <!-- Form to delete the ToDo List item, with hidden input for passing data -->
                    <form action="." method="post">
                        <input type="hidden" name="action" value="remove_todo_item">
                        <input type="hidden" name="itemNum" value="<?= $item['ItemNum'] ?>">
                        <button type="submit">X</button> <!-- Button to remove the ToDo List item -->
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <!-- Message displayed if no ToDo List items exist -->
        <p>No ToDo List items exist yet.</p>
    <?php endif; ?>
</section>

<!-- Section to Add a New ToDo List Item -->
<section>
    <h2>Add ToDo List Item</h2>
    <!-- Form for Adding a New ToDo List Item -->
    <form action="." method="post">
        <!-- Input field for the ToDo List item title -->
        <input type="text" name="title" placeholder="Title" required>
        <!-- Input field for the ToDo List item description -->
        <input type="text" name="description" placeholder="Description" required>
        <button type="submit" name="action" value="add_todo_item">Add</button> <!-- Submit button for adding the ToDo List item -->
    </form>
</section>

<?php 
include('view/footer.php'); // Include the footer part of the HTML page
?>
