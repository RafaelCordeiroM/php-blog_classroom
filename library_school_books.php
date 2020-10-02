<style>
  .modal_book {
    margin: 20px;
    padding: 50px;
    border-radius: 0;
    border-width: medium;
    font-size: 20px;
  }

  iframe {
    display: block;
    background: #000;
    border: none;
    height: 100vh;
    width: 100%;
  }
  .fa{
    font-size: 30px;
  }
</style>

<div class="container pt-4 mt-2 mb-2" style="background-color:#dcdcdc;">
  <div class="row">
    <div class="col-sm-3" align="center">
      
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>?source=book_school" method="post">
        <input type="hidden" name="src" value="matematica.pdf" id="div">
        <button class="modal_book btn btn-outline-dark" name="modal_book" type="submit" value=""><i class="fa fa-book"></i>Math</button>
      </form>
    </div>
    <div class="col-sm-3" align="center">
    
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>?source=book_school" method="post">
        <input type="hidden" name="src" value="portuguese.pdf" id="div">
        <button class="modal_book btn btn-outline-dark" name="modal_book" type="submit" value=""><i class="fa fa-book"></i>Portuguese</button>
      </form>
    </div>
    <div class="col-sm-3" align="center">
    
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>?source=book_school" method="post">
        <input type="hidden" name="src" value="quimica.pdf" id="div">
        <button class="modal_book btn btn-outline-dark" name="modal_book" type="submit" value=""><i class="fa fa-book"></i>Chemistry</button>
      </form>
    </div>
    <div class="col-sm-3" align="center">
    
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>?source=book_school" method="post">
        <input type="hidden" name="src" value="fisica.pdf" id="div">
        <button class="modal_book btn btn-outline-dark" name="modal_book" type="submit" value=""><i class="fa fa-book"></i>Physics</button>
      </form>
    </div>
    <div class="col-sm-3" align="center">
  
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>?source=book_school" method="post">
        <input type="hidden" name="src" value="biologia.pdf" id="div">
        <button class="modal_book btn btn-outline-dark" name="modal_book" type="submit" value=""><i class="fa fa-book"></i>Biology</button>
      </form>
    </div>
    <div class="col-sm-3" align="center">

      <form action="<?php echo $_SERVER['PHP_SELF']; ?>?source=book_school" method="post">
        <input type="hidden" name="src" value="geografia.pdf" id="div">
        <button class="modal_book btn btn-outline-dark" name="modal_book" type="submit" value=""><i class="fa fa-book"></i>Geography</button>
      </form>
    </div>
    <div class="col-sm-3" align="center">
    
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>?source=book_school" method="post">
        <input type="hidden" name="src" value="historia.pdf" id="div">
        <button class="modal_book btn btn-outline-dark" name="modal_book" type="submit" value=""><i class="fa fa-book"></i>History</button>
      </form>
    </div>
    <div class="col-sm-3" align="center">

      <form action="<?php echo $_SERVER['PHP_SELF']; ?>?source=book_school" method="post">
        <input type="hidden" name="src" value="sociologia.pdf" id="div">
        <button class="modal_book btn btn-outline-dark" name="modal_book" type="submit" value=""><i class="fa fa-book"></i>Sociologism</button>
      </form>
    </div>
    <div class="col-sm-3" align="center">
    
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>?source=book_school" method="post">
        <input type="hidden" name="src" value="filosofia.pdf" id="div">
        <button class="modal_book btn btn-outline-dark" name="modal_book" type="submit" value=""><i class="fa fa-book"></i>Philosophy</button>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_book" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <iframe src="books/<?php echo $_POST['src'] ?>" frameborder="0">
        </iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>