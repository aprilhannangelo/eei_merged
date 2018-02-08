<!-- HIDDEN FORMS -->
  <!-- SERVICE REQUEST FORM -->
  <form id="service" name="service" method="post">
    <div id="service" class="servicet">
      <div class="search-bar"><h5 class="body-header"><b>New Service Request </b></h5></div>
        <hr>
        <div class="row">
          <div class="col s12 m12 l6" id="form">
            <div class="row" id="request-form-row3">
              <div class="col s12">
                <div class="input-field" id="request-form">
                  <input placeholder="<?php echo $_SESSION['first_name'] . ' '. $_SESSION['last_name'] ?>" name="rname" type="text" disabled>
                  <label for="rname">Requestor's Name</label>
                </div>
              </div>
            </div>
            <div class="row" id="request-form-row2">
              <div class="col s12">
                <!-- <i class="tiny material-icons" id="form">event</i>Date Prepared: -->
                <div class="input-field" id="request-form">
                  <input type="text"  id="date_prepared" name="date_prepared" disabled>
                  <label for="date_prepared">Date Prepared (YYYY/MM/DD)</label>
                </div>
              </div>
            </div>
          </div>
          <div class="col s12 m12 l6" id="form">
            <div class="row" id="request-form-row3">
              <div class="col s12">
                <div class="input-field" id="request-form">
                  <input placeholder=" " class="title" name="title" type="text" data-length="40" class="validate" required>
                  <label for="title">Request Title</label>
                </div>
              </div>
            </div>
            <div class="row" id="request-form-row">
              <div class="input-field">
                <textarea id="textarea1" placeholder=" " class="materialize-textarea" name="request_details" required></textarea>
                <label for="textarea1" required>Details</label>
              </div>
            </div>
            <div class="row" id="request-form-row2">
              <input class="waves-effect waves-light submit" id="request-form" name="submit" type="submit" value="Submit">
              <input class="waves-effect waves-light cancel" id="request-form" name="submit" type="submit" value="Cancel">
            </div>
          </div>
          </div>
        </div>
  </form> <!-- End of Service Request Form -->

  <!-- USER ACCESS FORM  -->
  <form id="access" name="access" method="post">
    <div id="access" class="accesst">
      <div class="search-bar"><h5 class="body-header"><b>New Access Request</b></h5>
      </div>
        <hr>
          <div class="row">
            <!-- Start of LEFT column -->
            <div class="col s12 m12 l6" id="form">
              <h6>Request Details</h6>
              <div class="col s12 m12 l6">
                <div class="row" id="request-form-row4">
                  <div class="col s12">
                    <!-- <i class="tiny material-icons" id="form">event</i>Date Prepared: -->
                    <div class="input-field" id="request-form">
                      <input type="text"  id="date_prepared2" name="date_prepared2" disabled>
                      <label for="date_prepared2">Date Prepared (YYYY/MM/DD)</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col s12 m12 l6">
                <div class="row" id="request-form-row4">
                  <div class="col s12">
                    <div class="input-field" id="request-form">
                      <input placeholder=" " name="rc_no" type="number" class="validate">
                      <label for="rc_no">R.C. Number</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row" id="request-form-row3">
                <div class="col s12">
                  <div class="input-field" id="request-form">
                    <input placeholder=" " class="title" name="title" type="text" data-length="40" class="validate" required>
                    <label for="title">Request Title</label>
                  </div>
                </div>
              </div>
              <div class="row" id="request-form-row2">
                <div class="col s12">
                  <div class="input-field" id="request-form">
                    <input placeholder=" " name="company" type="text" class="validate">
                    <label for="company">Company</label>
                  </div>
                </div>
              </div>
              <div class="row" id="request-form-row2">
                <div class="col s12">
                  <div class="input-field" id="request-form">
                    <input placeholder=" " name="dp" type="text" class="validate">
                    <label for="Department/Project">Department/Project</label>
                  </div>
                </div>
              </div>
              <div class="row" id="request-form-row2">
                <div class="col s12">
                  <div class="input-field" id="request-form">
                    <input placeholder=" " name="access_request" type="text" class="validate">
                    <label for="Access Request">Access Request</label>
                  </div>
                </div>
              </div>
            </div> <!-- End of LEFT column -->


            <!-- Start of RIGHT column -->
            <div class="col s12 m12 l6" id="form">
              <h6>Ticket Details</h6>
              <div class="row" id="request-form-row">
                <div class="col s12">
                  <div class="input-field" id="request-form">
                    <input placeholder=" " name="names" type="text" class="validate">
                    <label for="Names">Name/s</label>
                  </div>
                </div>
              </div>
              <div class="row" id="request-form-row3">
                <div class="col s12">
                  <div class="input-field search-box" id="request-form">
                    <input placeholder=" " name="checker" autocomplete="off" type="text" class="validate">
                    <div class="result"></div>
                      <label for="approver">Checker</label>
                  </div>
                </div>
              </div>
              <div class="row" id="request-form-row2">
                    <div class="col s12">
                      <div class="input-field search-box" id="request-form">
                        <input placeholder=" " name="approver" autocomplete="off" type="text" class="validate">
                        <div class="result"></div>
                        <label for="approver">Approver</label>
                      </div>
                    </div>
                  </div>
              <div class="row" id="request-form-row2">
               <div class="col s12">
                 <div class="input-field" id="request-form">
                   <input type="text" class="datepicker"  id="expiry_date" name="expiry_date" placeholder="">
                   <label for="expiry_date">Expiry Date (YYYY/MM/DD)</label>
                 </div>
               </div>
              </div>
              <div class="row" id="request-form-row2">
                <div class="col s12">
                  <input class="waves-effect waves-light submit" id="request-form" name="submit" type="submit" value="Submit">
                  <input class="waves-effect waves-light cancel" id="request-form" name="submit" type="submit" value="Cancel">
                </div>
              </div>
            </div>  <!-- End of RIGHT column -->
          </div> <!-- End of row -->
    </div> <!-- End of class accesst-->
  </form> <!-- End of User Access Request Form -->
<!-- END OF HIDDEN FORMS  -->
