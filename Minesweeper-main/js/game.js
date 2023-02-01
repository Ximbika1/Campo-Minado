class Game{
    constructor(bombs, columns, rows, timeLimit, mode, id){
        this._finish = 0;
        this._board = new Board(bombs, columns, rows, timeLimit, id);
        this.time = 0;
        this._mode = mode;
        this._started = false;
        this._cheat = false;
        this.updateTime();
    }
    updateTime(){
        if(this._mode===0) this.time = 0;
        else this.time = this._board._timeLimit;
    }
    getFinishTime(){
        if(this._mode===0) return !(this.time<6039);
        else return !(this.time>0);
    }
    setTime(){
        if(this._mode===0) return ++this.time;
        else return --this.time;
    }
    getWinner(square){
        if(square._value === -1){
            this._finish = -1;
        }
        else if(this._board.getOpenSquareCountLeft() === 0){
            this._finish = 1;
        }
        else{
            this._finish = 0;
        }
        return this._finish;
    }
    getLogInfos(){
        if(!this.getFinishGame()) return null;
        let obj = {};
        obj.resultado = (this._finish==1)?"Vitoria":"Derrota";
        obj.data = (new Date()).toLocaleString('pt-br');
        obj.coluna = this._board._columns;
        obj.linha = this._board._rows;
        obj.bomba = this._board._bombCount;
        obj.modo = (this._mode==1)?"Rivotril":"Normal";
        obj.tempo = this.getMacthTime();
        return obj;
    }
    getMacthTime(){
        if(this._mode==0) return this.time;
        return this._board._timeLimit - this.time;
    }
    gameController(square = new Square(),callBack = ()=>{}){
        if(this._cheat) return;
        if(this.getFinishGame()) return false;
        this._board.openSquares(square);
        if(this.getWinner(square)){
            this.gameOver(callBack);
        }
    }
    gameOver(callBack){
        console.log("Acabou a partida: ", this._finish);
        this._started = false;
        this._board.openAllBombs();
        this.recordMatch();
        setTimeout(()=>{
            if(this._finish===-1)
                this.alertGameOver();
            else
                this.alertVictory();
            callBack();
        }, 500);
    }
    recordMatch(){
        let ajax = new XMLHttpRequest();
        if(!ajax){
            console.error("Ocorreu um problema ao tentar usar o ajax! Verifique se seu navegador tem suporte");
            return;
        }
        ajax.onreadystatechange = ()=>{
            try{
                if(ajax.readyState == XMLHttpRequest.DONE){
                    let resposta = JSON.parse(ajax.responseText);
                    if(resposta.error){
                        console.error(resposta.message);
                    }
                    else
                        console.log(resposta.message);
                }
            }catch(error){
                console.error("Error message: "+error);
            }
        };
        ajax.open('POST', './gravarPartida.php', true);
        ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        ajax.send('resultado=' + encodeURIComponent(this._finish+1)
        + '&quadrados_restantes=' + encodeURIComponent(this._board.getOpenSquareCountLeft())
        + '&tempo=' + encodeURIComponent(this.getMacthTime())
        + '&modo=' + encodeURIComponent(this._mode)
        + '&id_board=' + encodeURIComponent(this._board._id));
    }
    alertGameOver() {
        alert("VOCE PERDEU!!!");
    }
    alertVictory() {
        alert("VOCE VENCEU!!!");
    }
    initGame(rowEl, callBack){
        this._board.initBoard(rowEl);
        this._board.setSquareAction((square)=>{
            this.gameController(square, callBack);
        });
        this._started = true;
    }
    getXY(){
        return { _columns: this._board._columns, _rows: this._board._rows };
    }
    getFinishGame(){
        return this._finish!=0;
    }
}