<?php
checkIfuserIsNotLoggedIn();
$id = $_GET['id'];
$database = connectToDB();

// load the existing data from the user
// sql command
$sql = "SELECT * FROM posts WHERE id = :id";
// prepare
$query = $database->prepare($sql);
// execute
$query->execute([
  'id' => $id
]);
// fetch
$post = $query->fetch(); // get only one row of data

require "parts/header.php"; ?>
<div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Edit Post</h1>
      </div>
      <div class="card mb-2 p-4">
        <form method="POST" action="/post/edit">
          <div class="mb-3">
            <label for="post-title" class="form-label">Title</label>
            <input
              type="text"
              class="form-control"
              id="title"
              value="<?= $post['title']; ?>"
              name="title"
            />
          </div>
          <div class="mb-3">
            <label for="post-content" class="form-label">Content</label>
            <textarea class="form-control" id="content" rows="10" name="content"> <?= $post['content']; ?></textarea
            >
          </div>
          <div class="mb-3">
            <label for="post-content" class="form-label">Status</label>
            <select class="form-control" id="status" name="status">

              <?php if ( $post['status'] == 'pending' ) : ?>
                <option value="review" selected>Pending for Review</option>
              <?php else: ?>
                <option value="review">Pending for review</option>
              <?php endif; ?>

              <?php if ( $post['status'] == 'publish' ) : ?>
                <option value="publish" selected>publish</option>
              <?php else: ?>
                <option value="publish">publish</option>
              <?php endif; ?>
            </select>
          </div>
          <div class="text-end">
          <input type="hidden" name="id" value="<?= $post["id"]; ?>" />
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
      <div class="text-center">
        <a href="/manage-posts" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back to Posts</a
        >
      </div>
    </div>
    <?php require 'parts/footer.php';