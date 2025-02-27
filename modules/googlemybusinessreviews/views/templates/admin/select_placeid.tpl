{*
* 2020 AN Eshop Group
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0).
* It is available through the world-wide-web at this URL:
* https://opensource.org/licenses/osl-3.0.php
* If you are unable to obtain it through the world-wide-web, please send an email
* to contact@payplug.com so we can send you a copy immediately.
*
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PayPlug module to newer
 * versions in the future.
*
*  @author  AN Eshop Group
*  @copyright  2020 AN Eshop Group
*  @license   Private
*  AN Eshop Group
*}

{*<style>*}
{*    /* Always set the map height explicitly to define the size of the div*}
{*     * element that contains the map. */*}
{*    #map {*}
{*        height: 100%;*}
{*    }*}

{*    /* Optional: Makes the sample page fill the window. */*}
{*    #place-map-id {*}
{*        height: 500px;*}
{*        width: 100%;*}
{*        margin: 0;*}
{*        padding: 0;*}
{*    }*}

{*    .controls {*}
{*        background-color: #fff;*}
{*        border-radius: 2px;*}
{*        border: 1px solid transparent;*}
{*        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);*}
{*        box-sizing: border-box;*}
{*        font-family: Roboto;*}
{*        font-size: 15px;*}
{*        font-weight: 300;*}
{*        height: 29px;*}
{*        margin-left: 17px;*}
{*        margin-top: 10px;*}
{*        outline: none;*}
{*        padding: 0 11px 0 13px;*}
{*        text-overflow: ellipsis;*}
{*        width: 400px;*}
{*    }*}

{*    .controls:focus {*}
{*        border-color: #4d90fe;*}
{*    }*}

{*    .title {*}
{*        font-weight: bold;*}
{*    }*}

{*    #infowindow-content {*}
{*        display: none;*}
{*    }*}

{*    #map #infowindow-content {*}
{*        display: inline;*}
{*    }*}

{*</style>*}

{*<div id="place-map-id" class="panel kpi-container">*}
{*    <div style="display: none">*}
{*        <input id="pac-input"*}
{*               class="controls"*}
{*               type="text"*}
{*               placeholder="Enter a location">*}
{*    </div>*}
{*    <div id="map"></div>*}
{*    <div id="infowindow-content">*}
{*        <span id="place-name" class="title"></span><br>*}
{*        <strong>Place ID:</strong> <span id="place-id"></span><br>*}
{*        <span id="place-address"></span>*}
{*    </div>*}
{*</div>*}
{*{literal}*}
{*    <script>*}
{*        // This sample uses the Place Autocomplete widget to allow the user to search*}
{*        // for and select a place. The sample then displays an info window containing*}
{*        // the place ID and other information about the place that the user has*}
{*        // selected.*}

{*        // This example requires the Places library. Include the libraries=places*}
{*        // parameter when you first load the API. For example:*}
{*        // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">*}

{*        function initMap() {*}
{*            var map = new google.maps.Map(document.getElementById('map'), {*}
{*                center: {lat: -33.8688, lng: 151.2195},*}
{*                zoom: 13*}
{*            });*}

{*            var input = document.getElementById('pac-input');*}

{*            var autocomplete = new google.maps.places.Autocomplete(input);*}
{*            autocomplete.bindTo('bounds', map);*}

{*            // Specify just the place data fields that you need.*}
{*            autocomplete.setFields(['place_id', 'geometry', 'name']);*}

{*            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);*}

{*            var infowindow = new google.maps.InfoWindow();*}
{*            var infowindowContent = document.getElementById('infowindow-content');*}
{*            infowindow.setContent(infowindowContent);*}

{*            var marker = new google.maps.Marker({map: map});*}

{*            marker.addListener('click', function () {*}
{*                infowindow.open(map, marker);*}
{*            });*}

{*            autocomplete.addListener('place_changed', function () {*}
{*                infowindow.close();*}

{*                var place = autocomplete.getPlace();*}

{*                if (!place.geometry) {*}
{*                    return;*}
{*                }*}

{*                if (place.geometry.viewport) {*}
{*                    map.fitBounds(place.geometry.viewport);*}
{*                } else {*}
{*                    map.setCenter(place.geometry.location);*}
{*                    map.setZoom(17);*}
{*                }*}

{*                // Set the position of the marker using the place ID and location.*}
{*                marker.setPlace({*}
{*                    placeId: place.place_id,*}
{*                    location: place.geometry.location*}
{*                });*}

{*                marker.setVisible(true);*}

{*                infowindowContent.children['place-name'].textContent = place.name;*}
{*                infowindowContent.children['place-id'].textContent = place.place_id;*}
{*                infowindowContent.children['place-address'].textContent =*}
{*                    place.formatted_address;*}
{*                infowindow.open(map, marker);*}
{*            });*}
{*        }*}

{*    </script>*}
{*{/literal}*}
{*<script src="https://maps.googleapis.com/maps/api/js?key={$api_key}&libraries=places&callback=initMap"*}
{*        async defer></script>*}
