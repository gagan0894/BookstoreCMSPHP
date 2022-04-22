<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

include( 'includes/header.php' );

?>

<ul id="dashboard">
  <a href="books.php">
	<li>
		<img src="images/books.png" alt="Books" style="width: 100px; height: auto;">
		<br>
		Manage Books
	</li>
  </a>
  <a href="users.php">
	<li>
		<img src="images/user.png" alt="Users" style="width: 100px;">
		<br>
		Manage Users
    </li>
  </a>
</ul>

<?php

include( 'includes/footer.php' );

?>
