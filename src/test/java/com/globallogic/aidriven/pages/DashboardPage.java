package com.globallogic.aidriven.pages;

import com.globallogic.aidriven.config.TestContext;
import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;

public class DashboardPage {
  private static final String TITLE = "//h1[contains(@class,'dashboard__title') and normalize-space()='Dashboard']";
  private static final String BRAND = "//span[contains(@class,'brand__name') and normalize-space()='GlobalLogic']";
  private static final String PLACEHOLDER = "//p[contains(@class,'dashboard__placeholder')]";
  private static final String ACCOUNT_WIDGET = "//*[contains(@class,'account') or contains(@class,'transaction') or contains(@class,'balance')]";

  private final WebDriver driver;

  public DashboardPage() {
    this.driver = TestContext.getDriver();
  }

  public boolean isOnDashboardUrl() {
    return driver.getCurrentUrl().contains("/dashboard");
  }

  public boolean isDashboardHeadingVisible() {
    return driver.findElement(By.xpath(TITLE)).isDisplayed();
  }

  public boolean isGlobalLogicBrandVisible() {
    return driver.findElement(By.xpath(BRAND)).isDisplayed();
  }

  public boolean isPlaceholderWelcomeVisible() {
    return driver.findElement(By.xpath(PLACEHOLDER)).isDisplayed();
  }

  public boolean hasNoAccountWidgets() {
    return driver.findElements(By.xpath(ACCOUNT_WIDGET)).isEmpty();
  }
}
