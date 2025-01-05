document.addEventListener("DOMContentLoaded", function () {
  const video = document.querySelector(".training-video");
  const accordion = document.querySelector(".training-info-accordion");
  const progressBar = document.querySelector(".video-progres-line");

  const timestampsMap = new Map();

  for (const item of accordion.children) {
    const timestamp = parseInt(item.getAttribute("data-timestamp"));
    if (!timestamp) {
      continue;
    }

    item.addEventListener("click", function () {
      jumpToTimestamp(timestamp);
    });

    timestampsMap.set(timestamp, item);
  }

  function jumpToTimestamp(timestamp) {
    video.currentTime = timestamp;
    video.play();
  }

  function openAccordionItem(item, jump) {
    if (item.classList.contains("expanded")) {
      return;
    }

    for (const item of accordion.children) {
      item.classList.remove("expanded");
    }

    item.classList.add("expanded");

    if (jump) {
      const timestamp = item.getAttribute("data-timestamp");
      jumpToTimestamp(timestamp);
    }
  }

  function updateProgressBar() {
    const progress = (video.currentTime / video.duration) * 100;
    progressBar.style.setProperty("--progress", `${progress}%`);
  }

  video.addEventListener("timeupdate", () => {
    const currentTime = Math.floor(video.currentTime);
    const item = timestampsMap.get(currentTime);

    if (item) {
      openAccordionItem(item);
    }

    updateProgressBar();
  });

  video.addEventListener("seeked", () => {
    const currentTime = Math.floor(video.currentTime);
    const timestamps = Array.from(timestampsMap.keys()).reverse();

    const currentTs = timestamps.find((ts) => currentTime >= ts);

    if (!currentTs) {
      for (const item of accordion.children) {
        item.classList.remove("expanded");
      }
      return;
    }

    openAccordionItem(timestampsMap.get(currentTs));
  });
});
