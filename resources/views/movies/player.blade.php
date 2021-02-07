<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $movie }}</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('js/app.js') }}">
    <script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>

    <style>
        body {
            padding: 0;
            margin: 0;
            background: black;
        }

        video {
            left: 50%;
            min-height: 100%;
            min-width: 100%;
            position: absolute;
            top: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>
<body>
<div>
    <video class="w-full" autoplay id="video" style="height: 100vh!important" controls preload="auto"
           disablePictureInPicture poster="{{ $poster }}">
    </video>
    <div class="controls" id="video-controls" data-state="hidden">
        <div class="video-title">
            <h4>{{ $movie }}</h4>
        </div>
    </div>
    <script src="//cdn.jsdelivr.net/npm/hls.js@latest"></script>
    <script>
        var config = {
            autoStartLoad: true,
            startPosition: -1,
            debug: false,
            capLevelOnFPSDrop: false,
            capLevelToPlayerSize: false,
            initialLiveManifestSize: 1,
            maxBufferLength: 200,
            maxMaxBufferLength: 260,
            maxBufferSize: 60 * 1000 * 1000,
            maxBufferHole: 0.5,
            highBufferWatchdogPeriod: 2,
            nudgeOffset: 0.1,
            nudgeMaxRetry: 3,
            maxFragLookUpTolerance: 0.25,
            liveSyncDurationCount: 3,
            liveMaxLatencyDurationCount: Infinity,
            liveDurationInfinity: false,
            liveBackBufferLength: Infinity,
            enableWorker: true,
            enableSoftwareAES: true,
            manifestLoadingTimeOut: 10000,
            manifestLoadingMaxRetry: 1,
            manifestLoadingRetryDelay: 1000,
            manifestLoadingMaxRetryTimeout: 64000,
            startLevel: undefined,
            levelLoadingTimeOut: 10000,
            levelLoadingMaxRetry: 4,
            levelLoadingRetryDelay: 1000,
            levelLoadingMaxRetryTimeout: 64000,
            fragLoadingTimeOut: 20000,
            fragLoadingMaxRetry: 6,
            fragLoadingRetryDelay: 1000,
            fragLoadingMaxRetryTimeout: 64000,
            startFragPrefetch: false,
            testBandwidth: true,
            progressive: false,
            lowLatencyMode: true,
            fpsDroppedMonitoringPeriod: 5000,
            fpsDroppedMonitoringThreshold: 0.2,
            appendErrorMaxRetry: 3,
            enableWebVTT: true,
            enableIMSC1: true,
            enableCEA708Captions: true,
            stretchShortVideoTrack: false,
            maxAudioFramesDrift: 1,
            forceKeyFrameOnDiscontinuity: true,
            abrEwmaFastLive: 3.0,
            abrEwmaSlowLive: 9.0,
            abrEwmaFastVoD: 3.0,
            abrEwmaSlowVoD: 9.0,
            abrEwmaDefaultEstimate: 500000,
            abrBandWidthFactor: 0.95,
            abrBandWidthUpFactor: 0.7,
            abrMaxWithRealBitrate: false,
            maxStarvationDelay: 4,
            maxLoadingDelay: 4,
            minAutoBitrate: 0,
            emeEnabled: false,
            widevineLicenseUrl: undefined,
            drmSystemOptions: {},
        };

        if (Hls.isSupported()) {
            var video = document.getElementById('video');
            var hls = new Hls(config);

            video.disablePictureInPicture = true;
            video.on('contextmenu', function () {
                return false;
            });
            // bind them together
            hls.attachMedia(video);
            // MEDIA_ATTACHED event is fired by hls object once MediaSource is ready
            hls.on(Hls.Events.MEDIA_ATTACHED, function () {
                hls.loadSource('{{ addslashes($url) }}');
                hls.on(Hls.Events.MANIFEST_PARSED, function (event, data) {
                });
            });
            video.volume = {{ \App\Models\Volume::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->value('volume') }}
                video.onvolumechange = function () {
                $.ajax({
                    type: 'POST',
                    url: '/api/user/volume/save',
                    data: {'user': {{ \Illuminate\Support\Facades\Auth::user()->id }}, 'volume': video.volume},
                    success: function (response) {
                    }
                })
            }
            video.play();

            video.onplay = function () {
                let duration = video.duration;
                $.ajax({
                    type: 'POST',
                    url: '/api/user/watcher/save',
                    data: {
                        'user': {{ \Illuminate\Support\Facades\Auth::user()->username}},
                        'duration': duration,
                        'movie': {{ $movie }} },
                    success: function (response) {
                        console.log(response);
                    }
                })
            }
        }
    </script>
</div>
</body>
</html>

