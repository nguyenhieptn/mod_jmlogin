/* =========================================================
 * jm-modal.js v1.0
 * =========================================================
 * Copyright 2013 joomexp.com.
 * Author: Cong Nguyen
 * ========================================================= */
!(function ($) {
    var jmmodalobjects = [];
    var JmModal = function (element) {
        var $this = this;
        this.$element = $(element);
        $options = this.__parseOptions();

        var defaultVal = {
            width: 500,
            height: 400,
            top: 100,
            scroll: 'false',
            title: '',
            closeButton: 'true',
			tabheight: 265
        };
        this.isShow = false;
        this.$options = $.extend(defaultVal, $options);
        /*Make overlay element*/
        if(this.$options.title != '' || this.$options.closeButton == 'true'){
            var $modal_header = $('<div>').addClass('jm-modal-header');
            this.$element.find('.tab-outer').before($modal_header);
            if(this.$options.title != ''){
                $('<span>').addClass('jm-modal-title').text(this.$options.title).appendTo($modal_header);
            }
            if(this.$options.closeButton == 'true'){
                $('<a>').addClass('close').addClass('jm-modal-close').html('&times;').appendTo($modal_header);
            }
            $('<div>').css({clear:'both'}).appendTo($modal_header);
        }
        if(this.$options.scroll == 'true'){
            var $content = this.$element.find('.modal-body');
            var $scrollExt = $('<div class="scrollbar"/>')
                .append($('<div class="track"/>')
                .append($('<div class="thumb"/>')
                .append('<div class="end"/>')));
            $content.wrap('<div class="jm-scroll"/>');
            $content.before($scrollExt);
            $content.wrap('<div class="viewport"/>').wrap('<div class="overview"/>');
        }
        $(document).click(function(e){
			if(jQuery(e.target).parents('.jm-tab-content').length > 0) return;
			$this.hide();
		});
        $(window).resize(function(){$this.adjustposition();$this.updateScroll();});
        this.$element.find(".close").each(function(){$(this).click(function(){$this.hide()})});
    }

    JmModal.prototype = {
        constructor: JmModal,
        show: function (){
            var $height = this.$element.height();
			var $screen = $(window);
			var $offset = this.$element.parent().find('.btn-jm-group').offset();
			var $position = this.$element.parent().find('.btn-jm-group').position();
			if($offset.left<$screen.width()/2){
				$left=$position.left;
			}else{
				$left=$position.left-190;
			}
			this.adjustposition();
            var $this = this;
			this.isShow = true,
			this.$element.css({top:+$position.top+42+'px',left:+$left+'px',position:'absolute'});
			this.$element.slideDown(500,function(){
				$this.initScroll();
			});
        },
        hide: function(){
            this.isShow = false;
            var $height = this.$element.height();
			var $position = this.$element.parent().find('.btn-jm-group').position();
			this.$element.find('.overview').css({position:'absolute'});
            this.$element.slideUp(500,function(){
                $(this).css({display:'none',top:+$position.top+'px'});
				$('.arrow-up').css({display:'none'});
                if(!this.isShow){
                    this.isShow = false;
                }
            });
        },

        adjustposition: function(){
            var $screen = $(window);
			var $screen = $(window);
			var $offset = this.$element.parent().find('.btn-jm-group').offset();
			var $position = this.$element.parent().find('.btn-jm-group').position();
			if($offset.left<$screen.width()/2){
				$left=$position.left;
			}else{
				$left=$position.left-190;
			}
            var $elementwidth = this.$options.width;
            if($elementwidth >= $screen.width()){
                this.$element.width($screen.width() - 20);
            }else{
                this.$element.width(this.$options.width);
            }
            var $maxHeight = $screen.height() - this.$options.top - 30;
            if(this.$element.height() >= $maxHeight){
                this.$element.css({height:$maxHeight});
            }else{
                this.$element.css({height:this.$options.height});
            }
            this.$element.css({left:$left});
        },

        __parseOptions: function(){ 
            var options = {};
            options['width'] = this.$element.attr('modal-width');
            options['height'] = this.$element.attr('modal-height');
            options['top'] = this.$element.attr('modal-top');
            options['title'] = this.$element.attr('jm-modal-title');
            options['closeButton'] = this.$element.attr('modal-close');
            options['scroll'] = this.$element.attr('modal-scroll');
            options['tabheight'] = this.$element.attr('tabheight');
            return options;
        },

        initScroll: function(){
            if(this.$options.scroll != 'true') return;
            var $newHeight = this.$element.height() - this.$element.find('.jm-modal-header').height() - 60;
			this.$element.find('.viewport').css({height:$newHeight});
			$height_tab = this.$element.attr('tabheight');  
			if($height_tab>=$newHeight){
				this.$element.find('.overview').css({position:'absolute'});
				this.$element.find('.jm-scroll').tinyscrollbar();
			}else{
				this.$element.find('.jm-scroll').tinyscrollbar(false);
				this.$element.find('.overview').css({position:'static'});
			}
        },

        updateScroll: function(){
            if(this.$options.scroll != 'true') return;
            var $newHeight = this.$element.height() - this.$element.find('.jm-modal-header').height() - 60;
            this.$element.find('.viewport').css({height:$newHeight});
			$height_tab = this.$element.attr('tabheight');
			if($height_tab>=$newHeight){
				this.$element.find('.overview').css({position:'absolute'});
				this.$element.find('.jm-scroll').tinyscrollbar_update();
			}else{
				this.$element.find('.jm-scroll').tinyscrollbar(false);
				this.$element.find('.overview').css({position:'static'});
			}
        }
    }

    $.fn.JmModal = function ($opt) {
        return  this.each(function () {
            var $this = $(this);
            var $id = $this.attr('id');
            if(typeof(jmmodalobjects[$id]) == 'undefined'){
                var data = new JmModal(this);
                data[$opt]();
                jmmodalobjects[$id] = data;
            }else{
                jmmodalobjects[$id][$opt]();
            }
        });// end for each
    }; // end of functions
    //Call modal
    $(document).ready(function(){
        $('[data-toggle="jmmodal"]').click(function(){
			var $this = $(this);
			var tab =$this.attr('tab').toString();
			$('.jmtab_active').html($(tab).html());
			$height_tab = $('.jmtab_active').height();
			$('#jmmodal').attr('tabheight',$height_tab);
			var $tab_display = $(tab).css('display');
			var $modal_display = $('#jmmodal').css('display');
			if($tab_display == "block" && $modal_display == "block") {
				$($this.attr('href').toString()).JmModal('hide');
			}else{
				$($this.attr('href').toString()).JmModal('show');
			}
			return false; 
        });
		
    });
})(jQuery);