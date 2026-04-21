<footer class="footer">
    <div class="row g-0 justify-content-between fs--1 mt-4 mb-3">
      <div class="col-12 col-sm-auto text-center">
        <p class="mb-0 text-600">
            Thank you for using {{ config('app.name') }} Dashboard 
            <span class="d-none d-sm-inline-block">| </span>
            <br class="d-sm-none" /> 
            {{ date('Y') }} &copy;
        </p>
      </div>
      <div class="col-12 col-sm-auto text-center">
        <p class="mb-0 text-600">{{ config('asinusa.version', '1.0') }}</p>
      </div>
    </div>
</footer>