/**
 * Socket server for MakerFaireSG 2017
 *
 * Listens for `vid` param from SwipeToSend app and `tweet` param from AnimatedTweets app
 * and sends them to the socket client.
 */

// Include config file
var fs = require('fs');
eval(fs.readFileSync('./public/js/config.js') + '');
var port = config.port || 3000;

var http = require('http');
var url = require('url');
var querystring = require('querystring');

var app = http.createServer(function (req, res) {
    var method = req.method;
    var sendResponse = function (jsonObject) {
        res.setHeader('Access-Control-Allow-Origin', '*');
        res.setHeader('Access-Control-Allow-Methods', 'GET, POST');
        res.setHeader('Access-Control-Allow-Headers', 'content-type');

        res.writeHead(200, { "Content-Type": "application/json" });
        res.write(JSON.stringify(jsonObject));
        res.end();
    }

    if ('GET' === method) {
        var urlParts = url.parse(req.url, true);
        var query = urlParts.query;
        var vid = query['vid'] || 0;
        var tweet = query['tweet'] || 0;

        console.log(urlParts.search ? query : urlParts.href);
        io.sockets.emit('vid', vid); // client listening for "vid" param
        io.sockets.emit('tweet', tweet); // client listening for "tweet" param
        sendResponse(query);
    } else if ('POST' === method) {
        var body = '';

        // Consolidate body
        req.on('data', function (data) {
            body += data;
        });

        // When request is ended, emit to socket client
        req.on('end', function () {
            var post = JSON.parse(body);
            var videoId = post.vid;
            var tweet = post.tweet;

            console.log(post);
            io.sockets.emit('vid', videoId); // client listening for "vid" param
            io.sockets.emit('tweet', tweet); // client listening for "tweet" param
            sendResponse(post);
        });
    } else {
        sendResponse({});
    }
});

// Socket.io server listens to our app
var io = require('socket.io').listen(app);

// Emit welcome message on connection
io.sockets.on('connection', function (socket) {
    socket.emit('welcome', { message: 'Connected to Server' });
});

app.listen(port, function () {
    console.log('Node app is running on port', port);
});
