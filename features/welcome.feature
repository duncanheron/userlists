# features/welcome.feature
 
Feature: User journey entry points
    When a user visits the site
    As a non logged in memeber
    I should be redirected to login
 
    Scenario: Make sure the user is directed to log in from home
        Given I am on "home" page
        Then I should see "Login"

    Scenario: Make sure the user is directed to notfound
        Given I am on "/thisurldoesntexist"
        Then I should see "PAGE NOT FOUND"

    Scenario: Login the user in
        Given I have logged in
        And I should see "HELLO DUNCAN"

    Scenario: User confirms he is playing
        Given I have logged in
        When I check "response"
        And I press "submit"
        Then I should be on "/player"
        And I should see "You are playing this week"

    Scenario: User confirms he is not playing
        Given I have logged in
        When I uncheck "response"
        And I press "submit"
        Then I should be on "/player"
        And I should see "You have said you can't make it this week"
