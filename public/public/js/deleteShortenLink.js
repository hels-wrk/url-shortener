/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************************!*\
  !*** ./resources/js/deleteShortenLink.js ***!
  \*******************************************/
$('.delete').click(function (event) {
  event.preventDefault();

  var _token = $('meta[name="csrf-token"]').attr('content');

  var shortLink = $(".delete").val();
  $.ajax({
    url: '/delete-shortUrl',
    type: "POST",
    data: {
      'shortLink': shortLink,
      "_token": _token
    },
    success: function success(response) {
      console.log(shortLink);
    },
    error: function error(_error) {
      console.log(_error);
    },
    complete: function complete() {
      window.location.href = '/dashboard';
    }
  });
});
/******/ })()
;