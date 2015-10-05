/**
 * Functions to list rooms in a hotel.
 * On page load, a list of rooms and room types is read from XML.
 * This is formatted as a description list in the HTML page.
 *
 * Created by: Steven Mills, 18/08/2014
 * Last Modified by: Steven Mills 07/09/2015
 */

/*jslint browser: true, this: true */
/*global $*/

/**
 * Module pattern for room listing functions
 */
var ListRooms = (function () {

    'use strict';

    var pub = {}; // Public interface to the module

    /**
     * Display a list of hotel rooms.
     *
     * Information about the hotel rooms is split over two XML files.
     * First the list of room types is read from roomTypes.xml.
     * Room types are stored in an associative array for easy searching.
     * Once that has completed (using $.ajax().done()) a list of rooms is read.
     * The rooms are read from hotelRooms.xml, and the room types matched via the associative array.
     * Finally these are displayed in a description list.
     */
    function readRooms() {
        // Read the room types first, then the rooms
        var roomTypes = [];
        $.ajax({
            type: "GET",
            url: "xml/roomTypes.xml",
            cache: false,
            success: function (data) {
                $(data).find("roomType").each(function () {
                    var id, desc;
                    id = $($(this).find("id")[0]).text();
                    desc = $($(this).find("description")[0]).text();
                    roomTypes[id] = desc;
                });
            }
        }).done(function () {
            // We now have the room types, so can read in the rooms
            $.ajax({
                type: "GET",
                url: "xml/hotelRooms.xml",
                cache: false,
                success: function (data) {
                    $(data).find("hotelRoom").each(function () {
                        var number, description, type, price;
                        number = $($(this).find("number")[0]).text();
                        type = $($(this).find("roomType")[0]).text();
                        description = $($(this).find("description")[0]).text();
                        price = $($(this).find("pricePerNight")[0]).text();
                        $("#roomList").append($("<dt>").text(number + ': ' + roomTypes[type]));
                        $("#roomList").append($("<dd>").text(description + ' $' + price + ' per night.'));
                    });
                }
            });
        });
    }

    /**
     * Setup function for room listing page.
     *
     * This function simply displays a list of the hotel's rooms.
     */
    pub.setup = function () {
        readRooms();
    };

    // Expose public interface
    return pub;
}());

// On page load, setup the ListRooms functions
$(document).ready(ListRooms.setup);