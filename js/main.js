function getCheckedCheckBoxes() {
    var checkboxes = document.getElementsByClassName('checkboxHobby');
    var checkboxesChecked = [];
    for (var index = 0; index < checkboxes.length; index++) {
        if (checkboxes[index].checked) {
            checkboxesChecked.push(checkboxes[index].value); // положим в массив выбранный
        }
    }
    return checkboxesChecked; // для использования в нужном месте
}

$('#push-package').click(function (e){
    e.preventDefault();
    let hobbies = getCheckedCheckBoxes()
    $(`textarea`).removeClass('error');
    $(`label`).removeClass('text-danger');
    $(`label`).removeClass('fs-4');

    let id = document.getElementById("one").value;
    let about = document.getElementById('about').value;





    let formData = new FormData();
    formData.append('id' , id);
    formData.append('about' , about);
    formData.append('hobbies' , hobbies);



    $.ajax({
        url: '/send/addQuestionnaire',
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        data: formData,
        success (data){
            if(data.status){
                document.location.href = 'successabout';
            }
            if(data.type === 1){
                data.fields.forEach(function (field){
                    $(`textarea[id = "${field}"]`).addClass('error');
                    $(`label[id = "${field}"]`).addClass('text-danger fs-4');
                    msgReg.textContent = data.massage;
                });
            }
        }
    });
});