$("#roundFlight").click(function(){$(this).is(":checked")&&($("#cListFlights").addClass("c-round-flight"),$("#cListFlights").removeClass("c-single-flight"))}),$("#singleFlight").click(function(){$(this).is(":checked")&&($("#cListFlights").addClass("c-single-flight"),$("#cListFlights").removeClass("c-round-flight"))}),$(".evtPassengers").click(function(){$(".evtDropdown").focus().removeClass("d-none")}),$("html").click(function(){$(".evtDropdown").addClass("d-none")}),$(".evtPassengers").click(function(e){e.stopPropagation()}),$(".evtMinors1").click(function(){$(".evtTitle1").toggleClass("cm-title"),$(".evtDropdown1").toggleClass("d-none"),$(".evtYears1").addClass("d-none"),$(".evtTitle1").removeClass("position-absolute")}),$(".evtList1_1").click(function(){$(".evtYears1").removeClass("d-none"),$(".evtTitle1").addClass("position-absolute"),$(".evtDropdown1").toggleClass("d-none"),$(".evtTitle1").addClass("cm-title")}),$(".evtMinors2").click(function(){$(".evtTitle2").toggleClass("cm-title"),$(".evtDropdown2").toggleClass("d-none"),$(".evtYears2").addClass("d-none"),$(".evtTitle2").removeClass("position-absolute")}),$(".evtList2_1").click(function(){$(".evtYears2").removeClass("d-none"),$(".evtTitle2").addClass("position-absolute"),$(".evtDropdown2").toggleClass("d-none"),$(".evtTitle2").addClass("cm-title")}),$("#viewDetail").click(function(){$("#containerDetail").toggleClass("d-block")}),$("#viewDetailMobile").click(function(){$("#containerDetail").toggleClass("d-block")}),$("#detailClose").click(function(){$("#containerDetail").toggleClass("d-block")}),$("#cBrandFlight").click(function(){$(".evtHideMobile").toggleClass("d-none")});var owl=$("#carousel-1");owl.owlCarousel({navText:['<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABUAAAAUCAYAAABiS3YzAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAGdJREFUeNpiYCAMDID4PRQ7MFABwAz8D8UN1DYQxFagtoEGowYOnIGMUM37gVgASXwDEF8kw7wPQLwAxLiP5EJq4AYmBuqDD9T2/gOY92kS86MGD6zBCrQwuIFaidkAmuuIDgKAAAMA92Jbt0ySZLIAAAAASUVORK5CYII="/>','<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABUAAAAUCAYAAABiS3YzAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAGpJREFUeNpiYCAOGADxeyC+D2VTBTQA8X8ofk8tgxWghlHdYINRgwfOYEaoggRoDJMK9IE4AIn/AYgdQYwCJNuoge8zAQkBBioDRqihCWQajtP7gyYFjBpIuYE0KfpoUkg7QA0jykCAAAMACchXF/ysp2kAAAAASUVORK5CYII="/>'],dots:!0,stagePadding:50,margin:15,nav:!0,loop:!0,responsive:{0:{items:1},600:{items:2}}});
const now = new Date();
let section = "flights";
ageChilds = [
    {name: "1 año", value:1},
    {name: "2 años", value:2},
    {name: "3 años", value:3},
    {name: "4 años", value:4},
    {name: "5 años", value:5},
    {name: "6 años", value:6},
    {name: "7 años", value:7},
    {name: "8 años", value:8},
    {name: "9 años", value:9},
    {name: "10 años", value:10},
    {name: "11 años", value:11},
    {name: "12 años", value:12},
    {name: "13 años", value:13},
    {name: "14 años", value:14},
    {name: "15 años", value:15},
    {name: "16 años", value:16},
    {name: "14 años", value:17}
];
ageChildFlights = [
    {name: "0 a 24 meses(En brazos)", value:1},
    {name: "0 a 24 meses(En asiento)", value:2},
    {name: "2 a 11 años", value:3},
]
document.querySelectorAll("#tabs-options-buscador a").forEach(function (element){
    element.addEventListener("click", function (e){
        section = e.target.getAttribute("aria-controls");
        switch (section){
                case 'hotels':
                    window.widgetMain.switchEngine('Hotel', false);
                    //INSTANCE LIST CHILDS
                    listAgeChilds = ageChilds;
                break;
                case 'packages':
                    window.widgetMain.switchEngine('FlightPackage', false);
                    //INSTANCE LIST CHILDS
                    listAgeChilds = ageChilds;
                break;
                case 'flights':
                    //INSTANCE LIST CHILDS
                    listAgeChilds = ageChildFlights;
                break;
        }
        console.log(section)
    });
})

/** TYPE TRANPOSRT **/
//$("#fOrigin, #fDestination").removeClass("col-lg-3"), $("#fReturn").removeClass("d-none"), $("#fGoing").removeClass("c-going col-md-12 col-lg-2");});
function actionButtonTransport(element){
    element.addEventListener("change", function (e) {
        const data_value = e.target.getAttribute("data-value");
        console.log(`#transporte-${section}`)
        if (e.target.checked) {
            document.querySelector(`#transporte-${section}`).value = data_value;
            switch (data_value){
                case 'redondo':
                    document.querySelector("#fOrigin, #fDestination").classList.remove("col-lg-3");
                    document.querySelector("#fReturn").classList.remove("d-none");
                    document.querySelector("#fGoing").classList.remove("c-going", "col-md-12","col-lg-2");
                    document.querySelector("#fReturn").querySelector("input").setAttribute("required", true);
                    break;
                case 'unavia':
                    document.querySelector("#fOrigin, #fDestination").classList.add("col-lg-3");
                    document.querySelector("#fReturn").classList.add("d-none");
                    document.querySelector("#fGoing").classList.add("c-going", "col-md-12","col-lg-2");
                    document.querySelector("#fReturn").querySelector("input").removeAttribute("required");
                    break;
            }
        }
    });
}
document.querySelectorAll(".btn-transport").forEach(actionButtonTransport);

async function init(){
    //INSTANCE LIST CHILDS
    listAgeChilds = ageChildFlights;
    //INSTANCE DATEPICK
    //**FLIGHTS**//
    var picker_to_flight=new Lightpick({ field:document.getElementById("to_calendar"), separator:"/", numberOfMonths: 2});
    var picker_from_flight=new Lightpick(
        { field:document.getElementById("from_calendar"), separator:"/", numberOfMonths: 2,minDate:now, startDate:now,
            onSelect:function (e){
                console.log(e.toString('YYYY/MM/DD'))
                picker_to_flight.reloadOptions({minDate:e.toString('YYYY/MM/DD')})
                picker_to_flight.show();
            }
        });
    //**HOTELS**//
    var picker2=new Lightpick(
        {format: "YYYY/MM/DD", separator:"/", field:document.getElementById("start_date_hotels"), numberOfMonths: 2,secondField:document.getElementById("end_date_hotels"),minDate:now,repick:!0});
    //**PACKAGES**//
    var picker3=new Lightpick(
        {format: "YYYY/MM/DD",separator:"/", field:document.getElementById("start_date_packages"), numberOfMonths: 2,secondField:document.getElementById("end_date_packages"),minDate:now,repick:!0});
}
init();
    function actionPassagers(element, total){
        element.setAttribute("data-value",total);
        element.querySelector("span").innerText = total;
        if(element.querySelector("input")){
            element.querySelector("input").value = total;
        }
        console.log(element)
        displayPassagers(element, total);
    }
    function displayPassagers(element, total) {
        text = "";
        const target = section;
        const value = document.querySelector(`#${element.getAttribute("data-type")}-${target}`).value //total
        let display = document.querySelector(`.${section}-display`);
        display.setAttribute(`data-${element.getAttribute("data-type")}`, value);
        display.value = `${display.getAttribute("data-adult")} adultos${ (Number.parseInt(display.getAttribute("data-minor"))>0) ? `, ${display.getAttribute("data-minor")} menores` : ''} ${ Number.parseInt(display.getAttribute("data-rooms"))>0 ? `, ${display.getAttribute("data-rooms")} habitaciones` : ''}
        
        `;
    }
    function eventMinor(element, action, value=1){
        const type = element.getAttribute("data-type");
        const target = section;
        switch (action){
            case "plus":
                document.querySelector(`#${type}-${target}`).value = Number.parseInt(document.querySelector(`#${type}-${target}`).value) + value;
                break;
            case "minus":
                document.querySelector(`#${type}-${target}`).value = Number.parseInt(document.querySelector(`#${type}-${target}`).value) - value;
                break;
        }
    }
    function addAgeMinor(element, total){
        const node = document.createElement("div");
        node.setAttribute("class", `col-12 font-14  item-minor-${element.getAttribute("data-target")} mt-1`);
        new_input = "";
        if(element.getAttribute("data-list")){
            new_input = addInput(`${element.getAttribute("data-name")}[${element.getAttribute("data-list")}].MinorsAges[${total-1}].Years`,  "", "", true)
        }else{
            new_input = addInput(`edad${total}`, "", "", true);
        }

        let html = `<div id="cMinors_${total}" class="c-minors w-100 position-relative rounded evtMinors1 -cp-pointer">
                                                                <span id="cTitle_${total}" class="c-title evtTitle1 -pe-none" data-value="0">Menor 1</span>
                                                                <!--<span id="cYears_1" class="c-title d-none evtYears1">2 años</span>-->
                                                                <span id="iExpand_${total}" class="icon icon-expand font-24 -pe-none"></span>
                                                                ${new_input}
                                                            </div>
                                                            <div id="cmDropdown_${total}" class="c-minors-dropdown py-2 d-none evtDropdown1">
                                                               `;
        listAgeChilds.forEach(minor =>{
            html += `<div id="cList_${total}_${minor.value}" class="c-list" data-value="${minor.value}">${minor.name}</div>`;
        });
        html +=`</div>`;
        node.innerHTML =html;
        document.querySelector(`.list-minor-${element.getAttribute("data-target")}`).appendChild(node);
        node.querySelector(`#cMinors_${total}`).addEventListener("click", function (e){
            let content = node.querySelector(`#cmDropdown_${total}`);
            content.classList.toggle("d-none");
            content.querySelectorAll(".c-list").forEach(function (elementItem){
                elementItem.addEventListener("click", function (item){
                    console.log(e.target)
                    e.target.querySelector(`#cTitle_${total}`).innerText = item.target.innerText;
                    e.target.querySelector(`#cTitle_${total}`).setAttribute("data-value",item.target.getAttribute("data-value") );
                    e.target.querySelector(`#cMinors_${total} input`).value = item.target.getAttribute("data-value");
                    content.classList.add("d-none");
                });
            });
        });
    }
    function removeAgeMinor(element, total){
        let list = document.querySelectorAll(`.item-minor-${element.getAttribute("data-target")}`);
        list[total].remove();
    }
    document.querySelectorAll(".btn-passengers").forEach(actionBtnPassgers);
    function actionBtnPassgers(target){
        target.addEventListener("click",function (e){
            let element = e.target;
            let  value = document.querySelector(`.${element.getAttribute("data-target")} .${element.getAttribute("data-type")}-value`);
            console.log(`.${element.getAttribute("data-target")} .${element.getAttribute("data-type")}-value`)
            switch (element.getAttribute("data-action")) {
                case "minus":
                    if(element.getAttribute("data-type") == 'minor' && value.getAttribute("data-value")-1 < 0){
                        return false;
                    }else if(element.getAttribute("data-type") == 'adult' && value.getAttribute("data-value")-1 < 1){
                        return false;
                    }else {
                        if(element.getAttribute("data-type") == 'minor'){
                            removeAgeMinor(value, Number.parseInt(value.getAttribute("data-value"))-1)
                        }
                        eventMinor(value, element.getAttribute("data-action"))
                        actionPassagers(value, Number.parseInt(value.getAttribute("data-value"))-1)
                    }
                    break;
                case "plus":
                    if(element.getAttribute("data-type") == 'minor'){
                        addAgeMinor(value, Number.parseInt(value.getAttribute("data-value"))+1)
                    }
                    eventMinor(value, element.getAttribute("data-action"))
                    actionPassagers(value, Number.parseInt(value.getAttribute("data-value"))+1)
                    break;
            }
        });
    }
    document.querySelectorAll(".btn-add-list").forEach(function (item){
        item.addEventListener("click", function (e){
            let value_default = 2;
            const target = e.target.getAttribute("data-target");
            const action = e.target.getAttribute("data-action");
            const type = e.target.getAttribute("data-type");
            const name = e.target.getAttribute("data-name");
            let list_items = document.querySelector(action);
            const item_index = Number.parseInt(list_items.getAttribute("data-list")) + 1;
            list_items.setAttribute("data-list", item_index)
            let display = document.querySelector(`.${section}-display`);
            display.setAttribute(`data-${name}`, item_index+1);
            const node = document.createElement("div");
            node.setAttribute("class", `item-${type}-${target+item_index}`);
            node.setAttribute("data-index", item_index);
            const chtml = `<!-- start adults -->
                                                    <div class="row mb-3">
                                                     <div class="col-12 font-14 mt-2 mb-3 d-flex justify-content-between align-items-center">
                                                                <h4 class="mb-1 font-16 f-bold">Habitación ${item_index + 1}</h4>
                                                                <span class="color-secundary pointer remove-item-${type}-${target+item_index}" data-name="${name}" data-controls=".item-${type}-${target+item_index}" role="button">Quitar</span>
                                                            </div>
                                                        <div class="col-7 col-md-5 col-lg-7">
                                                            <span class="hotels-adult-text">Adultos</span>
                                                        </div>
                                                        <div class="col-5 col-md-7 col-lg-5 c-icons pr-4">
                                                            <div class="row hotels${item_index}">
                                                                <div class="col-4 px-1 text-center btn-passengers -cp-pointer" data-target="hotels${item_index}" data-action="minus" data-type="adult">
                                                                    <span class="icon icon-remove -pe-none"></span>
                                                                </div>
                                                                <div class="col-4 px-1 text-center adult-value" data-target="hotels${item_index}" data-value="${value_default}" data-type="adult">
                                                                    <span>${value_default}</span>
                                                                    ${addInput(`${type}[${item_index}].Adults`,"", value_default, true)}
                                                                </div>
                                                                <div class="col-4 px-1 text-center btn-passengers -cp-pointer" data-target="hotels${item_index}" data-action="plus" data-type="adult">
                                                                    <span class="icon icon-add -pe-none"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- start minors-->
                                                    <div class="row mb-3">
                                                        <div class="col-7 col-md-5 col-lg-7">
                                                            <span class="hotels-minor-text">Menores</span>
                                                        </div>
                                                        <div class="col-5 col-md-7 col-lg-5 c-icons pr-4">
                                                            <div class="row hotels${item_index}">
                                                                <div class="col-4 px-1 text-center btn-passengers -cp-pointer" data-target="hotels${item_index}" data-action="minus" data-type="minor">
                                                                    <span class="icon icon-remove -pe-none"></span>
                                                                </div>
                                                                <div data-list="${item_index}" data-name="${type}" class="col-4 px-1 text-center minor-value" data-target="hotels${item_index}" data-value="0" data-type="minor">
                                                                    <span>0</span>
                                                                    ${addInput(`${type}[${item_index}].Minors`,"", 0, false)}
                                                                </div>
                                                                <div class="col-4 px-1 text-center btn-passengers -cp-pointer" data-target="hotels${item_index}" data-action="plus" data-type="minor">
                                                                    <span class="icon icon-add -pe-none"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row list-minor-hotels${item_index}">
                                                            <div class="col-12 font-14 mb-2">
                                                                <span>¿Cuál es su edad?</span>
                                                                <span>*</span>
                                                                <span class="font-12">(hasta 17 años)</span>
                                                            </div>
                                                        </div>`;
            node.innerHTML = chtml;
            node.querySelectorAll(".btn-passengers").forEach(actionBtnPassgers)
            node.querySelector(`.remove-item-${type}-${target+item_index}`).addEventListener("click", eventRemoveItemList)
            eventMinor(node.querySelector(".adult-value"), "plus", value_default)
            displayPassagers(node.querySelector(".adult-value"), value_default)
            list_items.appendChild(node)

        });
    })
    function eventRemoveItemList(e){
         const control = e.target.getAttribute("data-controls");
        const element = document.querySelector(control);
        const el_minor = element.querySelector(".minor-value");
        const el_adult = element.querySelector(".adult-value");
        //change data
        eventMinor(el_minor, "minus", Number.parseInt(el_minor.getAttribute("data-value")))
        eventMinor(el_adult, "minus", Number.parseInt(el_adult.getAttribute("data-value")))
        //minus rooms and display
        let display = document.querySelector(`.${section}-display`);
        let total_rooms = Number.parseInt(display.getAttribute(`data-${e.target.getAttribute("data-name")}`));
        display.setAttribute(`data-${e.target.getAttribute("data-name")}`, total_rooms-1);
        displayPassagers(el_minor, el_minor.getAttribute("data-value"))
        displayPassagers(el_adult, el_adult.getAttribute("data-value"))
        element.remove();
    }
    function addInput(name, classes="", value = "", required=false){
        const  aria_invalid = document.querySelector(`.${section}-display`).getAttribute("aria-invalid") || "";
        return `<input type="text" name="${name}" class="${classes}" value="${value}" hidden="true" ${(required)? `required="${required}" aria-invalid="${aria_invalid}"`:""}>`;
    }
    /** SUBMIT **/
   /**
    document.querySelector("#form_flights").addEventListener("submit",  function (e){
        e.preventDefault();
        console.log(e)
        const validation = new Validation("form_flights",{nameClass:"c-has-invalid", inputInvalidClass:"c-invalid"});
        console.log(validation)
        if(validation.isValid()){
            this.submit();
        }
    });
    document.querySelector("#ap_booker_Hotel_form").addEventListener("submit",  function (e){
        e.preventDefault();
        const validation = new Validation("ap_booker_Hotel_form",{nameClass:"c-has-invalid", inputInvalidClass:"c-invalid"});
        //let isValid = validation.validate([{element: ".hotels-display", value: null}])
        if(validation.isValid()){
            this.submit();
        }
    });
    document.querySelector("#ap_booker_FlightPackage_form").addEventListener("submit",  function (e){
        e.preventDefault();
        const validation = new Validation("ap_booker_FlightPackage_form",{nameClass:"c-has-invalid", inputInvalidClass:"c-invalid"});
        //let isValid = validation.validate([{element: ".hotels-display", value: null}])
        if(validation.isValid()){
            this.submit();
        }
    });
    **/

 document.querySelectorAll(".btn-submit").forEach((element)=>{
        element.addEventListener("click",  function (e){
            //e.preventDefault();
            const $form =  e.target.getAttribute("data-action");
            console.log($form)
            const validation = new Validation($form,{nameClass:"c-has-invalid", inputInvalidClass:"c-invalid"});
            //let isValid = validation.validate([{element: ".hotels-display", value: null}])
            if(validation.isValid()){
                document.querySelector(`#${$form}`).querySelector(`button[type="submit"]`).click();
            }
        });
    });
