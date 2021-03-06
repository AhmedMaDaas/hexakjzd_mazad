<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>

<video
  id="my-player"
  controls
  style="width: 100%; max-width: 500px;"
/>

<script>
  const videoEl = document.querySelector('#my-player');
  const src = '{{ $live }}';
  if (videoEl.canPlayType('application/vnd.apple.mpegurl')) {
    // Some browers (safari and ie edge) support HLS natively
    videoEl.src = src;
  } else if (Hls.isSupported()) {
    const hls = new Hls();
    hls.loadSource(src)
    hls.attachMedia(videoEl);
  } else {
    console.error("This is a legacy browser that doesn't support MSE");
  }
</script> 