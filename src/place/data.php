<?php
include('../../auth.php');

$utc = new DateTimeZone('UTC');
$mysqli = new mysqli($db_host, $db_username, $db_passwd, $db_dbname, $db_port);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents("php://input"));

  if (!$data) {
    exit;
  }

  $data = (array) $data;

  if (isset($data['x']) && isset($data['y']) && isset($data['red']) && isset($data['green']) && isset($data['blue'])) {
    if ($mysqli->connect_errno) {
      printf("Connect failed: %s\n", $mysqli->connect_error);
      exit;
    }

    $now = (new DateTime('now', $utc))->format('Y-m-d H:i:s');

    $stmt = $mysqli->prepare('UPDATE `jsmick_rplace` SET `red`=?, `green`=?, `blue`=?, `date`=? WHERE `x`=? AND `y`=?');
    $stmt->bind_param('iiisii', $data['red'], $data['green'], $data['blue'], $now, $data['x'], $data['y']);
    $stmt->execute();
    $mysqli->close();

    print_r(true);
  }

  exit;
}

header('Content-Type: application/json; charset=utf-8');

$query = "SELECT `x`, `y`, `red`, `green`, `blue`, `date` FROM `jsmick_rplace`";

if ($mysqli->connect_errno) {
  printf("Connect failed: %s\n", $mysqli->connect_error);
  exit;
}

$data = array();
$data['max_x'] = 0;
$data['max_y'] = 0;
$data['latest'] = 0;
// $data['max_x'] = 7;
// $data['max_y'] = 7;
$data['data'] = array();

if (isset($_GET['latest'])) {
  $date = new DateTime('now', $utc);
  $ts = (int) $_GET['latest'];
  $data['latest'] = $ts;
  $date->setTimestamp($ts);
  $query = $query . ' WHERE `date` > "' . $date->format('Y-m-d H:i:s') . '"';
}

$result = $mysqli->query($query);
$mysqli->close();

// for ($x = 0; $x <= $data['max_x']; $x++) {
//   for ($y = 0; $y <= $data['max_y']; $y++) {
//     array_push($data['data'], array(
//       x => $x,
//       y => $y,
//       red => floor(($y / $data['max_y']) * 255),
//       green => floor(($x / $data['max_x']) * 255),
//       blue => 255 - floor(($x / $data['max_x']) * 255)
//     ));
//   }
// }

while ($row = $result->fetch_assoc()) {
  $x = (int) $row['x'];
  $y = (int) $row['y'];
  $r = (int) $row['red'];
  $g = (int) $row['green'];
  $b = (int) $row['blue'];
  $d = (new DateTime($row['date'], $utc))->getTimestamp();

  if ($x > $data['max_x']) {
    $data['max_x'] = $x;
  }

  if ($y > $data['max_y']) {
    $data['max_y'] = $y;
  }

  if ($d > $data['latest']) {
    $data['latest'] = $d;
  }

  array_push($data['data'], array('x'=>$x,'y'=>$y,'red'=>$r,'green'=>$g,'blue'=>$b));
}

echo json_encode($data);
?>
