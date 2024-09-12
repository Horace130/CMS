<?php

    // 1. connect to database
    $database = connectToDB();

    // 2. get all the data from the form  using  $_POST
    $title = $_POST["title"];
    $content = $_POST["content"];
    $status = $_POST["status"];
    $id = $_POST['id'];

    if ( empty( $title) || empty( $content) || empty( $status )  ) {
        setError( "All the fields are required.",  '/manage-posts-edit?id=' . $id );
    }
    // 4. update the password. 
    // 4.1 - sql
    $sql = "UPDATE posts SET title =:title, content =:content, status =:status WHERE id =:id";
    // 4.2 - prepare
    $query = $database -> prepare($sql);
    // 4.3 - execute - Remember hash the password before update
    $query->execute([
        'title' => $title,
        'content' => $content,
        'status' => $status,
        'id' => $id
    ]);
    // 5. redirect back to /manage-users
    header("Location: /manage-posts");
    exit;