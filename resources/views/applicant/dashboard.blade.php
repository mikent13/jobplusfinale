@extends('masters.AppPrimary')

@section('body')
        <div class="container">
        <h1>Schedule</h1>
		<hr>
        	<div class="col-md-6"></div>
        	<div class="col-md-6">
        		<h3>Active Job</h3>
                        <div id="activeJob">
                                <div id="active" class="list-group">
                                   <div class="list-group-item">
                                        <h3 class="list-group-item-heading" id="actitle"></h3>
                                        <p class="list-group-item-text" id="actdesc"></p>
                                        <h4 class="list-group-item-text" id="actsched"></h4>
                                        <p id="actemployer"></p>
                                        <p id="actworkid"></p>
                                        <p id="actschedid"></p>
                                        <div class="btn btn-primary" id="act-startbtn">
                                                <p>Start Job</p>
                                        </div>
                                        <div class="btn btn-default" id="act-endbtn">
                                                <p>End Job</p>
                                        </div>
                                   </div> 
                                    </div>
                                   <div class="modal fade" id="endModal" role="dialog">
                                      <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h3 class="modal-title">How's your experience working with 
                                            <p></p></h3>
                                          </div>
                                          <div class="modal-body">
                                            <input id="rating-system" name="rate" type="number" class="rating" min="1" max="5" step="1">
                                            <hr>
                                             <div class="form-group ">
                                               <textarea style="width:100%;height:130px;" name="review"  id="review" form="review" placeholder="Kindly give a short review."></textarea>
                                            </div>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-default" id="rev-endbtn">Submit</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>    
                               
                                <div id="noactive">
                                        <p>There's no active job as of the moment.</p>
                                </div>
                        </div>
	       		<h3>Upcoming Jobs</h3>
                        <div id="upcomingJob">
                                <p>There's no upcoming job as of the moment.</p>
                        </div>
                        <h3>Ongoing Jobs</h3>
                        <div id="ongoingJob">
                                    <div id="ongoing-noactive">
                                <p>There's no ongoing job as of the moment.</p>
                                </div>
                        </div>
        	</div>
        </div>	
@endsection

@section('js')
 <script src="/js/finalecustom.js"></script>
 <script src="/js/star-rating.js" type="text/javascript"></script>
@endsection