<?php declare(strict_types=1);

namespace Pages;

use Pages\BasePage;
use mysqli;

final class DevPage extends BasePage {
   private const PAGE_TEMPLATE = 'dev.phtml';

   public function doStuff(): void {
      // ToDo: Handle POST
   }

   protected function getPageTemplateName(): string {
      return self::PAGE_TEMPLATE;
   }

   protected function getPageTitle(): string {
      return 'Dev Page';
   }
}