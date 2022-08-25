var base_url = window.location.origin;
const SELECT_IKK = document.getElementById("id_ikk")
const TARGET = document.getElementById('target')

if(!!SELECT_IKK)
{
    SELECT_IKK.addEventListener("change",()=>{
        let selectIKKValue = SELECT_IKK.value
        $.ajax({
            url: base_url+'/async-request/ref-ikk',
            method: 'POST',
            data:{
                idIkk: selectIKKValue
            }
        }).success((data)=>{
            TARGET.value = data;
        })
    })
}
