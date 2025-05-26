function alpha(ch) {
  ch = ch.toUpperCase();
  let test = true;
  for (let i = 0; i < ch.length; i++) {
    if (ch[i] < "A" || ch[i] > "Z") {
      test = false;
    }
  }
  return test;
}

function verif() {
  const nom = document.getElementById("nom").value.trim();
  const prenom = document.getElementById("prenom").value.trim();
  const mail = document.getElementById("mail").value.trim();
  const message = document.getElementById("message").value.trim();

  if (nom === "" || alpha(nom) === false) {
    alert("Veuillez vérifier votre nom");
    return false;
  }
  if (prenom === "" || alpha(prenom) === false) {
    alert("Veuillez vérifier votre prénom");
    return false;
  }
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(mail)) {
    alert("Veuillez vérifier votre adresse e-mail");
    return false;
  }
  if (message === "") {
    alert("Veuillez vérifier votre message");
    return false;
  }
  if (window.Altcha && !Altcha.isValid()) {
    alert("Veuillez vérifier si vous êtes un robot");
    return false;
  }
  return true;
}
