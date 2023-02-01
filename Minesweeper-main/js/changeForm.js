class Exception{
    static emptyField(field){
        try{
            if(field.value.trim() === '') throw "0";
            if(field.value === 0)  throw "0";
            if(field.value === null)  throw "0";
        }catch(error){
            if(error === "0")
                return "Campo não pode estar vazio";
            return "Outro erro";
        }
        return 0;
    }
    static valueBeEqual(field, comparedField){
        try{
            if(field.value !== comparedField.value)
                throw "0";
        }catch(error){
            if(error === "0")
                return "campo está com valor diferente";
            return "Outro erro";
        }
        return 0;
    }
    static dateAfterToday(dataField){
        const today = new Date();
        const zeroAm = new Date(today.getFullYear(), today.getMonth(), today.getDate());
        try{
            if(dataField.valueAsDate.getTime() > zeroAm.getTime())
                throw "0";
        }catch(error){
            if(error === "0")
                return "Data de nascimento não pode ser maior que atual";
            return "data inválida";
        }
        return 0;
    }
}
class InputField{
    constructor(name = '', type = ''){
        this._error = false;
        this._name = name;
        this._type = type;
        this.validList = [Exception.emptyField];
        this._otherField = null;
    }
    addOtherField(otherField){
        this._otherField = otherField;
    }
    addValidation(validationFunc){
        this.validList.push(validationFunc);
    }
    setFieldEl(fieldEl){
        this._fieldEl = fieldEl;
    }
    addEvent(callback){
        this._fieldEl.addEventListener('change', ()=>{
            callback(this._fieldEl);
        });
    }
    setError(){
        this._error = true;
        this._fieldEl.parentElement.classList.add("error-field");
    }
    removeError(){
        this._error = false;
        this._fieldEl.parentElement.classList.remove("error-field");
    }
    checkInput(){
        this._error = false;
        this.validList.forEach((validItem) => {
            if(this._error) return;
            let error;
            if((error = validItem(this._fieldEl, this._otherField)) !== 0){
                this.setError();
            }
        });
        if(!this._error) this.removeError();
    }
}
class FormComponent{
    constructor(validUser){
        this._formEl = document.querySelector('form');
        this._inputList = [];
        if(this._formEl){
            this._formEl.addEventListener("submit", e=>{
                e.preventDefault();
                this.checkErrors();
                if(this.fieldsChecked())
                    this._formEl.submit();
            });
            this.initList(validUser);
        }
    }
    addAllValidation(inputObj){
        switch(inputObj._type){
            case "date":
                inputObj.addValidation(Exception.dateAfterToday);
                break;
            case "password":
                let pwdField = this._inputList.filter(input => input._type==="password");
                if(pwdField.length>0){
                    inputObj.addValidation(Exception.valueBeEqual);
                    inputObj.addOtherField(pwdField[0]._fieldEl);
                }
                break;
        }
    }
    initList(validUser){
        for(let input of this._formEl){
            if(input.type == "submit") continue;
            let inputObj = new InputField(input.name, input.type);
            inputObj.setFieldEl(input);
            this.addAllValidation(inputObj);
            if(validUser && input.name=='user_id') inputObj.addEvent(this.checkUser);
            this._inputList.push(inputObj);
        }
    }
    fieldsChecked(){
        return this._inputList.filter(input => input._error).length == 0;
    }
    checkErrors(){
        this._inputList.forEach((inputObj)=>{
            inputObj.checkInput();
        });
    }
    checkUser(input){
        if(input.value==="") return;
        let test = new XMLHttpRequest();
        if(!test){
            console.error("Houve algum problema para criar uma requisição assíncrona");
            return;
        }
        test.onreadystatechange = ()=>{
            try{
                if(test.readyState == XMLHttpRequest.DONE){
                    let resposta = JSON.parse(test.responseText);
                    if(resposta.error){
                        console.error(resposta.error);
                        return;
                    }
                    if(resposta.resp) alert('Usuário já existe!');
                    else alert('Usuário disponível!');
                }
            }catch(error){
                console.error("Error message: "+error);
            }
        };
        test.open('GET', './user.php?user_id='+ encodeURIComponent(input.value), true);
        test.send( null );
    }
}
class formView{
    constructor(){
        this._formButton = document.querySelectorAll("nav > p");
        this._cancelButton = document.querySelector(".cancel");
        this._formObj = new FormComponent(this._formButton[0] && this._formButton[0].classList.contains("alter-page"));
        this.addEvents();
    }
    addEvents(){
        function redirectPage(urlLink){
            window.location.href = urlLink;
        }
        if(this._formButton.length>0){
            if(this._formButton[0].classList.contains("alter-page"))
                this.addClickEvent(this._formButton[0], ()=>{
                    redirectPage("./login.php");
                });
            else
                this.addClickEvent(this._formButton[1], ()=>{
                    redirectPage("./cadastro.php");
                });
        }
        this.addClickEvent(this._cancelButton, ()=>{
            redirectPage("./index.php");
        });
    }
    addClickEvent(itemEl, callback){
        if(itemEl==null) return;
        itemEl.addEventListener("click",()=>{
            callback();
        });
    }
}
document.onload = new formView();