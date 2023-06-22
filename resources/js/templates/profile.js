// Count only user posts
if (window.location.pathname === "/profile") {
  $.post("/api/posts/count?mode=user", function (o) {
    $("#totalUserPosts").text(o.count);
  });
}
