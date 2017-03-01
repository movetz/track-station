const Koa = require('koa');
const parse = require('co-busboy');
const fs = require('fs');
const os = require('os');
const path = require('path');

const app = new Koa();

app.use(function *() {
    if ('POST' != this.method) return yield next;

    console.log(this.request);
    let parts = parse(this);

    let part;

    while ((part = yield parts)) {
        let stream = fs.createWriteStream(path.join(os.tmpdir(), 'test.flv'));
        part.pipe(stream);
        console.log('uploading %s -> %s', part.filename, stream.path);
    }


    this.body = '{ "text" : "Hello!" }';
});

if (!module.parent) app.listen(80);