class Validation{
options = {
    nameClass : "has-invalid",
    inputInvalidClass: "-invalid"
}
form = null;
inputs = [];
constructor(form, options = {}, inputs =[]) {
    this.form = form;
    this.inputs = inputs;
    this.options.nameClass = options?.nameClass || this.options.nameClass;
    this.options.inputInvalidClass = options?.inputInvalidClass || this.options.inputInvalidClass;
}
    isValid(){
        let valid = true;
        let $message = null;
        document.forms[this.form].querySelectorAll("input, select").forEach(target =>{
            let targetValid = true;
            //console.log(target.getAttribute("required"))
            //console.log(target)
            if(target.getAttribute("required") == "true"){
                //console.log(target.value)
                if(target.getAttribute("data-value") && target.getAttribute("data-value") != null){
                    if(target.getAttribute("data-value") == null || target.getAttribute("data-value") == "" || target.getAttribute("data-value") == "null"){
                        targetValid = false;
                        //target.setAttribute("data-value", "");
                        target.value = "";
                    }else{
                        target.value = target.getAttribute('data-string') || "";
                    }
                }else{
                    if(target.value == null || target.value == "0" || target.value == "" || target.value == "null"){
                        targetValid = false;
                        //target.value = "";
                        console.log(target)
                    }
                }
                if(targetValid){
                    if(target.parentNode?.classList.contains(this.options.nameClass)){
                        target.parentNode.classList.remove(this.options.nameClass);
                    }
                    //input
                    if(target.classList.contains(this.options.inputInvalidClass)){
                        target.classList.remove(this.options.inputInvalidClass);
                    }
                    $message = target.getAttribute("aria-invalid");
                    if($message){
                        document.querySelector( `#${$message}`).classList.remove("show");
                    }
                }else{
                    valid=false;
                    target.parentNode.classList.add(this.options.nameClass);
                    //input
                    target.classList.add(this.options.inputInvalidClass);
                    $message = target.getAttribute("aria-invalid");
                    if($message){
                        document.querySelector( `#${$message}`).classList.add("show");
                    }

                }
            }
        });
        console.log(valid)
        return valid;
    }
    validate(list = []){
        let valid = true;
        let $message = null;
        if(list.length){
            list.forEach(item =>{
                let target = document.querySelector(item.element);
                console.log(target);
                if(item.value){
                    if(target.parentNode?.classList.contains(this.options.nameClass)){
                        target.parentNode.classList.remove(this.options.nameClass);
                    }
                    //input
                    if(target.classList.contains(this.options.inputInvalidClass)){
                        target.classList.remove(this.options.inputInvalidClass);
                    }
                    $message = target.getAttribute("aria-invalid");
                    if($message){
                        document.querySelector( `#${$message}`).classList.remove("show");
                    }
                }else{
                    valid = false;
                    target.parentNode.classList.add(this.options.nameClass);
                    //input
                    target.classList.add(this.options.inputInvalidClass);
                    $message = target.getAttribute("aria-invalid");
                    if($message){
                        document.querySelector( `#${$message}`).classList.add("show");
                    }
                }
            });
        }
        console.log(valid);
        return valid;
    }
}