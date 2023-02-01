class Historico{
    constructor(){
        this._logContent = document.querySelector('#log .log-content');
        this.logJson = [];
        this.readMatch();
    }
    readMatch(){
        let ajax = new XMLHttpRequest();
        if(!ajax){
            console.error("Houve algum problema para criar uma requisição assíncrona");
            return;
        }
        ajax.onreadystatechange = ()=>{
            try{
                if(ajax.readyState == XMLHttpRequest.DONE){
                    console.log("chegou")
                    let resposta = JSON.parse(ajax.responseText);
                    if(resposta.error){
                        console.error(resposta.error);
                        return;
                    }
                    this.logJson = resposta;
                    this.fillLog();
                }
            }catch(error){
                console.error("Error message: "+error);
            }
        };
        ajax.open('GET', './historico.php', true);
        ajax.send( null );
    }
    emptyMessage(){
        let messageEl = document.createElement('span');
        messageEl.classList.add('message');
        messageEl.innerText = "Sem partidas jogadas";
        this._logContent.appendChild(messageEl);
    }
    createLog(matchObj){
        let matchEl = document.createElement('div');
        matchEl.classList.add('match');
        if(matchObj.resultado==="Vitoria")
            matchEl.classList.add('win');
        else
            matchEl.classList.add('lose');
        matchEl.innerHTML = `
            <span>${matchObj.data}</span>
            <p>Resultado: ${matchObj.resultado}</p>
            <p>Tabuleiro: ${matchObj.coluna}x${matchObj.linha}</p>
            <p>${matchObj.bomba} bombas</p>
            <p>Modo: ${matchObj.modo}</p>
            <p>Tempo - ${this.timeFormat(matchObj.tempo)}</p>
        `;
        this._logContent.appendChild(matchEl);
    }
    fillLog(){
        if(this.logJson.length == 0) this.emptyMessage();
        else{
            this.logJson.forEach(matchObj=>{
                this.createLog(matchObj);
            });
        }
    }
    timeFormat(val) {
        let minutes = Math.floor(val/60);
        if(minutes<10) minutes = `0${minutes}`;
        let seconds = val%60;
        if(seconds<10) seconds = `0${seconds}`;
        return minutes+":"+seconds;
    }
}