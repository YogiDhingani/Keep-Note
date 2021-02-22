/**
 * Global variables
 */
var template;
var compiled_template;
var text_delete_title;
var text_restore_title;
var card_body;
var card;

/**
 * Global notes array containing all notes value.
 */
var notes = new Array();

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

    $('.card-columns').on('click', '#restore', restoreNote);

    /**Deletes button when user clicks on yes in dialog box. */
    $('#exampleModalCenter').on('click', '#confirm_delete', deleteDialog);
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
        if(notes[i].status == "binned")
        {
            var rendered = compiled_template({ note_value: notes[i].title , note_key: i });
            card_columns.prepend(rendered);
        }
    }
    console.log(11);

    textareaRefresh($('textarea'));
}

/**     Displays button to user (Changes button opacity to 1)*/
function mouseOverCard(){
        var delete_button = this.querySelector('button');
        var restore_button = this.querySelector('#restore')
        transition(delete_button);
        transition(restore_button);
        delete_button.style.opacity = 1;
        restore_button.style.opacity = 1;
}

/**     Hides button from user (Changes button opacity to 0)*/
function mouseOutCard(){
        var delete_button = this.querySelector('button');
        delete_button.style.opacity = 0;
        var restore_button = this.querySelector('#restore');
        restore_button.style.opacity = 0;
}

/**     Show dialog box of confirm delete note. */
function deleteNote() {
    card_body = $(this).parent();
    card = $(this).parent().parent();
    $('#exampleModalCenter').modal('show');
}

/** Delete particular note on which it is called.*/
function deleteDialog () {

    text_delete_title = card_body.find($('textarea')).val();

    for(var i=0; i<notes.length ; i++)
    {
        if(notes[i].title == text_delete_title){
            notes = notes.filter(item => { return item != notes[i];})
        }
    }

    localStorage.setItem("Notes",JSON.stringify(notes));
    card.remove();
    $('#exampleModalCenter').modal('hide');
    $('.toast').toast("show");
}

/**Restore note from binned section to notes section. */
function restoreNote(){
    card_body = $(this).parent();
    card = $(this).parent().parent();
    text_restore_title = card_body.find($('textarea')).val();
    console.log(text_restore_title);
    changeStatus(text_restore_title, "active");
    localStorage.setItem("Notes",JSON.stringify(notes));
    location.reload();
}

/**Changes task status to new status. 
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

var button, another_button;

/**Activate light mode */
function lightMode(){

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
function changeBackgound(button, another_button){
    
    button.css("background-color","rgb(232, 234, 237)");
    button.css("color","rgb(32, 33, 36)");
    
    another_button.css("background-color","rgb(32, 33, 36)");
    another_button.css("color","rgb(232, 234, 237)");
}

/**Avtivate dark mode */
function darkMode(){
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