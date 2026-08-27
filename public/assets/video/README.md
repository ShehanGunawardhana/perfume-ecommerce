# Put your perfume video here

File expected at EXACTLY:

    public/assets/video/perfume-showcase.mp4

Referenced in: resources/views/home.blade.php, inside the
`#scent-ribbon` section, and scrubbed by
resources/js/animations/video-scroll.js.

Requirements for the scroll-scrub effect to look good:
- MP4, H.264 codec (broadest browser support)
- Landscape / wide aspect ratio (the section is full-bleed, object-fit: cover)
- Keep it under ~15-20MB — it loads on the home page. If your source file
  is larger, compress it first, e.g.:

    ffmpeg -i your-source-video.mov -vcodec libx264 -crf 24 -preset slow \
      -an public/assets/video/perfume-showcase.mp4

  (`-an` strips audio since the video is muted/scrubbed, not played with sound —
  that alone usually cuts file size a lot.)

If you want to rename the file instead of matching this name exactly,
update the `<source src="...">` path in resources/views/home.blade.php.
