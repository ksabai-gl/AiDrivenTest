import serviceProvider from "@core/ServiceProvider"
/**
 * This class only rule to auto implement methods if who to take extends to it
 */
export default class Extension {
  constructor() {
    serviceProvider.register(() => this.register());
    /**
     * Talk with Service Provider 
     * Just completed register one extension
     */
    serviceProvider.extensionRegistered();
    serviceProvider.boot(() => this.boot())
  }
}
