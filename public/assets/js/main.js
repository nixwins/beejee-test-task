$(document).ready(function() {

    $("#taskForm").submit(function(event) {
        event.preventDefault();
        const post_url = $(this).attr("action");
        const  request_method = $(this).attr("method");
        const form_data = $(this).serialize();

        $.ajax({
            url: post_url,
            type: request_method,
            data: form_data
        }).done(function(response) { //

            console.log(response);

            render(response);

        });
    });


    let createTaskModalCloseIc = $("#createTaskModalCloseIc").click(function() {
        location.reload();
    });
    let createTaskModalCloseBtn = $("#createTaskModalCloseBtn").click(function() {
        location.reload();
    });

    const render = function(data) {

        if(data.save == undefined){
            $("#status-msg").html("Пройзашла ошибка на сервере.");
        }
        if (data.save == true) {

            $("#status-msg").html("Задача добавлена");
            $("#task-list tr:first").after(data.html);


        } else {
            let msg = '';
            for (let i = 0; i < data.length; i++) {
                if (data[i].message != undefined)
                    msg += data[i].message;
            }
            $("#status-msg").html(msg);
        }
    };
    
    $("#loginForm").submit(function (event) {
        event.preventDefault();
        const post_url = $(this).attr("action");
        const  request_method = $(this).attr("method");
        const form_data = $(this).serialize();
        console.log(form_data);
        $.ajax({
            url: post_url,
            type: request_method,
            data: form_data
        }).done(function (response) { //

            console.log(response);
           
            if(response.isLogin == true){
                window.location.href = "/user/profile";
            }else{
                $("#login-status-msg").text(response.message);
            }
          

        });
    });

    $(".statusChangeBtn").on('click', function(event){
          
          event.preventDefault();
          
          const form_data = $(this).parent().serialize();
          console.log($(this).parent().serialize());
          $.ajax({
            url: "/task/update/status",
            type: "POST",
            data: form_data
        }).done(function (response) { //

            console.log(response);

            if (response.updated == true) {
                window.location.href = "/user/profile";
            }


        });
    });
    
   

});

