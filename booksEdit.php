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
    
    $query = 'UPDATE books SET
      title = "'.mysqli_real_escape_string( $connect, $_POST['title'] ).'",
      author = "'.mysqli_real_escape_string( $connect, $_POST['author'] ).'",
      genre = "'.mysqli_real_escape_string( $connect, $_POST['genre'] ).'",
      image = "'.mysqli_real_escape_string( $connect, $_POST['image'] ).'"
      WHERE id = '.$_GET['id'].'
      LIMIT 1';
    mysqli_query( $connect, $query );
    
    set_message( 'Book has been edited' );
    
  }
  
  header( 'Location: books.php' );
  die();
  
}
if( isset( $_GET['id'] ) )
{
  
  $query = 'SELECT *
    FROM books
    WHERE id = '.$_GET['id'].'
    LIMIT 1';
  $result = mysqli_query( $connect, $query );
  
  if( !mysqli_num_rows( $result ) )
  {
    
    header( 'Location: books.php' );
    die();
    
  }
  
  $record = mysqli_fetch_assoc( $result );
  
}
?>

<div>
  <h2>Edit Book</h2>
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
  <input type="submit" value="Edit Book">
  
</form>


<?php

include( 'includes/footer.php' );

?>