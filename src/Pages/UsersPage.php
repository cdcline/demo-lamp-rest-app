<?php declare(strict_types=1);

namespace Pages;

use DB\User;
use Pages\BasePage;
use Utils\ServerUtils;

final class UsersPage extends BasePage {
   private const PAGE_TEMPLATE = 'users.phtml';

   public function doStuff(): void {
      if ($_POST) {
         User::saveUserFromPost();
         ServerUtils::reloadPage();
      }
   }

   protected function getPageTemplateName(): string {
      return self::PAGE_TEMPLATE;
   }

   protected function getPageTitle(): string {
      return 'Users';
   }
}
