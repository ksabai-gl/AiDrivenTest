/**
 * We can understand this class like register memory 
 * and implement for React router
 */
class RouteRegistry {
  constructor() {
    this.routes = []
    this.listeners = new Set()
  }

  add(route) {
    this.routes.push(route)
  }

  all() {
    return this.routes
  }
}
const routeRegistry = new RouteRegistry();
export default routeRegistry;
