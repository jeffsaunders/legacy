<?
// simplified reading of an XLS
require_once 'reader.php';

$reader = new Spreadsheet_Excel_Reader();
$reader->setOutputEncoding("UTF-8");

$reader->read("8508686914ecc188efdcae80e9427385.xls");
//$reader->read("/tmp/test.xls");

for ($i = 1; $i <= $reader->sheets[0]["numRows"]; $i++)
{
	for ($j = 1; $j <= $reader->sheets[0]["numCols"]; $j++)
	{
		print "\"".$reader->sheets[0]["cells"][$i][$j]."\",";
	}
	echo "<br>";
}
?>