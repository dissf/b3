<?php
header('Content-Type: text/html; charset=UTF-8');

$ability_labels = ['imm' => 'immortal', 'pass' => 'passing through walls', 'lev' => 'levitation'];

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  if (!empty($_GET['save'])) {
    print('Спасибо, результаты сохранены.');
  }
  include('form.php');
  exit();
}

$errors = FALSE;


if (empty($_POST['name'])) {
  print('Заполните имя.<br/>');
  $errors = TRUE;
}
else if (!preg_match('/^[а-яА-Я ]+$/u', $_POST['name'])) {
  print('Недопустимые символы в имени.<br/>');
  $errors = TRUE;
}

if (empty($_POST['year'])) {
    print('Заполните год.<br/>');
    $errors = TRUE;
}
else {
  $year = $_POST['year'];
  if (!(is_numeric($year) && intval($year) >= 1900 && intval($year) <= 2020)) {
    print('Укажите корректный год.<br/>');
    $errors = TRUE;
  }
}

$ability_data = array_keys($ability_labels);
if (empty($_POST['abilities'])) {
    print('Выберите способность.<br/>');
    $errors = TRUE;
}
else{
  $abilities = $_POST['abilities'];
  foreach ($abilities as $ability) {
    if (!in_array($ability, $ability_data)) {
      print('Плохая способность!<br/>');
      $errors = TRUE;
    }
  }
}
if(empty($_POST['email']) || !preg_match("/^\\w+@[\\w\\.]+\\w\\.\\w+$/u", $_POST['email'])) {
print('Корректно укажите почту.<br/>');
$errors = TRUE;
}
if (empty($_POST['contract'])) {
  print('Подтвердите.<br/>');
  $errors = TRUE;
}
/*
$ability_insert = [];
foreach ($ability_data as $ability) {
  $ability_insert[$ability] = in_array($ability, $abilities) ? 1 : 0;
}
*/



if ($errors) {
   exit();
}

$user = 'u20490';
$pass = '3080615';
$db = new PDO('mysql:host=localhost;dbname=u20490', $user, $pass, array(PDO::ATTR_PERSISTENT => true));

try {
  $stmt = $db->prepare("INSERT INTO application SET name = ?, year = ?, ability_imm = ?, ability_pass = ?, ability_lev = ?");
  $stmt->execute([$_POST['name'], intval($year), $ability_insert['imm'], $ability_insert['pass'], $ability_insert['lev']]);
}
catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  exit();
}

catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  exit();
}
header('Location: ?save=1');
