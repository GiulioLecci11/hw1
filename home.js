
function onJson(json) {
    console.log(json);
    const feed = document.getElementById('feed');
    feed.innerHTML="";
    //copio il template e ripopolo
    for (let i in json) {
        const post = document.getElementById('post_template').content.cloneNode(true).querySelector(".post");
        post.querySelector(".username").textContent = "@" + json[i].creator;
        post.querySelector(".time").textContent=json[i].time;
        if(json[i].postnumber<=0){
            post.querySelector(".avatar img").src ="imgs/1.jpg";
        }
        else if(json[i].postnumber>0 && json[i].postnumber<=4) {
            post.querySelector(".avatar img").src ="imgs/2.jpg";
        }
        else if(json[i].postnumber>4 && json[i].postnumber<=9) {
            post.querySelector(".avatar img").src ="imgs/3.jpg";
        }
        else {
            post.querySelector(".avatar img").src ="imgs/4.jpg";
        }
        post.querySelector(".names > a").href = "#";
        post.querySelector(".text").textContent = json[i].text;
        post.querySelector(".elimina").addEventListener('click',deletePost);
        deletepic=document.createElement('img');
        deletepic.src="imgs/x.jpg";
        post.querySelector(".elimina").appendChild(deletepic);
        post.querySelector(".elimina").dataset.id_post=json[i].id;
        feed.appendChild(post);
    }
}
function deletePost(event){
    const deletedid=event.currentTarget.dataset.id_post;
    fetch("delete_post.php?id_post=" + deletedid).then(showPosts);
}
function responsePost(response)
{
    return response.json();
}
function responseStats(response)
{
    return response.json();
}

function showPosts(){
    fetch("home_getPosts.php").then(responsePost).then(onJson);
    showStats();
}
function showStats(){
    fetch("home_getStats.php").then(responseStats).then(onJsonStats);
}
function openModal() {
    modal=document.getElementById("modal-view");
    document.body.classList.add("no-scroll");
    modal.classList.remove("hidden");
    document.getElementById("text").value="";
    document.getElementById("x").addEventListener('click',closeModal);
}
function closeModal(){
    document.body.classList.remove('no-scroll');
    modal=document.getElementById("modal-view");
    modal.classList.add('hidden');
    document.getElementById("text").textContent="";
    showPosts();
}
function sendText(event){
    if(document.getElementById("text").value.length!=0){
        const text=document.getElementById("text").value;
        fetch("home_add_post.php?text=" + text).then(closeModal);
    }
    closeModal();
    //chiamo due volte così vado a coprirmi sia nel caso in cui invio qualcosa (risolvo sincronizzazione) sia quando non invio
    event.preventDefault(); 
}

function onJsonStats(json){
    console.log(json);
    const profile=document.getElementById("profile");
    profile.innerHTML="";
    const avatar= document.createElement('div');
    avatar.classList.add("avatar");
    avatar.style="background-image: url("+json[0].url+")";
    const mini=document.createElement("img");
    mini.classList.add("mini");
    mini.src=json[0].url;
    const usern=document.createElement('div');
    usern.classList.add("username");
    usern.textContent="@"+json[0].usern;
    const stats=document.createElement('div');
    stats.classList.add("stats");
    const cont=document.createElement("div");
    const br=document.createElement('br');
    cont.textContent="Post"
    const count=document.createElement("span");
    count.classList.add("count");
    count.textContent=json[0].postnumber;
    profile.appendChild(avatar);
    profile.appendChild(usern);
    profile.appendChild(stats);
    profile.appendChild(mini);
    stats.appendChild(cont);
    cont.appendChild(br);
    cont.appendChild(count);

    fetch("spoti.php?song="+json[0].songReq).then(responseSong).then(onJsonSong);
}
function onJsonSong(json){
  console.log(json);
  const songs=document.querySelector("#tracks");
  songs.innerHTML="";
  const res=json.tracks.items;
  let nRes=res.length;
  if(nRes>1){
    nRes=1;
  } //so che è inutile ciclare per uno solo, ma se volessi un giorno fare la stessa cosa per più canzoni mi trovo il ciclo pronto e mi basta cambiare nRes
  for(let i=0;i<nRes;i++){
    let artist=res[i].album.artists[0].name;
    const len=res[i].album.artists.length;
    for(let j=1;j<len;j++){
       artist+=" & "+res[i].album.artists[j].name;
    }
    const img_url=res[i].album.images[0].url;
    const titolo=res[i].name;
    const song=document.createElement('div');
    song.classList.add('spotiresult');
    const img=document.createElement('img');
    img.src=img_url;
    const creators=document.createElement('p');
    creators.textContent=artist;
    const suggest=document.createElement('p');
    suggest.textContent="In base alla tua attività ti consigliamo:";
    const title=document.createElement('h3');
    const song_link= document.createElement('a');
    song_link.href=res[i].uri;
    const play_button=document.createElement('img');
    play_button.classList.add('play');
    play_button.src="imgs/play.jpg";
    song_link.appendChild(play_button);
    title.textContent=titolo;
    song.appendChild(suggest);
    song.appendChild(img);
    song.appendChild(title);
    song.appendChild(creators);
    songs.appendChild(song);
    songs.appendChild(song_link);
  }
}
function responseSong(response)
{   
    return response.json();
}
document.getElementById("createPost").addEventListener('click',openModal);
document.forms["text_form"].addEventListener('submit',sendText);
showPosts();
//gestione menù mobile
const show_menu= document.querySelector('#show_menu');
const menu = document.querySelector('#menu');
menu.addEventListener('click',showMenu);
show_menu.querySelector('div').addEventListener('click',closeMenu);

function showMenu(event){
    event.currentTarget.classList.add('hidden');
    show_menu.classList.remove('hidden');
    show_menu.classList.add('show_menu');
}

function closeMenu(event){
    show_menu.classList.remove('show_menu');
    show_menu.classList.add('hidden');
    menu.classList.remove('hidden');
    
}