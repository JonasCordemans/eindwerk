<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//als ik deze activeer dan werkt de adresdetails niet meer van mijn lopende bestelingen
        //require 'vendor/autoload.php'; 
// als ik deze activeer dan werkt mijne frontend niet meer
        //require '../vendor/autoload.php'; 

        $root = realpath($_SERVER["DOCUMENT_ROOT"]);

        include "$filepath/../vendor/autoload.php";

?>

<?php

class User{

    private $db;
    private $fm;

    public function __construct(){
       $this->db = new Database();
       $this->fm = new Format();   
    }
    //toewijzen van veld values aan variabelen
    public function customerRegistration($data){
        $name           =  mysqli_real_escape_string($this->db->link, $data['name'] );
        $address        =  mysqli_real_escape_string($this->db->link, $data['address'] );
        $city           =  mysqli_real_escape_string($this->db->link, $data['city'] );
        $country        =  mysqli_real_escape_string($this->db->link, $data['country'] );
        $zip            =  mysqli_real_escape_string($this->db->link, $data['zip'] );
        $phone          =  mysqli_real_escape_string($this->db->link, $data['phone'] );
        $email          =  mysqli_real_escape_string($this->db->link, $data['email'] );
        $pass           =  mysqli_real_escape_string($this->db->link, md5($data['pass'] ));
        //zijn alle velden ingevuld? indien niet -> message aan gebruiker
        if ($name == "" || $address == "" || $city == "" || $country == "" || $zip == "" || $phone == "" || $email == "" || $pass == "") {
            $msg = "<span class='error'>Alle velden moeten ingevuld worden.</span> ";
            return $msg;
        }
        //eerst controleren of dit email adres nog niet bestaat = customer reeds is geregistreerd
        $mailquery = "SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1 ";
        $mailchk = $this->db->select($mailquery);
        //als hij al bestaat:
        if ($mailchk != false) {
            $msg = "<span class='error'>Dit email adres is reeds in gebruik</span> ";
            return $msg;
        //als hij nog NIET bestaat
        }else{
            $query = "INSERT INTO tbl_customer(name, address, city, country, zip, phone, email, pass) 
            VALUES ('{$name}','{$address}','{$city}','{$country}','{$zip}','{$phone}','{$email}','{$pass}')";
            $inserted_row = $this->db->insert($query);
            if ($inserted_row) {
                $msg = "<span class='success'>Welkom bij de BoozeBaron familie!</span>";
                return $msg;
            }else {
                $msg = "<span class='error'>Registratie is mislukt :(</span>";
                return $msg;
                }
        }
    }

    public function customerLogin($data){
        $email      =  mysqli_real_escape_string($this->db->link, $data['email'] );
        $pass       =  mysqli_real_escape_string($this->db->link, md5($data['pass'] )); //b! als in mysql uw veld md5 is moet ge dit ook aangeven als md5
        if ($email == "" || $pass == "") {
            $msg = "<span class='error'>Alle velden moeten ingevuld worden.</span> ";
            return $msg;
        }

        $query = "SELECT * FROM tbl_customer WHERE email = '$email' AND pass = '$pass'";
        $result = $this->db->select($query);
        if ($result != false) {
            $value = $result->fetch_assoc();
            Session::set("cuslogin", true );
            Session::set("cmrId", $value['id'] );
            Session::set("cmrName",  $value['name']);
            header("Location:index.php");
        }else{
            $msg = "<span class='fail'>Uw paswoord of email is niet correct</span>";
            return $msg;
        }
    }

    public function getCustomerData($id){
        $query = "SELECT * FROM tbl_customer WHERE Id = '$id' ";
        $result = $this->db->select($query);
        return $result;
    }

    public function customerUpdate($data, $cmrId){
        $name           =  mysqli_real_escape_string($this->db->link, $data['name'] );
        $address        =  mysqli_real_escape_string($this->db->link, $data['address'] );
        $city           =  mysqli_real_escape_string($this->db->link, $data['city'] );
        $country        =  mysqli_real_escape_string($this->db->link, $data['country'] );
        $zip            =  mysqli_real_escape_string($this->db->link, $data['zip'] );
        $phone          =  mysqli_real_escape_string($this->db->link, $data['phone'] );
        $email          =  mysqli_real_escape_string($this->db->link, $data['email'] );
        //zijn alle velden ingevuld? indien niet -> message aan gebruiker
        if ($name == "" || $address == "" || $city == "" || $country == "" || $zip == "" || $phone == "" || $email == "" ) {
            $msg = "<span class='fail'>Alle velden moeten ingevuld worden.</span> ";
            return $msg;
        }else{
      $query = "UPDATE tbl_customer
        SET 
        name          = '$name',
        address       = '$address',
        city          = '$city',
        country       = '$country',
        zip           = '$zip',
        phone         = '$phone',
        email         = '$email'
        WHERE id      = '$cmrId'";
      $update_row = $this->db->update($query);
      if ($update_row) {
          $msg = "<span class='success'>Uw profiel is geupdated </span>";
          return $msg;
      }else{
          $msg = "<span class='fail'>Oeps. Er ging iets mis! </span>";
          return $msg;
            }
        }
    }
    
    public function swiftmailer($data){
        $gender         =  mysqli_real_escape_string($this->db->link, $data['gender'] );
        $familyname     =  mysqli_real_escape_string($this->db->link, $data['naam'] );
        $firstname      =  mysqli_real_escape_string($this->db->link, $data['voornaam'] );
        $email          =  mysqli_real_escape_string($this->db->link, $data['email'] );
        $textarea       =  mysqli_real_escape_string($this->db->link, $data['textarea'] );

        //Load Composer's autoloader
        // require 'vendor/autoload.php';
        $mail = new PHPMailer(true); // Passing `true` enables exceptions

        try {

        //Server settings
        $mail->SMTPDebug = 0;                         // Enable verbose debug output
        $mail->isSMTP();                              // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';               // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                       // Enable SMTP authentication
        $mail->Username = 'boozebaroninfo@gmail.com'; // SMTP username
        $mail->Password = 'boozebaron1-';             // SMTP password
        $mail->SMTPSecure = 'tls';                    // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                            // TCP port to connect to

        //Recipients
        $mail->setFrom($email, 'BoozeBaron');
        $mail->addAddress('boozebaroninfo@gmail.com', 'Recipient');     // Add a recipient

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Vraag van ' . $firstname . " " . $familyname;
        $mail->Body    = $textarea;
        $mail->AltBody = $textarea;

        $mail->send();
        // echo 'Message has been sent';
        } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;

        }
    }

    public function customerMail($data){
        $gender         =  mysqli_real_escape_string($this->db->link, $data['gender'] );
        $familyname     =  mysqli_real_escape_string($this->db->link, $data['naam'] );
        $firstname      =  mysqli_real_escape_string($this->db->link, $data['voornaam'] );
        $email          =  mysqli_real_escape_string($this->db->link, $data['email'] );
        $phone          =  mysqli_real_escape_string($this->db->link, $data['telefoon'] );
        $newsletter     =  mysqli_real_escape_string($this->db->link, $data['checkbox'] );
    

        //zijn alle velden ingevuld? indien niet -> message aan gebruiker
        if ($gender == "" || $familyname == "" || $firstname == "" || $email == "" || $phone == "") {
            $msg = "<span class='fail'>Alle velden moeten ingevuld worden.</span> ";
            return $msg;
        }elseif($newsletter == ''){
            // send mail
            $this->swiftmailer($data);
            // send message to user it's ok
            $msg = "<span class='success'>Bedankt voor je bericht, we contacteren je spoedig.</span> ";
            return $msg;
        }else{
            //1. toevoegen gegevens aan DB
            $query = "INSERT INTO tbl_newsletter(Gender, Familyname, Firstname, Email,  Phone) 
            VALUES ('{$gender}','{$familyname}','{$firstname}','{$email}','{$phone}')";
            $inserted_row = $this->db->insert($query);
            //2. send mail
            $this->swiftmailer($data);
            //3. send message to user it's ok
            $msg = "<span class='success'>Bedankt voor je bericht, we contacteren je spoedig. <br> Je mag onze eerste nieuwsbrief spoedig verwachten</span> ";
            return $msg;
        }
    }



} //end of class
 
?>