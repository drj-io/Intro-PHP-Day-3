<pre>
<?php print_r($_GET); ?>

<?php if (isset($_GET['a'])) {
        print($_GET['a']);
      }
      else{
        print "there's no a 'get' param";

      }
?>
</pre>

 <h1>hello <?php print $_GET['a']; ?></h1>
