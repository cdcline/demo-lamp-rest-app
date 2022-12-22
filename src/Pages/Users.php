<?php declare(strict_types=1);

namespace Pages;

use DB\UserComment;
use Pages\BasePage;
use Utils\ServerUtils;

final class CommentsPage extends BasePage {
   private const PAGE_TEMPLATE = 'users.phtml';

   public function doStuff(): void {
      if ($_POST) {
         echo 'foo';
         die();
      }
   }

   protected function getPageTemplateName(): string {
      return self::PAGE_TEMPLATE;
   }

   protected function getPageTitle(): string {
      return 'Users';
   }
}
