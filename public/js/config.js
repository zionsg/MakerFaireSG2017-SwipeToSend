/**
 * Config
 */

var config = (function () {
    // Self reference - all public vars/methods will be stored in here and returned as public interface
    var self = {
        port: 3000, // for server.js
        endpointUrl: 'http://wall.mymakermall.com:3000'
    };

    // Return public interface
    return self;
})();
