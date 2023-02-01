class Square{
    constructor(squareEl, value, pos = 0){
        this._squareEl = squareEl;
        this._close = true;
        this._pos = pos;
        this._value = value;
    }
    openSquare(){
        this.showSquareContent(true);
        this._squareEl.className += "-opened";
        this._close = false;
        return this._value;
    }
    showSquareContent(show){
        if(!show) this._squareEl.innerHTML = "";
        else if(this._value===-1){
            let bombImg = document.createElement('img');
            bombImg.setAttribute("src", "./images/bomb.svg");
            if(show)
                bombImg.style.background = "#dd6868";
            this._squareEl.appendChild(bombImg);
        }
        else if(this._value > 0){
            this._squareEl.innerText = this._value;
        }
    }
}