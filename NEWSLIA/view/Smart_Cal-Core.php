<?php
class Calendar {
  // (A) CONSTRUCTOR - CONNECT TO DATABASE
  private $pdo = null;
  private $stmt = null;
  public $error = "";
  function __construct(){
    try {
      $this->pdo = new PDO(
        "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET, 
        DB_USER, DB_PASSWORD, [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
      );
    } 
    catch (Exception $ex) { die($ex->getMessage()); }
  }

  
  // (E) GET EVENTS FOR SELECTED MONTH
  function get ($month, $year) {
    // (E1) FIST & LAST DAY OF MONTH
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $dayFirst = "{$year}-{$month}-01";
    $dayLast = "{$year}-{$month}-{$daysInMonth}";

    // (E2) GET EVENTS
    $this->stmt = $this->pdo->prepare("SELECT * FROM `smart_calendar`
    WHERE `evt_start` BETWEEN ? AND ?
    OR `evt_end` BETWEEN ? AND ?");
    $this->stmt->execute([$dayFirst, $dayLast, $dayFirst, $dayLast]);
    
    // $events = [
    //  "e" => [ EVENT ID => [DATA], EVENT ID => [DATA], ... ],
    //  "d" => [ DAY => [EVENT IDS], DAY => [EVENT IDS], ... ]
    // ]

    $events = ["e" => [], "d" => []];
    while ($row = $this->stmt->fetch()) {
      $eStartMonth = substr($row['evt_start'], 5, 2);
      $eEndMonth = substr($row['evt_end'], 5, 2);
      $eStartDay = $eStartMonth==$month 
                 ? (int)substr($row['evt_start'], 8, 2) 
                 : 1 ;
      $eEndDay = $eEndMonth==$month 
               ? (int)substr($row['evt_end'], 8, 2) 
               : $daysInMonth ;
      for ($d=$eStartDay; $d<=$eEndDay; $d++) {
        if (!isset($events['d'][$d])) { $events['d'][$d] = []; }
        $events['d'][$d][] = $row['Post_Id'];
      }
      $events['e'][$row['evt_id']] = $row;
      $events['e'][$row['evt_id']]['first'] = $eStartDay;
    }
    return $events;
  }
}

// (F) DATABASE SETTINGS - CHANGE TO YOUR OWN!
define('DB_HOST', 'localhost');
define('DB_NAME', 'newslia');
define('DB_CHARSET', 'utf8');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

// (G) NEW CALENDAR OBJECT
$CAL = new Calendar();