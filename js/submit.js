$(document).ready(function() {

    // process the form
    $('form').submit(function(event) {

        // get the form data
        // there are many ways to get this data using jQuery (you can use the class or id also)
        var formData = {
            'name'              : $('input[id=name]').val(),
            'business'             : $('input[id=business]').val(),
            'phone'    : $('input[id=phone]').val(),
            'story'    : $('textarea[id=story]').val(),
            'website'    : $('input[id=website]').val(),
            'image'    : $('input[id=image]').val(),
            'notes'    : $('textarea[id=notes]').val(),
            'updateid'    : $('input[id=updateid]').val(),
            'fb'    : $('input[id=fb]').val(),
            'twitter'    : $('input[id=twitter]').val(),
            'insta'    : $('input[id=insta]').val(),
            'snapchat'    : $('input[id=snapchat]').val(),
            'linkedin'    : $('input[id=linkedin]').val()
        };

        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'submitchef.php', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
                        encode          : true
        });

        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
	Notify("Data sent. Refresh if you don't see it on the chart.",null,null,"success");
	refreshChart();
	hidebutton();
    });
});
function updateForm(chefid) {
chefdata = ""
$.get( "getchef.php?profile="+chefid, function( data ) {
  chefdata = data;
  postQuery(chefdata);
});
}
function postQuery(data) {
	console.log(data);
	console.log(data.name);
	$("#updateid").val(data.chefid);
        $("#name").val(data.name);
        $("#business").val(data.business);
        $("#notes").val(data.notes);
	$("#twitter").val(data.twitter);
        $("#insta").val(data.insta);
        $("#phone").val(data.phone);
	$("#website").val(data.website);
        $("#fb").val(data.fb);
        $("#story").val(data.story);
        $("#image").val(data.image);
        $("#snapchat").val(data.snapchat);
        $("#linkedin").val(data.linkedin);
	$("#cancelupdate").css("display","");
}

function reset() {
        $("#cancelupdate").css("display","none");
	$("form")[0].reset();
}

function hidebutton() {
        $("#cancelupdate").css("display","none");
}
setTimeout(function(){
   refreshChart();
}, 5000);
