/**
 * ALAJAX auto sender for jQuery
 * Create an auto ajax sender from your basic HTML code.
 * @url http://www.freelancer-id.com/alajax
 * @version 1.0
 * CopyRight: GNU General Public License v2
 * 
 * Developed by: Alaa Badran
 * http://www.freelancer-id.com/
 * Email alaa@freelancer-id.com
 *
 */
$ = jQuery; // Make sure its defined

$.fn.alajax = function (){
    // sgObj is a holder for #gallery container.. Cashing it.
    var aObj = $(this); // contaciner object
    var aForm = ($(this).is('form') ? $(this):$(this).find('form').eq(0)); // Storing Form object
    var oid = $(this).attr('id'); // Storing the ID of current Object
    
    // Default settings.
    var settings = {
        postType: aForm.attr('method'), // Storing Form method.. POST or GET
        tourl: aForm.attr('action') // Storing URL to send data to
    };
    
    /**
     * This function prepares data to be sent to server as POST or GET.
     */
    function _values(){
        var values= {}; // creating Object
        // Get values from INPUT elements except Submit, Button or Image inputs.
        $.each($('#'+oid+' input[type!=submit][type!=button][type!=image], #'+oid+' textarea, #'+oid+' select'), function (index, obj){
            if($(obj)){
                if($(obj).attr('type')=='checkbox' || $(obj).attr('type')=='radio'){
                    if($(obj).is(':checked')){
                        oname = $(obj).attr('name');
                        values[oname] = $(obj).val();
                    }
                } else {
                    if($(obj).val() !=''){
                        oname = $(obj).attr('name');
                        values[oname] = $(obj).val();
                    }
                }
            }
        });
        // returning the values as object.
        return values;
    }
    
    
    function _sendData(){
        // Run AJAX function
        $.ajax({
            type: settings.postType,
            url: settings.tourl,
            data: _values(),
            dataType: 'text',
            beforeSend: function (){
                // add code here if you want to do something before sending the form
            },
            success: function(data, textStatus, jqXHR){
                // Add code here when send is successful.
                alert(data);
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert(errorThrown);
            }
            
        });
    }
    
    /**
     * The initializer for this plugin.
     */
    function _init(){
        aForm.submit(function (event){
            _sendData(); // Processing
            event.preventDefault(); // To disable form submitting. Submit will be by AJAX only using the function above.
        });
    }
    
    return _init();
}
// END of Plugin


$(window).load(function (){
    //$('#allContent').alajax();
    //$('#myForm').alajax();
    $('form').alajax();
});