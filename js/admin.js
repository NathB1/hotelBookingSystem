/**
 * Administrative view of hotel room bookings.
 * On page load, a list of bookings is read from XML.
 * This is formatted as a list in the HTML page.
 *
 * Created by: Steven Mills, 18/08/2014
 * Last Modified by: Steven Mills 08/09/2015
 */

/*jslint browser: true, this: true */
/*global $*/

/**
 * Module pattern for administrative functions
 */
var Admin = (function () {

    'use strict';

    var pub = {}; // Public interface to the module

    /**
     * Convert an XML date to a string.
     *
     * Dates in the XML files are stored as day, month, and year elements.
     * Given a DOM node refering to a date, this function produces a string representing the date.
     * Dates are formatted yyyy-mm-dd to allow easy sorting and comparison.
     *
     * @param xmlDate An XML DOM representing a date.
     * @ return The date in yyyy-mm-dd format.
     */
    function makeDateFromXML(xmlDate) {
        var dd, mm, yyyy;

        dd = $(xmlDate).find("day").text();

        mm = $(xmlDate).find("month").text();

        yyyy = $(xmlDate).find("year").text();

        return yyyy + '-' + mm + '-' + dd;
    }

    /**
     * Display current bookings.
     *
     * Current bookings are read from an XML file and displayed as a list.
     */
    function readBookings() {
        $.ajax({
            type: "GET",
            url: "xml/roomBookings.xml",
            cache: false,
            success: function (data) {
                $(data).find("booking").each(function () {
                    var name, number, checkin, checkout;
                    number = $($(this).find("number")[0]).text();
                    name = $($(this).find("name")[0]).text();
                    checkin = makeDateFromXML($($(this).find("checkin")[0]));
                    checkout = makeDateFromXML($($(this).find("checkout")[0]));
                    $("#bookingList").append($("<li>").text(name + " - Room " + number + " from " + checkin + " to " + checkout));
                });
            }
        });
    }

    /**
     * Setup function for administration page.
     *
     * This function simply displays a list of existing bookings.
     */
    pub.setup = function () {
        readBookings();
    };

    // Expose public interface
    return pub;
}());

// On page load, setup the Admin functions
$(document).ready(Admin.setup);