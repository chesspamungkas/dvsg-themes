jQuery(document).ready(function($){
    $('#post_status').append('<option value="expired">Expired</option>');
    $('#expirationdate_expiretype').append('<option value="expired">Expired</option>');
    $('[id=expirationdate_expiretype] option').filter(function() { 
        return ($(this).text() == 'Expired'); 
    }).prop('selected', true);

    $('#enable-expirationdate').click (function ()
    {
        var thisCheck = $(this);
        if (thisCheck.is (':checked'))
        {
            $('[id=expirationdate_expiretype] option').filter(function() { 
                return ($(this).text() == 'Expired'); 
            }).prop('selected', true);
        }
        else
        {
            $("#post_status option[value='expired']").remove();
            $("#expirationdate_expiretype option[value='expired']").remove();
        }
    });
});