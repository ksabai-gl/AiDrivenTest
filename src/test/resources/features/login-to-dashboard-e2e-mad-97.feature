@MAD-97 @ui
Feature: Login to Dashboard E2E (MAD-97)
  As a QA tester of the Mobile Banking App
  I want to verify Sign in entry and navigation to Dashboard
  So that MAD-97 login→dashboard E2E is covered as navigation-only auth

  Background:
    Given the Mobile Banking App base URL is configured

  @smoke @regression @TC-001 @AC-01 @TS-01
  Scenario: TC-001 Application opens on Sign in with form controls
    When the tester navigates to the application base URL
    Then the application loads without a crash
    And the browser path is the login entry route
    And the Sign in form shows username, password, and Login control
    And the landing UI is Sign in and not the Dashboard heading

  @smoke @regression @TC-002 @AC-02 @TS-02
  Scenario: TC-002 Login with credentials navigates to Dashboard
    Given the tester is on the Sign in page
    When the tester enters username "test.user" or leaves username empty
    And the tester enters password "AnyPass1!" or leaves password empty
    And the tester activates the Login control
    Then the browser path is "/dashboard"
    And the Dashboard heading is visible
    And the welcome placeholder text is visible

  @regression @TC-003 @AC-02 @TS-02
  Scenario: TC-003 Blank credential Login navigates to Dashboard
    Given the tester is on the Sign in page
    When the tester enters username "empty" or leaves username empty
    And the tester enters password "empty" or leaves password empty
    And the tester activates the Login control
    Then the browser path is "/dashboard"
    And the Dashboard heading is visible
    And the welcome placeholder text is visible

  @regression @TC-004 @AC-03 @TS-03
  Scenario: TC-004 Direct navigation to unguarded Dashboard deep-link
    Given the tester starts a clean browser session for the app
    When the tester navigates directly to the dashboard URL without Login
    Then the Dashboard page renders without redirect to "/login"
    And the Dashboard heading is visible
    And the welcome placeholder text is visible

