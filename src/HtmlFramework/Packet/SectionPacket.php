<?php declare(strict_types=1);

namespace HtmlFramework\Packet;

use HtmlFramework\Packet\PacketTrait;
use mysqli;

class SectionPacket {
   use PacketTrait;

   public function __construct(string $templatePath) {
      $this->setData('templatePath', $templatePath);
      self::testMySQL();
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

   public function printArticleHtml(): void {
      $this->pageArticle->printHtml();
   }
}
