class Validation {

    constructor(t, s = {}, a = []) {
        this.options = {};
        this.form = t || null;
        this.inputs = a || [];
        this.options.nameClass = s.nameClass || "has-invalid";
        this.options.inputInvalidClass = s.inputInvalidClass || "-invalid";
        this.$messageListInvalids = [];
        //this.activateEventsInput();
        document.querySelector(this.form).setAttribute("novalidate", true)
    }

    /**
     * valida
     * @return {boolean}
     */
    isValid() {
        let valid = true;
        let $message = null;
        this.#registerListMessages();
        document.querySelector(this.form).querySelectorAll("input, select, textarea").forEach(target =>{
            let targetValid = true;
            if(target.getAttribute("required") == "true"){
                if(target.getAttribute("data-value") && target.getAttribute("data-value") != null){
                    if(target.getAttribute("data-value") == null || target.getAttribute("data-value") == "" || target.getAttribute("data-value") == "null"){
                        targetValid = false;
                        //target.setAttribute("data-value", "");
                        //target.value = "";
                    }else{
                        target.value = target.getAttribute('data-string') || "";
                    }
                }else{
                    if(target.value == null || target.value == "0" || target.value == "" || target.value == "null"){
                        targetValid = false;
                        //target.value = "";
                    }else{
                        targetValid = this.#typeInput(target);
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
                    $message = target.getAttribute("data-invalid");
                    if($message){
                        this.#actionListInvalid($message, false);
                    }
                }else{
                    valid=false;
                    target.parentNode.classList.add(this.options.nameClass);
                    //input
                    target.classList.add(this.options.inputInvalidClass);
                    $message = target.getAttribute("data-invalid");
                    if($message){
                        this.#actionListInvalid($message);
                    }

                }
            }
        });
        this.showMessages();
        return valid;
    }
    validate(t = []) {
        let a = !0,
            i = null;
        return (
            t.length &&
            t.forEach((t) => {
                let s = document.querySelector(t.element);
                t.value
                    ? (s.parentNode.classList.contains(this.options.nameClass) && s.parentNode.classList.remove(this.options.nameClass),
                    s.classList.contains(this.options.inputInvalidClass) && s.classList.remove(this.options.inputInvalidClass),
                    (i = s.getAttribute("data-invalid")) && document.querySelector("#" + i).classList.remove("show"))
                    : ((a = !1), s.parentNode.classList.add(this.options.nameClass), s.classList.add(this.options.inputInvalidClass), (i = s.getAttribute("data-invalid")) && document.querySelector("#" + i).classList.add("show"));
            }),
                a
        );
    }



    /************************** Methods para el listado de mensajes de data-invalid ******************/

    /**
    * recibe los atributos que tienen mensaje de error
     * @param  {string}
     *
     * @return  {null}
    * */
    #actionListInvalid(data_invalid, add = true){
        this.$messageListInvalids[data_invalid] = this.$messageListInvalids[data_invalid] || 0;
        if(add){
            this.$messageListInvalids[data_invalid] ++;
        }else{
            this.$messageListInvalids[data_invalid] --;
            //document.querySelector( `#${$message}`).classList.remove("show");
        }
    }

    /**
     * devuelve los atributos que tienen mensaje de error
     * */
    getListInvalid(){
        return this.$messageListInvalids;
    }

    /**
     * registro del listado d emensajes invalidos
     * @return {null}
     * **/
    #registerListMessages(){
        this.$messageListInvalids = [];
        document.querySelector(this.form).querySelectorAll("input, select").forEach(target =>{
            if(target.getAttribute("required") == "true"){
                const $message = target.getAttribute("data-invalid");
                if($message){
                    this.#actionListInvalid($message);
                }
            }
        });
    }
    /**
     * activa y muestra los mensajes de los inputs que son invalidos
     * @return {null}**/
    showMessages(){
        for (const $key in this.$messageListInvalids) {
            if(this.$messageListInvalids[$key] > 0){
                document.querySelector( `#${$key}`).classList.add("show");
            }else{
                document.querySelector( `#${$key}`).classList.remove("show");
            }
        }
    }
    /**
     * registra inputs o elementos y verifica si es valido o no
     * @param t{array}
     * @return {boolean}
     * **/
    /************************** FIN Methods para el listado de mensajes de data-invalid ******************/

    /************************** FIN Methods PARA ACTIVAR EVENTSLISTENERS  ******************/
    activateEventsInput(){
        let vm = this;
        document.querySelector(this.form).querySelectorAll("input, select").forEach(function (target){
            target.addEventListener("change", function (e) {
                vm.isValid();
            });
        });
    }

    /**
     * valida por tipo de dato si es valido o no
     * @param input
     * @return {boolean}
     */
    #typeInput(input){
    let type_input = input.getAttribute("type");
    let value_input = input.value;
    let isValid = true;
    const emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    if(type_input && value_input){
        switch (type_input){
            case 'email':

                if (!emailRegex.test(value_input)) {
                    isValid = false;
                }

                break;
            case 'tel':
                let min = input.getAttribute('min');
                let max = input.getAttribute('max');
                const strict = input.getAttribute('strict');
                let expreg = /^[0-9,^+\d]/;
                if(strict == 'true'){
                    if(!min) min = 7;
                    if(!max) max = 12;

                    expreg = new RegExp('^[0-9,^+\d]{'+min+','+max+'}$');
                }
                if (!expreg.test(value_input)) isValid = false;
                break;
        }
    }
        //console.log(isValid, input.getAttribute("name"));
    return isValid;
    }

}