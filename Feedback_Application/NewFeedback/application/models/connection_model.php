<?php
class connection_model Extends CI_Model{

  // this function will connect the MySQL Database.
  public function connect_database(){

    $host ='localhost';
    $user = 'root';
    $password = '';
    $db = 'feedback application';

    //Set DSN
    $dsn = 'mysql:host='.$host.';dbname='.$db;

    //Create a PDO Instance
    $pdo = new PDO($dsn, $user, $password);
    $pdo -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $pdo -> setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    return $pdo;
  }

}
?>
