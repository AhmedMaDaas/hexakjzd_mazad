var progressId = 0;

function _(el) {
  return document.getElementById(el);
}

function uploadFile(id) {
  var url = $('input[name="url"]').val();
  var token = $('input[name="_token"]').val();
  progressId = 'progressBar' + id;
  $('#' + progressId).removeClass('hidden');

  var file = _(id).files[0];
  // alert(file.name+" | "+file.size+" | "+file.type);
  var formdata = new FormData();
  formdata.append("file", file);
  formdata.append("_token", token);
  var ajax = new XMLHttpRequest();
  ajax.upload.addEventListener("progress", progressHandler, false);
  ajax.addEventListener("load", completeHandler, false);
  ajax.open("POST", url + "/admin/upload-file");
  ajax.send(formdata);
}

function progressHandler(event) {
  var percent = (event.loaded / event.total) * 100;
  _(progressId).value = Math.round(percent);
}

function completeHandler(event) {
  _(progressId).value = 0; //wil clear progress bar after successful upload
  $('#' + progressId).addClass('hidden');
}