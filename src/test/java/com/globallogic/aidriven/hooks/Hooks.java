package com.globallogic.aidriven.hooks;

import com.globallogic.aidriven.config.TestContext;
import com.globallogic.aidriven.config.WebDriverFactory;
import io.cucumber.java.After;
import io.cucumber.java.Before;
import org.openqa.selenium.OutputType;
import org.openqa.selenium.TakesScreenshot;
import org.openqa.selenium.WebDriver;

import java.nio.file.Files;
import java.nio.file.Path;
import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;

public class Hooks {
  @Before
  public void setUp() {
    String baseUrl = System.getProperty("app.base.url", "http://localhost:5173");
    TestContext.setBaseUrl(baseUrl.replaceAll("/$", ""));
    WebDriver driver = WebDriverFactory.createChromeDriver();
    TestContext.setDriver(driver);
  }

  @After
  public void tearDown() {
    WebDriver driver = TestContext.getDriver();
    if (driver == null) {
      return;
    }
    try {
      captureScreenshot(driver);
    } catch (Exception ignored) {
      // Evidence capture is best-effort at scaffold stage
    } finally {
      driver.quit();
      TestContext.setDriver(null);
    }
  }

  private void captureScreenshot(WebDriver driver) throws Exception {
    if (!(driver instanceof TakesScreenshot screenshotDriver)) {
      return;
    }
    Path screenshotDir = EvidencePaths.screenshotDir();
    byte[] png = screenshotDriver.getScreenshotAs(OutputType.BYTES);
    String stamp = LocalDateTime.now().format(DateTimeFormatter.ofPattern("yyyyMMdd-HHmmss"));
    Files.write(screenshotDir.resolve("scenario-end-" + stamp + ".png"), png);
  }
}
