<?php

if (isset($_GET['delete'])) {
    if ($user['user_role'] == "admin") {
        delete_comment($_GET['delete'], $_GET['p_id']);
    }
}
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'approved' || $_GET['status'] == 'unapproved') set_status_comment($_GET['id_comment'], $_GET['status']);
}

?>

<table class="table table-bordered table-hover">
    <thead>
        <th>id</th>
        <th>Author</th>
        <th>Comment</th>
        <th>Email</th>
        <th>Status</th>
        <th>In response to</th>
        <th>Post Id</th>
        <th>Date</th>
        <th>Approbation</th>
        <th>Modify</th>
    </thead>
    <tbody>

        <?php

        $query = "SELECT * from comments ";
        $select_comment = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_comment)) {
            $comment_id = $row['comment_id'];
            $comment_author = $row['comment_author'];
            $comment_comment = $row['comment_content'];
            $comment_email = $row['comment_email'];
            $comment_status = $row['comment_status'];
            $comment_post_id = $row['comment_post_id'];
            $comment_date = $row['comment_date'];

            echo "<tr>";
            echo "<td>$comment_id</td>";
            echo "<td>$comment_author</td>";
            echo "<td>$comment_comment</td>";
            echo "<td>$comment_email</td>";
            echo "<td>$comment_status</td>";

            $query_post = "SELECT post_title from posts where post_id = '$comment_post_id' ";
            $array_post = mysqli_query($connection, $query_post);
            $array_post = mysqli_fetch_assoc($array_post);
            $post_title = $array_post['post_title'];

            echo "<td>$post_title</td>";
            echo "<td>$comment_post_id</td>";

            echo "<td>$comment_date</td>";
            echo "
                <td>
                    <div class='btn-group'>
                        <a href='$_SERVER[PHP_SELF]?status=approved&id_comment=$comment_id' class='btn btn-success'>Approve</a>
                        <a href='$_SERVER[PHP_SELF]?status=unapproved&id_comment=$comment_id' class='btn btn-warning'>Unapprove</a>
                    </div>
                </td> 
            ";
            echo "
                <td>
                    <div class='btn-group'>
                        <a href='$_SERVER[PHP_SELF]?delete=$comment_id&p_id=$comment_post_id' class='btn btn-danger'>Delete</a>
                    </div>
                </td>
            ";
            echo "</tr>";
        }

        ?>

    </tbody>
</table>