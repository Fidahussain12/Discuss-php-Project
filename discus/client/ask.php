<div class="container">
    <h1 class="heading">Ask A Question </h1>
</div>

<form action="server/requests.php" method="post">


  <div class="col-6 offset-sm-3 margin-bottom-15">
    <label for="title" class="form-label">Title</label>
    <input  type="text" name="title" class="form-control" id="title" placeholder="Enter Question">
  </div>

  <div class="col-6 offset-sm-3 margin-bottom-15">
    <label for="description" class="form-label">Description</label>
    <textarea   name="description" class="form-control" id="description" placeholder="Enter Question"></textarea>
  </div>

  <div class="col-6 offset-sm-3 margin-bottom-15">
    <label for="category" class="form-label">Category</label>
   <?php
   include("category.php");
   ?>
  </div>
  <div class="col-6 offset-sm-3">

  </div>
  <button  type="submit" name="ask" class="button btn btn-primary col-6 offset-sm-3">Ask Question</button>
</form>