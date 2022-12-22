<?php declare(strict_types=1);

namespace DB;

use Utils\DBUtils;

class UserGroup {
   public static function fetchAllGroups(): array {
      $allGroups = <<<EOT
         SELECT `groupid`, `group_name`
         FROM `user_groups`
EOT;
      return DBUtils::fetchRowsForQuery($allGroups);
   }
}
