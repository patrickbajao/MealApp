(function($) {

    var Modal = function(dialog, response) {
        this.init(dialog, response);
    };
    
    $.extend(Modal.prototype, {
        dialog:    '',
        response:  '',
        maxHeight: window.innerHeight ? window.innerHeight : $(window).height(),
        height:    'auto',
        init: function(dialog, response) {
            this.dialog   = dialog;
            this.response = response;
            if($(this.response).height() > (this.maxHeight / 2 + 100)) {
                this.height = this.maxHeight - 50;
            }
        },
        show: function() {
            var self  = this;
            this.dialog.dialog({
                title: $('div.title', self.response),
                width: 940,
                maxWidth: 980,
                height: self.height,
                maxHeight: self.maxHeight,
                modal: true,
                resizable: true,
                open: function(event, ui) {
                    self.setAjaxForm();
                }
            });
        },
        setAjaxForm: function() {
            var self = this;
            $('form', this.response).submit(function() {
                data = '';
                
                // Create the data string to be passed
                $('input').each(function(i) {
                
                    // Check input type if it is a checkbox or a radiobutton
                    if('checkbox' == this.type || 'radio' == this.type) {
                    
                        // Check if the checkbox/radiobutton is checked. If it is checked, add to data string
                        if(this.checked) {
                            data += this.name + '=' + this.value + '&';
                        }
                    } else {
                        data += this.name + '=' + this.value + '&';
                    }
                });
                                
                // Submit form using AJAX
                $.ajax({
                    type: this.method,
                    url:  this.action,
                    data: data,
                    complete: function(transport) {
                        if(transport.status == 401) {
                            $(window.location).attr('href', '/');
                        }
                    },
                    success: function(response){
                        if(response.success) {
                            // Destroy the dialog box when the form was submitted successfully
                            self.dialog.dialog('destroy');
                            
                            contentDiv = $('div#content');
                            
                            // Add p.info after div.title if it does not exists
                            if($('p.info', contentDiv).length == 0) {
                                $('div.title').after('<p class="info"></p>');
                            }
                            $('p.info', contentDiv).text(response.info);
                            
                            $('#scheduled-meal', contentDiv).update(response.load + ' div.meal');
                            $('#meal-' + response.id, contentDiv).update(response.load + ' #meal-' + response.id + '>div');
                        } else if(!response.success) {
                            // Add p.error if it does not exists
                            if($('p.error').length == 0) {
                                $('<p class="error"></p>').prependTo(self.dialog);
                            }
                            $('p.error').text(response.error);
                            self.setAjaxForm();
                        }
                    }
                });
                return false;
            });
            self.setCancelLink();
            self.setPrevOrderLink();
            self.setScrollFollowButtons();
        },
        setCancelLink: function() {
            var self = this;
            $('a.cancel', this.response).click(function() {
                $("#dialog-modal").remove();
                return false;
            });
        },
        setPrevOrderLink: function() {
            var self = this;
            $('a.prev-order', this.response).click(function() {
                self.dialog.load(this.href, function(responseText, textStatus, XMLHttpRequest) {
                    if(XMLHttpRequest.status == 401) {
                        $(window.location).attr('href', '/');
                    } else {
                        $('div.title', this).remove();
                        self.setAjaxForm();
                    }
                });
                return false;
            });
        },
        setScrollFollowButtons: function() {
            var $buttons   = $('#follow'),
                $dialog    = $(this.dialog),
                position     = $buttons.position(),
                topPadding = 15;

            $dialog.scroll(function() {
                if ($dialog.scrollTop() > position.top) {
                    $buttons.stop().animate({
                        marginTop: $dialog.scrollTop()
                    });
                } else {
                    $dialog.stop().animate({
                        marginTop: 0
                    });
                }
            });
        }
    });
    
    $.fn.update = function(url) {
        this.load(url, function(responseText, textStatus, XMLHttpRequest) {
            $('span.links a.modal', this).mealModalLinks();
            $('span.links a.meal-link', this).mealLinks();
        });
    };
    
    $.fn.mealModalLinks = function() {
        this.each(function(i) {
            $(this).click(function() {
                $("#dialog-modal").remove();
                var dialog = $('<div id="dialog-modal" style="display:hidden"></div>').appendTo('body');
                var url = this.href;
                dialog.load(
                    url,
                    function (responseText, textStatus, XMLHttpRequest) {
                        if(XMLHttpRequest.status == 401) {
                            $(window.location).attr('href', '/');
                        } else {
                            var modal = new Modal(dialog, this);
                            modal.show();
                        }
                    }
                );
                return false;
            });
        });
    };
    
    $.fn.mealLinks = function() {
        this.each(function(i) {
            $(this).click(function() {
                $.ajax({
                    type: 'GET',
                    url:  this.href,
                    complete: function(transport) {
                        if(transport.status == 401) {
                            $(window.location).attr('href', '/');
                        }
                    },
                    success: function(response) {
                        if(response.success) {
                            contentDiv = $('div#content');
                            
                            // Add p.info after div.title if it does not exists
                            if($('p.info', contentDiv).length == 0) {
                                $('div.title').after('<p class="info"></p>');
                            }
                            $('p.info', contentDiv).text(response.info);
                            
                            $('#scheduled-meal', contentDiv).update(response.load + ' div.meal');
                            $('#meal-' + response.id, contentDiv).update(response.load + ' #meal-' + response.id + '>div');
                        }
                    }
                });
                return false;
            });
        });
    }
    
})(jQuery);

$(function(){
    $('span.links a.modal').mealModalLinks();
    $('span.links a.meal-link').mealLinks();
});