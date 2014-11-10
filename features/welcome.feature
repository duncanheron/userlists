# features/welcome.feature
 
Feature: User journey entry points
    When a user visits the site
    As a non logged in memeber
    I should be redirected to login
 
    Scenario: Make sure the user is directed to log in from home
        Given I am on "/index.php"
        Then I should see "Login"

    Scenario: Make sure the user is directed to notfound
        Given I am on "/thisurldoesntexist"
        Then I should see "PAGE NOT FOUND"

    Scenario: Login the user in
        Given I am on "/login"
        When I fill in "email" with "duncanuk@gmail.com"
        And I fill in "password" with "test"
        And I press "submit"
        Then I should be on "/player"
        And I should see "HELLO DUNCAN"

    Scenario: User confirms he is playing
        Given I am on "/login"
        When I fill in "email" with "duncanuk@gmail.com"
        And I fill in "password" with "test"
        And I press "submit"
        Then I should be on "/player"
        When I check "response"
        And I press "submit"
        Then I should be on "/player"
        And I should see "You are playing this week"

    Scenario: User confirms he is not playing
        Given I am on "/login"
        When I fill in "email" with "duncanuk@gmail.com"
        And I fill in "password" with "test"
        And I press "submit"
        Then I should be on "/player"
        When I uncheck "response"
        And I press "submit"
        Then I should be on "/player"
        And I should see "You have said you can't make it this week"
