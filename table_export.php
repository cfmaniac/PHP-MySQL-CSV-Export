<?php
/*PHP File for Exporting or Saving a CSV from
a MySQL Database table.
Fill out the items denoted with a //***

File by J Harvey <jharvey@cfmaniac.com>
*/

//*** vars for export
$createcsv = false; 
$servecsv= true; 

//*** database table to be exported
$db_table = 'XXXXXXXXX';

//*** optional list of fields to export. Use * for all fields:
$db_select = '*'; 

//*** optional where query:
$where = 'WHERE 1 ORDER BY 1';

//*** filename for export:
$csv_filename = 'db_export_'.$db_table.'_'.date('Y-m-d').'.csv';

//*** database variables:
$hostname = "localhost"; 
$user = "XXXXXXXXX"; 
$password = "XXXXXXXXX"; 
$database = "XXXXXXXXX"; 

// Database connection:
mysql_connect($hostname, $user, $password)
or die('Could not connect: ' . mysql_error());
					
mysql_select_db($database)
or die ('Could not select database ' . mysql_error());

// create empty variable to be filled with export data:
$csv_export = '';

// query to get data from database:
$query = mysql_query("SELECT ".$db_select." FROM ".$db_table." ".$where);
$field = mysql_num_fields($query);

// create line with field names:
for($i = 0; $i < $field; $i++) {
  $csv_export.= mysql_field_name($query,$i).';';
}

// newline (seems to work both on Linux & Windows servers):
$csv_export.= '
';

// loop through database query and fill export variable:
while($row = mysql_fetch_array($query)) {
  // create line with field values
  for($i = 0; $i < $field; $i++) {
    $csv_export.= '"'.$row[mysql_field_name($query,$i)].'";';
  }	
  $csv_export.= '
';	
}

//How are we generating or serving the file:
if($servercsv === "true"){
// Export the data and prompt a csv file for download
header("Content-type: text/x-csv");
header("Content-Disposition: attachment; filename=".$csv_filename."");
echo($csv_export);
}

if($createcsv === "true"){
// Saves the csv on the server
$csv_file = fopen ($csv_filename,'w');
fwrite ($csv_file,csv_export);
fclose ($csv_file);
echo ('Data saved to CSV File:'.$csv_filename);

}
?>
