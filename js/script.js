/**Global variables */
var template;
var compiled_template;
var template_image;
var compiled_template_image;
var text_delete_title;
var text_delete_title_image;
var card_body;
var card;

// var mysql = require('mysql');

// var con = mysql.createConnection({
//   host: "localhost",
//   user: "root",
//   password: "",
//   database: "notes"
// });

/**
 * Global notes array containing all notes value.
 */
var all_notes_sql = new Array();
var images = new Array();
var notes = new Array();

/**
 * Global variable which contains old title value.
 */
var old_title_val;

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
    $('body').on('click', '#btn-delete', deleteNote);

    $('body').on('click', '#btn-light', lightMode);

    $('body').on('click', '#btn-dark', darkMode);

    /**Stores old title value to OldTitleVal global variable.*/
    $('.card-columns').on('focusin','.card-body__textarea',(event) => {old_title_val = $(event.target).val();});

    /**Update note to latest value entered by user. */
    $('.card-columns').on('focusout', '.card-body__textarea', updateNote);

    /**Undo deleted note. */
    $('.toast').on('click', '#btn-undo', undoNote);

    $('#file-input').on('change',uploadFile);

    document.addEventListener('keydown', function(event){
        if(event.keyCode == 90 && event.ctrlKey){
         undoNote();
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

/**
 * Loads all notes stored in localStorage.
 */
function loadNotes(){
    
    var all_notes = JSON.parse(localStorage.getItem("Notes"));
	var all_images  = JSON.parse(localStorage.getItem("Images"));

    // $.post('onload.php?status=active',
    // function(data){
    //     var notes = JSON.parse(data);
    //     for(var j in notes)
    //     {
    //         console.log(notes[j]);
    //         all_notes_sql.push(notes[j]);
    //     }
    // });
    // console.log(all_notes_sql);

    for(var j in all_notes)
    {
        notes.push(all_notes[j]);
    }
	
	for(var j in all_images)
    {
        images.push(all_images[j]);
    }
}

var notes_active;

function onRefresh(){
	
    $('.card-columns').empty();  
    var card_columns = $('.card-columns');  

    $.post('onload.php?status=active',
    function (data){

        notes_active = JSON.parse(data);

        all_notes_sql = notes_active;
        for(var i=0; i < notes_active.length; i++)
        {
            if(all_notes_sql[i].status == "active" && all_notes_sql[i].note_type == "text"){
                var rendered = compiled_template({ note_value: all_notes_sql[i].note_title, note_key: i});
                card_columns.prepend(rendered);
            }
            if(all_notes_sql[i].status == "active" && all_notes_sql[i].note_type == "image"){
                var rendered = compiled_template_image({ image_title: all_notes_sql[i].note_title});
                card_columns.prepend(rendered);
            }
        }
    });

    // console.log(notes);
    // console.log(notes.length);
    // for (var i = 0; i < notes.length; i++) {
    //     if(notes[i].status == "active")
    //     {
    //         var rendered = compiled_template({ note_value: notes[i].title , note_key: i });
    //         card_columns.prepend(rendered);
    //         card_columns.append("</div>");
    //     }
    // }

	// for (var i = 0; i < images.length; i++) {
    //     if(images[i].status == "active")
    //     {
    //         var rendered = compiled_template_image({ image_title: images[i].title});
    //         card_columns.prepend(rendered);
    //     }
    // }

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
            var note_value = $('#note').val();
            notes.push({title: $('#note').val(), status:"active"});
            localStorage.setItem("Notes",JSON.stringify(notes));

            $.post('insert.php?msg='+note_value,
            function(data)
            {
                // console.log(data);
            });
            // window.location = "keepnotes.local/index.php?msg="+note_value;

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
	
	text_delete_title_image = card_body.find($('img')).attr('src');
    changeStatusImage(text_delete_title_image, "binned");

    localStorage.setItem("Images",JSON.stringify(images));
    localStorage.setItem("Notes",JSON.stringify(notes));

    $.post('bin.php?title='+text_delete_title,
    function(data){
        // console.log(data);
    });

    $.post('bin.php?title='+text_delete_title_image,
    function(data){
        // console.log(data);
    });

    card.remove();
    $('.toast').toast("show");
}

/**     Undo deleted note */
function undoNote(){
    $('.toast').toast("hide");
    // changeStatus(text_delete_title,'active');
    // changeStatusImage(text_delete_title_image,'active');

    $.post('undo.php?title='+text_delete_title,
    function(data){
        // console.log(data);
    });

    $.post('undo.php?title='+text_delete_title_image,
    function(data){
        // console.log(data);
    });

    // localStorage.setItem("Notes",JSON.stringify(notes));
    // localStorage.setItem("Images",JSON.stringify(images));
    onRefresh();
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

function changeStatusImage(title, status){
    for(var i=0; i<images.length; i++){
        if(images[i].title == title){
            images[i].status = status;
        }
    }
}

/** Update note value to the value enter by user.*/
function updateNote() {

    var new_title_val = $(this).val().trim();

    $.post('update.php?oldTitle='+old_title_val+'&newTitle='+new_title_val,
    function(data){
        // console.log(data);
    });
    
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

function uploadFile(){
    var input = document.getElementById("file-input");
    var file = input.files[0];
    if(file != undefined){
      formData= new FormData();
      if(!!file.type.match(/image.*/)){
        formData.append("image", file);
		images.push({ title:"/image/"+file.name, status:"active"});
		localStorage.setItem("Images",JSON.stringify(images));
        $.ajax({
          url: "upload.php?path=/image/"+file.name,
          type: "POST",
          data: formData,
          processData: false,
          contentType: false,
          success: function(data){
              onRefresh();
          }
        });
      }else{
        alert('Not a valid image!');
      }
    }else{
      alert('Input something!');
    }
  }

function logout(){
    var r = confirm("You want to logout?");
    if(r){
      window.location.href="logout.php";
    }
  }