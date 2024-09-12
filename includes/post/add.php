<?php

$database = connectToDB();

// 2. get all the data from the form using $_POST
$title = $_POST['title'];
$content = $_POST['content'];
if ( empty( $title ) || empty( $content ) ) {
    setError( "All the fields are required.", '/manage-posts-add' );
}
   $sql = "INSERT INTO posts (`title`,`content`,`user_id`) VALUES (:title, :content, :user_id)";
            // prepare (put everything into the bowl)
            $query = $database->prepare( $sql );
            // execute (cook it)
            $query->execute([
                'title' => $title,
                'content' => $content,
                'user_id' => $_SESSION['user'] ['id']
            ]);
        
        // 5. redireact back to /manage-users page
        header("Location: /manage-posts");
        exit;