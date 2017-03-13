/**
 * Created by Syed Haider Hassan on 8/25/14.
 */
;(function(window) {
    var
// Is Modernizr defined on the global scope
        Modernizr = typeof Modernizr !== "undefined" ? Modernizr : false,
// whether or not is a touch device
        isTouchDevice = Modernizr ? Modernizr.touch : !!('ontouchstart' in window || 'onmsgesturechange' in window),
// Are we expecting a touch or a click?
        buttonPressedEvent = (isTouchDevice) ? 'touchstart' : 'click',
        Haider = function() {
            this.init();
        };
// Initialization method
    Haider.prototype.init = function() {
        this.isTouchDevice = isTouchDevice;
        this.buttonPressedEvent = buttonPressedEvent;
    };
    Haider.prototype.getViewportHeight = function() {
        var docElement = document.documentElement,
            client = docElement.clientHeight,
            inner = window.innerHeight;
        if (client < inner)
            return inner;
        else
            return client;
    };
    Haider.prototype.getViewportWidth = function() {
        var docElement = document.documentElement,
            client = docElement.clientWidth,
            inner = window.innerWidth;
        if (client < inner)
            return inner;
        else
            return client;
    };
// Creates a "Haider" object.
    window.Haider = new Haider();
})(this);
;(function($){
    "use strict";
    Haider.notification = function(text,notyficationType,heading) {
        /*----------- BEGIN validationEngine CODE -------------------------*/
        var alertHead;
        if(typeof heading !== "undefined"){
            alertHead = heading
        }else{
            if(notyficationType === 'success'){
                alertHead = "Success !";
            }else if(notyficationType === 'error'){
                alertHead = "Error !";
            }else if(notyficationType === 'warning'){
                alertHead = "Warning !";
            }else if(notyficationType === 'information'){
                alertHead = "Information !";
            }
        }
        noty({
            layout:"topRight",
            text: text,
            type: notyficationType,
            theme: "bootstrapTheme",
            timeout:3600000,
            template: '<div class="alert alert-dismissible"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button><h4>	<i class="icon fa fa-check"></i>'+ alertHead + '</h4><span class="noty_text"></span></div>',
            closeWith: ["click"]
        });
        /*----------- END validate CODE -------------------------*/
    };
    return Haider;
})(jQuery);
