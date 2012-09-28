<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Run With Me</title>
</head>
<body>
<header>Welcome to RunWithMe App</header><br>
<!-- --> 
<a href="https://runkeeper.com/apps/authorize?response_type=code&client_id=b80d1107a51f4d89becceacf7be01c21&redirect_uri=http%3A%2F%2Fharmoneya.com%2FRunWithMe%2Findex.php"><img alt="" src="http://static1.runkeeper.com/images/assets/connect-blue-white-200x38.png"></a>
<br>
</body>
</html>

<?php
error_reporting(E_ERROR);
define('YAMLPATH', 'MyYaml/');
define('RUNKEEPERAPIPATH', 'MateRunner/');
//define('CONFIGPATH', '/../config/');

/*
//test inserting data to local DB
$dsn = 'mysql:dbname=run_with_me;host=127.0.0.1';
$username = 'root';
$passwd = '22691711';
/*
 * 
 */
//remote DB:
$domain ='http://91.228.126.8:2082';
$User = 'harmoney_danny';
$pass ='22691711';
$Database = 'harmoney_run_with_me';
$dsn = 'mysql:dbname=harmoney_run_with_me;host=localhost';

/*
 * 
try {
	$dbh = new PDO($dsn, $User, $pass);
	echo $value ="16 Oct 1972 00:00:00`, `Tel Aviv, Israel`, `http://graph.facebook.com/855664405/picture?type=small`, `dannysaban`, `false`, `M`, `Runner`, `http://graph.facebook.com/855664405/picture?type=large`, `http://runkeeper.com/user/559625690";
	echo "<hr>";echo $value2 = str_ireplace('`', "'", $value);echo "<hr>";
	$sql ="INSERT INTO `harmoney_run_with_me`.`Users` (`birthday`, `location`, `medium_picture`, `name`, `elite`, `gender`, `athlete_type`, `normal_picture`, `profile`) VALUES ('Mon, 13 Oct 1972 00:00:00', ' Tel Aviv, Israel', 'http://graph.facebook.com/100003538821460/picture?type=small', 'danny.harmoneya', 'false', 'M', 'Runner', ' http://graph.facebook.com/100003538821460/picture?type=large', 'http://runkeeper.com/user/564356054');";
	$sql2= "INSERT INTO `harmoney_run_with_me`.`Users` (`birthday`, `location`, `medium_picture`, `name`, `elite`, `gender`, `athlete_type`, `normal_picture`, `profile`) VALUES ('$value2');";
	$dbh->prepare($sql2);
	echo $count = $dbh->exec($sql2);
	
} catch (PDOException $e) {
	echo 'Connection failed: ' . $e->getMessage();
}

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

require(YAMLPATH.'lib/sfYamlParser.php');
require(RUNKEEPERAPIPATH.'lib/runkeeperAPI.class.php');

/* API initialization */
$rkAPI = new runkeeperAPI(
		//CONFIGPATH.'rk-api.sample.yml'	/* api_conf_file */
		'rk-api.sample.yml'	/* api_conf_file */
		);
if ($rkAPI->api_created == false) {
	echo 'error '.$rkAPI->api_last_error; /* api creation problem */
	exit();
}

/* Generate link to allow user to connect to Runkeeper and to allow your app*/
$linkUrl = $rkAPI->connectRunkeeperButtonUrl();



/* After connecting to Runkeeper and allowing your app, user is redirected to redirect_uri param (as specified in YAML config file) with $_GET parameter "code" */
if ($_GET['code']){ //$_GET['code']) {
	$auth_code = $_GET['code'];
	if ($rkAPI->getRunkeeperToken($auth_code) == false) {
		echo $rkAPI->api_last_error; /* get access token problem */
		echo "<hr>";
		exit();
	}
	else {
		/* Your code to store $rkAPI->access_token (client-side, server-side or session-side) */
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
		$rkProfile = $rkAPI->doRunkeeperRequest('Profile','Read');
		echo "below is the User's_profile data from RunKepeer :";
		echo "<br>";echo "<br>";
		//print_r($rkProfile);
		$get2 = get_object_vars($rkProfile);
		echo "<hr>";
		$tstring1 = implode('`, `' , $get2);echo "<br>";echo "<br>";
		$value2 = str_ireplace('`', "'", $tstring1);
		
		echo "<hr>";
		//$tstring1 = implode('`, `' , $get2);echo "<br>";echo "<br>";
		$getstr = substr($value2, 4);	echo "<br>";echo "<br>";
		$getsum = $getstr;
		
		// insert data to DB
		/**/
		try {
			$dbh = new PDO($dsn, $User, $pass);
	//echo $value ="16 Oct 1972 00:00:00`, `Tel Aviv, Israel`, `http://graph.facebook.com/855664405/picture?type=small`, `dannysaban`, `false`, `M`, `Runner`, `http://graph.facebook.com/855664405/picture?type=large`, `http://runkeeper.com/user/559625690";
	//echo "<hr>";echo $value2 = str_ireplace('`', "'", $value);echo "<hr>";
	//$sql ="INSERT INTO `harmoney_run_with_me`.`Users` (`birthday`, `location`, `medium_picture`, `name`, `elite`, `gender`, `athlete_type`, `normal_picture`, `profile`) VALUES ('Mon, 13 Oct 1972 00:00:00', ' Tel Aviv, Israel', 'http://graph.facebook.com/100003538821460/picture?type=small', 'danny.harmoneya', 'false', 'M', 'Runner', ' http://graph.facebook.com/100003538821460/picture?type=large', 'http://runkeeper.com/user/564356054');";
	$sql2= "INSERT INTO `harmoney_run_with_me`.`Users` (`birthday`, `location`, `medium_picture`, `name`, `elite`, `gender`, `athlete_type`, `normal_picture`, `profile`) VALUES ('$getsum');";
	$dbh->prepare($sql2);
	echo $count = $dbh->exec($sql2);
	echo "the below data was inserted to RunWithMe's DataBase";
		
		} catch (PDOException $e) {
			echo 'Connection failed: ' . $e->getMessage();
		}
		
		
	echo "<br>";echo "<br>";
		
	
		
		foreach ($get2 as $key=>$val){
			echo $key ." = ". $val;
			
			
			// insert data to DB
			
			
			echo "<br>";
		}
		echo "<hr>";
		
		/* Do a "Read" request on "Settings" interface => return all fields available for this Interface */
		//$rkSettings = $rkAPI->doRunkeeperRequest('Settings','Read');
		//print_r($rkSettings);
		//echo "<hr>";
		
		/* Do a "Read" request on "FitnessActivities" interface => return all fields available for this Interface or false if request fails */
// 		$rkActivity = $rkAPI->doRunkeeperRequest('FitnessActivity','Read');
// 		if ($rkActivity) {
// 			print_r($rkActivity);
// 			echo "<hr>";
// 		}
// 		else {
// 			echo $rkAPI->api_last_error;
// 			print_r($rkAPI->request_log);
// 			echo "<hr>";
// 		}

		/* Do a "Read" request on "FitnessActivityFeed" interface => return all fields available for this Interface or false if request fails */
		$rkActivities = $rkAPI->doRunkeeperRequest('FitnessActivityFeed','Read');
		if ($rkActivities) {
			echo "below is the User's Fitness_Activity data from RunKepeer :";
			echo "<br>";echo "<br>";
			//print_r($rkActivities);//$rkUpdateActivity
			//var_dump(get_object_vars($rkProfile));
			/**/
			$get3 = get_object_vars($rkActivities);
			$get4 = array_values($get3);
			//print_r($get3);
			/**/
			$i =1;
			foreach ($get4 as $key1){
				foreach ($key1 as $k){
					echo "Fitness activity Num $i :";echo "<br>";
					//print_r($k);
					$get5 = get_object_vars($k);
					//print_r($get5);//ok
					foreach ($get5 as $kk =>$vv){
						echo $kk ." = ". $vv;
						//insert data to DB
						
						echo "<br>";
					}
					//echo $k ." = ". $v; // ." = ". $v;
					echo "<br>";
					$i++;
				}
				
			}
			
			echo "<hr>";
		}
		else {
			echo $rkAPI->api_last_error;
			print_r($rkAPI->request_log);
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

