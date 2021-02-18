var check_count = localStorage.getItem("count");
if (check_count == null) {
    localStorage.setItem("count", 0);
}

$(document).ready(function () {

    textareaRefresh($('textarea'));

    onRefresh();

    $('#note').focusout(insertNote);

    $('body').on('focus', '.card-body', mouseover_card);

    $('body').on('focusout', '.card-body', mouseout_card);

    $('body').on('mouseover', '.card-body', mouseover_card);

    $('body').on('mouseout', '.card-body', mouseout_card);

    var card_body;
    var card;

    $('body').on('click', '#delete', deleteNote);

    $('#exampleModalCenter').on('click', '#confirm_delete', deleteDialog);

    $('body').on('focusout', '.card-body__textarea', updateTask);

});


function transition(element) {
    element.style.transition = "all 0.8s";
}

function textareaRefresh(element){
    $(element).each(function () {
        this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;overflow-y:hidden;');
    }).on('input', function () {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });   
}

function onRefresh(){

    var template = document.getElementById('template-addNote').innerHTML;
    var compiled_template = Handlebars.compile(template);

    var count = localStorage.getItem("count");
    for (var i = 1; i <= count; i++) {
        var card_columns = $('.card-columns');
        var rendered = compiled_template({ note_value: localStorage.getItem(i), note_key: i });
        card_columns.prepend(rendered);
    }

    textareaRefresh($('textarea'));
}

function insertNote(){
    var card_columns = $('.card-columns');
        
        if ($('#note').val().trim() != null && $('#note').val().trim() != "") {

            var count = localStorage.getItem("count");
            var next = parseInt(count) + 1;

            var template = document.getElementById('template-addNote').innerHTML;
            var compiled_template = Handlebars.compile(template);

            var rendered = compiled_template({ note_value: $('#note').val().trim(), note_key: next });

            localStorage.setItem("count", next);
            localStorage.setItem((next), $('#note').val().trim());

            card_columns.prepend(rendered);

            $('#note').val("");

            textareaRefresh($('textarea'));
        }
        else {
            $('#note').val("");
        }
        $('#note').each(function () {
            this.style.height = '40px';
            this.style.color = '';
        });
}

function mouseover_card(){
        var delete_button = this.querySelector('button');
        transition(delete_button);
        delete_button.style.opacity = 1;
}

function mouseout_card(){
        var delete_button = this.querySelector('button');
        delete_button.style.opacity = 0;
}

function deleteNote() {
    card_body = $(this).parent();
    card = $(this).parent().parent();
    $('#exampleModalCenter').modal('show');
}

function deleteDialog () {
    id_delete = card_body.find($('textarea')).attr("id");
    var count = localStorage.getItem("count");
    localStorage.removeItem(id_delete);
    localStorage.setItem("count", parseInt(count) - 1);
    card.remove();
    $('#exampleModalCenter').modal('hide');
    $('.toast').toast("show");
}

function updateTask() {
    var task_key = $(this).attr("id");
    localStorage.setItem(task_key, $(this).val());
}