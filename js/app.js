$(document).ready(function(){


  $('.modal').modal();
  //hide forms on load
  $(".accesst").hide();
  $(".requestort").hide();
  $(".servicet").hide();
  $('.notifications').click(function(){
        $("#notification_count").hide();
    });
  // $("#activity-log").hide();

  //live searching for user access request form
  $('.search-box input[type="text"]').on("keyup input", function(){
      /* Get input value on change */
      var inputVal = $(this).val();
      var resultDropdown = $(this).siblings(".result");
      if(inputVal.length){
          $.get("php_processes/search.php", {term: inputVal}).done(function(data){
              // Display the returned data in browser
              resultDropdown.html(data);
          });
      } else{
          resultDropdown.empty();
      }
  });

  $('.btn-edit').click(function () {
    var currentTD = $(this).parents('tr').find('td');
    if ($(this).html() == 'Edit') {
        currentTD = $(this).parents('tr').find('td');
        $.each(currentTD, function () {
            $(this).prop('contenteditable', true)
        });
    } else {
       $.each(currentTD, function () {
            $(this).prop('contenteditable', false)
        });
    }
    $(this).html($(this).html() == 'Edit' ? 'Save' : 'Edit')
});


$("#save-edits").submit(function(e) {
  e.preventDefault();
  $.ajax({
    url: 'php_processes/admin-edits.php',
    type: 'POST',
    data: $(this).serialize(),
    success: function(data)
     {
       swal({
          title: "Ticket Submitted!",
          text: "Your ticket number is: " +ticketNo,
          type: "success",
          icon: "success"
      }).then(function(){
        window.location="../eei/admin-settings.php";
      });
     }
    })
 });


  // Set search input value on click of result item
  $(document).on("click", ".result p", function(){
      $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
      $(this).parent(".result").empty();
  });

  //initialize select dropdown for materialize [DO NOT REMOVE]
  $('select').material_select();

 $('.tooltipped').tooltip({delay: 50});
  // Clickable table row
  jQuery(document).ready(function($) {
  $(".clickable-row").click(function() {
      window.location = $(this).data("href");
  });


  //if service request from 'New Ticket' dropdown menu is clicked..
  $('.service').click(function(){
    $(".main-body").hide();
    $("#dashboard").hide();
    $(".servicet").show();
    $(".accesst").hide();
    $(".requestort").hide();
  });

  //if access request from 'New Ticket' dropdown menu is clicked..
  $('.access').click(function(){
    $(".main-body").hide();
    $(".accesst").show();
    $(".servicet").hide();
    $(".requestort").hide();
  });

  $('.requestor').click(function(){
    $(".main-body").hide();
    $(".servicet").hide();
    $(".accesst").hide();
    $(".requestort").show();
  });



 //character counter for ticket Title
  $('input#input_text, textarea#textarea1').characterCounter();

  //to prevent user from typing ticket title when charcount reaches 40
  var max = 40;
  $('.title').keypress(function(e) {
      if (e.which < 0x20) {
          // e.which < 0x20, then it's not a printable character
          // e.which === 0 - Not a character
          return;     // Do nothing
      }
      if (this.value.length == max) {
          e.preventDefault();
      } else if (this.value.length > max) {
          // Maximum exceeded
          this.value = this.value.substring(0, max);
      }
  });


  //initialize datepicker of materializecss
  $('.datepicker').pickadate({
     selectMonths: false, // Creates a dropdown to control month
     selectYears: false, // Creates a dropdown of 15 years to control year,
     // today: 'Today',
     today: 'Today',
     clear: 'Clear',
     close: 'Ok',
     closeOnSelect: false // Close upon selecting a date,
   });

 //set current date to field
  var now = new Date();
  var day = ("0" + now.getDate()).slice(-2);
  var month = ("0" + (now.getMonth() + 1)).slice(-2);
  var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
  $('#date_prepared').val(today);
  $('#date_prepared2').val(today);

  // Sweet Alert
  $("#service").submit(function(e) {
    e.preventDefault();
    $.ajax({
      url: 'php_processes/service_ticket_process.php',
      type: 'POST',
      data: $(this).serialize(),
      success: function(data)
       {
         ticketNo= JSON.parse(data);
         swal({
            title: "Ticket Submitted!",
            text: "Your ticket number is: " +ticketNo,
            type: "success",
            icon: "success"
        }).then(function(){
          window.location="my-tickets.php";
          $(".main-body").show();
        });
       }
      })
   });

  $("#access").submit(function(e) {
  e.preventDefault();
  $.ajax({
    url: 'php_processes/access_ticket_process.php',
    type: 'POST',
    data: $(this).serialize(),
    success: function(data)
     {
       ticketNo= JSON.parse(data);
       swal({
          title: "Ticket Submitted!",
          text: "Your ticket number is: " +ticketNo,
          type: "success",
          icon: "success"
      }).then(function(){
        window.location="my-tickets.php";
      });
     }
    })
 });

 $("#requestor").submit(function(e) {
   e.preventDefault();
   $.ajax({
     url: 'php_processes/new-requestor.php',
     type: 'POST',
     data: $(this).serialize(),
     success: function(data)
      {
          requestor_name= JSON.parse(data);
          swal("User Added!", "You have added " +requestor_name + " as a user" , "success").then(function(){
            location.reload();
          });
      }
   })
 });

 $('#datatable tbody').on('click', 'tr', function () {
   window.location = $(this).data("href");
 } );




 $("#properties").submit(function(e) {
   e.preventDefault();
   $.ajax({
     url: 'php_processes/updateType-Severity.php',
     type: 'POST',
     data: $(this).serialize(),
     success: function()
      {
         // assignee= JSON.parse(data);
         swal({
            title: "Ticket Properties Saved!",
            text: "",
            type: "success",
            icon: "success"
        }).then(function(){
          location.reload();
          $("#ticket-properties").hide();
        });
      }
   })
 });

 $("#edit-properties").submit(function(e) {
   e.preventDefault();
   $.ajax({
     url: 'php_processes/edit_ticket_properties.php',
     type: 'POST',
     data: $(this).serialize(),
     success: function()
      {
         // assignee= JSON.parse(data);
         swal({
            title: "New ticket properties saved!",
            text: "",
            type: "success",
            icon: "success"
        }).then(function(){

          location.reload();

        });

      }
   })
 });

 $("#activity_log").submit(function(e) {
   e.preventDefault();
   $.ajax({
     url: 'php_processes/activitylog_process.php',
     type: 'POST',
     data: $(this).serialize(),
     success: function()
      {
         // assignee= JSON.parse(data);
         swal({
            title: "Activity log submitted!",
            text: "",
            type: "success",
            icon: "success"
        }).then(function(){
          location.reload();
        });

      }
   })
 });

 $("#check").submit(function(e) {
   if(confirm("Are you sure you want to check this ticket?")){
   e.preventDefault();
   $.ajax({
     url: 'php_processes/check-process.php',
     type: 'POST',
     data: $(this).serialize(),
     success: function()
      {
          swal("Ticket Checked", " ", "success").then(function(){
            location.reload();
            $(".approve-reject").hide();

          });
      }
     })
   }
 });

 $("#cancel").submit(function(e) {
   e.preventDefault();
   swal({
   title: "Are you sure?",
   text: "You will not be able to undo the action.",
   icon: "warning",
   buttons: true,
   dangerMode: true,
 })
 .then((willDelete) => {
   if (willDelete) {
     $.ajax({
         url: 'php_processes/cancel-process.php',
         type: 'POST',
         data: $(this).serialize(),
         success: function()
          {
              swal("Ticket Cancelled", " ", "success").then(function(){
                $(".modal-trigger").hide();
                location.reload();
              });
          }
         })
   } else {
     swal("", "Ticket not cancelled!","success");
   }
 });
 });



 $("#approve").submit(function(e) {
   if(confirm("Are you sure you want to approve this ticket?")){
   e.preventDefault();
   $.ajax({
     url: 'php_processes/approve-process.php',
     type: 'POST',
     data: $(this).serialize(),
     success: function()
      {
          swal("Ticket Approved", " ", "success").then(function(){
            location.reload();
            $(".approve-reject").hide();
          });
      }
     })
   }
 });

 $("#reject").submit(function(e) {
   if(confirm("Are you sure you want to reject this ticket?")){
   e.preventDefault();
   $.ajax({
     url: 'php_processes/reject-process.php',
     type: 'POST',
     data: $(this).serialize(),
     success: function()
      {
          swal("Ticket Rejected", " ", "success").then(function(){
            location.reload();
            $(".approve-reject").hide();
          });
      }
     })
   }
 });


 $("#assignee").submit(function(e) {
   e.preventDefault();
   $.ajax({
     url: 'php_processes/assign-ticket.php',
     type: 'POST',
     data: $(this).serialize(),
     success: function(data)
      {
        assignee= JSON.parse(data);
        swal({
           title: "Ticket Agent Assigned!",
           text: "Ticket agent is now " +assignee,
           type: "success",
           icon: "success"
       }).then(function(){
         location.reload();
       });
      }
     })
 });

 $( "#reassign-button" ).click(function() {
   $( "#reassign" ).toggle( "slow" );
 });

  $( "#activity-log" ).click(function() {
    $( ".comment_input" ).toggle( "slow" );
  });

 $('.edit-button').click(function () {
   for (i = 0; i < 5; i++) {
     document.getElementsByClassName('pflBody')[i].contentEditable = true;
   }
   });

  $(".cancel").click(function(){
   window.history.back();
   return false;
 });
//
// $(".pending").click(function(){
//   $(".pending-tickets").show();
//   $(".all-tickets").hide();
//   $(".inprogress-tickets").hide();
//   $(".closed-tickets").hide();
//   $(".resolved-tickets").hide();
//
// });
//
// $(".inprogress").click(function(){
//  $(".pending-tickets").hide();
//  $(".inprogress-tickets").show();
//  $(".all-tickets").hide();
//  $(".closed-tickets").hide();
//  $(".resolved-tickets").hide();
//
// });
//
// $(".resolved").click(function(){
//  $(".pending-tickets").hide();
//  $(".inprogress-tickets").hide();
//  $(".all-tickets").hide();
//  $(".closed-tickets").hide();
//  $(".resolved-tickets").show();
//
// });
//
// $(".closed").click(function(){
//  $(".pending-tickets").hide();
//  $(".inprogress-tickets").hide();
//  $(".all-tickets").hide();
//  $(".resolved-tickets").hide();
//  $(".closed-tickets").show();
//
// });

// $(".technicals").click(function(){
//  $(".technicals-tickets").show();
//  $(".all-tickets").hide();
// });

$(".accesstickets").click(function(){
 $(".technicals-tickets").hide();
 $(".network-tickets").hide();
 $(".all-tickets").hide();
 $(".access-tickets").show();

});

});
});
