<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <!-- Logo -->
    <a class="navbar-brand" href="./">
      <img src="./public/logo.png" alt="Logo" />
    </a>

    <!-- Navbar Toggle Button for Mobile View -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar Links -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <!-- Home Link -->
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./">Home</a>
        </li>

        <?php if (isset($_SESSION['user']['username'])): ?>
          <!-- Logged-In User Links -->
          <li class="nav-item">
            <a class="nav-link" href="./server/requests.php?logout=true">
              Logout (<?php echo htmlspecialchars(ucfirst($_SESSION['user']['username']), ENT_QUOTES, 'UTF-8'); ?>)
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?ask=true">Ask A Question</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?u-id=<?php echo intval($_SESSION['user']['user_id']); ?>">My Questions</a>
          </li>
        <?php else: ?>
          <!-- Guest Links -->
          <li class="nav-item">
            <a class="nav-link" href="?login=true">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?signup=true">Sign Up</a>
          </li>
        <?php endif; ?>

        <!-- Latest Questions Link -->
        <li class="nav-item">
          <a class="nav-link" href="?latest=true">Latest Questions</a>
        </li>
      </ul>

      <!-- Search Form -->
      <form class="d-flex" method="GET" action="">
        <input class="form-control me-2" name="search" type="search" placeholder="Search questions" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
