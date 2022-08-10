require('./bootstrap')

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import Turbolinks from 'turbolinks'
/* const Swal = require('sweetalert2') */
Turbolinks.start()