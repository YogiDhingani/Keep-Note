/**Global variables */
var template;
var compiled_template;
var text_delete_title;
var card_body;
var card;

/**
 * Global notes array containing all notes value.
 */
var notes = new Array();

/**
 * Global variable which contains old title value.
 */
var old_title_val;

/**Whatever code you write inside this method will run once the page DOM is ready to execute JavaScript code.*/
$(document).ready(function () {

    template = document.getElementById('template-addNote').innerHTML;
    compiled_template = Handlebars.compile(template);

    textareaRefresh($('textarea'));
    var mode = localStorage.getItem("Mode");

    if(mode == "Dark"){
        darkMode();
    }
    if(mode == "Light"){
        lightMode();
    }


    onRefresh();

    /** insert note after user enter note and user click on outside of it (loses focus from it).*/
    $('#note').focusout(insertNote);

    /**Displays button when user give focus to note. */
    $('body').on('focus', '.card-body', mouseOverCard);

    /**Hides button when user loses focus from note. */
    $('body').on('focusout', '.card-body', mouseOutCard);

    /**Displays button when user hover over notes. */
    $('body').on('mouseover', '.card-body', mouseOverCard);

    /**Hides button when user hover over notes. */
    $('body').on('mouseout', '.card-body', mouseOutCard);

    /**Shows dialog to user wheather delete button or not.*/
    $('body').on('click', '#delete', deleteNote);

    $('body').on('click', '#btn-light', lightMode);

    $('body').on('click', '#btn-dark', darkMode);

    /**Deletes button when user clicks on yes in dialog box. */
    // $('#exampleModalCenter').on('click', '#confirm_delete', deleteDialog);

    /**Stores old title value to OldTitleVal global variable.*/
    $('.card-columns').on('focusin','.card-body__textarea',(event) => {old_title_val = $(event.target).val();});

    /**Update note to lates value entered by user. */
    $('.card-columns').on('focusout', '.card-body__textarea', updateNote);

    /**Undo deleted note. */
    $('.toast').on('click', '#btn-undo', undoNote);

});

/**Give transition to element passed as argument.
 * 
 * @param {element} element - element name
 */
function transition(element) {
    element.style.transition = "all 0.8s";
}

/**Arrange textarea size according to content.
 * 
 * @param {textarea} element - element name
 */
function textareaRefresh(element){
    $(element).each(function () {
        this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;overflow-y:hidden;');
    }).on('input', function () {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });   
}

/**
 * Loads all notes stored in localStorage.
 */
function onRefresh(){

    var all_notes = JSON.parse(localStorage.getItem("Notes"));

    for(var j in all_notes)
    {
        notes.push(all_notes[j]);
    }

    var card_columns = $('.card-columns');  
    card_columns.empty();

    for (var i = 0; i < notes.length; i++) {
        if(notes[i].status == "active")
        {
            var rendered = compiled_template({ note_value: notes[i].title , note_key: i });
            card_columns.prepend(rendered);
        }
    }

    textareaRefresh($('textarea'));
}

/**
 * Insert note to  page.
 */
function insertNote(){
    var card_columns = $('.card-columns');

        if ($('#note').val().trim() != null && $('#note').val().trim() != "") 
        {
            var rendered = compiled_template({ note_value: $('#note').val().trim()});

            card_columns.prepend(rendered);
            notes.push({title: $('#note').val(), status:"active"});
            localStorage.setItem("Notes",JSON.stringify(notes));

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

/**     Displays button to user (Changes button opacity to 1)*/
function mouseOverCard(){
        var delete_button = this.querySelector('button');
        transition(delete_button);
        delete_button.style.opacity = 1;
}

/**     Hides button from user (Changes button opacity to 0)*/
function mouseOutCard(){
        var delete_button = this.querySelector('button');
        delete_button.style.opacity = 0;
}


/**     Show dialog box of confirm delete note. */
function deleteNote() {
    card_body = $(this).parent();
    card = $(this).parent().parent();

    text_delete_title = card_body.find($('textarea')).val();
    changeStatus(text_delete_title, "binned");

    localStorage.setItem("Notes",JSON.stringify(notes));
    card.remove();
    
    $('.toast').toast("show");
}

/**     Undo deleted note */
function undoNote(){
    $('.toast').toast("hide");
    changeStatus(text_delete_title,'active');
    localStorage.setItem("Notes",JSON.stringify(notes));
    location.reload();
}

/** changes particular task status.
 * @param {string} title - title of task
 * @param {string} status - status of task
*/
function changeStatus(title, status){
    for(var i=0; i<notes.length; i++){
        if(notes[i].title == title){
            notes[i].status = status;
        }
    }
}

/** Update note value to the value enter by user.*/
function updateNote() {

    var new_title_val = $(this).val().trim();
    
        for(var i=0; i<notes.length; i++){
            if(notes[i].title == old_title_val){
                notes[i].title = new_title_val;
            }
        }
    localStorage.setItem("Notes",JSON.stringify(notes));
}

var button, another_button;

/**Activate light mode */
function lightMode()
{

    var mode = localStorage.getItem("Mode");
    another_button = $(this).parent().find($('#btn-dark'));
    button = $(this);

    $("html").css("--background-color","white");
    $("html").css("--text-color","black");
    localStorage.setItem("Mode","Light");

    if(mode != "Light")
    {
        changeBackgound(button,another_button);
    }
}

/**Changes background color of button */
function changeBackgound(button, another_button)
{    
    button.css("background-color","rgb(232, 234, 237)");
    button.css("color","rgb(32, 33, 36)");
    
    another_button.css("background-color","rgb(32, 33, 36)");
    another_button.css("color","rgb(232, 234, 237)");
}

/**Avtivate dark mode */
function darkMode()
{

    var mode = localStorage.getItem("Mode");
    another_button = $(this).parent().find($('#btn-light'));
    button = $(this);

    $("html").css("--background-color","rgb(32, 33, 36)");
    $("html").css("--text-color","rgb(232, 234, 237)");
    localStorage.setItem("Mode","Dark");

    if(mode != "Dark")
    {
        changeBackgound(button,another_button); 
    }
}