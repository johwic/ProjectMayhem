var select_result;
var $result;
var $query;

function show_result() {
    'use strict';
    $result.slideDown(conf.slide_speed);
}

function hide_result() {
    'use strict';
    $result.slideUp(conf.slide_speed);
}

/*
 in case there is an error or there is no result,
 remove footer, add border radius to bottom right and left,
 and unbind click event and handler
 */
function remove_footer() {
    'use strict';
    $result.off("click", "tr", select_result);
    // add border radius to the last row of the result
    //result.find("table").addClass("border_radius");
}

/*
 get the search input object (not just its value)
 */
function search_query(search_object, bypass_check_last_value, reset_current_page) {
    'use strict';
    if ($.trim(search_object.value).length) {

        // If the previous value is different from the new one perform the search
        // Otherwise ignore that. This is useful when user change cursor position on the search field
        if (bypass_check_last_value || search_object.latest_value !== search_object.value) {

            // Reset selected row if there is any
            search_object.selected_row = undefined;

            /*
             If a search is in the queue to be executed while another one is coming,
             prevent the last one
             */
            if (search_object.to_be_executed) {
                clearTimeout(search_object.to_be_executed);
            }

            // Start search after the type delay
            search_object.to_be_executed = setTimeout(function () {

                // Sometimes requests with no search value get through, double check the length to avoid it
                if ($.trim($query.val()).length) {
                    // Display loading icon
                    $query.addClass('ajax_loader');

                    // Send the request
                    $.ajax({
                        type: "post",
                        url: conf.url,
                        data: $query.closest('form').serialize(),
                        dataType: "json",
                        success: function (response) {
                            if (response.status === 'success') {

                                // set html result and total pages
                                $result.find('table tbody').html(response.html);

                                //result.on("click", "tr", select_result);

                            } else {
                                // There is an error
                                $result.find('table tbody').html(response.html);

                                remove_footer();
                            }

                        },
                        error: function () {
                            $result.find('table tbody').html('<tr><td>Something went wrong. Please refresh the page.</td></tr>');

                            remove_footer();
                        },
                        complete: function () {
                            /*
                             Because this is a asynchronous request
                             it may add result even after there is no query in the search field
                             */
                            if ($.trim(search_object.value).length && $result.is(":hidden")) {
                                show_result();
                            }

                            $query.removeClass('ajax_loader');

                        }
                    });
                    // End of request
                }

            }, conf.type_delay);

        }

    } else {
        // If search field is empty, hide the result
        // If $(conf.result_id + ":animated") is removed, it may check visibility of the result div
        // while it's animating and may not hide the div
        if ($result.is(":visible") || $result.is(":animated")) {
            hide_result();
        }
    }

    search_object.latest_value = search_object.value;

}

/*
 select row / item function when users click or press enter key
 */
select_result = function () {
    'use strict';
    $query.val($query.selected_row.find('td').eq(conf.select_column_index).html());
    hide_result();

    var $stat_div = $('#stat_div');

    $.ajax({
        type: 'GET',
        url: stat_url.replace('0', $query.selected_row.attr('player-id')),
        success: function (response) {
            $stat_div.find('table tbody').html(response.html);
        }
    });
};

/*
 result width and position is changed based on search input
 */
function adjust_result_position() {
    'use strict';
    // considering result div border size, place the div in the center, underneath of search input
    // outerwidth - border size of the result div
    // adjust result position
    $result.css({left: $query.position().left + 1, width: $query.outerWidth() - 2});
}

$(document).ready(function () {
    'use strict';

    $result = $(conf.result_id);
    $query = $(conf.query_id);
    // Adjust result position based on search input position.
    adjust_result_position();

    // re-Adjust result position when screen resizes
    $(window).resize(function () {
        adjust_result_position();
    });

    // Trigger search when typing is started
    $query.on('keyup', function (event) {

        // If enter key is pressed check if the user want to selected hovered row
        var keycode = event.keyCode || event.which;
        if ($.trim($query.val()).length && keycode === 13) {
            if (($result.is(":visible") || $result.is(":animated")) && $result.find("tr").length !== 0) {
                // find hovered row
                if ($query.selected_row !== undefined) {
                    /*
                     Do whatever you want with the selected row
                     Instead of calling directly select function, it should be through click event
                     then easily can bind or unbind to page_range result handler
                     */
                    $query.selected_row.trigger("click");
                } // If there is any results and hidden and the search input is in focus, show result by press enter
            } else {
                show_result();
            }
        } else {
            // If something other than enter is pressed start search immediately
            search_query(this, false, true);
        }

    });

    // While search input is in focus
    // Move among the rows, by pressing or keep pressing arrow up and down
    $query.on('keydown', function (event) {

        var keycode = event.keyCode || event.which;
        if (keycode === 40 || keycode === 38) {
            if ($.trim($query.val()).length && $result.find("tr").length !== 0) {

                if (($result.is(":visible") || $result.is(":animated"))) {
                    $result.find('tr').removeClass('hover');

                    if ($query.selected_row === undefined) {
                        // Moving just started
                        $query.selected_row = $result.find("tr").eq(0);
                        $query.selected_row.addClass("hover");
                    } else {

                        $query.selected_row.removeClass("hover");

                        if (keycode === 40) {
                            // next
                            if ($query.selected_row.next().length === 0) {
                                // here is the end of the table
                                $query.selected_row = $result.find("tr").eq(0);
                                $query.selected_row.addClass("hover");
                            } else {
                                $query.selected_row.next().addClass("hover");
                                $query.selected_row = $query.selected_row.next();
                            }

                        } else {
                            // previous
                            if ($query.selected_row.prev().length === 0) {
                                // here is the end of the table
                                $query.selected_row = $result.find("tr").last();
                                $query.selected_row.addClass("hover");
                            } else {
                                $query.selected_row.prev().addClass("hover");
                                $query.selected_row = $query.selected_row.prev();
                            }
                        }

                    }
                } else {
                    // If there is any results and hidden and the search input is in focus, show result by press down
                    if (keycode === 40) {
                        show_result();
                    }
                }
            }
        }

    });

    // Show result when is focused
    $query.on('focus', function () {
        // check if the result is not empty show it
        if ($.trim($query.val()).length && ($result.is(":hidden") || $result.is(":animated")) && $result.find("tr").length !== 0) {
            search_query(this, false, true);
            show_result();
        }
    });

    // In the beginning, there is no result / tr, so we bind the event to the future tr
    $result.on('mouseover', 'tr', function () {
        // remove all the hover classes, otherwise there are more than one hovered rows
        $result.find('tr').removeClass('hover');

        // set the current selected row
        $query.selected_row = $(this);

        $(this).addClass('hover');
    });

    // In the beginning, there is no result / tr, so we bind the event to the future tr
    $result.on('mouseleave', 'tr', function () {
        // remove all the hover classes, otherwise there are more than one hovered rows
        $result.find('tr').removeClass('hover');

        // Reset selected row
        $query.selected_row = undefined;
    });

    $result.on('click', 'tr', select_result);

    // Click doesn't work on iOS - This is to fix that
    // According to: http://stackoverflow.com/a/9380061/2045041
    var touchStartPos;
    $(document)
        // log the position of the touchstart interaction
        .bind('touchstart', function () {
            touchStartPos = $(window).scrollTop();
        })
        // log the position of the touchend interaction
        .bind('touchend', function (event) {
            // calculate how far the page has moved between
            // touchstart and end.
            var distance, clickableItem;

            distance = touchStartPos - $(window).scrollTop();

            clickableItem = $(document);

            // adding this class for devices that
            // will trigger a click event after
            // the touchend event finishes. This
            // tells the click event that we've
            // already done things so don't repeat

            clickableItem.addClass("touched");

            if (distance < 10 && distance > -10) {
                // the distance was less than 20px
                // so we're assuming it's tap and not swipe
                if (!$(event.target).closest(conf.result_id).length && !$(event.target).is(conf.query_id) && $result.is(":visible")) {
                    hide_result();
                }
            }
        });


    $(document).on('click', function (event) {
        // for any non-touch device, we need
        // to still apply a click event
        // but we'll first check to see
        // if there was a previous touch
        // event by checking for the class
        // that was left by the touch event.
        if ($(this).hasClass("touched")) {
            // this item's event was already triggered via touch
            // so we won't call the function and reset this for
            // the next touch by removing the class
            $(this).removeClass("touched");
        } else {
            // there wasn't a touch event. We're
            // instead using a mouse or keyboard
            // Hide the result if outside of the result is clicked
            if (!$(event.target).closest(conf.result_id).length && !$(event.target).is(conf.query_id) && $result.is(":visible")) {
                hide_result();
            }
        }
    });

    // disable the form submit on pressing enter
    $query.closest('form').submit(function () {
        return false;
    });

});