// Limit scope pollution from any deprecated API
jQuery(function($){

    var load_changer = function(){
        var t_body = $('body');
        var t_div = $('.boxed-fluid');
        var t_transition_time = 0;
        var t_transition_apply = function(){
            clearTimeout(t_transition_time);
            t_body.addClass('animated_change');
            t_transition_time = setTimeout(t_transition_end, 1500);
        };
        var t_transition_end = function(){
            t_body.removeClass('animated_change');
        };
        var t_color = $('select[name="site_color"]');
        var t_layout = $('select[name="site_layout"]');
        t_color.change(function(){
            var t = $(this);
            if(t.val()!==t.data('color')){
                t_transition_apply();
                switch(t.val()){
                    case 'dark':
                        t_div.addClass('black_version');
                        break;
                    case 'light':
                        t_div.removeClass('black_version');
                        break;
                    default:
                        break;
                }
                t.data('color', t.val());
            }
        });
        t_layout.change(function(){
            var t = $(this);
            if(t.val()!==t.data('layout')){
                t_transition_apply();
                switch(t.val()){
                    case 'boxed':
                        t_body.addClass('boxed');
                        break;
                    case 'wide':
                        t_body.removeClass('boxed');
                        break;
                    default:
                        break;
                }
                t.data('layout', t.val());
            }
        });
        $('#background_patterns>li').click(function(){
            if('boxed'!==t_layout.data('layout')){
                t_layout.val('boxed');
                t_transition_apply();
                t_body.addClass('boxed');
                t_layout.data('layout','boxed');
            }
            t_body.css({backgroundImage: 'url('+$(this).children('img').attr('src')+')', backgroundRepeat: 'repeat'});
        });
        $('#background_images>li').click(function(){
            if('boxed'!==t_layout.data('layout')){
                t_layout.val('boxed');
                t_transition_apply();
                t_body.addClass('boxed');
                t_layout.data('layout','boxed');
            }
            t_body.css({backgroundImage: 'url('+$(this).children('img').attr('src')+')', backgroundRepeat: 'no-repeat'});
        });

        var t_box = $('.color-box');
        var t_box_width = t_box.outerWidth();
        $('.color-box_settings').click(function(){
            if(t_box.data('visible')){
                t_box.css({left: -t_box_width});
                t_box.data('visible', false);
            }else{
                t_box.css({left: 0});
                t_box.data('visible', true);
            }
        });

        var style_index = 0;

        function color_options(selector, default_color, color_change){
            var t_color = default_color;
            var t_picker = undefined;
            var t_picker_container = $('<div/>').addClass('color_picker').css({position: 'fixed', zIndex: 999, top: 388, left: 200});
            var t_color_input = $('<input/>').css({position: 'absolute', zIndex: 999, top: 198, left: 0, width: '100%', textAlign: 'center', lineHeight: '1.6em', border: '1px solid black'});
            var style_id = 'color-box-style'+style_index;
            style_index++;
            $('.color-box_settings').click(function(){
                if(t_box.data('visible')){
                    t_picker_container.hide();
                }
            });
            var t_callback = function(){
                var t_style = $('head>#'+style_id);
                var t_output = '';
                if(!t_style.length)
                    t_style = $('<style/>').attr('id',style_id).appendTo('head');
                t_output += color_change.replace(/%color%/g,t_color);
                t_style.html(t_output);
            };
            $(selector+'>li:lt(-1)').click(function(){
                $('.color_picker').hide();
                t_color = $(this).children('span').css('background-color').replace(/rgb\(\s*(\d+)\s*,\s*(\d+)\s*,\s*(\d+)\s*\)/ig,function(c, r, g, b){return '#'+Number(r).toString(16)+Number(g).toString(16)+Number(b).toString(16);});
                t_callback();
                if(undefined!==t_picker){
                    t_picker.setColor(t_color);
                    t_color_input.val(t_color);
                }
            });
            var t_input_update = function(){
                t_color_input.val(t_color);
                t_color_input.css({backgroundColor: t_color, color: t_picker.hsl[2] > 0.5 ? '#000' : '#fff'});
            };
            $(selector+'>li:last').click(function(){
                if(undefined===t_picker){
                    t_picker = $.farbtastic(t_picker_container.appendTo('body'));
                    t_picker_container.append(t_color_input);
                    t_picker.setColor(t_color);
                    t_input_update();
                    t_picker.linkTo(function(color){
                        t_color = color;
                        t_callback();
                        t_input_update();
                    });
                    t_color_input.change(function(){
                        t_picker.setColor(t_color_input.val());
                    });
                    t_picker_container.show();
                }else{
                    $('.color_picker').not(t_picker_container).hide();
                    t_picker_container.toggle();
                }
            });
        }

        color_options('#site_color','#96a6a6',"\n\
        .d-text-c.active,\n\
        .d-text-c-h.active,\n\
        .d-text-c-h:hover,\n\
        .d-text-c {\n\
            color: %color% !important;\n\
        }\n\
        .d-bg-c.active,\n\
        .d-bg-c-h:hover,\n\
        .mini-slider .slider-dots li.active,\n\
        .d-bg-c-h.active,\n\
        .d-bg-c {\n\
            background: %color% !important;\n\
        }\n\
        .d-border-c.active,\n\
        .d-border-c-h:hover,\n\
        .d-border-c-h.active,\n\
        .d-border-c {\n\
            border-color: %color% !important;\n\
        }\n\
        ");

        color_options('#site_color_2','#96a6a6',"\n\
        .s-text-c.active,\n\
        .s-text-c-h.active,\n\
        .s-text-c-h:hover,\n\
        .s-text-c {\n\
            color: %color% !important;\n\
        }\n\
        .s-bg-c.active,\n\
        .s-bg-c-h:hover,\n\
        .s-bg-c-h.active,\n\
        .s-bg-c {\n\
            background: %color% !important;\n\
        }\n\
        .s-border-c.active,\n\
        .s-border-c-h:hover,\n\
        .s-border-c-h.active,\n\
        .s-border-c {\n\
            border-color: %color% !important;\n\
        }\n\
        ");

    };

    load_changer();

});