package com.globallogic.aidriven.pages;

import com.globallogic.aidriven.config.TestContext;
import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;

public class LoginPage {
  private static final String HEADING = "//h1[@id='login-heading' or normalize-space()='Sign in']";
  private static final String USERNAME = "//input[@name='username']";
  private static final String PASSWORD = "//input[@name='password' or @type='password']";
  private static final String SUBMIT = "//button[@type='submit' and normalize-space()='Login']";

  private final WebDriver driver;

  public LoginPage() {
    this.driver = TestContext.getDriver();
  }

  public void open() {
    driver.get(TestContext.getBaseUrl() + "/login");
  }

  public boolean isDisplayed() {
    return driver.findElement(By.xpath(HEADING)).isDisplayed();
  }

  public WebElement getUsernameField() {
    return driver.findElement(By.xpath(USERNAME));
  }

  public WebElement getPasswordField() {
    return driver.findElement(By.xpath(PASSWORD));
  }

  public WebElement getSubmitButton() {
    return driver.findElement(By.xpath(SUBMIT));
  }

  public void enterCredentials(String username, String password) {
    getUsernameField().clear();
    getUsernameField().sendKeys(username);
    getPasswordField().clear();
    getPasswordField().sendKeys(password);
  }

  public void submit() {
    getSubmitButton().click();
  }
}
