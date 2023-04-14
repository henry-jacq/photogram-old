// Count only user posts
$.post("/api/posts/count?mode=user", function (o) {
  $("#totalUserPosts").text(o.count);
});
