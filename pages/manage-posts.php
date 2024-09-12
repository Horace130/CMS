<?php 
checkIfuserIsNotLoggedIn();
  // 1. connect to the database
  $database = connectToDB();

$sql = "SELECT * FROM posts";
// 2.2
$query = $database->prepare( $sql );
// 2.3
$query->execute();
// 2.4
$posts = $query->fetchAll();

require "parts/header.php"; ?>
 <form action="post/delete" method="POST">
<div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Manage Posts</h1>
        <div class="text-end">
          <a href="/manage-posts-add" class="btn btn-primary btn-sm"
            >Add New Post</a
          >
        </div>
      </div>
      <div class="card mb-2 p-4">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col" style="width: 40%;">Title</th>
              <th scope="col">Status</th>
              <th scope="col" class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($posts as $index => $post) :?>

            <tr>
              <th scope="row"><?= $post['id']?></th>
              <td><?= $post['title']?></td>
              <td><span class="badge bg-warning"><?= $post['status']?></span></td>
              <td class="text-end">
                <div class="buttons">
                  <a
                    href="/post"
                    target="_blank"
                    class="btn btn-primary btn-sm me-2 disabled"
                    ><i class="bi bi-eye"></i
                  ></a>
                  <a
                    href="/manage-posts-edit?id=<?= $post['id']; ?>"
                    class="btn btn-secondary btn-sm me-2"
                    ><i class="bi bi-pencil"></i
                  ></a>
        
                  <input type="hidden" name="id" value="<?= $post['id']; ?>" />
                  <button class="btn btn-danger btn-sm"
                    ><i class="bi bi-trash"></i
                  ></button>
                  </form>
                </div>
              </td>
            </tr>
          </form>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <div class="text-center">
        <a href="/dashboard" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back to Dashboard</a
        >
      </div>
    </div>
    <?php require 'parts/footer.php';