<?php

/*
#########################################################################
/   script query_alcoma_interfaces.php for CACTI projects               #
/									#
/   part of "Alcoma MP CACTI Template"  				#
/									#
/   created by Patrik Majer (Kacer Huhu) - www.patrik-majer.net		#
/									#
/   version 0.1 - alpha - 2011-05-02					#
/									#
#########################################################################
*/

/* do NOT run this script through a web browser */
if (!isset($_SERVER["argv"][0]) || isset($_SERVER['REQUEST_METHOD'])  || isset($_SERVER['REMOTE_ADDR'])) {
   die("<br><strong>This script is only meant to run at the command line.</strong>");
}

$no_http_headers = true;

include(dirname(__FILE__) . "/../include/global.php");
include(dirname(__FILE__) . "/../lib/snmp.php");

$oids = array(
	"status"		=> ".3",
	"type" 			=> ".5",
	"speed"			=> ".4",
	"bytes_in"		=> ".8",
	"bytes_out"		=> ".10",
	"packets_in"		=> ".7",
	"packets_out"		=> ".9",
	"error"			=> ".11",
	"collision"		=> ".12",
	);

$hostname 	= $_SERVER["argv"][1];
$host_id 	= $_SERVER["argv"][2];
$snmp_auth 	= $_SERVER["argv"][3];
$cmd 		= $_SERVER["argv"][4];

/* support for SNMP V2 and SNMP V3 parameters */
$snmp = explode(":", $snmp_auth);
$snmp_version 	= $snmp[0];
$snmp_port    	= $snmp[1];
$snmp_timeout 	= $snmp[2];
$ping_retries 	= $snmp[3];
$max_oids	= $snmp[4];

$snmp_auth_username   	= "";
$snmp_auth_password   	= "";
$snmp_auth_protocol  	= "";
$snmp_priv_passphrase 	= "";
$snmp_priv_protocol   	= "";
$snmp_context         	= "";
$snmp_community 	= "";

if ($snmp_version == 3) {
	$snmp_auth_username   = $snmp[6];
	$snmp_auth_password   = $snmp[7];
	$snmp_auth_protocol   = $snmp[8];
	$snmp_priv_passphrase = $snmp[9];
	$snmp_priv_protocol   = $snmp[10];
	$snmp_context         = $snmp[11];
}else{
	$snmp_community = $snmp[5];
}

/*
 * process INDEX requests
 */
if ($cmd == "index") {

	$return_arr = array(0,1);
	
	for ($i=0;($i<sizeof($return_arr));$i++) {
		print $return_arr[$i] . "\n";
	}

/*
 * process NUM_INDEXES requests
 */
}elseif ($cmd == "num_indexes") {

	$return_arr = array(0,1);

	print sizeof($return_arr) . "\n";	

/*
 * process QUERY requests
 */
}elseif ($cmd == "query") {
	$arg = $_SERVER["argv"][5];

	$arr_index = array(0,1);
	
	if($arg == "index")
	{ $arr = array(0,1); }
	elseif($arg == "name")
	{ $arr = array("MPLine2","MPLine3"); }
	else
	{

	  for ($i=0;($i<sizeof($arr_index));$i++) {
		
		if( $i == 0){ $oid = ".1.3.6.1.4.1.12140.2.9"; }
		elseif ($i == 1){ $oid = ".1.3.6.1.4.1.12140.2.10"; }
				
		$x = cacti_snmp_walk($hostname, $snmp_community, $oid.$oids[$arg], $snmp_version, $snmp_auth_username, $snmp_auth_password, $snmp_auth_protocol, $snmp_priv_passphrase, $snmp_priv_protocol, $snmp_context, $snmp_port, $snmp_timeout, $ping_retries, $max_oids, SNMP_POLLER);
		
		list($x) = explode ("(", $x[0]["value"]);
		
		if($arg == "status")
		{
		    if($x == 0){ $x = "down (".$x.")"; }
		    elseif($x == 1){ $x = "up (".$x.")"; }
		}		
		elseif( $arg == "type" )
		{
		    if( $x == -1){ $x = "offline (".$x.")"; }
		    elseif( $x == 0) { $x = "halfduplex (".$x.")"; }
		    elseif( $x == 1){ $x = "fullduplex (".$x.")"; }
		}
		elseif($arg == "speed")
		{
		    if( $x == -1){ $x = "offline (".$x.")"; }
		    elseif( $x == 0) { $x = "10Mb/s (".$x.")"; }
		    elseif( $x == 1){ $x = "100Mb/s (".$x.")"; }
		    elseif( $x == 2){ $x = "1000Mb/s (".$x.")"; }
	
		}
		
		$arr[]  =  $x;
	  }  
        }
        
	for ($i=0;($i<sizeof($arr_index));$i++) {
		print $arr_index[$i] . "!" . $arr[$i] . "\n";
	}

/*
 * process GET requests
 */
}
elseif ($cmd == "get") {
	$arg = $_SERVER["argv"][5];
	$index = $_SERVER["argv"][6];

	if( $index == 0){ $oid = ".1.3.6.1.4.1.12140.2.9"; }
	elseif ($index == 1){ $oid = ".1.3.6.1.4.1.12140.2.10"; }

	print (cacti_snmp_get($hostname, $snmp_community, $oid.$oids[$arg].".0", $snmp_version, $snmp_auth_username, $snmp_auth_password, $snmp_auth_protocol,$snmp_priv_passphrase,$snmp_priv_protocol, $snmp_context, $snmp_port, $snmp_timeout, $ping_retries, SNMP_POLLER));

}
else {
	print "ERROR: Invalid command given\n";
}

/*
function reindex($arr) {
	$return_arr = array();

	for ($i=0;($i<sizeof($arr));$i++) {
		$return_arr[$i] = $arr[$i]["value"];
	}

	return $return_arr;
}
*/

?>
