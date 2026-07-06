@MAD-97 @regression @ui
Feature: MAD-97 Login to Dashboard E2E
  As a mobile banking customer
  I want to sign in and reach my dashboard
  So that I can access the account overview placeholder

  Background:
    Given the application base URL is configured

  @smoke @AC-01 @TC-MAD-97-01
  Scenario: Application root redirects unauthenticated user to login page
    Given a fresh browser session with no stored authentication state
    When I navigate to the application root URL
    Then the browser URL should end with "/login"
    And the Sign in heading is visible on the login page

  @smoke @AC-02 @TC-MAD-97-02
  Scenario: Login page displays enabled username password and login controls
    Given I am on the login page
    Then the Sign in heading is visible on the login page
    And the username field is visible and enabled
    And the password field is visible and enabled
    And the Login submit button is visible and enabled

  @smoke @AC-03 @TC-MAD-97-03
  Scenario: Login form submit navigates user to dashboard
    Given I am on the login page
    When I enter username "demo.user" and password "demo.pass"
    And I submit the login form
    Then the browser URL should end with "/dashboard"

  @smoke @AC-04 @TC-MAD-97-04
  Scenario: Dashboard displays heading branding and welcome content
    Given I have navigated to the dashboard via login
    Then the Dashboard heading is visible
    And the GlobalLogic brand is visible in the header
    And placeholder welcome text is shown without account widgets

  @AC-01 @TC-MAD-97-05
  Scenario: Unknown route redirects unauthenticated user to login page
    Given a fresh browser session with no stored authentication state
    When I navigate to "/unknown-page"
    Then the browser URL should end with "/login"
    And the Sign in heading is visible on the login page

  @AC-03 @TC-MAD-97-06
  Scenario: Empty credentials allow login navigation to dashboard
    Given I am on the login page
    When I submit the login form without entering credentials
    Then the browser URL should end with "/dashboard"
    And the Dashboard heading is visible

  @AC-02 @AC-03 @TC-MAD-97-07
  Scenario: Direct login page access loads without redirect loop
    Given a fresh browser session with no stored authentication state
    When I navigate directly to the login page
    Then the browser URL should end with "/login"
    And the Sign in heading is visible on the login page
    When I submit the login form without entering credentials
    Then the browser URL should end with "/dashboard"
