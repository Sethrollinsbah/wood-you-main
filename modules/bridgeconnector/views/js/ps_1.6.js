/**
 *    This file is part of eMagicOne Store Manager Bridge Connector.
 *
 *   eMagicOne Store Manager Bridge Connector is free software: you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation, either version 3 of the License, or
 *   (at your option) any later version.
 *
 *   eMagicOne Store Manager Bridge Connector is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License
 *   along with eMagicOne Store Manager Bridge Connector.  If not, see <http://www.gnu.org/licenses/>.
 *
 *  @author    eMagicOne <contact@emagicone.com>
 *  @copyright 2014-2022 eMagicOne
 *  @license   http://www.gnu.org/licenses   GNU General Public License
 */

$(document).ready(function() {
    var mobassistantconnector_tracknum_message_lng_all_id = $('#mobassistantconnector_tracknum_message_lng_all').val();

    if (mobassistantconnector_tracknum_message_lng_all_id > 0) {
        $('#mobassistantconnector_tracknum_message_lng_all').attr('checked', 'checked');
        hideOtherLanguage(mobassistantconnector_tracknum_message_lng_all_id);
    }

    if ($('#mobassistantconnector_tracknum_message_lng_all').is(':checked')) {
        $('button[type="button"]').attr('disabled','disabled');
    }

    $('#mobassistantconnector_tracknum_message_lng_all'). click(function() {
        if ($(this).is(':checked')) {
            $(this).val(id_language);
            //$('button[type="button"]').attr('disabled', 'disabled');
            $('button[data-toggle="dropdown"]').attr('disabled', 'disabled');
        } else {
            //$('button[type="button"]').removeAttr('disabled');
            $('button[data-toggle="dropdown"]').removeAttr('disabled');
        }
    });

    // To avoid auto fill
    $('#bridgeconnector_password_fake').parent().parent().parent().hide();
});