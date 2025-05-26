function alpha(ch){
    ch=ch.toUpperCase();
    test=true;
    for(i=0;i<ch.length;i++){
        if(ch[i]<"A" ||ch[i]>"Z"){
            test=false;
        }
    }
    return test;
}   
function verif(){
nom=document.getElementById("nom").value;
prenom=document.getElementById("prenom").value;
mail=document.getElementById("mail").value;
passe=document.getElementById("passe").value;
s=document.getElementById("s").value;
r1=document.getElementById("r").checked;

    
if((nom=="") ||alpha(nom)==false){
    alert("verifier votre nom");
    return false;
}
if(prenom=="" ||alpha(prenom)==false)
{   
    alert("verifier votre prenom");
    return false;
}
p = mail.indexOf("@");
    if (p == -1 || p === 0 || p === mail.length - 1) {
    alert("Veuillez vérifier votre adresse e-mail");
   return false;
}
    if(s==0){
     alert("verifier votre methode de payement ")
    return false;
}
if(r1==false){
    alert("verifier si vous etes un robot")
    return false;
}
}