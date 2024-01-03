/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
import Swal from 'sweetalert2/dist/sweetalert2.js';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const infoMeta = document.querySelector('meta[name="info"]');
if (infoMeta) {
    Swal.fire({
        icon: 'info',
        title: infoMeta.content,
    });
}