<html>
<link rel="stylesheet" href="forms.css" type="text/css" media="screen">
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

				// $arrlength = count($data);

				// echo $arrlength;

				// echo $data["first_name"];
				// echo $data["last_name"];
				// echo $data["company"];
				// echo $data["date"];

$pdf_file_url = 'https://s3-us-west-1.amazonaws.com/pdfgeneration/Verve_Example_Contract.pdf';
include 'createXFDF.php';
$xfdf = createXFDF( $pdf_file_url, $data );



$result_directory = 'https://s3-us-west-1.amazonaws.com/pdfgeneration/xfdf_files';
$xfdf_file = $data['corp_name'] . '-' . $data['NAME'] . '.xfdf';
$xfdf_file_path = 'https://s3-us-west-1.amazonaws.com/pdfgeneration/xfdf_files' . '/' . $xfdf_file;

if( $fp = fopen( $xfdf_file_path, 'w' ) )
{
    fwrite( $fp, $xfdf, strlen( $xfdf ) );
};
fclose($fp);

$pdf_template_path = 'https://s3-us-west-1.amazonaws.com/pdfgeneration/Verve_Example_Contract.pdf';
$pdftk = '/usr/bin/pdftk';
$pdf_name = 'https://s3-us-west-1.amazonaws.com/pdfgeneration/pdf_files' . $data['corp_name'] . '-' . $data['NAME'] . '.pdf';
$command = "$pdftk $pdf_template_path fill_form '$xfdf_file_path' output '$pdf_name' flatten";

$pdf_url = 'https://glacial-journey-4511.herokuapp.com/pdf_files/' . $data['corp_name'] . '-' . $data ['NAME'] . '.pdf';

exec( $command, $output, $ret );

echo "<div class='bg_i'>
		<div class='left_confirm'>
		Please review the contract on the right.  If you are satisfied with the contract, click the continue button to submit the contract to Verve Mobile.  If you want to edit your fields, please click the back button to start the process over.<br>
		<div class='buttons'>
		<a class='button_1' href='fields.php'>back</a>
		<a class='button_1' href='send_email.php'>send contract</a>



</div></div>
<object data='$pdf_name' type='application/pdf' class='right_pdf' height='1000px'><p>It appears you don't have Adobe Reader on your machine - click<a href='$pdf_url'>here</a>to preview your PDF!</p></object>
</div>"



?>
</html>
