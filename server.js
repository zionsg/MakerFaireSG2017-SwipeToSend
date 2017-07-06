var http = require('http');
var url = require('url');
var querystring = require('querystring');

var app = http.createServer(function (req, res) {
    var method = req.method;
    var sendResponse = function (jsonObject) {
        res.writeHead(200, { "Content-Type": "application/json" });
        res.write(JSON.stringify(jsonObject));
        res.end();
    }

    if ('GET' === method) {
        var urlParts = url.parse(req.url, true);
        var query = urlParts.query;

        console.log(urlParts.search ? query : urlParts.href);
        io.sockets.emit('vid', query); // client listening for "vid" param
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

            console.log(post);
            io.sockets.emit('vid', post.data); // client listening for "vid" param
            sendResponse(post);
        });
    } else {
        sendResponse(post);
    }
});

// Socket.io server listens to our app
var io = require('socket.io').listen(app);
var port = 3000;

// Emit welcome message on connection
io.sockets.on('connection', function (socket) {
    socket.emit('welcome', { message: 'Connected to Server' });
});

app.listen(port, function () {
    console.log('Node app is running on port', port);
});
