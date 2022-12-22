<?php declare(strict_types=1);

namespace Pages;

use DB\UserComment;
use Pages\BasePage;
use Utils\ServerUtils;

final class DevPage extends BasePage {
   private const PAGE_TEMPLATE = 'dev.phtml';

   public function doStuff(): void {
      if ($_POST) {
         UserComment::saveCommentFromPost();
         ServerUtils::reloadPage();
         die();
      }
   }

   protected function getPageTemplateName(): string {
      return self::PAGE_TEMPLATE;
   }

   protected function getPageTitle(): string {
      return 'Dev Page';
   }
}
