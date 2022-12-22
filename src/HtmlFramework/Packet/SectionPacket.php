<?php declare(strict_types=1);

namespace HtmlFramework\Packet;

use DB\User;
use DB\UserComment;
use DB\UserGroup;
use HtmlFramework\Packet\PacketTrait;

class SectionPacket {
   use PacketTrait;

   public function __construct(string $templatePath) {
      $this->setData('templatePath', $templatePath);
   }

   public function getAllComments(): array {
      return UserComment::fetchAllComments();
   }

   public function getAllUsers(): array {
      return User::fetchAllUsers();
   }

   public function getAllGroups(): array {
      return UserGroup::fetchAllGroups();
   }
}
