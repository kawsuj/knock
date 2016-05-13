function makeSearchable(table_id){
	    // Setup - add a text input to each footer cell
	    $(table_id +' tfoot th').each( function () {
	        var title = $(table_id + ' tfoot th').eq( $(this).index() ).text();
	        //$(this).html( '<input type="text" placeholder="Search on '+title+'" />' );
	        if (!strStartsWith(title, '#NOSEARCH#')){
	        	//alert('title='+title);
				$(this).html( '<input style="width:100%" type="text" placeholder="Search" />' );
			}else{
				$(this).html( '' );
			}
	        
	        
	    } );
	    
	    // DataTable
	    var table = $(table_id).DataTable();
	 
	    // Apply the search
	    table.columns().every( function () {
	        var that = this;
	 
	        $( 'input', this.footer() ).on( 'keyup change', function () {
	            if ( that.search() !== this.value ) {
	                that
	                    .search( this.value )
	                    .draw();
	            }
	        } );
	    } );
}


function strStartsWith(str, prefix) {
    return str.indexOf(prefix) === 0;
}

function strEndsWith(str, suffix) {
    return str.match(suffix+"$")==suffix;
}

function strContains(str, substr) {
	//alert ('found ' + substr + ' in ' + str + ' at pos' + str.indexOf(substr) )
    return str.indexOf(substr) > -1;
}

$(function(){
	$('.wierd_one').tooltip();
});


$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip({
    	html : true,
        content: function () {
            return $(this).prop('title');
        }
    }); 
    
    $(".knock-confirm-delete").on("submit", function(){
        return confirm("Do you want to delete this item?");
    });
});

