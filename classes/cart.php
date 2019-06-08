<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>

<?php

class Cart{

    private $db;
    private $fm;

public function __construct(){
    $this->db = new Database();
    $this->fm = new Format();   
}

public function addToCart($quantity, $id){
    $quantity = $this->fm->validation($quantity); 
    $quantity = mysqli_real_escape_string($this->db->link, $quantity);
    $productId = mysqli_real_escape_string($this->db->link, $id);
    $sId = session_id();

    $query = "SELECT * FROM tbl_product WHERE productId = '$productId' ";
    $result = $this->db->select($query)->fetch_assoc();

    $productName = $result['productName'];
    $price = $result['price'];
    $image = $result['image'];

    $chquery = "SELECT * FROM tbl_cart WHERE productId = '$productId' AND sId = '$sId'";
    $getPro = $this->db->select($chquery);
    if ($getPro) {
        $msg = "<span class='fail'>Dit produkt zit reeds in je winkelwagentje.</span>";
        return $msg;
    }else{
    
    $query = "INSERT INTO tbl_cart(sId, productId, productName, price, quantity, image) 
    VALUES ('{$sId}','{$productId}','{$productName}','{$price}','{$quantity}','{$image}')";
    $inserted_row = $this->db->insert($query);
    if ($inserted_row) {
        $msg = "<span class='success'>Toegevoegd aan je winkelwagentje.</span>";
        return $msg;
    }else {
        $msg = "<span class='fail'>Dit kon niet toegevoegd worden aan winkelkar.</span>";
        return $msg;
        }
}
    
}

public function getCartProduct(){
    $sId = session_id();
    $query = "SELECT * FROM tbl_cart WHERE sId = '$sId' ";
    $result = $this->db->select($query);
    return $result;
}

public function getCartQuantity() {
    $sId = session_id();
    $query = "SELECT SUM(quantity) AS quantity FROM tbl_cart WHERE sId = '$sId' GROUP BY sId";
    $result = $this->db->select($query);
    $qty = 0;
    if ($result = $result->fetch_assoc()) {
        $qty = $result['quantity'];
    }
    return $qty;
}

public function updateCartQuantity($cartId, $quantity){
    $cartId = mysqli_real_escape_string($this->db->link, $cartId);
    $quantity = mysqli_real_escape_string($this->db->link, $quantity);

    $query = "UPDATE tbl_cart SET quantity = '$quantity' WHERE cartId = '$cartId'";
    $update_row = $this->db->update($query);

            if ($update_row) {
                $msg = "<span class='success'>Aantal is aangepast</span>";
                return $msg;
            }else{
                $msg = "<span class='error'>Aantal kon niet aangepast worden</span>";
                return $msg;
            }
        }

public function delProductByCart($delId){
    $delId = mysqli_real_escape_string($this->db->link, $delId);
    $query = "DELETE FROM tbl_cart WHERE cartId = '$delId'";
    $deldata = $this->db->delete($query);
    if ($deldata) {
        echo "<script>Window.location = 'cart.php';</script> ";
    }else{
        $msg = "<span class='error'>Item niet verwijderd. </span>";
        return $msg;
    }
}

public function checkCartTable(){
    $sId = session_id();
    $query = "SELECT * FROM tbl_cart WHERE sId = '$sId' ";
    $result = $this->db->select($query);
    return $result;
}

public function delCustomerCart(){
    $sId = session_id();
    $query = "DELETE FROM tbl_cart WHERE sId = '$sId' ";
    $result = $this->db->delete($query);
    return $result;
}

public function orderProduct($cmrId){
    $sId = session_id();
    $query = "SELECT * FROM tbl_cart WHERE sId = '$sId' ";
    $getPro = $this->db->select($query);
    if ($getPro) {
        while ($result = $getPro->fetch_assoc()) {
           $productId       = $result['productId'];
           $productName     = $result['productName'];
           $quantity        = $result['quantity'];
           $price           = $result['price'];
           $image           = $result['image'];
           $query = "INSERT INTO tbl_order(cmrId, productId, productName, quantity, price, image) 
           VALUES ('{$cmrId}','{$productId}','{$productName}','{$quantity}','{$price}','{$image}')";
           $inserted_row = $this->db->insert($query);
        }
    }
}

public function getOrderProduct($cmrId){
    $query = "SELECT * FROM tbl_order WHERE cmrId = '$cmrId' ORDER BY date DESC ";
    $result = $this->db->select($query);
    return $result;
}

public function checkOrder($cmrId){
    $query = "SELECT * FROM tbl_order WHERE cmrId = '$cmrId'";
    $result = $this->db->select($query);
    return $result;
}

//admin gedeelte. Alle orders oproepen
public function getAllOrderProduct(){
    $query = "SELECT * FROM tbl_order ORDER BY date";
    $result = $this->db->select($query);
    return $result;
}

//admin gedeelte. Alle archived orders oproepen
public function getAllArchivedOrders(){
    $query = "SELECT * FROM tbl_order_history ORDER BY date";
    $result = $this->db->select($query);
    return $result;
}

public function productShifted($id,$date,$price){
    $id     = mysqli_real_escape_string($this->db->link, $id);
    $date   = mysqli_real_escape_string($this->db->link, $date);
    $price  = mysqli_real_escape_string($this->db->link, $price);

    $query = "UPDATE tbl_order
            SET 
            status = '1'
            WHERE cmrId = '$id' AND date = '$date' AND price = '$price' ";
            $update_row = $this->db->update($query);
            if ($update_row) {
                $msg = "<span class='success'>status updated</span>";
                return $msg;
            }else{
                $msg = "<span class='error'>status update mislukt</span>";
                return $msg;
            }
}

public function movedToHistory($prodline){
    $sId = session_id();
    $query = "SELECT * FROM tbl_order WHERE id = ' $prodline' ";
    $getOrderId = $this->db->select($query);
    if ($getOrderId) {
        while ($result = $getOrderId->fetch_assoc()) {
           $orderId         = $result['id'];
           $productId       = $result['productId'];
           $productName     = $result['productName'];
           $cmrId           = $result['cmrId'];
           $quantity        = $result['quantity'];
           $price           = $result['price'];
           $date            = $result['date'];
           $query = "INSERT INTO tbl_order_history(cmrId, productId, productName, quantity, price, date, orderid) 
           VALUES ('{$cmrId}','{$productId}','{$productName}','{$quantity}','{$price}','{$date}','{$orderId}')";
           $inserted_row = $this->db->insert($query);
        }
        $msg2 = "<span class='success'> en verplaatst naar order history </span>";
        return $msg2;
    }
}


public function delProductShifted($id,$date,$price){
    $id     = mysqli_real_escape_string($this->db->link, $id);
    $date   = mysqli_real_escape_string($this->db->link, $date);
    $price  = mysqli_real_escape_string($this->db->link, $price);
    $query = "DELETE FROM tbl_order WHERE cmrId = '$id' AND date = '$date' AND price = '$price' ";
    $deldata = $this->db->delete($query);
    if ($deldata) {
        $msg = "<span class='success'>Bestelling afgehandeld </span>";
        return $msg;
    }else{
        $msg = "<span class='error'>Oeps, een error </span>";
        return $msg;
    }
}

//ophalen van de laatste toegevoegde record in de bestellingen en daar de data van weergeven aan gebruiker als betalingsreferentie
public function getpaymentdata(){
    $query = "SELECT * FROM tbl_order ORDER BY id DESC LIMIT 1";
    $result = $this->db->select($query);
    return $result;
}

// under construction
// TODO: Many-to-Many relations ipv op date selecteren
public function getTotalValueLastOrder(){
    // 1. eerst de hoogste datum oproepen (OK)
    $lastOrderDate = "SELECT date FROM tbl_order ORDER BY date DESC LIMIT 1";
    $lastOrderDate = $this->db->select($lastOrderDate);
    $date = null;
    if ($lastOrderDate) {
        while ($result = $lastOrderDate->fetch_assoc()) {
            $date = $result['date'];
        }
    }
    
    // 2. alle rows oproepen die corresponderen met deze datum
    $query = "SELECT * FROM tbl_order WHERE date = '$date'";

    $result = $this->db->select($query);
    
    return $result;
}
//

public function accountnumber(){
    $query = "SELECT * FROM tbl_companyinfo";
    $result = $this->db->select($query);
    return $result;
}

//inserten van custom product to the cart
public function addCustToCart($cProduct, $quantity, $unitprice, $productId, $sticker){

//declareren van de product variabelen die dan meegestuurt worden in de insert

    $Id = session_id();
    
    $query = "INSERT INTO tbl_cart(sId, productId, productName, price, quantity, remarks) 
    VALUES ('{$Id}','{$productId}','{$cProduct}','{$unitprice}','{$quantity}','{$sticker}')";
    $inserted_row = $this->db->insert($query);
    if ($inserted_row) {
        $msg = "<span class='success'>Toegevoegd aan winkelkar.</span>";
        return $msg;
    }else {
        $msg = "<span class='error'>Dit kon niet toegevoegd worden aan winkelkar.</span>";
        return $msg;
        }

    
}


}

?>