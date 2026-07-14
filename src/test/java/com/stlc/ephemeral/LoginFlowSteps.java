package com.stlc.ephemeral;

import com.stlc.ephemeral.pages.DashboardPage;
import com.stlc.ephemeral.pages.LoginPage;
import io.cucumber.java.en.Given;
import io.cucumber.java.en.Then;
import io.cucumber.java.en.When;
import org.openqa.selenium.WebDriver;

import static org.junit.Assert.assertFalse;
import static org.junit.Assert.assertTrue;

/**
 * Glue for MAD-97 login → dashboard features.
 * Locators are XPath-only via page objects (STLC boundary).
 */
public class LoginFlowSteps {
    private String baseUrl() {
        return System.getProperty("app.base.url",
                System.getenv().getOrDefault("APP_BASE_URL", "http://127.0.0.1:5173"));
    }

    private WebDriver driver() {
        return UiEvidenceHooks.getDriver();
    }

    private LoginPage loginPage() {
        return new LoginPage(driver());
    }

    private DashboardPage dashboardPage() {
        return new DashboardPage(driver());
    }

    @Given("the Mobile Banking App base URL is configured")
    public void bankingBaseConfigured() {
        assertTrue("app.base.url required", baseUrl() != null && !baseUrl().isBlank());
    }

    @Given("the tester is on the Sign in page")
    public void onSignIn() {
        openBase();
        assertLoginEntry();
    }

    @Given("the tester starts a clean browser session for the app")
    public void cleanSession() {
        driver().manage().deleteAllCookies();
        openBase();
    }

    @When("the tester navigates to the application base URL")
    public void openBase() {
        driver().get(baseUrl());
    }

    @When("the tester navigates directly to the dashboard URL without Login")
    public void openDashboardDirect() {
        String root = baseUrl().replaceAll("/+$", "");
        driver().get(root + "/dashboard");
    }

    @When("the tester enters username {string} or leaves username empty")
    public void enterUser(String user) {
        loginPage().enterUsername(user);
    }

    @When("the tester enters password {string} or leaves password empty")
    public void enterPass(String pass) {
        loginPage().enterPassword(pass);
    }

    @When("the tester activates the Login control")
    public void clickLogin() {
        loginPage().clickLogin();
        try {
            Thread.sleep(800);
        } catch (InterruptedException ignored) {
            Thread.currentThread().interrupt();
        }
    }

    @Then("the application loads without a crash")
    public void loadsOk() {
        assertTrue(driver().getPageSource() != null && driver().getPageSource().length() > 20);
    }

    @Then("the browser path is the login entry route")
    public void assertLoginEntry() {
        String url = driver().getCurrentUrl() == null ? "" : driver().getCurrentUrl().toLowerCase();
        boolean loginPath = url.contains("login");
        boolean hasForm = loginPage().formControlsPresent() || loginPage().isSignInVisible();
        assertTrue("expected login entry route or Sign in form, url=" + url, loginPath || hasForm);
    }

    @Then("the Sign in form shows username, password, and Login control")
    public void assertForm() {
        assertTrue("Sign in form controls missing", loginPage().formControlsPresent());
    }

    @Then("the landing UI is Sign in and not the Dashboard heading")
    public void assertNotDashboard() {
        assertTrue(
                loginPage().isSignInVisible() || loginPage().formControlsPresent());
        assertFalse(
                "Dashboard should not be landing UI",
                driver().getCurrentUrl() != null
                        && driver().getCurrentUrl().toLowerCase().contains("/dashboard"));
    }

    @Then("the browser path is {string}")
    public void assertPath(String expected) {
        String url = driver().getCurrentUrl() == null ? "" : driver().getCurrentUrl();
        String want = expected == null ? "" : expected.trim();
        assertTrue("expected path " + want + " in " + url, url.toLowerCase().contains(want.toLowerCase()));
    }

    @Then("the Dashboard heading is visible")
    public void assertDashboardHeading() {
        assertTrue("Dashboard heading missing", dashboardPage().isHeadingVisible());
    }

    @Then("the welcome placeholder text is visible")
    public void assertWelcome() {
        assertTrue("Welcome placeholder missing", dashboardPage().isWelcomeVisible());
    }

    @Then("the Dashboard page renders without redirect to {string}")
    public void assertNoRedirect(String loginPath) {
        String url = driver().getCurrentUrl() == null ? "" : driver().getCurrentUrl().toLowerCase();
        String blocked = loginPath == null ? "/login" : loginPath.toLowerCase();
        assertFalse("should not redirect to " + blocked + " but was " + url, url.contains(blocked));
        assertDashboardHeading();
    }
}
