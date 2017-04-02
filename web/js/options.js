(function () {

    "use strict";

    var matched, browser;

    // Use of jQuery.browser is frowned upon.
    // More details: http://api.jquery.com/jQuery.browser
    // jQuery.uaMatch maintained for back-compat
    jQuery.uaMatch = function (ua) {
        ua = ua.toLowerCase();

        var match = /(chrome)[ \/]([\w.]+)/.exec(ua) ||
            /(webkit)[ \/]([\w.]+)/.exec(ua) ||
            /(opera)(?:.*version|)[ \/]([\w.]+)/.exec(ua) ||
            /(msie) ([\w.]+)/.exec(ua) ||
            ua.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec(ua) || [];

        return {
            browser: match[1] || "",
            version: match[2] || "0"
        };
    };

    matched = jQuery.uaMatch(navigator.userAgent);
    browser = {};

    if (matched.browser) {
        browser[matched.browser] = true;
        browser.version = matched.version;
    }

    // Chrome is Webkit, but Webkit is also Safari.
    if (browser.chrome) {
        browser.webkit = true;
    } else if (browser.webkit) {
        browser.safari = true;
    }

    jQuery.browser = browser;

    jQuery.sub = function () {
        function jQuerySub(selector, context) {
            return new jQuerySub.fn.init(selector, context);
        }
        jQuery.extend(true, jQuerySub, this);
        jQuerySub.superclass = this;
        jQuerySub.fn = jQuerySub.prototype = this();
        jQuerySub.fn.constructor = jQuerySub;
        jQuerySub.sub = this.sub;
        jQuerySub.fn.init = function init(selector, context) {
            if (context && context instanceof jQuery && !(context instanceof jQuerySub)) {
                context = jQuerySub(context);
            }

            return jQuery.fn.init.call(this, selector, context, rootjQuerySub);
        };
        jQuerySub.fn.init.prototype = jQuerySub.fn;
        var rootjQuerySub = jQuerySub(document);
        return jQuerySub;
    };

})();


$(document).ready(function () {
    "use strict";
    $(".responsive-menu").click(function (e) {
        $(".main-nav>ul").css({display: "block"});
        e.stopPropagation();
        if (e.preventDefault)
            e.preventDefault();
        return false;
    });
    $("body").click(function () {
        $(".main-nav>ul").css({display: "none"});
    });
});


$(document).ready(function () {
   /* GALLERY IMAGE ZOOM */
    $Electra.swipebox = (jQuery().swipebox) ? $(".swipebox").swipebox() : null;
});



$(document).ready(function () {
var datePicker = function() {
    jQuery('#check-in').datetimepicker({
      format:'m-d-Y',
      onShow:function( ct ){
        this.setOptions({
          maxDate:jQuery('#check-out').val()?jQuery('#check-out').val():false
        })
      },
      timepicker:false
    });
    jQuery('#check-out').datetimepicker({
      format:'m-d-Y',
      onShow:function( ct ){
        this.setOptions({
          minDate:jQuery('#check-in').val()?jQuery('#check-in').val():false
        })
      },
      timepicker:false
    });
  }
  datePicker();
});

$(document).ready(function () {
var roomSelect = function() {
    var select = $('.tour-drop').parent();

    select.click(function(e) {
      e.preventDefault();
      select.not($(this)).find('ul').hide();
      $(this).find('ul').toggle();
    });

    $('html').click(function() {
      select.find('ul').hide();
    });

    select.each( function(index, val) {
      $(this).click(function(event){
        event.stopPropagation();
      });
    });

    select.each( function(index, val) {
      $(this).find('ul li').click(function(e) {
        e.preventDefault();
          $(this).parent().parent().find('input').attr('value', $(this).text());
      });
    });
  }
roomSelect();
});





/* ================= SCROOL TOP ================= */
$(document).ready(function () {
    "use strict";
    $('.backtotop').click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 1200, 'swing');
        return false;
    });
});

/* ================= IE fix ================= */
$(document).ready(function () {
    "use strict";
    if (!Array.prototype.indexOf) {
        Array.prototype.indexOf = function (obj, start) {
            for (var i = (start || 0), j = this.length; i < j; i++) {
                if (this[i] === obj) {
                    return i;
                }
            }
            return -1;
        };
    }
});

/* ================= START PLACE HOLDER ================= */
$(document).ready(function ($) {
    "use strict";
    $('input[placeholder], textarea[placeholder]').placeholder();
});
/* ================= END PLACE HOLDER ================= */

jQuery('.contact-form').each(function () {
    "use strict";
    var t = jQuery(this);
    var t_result = jQuery(this).find('.form-send');
    var t_result_init_val = t_result.val();
    var validate_email = function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    };
    var t_timeout;
    t.submit(function (event) {
        event.preventDefault();
        var t_values = {};
        var t_values_items = t.find('input[name],textarea[name]');
        t_values_items.each(function () {
            t_values[this.name] = jQuery(this).val();
        });
        if (t_values['contact-name'] === '' || t_values['contact-email'] === '' || t_values['contact-message'] === '') {
            t_result.val('Please fill in all the required fields.');
        } else
        if (!validate_email(t_values['contact-email']))
            t_result.val('Please provide a valid e-mail.');
        else
            jQuery.post("php/contacts.php", t.serialize(), function (result) {
                t_result.val(result);
            });
        clearTimeout(t_timeout);
        t_timeout = setTimeout(function () {
            t_result.val(t_result_init_val);
        }, 3000);
    });

});


/* AS JavaScript [START] */
$Electra = {};

// Email object
$Electra.email = {};

// Forms
$Electra.form = {};
$Electra.form.errorClass = 's_error';

$Electra.form.subscribe = {};
$Electra.form.subscribe.id = '#newsletter';

jQuery(document).ready(function ($) {

    "use strict";

    /* SUBSCRIBE FORM */
    $($Electra.form.subscribe.id).on('submit', function (e) {
        e.preventDefault();
        var form = $(this);
        var input = form.find('input[type="text"]');
        if ($Electra.form.validate(form)) {
            $.post('php/subscribe.php', form.serialize(), function (result) {
                input.attr('placeholder', result);
                input.val('');
            });
        } else {
            setTimeout(function () {
                input.removeClass($Electra.form.errorClass);
            }, 800);
        }
        return false;
    });
});

/*  EMAIL VALIDATION FUNCTION */
$Electra.email.validate = function (email) {
    "use strict";
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
};
/* --------------------------- */

/*  FORM ELEMENT VALIDATION FUNCTION */
$Electra.form.validate = function validate(form) {
    "use strict";
    var valid = true;
    $.each(form.find(':input:not(:input[type="submit"])'), function (index, input) {
        var val = $(input).val();
        if ($.trim(val) === '') {
            $Electra.form.inputError(input);
            valid = false;
            return false;
        }
        if ($(input).attr('name') === 'newsletter-email') {
            if (!$Electra.email.validate(val)) {
                $Electra.form.inputError(input);
                valid = false;
                return false;
            }
        }
    });
    return valid;
};

/* TOGGLE INPUT ERROR CLASS */
$Electra.form.inputError = function inputError(input) {
    "use strict";
    if (!$(input).hasClass($Electra.form.errorClass))
        $(input).addClass($Electra.form.errorClass);
    $(input).focus();
};
/* AS JavaScript [END] */



// Instantiate theme collapse element object
$theme_accordion = {};
$theme_accordion.collapse = {};

/* ACCORDION */
$(".accordion-toggle").click(function () {
    "use strict";
    if ($(this).parent().hasClass('active')) {
        $theme_accordion.collapse.close($(this).parent().parent());
        return;
    }
    $('#accordion').children('.accordion-group').each(function (i, elem) {
        $theme_accordion.collapse.close(elem);
    });
    $theme_accordion.collapse.open(this);
});


/* ACCORDION STATE MANAGER */
$theme_accordion.collapse.close = function close(element) {
    "use strict";
    jQuery(element).children('.accordion-heading').removeClass('active');
    jQuery(element).children('.accordion-body').removeClass('in');
    jQuery(element).children('.accordion-heading').find('.plus').html('+');
};
$theme_accordion.collapse.open = function open(element) {
    "use strict";
    jQuery(element).parent().toggleClass('active');
    jQuery(element).find('.plus').html('-');
};
/* --------------------------- */



/* COUNTDOWN */
    var cd_duedate = $('#the_countdown').attr('data-duedate');
    var cd_start = new Date($('#the_countdown').attr('data-startdate')).getTime();
    var cd_end = new Date(cd_duedate).getTime();
    $Electra.countdown = (jQuery().countdown) ? $('#the_countdown').countdown(cd_duedate, function(event) {
        var $this = $(this);
        // Total days
        var days = Math.round(Math.abs((cd_start - cd_end))/(24*60*60*1000));
        var divider = {
            'seconds':60,
            'minutes':60,
            'hours':24
        };
        var progress = null;
        switch (event.type) {
            case "seconds":
            case "minutes":
            case "hours":
            case "days":
            case "weeks":
            case "daysLeft":
                $this.find('b#' + event.type).html('<span>'+event.value+'</span>');
                if(event.type === 'days'){
                    progress = ((days - event.value) * 100) / (days);
                }else{                    
                    progress = (100 / divider[event.type]) * (divider[event.type] - event.value);
                }
                $this.find('.countdown_progress.' + event.type + ' .filled')
                        .css('width', progress + '%');
                break;
            case "finished":
                $this.hide();
                break;
        }
    }) : null;






//==============END TWITTER====================================