<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Behat\Context\Step;
//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Features context.
 */
class FeatureContext extends MinkContext
{
    protected $pages;
    protected $elements;
    /**
     * Initializes context.
     * Every scenario gets its own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        // Initialize your context here
        $this->pages = array(
            'home'   => '/index.php',
            'login'  => '/login',
            'player' => '/player'
        );
    }

//
// Place your definition and hook methods here:
//
//    /**
//     * @Given /^I have done something with "([^"]*)"$/
//     */
//    public function iHaveDoneSomethingWith($argument)
//    {
//        doSomethingWith($argument);
//    }
//

    /**
     * @Given /^I have logged in$/
     */
    public function iHaveLoggedIn()
    {
        return array(
            new Step\When('I am on "login" page'),
            new Step\When('I fill in "email" with "duncanuk@gmail.com"'),
            new Step\When('I fill in "password" with "test"'),
            new Step\When('I press "submit"'),
            new Step\Then('I should be on "player" page'),
        );
    }

    /**
     * @Then /^I should see "([^"]*)"$/
     */
    // public function iShouldSee($arg1)
    // {
    //     throw new PendingException();
    // }


    /**
     * @Given /^I am on "([^"]*)" page$/
     */
    public function iAmOnPage($page)
    {
        if(! isset($this->pages[$page])) {
            throw new Exception('Page not in pagelist');
        }
        $page = $this->pages[$page];
        
        return new Step\When("I am on \"$page\"");
    }

    /**
     * @Then /^I should be on "([^"]*)" page$/
     */
    public function iShouldBeOnPage($page)
    {   
        if(! isset($this->pages[$page])) {
            throw new Exception('Page not in pagelist');
        }
        $page = $this->pages[$page];
        
        return new Step\Then("I am on \"$page\"");
    }
}
