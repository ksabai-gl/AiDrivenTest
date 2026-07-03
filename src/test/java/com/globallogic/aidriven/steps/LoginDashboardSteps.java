package com.globallogic.aidriven.steps;

import com.globallogic.aidriven.pages.DashboardPage;
import com.globallogic.aidriven.pages.LoginPage;
import io.cucumber.java.en.And;
import io.cucumber.java.en.Given;
import io.cucumber.java.en.Then;
import io.cucumber.java.en.When;
import org.openqa.selenium.support.ui.ExpectedConditions;
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

  @Then("the login form is displayed with required fields")
  public void theLoginFormIsDisplayedWithRequiredFields() {
    assertTrue(loginPage.isDisplayed(), "Sign in heading should be visible");
    assertTrue(loginPage.getUsernameField().isDisplayed(), "Username field should be visible");
    assertTrue(loginPage.getPasswordField().isDisplayed(), "Password field should be visible");
    assertTrue(loginPage.getSubmitButton().isDisplayed(), "Login button should be visible");
  }

  @When("I enter username {string} and password {string}")
  public void iEnterUsernameAndPassword(String username, String password) {
    loginPage.enterCredentials(username, password);
  }

  @When("I submit the login form")
  @And("I submit the login form")
  public void iSubmitTheLoginForm() {
    loginPage.submit();
  }

  @Then("I should be on the dashboard page")
  public void iShouldBeOnTheDashboardPage() {
    new WebDriverWait(com.globallogic.aidriven.config.TestContext.getDriver(), Duration.ofSeconds(10))
        .until(d -> dashboardPage.isOnDashboardUrl());
    assertTrue(dashboardPage.isOnDashboardUrl(), "URL should contain /dashboard");
  }

  @Then("the dashboard heading is visible")
  @And("the dashboard heading is visible")
  public void theDashboardHeadingIsVisible() {
    assertTrue(dashboardPage.isDashboardHeadingVisible(), "Dashboard h1 should be visible");
  }

  @Then("the GlobalLogic brand is visible in the header")
  @And("the GlobalLogic brand is visible in the header")
  public void theGlobalLogicBrandIsVisibleInTheHeader() {
    assertTrue(dashboardPage.isGlobalLogicBrandVisible(), "GlobalLogic brand should be visible");
  }

  @Then("placeholder welcome text is shown without account widgets")
  @And("placeholder welcome text is shown without account widgets")
  public void placeholderWelcomeTextIsShownWithoutAccountWidgets() {
    assertTrue(dashboardPage.isPlaceholderWelcomeVisible(), "Welcome placeholder should be visible");
    assertTrue(dashboardPage.hasNoAccountWidgets(), "Account/transaction widgets should not appear");
  }
}
