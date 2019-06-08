<?php 

$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/session.php');
Session::checkLogin();

include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');


?>

<?php 

class Adminlogin {

    private $db;
    private $fm; //$format

    public function __construct(){
       $this->db = new Database();
       $this->fm = new Format();

    }
// hier krijgen we de parameters binnen van de login.php file. namelijk de values van de login velden.
    public function adminLogin($adminUser, $adminPass){
        //validation method heeft maar 1 parameter dus moeten we dit voor elke input doen
        $adminUser = $this->fm->validation($adminUser); 
        $adminPass = $this->fm->validation($adminPass);
        //we spreken onze database connection method aan
        $adminUser = mysqli_real_escape_string($this->db->link, $adminUser); //Escapes special characters in a string for use in an SQL statement, taking into account the current charset of the connection
        $adminPass = mysqli_real_escape_string($this->db->link, $adminPass); //Escapes special characters in a string for use in an SQL statement, taking into account the current charset of the connection
        //als 1 van de velden leeg is of allebei een message
        if(empty($adminUser) || empty($adminPass)) {
            $loginmsg = "Beide velden moeten ingevuld zijn";
            return $loginmsg;
        }else{
            $query = "SELECT * from tbl_admin WHERE adminUser='{$adminUser}' AND adminPass='{$adminPass}' ";
            //binnen het opbject selecteren we de method select
            $result = $this->db->select($query);
            if ($result != false) {
               $value = $result->fetch_assoc();
               Session::set("adminlogin", true);
               Session::set("adminId", $value['adminId']);
               Session::set("adminUser", $value['adminUser']);
               Session::set("adminName", $value['adminName']);
               header("Location: dashboard.php");
            }else{
                $loginmsg = "Uw gebruikersnaam of paswoord is incorrect";
                return $loginmsg;
            }
        }

    }
}


?>