<?php

require_once('ImageUpload.php');

class MarksValidation extends ImageUpload
{
  private $marks;
  private $error = [];
  public function __construct()
  {
    parent::__construct();
    $this->marks = $_POST['marks'];
    $this->validateTextArea();
  }

  public function validateTextArea()
  {
    if (empty($this->marks)) {
      $this->error['marks'] = "Subject|Marks Field Cannot Be Empty";
    } else {
      $lines = preg_split('/\r\n|\r|\n/', $this->marks);
      $data = [];
      foreach ($lines as $line) {
        if (!preg_match('/^[a-zA-Z]+\|[0-9]+(\.[0-9]+)?$/', $line)) {
          $this->error['marks'] = "Invalid Input Format: $line";
        }
        $parts = explode("|", $line);
        $subject = trim($parts[0]);
        $marks = trim($parts[1]);
        if (empty($subject) || empty($marks)) {
          $this->error['marks'] = "Subject And Marks Cannot Be Empty";
        }
        if ($marks < 0 || $marks > 100) {
          $this->error['marks'] = "Marks Should Be Between 0 And 100";
        }
        if (is_numeric($subject) || !is_numeric($marks)) {
          $this->error['marks'] = "Invalid Input Format. Please Enter Subject Before Marks";
        }
        $data[] = array('subject' => $subject, 'marks' => $marks);
      }
    }
    if (!empty($this->error)) {
      $query_params = http_build_query(['markserror' => $this->error]);
      header("Location: ../a4.php?" . $query_params);
      exit();
    } else {
?>
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <table class="table text-center">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Subjects</th>
                  <th scope="col">Marks</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($data as $row) {
                ?>
                  <tr>
                    <td>
                      <?php
                      echo htmlspecialchars($row['subject']);
                      ?>
                    </td>
                    <td>
                      <?php
                      echo htmlspecialchars($row['marks']);
                      ?>
                    </td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
<?php
    }
  }
}

?>
