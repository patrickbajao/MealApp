(function($) {
    var Meal = function() {
        this.init();
    };

    $.extend(Meal.prototype, {
        vote_link: $('a.vote-link'),
        view_votes_link: $('a.view-votes-link'),
        stop_vote_link: $('a.stop-vote-link'),
        order_link: $('a.order-link'),
        view_orders_link: $('a.view-orders-link'),
        stop_order_link: $('a.stop-order-link'),
        init: function() {
            
        }
    });

    $.fn.init = function() {
    };
    
})(jQuery);

$(function(){
    init();
});