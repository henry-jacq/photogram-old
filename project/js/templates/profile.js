// Count only user posts
$.post("/api/posts/count?mode=user", function (o) {
  console.log(o), $("#totalUserPosts").text(o.count);
});
