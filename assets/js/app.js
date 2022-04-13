import '../scss/app.scss';

import $ from 'jquery';
import 'bootstrap';

$('#myModal').on('shown.bs.modal', function() {
    $('#myInput').trigger('focus')
})