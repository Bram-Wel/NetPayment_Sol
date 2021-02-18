@stack('modals')

@stack("scripts")
<script src="{{ asset('js/assets/jquery-3.5.1.min.js') }}"></script>
<script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
<script>
    if ('ontouchstart' in document.documentElement) {
        document.addEventListener('touchstart', onTouchStart, {passive: true});
    }
</script>
</body>
</html>
