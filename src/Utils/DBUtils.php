<?php declare(strict_types=1);

namespace Utils;

use Exception;
use mysqli;

class DBUtils {
   private const SERVERNAME = 'localhost';
   private const DBNAME = 'dev_db';
   // Connecting as root is a terrible security breach but this just a basic localhost demo site.
   private const USERNAME = 'root';
   // Even worse security breach to hardcode the root password 😂
   private const PASSWORD = 'my-test-pw';

   private static function fetchConn() {
      // Create connection
      $conn = new mysqli(self::SERVERNAME, self::USERNAME, self::PASSWORD, self::DBNAME);
      // Check connection
      if ($conn->connect_error) {
         throw new ConnectionError($conn);
      }
      return $conn;
   }

   public static function fetchValue($sqlQuery, $params) {
      $conn = self::fetchConn();
      $stmt = $conn->prepare($sqlQuery);
      $pKey = '';
      $pValues = [];
      foreach ($params as $param) {
         $pKey .= $param[0];
         $pValues[] = $param[1];
      }
      $stmt->bind_param($pKey, ...$pValues);
      $stmt->execute();
      $stmt->bind_result($result);
      $stmt->fetch();
      return $result;
   }

   public static function insertRow($sqlQuery, $params) {
      $conn = self::fetchConn();
      $stmt = $conn->prepare($sqlQuery);
      $pKey = '';
      $pValues = [];
      foreach ($params as $param) {
         $pKey .= $param[0];
         $pValues[] = $param[1];
      }
      $stmt->bind_param($pKey, ...$pValues);
      $stmt->execute();
   }

   public static function fetchRowsForQuery(string $sqlQuery): array {
      $qResult = self::fetchConn()->query($sqlQuery);
      $rows = [];

      if (mysqli_num_rows($qResult) > 0) {
         // output data of each row
         while ($row = mysqli_fetch_assoc($qResult)) {
            $rows[] = $row;
         }
      }

      return $rows;
   }
}

class ConnectionError extends Exception {
   public function __construct(private $conn) {
      $this->$conn = $conn;
      $errMsg ="MySQL connection failed: {$this->conn->connect_error}";
      return parent::__construct($errMsg);
   }
}
