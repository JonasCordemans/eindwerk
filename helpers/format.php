<?php

// Format Class om mysql injection tegen te gaan. alle speciale characters worden verwijderd

class Format{
    //voorkomen dat hele description getoont wordt
    public function textShorten($text, $limit = 400){
        $text = $text."";
        $text = substr($text, 0, $limit);
        $text = $text ."..";
        return $text;
    }

    public function validation($data){
        $data = trim($data); //Strip whitespace from beginning and end of a string
        $data = stripcslashes($data); //Returns a string with backslashes stripped off. Recognizes C-like \n, \r 
        $data = htmlspecialchars($data); //Convert special characters to HTML entities
        return $data;
    }

    //datum in "uw bestellingen"
    public function formatDate($date){
        return date('F j, Y, g: i a', strtotime($date));
    }

}


?>