function jsonToArray(json) {
    var result = [];
    result.push([i, json]);

    var array = undefined;
    for (var i in result) {
        for (var y in result[i]) {
            if (typeof result[i][y] !== 'undefined') {
                array = result[i][y];
            }
        }
    }

    return array;
}

var interestHTML = '';
var interestIndex = 0;

function setupInterestsHTML() {
    getInterestsHTML('', interestObjects);
    $("#interest_list").append(interestHTML);
}

function getInterestsHTML(prefix, interest_data) {
    var index = 0;
    for (var i in interest_data) {
        if (interest_data[i] instanceof Array) {
            interestHTML += '<ul id="ul.' + (prefix + '_' + i).substring(1) + '">';
            interestHTML += getInterestElement((prefix + '_' + i).substring(1), i, true, user_interests[(prefix + '_' + i).substring(1)] === 1);
            if (interest_data[i].length > 0) {
                for (var a in interest_data[i]) {
                    interestHTML += getInterestElement((prefix + '_' + i + '_' + interest_data[i][a]).substring(1), interest_data[i][a], true, user_interests[(prefix + '_' + i + '_' + interest_data[i][a]).substring(1)] === 1);
                    interestHTML += '</li>';
                }
            }

            interestHTML += '\
             </li>\
             </ul>\
            ';

            // we've reached the end of a section
            if (index === (Object.keys(interest_data).length) - 1) {
                for (var k = 1; k <= count(prefix, '_') - 1; k++) {
                    interestHTML += '</li>';
                    interestHTML += '</ul>';
                }
            }

            index++;
        } else if (interest_data[i] instanceof Object) {
          if(index !== 0 && !prefix.includes('_')) {
            interestHTML += '</ul>';
          }
            interestHTML += '<ul id="ul.' + (prefix + '_' + i).substring(1) + '">';
            interestHTML += getInterestElement((prefix + '_' + i).substring(1), i, (prefix + '_' + i).substring(1).includes('_') === true, user_interests[(prefix + '_' + i).substring(1)] === 1);
            getInterestsHTML(prefix + '_' + i, interest_data[i]);
            index++;
        }
    }
}

function getInterestElement(id, text, hidden, checked) {
    return '\
      <li class="remember ' + (hidden ? 'interest' : 'interest active') + '">\
        <div style="text-align: left">\
            <div class="checkbox">\
                <label '+ ('id=label.' + id.split(' ').join('%20')) + ' ' + ('name=' + count(id, '_')) + '>\
                  <input type="checkbox" ' + ('id=input.' + id.split(' ').join('%20')) + ' ' + ('name=' + count(id, '_')) + ' ' + (checked ? 'checked' : '') + '>' + text + '</input>\
                </label>\
            </div>\
        </div>\
  ';
}

function count(string, char) {
    var re = new RegExp(char, "gi");
    return string.match(re) ? string.match(re).length : 0;
}

// ===================================== ABOUT TAB CODE =======================

const isNumericInput = (event) => {
    const key = event.keyCode;
    return ((key >= 48 && key <= 57) || // Allow number line
        (key >= 96 && key <= 105) // Allow number pad
    );
};

const isModifierKey = (event) => {
    const key = event.keyCode;
    return (event.shiftKey === true || key === 35 || key === 36) || // Allow Shift, Home, End
        (key === 8 || key === 9 || key === 13 || key === 46) || // Allow Backspace, Tab, Enter, Delete
        (key > 36 && key < 41) || // Allow left, up, right, down
        (
            // Allow Ctrl/Command + A,C,V,X,Z
            (event.ctrlKey === true || event.metaKey === true) &&
            (key === 65 || key === 67 || key === 86 || key === 88 || key === 90)
        )
};

const enforceFormat = (event) => {
    // alert('A');
    // Input must be of a valid number format or a modifier key, and not longer than ten digits
    if (!isNumericInput(event) && !isModifierKey(event)) {
        event.preventDefault();
    }
};

const formatToPhone = (event) => {
    if (isModifierKey(event)) {
        return;
    }

    // I am lazy and don't like to type things more than once
    const target = event.target;
    const input = event.target.value.replace(/\D/g, '').substring(0, 10); // First ten digits of input only
    const zip = input.substring(0, 3);
    const middle = input.substring(3, 6);
    const last = input.substring(6, 10);

    if (input.length > 6) {
        target.value = `(${zip}) ${middle} - ${last}`;
    } else if (input.length > 3) {
        target.value = `(${zip}) ${middle}`;
    } else if (input.length > 0) {
        target.value = `(${zip}`;
    }
};

$('#phonenumber').on('keydown', enforceFormat);
$('#phonenumber').on('keyup', formatToPhone);

$('#about-you').bind('input propertychange', function() {
    var aboutYouLength = $('#about-you').val().length;
    $('#about-you-length').text(aboutYouLength + '/255');
});

// ===================================== [END] ABOUT TAB CODE =======================


// ===================================== LOCATION TAB CODE =======================
var placeSearch, autocomplete;
var componentForm = {
    street_number: 'short_name',
    route: 'long_name',
    locality: 'long_name',
    administrative_area_level_1: 'short_name',
    country: 'long_name',
    postal_code: 'short_name'
};



// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
                center: geolocation,
                radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
        });
    }

    updateLocationNextBtn();
}

function initAutocomplete() {
    // Create the autocomplete object, restricting the search to geographical
    // location types.
    autocomplete = new google.maps.places.Autocomplete(
        /** @type {!HTMLInputElement} */
        (document.getElementById('autocomplete')), {
            types: ['geocode']
        });

    // When the user selects an address from the dropdown, populate the address
    // fields in the form.
    autocomplete.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
    // Get the place details from the autocomplete object.
    var place = autocomplete.getPlace();

    for (var component in componentForm) {
        document.getElementById(component).value = '';
        document.getElementById(component).disabled = false;
    }

    // Get each component of the address from the place details
    // and fill the corresponding field on the form.
    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
        }
    }

    updateLocationNextBtn();
}

$("#autocomplete").change(function() {
    updateLocationNextBtn();
});

function updateLocationNextBtn() {
    if ($('#route').val().length === 0) {
        $('#location-next').addClass('disabled');
    } else {
        $('#location-next').removeClass('disabled');
    }
}

// ===================================== [END] LOCATION TAB CODE =======================
