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

   public static function fetchUserComments(): array {
      $allComments = <<<EOT
         SELECT `name` as "Name", `group_name` as "Group Name", `comment` as "Comment"
         FROM `comments`
         JOIN `user` USING (`userid`)
         JOIN `user_groups` USING (`groupid`);
EOT;
      return self::fetchRowsForQuery($allComments);
   }

   private static function fetchRowsForQuery(string $sqlQuery): array {
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
