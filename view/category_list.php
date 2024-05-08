<?php 
// Include the header part of the HTML page
include("view/header.php"); 
?>

<!-- Display Categories -->
<?php if (!empty($categories)) : ?> <!-- Check if there are any categories to display -->
    <section id="list" class="list">
        <header>
            <h1>Category List</h1>
        </header>
        <!-- Loop through the categories and display each one -->
        <?php foreach ($categories as $category) : ?>
            <div class="list__row">
                <div class="list__item">
                    <!-- Display the category name -->
                    <p class="bold"><?= htmlspecialchars($category['categoryName']) ?></p>
                </div>
                <div class="list__removed">
                    <!-- Form to delete the category -->
                    <form action="." method="post">
                        <input type="hidden" name="action" value="delete_category">
                        <input type="hidden" name="category_id" value="<?= $category['categoryID'] ?>">
                        <button class="remove-button">X</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
<?php else : ?>
    <!-- Display a message if no categories exist -->
    <p>No Categories exist yet</p>
<?php endif; ?>

<!-- Add Category Form -->
<section>
    <h2>Add Category</h2>
    <form action="." method="post" id="add__form" class="add__form">
        <input type="hidden" name="action" value="add_category">
        <div class="add__inputs">
            <label>Name:</label>
            <!-- Input for the new category name -->
            <input type="text" name="category_name" maxlength="30" placeholder="Name" autofocus required>
        </div>
        <div class="add__addItem">
            <!-- Button to submit the form and add a new category -->
            <button class="add-button bold">Add</button>
        </div>
    </form>
</section>

<!-- Link to View/Edit ToDo List -->
<p><a href=".?action=list_todo_items">View/Edit ToDo List</a></p>

<?php 
// Include the footer part of the HTML page
include("view/footer.php"); 
?>
