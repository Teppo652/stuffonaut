<?Php
/* source https://www.plus2net.com/php_tutorial/pdf-cell.php
file:///C:/code/PHP%20print%20PDF/FAQ.htm#q1
*/
require('pdf/fpdf.php');
define('EURO', chr(128));
/* ============================== receipt texts ==================================== */
// translations EN
// top
/*
$title = "RECEIPT";
$from = "From";
$to = "To";
// middle
$receiptNumber_text = "Receipt number";
$receiptDate_text = "Date";
$receiptTerms_text = "Terms";
$receiptDue_text = "Due";
// bottom (table)
$description_text = "Description";
$price_text = "Price";
$qty_text = "Qty";
$amount_text = "Amount";
$tax_text = "Tax";
//  narrow table 
$subtotal_text = "Subtotal";
$tax2_text = "Tax (0%)";
$total_text = "Total";
$balanceDue_text = "Balance Due";
*/

// FI
//$receipt = "KUITTI#Saaja#Maksaja#Kuitin numero#Päivämäärä#Terms#Due#Tuote#Hinta#à-hinta#Määrä#Yhteensä#Yhteensä#Alv (0%)#Total#YHTEENSÄ";

// EN
$receipt = "RECEIPT#From#To#Receipt number#Date#Terms#Due#Description#Price#Qty#Amount#Tax#Subtotal#Tax (0%)#Total#Balance Due";
$arr = explode('#', $receipt);
$c=0;

$title = $arr[$c]; $c++;
$from = $arr[$c]; $c++;
$to = $arr[$c]; $c++;
// middle
$receiptNumber_text = $arr[$c]; $c++;
$receiptDate_text = $arr[$c]; $c++;
$receiptTerms_text = $arr[$c]; $c++;
$receiptDue_text = $arr[$c]; $c++;
// bottom (table)
$description_text = $arr[$c]; $c++;
$price_text = $arr[$c]; $c++;
$qty_text = $arr[$c]; $c++;
$amount_text = $arr[$c]; $c++;
$tax_text = $arr[$c]; $c++;
//  narrow table 
$subtotal_text = $arr[$c]; $c++;
$tax2_text = $arr[$c]; $c++;
$total_text = $arr[$c]; $c++;
$balanceDue_text = $arr[$c]; $c++;

// ----------------- receipt values ----------------
// middle
$receiptNumber_val = "123456";
$receiptDate_val = "123456";
$receiptTerms_val = " ";
$receiptDue_val = "XXXXX";
// bottom (table)
$description_val = "Single ad at www.stuffonaut.com";
$price_val = "0.00";
$qty_val = "1";
$amount_val = "0.00 ".EURO; // "SEK 0.00"
$tax_val = "0";
$additionalDetails_text = "Additional details"; 
//  narrow table 
$subtotal_val = "0.00 ".EURO; // "SEK 0.00"
$tax2_val = "0";
$total_val = "0.00 ".EURO; // "SEK 0.00"
$balanceDue_val = "0.00 ".EURO; // "SEK 0.00"



// our company
 $textLogo = ""; // not in use
 $logo = 'img/logos/logoReceipt.png';
 $ourCompany = "Angry Group, Ltd."; 
 $ourEmail = "info@angrygroup.com";
 $ourAddr = "Rooms 1318-20; Hollywood Plaza";
 $ourAddr2 = "610 Nathan Road;Mongkok; Kowloon";
 $ourAddr3 = "Hong Kong";
 $ourPhone = "";
 //  Rooms 1318-20; Hollywood Plaza; 610 Nathan Road; Mongkok; Kowloon; Hong Kong.

 // customer
 $userCompany = "Company B";
 $userEmail = "Email";
 $userAddr = "Addr";
 $userAddr2 = "Addr2";
 $userAddr3 = "Addr3";
 $userPhone = "phone";



/* ==================== create receipt ====================== */
//$str = iconv('UTF-8', 'windows-1252', $str);

$pdf = new FPDF(); 
$pdf->AddPage();

$pdf->SetFont('Arial','B',16);
$pdf->Cell(80,6," "); // space
$pdf->Cell(60,6,$title,0,0,'L'); // title
//$pdf->Cell(50,10,$textLogo,0,1,'C'); // textLogo
$pdf->Image($logo,157,7,45,10,'png'); // logo  264x54
$pdf->MultiCell(190,20,"\n");

// from to 
$pdf->SetFont('Arial','',11);
$pdf->Cell(80,10,$from);
$pdf->Cell(80,10,$to);
$pdf->MultiCell(80,10,"\n");

// company name   company name
$pdf->SetFont('Arial','B',13);
$pdf->Cell(80,6,$ourCompany);
$pdf->Cell(80,6,$userCompany);
$pdf->MultiCell(80,6,"\n");

// emails
$pdf->SetFont('Arial','',11);
$pdf->Cell(80,6,$ourEmail);
$pdf->Cell(80,6,$userEmail);
$pdf->MultiCell(80,6,"\n");

// addr
$pdf->Cell(80,6,$ourAddr);
$pdf->Cell(80,6,$userAddr);
$pdf->MultiCell(80,6,"\n");

// addr 2
$pdf->Cell(80,6,$ourAddr2);
$pdf->Cell(80,6,$userAddr2);
$pdf->MultiCell(80,6,"\n");

// addr 3
$pdf->Cell(80,6,$ourAddr3);
$pdf->Cell(80,6,$userAddr3);
$pdf->MultiCell(80,6,"\n");

// phone
$pdf->Cell(80,8,$ourPhone);
$pdf->Cell(80,8,$userPhone);
$pdf->MultiCell(80,8,"\n");







// space
$pdf->MultiCell(190,16,"\n");


// horizontal line
$pdf->SetFillColor(171,171,171);
 $pdf->Cell(192,0.3," ",0,1,'C',TRUE);

// space
$pdf->MultiCell(190,2,"\n");



// receipt number
$pdf->Cell(30,6,$receiptNumber_text);
$pdf->Cell(30,6,$receiptNumber_val);
$pdf->MultiCell(80,6,"\n");

// receipt date
$pdf->Cell(30,6,$receiptDate_text);
$pdf->Cell(30,6,$receiptDate_val);
$pdf->MultiCell(80,6,"\n");

// receipt terms
$pdf->Cell(30,6,$receiptTerms_text);
$pdf->Cell(30,6,$receiptTerms_val);
$pdf->MultiCell(80,6,"\n");

// receipt due
$pdf->Cell(30,6,$receiptDue_text);
$pdf->Cell(30,6,$receiptDue_val);
$pdf->MultiCell(80,6,"\n");





// space
$pdf->MultiCell(190,10,"\n");

// box
$pdf->MultiCell(190,10,"\n"); // space
$pdf->SetFont('Arial','B',12);
$pdf->SetFillColor(171,171,171); //100,255,255
$pdf->SetDrawColor(255,255,255);
// $pdf->SetDrawColor(255,1,1);// input R , G , B 
//$pdf->Cell(190,10,"Hello World!",1,1,'C',TRUE);

 $pdf->Cell(2,10," ",0,0,'L',TRUE);
$pdf->Cell(120,10,$description_text,0,0,'L',TRUE);
 $pdf->Cell(15,10,$price_text,0,0,'L',TRUE);
 $pdf->Cell(25,10,$qty_text ,0,0,'L',TRUE);
 $pdf->Cell(20,10,$amount_text,0,0,'L',TRUE);
  $pdf->Cell(10,10,$tax_text,0,0,'L',TRUE);
  $pdf->Cell(2,10," ",0,0,'L',TRUE);
$pdf->MultiCell(80,10,"\n");
/*
$pdf->SetFont('Arial','B',12);
// header line
$pdf->Cell(120,6,"Description");
 $pdf->Cell(15,6,"Price");
 $pdf->Cell(25,6,"Qty");
 $pdf->Cell(20,6,"Amount");
  $pdf->Cell(5,6,"Tax");
$pdf->MultiCell(80,6,"\n");
*/

// value lines
$pdf->SetFont('Arial','',11);
$pdf->Cell(2,8," "); // empty
$pdf->Cell(120,8,$description_val);
 $pdf->Cell(15,8,$price_val);
 $pdf->Cell(25,8,$qty_val);
 $pdf->Cell(20,8,$amount_val); // $pdf->Cell(20,5,"SEK 0.00");
  $pdf->Cell(5,8,$tax_val);
$pdf->MultiCell(80,8,"\n");

// additional details
$pdf->Cell(2,10," "); // empty
$pdf->Cell(200,6,$additionalDetails_text);
$pdf->MultiCell(80,6,"\n");

// space
$pdf->MultiCell(190,20,"\n");


// ---------- narrow table ---------------
// Subtotal
$pdf->Cell(125,6," ");
 $pdf->Cell(35,6,$subtotal_text);
 $pdf->Cell(40,6,$subtotal_val); // $pdf->Cell(40,6,"SEK 0.00");
$pdf->MultiCell(80,6,"\n");

// Tax
$pdf->Cell(125,6," ");
 $pdf->Cell(35,6,$tax2_text);
 $pdf->Cell(40,6,$tax2_val); // $pdf->Cell(40,6,"SEK 0.00");
$pdf->MultiCell(80,6,"\n");

// Total 
$pdf->Cell(125,6," ");
 $pdf->Cell(35,6,$total_text);
 $pdf->Cell(40,6,$total_val); // $pdf->Cell(40,6,"SEK 0.00");
$pdf->MultiCell(80,6,"\n");

// Balance Due
$pdf->SetFont('Arial','B',13);
$pdf->Cell(115,6," ");
 $pdf->Cell(45,6,$balanceDue_text);
 $pdf->Cell(45,6,$balanceDue_val ); // $pdf->Cell(40,6,"SEK 0.00");
$pdf->MultiCell(80,6,"\n");

/*
// TEST
$pdf->MultiCell(190,20,"\n"); // space
$pdf->SetFont('Arial','B',16);
$pdf->SetFillColor(100,255,255);
// $pdf->SetDrawColor(255,1,1);// input R , G , B 
$pdf->Cell(190,10,'Hello World!',1,1,'C',TRUE);
*/

/*
$pdf->SetFont('Arial','',12);
$pdf->Cell(80,10,"Left");
$pdf->Cell(80,10,"Right");

$pdf->MultiCell(55,20,"Row 21\nRow 22");
$pdf->MultiCell(55,20,"Row 31\nRow 32");
$pdf->MultiCell(80,20,"Row 41\nRow 42");
*/

//$pdf->Cell(80,10,'Hello World!',1,0,'C',true,'https://www.plus2net.com');
$pdf->Output('receipt_stuffonaut.pdf','I'); // Send to browser and display

?>