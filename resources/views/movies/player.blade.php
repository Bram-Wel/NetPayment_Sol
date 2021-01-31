<link rel="stylesheet" href="{{ mix('css/app.css') }}">
<link rel="stylesheet" href="{{ mix('js/app.js') }}">

<style>
    body {
        padding: 0;
        margin: 0;
        background: black;
    }

    video {
        object-fit: contain;
    }
</style>

<div>
    <video class="w-full" id="video" style="height: 100vh!important" controls preload="auto">
    </video>
    <script src="//cdn.jsdelivr.net/npm/hls.js@latest"></script>
    <script>
        var config = {
            autoStartLoad: true,
            startPosition: -1,
            debug: false,
            capLevelOnFPSDrop: false,
            capLevelToPlayerSize: false,
            initialLiveManifestSize: 1,
            maxBufferLength: 100,
            maxMaxBufferLength: 160,
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
            // bind them together
            hls.attachMedia(video);
            // MEDIA_ATTACHED event is fired by hls object once MediaSource is ready
            hls.on(Hls.Events.MEDIA_ATTACHED, function () {
                hls.loadSource('{{ addslashes($url) }}');
                hls.on(Hls.Events.MANIFEST_PARSED, function (event, data) {
                });
            });
        }
        video.play();
    </script>
</div>

