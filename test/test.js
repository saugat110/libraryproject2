const url = new URL(window.location.href);

if(url.searchParams.get('there')!== null){
    var paragraph = document.getElementById('p1');
    paragraph.style.color='red';
}


var form=document.getElementById('f1');
f1.addEventListener('reset', function(){
    let field=document.getElementById('email');
    setTimeout(function(){
        field.value="saugat";

    },0);
    // field.value="saugat";
});