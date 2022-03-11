import grapesjs from 'grapesjs';
import 'grapesjs/dist/css/grapes.min.css';
require('grapesjs-preset-webpage');


var editor = grapesjs.init({
    container : '#gjs',
    plugins: ['gjs-preset-webpage'],
    pluginsOpts: {
      'gjs-preset-webpage': {
        // options
      }
    }
});
