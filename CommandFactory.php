<?PHP
include_once($IDDir . "/Orders.php");





	
//The command factory.  Input the command you wish executed.
class CommandFactory {
   
    //Different types of cars.
    const ORDER_CUSTOMERORDER = "CustomerOrder";
    const ORDER_SHIPORDER = "ShipOrder";
    const ORDER_ADDPRODUCT = "AddProduct";
    const ORDER_ADDSTOCK = "AddStock";
   
    //Make the car that is selected.
    public static function injectOrder($Object, $orderString){
	
	    
        switch($orderType){
            case self::ORDER_CUSTOMERORDER:
                $Object->CustomerOrder($orderString);
                break;
            case self::ORDER_SHIPORDER:
                $Object->ShipOrder($orderString);
                break;
            case self::ORDER_ADDPRODUCT:
                $Object->AddProduct($orderString);
				break;
            case self::ORDER_ADDSTOCK:
                $Object->AddStock($orderString);
                break;
            default:
                echo " \n Order  '" . $orderType . "'  isn't recognized. \n ";
        }
        /// die("Order isn't recognized.");
    }
   
}

