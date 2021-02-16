/*!
 * animate.css -http://daneden.me/animate
 * Version - 3.5.0
 * Licensed under the MIT license - http://opensource.org/licenses/MIT
 *
 * Copyright (c) 2016 Daniel Eden
 */
!function($){$.fn.extend({animateCss:function(n){var i="webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend";$(this).addClass("animated "+n).one(i,function(){$(this).removeClass("animated "+n)})}})}(jQuery);