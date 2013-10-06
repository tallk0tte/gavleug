/* Funktion för galleriet */
function changeLink(id){
    document.getElementById('huvudbild').src = 'images/'+id;
    document.getElementById(id).width="500";
    document.getElementById(id).height="500";
}

