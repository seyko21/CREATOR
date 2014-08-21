var ajustTable = {

    create: function(alias){
        var colCount = $('.'+alias+'scrollfirstTr>td').length; //get total number of column

        var m = 0;
        var n = 0;
        var brow = 'mozilla';

        jQuery.each(jQuery.browser, function(i, val) {
          if(val == true){
            brow = i.toString();
          }
        });

        $('.'+alias+'tableHeader').each(function(i){
          if (m < colCount){

            if (brow == 'mozilla'){
              $('#'+alias+'firstTd').css("width",$('.'+alias+'tableFirstCol').innerWidth());//for adjusting first td
              $(this).css('width',$('#'+alias+'table_div td:eq('+m+')').innerWidth());//for assigning width to table Header div
            }
            else if (brow == 'msie'){
              $('#'+alias+'firstTd').css("width",$('.'+alias+'tableFirstCol').width());
              $(this).css('width',$('#'+alias+'table_div td:eq('+m+')').width()-2);//In IE there is difference of 2 px
            }
            else if (brow == 'safari'){
              $('#'+alias+'firstTd').css("width",$('.'+alias+'tableFirstCol').width());
              $(this).css('width',$('#'+alias+'table_div td:eq('+m+')').width());
            }
            else {
              $('#'+alias+'firstTd').css("width",$('.'+alias+'tableFirstCol').width());
              $(this).css('width',$('#'+alias+'table_div td:eq('+m+')').innerWidth());
            }
          }
          m++;
        });

        $('.'+alias+'tableFirstCol').each(function(i){
          if(brow == 'mozilla'){
            $(this).css('height',$('#'+alias+'table_div td:eq('+colCount*n+')').outerHeight());//for providing height using scrollable table column height
          }
          else if(brow == 'msie'){
            $(this).css('height',$('#'+alias+'table_div td:eq('+colCount*n+')').innerHeight()-2);
          }
          else {
            $(this).css('height',$('#'+alias+'table_div td:eq('+colCount*n+')').height());
          }
          n++;
        });
    },
    scroll: function(alias){
        $('#'+alias+'divHeader').scrollLeft($('#'+alias+'table_div').scrollLeft());
        $('#'+alias+'firstcol').scrollTop($('#'+alias+'table_div').scrollTop());
    }
};