"use strict";

drift.on('ready', function (api) {
  // hide the widget when it first loads
  api.widget.hide(); // show the widget when you receive a message

  drift.on('message', function (e) {
    api.widget.show();
  }); // hide the widget when you close the chat

  drift.on('chatClose', function (e) {
    api.widget.hide();
  });
});