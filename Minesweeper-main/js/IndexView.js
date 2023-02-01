class IndexView{
    constructor(){
        this._gameLevelSelector = document.querySelector('#dropdownLevel');
        this._gameModeSelector = document.querySelector("#dropdown");
        this._bombCount = document.querySelector("#bombCount");
        this._minutesLabel = document.querySelector("#minutes");
        this._secondsLabel = document.querySelector("#seconds");
        this._boardEl = document.querySelector('#game-content .board');
        this._cheating = document.querySelector(".cheating span");
        this._startButton = document.querySelector(".button-start");
        this._startModal = document.querySelector(".modal-start");
        this._columnEl = document.querySelector(".columns");
        this._lineEl = document.querySelector(".lines");
        this.setRowEl(".board > .row");
        this._menuButton = document.querySelector('.menu-button');
        this._menuModal = document.querySelector('.modal-frame');
        this._historico = new Historico();
        document.onload = this.addEvents();
        this._game;
        this._timer;
    }
    restartBoard(){
        let obj;
        if(obj = this._game.getLogInfos())
            this._historico.createLog(obj);
        this._startButton.innerText = "Jogar";
        this._gameLevelSelector.disabled = false;
        this._gameModeSelector.disabled = false;
        this._startModal.style.display = "block";
    }
    
    addEvents(){
        let modalClosed = true;
        this._menuButton.addEventListener("click", ()=>{
            if(modalClosed){
                this._menuModal.style.display = "block";
            }
            else{
                this._menuModal.style.display = "";
            }
            modalClosed = !modalClosed;
        });
        this._menuModal.addEventListener("click", clickEvent=>{
            if(clickEvent.target==this._menuModal){
                this._menuModal.style.display = "";
                modalClosed = true;
            }
        });
        this._startButton.addEventListener("click", ()=>{
            if(this._game.getFinishGame()){
                this.setBoard();
                this.fillTimer();
            }
            this._startButton.innerText = "Carregando...";
            this._gameLevelSelector.disabled = true;
            this._gameModeSelector.disabled = true;
            this._game.initGame(this._rowEl, ()=>{
                this.restartBoard();
            });
            this._startButton.innerText = "-";
            this._startModal.style.display = "none";
            this._timer = setInterval(()=>{
                if(this._game.getFinishGame()) clearInterval(this._timer);
                this._game.setTime();
                this.fillTimer();
                if(this._game.getFinishTime()){
                    this.stopTime(this._timer);
                }
            },1000);
        });
        this._gameLevelSelector.onchange = ()=>{
            this.setBoard();
            this.fillTimer();
        };
        this._gameModeSelector.onchange = ()=>{
            if(this._gameModeSelector.value==1){
                if(this._game===undefined)
                    this.setBoard();
                this._game._mode = 1;
            }else{
                this._game._mode = 0;
            }
            this._game.updateTime();
            this.fillTimer();
        };
        this._cheating.addEventListener("click", clickEv=>{
            if(this._game._started && !this._game._cheat){
                let seconds = 3;
                this._cheating.innerText = seconds;
                this._game._board.showAllSquaresContent(true);
                let timer = setInterval(()=>{
                    this._cheating.innerText = --seconds;
                    if(seconds===0){
                        this._game._board.showAllSquaresContent(false);
                        this._game._cheat = false;
                        this._cheating.innerText = "Trapaça";
                        clearInterval(timer);
                    }
                },1000);
                this._game._cheat = true;
            }
        });

        this.setBoard();
        this._game.updateTime();
        this.fillTimer();
    }
    getModeValue(){
        return parseInt(this._gameModeSelector.value);
    }
    setBoard(){
        switch(this._gameLevelSelector.value){
            case "0":
                this._game = new Game(12, 9, 9, 50, this.getModeValue(), 1);
                break;
            case "1":
                this._game = new Game(15, 9, 9, 60, this.getModeValue(), 2);
                break;
            case "2":
                this._game = new Game(30, 18, 14, 120, this.getModeValue(), 3);
                break;
            case "3":
                this._game = new Game(40, 18, 14, 150, this.getModeValue(), 4);
                break;
            default:
                this._game = new Game(80, 30, 16, 200, this.getModeValue(), 5);
        }
        this.fillBoard();
        let xy = this._game.getXY();
        this._columnEl.innerText = xy._columns;
        this._lineEl.innerText = xy._rows;
        this._bombCount.innerText = this._game._board._bombCount;
    }

    setRowEl(selector = ""){
        this._rowEl = document.querySelectorAll(selector);
    }

    createElement(tag, className){
        let element = document.createElement(tag);
        element.className = className;
        return element;
    }
    
    fillBoard(){
        this._boardEl.innerHTML = '';
        let dimension = this._game.getXY();
        let changeSquare = ['square', 'square2'];
        for(let i = 0; i < dimension._rows; i++){
            let boardTemp = this.createElement('div', 'row');

            if(i % 2 == 0) changeSquare.sort((a, b) =>  a.localeCompare(b));
            else changeSquare.sort((a, b) => b.localeCompare(a));

            for(let j = 0; j < dimension._columns; j++){
                boardTemp.appendChild(this.createElement('div', changeSquare[j%2]));
            }

            this._boardEl.appendChild(boardTemp);
        }
        this.setRowEl(".board > .row");
    }

    fillTimer(){
        this._secondsLabel.innerHTML = this.timeFormat(this._game.time % 60);
        this._minutesLabel.innerHTML = this.timeFormat(parseInt(this._game.time / 60));
    }

    stopTime(timer) {
        clearInterval(timer);
        this._game._finish = -1;
        this._game.gameOver(()=>{
            this.restartBoard();
        });
    }

    timeFormat(val) {
        var valString = val + "";
        if (valString.length < 2) {
            return "0" + valString;
        } else {
            return valString;
        }
    }
}
document.onload = new IndexView();