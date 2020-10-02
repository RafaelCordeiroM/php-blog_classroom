<?php include "includes/header.php"; ?>


<div id="page-wrapper">
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
      <div class="jumbotron">
        <h1 class="display-4">Posts</h1>
        <hr class="my-4">
      </div>
      <div class="col-sm-12">

        <?php

        if (isset($_GET['source'])) {

          $source = $_GET['source'];

          switch ($source) {
            case 'add_post':
              include "includes/add_posts.php";
              break;
            case 'edit_post':
              include "includes/edit_post.php";
              break;
            default:
              include "includes/view_posts.php";
              break;
          }
        }
        if (!isset($_GET['source'])) {
          include "includes/view_posts.php";
        }
        ?>


      </div>

    </div>
  </div>
  <!-- /.row -->

</div>
<!-- /.container-fluid -->

<!-- /#page-wrapper -->
<?php include "includes/footer.php"; ?>
<style>
  select {
    width: 100%;
    padding: 16px 20px;
    border: none;
    border-radius: 4px;
    background-color: #f1f1f1;
  }
</style>

<!-- <script>
    $(document).ready(function() {
        $('.btn-post').on('click', function() {

            //extracting values from db
            $tr = $(this).closest('tr');
            var value_cat_id = $(this).closest('tr').find("#id_cat").attr("value");

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            //placing all values into the inputs
            $('#id-edit').val(data[1]);
            $('#title-edit').val(data[3]);
            document.getElementById('category-id-edit').value = value_cat_id;
            document.getElementById("content-edit").innerHTML = data[6];
            $('#demo-edit').val(data[7]);
            $('#image-edit').val(data[5]);
            $('#author-edit').val(data[8]);
            $('#tags-edit').val(data[9]);
            $('#status-edit').val(data[11]);
        });
    });
</script> -->