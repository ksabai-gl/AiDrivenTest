/**
 * It's working like Laravel provider 
 */
class ServiceProvider {
  constructor() {
    this.phase = 'init' // init | register | ready | booted
    this.registerQueue = []
    this.bootQueue = []
    this.expected = 0
    this.completed = 0
  }
  /**
   * 
   * @param count is total extension will register to working
   */
  expect(count) {
    this.expected = count
  }
  /**  Mark total extension completed register 
   *   Because maybe a lots of thing extension register, so we don't know when to complete. 
   *   It should have mark 
   */
  extensionRegistered() {
    this.completed++

    if (this.completed >= this.expected) {
      this.markReady()
    }
  }

  register(fn) {
    this.registerQueue.push(fn)
  }

  boot(fn) {
    if (this.phase === 'ready') {
      fn()
    } else {
      this.bootQueue.push(fn)
    }
  }
  /**
     * Of course we also don't need reset register but it better good for memmory, so need reset 
     */
  markReady() {
    this.registerQueue.forEach(fn => fn())
    this.registerQueue = [];
    this.phase = 'ready'
    this.bootQueue.forEach(fn => fn())
    this.bootQueue = []
    this.phase = 'booted'
  }
}
/**
 * Singleon pattern
 */
const serviceProvider = new ServiceProvider();
export default serviceProvider;
