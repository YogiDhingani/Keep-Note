$(document).ready(function () {

    textareaRefresh($('textarea'));

    $('#note').focusout(insertNote);

});



function textareaRefresh(element){
    $(element).each(function () {
        this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;overflow-y:hidden;');
    }).on('input', function () {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });   
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
