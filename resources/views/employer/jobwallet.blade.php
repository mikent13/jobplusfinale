
@extends('masters.EmpPrimary')
@section('css')
<link rel="stylesheet" href="/bootstrap/css/employer-jobpost.css">
<link rel="stylesheet" href="/css/malot-timepicker.css">
@endsection

@section('body')
@include('employer.modals.jobpage.jobposting')
@include('employer.modals.jobpage.recommended')

 <div class="hero">
  <div class="container">
    <h1><b>JOBPLUS WALLET</b></h1>
    
  </div>
</div>

<div class="container">
  <div class="row">
    <h1 class="up-header">You currently have  <div class="btn btn-primary" id="display_credit" size="100px"></div> credits</h1> 
  </div>
  <hr>
<div class="col-xs-12 dash-content">
        <br><br>
        <div class="col-md-4">
          <div class="panel panel-default">
                  <div class="panel-heading">
                   <h4> Post Credit A </h4>
                  </div>
                  <div class="panel-body">
                   <center>
                   <p><b><h1>30</h1></b></p>
                   <p><h2>Credits</h2></p>
                  <br><br>
                  <p>Php 50.20 <br>
                  (Php 1.67/credit)</p>
                  </center>
                  </div>

                  <div class="panel-footer">
                  <center>
                <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="hosted_button_id" value="7N6PTSWMXE7QA">
                <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" id="postA" name="submit" alt="PayPal - The safer, easier way to pay online!">
                <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                </form>

                </center>
                </div>
          </div>
        </div>

      <div class="col-md-4">
          <div class="panel panel-default">
                  <div class="panel-heading">
                   <h4> Post Credit B </h4>
                  </div>
                  <div class="panel-body">
                   
                   <center>
                   <p><b><h1>50</h1></b></p>
                   <p><h2>Credits</h2></p>
                  <br><br>
                  <p>Php 80.00 <br>
                  (Php 1.60/credit)</p>
                  </center>
                  </div>

                  <div class="panel-footer">
                  <center>
                <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="hosted_button_id" value="ZCDGEDG2USL7C">
                <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                </form>


                </center>
                </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="panel panel-default">
                  <div class="panel-heading">
                   <h4> Post Credit C </h4>
                  </div>
                  <div class="panel-body">
                   <center>
                   <p><b><h1>100</h1></b></p>
                   <p><h2>Credits</h2></p>
                  <br><br>
                  <p>Php 150.00<br>
                  (Php 1.50/credit)</p>
                  </center>
                  </div>

                  <div class="panel-footer">
                  <center>
                <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="hosted_button_id" value="K484DW78J3VDL">
                <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" class="btn-buy" alt="PayPal - The safer, easier way to pay online!">
                <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                </form>
                </center>
                </div>
          </div>
        </div>
        </div>
          <center>
            <p>Save money and get free bonus credits when you buy in bulk.</p>
          </center>
        </div>
</div>
@endsection

@section('js')
<script src="/js/jquery-1.11.1.min.js"></script>
<script src="/bootstrap/js/bootstrap.min.js"></script>
<script src="/bootcard/js/bootcards.min.js"></script>
<script src="/bootstrap/bootstrap-select.js"></script>
<script src="/calendar/moment.min.js"></script>
<script src="/js/malot-timepicker.js"></script>
<script src="/sweetalert/sweetalert.min.js"></script>
<script type="/js/employer-dashboard.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBJJH4SL6eCDPu7N5C-2XcBt8jpZJeMyQ&libraries=places"></script>
@endsection