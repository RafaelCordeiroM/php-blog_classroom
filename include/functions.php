<?php

function escape($string){
    global $connection;
    return mysqli_real_escape_string($connection,trim($string));
}

function callNameCategory($id)
{

    global $connection;

    $query = "SELECT cat_title from categoria WHERE cat_id='$id'";
    $row = mysqli_fetch_assoc(mysqli_query($connection, $query));

    echo $row['cat_title'];
}

function comment_post($array_data)
{

    global $connection;
    $check_empty = false;

    foreach ($array_data as $n) {
        if (empty($n)) {
            $check_empty = true;
        }
    }

    $date = date("Y-m-d H:i");
    $array_data['message'] = escape($array_data['message']);
    $query = "INSERT INTO comments (comment_post_id,comment_author,comment_email,comment_content,comment_status,comment_date)";
    $query .= " VALUES('$array_data[post_id]','$array_data[author]','$array_data[email]','$array_data[message]','approved','$date')";

    if ($check_empty == false) {
        $query_post = mysqli_query($connection, $query);
        if ($query_post) {

            $query_update_count = "UPDATE posts SET post_comment_count =post_comment_count + 1 WHERE post_id ='$array_data[post_id]'";
            $s = mysqli_query($connection, $query_update_count);

            if (!$s) {
                echo mysqli_error($connection);
            }
            echo "<div class='alert alert-success '>comment posted!</div>";
        } else {
            echo mysqli_error($connection);
        }
    } else {
        echo "<div class='alert alert-warning '>please fill the form correctly</div>";
    }
}

function verify_password($password){

    $ver = true;

    if(empty($password)){
        $ver = false;
    }
    if(strlen($password) > 30){
        $ver = false;
    }
    if($ver) return true;
    else return false;
}
