<!-- Scripts -->
<script src="{{ asset('manage/js/app.js') }}"></script>
<script src="{{ asset('manage/js/jQ-bd.js') }}"></script>
<script src="{{ asset('manage/js/bd.js') }}"></script>
<script src="{{ asset('manage/js/vendor/select2.min.js') }}"></script>
<noscript>
    <div class="noscript">Javascript Require</div>
</noscript>
<script>
$('.select-two').select2();
document.addEventListener("DOMContentLoaded", function(){
    bd.showTime('time');
});
</script>
@yield('bottom')