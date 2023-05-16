<?php

require_once('FPDF/fpdf.php');
require_once('EmailValidation.php');
class ConfigurePDF extends EmailValidation {
  public function __construct() {
    parent::__construct();
    $this->returnValidatedData();
  }
  public function returnValidatedData()
  {
    if (($this->validateNames() == TRUE) && ($this->validateImage() == TRUE) && ($this->validateTextArea() == TRUE) && ($this->validatePhone() == TRUE) && ($this->validateEmail() == TRUE)) {
      $pdfVal = new PDFValidation;
      $pdfVal->callPDF();
    }
  }
}
class PDFValidation extends Fpdf {
  private $fname;
  private $lname;
  private $imageName;
  private $marks;
  private $phone;
  private $email;
  public function __construct()
  {
    parent::__construct();
    $this->fname = $_POST['fname'];
    $this->lname = $_POST['lname'];
    $this->imageName = $_FILES['image']['name'];
    $this->marks = $_POST['marks'];
    $this->phone = $_POST['phone'];
    $this->email = $_POST['email'];
  }
  public function dispImage() {
    $target_dir = "../../imguploads/";
    $target_file = $target_dir . basename($this->imageName);
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
      return $target_file;
    }
  }

  public function callPDF() {
    require_once('FPDF/fpdf.php');
    $fpdf = new Fpdf();
    $fpdf->AddPage();
    $fpdf->SetFont('Arial', 'B', 15);
    $fpdf->Cell(80, 15, "First Name", 1, 0, 'C');
    $fpdf->Cell(80, 15, $this->fname, 1, 1, 'C');
    $fpdf->Cell(80, 15, "Last Name", 1, 0, 'C');
    $fpdf->Cell(80, 15, $this->lname, 1, 1, 'C');
    $fpdf->Cell(80, 15, "Phone Number", 1, 0, 'C');
    $fpdf->Cell(80, 15, $this->phone, 1, 1, 'C');
    $fpdf->Cell(80, 15, "E-Mail ID", 1, 0, 'C');
    $fpdf->Cell(80, 15, $this->email, 1, 1, 'C');
    $fpdf->Ln();
    $fpdf->Cell(160, 15, "Subject | Marks", 1, 0, 'C');
    $fpdf->Ln();
    $fpdf->Cell(160, 15, $this->marks, 1, 1, 'C');
    $fpdf->Ln();
    $fpdf->Image($this->dispImage(), 20, 120, 100, 100);
    $fpdf->Output('D');
  }
}

if (isset($_POST['submit'])) {
  $pdflVal = new ConfigurePDF();
}

?>
