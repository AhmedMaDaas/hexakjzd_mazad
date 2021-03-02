var viewChannel = pusher.subscribe('choose-winner-channel');
viewChannel.bind('choose-winner', function(data) {
  $('#winnerModal').modal('show');
});