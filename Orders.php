<?php
include_once($IDDir . "/Stocks.php");



Class Orders extends Products   
{
   protected $orderedquantityStock;
   ptotected $orderID;

	public function __construct($OrderId, $SKU, $Qty) {
		  
	    $this->SKU = $SKU;
		$this->orderedquantityStock = $Qty; 
	    $this->orderID = $OrderId; 
	}
  

	public function CustomerOrder ()  {  //  - Someone purchases Qty of the SKU on an order identified by OrderId. Decrements Available, and increments Committed for the specified SKU.
        $piece1 = '(';
    	$piece2 = '';
		
		if(isset($SKU)) {
			$piece1 .= 'SKU,';
			$piece2 .= "'" . $this->SKU . "'";
            $piece2 .= ',';
		}
		else {
			echo " \n Error:  SKU Field Empty  \n ";
			return false;
        }
		
		$productTable = 'Products';
		$productPiece = " (SKU) VALUES ('" . $this->SKU . "')";
		
	
        $productResults = OrderData::InsertData($productTable, $productPiece);
		
		if($productResults === false)
			return false;
		
		
		if(isset($Qty)) {
			$piece1 .= 'PetFavoriteFood,';
			$piece2 .= "'" . $Qty . "'";
            $piece2 .= ',';
		}
		else {
			echo " \n Error:  Quantity Field Empty  \n ";
			return false;
        }
		
		$piece1 .= 'PetAge,';
		$piece2 .= ',';
		
		if(isset($DB_PET_TYPE)) {
			$piece1 .= 'PetTypeId';
			$piece2 .= OrderData::$petArray[$DB_PET_TYPE];
		}
        $piece2 .= ')';
		
		$piece1 .= ') VALUES (';

        $insertPiece = $piece1 . $piece2;
		
		
		
		
		return true;
	}




	public function ShipOrder ($OrderId)  {  //   - Ships the order to its buyer. Decrements Stock and Committed for each SKU on the Order. Fails if there is not enough Available for any one of its line items

	}


}
