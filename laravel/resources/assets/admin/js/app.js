$(function () {
  moment.locale('tr');
  $('.icheck').iCheck({
    checkboxClass: 'icheckbox_flat-red',
    radioClass: 'iradio_flat-red',
    increaseArea: '20%' // optional
  });

  $('.select2').select2();
  $('.select2-no-search').select2({
    minimumResultsForSearch: Infinity,
  });

  $('.birthday-picker').datepicker({
    language: "tr",
    startView: 2,
    autoclose: true
  })

  $(":file").filestyle({
    buttonText: "Dosya seç",
    iconName: "fa fa-folder-open",
    placeholder: "Dosya seçilmedi",
    buttonBefore: true,
  });

  $('.date-picker').datepicker({
    language: "tr",
    autoclose: true
  })
  $('.max-length').maxlength({
    alwaysShow: true,
  });
  $('.date-mask').inputmask('dd.mm.yyyy', { 'placeholder': 'GG.AA.YYYY' })
  $('.mobile').inputmask('(999) 999 99 99', { 'placeholder': '(___) ___ __ __' })
  $(".url-mask").inputmask({ regex: "https?://.*" });
  $('[data-toggle="popover"]').popover();
  $('.multi-select').multiSelect({
    selectableHeader: "<input type='text' class='search-input' style='width: 100%; margin-bottom: 10px;' autocomplete='off' placeholder='Arama'>",
    selectionHeader: "<input type='text' class='search-input' style='width: 100%; margin-bottom: 10px;' autocomplete='off' placeholder='Arama'>",
    afterInit: function(ms){
      $('#multiselect-loading').remove();
      var that = this,
      $selectableSearch = that.$selectableUl.prev(),
      $selectionSearch = that.$selectionUl.prev(),
      selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
      selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

      that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
      .on('keydown', function(e){
        if (e.which === 40){
          that.$selectableUl.focus();
          return false;
        }
      });

      that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
      .on('keydown', function(e){
        if (e.which == 40){
          that.$selectionUl.focus();
          return false;
        }
      });
    },
    afterSelect: function(){
      this.qs1.cache();
      this.qs2.cache();
    },
    afterDeselect: function(){
      this.qs1.cache();
      this.qs2.cache();
    }
  });
});

$.ajaxSetup({ headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') }});
function deleteItem(slug, message, deleteClass = "delete") {
  $('.' + deleteClass).on('click', function (e) {
    var id = $(this).attr('delete-id');
    var name = $(this).attr('delete-name');
    swal({
      title: "Are you sure?",
      text:  "'" + name + "' " + message,
      type: "warning",
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, Delete!",
      showCancelButton: true,
      cancelButtonText: "No",
      showLoaderOnConfirm: true,
      preConfirm: function (email) {
        return new Promise(function (resolve, reject) {
          $.ajax({
            url: "/admin/" + slug + "/" + id,
            method: "DELETE",
            dataType: "json",
            success: function(result){
              resolve()
            },
            error: function (xhr, ajaxOptions, thrownError) {
              ajaxError(xhr, ajaxOptions, thrownError);
            }
          });
        })
      },
      allowOutsideClick: false,
    }).then(function () {
      $("#" + slug + "-" + id).remove();
      swal({
        title: "Successfully Deleted!",
        type: "success",
        confirmButtonText: "OK",
      });
    })
  });
}

function approveItem(slug, completeMessage, notComleteMessage, callback, completeClass = "complete") {
  $('.' + completeClass).on('click', function (e) {
    var id = $(this).attr('complete-id');
    var name = $(this).attr('complete-name');
    var complete = ($(this).attr('is-complete') == '1' ? 1 : 0);
    $.ajax({
      url: "/admin/" + slug + "/" + id + "/complete",
      method: "PUT",
      dataType: "json",
      data: {
        'complete': complete
      },
      success: function (result) {
        if (approval) {
          $("#complete-" + slug + "-" + id).addClass('hidden');
          $("#uncomplete-" + slug + "-" + id).removeClass('hidden');
        } else {
          $("#complete-" + slug + "-" + id).removeClass('hidden');
          $("#uncomplete-" + slug + "-" + id).addClass('hidden');
        }

      },
      error: function (xhr, ajaxOptions, thrownError) {
        ajaxError(xhr, ajaxOptions, thrownError);
      }
    });

    // swal({
    //   title: "Emin misin?",
    //   text:  "'" + name + "' " + approveMessage,
    //   type: "warning",
    //   confirmButtonColor: "#DD6B55",
    //   confirmButtonText: "Evet, " + (approval ? 'onayla!' : 'onayı kaldır!'),
    //   showCancelButton: true,
    //   cancelButtonText: "Hayır",
    //   showLoaderOnConfirm: true,
    //   preConfirm: function () {
    //     return new Promise(function (resolve, reject) {
    //       $.ajax({
    //         url: "/admin/" + slug + "/" + id + "/approve",
    //         method: "PUT",
    //         dataType: "json",
    //         data: { 'approve': approval },
    //         success: function(result){
    //           resolve()
    //         },
    //         error: function (xhr, ajaxOptions, thrownError) {
    //           ajaxError(xhr, ajaxOptions, thrownError);
    //         }
    //       });
    //     })
    //   },
    //   allowOutsideClick: false,
    // }).then(function () {
    //   if (typeof callback === "function") {
    //     callback(approval, id, name)
    //   }
    //   if (approval) {
    //     $("#approve-" + slug + "-" + id).addClass('hidden');
    //     $("#unapprove-" + slug + "-" + id).removeClass('hidden');
    //     swal({
    //       title: "Başarıyla Onaylandı!",
    //       type: "success",
    //       confirmButtonText: "Tamam",
    //     });
    //   } else {
    //     $("#approve-" + slug + "-" + id).removeClass('hidden');
    //     $("#unapprove-" + slug + "-" + id).addClass('hidden');
    //     swal({
    //       title: "Başarıyla Onayı Kaldırıldı!",
    //       type: "success",
    //       confirmButtonText: "Tamam",
    //     });
    //   }
    // })
  });
}


function ajaxError(xhr, ajaxOptions, thrownError) {
  message = "Unexpected Error!";
  console.log("XHR:");
  console.log(xhr);
  if (xhr.responseText) {
    message = xhr.responseText;
  }
  console.log("Ajax Options:");
  console.log(ajaxOptions);
  console.log("Thrown Error:");
  console.log(thrownError);
  swal({
    title: message,
    type: "error",
    confirmButtonText: "OK",
  });
}

function block(selector) {
  $(selector).block({
    message: null,
  });
}

function unblock(selector) {
  $(selector).unblock();
}
