
function verif() {
  const mail = document.getElementById("email").value.trim();
  const passe = document.getElementById("password").value.trim();

  // Basic email regex for better validation
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(mail)) {
    alert("Veuillez vérifier votre adresse e-mail");
    return false;
  }

  if (passe.length < 6) {
    alert("Le mot de passe doit contenir au moins 6 caractères");
    return false;
  }

  return true;
}
