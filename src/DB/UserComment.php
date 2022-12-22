<?php declare(strict_types=1);

namespace DB;

use Exception;
use Utils\DBUtils;

class UserComment {
   public static function saveCommentFromPost(): void {
      $commentData = $_POST['comment'] ?: [];
      $name = $commentData['name'] ?: '';
      $comment = $commentData['comment'] ?: '';
      $userComment = new self($name, $comment);
      $userComment->save();
   }

   public static function fetchAllComments(): array {
      $allComments = <<<EOT
         SELECT `name` as "Name", `group_name` as "Group Name", `comment` as "Comment"
         FROM `comments`
         JOIN `users` USING (`userid`)
         JOIN `user_groups` USING (`groupid`);
EOT;
      return DBUtils::fetchRowsForQuery($allComments);
   }

   private function __construct(
      private string $name,
      private string $comment)
   {
      if (!$name || !$comment) {
         throw new UserCommentException($name, $comment);
      }

      if (!$userid = User::getUseridFromName($name)) {
         throw new InvalidUserException("Unknown User");
      }

      $this->name = $name;
      $this->userid = $userid;
      $this->comment = $comment;
   }

   private function save() {
      $q_save = <<<EOT
         INSERT INTO `comments`
         (`userid`, `comment`)
         VALUES
         (?, ?)
EOT;
      $params = [
         ['i', $this->userid],
         ['s', $this->comment]
      ];
      DBUtils::insertRow($q_save, $params);
   }
}

class UserCommentException extends Exception {
   private function __construct(
      private string $name,
      private string $comment)
   {
      $errorMsg = "Invalid Comment: Name -> '{$name}', Comment -> '{$comment}'";
      parent::__construct($errorMsg);
   }
}

class InvalidUserException extends Exception {}
