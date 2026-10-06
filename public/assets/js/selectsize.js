$(document).ready(function () {
    $('#bidang_id').selectize({
        create: true, // supaya bisa input manual
        sortField: 'text',
        maxItems: 1 // single select
    });
    $('#perguruan_id').selectize({
        create: true,
        sortField: 'text',
        maxItems: 1
    });
    $('#kota_perguruan_id').selectize({
        create: true,
        sortField: 'text',
        maxItems: 1
    });
});