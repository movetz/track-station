const Koa = require('koa');
const parse = require('co-busboy');
const fs = require('fs');
const os = require('os');
const path = require('path');
const ampq = require('amqp');
const route = require('koa-route');
const App = require('./app.js');

//const connection = ampq.createConnection({ host: 'mq', login: 'ts_user', password: 'ts_pass', vhost: '/' });


console.log(App);

const tapp = new App();


const app = new Koa();








// connection.on('ready', function () {
//     connection.exchange("my_exchange", options={type:'fanout'}, function(exchange) {
//
//
//         const sendMessage = function(payload) {
//             console.log('about to publish')
//             let encoded_payload = JSON.stringify(payload);
//             exchange.publish('', encoded_payload, {});
//         };
//
//         // Recieve messages
//         connection.queue("my_queue_name", function(queue){
//             console.log('Created queue')
//             queue.bind(exchange, '');
//             queue.subscribe(function (message) {
//                 console.log('subscribed to queue')
//                 var encoded_payload = unescape(message.data)
//                 var payload = JSON.parse(encoded_payload)
//                 console.log('Recieved a message:')
//                 console.log(payload)
//             })
//         })
//
//
//
//     })
// });


app.use(route.get('/', async (ctx, next) => {
    const start = new Date();
    await next();
    const ms = new Date() - start;
    let data = `${ctx.method} ${ctx.url} - ${ms}ms`;
    console.log(data);

    this.body = data;
}));

app.use(function *() {
    if ('POST' != this.method) return yield next;


    console.log(tapp.run());

    //sendMessage({"Message" : "Hello 123"});
    // let parts = parse(this);
    //
    // let part;
    //
    // while ((part = yield parts)) {
    //     let stream = fs.createWriteStream(path.join(os.tmpdir(), 'test.flv'));
    //     part.pipe(stream);
    //     console.log('uploading %s -> %s', part.filename, stream.path);
    // }


    this.body = '{ "text" : "Hello!" }';
});






if (!module.parent) app.listen(80);