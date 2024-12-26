<div>
    <h1 class="heading">Categories</h1>
    <?php  
    // Include the database connection
    include('./client/common/db.php');

    // Prepare and execute the query
    $query = "SELECT * FROM category";
    if ($result = $conn->query($query)) {

        // Loop through the results
        foreach ($result as $row) {
            $name = ucfirst(htmlspecialchars($row['name'])); // Sanitize output to prevent XSS
            $id = intval($row['id']); // Sanitize id to ensure it's an integer

            // Display category
            echo "<div class='row question-list'>
                    <h4><a href='?c-id=$id'>$name</a></h4>
                  </div>";
        }

        // Free the result set
        $result->free();
    } else {
        echo "Error retrieving categories: " . $conn->error;
    }

    ?>
</div>
