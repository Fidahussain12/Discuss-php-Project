<div class="container">
    <h1 class="heading">Login</h1>
</div>

<form action="server/requests.php" method="post">
    <div class="col-6 offset-sm-3 margin-bottom-15">
        <label for="email" class="form-label">User Email</label>
        <input type="text" name="email" class="form-control" id="email" placeholder="Enter User Email" required>
    </div>

    <div class="col-6 offset-sm-3 margin-bottom-15">
        <label for="password" class="form-label">User Password</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Enter User Password" required>
    </div>

    <button type="submit" name="login" class="btn btn-primary col-6 offset-sm-3">Login</button>
</form>
