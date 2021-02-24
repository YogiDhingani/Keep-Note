/**
 * Global variables
 */
var template;
var compiled_template;
var template_image;
var compiled_template_image;
var text_delete_title;
var text_restore_title;
var text_delete_title_image;
var text_restore_title_image;
var card_body;
var card;

/**
 * Global notes array containing all notes value.
 */
var images = new Array();
var notes = new Array();

/**Whatever code you write inside this method will run once the page DOM is ready to execute JavaScript code.*/
$(document).ready(function () {

    template = document.getElementById('template-addNote').innerHTML;
    compiled_template = Handlebars.compile(template);

    template_image = document.getElementById('template-addImage').innerHTML;
    compiled_template_image = Handlebars.compile(template_image);

    textareaRefresh($('textarea'));
    var mode = localStorage.getItem("Mode");

    if(mode == "Dark"){
        darkMode();
    }
    if(mode == "Light"){
        lightMode();
    }

    loadNotes();
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
    $('body').on('click', '#btn-delete', deleteNote);

    $('body').on('click', '#btn-light', lightMode);

    $('body').on('click', '#btn-dark', darkMode);

    $('.card-columns').on('click', '#btn-restore', restoreNote);

    $('.row').on('click','#btn-empty_bin',modalEmptyBin);

    $('#dialog_empty_bin').on('click','#btn-empty_bin_on_dialog',emptyBin);

    /**Deletes button when user clicks on yes in dialog box. */
    $('#dialog_delete_note').on('click', '#btn-confirm_delete_on_dialog', deleteDialog);

    document.addEventListener('keydown', function(event){
        if(event.keyCode == 68 && event.ctrlKey){
         emptyBin();
        }
      }, false);

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

function loadNotes(){
    var all_notes = JSON.parse(localStorage.getItem("Notes"));
    var all_images = JSON.parse(localStorage.getItem("Images"));

    for(var j in all_notes)
    {
        notes.push(all_notes[j]);
    }

    for(var j in all_images)
    {
        images.push(all_images[j]);
    }
}

/**
 * Loads all notes stored in localStorage.
 */
function onRefresh(){

    var card_columns = $('.card-columns');  
    card_columns.empty();

    for (var i = 0; i < notes.length; i++) {
        if(notes[i].status == "binned")
        {
            var rendered = compiled_template({ note_value: notes[i].title , note_key: i });
            card_columns.prepend(rendered);
        }
    }

    for (var i = 0; i < images.length; i++) {
        if(images[i].status == "binned")
        {
            var rendered = compiled_template_image({ image_title: images[i].title});
            card_columns.prepend(rendered);
        }
    }

    textareaRefresh($('textarea'));
}

/**     Displays button to user (Changes button opacity to 1)*/
function mouseOverCard(){
        var delete_button = this.querySelector('button');
        var restore_button = this.querySelector('#btn-restore');
        transition(delete_button);
        transition(restore_button);
        delete_button.style.opacity = 1;
        restore_button.style.opacity = 1;
}

/**     Hides button from user (Changes button opacity to 0)*/
function mouseOutCard(){
        var delete_button = this.querySelector('button');
        delete_button.style.opacity = 0;
        var restore_button = this.querySelector('#btn-restore');
        restore_button.style.opacity = 0;
}

/**     Show dialog box of confirm delete note. */
function deleteNote() {
    card_body = $(this).parent();
    card = $(this).parent().parent();
    $('#dialog_delete_note').modal('show');
}

/** Delete particular note on which it is called.*/
function deleteDialog () {

    text_delete_title = card_body.find($('textarea')).val();
    text_delete_title_image = card_body.find($('img')).attr('src');

    for(var i=0; i<notes.length ; i++)
    {
        if(notes[i].title == text_delete_title){
            notes = notes.filter(item => { return item != notes[i];})
        }
    }

    for(var i=0; i<images.length ; i++)
    {
        if(images[i].title == text_delete_title_image){
            images = images.filter(item => { return item != images[i];})
        }
    }

    localStorage.setItem("Notes",JSON.stringify(notes));
    localStorage.setItem("Images",JSON.stringify(images));
    card.remove();
    $('#dialog_delete_note').modal('hide');
    $('.toast').toast("show");
}

/**Restore note from binned section to notes section. */
function restoreNote(){
    card_body = $(this).parent();
    card = $(this).parent().parent();

    text_restore_title = card_body.find($('textarea')).val();
    changeStatus(text_restore_title, "active");

    text_delete_title_image = card_body.find($('img')).attr('src');
    changeStatusImage(text_delete_title_image, "active");

    localStorage.setItem("Images",JSON.stringify(images));

    localStorage.setItem("Notes",JSON.stringify(notes));
    onRefresh();
    $('.toast-restored').toast("show");
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

function changeStatusImage(title, status){
    for(var i=0; i<images.length; i++){
        if(images[i].title == title){
            images[i].status = status;
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

function modalEmptyBin(){
    $('#dialog_empty_bin').modal('show');
}

/**delete all notes in bin section */
function emptyBin(){
    notes = notes.filter(items => { return items.status !== "binned"});
    images = images.filter(items => { return items.status !== "binned"});
    localStorage.setItem("Notes",JSON.stringify(notes));
    localStorage.setItem("Images",JSON.stringify(images));
    $('#dialog_empty_bin').modal('hide');
    onRefresh();
}