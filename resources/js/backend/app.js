import 'alpinejs'

window.$ = window.jQuery = require('jquery');
window.Swal = require('sweetalert2');

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// CoreUI
require('@coreui/coreui');

// Plugin url
require('../plugins');
