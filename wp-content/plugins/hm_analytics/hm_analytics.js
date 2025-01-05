document.addEventListener("DOMContentLoaded", function () {
  const video = document.querySelector(".training-video");

  if (!video) {
    return;
  }

  video.addEventListener("ended", function () {
    wp.ajax
      .post("log_client_event", { event: "VIDEO_WATCHED" })
      .done(function (res) {
        console.log("success:", res);
      })
      .fail(function (err) {
        console.log("error:", err);
      });
  });
});
