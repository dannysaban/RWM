<?php

$input_data_AVG = array(1.98, 2.09, 2.34, 4.09, 5,4.87, 4.33, 4.91, 5);
$input_bit_AVG_sum = $input_data_AVG ;
$input_bit_AVG_sum2 = $input_data_AVG ;

$input_data_danny = array(1,2,2,4,5,4,1,4,5);
$input_bit_danny_sum = $input_data_danny ;
$input_bit_danny_sum_AVG = $input_data_danny ;
$input_bit_danny_sum_KLD = $input_data_danny ;

$input_data_yossi = array(0,5,2,4,4,2,2,1,4);
$input_bit_yossi_sum = $input_data_yossi ;
$input_bit_yossi_sum_AVG = $input_data_yossi ;
$input_bit_yossi_sum_KLD = $input_data_yossi ;

//******************************************
$n = 80;
$prams = 9;
//$aa=0;
$one = 1;

ECHO "Network AVG score: ";echo "\t";
foreach ($input_data_AVG as $val_AVG){
	echo $AVG = $val_AVG;echo "\t";


}

echo "<hr>";
ECHO "2 users' set of weights:";echo "<br>";echo "<br>";
ECHO " YOSSI score  : ";echo "\t";
foreach ($input_data_yossi as $val_y){
	echo $yossi = $val_y;echo "\t";
	
	
}

echo "<br>";
ECHO "DANNY score: ";echo "\t";
foreach ($input_data_danny as $val_d){
	echo $danny = $val_d;echo "\t";
	
}
//************************ test D to Y ************************

echo "<hr>";
foreach ($input_bit_yossi_sum as $val_y_s){

	
	$get_yossi_bit = array_pop($input_bit_yossi_sum);
	$get_danny_bit = array_pop($input_bit_danny_sum);
	
	$get_bit_sum0 = $get_yossi_bit - $get_danny_bit;
	$get_bit_sum1 = $get_bit_sum0/$prams; 
	$get_bit_sum2 =  pow($get_bit_sum1, 2);
	$get_bit_sum += sqrt($get_bit_sum2);

}
echo "'slope-one' Algorithm: ";echo "<br>";echo "<br>";
echo 	"total diff D->Y = ". $get_bit_sum;echo "<br>";
echo 	"total power D->Y = ". $get_pow = pow($get_bit_sum, 2);echo "<br>";
echo 	"set by by total users D->Y= ". $get_users = $get_pow/$n;echo "<br>";
echo 	"total Yossi distance from Danny = ". $dis = sqrt($get_users);echo "<hr>";
echo 	"rank of Danny->Yossi = ". $sum = 1 - $dis;echo "<hr>";


echo "<br>";
echo "<hr>";
echo "KLD Algorithm: ";echo "<br>";echo "<br>";
//echo "<br>";

//****************************test AVG danny*****************************************************

foreach ($input_bit_danny_sum_AVG as $val_y_s){


	$get_AVG_bit = array_pop($input_bit_AVG_sum);
	$get_danny_bit_AVG = array_pop($input_bit_danny_sum_AVG);

	$get_bit_sum00 = $get_AVG_bit - $get_danny_bit_AVG;
	$get_bit_sum01 = $get_bit_sum00/$prams;
	$get_bit_sum02 =  pow($get_bit_sum01, 2);
	$get_bit_sum_AVG += sqrt($get_bit_sum02);

}

echo 	"total diff D->AVG = ". $get_bit_sum_AVG; echo "<br>";
echo 	"total power D->AVG = ". $get_pow_AVG = pow($get_bit_sum_AVG, 2);echo "<br>";
echo 	"set by by total users D->AVG = ". $get_users_AVG = $get_pow_AVG/$n;echo "<br>";
echo 	"total distance D->AVG = ". $dis_d = sqrt($get_users_AVG);echo "<hr>";
echo 	"rank of D->AVG = ". $sum_AVG = 1 - $dis_d;echo "<hr>";

//****************************test AVG yossi*****************************************************

foreach ($input_bit_yossi_sum_AVG as $val_yossi){


	$get_AVG2_bit = array_pop($input_bit_AVG_sum2);
	$get_yossi_sum_AVG = array_pop($input_bit_yossi_sum_AVG);

	$get_bit_sum_y1 = $get_AVG2_bit - $get_yossi_sum_AVG;
	$get_bit_sum_y2 = $get_bit_sum_y1/$prams;
	$get_bit_sum_y3 =  pow($get_bit_sum_y2, 2);
	$get_bit_sum_y += sqrt($get_bit_sum_y3);

}

echo 	"total diff Y->AVG = ". $get_bit_sum_y; echo "<br>";
echo 	"total power Y->AVG = ". $get_pow_y = pow($get_bit_sum_y, 2);echo "<br>";
echo 	"set by by total users Y->AVG = ". $get_users_y = $get_pow_y/$n;echo "<br>";
echo 	"total distance Y->AVG = ". $dis_y = sqrt($get_users_y);echo "<hr>";
echo 	"rank of Y->AVG = ". $sum_y = 1 - $dis_y;echo "<hr>";

//****************************test KLD*****************************************************

foreach ($input_bit_danny_sum_KLD as $val_dkl){


	$get_yossi_bit_KLD = array_pop($input_bit_yossi_sum_KLD);
	$get_danny_bit_KLD = array_pop($input_bit_danny_sum_KLD);

	$get_bit_KLD1 = $get_AVG_bit - $get_danny_bit_AVG;
	$get_bit_KLD2 = $get_bit_KLD1/$prams;
	$get_bit_KLD3 =  pow($get_bit_KLD2, 2);
	$get_bit_KLD += sqrt($get_bit_KLD3);

}


/**/

echo "KLD calculate the distance of YOSSI to DANNY as: ". $kld3 = sqrt(pow($dis_y*log10($dis_y/$dis_d),2));echo "<br>";
echo  "rank danny to yossi is: " . $result = $one - $kld3;





