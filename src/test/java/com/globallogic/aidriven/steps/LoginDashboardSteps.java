package com.globallogic.aidriven.steps;

import com.globallogic.aidriven.pages.DashboardPage;
import com.globallogic.aidriven.pages.LoginPage;
import io.cucumber.java.en.Given;
import io.cucumber.java.en.Then;
import io.cucumber.java.en.When;
import org.openqa.selenium.support.ui.WebDriverWait;

import java.time.Duration;

import static org.junit.jupiter.api.Assertions.assertTrue;

public class LoginDashboardSteps {
  private final LoginPage loginPage = new LoginPage();
  private final DashboardPage dashboardPage = new DashboardPage();

  @Given("the application base URL is configured")
  public void theApplicationBaseUrlIsConfigured() {
    // Base URL set in Hooks @Before hook from system property app.base.url
  }

  @Given("I am on the login page")
  public void iAmOnTheLoginPage() {
    loginPage.open();
  }

  @Given("I have navigated to the dashboard via login")
  public void iHaveNavigatedToTheDashboardViaLogin() {
    loginPage.open();
    loginPage.enterCredentials("demo.user", "demo.pass");
    loginPage.submit();
    new WebDriverWait(com.globallogic.aidriven.config.TestContext.getDriver(), Duration.ofSeconds(10))
        .until(d -> dashboardPage.isOnDashboardUrl());
  }

  @Then("the login form is displayed with required fields")
  public void theLoginFormIsDisplayedWithRequiredFields() {
    assertTrue(loginPage.isSignInHeadingVisible(), "Sign in heading should be visible");
    assertTrue(loginPage.getUsernameField().isDisplayed(), "Username field should be visible");
    assertTrue(loginPage.getPasswordField().isDisplayed(), "Password field should be visible");
    assertTrue(loginPage.getSubmitButton().isDisplayed(), "Login button should be visible");
  }

  @Then("the Sign in heading is visible on the login page")
  public void theSignInHeadingIsVisibleOnTheLoginPage() {
    assertTrue(loginPage.isSignInHeadingVisible(), "Sign in heading should be visible");
  }

  @Then("the username field is visible and enabled")
  public void theUsernameFieldIsVisibleAndEnabled() {
    assertTrue(loginPage.getUsernameField().isDisplayed(), "Username field should be visible");
    assertTrue(loginPage.getUsernameField().isEnabled(), "Username field should be enabled");
  }

  @Then("the password field is visible and enabled")
  public void thePasswordFieldIsVisibleAndEnabled() {
    assertTrue(loginPage.getPasswordField().isDisplayed(), "Password field should be visible");
    assertTrue(loginPage.getPasswordField().isEnabled(), "Password field should be enabled");
  }

  @Then("the Login submit button is visible and enabled")
  public void theLoginSubmitButtonIsVisibleAndEnabled() {
    assertTrue(loginPage.getSubmitButton().isDisplayed(), "Login button should be visible");
    assertTrue(loginPage.getSubmitButton().isEnabled(), "Login button should be enabled");
  }

  @Then("the browser URL should end with {string}")
  public void theBrowserUrlShouldEndWith(String suffix) {
    String url = com.globallogic.aidriven.config.TestContext.getDriver().getCurrentUrl();
    assertTrue(url.endsWith(suffix), "Expected URL to end with " + suffix + " but was " + url);
  }

  @When("I enter username {string} and password {string}")
  public void iEnterUsernameAndPassword(String username, String password) {
    loginPage.enterCredentials(username, password);
  }

  @When("I submit the login form")
  public void iSubmitTheLoginForm() {
    loginPage.submit();
  }

  @When("I submit the login form without entering credentials")
  public void iSubmitTheLoginFormWithoutEnteringCredentials() {
    loginPage.submit();
  }

  @Then("I should be on the dashboard page")
  public void iShouldBeOnTheDashboardPage() {
    new WebDriverWait(com.globallogic.aidriven.config.TestContext.getDriver(), Duration.ofSeconds(10))
        .until(d -> dashboardPage.isOnDashboardUrl());
    assertTrue(dashboardPage.isOnDashboardUrl(), "URL should contain /dashboard");
  }

  @Then("the dashboard heading is visible")
  public void theDashboardHeadingIsVisibleLower() {
    assertDashboardHeading();
  }

  @Then("the Dashboard heading is visible")
  public void theDashboardHeadingIsVisible() {
    assertDashboardHeading();
  }

  @Then("the GlobalLogic brand is visible in the header")
  public void theGlobalLogicBrandIsVisibleInTheHeader() {
    assertTrue(dashboardPage.isGlobalLogicBrandVisible(), "GlobalLogic brand should be visible");
  }

  @Then("placeholder welcome text is shown without account widgets")
  public void placeholderWelcomeTextIsShownWithoutAccountWidgets() {
    assertTrue(dashboardPage.isPlaceholderWelcomeVisible(), "Welcome placeholder should be visible");
    assertTrue(dashboardPage.hasNoAccountWidgets(), "Account/transaction widgets should not appear");
  }

  private void assertDashboardHeading() {
    assertTrue(dashboardPage.isDashboardHeadingVisible(), "Dashboard h1 should be visible");
  }
}
