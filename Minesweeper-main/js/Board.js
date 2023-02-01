class Board{
    constructor(bombs = 0, columns = 0, rows = 0, timeLimit = 0, id = 3){
        this._id = id;
        this._columns = columns;
        this._rows = rows;
        this._timeLimit = timeLimit;
        this._squares = [];
        this._bombCount = bombs;
        this._boardEl = document.querySelector('#game-content .board');
    }

    getOpenSquareCountLeft(){
        return this._squares.filter(square=>square._close && square._value>-1).length;
    }

    initBoard(rowEl){
        let sum = 0;
        rowEl.forEach( (line) => {
            line.querySelectorAll("div").forEach( (square) => {
                this._squares.push(new Square(square, 0, sum++));
            });
        });
        this.setBombPosition();
    }

    openSquares(square = new Square()){
        if(square._squareEl==undefined) return;
        if(!square._close) return;
        if(square.openSquare()===0){
            let column = square._pos % this._columns;
            if(column>0){
                this.openSquares(this._squares[square._pos-1]);
                this.openSquares(this._squares[square._pos + (this._columns - 1)]);
                this.openSquares(this._squares[square._pos - (this._columns + 1)]);
            }
            if(column<this._columns-1){
                this.openSquares(this._squares[square._pos+1]);
                this.openSquares(this._squares[square._pos + (this._columns + 1)]);
                this.openSquares(this._squares[square._pos - (this._columns - 1)]);
            }
            this.openSquares(this._squares[square._pos + this._columns]);
            this.openSquares(this._squares[square._pos - this._columns]);
        }
    }

    setSquareAction(callBack){
        this._squares.forEach(square=>{
            square._squareEl.addEventListener("click", ()=>{
                callBack(square);
            });
        });
    }

    getTotalPos(){
        return this._columns * this._rows;
    }
    verifyFirstColumn(square){
        return square._pos%this._columns>0;
    }
    verifyLastColumn(square){
        return square._pos%this._columns < this._columns - 1;
    }
    setMoreOne(neighbor){
        if(this._squares[neighbor] && this._squares[neighbor]._value > -1)
            this._squares[neighbor]._value++;
    }
    setBombPosition(){
        let bombPos = this.randonPosition();
        for(let position of bombPos){
            this._squares[position]._value = -1;
            if(this.verifyFirstColumn(this._squares[position])){
                this.setMoreOne(position - 1);
                this.setMoreOne(position + (this._columns - 1));
                this.setMoreOne(position - (this._columns + 1));
            }
            if(this.verifyLastColumn(this._squares[position])){
                this.setMoreOne(position + 1);
                this.setMoreOne(position + (this._columns + 1));
                this.setMoreOne(position - (this._columns - 1));
            }
            this.setMoreOne(position + this._columns);
            this.setMoreOne(position - this._columns);
        }
    }

    openAllBombs(){
        this._squares.filter(square => square._close && square._value === -1).forEach((square)=>{
            square.openSquare();
        });
    }
    showAllSquaresContent(show = true){
        this._squares.filter(square => square._close).forEach(square=>{
            square.showSquareContent(show);
        });
    }

    randonPosition(){
        let count = this.getTotalPos();
        let bombPos = [];
        let bombCount = this._bombCount;
        while (bombCount > 0) {
            var pos = Math.floor(Math.random() * count);
            if (bombPos.filter(item => item == pos).length == 0) {
                bombPos.push(pos);
                bombCount--;
            }
        }
        return bombPos;
    }
}