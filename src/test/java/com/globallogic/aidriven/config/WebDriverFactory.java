package com.globallogic.aidriven.config;

import io.github.bonigarcia.wdm.WebDriverManager;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.chrome.ChromeOptions;

public final class WebDriverFactory {
  private WebDriverFactory() {}

  public static WebDriver createChromeDriver() {
    WebDriverManager.chromedriver().setup();
    ChromeOptions options = new ChromeOptions();
    options.addArguments("--headless=new", "--window-size=1280,720", "--disable-gpu");
    return new ChromeDriver(options);
  }
}
