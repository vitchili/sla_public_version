
/******Estilização dos cards do manual e videos. As subcategorias que nao tem video cadastrado ficarao cinza*/
//Terei que mudar o cursor para not-allowed toda vez que nao tenha um pdf ou video dessa funcionalidade.
//todo icone de pdf e video tem um id que chama o nome da NomeSubcategoria-pdf ou NomeSubcategoria-video
/* //Exemplo acima considera a subcategoria Funcionalidades e bloqueia o mouse para que seja clicado em um link que nao exista ainda
*/
/*MOUSE BLOCK INDEX*/


/*MOUSE POINTER*/

document.querySelector('.icon-play-pause').addEventListener('mouseover',() => {
  document.querySelector('.icon-play-pause').style.cursor = 'pointer';
});
