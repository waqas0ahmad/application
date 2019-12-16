
/**
 * 
 * Will timeout after 5 min inactivity
 */
onInactive(300000, function () {
    window.location.href='./logout.php'
});
function onFileSelect(_this){
    if($(_this)[0].files.length>0)
    $("#file").text($(_this)[0].files[0].name)
}
function onInactive(ms, cb) {
    var wait = setTimeout(cb, ms);
    document.onmousemove = document.mousedown = document.mouseup = document.onkeydown = document.onkeyup = document.focus = function () {
        clearTimeout(wait);
        wait = setTimeout(cb, ms);
    };
}


const html=`<div class="modal fade" id="deleteModalJs">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title" id="dlg-hd">Modal Heading</h4>
    </div>
    <div class="modal-body" id="dlg-bd">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-outline-success" id="btn1" >No</button>
        <button type="button" class="btn btn-outline-danger" id="btn" >Yes</button>
      
    </div>
  </div>
</div>
</div>`;

async function ConfirmAlert(head,body){
    if(!($("#deleteModalJs").length))
    $("body").append(html);
    $("#deleteModalJs").modal({  backdrop: 'static',
    keyboard: false},"show");

    $("#dlg-hd").text(head);
    $("#dlg-bd").html(body);
var promo=new Promise((res,rej)=>{
    $("#btn").on('click',(e)=>{
        $("#deleteModalJs").modal("hide");
        res("YES")
        //$("#deleteModalJs").remove();
    });
    $("#btn1").on('click',(e)=>{
        $("#deleteModalJs").modal("hide");
        res("NO");        
        //$("#deleteModalJs").remove();
    })
});
return await promo;
}

function DeleteAlert(filename){
    ConfirmAlert("Delete",`Do you want to delete <b>"${filename}"</b>?`).then(e=>{
        if(e=="YES"){            
            location.href=`./delete.php?link=${filename}`;
        }
        if(e=="NO"){
            
        }
    })
}
function PermanentDeleteAlert(filename){
    ConfirmAlert("Delete",`Do you want to delete <b>"${filename}"</b> permanently?`).then(e=>{
        if(e=="YES"){
            location.href=`./delete.php?link=${filename}`;
        }
        if(e=="NO"){
            
        }
    })
}

// var promise=new Promise((resolve,reject)=>{
//     setTimeout(()=>{
//         resolve(10)
//     },2000);
// });
// var abc=()=>{
//     return promise ;
// }
// async function init(){
//     let res=await abc();
//     return res;
// }
// console.log();