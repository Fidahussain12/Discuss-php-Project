<select class="form-control" name="category" id="category">
    <option value="">Select A Category</option>
    <?php 
    // Include the database connection
    include("common/db.php");

    // Query to fetch categories
    $query = "SELECT * FROM category";
    $result = $conn->query($query);

    // Check if the query executed successfully
    if ($result && $result->num_rows > 0) {
        // Loop through each row
        while ($row = $result->fetch_assoc()) {
            // Sanitize output
            $name = htmlspecialchars(ucwords($row['name']));
            $id = htmlspecialchars($row['id']);

            // Output each category as an option
            echo "<option value=\"$id\">$name</option>";
        }
    } else {
        // Fallback option if no categories are available
        echo "<option value=\"\">No Categories Available</option>";
    }
    ?>
</select>
