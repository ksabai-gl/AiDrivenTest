import routeRegistry from '@core/RouteRegistry'
/**
 * 
 * @param {*} route is router you need register for React route
 * This is register a router to you can UX friendly
 * But to display one menu to sidebar dashboard you need use PHP hook. Because at here you can not check user role 
 */
export default function RegisterRoute(route) {
  routeRegistry.add(route)
}
