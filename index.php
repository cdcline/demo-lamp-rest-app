<?php declare(strict_types=1);

// 1. Setup Autoload and define objects we'll use in the file
require_once __DIR__ . '/vendor/autoload.php';

echo 'hello world!';

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

// 3. Make sure we put out all the text we need want to display
flush();

// 4. Exit with no errors
exit(/*success*/0);
