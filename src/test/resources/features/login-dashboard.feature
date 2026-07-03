@MAD-97 @regression @smoke
Feature: Login to Dashboard
  As a mobile banking customer
  I want to sign in and reach my dashboard
  So that I can access the account overview placeholder

  Background:
    Given the application base URL is configured

  @AC-01 @AC-02 @AC-03 @AC-04 @AC-05
  Scenario: Successful login navigates to dashboard shell
    Given I am on the login page
    Then the login form is displayed with required fields
    When I enter username "testuser" and password "testpass"
    And I submit the login form
    Then I should be on the dashboard page
    And the dashboard heading is visible
    And the GlobalLogic brand is visible in the header
    And placeholder welcome text is shown without account widgets
