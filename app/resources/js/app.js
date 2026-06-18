import './bootstrap';
import "bootstrap/dist/js/bootstrap.bundle.min.js";
import './admin'
import serviceProvider from './core/ServiceProvider';
/**
 * Autoload css 
 */
import.meta.glob('../../extensions/**/Resources/css/autoload.css', { eager: true })
/**
 * Autoload javascript file of extension
 */
const modules = import.meta.glob('../../extensions/**/Resources/js/autoload.js', { eager: true });
serviceProvider.expect(Object.keys(modules).length)
/**
 * Implement JS from extension and auto call 
 */
Object.values(modules).forEach(mod => {
  const ExtensionClass = mod.default
  if (typeof ExtensionClass === 'function') {
    new ExtensionClass() 
  }
});