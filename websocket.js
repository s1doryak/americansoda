process.chdir(__dirname);

function is_local() {
    return process.env.APP_ENV === 'local';
}

function is_https() {
    return process.env.APP_SCHEME === 'https';
}

var dotenv = require('dotenv'),
    express = require('express'),
    fs = require('fs'),
    http = require('http'),
    https = require('https'),
    SocketIO = require('socket.io'),
    Redis = require('ioredis'),
    app,
    server,
    options,
    io;

dotenv.config();

app = express();

if (is_https()) {
    server = https.createServer({
        key: fs.readFileSync(process.env.WEBSOCKET_HTTPS_KEY),
        cert: fs.readFileSync(process.env.WEBSOCKET_HTTPS_CERT)
    }, app);
    options = {
        origins: '*:*'
    };
} else {
    server = http.createServer(app);
    options = {};
}

if (is_local()) {
    options = {};
}

io = new SocketIO(server, options);

if (io) {
    io.on('connection', function (socket) {
        socket.emit('message', 'client connection ' + socket.id);
    });

    var redis = new Redis({
        port: process.env.REDIS_PORT,
        host: process.env.REDIS_HOST,
        password: process.env.REDIS_PASSWORD,
        db: process.env.REDIS_DATABASE
    });

    if (redis) {
        redis.psubscribe('*');
        redis.on('pmessage', function (pattern, channel, message) {
            io.emit('push', JSON.parse(message).data);
        });
    }

}

server.listen(process.env.WEBSOCKET_PORT);
