<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

include( 'includes/header.php' );
$query1 = "SELECT * FROM genres";
$options ="";
$result = mysqli_query($connect,$query1);
while($row1 = mysqli_fetch_array($result))
{
    $options = $options."<option value=\"$row1[0]\">$row1[1]</option>";
}

if( isset( $_POST['title'] ) )
{
  
  if( $_POST['title'] and $_POST['genre'] )
  {
    
    $query = 'INSERT INTO books (
        title,
        author,
        genre,
        image
      ) VALUES (
         "'.mysqli_real_escape_string( $connect, $_POST['title'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['author'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['genre'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['image'] ).'"
      )';
    mysqli_query( $connect, $query );
    
    set_message( 'Book has been added' );
    
  }
  
  header( 'Location: books.php' );
  die();
  
}

?>


<div>
  <h2>Add Book</h2>
  <button onclick="document.location='books.php'" class="buttonLink">Return</button>
</div>
<form method="post">
  
  <label for="title">Title:</label>
  <input type="text" name="title" id="title">
    
  <br>
  
  <label for="author">Author:</label>
  <input type="text" name="author" id="author">
  
  <label for="genre">Genre:</label>
  <select name="genre" id="genre">
  <?php echo $options;?>
  </select>
  <br/>
  
  <label for="image">Select Image to upload:</label>
  <input type="file" name="image" id="image">
  <br/>
  <input type="submit" value="Add Book">
  
</form>


<?php

include( 'includes/footer.php' );

?>