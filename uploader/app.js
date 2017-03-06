

 class App {
  constructor() {
      this.a = 4;
  }
  async run() {
      let d = await this._test();
      console.log(d);
      return d;
  }
  _test() {
      return new Promise(function (resolve, reject) {
          setTimeout(()=> {
              resolve('Hello From Promiser'); //call native resolve when finish
          }, 10); // resolve() will be called in 10 ms
      });
  }
}

module.exports = App