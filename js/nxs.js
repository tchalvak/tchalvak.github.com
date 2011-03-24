function repositoryLoad() {
    var limit = 20        // how many repos to list
    var login = 'tchalvak' // your username

    $.getJSON('http://github.com/api/v1/json/' + login + '?callback=?', function(data) {
        var repos = $.grep(data.user.repositories, function() {
        return !this.fork
        })
        


        repos.sort(function(a, b) {
        return b.watchers - a.watchers
        })

        $.each(repos.slice(0, limit), function() {
        $('#repos').append('<li><a href="' + this.url + '">' + this.name + '</a></li>')
        })
    })

	$("#waiting").hide(); // Hide the not yet loaded message.
	
	
} // End of repositoryLoad function.

function loadLastCommitMessage(){
var login = 'tchalvak' // your username
        
    $.getJSON('http://github.com/api/v1/json/' + login + '/ninjawars/commit/master/?callback=?', function(data) {
    var unknown = $.grep(data.commit, function() {
        return true;
    })
    /*var_dump(unknown);
    
    var_dump(data);
    var_dump(data.commit);
    var_dump(data.commit.message);
    var_dump(data.commit.url);
    var_dump(data.commit.author.name);
    */
    
        // Load latest commit message.
	$('#latest-commit').html(data.commit.message);
	$('#latest-commit').append("<div id='commit-author'>--"+data.commit.author.name+"</div>");
	$('#latest-commit-title').show();        
	$('#latest-commit').show();
    
    });
    
}        


$(document).ready(function() {

		//$("#repos").append("<div id='waiting'>Repositories not yet loaded.</div>");
    //$("#j a").click(function() { // Just for the special jquery testing link.
        //alert("Hello world!");
    //});
    
    
    
	$('#latest-commit').hide();
	$('#latest-commit-title').hide();
	           
	//setTimeout(function (){
        //    repositoryLoad();
        //}, 800); // Only load the repositories after a delay.
	
	//$('#latest-commit').load("index.html .subtitle"); //  #commit .message
	//$('#j').load('http://github.com/tchalvak/ninjawars/tree/master #commit');
	//$('#latest-commit').show();
	//$('#latest-commit-title').show();
	var main = $('#main-body');
	if(main.width() > 1000){
		// Optimally, this should only happen for computer browsers and not handheld. 
	    loadLastCommitMessage();
		main.addClass('large-body');
        } else {
            // For smallscreens, nullify target= attributes.
            $('a[target]').attr('target', '');
        }

});
