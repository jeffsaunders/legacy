<?php
class OdbcManager{
var $database;
var $columns_name;
	function connect($odbc_name,$hostname_DB="",$username_DB="", $password_DB="")
		{
		$this->database=odbc_pconnect($odbc_name,$username_DB,$password_DB)or die("Cant Open Excle");
		$this->columns_name=$this->headtable();
		}

 	function headtable(){
                $tables = odbc_tables($this->database) ;
                $a_tit = array();
                $i = 0;
                while(odbc_fetch_row($tables)){
                        $a_tit[$i] = odbc_result($tables, 3);
                        $i++;
                }
                return $a_tit;
        }

 function columntable($nomtable="myrange"){
                $query = "SELECT * FROM $nomtable";
                $qid = odbc_exec($this->database, $query);
                $i = 1;
                $a_col = array();
                $j = odbc_num_fields($qid);
                
                while( $i <= $j ){
                        $a_col[$i] = odbc_field_name($qid, $i);
                      
                        $i++;
                }
                return $a_col;
        }
  function printtable($nomtable="myrange"){
                echo '<table border="1"><tr>';

                
                $columns = $this->columntable($nomtable);
                $i = 1;

                while ($i <= count($columns)){
                        echo "<td>$columns[$i]</td>";
                        $i++;
                }
                echo '</tr>';
                
                $query = "SELECT * FROM $nomtable";
                $result = odbc_exec($this->database, $query);
                while ( odbc_fetch_row ($result)){
                        $j = 1;
						if(odbc_result($result, 1)!=NULL){
                        echo '<tr>';
						
                        while($j < $i){
                                echo "<td>".odbc_result ($result, $j)."</td>";
                                $j++;
                        }
                        echo '</tr>';
							}
                        }
                
                echo '</table>';


        }
		function return_import_values($nomtable="myrange")
		{
		$array=array();
		$row_count=0;

		
        $columns = $this->columntable();
        $i = 1;
       while ($i <= count($columns)){
                        $i++;
                }

                
                $query = "SELECT * FROM $nomtable";
                $result = odbc_exec($this->database, $query);
                while ( odbc_fetch_row ($result)){
				$row_count++;
                        $j = 1;
						if(odbc_result($result, 1)!=NULL){
                          while($j < $i){
                              $array[$row_count][$columns[$j]]=odbc_result ($result, $j);
                              $j++;
                        }
                       
							}
                        }
                
           return $array   ;
		}
		
			function close()
		{
		$this->database=odbc_close($this->database);

		}


}


?>
