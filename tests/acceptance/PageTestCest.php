<?php


namespace Acceptance;

use \AcceptanceTester;
use yii\helpers\Url;

class PageTestCest
{
    // tests
    public function PageTest(FunctionalTester $I)
    {
        $I->amOnPage(Url::to('admin/login'));
        $I->see('Вход','h1');
    }
}
