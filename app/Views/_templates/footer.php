<?php
helper('filesystem');
if (!function_exists('get_file_date')) {
    function get_file_date($file): int
    {
        return get_file_info(APPPATH . '../public/' . $file, 'date')['date'];
    }
} ?>
</body>
<script src="/static/js/bootstrap.bundle.min.js?version=5.3.3" defer></script>
<script src="/static/js/app.js?cache=<?= get_file_date('static/js/app.js') ?>" defer async></script>
<?php if (!url_is('auth/login')) : ?>
    <footer class="border-top border-2 border-primary bg-white">
        <div class="container-fluid py-4">
            <div class="row container-fluid mx-auto mb-2">
                <div class="col-lg-11">
                    <div class="text-muted fw-bold mt-lg-4 h5">System License</div>
                    <div class="text-muted"> All content is available under the <a href="//www.nationalarchives.gov.uk/doc/open-government-licence/version/3/" target="_blank">Open Government Licence v3.0</a>, except where otherwise stated.</div>
                </div>
                <div class="col-lg-1">
                    <img src="/static/images/core5.png" alt="System Logo" class="mt-lg-4">
                </div>
            </div>
        </div>
        <div class="copyright text-white container-fluid px-4 py-2">
            <div class="container-fluid">
                &copy; Copyright of Crown Jewels Lab <?= date('Y') ?>.
            </div>
        </div>
    </footer>
<?php endif; ?>

</html>