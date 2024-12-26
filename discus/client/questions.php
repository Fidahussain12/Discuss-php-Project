<div class="container">
    <div class="row">
        <div class="col-8">
            <h1 class="heading">Questions</h1>
            <?php
            include("client/common/db.php");

            // Initialize and sanitize variables
            $uid = isset($_GET["u-id"]) ? intval($_GET["u-id"]) : null;
            $cid = isset($_GET["c-id"]) ? intval($_GET["c-id"]) : null;
            $search = isset($_GET["search"]) ? $conn->real_escape_string($_GET["search"]) : null;

            // Determine the query based on GET parameters
            if ($cid) {
                $query = "SELECT * FROM questions WHERE category_id = $cid";
            } else if ($uid) {
                $query = "SELECT * FROM questions WHERE user_id = $uid";
            } else if (isset($_GET["latest"])) {
                $query = "SELECT * FROM questions ORDER BY id DESC";
            } else if ($search) {
                $query = "SELECT * FROM questions WHERE `title` LIKE '%$search%'";
            } else {
                $query = "SELECT * FROM questions";
            }

            // Execute the query
            $result = $conn->query($query);

            // Display questions
            foreach ($result as $row) {
                $title = htmlspecialchars($row['title']); // Prevent XSS
                $id = intval($row['id']); // Sanitize output
                echo "<div class='row question-list' id='question-$id'>
                      <h4 class='my-question'>
                          <a href='?q-id=$id' id='link-$id'>$title</a>";
                if (!empty($uid)) {
                    echo " <a href='./server/requests.php?delete=$id'>Delete</a>";
                }
                echo "</h4></div>";
            }
            ?>
        </div>
        <div class="col-4">
            <?php include('categorylist.php'); ?>
        </div>
    </div>
</div>
