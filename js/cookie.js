/**
 * Utility functions for getting/setting Cookies.
 *
 * Created by: Steven Mills, 09/04/2014
 * Last Modified by: Steven Mills 08/09/2015
 */

/*jslint browser: true, for: true */

/**
 * Module pattern for cookie functions
 */
var Cookie = (function () {

    'use strict';

    var pub = {}; // Public interface to the module

    /**
     * Set (or reset) a cookie value
     *
     * Cookies may be set to expire after a given number of hours.
     * If no expiry time is given, they expire when the browser closes.
     *
     * @param name The name of the cookie to store
     * @param value The value to store in the cookie
     * @param hours [optional] time (in hours) until the cookie expires
     */
    pub.set = function (name, value, hours) {
        var date, expires;
        // URI encoding prevents problems with special characters
        name = encodeURIComponent(name);
        value = encodeURIComponent(value);
        if (hours) {
            date = new Date();
            date.setHours(date.getHours() + hours);
            expires = "; expires=" + date.toGMTString();
        } else {
            expires = "";
        }
        document.cookie = name + "=" + value + expires + "; path=/";
    };

    /**
     * Retrieve a cookie value
     *
     * @param name The name of the cookie to retrieve
     * @return The value of the cookie, or null if not set
     */
    pub.get = function (name) {
        var nameEq, cookies, cookie, i;
        // Cookies are stored with URI encoded names, so need to search for those
        name = encodeURIComponent(name);
        nameEq = name + "=";
        cookies = document.cookie.split(";");
        for (i = 0; i < cookies.length; i += 1) {
            cookie = cookies[i].trim();
            if (cookie.indexOf(nameEq) === 0) {
                // Values are URI encoded, so decode before returning them
                return decodeURIComponent(cookie.substring(nameEq.length, cookie.length));
            }
        }
        return null;
    };

    /**
     * Clear a cookie value
     *
     * @param name The name of the cookie to clear
     */
    pub.clear = function (name) {
        name = encodeURIComponent(name);
        pub.set(name, "", -1);
    };

    // Expose public interface
    return pub;
}());