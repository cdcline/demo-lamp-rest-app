<?php declare(strict_types=1);

namespace DB;

use Utils\DBUtils;

class User {
   public static function getUseridFromName(string $name): int {
      $q_userid = <<<EOT
         SELECT `userid`
         FROM `users`
         WHERE `name` = ?
EOT;
      $params = [['s', $name]];
      $userid = DBUtils::fetchValue($q_userid, $params);
      return (int)$userid;
   }
}
