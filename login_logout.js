function performLogin(){
  try {
    login.performLogin();
  } catch (e) {

  } finally {
    window.location.href = 'index.php';
  }
}

function performLogout(){
  try {
    login.performLogout();
  } catch (e) {

  } finally {
    window.location.href = 'login.php';
  }
}