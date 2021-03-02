var viewChannel = pusher.subscribe('confirm-winner-channel');
viewChannel.bind('confirm-winner', function(data) {
  $('#winnerModal').modal('show');
  $('#winnerModal .load').addClass('hidden');
  $('#winnerModal img').removeClass('hidden');
  var number = data.winnerNumber == null ? 'Unset' : data.winnerNumber;
  $('#winnerModal span').text(data.winnerName + ' : ' + number);
});