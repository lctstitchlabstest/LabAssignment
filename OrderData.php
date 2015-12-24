<?php
$IDDir = dirname(__FILE__);
//include_once($IDDir . "/../incl/conf.php"); 
include_once($IDDir . "/DBConn.php");
// bind SOAP/Client.php -> path of the php file

class OrderData extends DBConn {
	/**********************************************************************************************************************************************************/
	//  Please note:  This class is specific to the Stitch Labs Homework Assignment and provides the necessary specification for applying the DBConn abstraction to the specific method database interaction requirements.
	/**********************************************************************************************************************************************************/
    private static $Array;
    private static $Stitch_Database = 'stitch';  //  This is set when an object to this class is instantiated and is passed in whenever a database call is made
                                                 //   This database value assignment Needs to be in here
	public function __construct($database) {
		  
	    OrderData::SingleDB($database);
		OrderData::$Stitch_Database = $database; 
	}
  
	public static function get_product_rows($sql = '') {
		//  This is NOT completely implemented and not used
		$dbh = DBConn::SingleDB(OrderData::$Stitch_Database);
		
		$sql = "
			SELECT * 
			  FROM Products" . $sql . "";
			  
		$sthselect = $dbh->PrepareSQL($sql);
		$dbh->ExecuteSQL($sthselect, array());

		if(!($results = $dbh->GetSQLResultSet($sthselect)))
			$results = "could not retrieve records";
        //echo "      \n       " . $sql . "      \n       ";

		return $results;  

	}


	public static function delete_product_rows($sql = '') {
		//  This is NOT completely implemented and not used
		$dbh = DBConn::SingleDB(OrderData::$Stitch_Database);
		
		$sql = "
			DELETE 
			  FROM Products" . $sql . "";
			  
		$sthselect = $dbh->PrepareSQL($sql);
		$dbh->ExecuteSQL($sthselect, array());

		if(!($results = $dbh->GetSQLResultSet($sthselect)))
			$results = "could not delete records";
        //echo "      \n       " . $sql . "      \n       ";

		return $results;  

	}
	


	public static function get_table_dump() {
		//  This is used in Part II to check persistence
		$dbh = DBConn::SingleDB(OrderData::$Stitch_Database);
		
		try {
			//$dbh->beginTransaction();
			$sql = "
				SELECT * 
				  FROM Products";
				  
			$sthselect = $dbh->PrepareSQL($sql);
			$dbh->ExecuteSQL($sthselect, array());

			if(!($results = $dbh->GetSQLResultSet($sthselect)))
				$results = "could not retrieve records";

			return $results;  
		} catch (PDOException $e) {
			//$dbh->rollBackSQL($sthselect);
            die ($e->getMessage() . PHP_EOL); 
		}
	}
	
	
	
	
	public static function InsertData($DB_TABLE, $insertPiece)
    { //  This is used in both Parts I and II
		
 		$dbh = DBConn::SingleDB(OrderData::$Stitch_Database);
 		
        $sql = " INSERT INTO $DB_TABLE" .  $insertPiece."";
		
		$sthselect = $dbh->PrepareSQL($sql);
		$dbh->ExecuteSQL($sthselect, array());
		$recordID = $dbh->LastInsertId();
		if((empty($recordID)))  {
			$results = false;     // "could not insert table record";
			echo " \n Unable to insert record into table $DB_TABLE \n Fatal Process Error."
		}
		else  {
			$results = "ID:  " . $recordID . PHP_EOL . "One record for $DB_TABLE has been successfully inserted.";
			
        }
		return $results;  
	
    }

	
	
	
///////////////////////////////////////**********************************************************************//////////////////////////////////
	public static function Update_Data($DB_TABLE, $updatePiece) {
		
		$dbh = DBConn::SingleDB(OrderData::$Stitch_Database);
		//return $dbh;
		try {
			//$dbh->beginTransaction();
			$sql = "
				UPDATE Inventory 
                  Set ? = ? + ?
				    WHERE ProductSKU = ? LIMIT 1";
			$sql3 = "SELECT * FROM Inventory LIMIT 1";
			$sql2 = "
				UPDATE Inventory 
                  Set $Field = $Field $Update
				    WHERE ProductSKU = '" . $Product . "' LIMIT 1";
                  //  Set AvailableAMT = AvailableAMT + ?";
				  
			$sthselect = $dbh->PrepareSQL($sql2);
			$dbh->ExecuteSQL($sthselect, array());
		//	if(!($results = $dbh->GetSQLResultSet($sthselect)))

				//$results = "could not retrieve records";
             echo " \n $sql2  \n ";
			//return $results;  
		} catch (PDOException $e) {
			//$dbh->rollBackSQL($sthselect);
			    if ($e->getCode() == '1690')
                   echo " \n The quantity requested is not available: ".$e->getMessage(); 
            //die ($e->getMessage() . PHP_EOL); 
		}

      //  return $exception->getMessage(); 
      //  echo "exception: ".$exception;

    }

	
	
///////////////////////////////////////**********************************************************************//////////////////////////////////
	public static function Update_inventory($Field, $Update, $Product) {
		
		$dbh = DBConn::SingleDB(OrderData::$Stitch_Database);
		//return $dbh;
		try {
			//$dbh->beginTransaction();
			$sql = "
				UPDATE Inventory 
                  Set ? = ? + ?
				    WHERE ProductSKU = ? LIMIT 1";
			$sql3 = "SELECT * FROM Inventory LIMIT 1";
			$sql2 = "
				UPDATE Inventory 
                  Set $Field = $Field $Update
				    WHERE ProductSKU = '" . $Product . "' LIMIT 1";
                  //  Set AvailableAMT = AvailableAMT + ?";
				  
			$sthselect = $dbh->PrepareSQL($sql2);
			$dbh->ExecuteSQL($sthselect, array());
		//	if(!($results = $dbh->GetSQLResultSet($sthselect)))

				//$results = "could not retrieve records";
             echo " \n $sql2  \n ";
			//return $results;  
		} catch (PDOException $e) {
			//$dbh->rollBackSQL($sthselect);
			    if ($e->getCode() == '1690')
                   echo " \n The quantity requested is not available: ".$e->getMessage(); 
            //die ($e->getMessage() . PHP_EOL); 
		}

      //  return $exception->getMessage(); 
      //  echo "exception: ".$exception;

    }

	
	
	// INSERT INTO `stitch`.`inventory` (`IId`, `ProductSKU`, `TotalAMT`, `CommittedAMT`, `AvailableAMT`) VALUES (NULL, 'TSHIRT1%E2%88%92SM', '5', '2', '3'); 
}
