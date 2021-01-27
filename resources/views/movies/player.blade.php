<link href="https://unpkg.com/video.js/dist/video-js.css" rel="stylesheet">
<!-- Fantasy -->
<link href="https://unpkg.com/@videojs/themes@1/dist/fantasy/index.css"
      rel="stylesheet">

<link rel="stylesheet" href="{{ mix('css/app.css') }}">
<link rel="stylesheet" href="{{ mix('js/app.js') }}">


<style>
    .vjs-theme-fantasy .vjs-big-play-button {
        color: #ED3237;
    }

    .video-js .vjs-control-bar {
        background: transparent;
    }

    .vjs-theme-fantasy .vjs-play-progress, .vjs-theme-fantasy .vjs-play-progress:before {
        background-color: #ED3237;
    }

    .video-js .vjs-progress-holder {
        height: 0.2em;
    }

    body {
        padding: 0;

    }

    .vjs-poster {
        background-size: 100% !important;
    }
</style>

<div>
    <video-js id="my_video_1" class="vjs-theme-fantasy w-full" style="height: 100vh!important" controls preload="auto">
        <source src="{{ $url }}"
                type="application/x-mpegURL">
    </video-js>

    <script src="https://unpkg.com/video.js/dist/video.js"></script>
    <script src="https://unpkg.com/@videojs/http-streaming/dist/videojs-http-streaming.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/videojs-contextmenu-ui@5.2.0/dist/videojs-contextmenu-ui.min.js"></script>


    <script>
        var player = videojs('my_video_1', {
            poster: "{{ $poster }}",
            autoplay: true,
            preload: 'auto',
            notSupportedMessage: 'Could not play the video',
            responsive: true,

            userActions: {
                hotkeys: function (event) {
                    if (event.which === 32) {
                        if (!this.paused) {
                            this.pause();
                        } else {
                            this.play();
                        }
                    }
                }
            }

        })
    </script>
</div>

