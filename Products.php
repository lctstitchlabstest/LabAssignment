<?php
include_once($IDDir . "/Stocks.php");


Class Products extends Stocks   
{
   protected $initialquantityStock;
   protected $committedStock;
   protected $availableStock;

	public function __construct($SKU, $QTY) {
		  
	    $this->SKU = $SKU;
		$this->initialquantityStock = $QTY; 
	    $this->committedStock = 0;
		$this->availableStock = $QTY; 
	}
  

	public function AddProduct ()  {  // - Creates a Product identified by SKU with a Stock and available quantity of Qty
        $piece1 = '(';
    	$piece2 = '';
		
		if(isset($SKU)) {
			$piece1 .= 'ProductSKU,';
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
			$piece1 .= 'TotalAMT,';
			$piece2 .= "" . $this->initialquantityStock . "";
            $piece2 .= ',';
		}
		else {
			echo " \n Error:  Quantity Field Empty  \n ";
			return false;
        }
		
		$piece1 .= 'CommittedAMT,';
		$piece2 .= $this->committedStock . ',';

 		$piece1 .= 'AvailableAMT';
        $piece2 .= $this->availableStock . ')';
		
		$piece1 .= ') VALUES (';

        $inventoryPiece = $piece1 . $piece2;
		
		$inventoryTable = 'Inventory';
		$productPiece = " (SKU) VALUES ('" . $this->SKU . "')";
		
	
        $inventoryResults = OrderData::InsertData($inventoryTable, $inventoryPiece);
		
		if($inventoryResults === false)
			return false;
			
		return true;
	}


	public function AddStock($SKU, $Qty)  {  //   - Increases Stock and Available for a given SKU

		$inventoryTable = 'Inventory';
		$productPiece = " (SKU) VALUES ('" . $this->SKU . "')";
		
        $piece2 = "WHERE ProductSKU ='" . $this->SKU . "'";
	}

}

//INSERT INTO productdata (prId, paId, pdData) VALUES (41488, 2947, '');
