$(document).ready(function() {
  $('[data-toggle=offcanvas]').click(function() {
    $('.row-offcanvas').toggleClass('active');
  });
});
 $('button[data-loading-text]').click(function () {
    $(this).button('loading');
    
});
    $(function () {
        $("[data-toggle='popover']").popover();
    });
$( document ).ajaxStart(function() {
  $( "#loading" ).show();
});
$( document ).ajaxStop(function() {
  $( "#loading" ).hide();
});
 function submitPoll(id) {
            var str = "";
            $(':radio').each(function() {
                str += this.checked ? "1," : "0,";

            });
            //alert(str);
            var param = "?action=vote&id=" + id + "&ans=" + str;
            //alert("./admin/_poll.php" + param)
           
            $.ajax({
                url: "./admin/_poll.php" + param,
                type: "POST",
                cache: false
            })
                    .done(function(html) {
                //alert("Submitted" + html);
                loadpoll(id);
                
            })


        }
        function loadpoll(id){
            $("#polldiv").html("Loading ...");
            $.ajax({
                    url: "./admin/_poll.php?action=result&id="+id,
                    type: "POST",
                    cache: false
                })
                        .done(function(html) {
                    $("#polldiv").html(html);
                })
        }
        function invitefriend(email){
                       
            if($.trim(email)==""){
                $("#friendemail").css("border-color","red")
                setTimeout(function() { $('button[data-loading-text]').button("reset"); }, 100);
                return;
            }
            $("#friendemail").css("border-color","");

            $.ajax({
                    url: "../activity/_register.php?action=invitefriend&email="+email,
                    type: "POST",
                    cache: false
                })
                        .done(function(html) {
                            $("#friendemail").val("");
                })
        }        //
        function changepassword(password){
            if($.trim(password)==""){
                $("#password").css("border-color","red")
                setTimeout(function() { $('button[data-loading-text]').button("reset"); }, 100);
                return;
            }
            $("#password").css("border-color","");

            $.ajax({
                    url: "_register.php?action=changepassword&password="+password,
                    type: "POST",
                    cache: false
                })
                        .done(function(html) {
                   $("#password").val("");
                })
        }
        function resetpassword(email){
           if($.trim(email)==""){
                $("#email").css("border-color","red")
                setTimeout(function() { $('button[data-loading-text]').button("reset"); }, 100);
                return;
            }
            $("#email").css("border-color",""); 
           //alert("./activity/_register.php?action=resetpassword&email="+email);
           $("#status").html("Sending...");
            $.ajax({
                    url: "./activity/_register.php?action=resetpassword&email="+email,
                    type: "POST",
                    cache: false
                })
                        .done(function(html) {
                   $("#status").html('<div class="alert alert-warning">'+html+'</div>');
                   $('#email').val("")
                })
        }