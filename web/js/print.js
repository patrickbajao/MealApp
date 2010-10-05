$(function(){
    $('<div id="bar"><strong>Print Preview</strong><a href="#">Print</a></div>').prependTo('body');
    $('div#bar a').click(function() {
        window.print();
        return false;
    });
});