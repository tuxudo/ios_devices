<div id="ios_devices-tab"></div>
<h2 data-i18n="ios_devices.ios_devices"></h2>
<div id="ios_devices-msg" data-i18n="listing.loading" class="col-lg-12 text-center"></div>

<script>
$(document).on('appReady', function(){
    $.getJSON(appUrl + '/module/ios_devices/get_tab_data/' + serialNumber, function(data){
        // Set count of ios_devices
        $('#ios_devices-cnt').text(data.length);

        // Check if we have iOS Device data
        if (data.length == 0){
            $('#ios_devices-msg').text(i18n.t('no_data'));
        } else {

            // Hide loading message
            $('#ios_devices-msg').text('');

            var skipThese = ['id','serial_number','serial'];
            $.each(data, function(i,d){

                // Generate rows from data
                var rows = ''
                for (var prop in d){
                    // Skip skipThese
                    if(skipThese.indexOf(prop) == -1){
                        // Do nothing for empty values to blank them
                        if (d[prop] == '' || d[prop] == null){
                            rows = rows

                        // Format connected
                        } else if(prop == "connected"){
                            var date = new Date(d[prop] * 1000);
                            rows = rows + '<tr><th>'+i18n.t('ios_devices.'+prop)+'</th><td><span title="'+moment(date).fromNow()+'">'+moment(date).format('llll')+'</span></td></tr>';
                                                
                        // Else, build out rows from devices
                        } else {
                            rows = rows + '<tr><th>'+i18n.t('ios_devices.'+prop)+'</th><td>'+d[prop]+'</td></tr>';
                        }
                    }
                }

                if (d.device_class == "iPad"){
                    $('#ios_devices-tab')
                        .append($('<h4>')
                            .append($('<i>')
                                .addClass('fa fa-tablet'))
                            .append(' '+d.serial))
                        .append($('<div style="max-width:550px;">')
                            .append($('<table>')
                                .addClass('table table-striped table-condensed')
                                .append($('<tbody>')
                                    .append(rows))))
                } else if (d.device_class == "iPod"){
                    $('#ios_devices-tab')
                        .append($('<h4>')
                            .append($('<i>')
                                .addClass('fa fa-music'))
                            .append(' '+d.serial))
                        .append($('<div style="max-width:550px;">')
                            .append($('<table>')
                                .addClass('table table-striped table-condensed')
                                .append($('<tbody>')
                                    .append(rows))))
                } else {
                    $('#ios_devices-tab')
                        .append($('<h4>')
                            .append($('<i>')
                                .addClass('fa fa-mobile'))
                            .append(' '+d.serial))
                        .append($('<div style="max-width:550px;">')
                            .append($('<table>')
                                .addClass('table table-striped table-condensed')
                                .append($('<tbody>')
                                    .append(rows))))
                }
            })
        }
    });
});
</script>
