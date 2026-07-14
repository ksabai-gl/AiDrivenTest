# Automation framework decision — MAD-97

**Profile:** `java-selenium-cucumber`  
**Confirmed from:** PRIOR_STAGE_OUTPUT / Test Case Design baseline  
**Locator strategy:** XPath only (`By.xpath`)  
**Forbidden runners:** Vitest, Jest, `npm test`  
**Target repo:** ksabai-gl/AiDrivenTest  
**Harness branch:** `stlc/MAD-97-ui-harness`  
**Smoke:** `mvn test -Dcucumber.filter.tags=@smoke`  
**Regression:** `mvn test -Dcucumber.filter.tags=@regression`  
**App base URL:** `http://127.0.0.1:5173`
