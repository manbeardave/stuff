<?php 

  $date=$_POST['date'];
  $corp_name=$_POST['corp_name'];
  $corp_state=$_POST['corp_state'];
  $address=$_POST['address'];
  $customer=$_POST['CUSTOMER'];
  $by=$_POST['BY'];
  $name=$_POST['NAME'];
  $title=$_POST['TITLE'];

                          $data = array();

                          $data["date"] = $date;
                          $data["corp_name"] = $corp_name;
                          $data["corp_state"] = $corp_state;
                          $data["address"] = $address;
                          $data["CUSTOMER"] = $customer;
                          $data["BY"] = $by;
                          $data["NAME"] = $name;
                          $data["TITLE"] = $title;

echo $data['BY'];

echo "sent fool";
?>

