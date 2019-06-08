<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>

<?php

// Category class 
class Category{

    private $db;
    private $fm; //$format

    public function __construct(){
       $this->db = new Database();
       $this->fm = new Format();   
}

public function catInsert($catName){
    $catName = $this->fm->validation($catName); 
    $catName = mysqli_real_escape_string($this->db->link, $catName);
    if(empty($catName)) {
        $msg = "Category name cannot be empty";
        return $msg;
    }else{
        $query = "INSERT INTO tbl_category(catName) VALUES ('$catName')";
        $catinsert = $this->db->insert($query);
        if ($catinsert) {
            //de class wordt gedefineerd in layout.css
            $msg = "<span class='success'>Category Inserted. </span>";
            return $msg;
        }else {
            $msg = "<span class='error'>Category insert failed. </span>";
        }
    }
}

public function getAllCat(){
    $query = "SELECT * FROM tbl_category ORDER BY catId DESC";
    $result = $this->db->select($query);
    return $result;
}

public function getCatById($id){
$query = "SELECT * FROM tbl_category WHERE catId = '$id' ";
    $result = $this->db->select($query);
    return $result;
}

public function catUpdate($catName, $id){
    $catName = $this->fm->validation($catName); 
    $catName = mysqli_real_escape_string($this->db->link, $catName);
    $id = mysqli_real_escape_string($this->db->link, $id);
    if(empty($catName)) { // als het update veld leeg is krijg je een error
        $msg = "<span class='error'>Category Field must not be empty. </span>";
        return $msg;
        }else{
            $query = "UPDATE tbl_category
            SET 
            catName = '$catName'
            WHERE catId = '$id'";
            $update_row = $this->db->update($query);
            if ($update_row) {
                $msg = "<span class='success'>Category Updated Successfully. </span>";
                return $msg;
            }else{
                $msg = "<span class='error'>Category not updated. </span>";
                return $msg;
            }
        }
    }

    public function delCatById($id){
        $query = "DELETE FROM tbl_category WHERE catId = '$id'";
        $deldata = $this->db->delete($query);
        if ($deldata) {
            $msg = "<span class='success'>Product deleted Successfully. </span>";
            return $msg;
        }else{
            $msg = "<span class='error'>Product not deleted. </span>";
            return $msg;
        }
    }

}//end of class

?>