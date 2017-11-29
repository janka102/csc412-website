<?php
$mysqli = new mysqli('localhost','csc412','csc412','csc412');
$data = array();

if ($mysqli->connect_errno) {
  printf("Connect failed: %s\n", $mysqli->connect_error);
  exit();
}

$result = $mysqli->query("SELECT x, y, red, green, blue FROM jsmick_rplace");
header('Content-Type: application/json; charset=utf-8');

$data['max_x'] = 0;
$data['max_y'] = 0;
$data['data'] = array();

$to_int = function($value) {
  return (int) $value;
};

while ($row = $result->fetch_assoc()) {
  $r = array_map($to_int, $row);

  if ($r['x'] > $data['max_x']) {
    $data['max_x'] = $r['x'];
  }

  if ($r['y'] > $data['max_y']) {
    $data['max_y'] = $r['y'];
  }

  array_push($data['data'], $r);
}

echo json_encode($data);

$mysqli->close();
?>
