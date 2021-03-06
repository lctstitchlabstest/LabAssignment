<?sql


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
