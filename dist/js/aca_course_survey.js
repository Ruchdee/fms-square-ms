$(function() {
    // Search Items
    $('.searchbar > input').on('keyup', function() {
        var rex = new RegExp($(this).val(), 'i');
        $('.todo-listing .todo-item').hide();
        $('.todo-listing .todo-item').filter(function() {
            return rex.test($(this).text());
        }).show();
    });
});

// #####################################################
// Quill data
// #####################################################
var quill = new Quill('#survey-desc', {
    modules: {
        toolbar: [
            [{ header: [1, 2, false] }],
            ['bold', 'italic', 'underline'],
            ['link', 'image', 'code-block']
        ]
    },
    placeholder: 'รายละเอียดแบบสำรวจ..',
    theme: 'snow' // or 'bubble'
});

$('#addFormModal').on('hidden.bs.modal', function(e) {
    // do something...
    $(this).find("input,textarea,select").val('').end();
    quill.deleteText(0, 2000);
});

$('#add-form').on('click', function(event) {
    event.preventDefault();
    $('#addFormModal').modal('show');
});

$('#form-add').submit(function() {
    $('#survey-desc-txt').val(quill.root.innerHTML.trim());
});

var $btns = $('.list-group-item-action').click(function() {
    if (this.id == 'all-todo-list') {
        var $el = $('.' + this.id).fadeIn();
        $('#all-todo-container > div').not($el).hide();
    } else if (this.id == 'current-todo-delete') {
        var $el = $('.' + this.id).fadeIn();
        $('#all-todo-container > div').not($el).hide();
    } else {
        var $el = $('.' + this.id).fadeIn();
        $('#all-todo-container > div').not($el).hide();
    }
    $btns.removeClass('active');
    $(this).addClass('active');
});

function taskItem() {
    $('.todo-item .content-todo').on('click', function(event) {
        event.preventDefault();

        var $_taskTitle = $(this).parents('.todo-item').children().find('.todo-header').attr('data-todo-header');
        var $todoHtml = $(this).find('.todo-subtext').attr('data-todosubtext-html');

        $('.task-heading').text($_taskTitle);
        $('.task-text').html($todoHtml);

        $('#todoShowListItem').modal('show');
    });
}

taskItem();