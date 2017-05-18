<?
require_once __DIR__.'/../fpdf/fpdf.php';
require_once __DIR__.'/core/init.php';

class Form extends FPDF {

	function __construct()
	{
	  parent::__construct();
	  //Fix for euro sign
	  define('EURO',chr(128));

	}

	//Setup page, print logo
	function Header()
	{
		$this->SetMargins(26, 26);
		$this->setAutoPageBreak(true, 26);
		$this->SetTopMargin(26);
		$this->Image('logo.png',($this->w- 76),15,50);
	}

	//Print folding marks 
	function printMarks()
	{
		$this->SetLineWidth(0.1);
		$this->SetDrawColor(0, 0, 0);

		$this->Line(0 , 105 , 5, 105);
		$this->Line(0 , 210 , 5, 210);

		//print middle mark
		$this->Line(0 , $this->h / 2 , 3, $this->h / 2);
	}

	//Print header in a way to put it in an A4 letter envelope
	//reference: https://diedesigner.net/wp-content/uploads/2010/06/din_676_b1.gif
	function printCompanyAdress()
	{
		$this->SetY(50);
		$this->SetFont('Arial','U',8);
		$this->Cell(85, 0, "Maps4Print GmbH | Geschwister-Scholl-Str. 25 | 76726 Germersheim", 0 , 0, 'L');
	}

	//Print footer with legal text 
	function Footer()
	{
		$colWidth = ($this->w - (2*26)) / 3;
		$offsetBottom = -26;
		$this->SetFont('Arial','',8);
		$this->SetY($offsetBottom);

		$this->MultiCell(100, 3,
			utf8_decode("Maps4Print UG (haftungsbeschränkt)\nGeschwister-Scholl-Str. 25\n76726 Germersheim \nDeutschland"), 0, 'L');

		$this->SetXY($this->GetX() + $colWidth, $offsetBottom);
		$this->MultiCell($colWidth, 3,
			utf8_decode("Bankverbindung: Cortal Consors\nBNP Paribas S.A.\nBIC: 0123456789\nIBAN: DE78 1234 5678 9123"));

		$this->SetXY($this->GetX() + 2 * $colWidth, $offsetBottom);
		$this->MultiCell($colWidth, 3,
			utf8_decode("Geschäftsinhaber: Felix Schütt\nSitz: D-76726 Germersheim\nHandelsreg.nr.: HRB 198437\nZust. Amtsgericht: D-32983 Hildesheim\nWEEE-Reg.Nr. DE 198472143"));
		}
}


class Invoice extends Form
{
	function __construct()
	{
		//Prints header and footer
		parent::__construct();
	}

	function printCustomerAdress(){
		$this->SetFont('Arial','',10);
		$this->SetY(60);
		$this->MultiCell(80, 5, "Herr\nMax Mustermann\nMusterstrasse 1\n12345 Musterstadt");
	}

	function printInvoiceHeader(){
		$this->SetFont('Arial','',8);
		$this->SetXY(-76,60);
		$this->MultiCell(80, 3, utf8_decode("Rechnungsdatum:\nLieferungsdatum:\n\nTelefon:\nFax:\nE-Mail:\n\nIhre Kundennnummer:"));
		$this->SetXY(-106,60);
		$this->MultiCell(80, 3, utf8_decode("01.01.2018\n01.01.2018\n\n+49 067276/29839\n+49 067276/29839\nsupport@maps4print.com\n\nKD-103984"), 0, 'R');
	}

	function printInvoiceGreeting(){
		$this->SetFont('Arial', 'B', 12);
		$this->SetXY(26, 90);
		$this->Write(12, utf8_decode("Ihre Rechnung Nr. 12345 für Ihre Bestellung B2234"));

		$this->SetFont('Arial', '', 10);
		$this->SetY($this->GetY() + 20);
		$this->MultiCell(0, 5, utf8_decode("Guten Tag [ANREDE] [VORNAME] [NACHNAME],\n\nvielen Dank für Ihre Bestellung. Diese Rechnung ist für Ihre Unterlagen bestimmt. Bitte drucken Sie sich diese Rechnung aus und heben Sie sie gut auf, sollten Sie Fragen zu unserem Service haben."));	
	}

	function printShoppingCartTable($id){
		$data = Map::getAllMapsFromShoppingCart($id);
		
		$this->SetY($this->GetY() + 10);
		$this->SetFont('Arial', 'B', 10);
		$this->SetFillColor(224, 224, 224);

		//table header
		$this->Cell(25,8, utf8_decode("Art.-Nr."), 0, 0, 'L', 1);
		$this->Cell(115,8, utf8_decode("Beschreibung"), 0, 0, 'L', 1);
		$this->Cell(0,8, utf8_decode("Netto / ").EURO, 0, 1, 'L', 1);

		//table body
		$this->SetFont('Arial', '', 10);
		if(isset($data)){
			foreach ($data as $row => $product) {
				//one map row
				$this->Cell(20,8, $product->name);
			}
		}
	}

}

$invoice=new Invoice();
$invoice->AliasNbPages();
$invoice->AddPage();

$invoice->printMarks();
$invoice->printCompanyAdress();
$invoice->printCustomerAdress();
$invoice->printInvoiceHeader();
$invoice->printInvoiceGreeting();
$invoice->printShoppingCartTable(2);


$title = "Rechnung_12345";
$invoice->SetTitle($title);
$invoice->Output('I', $title); 
