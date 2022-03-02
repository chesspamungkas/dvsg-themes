jQuery(function() {

    const FB_PAGE_NAME=jQuery('#fbName').val();
    const IG_USERNAME=jQuery('#igName').val();
    const FB_APP_ID=jQuery('#fbApp').val();
    let fbLink='';
    let igLink='';
    var md=new MobileDetect(window.navigator.userAgent);
    if(md.mobile()===null){
        fbLink='https://facebook.com/'+FB_PAGE_NAME;
        igLink='https://instagram.com/'+IG_USERNAME
    }
    else{
        if(md.os()==='iOS'){
            fbLink='fb://profile/'+FB_APP_ID
        }
        else{
            fbLink='fb://page/'+FB_APP_ID
        }
        igLink='instagram://user?username='+IG_USERNAME
    }
    jQuery('.fbLink').attr('href',fbLink);
    jQuery('.igLink').attr('href',igLink);
});