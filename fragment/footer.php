<? include("./class/simphp.php"); ?>

<div id="footer" style="margin-top: 25px;">

    <div class="container">

    </div>
</div>
<div id="footer" class="navbar navbar-default navbar-fixed-bottom" style="padding-top: 5px;">

    <div class="container">
        <p class="text-muted credit">SSN Alumni (c) 2013 | <a href="#">Privacy Policy</a> |  <a href="#">Credit</a> | <?= $info ?>.</p>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="forgot">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Forgot UserName / Password ?</h4>
            </div>
            <div class="modal-body">
                <div class="input-group" style="margin-bottom: 10px">
                                <input type="text" class="form-control" id='email' placeholder="abc@ssn.edu.in">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" onclick='resetpassword($("#email").val())'> Reset Password!</button>
                                </span>
            </div>
            <div class="modal-footer">
                <a href="#" id="status"></a>
                <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
                
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-35033623-1']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();

    
</script>
