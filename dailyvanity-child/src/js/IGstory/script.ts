import * as Zuck from 'zuck.js'
var timestamp = function() {
  var timeIndex = 0;
  var shifts = [35, 60, 60 * 3, 60 * 60 * 2, 60 * 60 * 25, 60 * 60 * 24 * 4, 60 * 60 * 24 * 10];

  var now = new Date();
  var shift = shifts[timeIndex++] || 0;
  var date = new Date(now.getMilliseconds() - shift * 1000);

  return date.getTime() / 1000;
};

const currentIGSkin = {
  name: 'FaceSnap', 
  params: {
    avatars: true,
    list: false,
    autoFullScreen: true,
    cubeEffect: false,
    paginationArrows: true
  }
}
jQuery(function($) {
  const get = function (array, what) {
    if (array) {
      return array[what] || '';
    } else {
      return '';
    }
  };
  if($('.zuckContainer').length > 0) {
    $('.zuckContainer').each(function(index, ele) {
      console.log($(ele).data('json'))
      let stories = window[$(ele).data('json')]
      console.log(ele)

      new Zuck(ele, {
        backNative: true,
        previousTap: true,
        skin: currentIGSkin['name'],
        autoFullScreen: currentIGSkin['params']['autoFullScreen'],
        avatars: currentIGSkin['params']['avatars'],
        paginationArrows: currentIGSkin['params']['paginationArrows'],
        list: currentIGSkin['params']['list'],
        cubeEffect: currentIGSkin['params']['cubeEffect'],
        localStorage: true,
        stories: stories
      });
    })
    
  }
})


