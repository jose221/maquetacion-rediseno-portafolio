document.querySelectorAll(".collapse-btn").forEach( function (element) {
    element.addEventListener("click",function (e) {
        let  target = e.target;
        console.log(e);
        document.querySelector(target.getAttribute("data-target")).classList.toggle("show");
    })
})

document.querySelectorAll(".btn-tooltip").forEach( function (element) {
    element.addEventListener("click",function (e) {
        console.log(element)
      try{
          let  target = e.target;
          console.log( e.target);
          document.querySelectorAll(".tooltip").forEach(function (target1){
              if(target1.classList.contains("show")){
                  target1.classList.remove("show");
              }
          })
          target.querySelector(".tooltip").classList.toggle("show");
      }catch (e){
          console.log(e)
      }
    })
})
document.querySelectorAll(".btn-tooltip-close").forEach( function (element) {
    element.addEventListener("click",function (e) {
        let  target = e.target;
        document.querySelectorAll(".tooltip").forEach(function (target1){
            if(target1.classList.contains("show")){
                target1.classList.remove("show");
            }
        })
    })
})
