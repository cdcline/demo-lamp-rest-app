<?php declare(strict_types=1);

namespace DB;

use DB\UserGroup;
use Exception;
use Utils\DBUtils;

class User {
   public static function fetchAllUsers(): array {
      $allComments = <<<EOT
         SELECT `name` as "Name", `group_name` as "Group Name"
         FROM `users`
         JOIN `user_groups` USING (`groupid`);
EOT;
      return DBUtils::fetchRowsForQuery($allComments);
   }

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

   public static function saveUserFromPost(): void {
      $userData = $_POST['user'] ?: [];
      $name = $userData['name'] ?: '';
      $groupid = (int)$userData['groupid'] ?: 0;
      $user = new self($name, $groupid);
      $user->save();
   }

   private function __construct(
      private string $name,
      private int $groupid)
   {
      if (!$name || !$groupid) {
         throw new UserGroupException($name, $groupid);
      }

      $this->name = $name;
      $this->groupid = $groupid;
   }

   private function save() {
      $q_save = <<<EOT
         INSERT INTO `users`
         (`groupid`, `name`)
         VALUES
         (?, ?)
EOT;
      $params = [
         ['i', $this->groupid],
         ['s', $this->name]
      ];
      DBUtils::insertRow($q_save, $params);
   }

}

class UserGroupException extends Exception {
   private function __construct(
      private string $name,
      private int $groupid)
   {
      $errorMsg = "Invalid Comment: Name -> '{$name}', groupid -> '{$groupid}'";
      parent::__construct($errorMsg);
   }
}

class InvalidGroupException extends Exception {}
