package com.stlc.ephemeral.pages;

import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;

/**
 * Dashboard page object — XPath-only locators (STLC java-selenium-cucumber).
 * MAD-97 / AC-02 / AC-03 / TC-002…TC-004.
 */
public class DashboardPage {
    private final WebDriver driver;

    public static final String DASHBOARD_HEADING_XPATH =
            "//h1[contains(@class,'dashboard__title') or normalize-space()='Dashboard']"
                    + " | //h1[contains(normalize-space(),'Dashboard')]";
    public static final String WELCOME_XPATH =
            "//p[contains(@class,'dashboard__placeholder')]"
                    + " | //*[contains(normalize-space(),"
                    + "'Welcome. Your account overview will appear here.')]";

    public DashboardPage(WebDriver driver) {
        this.driver = driver;
    }

    public boolean isHeadingVisible() {
        return !driver.findElements(By.xpath(DASHBOARD_HEADING_XPATH)).isEmpty();
    }

    public boolean isWelcomeVisible() {
        return !driver.findElements(By.xpath(WELCOME_XPATH)).isEmpty();
    }
}
