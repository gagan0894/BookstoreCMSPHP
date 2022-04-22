<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

include( 'includes/header.php' );

if( !isset( $_GET['id'] ) )
{
  
  header( 'Location: users.php' );
  die();
  
}
  
  
    
    if( isset($_POST['password']))
    {
        if($_POST['password'] === $_POST['passwordC'])
      {
      $query = 'UPDATE users SET
        password = "'.md5( $_POST['password'] ).'"
        WHERE id = '.$_GET['id'].'
        LIMIT 1';
      mysqli_query( $connect, $query );
      
      set_message( 'User Password has been updated' );
       header( 'Location: users.php' );
       die();
    }
    else
    {
   set_message( 'Passwords don\'t match '.$_POST['password']." and ".$_POST['passwordC']."xx".$_POST['password'] == $POST['passwordC']);
    }
  
    }
  

 


if( isset( $_GET['id'] ) )
{
  
  $query = 'SELECT *
    FROM users
    WHERE id = '.$_GET['id'].'
    LIMIT 1';
  $result = mysqli_query( $connect, $query );
  
  if( !mysqli_num_rows( $result ) )
  {
    
    header( 'Location: users.php' );
    die();
    
  }
  
  $record = mysqli_fetch_assoc( $result );
  
}

?>

<div>
  <h2>Change User Password</h2>
  <button onclick="document.location='users.php'" class="buttonLink">Return</button>
</div>

<form method="post">
  
  <label for="password">Enter new Password:</label>
  <input type="text" name="password" id="password">
  <br/>
  <label for="passwordC">Confirm new Password:</label>
  <input type="password" name="passwordC" id="passwordC">
  
  
  <input type="submit" value="Change Password">
  
</form>


<?php

include( 'includes/footer.php' );

?>