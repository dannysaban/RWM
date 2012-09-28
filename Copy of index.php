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

<?php
error_reporting ( E_ERROR );
define ( 'YAMLPATH', 'MyYaml/' );
define ( 'RUNKEEPERAPIPATH', 'MateRunner/' );
// define('CONFIGPATH', '/../config/');

/*
 * //test inserting data to local DB $dsn =
 * 'mysql:dbname=run_with_me;host=127.0.0.1'; $username = 'root'; $passwd =
 * '22691711'; /*
 */
// remote DB:
$domain = 'http://91.228.126.8:2082';
$User = 'harmoney_danny';
$pass = '22691711';
$Database = 'harmoney_run_with_me';
$dsn = 'mysql:dbname=harmoney_run_with_me;host=localhost';

/*
 * try { $dbh = new PDO($dsn, $User, $pass); echo $value ="16 Oct 1972
 * 00:00:00`, `Tel Aviv, Israel`,
 * `http://graph.facebook.com/855664405/picture?type=small`, `dannysaban`,
 * `false`, `M`, `Runner`,
 * `http://graph.facebook.com/855664405/picture?type=large`,
 * `http://runkeeper.com/user/559625690"; echo "<hr>";echo $value2 =
 * str_ireplace('`', "'", $value);echo "<hr>"; $sql ="INSERT INTO
 * `harmoney_run_with_me`.`Users` (`birthday`, `location`, `medium_picture`,
 * `name`, `elite`, `gender`, `athlete_type`, `normal_picture`, `profile`)
 * VALUES ('Mon, 13 Oct 1972 00:00:00', ' Tel Aviv, Israel',
 * 'http://graph.facebook.com/100003538821460/picture?type=small',
 * 'danny.harmoneya', 'false', 'M', 'Runner', '
 * http://graph.facebook.com/100003538821460/picture?type=large',
 * 'http://runkeeper.com/user/564356054');"; $sql2= "INSERT INTO
 * `harmoney_run_with_me`.`Users` (`birthday`, `location`, `medium_picture`,
 * `name`, `elite`, `gender`, `athlete_type`, `normal_picture`, `profile`)
 * VALUES ('$value2');"; $dbh->prepare($sql2); echo $count = $dbh->exec($sql2);
 * } catch (PDOException $e) { echo 'Connection failed: ' . $e->getMessage(); }
 */


/*
try {
	$dbh = new PDO($dsn, $username, $passwd);
	echo $value ="16 Oct 1972 00:00:00`, `Tel Aviv, Israel`, `http://graph.facebook.com/855664405/picture?type=small`, `dannysaban`, `false`, `M`, `Runner`, `http://graph.facebook.com/855664405/picture?type=large`, `http://runkeeper.com/user/559625690";
	echo "<hr>";echo $value2 = str_ireplace('`', "'", $value);echo "<hr>";
	$sql ="INSERT INTO `run_with_me`.`Users` (`birthday`, `location`, `medium_picture`, `name`, `elite`, `gender`, `athlete_type`, `normal_picture`, `profile`) VALUES ('Mon, 13 Oct 1972 00:00:00', ' Tel Aviv, Israel', 'http://graph.facebook.com/100003538821460/picture?type=small', 'danny.harmoneya', 'false', 'M', 'Runner', ' http://graph.facebook.com/100003538821460/picture?type=large', 'http://runkeeper.com/user/564356054');";
	$sql2= "INSERT INTO `run_with_me`.`Users` (`birthday`, `location`, `medium_picture`, `name`, `elite`, `gender`, `athlete_type`, `normal_picture`, `profile`) VALUES ('$value2');";
	$dbh->prepare($sql2);
	echo $count = $dbh->exec($sql2);
	
} catch (PDOException $e) {
	echo 'Connection failed: ' . $e->getMessage();
}

*/

require (YAMLPATH . 'lib/sfYamlParser.php');
require (RUNKEEPERAPIPATH . 'lib/runkeeperAPI.class.php');

/* API initialization */
$rkAPI = new runkeeperAPI ( 
		// CONFIGPATH.'rk-api.sample.yml' /* api_conf_file */
		'rk-api.sample.yml'	/* api_conf_file */
		);
if ($rkAPI->api_created == false) {
	echo 'error ' . $rkAPI->api_last_error; /* api creation problem */
	exit ();
}

/* Generate link to allow user to connect to Runkeeper and to allow your app */
$linkUrl = $rkAPI->connectRunkeeperButtonUrl ();

/*
 * After connecting to Runkeeper and allowing your app, user is redirected to
 * redirect_uri param (as specified in YAML config file) with $_GET parameter
 * "code"
 */
if ($_GET ['code']) { // $_GET['code']) {
	$auth_code = $_GET ['code'];
	if ($rkAPI->getRunkeeperToken ( $auth_code ) == false) {
		echo $rkAPI->api_last_error; /* get access token problem */
		echo "<hr>";
		exit ();
	} else {
		/*
		 * Your code to store $rkAPI->access_token (client-side, server-side or
		 * session-side)
		 */
		/* Note: $rkAPI->access_token will have to be set et valid for following operations */
		
		/* Do a "Read" request on "settings" interface => return all fields available for this Interface 
		$rkUser = $rkAPI->doRunkeeperRequest('User','Read');
		echo "below is the setting_data available for you to retrive from RunKepeer :";
		echo "<br>";
		//print_r($rkUser);
		$get1 = get_object_vars($rkUser);
		foreach ($get1 as $key=>$val){
			echo $key ." = ". $val;
			echo "<br>";
		}
				
		echo "<hr>";
		*/

		/* Do a "Read" request on "Profile" interface => return all fields available for this Interface */
		$rkProfile = $rkAPI->doRunkeeperRequest ( 'Profile', 'Read' );
		//echo "below is the User's_profile data from RunKepeer :";
		
		// print_r($rkProfile);
		$get2 = get_object_vars ( $rkProfile );echo "<br>";
		
		//echo "<hr>";
		
		// preper the data for insertion to DB
		/*
		 * 
		 */
		$tstring1 = implode ( '`, `', $get2 );//improve dode to 1 step
		$value2 = str_ireplace ( '`', "'", $tstring1 );
		$getstr = substr ( $value2, 4 );
				
		//data was parse in order to insert it to DB
		
		echo $getsum = $getstr;echo "<hr>";
		
		// insert data to DB
		try {
			$dbh = new PDO ( $dsn, $User, $pass );
			$sql2 = "INSERT INTO `harmoney_run_with_me`.`Users` (`birthday`, `location`, `medium_picture`, `name`, `elite`, `gender`, `athlete_type`, `normal_picture`, `profile`) VALUES ('$getsum');";
			$dbh->prepare ( $sql2 );
			$dbh->exec ( $sql2 );
			echo $getID = $dbh->lastInsertId();echo "<br>";
			echo "the belowed data was inserted to RunWithMe's DataBase";echo "<br>";
		} catch ( PDOException $e ) {
			echo 'Connection failed: ' . $e->getMessage ();
		}
				
		echo "<br>";
		echo "<br>";
		
		foreach ( $get2 as $key => $val ) {
			echo $key . " = " . $val;
			
			// insert data to DB
			
			echo "<br>";
		}
		echo "<hr>";
		
		/*
		 * Do a "Read" request on "Settings" interface => return all fields
		 * available for this Interface
		 */
		// $rkSettings = $rkAPI->doRunkeeperRequest('Settings','Read');
		// print_r($rkSettings);
		// echo "<hr>";
		
		/*
		 * Do a "Read" request on "FitnessActivities" interface => return all
		 * fields available for this Interface or false if request fails
		 */
		// $rkActivity = $rkAPI->doRunkeeperRequest('FitnessActivity','Read');
		// if ($rkActivity) {
		// print_r($rkActivity);
		// echo "<hr>";
		// }
		// else {
		// echo $rkAPI->api_last_error;
		// print_r($rkAPI->request_log);
		// echo "<hr>";
		// }
		
		/*
		 * Do a "Read" request on "FitnessActivityFeed" interface => return all
		 * fields available for this Interface or false if request fails
		 */
		$rkActivities = $rkAPI->doRunkeeperRequest ( 'FitnessActivityFeed', 'Read' );
		if ($rkActivities) {
			echo "below is the User's Fitness_Activity data from RunKepeer :";
			echo "<br>";
			echo "<br>";
			// print_r($rkActivities);//$rkUpdateActivity
			// var_dump(get_object_vars($rkProfile));
			$get3 = get_object_vars ( $rkActivities );
			$get4 = array_values ( $get3 );
			// print_r($get3);
			$i = 1;
			foreach ( $get4 as $key1 ) {
				foreach ( $key1 as $k ) {
					echo "Fitness activity Num $i :";
					echo "<br>";
					// print_r($k);
					$get5 = get_object_vars ( $k );
					
					// prepare data for DB insertion
					
					$activity = implode ( '`, `', $get5 );//improve dode to 1 step
					$value3 = str_ireplace ( '`', "'", $activity );
					echo "<br>";
					
					// insert data to DB
					/*	*/
					try {
						$dbh = new PDO ( $dsn, $User, $pass );
						$sql3 = "INSERT INTO `harmoney_run_with_me`.`Fitness_Activities` (`duration`, `total_distance`, `start_time`, `type`, `uri`, `Uid`) VALUES ('$value3', '$getID');";
						$dbh->prepare ( $sql3 );
						$dbh->exec ( $sql3 );
						echo "the belowed data was inserted to RunWithMe's DataBase";echo "<br>";
					} catch ( PDOException $e ) {
						echo 'Connection failed: ' . $e->getMessage ();
					}
				
					
					// print_r($get5);//ok
					foreach ( $get5 as $kk => $vv ) {
													
						echo $kk . " = " . $vv; echo "<br>";
					}
					
					echo "<br>";
					$i ++;
				}
			}
			
			echo "<hr>";
		} else {
			echo $rkAPI->api_last_error;
			print_r ( $rkAPI->request_log );
			echo "<hr>";
		}

// 		/* Do a "Create" request on "FitnessActivity" interface with fields => return created FitnessActivity content if request success, false if not */
// 		$fields = json_decode('{"type": "Running", "equipment": "None", "start_time": "Sat, 1 Jan 2011 00:00:00", "notes": "My first late-night run", "path": [{"timestamp":0, "altitude":0, "longitude":-70.95182336425782, "latitude":42.312620297384676, "type":"start"}, {"timestamp":8, "altitude":0, "longitude":-70.95255292510987, "latitude":42.31230294498018, "type":"end"}], "post_to_facebook": true, "post_to_twitter": true}');
// 		$rkCreateActivity = $rkAPI->doRunkeeperRequest('NewFitnessActivity','Create',$fields);
// 		if ($rkCreateActivity) {
// 			print_r($rkCreateActivity);
//			echo "<hr>";

// 		}
// 		else {
// 			echo $rkAPI->api_last_error;
// 			print_r($rkAPI->request_log);
//			echo "<hr>";
// 		}
	}
}
?>




<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<title>RunWithMe_Facebook Graph</title>
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
<header>Welcome to RunWithMe App</header>
	<br>
	
	<a
		href="https://runkeeper.com/apps/authorize?response_type=code&client_id=b80d1107a51f4d89becceacf7be01c21&redirect_uri=http%3A%2F%2Fharmoneya.com%2FRunWithMe%2Findex.php"><img
		alt=""
		src="http://static1.runkeeper.com/images/assets/connect-blue-white-200x38.png"></a>
	<br>
	<h1>Your Facebook Profile:</h1>

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
