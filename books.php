<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

include( 'includes/header.php' );

if( isset( $_GET['delete'] ) )
{
  
  $query = 'DELETE FROM books
    WHERE id = '.$_GET['delete'].'
    LIMIT 1';
  mysqli_query( $connect, $query );
    
  set_message( 'Book has been deleted' );
  
  header( 'Location: books.php' );
  die();
  
}

$query = 'SELECT b.id,b.title,g.genre,b.author,b.image
  FROM books b,genres g
  WHERE b.genre = g.id
  ORDER BY createdon DESC';
$result = mysqli_query( $connect, $query );

?>
<div>
  <!--<a href="booksAdd.php" class="buttonLink"> Add Book</a>-->
  <h2>Manage Books</h2>
  <button onclick="document.location='booksAdd.php'" class="buttonLink">Add Book</button>
</div>



<div class="grid-container">
  <?php while( $record = mysqli_fetch_assoc( $result ) ): ?>
<div>       
	   <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($record['image']).'"height="300" width="300"/>'?>
	   <br/>
        <?php echo "Title:".htmlentities( $record['title'] ); ?>
		<br/>
      <?php echo "Genre:".htmlentities($record['genre']); ?>
      <br/>
	  <?php echo "Author:".htmlentities( $record['author'] ); ?>
      <br/>
	  <a href="booksEdit.php?id=<?php echo $record['id']; ?>" style="color:#1217b3">Edit</i></a>
      <br/>      
	  <a href="books.php?delete=<?php echo $record['id']; ?>" 
      onclick="javascript:confirm('Are you sure you want to delete this project?');" style="color:#1217b3">Delete</i></a>
		</div>
  <?php endwhile; ?>


</div>



<?php

include( 'includes/footer.php' );

?>