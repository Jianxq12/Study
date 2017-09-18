(function (window) {
    var utils = {
        getRandom : function (min,max) {
            return Math.floor(Math.random()*(max - min) + min);
        }
    }
    
    window.utils = utils;
    
})(window)
