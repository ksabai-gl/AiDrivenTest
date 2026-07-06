package com.globallogic.aidriven.steps;

import com.globallogic.aidriven.config.TestContext;
import com.globallogic.aidriven.config.WebDriverFactory;
import com.globallogic.aidriven.pages.LoginPage;
import io.cucumber.java.en.Given;
import io.cucumber.java.en.When;
import org.openqa.selenium.WebDriver;

public class NavigationSteps {
  private final LoginPage loginPage = new LoginPage();

  @Given("a fresh browser session with no stored authentication state")
  public void aFreshBrowserSessionWithNoStoredAuthenticationState() {
    WebDriver existing = TestContext.getDriver();
    if (existing != null) {
      existing.quit();
      TestContext.setDriver(null);
    }
    WebDriver driver = WebDriverFactory.createChromeDriver();
    TestContext.setDriver(driver);
  }

  @When("I navigate to the application root URL")
  public void iNavigateToTheApplicationRootUrl() {
    loginPage.navigateToRoot();
  }

  @When("I navigate to {string}")
  public void iNavigateTo(String path) {
    loginPage.navigateToPath(path);
  }

  @When("I navigate directly to the login page")
  public void iNavigateDirectlyToTheLoginPage() {
    loginPage.open();
  }
}
