<?php declare(strict_types=1);

namespace Pages;

use Pages\BasePage;
use mysqli;

final class DevPage extends BasePage {
   private const PAGE_TEMPLATE = 'dev.phtml';

   public function doStuff(): void {
      // ToDo: Handle POST
      $this->testMySQL();
   }

   protected function getPageTemplateName(): string {
      return self::PAGE_TEMPLATE;
   }

   protected function getPageTitle(): string {
      return 'Dev Page';
   }

   private function testMySQL(): void {
      $servername = "localhost";
      $username = "root";
      $password = "my-test-pw";
      $dbname = "dev_db";

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);

      // Check connection
      if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
      }
      echo "Connected successfully";

      $sql = "SELECT `name`, `group_name`, `comment`
      FROM `comments`
      JOIN `user` USING (`userid`)
      JOIN `user_groups` USING (`groupid`);";

      $result = $conn->query($sql);

      if (mysqli_num_rows($result) > 0) {
         // output data of each row
         while($row = mysqli_fetch_assoc($result)) {
            var_dump($row);
         }
      } else {
         echo "0 results";
      }
   }
}