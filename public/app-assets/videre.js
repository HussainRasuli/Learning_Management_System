// 
if (typeof Object.create !== "function") {
    Object.create = function (obj) {
        function F() {}
        F.prototype = obj;
        return new F();
    };
}

(function ($, window, document) {
	var dimensions = {
		2256: [2256	, 1269],
		1920: [1920	, 1080],
		1280: [1280	, 720],
		1024: [1024	, 576],
		768 : [768	, 432],
		512 : [512	, 288],
	}
		currentQuality = null;
		currentVolumeIcon = null;

	function kFormat ( num ) {
		if ( num >= 1000000 ) {
			return (num/1000000).toFixed(2) + 'M';
		}
		if ( num >= 100000 ) {
			return (num/1000).toFixed() + 'K';
		}
		if ( num >= 1000 ) {
			return (num/1000).toFixed(1) + 'K';
		}
		return num;
	};

	function pluralize ( string, count ) {
		return (count === 0 || count != 1) ? string + 's' : string;
	}

	var Video = {
		
		init : function (options, el) {
			var base = this;
				el = el[0];

            base.options = $.extend({}, $.fn.videre.options, options);

			if ($.inArray(base.options.dimensions, dimensions[base.options.dimensions]) === 0) {
				$('html head').append('<script src="public/app-assets/jquery-ui.js"></script>');
				base.wrapPlayer(el);
			} else {
				alert("Dimension isn't included in Videre");
			};

		},

		wrapPlayer : function (el) {
			var base = this;
				if (base.options.video.viewCount) {
					viewCount = kFormat(base.options.video.viewCount);
				} else {
					viewCount = ''
				}
				pluralizeView = pluralize('view', base.options.video.viewCount);
				template = $(
								'<div class="vid-html5">'+
									'<video src="'+base.options.video.quality[0].src+'" id="html-player" style="width: 50rem; height: 400px;"></video>'+
								'</div>'+
								'<div class="vid-toggle-layer"></div>'+
								'<div class="vid-shadow-layer"></div>'+
								'<div class="vid-info-layer">'+
									'<div class="vid-info-wrapper flex align-end">'+
										'<div class="main-info">'+
											'<p>You\'re watching</p>'+
											'<h1>'+base.options.video.title+'</h1>'+
										'</div>'+
										'<div class="view-count">'+
											(viewCount != '' ?('<h2>'+viewCount.toLocaleString()+' '+pluralizeView+'</h2>') : '')+
										'</div>'+
									'</div>'+
								'</div>'+
								'<div class="vid-controls-bottom flex align-center justify-center">'+
									'<div class="vid-controls-wrapper">'+
										'<div class="vid-controls-contents flex align-center justify-center">'+
											'<button class="vid-play-btn item"><i class="mdi mdi-play flex align-center"></i></button>'+
											'<div class="vid-volume-container flex align-center">'+
												'<button class="vid-volume-control item"><i class="mdi mdi-volume-high flex align-center"></i></button>'+
												'<div id="vol-control" class="vid-volume-slider"></div>'+
											'</div>'+
											'<span class="vid-current-time"></span>'+
											'<div class="vid-progress">'+
												'<div class="progress-bg"></div>'+
												'<div class="progress-loaded"></div>'+
												'<div class="progress-fg"></div>'+
												'<div class="progress-hovertime"></div>'+
											'</div>'+
											'<span class="vid-duration"></span>'+
											'<button class="vid-request-fullscreen item"><i class="mdi mdi-fullscreen flex align-center"></i></button>'+
										'</div>'+
									'</div>'+
								'</div>'+
								'<div class="vid-bottom-progress-bar">'+
									'<div class="progress-fg"></div>'+
								'</div>'
							);
			
			currentQuality = base.options.video.quality.indexOf(base.options.video.quality[0]);
			$(el).css('width', dimensions[base.options.dimensions][0]+'px');
			$(el).addClass('vid-wrapper videre-container mouse-entered');
			$(el).append(template);
			base.decodeMedia(el);
		},

		decodeMedia : function (el) {
			var base = this;
				media = document.getElementById('html-player');
				el = el;

			media.onloadedmetadata = function() {
				base.renderMediaData(el);
			};
			media.onwaiting = function() {
				// while video is waiting to load the next frame
			};
			media.onended = function() {
				// while video has ended
				$('.vid-wrapper').addClass('paused');
				$('.vid-play-btn').find('i').addClass('mdi-play').removeClass('mdi-pause');
			};
			media.oncanplaythrough = function() {
				// while video has loaded the next frame
			};

			// ondurationchange = Execute a function when the duration of a video has changed
		},

		renderMediaData : function(el) {
			var base = this;
				duration = base.toHHMMSS(media.duration);
				qualitySelectorTemplate = $('<div class="vid-quality-selector flex"></div>');

			for (let i = 0; base.options.video.quality.length > i; i++){
				var qualityArray = $(
										'<button data-index="'+i+'">'+base.options.video.quality[i].label+'</button>'
									);
				qualitySelectorTemplate.append(qualityArray);
			};

			media.volume = 0.5;

			$(el).append(qualitySelectorTemplate);
			$(el).find('.vid-duration').text(duration);

			setInterval(function(){
				base.renderProgress();
			}, 10);

			base.setControls();
			base.setQuality();
		},

		setQuality : function () {
			var base = this;

			$('.vid-quality-selector button').click(function(){
				var index = $(this).data('index');

				$('video').attr('src', base.options.video.quality[index].src);
				currentQuality = base.options.video.quality.indexOf(base.options.video.quality[index]);
				media.currentTime = base.options.currentTime;
				base.decodeMedia();
			});
			base.togglePlay();
			// set an active class for the current quality in buttons
			$('.vid-quality-selector button').removeClass();
			$('.vid-quality-selector button[data-index="'+currentQuality+'"]').addClass('active');
		},

		renderProgress : function ( ) {
			var base = this;
				currentTime = base.toHHMMSS(media.currentTime);

		 	base.options.currentTime = media.currentTime;
			$('.vid-current-time').text(currentTime);
			$('.progress-fg').css('width', (100 / media.duration) * media.currentTime+'%');
			if (media.duration)
				$('.progress-loaded').css('width', (100 / media.duration) * media.buffered.end(0)+'%');
		},

		setControls : function () {
			var base = this;

			$('.vid-play-btn').unbind().click(function(){
				console.log('clicked')
				base.togglePlay();
			});

			$('.vid-toggle-layer').unbind()

			$('.vid-toggle-layer').unbind().click(function(){
				base.togglePlay();
			}).dblclick(function(){
				if ( media.requestFullscreen ) {
					media.requestFullscreen();
				} else if ( media.mozRequestFullScreen ) {
					media.mozRequestFullScreen();
				} else if ( media.webkitRequestFullscreen ) {
					media.webkitRequestFullscreen();
				};
				base.isFullscreen();
			});

			$('.vid-request-fullscreen').unbind().click(function(){
				if ( media.requestFullscreen ) {
					media.requestFullscreen();
				} else if ( media.mozRequestFullScreen ) {
					media.mozRequestFullScreen();
				} else if ( media.webkitRequestFullscreen ) {
					media.webkitRequestFullscreen();
				};
				base.isFullscreen();
			});


			$('.vid-volume-control').unbind().mouseenter(function(){
				base.setVolume();
			}).click(function(){
				base.toggleVolumeMute($(this));
			});
            
            $('.vid-progress').unbind().on('click', function(e){
                var position = base.seek(e);
                media.currentTime = position.value;
            });

            $('.progress-bg').unbind().mousemove(function(e){
                
                var hoverX, startX, width, result, offset;
                hoverX = e.clientX;
                offset = $('.progress-fg').offset();
                width = $('.vid-progress').width();
                result = (  base.toHHMMSS(base.seek(e).value));

                $('.progress-hovertime').addClass('hover');

                $('.progress-hovertime').css('left', hoverX - offset.left + 'px');
                $('.progress-hovertime').text(result);
            
            }).unbind().mouseleave(function(){
                $('.progress-hovertime').removeClass('hover');
            });

			base.mouseMovement();
		},

		seek : function ( event ) {
            var offset = $('.progress-fg').offset();
                x = event.pageX - offset.left;
                y = event.pageY - offset.top;
                max = media.duration;
                value = x * max / $('.vid-progress').width();
            return {x: x, y: y, max: max, value: value};
		},

		toggleVolumeMute : function (element) {
			var base = this;

			if (media.volume != 0) {

				media.volume = 0;
				element.find('i').removeClass().addClass('mdi mdi-volume-off flex align-center');
				$('#vol-control').slider({value: 0});

			} else {

				if (currentVolumeIcon) {
					element.find('i').removeClass().addClass(currentVolumeIcon);
				} else {
					element.find('i').removeClass().addClass('mdi mdi-volume-high flex align-center');
				}
				media.volume = base.options.audio.volume / 100;
				$('#vol-control').slider({value: base.options.audio.volume});

			}
		},

		setVolume : function() {
			var base = this;

			$('#vol-control').css('width', '100px');
			$('#vol-control').slider({
			    min: 0,
			    max: 100,
			    value: media.volume === 0 ? 0 : base.options.audio.volume,
				range: "min",
				animate: false,
			    slide: function(event, ui) {
			      	media.volume = ui.value / 100;
			      	base.options.audio.volume = ui.value;
			      	if ( ui.value >= 50) {
			      		$('.vid-volume-control i').removeClass().addClass('mdi mdi-volume-high flex align-center');
			      		currentVolumeIcon = 'mdi mdi-volume-high flex align-center';
			      	} else if ( ui.value <= 50 ) {
			      		$('.vid-volume-control i').removeClass().addClass('mdi mdi-volume-medium flex align-center');
			      		currentVolumeIcon = 'mdi mdi-volume-medium flex align-center';
			      		if (ui.value === 0) {
			      			$('.vid-volume-control i').removeClass().addClass('mdi mdi-volume-mute flex align-center');
			      			currentVolumeIcon = 'mdi mdi-volume-mute flex align-center';
			      		}
			      	};
			    }
			});

			$('.vid-volume-container').mouseleave(function(){
				$('#vol-control').css('width', '0');
			});

		},

		mouseMovement : function () {
			var base = this;
				timeout = null;

			    clearTimeout(timeout);

		    timeout = setTimeout(function() {
		        // mouse is idle after 1.5s
		        base.toggleControls();
		    }, 2500);
			$(this).addClass('mouse-entered');
			$('.vid-wrapper').on('mousemove', function() {
			    clearTimeout(timeout);

			    timeout = setTimeout(function() {
			        // mouse is idle after 1.5s
			        base.toggleControls();
			    }, 2500);
				$(this).addClass('mouse-entered');
			}).mouseleave(function(){
			    clearTimeout(timeout);
			    timeout = setTimeout(function() {
			        // mouse is idle after 1.5s
			        base.toggleControls();
			    }, 2500);
			});;

		},

		toggleControls : function() {
			var base = this;
	        $('.vid-wrapper').removeClass('mouse-entered');
		},

		isFullscreen : function () {
			var base = this;
			if (!window.screenTop && !window.screenY) {
				$('.vid-wrapper').addClass('is-fullscreen');
				$('.vid-wrapper button.vid-request-fullscreen i').removeClass('mdi-fullscreen').addClass('mdi-fullscreen-exit')
				base.exitFullscreen();
			} else {
				// if not fullscreen
				$('.vid-wrapper button.vid-request-fullscreen i').addClass('mdi-fullscreen').removeClass('mdi-fullscreen-exit')
				$('.vid-wrapper').removeClass('is-fullscreen');
			};

		},

		exitFullscreen : function ( ) {
			$('.vid-request-fullscreen').click(function(){
		        if (media.exitFullscreen) {
		            media.exitFullscreen();
		        } else if (media.webkitExitFullscreen) {
		            media.webkitExitFullscreen();
		        } else if (media.mozCancelFullScreen) {
		            media.mozCancelFullScreen();
		        } else if (media.msExitFullscreen) {
		            media.msExitFullscreen();
		        };
			});
			$('.vid-toggle-layer').dblclick(function(){
		        if (media.exitFullscreen) {
		            media.exitFullscreen();
		        } else if (media.webkitExitFullscreen) {
		            media.webkitExitFullscreen();
		        } else if (media.mozCancelFullScreen) {
		            media.mozCancelFullScreen();
		        } else if (media.msExitFullscreen) {
		            media.msExitFullscreen();
		        };
			});
		},

		togglePlay : function() {
			var isPlaying = media.currentTime > 0 && !media.paused && !media.ended && media.readyState > 2;
			if (!isPlaying){
				media.play();

				$('.vid-wrapper').removeClass('paused');
				$('.vid-play-btn').find('i').removeClass('mdi-play').addClass('mdi-pause');
			} else {

				$('.vid-wrapper').addClass('paused').addClass('mouse-entered');
				$('.vid-play-btn').find('i').addClass('mdi-play').removeClass('mdi-pause');
				media.pause();
			}
		},

        toHHMMSS : function (time) {
        	var base = this;
            	m=~~(time/60), s=~~(time % 60);
            return (m<10?"0"+m:m)+':'+(s<10?"0"+s:s);
        }

	};

	$.fn.videre = function(options){
		return Video.init(options, $(this[0]));
	};

	// default options
	$.fn.videre.options = {
		video: {
			quality: [{
				label: null,
				src: null
			}],
			title: null,
			viewCount: null
		},
		currentTime: null,
		audio: {
			volume: 50
		},
		dimensions: {
			1920: [1920, 1080]
		},
		bottomProgressBar: true
	};


}(jQuery, window, document));
