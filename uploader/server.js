const Koa = require('koa');

const app = new Koa();

app.use(function *() {
    this.body = '<h2>Hello!</h2>';
});

if (!module.parent) app.listen(80);