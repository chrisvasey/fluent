@push('styles')
    <link href="path/to/grapes.min.css" rel="stylesheet"/>
    <link href="path/to/grapesjs-preset-webpage.min.css" rel="stylesheet"/>
@endpush

<div id="gjs"></div>

@push('scripts')
<script src="path/to/grapes.min.js"></script>
<script src="path/to/grapesjs-preset-webpage.min.js"></script>
<script type="text/javascript">
  var editor = grapesjs.init({
      container : '#gjs',
      plugins: ['gjs-preset-webpage'],
      pluginsOpts: {
        'gjs-preset-webpage': {
          // options
        }
      }
  });
</script>
@endpush
