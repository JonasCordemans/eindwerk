<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>

<?php

// Category class 
class Brand{

    private $db;
    private $fm; //$format

    public function __construct(){
       $this->db = new Database();
       $this->fm = new Format();   
}

public function brandInsert($brandName){
    $brandName = $this->fm->validation($brandName); 
    $brandName = mysqli_real_escape_string($this->db->link, $brandName);
    if(empty($brandName)) {
        $msg = "Brand name cannot be empty";
        return $msg;
    }else{
        $query = "INSERT INTO tbl_brand(brandName) VALUES ('{$brandName}')";
        $brandinsert = $this->db->insert($query);
        if ($brandinsert) {
            //de class wordt gedefineerd in layout.css
            $msg = "<span class='success'>Brand Inserted. </span>";
            return $msg;
        }else {
            $msg = "<span class='error'>Brand insert failed. </span>";
        }
    }
}

public function getAllBrand(){

        $query = "SELECT * FROM tbl_brand ORDER BY brandId DESC";
        $result = $this->db->select($query);
        return $result;
}

public function getUpdateById($id){
    $query = "SELECT * FROM tbl_brand WHERE brandId = '{$id}'";
        $result = $this->db->select($query);
        return $result;
    }
    
public function brandUpdate($brandName, $id){
    $brandName = $this->fm->validation($brandName); 
    $brandName = mysqli_real_escape_string($this->db->link, $brandName);
    $id = mysqli_real_escape_string($this->db->link, $id);
    if(empty($brandName)) { // als het update veld leeg is krijg je een error
        $msg = "<span class='error'>Category Field must not be empty. </span>";
        return $msg;
        }else{
            $query = "UPDATE tbl_brand
            SET brandName = '{$brandName}'
            WHERE brandId = '{$id}'";
            $update_row = $this->db->update($query);
            if ($update_row) {
                $msg = "<span class='success'>Brand Updated Successfully. </span>";
                return $msg;
            }else{
                $msg = "<span class='error'>Brand not updated. </span>";
                return $msg;
            }
        }
    }

public function delBrandById($id){
    $query = "DELETE FROM tbl_brand WHERE brandId = '{$id}'";
    $delbranddata = $this->db->delete($query);
    if ($delbranddata) {
        $msg = "<span class='success'>Brand deleted Successfully. </span>";
        return $msg;
    }else{
        $msg = "<span class='error'>Brand not deleted. </span>";
        return $msg;
    }
}

public function delSlideById($id){
    $query = "DELETE FROM tbl_image WHERE id = '{$id}'";
    $delSlide = $this->db->delete($query);
    if ($delSlide) {
        $msg = "<span class='success'>Deze slide is verwijderd. </span>";
        return $msg;
    }else{
        $msg = "<span class='error'>Oeps, deze slide kon niet verwijderd worden. </span>";
        return $msg;
    }
}


public function getCopyById(){
    $query = "SELECT * FROM tbl_copy";
    $result = $this->db->select($query);
    return $result;
}

public function footerUpdate($copyright){
    $copyright = $this->fm->validation($copyright); 
    $copyright = mysqli_real_escape_string($this->db->link, $copyright);
    if(empty($copyright)) { // als het update veld leeg is krijg je een error
        $msg = "<span class='error'>Dit veld mag niet leeg zijn. </span>";
        return $msg;
        }else{
            $query = "UPDATE tbl_copy
            SET copyright = '{$copyright}'
            WHERE id = '1'";
            $update_row = $this->db->update($query);
            if ($update_row) {
                $msg = "<span class='success'>Copyright updated.</span>";
                return $msg;
            }else{
                $msg = "<span class='error'>Copyright kon niet ge-updated worden. </span>";
                return $msg;
            }
        }
}

public function getSocialById(){
    $query = "SELECT * FROM tbl_social";
    $result = $this->db->select($query);
    return $result;
}

public function socialUpdate($fb, $tw, $gp){
    $fb = $this->fm->validation($fb); 
    $tw = $this->fm->validation($tw); 
    $gp = $this->fm->validation($gp); 

    $fb = mysqli_real_escape_string($this->db->link, $fb);
    $tw = mysqli_real_escape_string($this->db->link, $tw);
    $gp = mysqli_real_escape_string($this->db->link, $gp);
    if(empty($fb)) { // als het update veld leeg is krijg je een error
        $msg = "<span class='error'>Alle velden moeten ingevuld zijn </span>";
        return $msg;
        }else{
            $query = "UPDATE tbl_social
            SET 
            fb = '{$fb}',
            tw = '{$tw}',
            gp = '{$gp}'
            WHERE id = '1'";
            $update_row = $this->db->update($query);
            if ($update_row) {
                $msg = "<span class='success'>Social media links zijn ge-updated.</span>";
                return $msg;
            }else{
                $msg = "<span class='error'>Oeps, er is iets mis gegaan. </span>";
                return $msg;
            }
        }
}

public function getAllImages(){
    $query = "SELECT * FROM tbl_image";
    $result = $this->db->select($query);
    return $result;
}

public function sliderInsert($data, $file){
    $title    = mysqli_real_escape_string($this->db->link, $data['title']);

    $permited = array('jpg','png','jpeg','gif');
    $file_name = $file['image']['name'];
    $file_size = $file['image']['size'];
    $file_temp = $file['image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "upload/".$unique_image;
    if ($title == "") {
        $msg = "<span class='success'>Dit veld mag niet leeg zijn. </span>";
        return $msg;
    }else{
        move_uploaded_file($file_temp, $uploaded_image);
        $query = "INSERT INTO tbl_image(title, image) 
        VALUES ('{$title}','{$uploaded_image}')";
        $inserted_row = $this->db->insert($query);
        if ($inserted_row) {
            //de class wordt gedefineerd in layout.css
            $msg = "<span class='success'>Foto aan slider toegevoegd. </span>";
            return $msg;
        }else {
            $msg = "<span class='error'>Oeps, er is iet misgegaan. </span>";
            return $msg;
            }
        }
    }

    // dynamische update van de quote in de header
    // oproepen van de quote uit de tabel
    public function getQuoteById(){
        $query = "SELECT * FROM tbl_quote";
        $result = $this->db->select($query);
        return $result;
    }
    
    public function quoteUpdate($quote, $quoteBy){
        $quote      = $this->fm->validation($quote); 
        $quoteBy    = $this->fm->validation($quoteBy); 
        $quote      = mysqli_real_escape_string($this->db->link, $quote);
        $quoteBy    = mysqli_real_escape_string($this->db->link, $quoteBy);
        if(empty($quote)) { // als het update veld leeg is krijg je een error
            $msg = "<span class='error'>Dit veld mag niet leeg zijn. </span>";
            return $msg;
            }else{
                $query = "UPDATE tbl_quote
                SET 
                quote   = '{$quote}',
                quoteby = '{$quoteBy}'
                WHERE id = '1'";
                $update_row = $this->db->update($query);
                if ($update_row) {
                    $msg = "<span class='success'>Quote is updated.</span>";
                    return $msg;
                }else{
                    $msg = "<span class='error'>Oeps, quote kon niet ge-updated worden. </span>";
                    return $msg;
                }
            }
    }
    // end

    // dynamische update van de company details
    // oproepen van de company details uit de database
    public function getcompanyInfo(){
        $query = "SELECT * FROM tbl_companyinfo";
        $result = $this->db->select($query);
        return $result;
    }
    
    public function CompanyUpdate($cname, $caddress, $czip, $ccity, $ccountry, $cemail, $cphone, $cfax, $vat){
        $cname          = $this->fm->validation($cname); 
        $caddress       = $this->fm->validation($caddress); 
        $czip           = $this->fm->validation($czip); 
        $ccity          = $this->fm->validation($ccity); 
        $ccountry       = $this->fm->validation($ccountry); 
        $cemail         = $this->fm->validation($cemail); 
        $cphone         = $this->fm->validation($cphone); 
        $cfax           = $this->fm->validation($cfax); 
        $vat            = $this->fm->validation($vat); 

        $cname          = mysqli_real_escape_string($this->db->link, $cname);
        $caddress       = mysqli_real_escape_string($this->db->link, $caddress);
        $czip           = mysqli_real_escape_string($this->db->link, $czip);
        $ccity          = mysqli_real_escape_string($this->db->link, $ccity);
        $ccountry       = mysqli_real_escape_string($this->db->link, $ccountry);
        $cemail         = mysqli_real_escape_string($this->db->link, $cemail);
        $cphone         = mysqli_real_escape_string($this->db->link, $cphone);
        $cfax           = mysqli_real_escape_string($this->db->link, $cfax);
        $vat            = mysqli_real_escape_string($this->db->link, $vat);

        if(empty($cname)) { // als het update veld leeg is krijg je een error
            $msg = "<span class='error'>Alle velden moeten ingevuld zijn. </span>";
            return $msg;
            }else{
                $query = "UPDATE tbl_companyinfo
                SET 
                name        = '{$cname}',
                address     = '{$caddress}',
                zip         = '{$czip}',
                city        = '{$ccity}',
                country     = '{$ccountry}',
                email       = '{$cemail}',
                phone       = '{$cphone}',
                fax         = '{$cfax}',
                vat         = '{$vat}'
                WHERE id = '1'";
                $update_row = $this->db->update($query);
                if ($update_row) {
                    $msg = "<span class='success'>Company info is updated.</span>";
                    return $msg;
                }else{
                    $msg = "<span class='error'>Oeps, quote kon niet ge-updated worden. </span>";
                    return $msg;
                }
            }
    }

        public function questionAdd($question, $answer){

        $question     = $this->fm->validation($question); 
        $answer       = $this->fm->validation($answer); 

        $question   =  mysqli_real_escape_string($this->db->link, $question);
        $answer     =  mysqli_real_escape_string($this->db->link, $answer);
        //zijn alle velden ingevuld? indien niet -> message aan gebruiker
        if ($question == "" || $answer == "") {
            $msg = "<span class='error'>Alle velden moeten ingevuld worden.</span> ";
            return $msg;
        }else{
            //1. toevoegen gegevens aan DB
            $query = "INSERT INTO tbl_faq(question, answer) 
            VALUES ('{$question}','{$answer}')";
            $inserted_row = $this->db->insert($query);
            $msg = "<span class='success'>De vraag is toegevoegd</span> ";
            return $msg;
        }
    }

    public function getAllFaq(){

        $query = "SELECT * FROM tbl_faq ORDER BY faqid ASC";
        $result = $this->db->select($query);
        return $result;
}

    public function delFaqById($id){
        $query = "DELETE FROM tbl_faq WHERE faqid = '{$id}'";
        $delfaqdata = $this->db->delete($query);
        if ($delfaqdata) {
            $msg = "<span class='success'>Deze FAQ is verwijderd. </span>";
            return $msg;
        }else{
            $msg = "<span class='error'>Oeps, deze FAQ kon niet verwijderd worden. Gelieve contact op te nemen met je administrator.</span>";
            return $msg;
        }
    }

    public function getFaqUpdateById($id){
        $query = "SELECT * FROM tbl_faq WHERE faqid = '{$id}'";
            $result = $this->db->select($query);
            return $result;
        }

    public function faqUpdate($question, $answer, $id){
        $question   = $this->fm->validation($question); 
        $answer     = $this->fm->validation($answer); 

        $question   = mysqli_real_escape_string($this->db->link, $question);
        $answer     = mysqli_real_escape_string($this->db->link, $answer);

        if(empty($question) || empty($answer )) { // als de update velden leeg zijn  krijg je een error
            $msg = "<span class='error'>Beide velden moeten ingevuld zijn. </span>";
            return $msg;
            }else{
                $query = "UPDATE tbl_faq
                SET 
                question = '{$question}', 
                answer = '{$answer}'
                WHERE faqid = '{$id}'";
                $update_row = $this->db->update($query);
                if ($update_row) {
                    $msg = "<span class='success'>De vraag is aangepast. </span>";
                    return $msg;
                }else{
                    $msg = "<span class='error'>Oeps, de vraag kon niet aangepast worden. Gelieve contact op te nemen met je site adminstrator. </span>";
                    return $msg;
                }
            }
        }

        

    // end

}
?>