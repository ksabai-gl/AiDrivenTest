package com.stlc.ephemeral.pages;

import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;

/**
 * Sign in page object — XPath-only locators (STLC java-selenium-cucumber).
 * MAD-97 / AC-01 / TC-001.
 */
public class LoginPage {
    private final WebDriver driver;

    public static final String USERNAME_XPATH = "//input[@name='username']";
    public static final String PASSWORD_XPATH = "//input[@name='password']";
    public static final String LOGIN_BTN_XPATH =
            "//button[@type='submit' and normalize-space()='Login']"
                    + " | //button[normalize-space()='Login']";
    public static final String SIGN_IN_HEADING_XPATH =
            "//h1[@id='login-heading' or contains(normalize-space(),'Sign in')]"
                    + " | //h1[normalize-space()='Sign in']";

    public LoginPage(WebDriver driver) {
        this.driver = driver;
    }

    public WebElement username() {
        return driver.findElement(By.xpath(USERNAME_XPATH));
    }

    public WebElement password() {
        return driver.findElement(By.xpath(PASSWORD_XPATH));
    }

    public WebElement loginButton() {
        return driver.findElement(By.xpath(LOGIN_BTN_XPATH));
    }

    public boolean isSignInVisible() {
        return !driver.findElements(By.xpath(SIGN_IN_HEADING_XPATH)).isEmpty();
    }

    public boolean formControlsPresent() {
        return !driver.findElements(By.xpath(USERNAME_XPATH)).isEmpty()
                && !driver.findElements(By.xpath(PASSWORD_XPATH)).isEmpty()
                && !driver.findElements(By.xpath(LOGIN_BTN_XPATH)).isEmpty();
    }

    public void enterUsername(String user) {
        WebElement el = username();
        el.clear();
        if (user != null && !user.isBlank() && !"empty".equalsIgnoreCase(user)) {
            el.sendKeys(user);
        }
    }

    public void enterPassword(String pass) {
        WebElement el = password();
        el.clear();
        if (pass != null && !pass.isBlank() && !"empty".equalsIgnoreCase(pass)) {
            el.sendKeys(pass);
        }
    }

    public void clickLogin() {
        loginButton().click();
    }
}
