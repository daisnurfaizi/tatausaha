<script src="{{ URL::asset('build/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
<script src="{{ URL::asset('build/js/plugins.js') }}"></script>
<script>
    function toggleTheme() {

        var htmlElement = document.documentElement;

        // Extract the value of data-sidebar
        var dataSidebarValue = htmlElement.getAttribute('data-bs-theme');


        // save to local storage

        if (dataSidebarValue === 'dark') {
            htmlElement.setAttribute('data-sidebar', 'light');
            localStorage.setItem('data-bs-theme', dataSidebarValue);
        } else {
            htmlElement.setAttribute('data-sidebar', 'dark');
            localStorage.setItem('data-bs-theme', dataSidebarValue);
        }


        // Display the value using an alert (you can replace this with any action you want)

    }
</script>
@yield('script')
@yield('script-bottom')
