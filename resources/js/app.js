require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

var Turbolinks = require("turbolinks")
/* const Swal = require('sweetalert2') */
Turbolinks.start()