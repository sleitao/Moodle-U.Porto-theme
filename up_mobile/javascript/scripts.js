(function($) {
  $.fn.outerHTML = function() {
    return $(this).clone().wrap('<div></div>').parent().html();
  };
})(jQuery);

$(document).ready(function() {

	// Toggle lists
	(function () {
		// toggle course lists
		var topics = $('.topics .section, .weeks .section');
		//hide sides
		$('.weeks .side').remove();

		topics.each(function () {
		//	$('.summary, .section', this).hide();
		});

		//do something if section name is null
		topics.each(function () {
//			if ($('.sectionname, .weekdates', this).length === 0) {
//				$('.content', this).prepend('<h3 class="sectionname">Section Name</h3>');
//			}
		});

		// toggle sections visibility
		$('.topics .section .left').on('click', function () {
			if ($(this).parent().find('.content .summary').css('display') === 'none') {
				$(this).parent().find('.content').children().fadeIn();
			} else {
				$(this).parent().find('.content').children(':not(.sectionname)').fadeOut();
			}
		});

		topics.bind({
			mouseenter: function () {

			},
			mouseleave: function () {
			},
			click: function () {
				if ($('.summary, .section', this).css('display') === 'none') {
//					$('.summary, .section', this).slideDown().addClass('active');
				} else {
//					$('.summary, .section', this).slideUp().removeClass('active');
				}
			}
		});
	})();


	// ====== FORMS =====

	// change legend to placeholder
	var convertToPlaceholder = function (input) {
		input.each(function () {
			var placeholder = $(this).parents('.fitem').find('.fitemtitle label').remove();
			$(this).attr('placeholder', placeholder.text());
		});
	};

	convertToPlaceholder($('.mform input[type=text]'));
	convertToPlaceholder($('.mform textarea'));

	// more finger friendly checkboxs
	(function () {
		/*var checkbox = $('.fcheckbox').parent().addClass('checkbox');

		var text = checkbox.find('.fitemtitle');
		var check = checkbox.find('.fcheckbox input');

		checkbox.empty().append(check.outerHTML() + text.html());

		// check if checked
		$('.checkbox').on('click', function () {
			var checked = $('input', this).is(':checked');
			if (checked) {
				checkbox.addClass('checked');
			} else {
				checkbox.removeClass('checked');
			}
		});*/
	})();

	// ===== FORUMS =====
	(function () {
		//remove extra info
//		$('.path-mod-forum .region-content .groupselector').remove();
//		$('.path-mod-forum .region-content #intro.generalbox').remove();
		$('.path-mod-forum .region-content .discussioncontrols').remove();

		var forumpost = $('.forumpost');

		// remove "parent", "split" and split bars
		$('.forumpost .commands').each(function () {
			var a = $('a', this);
			if (a.length === 5 || a.length === 4) {
				$(a).eq(0).remove();
				$(a).eq(2).remove();
			}
			a = $('a', this);
			$(this).empty().append(a);
		});

/*		if ($('#page-mod-forum-discuss').length !== 0) {
			forumpost.each(function () {
				var content = $('.content', this).html();
				var commands = $('.commands', this);

				var showText = $(content).html().substring(0, 250);
				var hideText = $(content).html().substring(250);

				var moreButton = '<div class="more"><a href="">+</a></div>';

				if (hideText.length !== 0) {
					$('.content', this).html('<p>' + showText + ' ...</p>' + moreButton);
				} else {
					$('.content', this).html(content + moreButton);
				}

				var that = this;
				$('.more', this).on('click', function (ev) {
					ev.preventDefault();
					console.log(hideText);
					$('.content', that).fadeOut('fast', function () {
						$('.content', that).html(content).slideDown('slow', function () {
							$('.side', that).slideDown('medium');
						});

					});

				});
			});
			$('.forumpost .side').hide();
		}
*/
/*
		if ($('#page-mod-forum-discuss').length !== 0) {
			forumpost.each(function () {
				var content = $('.content .fullpost', this).html();
				var commands = $('.commands', this);

				var showText = $(content).text().substring(0, 250);
				var hideText = $(content).text().substring(250);

				var moreButton = '<div class="more"><a href="">+</a></div>';
				if (hideText.length !== 0) {
					$('.content .fullpost', this).html('<p>' + showText + ' ...</p>' + moreButton);
				} else {
					$('.content .fullpost', this).html(content + moreButton);
				}
				var that = this;
				$('.more', this).on('click', function (ev) {
					ev.preventDefault();
					$('.content .fullpost', that).fadeOut('fast', function () {
						$('.content .fullpost', that).html(content).slideDown('slow', function () {
							$('.side', that).slideDown('medium');
						});
					});
				});
			});
			$('.forumpost .side').hide();
		}
*/
	})();

	// ===== SIDEBAR ====
	(function () {
	$('#region-post .block .content').hide();
	$('#region-post .block .header').on('click', function () {
		var content = $(this).parent().find('.content');
		if (content.css('display') === 'none') {
			content.fadeIn();
		} else {
			content.fadeOut().slideUp('fast');
		}
	});
	})();


	// ===== MENU ======


//	toggle message menu
	$('.toggle > a').on('click', function (ev) {
		var newMessage = $('#newmessage a').html();

		if (newMessage !== '0') {
			var showOrHide = $(this).hasClass('active');
			if ( showOrHide !== true ) {
				$('#userinfo, #messages').fadeOut().prev().removeClass('active');
				$(this).next().fadeIn();
				$(this).addClass('active');
			} else if ( showOrHide !== false ) {
				$(this).next().fadeOut();
				$(this).removeClass('active');
			}
			return false;
		}
	});

	// remove menu
	$(document.body).on('click', function() {
		$('#messages, #userinfo').fadeOut().prev().removeClass('active');
	});

//end
});

//remove menu on click outsite menu
//$(document.body).bind('click', function() {
//	$('a.menu-parent').trigger('collapse');
//});
//$('#menu .level-1 .sub').bind('click', function(ev) {
//	ev.stopPropagation();
//});
//
// submenu
//$('#menu .sub .contains_branch ul').hide();
//$('#menu .sub .contains_branch .branch').click(function () {
//	$(this).next().toggle().parent().toggleClass('active-submenu');
//});