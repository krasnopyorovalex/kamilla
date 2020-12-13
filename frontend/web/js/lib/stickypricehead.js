(function($) {
  $.fn.stickypricehead = function(options) {
    var settings = $.extend( {
      'topMargin' : 0,
      'stickPrevP' : false,
      'offsetBlock' : '#header_content, .header_top',
      'widthType' : 'css' // false or 'width' or 'css'
    }, options);

    $(this).each(function(){
      var self = this;
      var origin = $(self).find('tr:first');
      var clone = origin.clone();
      var prev_p = $(this).prev().clone();
      var offset_block_height = updOffsetHeight(clone, prev_p);

      clone.css({
        "position"   : 'fixed',
        "z-index"    : '999',
        "top"        : offset_block_height + 'px',
        "margin-left": '-1px' // borders fix?
      });

      if (settings['stickPrevP']) {
        prev_p.css({
          "position" : 'fixed',
          "z-index" : 999,
          "background" : 'white',
          "width" : $(self).width() - 1 + 'px'
        })
      }

      updWidths(clone, origin, prev_p);

      clone.hide().prependTo(self);
      prev_p.hide().prependTo(self);

      $(window).scroll(function() {
        var countTop =  origin.offset().top - $(window).scrollTop() - offset_block_height;

        if(countTop > 0 || $(self).height() + countTop - 120 < 0) {
          clone.hide();
          if (settings['stickPrevP']) {
            prev_p.hide();
          }

        } else {
          clone.show();
          if (settings['stickPrevP']) {
            prev_p.show();
          }

          $(window).resize();
        }
      });

      $(window).resize(function (e) {
        offset_block_height = updOffsetHeight(clone, prev_p);
        updWidths(clone, origin, prev_p);
      })
    });

    function updOffsetHeight(clone, prev_p) {
      var offset_block_height = settings['topMargin'];
      $(settings['offsetBlock']).each(function () {
        offset_block_height += $(this).height()
      })

      if (settings['stickPrevP']) {
        prev_p.css({
          "top" : offset_block_height + 'px',
        })
        clone.css({
          "top" : offset_block_height + prev_p.height() +  'px',
        });

        return offset_block_height + prev_p.height();
      }

      clone.css({
        "top" : offset_block_height + 'px',
      });
      return offset_block_height;

    }

    function updWidths(clone, origin, prev_p) {
      var origin_th = origin.find('th');

      clone.width(origin.width() + 2);
      prev_p.width(origin.width() - 1);

      if (settings['widthType']) {
        clone.find('th').each(function (key) {
          if (settings['widthType'] == 'css') {
            $(this).css({width: $(origin_th[key]).css('width')});
          } else {
            $(this).width($(origin_th[key]).width());
          }
        });
      }
    }

    $(window).scroll();
  };
})(jQuery);