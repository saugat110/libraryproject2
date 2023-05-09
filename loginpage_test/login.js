function toggleforms(){
    
    var form1=document.getElementById('f1');
    var form2=document.getElementById('f2');
    var button=document.getElementById('button1');
    var title=document.getElementById('form_title');

    if(form1.style.display == 'none'){   //form 1 user     form2 admin
        form2.style.display = 'none';
        form1.style.display = 'block';
        button.textContent = 'Admin Login';
        title.textContent = 'Student Login';
    }else{
        form1.style.display = 'none';
        form2.style.display = 'block';
        button.textContent = 'Student Login';
        title.textContent = 'Admin Login';
    }
    
}