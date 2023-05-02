//admin form bata login grda error vaye feri admin login page khulnu ko satta
//student page khulthyoo kinaki by default hamle student page khulne banako xa
//so login_validate bata admin login ma error vetiye
//redirected to index.php with ?admin=1,
//solution: so yedi url ma admin set xa vne form 1(student) lai disable grdinee

const url = new URL(window.location.href);
if(url.searchParams.get('admin')!== null){
    var form1=document.getElementById('f1');
    var form2=document.getElementById('f2');
    form1.style.display='none';
    form2.style.display='block';

    var button=document.getElementById('button1');
    var title1=document.getElementById('span1');
    var title2=document.getElementById('span2');
        button.textContent = 'Student Login';
        title1.textContent = 'Admin';
        title2.textContent = 'Login';

}


//to switch forms with button, by default when page loads shows user form shows
//css ma form 2(f2) lai disable garieko xa
function toggleforms(){
    
    var form1=document.getElementById('f1');
    var form2=document.getElementById('f2');
    var button=document.getElementById('button1');
    var title1=document.getElementById('span1');
    var title2=document.getElementById('span2');

    if(form1.style.display == 'none'){   //form 1 user     form2 admin
        form2.style.display = 'none';
        form1.style.display = 'block';
        button.textContent = 'Admin Login';
        title1.textContent = 'Student';
        title2.textContent = 'Login';
    }else{
        form1.style.display = 'none';
        form2.style.display = 'block';
        button.textContent = 'Student Login';
        title1.textContent = 'Admin';
        title2.textContent = 'Login';
    }

    //admin login ma gaera kei credential wrong vaye feri admin page khulxa with ?admin=1
    // so if ?admin=1 set huda student login ma click grera page refresh grda feri 
    //admin page khulthyoo so, solution: button click grda remove ?admin=1;
    let url=new URL(window.location.href); //yo herna baki
    if(url.searchParams.has('admin')){
        url.searchParams.delete('admin');
        window.history.replaceState(null, '', url);
    }
    
}



var box1=document.getElementById('c1');
box1.addEventListener('change', function(){
    var password=document.getElementById('pword');
    password.style.borderColor='blue';
    if(this.checked){
        password.type='text';
    }else{
        password.type='password';
    }
});


var box2=document.getElementById('c2');
box2.addEventListener('change', function(){
    var password=document.getElementById('pword2');
    password.style.borderColor='red';  //admin page ma show password click grda password ko border udcha
    if(this.checked){
        password.type='text';
    }else{
        password.type='password';
    }
});



//when the form was reset with show password checked the password field would show 
//visible password even when not checked, so solution:
var form1=document.getElementById('f1');
form1.addEventListener('reset', function(){
    var password1=document.getElementById('pword');
    password1.type='password';
    // password1=null;

    var error_message1=document.getElementById('error_message1'); //error message ni clear grna
    error_message1.textContent='';

    setTimeout(function(){  //reset grda initial value ma basxa set by session, so to clear 
        password1.value='';
        document.getElementById('email').value='';
    }, 1);

    document.getElementById('forgot_password1').textContent=''; //forgot password text clear

});


var form2=document.getElementById('f2');
form2.addEventListener('reset', function(){
    var password2=document.getElementById('pword2');
    password2.type='password';
    // password2=null;

    var error_message2=document.getElementById('error_message2'); //error message ni clear grna
    error_message2.textContent='';

    setTimeout(function(){  //reset grda initial value ma basxa set by session, so to clear 
        password2.value='';
        document.getElementById('email2').value='';
    }, 1);

    document.getElementById('forgot_password2').textContent=''; //forgot password text clear

});


//page refresh garda ni check box checked basthyoo
window.addEventListener('load', function() {
    var checkbox1 = document.getElementById('c1');
    var checkbox2 = document.getElementById('c2');
    checkbox1.checked = false;
    checkbox2.checked = false;

    // //page refresh grda error message(invalid credential message) clear hudainw thyoo, solution:
    let url=new URL(window.location.href);

    if(url.searchParams.has('apnm')){
        url.searchParams.delete('apnm');
    }
    if(url.searchParams.has('upnm')){
        url.searchParams.delete('upnm');
    }
    if(url.searchParams.has('unf')){
        url.searchParams.delete('unf');
    }
    if(url.searchParams.has('anf')){
        url.searchParams.delete('anf');
    }

    window.history.replaceState(null, '', url);
    
    //window.history.replaceState() is a method that is used to modify the current history entry without creating a new one. It takes three arguments:
    //state (optional): An object that represents the new state of the history entry. This can be used to store arbitrary data that is associated with the new state.
    //title (optional): The title of the new history entry. This is ignored in most modern browsers, so it is usually passed as an empty string ('').
    //url: The new URL that should be displayed in the browser's address bar. This can be an absolute or relative URL, or a data URL.


});





















