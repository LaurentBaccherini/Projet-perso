/* Fonction qui déclenche l'enregistrement du commentaire via AJAX*/  
  function recComs(e){
    e.preventDefault();
    let formdata = new FormData(infosForm);
    const XHR = new XMLHttpRequest();
    XHR.open('POST','comment.php');
    XHR.addEventListener('load',function(){
       const REP = XHR.responseText;
       screenComs();/* Appel de la seconde fonction pour l'affichage des commentaires*/
    })
   
    XHR.send(formdata);   
}

function screenComs(){/* Fonction qui déclenche la sélection et l'affichage de tous lescommentaires liés à l'id de l'article*/
   const XHR = new XMLHttpRequest();
   let id_art=document.querySelector('input[name=id_art]').value;/* Récupération de l'id article via JS*/
    XHR.open('GET', 'ajax.php?id='+id_art);

    XHR.addEventListener('load',function(){
       document.querySelector('aside').innerHTML = XHR.responseText;/* Ici on cible la balise HTML qui recevra le contenue HTML généré*/
    });
    XHR.send();
}