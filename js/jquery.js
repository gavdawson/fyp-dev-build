$('', 'table').each(function(i) {
    $(this).text(i+1);
});

$('table.paginated').each(function() {
    var currentPage = 0;
    var numPerPage = 20;
    var $table = $(this);
    $table.bind('repaginate', function() {
        $table.find('tbody tr').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
    });
    $table.trigger('repaginate');
    var numRows = $table.find('tbody tr').length;
    var numPages = Math.ceil(numRows / numPerPage);
    var $pager = $('<div class="pager"></div>');
    var $previous = $('<span class="previous"><<</spnan>');
    var $next = $('<span class="next">>></spnan>');
    for (var page = 0; page < numPages; page++) {
        $('<span class="page-number"></span>').text(page + 1).bind('click', {
            newPage: page
        }, function(event) {
            currentPage = event.data['newPage'];
            $table.trigger('repaginate');
            $(this).addClass('active').siblings().removeClass('active');
        }).appendTo($pager).addClass('clickable');
    }
    $pager.insertBefore($table).find('span.page-number:first').addClass('active');
    $previous.insertBefore('span.page-number:first');
    $next.insertAfter('span.page-number:last');
    
    $next.click(function (e) {
        $previous.addClass('clickable');
        $pager.find('.active').next('.page-number.clickable').click();
    });
    $previous.click(function (e) {
        $next.addClass('clickable');
        $pager.find('.active').prev('.page-number.clickable').click();
    });
    $table.on('repaginate', function () {
        $next.addClass('clickable');
        $previous.addClass('clickable');
        
        setTimeout(function () {
            var $active = $pager.find('.page-number.active');
            if ($active.next('.page-number.clickable').length === 0) {
                $next.removeClass('clickable');
            } else if ($active.prev('.page-number.clickable').length === 0) {
                $previous.removeClass('clickable');
            }
        });
    });
    $table.trigger('repaginate');
});

$("#searchInput").keyup(function () {
    //split the current value of searchInput
    var data = this.value.split(" ");
    //create a jquery object of the rows
    var jo = $("#fbody").find("tr");
    if (this.value == "") {
        jo.show();
        return;
    }
    //hide all the rows
    jo.hide();

    //Recusively filter the jquery object to get results.
    jo.filter(function (i, v) {
        var $t = $(this);
        for (var d = 0; d < data.length; ++d) {
            if ($t.text().toLowerCase().indexOf(data[d].toLowerCase()) > -1) {
                return true;
            }
        }
        return false;
    })
    //show the rows that match.
    .show();
}).focus(function () {
    this.value = "";
    $(this).css({
        "color": "black"
    });
    $(this).unbind('focus');
}).css({
    "color": "#C0C0C0"
});

/* jQuery(function($) {

  $("a.xx, a.yy").live("click", function() {
    var $this, c;
    $this = $(this);
    c = $this.hasClass("xx")
              ? {us: "yy", them: "xx" }
              : {us: "xx", them: "yy" };
     $("a." + c.us).removeClass(c.us).addClass(c.them);
     $this.removeClass(c.them).addClass(c.us);
    
    // Just returning false here for the purposes of demo
    return false;
  });
  
}); */

$(document).ready(function() {
    $('#example').DataTable();
} );

if ($("#rowna").html()) {
    // The cell has stuff in it
}
else {
    $('#rowna').css('background-color','#000!important');
}