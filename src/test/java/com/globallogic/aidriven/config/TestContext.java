package com.globallogic.aidriven.config;

import org.openqa.selenium.WebDriver;

public final class TestContext {
  private static WebDriver driver;
  private static String baseUrl;

  private TestContext() {}

  public static WebDriver getDriver() {
    return driver;
  }

  public static void setDriver(WebDriver webDriver) {
    driver = webDriver;
  }

  public static String getBaseUrl() {
    return baseUrl;
  }

  public static void setBaseUrl(String url) {
    baseUrl = url;
  }
}
