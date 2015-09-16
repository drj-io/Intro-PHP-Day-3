<?php  if(isset($_GET['name'])){ ?>
  <h1>Hello, <?php print $_GET['name']; ?></h1>
<?php  } else { ?>



  <form>

      <input placeholder="name" name="name" />
      <input type="submit" />

  </form>





<?php } ?>
