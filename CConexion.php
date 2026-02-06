<?php
class CConexion {

      public static function conexionBD(){

      $host = 'localhost';
      $dbname = 'dulceria';
      $username = 'postgres'; // Reemplaza "tu_usuario" por el nombre de usuario de tu base de datos PostgreSQL
      $password = 'Lector'; // Reemplaza "tu_contraseña" por la contraseña de tu base de datos PostgreSQL

      try {
          $conn = new PDO("pgsql:host=$host; dbname=$dbname" , $username,$password);
          
      }
      catch(PDOException $e) {
          echo ("Error al conectar a la base de datos,$exp ") ;

       }
      return $conn;
    }
}
?>
