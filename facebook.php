<?php
/**
 * Copyright 2011 Facebook, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

require 'src/facebook.php';


// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook ( array (
		'appId' => '350573805024145',
		'secret' => '6868bf689b6e745f799cdc04fb5afe28' 
) );

// Get User ID
$user = $facebook->getUser ();

// We may or may not have this data based on whether the user is logged in.
//
// If we have a $user id here, it means we know the user is logged into
// Facebook, but we don't know if the access token is valid. An access
// token is invalid if the user logged out of Facebook.

if ($user) {
	try {
		// Proceed knowing you have a logged in user who's authenticated.
		$user_profile = $facebook->api ( '/me' );
	} catch ( FacebookApiException $e ) {
		error_log ( $e );
		$user = null;
	}
}

// Login or logout url will be needed depending on current user state.
if ($user) {
	$logoutUrl = $facebook->getLogoutUrl ();
} else {
	$loginUrl = $facebook->getLoginUrl ();
}

// This call will always work since we are fetching public data.
// $naitik = $facebook->api('/naitik');

?>
<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<title>php-sdk</title>
<style>
body {
	font-family: 'Lucida Grande', Verdana, Arial, sans-serif;
}

h1 a {
	text-decoration: none;
	color: #3b5998;
}

h1 a:hover {
	text-decoration: underline;
}
</style>
</head>
<body>
	<h1>php-sdk</h1>

    <?php if ($user): ?>
      <a href="<?php echo $logoutUrl; ?>">Logout</a>
    <?php else: ?>
      <div>
		Login using OAuth 2.0 handled by the PHP SDK: <a
			href="<?php echo $loginUrl; ?>">Login with Facebook</a>
	</div>
    
				
				
				
				<?php endif;?> 
	<h3>PHP Session</h3>
	<pre><?php print_r($_SESSION); ?></pre>

    <?php if ($user): ?>
      <h3>You</h3>
	<img src="https://graph.facebook.com/<?php echo $user; ?>/picture">

	<h3>Your User Object (/user)</h3>
	<pre><?php
					 global $database;
					
					foreach ( $user_profile as $up => $val ) {
						
						if ($up == 'languages' || $up == 'education') {
							
							foreach ( $val as $v => $k ) {
								
								foreach ( $k as $k1 => $k2 ) {
									//foreach ($k1 as $k11 => $k22){}
									/*
									 * [education] => Array ( [0] => Array (
									 *  [school] => Array ( [id] =>103772529661901 [name] => Hebrew University of Jerusalem ) 
									 *  [type] =>College ) )
									 */
									if ($k1 == 'school') {
										echo $up . " = " . $k2['name'];//ok $k1 == 'school'
										$get1 =  $k2 ['name'];
										$database .= "'".$get1."', ";
										echo "<br>";
									}
									
									if ($k1 == 'type') {
										echo $up . " = " . $k2;
										$get2 = $k2;
										$database .= "'".$get2."', ";
										echo "<br>";
									} 

									if ($k1 == 'id') { //ok $k1 == 'id'
										
											echo $up . " = " . $k['name']; // ok
											$get3 = $k['name'];
											$database .= "'".$get3."', ";
											echo "<br>";	
										
										
										/*
										 * [languages] => Array ( 
										 * [0] => Array (
										 *  [id] => 108405449189952 [name] =>Hebrew ) 
										 * [1] => Array ( 
										 *  [id] =>116280521715636 [name] => English English ) )
										 */
									}
									
								}//end foreach ( $k as $k1 => $k2 )
							}
						}						

						// else
						
						elseif ($up == 'hometown' || $up == 'location') {
							/*
							 * [hometown] => Array ( 
							 * [id] => 110619208966868
							 * [name] => Haifa, Israel )
							 */
							//foreach ( $val as $v => $k ) {
								
									echo $up . " = " . $val['name'];
									echo "<br>";

								
								
								//echo $up . " = " . $k;
								//echo "<br>";
							//}
							
							// echo $up . " = " . $val;
						} 

						else {
							echo $up . " = " . $val;
							echo "<br>";
						}
					} // end first foreach
					
					echo "above is the user's profile as inserted to DB: ";echo "<br>";
					
					$domain = 'http://91.228.126.8:2082';
					$User = 'harmoney_danny';
					$pass = '22691711';
					$Database = 'harmoney_run_with_me';
					$dsn = 'mysql:dbname=harmoney_run_with_me;host=localhost';
					
					echo ($database);
					
					try {
						$dbh = new PDO ( $dsn, $User, $pass );
						$sql2 = "INSERT INTO `harmoney_run_with_me`.`User_facebook` (`id`, `idUser_facebook`, `name`, `link`, `username`, `hometown`, `location`, `education1`, `education2`, `education3`, `education4`, `gender`, `religion`, `political`, `timezone`, `locale`, `languages1`, `languages2`, `languages3`, `verified`, `updated_time`, `Uid`) VALUES (NULL, '188850404', 'danydin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$getID');";
						$dbh->prepare ( $sql2 );
						$dbh->exec ( $sql2 );
						echo "<br>"; echo $getID_User_facebook = $dbh->lastInsertId();echo "<br>";
						echo "user data was inserted to RunWithMe's DataBase";echo "<br>";
					} catch ( PDOException $e ) {
						echo 'Connection failed: ' . $e->getMessage ();
					}
					//INSERT INTO `harmoney_run_with_me`.`User_facebook` (`id`, `idUser_facebook`, `name`, `link`, `username`, `hometown`, `location`, `education1`, `education2`, `education3`, `education4`, `gender`, `religion`, `political`, `timezone`, `locale`, `languages1`, `languages2`, `languages3`, `verified`, `updated_time`, `Uid`) VALUES (NULL, '', 'dada gabor', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '');
					?>
	
	</pre><?php endif;?>
  </body>
</html>
