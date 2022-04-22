<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

include( 'includes/header.php' );

if( isset( $_GET['delete'] ) )
{
  
  $query = 'DELETE FROM users
    WHERE id = '.$_GET['delete'].'
    LIMIT 1';
  mysqli_query( $connect, $query );
  
  set_message( 'User has been deleted' );
  
  header( 'Location: users.php' );
  die();
  
}

$query = 'SELECT *
  FROM users WHERE id<>1
  ORDER BY last,first';
$result = mysqli_query( $connect, $query );

?>

<div>
  <!--<a href="booksAdd.php" class="buttonLink"> Add Book</a>-->
  <h2>Manage Users</h2>
  <button onclick="document.location='usersAdd.php'" class="buttonLink">Add User</button>
</div>

<table>
  <tr>
    <th align="center">ID</th>
    <th align="left">Name</th>
    <th align="left">Email</th>
    <th align="left">Password</th>
    <th></th>
    <th></th>
  </tr>
  <?php while( $record = mysqli_fetch_assoc( $result ) ): ?>
    <tr>
      <td align="center"><?php echo $record['id']; ?></td>
      <td align="left"><?php echo htmlentities( $record['first'] ); ?> <?php echo htmlentities( $record['last'] ); ?></td>
      <td align="left"><a href="mailto:<?php echo htmlentities( $record['email'] ); ?>"><?php echo htmlentities( $record['email'] ); ?></a></td>
      <td align="left"><?php echo htmlentities( $record['password'] ); ?></td>
      <td align="center"><a href="userPassword.php?id=<?php echo $record['id']; ?>">Change Password</a></td>
      <td align="center">
        <?php if( $_SESSION['id'] != $record['id'] ): ?>
          <a href="users.php?delete=<?php echo $record['id']; ?>" onclick="javascript:confirm('Are you sure you want to delete this user?');">Delete</a>
        <?php endif; ?>
      </td>
    </tr>
  <?php endwhile; ?>
</table>


<?php

include( 'includes/footer.php' );

?>