<?php

$array = array("firstname" => "","name" => "", "eadress" => "", "phone" => "", "message" => "", "firstnameError" => "", "nameError" => "", "eadressError" => "", "phoneError" => "", "messageError" => "", "isSuccess" => false);


$emailTo ="contact@ekherchi.fr";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  $array["firstname"] = verifyInput($_POST["firstname"]);
  $array["name"] = verifyInput($_POST["name"]);
  $array["eadress"] = verifyInput($_POST["email"]);
  $array["phone"] = verifyInput($_POST["phone"]);
  $array["message"] = verifyInput($_POST["message"]);
  $array["isSuccess"] = true;
  $emailText="";

  if(empty($array["firstname"])){
    $array["firstnameError"]="Veuillez renseigner votre prénom.";
    $array["isSuccess"] = false;
  }
  else{
    $emailText .= "Firstname: {$array["firstname"]}\n";
  }

  if(empty($array["name"])){
    $array["nameError"]="Veuillez renseigner votre nom.";
    $array["isSuccess"] = false;
  }
  else{
    $emailText .= "Name: {$array["name"]}\n";
  }

  if(!isEmail($array["eadress"])){
   $array["eadressError"]="Veuillez renseigner une adresse e-mail valide.";
   $array["isSuccess"] = false;
  }
  else{
    $emailText .= "Email: {$array["eadress"]}\n";
  }

  if(!isPhone($array["phone"])){
    $array["phoneError"]="Uniquement des chiffres et des espaces pour votre numéro de téléphone";
    $array["isSuccess"] = false;
  }
  else{
    $emailText .= "Téléphone: {$array["phone"]}\n";
  }

  if(empty($array["message"])){
    $array["messageError"]="Veuillez préciser quel est votre message";
    $array["isSuccess"] = false;
  }
  else{
    $emailText .= "Message: {$array["message"]}\n";
  }  

  if($array["isSuccess"]){
    $headers= "From: {$array["firstname"]} {$array["name"]} <{$array["eadress"]}>\r\nReply-to: {$array["eadress"]}";
    mail($emailTo, "Un message du site ekherchi.fr", $emailText, $headers);
  }
  
  echo json_encode($array);

}

function isPhone($var){
  return preg_match("/^[0-9 ]*$/", $var);
}

function isEmail($var){

  return filter_var($var, FILTER_VALIDATE_EMAIL);

}

function verifyInput($var){
  $var = trim($var);
  $var = stripcslashes($var);
  $var = htmlspecialchars($var);

  return $var;
}

?>