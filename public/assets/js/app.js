(function($) {
    if ($('.sidebar-menu').length > 0) {
        var content           = $('.page-container'),
            sidebar           = $('.sidebar-menu'),
            mainMenu          = sidebar.find('.main-menu'),
            openbtn           = $('#open-button'),
            closebtn          = $('#close-button'),
            itemsWithSubmenu  = sidebar.find('li:not(.dropdown):has(ul)'),
            open              = false;

        mainMenu.find('> li').addClass('root-level');

        itemsWithSubmenu.each(function(i, el){
            var $this   = $(el),
                link    = $this.find('> a'),
                submenu = $this.find('> ul');

            if(submenu.find('li.active').length){
                $this.addClass('opened');
                submenu.addClass('visible');
            }

            link.on('click', function(ev) {
                ev.preventDefault();

                if($this.hasClass('root-level')) {
                    var closeSubmenus = mainMenu.find('.root-level').not($this).find('> ul');

                    closeSubmenus.each(function(i, el) {
                        var sub = $(el);

                        sub.parent().removeClass('opened');

                        TweenMax.to(sub, 0.5, {css: {height: 0, opacity: .2}, ease: Sine.easeInOut, onComplete: function() {
                            sub.removeClass('visible');
                        }});
                    });
                }

                if(!$this.hasClass('opened')) {
                    var currentHeight;

                    if(!submenu.is(':visible')) {
                        submenu.addClass('visible').height('');
                        currentHeight = submenu.outerHeight();

                        var propsFrom = {
                            opacity: .2,
                            height: 0,
                            top: -20
                        },
                        propsTo = {
                            height: currentHeight,
                            opacity: 1,
                            top: 0
                        };

                        TweenMax.set(submenu, {css: propsFrom});

                        $this.addClass('opened');

                        TweenMax.to(submenu, 0.25, {css: propsTo, ease: Sine.easeInOut, onComplete: function() {
                            submenu.attr('style', '');
                        }});
                    }
                } else {
                    $this.removeClass('opened');

                    TweenMax.to(submenu, 0.25, {css: {height: 0, opacity: .2}, ease: Sine.easeInOut, onComplete: function() {
                        submenu.removeClass('visible');
                    }});
                }
            });
        });

        $('#open-button, #close-button').off('click');
        $('#open-button, #close-button').off('touchend');
        $('html').off('click');

        this.eventtype = 'click';
        var open = false;

        openbtn[0].addEventListener(this.eventtype, function(ev) {
            if(open) {
                content.removeClass('show-menu');
                open = false;
            } else {
                content.addClass('show-menu');
                open = true;
            }
        });

        if(closebtn) {
            closebtn.on(this.eventtype, function(ev){
                content.removeClass('show-menu');
                open = false;
            });
        }

        document.addEventListener(this.eventtype, function(ev) {
            if(ev.target != openbtn[0]) {
                if(open && !hasParent(ev.target, sidebar[0])) {
                    bodyClickFn(this);
                }
            }
        });

        var bodyClickFn = function(el) {
            content.removeClass('show-menu');
            open = false;

            el.removeEventListener(this.eventtype, bodyClickFn );
        };
    }

    var resizeEventsTrigger = (function () {
        function triggerResizeStart($el) {
            console.log($el);
            $el.trigger('resizestart');
            isStart = !isStart;
        }

        function triggerResizeEnd($el) {
            clearTimeout(timeoutId);
            timeoutId = setTimeout(function () {
                $el.trigger('resizeend');
                isStart = !isStart;
            }, delay);
        }

        var isStart = true;
        var delay = 200;
        var timeoutId;

        return function ($el) {
            isStart ? triggerResizeStart($el) : triggerResizeEnd($el);
        };

    })();

    window.onresize = function () {
        resizeEventsTrigger($('.line-chart, .filter-container'));
    };

    if($('.custom-file-input').length > 0) {
        $('.custom-file-input').each(function() {
            var $input	 = $(this).find('input'),
                $label	 = $(this).find('label'),
                labelVal = $label.html();

            $input.on('change', function(e){
                var fileName = '';
                fileName = e.target.value.split('\\').pop();

                if(fileName)
                    $label.find('span').html(fileName);
                else
                    $label.html(labelVal);
            });

            // Firefox bug fix
            $input
                .on('focus', function(){ $input.addClass('has-focus'); })
                .on('blur', function(){ $input.removeClass('has-focus'); })
                .on('change', function(e){
                    $('#importData').submit();
                });
        });
    }

    if($('.custom-match-data').length > 0) {
        $('.custom-match-data').each(function() {
            var $input  = $(this).find('input'),
                $label  = $(this).find('label'),
                labelVal = $label.html();

            $input.on('change', function(e){
                var fileName = '';
                fileName = e.target.value.split('\\').pop();

                if(fileName)
                    $label.find('span').html(fileName);
                else
                    $label.html(labelVal);
            });

            // Firefox bug fix
            $input
                .on('focus', function(){ $input.addClass('has-focus'); })
                .on('blur', function(){ $input.removeClass('has-focus'); })
                .on('change', function(e){
                    $('#matchData').submit();
                });
        });
    }
    
    $('#match-offers-submit').click(function(e){
        e.preventDefault();
        var value = $('#match-offers').val();
            if(value){
                $('#matchOffers').submit();
            } else {
                alert('Va rugam selectati un fisier!');
            }
    });

    $('#match-vouchers-submit').click(function(e){
        e.preventDefault();
        var value = $('#import-vouchers').val();
        if(value){
            $('#importVouchers').submit();
        } else {
            alert('Va rugam selectati un fisier!');
        }
    });
    
    $(function(){
        $('#match-offers').change(function(){
            var filename = $(this).val();
            $('#offers_match').remove();
            $('<label id="offers_match" for="match-offers"><span>'+ filename +'</span><i class="fa fa-upload" aria-hidden="true"></i></label>').insertAfter($(this));
        });
    });

    $(function(){
        $('#import-vouchers').change(function(){
            var filename = $(this).val();
            $('#import_vouchers').remove();
            $('<label id="import_vouchers" for="import-vouchers"><span>'+ filename +'</span><i class="fa fa-upload" aria-hidden="true"></i></label>').insertAfter($(this));
        });
    });
    
    if ($('#online-users-chart').length > 0) {
        var lineOptions = {
            animation: {
                onComplete: function () {
                    var ctx = this.chart.ctx;
                    ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'bottom';

                    this.data.datasets.forEach(function (dataset) {
                        for (var i = 0; i < dataset.data.length; i++) {
                            var model = dataset._meta[0].data[i]._model;
                            ctx.fillText(dataset.data[i], model.x, model.y - 5);
                        }
                    });               
                }
            },
            legend : {
                display: false
            },
            scales: {
                type: 'logarithmic',
                gridLines: false
            }
        };
        
        var ctx = document.getElementById('online-users-chart').getContext('2d');
        var lineDemo = new Chart(ctx, {
            type: 'line',
            data: usersData,
            options: lineOptions
        });
    }

    if ($('.demographics-panel').length > 0) {
//        https://github.com/chartjs/Chart.js/issues/512

        var pieOptions = {
            title: {
                enabled: false
            },
            legend: {
                display: false
            },
            animation:{
                animateScale: true
            }
        };

        $('.demographics-panel canvas').each(function(index, el){
            var $this = $(el),
                id = $this.attr('id'),
                data = window[$this.data('set')];

            var ctx = document.getElementById(id).getContext('2d');

            var pieChart = new Chart(ctx, {
                type: 'pie',
                data: data,
                options: pieOptions
            });

            var legend = $('#' + id + 'Legend');

            legend.html(pieChart.generateLegend());
        });
    }
    
    if ($('#new-users-bar').length > 0){

        $('span#new-users-bar').peity('bar', {
            fill: ['#9473c5', '#6c5194'],
            width: 350,
            height: 40
        });

        $('.line-chart').on('resizeend', function () {

            $('span#new-users-bar').change();
        });
    }
    
    if ($('#total-products-bar').length > 0){
        $('span#total-products-bar').peity('bar', {
            fill: ['#9473c5', '#6c5194'],
            width: 350,
            height: 40
        });
        
        $('.line-chart').on('resizeend', function () {
            $('span#total-products-bar').change();
        });
    }
    
    if ($('select.custom-select').length > 0) {
        $('select.custom-select').select2({
            minimumResultsForSearch: Infinity
        });

        $('select.custom-select').each(function(i, el){
            var $this = $(el),
                opts = {
                    minimumResultsForSearch: attrDefault($this, 'search', Infinity),
                    allowClear: attrDefault($this, 'allowClear', false)
                };

            $this.select2(opts);
            $this.addClass('visible');

            //$this.select2("open");
        });
    }

    if ($('#reviewFilter').length > 0){
        $('#reviewFilter select').on('change', function(){
            $('#reviewFilter').submit();
        });
    }

    if ($('.dd').length > 0) {
        $('.dd').nestable({
            maxDepth: 1
        });
        
        $('.dd').on('change', function() {
            var data = JSON.stringify($('.dd').nestable('serialize'));
            
			var url = nestable_order_url;
			if ($(".dd").hasClass("js_app_menu_order")) {
				url = app_menu_order_url;
			}
			
            $.ajax({
                type: 'POST',
                url: url,
                data: {'order' : data},
                dataType: 'JSON',
                success: function(){}
            });
        });
    }

    $('.shop_id_vouchers').on('change', function() {
        var shop_id = $('.shop_id_vouchers').val();

        $.ajax({
            type: 'POST',
            url: shop_locations_options,
            data: {'shop_id' : shop_id},
            dataType: 'JSON',
            success: function(response){
                $('.location_id_vouchers').html(response);

                $('.location_id_vouchers').select2({
                    minimumResultsForSearch: Infinity
                });
            }
        });
    });

    $('.shop_location_city_id').on('change', function() {
        $("#address").prop('disabled', false); //When chaning the city, enable the address field until we set a new mall
        $.ajax({
            type: 'POST',
            url: centre_comerciale_in_oras,
            data: {'city_id' : $(this).val()},
            dataType: 'JSON',
            success: function(response){
                $('.shop_location_mall_id').html(response);

                $('.shop_location_mall_id').select2({
                    minimumResultsForSearch: Infinity
                });
            }
        });
    });

	//	Inline Edit BEGIN
	$('.inline-edit').inlineEdit('click');

	var inline_edit_id = 0,
		inline_edit_name = "",
		inline_edit_original_name = "",
		inline_edit_current_element = "";

	$("body").on("blur", ".inline-edit-input", function () {
		inline_edit_id	 = $(this).parent().data("id");
		inline_edit_name = $(this).val();
		inline_edit_original_name = $(this).parent().data("originalName");
		inline_edit_current_element = $(".menu_element_id_"+inline_edit_id);
		
		$('#confirmation-modal').modal('show');
	});
	
	$('#confirmation-modal').on('click', '#confirm-button', function (e) {
		$.ajax({
			type: 'POST',
			url: base_path+"/ajax/salveaza-nume-meniu",
			data: {'id' : inline_edit_id, 'name' : inline_edit_name},
			dataType: 'JSON',
			success: function(response){
				inline_edit_current_element.text(response.name);
			}
		});
	});
	
	$('#confirmation-modal').on('click', '.cancel-button', function (e) {
		inline_edit_current_element.text(inline_edit_original_name);
	});
	//	Inline Edit END
	
    if ($('.offer-switch').length > 0) {
        var loading = false;
        
        $('.offer-switch input').on('change', function(e){
            e.preventDefault();
            
            var $this = $(this),
                offerId = $this.data('id'),
                offerType = $this.data('type'),
                status;
            
            if(!loading) {
                loading = true;
                
                if($this.is(':checked')){
                    status = true;
                } else {
                    status = false;
                }

                $.ajax({
                    type: 'POST',
                    url: status_change_url,
                    data: {'id' : offerId, 'type' : offerType, 'status' : status},
                    dataType: 'JSON',
                    success: function(response){
                        loading = false;

                        if(response) {
                            if(status){
                                $this.prop('checked', true);
                                $this.addClass('checked');
                                
//                                if($this.parents('.dd-item')) {
//                                    $this.parents('.dd-item').removeClass('offer-disabled');
//                                }
                            } else {
                                $this.prop('checked', false);
                                $this.removeClass('checked');
                                
//                                if($this.parents('.dd-item')) {
//                                    $this.parents('.dd-item').addClass('offer-disabled');
//                                }
                            }
                        }
                    }
                });
            }
        });
    }
    
    if ($('.slider-switch').length > 0) {
        var loading = false;
        
        $('.slider-switch input').on('change', function(e){
            e.preventDefault();
            
            var $this = $(this),
                offerId = $this.data('id'),
                status;
            
            if(!loading) {
                loading = true;
                
                if($this.is(':checked')){
                    status = true;
                } else {
                    status = false;
                }

                $.ajax({
                    type: 'POST',
                    url: in_slider_change_url,
                    data: {'id' : offerId, 'status' : status},
                    dataType: 'JSON',
                    success: function(response){
                        loading = false;

                        if(response) {
                            if(status){
                                $this.prop('checked', true);
                                $this.addClass('checked');
                            } else {
                                $this.prop('checked', false);
                                $this.removeClass('checked');
                            }
                        }
                    }
                });
            }
        });
    }
    
    if ($('.shop-review-switch').length > 0) {
        var loading = false;
        
        $('.shop-review-switch input').on('change', function(e){
            e.preventDefault();
            
            var $this = $(this),
                offerId = $this.data('id'),
                offerType = $this.data('type'),
                status;
            
            if(!loading) {
                loading = true;
                
                if($this.is(':checked')){
                    status = true;
                } else {
                    status = false;
                }

                $.ajax({
                    type: 'POST',
                    url: status_change_url,
                    data: {'id' : offerId, 'type' : offerType, 'status' : status},
                    dataType: 'JSON',
                    success: function(response){
                        loading = false;

                        if(response) {
                            if(status){
                                $this.prop('checked', true);
                                $this.addClass('checked');
                            } else {
                                $this.prop('checked', false);
                                $this.removeClass('checked');
                            }
                        }
                    }
                });
            }
        });
    }
    
    if ($('.countdown').length > 0) {
        $('.countdown').each(function(index, el){
            var el       = $(el),
                deadline = el.data('to'),
                daysText = el.data('day');
            
            initializeClock(el, deadline, daysText);
        });
        
        function getTimeRemaining(endtime){
            var t = moment(endtime) - moment(new Date());
            
            var seconds = Math.floor( (t/1000) % 60 );
            var minutes = Math.floor( (t/1000/60) % 60 );
            var hours = Math.floor( (t/(1000*60*60)) % 24 );
            var days = Math.floor( t/(1000*60*60*24) );
            
            return {
              'total': t,
              'days': days,
              'hours': hours,
              'minutes': minutes,
              'seconds': seconds
            };
        }
        
        function initializeClock(element, endtime, text){
            var clock = element;
            var timeinterval = setInterval(function(){
                var t = getTimeRemaining(endtime);
                
                if(t.total < 0) {
                    clock.html('0 ' + text);
                } else {
                    clock.html(t.days + ' ' + text + ', '+ t.hours + ':' + t.minutes + ':' + t.seconds);
                }
                    
                if(t.total<=0){
                    clearInterval(timeinterval);
                }
            },1000);
        }
    }
    
    if ($('#filters').length > 0) {
        if($('.filter-container.open').length > 0){
            var contentHeight = $('.filter-container.open').find('form').outerHeight() + 80;
            $('.filter-container').css('height', contentHeight);
        }
        
        $('.filter-container').on('resizeend', function () {
            if($('.filter-container.open').length > 0){
                var contentHeight = $('.filter-container.open').find('form').outerHeight() + 80;
                $('.filter-container').css('height', contentHeight);
            }
        });
        
        $(document).on('click','.btn-toggle-filter', function(){
            var container = $('.filter-container');
            var contentHeight = container.find('form').outerHeight() + 80;
            var status = container.attr('data-status');
            
            if(!status){
                status = 'opened';
            }
            
            doAnimation(container, contentHeight, status);
        });

        function doAnimation(container, contentHeight, filterStatus){
            var toggler = $('.btn.btn-toggle-filter');
            
            if(filterStatus === 'opened'){
                container.removeClass('open');
                container.attr('style', 'height: 42px;');
                toggleArrow(toggler, "up");
                container.attr('data-status', 'closed');
            } else {
                container.addClass('open');
                toggleArrow(toggler, "down");
                container.attr('style', 'height:' + contentHeight + 'px');
                container.attr('data-status', 'opened');
            }
        }

        function toggleArrow(toggler, direction){
            if(direction=="up"){
                $(toggler).children(".fa-chevron-down").css('display', 'inline-block');
                $(toggler).children(".fa-chevron-up").css('display', 'none');
            } else {
                $(toggler).children(".fa-chevron-up").css('display', 'inline-block');
                $(toggler).children(".fa-chevron-down").css('display', 'none');
            }
        }
    }

    if($('#standard-add-to-feed').length > 0) {
        $('#standard-add-to-feed').on('change', function(e){
            var $this = $(this),
                addImage = $(this).parents('.form-right').find('.add-image');

            if($this.is(':checked')){
                addImage.removeClass('not-available');
            } else {
                addImage.addClass('not-available');
            }
        });
    }

    $(document).ready(function(){
        if ($('.login-container').length > 0) {
            var loginContainer = $('.login-container'),
                focusSet = false;

            setTimeout(function(){
                loginContainer.addClass('init')

                setTimeout(function() {

                    if(!focusSet) {
                        loginContainer.find('form input:first').focus();
                        focusSet = true;
                    }
                }, 550);
            }, 0);
        }

        $('body').addClass('has-js');
        setupLabel();

        $('body').on('click', '.custom-check, .custom-radio', function(){
            setupLabel();
        });

        $('.fileinput').fileinput();

        $('textarea.limited-characters').characterCounter(256);
        $('textarea.notification-characters').characterCounter(50);

        function setupLabel() {
            if ($('.custom-radio input').length) {
                $('.custom-radio').each(function(){
                    $(this).removeClass('r_on');
                });
                $('.custom-radio input:checked').each(function(){
                    $(this).parent('label').addClass('r_on');
                });
            };
            if ($('.custom-check input').length) {
                $('.custom-check').each(function(){
                    $(this).removeClass('c_on');
                });
                $('.custom-check input:checked').each(function(){
                    $(this).parent('label').addClass('c_on');
                });
            };
        };

        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('input[name="_token"]').val()
            }
        });

        jQuery.fn.resetForm = function () {
            var $form = $(this);

            $form.find('input:text, input:password, input:file, textarea').val('');
            $form.find('select option:selected').removeAttr('selected');
            $form.find('input:checkbox, input:radio').removeAttr('checked');
            $form.find('.custom-check, .custom-radio').removeClass('c_on r_on');

            return this;
        };

        $(function () {
            if($(".datepicker").length > 0){
                $(".datepicker").datetimepicker({
                    format: "DD/MM/Y",
                    ignoreReadonly: true,
                    allowInputToggle: true,
                    widgetPositioning: {
                        vertical: "bottom"
                    }
                });
            }

            if($(".datepicker-max-date").length > 0){
                $(".datepicker-max-date").datetimepicker({
                    format: "DD/MM/Y",
                    maxDate: moment(),
                    ignoreReadonly: true,
                    allowInputToggle: true,
                    widgetPositioning: {
                        vertical: "bottom"
                    }
                });
            }

            if($(".daterange").length > 0){
                $(".daterange").daterangepicker({
                    timePicker: false,
                    opens: 'right',
                    drops: 'down',
                    autoUpdateInput: false,
                    locale: {
                        format: 'DD/MM/Y',
                        applyLabel: "Aplică",
                        cancelLabel: "Renunță"
                    }
                });

                $('.daterange').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('DD/MM/Y') + ' - ' + picker.endDate.format('DD/MM/Y'));
                });

                $('.daterange').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                });
            }

            if($('#filters').length > 0) {
                if($('#datetime_starts_at input').val() !== '' && $('#datetime_ends_at input').val() !== ''){
                    minDate = moment($('#datetime_starts_at input').val(), 'DD/MM/Y HH:mm');
                    maxDate = moment($('#datetime_ends_at input').val(), 'DD/MM/Y HH:mm');

                    // minDate: minDate,
                    // maxDate: maxDate,
                    $('#datetime_starts_at').datetimepicker({
                        format: 'DD/MM/Y HH:mm',
                        ignoreReadonly: true,
                        sideBySide: true,
                        allowInputToggle: true,
                        widgetPositioning: {
                            vertical: "bottom"
                        }
                    });
                    // minDate: minDate,

                    $('#datetime_ends_at').datetimepicker({
                        format: 'DD/MM/Y HH:mm',
                        ignoreReadonly: true,
                        sideBySide: true,
                        allowInputToggle: true,
                        widgetPositioning: {
                            vertical: "bottom"
                        }
                    });
                } else {
                    $('#datetime_starts_at').datetimepicker({
                        format: 'DD/MM/Y HH:mm',
                        ignoreReadonly: true,
                        sideBySide: true,
                        allowInputToggle: true,
                        widgetPositioning: {
                            vertical: "bottom"
                        }
                    });

                    $('#datetime_ends_at').datetimepicker({
                        format: 'DD/MM/Y HH:mm',
                        ignoreReadonly: true,
                        sideBySide: true,
                        allowInputToggle: true,
                        widgetPositioning: {
                            vertical: "bottom"
                        }
                    });
                }

                $("#datetime_starts_at").on("dp.change", function (e) {
                    // $('#datetime_ends_at').data("DateTimePicker").minDate(e.date);
                });

                $("#datetime_ends_at").on("dp.change", function (e) {
                    // $('#datetime_starts_at').data("DateTimePicker").maxDate(e.date);
                });
            } else {
                if($('#datetime_starts_at').length > 0 && $('#datetime_ends_at').length > 0){
                    var minDate,
                        maxDate;

                    if($('#datetime_starts_at input').val() !== '' && $('#datetime_ends_at input').val() !== ''){
                        minDate = moment($('#datetime_starts_at input').val(), 'DD/MM/Y HH:mm');
                        maxDate = moment($('#datetime_ends_at input').val(), 'DD/MM/Y HH:mm');

                        // minDate: minDate,
                        // maxDate: maxDate,
                        $('#datetime_starts_at').datetimepicker({
                            format: 'DD/MM/Y HH:mm',
                            ignoreReadonly: true,
                            sideBySide: true,
                            allowInputToggle: true,
                            widgetPositioning: {
                                vertical: "bottom"
                            }
                        });

                        $('#datetime_ends_at').datetimepicker({
                            format: 'DD/MM/Y HH:mm',
                            ignoreReadonly: true,
                            sideBySide: true,
                            allowInputToggle: true,
                            widgetPositioning: {
                                vertical: "bottom"
                            }
                        });
                    } else {
                        $('#datetime_starts_at').datetimepicker({
                            format: 'DD/MM/Y HH:mm',
                            ignoreReadonly: true,
                            sideBySide: true,
                            allowInputToggle: true,
                            widgetPositioning: {
                                vertical: "bottom"
                            }
                        });

                        $('#datetime_ends_at').datetimepicker({
                            format: 'DD/MM/Y HH:mm',
                            ignoreReadonly: true,
                            sideBySide: true,
                            allowInputToggle: true,
                            widgetPositioning: {
                                vertical: "bottom"
                            }
                        });
                    }
                }

                $("#datetime_starts_at").on("dp.change", function (e) {
                    if (e.date > moment()) {
                        // $('#datetime_ends_at').data("DateTimePicker").minDate(e.date);
                    } else {
                        // $('#datetime_ends_at').data("DateTimePicker").minDate(moment());
                    }
                });

                $("#datetime_ends_at").on("dp.change", function (e) {
                    if(!$("#datetime_starts_at input").val()) {
                        // $('#datetime_starts_at').data("DateTimePicker").maxDate(e.date);
                    }
                });
            }

            $('.validationEngine').each(function (i, obj) {
                $(obj).validationEngine('attach', {promptPosition: "topLeft", scroll: false});
            });

            if ($('#shop-form').length > 0) {
                $('input[name="online_shop"]').on('change', function(){
                    var $this = $(this);

                    if ($this.is(':checked') && $this.prop('id') == 'yes') {
                        // $('input[name="website"]').removeClass('validate[custom[url]]').addClass('validate[required, custom[url]]');
                        $('input[name="website"]').addClass('validate[required]');
                    } else {
                        // $('input[name="website"]').removeClass('validate[required, custom[url]]').addClass('validate[custom[url]]');
                        $('input[name="website"]').removeClass('validate[required]');
                    }
                });
            }

			$('.flexslider').flexslider({
			   animation: "slide",
			   controlNav: false
			});

            $('.notification').show().delay(5000).fadeOut();

            $("#resetFilters").on("click", function () {
                $('#FiltersForm').resetForm();
                $('select.custom-select').trigger('change.select2');
            });

            $(".reset-date-picker").on("click", function (e) {
                e.preventDefault();
                $(this).parent().find(".date-picker-input, .daterange").val('');
                $('#datetime_starts_at').data("DateTimePicker").minDate(moment().subtract(30, 'years'));
                $('#datetime_starts_at').data("DateTimePicker").maxDate(moment().add(50, 'years'));

                $('#datetime_ends_at').data("DateTimePicker").minDate(moment().subtract(30, 'years'));
                $('#datetime_ends_at').data("DateTimePicker").maxDate(moment().add(50, 'years'));
            });
        });

        $('[data-toggle="tooltip"]').tooltip();

        /*---------- Google maps -------------*/

        if($('#gmap_canvas').length > 0){
            var mapPage = $('#gmap_canvas').data('map-page');

            $("body").on("change", ".js-find-mall-location", function(){
                var idMall = $('#mall_id').val();
                $('#address').prop('disabled', false);  //Default address should be enabled.
                $.ajax({
                    url: base_path + "/locatii-magazine/locatie-centru-comercial",
                    data: {"mall_id" : idMall},
                    method: "GET",
                    success: function (response) {
                        if (response) {
                            var res = $.parseJSON(response);

                            $('#city').val(res.mall_info.city_id);
                            $('#address').val(res.mall_info.address);
                            //Disable the addres so can't be changed.
                            $('#address').prop('disabled', true);
                            $('#latitude').val(res.mall_info.lat);
                            $('#longitude').val(res.mall_info.lng);

                            $('#select2-city-container').text(res.city_info.name);
                            $('#select2-city-container').attr("title", res.city_info.name);

                            initializeWithCity($('#city option:selected').text());
                            reloadShopLocationFormMap();
                        }
                    }
                });
            });

            if(mapPage === 'city') {
                google.maps.event.addDomListener(window, 'load', initializeCityFormMap);

                $('#city').change(function(){
                    reloadCityFormMap();
                });

                $('#county').change(function(){
                    initializeWithCounty($('#county option:selected').text());
                });
            } else if (mapPage === 'shop-location') {
                google.maps.event.addDomListener(window, 'load', initialize);

                $('#address').change(function(){
                    reloadShopLocationFormMap();
                });
                $('#city').change(function(){
                    initializeWithCity($('#city option:selected').text());
                });
                $('#name').change(function(){
                    reloadShopLocationFormMap();
                });
            } else if (mapPage === 'shop-details') {
				google.maps.event.addDomListener(window, 'load', initializeShopDetailsMap);

				var shop_id = $("#shop_id").val();

				if (shop_id !== 'undefined') {
						$.ajax({
						type: "POST",
						url: shop_locations_geodata_url,
						data: {'shop_id' : shop_id},
						dataType: 'JSON'
					}).done(function( data ) {
						if(data){
							removeMarkers();
							markers = data;
							initializeShopLocationsMap();
						}
					});
				}
			} else {
                google.maps.event.addDomListener(window, 'load', initialize);

                $('#address').change(function(){
                        reloadMallFormMap();
                });
                $('#city').change(function(){
                        initializeWithCity($('#city option:selected').text());
                });
                $('#name').change(function(){
                        reloadMallFormMap();
                });
            }

            var geocoder;
            var map;
            var marker;
            var gmarkers = [];
            var infoWindow = new google.maps.InfoWindow;
            var markers = [];

            function initialize() {
                var latitudine = $('#latitude').val();
                var longitudine = $('#longitude').val();
                var setMarkerInit = true;
                var mapOptions = {};
                mapOptions['zoom'] = 15;

                if ((latitudine == "") && (longitudine == "")) {
                    latitudine = 45.9432;
                    longitudine = 24.9668;
                    setMarkerInit = false;
                    mapOptions['zoom'] = 6;
                }

                geocoder = new google.maps.Geocoder();
                var latlng = new google.maps.LatLng(latitudine, longitudine);

                mapOptions['center'] = latlng;

                $('#gmap_canvas').show();
                map = new google.maps.Map(document.getElementById('gmap_canvas'), mapOptions);

                if (setMarkerInit == true) {
                    placeMarker(latlng);
                }

                google.maps.event.addListener(map, 'click', function (event) {
                    placeMarker(event.latLng);
                });
            }

            function initializeShopDetailsMap() {
                var latitudine = 45.9432;
                var longitudine = 24.9668;
                var setMarkerInit = false;
                var latlng = new google.maps.LatLng(latitudine, longitudine);
                var mapOptions = {
                    zoom: 6,
                    center: latlng
                };

                geocoder = new google.maps.Geocoder();

                $('#gmap_canvas').show();
                map = new google.maps.Map(document.getElementById('gmap_canvas'), mapOptions);
            }

            function placeMarker(location) {
                if (marker) {
                    marker.setPosition(location);
                    populateInputs(location);
                } else {
                    marker = new google.maps.Marker({
                        position: location,
                        map: map,
                        draggable: true
                    });
                    google.maps.event.addListener(marker, "dragend", function (mEvent) {
                        populateInputs(mEvent.latLng);
                    });
                }
                populateInputs(location);
            }

            function initializeShopLocationsMap(){
                var i;
                for (i = 0; i < markers.length; i++) {
                    var latlng = new google.maps.LatLng(markers[i]['lat'], markers[i]['lng']);
                    marker = new google.maps.Marker({
                        position: latlng,
                        map: map
                    });
                    gmarkers.push(marker);

                    google.maps.event.addListener(marker, 'click', (function(marker, i) {
                        return function() {
                            var content_info = '<div class="gm_info"><div class="gm_title">'+markers[i]['name'];
                            if (markers[i]['address'] !== '') {
                                content_info = content_info + '</div><p><strong>Adresa: </strong>'+markers[i]['address'];
                            }
                            if (markers[i]['email'] !== '') {
                                content_info = content_info + '</div><p><strong>E-mail: </strong>'+markers[i]['email'];
                            }
                            if (markers[i]['phone'] !== '') {
                                content_info = content_info + '</div><p><strong>Telefon: </strong>'+markers[i]['phone'];
                            }

                            infowindow = new google.maps.InfoWindow({
                                content: content_info
                            });
                            infowindow.open(map, marker);
                        }
                    })(marker, i));
                }
            }

            function removeMarkers(){
                var i;
                for(i=0; i<gmarkers.length; i++){
                    gmarkers[i].setMap(null);
                }
            }

            function populateInputs(pos) {
                document.getElementById("latitude").value = pos.lat();
                document.getElementById("longitude").value = pos.lng();
            }

            function initializeCityFormMap() {
                var latitudine = $('#latitude').val();
                var longitudine = $('#longitude').val();
                var setMarkerInit = true;
                var mapOptions = {};
                mapOptions['zoom'] = 12;

                if ((latitudine == "") && (longitudine == "")) {
                    latitudine = 45.9432;
                    longitudine = 24.9668;
                    setMarkerInit = false;
                    mapOptions['zoom'] = 6;
                }

                geocoder = new google.maps.Geocoder();
                var latlng = new google.maps.LatLng(latitudine, longitudine);

                mapOptions['center'] = latlng;

                $('#gmap_canvas').show();
                map = new google.maps.Map(document.getElementById('gmap_canvas'), mapOptions);

                if (setMarkerInit == true) {
                    placeMarker(latlng);
                }

                google.maps.event.addListener(map, 'click', function (event) {
                    placeMarker(event.latLng);
                });
            }

            function initializeWithCounty(county) {
                var city = $('#city').val();
                var mapDiv = document.getElementById('gmap_canvas');
                var map;
                var address = city + ", " + county + ", Romania";
                var geocoder = new google.maps.Geocoder();
                // Get LatLng information by name
                geocoder.geocode({
                    "address": address
                }, function (results, status) {
                    map = new google.maps.Map(mapDiv, {
                        // Center map (but check status of geocoder)
                        center: results[0].geometry.location,
                        zoom: 9,
                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                        setMarkerInit: true
                    });

                    google.maps.event.addListener(map, 'click', function (event) {
                        placeMarker(event.latLng);
                    });

                    marker = new google.maps.Marker({
                        position: results[0].geometry.location,
                        map: map,
                        draggable: true
                    });

                    populateInputs(results[0].geometry.location);
                });
            }

            function initializeWithCity(city) {
                var adresa = $('#address').val();
                var mapDiv = document.getElementById('gmap_canvas');
                var map;
                var address = adresa + ", " + city + ", Romania";
                var geocoder = new google.maps.Geocoder();
                // Get LatLng information by name
                geocoder.geocode({
                    "address": address
                }, function (results, status) {
                    if(results[0]) {
                        map = new google.maps.Map(mapDiv, {
                            // Center map (but check status of geocoder)
                            center: results[0].geometry.location,
                            zoom: 14,
                            mapTypeId: google.maps.MapTypeId.ROADMAP,
                            setMarkerInit: true
                        });


                        google.maps.event.addListener(map, 'click', function (event) {
                            placeMarker(event.latLng);
                        });

                        marker = new google.maps.Marker({
                            position: results[0].geometry.location,
                            map: map,
                            draggable: true
                        });

                        populateInputs(results[0].geometry.location);
                    }
                });
            }

            function reloadCityFormMap() {
                var judet = $('#county option:selected').text();
                var oras = $('#city').val();

                $('#city').change(function () {
                    oras = $('#city').val();
                });

                $('#county').change(function () {
                    judet = $('#county option:selected').text();
                });

                $('#gmap_canvas').hide();

                var geocoder;
                var pozitie;
                var map;

                $('#gmap_canvas').show();

                geocoder = new google.maps.Geocoder();

                if ($('#city').val() !== "") {
                    geocoder.geocode({'address': oras + ',' + judet}, function (results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            pozitie = results[0].geometry.location;
                            populateInputs(pozitie);

                            var myOptions = {
                                zoom: 15,
                                center: new google.maps.LatLng(pozitie.lat(), pozitie.lng()),
                                mapTypeId: google.maps.MapTypeId.ROADMAP,
                                disableDefaultUI: true
                            };

                            map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);

                            google.maps.event.addListener(map, 'click', function (event) {
                                placeMarker(event.latLng);
                            });

                            marker = new google.maps.Marker({
                                position: pozitie,
                                map: map,
                                draggable: true
                            });

                            google.maps.event.addListener(marker, "dragend", function (mEvent) {
                                populateInputs(mEvent.latLng);
                            });

                            placeMarker(pozitie);

                            google.maps.event.addListener(
                                marker,
                                "click"
                            );
                        } else {
                            console.log('Geocode was not successful for the following reason: ' + status);
                        }
                    });
                }
            }

            function reloadShopLocationFormMap() {
                var adresa = $('#address').val();
                var nume = $('#name').val();
                var oras = $('#city option:selected').text();

                $('#address').change(function () {
                    adresa = $('#address').val();
                });

                $('#name').change(function () {
                    nume =  $('#name').val();
                });

                $('#city').change(function () {
                    oras = $('#city option:selected').text();
                });

                $('#gmap_canvas').hide();

                var geocoder;
                var pozitie;
                var map;

                var continut = "<span style='height:auto !important; display:block; white-space:nowrap; overflow:hidden !important;'><strong style='font-weight:400;'>" + nume + "</strong><br/></span>";

                $('#gmap_canvas').show();

                geocoder = new google.maps.Geocoder();

                if ($('#address').val() !== "") {
                    geocoder.geocode({'address': adresa + ',' + oras}, function (results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            pozitie = results[0].geometry.location;
                            populateInputs(pozitie);
                            var myOptions = {
                                zoom: 15,
                                center: new google.maps.LatLng(pozitie.lat(), pozitie.lng()),
                                mapTypeId: google.maps.MapTypeId.ROADMAP,
                                disableDefaultUI: true
                            };
                            map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);
                            google.maps.event.addListener(map, 'click', function (event) {
                                placeMarker(event.latLng);
                            });
                            marker = new google.maps.Marker({
                                position: pozitie,
                                map: map,
                                draggable: true
                            });
                            google.maps.event.addListener(marker, "dragend", function (mEvent) {
                                populateInputs(mEvent.latLng);
                            });
                            placeMarker(pozitie);
                            infowindow = new google.maps.InfoWindow({content: continut});
                            google.maps.event.addListener(
                                marker,
                                "click",
                                function () {
                                    infowindow.open(map, marker);
                                }
                            );
                            infowindow.open(map, marker);
                        } else {
                            console.log('Geocode was not successful for the following reason: ' + status);
                        }
                    });
                }
            }

            function reloadMallFormMap() {
                var adresa = $('#address').val();
                var nume = $('#name').val();
                var oras = $('#city option:selected').text();

                $('#address').change(function () {
                    adresa = $('#address').val();
                });

                $('#name').change(function () {
                    nume = $('#name').val();
                });

                $('#city').change(function () {
                    oras = $('#city option:selected').text();
                });

                $('#gmap_canvas').hide();

                var geocoder;
                var pozitie;
                var map;

                var continut = "<span style='height:auto !important; display:block; white-space:nowrap; overflow:hidden !important;'><strong style='font-weight:400;'>" + nume + "</strong><br/></span>";

                $('#gmap_canvas').show();
                geocoder = new google.maps.Geocoder();

                if ($('#address').val() !== "") {
                    geocoder.geocode({'address': adresa + ',' + oras}, function (results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            pozitie = results[0].geometry.location;
                            populateInputs(pozitie);

                            var myOptions = {
                                zoom: 15,
                                center: new google.maps.LatLng(pozitie.lat(), pozitie.lng()),
                                mapTypeId: google.maps.MapTypeId.ROADMAP,
                                disableDefaultUI: true
                            };

                            map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);
                            google.maps.event.addListener(map, 'click', function (event) {
                                placeMarker(event.latLng);
                            });

                            marker = new google.maps.Marker({
                                position: pozitie,
                                map: map,
                                draggable: true
                            });

                            google.maps.event.addListener(marker, "dragend", function (mEvent) {
                                populateInputs(mEvent.latLng);
                            });

                            placeMarker(pozitie);
                            infowindow = new google.maps.InfoWindow({content: continut});
                            google.maps.event.addListener(
                                marker,
                                "click",
                                function () {
                                    infowindow.open(map, marker);
                                }
                            );
                            infowindow.open(map, marker);
                        } else {
                            console.log('Geocode was not successful for the following reason: ' + status);
                        }
                    });
                }
            }
        }
		
		// User rights BEGIN
		$(".check_all").change(function () {
			$("input:checkbox").prop('checked', $(this).prop("checked"));
		});
		
		$(".check_all_read").change(function () {
			$(".read-column").prop('checked', $(this).prop("checked"));
		});
		
		$(".check_all_write").change(function () {
			$(".write-column").prop('checked', $(this).prop("checked"));
		});
		
		$(".check_all_delete").change(function () {
			$(".delete-column").prop('checked', $(this).prop("checked"));
		});
		
		$('.check_all_in_row').on('click', function() {
			var row_id = $(this).data('id');
			
			if ($(this).is(':checked')) {
				$("#menu_read_" + row_id).prop('checked', true);
				$("#menu_write_" + row_id).prop('checked', true);
				$("#menu_delete_" + row_id).prop('checked', true);
			} else {
				$("#menu_read_" + row_id).prop('checked', false);
				$("#menu_write_" + row_id).prop('checked', false);
				$("#menu_delete_" + row_id).prop('checked', false);
			}
		});
		// User rights END
    });
}(jQuery));

function attrDefault($el, data_var, default_val)
{
    if(typeof $el.data(data_var) != 'undefined')
    {
        return $el.data(data_var);
    }

    return default_val;
}

/* ===========================================================
 * Bootstrap: fileinput.js v3.1.3
 * http://jasny.github.com/bootstrap/javascript/#fileinput
 * ===========================================================
 * Copyright 2012-2014 Arnold Daniels
 *
 * Licensed under the Apache License, Version 2.0 (the "License")
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================== */

+function ($) { "use strict";

  var isIE = window.navigator.appName == 'Microsoft Internet Explorer'

  // FILEUPLOAD PUBLIC CLASS DEFINITION
  // =================================

  var Fileinput = function (element, options) {
    this.$element = $(element)
    
    this.$input = this.$element.find(':file')
    if (this.$input.length === 0) return

    this.name = this.$input.attr('name') || options.name

    this.$hidden = this.$element.find('input[type=hidden][name="' + this.name + '"]')
    if (this.$hidden.length === 0) {
      this.$hidden = $('<input type="hidden">').insertBefore(this.$input)
    }

    this.$preview = this.$element.find('.fileinput-preview')
    var height = this.$preview.css('height')
    if (this.$preview.css('display') !== 'inline' && height !== '0px' && height !== 'none') {
      this.$preview.css('line-height', height)
    }
        
    this.original = {
      exists: this.$element.hasClass('fileinput-exists'),
      preview: this.$preview.html(),
      hiddenVal: this.$hidden.val()
    }
    
    this.listen()
  }
  
  Fileinput.prototype.listen = function() {
    this.$input.on('change.bs.fileinput', $.proxy(this.change, this))
    $(this.$input[0].form).on('reset.bs.fileinput', $.proxy(this.reset, this))
    
    this.$element.find('[data-trigger="fileinput"]').on('click.bs.fileinput', $.proxy(this.trigger, this))
    
    if(this.$element.hasClass('fileinput-background')) {
        this.$element.parents('.add-image').find('.file-list .file-background [data-dismiss="fileinput"]').on('click.bs.fileinput', $.proxy(this.clear, this));
    } else if (this.$element.hasClass('fileinput-logo')) {
        this.$element.parents('.add-image').find('.file-list .file-logo [data-dismiss="fileinput"]').on('click.bs.fileinput', $.proxy(this.clear, this));
    } else {
        this.$element.find('[data-dismiss="fileinput"]').on('click.bs.fileinput', $.proxy(this.clear, this));
    }
  },

  Fileinput.prototype.change = function(e) {
    var files = e.target.files === undefined ? (e.target && e.target.value ? [{ name: e.target.value.replace(/^.+\\/, '')}] : []) : e.target.files
    
    e.stopPropagation()

    if (files.length === 0) {
      this.clear()
      return
    }

    this.$hidden.val('')
    this.$hidden.attr('name', '')
    this.$input.attr('name', this.name)

    var file = files[0]

    if (this.$preview.length > 0 && (typeof file.type !== "undefined" ? file.type.match(/^image\/(gif|png|jpeg)$/) : file.name.match(/\.(gif|png|jpe?g)$/i)) && typeof FileReader !== "undefined") {
      var reader = new FileReader()
      var preview = this.$preview
      var element = this.$element

      reader.onload = function(re) {
        var $img = $('<img>')
        $img[0].src = re.target.result
        files[0].result = re.target.result
        
        if(element.hasClass('fileinput-background')) {
            element.parents('.add-image').find('.file-list .file-background .fileinput-filename span').text(file.name);
            $('.file-list .file-background').show();
        } else if (element.hasClass('fileinput-logo')) {
            element.parents('.add-image').find('.file-list .file-logo .fileinput-filename span').text(file.name);
            $('.file-list .file-logo').show();
        } else {
            element.find('.fileinput-filename').text(file.name);
            element.find('.fileinput-filename').show();
        }
        
        // if parent has max-height, using `(max-)height: 100%` on child doesn't take padding and border into account
        if (preview.css('max-height') != 'none') $img.css('max-height', parseInt(preview.css('max-height'), 10) - parseInt(preview.css('padding-top'), 10) - parseInt(preview.css('padding-bottom'), 10)  - parseInt(preview.css('border-top'), 10) - parseInt(preview.css('border-bottom'), 10))
        
        preview.html($img)
        element.addClass('fileinput-exists').removeClass('fileinput-new')

        element.trigger('change.bs.fileinput', files)
      }

      reader.readAsDataURL(file)
    } else {
      this.$element.find('.fileinput-filename').text(file.name)
      this.$element.find('.fileinput-filename').show()
      this.$preview.text(file.name)
      
      this.$element.addClass('fileinput-exists').removeClass('fileinput-new')
      
      this.$element.trigger('change.bs.fileinput')
    }
  },

  Fileinput.prototype.clear = function(e) {
    if (e) e.preventDefault()
    
    this.$hidden.val('')
    this.$hidden.attr('name', this.name)
    this.$input.attr('name', '')

    //ie8+ doesn't support changing the value of input with type=file so clone instead
    if (isIE) { 
      var inputClone = this.$input.clone(true);
      this.$input.after(inputClone);
      this.$input.remove();
      this.$input = inputClone;
    } else {
      this.$input.val('')
    }

    this.$preview.html('')
    
    this.$element.addClass('fileinput-new').removeClass('fileinput-exists')
    
    if(this.$element.hasClass('fileinput-background')) {
        this.$element.parents('.add-image').find('.file-list .file-background .fileinput-filename span').text('');
        $('.file-list .file-background').hide();
    } else if (this.$element.hasClass('fileinput-logo')) {
        this.$element.parents('.add-image').find('.file-list .file-logo .fileinput-filename span').text('');
        $('.file-list .file-logo').hide();
    } else {
        this.$element.find('.fileinput-filename').text('');
        this.$element.find('.fileinput-filename').hide();
    }
    
    if (e !== undefined) {
      this.$input.trigger('change')
      this.$element.trigger('clear.bs.fileinput')
    }
  },

  Fileinput.prototype.reset = function() {
    this.clear()

    this.$hidden.val(this.original.hiddenVal)
    this.$preview.html(this.original.preview)
    this.$element.find('.fileinput-filename').text('')

    if (this.original.exists) this.$element.addClass('fileinput-exists').removeClass('fileinput-new')
     else this.$element.addClass('fileinput-new').removeClass('fileinput-exists')
    
    this.$element.trigger('reset.bs.fileinput')
  },

  Fileinput.prototype.trigger = function(e) {
    this.$input.trigger('click')
    e.preventDefault()
  }

  
  // FILEUPLOAD PLUGIN DEFINITION
  // ===========================

  var old = $.fn.fileinput
  
  $.fn.fileinput = function (options) {
    return this.each(function () {
      var $this = $(this),
          data = $this.data('bs.fileinput')
      if (!data) $this.data('bs.fileinput', (data = new Fileinput(this, options)))
      if (typeof options == 'string') data[options]()
    })
  }

  $.fn.fileinput.Constructor = Fileinput


  // FILEINPUT NO CONFLICT
  // ====================

  $.fn.fileinput.noConflict = function () {
    $.fn.fileinput = old
    return this
  }


  // FILEUPLOAD DATA-API
  // ==================

  $(document).on('click.fileinput.data-api', '[data-provides="fileinput"]', function (e) {
    var $this = $(this)
    if ($this.data('bs.fileinput')) return
    $this.fileinput($this.data())
      
    var $target = $(e.target).closest('[data-dismiss="fileinput"],[data-trigger="fileinput"]');
    if ($target.length > 0) {
      e.preventDefault()
      $target.trigger('click.bs.fileinput')
    }
  })

}(window.jQuery);

(function ($) {
    $.fn.characterCounter = function (limit) {
        return this.filter("textarea.limited-characters, textarea.notification-characters").each(function () {
            var $this = $(this),
                checkCharacters = function (event) {
                    if ($this.val().length > limit) {
                        $this.val($this.val().substring(0, limit));
                        
                        event.preventDefault();
                        event.stopPropagation();
                    } else {
                        $this.parent('.form-group').find('.max-chars span').text(limit - $this.val().length);
                    }
                };

            $this.keyup(function (event) {
                // Keys "enumeration"
                var keys = {
                    BACKSPACE: 8,
                    TAB: 9,
                    LEFT: 37,
                    UP: 38,
                    RIGHT: 39,
                    DOWN: 40
                };

                // which normalizes keycode and charcode.
                switch (event.which) {
                    case keys.UP:
                    case keys.DOWN:
                    case keys.LEFT:
                    case keys.RIGHT:
                    case keys.TAB:
                        break;
                    default:
                        checkCharacters(event);
                        break;
                }
            });
            
            $this.parent('.form-group').find('.max-chars span').text(limit - $this.val().length);

            // Handle cut/paste.
            $this.bind("paste cut", function (event) {
                // Delay so that paste value is captured.
                setTimeout(function () { checkCharacters(event); event = null; }, 150);
            });
        });
    };
} (jQuery));

// http://stackoverflow.com/a/11381730/989439
function mobilecheck() {
    var check = false;
    (function(a){if(/(android|ipad|playbook|silk|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))check = true})(navigator.userAgent||navigator.vendor||window.opera);
    return check;
}

function hasParent(e, id) {
    if (!e) return false;
    var el = e.target||e.srcElement||e||false;
    while (el && el != id) {
        el = el.parentNode||false;
    }
    return (el!==false);
}