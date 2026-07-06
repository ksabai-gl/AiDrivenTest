package com.globallogic.aidriven.hooks;

import com.globallogic.aidriven.config.TestContext;
import io.cucumber.java.AfterStep;
import io.cucumber.java.Scenario;
import org.openqa.selenium.OutputType;
import org.openqa.selenium.TakesScreenshot;
import org.openqa.selenium.WebDriver;

import java.nio.file.Files;
import java.nio.file.Path;
import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;

public class UiEvidenceHooks {
  private static final DateTimeFormatter STAMP =
      DateTimeFormatter.ofPattern("yyyyMMdd-HHmmss-SSS");

  @AfterStep
  public void captureStepScreenshot(Scenario scenario) {
    WebDriver driver = TestContext.getDriver();
    if (driver == null || !(driver instanceof TakesScreenshot screenshotDriver)) {
      return;
    }
    try {
      Path dir = EvidencePaths.screenshotDir();
      String slug = scenario.getName().toLowerCase().replaceAll("[^a-z0-9]+", "-");
      if (slug.length() > 48) {
        slug = slug.substring(0, 48);
      }
      String stamp = LocalDateTime.now().format(STAMP);
      Path file = dir.resolve(slug + "_step_" + stamp + ".png");
      byte[] png = screenshotDriver.getScreenshotAs(OutputType.BYTES);
      Files.write(file, png);
    } catch (Exception ignored) {
      // Best-effort STLC evidence capture
    }
  }
}
