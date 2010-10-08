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
            if($(this.response).height() > (this.maxHeight / 2)) {
                this.height = this.maxHeight - 50;
            }
        },
        show: function() {
            var self  = this;
            this.dialog.dialog({
                title: $('div.title', self.response),
                width: 460,
                maxWidth: 460,
                height: self.height,
                maxHeight: self.maxHeight,
                modal: true,
                resizable: false,
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
                        } else {
                            self.dialog.html(response);
                            $('div.title', self.dialog).remove();
                            self.setAjaxForm();
                        }
                    }
                });
                return false;
            });
            this.setCancelLink();
        },
        setCancelLink: function() {
            var self = this;
            $('a.cancel', this.response).click(function() {
                $("#dialog-modal").remove();
                return false;
            });
        }
    });
    
    $.fn.showSuggestionBox = function() {
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
    };
    
})(jQuery);

$(function(){
    $('a.place-suggest-link').showSuggestionBox();
    $('a.item-suggest-link').showSuggestionBox();
});