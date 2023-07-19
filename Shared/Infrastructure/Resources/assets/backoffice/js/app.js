$(document).ready(function () {
    window._token = $('meta[name="csrf-token"]').attr('content')

    $('.select-all').click(function () {
        let $select2 = $(this).parent().siblings('.select2')
        $select2.find('option').prop('selected', 'selected')
        $select2.trigger('change')
    })
    $('.deselect-all').click(function () {
        let $select2 = $(this).parent().siblings('.select2')
        $select2.find('option').prop('selected', '')
        $select2.trigger('change')
    })

    $('.select2').select2();
})


let titleInput = document.getElementById('title');
let slugInput = document.getElementById('slug');
if(!titleInput){
    titleInput = document.getElementById('name');
}

if (titleInput && slugInput) {
    titleInput.addEventListener('input', () => {
        let textTitle = titleInput.value;
        let slugged = textTitle.replace(/\s+/g, '-');
        slugInput.value = slugged.normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase();
    });
}
