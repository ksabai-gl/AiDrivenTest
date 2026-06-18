
---

```markdown
# LiteERP – Brain of Extension Core

This is the core system that powers LiteERP extensions, written in JavaScript.

## Core Structure

**Path:** `resources/js/core`

The core works similarly to Laravel's core architecture.  
All extensions are registered and booted via `ServiceProvider.js`.

To fully understand how the core and extensions interact, you should be familiar with the **Singleton pattern**.

📖 Reference:  
https://refactoring.guru/design-patterns/singleton

---

## Example: HRM Extension

**File:** `extensions/Hrm/Resources/js/autoload.js`

```js
import Extension from '@core/Extension'
import RegisterRoute from '@core/RegisterRoute'
import HrmApp from './app.jsx'

export default class ServiceProvider extends Extension {
    register() {
        console.log("HRM register")
        RegisterRoute({
            path: '/hrm',
            element: HrmApp
        })
    }

    boot() {
        console.log('HRM loaded')
    }
}
