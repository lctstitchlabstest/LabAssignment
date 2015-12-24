# LabAssignment
Stockings
Database



Products table //  
ID  
SKU

Inventory table
InventoryID
ProductID/SKU
AMT
CommittedAMT
//  AvailableAMT - Unnecessary


Orders Table
OrderID (non-unique)
ProductID/SKU
QtyOrdered


If I were going to extend this application I would create an OrderOperation Table
This would have a field for the Order as well as the name of the corresponding function to call.
This function would strip the content string into arguments they way that is currently done in the switch statement before calling the appropriate function.
This approach would be better in organization because I'm separating the switch statement into separate functions but I'm still writing about the same amount of code.





CREATE TABLE IF NOT EXISTS Products(
  PId  TINYINT(3) UNSIGNED AUTO_INCREMENT NOT NULL,      
  SKU   VARCHAR(35) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,     
  PRIMARY KEY ( PId ),
  UNIQUE KEY ( SKU )
  )ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_swedish_ci;   


CREATE TABLE IF NOT EXISTS Inventory (
  IId  int(11) UNSIGNED AUTO_INCREMENT NOT NULL,      
  ProductSKU VARCHAR( 35 ) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,     
  TotalAMT TINYINT(3) UNSIGNED NOT NULL,     
  CommittedAMT TINYINT(3) UNSIGNED NOT NULL,
  AvailableAMT  TINYINT(3) UNSIGNED NOT NULL,      
  PRIMARY KEY ( IId ),
  FOREIGN KEY (ProductSKU) REFERENCES Products(SKU)
  )ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_swedish_ci;   
  


CREATE TABLE IF NOT EXISTS Orders (
  ordId  int(11) UNSIGNED NOT NULL,      
  ProductSKU   VARCHAR(35) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL, 
  PurchaseQuantity TINYINT(3) UNSIGNED NOT NULL,
  Shipped BOOLEAN NOT NULL DEFAULT false,
  opvTime TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  UNIQUE KEY (ordId, ProductSKU),
  FOREIGN KEY (ProductSKU) REFERENCES Products(SKU)
) ; 



Scripting


abstract Class Stocks   
{
   protected $SKU;

}

Class Products extends Stocks   
{
   protected $initialquantityStock;
   protected $committedStock;
   protected $availableStock;


	public function AddProduct ($SKU, $Qty)  {  // - Creates a Product identified by SKU with a Stock and available quantity of Qty


	}


	public function AddStock($SKU, $Qty)  {  //   - Increases Stock and Available for a given SKU


	}

}




Class Orders extends Products   
{
   protected $orderedquantityStock;
   ptotected $orderID;


	public function CustomerOrder ($OrderId, $SKU, $Qty)  {  //  - Someone purchases Qty of the SKU on an order identified by OrderId. Decrements Available, and increments Committed for the specified SKU.

	}


	public function ShipOrder ($OrderId)  {  //   - Ships the order to its buyer. Decrements Stock and Committed for each SKU on the Order. Fails if there is not enough Available for any one of its line items

	}


}






	
//The command factory.  Input the command you wish executed.
class CommandFactory {
   
    //Different types of cars.
    const ORDER_CUSTOMERORDER = "CustomerOrder";
    const ORDER_SHIPORDER = "ShipOrder";
    const ORDER_ADDPRODUCT = "AddProduct";
    const ORDER_ADDSTOCK = "AddStock";
   
    //Make the car that is selected.
    public static function injectOrder($Object, $orderString){
	
        $wordarray[$filetextarray[0]] = $filetextarray[1];
	    
        switch($orderType){
            case self::ORDER_CUSTOMERORDER:
                return new Honda();
                break;
            case self::ORDER_SHIPORDER:
                return new Toyota();
                break;
            case self::ORDER_ADDPRODUCT:
                return new Mazda();
				break;
            case self::ORDER_ADDSTOCK:
                return new Toyota();
                break;
            default:
                echo " \n Order  '" . $orderType . "'  isn't recognized. \n ";
        }
        /// die("Order isn't recognized.");
    }
   
}



//  Testing script

$filedata = file_get_contents('./text.txt', true);
$filearray = explode("\n", $filedata);
$wordarray = array();

foreach($filearray as $filetext)
    {
    $filetextarray = explode(' ', $filetext);	
	CommandFactory::injectOrder($Object, $orderString);
    }
