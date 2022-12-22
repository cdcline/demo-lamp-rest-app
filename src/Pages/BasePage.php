<?php declare(strict_types=1);

namespace Pages;

use HtmlFramework\Body as HtmlBody;
use HtmlFramework\Head as HtmlHead;
use HtmlFramework\Header as HtmlHeader;
use HtmlFramework\Root as HtmlRoot;
use HtmlFramework\Section as HtmlSection;
use Pages\InvalidPageException;

abstract class BasePage {
   protected const HEADER_TEMPLATE = 'default_header.phtml';

   private const TEMPLATE_PATH = 'src/templates';
   private $ranHTMLPrint = false;
   private $pageData = [];

   // Name of the file we'll load in the "article" section.
   abstract protected function getPageTemplateName(): string;
   // For now the titles will be static to the page types
   abstract protected function getPageTitle(): string;
   // Before we print the page we might want to do stuff.
   public function doStuff(): void {}

   public function setPageData(string $index, $value): void {
      if ($this->ranHTMLPrint) {
         InvalidPageException::throwInvalidPageOperation("Please don't set page data after printing it. Logic will become a crazy mess!");
      }
      $this->pageData[$index] = $value;
   }

   public function printHtml(): void {
      $this->ranHTMLPrint = true;
      $htmlHead = HtmlHead::fromValues($this->getPageTitle());
      $htmlSectionHeader = HtmlHeader::fromValues($this->getPageTitle(), $this->getPageHeaderPath());
      $htmlSection = HtmlSection::fromValues($this->getPageTemplatePath());
      $htmlBody = HtmlBody::fromValues($htmlSectionHeader, $htmlSection);
      $htmlRoot = HtmlRoot::fromValues($htmlHead, $htmlBody);
      $htmlRoot->printHtml();
   }

   protected function getPageHeaderName(): string {
      return self::HEADER_TEMPLATE;
   }

   private function getPageHeaderPath(): string {
      return self::TEMPLATE_PATH . "/{$this->getPageHeaderName()}";
   }

   private function getPageTemplatePath(): string {
      return self::TEMPLATE_PATH . "/{$this->getPageTemplateName()}";
   }
}
