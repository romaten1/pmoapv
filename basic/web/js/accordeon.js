$('#accordion').on('shown.bs.collapse', function () {
  
  var openPanel = $(this).find('.in').parents('.panel');
  openPanel.prependTo('#accordion');
  
});