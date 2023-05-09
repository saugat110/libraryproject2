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
    password.style.borderColor='red';
    if(this.checked){
        password.type='text';
    }else{
        password.type='password';
    }
});



//when the form was reset with show password checked the password field would show password even
//when not checked, so solution:
var form1=document.getElementById('f1');
form1.addEventListener('reset', function(){
    var password1=document.getElementById('pword');
    password1.type='password';
    password1=null;
});



var form2=document.getElementById('f2');
form2.addEventListener('reset', function(){
    var password2=document.getElementById('pword2');
    password2.type='password';
    password2=null;
});





















