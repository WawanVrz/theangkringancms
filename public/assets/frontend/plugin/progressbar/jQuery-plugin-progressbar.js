(function($){$.fn.loading=function(){var DEFAULTS={backgroundColor:'#b3cef6',progressColor:'#4b86db',percent:0,amount:0,selisih:0,session:0,duration:2000};$(this).each(function(){var $target=$(this);var opts={backgroundColor:$target.data('color')?$target.data('color').split(',')[0]:DEFAULTS.backgroundColor,progressColor:$target.data('color')?$target.data('color').split(',')[1]:DEFAULTS.progressColor,percent:$target.data('percent')?$target.data('percent'):DEFAULTS.percent,amount:$target.data('amount')?$target.data('amount'):DEFAULTS.amount,selisih:$target.data('selisih')?$target.data('selisih'):DEFAULTS.selisih,session:$target.data('session')?$target.data('session'):DEFAULTS.session,duration:$target.data('duration')?$target.data('duration'):DEFAULTS.duration};opts.amount>=250?$target.append('<div class="background"></div><div class="rotate"></div><div class="left"></div><div class="right"></div><div class="secondlayer" style="background: #ffffff; height: 180px;width: 180px;"><span class="firstlayer" style="background: #284e76; height: 150px;width: 150px;left: 50%;top: 50%;font-size: 26px; line-height: 15px; display: flex;flex-direction: column; padding-top: 20px;">'+opts.amount+' \u20AC <p style="font-size: 13px; padding: 15px 25px;">Your total purchase</p></span></div>'):opts.session==1?$target.append('<div class="background"></div><div class="rotate"></div><div class="left"></div><div class="right"></div><div class="secondlayer" style="background: #ffffff; height: 180px;width: 180px;"><span class="firstlayer" style="background: #284e76; height: 150px;width: 150px;left: 50%;top: 50%;font-size: 26px; line-height: 15px; display: flex;flex-direction: column; padding-top: 20px;">'+opts.amount+' \u20AC <p style="font-size: 13px; padding: 15px 25px;">Your total purchase</p></span></div>'):$target.append('<div class="background"></div><div class="rotate"></div><div class="left"></div><div class="right"></div><div class="secondlayer" style="background: #ffffff; height: 180px;width: 180px;"><span class="firstlayer" style="background: #284e76; height: 150px;width: 150px;left: 50%;top: 50%;font-size: 26px; line-height: 15px; display: flex;flex-direction: column; padding-top: 20px;">'+opts.amount+' \u20AC <p style="font-size: 13px; padding: 15px 25px;">'+opts.selisih+' \u20AC more to get your benefit</p></span></div>'),$target.find('.background').css('background-color',opts.backgroundColor),$target.find('.left').css('background-color',opts.backgroundColor),$target.find('.rotate').css('background-color',opts.progressColor),$target.find('.right').css('background-color',opts.progressColor);var $rotate=$target.find('.rotate');if(setTimeout(function(){$rotate.css({transition:'transform '+opts.duration+'ms linear',transform:'rotate('+opts.percent*3.6+'deg)'});},1),opts.percent>50){var animationRight='toggle '+opts.duration/opts.percent*50+'ms step-end';var animationLeft='toggle '+opts.duration/opts.percent*50+'ms step-start';$target.find('.right').css({animation:animationRight,opacity:1}),$target.find('.left').css({animation:animationLeft,opacity:0});}});};}(jQuery));