define(['jquery'], function($){
  "use strict";
      return function updatePostBlock(cur, next)
      {
          $(".headbands-post-list-item#item-" + cur).attr('class', 'headbands-post-list-item disabled');
          $(".headbands-post-list-item#item-" + next).attr('class', 'headbands-post-list-item enabled');
      }
});
